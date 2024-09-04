<?php
require('../db.php');
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['name'], $_POST['code'], $_POST['faculty_id']) && !empty($_POST['faculty_id'])) {
    $name = stripslashes($_POST['name']);
    $name = mysqli_real_escape_string($con, $name);

    $code = stripslashes($_POST['code']);
    $code = mysqli_real_escape_string($con, $code);

    $faculty_id = stripslashes($_POST['faculty_id']);
    $faculty_id = mysqli_real_escape_string($con, $faculty_id);

    $create_datetime = date("Y-m-d H:i:s");

    $query = "INSERT INTO department (name, code, faculty_id, created_at)
              VALUES ('$name', '$code', '$faculty_id', '$create_datetime')";

    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['success'] = "Department has been added successfully!";
        header("Location: department.php");
    } else {
        echo "An issue occurred while adding the department!";
    }
} else {
    echo "Please fill in the form.";
}
?>
