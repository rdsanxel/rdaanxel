<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $monto = $_POST['monto'];
    $plazo = $_POST['plazo'];
    $motivo = $_POST['motivo'];

    $mail = new PHPMailer(true);

    try {
        // Configuración SMTP de Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'TU_CORREO@gmail.com'; // cambia esto
        $mail->Password = 'TU_CONTRASEÑA_APP'; // una contraseña de aplicación, no tu clave normal
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Remitente y destinatario
        $mail->setFrom('TU_CORREO@gmail.com', 'Quiterio Crédito');
        $mail->addAddress('TU_CORREO@gmail.com');

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nueva solicitud de préstamo';
        $mail->Body = "
            <strong>Nombre:</strong> $nombre<br>
            <strong>Email:</strong> $email<br>
            <strong>Monto:</strong> $monto MXN<br>
            <strong>Plazo:</strong> $plazo meses<br>
            <strong>Motivo:</strong> $motivo
        ";

        $mail->send();
        echo "Mensaje enviado correctamente.";
    } catch (Exception $e) {
        echo "Error al enviar mensaje. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>