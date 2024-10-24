<?php
session_start();
include "../db/conexion_db.php";

function registrarRetiro($conn, $monto_retiro, $user_id) {
    // Insertar el retiro en la tabla movimientos con user_id
    $sql = "INSERT INTO movimientos (monto, tipo, user_id) VALUES (?, 'Retiro', ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('di', $monto_retiro, $user_id); // 'di' indica que son valores decimales y un entero (monto, user_id)
        $stmt->execute();

        // Actualizar el valor base sumando el retiro
        $sql = "UPDATE valor_base SET monto_base = monto_base + ? WHERE user_id = ?";
        $stmt2 = $conn->prepare($sql);

        if ($stmt2) {
            $stmt2->bind_param('di', $monto_retiro, $user_id);
            $stmt2->execute();
            return true;
        } else {
            throw new Exception("Error en la consulta de actualización: " . $conn->error);
        }
    } else {
        throw new Exception("Error en la consulta de inserción: " . $conn->error);
    }
}

function registrarDeposito($conn, $monto_deposito, $user_id) {
    // Insertar el depósito en la tabla movimientos con user_id
    $sql = "INSERT INTO movimientos (monto, tipo, user_id) VALUES (?, 'Depósito', ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('di', $monto_deposito, $user_id); // 'di' indica que son valores decimales y un entero (monto, user_id)
        $stmt->execute();

        // Actualizar el valor base restando el depósito
        $sql = "UPDATE valor_base SET monto_base = monto_base - ? WHERE user_id = ?";
        $stmt2 = $conn->prepare($sql);

        if ($stmt2) {
            $stmt2->bind_param('di', $monto_deposito, $user_id);
            $stmt2->execute();
            return true;
        } else {
            throw new Exception("Error en la consulta de actualización: " . $conn->error);
        }
    } else {
        throw new Exception("Error en la consulta de inserción: " . $conn->error);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['monto_retiro']) && isset($_SESSION['user_id'])) {
        try {
            registrarRetiro($conn, $_POST['monto_retiro'], $_SESSION['user_id']);
            header('Location: index.php');
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } elseif (isset($_POST['monto_deposito']) && isset($_SESSION['user_id'])) {
        try {
            registrarDeposito($conn, $_POST['monto_deposito'], $_SESSION['user_id']);
            header('Location: index.php');
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        echo "No se ha iniciado sesión.";
    }
}
?>
