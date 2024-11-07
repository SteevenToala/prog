<?php
include '../util/conexion.php';
$sql = "SELECT nombre FROM usuarios";
$result = mysqli_query($conn,$sql);

$dataUsers = array();
if($result->num_rows>0){
  while($row = mysqli_fetch_array($result)){
    $dataUsers[]=array(
      'nombre'=>$row['nombre']
    );
  }
}else{
  echo "no existen elementos";
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
            <div class="mb-3">
              <label for="fecha_fin" class="form-label">Fecha Fin</label>
              <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
            </div>            
            <div class="mb-3">
              <label for="matricula_vehiculo" class="form-label">Vehiculos disponibles(matricula)</label>
              <select class="form-select" id="matricula_vehiculo" name="matricula_vehiculo" required>
                <option value="administrador"></option>    
            </select>
            </div>
            <div class="mb-3">
              <label for="nombre_usuario" class="form-label">Nombre Usuario</label>
              <select id="nombre_usuario" name="nombre_usuario" class="form-select" required>
                <?php foreach($dataUsers as $user):?>                
                <option value="<?php echo $user['nombre'];?>"><?php echo $user['nombre'];?></option>                
                <?php endforeach;?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Alquiler</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  