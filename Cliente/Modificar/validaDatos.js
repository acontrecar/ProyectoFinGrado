var modificaClave = 0;

document.getElementById("contraseña").addEventListener("keyup", () => {
  var clave = document.getElementById("contraseña").value;
  if (clave.length == 0) {
    modificaClave = 0;
  } else {
    modificaClave = 1;
  }
});

document.getElementById("boton").addEventListener("click", (evento) => {
  if (modificaClave == 1) {
    var Contraseña = document.getElementById("contraseña").value;
    var RepiteContraseña = document.getElementById("contraseña2").value;
    var repeatPasswordError = document.getElementById("passwordError");
    var nameError = document.getElementById("nameError");

    var mayuscula = false;
    var numero = false;

    for (var i = 0; i < Contraseña.length; i++) {
      if (!isNaN(Contraseña.charAt(i))) {
        numero = true;
      } else {
        if (Contraseña.charAt(i) == Contraseña.charAt(i).toUpperCase()) {
          mayuscula = true;
        }
      }
    }
    if (mayuscula != true || numero != true) {
      passwordError.innerHTML =
        "*La contraseña debe contener 1 mayúscula y un número.";
      evento.preventDefault();
    } else {
      if (Contraseña != RepiteContraseña) {
        repeatPasswordError.innerHTML = "*Las contraseñas deben coincidir";
        evento.preventDefault();
      }
    }
  }

  var patron = /^[A-Za-zá-ú Á-Ú]{1,30}$/;

  var nombre = document.getElementById("nombre");

  if (nombre.value.length != 0) {
    if (!patron.test(nombre.value)) {
      nameError.innerHTML = "*Introduzca un nombre correcto";
      evento.preventDefault();
    }
  }
});
