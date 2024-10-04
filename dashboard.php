<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$role = $_GET['role'];

if ($role == 'teacher') {
    echo "<h2>Welcome Teacher</h2>";
    // Display the quiz and assignment post forms
    include 'post_quiz_form.html';
} else {
    echo "<h2>Welcome Student</h2>";
    // Display the available quizzes and submission form
    include 'submit_quiz_form.html';
}
?>
