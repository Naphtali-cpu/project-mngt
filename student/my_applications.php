<?php
session_start();
include("../db.php");

$user_id = $_SESSION['user_id'];

// Fetch the student's email or ID to filter their applications
$student_email = $_SESSION['email'];

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
                    <h1>My Project Applications</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">My Applications</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Project Applications</h3>
                        <i class='bx bx-search'></i>
                        <i class='bx bx-filter'></i>
                    </div>
                    <table>
                        <thead>
                        <tr>
                            <th>1st Project Idea</th>
                            <th>2nd Project Idea</th>
                            <th>Status</th>
                            <th>Date Submitted</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        include("../db.php");

                        // Fetch the student's project applications
                        $query = "SELECT project_idea_1, project_idea_2, status, created_at 
                                  FROM project_applications 
                                  WHERE email='$student_email'";
                        $result = mysqli_query($con, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['project_idea_1'] . "</td>";
                                echo "<td>" . $row['project_idea_2'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>" . date("d-m-Y", strtotime($row['created_at'])) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No project applications found.</td></tr>";
                        }

                        $con->close();
                        ?>
                        </tbody>
                    </table>

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
