<nav class="sb-topnav navbar navbar-expand navbar-light" style="background-color:lightgray">
    <a class="navbar-brand" href="#">
        <img src="./img/LogoExpertsDev.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
        CdEIG
    </a>

    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <div class="d-none d-md-inline-block ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <ul class="navbar-nav mr-auto">
            <!-- Menu principal quand l'utilisateur est identifié -->
            <li class="nav-item active">
                <a class="nav-link" href="#">A propos <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Module 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Module 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Module 3</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Module 4</a>
            </li>
            <!-- fin du menu principal -->
        </ul>

    </div>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Paramètres</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Déconnexion</a>
            </div>
        </li>
    </ul>
</nav>
