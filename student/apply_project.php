<?php
session_start();
include("../db.php");

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $admission_number = $_POST['admission_number'];
    $project_idea_1 = $_POST['project_idea_1'];
    $project_idea_2 = $_POST['project_idea_2'];

    $sql_insert = "INSERT INTO project_applications (student_name, phone, email, admission_number, project_idea_1, project_idea_2, status)
                   VALUES ('$student_name', '$phone', '$email', '$admission_number', '$project_idea_1', '$project_idea_2', 'pending')";

    if ($con->query($sql_insert) === TRUE) {
//        $message = "Application submitted successfully!";
        header("Location: my_applications.php");
    } else {
        $message = "Error: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Student area</title>
    <link rel="stylesheet" href="css/style.css"/>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div>

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>
    <!-- End Sidebar -->

    <!-- CONTENT -->
    <section id="content">
        <!-- Navbar/Header -->
        <?php include 'header.php'; ?>
        <!-- Navbar/Header -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Submit Project Application</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="#">Submit Application</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="container">
                <?php if (isset($message)) { echo "<p>$message</p>"; } ?>

                <input type="checkbox" id="check">
                <div class="login form"><br>
                    <form action="" method="POST">
                        <input type="text" name="student_name" placeholder="Student Name" required />
                        <input type="text" name="phone" placeholder="Phone" required />
                        <input type="email" name="email" placeholder="Email" required />
                        <input type="text" name="admission_number" placeholder="Admission Number" required />
                        <input type="text" name="project_idea_1" placeholder="1st Project Idea" required />
                        <input type="text" name="project_idea_2" placeholder="2nd Project Idea" required />
                        <input type="submit" value="Submit Application" />
                    </form>
                </div>
            </div>

        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

</div>

<?php
$con->close();
?>
<script src="js/scripts.js"></script>
</body>
</html>
