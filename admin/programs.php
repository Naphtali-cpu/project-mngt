<?php
session_start();
include("../db.php");

$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Programs area</title>
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
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Add Program</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>

                <a href="add_program.php" class="btn-download">
                    <i class='bx bxs-cloud-download' ></i>
                    <span class="text">Add Program</span>
                </a>

            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Program</h3>
                        <i class='bx bx-search' ></i>
                        <i class='bx bx-filter' ></i>
                    </div>
                    <table>
                        <thead>
                        <tr>
                            <th>Program Name</th>
                            <th>Code</th>
                            <th>Department Name</th>
                            <th>Date Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        include("../db.php");

                        $query = "SELECT program.name AS prog_name, program.code, department.name 
    AS department_name, program.created_at
                  FROM program
                  JOIN department ON program.department_id = department.id";
                        $result = mysqli_query($con, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['prog_name'] . "</td>";
                                echo "<td>" . $row['code'] . "</td>";
                                echo "<td>" . $row['department_name'] . "</td>";
                                echo "<td>" . date("d-m-Y", strtotime($row['created_at'])) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No program found.</td></tr>";
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
$conn->close();
?>
<script src="js/scripts.js"></script>
</body>
</html>
