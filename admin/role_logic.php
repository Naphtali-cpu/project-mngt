<?php
require('../db.php');
session_start();

if (isset($_POST['name'])) {
    $name = stripslashes($_POST['name']);
    $name = mysqli_real_escape_string($con, $name);

    $type = stripslashes($_POST['type']);
    $type = mysqli_real_escape_string($con, $type);


    $create_datetime = date("Y-m-d H:i:s");

    $query = "INSERT INTO roles (name, type, created_at)
              VALUES ('$name', '$type', '$create_datetime')";

    $result = mysqli_query($con, $query);

    if ($result) {
        // Staff member added successfully
        $_SESSION['success'] = "Role has been added successfully!";
        header("Location: roles.php");
    } else {
        echo "An issue occurred while adding the srole!";
    }
} else {
    echo "Please fill in the form.";
}
?>
