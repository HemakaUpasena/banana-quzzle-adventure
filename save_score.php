<?php
include 'db_connect.php';

// Get JSON data from frontend (game.html)
$data = json_decode(file_get_contents("php://input"), true);

// Extract variables from the received JSON
$username = $data['username'];
$level_name = $data['level'];
$time_left = $data['score_time'];
$points = $data['points'];

// Insert into the 'score' table
$sql = "INSERT INTO score (username, level_name, time_left, points)
        VALUES ('$username', '$level_name', '$time_left', '$points')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

$conn->close();
?>
