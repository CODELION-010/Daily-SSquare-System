<?php
include '../db/conexion_db.php';

function actualizarPassword($conn, $token, $nuevaPassword) {
    // Verificar si el token es válido y no ha expirado
    $stmt = $conn->prepare("SELECT user_id, token_expira FROM reset_tokens WHERE token = ?");
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $stmt->bind_result($user_id, $token_expira);
    $stmt->fetch();
    $stmt->close();

    if (!$user_id) {
        echo "Token inválido.";
        return;
    }

    // Comprobar si el token ha expirado
    if (strtotime($token_expira) < time()) {
        echo "El token ha expirado.";
        return;
    }

    // Actualizar la contraseña del usuario
    $nuevaPasswordHash = password_hash($nuevaPassword, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE usuarios SET password = ? WHERE user_id = ?");
    $stmt->bind_param('si', $nuevaPasswordHash, $user_id);
    $stmt->execute();
    $stmt->close();

    // Eliminar el token para evitar reutilización
    $stmt = $conn->prepare("DELETE FROM reset_tokens WHERE token = ?");
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $stmt->close();

    echo "Contraseña actualizada con éxito.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $nuevaPassword = $_POST['password'];

    if (!empty($nuevaPassword)) {
        actualizarPassword($conn, $token, $nuevaPassword);
    } else {
        echo "La contraseña no puede estar vacía.";
    }
}
?>
