<?php
session_start();
include 'db_connection.php'; // Make sure to create a file for database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Verify login
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'teacher') {
            header("Location: dashboard.php?role=teacher");
        } else {
            header("Location: dashboard.php?role=student");
        }
    } else {
        echo "Invalid login credentials.";
    }
}
?>
