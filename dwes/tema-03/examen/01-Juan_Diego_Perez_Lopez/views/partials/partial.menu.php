<<<<<<< HEAD
<!-- menú principal Artículos -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Artículos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="nuevo.php">Nuevo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="order.php?criterio=id">Id</a></li>
                        <li><a class="dropdown-item" href="order.php?criterio=nombre">Nombre</a></li>
                        <li><a class="dropdown-item" href="order.php?criterio=poblacion">Población</a></li>
                        <li><a class="dropdown-item" href="order.php?criterio=curso">Curso</a></li>
                    </ul>
                </li>

            </ul>
            <form class="d-flex" role="search" action="filter.php" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="expresion" required>
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </form>
        </div>
    </div>
=======
<!-- menú principal Artículos -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Artículos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="nuevo.php">Nuevo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="order.php?criterio=id">Id</a></li>
                        <li><a class="dropdown-item" href="order.php?criterio=nombre">Nombre</a></li>
                        <li><a class="dropdown-item" href="order.php?criterio=poblacion">Población</a></li>
                        <li><a class="dropdown-item" href="order.php?criterio=curso">Curso</a></li>
                    </ul>
                </li>

            </ul>
            <form class="d-flex" role="search" action="filter.php" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="expresion" required>
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </form>
        </div>
    </div>
>>>>>>> 880701ca79aea3b9a52b24be21ccbac733d67c82
</nav>