$('#formAddVehicle').submit(function(e) {
    e.preventDefault(); 

    var formData = new FormData(this); 

    $.ajax({
        url: './home_section/scripts/addVehicle.php', 
        type: 'POST',
        data: formData,
        contentType: false, 
        processData: false, 
        success: function(response) {
            try {
                var data = JSON.parse(response); 
                
                if (data.success) {
                    
                    var modal = bootstrap.Modal.getInstance(document.getElementById('addVehicleModal'));
                    modal.hide();

                    
                    var nuevaFila = `<tr id="vehicle-${data.id}">
                        <td class="marca">${data.marca}</td>
                        <td class="modelo">${data.modelo}</td>
                        <td class="matricula">${data.matricula}</td>
                        <td class="tarifa">${data.tarifa}</td>
                        <td class="estado">${data.estado}</td>
                        <td class="color">${data.color}</td>
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
                                >
                                Editar
                            </button>
                            <button class="btn btn-danger btn-sm eliminar" data-id="${data.id}">Eliminar</button>
                        </td>
                    </tr>`;

                    $('#tablaVehiculos').append(nuevaFila); 

                    
                    $('#alertaVehicle').removeClass('d-none alert-danger').addClass('alert-success').text('Vehículo agregado correctamente.');
                } else {
                    
                    $('#alertaVehicle').removeClass('d-none alert-success').addClass('alert-danger').text(data.message);
                }
            } catch (e) {                
                $('#alertaVehicle').removeClass('d-none alert-success').addClass('alert-danger').text('Error al procesar la respuesta del servidor.');
            }
        },
        error: function(xhr, status, error) {
            $('#alertaVehicle').removeClass('d-none alert-success').addClass('alert-danger').text('Error de conexión.');
        }
    });
});
