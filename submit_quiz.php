<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['role'] == 'student') {
    $quiz_id = $_POST['quiz_id'];
    $submission = $_POST['submission'];
    $student_id = $_SESSION['user_id'];

    $sql = "INSERT INTO submissions (quiz_id, student_id, submission, submission_date)
            VALUES ('$quiz_id', '$student_id', '$submission', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Submission successful!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
