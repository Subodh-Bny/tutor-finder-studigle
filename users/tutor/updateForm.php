<?php
session_start();

if ($_SESSION['user_role'] != 'tutor' || !isset($_SESSION['user_id'])) {
    header("Location: ../../registerationAndLogin/login.php");
    exit;
}

include "../../connection/connection.php";
$userid = $_SESSION['user_id'];
$_SESSION['message'] = "";

$sql = "SELECT *, t.tutor_id from users u join tutor t on t.user_id = u.id where id = $userid";
$result = mysqli_query($con, $sql);
if ($result) {
    $row = mysqli_fetch_array($result);
    $tutorId = $row['tutor_id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];

    $availability = $_POST['availability'];
    $rate = $_POST['rate'];
    $updatesql = "UPDATE users
    JOIN tutor ON users.id = tutor.user_id
    SET
        users.name = '$name',
        users.phone = '$phone',
        users.email = '$email',
        tutor.bio = '$bio',
        tutor.availability = '$availability',
        tutor.hourly_rate = '$rate',
        tutor.image = '$target_file'
    WHERE
        users.id = $userid AND tutor.user_id = $userid;"
    ;
    $update_res = mysqli_query($con, $updatesql);
    if ($_POST['subjects'] != -1) {
        $subject = $_POST['subjects'];
        $add_subject_sql = "INSERT into subjects(tutor_id, subject) values('$tutorId', '$subject')";
        $result_subject_create = mysqli_query($con, $add_subject_sql);
        if ($result_subject_create) {

        } else {
            $_SESSION['message'] = mysqli_error($con);
        }
    } else if ($_POST['subject_create'] != "") {
        $subject = $_POST['subject_create'];
        $add_subject_sql = "INSERT into subjects(tutor_id, subject) values('$tutorId', '$subject')";
        $result_subject_create = mysqli_query($con, $add_subject_sql);
        if ($result_subject_create) {

        } else {
            $_SESSION['message'] = mysqli_error($con);
        }
    }
    if ($update_res) {
        $_SESSION['message'] = "Updated Successfully";
        $affected_rows = $con->affected_rows;
        if ($affected_rows > 0) {
            $insertActivitySql = "INSERT INTO useractivity (user_id, activity_type, activity_details) VALUES (?, ?, ?)";
            $stmtInsertActivity = mysqli_stmt_init($con);
            if (!mysqli_stmt_prepare($stmtInsertActivity, $insertActivitySql)) {
                // Handle SQL statement preparation error
                exit("SQL statement preparation error");
            }
            $activityType = "Profile Update";
            $activityDetails = "$name updated his profile";
            mysqli_stmt_bind_param($stmtInsertActivity, "iss", $userid, $activityType, $activityDetails);
            mysqli_stmt_execute($stmtInsertActivity);
        }
    } else {
        $_SESSION['message'] = mysqli_error($con);
    }



}

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update</title>

    <!-- External CSS files -->
    <link rel="stylesheet" href="./updateform.css" />
    <link rel="stylesheet" href="../../public/utility.css" />
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
                <ul>
                    <a href="./tutor.php">
                        <li id="dashboard">Home</li>

                    </a>

                </ul>
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
                                <li><a href="#">Update Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="main-contents dashboard">
                <h2>Update Profile</h2>
                <hr />
                <div class="dash-container">
                    <!-- Dashboard content will go here -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
                        enctype="multipart/form-data">
                        Select image to upload:
                        <input type="file" name="image" id="image">
                        <label for="name">Name</label><br>
                        <input id="name" name="name" type="text" value="<?php echo $row['name']; ?>">
                        <br>
                        <label for="phone">Phone</label><br>
                        <input id="phone" type="text" name="phone" value="<?php echo $row['phone']; ?>"><br>
                        <label for="email">Email</label><br>
                        <input id="email" type="text" name="email" value="<?php echo $row['email']; ?>"><br>
                        <label for="bio">Bio</label><br>
                        <textarea name="bio" id="bio" cols="30" rows="5"><?php echo $row['bio']; ?></textarea>
                        <br>
                        <label for="subjects">Subjects Taught</label>
                        <br>
                        <label for="select-subjects" style="font-size:1
                        50px;">Select from existing Subjects</label><br>
                        <select name="subjects" id="select-subjects">
                            <option value="-1">Select</option>
                            <?php /* echo $row['subjects_taught']; */
                            $subject_sql = "SELECT distinct subject from subjects ";
                            $subject_res = mysqli_query($con, $subject_sql);
                            if ($subject_res) {
                                while ($subjects = mysqli_fetch_assoc($subject_res)) {
                                    echo "<option value='" . $subjects['subject'] . "'>" . $subjects['subject'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <br>
                        <label for="create-subject" style="font-size:1
                        50px;">Or Create one</label><br>

                        <input type="text" id="create-subject" name="subject_create">

                        <br>
                        <label for="availability">Availability</label>
                        <br>
                        <input type="text" name="availability" id="availability"
                            value="<?php echo $row['availability']; ?>">
                        <br>
                        <label for="rate">Hourly Rate</label><br>
                        <input type="text" name="rate" id="rate" value="<?php echo $row['hourly_rate']; ?>">
                        <br>
                        <button type="submit" name="submit">Update</button>
                        <br>
                        <span>
                            <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            ?>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- External JavaScript file -->
    <script src="./tutor.js"></script>
</body>

</html>