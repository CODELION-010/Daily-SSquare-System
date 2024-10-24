
<!DOCTYPE html>
<html class="html" lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicia Sesion o Registrate</title>
  <link rel="icon" href="img/login_icon.png">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">
  <!-- CUSTOM CSS -->
  <link rel="stylesheet" href="css/style.css">

  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="app/login_procesar.php" method="post" class="sign-in-form">
          <h2 class="title">Inicia Sesion</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="email" name="email" autocomplete="username" placeholder="Correo Registrado" required="yes">
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="contrasena" autocomplete="current-password" placeholder="Contraseña" id="id_password" required="yes">
            <i class="far fa-eye" id="togglePassword" style="cursor: pointer;"></i>
          </div>

          <input type="submit" value="Iniciar Sesion" class="btn solid">

          <div class="social-media">
            <a class="icon-mode" onclick="toggleTheme('dark');"><i class="fas fa-moon"></i></a>
            <a class="icon-mode" onclick="toggleTheme('light');"><i class="fas fa-sun"></i></a>
          </div>
          <p class="text-mode">Cambiar Tema</p>
        </form>
        <!--formulario para registro-->
        <form action="app/registro_procesar.php" method="post" class="sign-up-form" id="form_registro" >
        <div class="social-media">
            <a class="icon-mode" onclick="toggleTheme('dark');"><i class="fas fa-moon"></i></a>
            <a class="icon-mode" onclick="toggleTheme('light');"><i class="fas fa-sun"></i></a>
          </div>
          <p class="text-mode">Cambiar Tema</p>
          <h2 class="title">Registrate</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="nombre" id="nombre" autocomplete="nombre" placeholder="Nombre de Usuario" required="yes">
          </div>
          <span id="nombre_error" class="error_menssage" ></span>

          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" autocomplete="email" placeholder="Correo Electronico" required="yes">
          </div>
          <span id="email_error" class="error_menssage" ></span>

          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" autocomplete="current-password" placeholder="Contraseña" id="id_reg" required="yes">
            <i class="far fa-eye" id="toggleReg" style="cursor: pointer;"></i>
          </div>
          <span id="password_error" class="error_menssage" ></span>

          <div class="input-field">
            <i class="fas fa-phone"></i>
            <input type="text" name="telefono"  placeholder="Número de Celular" id="telefono" required="yes">
          </div>
          <span id="telefono_error" class="error_menssage" ></span>


          <label class="check">
            <input type="checkbox" checked="checked">
            <span class="checkmark">Acepto <a href="terms.html">Tratamiento de Datos</a></span>
          </label>
          <input type="submit" value="Registrarse" class="btn solid">
        </form>
      </div>
    </div>
    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Aun no tienes cuenta?</h3>
          <p>Crea tu cuenta e inicia sesión para probar el sistema de registro de operaciones bancarias en su version Beta</p>
          <button class="btn transparent" id="sign-up-btn">Registrarse</button>
        </div>
        <img src="img/login_icon.png" class="image" alt="">
      </div>

      <div class="panel right-panel">
        <div class="content">
          <h3>Ya eres usuario?</h3>
          <p>Inicia sesion y prueba el sistema sin limites</p>
          <button class="btn transparent" id="sign-in-btn">Inicia Sesion</button>
        </div>
        <img src="img/login_icon.png" class="image" alt="">
      </div>
    </div>
  </div>

  <script src="js/main.js"></script>

  <?php

if (isset($_GET['error'])) {
    if ($_GET['error'] === 'clave') {
        echo '<script>swal("Espera...","Clave errada,intenta de nuevo porfavor","error");</script>';
    }if ($_GET['error'] === 'email') {
        echo '<script>swal("Espera...","El correo electronico que ingresaste es incorrecto o no esta registrado","error");</script>';
    }
}
?>

</body>
</html>