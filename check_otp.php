<?php
session_start();

if ($_POST['otp_input'] == $_SESSION['otp']) {
    $_SESSION['authenticated'] = true;
    setcookie("username", $_SESSION['email'], time() + 86400, "/");
    unset($_SESSION['otp']);
    header("Location: levels.html");
    exit();
  }
 else {
    echo "❌ Incorrect code. Please try again.";
}
?>

