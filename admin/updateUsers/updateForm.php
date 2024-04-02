<?php
session_start();
include "../../connection/connection.php";
$select_user_sql = "SELECT * from users where id = " . $_SESSION['update_user_id'];
$result = mysqli_query($con, $select_user_sql);


if ($result) {
    $row = mysqli_fetch_array($result);
} else {
    echo "Couldnot fetch  data";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Users</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Kanit:wght@300&family=Libre+Baskerville&family=Open+Sans&family=Poppins:wght@300&family=Roboto+Slab:wght@500&display=swap");
    </style>
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../utility.css" />
    <link rel="stylesheet" href="./updateForm.css">
</head>

<body>
    <div class="main flex">
        <div class="menu">
            <div class="logo flex align-center justify-center">
                <h2>Studigle</h2>
            </div>
            <div class="menu-cat flex">
                <ul>
                    <a href="../index.php" class="manage-link">
                        <li id="manage-users">Manage Users</li>
                    </a>
                </ul>
                <button>Settings</button>
            </div>
        </div>
        <div class="contents-container">
            <div class="nav">
                <h2>
                    <?php echo $row['name']; ?>
                </h2>
                <div class="nav-icons">

                    <div class="profile icons">
                        <img src="../images/profile.svg" />
                    </div>
                    <div class="profile-container">
                        <div class="profile-contents">
                            <h4>Hi, Admin</h4>
                            <hr />
                            Manage Profile
                            <br />
                            <form action="../../logout/logout.php" method="post">
                                <button type="submit" class="logout-btn">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-contents">
                <h2>Update</h2>
                <hr />
                <form action="./updatedata.php" method="POST">
                    <label for="name">Name</label><br>
                    <input id="name" name="name" type="text" value="<?php echo $row['name']; ?>">
                    <br>
                    <label for="phone">Phone</label><br>
                    <input id="phone" type="text" name="phone" value="<?php echo $row['phone']; ?>"><br>
                    <label for="email">Email</label><br>
                    <input id="email" type="text" name="email" value="<?php echo $row['email']; ?>"><br>

                    <?php if ($row['role'] == "student") {

                        $get_student_sql = "SELECT grade_level, subjects_needed from students where user_id = " . $row['id'];
                        $student_result = mysqli_query($con, $get_student_sql);
                        if ($student_result) {
                            $student_row = mysqli_fetch_array($student_result);
                            ?>

                            <label for="grade">Grade</label><br>
                            <input id="grade" type="text" name="grade" value="<?php echo $student_row['grade_level']; ?>">
                            <?php
                        }
                    } else if ($row['role'] == "tutor") {
                        $get_tutor_sql = "SELECT * from tutor where user_id = " . $row['id'];
                        $tutor_result = mysqli_query($con, $get_tutor_sql);
                        if ($tutor_result) {
                            $tutor_row = mysqli_fetch_array($tutor_result);
                            ?>

                                <label for="bio">Bio</label><br>
                                <textarea name="bio" id="bio" cols="30" rows="5"><?php echo $tutor_row['bio']; ?></textarea>
                                <br>
                                <label for="subjects">Subjects Taught</label>
                                <br>
                                <textarea name="subjects" id="subjects" cols="30"
                                    rows="3"><?php echo $tutor_row['subjects_taught']; ?></textarea>
                                <br>
                                <label for="availability">Availability</label>
                                <br>
                                <input type="text" name="availability" id="availability"
                                    value="<?php echo $tutor_row['availability']; ?>">
                                <br>
                                <label for="rate">Hourly Rate</label><br>
                                <input type="text" name="rate" id="rate" value="<?php echo $tutor_row['hourly_rate']; ?>">
                            <?php
                        }
                    }
                    $_SESSION['update_user_role'] = $row['role'];
                    ?>
                    <br>
                    <button type="submit" name="update">Update</button>
                    <br>

                    <?php
                    if (isset($_SESSION['update_msg'])) {
                        ?>
                        <span class="update_message" style="color:green;">
                            <?php
                            echo $_SESSION['update_msg'];
                            unset($_SESSION['update_msg']);
                    } else if (isset($_SESSION['error_update_msg'])) {
                        ?>
                                <span class="update_message" style="color:green;">
                                    ?>
                                    <?php
                                    echo $_SESSION['error_update_msg'];
                                    unset($_SESSION['error_update_msg']);

                    }
                    ?>
                        </span>

                </form>
            </div>
        </div>
    </div>
    <script src="./update.js"></script>
</body>

</html>