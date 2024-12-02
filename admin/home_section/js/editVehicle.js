
var editModalVehicle = document.getElementById('editModalVehicle');
editModalVehicle.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; 
    var vehicleId = button.getAttribute('data-id'); 
    var marca = button.getAttribute('data-editMarca'); 
    var modelo = button.getAttribute('data-editModelo');
    var matricula = button.getAttribute('data-editMatricula');
    var tarifa = button.getAttribute('data-editTarifa');
    var color = button.getAttribute('data-editColor');
    var estado = button.getAttribute('data-editEstado');
    var tipo_vehiculo = button.getAttribute('data-editTipo');
    var disponibilidad = button.getAttribute('data-editDisponibilidad');

    
    document.getElementById('editVehicleId').value = vehicleId;
    document.getElementById('editMarca').value = marca;
    document.getElementById('editModelo').value = modelo;
    document.getElementById('editMatricula').value = matricula;
    document.getElementById('editTarifa').value = tarifa;
    document.getElementById('editColor').value = color;
    document.getElementById('editEstado').value = estado;
    document.getElementById('editTipo').value = tipo_vehiculo;
    document.getElementById('editDisponibilidad').value = disponibilidad;
});


$('#editModalVehicle').on('hidden.bs.modal', function () {
    $('#editFormVehicle')[0].reset(); 
});


$('#editFormVehicle').submit(function (e) {
    e.preventDefault(); 

    var vehicleId = $('#editVehicleId').val();
    var marca = $('#editMarca').val();
    var modelo = $('#editModelo').val();
    var matricula = $('#editMatricula').val();
    var tarifa = parseFloat($('#editTarifa').val()); 
    var color = $('#editColor').val();
    var estado = $('#editEstado').val();
    var tipo_vehiculo = $('#editTipo').val();
    var disponibilidad = $('#editDisponibilidad').val();

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
            disponibilidad: disponibilidad,
            tipo_vehiculo: tipo_vehiculo,
            estado: estado
        },
        success: function (response) {
            console.log('Respuesta del servidor:', response);

            
            if (response.trim() === 'success') {
                
                $('#vehicle-' + vehicleId + ' .marca').text(marca);
                $('#vehicle-' + vehicleId + ' .modelo').text(modelo);
                $('#vehicle-' + vehicleId + ' .matricula').text(matricula);
                $('#vehicle-' + vehicleId + ' .tarifa').text(tarifa);
                $('#vehicle-' + vehicleId + ' .color').text(color);
                $('#vehicle-' + vehicleId + ' .estado').text(estado);
                $('#vehicle-' + vehicleId + ' .tipo').text(tipo_vehiculo);
                $('#vehicle-' + vehicleId + ' .disponibilidad').text(disponibilidad);

                
                $('button[data-id="' + vehicleId + '"]').attr({
                    'data-editMarca': marca,
                    'data-editModelo': modelo,
                    'data-editMatricula': matricula,
                    'data-editTarifa': tarifa,
                    'data-editColor': color,                    
                    'data-editTipo': tipo_vehiculo,
                    'data-editDisponibilidad': disponibilidad,
                    'data-editEstado': estado
                });

                
                var modalVehicle = bootstrap.Modal.getInstance(editModalVehicle);
                modalVehicle.hide();

                
                $('#alertaVehicle').removeClass('d-none alert-danger').addClass('alert-success').text('Vehículo actualizado correctamente.');
            } else {
                console.log('Error en la respuesta: ', response); 
                
                $('#alertaVehicle').removeClass('d-none alert-success').addClass('alert-danger').text('Error al actualizar vehículo.');
            }
        },
        error: function (xhr, status, error) {
            console.log('Error en la solicitud AJAX:', error); 
            
            $('#alertaVehicle').removeClass('d-none alert-success').addClass('alert-danger').text('Error de conexión.');
        }
    });
});
