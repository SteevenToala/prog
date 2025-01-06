<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'empleado') {
    header("Location: ../pages/iniciarSesion.php");
    exit();
}
include '../util/conexion.php';
$sql = "SELECT alquileres.id, alquileres.fecha_inicio, alquileres.fecha_fin, alquileres.estado, usuarios.nombre AS nombre_usuario,vehiculos.id AS vehiculo_id, vehiculos.matricula, vehiculos.marca, vehiculos.modelo, vehiculos.imagen
            FROM alquileres
            JOIN usuarios ON alquileres.usuario_id = usuarios.id
            JOIN vehiculos ON alquileres.vehiculo_id = vehiculos.id";
$result = mysqli_query($conn, $sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $data[] = array(
            'id' => $row['id'],
            'fecha_inicio' => $row['fecha_inicio'],
            'fecha_fin' => $row['fecha_fin'],
            'matricula' => $row['matricula'],
            'marca' => $row['marca'],
            'modelo' => $row['modelo'],
            'imagen' => $row['imagen'],
            'vehiculo_id' => $row['vehiculo_id'],
            'nombre_usuario' => $row['nombre_usuario'],
            'estado' => $row['estado']
        );
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/footer.css">


    <link rel="stylesheet" href="../styles/home_admin.css">
    <style>
        .xd {
            display: flex;
            width: 90%;
            height: 90%;
            background-color: aliceblue;
            border-radius: 20px;
            padding: 10px;
            overflow-x: scroll;
        }
    </style>
</head>

<body>
    <?php
    include './home_section/modals/contrato.html';
    include './home_section/modals/modal_addRent.php';
    include './home_section/modals/modal_editRent.php';
    include './home_section/modals/modal_EditarFechaF.html';

    ?>

    <div class="container-fluid vh-100 d-flex flex-column overflow-hidden">
        <div class="row flex-grow-1 ">
            <?php
            include './home_section/scripts/menu.php'
            ?>
            <main class="col-12 mx-auto px-4 main-content d-flex flex-column h-100">
                <h1 class="tittle-p">Gestion de alquileres</h1>
                <div id="alerta2" class="alert d-none" role="alert"></div>
                <table class="table table-striped mt-4">
                    <thead class="table-dark">
                        <th>Imagen</th>
                        <th>Matricula</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>
                        <th>Cliente</th>                        
                        <th>Contrato</th>
                        <th>Acciones</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody id="tablaRents">
                        <?php foreach ($data as $rent): ?>
                            <tr id="rent-<?php echo $rent['id'] ?>">
                                <th>
                                    <img src="../images/autos/<?php echo htmlspecialchars($rent['imagen'], ENT_QUOTES, 'UTF-8'); ?>"
                                        alt="Imagen de <?php echo $rent['modelo']; ?>"
                                        style="width: 100px; height: auto; border-radius: 5px;">
                                </th>
                                <th class="matricula"><?php echo $rent['matricula'] ?></th>
                                <th class="marca"><?php echo $rent['marca'] ?></th>
                                <th class="modelo"><?php echo $rent['modelo'] ?></th>
                                <th><?php echo $rent['fecha_inicio'] ?></th>
                                <th class="fecha_fin"><?php echo $rent['fecha_fin'] ?></th>
                                <th><?php echo $rent['estado'] ?></th>
                                <th class="nombre"><?php echo $rent['nombre_usuario'] ?></th>
                                

                                <th>
                                    <button class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#contratoModal"
                                        data-id="<?php echo $rent['id']; ?>"
                                        data-fechaInicio="<?php echo $rent['fecha_inicio']; ?>"
                                        data-fechaInicio="<?php echo $rent['fecha_fin']; ?>"
                                        data-nombreUsuario="<?php echo $rent['nombre_usuario']; ?>"
                                        data-matricula="<?php echo htmlspecialchars($rent['matricula'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-vehiculoid="<?php echo htmlspecialchars($rent['vehiculo_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                        Ver Contrato
                                    </button>
                                </th>
                                <th>
                                    <button class="btn btn-warning btn-sm editar"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModalRent"
                                        data-id="<?php echo $rent['id']; ?>"
                                        data-fechaInicio="<?php echo $rent['fecha_inicio']; ?>"
                                        data-fechaInicio="<?php echo $rent['fecha_fin']; ?>"
                                        data-nombreUsuario="<?php echo $rent['nombre_usuario']; ?>"
                                        data-vehiculoid="<?php echo htmlspecialchars($rent['vehiculo_id'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-matricula="<?php echo htmlspecialchars($rent['matricula'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-marca="<?php echo htmlspecialchars($rent['marca'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-modelo="<?php echo htmlspecialchars($rent['modelo'], ENT_QUOTES, 'UTF-8'); ?>">
                                        Editar
                                    </button>
                                </th>
                                <th>
                                    <button class="btn btn-warning btn-sm editar"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editFechaF"
                                        data-id="<?php echo $rent['id']; ?>"
                                        data-fechaInicio="<?php echo $rent['fecha_inicio']; ?>"
                                        data-fechaInicio="<?php echo $rent['fecha_fin']; ?>"
                                        data-nombreUsuario="<?php echo $rent['nombre_usuario']; ?>"
                                        data-vehiculoid="<?php echo htmlspecialchars($rent['vehiculo_id'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-matricula="<?php echo htmlspecialchars($rent['matricula'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-marca="<?php echo htmlspecialchars($rent['marca'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-modelo="<?php echo htmlspecialchars($rent['modelo'], ENT_QUOTES, 'UTF-8'); ?>">
                                        Editar fecha fin
                                    </button>
                                </th>
                                <th><button class="btn btn-danger btn-sm eliminar" data-id="<?php echo $rent['id']; ?>">Eliminar</button></th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="text-center mt-3">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRentModal">Agregar Alquiler</button>
                </div>
            </main>
        </div>
    </div>
    <?php include '../util/footer.html'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./home_section/js/addRent.js"></script>
    <script src="./home_section/js/editRent.js"></script>
    <script src="./home_section/js/removeRent.js"></script>
    <script src="./home_section/js/contrato.js"></script>
    <script src="./home_section/js/editFechaFin.js"></script>
    <script>
 document.addEventListener("DOMContentLoaded", function () {
  const camposFecha = document.querySelectorAll(".fecha_fin");

  // Obtener la fecha actual
  const hoy = new Date();
  hoy.setDate(hoy.getDate()); // Fecha mínima es hoy
  const fechaMinima = hoy.toISOString().split("T")[0];

  // Establecer el atributo min para todos los campos
  camposFecha.forEach((campo) => {
    campo.setAttribute("min", fechaMinima);

    // Validar en el evento de cambio
    campo.addEventListener("change", function () {
      const fechaSeleccionada = new Date(campo.value);
      if (fechaSeleccionada <= hoy) {
        alert("Por favor, selecciona una fecha mayor a hoy.");
        campo.value = ""; // Limpiar el campo
      }
    });
  });
});

</script>




<script>
// Filtrado de vehículos
document.getElementById('searchVehicle').addEventListener('input', filterVehicles);

function filterVehicles() {
  const query = document.getElementById('searchVehicle').value.toLowerCase().trim(); // Texto buscado
  const vehicles = document.querySelectorAll('.vehicle-item'); // Todos los vehículos
  let visibleVehicles = 0;

  vehicles.forEach(vehicle => {
    const marca = vehicle.dataset.marca.toLowerCase();
    const modelo = vehicle.dataset.modelo.toLowerCase();
    const matricula = vehicle.dataset.matricula.toLowerCase();

    // Mostrar solo los vehículos que coinciden con la búsqueda
    if (marca.includes(query) || modelo.includes(query) || matricula.includes(query)) {
      vehicle.style.display = ''; // Mostrar el vehículo
      visibleVehicles++;
    } else {
      vehicle.style.display = 'none'; // Ocultar el vehículo
    }
  });

  // Mensaje cuando no hay resultados
  const listContainer = document.getElementById('vehicleList');
  const noResultsMessage = document.getElementById('noResultsMessage');

  if (visibleVehicles === 0) {
    if (!noResultsMessage) {
      const message = document.createElement('li');
      message.id = 'noResultsMessage';
      message.className = 'list-group-item text-center text-muted';
      message.textContent = 'No se encontraron vehículos';
      listContainer.appendChild(message);
    }
  } else if (noResultsMessage) {
    noResultsMessage.remove();
  }
}

// Selección de vehículo
function selectVehicle(vehicleId, marca, modelo, matricula) {
  const matriculaInput = document.getElementById('matricula_vehiculo');
  const selectedVehicleText = document.getElementById('selectedVehicle');
  const submitButton = document.getElementById('submitRentButton');

  if (!matriculaInput || !selectedVehicleText || !submitButton) {
    console.error('No se encontraron elementos del formulario.');
    return;
  }

  matriculaInput.value = vehicleId; // Asignar el ID del vehículo
  selectedVehicleText.textContent = `Vehículo seleccionado: ${marca} - ${modelo} (Matrícula: ${matricula})`;
  submitButton.disabled = false; // Habilitar el botón de envío
}

// Buscar vehículos a través de un API
document.getElementById('searchVehicle').addEventListener('input', function () {
  const query = this.value.trim();

  fetch(`buscarVehiculos.php?query=${encodeURIComponent(query)}`)
  .then(response => response.json())
  .then(data => {
    const listContainer = document.getElementById('vehicleList');
    listContainer.innerHTML = ''; // Limpiar la lista existente

    data.forEach(vehicle => {
      const vehicleItem = document.createElement('li');
      vehicleItem.className = 'list-group-item d-flex align-items-center vehicle-item';
      vehicleItem.setAttribute('data-id', vehicle.id || '');
      vehicleItem.setAttribute('data-marca', (vehicle.marca || '').toLowerCase());
      vehicleItem.setAttribute('data-modelo', (vehicle.modelo || '').toLowerCase());
      vehicleItem.setAttribute('data-matricula', (vehicle.matricula || '').toLowerCase());
      vehicleItem.onclick = () => {
        if (vehicle.id && vehicle.marca && vehicle.modelo && vehicle.matricula) {
          selectVehicle(vehicle.id, vehicle.marca, vehicle.modelo, vehicle.matricula);
        } else {
          console.error('Datos del vehículo incompletos:', vehicle);
        }
      };

      vehicleItem.innerHTML = `
        <img src="../images/autos/${vehicle.imagen || 'placeholder.jpg'}" alt="Imagen de ${vehicle.marca || 'N/A'}" class="me-3" style="width: 50px; height: 50px; object-fit: cover;">
        <div>
          <strong>${vehicle.marca || 'Sin Marca'} - ${vehicle.modelo || 'Sin Modelo'}</strong><br>
          <small>Matrícula: ${vehicle.matricula || 'Sin Matrícula'}</small>
        </div>
      `;

      listContainer.appendChild(vehicleItem);
    });
  })
  .catch(error => console.error('Error fetching vehicles:', error));
});
</script>



</body>

</html>