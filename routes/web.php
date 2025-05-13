<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tipos-soporte', [TipoSoporteController::class, 'index'])->name('tipos-soporte.index');


