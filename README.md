# TODOS
- assegnare post all'utente


# Progetto Laravel con login

## Organizzare il progetto
1. Definire la struttura del database per bene (tabelle, campi, tipo di ciascun campo e limiti, relazioni tra tabelle)
1. Tutta la parte di codice è bene farla in inglese (nomi tabelle, nomi variabili e se possibile anche commenti)
1. Definire le sezioni del sito (le pagine) e la struttura degli indirizzi
## Inizializzazione
1. Creare la cartella del progetto
1. Entrare dal terminale nella cartella
1. ```composer create-project --prefer-dist laravel/laravel:^7.0 .```
1. Solo per Laravel <= 7 rimuovere fzaninotto/faker perchè deprecato e installare la nuova libreria per generare dati fake:
    ```composer remove fzaninotto/faker```
    ```composer require fakerphp/faker```
1. Se volete usare la laravel-debugbar:
    ```composer require barryvdh/laravel-debugbar --dev```
1. Installare la libreria di scaffolding:
    ```composer require laravel/ui:^2.4```
1. Scegliere lo scaffolding desiderato (nel nostro caso vue con autenticazione):
    ```php artisan ui vue --auth```
1. (installare eventuali altre librerie per altre cose come: gestione ruoli, generazione slug)

## Frontend (js, css)
1. Su package.json modificare:
    - **"bootstrap": "^4.0.0",** in **"bootstrap": "^5.1.3",** (o comunque la versione che si vuole usare)
    - **"popper.js": "^1.12",** in **"@popperjs/core": "^2.11.5",**
1. Su resorces/js/bootstrap.js commentare (perchè non servono per bootstrap 5):
    - **window.Popper = require('popper.js').default;**
    - **window.$ = window.jQuery = require('jquery');**
1. Aggiornare il file webpack.mix.js affinchè produca file js diversi per il front office (con Vue) e il backoffice (con blade):
    ```js
    mix.js('resources/js/front.js', 'public/js')
        .js('resources/js/back.js', 'public/js')
        .sass('resources/sass/back.scss', 'public/css')
        .options({
            processCssUrls: false
        });
    ```
1. nella cartella **resources/js/** creare i file **front.js** e **back.js** copiando il file **app.js** già presente
1. nella cartella **resources/css/** rinominare il file **app.scss** in **back.scss**
1. Installare le librerie js:
    ```npm install```

## Backend specifico dell'applicazione
1. Creare la cartella Models (**con la maiuscola**) e metterci dentro il file del model **User.php**
1. Modificare in User.php il namespace: da **namespace App;** a **namespace App\Models;** (ricordatevi che il namespace di tutto ciò che sta nella cartella app deve coincidere con la struttura delle cartelle)
1. Per l'intero progetto i model li costruiremo con:
    ```php artisan make:model Models/<NomeDelModel>```
1. fare una ricerca nella cartella del progetto di **App\User** e sostituirlo con **App\Models\User** (non modificare però i file che si trovano nella cartella vendor)
1. Spostare e rinominare il file **app/Http/Controllers/HomeController.php** in **app/Http/Controllers/Admin/AdminController.php**
1. Nel file appena spostato:
    - modificare il namespace a **namespace App\Http\Controllers\Admin;**
    - aggiungere la riga di codice (se non c'è già) **use App\Http\Controllers\Controller;**
1. fare una ricerca nella cartella del progetto di **App\Http\Controllers\HomeController** e sostituirlo con **App\Http\Controllers\Admin\AdminController** (non modificare però i file che si trovano nella cartella vendor)
1. Per l'intero progetto i controllers li costruiremo con:
    ```php artisan make:controller <NomeCartella>/<NomeDelController> --resource --model=<NomeDelModel>```
1. Rigenerare la classmap:
    ```composer dump-autoload```
1. Nel file **app/Providers/RouteServiceProvider.php** modificare:
    - **public const HOME = '/home';** in **public const HOME = '/admin';** (oppure quello che avete messo voi)
1. Se serve modificare il file **app/Http/Middleware/Authenticate.php**:
    - **return route('login');** con la route che volete voi

## Routes
1. Nel file **routes/web.php** creare le rotte necessarie raggruppando tutte quelle dedicate al backoffice sotto il termine admin. Esempio:
    ```php
    Route::get('/', function () {
        return view('guests.home');
    })->name('home');

    Auth::routes();

    Route::middleware('auth')
   ->namespace('Admin')
   ->name('admin.')
   ->prefix('admin')
   ->group(function () {
        Route::get('/', 'AdminController@dashboard')->name('dashboard');
        Route::resource('posts', 'PostController');
   });
    ```
## Database
1. Creare il database da phpMyAdmin oppure da linea di comando o come volete
1. Nel file .env aggiornare i dati del database (quelli che iniziano con DB_) e giacchè anche APP_NAME col nome della vostra app
1. Aggiornare i file delle migrations
1. Aggiornare il file DatabaseSeeder.php aggiungendo <code>$this->call(ModelSeeder::class);</code> per ogni model di cui abbiamo il seeder
1. Aggiornare i file dei seeders
    - agiungere <code>use Faker\Generator as Faker;</code>
    - modificare <code>public function run()</code> a <code>public function run(Faker $faker)</code>
1. (slugs cercate nei file del progetto per dettagli)
1. Nel model impostare la proprietà $fillable con le colonne che possono essere "mass assigned"

## Views
1. Organizzare la cartella resources/views con:
    - una sottocartella admin (con le sottocartelle per ciascun model risorsa)
    - una sottocartella guests
1. spostare **home.blade.php** dentro admin e rinominarlo in **dashboard.blade.php** o comunquer rinominare i file con nomi chiari
1. aggiornare i vecchi nomi dei template blade ovunque erano stai usati (controllers, web.php, altri template blade ...)

## Parte Vue
1. Nel **webpack.mix.js** aggiungere ```mix.js('resources/js/front.js', 'public/js')```
1. Creare il file **front.js** in **resources/js**
1. Avviare (o riavviare) ```npm run watch```
1. Nel file **front.js** scrivere il codice per connettere Vue alla pagina:
    ```js
    require('./bootstrap');

    window.Vue = require('vue'); // importiamo la libreria Vue
    import App from './components/App.vue'; // importiamo il componente base App.vue e lo assegniamo alla variabile App

    // inizializziamo l'applicazione Vue passandogli l'oggetto di inizializzazione
    const app = new Vue({
        el: '#root', // id del componente nel file HTML dentro il quale opererà Vue
        render: h => h(App) // monta il componente App nell'elemento root
    });
    ```
1. Creare o modificare il template blade che gestirà la pagina (**guest/home.blade.php**)
1. Svuotare il body e mettere l'elemento vuoto root per Vue e l'importazione del file **front.js**:
    - opzione 1:
    ```html
    <body>
        <div id="root"></div>

        <script src="{{ asset('js/front.js') }}"></script>
    </body>
    ```
    - opzione 2:
    ```html
    <head>
        .....
        <script defer src="{{ asset('js/front.js') }}"></script>
    </head>
    <body>
        <div id="root"></div>
    <body>
    ```
1. Eliminare in **routes/web.php** la rotta '/' di default
1. In **routes/web.php** aggiungere alla fine (per ridirezionare tutte le rotte non gestite da Laravel a Vue, che le gestirà con il suo router):
    ```php
    // rotte frontoffice per Vue
    Route::get("{any?}", function() {
        return view("guests.home");
    })->where("any", ".*")->name('home');
    ```
1. Svuotare la cartella **resources/js/components** se esiste oppure crearla
1. Creare il componente **App.vue** nella stessa cartella (**resources/js/components**)
1. Ed ora scrivere tutto il front office
1. Se si sta usando bootstrap importare l'scss nel componente App.vue aggiungendo alla fine:
    ```html
    <style lang="scss">
        @import "~bootstrap/scss/bootstrap";
    </style>
    ```
## Laravel API
1. ...

## Usare il router di Vue
1. installarlo: ```npm install vue-router@3 --save-dev```
1. in **resources/js/front.js** collegare vue-router con vue:
    ```js
        require('./bootstrap');

        import Vue from 'vue';
        import VueRouter from 'vue-router'; // importiamo la libreria vue-router
        import App from './App.vue';

        // importiamo tutti i componenti delle pagine
        // ...
        // ...
        // ...


        // definiamo le rotte
        const routes = [
            {
                path: '/',
                name: 'nomeRotta',
                component: PageName,
            },
            {
                path: '/percorso/url/:parametro',
                name: 'nomeRotta',
                component: PageName,
                props: true, // se il parametro lo volete usare come una prop altrimenti è più difficile da recuperare
            },

            // definite anche gli altri
            {
                path: '*',
                name: 'page404',
                component: Page404,
            }
        ]

        // costruiamo il nostro router
        const router = new VueRouter({
            routes,
            mode: 'history', // per non avere l'hashtag nell'url ma richiede l'impostazione corretta del server
        });


        Vue.use(VueRouter); // diciamo a Vue di usare il plugin vue-router

        const app = new Vue({
            el: '#root',
            render: h => h(App),
            router, // diciamo a vue di inizializzare la nostra app usando il router che abbiamo costruito
        });
    ```
1. Creiamo la cartella **pages** con tutte le pagine
1. Creiamo i componenti vue per ciascuna pagina
1. Usiamo il router:
    ```
        <router-view></router-view>
    ```
    e
    ```
        <router-link :to="{name: 'nome route'}">Contentuto</router-link>
    ```
