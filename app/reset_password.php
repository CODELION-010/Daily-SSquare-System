<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/style_newpass.css">
    <title>Restablecer Contraseña</title>
</head>
<body>
<div class="container">
    <h4>Introduce tu nueva contraseña</h4>
    <form  class="input-field" id="updatePasswordForm" method="POST" action="actualizar_password.php">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
        
        <div class="input-container">
           <i class="material-icons prefix">vpn_key</i>
            <label for="password">Nueva contraseña:</label>
            <input type="password" id="password" name="password" required>
            <span class="password-eye" onclick="togglePassword('password')">👁️</span>
        </div>

        <div class="input-container">
        <i class="material-icons prefix">vpn_key</i>

            <label for="confirmPassword">Confirmar contraseña:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <span class="password-eye" onclick="togglePassword('confirmPassword')">👁️</span>
        </div>

        <button class="btn waves-effect waves-light" type="submit">
            Restablecer Contraseña
            <i class="material-icons right">sync</i>
        </button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/newpass.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>

</body>
</html>
