$(document).on('click', '.eliminar', function(e) {
    const idvehicle = $(this).data('id');
    
    
    let formData = new FormData();
    formData.append('id_vehicle', idvehicle);
    
    
    fetch('./home_section/scripts/removeVehicle.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        
        const alerta = $('#alertaVehicle');
        if (data.includes('exitoso')) {
            alerta.removeClass('d-none alert-danger').addClass('alert-success').text('¡Vehiculo eliminado exitosamente!');
            
            $(this).closest('tr').remove(); 
        } else {
            alerta.removeClass('d-none alert-success').addClass('alert-danger').text('Error: ' + data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
