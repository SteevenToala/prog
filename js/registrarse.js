let btnregistrarse = document.getElementById("registrarse");
let inputEmail = document.getElementById("email");
let inputPassword = document.getElementById("password");

btnregistrarse.addEventListener('click',verAlerta,false);

function verAlerta(){      
  inputEmail.value="";
  inputPassword.value="";
  alert('Ingresa valores validos');
}
