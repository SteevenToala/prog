$(document).on('click', '.eliminar', function(e) {
    const idUsuario = $(this).data('id');
    
    // Crear un objeto FormData para enviar el ID
    let formData = new FormData();
    formData.append('id_usuario', idUsuario);
    
    // Enviar los datos por AJAX
    fetch('./home_section/scripts/removeUser.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Mostrar mensaje de éxito o error
        const alerta = $('#alerta2');
        if (data.includes('exitoso')) {
            alerta.removeClass('d-none alert-danger').addClass('alert-success').text('¡Usuario eliminado exitosamente!');
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
