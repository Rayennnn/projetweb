<?php
// Include PHPMailer classes
require 'C:/xampp/htdocs/Quiz/View/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/Quiz/View/PHPMailer/src/SMTP.php';
require 'C:/xampp/htdocs/Quiz/View/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($to, $subject, $message, $score, $rating) {
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

        // Get the appropriate message and image based on score
        $motivationMessage = '';
        $imageUrl = '';
        
        if ($score >= 4) {
            $motivationMessage = "Excellent! You're highly motivated! 🌟";
            $imageUrl = "https://localhost/Quiz/View/Front/image.jpg";
        } elseif ($score >= 2) {
            $motivationMessage = "You're not motivated yet 😞, but we got you!";
            $imageUrl = "https://localhost/Quiz/View/Front/image1.jpg";
        } else {
            $motivationMessage = "Not motivated at all? No worries, you're in good hands!";
            $imageUrl = "https://localhost/Quiz/View/Front/image2.jpg";
        }

        // Create dynamic email body
        $emailBody = '
        <html>
        <head>
            <style>
                .email-container {
                    font-family: Arial, sans-serif;
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    line-height: 1.6;
                }
                .header {
                    color: #2c3e50;
                    font-size: 24px;
                    margin-bottom: 20px;
                }
                .content {
                    color: #34495e;
                    margin-bottom: 20px;
                }
                .rating-section {
                    margin: 15px 0;
                    padding: 10px;
                    background-color: #f8f9fa;
                    border-radius: 5px;
                }
                .rating-stars {
                    color: #ffd700;
                    font-size: 24px;
                    margin: 10px 0;
                }
                .rating-text {
                    color: #2c3e50;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div class="email-container">
                <div class="header">
                    Quiz Results
                </div>
                <div class="content">
                    <p>Dear User,</p>
                    
                    <p>Thank you for participating in the quiz! Here\'s your result:</p>
                    
                    <p><strong>Your Score: ' . $score . '</strong></p>
                    
                    <p><strong>' . $motivationMessage . '</strong></p>
                    
                    <div class="rating-section">
                        <p class="rating-text">Your Rating: ' . $rating . ' out of 5</p>
                        <div class="rating-stars">' . str_repeat('★', $rating) . str_repeat('☆', 5 - $rating) . '</div>
                    </div>
                    
                    <img src="' . $imageUrl . '" alt="Result Image" class="result-image">
                    
                    <p>We hope you found this quiz helpful in assessing your motivation level!</p>
                </div>
                <div class="footer">
                    <p>Best regards,<br>
                    Quiz Team</p>
                </div>
            </div>
        </body>
        </html>';

        // Email content
        $mail->setFrom('rimajelassi81@gmail.com', 'Quiz System'); 
        $mail->addAddress($to); 
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $emailBody;

        // Send the email
        $mail->send();
        echo "Email sent successfully!";
    } catch (Exception $e) {
        echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = $_POST['email'];
    $message = $_POST['message'];
    $score = $_POST['score'];
    $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
    
    sendEmail(
        $to,
        'Your Quiz Results',
        $message,
        $score,
        $rating
    );
}
?>