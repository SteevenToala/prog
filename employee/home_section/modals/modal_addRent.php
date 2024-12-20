<?php
include '../util/conexion.php';
$sql = "SELECT nombre,id FROM usuarios";
$result = mysqli_query($conn, $sql);

$dataUsers = array();
if ($result->num_rows > 0) {
  while ($row = mysqli_fetch_array($result)) {
    $dataUsers[] = array(
      'nombre' => $row['nombre'],
      'id' => $row['id']
    );
  }
} else {
  echo "no existen elementos";
}


$sqlv = "SELECT marca,modelo,matricula, id FROM vehiculos WHERE disponibilidad = 'Disponible'";
$resultv = mysqli_query($conn, $sqlv);

$datavehicles = array();
if ($resultv->num_rows > 0) {
  while ($row = mysqli_fetch_array($resultv)) {
    $datavehicles[] = array(
      'marca' => $row['marca'],
      'matricula' => $row['matricula'],
      'modelo' => $row['modelo'],
      'id' => $row['id']
    );
  }
} else {
  echo "";
}


?>
<div class="modal fade" id="addRentModal" tabindex="-1" aria-labelledby="addRentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addRentModalLabel">Agregar Nuevo Alquiler</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formAddRent">
          <!--<div class="mb-3">
              <label for="fecha_fin" class="form-label">Fecha Fin</label>
              <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
            </div>-->
            <div class="mb-3">
  <label for="fecha_fin_1" class="form-label">Fecha Fin</label>
  <input type="date" class="form-control fecha_fin" id="fecha_fin_1" name="fecha_fin_1" required>
</div>

          <div class="mb-3">
            <label for="matricula_vehiculo" class="form-label">Vehiculos disponibles(marca-modelo-matricula)</label>
            <select class="form-select" id="matricula_vehiculo" name="matricula_vehiculo" required>
              <?php foreach ($datavehicles as $vehicle): ?>
                <option id="aV<?php echo $vehicle['id']; ?>" value="<?php echo $vehicle['id']; ?>"><?php echo $vehicle['marca']; ?> - <?php echo $vehicle['modelo']; ?> - <?php echo $vehicle['matricula']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="nombre_usuario" class="form-label">Nombre Usuario</label>
            <select id="nombre_usuario" name="nombre_usuario" class="form-select" required>
              <?php foreach ($dataUsers as $user): ?>
                <option value="<?php echo $user['id']; ?>"><?php echo $user['nombre']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Agregar Alquiler</button>
        </form>
      </div>
    </div>
  </div>
</div>