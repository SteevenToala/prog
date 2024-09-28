<?php
session_start();

// Verificar si el usuario está autenticado y es un usuario normal
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'empleado') {
    header("Location: ../pages/iniciarSesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            position: sticky;
            top: 0;
            background-color: #343a40;
            color: white;
        }

        .sidebar a {
            color: #fff;
            padding: 15px;
            display: block;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .main-content {
            padding: 20px;
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar">
                <h4 class="text-center mt-3">Menú del Empleado</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" onclick="showSection('dashboard')">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('alquileres')">
                            <i class="fas fa-car"></i> Alquileres
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('vehiculos')">
                            <i class="fas fa-car-side"></i> Vehículos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('tareas')">
                            <i class="fas fa-tasks"></i> Tareas Diarias
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
                <h1>Bienvenido, Empleado</h1>

                <!-- Sección de Dashboard -->
                <div id="dashboard" class="content-section active">
                    <h2>Dashboard</h2>
                    <p>Información general sobre las tareas y alquileres actuales.</p>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Estadísticas de Alquileres</h4>
                            <canvas id="rentalStats" width="400" height="200"></canvas>
                        </div>
                        <div class="col-md-6">
                            <h4>Vehículos Disponibles</h4>
                            <canvas id="vehiculosStats" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Sección de Alquileres -->
                <div id="alquileres" class="content-section">
                    <h2>Alquileres Actuales</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID de Alquiler</th>
                                <th>Cliente</th>
                                <th>Vehículo</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>Juan Pérez</td>
                                <td>Toyota Corolla</td>
                                <td>2024-09-20</td>
                                <td>2024-09-27</td>
                                <td>Activo</td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>Ana Gómez</td>
                                <td>Honda Civic</td>
                                <td>2024-09-22</td>
                                <td>2024-09-29</td>
                                <td>Activo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Sección de Vehículos -->
                <div id="vehiculos" class="content-section">
                    <h2>Vehículos Disponibles</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID de Vehículo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Año</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>Toyota</td>
                                <td>Corolla</td>
                                <td>2022</td>
                                <td>Disponible</td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>Honda</td>
                                <td>Civic</td>
                                <td>2021</td>
                                <td>Mantenimiento</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Sección de Tareas Diarias -->
                <div id="tareas" class="content-section">
                    <h2>Tareas Diarias</h2>
                    <ul class="list-group">
                        <li class="list-group-item">Revisar estado de los vehículos</li>
                        <li class="list-group-item">Atender a los clientes</li>
                        <li class="list-group-item">Registrar nuevos alquileres</li>
                    </ul>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function showSection(section) {
            // Ocultar todas las secciones de contenido
            document.querySelectorAll('.content-section').forEach((sec) => {
                sec.classList.remove('active');
            });
            // Mostrar la sección seleccionada
            document.getElementById(section).classList.add('active');
        }

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

        const ctxVehiculos = document.getElementById('vehiculosStats').getContext('2d');
        const vehiculosStatsChart = new Chart(ctxVehiculos, {
            type: 'pie',
            data: {
                labels: ['Disponible', 'Mantenimiento'],
                datasets: [{
                    label: 'Estado de Vehículos',
                    data: [70, 30],
                    backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(255, 99, 132, 0.5)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>

</html>
