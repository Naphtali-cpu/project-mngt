<?php
session_start();
include("../db.php");

// Get the current staff member's user ID from the session
$staff_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Staff area</title>
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
                    <h1>Assigned Students</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Assigned Students</a>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Students Assigned to Me</h3>
                        <i class='bx bx-search'></i>
                        <i class='bx bx-filter'></i>
                    </div>
                    <table>
                        <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Admission Number</th>
                            <th>1st Project Idea</th>
                            <th>2nd Project Idea</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        include("../db.php");

                        // Fetch students assigned to the logged-in staff member
                        $query = "SELECT student_name, phone, email, admission_number, project_idea_1, project_idea_2, status 
                                  FROM project_applications 
                                  WHERE staff_id = '$staff_id'";
                        $result = mysqli_query($con, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['student_name'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['admission_number'] . "</td>";
                                echo "<td>" . $row['project_idea_1'] . "</td>";
                                echo "<td>" . $row['project_idea_2'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No students assigned to you yet.</td></tr>";
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
