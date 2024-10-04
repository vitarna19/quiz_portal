<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['role'] == 'teacher') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $teacher_id = $_SESSION['user_id'];

    $sql = "INSERT INTO quizzes (title, description, due_date, teacher_id) 
            VALUES ('$title', '$description', '$due_date', '$teacher_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Quiz posted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
