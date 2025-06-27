<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'localhost';
    $mail->Port       = 1025; // Port utilisé par MailHog
    $mail->SMTPAuth   = false; // Pas besoin d'auth en local
    $mail->SMTPSecure = false;

    $mail->setFrom('test@example.com', 'Plateforme Stages');
    $mail->addAddress('candidat@example.com');

    $mail->Subject = 'Test mail';
    $mail->Body    = 'Ceci est un test d\'envoi local avec MailHog.';

    $mail->send();
    echo 'Message envoyé';
} catch (Exception $e) {
    echo "Erreur : {$mail->ErrorInfo}";
}
