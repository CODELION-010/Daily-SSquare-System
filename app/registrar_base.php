<?php
session_start();
include "../db/conexion_db.php";

// Función para registrar el monto base
function registrarMontoBase($conn, $user_id, $monto_base) {
    // Insertar el monto base en la tabla valor_base
    $sql = "INSERT INTO valor_base (monto_base, user_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param('di', $monto_base, $user_id);
        $stmt->execute();
        return true;
    } else {
        throw new Exception("Error en la consulta: " . $conn->error);
    }
}

// Lógica principal
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $monto_base = $_POST['monto_base'];

    try {
        if (registrarMontoBase($conn, $user_id, $monto_base)) {
            // Redireccionar a la página principal después de registrar el monto base
            header('Location: index.php');
            exit();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo "No se ha iniciado sesión.";
}
?>
