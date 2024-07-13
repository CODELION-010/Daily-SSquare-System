<?php
session_start();
include "../db/conexion_db.php";
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['email'])) {
    // Si no ha iniciado sesión, redirige al usuario a la página de inicio de sesión.
    header('Location: ../index.php');
    exit();
}

// Consultar registros de la tabla "movimientos"
$query = "SELECT id, monto, tipo, DATE_FORMAT(fecha, '%Y-%m-%d %h:%i %p') AS fecha FROM movimientos WHERE user_id = ? ORDER BY fecha DESC";
$stmt = $conn->prepare($query);


// Comprobar si la consulta preparada fue exitosa
if ($stmt) {
    // Enlazar el user_id del usuario actual a la consulta
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    $num_movimientos = $result->num_rows;
    $_SESSION['num_movimientos'] = $num_movimientos;
    echo "<h2>Cantidad de movimientos: $num_movimientos</h2>";
    // mostrar los movimientos en la tabla
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $monto = $row['monto'];
            $tipo = $row['tipo'];
            $fecha = $row['fecha'];
            $monto = number_format($monto, 0, ',', '.');
            
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$ $monto</td>";
            echo "<td>$tipo</td>";
            echo "<td>$fecha</td>";
            echo "</tr>";
        }
        echo "</tabla>";
    } else {
        echo "<h2>No se encontraron registros.</h2>";
    }
    $stmt->close();
} else {
    echo "Error en la consulta: " . $conn->error;
}
$conn->close();
?>
