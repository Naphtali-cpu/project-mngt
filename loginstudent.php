<?php
require('db.php');
session_start();

if (isset($_POST['username'])) {
    $username = stripslashes($_POST['username']);

    $password = stripslashes($_POST['password']);

    // Check if the username exists
    $query = "SELECT * FROM students WHERE username='$username'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['student_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['success'] = "You are logged in!";

            header("Location: student/dashboard.php"); // Redirect to a dashboard page
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }
} else {
    echo "Please fill in the form.";
}
?>
