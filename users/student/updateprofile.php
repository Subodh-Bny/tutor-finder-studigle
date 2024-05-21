<?php
session_start();
$_SESSION['update_msg'] = "";
if (isset($_SESSION['user_id'])) {


    // Redirect if user role is not 'student' or if user ID is not set
    if ($_SESSION['user_role'] != 'student' || !isset($_SESSION['user_id'])) {
        header("Location: ../../registerationAndLogin/login.php");
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" || isset($_POST['update-btn'])) {

        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user_id = $_SESSION['user_id'];
        $userName = $_SESSION['user_name'];


        include "../../connection/connection.php";
        $sql = "UPDATE users SET name = ?, phone = ?, email = ?, password = ?  WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sissi", $name, $phone, $email, $password, $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['update_msg'] = "Profile updated successfully";

            $getUpdatedSql = "SELECT * from users where id = $user_id";


            $insertActivitySql = "INSERT INTO useractivity (user_id, activity_type, activity_details) VALUES (?, ?, ?)";
            $stmtInsertActivity = mysqli_stmt_init($con);
            if (!mysqli_stmt_prepare($stmtInsertActivity, $insertActivitySql)) {
                // Handle SQL statement preparation error
                exit("SQL statement preparation error");
            }
            $activityType = "Profile Update";
            $activityDetails = "$userName updated his profile";
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
    <link rel="stylesheet" href="./normalUser.css" />
    <link rel="stylesheet" href="../../public/utility.css" />
</head>

<body>
    <div class="main flex">
        <div class="menu">
            <div class="logo flex align-center justify-center">
                <a href="#" class="logo">
                    <img class="web-name" src="../../img/logo-text copy.png" alt="" />
                </a>
            </div>
            <div class="menu-cat flex">
                <ul>
                    <a href="./normalUser.php">
                        <li id="dashboard">Home</li>
                    </a>
                </ul>
                <form action=" ../../logout/logout.php" method="post" id="logout-form">

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
                        <img src="../../admin/images/profile.svg" />
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
                    <form class="update-container" method="POST"
                        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <label for="name">Name</label><br>
                        <input type="text" name="name" id="name"><br>
                        <label for="phone">Phone</label><br>
                        <input type="text" name="phone" id="phone"><br>
                        <label for="email">Email</label><br>
                        <input type="text" name="email" id="email"><br>
                        <label for="password">Password</label><br>
                        <input type="text" name="password" id="password"><br>
                        <button name="update-btn"
                            style="padding:5px;background-color:transparent; border:1px solid #644bb1; border-radius:5px; margin-top:5px;">Update</button><br>
                        <span style="color:green;">
                            <?php echo $_SESSION['update_msg'];
                            unset($_SESSION['update-msg']);
                            ?>
                        </span>
                        <br>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="./student.js"></script>

</body>

</html>