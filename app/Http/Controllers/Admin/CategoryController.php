<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //Display a listing of the resource.
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    //Show the form for creating a new resource.
    public function create()
    {
        return view('admin.categories.create');
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'slug'          => 'required|string|max:50|unique:posts',
            'name'          => 'required|string|max:50',
            'description'   => 'required|string|max:5000',
        ]);

        $data = $request->all() + [
            'user_id' => Auth::id(),
        ];

        // salvataggio
        $category = Category::create($data);

        return redirect()->route('admin.categories.show', ['category' => $category->slug]);
        // redirect
    }

    //Display the specified resource.
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    //Show the form for editing the specified resource.
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, Category $category)
    {

        // validation
        $data = $request->all();

        // aggiornare nel database
        $category->update($data);

        // redirect
        return redirect()->route('admin.categories.show', ['category' => $category]);
    }

    //Remove the specified resource from storage.
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}
