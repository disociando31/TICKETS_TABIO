document.addEventListener("keyup", detectTabKey);

function detectTabKey(e) {
    if (e.keyCode == 9) {
        if (document.getElementById("botoncontraste").classList.contains("active-barra-accesibilidad-govco")) {
            document.getElementById("botoncontraste").classList.toggle("active-barra-accesibilidad-govco");
        }
        if (document.getElementById("botonaumentar").classList.contains("active-barra-accesibilidad-govco")) {
            document.getElementById("botonaumentar").classList.toggle("active-barra-accesibilidad-govco");
        }
        if (document.getElementById("botondisminuir").classList.contains("active-barra-accesibilidad-govco")) {
            document.getElementById("botondisminuir").classList.toggle("active-barra-accesibilidad-govco");
        }
    }
}

function cambiarContexto() {
    var botoncontraste = document.getElementById("botoncontraste");
    var botonaumentar = document.getElementById("botonaumentar");
    var botondisminuir = document.getElementById("botondisminuir");

    if (!botoncontraste.classList.contains("active-barra-accesibilidad-govco")) {
        botoncontraste.classList.toggle("active-barra-accesibilidad-govco");
        document.getElementById("titleaumentar").style.display = "";
        document.getElementById("titledisminuir").style.display = "";
        document.getElementById("titlecontraste").style.display = "none";
    }
    if (botondisminuir.classList.contains("active-barra-accesibilidad-govco")) {
        botondisminuir.classList.remove("active-barra-accesibilidad-govco");
    }
    if (botonaumentar.classList.contains("active-barra-accesibilidad-govco")) {
        botonaumentar.classList.remove("active-barra-accesibilidad-govco");
    }

    // Modificar para cambiar el contraste de toda la página
    document.body.classList.toggle('modo_oscuro-govco');
    
    // También cambiar el div específico para-mirar
    var element = document.getElementById('para-mirar');
    if (document.body.classList.contains('modo_oscuro-govco')) {
        element.className = "modo_oscuro-govco";
    } else {
        element.className = "modo_claro-govco";
    }
}

function disminuirTamanio() {
    console.log("Disminuyendo tamaño"); // Para depuración
    
    var botoncontraste = document.getElementById("botoncontraste");
    var botonaumentar = document.getElementById("botonaumentar");
    var botondisminuir = document.getElementById("botondisminuir");

    // Manejo de clases de botones
    if (!botondisminuir.classList.contains("active-barra-accesibilidad-govco")) {
        botondisminuir.classList.toggle("active-barra-accesibilidad-govco");
        document.getElementById("titleaumentar").style.display = "";
        document.getElementById("titledisminuir").style.display = "none";
        document.getElementById("titlecontraste").style.display = "";
    }
    if (botonaumentar.classList.contains("active-barra-accesibilidad-govco")) {
        botonaumentar.classList.remove("active-barra-accesibilidad-govco");
    }
    if (botoncontraste.classList.contains("active-barra-accesibilidad-govco")) {
        botoncontraste.classList.remove("active-barra-accesibilidad-govco");
    }

    // Modificar el tamaño de TODOS los elementos de texto
    var elementos = document.querySelectorAll('body *');
    elementos.forEach(function(element) {
        // Verificar si el elemento tiene texto visible
        if (element.textContent && element.textContent.trim() !== '') {
            const tamanioActual = parseFloat(window.getComputedStyle(element).fontSize);
            if (tamanioActual > 8) { // Límite mínimo de 8px
                element.style.fontSize = (tamanioActual - 2) + 'px';
            }
        }
    });
}

function aumentarTamanio() {
    console.log("Aumentando tamaño"); // Para depuración
    
    var botoncontraste = document.getElementById("botoncontraste");
    var botonaumentar = document.getElementById("botonaumentar");
    var botondisminuir = document.getElementById("botondisminuir");

    // Manejo de clases de botones
    if (!botonaumentar.classList.contains("active-barra-accesibilidad-govco")) {
        botonaumentar.classList.toggle("active-barra-accesibilidad-govco");
        document.getElementById("titleaumentar").style.display = "none";
        document.getElementById("titledisminuir").style.display = "";
        document.getElementById("titlecontraste").style.display = "";
    }
    if (botondisminuir.classList.contains("active-barra-accesibilidad-govco")) {
        botondisminuir.classList.remove("active-barra-accesibilidad-govco");
    }
    if (botoncontraste.classList.contains("active-barra-accesibilidad-govco")) {
        botoncontraste.classList.remove("active-barra-accesibilidad-govco");
    }

    // Modificar el tamaño de TODOS los elementos de texto
    var elementos = document.querySelectorAll('body *');
    elementos.forEach(function(element) {
        // Verificar si el elemento tiene texto visible
        if (element.textContent && element.textContent.trim() !== '') {
            const tamanioActual = parseFloat(window.getComputedStyle(element).fontSize);
            if (tamanioActual < 32) { // Límite máximo de 32px
                element.style.fontSize = (tamanioActual + 2) + 'px';
            }
        }
    });
}

// Eliminar la función tamanioElemento ya que no la necesitamos más
function tamanioElemento(element) {
    const tamanioParrafo = window.getComputedStyle(element, null).getPropertyValue('font-size');
    return parseFloat(tamanioParrafo);
}