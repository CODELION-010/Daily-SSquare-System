<?php
session_start();
include "../db/conexion_db.php";

// Función para procesar el inicio de sesión
function procesarLogin($conn, $email, $contrasena) {
    // Consulta para obtener los datos del usuario
    $sql = "SELECT user_id, nombre, email, password, telefono FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $usuario = $result->fetch_assoc();
            if (password_verify($contrasena, $usuario['password'])) {
                iniciarSesion($conn, $usuario);
                return true;
            } else {
                redirigirConError('clave');
            }
        } else {
            redirigirConError('email');
        }
    } else {
        throw new Exception("Error en la consulta: " . $conn->error);
    }
    return false;
}

// Función para iniciar la sesión y establecer variables de sesión
function iniciarSesion($conn, $usuario) {
    $_SESSION['email'] = $usuario['email'];
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['user_id'] = $usuario['user_id'];
    $_SESSION['telefono'] = $usuario['telefono'];

    // Obtener valor_base del usuario
    $_SESSION['monto_base'] = obtenerMontoBase($conn, $usuario['user_id']);

    // Obtener movimientos del usuario
    $_SESSION['movimientos'] = obtenerMovimientos($conn, $usuario['user_id']);

    // Redirigir a la página de inicio
    header('Location: index.php');
    exit();
}

// Función para obtener el monto_base del usuario
function obtenerMontoBase($conn, $user_id) {
    $sql = "SELECT monto_base FROM valor_base WHERE user_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['monto_base'] ?? 0;
    } else {
        throw new Exception("Error al obtener el monto_base: " . $conn->error);
    }
}

// Función para obtener los movimientos del usuario
function obtenerMovimientos($conn, $user_id) {
    $sql = "SELECT * FROM movimientos WHERE user_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        throw new Exception("Error al obtener los movimientos: " . $conn->error);
    }
}

// Función para redirigir con un error específico
function redirigirConError($error) {
    header("Location: ../index.php?error=$error");
    exit();
}

// Lógica principal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['contrasena'])) {
    try {
        procesarLogin($conn, $_POST['email'], $_POST['contrasena']);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>
