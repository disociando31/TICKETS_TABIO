<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GestionSoporteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\SoporteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TipoAsistenciaController;
use App\Http\Controllers\TiposEquipoController;
use App\Http\Controllers\TiposMantenimientoController;
use App\Http\Controllers\TipoSoporteController;
use App\Http\Controllers\UserController;

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
    'verify' => false,
]);

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
Route::middleware(['auth', 'permission.active:gestionar_perfil'])
    ->group(function () {
        Route::get('/perfil', [UserController::class, 'editarPerfil'])->name('perfil');
        Route::put('/perfil', [UserController::class, 'actualizarPerfil'])->name('perfil.update');
    });

// Rutas para GestionSolicitudController
Route::middleware(['auth', 'permission.active:gestionar_solicitudes'])->group(function () {
    Route::resource('gestion_solicitudes', SolicitudController::class);
});

// Rutas para GestionSoporteController
Route::middleware(['auth', 'permission.active:gestionar_soportes'])->group(function () {
    Route::resource('gestion_soportes', GestionSoporteController::class);
});

// Rutas para SolicitudController
Route::middleware(['auth', 'permission.active:gestionar_solicitudes'])->group(function () {
    Route::resource('solicitudes', SolicitudController::class);
});

// Rutas para SoporteController
Route::middleware(['auth', 'permission.active:gestionar_soportes'])->group(function () {
    Route::resource('soportes', SoporteController::class);
});

// Rutas para TicketController
Route::middleware(['auth', 'permission.active:gestionar_todos_tickets'])->group(function () {
    Route::resource('tickets', TicketController::class);
});

// Rutas para TipoAsistenciaController
Route::middleware(['auth', 'permission.active:gestionar_tipos_asistencia'])->group(function () {
    Route::resource('tipos_asistencia', TipoAsistenciaController::class);
});

// Rutas para TipoEquipoController
Route::middleware(['auth', 'permission.active:gestionar_tipos_equipos'])->group(function () {
    Route::resource('tipos_equipos', TiposEquipoController::class);
});

// Rutas para TipoMantenimientoController
Route::middleware(['auth', 'permission.active:gestionar_tipos_mantenimientos'])->group(function () {
    Route::resource('tipos_mantenimientos', TiposMantenimientoController::class);
});

// Rutas para TipoSoporteController
Route::middleware(['auth', 'permission.active:gestionar_tipos_soporte'])->group(function () {
    Route::resource('tipos_soporte', TipoSoporteController::class);
});
