<?php
session_start();

include "../db/conexion_db.php";

// Verificar que el usuario haya iniciado sesión
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $monto_base=$_POST['monto_base'];
      
    // Insertar el monto base en la tabla valor_base
    $sql = "INSERT INTO valor_base (monto_base, user_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('di', $monto_base, $user_id);
        $stmt->execute();

        // Redireccionar a la página principal después de registrar el monto base
        header('Location: index.php');
        exit();
    } else {
        echo "Error en la consulta: " . $conn->error;
    }
} else {
    echo "No se ha iniciado sesión.";
}

?>
