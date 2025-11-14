<?php
session_start();

if ($_POST['otp_input'] == $_SESSION['otp']) {
    $_SESSION['authenticated'] = true;
    unset($_SESSION['otp']); // prevent reuse
    header("Location: levels.html");
    exit();
} else {
    echo "❌ Incorrect code. Please try again.";
}
?>

