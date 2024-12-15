$(document).on('click', '.eliminar', function (e) {
    e.preventDefault(); // Prevenir comportamiento por defecto del botón

    const idVehicle = $(this).data('id'); // Obtener el ID del vehículo
    const card = $(this).closest('.col-md-4'); // Seleccionar la tarjeta correspondiente

    if (!confirm('¿Estás seguro de que deseas eliminar este vehículo?')) {
        return; // Salir si el usuario cancela la confirmación
    }

    let formData = new FormData();
    formData.append('id_vehicle', idVehicle);

    fetch('./home_section/scripts/removeVehicle.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            const alerta = $('#alertaVehicle'); // Selector para mostrar mensajes de alerta

            if (data.includes('exitoso')) {
                alerta.removeClass('d-none alert-danger').addClass('alert-success').text('¡Vehículo eliminado exitosamente!');
                
                card.fadeOut(300, function () {
                    $(this).remove(); // Remover la tarjeta del DOM después de la animación
                });
            } else {
                alerta.removeClass('d-none alert-success').addClass('alert-danger').text('Error: ' + data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            $('#alertaVehicle').removeClass('d-none alert-success').addClass('alert-danger').text('Error de conexión.');
        });
});
