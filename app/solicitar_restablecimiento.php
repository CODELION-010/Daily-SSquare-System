<?php
include '../db/conexion_db.php';

function generarToken($longitud = 64) {
    return bin2hex(random_bytes($longitud / 2));
}

function solicitarRestablecimiento($email) {
    global $conexion; // Conexión a la base de datos

    // Verificar si el usuario existe
    $query = "SELECT user_id FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        return ['status' => 'error', 'mensaje' => 'Correo electrónico no encontrado.'];
    }

    $usuario = $resultado->fetch_assoc();
    $userId = $usuario['user_id'];
    $token = generarToken();
    $tokenExpira = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // Insertar el token en la tabla reset_tokens
    $query = "INSERT INTO reset_tokens (user_id, token, token_expira) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("iss", $userId, $token, $tokenExpira);
    $stmt->execute();

    // Enviar el correo electrónico con el enlace de restablecimiento
    $enlace = "http://localhost/cuadre_diario/reset_password.php?token=$token";
    mail($email, "Restablecer contraseña", "Haz clic en el siguiente enlace para restablecer tu contraseña: $enlace");

    return ['status' => 'success', 'mensaje' => 'Correo enviado para restablecer la contraseña.'];
}

// Manejar la solicitud desde Ajax
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $resultado = solicitarRestablecimiento($email);
    echo json_encode($resultado);
}
?>
