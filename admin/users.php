<?php
//include auth_session.php file on all student panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin - Users</title>
    <link rel="stylesheet" href="css/style.css"/>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body>
<div class="grid-container">

    <!-- Header -->
    <?php include 'header.php'; ?>
    <!-- End Header -->

    <!-- Header -->
    <?php include 'sidebar.php'; ?>
    <!-- End Header -->

    <!-- Main -->
    <main class="main-container">
        <div class="main-title">
            <h2>Users</h2>

            <a href="add_user.php">
                <button class="completebtn">
                    Add User
                </button>
            </a>
        </div>

        <div class="table-container">
            <table class="content-table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>User Type</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include("../db.php");
                include("../auth_session.php");

                $query = "SELECT * FROM users";
                // Fetch inquiries from the database
                $resultUsers = mysqli_query($con, $query);

                // Check if there are any inquiries
                if (mysqli_num_rows($resultUsers) > 0) {
                    // Output each inquiry as a table row
                    while ($row = mysqli_fetch_assoc($resultUsers)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['role'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No users found.</td></tr>";
                }

                // Close the database connection
                mysqli_close($con);
                ?>
                </tbody>
            </table>
        </div>

    </main>
    <!-- End Main -->

</div>
<script src="js/scripts.js"></script>
</body>
</html>
`