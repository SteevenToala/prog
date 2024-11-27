$(document).ready(function() {
    $('#recoverForm').on('submit', function(e) {
      e.preventDefault(); // Evitar que el formulario se envíe de forma tradicional
  
      $.ajax({
        type: 'POST',
        url: '../util/recover.php', // URL del archivo de login 
        data: { email: $('#email').val() },       
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#error').removeClass('alert-danger').addClass('alert-success').text(response.message).show();
            } else {
                $('#error').removeClass('alert-success').addClass('alert-danger').text(response.message).show();
            }
        },
        error: function(xhr, status, error) {
          
          console.error("Error del servidor:", xhr.responseText);
          $('#error').text('Ocurrió un error en el servidor: ' + xhr.responseText).show();
        }
      });
    });
  });
  