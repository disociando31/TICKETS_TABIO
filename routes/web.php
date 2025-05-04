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

// Ruta de dashboard
Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('home');

// Rutas para usuarios (protegidas por permiso)
Route::middleware(['auth', 'permission.active:gestionar_usuarios'])
    ->group(function () {
        Route::resource('usuarios', UserController::class);
    });

// Rutas para roles (protegidas por permiso)
Route::middleware(['auth', 'permission.active:gestionar_roles'])
    ->group(function () {
        Route::resource('roles', RoleController::class)->except(['destroy']);
        Route::patch('/roles/{id}/toggle-estado', [RoleController::class, 'toggleEstado'])
             ->name('roles.toggle-estado');
    });

// Rutas para perfil (solo requieren autenticación)
Route::middleware(['auth',  'permission.active:gestionar_perfil'])
    ->group(function () {
        Route::get('/perfil', [UserController::class, 'editarPerfil'])->name('perfil');
        Route::put('/perfil', [UserController::class, 'actualizarPerfil'])->name('perfil.update');
    });

