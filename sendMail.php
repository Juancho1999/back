<?php
header("Access-Control-Allow-Origin: *");
die(var_dump('No se puede acceder a este archivo directamente'));

// Habilitar reporte de errores (ideal en desarrollo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Cargar el autoload de Composer
require DIR . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Crear instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.tuservidor.com'; // Reemplaza con tu servidor SMTP, por ejemplo: smtp.gmail.com
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tu_correo@ejemplo.com'; // Tu dirección de correo
    $mail->Password   = 'tu_contraseña';           // Tu contraseña
    // Define el método de encriptación: 'tls' para el puerto 587 o 'ssl' para el puerto 465
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port       = 587; // Cambia al puerto 465 si usas SSL

    // Configurar remitente y destinatario(s)
    $mail->setFrom('tu_correo@ejemplo.com', 'Tu Nombre');
    $mail->addAddress('destinatario@ejemplo.com', 'Nombre Destinatario');
    // Si necesitas enviar a varios destinatarios, usa:
    // $mail->addAddress('otro@ejemplo.com');

    // Contenido del correo
    $mail->isHTML(true); // El correo se enviará en HTML
    $mail->Subject = 'Asunto del correo';
    $mail->Body    = '<h1>Hola</h1><p>Este es un correo de prueba enviado desde el backend.</p>';
    $mail->AltBody = 'Hola, este es un correo de prueba enviado desde el backend.';

    // Enviar el correo
    $mail->send();
    echo 'El mensaje se envió correctamente.';
} catch (Exception $e) {
    echo "El mensaje no se pudo enviar. Error de PHPMailer: {$mail->ErrorInfo}";
}