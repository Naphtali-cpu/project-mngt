<?php
session_start();
include("../db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $application_id = $_POST['application_id'];
    $staff_id = $_POST['staff_id'];

    // Update the project application with the assigned staff member and change status to 'assigned'
    $query = "UPDATE project_applications 
              SET staff_id = '$staff_id', status = 'assigned' 
              WHERE id = '$application_id'";

    if (mysqli_query($con, $query)) {
        $_SESSION['success_message'] = "Staff assigned successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to assign staff. Please try again.";
    }

    header("Location: project_applications.php");
    exit();
}

$con->close();
?>
