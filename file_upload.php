<?php
// Start the session
session_start();

// Include database connection
include 'db.php';

// Check if the form is submitted and a file is uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file_to_upload'])) {
    
    // Define the target directory for uploads
    $target_dir = "uploads/";  // or use an absolute path as mentioned earlier
    $target_file = $target_dir . basename($_FILES["file_to_upload"]["name"]);
    
    // Check if the uploads directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create the directory if it doesn't exist
    }

    // Attempt to move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $target_file)) {
        // File has been successfully uploaded
        echo "The file " . basename($_FILES["file_to_upload"]["name"]) . " has been uploaded.";

        // Insert file details into the database if necessary
        $student_id = $_SESSION['user_id'];
        $filename = basename($_FILES["file_to_upload"]["name"]);
        $filepath = $target_file;
        
        $sql = "INSERT INTO files (student_id, filename, filepath) VALUES ('$student_id', '$filename', '$filepath')";
        
        if ($conn->query($sql) === TRUE) {
            echo "File details saved in the database.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // Error occurred during the file upload
        echo "Error uploading file!";
    }
}
?>
