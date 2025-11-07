<?php
include 'db_connect.php'; // existing connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Gather and sanitize input
  $fullname = trim($_POST['fullname'] ?? '');
  $age = intval($_POST['age'] ?? 0);
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  // Server-side validation patterns
  $emailPattern = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
  $passwordPattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*!]).{8,}$/';

  // Validate email
  if (!preg_match($emailPattern, $email)) {
    echo "<script>alert('Invalid email format. Please use a valid email.'); window.history.back();</script>";
    exit;
  }

  // Validate password
  if (!preg_match($passwordPattern, $password)) {
    echo "<script>alert('Weak password. It must be at least 8 chars, include 1 uppercase, 1 number and 1 symbol.'); window.history.back();</script>";
    exit;
  }

  // Optional: additional validation (age > 0, fullname length)
  if ($age <= 0) {
    echo "<script>alert('Please enter a valid age.'); window.history.back();</script>";
    exit;
  }

  // Hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Use prepared statements to avoid SQL injection
  $stmt = $conn->prepare("INSERT INTO users (fullname, age, email, password) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("siss", $fullname, $age, $email, $hashedPassword);

  if ($stmt->execute()) {
    echo "<script>alert('Account created successfully!'); window.location='login.html';</script>";
  } else {
    // MySQL error (often duplicate email)
    echo "<script>alert('Error: Could not create account. Email might already be registered.'); window.history.back();</script>";
  }

  $stmt->close();
  $conn->close();
} else {
  // Not a POST
  header("Location: signup.html");
  exit;
}
?>

