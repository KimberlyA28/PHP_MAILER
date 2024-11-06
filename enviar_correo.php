<?php
// Carga el archivo autoload.php de Composer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $destinatario = $_POST['email'];
    $asunto = $_POST['asunto'];
    $contenido = $_POST['contenido'];

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Servidor SMTP de tu proveedor de correo
        $mail->SMTPAuth   = true;
        $mail->Username   = 'lpareja972@gmail.com'; // Tu correo
        $mail->Password   = 'sgey mfai rark xzxw'; // Tu contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Configuración del email
        $mail->setFrom('lpareja972@gmail.com', 'Kimberly Altamirano - Senati'); // Tu correo con nombre profesional
        $mail->addAddress($destinatario); // Destinatario

        $mail->isHTML(true);
        $mail->Subject = $asunto;

        // Cuerpo del correo con diseño profesional
        $mail->Body    = "
        <html>
        <head>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background-color: #f8f8f8;
                    color: #333;
                    margin: 0;
                    padding: 0;
                }
                .email-container {
                    width: 100%;
                    background-color: #ffffff;
                    margin: 20px auto;
                    padding: 40px;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    max-width: 650px;
                    font-size: 16px;
                    line-height: 1.6;
                }
                h1 {
                    color: #1a73e8;
                    font-size: 30px;
                    text-align: center;
                    margin-bottom: 20px;
                }
                p {
                    font-size: 16px;
                    line-height: 1.6;
                    margin: 10px 0;
                }
                .footer {
                    text-align: center;
                    font-size: 12px;
                    color: #777;
                    margin-top: 30px;
                }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <h1>¡Nuevo Mensaje Recibido!</h1>
                <p><strong>Asunto:</strong> $asunto</p>
                <p><strong>Contenido:</strong></p>
                <p>$contenido</p>
                <a href='https://github.com/KimberlyA28/PHP_MAILER' class='btn btn-primary' target='_blank'>Ver detalles</a>
            </div>
            <div class='footer'>
                <p>&copy; 2024 Kimberly Altamirano - Senati. Todos los derechos reservados.</p>
            </div>
        </body>
        </html>
        ";

        // Correo en texto plano para clientes que no soportan HTML
        $mail->AltBody = strip_tags($contenido); 

        // Enviar correo
        if ($mail->send()) {
            // Redirecciona a la página con el mensaje de éxito
            header("Location: index.html?status=success");
        } else {
            // Redirecciona a la página con el mensaje de error
            header("Location: index.html?status=error");
        }
    } catch (Exception $e) {
        echo "No se pudo enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
