<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

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

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');

// Rutas para usuarios
Route::resource('usuarios', UserController::class);

// Rutas para perfil de usuario
Route::get('/perfil', [UserController::class, 'editarPerfil'])->name('perfil');
Route::put('/perfil', [UserController::class, 'actualizarPerfil'])->name('perfil.update');

// Rutas para roles
Route::resource('roles', RoleController::class)->except(['destroy']);
Route::patch('/roles/{id}/toggle-estado', [RoleController::class, 'toggleEstado'])->name('roles.toggle-estado');