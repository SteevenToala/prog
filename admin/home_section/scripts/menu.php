<!-- Checkbox para alternar el menú -->
<input type="checkbox" id="menu-toggle" hidden>

<!-- Botón para alternar el menú -->
<label for="menu-toggle" class="sidebar-toggler-label">
    <i class="fas fa-bars"></i>
</label>

<!-- Menú lateral -->
<nav class="col-md-3 col-lg-2 sidebar bg-light p-3">
    <h4 class="text-center mt-3"></h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="home_admin.php">
                <i class="fas fa-tachometer-alt me-2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="gestion_users.php">
                <i class="fas fa-users me-2"></i>
                <span>Gestión de Usuarios</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="./gestion_vehicles.php">
                <i class="fas fa-car me-2"></i>
                <span>Gestión Vehículos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="reports.php">
                <i class="fas fa-chart-line me-2"></i>
                <span>Reportes</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="gestion_rates.php">
                <i class="fas fa-chart-line me-2"></i>
                <span>Gestión de Tarifas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center text-danger" href="../util/logout.php">
                <i class="fas fa-sign-out-alt me-2"></i>
                <span>Cerrar Sesión</span>
            </a>
        </li>
    </ul>
</nav>
