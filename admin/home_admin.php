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
<div id="dashboard" class="content-section active">
    <h2>Dashboard</h2>
    <p>Información general y estadísticas sobre la gestión.</p>

    <div class="row">
        <div class="col-md-6">
            <h4>Estadísticas de Alquiler</h4>
            <canvas id="rentalStats" width="400" height="200"></canvas>
        </div>
        <div class="col-md-6">
            <h4>Usuarios Registrados</h4>
            <canvas id="userStats" width="400" height="200"></canvas>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <h4>Resumen de Alquileres</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th>Total de Alquileres</th>
                        <th>Ingresos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Enero</td>
                        <td>150</td>
                        <td>$3000</td>
                    </tr>
                    <tr>
                        <td>Febrero</td>
                        <td>120</td>
                        <td>$2400</td>
                    </tr>
                    <tr>
                        <td>Marzo</td>
                        <td>170</td>
                        <td>$3400</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

                <!-- Sección de Agregar Usuario -->
                <div id="addUser" class="content-section">
                    <h2>Agregar Usuario</h2>
                    <form>
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                    </form>
                </div>

                <!-- Sección de Listar Usuarios -->
                <div id="listUsers" class="content-section">
                    <h2>Listar Usuarios</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre de Usuario</th>
                                <th>Fecha de Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Usuario 1</td>
                                <td>2024-01-01</td>
                                <td>
                                    <button class="btn btn-warning btn-sm">Editar</button>
                                    <button class="btn btn-danger btn-sm">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Sección de Editar Usuario -->
                <div id="editUser" class="content-section">
                    <h2>Editar Usuario</h2>
                    <form>
                        <div class="mb-3">
                            <label for="editUsername" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="editUsername" required>
                        </div>
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    </form>
                </div>

                <!-- Sección de Reportes -->                
                <div id="reports" class="content-section">
                    <h2>Reportes de Alquiler de Autos</h2>
                    <p>Aquí puedes ver y descargar diferentes tipos de reportes relacionados con el alquiler de autos.</p>

                    <div class="mb-3">
                        <label for="reportType" class="form-label">Selecciona el Tipo de Reporte</label>
                        <select class="form-select" id="reportType">
                            <option value="vehiculos">Reporte de Vehículos Alquilados</option>
                            <option value="ingresos">Reporte de Ingresos</option>
                            <option value="estadisticas">Estadísticas de Uso</option>
                        </select>
                    </div>

                    <button class="btn btn-primary mb-3" onclick="generateReport()">Generar Reporte</button>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Tipo de Reporte</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="reportTableBody">
                            <tr>
                                <td>2024-09-01</td>
                                <td>Vehículos Alquilados</td>
                                <td>Listado de vehículos alquilados en el mes de agosto.</td>
                                <td>
                                    <button class="btn btn-success btn-sm">Descargar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2024-09-10</td>
                                <td>Ingresos</td>
                                <td>Reporte de ingresos generados por alquileres durante el último mes.</td>
                                <td>
                                    <button class="btn btn-success btn-sm">Descargar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2024-09-20</td>
                                <td>Estadísticas de Uso</td>
                                <td>Informe sobre la frecuencia de alquiler de cada vehículo.</td>
                                <td>
                                    <button class="btn btn-success btn-sm">Descargar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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