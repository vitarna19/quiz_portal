<?php
// Include your database connection file
include 'db_connection.php';  // Make sure to create this file

// Enable error reporting (useful for debugging; disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Directory where the file will be uploaded
    $target_dir = "uploads/";
    // Path of the file to be uploaded
    $target_file = $target_dir . basename($_FILES["assignment-file"]["name"]);

    // Ensure the uploads folder exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create uploads directory if it doesn't exist
    }

    // Check if the file is a PDF
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($fileType != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        exit;
    }

    // Check for upload errors
    if ($_FILES["assignment-file"]["error"] != 0) {
        echo "Error uploading the file. Error Code: " . $_FILES["assignment-file"]["error"];
        exit;
    }

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($_FILES["assignment-file"]["tmp_name"], $target_file)) {
        // Store file name and path into the database
        $file_name = basename($_FILES["assignment-file"]["name"]);
        $file_path = $target_file;
        $uploaded_at = date('Y-m-d H:i:s'); // Get current date and time

        // Insert file details into the database
        $sql = "INSERT INTO pdf_uploads (file_name, file_path, uploaded_at) VALUES ('$file_name', '$file_path', '$uploaded_at')";

        if ($conn->query($sql) === TRUE) {
            echo "The file " . htmlspecialchars($file_name) . " has been uploaded and saved in the database.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    // If the upload process fails, show this message
    echo "Task failed.";
}

// Close the database connection
$conn->close();
?>
