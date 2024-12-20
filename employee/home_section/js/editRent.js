var editModalRent = document.getElementById('editModalRent');
editModalRent.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var alquilerId = button.getAttribute('data-id');  
    
    
    document.getElementById('editRentID').value = alquilerId;
});


$('#editModalRent').on('hidden.bs.modal', function () {
    $('#formEditRent')[0].reset(); 
});


$('#formEditRent').submit(function(e) {
    e.preventDefault(); 

    var id_vehiculo = $('#matricula_vehiculoE').val();    
    var id_usuario = $('#nombre_usuarioE').val();   
    var id_alquiler =  $('#editRentID').val();   

    $.ajax({
        url: './home_section/scripts/editRent.php',
        type: 'POST',
        dataType: 'json',
        data: { id_alquiler: id_alquiler, id_vehiculo:id_vehiculo, id_usuario:id_usuario },
        success: function(response) {
            if (response.success) {   
                /*console.log(response.usuario_actual.nombre);
                console.log($('#rent-' + id_alquiler + ' .nombre'));*/
                // Actualizar la fila en la tabla sin recargar la página                
                $('#rent-' + id_alquiler + ' .nombre').text(response.usuario_actual.nombre);
                $('#rent-' + id_alquiler + ' .marca').text(response.vehiculo_actual.marca);
                $('#rent-' + id_alquiler + ' .modelo').text(response.vehiculo_actual.modelo);
                $('#rent-' + id_alquiler + ' .matricula').text(response.vehiculo_actual.matricula);
                
                
                var optionEliminarE = document.getElementById('eV'+response.vehiculo_actual.id);
                var optionEliminarA = document.getElementById('aV'+response.vehiculo_actual.id);
                if(optionEliminarE){
                    optionEliminarE.remove();
                    optionEliminarA.remove();
                    console.log('option eliminado correctamente');
                }else{
                    console.log('este option no existe');
                }

                var optionAgregar = document.createElement('option');
                optionAgregar.value = response.vehiculo_antiguo.id;
                optionAgregar.id = 'eV'+response.vehiculo_antiguo.id;
                optionAgregar.textContent= response.vehiculo_antiguo.marca+' - '+response.vehiculo_antiguo.modelo+' - '+ response.vehiculo_antiguo.matricula+' - ';

                addOptionalEmilimar('matricula_vehiculoE',optionAgregar);

                var optionAgregarA = document.createElement('option');
                optionAgregarA.value = response.vehiculo_antiguo.id;
                optionAgregarA.id = 'aV'+response.vehiculo_antiguo.id;
                optionAgregarA.textContent= response.vehiculo_antiguo.marca+' - '+response.vehiculo_antiguo.modelo+' - '+ response.vehiculo_antiguo.matricula+' - ';
                addOptionalEmilimar('matricula_vehiculo',optionAgregarA);

                
                $('button[data-id="' + id_alquiler + '"]').attr({                    
                    'data-nombreUsuario': response.usuario_actual.nombre,
                    'data-matricula': response.vehiculo_actual.matricula,                   
                });


                
                var modal = bootstrap.Modal.getInstance(editModalRent);
                modal.hide();
                
                $('#alerta2').removeClass('d-none alert-danger').addClass('alert-success').text(response.message);
            } else {                
                $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text(response.message);
            }
        },
        error: function(xhr, status, error) {            
            $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text('Error de conexión.');
        }
    });
});



function addOptionalEmilimar(idSelect, option) {
    var select = document.getElementById(idSelect);
    if (!select) {
        console.error(`No se encontró el elemento <select> con id "${idSelect}".`);
        return;
    }    
    select.appendChild(option); // Ahora 'option' es un nodo DOM válido
}
