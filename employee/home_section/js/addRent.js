$('#formAddRent').submit(function(e){
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
        url: './home_section/scripts/addrent.php',
        type: 'POST',
        data: formData,
        success: function(response){
            var data = JSON.parse(response);

            if(data.success){
                var modal = bootstrap.Modal.getInstance(document.getElementById('addRentModal'));
                modal.hide();

                var nuevaFila = `<tr>
                    <td class="nombre">${data.fecha_inicio}</td>
                    <td>${data.id_usuario}</td>
                    <td>${data.id_vehiculo}</td>                    
                    <td>
                        <button class="btn btn-warning btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editModal" 
                            data-id="${data.id}" 
                            >
                            Editar
                        </button>
                        <button class="btn btn-danger btn-sm eliminar" data-id="${data.id}">Eliminar</button>
                    </td>
                </tr>`;

                $('#tablaRents').append(nuevaFila);

                $('#alerta2').removeClass('d-none alert-danger').addClass('alert-success').text('Usuario agregado correctamente.');
            }else{

                $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text(data.message);
            }

        },
        error: function(xhr,status,error){
            $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text('Error de conexion');
        }
    });

});