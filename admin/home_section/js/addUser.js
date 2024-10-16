document.getElementById('formaddUser').addEventListener('submit', function (event) {
    event.preventDefault(); // Evitar que el formulario recargue la página

    // Crear un objeto FormData con los datos del formulario
    let formData = new FormData(this);

    // Enviar los datos por AJAX
    fetch('./home_section/scripts/addUser.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            // Mostrar mensaje de éxito o error
            const alerta = document.getElementById('alerta');
            if (data.includes('exitoso')) {
                alerta.classList.remove('d-none', 'alert-danger');
                alerta.classList.add('alert-success');
                alerta.textContent = '¡Registro exitoso!';
            } else {
                alerta.classList.remove('d-none', 'alert-success');
                alerta.classList.add('alert-danger');
                alerta.textContent = 'Error: ' + data;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});



document.addEventListener('DOMContentLoaded', function () {
    const eliminarButtons = document.querySelectorAll('.eliminar');
    
    eliminarButtons.forEach(button => {
        button.addEventListener('click', function () {
            const idUsuario = this.getAttribute('data-id');
            
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
                        this.closest('tr').remove(); // Elimina la fila correspondiente
                    } else {
                        alerta.classList.remove('d-none', 'alert-success');
                        alerta.classList.add('alert-danger');
                        alerta.textContent = 'Error: ' + data;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
});
