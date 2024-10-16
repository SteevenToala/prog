<?php
session_start();

// Verificar si el usuario está autenticado y es administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'administrador') {
    header("Location: ../pages/iniciarSesion.php");
    exit();
}



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/home_admin.css">
    <style>
        .eliminarR{
            color: black;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar">
                <h4 class="text-center mt-3">Menú de Administración</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" onclick="showSection('dashboard')">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#userManagement" role="button" aria-expanded="false" aria-controls="userManagement">
                            <i class="fas fa-users"></i> Gestión de Usuarios
                        </a>
                        <div class="collapse" id="userManagement">
                            <a class="nav-link ms-3" href="#" onclick="showSection('addUser')">Agregar Usuario</a>
                            <a class="nav-link ms-3" href="#" onclick="showSection('listUsers')">Listar Usuarios</a>
                            <a class="nav-link ms-3" href="#" onclick="showSection('editUser')">Editar Usuario</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('reports')">
                            <i class="fas fa-chart-line"></i> Reportes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="../util/logout.php">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Contenido Principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <h1>Bienvenido, Administrador</h1>

                <!-- Sección de Dashboard -->
                
                <?php include './home_section/dashboard.html';?>

                <!-- Sección de Agregar Usuario -->
                <?php include './home_section/addUser.html';?>

                <!-- Sección de Listar Usuarios -->
                <?php include './home_section/listUser.php';?>

                <!-- Sección de Editar Usuario -->
                <?php include './home_section/editUser.html';?>
                
                <!-- Sección de Reportes -->
                <?php include './home_section/reports.html';?>

            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./home_section/js/addUser.js"></script>

    <script>
        function showSection(section) {
            // Ocultar todas las secciones de contenido
            document.querySelectorAll('.content-section').forEach((sec) => {
                sec.classList.remove('active');
            });
            // Mostrar la sección seleccionada
            document.getElementById(section).classList.add('active');
        }
    </script>
    <!-- Al final del archivo antes de cerrar el </body> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxRental = document.getElementById('rentalStats').getContext('2d');
        const rentalStatsChart = new Chart(ctxRental, {
            type: 'bar',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                datasets: [{
                    label: 'Total de Alquileres',
                    data: [150, 120, 170, 200, 180, 220],
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctxUser = document.getElementById('userStats').getContext('2d');
        const userStatsChart = new Chart(ctxUser, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                datasets: [{
                    label: 'Usuarios Registrados',
                    data: [50, 70, 90, 120, 150, 180],
                    fill: false,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>