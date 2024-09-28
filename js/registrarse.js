/*let btnregistrarse = document.getElementById("registrarse");
let inputEmail = document.getElementById("email");
let inputPassword = document.getElementById("password");

btnregistrarse.addEventListener('click', verAlerta, false);

function verAlerta() {
    inputEmail.value = "";
    inputPassword.value = "";
    alert('Ingresa valores validos');
}*/
document.getElementById('registroForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar que el formulario recargue la página

    // Crear un objeto FormData con los datos del formulario
    let formData = new FormData(this);

    // Enviar los datos por AJAX
    fetch('../util/registrar_usuario.php', {
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