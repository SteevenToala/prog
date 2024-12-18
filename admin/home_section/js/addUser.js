const modalConfirmation = new bootstrap.Modal(document.getElementById('cmodalCaddUser'));
$('#formAddUser').submit(function(e) {
    e.preventDefault(); 

    var formData = $(this).serialize(); 
    if($('#password').val()==$('#passwordC').val()){
        $.ajax({
            type: 'POST',
            url: '../util/verificarCorreoExiste.php',
            data: { email: $('#email').val() },
            dataType: 'json',
            success: function (response) {
              if (response.success) {
                $('#alerta').removeClass('alert-danger').addClass('alert-success').text(response.message).show();
                modalConfirmation.show();
                $.ajax({
        url: './home_section/scripts/addUser.php',  
        type: 'POST',
        data: formData,
        success: function(response) {
            var data = JSON.parse(response);
            
            if (data.success) {
                // Cerrar el modal
                var modal = bootstrap.Modal.getInstance(document.getElementById('addUserModal'));
                modal.hide();

                
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

                
                $('#alerta2').removeClass('d-none alert-danger').addClass('alert-success').text('Usuario agregado correctamente.');
            } else {
                
                $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text(data.message);
            }
        },
        error: function(xhr, status, error) {
                $('#alerta').removeClass('alert-success').addClass('alert-danger').text('Error de conexión.').show();
        }
                });
            } else {
                $('#alerta').removeClass('alert-success').addClass('alert-danger').text(response.message).show();            
              }
            },
            error: function (xhr, status, error) {
    
              console.error("Error del servidor:", xhr.responseText);
              $('#alerta').text('Ocurrió un error en el servidor: ' + xhr.responseText).show();
            }
          });
    }
    else{
        $('#alerta').removeClass('alert-success').addClass('alert-danger').text('Las contrasenas no coinciden').show();
    }
});
