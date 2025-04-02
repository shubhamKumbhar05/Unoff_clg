<?php
// Include database connection
include 'db.php';

// Check if a file ID is provided
if (isset($_GET['file_id'])) {
    $file_id = $_GET['file_id'];

    // Fetch file details from the database
    $sql = "SELECT * FROM files WHERE id = '$file_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filepath = $row['filepath'];
        $filename = $row['filename'];

        // Check if the file exists
        if (file_exists($filepath)) {
            // Set headers to initiate the download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . filesize($filepath));

            // Output the file content
            readfile($filepath);
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "Invalid file ID.";
    }
} else {
    echo "No file specified.";
}
?>
