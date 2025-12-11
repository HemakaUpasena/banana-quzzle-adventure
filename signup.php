<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fullname = trim($_POST["fullname"]);
    $age      = intval($_POST["age"]);
    $email    = trim($_POST["email"]);
    $password = $_POST["password"];
 
// BASIC FIELD VALIDATION
   
    if (empty($fullname) || empty($email) || empty($password)) {
        echo "Please fill all required fields.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    
// PASSWORD VALIDATION
   
    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long.";
        exit;
    }

    if (!preg_match('/[A-Z]/', $password)) {
        echo "Password must contain at least one uppercase letter.";
        exit;
    }

    if (!preg_match('/[0-9]/', $password)) {
        echo "Password must contain at least one number.";
        exit;
    }

    if (!preg_match('/[\W_]/', $password)) {
        echo "Password must contain at least one symbol (e.g., @, #, !).";
        exit;
    }

    
// HASH PASSWORD BEFORE SAVING
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // INSERT USER INTO DATABASE
    
    $stmt = $conn->prepare("INSERT INTO users (fullname, age, email, password) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        echo "Prepare failed: " . $conn->error;
        exit;
    }

    $stmt->bind_param("siss", $fullname, $age, $email, $hashedPassword);

   if ($stmt->execute()) {
    $stmt->close();
    header("Location: login.html");
    exit;
} else {
    $stmt->close();
    echo "Signup failed. Reason: " . $stmt->error;
    exit;
}

}

$conn->close();
?>

