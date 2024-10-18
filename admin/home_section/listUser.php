<?php include '../util/conexion.php';
$sql = "SELECT id, nombre, fecha_registro,email,tipo_usuario FROM usuarios";
$result = mysqli_query($conn, $sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $data[] = array(
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'email' => $row['email'],
            'tipo_usuario' => $row['tipo_usuario'],
            'fecha_registro'=> $row['fecha_registro']
        );
    }
} else {
    echo "no existen elementos";
}

$conn->close();
?>

<div id="listUsers" class="content-section active">
    <h2>Listar Usuarios</h2>
    <div id="alerta2" class="alert d-none" role="alert"></div>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre de Usuario</th>
                <th>Email</th>
                <th>Tipo de Usuario</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>                
            </tr>
        </thead>
        <tbody id="tablaUsuarios">
            <?php foreach ($data as $usuario) : ?>
                <tr id="usuario-<?php echo $usuario['id']; ?>">
                    <td class="nombre"><?php echo htmlspecialchars($usuario['nombre'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td><?php echo $usuario['tipo_usuario']; ?></td>
                    <td><?php echo $usuario['fecha_registro']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editModal" 
                            data-id="<?php echo $usuario['id']; ?>" 
                            data-nombre="<?php echo htmlspecialchars($usuario['nombre'], ENT_QUOTES, 'UTF-8'); ?>">
                            Editar
                        </button>
                        <button class="btn btn-danger btn-sm eliminar" data-id="<?php echo $usuario['id']; ?>">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Botón para abrir el modal de agregar usuario, centrado -->
    <div class="text-center mt-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Agregar Usuario</button>
    </div>
</div>

<!-- Modal para agregar usuario -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Agregar Nuevo Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formAddUser">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3">
            <label for="tipo_usuario" class="form-label">Tipo de Usuario</label>
            <select id="tipo_usuario" name="tipo_usuario" class="form-select" required>
              <option value="administrador">Administrador</option>
              <option value="empleado">Empleado</option>
              <option value="cliente">Cliente</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Agregar Usuario</button>
        </form>
      </div>
    </div>
  </div>
</div>