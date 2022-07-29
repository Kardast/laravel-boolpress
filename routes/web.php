<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('guests.home');
})->name('home');

Auth::routes();

// Route::get('/admin', 'HomeController@index')->name('admin');
Route::middleware('auth')
   ->namespace('Admin') // cartella DENTRO A CONTROLLERS
   ->name('admin.') // le rotte iniziano con admin
   ->prefix('admin') // tutti le url avranno anche la parola admin (/admin/)
   ->group(function () {
        Route::get('/', 'AdminController@dashboard')->name('dashboard');
        Route::resource('posts', 'PostController');
        Route::get('users', 'UserController@index')->name('users.index');
        Route::resource('categories', 'CategoryController');
        Route::get('my-posts', 'PostController@myIndex')->name('posts.myIndex');
        Route::resource('tags', 'TagController');
   });
