<?php
session_start();

// Redirect if user role is not 'student' or if user ID is not set
if ($_SESSION['user_role'] != 'student' || !isset($_SESSION['user_id'])) {
    header("Location: ../../registerationAndLogin/login.php");
}

include "../../connection/connection.php";

$student_user_id = $_SESSION['user_id'];
$get_accepted_sql = "SELECT r.*, users.name, users.phone, users.email, users.id, tut.bio FROM request r INNER JOIN users ON r.tutor_id = users.id INNER JOIN tutor tut ON tut.user_id = users.id WHERE r.student_id = $student_user_id AND r.status = 'accepted'";
$get_accepted_res = mysqli_query($con, $get_accepted_sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tutor</title>

    <!-- External CSS files -->
    <link rel="stylesheet" href="../tutor/updateform.css" />
    <link rel="stylesheet" href="../../public/utility.css" />
    <link rel="stylesheet" href="../tutor/students.css" />
</head>

<body>
    <div class="main flex">
        <!-- Menu -->
        <div class="menu">
            <div class="logo flex align-center justify-center">
                <a href="#" class="logo">
                    <img class="web-name" src="../../img/logo-text copy.png" alt="" />
                </a>
            </div>
            <div class="menu-cat flex">
                <?php include "../../components/studentAside.php" ?>
                <!-- Logout Form -->
                <form action="../../logout/logout.php" method="post" id="logout-form">
                    <button name="logout">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                        </svg>Logout</button>
                </form>
            </div>
        </div>

        <!-- Contents Container -->
        <div class="contents-container">
            <!-- Navigation -->
            <div class="nav">
                <h2>Welcome
                    <?php echo $_SESSION['user_name']; ?>
                </h2>
                <div class="nav-icons">
                    <!-- Profile Icon -->
                    <div class="profile icons">
                        <img src="../../admin/images/profile.svg" />
                    </div>
                    <!-- Profile Container -->
                    <div class="profile-container">
                        <div class="profile-contents">
                            <h4>Settings</h4>
                            <ul class="setting-list">
                                <li><a href="./updateForm.php">Update Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="main-contents dashboard">
                <h2>Your Tutors</h2>
                <hr />
                <div class="dash-container">
                    <!-- Dashboard content will go here -->
                    <?php
                    if ($get_accepted_res) {
                        while ($row = mysqli_fetch_array($get_accepted_res)) {
                            echo "<div class='student'>
                            <h3>" . $row['name'] . "</h3>
                            <div class='buttons'>
                            <a href='./message/messages.php'><button class='chat-open' data-chat-id='" . $row['tutor_id'] . "' >Say hi👋</button></a>
                            <button class='remove-tutor' data-request-id='" . $row['request_id'] . "'>Remove</button>
                            </div>
                            </div>";
                        }


                    } else {
                        echo mysqli_error($con);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- External JavaScript file -->
    <script src="../tutor/tutor.js"></script>
    <script src="../../ajax/ajax.js"></script>
    <script src="./yourTutors.js"></script>
</body>

</html>