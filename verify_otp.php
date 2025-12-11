<?php
session_start();
if(!isset($_SESSION['otp'])){
  header("Location: login.html");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Verify OTP</title>
  <style>
    body { background:#0b3d2e; color:white; text-align:center; padding-top:80px; font-family:Poppins; }
    input { padding:12px; border-radius:8px; width:180px; text-align:center; }
    button { padding:12px 20px; border-radius:8px; border:none; background:#ffbf00; cursor:pointer; }
  </style>
</head>
<body>

  <h2>Enter Your 6-Digit Code</h2>

  <form action="check_otp.php" method="POST">
    <input type="text" maxlength="6" name="otp_input" required /><br><br>
    <button type="submit">Verify</button>
  </form>

</body>
</html>

