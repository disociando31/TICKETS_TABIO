@extends('layouts.app')
@include('partials.accessibility')
@section('content')
<div class="usuarios-container">
    <div class="usuarios-header">
        <h1 class="usuarios-title">Software Instalado - {{ $equipo->NombreEquipo }}</h1>
        @can('gestionar_equipos')
            
                <i class="fas fa-plus"></i> Agregar Software
            </a>
        @endcan
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
            <div class="info-section">
                <h3>Información del Equipo</h3>
                <div class="detalle-item">
                    <label>Nombre del Equipo:</label>
                    <span class="valor">{{ $equipo->NombreEquipo }}</span>
                </div>
                <div class="detalle-item">
                    <label>Dependencia:</label>
                    <span class="valor">{{ $equipo->dependencia->Dependencia }}</span>
                </div>
            </div>

            <div class="info-section">
                <h3>Software Instalado</h3>
                @if(!$equipo->software_instalado)
                    <p class="no-data">No hay software instalado registrado.</p>
                @else
                    <div class="detalle-item">
                        <label>Sistema Operativo:</label>
                        <span class="valor">{{ $equipo->software_instalado->SistemaOperativo ?? 'No especificado' }}</span>
                    </div>

                    <div class="detalle-item">
                        <label>Suite Ofimática:</label>
                        <span class="valor">{{ $equipo->software_instalado->SuiteOfimatica ?? 'No especificado' }}</span>
                    </div>

                    <div class="detalle-item">
                        <label>Licencia Suite Ofimática:</label>
                        <span class="valor">{{ $equipo->software_instalado->LicSuiteOfimatica ?? 'No especificado' }}</span>
                    </div>

                    <div class="detalle-item">
                        <label>Antivirus:</label>
                        <span class="valor">{{ $equipo->software_instalado->Antivirus ?? 'No especificado' }}</span>
                    </div>

                    <div class="detalle-item">
                        <label>Licencia Antivirus:</label>
                        <span class="valor">{{ $equipo->software_instalado->LicAntivirus ?? 'No especificado' }}</span>
                    </div>

                    @can('gestionar_equipos')
                        <div class="acciones-grupo">
                            <button type="button" class="btn-editar" onclick="editSoftware('{{ $equipo->software_instalado->idSoftwareInstalado }}')">
                                <i class="fas fa-edit"></i> Editar Software
                            </button>
                        </div>
                    @endcan
                @endif
            </div>
        </div>
    </div>

    <!-- Modal para Editar Software -->
    <div id="softwareModal" class="modal" style="display: none;">
        <div class="modal-content">
            <h3 id="modalTitle">Editar Software</h3>
            <form id="softwareForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="softwareId" name="softwareId">
                
                <div class="form-group">
                    <label for="SistemaOperativo">Sistema Operativo:</label>
                    <input type="text" id="SistemaOperativo" name="SistemaOperativo" class="form-control">
                </div>

                <div class="form-group">
                    <label for="SuiteOfimatica">Suite Ofimática:</label>
                    <input type="text" id="SuiteOfimatica" name="SuiteOfimatica" class="form-control">
                </div>

                <div class="form-group">
                    <label for="LicSuiteOfimatica">Licencia Suite Ofimática:</label>
                    <input type="text" id="LicSuiteOfimatica" name="LicSuiteOfimatica" class="form-control">
                </div>

                <div class="form-group">
                    <label for="Antivirus">Antivirus:</label>
                    <input type="text" id="Antivirus" name="Antivirus" class="form-control">
                </div>

                <div class="form-group">
                    <label for="LicAntivirus">Licencia Antivirus:</label>
                    <input type="text" id="LicAntivirus" name="LicAntivirus" class="form-control">
                </div>

                <div class="buttons-container">
                    <button type="submit" class="btn-submit">Guardar</button>
                    <button type="button" class="btn-cancel" onclick="hideModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="actions-container">
        <a href="{{ route('equipos.show', $equipo->idEquipo) }}" class="btn-volver">
            <i class="fas fa-arrow-left"></i> Volver al Equipo
        </a>
    </div>
</div>

<style>
.usuarios-container {
    padding: 20px;
}

.usuarios-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.usuarios-title {
    margin: 0;
    font-size: 24px;
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

.btn-editar {
    background: #007bff;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
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

.info-card {
    background: white;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.info-section {
    margin-bottom: 20px;
}

.info-section h3 {
    margin-bottom: 15px;
    color: #333;
}

.detalle-item {
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

.detalle-item label {
    font-weight: bold;
    min-width: 200px;
    color: #666;
}

.valor {
    color: #333;
}

.acciones-grupo {
    margin-top: 15px;
    display: flex;
    gap: 10px;
}

.no-data {
    color: #666;
    font-style: italic;
}
</style>

@endsection