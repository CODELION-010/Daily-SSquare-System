<?php
session_start();

// Función para cerrar la sesión
function cerrarSesion() {
    // Destruir todas las variables de sesión
    $_SESSION = array();

    // Destruir la sesión
    session_destroy();

    // Redirigir a la página de inicio de sesión
    header('Location: ../index.php');
    exit();
}

// Llamada a la función para cerrar la sesión
cerrarSesion();
?>
