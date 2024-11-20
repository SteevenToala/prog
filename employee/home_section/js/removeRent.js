var mdEdit = document.getElementById('matricula_vehiculo');

$(document).on('click', '.eliminar', function (e) {
    const idRent = $(this).data('id'); 

    $.ajax({
        url: './home_section/scripts/removeRent.php', 
        type: 'POST', 
        dataType: 'json', 
        data: { rent_id: idRent },
        success: function (response) {
            const alerta = $('#alerta2');

            if (response.success) { 
                alerta.removeClass('d-none alert-danger').addClass('alert-success').text('Alquiler eliminado correctamente');                                
                
                var optionVehiculo = document.createElement('option');
                optionVehiculo.value = response.id_vehiculo;
                optionVehiculo.id = 'aV' + response.id_vehiculo;
                optionVehiculo.textContent = `${response.marca} - ${response.modelo} - ${response.matricula}`;

                
                addOptionalEmilimar('matricula_vehiculo', optionVehiculo);

                
                $(e.target).closest('tr').remove(); 
            } else { 
                alerta.removeClass('d-none alert-success').addClass('alert-danger').text('Error: ' + response.message);
            }
        },
        error: function (xhr, status, error) { 
            console.error('Error:', error);
            const alerta = $('#alerta2');
            alerta.removeClass('d-none alert-success').addClass('alert-danger').text('Ocurrió un error inesperado.');
        }
    });
});

// Función para agregar una nueva opción al select
function addOptionalEmilimar(idSelect, option) {
    var select = document.getElementById(idSelect);
    if (!select) {
        console.error(`No se encontró el elemento <select> con id "${idSelect}".`);
        return;
    }    
    select.appendChild(option); // Ahora 'option' es un nodo DOM válido
}
