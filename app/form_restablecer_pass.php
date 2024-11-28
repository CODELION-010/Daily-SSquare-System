<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/style_resetpass.css">
    <title>Envio de email para restablecer contraseña</title>
</head>
<body>
    <div class="container" >
    <a href="../index.php"><i class="material-icons right">reply_all</i></a>

    <h4>Restablecer Contraseña</h4>
    <div class="input-field">
        <form id="formRestablecimiento">
            <i class="material-icons prefix">email</i>
            <label for="email">Ingrese Correo electrónico Registrado</label>    
            <input type="email" id="email" name="email" required>
            <button class="btn waves-effect waves-light" type="submit">
                Enviar <i class="material-icons right">send</i>
            </button>
        </form>
    </div>  
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
    <script src="../js/js_resetpass.js"></script>
</body>
</html>
