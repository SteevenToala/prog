let editModals = document.getElementById('editFechaF');
editModals.addEventListener('show.bs.modal', function (event) {
    let button = event.relatedTarget; 
    let alquilerId = button.getAttribute('data-id');
    /*var userName = button.getAttribute('data-nombre'); */

    
    document.getElementById('editRentID').value = alquilerId;
    /*document.getElementById('editUserName').value = userName;*/
});


$('#editFechaF').on('hidden.bs.modal', function () {
    $('#formFechaF')[0].reset();
});


$('#formFechaF').submit(function(e) {
    e.preventDefault();
    var fecha_fin = $('#fecha_fin').val();
    var id = $('#editRentID').val();
    
    
    $.ajax({
        url: './home_section/scripts/editFF.php',
        type: 'POST',
        data: { fecha_fin: fecha_fin ,id:id},
        success: function(response) {
            if (response.trim() === 'success') {
                $('#rent-' + id + ' .fecha_fin').text(fecha_fin);
                                               
                var modal = bootstrap.Modal.getInstance(editModals);
                modal.hide();

                
                $('#alerta2').removeClass('d-none alert-danger').addClass('alert-success').text('Se ha actualizo la fecha.');
            } else {
                
                $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text('Error al actualizar la fecha.');
            }
        },
        error: function(xhr, status, error) {
            
            $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text('Error de conexión.');
        }
    });    
});
