<?php
include "../db/conexion_db.php";
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'], $_POST['email'], $_POST['password'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null; // Manejamos el teléfono como un valor opcional

    // Hashear la contraseña
    $password_hasheada = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el usuario en la tabla usuarios
    $sql = "INSERT INTO usuarios (nombre, email, password, telefono) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('ssss', $nombre, $email, $password_hasheada, $telefono);
        $stmt->execute();
        // Redirigir a la página de inicio (index.php)
        header('Location: ../index.php');
        exit();
    } else {
        echo "Error en la consulta de inserción: " . $conn->error;
    }
}
?>
