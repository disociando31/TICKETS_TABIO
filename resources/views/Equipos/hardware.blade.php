@extends('layouts.app')
@include('partials.accessibility')
@section('content')
<div class="crear-usuario-container">
    <div class="header">
        <h1>Hardware - {{ $equipo->NombreEquipo }}</h1>
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

        <div class="hardware-section">
            <h3>Componentes de Hardware</h3>
            @if($equipo->hardware->isEmpty())
                <p class="no-data">No hay componentes de hardware registrados.</p>
            @else
                <div class="hardware-list">
                    @foreach($equipo->hardware as $hw)
                        <div class="hardware-item">
                            <div class="detalle-item">
                                <label>Número de Placa:</label>
                                <span class="valor">{{ $hw->NumeroPlaca }}</span>
                            </div>
                            <div class="detalle-item">
                                <label>Modelo CPU:</label>
                                <span class="valor">{{ $hw->ModeloCPU }}</span>
                            </div>
                            <div class="detalle-item">
                                <label>Serial CPU:</label>
                                <span class="valor">{{ $hw->SerialCPU }}</span>
                            </div>
                            <div class="detalle-item">
                                <label>Componente:</label>
                                <span class="valor">{{ $hw->Componente }}</span>
                            </div>
                            <div class="detalle-item">
                                <label>Descripción:</label>
                                <span class="valor">{{ $hw->Descripcion }}</span>
                            </div>
                            <div class="actions">
                                <button type="button" 
                                        class="btn-edit"
                                        onclick="editHardware({{ json_encode($hw) }})">
                                    Editar
                                </button>
                                <form action="{{ route('hardware.destroy', $hw->id) }}" 
                                      method="POST" 
                                      class="delete-form"
                                      onsubmit="return confirm('¿Está seguro de eliminar este componente?')">
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
                + Agregar Nuevo Hardware
            </button>
        </div>
    </div>

    <!-- Formulario Modal para Agregar/Editar -->
    <div id="hardwareModal" class="modal" style="display: none;">
        <div class="modal-content">
            <h3 id="modalTitle">Agregar Hardware</h3>
            <form id="hardwareForm" method="POST">
                @csrf
                <input type="hidden" id="hardwareId" name="hardwareId">
                <div class="form-group">
                    <label for="NumeroPlaca">Número de Placa:</label>
                    <input type="text" id="NumeroPlaca" name="NumeroPlaca" required>
                </div>
                <div class="form-group">
                    <label for="ModeloCPU">Modelo CPU:</label>
                    <input type="text" id="ModeloCPU" name="ModeloCPU" required>
                </div>
                <div class="form-group">
                    <label for="SerialCPU">Serial CPU:</label>
                    <input type="text" id="SerialCPU" name="SerialCPU" required>
                </div>
                <div class="form-group">
                    <label for="Componente">Componente:</label>
                    <input type="text" id="Componente" name="Componente" required>
                </div>
                <div class="form-group">
                    <label for="Descripcion">Descripción:</label>
                    <input type="text" id="Descripcion" name="Descripcion" required>
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
    document.getElementById('modalTitle').textContent = 'Agregar Hardware';
    document.getElementById('hardwareForm').reset();
    document.getElementById('hardwareForm').action = "{{ route('hardware.store', $equipo->idEquipo) }}";
    document.getElementById('hardwareModal').style.display = 'block';
}

function editHardware(hardware) {
    document.getElementById('modalTitle').textContent = 'Editar Hardware';
    document.getElementById('NumeroPlaca').value = hardware.NumeroPlaca;
    document.getElementById('ModeloCPU').value = hardware.ModeloCPU;
    document.getElementById('SerialCPU').value = hardware.SerialCPU;
    document.getElementById('Componente').value = hardware.Componente;
    document.getElementById('Descripcion').value = hardware.Descripcion;
    document.getElementById('hardwareId').value = hardware.id;
    document.getElementById('hardwareForm').action = `/hardware/${hardware.id}`;
    document.getElementById('hardwareForm').innerHTML += '@method("PUT")';
    document.getElementById('hardwareModal').style.display = 'block';
}

function hideModal() {
    document.getElementById('hardwareModal').style.display = 'none';
    document.getElementById('hardwareForm').reset();
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

.hardware-item {
    background: #f8f9fa;
    padding: 1.5rem;
    margin-bottom: 1rem;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.actions {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
    justify-content: flex-end;
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

.detalle-item {
    margin-bottom: 0.5rem;
}

.detalle-item label {
    font-weight: bold;
    margin-right: 0.5rem;
}
</style>
@endsection