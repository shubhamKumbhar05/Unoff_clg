
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - College Platform</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php include 'login.php'; echo $_SESSION['name']; ?>!</h2>
        <p>Your Branch: <?php echo $_SESSION['branch']; ?></p>
        <p>Your Academic Year: <?php echo $_SESSION['academic_year']; ?></p>

        <h3>Your Personal Library</h3>
        <form action="file_upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file_to_upload" required>
            <button type="submit">Upload File</button>
        </form>

        <h3>Uploaded Files</h3>
        <ul>
            <?php
            include 'db.php';
            $userId = $_SESSION['user_id'];
            $result = $conn->query("SELECT * FROM files WHERE student_id = '$userId'");
            while($file = $result->fetch_assoc()) {
                echo "<li>{$file['filename']}</li>";
            }
            ?>
            <a href="view_files.php"><button>View And Download</button></a>
        </ul>

        <!-- Logout Button -->
        <form method="POST">
            <button type="submit" name="lg_out">Logout</button>
        </form>
    </div>
</body>
</html>
<?php
    if(isset($_POST["lg_out"])) {
        header("Location: " . $_SERVER['PHP_SELF']);
    }
?>
