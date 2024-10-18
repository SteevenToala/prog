
document.addEventListener('DOMContentLoaded', function () {
    const eliminarButtons = document.querySelectorAll('.eliminar');
    
    eliminarButtons.forEach(button => {
        button.addEventListener('click', function () {
            const idVehicle = this.getAttribute('data-id');
            
            // Crear un objeto FormData para enviar el ID
            let formData = new FormData();
            formData.append('id_vehicle', idVehicle);
            
            // Enviar los datos por AJAX
            fetch('./home_section/scripts/removeVehicle.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    // Mostrar mensaje de éxito o error
                    const alerta = document.getElementById('alertaVehicle');
                    if (data.includes('exitoso')) {
                        alerta.classList.remove('d-none', 'alert-danger');
                        alerta.classList.add('alert-success');
                        alerta.textContent = '¡Vehiculo eliminado exitosamente!';                        
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
