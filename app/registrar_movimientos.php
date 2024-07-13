<?php
session_start();
include "../db/conexion_db.php";

// Verificar si se ha enviado el formulario de retiro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['monto_retiro'])) {
    $monto_retiro = $_POST['monto_retiro'];

    // Asegúrate de que el usuario haya iniciado sesión
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Insertar el retiro en la tabla movimientos con user_id
        $sql = "INSERT INTO movimientos (monto, tipo, user_id) VALUES (?, 'Retiro', ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('di', $monto_retiro, $user_id); // 'di' indica que son valores decimales y un entero (monto, user_id)
            $stmt->execute();

            // Actualizar el valor base sumando el retiro
            $sql = "UPDATE valor_base SET monto_base = monto_base + ? WHERE user_id = $user_id ";
            $stmt2 = $conn->prepare($sql);

            if ($stmt2) {
                $stmt2->bind_param('d', $monto_retiro);
                $stmt2->execute();

                // Redireccionar a la página principal después de registrar el retiro
                header('Location: index.php');
                exit();
            } else {
                echo "Error en la consulta de actualización: " . $conn->error;
            }
        } else {
            echo "Error en la consulta de inserción: " . $conn->error;
        }
    } else {
        echo "No se ha iniciado sesión.";
    }
}

// Verificar si se ha enviado el formulario de depósito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['monto_deposito'])) {
    $monto_deposito = $_POST['monto_deposito'];

    // Asegúrate de que el usuario haya iniciado sesión
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Insertar el depósito en la tabla movimientos con user_id
        $sql = "INSERT INTO movimientos (monto, tipo, user_id) VALUES (?, 'Depósito', ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('di', $monto_deposito, $user_id); // 'di' indica que son valores decimales y un entero (monto, user_id)
            $stmt->execute();

            // Actualizar el valor base restando el depósito
            $sql = "UPDATE valor_base SET monto_base = monto_base - ? WHERE user_id = $user_id ";
            $stmt2 = $conn->prepare($sql);

            if ($stmt2) {
                $stmt2->bind_param('d', $monto_deposito);
                $stmt2->execute();

                // Redireccionar a la página principal después de registrar el depósito
                header('Location: index.php');
                exit();
            } else {
                echo "Error en la consulta de actualización: " . $conn->error;
            }
        } else {
            echo "Error en la consulta de inserción: " . $conn->error;
        }
    } else {
        echo "No se ha iniciado sesión.";
    }
}
?>
