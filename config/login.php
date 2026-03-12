<?php
session_start();
require_once "../config/dbcon.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM admin WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // DIRECT COMPARISON (plain text)
    if ($password === $user['password']) {
        $_SESSION['username'] = $username;
        header("Location: ../admin/student_dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = "Incorrect password.";
        header("Location: ../admin/login.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Username not found.";
    header("Location: ../admin/login.php");
    exit();
}
?>
