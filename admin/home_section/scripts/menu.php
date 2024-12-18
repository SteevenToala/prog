<!-- Menú horizontal -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <!-- Botón para alternar el menú en dispositivos pequeños -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Menú -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home_admin.php">
                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gestion_users.php">
                        <i class="fas fa-users me-1"></i> Gestión de Usuarios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./gestion_vehicles.php">
                        <i class="fas fa-car me-1"></i> Gestión Vehículos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rents.php">
                        <i class="fas fa-chart-line me-1"></i> Alquileres
                    </a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link" href="reports.php">
                        <i class="fas fa-chart-line me-1"></i> Reportes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gestion_rates.php">
                        <i class="fas fa-tags me-1"></i> Gestión de Tarifas
                    </a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link text-danger" href="../util/logout.php">
                        <i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
