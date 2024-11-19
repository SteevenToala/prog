$(document).on('click', '.eliminar', function (e) {
    const idRent = $(this).data('id'); // Obtiene el ID del alquiler

    $.ajax({
        url: './home_section/scripts/removeRent.php', 
        type: 'POST', 
        dataType: 'json', 
        data: { rent_id: idRent },
        success: function (response) {
            const alerta = $('#alerta2');

            if (response.success) { 
                alerta.removeClass('d-none alert-danger').addClass('alert-success').text(response.message);
                $(e.target).closest('tr').remove(); 
            } else { 
                alerta.removeClass('d-none alert-success').addClass('alert-danger').text('Error: ' + response.message);
            }
        },
        error: function (xhr, status, error) { // En caso de error en la solicitud
            console.error('Error:', error);
            const alerta = $('#alerta2');
            alerta.removeClass('d-none alert-success').addClass('alert-danger').text('Ocurrió un error inesperado.');
        }
    });
});
