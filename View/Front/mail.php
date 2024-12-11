<?php
// Include PHPMailer classes
require 'C:/xampp/htdocs/Quiz/View/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/Quiz/View/PHPMailer/src/SMTP.php';
require 'C:/xampp/htdocs/Quiz/View/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'rimajelassi81@gmail.com'; 
        $mail->Password = 'fpvzjizjnjtoqqlw'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email content
        $mail->setFrom('rimajelassi81@gmail.com', 'Quiz System'); 
        $mail->addAddress($to); 
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Send the email
        $mail->send();
        echo "Email sent successfully!, ";
    } catch (Exception $e) {
        echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }
}

// Example usage
sendEmail('brtalel3@gmail.com', 'Quiz Results', '<h1>Congratulations !</h1><p>You scored 100% on your quiz.</p>');
?>
