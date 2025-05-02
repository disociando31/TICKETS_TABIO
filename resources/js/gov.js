window.addEventListener("load", function() {
    initTopBar();
});


function initTopBar() {
    const translateElement = document.querySelector(".idioma-icon-barra-superior-govco");
    translateElement.addEventListener("click", translate, false);

    function translate() {
        // ... // Implementar traducción
    }
}