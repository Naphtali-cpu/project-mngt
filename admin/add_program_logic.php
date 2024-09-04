<?php
require('../db.php');
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['name'], $_POST['code'], $_POST['department_id']) && !empty($_POST['department_id'])) {
    $name = stripslashes($_POST['name']);
    $name = mysqli_real_escape_string($con, $name);

    $code = stripslashes($_POST['code']);
    $code = mysqli_real_escape_string($con, $code);

    $department_id = stripslashes($_POST['department_id']);
    $department_id = mysqli_real_escape_string($con, $department_id);

    $create_datetime = date("Y-m-d H:i:s");

    $query = "INSERT INTO program (name, code, department_id, created_at)
              VALUES ('$name', '$code', '$department_id', '$create_datetime')";

    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['success'] = "Program has been added successfully!";
        header("Location: programs.php");
    } else {
        echo "An issue occurred while adding the program!";
    }
} else {
    echo "Please fill in the form.";
}
?>
