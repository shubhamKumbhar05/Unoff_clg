<?php
// Start the session
session_start();

// Include database connection
include 'db.php';

// Fetch the list of files uploaded by the logged-in student
$student_id = $_SESSION['user_id'];  // Ensure that the student is logged in
$sql = "SELECT * FROM files WHERE student_id = '$student_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Your Uploaded Files:</h2>";
    while($row = $result->fetch_assoc()) {
        echo "<p>";
        echo "File: " . $row['filename'] . " ";
        echo "<a href='download.php?file_id=" . $row['id'] . "'>Download</a>";
        echo "</p>";
    }
} else {
    echo "No files found!";
}
?>
