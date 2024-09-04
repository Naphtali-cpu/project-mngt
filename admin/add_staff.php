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

            </div>

            <div class="container">
            <input type="checkbox" id="check">
            <div class="login form"><br>
                <form action="add_staff_logic.php" method="post">
                    <input type="text"  name="username" placeholder="Username" required />
                    <input type="text"  name="mobile" placeholder="Mobile Number" required />
                    <input type="text"  name="email" placeholder="Email Address">
                    <input type="text"  name="department" placeholder="Department">
                    <input type="text"  name="faculty" placeholder="Faculty">
                    <input type="password"  name="password" placeholder="Password">
                    <input type="submit" name="submit" value="Add Staff" >
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
