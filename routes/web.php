<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebcamController;
use App\Http\Controllers\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//FOR CLEAR ALL CACHE
Route::get('/clear-caches', function () { Artisan::call('cache:clear'); Artisan::call('storage:link'); Artisan::call('config:cache');
    Artisan::call('clear-compiled'); Artisan::call('view:clear'); Artisan::call('route:clear'); return "Cache is cleared";
});


Route::get("/home", function(){ return View::make("index"); })->name('homepage');

Route::get('webcam', [WebcamController::class, 'index']);
Route::get('/', [WebcamController::class, 'index']);
Route::post('webcam', [WebcamController::class, 'store'])->name('webcam.capture');

//For Login /Register
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login-auth', [LoginController::class, 'login'])->name('adminlogin');
