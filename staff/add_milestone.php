<?php
session_start();
include("../db.php");

$staff_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql_insert = "INSERT INTO milestones (student_id, staff_id, title, description, status)
                   VALUES ('$student_id', '$staff_id', '$title', '$description', 'To Do')";

    if ($con->query($sql_insert) === TRUE) {
        header("Location: milestones.php");
    } else {
        $message = "Error: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Staff Area</title>
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
                    <h1>Create and Assign Milestones</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Milestones</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="container">
                <?php if (isset($message)) { echo "<p>$message</p>"; } ?>

                <input type="checkbox" id="check">
                <div class="login form"><br>
                    <form action="" method="POST">
                        <select name="student_id" required>
                            <option value="">Select Student</option>
                            <?php
                            $query = "SELECT id, student_name FROM project_applications WHERE staff_id = '$staff_id'";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['student_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <input type="text" name="title" placeholder="Milestone Title" required />
                        <textarea name="description" placeholder="Milestone Description" required></textarea>
                        <input type="submit" value="Create Milestone" />
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
