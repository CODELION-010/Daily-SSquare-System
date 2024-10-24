<?php
session_start();
include "../db/conexion_db.php";

function verificarSesion() {
    if (!isset($_SESSION['email'])) {
        header('Location: ../index.php');
        exit();
    }
}

function consultarMovimientos($conn, $user_id) {
    $query = "SELECT id, monto, tipo, DATE_FORMAT(fecha, '%Y-%m-%d %h:%i %p') AS fecha FROM movimientos WHERE user_id = ? ORDER BY fecha DESC";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $movimientos = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['monto'] = number_format($row['monto'], 0, ',', '.');
                $movimientos[] = $row;
            }
        }
        $stmt->close();
        return $movimientos;
    } else {
        throw new Exception("Error en la consulta: " . $conn->error);
    }
}

function mostrarMovimientos($movimientos) {
    if (empty($movimientos)) {
        echo "<h2>No se encontraron registros.</h2>";
    } else {
        foreach ($movimientos as $movimiento) {
            echo "<tr>";
            echo "<td>{$movimiento['id']}</td>";
            echo "<td>\$ {$movimiento['monto']}</td>";
            echo "<td>{$movimiento['tipo']}</td>";
            echo "<td>{$movimiento['fecha']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

try {
    verificarSesion();
    $movimientos = consultarMovimientos($conn, $_SESSION['user_id']);
    mostrarMovimientos($movimientos);
} catch (Exception $e) {
    echo $e->getMessage();
}

$conn->close();
?>
