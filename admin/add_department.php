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
                            <a href="#">Add Department</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="container">
                <input type="checkbox" id="check">
                <div class="login form"><br>
                    <form action="add_department_logic.php" method="post">
                        <input type="text"  name="name" placeholder="Department Name" required />
                        <input type="text"  name="code" placeholder="Department Code" required />

                        <select name="faculty_id" id="faculty_id">
                            <option value="">Select Faculty</option>
                            <?php
                            include("../db.php");

                            $sql_fetch_users = "SELECT id, name FROM faculty";
                            $result = $con->query($sql_fetch_users);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $faculty_id = $row['id'];
                                    $faculty_name = $row['name'];
                                    echo "<option value='$faculty_id'>$faculty_name</option>";
                                }
                            } else {
                                echo "<option value='' disabled>No faculty found</option>";
                            }

                            $con->close();
                            ?>
                        </select>
                        <input type="submit" name="submit" value="Add Department" >
                    </form>

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
