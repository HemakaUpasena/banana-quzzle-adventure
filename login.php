<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  $stmt = $conn->prepare("SELECT id, fullname, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
      echo "<script>alert('Welcome back, " . addslashes($row['fullname']) . "!'); window.location='levels.html';</script>";
    } else {
      echo "<script>alert('Incorrect password'); window.history.back();</script>";
    }
  } else {
    echo "<script>alert('No account found with that email'); window.history.back();</script>";
  }

  $stmt->close();
  $conn->close();
} else {
  header("Location: login.html");
  exit;
}
?>

