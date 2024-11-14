var editModal = document.getElementById('editModal');
editModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Botón que activa el modal
    var userId = button.getAttribute('data-id'); // Obtener el id del usuario
    var userName = button.getAttribute('data-nombre'); // Obtener el nombre del usuario

    // Asignar los valores a los campos del modal
    document.getElementById('editUserId').value = userId;
    document.getElementById('editUserName').value = userName;
});

// Limpiar el modal al cerrarse para evitar que queden valores antiguos
$('#editModalRent').on('hidden.bs.modal', function () {
    $('#editForm')[0].reset(); // Restablecer el formulario
});