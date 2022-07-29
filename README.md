# Progetto Laravel con login

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
1. Su package.json modificare:
    - **"bootstrap": "^4.0.0",** in **"bootstrap": "^5.1.3",** (o comunque la versione che si vuole usare)
    - **"jquery": "^3.2"** DA RIMUOVERE,
    - **"popper.js": "^1.12",** in **"@popperjs/core": "^2.11.5",**
1. Su resorces/js/bootstrap.js commentare (perchè non servono per bootstrap 5):
    - **window.Popper = require('popper.js').default;**
    - **window.$ = window.jQuery = require('jquery');**
    - **require('bootstrap');** copiarlo in resorces/js/bootstrap.js,
1. Aggiornare il file webpack.mix.js affinchè produca file js diversi per il front office (con Vue) e il backoffice (con blade):
    ```
    mix.js('resources/js/front.js', 'public/js')
        .js('resources/js/back.js', 'public/js')
        .sass('resources/sass/back.scss', 'public/css');
    ```
1. nella cartella **resources/js/** creare i file **front.js** e **back.js** copiando il file **app.js** già presente
1. nella cartella **resources/css/** rinominare il file **app.scss** in **back.scss**
1. cambiare il link al css nel file app.blade.php in back.css,
1. inserire **<script src="{{ asset('js/back.js') }}" defer></script>** in app.blade.php nella sezione scripts per far funzionare bootstrap,
1. Installare le librerie js:
    ```npm install```
        ```npm run watch ```

## Models
1. Creare la cartella Models (**con la maiuscola**) e metterci dentro il file del model **User.php**
1. Modificare in User.php il namespace: da **namespace App;** a **namespace App\Models;** (ricordatevi che il namespace di tutto ciò che sta nella cartella app deve coincidere con la struttura delle cartelle)
1. Per l'intero progetto i model li costruiremo con:
    ```php artisan make:model Models/<NomeDelModel>```
1. fare una ricerca nella cartella del progetto di **App\User** e sostituirlo con **App\Models\User** (non modificare però i file che si trovano nella cartella vendor)
1. Spostare e rinominare il file **app/Http/Controllers/HomeController.php** in **app/Http/Controllers/Admin/AdminController.php**
1. Nel file appena spostato:
    - rinominare anche il nome della classe in **class AdminController extends Controller**
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
