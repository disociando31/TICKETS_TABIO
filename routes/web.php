<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SoporteController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\Api\GestionSoporteController;
use App\Http\Controllers\Api\GestionTicketController;
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
Route::middleware(['auth', 'permission.active:gestionar_equipos'])
    ->group(function () {
        Route::resource('equipos', App\Http\Controllers\EquipoController::class);
        Route::get('equipos/{id}/configRed', [App\Http\Controllers\EquipoController::class, 'configRed'])->name('equipos.configRed');
        Route::get('equipos/{id}/hardware', [App\Http\Controllers\EquipoController::class, 'hardware'])->name('equipos.hardware');
        Route::get('equipos/{id}/software_instalados', [App\Http\Controllers\EquipoController::class, 'software_instalados'])->name('equipos.software_instalados');
        Route::get('equipos/{id}/tickets', [App\Http\Controllers\EquipoController::class, 'tickets'])->name('equipos.tickets');
        
    });
// Rutas para dependencias
Route::middleware(['auth', 'role.active:Administrador'])->group(function () {
    Route::resource('dependencias', DependenciaController::class);
    Route::patch('/dependencias/{id}/toggle-estado', [DependenciaController::class, 'toggleEstado'])
         ->name('dependencias.toggle-estado');
});

// Rutas para tickets
Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', TicketController::class);
});

// Rutas para Soporte
Route::middleware(['auth'])->group(function () {
    Route::get('/soportes/create/{ticket}', [SoporteController::class, 'create'])->name('soportes.create');
    Route::post('/soportes', [SoporteController::class, 'store'])->name('soportes.store');
    Route::get('/soportes/{soporte}', [SoporteController::class, 'show'])->name('soportes.show');
    Route::get('/soportes/{soporte}/edit', [SoporteController::class, 'edit'])->name('soportes.edit');
    Route::put('/soportes/{soporte}', [SoporteController::class, 'update'])->name('soportes.update');
});

// Rutas para Solicitud
Route::middleware(['auth'])->group(function () {
    Route::get('/solicitudes/create/{ticket}', [SolicitudController::class, 'create'])->name('solicitudes.create');
    Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');
    Route::get('/solicitudes/{solicitud}', [SolicitudController::class, 'show'])->name('solicitudes.show');
    Route::get('/solicitudes/{solicitud}/edit', [SolicitudController::class, 'edit'])->name('solicitudes.edit');
    Route::put('/solicitudes/{solicitud}', [SolicitudController::class, 'update'])->name('solicitudes.update');
});

// Rutas para API Gestión de Tickets
Route::middleware(['auth'])->prefix('api')->group(function () {
    Route::post('/gestion-tickets', [GestionTicketController::class, 'store'])->name('api.gestion-tickets.store');
});