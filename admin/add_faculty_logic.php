<?php
require('../db.php');
session_start();

if (isset($_POST['name'])) {
    $name = stripslashes($_POST['name']);
    $name = mysqli_real_escape_string($con, $name);

    $code = stripslashes($_POST['code']);
    $code = mysqli_real_escape_string($con, $code);


    $create_datetime = date("Y-m-d H:i:s");

    $query = "INSERT INTO faculty (name, code, created_at)
              VALUES ('$name', '$code', '$create_datetime')";

    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['success'] = "Faculty has been added successfully!";
        header("Location: faculty.php");
    } else {
        echo "An issue occurred while adding the faculty!";
    }
} else {
    echo "Please fill in the form.";
}
?>
