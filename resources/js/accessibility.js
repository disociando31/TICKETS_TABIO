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