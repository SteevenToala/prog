<?php
session_start();


if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'cliente') {
    header("Location: ../pages/iniciarSesion.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Cliente</title>
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
                <h4 class="text-center mt-3">Menú del Cliente</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" onclick="showSection('dashboard')">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('misAlquileres')">
                            <i class="fas fa-car"></i> Mis Alquileres
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('vehiculosDisponibles')">
                            <i class="fas fa-car-side"></i> Vehículos Disponibles
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
                <h1>Bienvenido, Cliente</h1>

                <!-- Sección de Dashboard -->
                <div id="dashboard" class="content-section active">
                    <h2>Dashboard</h2>
                    <p>Información general sobre tus alquileres y los vehículos disponibles para alquilar.</p>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Alquileres Activos</h5>
                                    <p class="card-text">Tienes 2 alquileres activos.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Vehículos Disponibles</h5>
                                    <p class="card-text">Actualmente hay 5 vehículos disponibles para alquilar.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección de Mis Alquileres -->
                <div id="misAlquileres" class="content-section">
                    <h2>Mis Alquileres</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID de Alquiler</th>
                                <th>Vehículo</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>Toyota Corolla</td>
                                <td>2024-09-20</td>
                                <td>2024-09-27</td>
                                <td>Activo</td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>Honda Civic</td>
                                <td>2024-09-22</td>
                                <td>2024-09-29</td>
                                <td>Activo</td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>Ford Mustang</td>
                                <td>2024-08-10</td>
                                <td>2024-08-17</td>
                                <td>Finalizado</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Sección de Vehículos Disponibles -->
                <div id="vehiculosDisponibles" class="content-section">
                    <h2>Vehículos Disponibles para Alquilar</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID de Vehículo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Año</th>
                                <th>Precio por Día</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>Toyota</td>
                                <td>Corolla</td>
                                <td>2022</td>
                                <td>$50</td>
                                <td><button class="btn btn-primary">Alquilar</button></td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>Honda</td>
                                <td>Civic</td>
                                <td>2021</td>
                                <td>$45</td>
                                <td><button class="btn btn-primary">Alquilar</button></td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>Ford</td>
                                <td>Mustang</td>
                                <td>2023</td>
                                <td>$100</td>
                                <td><button class="btn btn-primary">Alquilar</button></td>
                            </tr>
                            <tr>
                                <td>004</td>
                                <td>Chevrolet</td>
                                <td>Camaro</td>
                                <td>2023</td>
                                <td>$90</td>
                                <td><button class="btn btn-primary">Alquilar</button></td>
                            </tr>
                            <tr>
                                <td>005</td>
                                <td>BMW</td>
                                <td>Series 3</td>
                                <td>2022</td>
                                <td>$85</td>
                                <td><button class="btn btn-primary">Alquilar</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

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
</body>

</html>