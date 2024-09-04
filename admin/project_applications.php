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
                    <h1>Project Applications</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Applications</a>
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
                            <th>Student Name</th>
                            <th>1st Project Idea</th>
                            <th>2nd Project Idea</th>
                            <th>Status</th>
                            <th>Assign to Staff</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        include("../db.php");

                        $query = "SELECT id, student_name, project_idea_1, project_idea_2, status 
                                  FROM project_applications 
                                  WHERE status = 'pending'";
                        $result = mysqli_query($con, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['student_name'] . "</td>";
                                echo "<td>" . $row['project_idea_1'] . "</td>";
                                echo "<td>" . $row['project_idea_2'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>";
                                echo "<form action='assign_staff.php' method='post'>";
                                echo "<input type='hidden' name='application_id' value='" . $row['id'] . "' />";
                                echo "<select name='staff_id' required>";
                                echo "<option value=''>Select Staff</option>";

                                // Fetch staff members from users table where role is 'staff'
                                $staff_query = "SELECT * FROM users WHERE role = 'staff'";
                                $staff_result = mysqli_query($con, $staff_query);

                                if (mysqli_num_rows($staff_result) > 0) {
                                    while ($staff = mysqli_fetch_assoc($staff_result)) {
                                        echo "<option value='" . $staff['id'] . "'>" . $staff['username'] . "</option>";
                                    }
                                } else {
                                    echo "<option value='' disabled>No staff found</option>";
                                }

                                echo "</select>";
                                echo "<input type='submit' value='Assign' />";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No pending project applications found.</td></tr>";
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
