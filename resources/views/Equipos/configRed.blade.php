@extends('layouts.app')
@include('partials.accessibility')
@section('content')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Configuración de Red - {{ $equipo->NombreEquipo }}</h1>
    </div>
    
    @if ($errors->any())
    <div class="error-container">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

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

        <!-- Configuración Actual -->
        <div class="config-red-section">
            <h3>Configuración Actual</h3>
            @if($configActual)
                <div class="config-red-list">
                    <div class="config-red-item">
                        <div class="detalle-item">
                            <label>Dirección MAC:</label>
                            <span class="valor">{{ $configActual->MAC }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Dirección IP:</label>
                            <span class="valor">{{ $configActual->IP }}</span>
                        </div>
                    </div>
                </div>
            @else
                <p class="no-data">No hay configuración de red actual registrada.</p>
            @endif
        </div>

        <!-- Historial de Configuraciones -->
        @if($historialConfig->isNotEmpty())
        <div class="config-red-section">
            <h3>Historial de Configuraciones</h3>
            <div class="config-red-list">
                @foreach($historialConfig as $config)
                    <div class="config-red-item">
                        <div class="detalle-item">
                            <label>Dirección MAC:</label>
                            <span class="valor">{{ $config->MAC }}</span>
                        </div>
                        <div class="detalle-item">
                            <label>Dirección IP:</label>
                            <span class="valor">{{ $config->IP }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modificar el script -->
<script>
// Eliminar la función showAddForm
function editConfigRed(mac, ip, id) {
    document.getElementById('modalTitle').textContent = 'Editar Configuración de Red';
    document.getElementById('MAC').value = mac;
    document.getElementById('IP').value = ip;
    document.getElementById('configId').value = id;
    document.getElementById('configRedForm').action = `/configRed/${id}`;
    document.getElementById('configRedForm').innerHTML += '@method("PUT")';
    document.getElementById('configRedModal').style.display = 'block';
}

function hideModal() {
    document.getElementById('configRedModal').style.display = 'none';
    document.getElementById('configRedForm').reset();
}
</script>

<style>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    padding: 2rem;
    border-radius: 8px;
    width: 100%;
    max-width: 500px;
}

.config-red-item {
    background: #f8f9fa;
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 4px;
}

.actions {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.btn-edit, .btn-delete {
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
}

.btn-edit {
    background: #007bff;
    color: white;
    border: none;
}

.btn-delete {
    background: #dc3545;
    color: white;
    border: none;
}

.delete-form {
    display: inline;
}
</style>
@endsection