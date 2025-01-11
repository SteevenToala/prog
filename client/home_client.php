<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'cliente') {
    header("Location: ../pages/iniciarSesion.php");
    exit();
}
$usuario_id = $_SESSION['usuario_id'];

include '../util/conexion.php';

// Consultar valores únicos para los filtros
$sqlMarcas = "SELECT DISTINCT marca FROM vehiculos WHERE disponibilidad = 'Disponible'";
$sqlCombustible = "SELECT DISTINCT tipo_combustible FROM vehiculos";
$sqlVehiculos = "SELECT id, marca, modelo, matricula, disponibilidad, tarifa, estado, color, imagen, tipo_combustible, tipo_vehiculo, tipo_transmision 
                 FROM vehiculos 
                 WHERE disponibilidad = 'Disponible'";
$sqlTipoVehiculo = "SELECT DISTINCT tipo_vehiculo FROM vehiculos";
$sqlTransmision = "SELECT DISTINCT tipo_transmision FROM vehiculos";

// Ejecutar las consultas
$resultMarcas = mysqli_query($conn, $sqlMarcas);
$resultCombustible = mysqli_query($conn, $sqlCombustible);
$resultTipoVehiculo = mysqli_query($conn, $sqlTipoVehiculo);
$resultTransmision = mysqli_query($conn, $sqlTransmision);
$resultVehiculos = mysqli_query($conn, $sqlVehiculos);

// Guardar valores únicos en arreglos
$marcas = [];
$combustibles = [];
$tiposVehiculo = [];
$tiposTransmision = [];

if ($resultMarcas->num_rows > 0) {
    while ($row = mysqli_fetch_array($resultMarcas)) {
        $marcas[] = $row['marca'];
    }
}

if ($resultCombustible->num_rows > 0) {
    while ($row = mysqli_fetch_array($resultCombustible)) {
        $combustibles[] = $row['tipo_combustible'];
    }
}

if ($resultTipoVehiculo->num_rows > 0) {
    while ($row = mysqli_fetch_array($resultTipoVehiculo)) {
        $tiposVehiculo[] = $row['tipo_vehiculo'];
    }
}

if ($resultTransmision->num_rows > 0) {
    while ($row = mysqli_fetch_array($resultTransmision)) {
        $tiposTransmision[] = $row['tipo_transmision'];
    }
}

// Guardar datos de los vehículos
$data = [];
if ($resultVehiculos->num_rows > 0) {
    while ($row = mysqli_fetch_array($resultVehiculos)) {
        $data[] = array(
            'id' => $row['id'],
            'marca' => $row['marca'],
            'modelo' => $row['modelo'],
            'matricula' => $row['matricula'],
            'disponibilidad' => $row['disponibilidad'],
            'tarifa' => $row['tarifa'],
            'estado' => $row['estado'],
            'color' => $row['color'],
            'imagen' => $row['imagen'],
            'tipo_combustible' => $row['tipo_combustible'],
            'tipo_vehiculo' => $row['tipo_vehiculo'],
            'tipo_transmision' => $row['tipo_transmision']
        );
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Vehículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/menu.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="../styles/background.css">
    <link rel="stylesheet" href="./css/catalogo.css">
    <style>
        #vehicleInfo img {
  border-radius: 8px;
  border: 1px solid #ddd;
}

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include './util/menu.php';
            include './modals/modal_addRev.php';
            ?>

            <div class="col-md-3">
                <!-- Barra lateral de filtros -->
                <div class="p-3 border rounded shadow-sm bg-light" id="filterSidebar">
                    <h4 class="text-center mb-3">Filtros</h4>
                    <form id="filterForm">
                        <div class="mb-3">
                            <label for="filterMarca" class="form-label">Marca</label>
                            <select id="filterMarca" class="form-select">
                                <option value="">Todas</option>
                                <?php foreach ($marcas as $marca): ?>
                                    <option value="<?= strtolower($marca) ?>"><?= $marca ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="filterPrecio" class="form-label">Rango de precios</label>
                            <select id="filterPrecio" class="form-select">
                                <option value="">Todos</option>
                                <option value="0-50">$0 - $50 / día</option>
                                <option value="51-100">$51 - $100 / día</option>
                                <option value="101-150">$101 - $150 / día</option>
                                <option value="151-200">$151 - $200 / día</option>
                                <option value="201-9999">Más de $200 / día</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="filterCombustible" class="form-label">Tipo de Combustible</label>
                            <select id="filterCombustible" class="form-select">
                                <option value="">Todos</option>
                                <?php foreach ($combustibles as $combustible): ?>
                                    <option value="<?= strtolower($combustible) ?>"><?= $combustible ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="filterTipoVehiculo" class="form-label">Tipo de Vehículo</label>
                            <select id="filterTipoVehiculo" class="form-select">
                                <option value="">Todos</option>
                                <?php foreach ($tiposVehiculo as $tipo): ?>
                                    <option value="<?= strtolower($tipo) ?>"><?= $tipo ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="filterTransmision" class="form-label">Tipo de Transmisión</label>
                            <select id="filterTransmision" class="form-select">
                                <option value="">Todos</option>
                                <?php foreach ($tiposTransmision as $transmision): ?>
                                    <option value="<?= strtolower($transmision) ?>"><?= $transmision ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="reset" class="btn btn-secondary w-100">Limpiar filtros</button>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="container my-5">
                    <h1 class="text-center mb-4">Catálogo de Vehículos</h1>
                    <!-- Contenedor de resultados -->
                    <div class="row g-4" id="vehicleCatalog">
                        <?php if ($data): ?>
                            <?php foreach ($data as $vehiculo): ?>
                                <div class="col-md-4 vehicle-card"
                                    data-marca="<?= strtolower($vehiculo['marca']) ?>"
                                    data-tarifa="<?= $vehiculo['tarifa'] ?>"
                                    data-combustible="<?= strtolower($vehiculo['tipo_combustible']) ?>"
                                    data-tipo="<?= strtolower($vehiculo['tipo_vehiculo']) ?>"
                                    data-transmision="<?= strtolower($vehiculo['tipo_transmision']) ?>">
                                    <div class="card h-100">
                                        <img src="../images/autos/<?= $vehiculo['imagen'] ?>" class="card-img-top" alt="<?= $vehiculo['marca'] ?> <?= $vehiculo['modelo'] ?>">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title"><?= $vehiculo['marca'] ?> <?= $vehiculo['modelo'] ?></h5>
                                            <p class="card-text">
                                                Matrícula: <span class="text-muted"><?= $vehiculo['matricula'] ?></span><br>
                                                Disponibilidad: <span class="text-muted"><?= $vehiculo['disponibilidad'] ?></span><br>
                                                Tarifa: <span class="text-muted">$<?= number_format($vehiculo['tarifa'], 2) ?> / día</span><br>
                                                Estado: <span class="text-muted"><?= $vehiculo['estado'] ?></span><br>
                                                Combustible: <span class="text-muted"><?= $vehiculo['tipo_combustible'] ?></span><br>
                                                Tipo: <span class="text-muted"><?= $vehiculo['tipo_vehiculo'] ?></span><br>
                                                Transmisión: <span class="text-muted"><?= $vehiculo['tipo_transmision'] ?></span>
                                            </p>
                                            <div class="mt-auto d-grid">
                                                <button class="btn btn-primary btn-sm editar"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#addRevModal"
                                                    data-idV="<?php echo $vehiculo['id']; ?>"
                                                    data-idU="<?php echo $usuario_id; ?>"
                                                    >
                                                    Reservar
                                                </button>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center">No se encontraron vehículos.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="./js/addReservations.js"></script>
    <script>
        const form = document.getElementById('filterForm');
        const vehicleCards = document.querySelectorAll('.vehicle-card');

        // Lógica de filtrado
        const applyFilters = () => {
            const marca = document.getElementById('filterMarca').value.toLowerCase();
            const precio = document.getElementById('filterPrecio').value;
            const combustible = document.getElementById('filterCombustible').value.toLowerCase();
            const tipoVehiculo = document.getElementById('filterTipoVehiculo').value.toLowerCase();
            const transmision = document.getElementById('filterTransmision').value.toLowerCase();

            vehicleCards.forEach(card => {
                const cardMarca = card.getAttribute('data-marca');
                const cardTarifa = parseFloat(card.getAttribute('data-tarifa'));
                const cardCombustible = card.getAttribute('data-combustible');
                const cardTipo = card.getAttribute('data-tipo');
                const cardTransmision = card.getAttribute('data-transmision');

                let matchesPrecio = true;
                if (precio) {
                    const [min, max] = precio.split('-').map(Number);
                    matchesPrecio = cardTarifa >= min && cardTarifa <= max;
                }

                const matches = (
                    (marca === '' || cardMarca === marca) &&
                    matchesPrecio &&
                    (combustible === '' || cardCombustible === combustible) &&
                    (tipoVehiculo === '' || cardTipo === tipoVehiculo) &&
                    (transmision === '' || cardTransmision === transmision)
                );

                card.style.display = matches ? '' : 'none';
            });
        };

        // Evento de entrada para filtros
        form.addEventListener('input', applyFilters);

        // Evento para limpiar filtros
        form.addEventListener('reset', () => {
            setTimeout(applyFilters, 0); // Llamar a applyFilters después de restablecer los valores del formulario
        });
    </script>

<script>
  // Inicializar Flatpickr para el campo de fecha y hora de inicio
  flatpickr("#fecha_inicio", {
    enableTime: true,   // Habilitar la selección de hora
    time_24hr: true,    // Formato de 24 horas
    dateFormat: "Y-m-d H:i:S",  // Formato con fecha, hora, minutos y segundos
    minuteIncrement: 1, // Incremento de 1 minuto
    secondIncrement: 1, // Incremento de 1 segundo
    onChange: function(selectedDates, dateStr, instance) {
      // Cuando se cambia la fecha de inicio, actualizar la fecha de fin
      if (selectedDates[0]) {
        const inicioDate = selectedDates[0];
        // Establecer el mínimo permitido en fecha de fin (con precisión de horas, minutos y segundos)
        const minDate = inicioDate.toLocaleString('sv-SE');  // Utiliza el formato local
        document.getElementById('fecha_fin')._flatpickr.set('minDate', minDate);

        // Validar la diferencia de tiempo (debe ser al menos 1 minuto)
        const fechaFin = document.getElementById('fecha_fin')._flatpickr.selectedDates[0];
        if (fechaFin && (fechaFin - inicioDate) < 60000) {  // 60000 ms = 1 minuto
          // Mostrar el modal de error
          var myModal = new bootstrap.Modal(document.getElementById('modalError'));
          myModal.show();
          document.getElementById('fecha_fin')._flatpickr.clear();
        }
      }
    }
  });

  // Inicializar Flatpickr para el campo de fecha y hora de fin
  flatpickr("#fecha_fin", {
    enableTime: true,   // Habilitar la selección de hora
    time_24hr: true,    // Formato de 24 horas
    dateFormat: "Y-m-d H:i:S",  // Formato con fecha, hora, minutos y segundos
    minuteIncrement: 1, // Incremento de 1 minuto
    secondIncrement: 1, // Incremento de 1 segundo
    onChange: function(selectedDates, dateStr, instance) {
      // Cuando se cambia la fecha de fin, actualizar la fecha de inicio
      if (selectedDates[0]) {
        const finDate = selectedDates[0];
        // Establecer el máximo permitido en fecha de inicio (con precisión de horas, minutos y segundos)
        const maxDate = finDate.toISOString().slice(0, 19);
        document.getElementById('fecha_inicio')._flatpickr.set('maxDate', maxDate);

        // Validar la diferencia de tiempo (debe ser al menos 1 minuto)
        const fechaInicio = document.getElementById('fecha_inicio')._flatpickr.selectedDates[0];
        if (fechaInicio && (finDate - fechaInicio) < 60000) {  // 60000 ms = 1 minuto
          // Mostrar el modal de error
          var myModal = new bootstrap.Modal(document.getElementById('modalError'));
          myModal.show();
          document.getElementById('fecha_inicio')._flatpickr.clear();
        }
      }
    }
  });
</script>
</body>

</html>