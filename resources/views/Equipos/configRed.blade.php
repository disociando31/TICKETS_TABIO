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

        <div class="config-red-section">
            <h3>Configuraciones de Red</h3>
            @if($equipo->configRed->isEmpty())
                <p class="no-data">No hay configuraciones de red registradas.</p>
            @else
                <div class="config-red-list">
                    @foreach($equipo->configRed as $config)
                        <div class="config-red-item">
                            <div class="detalle-item">
                                <label>Dirección MAC:</label>
                                <span class="valor">{{ $config->MAC }}</span>
                            </div>
                            <div class="detalle-item">
                                <label>Dirección IP:</label>
                                <span class="valor">{{ $config->IP }}</span>
                            </div>
                            <div class="actions">
                                <button type="button" 
                                        class="btn-edit"
                                        onclick="editConfigRed('{{ $config->MAC }}', '{{ $config->IP }}', {{ $config->id }})">
                                    Editar
                                </button>
                                <form action="{{ route('configRed.destroy', $config->id) }}" 
                                      method="POST" 
                                      class="delete-form"
                                      onsubmit="return confirm('¿Está seguro de eliminar esta configuración?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <button type="button" class="btn-add" onclick="showAddForm()">
                + Agregar Nueva Configuración
            </button>
        </div>
    </div>

    <!-- Formulario Modal para Agregar/Editar -->
    <div id="configRedModal" class="modal" style="display: none;">
        <div class="modal-content">
            <h3 id="modalTitle">Agregar Configuración de Red</h3>
            <form id="configRedForm" method="POST">
                @csrf
                <input type="hidden" id="configId" name="configId">
                <div class="form-group">
                    <label for="MAC">Dirección MAC:</label>
                    <input type="text" id="MAC" name="MAC" required>
                </div>
                <div class="form-group">
                    <label for="IP">Dirección IP:</label>
                    <input type="text" id="IP" name="IP" required>
                </div>
                <div class="buttons-container">
                    <button type="submit" class="btn-submit">Guardar</button>
                    <button type="button" class="btn-cancel" onclick="hideModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="buttons-container">
        <a href="{{ route('equipos.show', $equipo->idEquipo) }}" class="btn-back">
            Volver al Equipo
        </a>
    </div>
</div>

<script>
function showAddForm() {
    document.getElementById('modalTitle').textContent = 'Agregar Configuración de Red';
    document.getElementById('configRedForm').reset();
    document.getElementById('configRedForm').action = "{{ route('configRed.store', $equipo->idEquipo) }}";
    document.getElementById('configRedModal').style.display = 'block';
}

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