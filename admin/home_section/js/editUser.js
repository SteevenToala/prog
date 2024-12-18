
var editModal = document.getElementById('editModal');
editModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; 
    var userId = button.getAttribute('data-id'); 
    /*var userName = button.getAttribute('data-nombre'); */

    
    document.getElementById('editUserId').value = userId;
    /*document.getElementById('editUserName').value = userName;*/
});


$('#editModal').on('hidden.bs.modal', function () {
    $('#editForm')[0].reset();
});


$('#editForm').submit(function(e) {
    e.preventDefault();
    var userId = $('#editUserId').val();
    var password = $('#password').val();
    var passwordC = $('#passwordC').val();
    if(password==passwordC){
    $.ajax({
        url: './home_section/scripts/editUser.php',
        type: 'POST',
        data: { id: userId, password: password },
        success: function(response) {
            if (response.trim() === 'success') {
                                               
                var modal = bootstrap.Modal.getInstance(editModal);
                modal.hide();

                
                $('#alerta2').removeClass('d-none alert-danger').addClass('alert-success').text('Se ha cambiado la contrasena correctamente.');
            } else {
                
                $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text('Error al actualizar usuario.');
            }
        },
        error: function(xhr, status, error) {
            
            $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text('Error de conexión.');
        }
    });
    }else{
        $('#alertaE').removeClass('d-none alert-success').addClass('alert-danger').text('Las contrsenas no coinciden.').show();
    }
});
