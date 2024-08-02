<?php

session_start();



// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loginsh";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$title = $_POST['title'];
$content = $_POST['content'];
$firstname = $_POST['firstname']; 
$post_date = date('Y-m-d'); // Current date

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO posts (firstname, post_date, title, content) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $firstname, $post_date, $title, $content);

if ($stmt->execute()) {
    header("Location: dashboard.php?status=success");
    exit();
} else {
    header("Location: submit-post.html?status=error");
    exit();
}

$stmt->close();
$conn->close();
?>