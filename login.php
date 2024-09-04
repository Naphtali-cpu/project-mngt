<?php
session_start();
require('db.php');

if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);

    $password = stripslashes($_REQUEST['password']);

    // Query to check the user in the database
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Start session and set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on user role
            if ($_SESSION['role'] == 'admin') {
                header("Location: admin/dashboard.php");
            } elseif ($_SESSION['role'] == 'staff') {
                header("Location: staff/dashboard.php");
            } else {
                // Redirect to a default page if role is not admin or staff
                header("Location: index.php");
            }
            exit(); // Ensure script stops after redirection
        } else {
            echo "<div class='form'>
            <h3>Incorrect Username/password.</h3><br/>
            <p class='link'>Click here to <a href='signin.html'>Login</a> again.</p>
            </div>";
        }
    } else {
        echo "<div class='form'>
            <h3>Invalid user.</h3><br/>
            <p class='link'>Click here to <a href='signin.html'>Login</a> again.</p>
            </div>";
    }
}
?>
