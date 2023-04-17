<?php

use App\Http\Controllers\GameSessionController;
use App\Http\Controllers\HomeController;
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

Route::get('/', HomeController::class);

Route::controller(GameSessionController::class)
    ->prefix('game-sessions')
    ->name('game-sessions.')
    ->group(function () {
        Route::get('', 'show')->name('show');
        Route::post('', 'store')->name('store');
    });
