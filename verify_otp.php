<?php
session_start();
if (!isset($_SESSION['otp'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Verify Code - Banana Puzzle Adventure</title>
<style>
body {
  background: linear-gradient(135deg, #1b5e20, #388e3c);
  font-family: 'Poppins', sans-serif;
  text-align: center;
  color: white;
  margin-top: 100px;
}
input {
  padding: 10px;
  border-radius: 5px;
  border: none;
  font-size: 18px;
  width: 150px;
  text-align: center;
}
button {
  background-color: #ffeb3b;
  border: none;
  padding: 10px 20px;
  margin-top: 20px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: bold;
}
</style>
</head>
<body>
  <h2>🔐 Verify Your Email</h2>
  <p>Enter the 6-digit code sent to your email:</p>

  <form method="POST" action="check_otp.php">
    <input type="text" name="otp_input" maxlength="6" required><br>
    <button type="submit">Verify</button>
  </form>
</body>
</html>
