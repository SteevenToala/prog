<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'administrador') {
    header("Location: ../pages/iniciarSesion.php");
    exit();
}

include('../util/conexion.php');

$usuariosQuery = "SELECT * FROM usuarios";
$vehiculosQuery = "SELECT * FROM vehiculos";
$alquileresQuery = "SELECT * FROM alquileres";

// Ejecutar consultas
$usuariosResult = $conn->query($usuariosQuery);
$vehiculosResult = $conn->query($vehiculosQuery);
$alquileresResult = $conn->query($alquileresQuery);

// Contar los registros para los gráficos
$numUsuarios = $usuariosResult->num_rows;
$numVehiculos = $vehiculosResult->num_rows;
$numAlquileres = $alquileresResult->num_rows;

// Consulta para obtener los alquileres por mes
$query = "SELECT MONTH(fecha_inicio) AS mes, COUNT(*) AS cantidad
          FROM alquileres
          GROUP BY MONTH(fecha_inicio)
          ORDER BY mes";
$result = $conn->query($query);

// Arreglo para almacenar los alquileres por mes
$alquileres_por_mes = array_fill(0, 12, 0); // Inicializa un array con 12 ceros

// Llenar el arreglo con los resultados de la consulta
while ($row = $result->fetch_assoc()) {
    $alquileres_por_mes[$row['mes'] - 1] = $row['cantidad']; // Asignar la cantidad al mes correspondiente
}





// Consulta para obtener los vehículos por estado
$query2 = "SELECT estado, COUNT(*) AS cantidad
          FROM vehiculos
          GROUP BY estado";
$result2 = $conn->query($query2);

// Inicializar un array para almacenar las cantidades de cada estado
$estado_vehiculos = [
    'Excelente' => 0,
    'Bueno' => 0,
    'Regular' => 0,
    'Malo' => 0
];

// Llenar el array con los resultados de la consulta
while ($row = $result2->fetch_assoc()) {
    $estado_vehiculos[$row['estado']] = $row['cantidad'];
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../styles/home_admin.css">
    <link rel="stylesheet" href="./home_section/styles/menuA.css">
    <link rel="stylesheet" href="./home_section/styles/modeladdVehicle.css">

</head>

<body>
    <?php include './home_section/scripts/menu.php' ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Contenido principal -->
            <div class="col-md-12 p-4">
                <!-- Título principal del dashboard -->
                <h2 class="mb-4">Dashboard de Estadísticas</h2>

                <!-- Contenedor para los gráficos -->
                <div class="row">
                    <!-- Gráfico de barras -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title text-center">Gráfico de Cantidad de Registros</h4>
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Gráfico de líneas -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title text-center">Gráfico de Alquileres</h4>
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Gráfico circular -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title text-center">Gráfico Circular de Estado de Vehículos</h4>
                                <canvas id="pieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div> <!-- Fin de la fila de gráficos -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Gráfico de barras: Cantidad de usuarios, vehículos y alquileres
        var ctxBar = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Usuarios', 'Vehículos', 'Alquileres'],
                datasets: [{
                    label: 'Cantidad',
                    data: [<?php echo $numUsuarios; ?>, <?php echo $numVehiculos; ?>, <?php echo $numAlquileres; ?>],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                    borderColor: ['#0056b3', '#218838', '#e0a800'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pasar los datos de PHP a JavaScript
        var alquileresPorMes = <?php echo json_encode($alquileres_por_mes); ?>;

        // Gráfico de líneas: Datos de alquileres por mes
        var ctxLine = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                datasets: [{
                    label: 'Alquileres',
                    data: alquileresPorMes, // Datos obtenidos desde PHP
                    borderColor: '#007bff',
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pasar los datos de PHP a JavaScript
        var estadoVehiculos = <?php echo json_encode($estado_vehiculos); ?>;

        // Gráfico circular: Estado de los vehículos
        var ctxPie = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Excelente', 'Bueno', 'Regular', 'Malo'],
                datasets: [{
                    label: 'Estado de Vehículos',
                    data: [
                        estadoVehiculos['Excelente'],
                        estadoVehiculos['Bueno'],
                        estadoVehiculos['Regular'],
                        estadoVehiculos['Malo']
                    ], // Datos obtenidos desde PHP
                    backgroundColor: ['#28a745', '#ffc107', '#ff5733', '#dc3545'],
                    borderColor: ['#218838', '#e0a800', '#e02a00', '#b82b2b'],
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

