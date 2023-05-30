<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\tgBotController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/bot_hook', [tgBotController::class, 'bot_hook']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
