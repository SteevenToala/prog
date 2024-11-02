$('#formAddVehicle').submit(function(e) {
    e.preventDefault(); // Prevenir la recarga de la página

    var formData = $(this).serialize(); // Serializar los datos del formulario

    $.ajax({
        url: './home_section/scripts/addVehicle.php',  // Ruta del archivo PHP que procesa la adición de usuarios
        type: 'POST',
        data: formData,
        success: function(response) {
            var data = JSON.parse(response);
            
            if (data.success) {
                // Cerrar el modal
                var modal = bootstrap.Modal.getInstance(document.getElementById('addVehicleModal'));
                modal.hide();

                // Añadir la nueva fila a la tabla de usuarios
                var nuevaFila = `<tr id="vehicle-${data.id}">
                    <td class="marca">${data.marca}</td>
                    <td class="modelo">${data.modelo}</td>
                    <td class="matricula">${data.matricula}</td>
                    <td class="tarifa">${data.tarifa}</td>
                    <td class="estado">${data.estado}</td>
                    <td class="color">${data.color}</td>
                    <td class="tipo">${data.tipo}</td>
                    <td class="disponibilidad">${data.disponibilidad}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editModalVehicle" 
                            data-id="${data.id}" 
                            data-editMarca="${data.marca}"
                            data-editModelo="${data.modelo}"
                            data-editMatricula="${data.matricula}"
                            data-editTarifa="${data.tarifa}"
                            data-editEstado="${data.estado}"
                            data-editColor="${data.color}"
                            data-editTipo="${data.tipo}"
                            >
                            Editar
                        </button>
                        <button class="btn btn-danger btn-sm eliminar" data-id="${data.id}">Eliminar</button>
                    </td>
                </tr>`;
                
                $('#tablaUsuarios').append(nuevaFila);

                // Mostrar mensaje de éxito
                $('#alertaVehicle').removeClass('d-none alert-danger').addClass('alert-success').text('Usuario agregado correctamente.');
            } else {
                // Mostrar el mensaje de error del servidor
                $('#alertaVehicle').removeClass('d-none alert-success').addClass('alert-danger').text(data.message);
            }
        },
        error: function(xhr, status, error) {
            $('#alertaVehicle').removeClass('d-none alert-success').addClass('alert-danger').text('Error de conexión.');
        }
    });
});
