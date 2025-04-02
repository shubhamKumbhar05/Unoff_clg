<?php
session_start();
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $college_id = $_POST['college_id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE college_id = '$college_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // if (password_verify($password, $row['password'])) {
        if($password==$row['password']){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['branch'] = $row['branch'];
            $_SESSION['academic_year'] = $row['academic_year'];
            $stu_name = $row['name'];
            // echo "<script>alert($_SESSION[user_id]);</script>";
            header("Location: dashboard.php");
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No such user found!";
    }
}
?>
