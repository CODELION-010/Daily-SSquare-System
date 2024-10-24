<?php
include "../db/conexion_db.php";
session_start();

// Función para procesar el registro de un nuevo usuario
function procesarRegistro($conn, $nombre, $email, $password, $telefono = null) {
    // Hashear la contraseña
    $password_hasheada = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el usuario en la tabla usuarios
    $sql = "INSERT INTO usuarios (nombre, email, password, telefono) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('ssss', $nombre, $email, $password_hasheada, $telefono);
        $stmt->execute();
        return true;
    } else {
        throw new Exception("Error en la consulta de inserción: " . $conn->error);
    }
}

// Lógica principal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'], $_POST['email'], $_POST['password'])) {
    try {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;

        if (procesarRegistro($conn, $nombre, $email, $password, $telefono)) {
            // Redirigir a la página de inicio (index.php) si el registro es exitoso
            header('Location: ../index.php');
            exit();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>
