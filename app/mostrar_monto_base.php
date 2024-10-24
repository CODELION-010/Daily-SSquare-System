<?php
session_start();
include "../db/conexion_db.php";

// Función para verificar si el usuario ha iniciado sesión
function verificarSesion() {
    if (!isset($_SESSION['email']) && !isset($_SESSION['user_id']) && !isset($_SESSION['telefono'])) {
        // Redirige al usuario a la página de inicio de sesión si no ha iniciado sesión
        header('Location: ../index.php');
        exit();
    }
}

// Función para obtener el monto base actual del usuario
function obtenerMontoBase($conn, $user_id) {
    $sql = "SELECT monto_base FROM valor_base WHERE user_id = ? ORDER BY id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $monto_base_actual = $result->fetch_assoc()['monto_base'];
            return number_format($monto_base_actual, 0, ',', '.');
        } else {
            return 0; // Valor predeterminado si no hay registros en la tabla
        }
    } else {
        throw new Exception("Error en la consulta: " . $conn->error);
    }
}

// Verifica si el usuario ha iniciado sesión
verificarSesion();

// Obtener datos de la sesión
$user_id = $_SESSION['user_id'];

// Obtener el monto base actual y mostrarlo
try {
    $monto_base_actual = obtenerMontoBase($conn, $user_id);
    echo $monto_base_actual;
} catch (Exception $e) {
    echo $e->getMessage();
}

?>
