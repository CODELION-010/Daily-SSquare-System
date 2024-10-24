<?php
session_start();
include "../db/conexion_db.php";

// Función para verificar si el usuario ha iniciado sesión
function verificarSesion() {
    if (!isset($_SESSION['email'])) {
        redirigirALogin();
    }
}

// Función para redirigir al usuario a la página de inicio de sesión
function redirigirALogin() {
    header('Location: ../index.php');
    exit();
}

// Función para obtener el número de movimientos de un usuario
function obtenerNumeroMovimientos($conn, $user_id) {
    $query = "SELECT COUNT(*) as num_movimientos FROM movimientos WHERE user_id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return $row['num_movimientos'];
    } else {
        throw new Exception("Error en la consulta: " . $conn->error);
    }
}

// Lógica principal
try {
    verificarSesion();

    // Obtener el número de movimientos del usuario
    $num_movimientos = obtenerNumeroMovimientos($conn, $_SESSION['user_id']);

    // Devolver el número de movimientos como texto
    echo $num_movimientos;
} catch (Exception $e) {
    echo $e->getMessage();
} finally {
    $conn->close();
}
?>
