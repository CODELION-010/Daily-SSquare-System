<?php
// Incluir la librería de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Asegúrate de haber incluido el archivo de PHPMailer
require '../vendor/autoload.php';
include '../db/conexion_db.php';

function generarToken() {
    return bin2hex(random_bytes(16));  // Generar un token aleatorio
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];  // Obtener el email del formulario
    $token = generarToken();   // Generar un token único
    $expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));  // Fecha de expiración para el token

    // Verificar si el usuario existe
    $stmt = $conn->prepare("SELECT user_id FROM usuarios WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    if ($user_id) {
        // Insertar el token en la tabla reset_tokens
        $stmt = $conn->prepare("INSERT INTO reset_tokens (user_id, token, token_expira) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $user_id, $token, $expiracion);
        $stmt->execute();
        $stmt->close();

        // Crear enlace para el restablecimiento de contraseña
        $enlace = "http://localhost/cuadre_diario/app/reset_password.php?token=$token";  // Cambia 'tu-dominio.com' por tu dominio real
        // Configuración de PHPMailer para enviar el correo
        $mail = new PHPMailer(true);
        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Servidor SMTP de Gmail (cambia si usas otro servicio)
            $mail->SMTPAuth = true;
            $mail->Username = 'leoncybercafe2@gmail.com';  // Tu dirección de correo de Gmail
            $mail->Password = 'dgvt jevj ucfn coly';  // Contraseña de tu cuenta de correo (o contraseña de aplicación si usas verificación en dos pasos)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;  // Puerto adecuado para Gmail

            // Configurar el remitente y el destinatario
            $mail->setFrom('tu-email@gmail.com', 'Restablecer Contraseña D.S.S.');  // Remitente
            $mail->addAddress($email);  // Destinatario

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Restablecimiento de contraseña';
            $mail->Body    = "Haz clic en el siguiente enlace para restablecer tu contraseña: <a href='$enlace'>$enlace</a>";

            // Enviar el correo
            $mail->send();
            echo "Se ha enviado el enlace de restablecimiento a: $email";
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";  // En caso de error
        }
    } else {
        echo "No se encontró una cuenta con ese correo.";  // Si el correo no existe en la base de datos
    }
}
?>
