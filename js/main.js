const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

const htmlEl = document.getElementsByTagName("html")[0];
const currentTheme = localStorage.getItem("theme")
  ? localStorage.getItem("theme")
  : null;
if (currentTheme) {
  htmlEl.dataset.theme = currentTheme;
}
const toggleTheme = (theme) => {
  htmlEl.dataset.theme = theme;
  localStorage.setItem("theme", theme);
};

const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#id_password");

togglePassword.addEventListener("click", function (e) {
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);
  this.classList.toggle("fa-eye-slash");
});

const toggleReg = document.querySelector("#toggleReg");
const pass = document.querySelector("#id_reg");

toggleReg.addEventListener("click", function (e) {
  const type = pass.getAttribute("type") === "password" ? "text" : "password";
  pass.setAttribute("type", type);
  this.classList.toggle("fa-eye-slash");
});


//validacion de formulario registro

// Valida el nombre
function validateName(name) {
  // No permite caracteres como @ * o ""
  const regex = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/;
  return regex.test(name);
}

// Valida el email
function validateEmail(email) {
  // No permite correos con dominio @yopmail
  const regex = /^((?!yopmail\.com).)+@((?!yopmail\.com).)+$/;
  return regex.test(email);
}

// Valida la contraseña
function validatePassword(password) {
  // Debe tener al menos 3 caracteres
  // Debe tener al menos 1 mayúscula
  // Debe tener un máximo de 16 caracteres
  // No permite caracteres como {} o ""
  const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=\S+$).{3,16}$/;
  return regex.test(password);
}

// Valida el teléfono
function validatePhone(phone) {
  // Debe tener al menos 10 caracteres
  // Debe empezar por 3
  const regex = /^3\d{9}$/;
  return regex.test(phone);
}
// Valida el formulario
function validateForm() {
  // Obtiene los valores de los campos por medio de el id de cada uno
  const name = document.getElementById('nombre').value;
  const email = document.getElementById('email').value;
  const password = document.getElementById('id_reg').value;
  const phone = document.getElementById('telefono').value;

  // Valida el nombre
  if (!validateName(name)) {
    // Muestra un mensaje de error
    document.getElementById('nombre_error').innerHTML = 'El nombre solo puede contener letras, espacios y Ñ';
    return false;
  } else {
    // Elimina el mensaje de error al cumplirse la validacion
    document.getElementById('nombre_error').innerHTML = '';
  }

  // Valida el email
  if (!validateEmail(email)) {
    // Muestra un mensaje de error
    document.getElementById('email_error').innerHTML = 'El email no es válido';
    return false;
  } else {
    // Elimina el mensaje de error
    document.getElementById('email_error').innerHTML = '';
  }

  // Valida la contraseña
  if (!validatePassword(password)) {
    // Muestra un mensaje de error
    document.getElementById('password_error').innerHTML = 'La contraseña debe tener al menos 3 caracteres, 1 mayúscula y un máximo de 16 caracteres';
    return false;
  } else {
    // Elimina el mensaje de error
    document.getElementById('password_error').innerHTML = '';
  }

  // Valida el teléfono
  if (!validatePhone(phone)) {
    // Muestra un mensaje de error
    document.getElementById('telefono_error').innerHTML = 'El teléfono debe contener solo numeros, empezar con el numero 3 y tener al menos 10 caracteres';
    return false;
  } else {
    // Elimina el mensaje de error
    document.getElementById('telefono_error').innerHTML = '';
  }

  // Si todas las validaciones pasan, devuelve true
  return true;
}
// Agrega un evento al botón de envío del formulario
document.getElementById('form_registro').addEventListener('submit', function(event) {
  // Evita que el formulario se envíe si no es válido
  if (!validateForm()) {
    event.preventDefault();
  }
});
