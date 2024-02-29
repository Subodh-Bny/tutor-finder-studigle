<?php
session_start();
$_SESSION['update_msg'] = "";
if (isset($_SESSION['user_id'])) {
    if ($_SERVER['REQUEST_METHOD'] == "POST" || isset($_POST['update-btn'])) {
        $grade = $_POST['grade'];
        $user_id = $_SESSION['user_id'];
        $userName = $_SESSION['user_name'];

        include "../connection/connection.php";
        $sql = "UPDATE students SET grade_level = ? WHERE user_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("si", $grade, $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['update_msg'] = "Grade level updated successfully";

            $getUpdatedSql = "SELECT * from users where id = $user_id";


            $insertActivitySql = "INSERT INTO useractivity (user_id, activity_type, activity_details) VALUES (?, ?, ?)";
            $stmtInsertActivity = mysqli_stmt_init($con);
            if (!mysqli_stmt_prepare($stmtInsertActivity, $insertActivitySql)) {
                // Handle SQL statement preparation error
                exit("SQL statement preparation error");
            }
            $activityType = "Profile Update";
            $activityDetails = "$userName with updated his profile";
            mysqli_stmt_bind_param($stmtInsertActivity, "iss", $user_id, $activityType, $activityDetails);
            mysqli_stmt_execute($stmtInsertActivity);


        } else {
            echo "Failed to update grade level";
        }

        $stmt->close();
        $con->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../users/normalUser.css" />
    <link rel="stylesheet" href="../public/utility.css" />
</head>

<body>
    <div class="main flex">
        <div class="menu">
            <div class="logo flex align-center justify-center">
                <a href="#" class="logo">
                    <img class="web-name" src="../img/logo-text copy.png" alt="" />
                </a>
            </div>
            <div class="menu-cat flex">
                <ul>
                    <a href="../users/student/normalUser.php">
                        <li id="dashboard">Home</li>
                    </a>
                </ul>
                <form action=" ../logout/logout.php" method="post" id="logout-form">

                    <button name="logout">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                        </svg>Logout
                    </button>
                </form>
            </div>
        </div>
        <div class="contents-container">
            <div class="nav">
                <h2>
                    <?php echo $_SESSION['user_name']; ?>
                </h2>
                <div class="nav-icons">
                    <div class="profile icons">
                        <img src="../admin/images/profile.svg" />
                    </div>
                    <div class="profile-container">
                        <div class="profile-contents">
                            <h4>Settings</h4>
                            <ul class="setting-list">
                                <li><a href="#">Update Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-contents dashboard">
                <h2>Update Profile</h2>
                <hr />
                <div class="dash-container">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="update-form"
                        method="POST">
                        <label for="grade">Grade</label><br>
                        <input type="text" name="grade" id="grade"><br>
                        <span>
                            <?php echo $_SESSION['update_msg'];
                            unset($_SESSION['update-msg']);
                            ?>
                        </span>
                        <br>
                        <button type="submit" name="update-btn">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="../users/student/student.js"></script>
</body>

</html>