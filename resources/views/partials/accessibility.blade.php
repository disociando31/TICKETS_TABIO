<div class="content-example-barra">
    <div class="barra-accesibilidad-govco">
        <button id="botoncontraste" class="icon-contraste" aria-label="Contraste" onclick="cambiarContexto()">
            <div class="icon-box">
                <img src="{{ asset('images/accessibility/Contraste.svg') }}" alt="Contraste">
            </div>
        </button>
        <button id="botondisminuir" class="icon-reducir" aria-label="Reducir letra" onclick="disminuirTamanio()">
            <div class="icon-box">
                <img src="{{ asset('images/accessibility/Minimizar.svg') }}" alt="Reducir letra">
            </div>
        </button>
        <button id="botonaumentar" class="icon-aumentar" aria-label="Aumentar letra" onclick="aumentarTamanio()">
            <div class="icon-box">
                <img src="{{ asset('images/accessibility/Maximizar.svg') }}" alt="Aumentar letra">
            </div>
        </button>
    </div>
</div>

<script src="{{ asset('js/accessibility-gov.js') }}"></script>
