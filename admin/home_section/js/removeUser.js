document.addEventListener('DOMContentLoaded', function () {
    const tablaUsuarios = document.getElementById('tablaUsuarios');
    
    // Delegar el evento de eliminar
    tablaUsuarios.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('eliminar')) {
            const idUsuario = e.target.getAttribute('data-id');
            
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
                const alerta = document.getElementById('alerta2');
                if (data.includes('exitoso')) {
                    alerta.classList.remove('d-none', 'alert-danger');
                    alerta.classList.add('alert-success');
                    alerta.textContent = '¡Usuario eliminado exitosamente!';                        
                    // Eliminar la fila de la tabla sin recargar la página
                    e.target.closest('tr').remove(); // Elimina la fila correspondiente
                } else {
                    alerta.classList.remove('d-none', 'alert-success');
                    alerta.classList.add('alert-danger');
                    alerta.textContent = 'Error: ' + data;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
});
