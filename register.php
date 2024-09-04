<?php
require('db.php');
session_start();

$_SESSION['success'] = "";

if (isset($_REQUEST['username'])) {
    $username = stripslashes($_REQUEST['username']);

    $email = stripslashes($_REQUEST['email']);

    $mobile = stripslashes($_REQUEST['mobile']);

    $program = stripslashes($_REQUEST['program']);

    $password = stripslashes($_REQUEST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $create_datetime = date("Y-m-d H:i:s");

    $query = "INSERT into `students` (username, mobile_number, email, program, password, created_at)
              VALUES ('$username', '$mobile', '$email', '$program', '$hashed_password', '$create_datetime')";

    $result = mysqli_query($con, $query);

    if ($result) {
        // Retrieve the student's ID after registration
        $student_id = mysqli_insert_id($con);

        // Storing student ID in session variable
        $_SESSION['student_id'] = $student_id;



        header("Location: signin.html");
    } else {
        echo "An issue occurred with registering!";
    }
}
?>