@extends('layouts.app')
@include('partials.accessibility')
@section('content')
<div class="usuarios-container">
    <div class="usuarios-header">
        <h1 class="usuarios-title">Agregar Software - {{ $equipo->NombreEquipo }}</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="table-responsive">
        <div class="info-card">
            <form method="POST" action="{{ route('equipos.software.store', $equipo->idEquipo) }}">
                @csrf
                <div class="form-group">
                    <label for="SistemaOperativo">Sistema Operativo:</label>
                    <input type="text" class="form-control" id="SistemaOperativo" name="SistemaOperativo" value="{{ old('SistemaOperativo') }}" required>
                </div>

                <div class="form-group">
                    <label for="SuiteOfimatica">Suite Ofimática:</label>
                    <input type="text" class="form-control" id="SuiteOfimatica" name="SuiteOfimatica" value="{{ old('SuiteOfimatica') }}" required>
                </div>

                <div class="form-group">
                    <label for="LicSuiteOfimatica">Licencia Suite Ofimática:</label>
                    <input type="text" class="form-control" id="LicSuiteOfimatica" name="LicSuiteOfimatica" value="{{ old('LicSuiteOfimatica') }}" required>
                </div>

                <div class="form-group">
                    <label for="Antivirus">Antivirus:</label>
                    <input type="text" class="form-control" id="Antivirus" name="Antivirus" value="{{ old('Antivirus') }}" required>
                </div>

                <div class="form-group">
                    <label for="LicAntivirus">Licencia Antivirus:</label>
                    <input type="text" class="form-control" id="LicAntivirus" name="LicAntivirus" value="{{ old('LicAntivirus') }}" required>
                </div>

                <div class="actions-container">
                    <a href="{{ route('equipos.software.index', $equipo->idEquipo) }}" class="btn-volver">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <button type="submit" class="btn-crear">
                        <i class="fas fa-save"></i> Guardar Software
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.usuarios-container {
    padding: 20px;
}

.usuarios-header {
    margin-bottom: 20px;
}

.usuarios-title {
    margin: 0;
    font-size: 24px;
    color: #333;
}

.info-card {
    background: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #666;
}

.form-control {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.actions-container {
    margin-top: 20px;
    display: flex;
    gap: 10px;
    justify-content: flex-start;
}

.btn-volver {
    background: #6c757d;
    color: white;
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-crear {
    background: #28a745;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-volver:hover {
    background: #5a6268;
}

.btn-crear:hover {
    background: #218838;
}

.alert {
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}
</style>
@endsection