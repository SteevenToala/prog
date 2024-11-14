 // Script para pasar datos al modal
 var editModal = document.getElementById('contratoModal');
 editModal.addEventListener('show.bs.modal', function(event) {
     var button = event.relatedTarget; // Botón que activa el modal
     var userId = button.getAttribute('data-id'); // Obtener el id del usuario            
     var matricula = button.getAttribute('data-matricula');
     var nombre_usuario = button.getAttribute('data-nombreUsuario');
     var fechaI = button.getAttribute('data-fechaInicio');
     // Asignar los valores a los campos del modal

     document.getElementById('matriculaC').innerHTML = " " + matricula;
     document.getElementById('nombreC').innerHTML = " " + nombre_usuario;
     document.getElementById('fechaI').innerHTML = " " + fechaI;

 });

 // Limpiar el modal al cerrarse para evitar que queden valores antiguos
 $('#contratoModal').on('hidden.bs.modal', function() {
     $('#editForm')[0].reset(); // Restablecer el formulario
 });