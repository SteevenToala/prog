var editModalRent = document.getElementById('editModalRent');

// Evento al mostrar el modal
editModalRent.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var alquilerId = button.getAttribute('data-id');
    var fecha_D = button.getAttribute('data-fechaDevolucion');
    var cargosExtra = button.getAttribute('data-cargosExtra');
    var descripcionDevolucion = button.getAttribute('data-descripcionDevolucion');
    var devuelto = button.getAttribute('data-devuelto');

    // Asignar los valores al formulario
    document.getElementById('editRentID').value = alquilerId;
    document.getElementById('fecha_devolucion').value = fecha_D;
    document.getElementById('cargos_extra').value = cargosExtra;
    document.getElementById('descripcion_devolucion').value = descripcionDevolucion;
    document.getElementById('devuelto').value = devuelto;
});

// Restablecer el formulario al cerrar el modal
$('#editModalRent').on('hidden.bs.modal', function () {
    $('#formeEditDev')[0].reset();
});

// Manejo del envío del formulario
$('#formeEditDev').submit(function (e) {
    e.preventDefault();

    var editRentID = $('#editRentID').val();
    var descripcion_devolucion = $('#descripcion_devolucion').val();
    var fecha_devolucion = $('#fecha_devolucion').val();
    var devuelto = $('#devuelto').val();
    var cargos_extra = $('#cargos_extra').val();

    // Enviar la solicitud AJAX
    $.ajax({
        url: './home_section/scripts/editDev.php',
        type: 'POST',
        dataType: 'json',
        data: {
            editRentID: editRentID,
            descripcion_devolucion: descripcion_devolucion,
            fecha_devolucion: fecha_devolucion,
            devuelto: devuelto,
            cargos_extra: cargos_extra
        },
        success: function (response) {
            if (response.success) {
                // Actualizar la fila en la tabla
                $('#rent-' + editRentID + ' .fecha').text(fecha_devolucion);
                $('#rent-' + editRentID + ' .cargos').text(cargos_extra);
                $('#rent-' + editRentID + ' .descripcion').text(descripcion_devolucion);
                $('#rent-' + editRentID + ' .devuelto').text(devuelto);

                // Mostrar mensaje de éxito
                $('#alerta2')
                    .removeClass('d-none alert-danger')
                    .addClass('alert-success')
                    .text(response.message);
            } else {
                // Mostrar mensaje de error
                $('#alerta2')
                    .removeClass('d-none alert-success')
                    .addClass('alert-danger')
                    .text(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error en la conexión AJAX:", error);
            console.error("Estado:", status);
            console.error("Respuesta del servidor:", xhr.responseText);

            // Mostrar mensaje de error
            $('#alerta2')
                .removeClass('d-none alert-success')
                .addClass('alert-danger')
                .text('Error de conexión.');
        }
    });
});
