<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TgBotController;
use App\Http\Controllers\TgGroupsController;
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
Route::post('/bot_hook2', [TgBotController::class, 'bot_hook2']);

Route::get('/TgGroupsIndex', [TgGroupsController::class, 'index']);
Route::post('/TgGroupsUpdate/{id}', [TgGroupsController::class, 'update']);


Route::get('/test', [TgBotController::class, 'test']);
Route::get('/olx_parse1', [TgBotController::class, 'olx_parse1']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
