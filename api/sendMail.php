<?php
header("Access-Control-Allow-Origin: *");
//die(var_dump('No se puede acceder a este archivo directamente'));

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
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'iralajuan099@gmail.com'; // Configura tu email
    $mail->Password = 'nuerkapjxardorap'; // App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom($data->email, $data->name);
    $mail->addAddress('iralajuan099@gmail.com'); // Cambia al email que recibirá los mensajes
    $mail->Subject = 'Mensaje de Contacto: ' . $data->name;
    $mail->Body = "Nombre: {$data->name}\nEmail: {$data->email}\nTeléfono: {$data->phone}\nMensaje: {$data->message}";

    $mail->send();

    echo json_encode(["status" => "success", "message" => "Correo enviado"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $mail->ErrorInfo]);
}
?>
