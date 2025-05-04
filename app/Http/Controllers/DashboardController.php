<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $rol = $user->getRoleNames()->first() ?? 'Sin rol';
        
        // Verificar si el usuario tiene al menos un rol activo
        $hasActiveRoles = $user->roles()->where('estado', true)->exists();
        
        return view('home', [
            'rol' => $rol,
            'rolDesactivado' => !$hasActiveRoles
        ]);
    }
}