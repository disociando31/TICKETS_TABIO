<div class="content-example-barra">
    <div class="barra-accesibilidad-govco">
        <button id="botoncontraste" class="icon-contraste" onclick="cambiarContexto()">
            <span id="titlecontraste">Contraste</span>
        </button>
        <button id="botondisminuir" class="icon-reducir" onclick="disminuirTamanio('disminuir')">
            <span id="titledisminuir">Reducir letra</span>
        </button>
        <button id="botonaumentar" class="icon-aumentar" onclick="aumentarTamanio('aumentar')">
            <span id="titleaumentar">Aumentar letra</span>
        </button>
    </div>
</div>

<script src="{{ asset('js/accessibility-gov.js') }}"></script>