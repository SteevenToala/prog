
var editModal = document.getElementById('editModal');
editModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; 
    var userId = button.getAttribute('data-id'); 
    var userName = button.getAttribute('data-nombre'); 

    
    document.getElementById('editUserId').value = userId;
    document.getElementById('editUserName').value = userName;
});


$('#editModal').on('hidden.bs.modal', function () {
    $('#editForm')[0].reset();
});


$('#editForm').submit(function(e) {
    e.preventDefault();
    var userId = $('#editUserId').val();
    var userName = $('#editUserName').val();

    $.ajax({
        url: './home_section/scripts/editUser.php',
        type: 'POST',
        data: { id: userId, nombre: userName },
        success: function(response) {
            if (response.trim() === 'success') {
                // Actualizar el nombre en la tabla sin recargar la página
                $('#usuario-' + userId + ' .nombre').text(userName);

                // Actualizar el atributo data-nombre del botón Editar
                $('button[data-id="' + userId + '"]').attr('data-nombre', userName);

                // Cerrar el modal
                var modal = bootstrap.Modal.getInstance(editModal);
                modal.hide();

                // Mostrar mensaje de éxito
                $('#alerta2').removeClass('d-none alert-danger').addClass('alert-success').text('Usuario actualizado correctamente.');
            } else {
                // Mostrar mensaje de error
                $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text('Error al actualizar usuario.');
            }
        },
        error: function(xhr, status, error) {
            // Mostrar mensaje de error en caso de fallo en la solicitud
            $('#alerta2').removeClass('d-none alert-success').addClass('alert-danger').text('Error de conexión.');
        }
    });
});
