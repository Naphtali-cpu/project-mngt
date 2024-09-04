<?php
session_start();
include("../db.php");

$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Admin area</title>
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
                            <a href="#">Add Staff</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>

                <a href="add_staff.php" class="btn-download">
                    <i class='bx bxs-cloud-download' ></i>
                    <span class="text">Add Staff</span>
                </a>

            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Staff Members</h3>
                        <i class='bx bx-search' ></i>
                        <i class='bx bx-filter' ></i>
                    </div>
                    <table>
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Faculty</th>
                            <th>Date Registered</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM users WHERE role='staff'";
                        $result = mysqli_query($con, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['username'] . "</p></td>";
                                echo "<td>" . $row['mobile_number'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['department'] . "</td>";
                                echo "<td>" . $row['faculty'] . "</td>";
                                echo "<td>" . date("d-m-Y", strtotime($row['created_at'])) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No staff members found.</td></tr>";
                        }
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
