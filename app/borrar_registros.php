<?php
session_start();

include "../db/conexion_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['borrar_registros'])) {
    // Verificar si el usuario ha iniciado sesión y obtener su user_id
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['borrado_error'] = "No ha iniciado sesión.";
        header('Location: index.php?borrado_error=1');
        exit();
    }
    
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM movimientos WHERE user_id = ?";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->close();
        
        $_SESSION['borrado_exitoso']= true;
    } 
    
    header('Location: index.php?borrado_exitoso=1');
    exit();
}
?>