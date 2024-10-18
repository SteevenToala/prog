$('#formAddUser').submit(function(e) {
    e.preventDefault(); // Prevenir la recarga de la página

    var formData = $(this).serialize(); // Serializar los datos del formulario

    $.ajax({
        url: './home_section/scripts/addUser.php',  // Ruta del archivo PHP que procesa la adición de usuarios
        type: 'POST',
        data: formData,
        success: function(response) {
            var data = JSON.parse(response);
            
            if (data.success) {
                // Cerrar el modal
                var modal = bootstrap.Modal.getInstance(document.getElementById('addUserModal'));
                modal.hide();

                // Añadir la nueva fila a la tabla de usuarios
                var nuevaFila = `<tr id="usuario-${data.id}">
                    <td class="nombre">${data.nombre}</td>
                    <td>${data.email}</td>
                    <td>${data.tipo_usuario}</td>
                    <td>${data.fecha_registro}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editModal" 
                            data-id="${data.id}" 
                            data-nombre="${data.nombre}">
                            Editar
                        </button>
                        <button class="btn btn-danger btn-sm eliminar" data-id="${data.id}">Eliminar</button>
                    </td>
                </tr>`;
                
                $('#tablaUsuarios').append(nuevaFila);

                // Mostrar mensaje de éxito
                $('#alerta2').removeClass('d-none alert-danger').addClass('alert-success').text('Usuario agregado correctamente.');
            } else {
                // Mostrar el mensaje de error del servidor
                $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text(data.message);
            }
        },
        error: function(xhr, status, error) {
            $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text('Error de conexión.');
        }
    });
});
