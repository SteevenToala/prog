// Script para pasar datos al modal
var editModalVehicle = document.getElementById('editModalVehicle');
editModalVehicle.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Botón que activa el modal
    var vehicleId = button.getAttribute('data-id'); // Obtener el id del usuario
    var marca = button.getAttribute('data-editMarca'); // Obtener el nombre del usuario
    var modelo = button.getAttribute('data-editModelo');
    var matricula = button.getAttribute('data-editMatricula');
    var tarifa = button.getAttribute('data-editTarifa');
    var color = button.getAttribute('data-editColor');
    var estado = button.getAttribute('data-editEstado');

    // Asignar los valores a los campos del modal
    document.getElementById('editVehicleId').value = vehicleId;
    document.getElementById('editMarca').value = marca;
    document.getElementById('editModelo').value = modelo;
    document.getElementById('editMatricula').value = matricula;
    document.getElementById('editTarifa').value = tarifa;
    document.getElementById('editColor').value = color;
    document.getElementById('editEstado').value = estado;
});

// Limpiar el modal al cerrarse para evitar que queden valores antiguos
$('#editModalVehicle').on('hidden.bs.modal', function () {
    $('#editFormVehicle')[0].reset(); // Restablecer el formulario
});

// Enviar el formulario de edición mediante AJAX
// Enviar el formulario de edición mediante AJAX
$('#editFormVehicle').submit(function (e) {
    e.preventDefault(); // Prevenir que el formulario recargue la página

    var vehicleId = $('#editVehicleId').val();
    var marca = $('#editMarca').val();
    var modelo = $('#editModelo').val();
    var matricula = $('#editMatricula').val();
    var tarifa = parseFloat($('#editTarifa').val()); 
    var color = $('#editColor').val();
    var estado = $('#editEstado').val();

    if (isNaN(tarifa) || tarifa < 0) {
        alert('La tarifa debe ser un número válido y mayor o igual a cero.');
        return;
    }

    $.ajax({
        url: './home_section/scripts/editVehicle.php',
        type: 'POST',
        data: {
            id: vehicleId,
            marca: marca,
            modelo: modelo,
            matricula: matricula,
            tarifa: tarifa,
            color: color,
            estado: estado
        },
        success: function (response) {
            console.log('Respuesta del servidor:', response); // Depura la respuesta

            // Asegúrate de que 'response.trim()' limpie bien los espacios
            if (response.trim() === 'success') {
                // Actualizar la fila en la tabla sin recargar la página
                $('#vehicle-' + vehicleId + ' .marca').text(marca);
                $('#vehicle-' + vehicleId + ' .modelo').text(modelo);
                $('#vehicle-' + vehicleId + ' .matricula').text(matricula);
                $('#vehicle-' + vehicleId + ' .tarifa').text(tarifa);
                $('#vehicle-' + vehicleId + ' .color').text(color);
                $('#vehicle-' + vehicleId + ' .estado').text(estado);

                // Actualizar el atributo data- del botón Editar
                $('button[data-id="' + vehicleId + '"]').attr({
                    'data-editMarca': marca,
                    'data-editModelo': modelo,
                    'data-editMatricula': matricula,
                    'data-editTarifa': tarifa,
                    'data-editColor': color,
                    'data-editEstado': estado
                });

                // Cerrar el modal
                var modalVehicle = bootstrap.Modal.getInstance(editModalVehicle);
                modalVehicle.hide();

                // Mostrar mensaje de éxito
                $('#alertaVehicle').removeClass('d-none alert-danger').addClass('alert-success').text('Vehículo actualizado correctamente.');
            } else {
                console.log('Error en la respuesta: ', response); // Depurar errores
                // Mostrar mensaje de error
                $('#alertaVehicle').removeClass('d-none alert-success').addClass('alert-danger').text('Error al actualizar vehículo.');
            }
        },
        error: function (xhr, status, error) {
            console.log('Error en la solicitud AJAX:', error); // Depurar errores
            // Mostrar mensaje de error en caso de fallo en la solicitud
            $('#alertaVehicle').removeClass('d-none alert-success').addClass('alert-danger').text('Error de conexión.');
        }
    });
});
