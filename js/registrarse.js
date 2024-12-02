document.getElementById('registroForm').addEventListener('submit', function(event) {
    event.preventDefault(); 

    
    let formData = new FormData(this);

    
    fetch('../util/registrar_usuario.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      
      const alerta = document.getElementById('alerta');
      if (data.includes('exitoso')) {
        alerta.classList.remove('d-none', 'alert-danger');
        alerta.classList.add('alert-success');
        alerta.textContent = '¡Registro exitoso!';
        this.reset();    
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