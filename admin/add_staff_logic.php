<?php
require('../db.php');
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['username'])) {
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con, $username);

    $mobile = stripslashes($_POST['mobile']);
    $mobile = mysqli_real_escape_string($con, $mobile);

    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($con, $email);

    $department = stripslashes($_POST['department']);
    $department = mysqli_real_escape_string($con, $department);

    $faculty = stripslashes($_POST['faculty']);
    $faculty = mysqli_real_escape_string($con, $faculty);

    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($con, $password);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $create_datetime = date("Y-m-d H:i:s");

    $query = "INSERT INTO users (username, mobile_number, email, password, department, faculty, created_at)
              VALUES ('$username', '$mobile', '$email', '$hashed_password', '$department', '$faculty', '$create_datetime')";

    $result = mysqli_query($con, $query);

    if ($result) {
        // Staff member added successfully
        $_SESSION['success'] = "Staff member has been added successfully!";
        header("Location: staff.php"); // Redirect to the dashboard or another appropriate page
    } else {
        echo "An issue occurred while adding the staff member!";
    }
} else {
    echo "Please fill in the form.";
}
?>
