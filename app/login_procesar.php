<?php
session_start();
include "../db/conexion_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['contrasena'])) {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT user_id, nombre, email, password, telefono FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $usuario = $result->fetch_assoc();
            if (password_verify($contrasena, $usuario['password'])) {
                // Inicio de sesión exitoso, establece las variables de sesión
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['user_id'] = $usuario['user_id']; // Almacena el user_id en la sesión
                $_SESSION['telefono'] = $usuario['telefono'];
               
                // Ahora, obtén el valor_base del usuario
                $user_id = $usuario['user_id']; // Usa el user_id del usuario actual
                $sql_valor_base = "SELECT monto_base FROM valor_base WHERE user_id = ?";
                $stmt_valor_base = $conn->prepare($sql_valor_base);
                if ($stmt_valor_base) {
                    $stmt_valor_base->bind_param('i', $user_id);
                    $stmt_valor_base->execute();
                    $result_valor_base = $stmt_valor_base->get_result();
                    $valor_base = $result_valor_base->fetch_assoc();
                    $_SESSION['monto_base'] = $valor_base['monto_base'];
                }

                // Obtén los movimientos del usuario
                $sql_movimientos = "SELECT * FROM movimientos WHERE user_id = ?";
                $stmt_movimientos = $conn->prepare($sql_movimientos);
                if ($stmt_movimientos) {
                    $stmt_movimientos->bind_param('i', $user_id);
                    $stmt_movimientos->execute();
                    $result_movimientos = $stmt_movimientos->get_result();
                    $_SESSION['movimientos'] = $result_movimientos->fetch_all(MYSQLI_ASSOC);
                }

                // Redirige al usuario a la página de inicio (index.php)
                header('Location: index.php');
                exit();
            }else {//mensaje error clave incorrecta
                header('Location: ../index.php?error=clave');
            }
        } else {
            header('Location: ../index.php?error=email');
        }
    } else {
        echo "Error en la consulta: " . $conn->error;
    }
}

?>