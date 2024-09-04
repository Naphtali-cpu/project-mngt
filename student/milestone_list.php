<?php
session_start();
include("../db.php");

// Get the current student ID from the session
$student_id = $_SESSION['user_id'];

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
                    <h1>My Milestones</h1>
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

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Milestons</h3>
                    </div>
                    <?php
                    $query = "SELECT * FROM milestones WHERE student_id = '$student_id'";
                    $result = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div>";
                        echo "<h3>" . $row['title'] . "</h3>";
                        echo "<p>" . $row['description'] . "</p>";
                        echo "<p>Status: " . $row['status'] . "</p>";

                        if ($row['status'] != 'Complete') {
                            echo "<form action='update_milestone.php' method='post' enctype='multipart/form-data'>";
                            echo "<input type='hidden' name='milestone_id' value='" . $row['id'] . "' />";
                            echo "<select name='status'>";
                            echo "<option value='To Do' " . ($row['status'] == 'To Do' ? 'selected' : '') . ">To Do</option>";
                            echo "<option value='In Progress' " . ($row['status'] == 'In Progress' ? 'selected' : '') . ">In Progress</option>";
                            echo "<option value='Complete' " . ($row['status'] == 'Complete' ? 'selected' : '') . ">Complete</option>";
                            echo "</select>";
                            echo "<input type='file' name='screenshot' />";
                            echo "<input type='submit' value='Update' />";
                            echo "</form>";
                        }

                        if (!empty($row['screenshot'])) {
                            echo "<img src='uploads/" . $row['screenshot'] . "' alt='Screenshot' />";
                        }

                        echo "</div>";
                    }
                    ?>
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
