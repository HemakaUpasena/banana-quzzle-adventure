<?php
session_start();
include 'db_connect.php';

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Check credentials
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Generate 6-digit OTP
    $otp = rand(100000, 999999);

    // Save OTP and email to session
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;

    // Send OTP using PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hemakaupasena160998@gmail.com'; 
        $mail->Password = 'xsqurfgoobpevewb'; // 16-char app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender & recipient
        $mail->setFrom('hemakaupasena160998@gmail.com', 'Banana Puzzle Adventure');
        $mail->addAddress($email);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Your Banana Puzzle Adventure Verification Code';
        $mail->Body = "<h3>Your verification code is: <strong>$otp</strong></h3>";

        // Send email
        $mail->send();

        header("Location: verify_otp.php");

        exit();

    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    echo "❌ Invalid login credentials.";
}
?>



