import './accessibility';

function toggleNarrator() {
    alert('Función de narrador activada.');
}

function increaseText() {
    document.body.style.fontSize = 'larger';
}

function decreaseText() {
    document.body.style.fontSize = 'smaller';
}

function increaseSpacing() {
    document.body.style.letterSpacing = '2px';
}

function decreaseSpacing() {
    document.body.style.letterSpacing = 'normal';
}

function toggleGrayscale() {
    document.body.style.filter = document.body.style.filter === 'grayscale(100%)' ? 'none' : 'grayscale(100%)';
}

function toggleHighContrast() {
    document.body.classList.toggle('high-contrast');
}

function toggleDyslexicFont() {
    document.body.classList.toggle('dyslexic-font');
}

function increaseCursor() {
    document.body.style.cursor = 'zoom-in';
}

function highlightLinks() {
    document.querySelectorAll('a').forEach(link => {
        link.style.backgroundColor = 'yellow';
    });
}

function resetAccessibility() {
    document.body.style = '';
    document.querySelectorAll('a').forEach(link => {
        link.style.backgroundColor = '';
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const contrastButton = document.querySelector('.icon-contraste');

    if (contrastButton) {
        contrastButton.addEventListener('click', () => {
            const body = document.body;

            // Alternar entre modo oscuro y claro
            if (body.classList.contains('modo_oscuro-govco')) {
                body.classList.remove('modo_oscuro-govco');
                body.classList.add('modo_claro-govco');
            } else {
                body.classList.remove('modo_claro-govco');
                body.classList.add('modo_oscuro-govco');
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const increaseButton = document.querySelector('.icon-aumentar');
    const decreaseButton = document.querySelector('.icon-reducir');
    const body = document.body;

    // Aumentar tamaño de fuente
    if (increaseButton) {
        increaseButton.addEventListener('click', () => {
            const currentFontSize = parseFloat(window.getComputedStyle(body).fontSize);
            if (!isNaN(currentFontSize)) {
                body.style.fontSize = `${currentFontSize + 2}px`; // Incrementa en 2px
                console.log(`Tamaño de fuente aumentado a: ${currentFontSize + 2}px`);
            } else {
                console.error('No se pudo obtener el tamaño de la fuente actual.');
            }
        });
    } else {
        console.error('Botón de aumentar letra no encontrado.');
    }

    // Reducir tamaño de fuente
    if (decreaseButton) {
        decreaseButton.addEventListener('click', () => {
            const currentFontSize = parseFloat(window.getComputedStyle(body).fontSize);
            if (!isNaN(currentFontSize) && currentFontSize > 10) { // Evitar que sea menor a 10px
                body.style.fontSize = `${currentFontSize - 2}px`; // Reduce en 2px
                console.log(`Tamaño de fuente reducido a: ${currentFontSize - 2}px`);
            } else if (currentFontSize <= 10) {
                console.warn('El tamaño de la fuente no puede ser menor a 10px.');
            } else {
                console.error('No se pudo obtener el tamaño de la fuente actual.');
            }
        });
    } else {
        console.error('Botón de reducir letra no encontrado.');
    }
});