<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TgBotController;
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
Route::get('/adminpanel', function (){return view('adminpanel/aPanel');});
Route::post('/bot_hook', [TgBotController::class, 'bot_hook']);

Route::get('/send', [TgBotController::class, 'store']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
