$('#formAddRent').submit(function (e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
        url: './home_section/scripts/addrent.php',
        type: 'POST',
        data: formData,
        success: function (response) {
            var data = JSON.parse(response);

            if (data.success) {
                var modal = bootstrap.Modal.getInstance(document.getElementById('addRentModal'));
                modal.hide();

                var nuevaFila = `<tr>
                    <td class="nombre">${data.fecha_inicio}</td>
                    <td></td>
                    <td>Activo</td>                                                            
                    <td>${data.nombre}</td>  
                    <td>${data.matricula}</td>
                    <td>${data.marca}</td>                    
                    <td>${data.modelo}</td>
                    <th>
                                    <button class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#contratoModal"
                                        data-id="${data.id}"
                                        data-fechaInicio="${data.fecha_inicio}"
                                        data-nombreUsuario="${data.nombre}"
                                        data-matricula="${data.matricula}">
                                        Ver Contrato
                                    </button>
                    </th>                                                         
                    <th>
                                <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModalRent"
                                    data-id="${data.id}"
                                    data-fechaInicio="${data.fecha_inicio}"
                                    data-nombreUsuario="${data.nombre}"
                                    data-matricula="${data.matricula}">
                                    Editar
                                </button>
                    </th>
                    <th><button class="btn btn-danger btn-sm eliminar" data-id="${data.id}">Eliminar</button></th>
                </tr>`;

                $('#tablaRents').append(nuevaFila);

                $('#alerta2').removeClass('d-none alert-danger').addClass('alert-success').text('Alquiler agregado correctamente.');
                var rentEliminar = document.getElementById('aV' + `${data.id_vehiculo}`);
                if (rentEliminar) {
                    rentEliminar.remove();
                    console.log(`Elemento con ID "aV${data.id_vehiculo}" eliminado.`);
                } else {
                    console.error(`No se encontró un elemento con ID "aV${data.id_vehiculo}".`);
                }
            } else {

                $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text(data.message);
            }

        },
        error: function (xhr, status, error) {
            $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text('Error de conexion');
        }
    });

});