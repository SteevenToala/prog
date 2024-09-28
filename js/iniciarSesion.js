$(document).ready(function() {
  $('#loginForm').on('submit', function(e) {
    e.preventDefault(); // Evitar que el formulario se envíe de forma tradicional

    $.ajax({
      type: 'POST',
      url: '../util/login.php', // URL del archivo de login
      data: $(this).serialize() + '&action=login',
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          // Redirigir según el tipo de usuario
          if (response.tipo_usuario === 'administrador') {
            window.location.href = '../admin/home_admin.php';
          } else if (response.tipo_usuario === 'empleado') {
            window.location.href = '../employee/home_employee.php';
          } else {
            window.location.href = '../client/home_client.php';
          }
        } else {
          // Mostrar error
          $('#error').text(response.error).show();
        }
      },
      error: function(xhr, status, error) {
        // Mostrar error en consola y en la página
        console.error("Error del servidor:", xhr.responseText);
        $('#error').text('Ocurrió un error en el servidor: ' + xhr.responseText).show();
      }
    });
  });
});
