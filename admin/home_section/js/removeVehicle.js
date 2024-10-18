$(document).on('click', '.eliminar', function(e) {
    const idvehicle = $(this).data('id');
    
    // Crear un objeto FormData para enviar el ID
    let formData = new FormData();
    formData.append('id_vehicle', idvehicle);
    
    // Enviar los datos por AJAX
    fetch('./home_section/scripts/removeVehicle.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Mostrar mensaje de éxito o error
        const alerta = $('#alertaVehicle');
        if (data.includes('exitoso')) {
            alerta.removeClass('d-none alert-danger').addClass('alert-success').text('¡Vehiculo eliminado exitosamente!');
            // Eliminar la fila de la tabla sin recargar la página
            $(this).closest('tr').remove(); // Elimina la fila correspondiente
        } else {
            alerta.removeClass('d-none alert-success').addClass('alert-danger').text('Error: ' + data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
