<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $college_id = $_POST['college_id'];
    $name = $_POST['name'];
    $branch = $_POST['branch'];
    $academic_year = $_POST['academic_year'];
    // $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $password = $_POST['password'];

    $sql = "INSERT INTO students (college_id, name, branch, academic_year, password) VALUES ('$college_id', '$name', '$branch', '$academic_year', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        header("Location: login.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
