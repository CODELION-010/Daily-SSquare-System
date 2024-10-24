<?php
session_start();
include "../db/conexion_db.php";

// Función para verificar si el usuario ha iniciado sesión
function verificarSesion() {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception("No ha iniciado sesión.");
    }
    return $_SESSION['user_id'];
}

// Función para borrar los registros de movimientos de un usuario
function borrarRegistros($conn, $user_id) {
    $sql = "DELETE FROM movimientos WHERE user_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->close();
        return true;
    } else {
        throw new Exception("Error en la consulta: " . $conn->error);
    }
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['borrar_registros'])) {
        $user_id = verificarSesion();
        borrarRegistros($conn, $user_id);
        $_SESSION['borrado_exitoso'] = true;
        header('Location: index.php?borrado_exitoso=1');
        exit();
    }
} catch (Exception $e) {
    $_SESSION['borrado_error'] = $e->getMessage();
    header('Location: index.php?borrado_error=1');
    exit();
}
?>
