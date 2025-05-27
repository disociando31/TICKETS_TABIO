<nav class="navbar navbar-expand-lg barra-superior-govco" aria-label="Barra superior">
    <div class="container-fluid">
        <a href="https://www.gov.co/" target="_blank" aria-label="Portal del Estado Colombiano - GOV.CO"></a>
        <div class="d-flex align-items-center">
            @auth
                <form action="{{ route('logout') }}" method="POST" class="me-3">
                    @csrf
                    <button type="submit" class="btn btn-link text-white text-decoration-none">
                        Cerrar sesión
                    </button>
                </form>
            @endauth
            <button class="idioma-icon-barra-superior-govco float-right" aria-label="Button to change the language of the page to English"></button>
        </div>
    </div>
</nav>