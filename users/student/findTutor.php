<?php
session_start();

// Redirect if user role is not 'student' or if user ID is not set
if ($_SESSION['user_role'] != 'student' || !isset($_SESSION['user_id'])) {
    header("Location: ../../registerationAndLogin/login.php");
}
include '../../connection/connection.php';
if (isset($_POST['see-more'])) {
    $tutorid = $_POST['tutor_id'];
    $_SESSION['profile_tutor'] = $tutorid;

    header("Location: ./tutorProfile/tutorProfile.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <!-- External CSS files -->
    <link rel="stylesheet" href="./normalUser.css" />
    <link rel="stylesheet" href="../../public/utility.css" />
    <link rel="stylesheet" href="./findTutor.css">

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
                <?php include "../../components/studentAside.php"; ?>
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
                    <div class="profile icons user-profile">
                        <img src="../../admin/images/profile.svg" />
                    </div>
                    <!-- Profile Container -->
                    <div class="profile-container user-control hide ">
                        <div class="profile-contents">
                            <h4>Settings</h4>
                            <ul class="setting-list">
                                <li><a href="./updateprofile.php">Update Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="main-contents dashboard">
                <div class="header-container">
                    <h2>Find Tutor</h2>
                    <div class="input">
                        <h4>Select subject</h4>
                        <select name="subject" id="subject">
                            <option value="-1">Select...</option>
                            <?php
                            $get_subjects = "SELECT DISTINCT subject FROM subjects";
                            $subject_result = mysqli_query($con, $get_subjects);
                            if ($subject_result) {
                                while ($subjects = mysqli_fetch_assoc($subject_result)) {
                                    echo "<option value='" . $subjects['subject'] . "'>" . $subjects['subject'] . "</option>";
                                }
                            }
                            ?>


                        </select>
                        <button id="subject-submit">SEARCH</button>
                    </div>
                </div>

                <hr />
                <div class="find-container">

                    <?php
                    $sql = "SELECT users.name, users.id, tutor.image, ROUND(AVG(ratings.rating), 2) AS average FROM users LEFT JOIN tutor ON tutor.user_id = users.id LEFT JOIN ratings ON ratings.tutor_id = tutor.tutor_id WHERE role = 'tutor' GROUP BY users.name, users.id ORDER BY average DESC";
                    $result = mysqli_query($con, $sql);
                    
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="tutor">
                                <?php
                                // Display image if available
                                if (!empty($row['image'])) {

                                    echo '<img class="tutor-profile" src="../tutor/' . $row['image'] . '" alt="profile">';

                                } else {
                                    // Display a default image if no image is available
                                    echo '<img class="tutor-default" src="../../img/user.svg" alt="profile">';
                                }
                                ?>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                    <input type="hidden" name="tutor_id" value="<?php echo $row['id']; ?>">
                                    <span class="name">
                                        <?php echo $row['name'] ?>
                                    </span>
                                    <span class="avg-rating">
                                        Rating: <?php echo $row['average'] > 0 ? $row['average'] : 0; ?>
                                    </span>
                                    <button type="submit" name="see-more">See More</button>
                                </form>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>
            </div>



        </div>
    </div>

    <!-- External JavaScript file -->
    <script src="./profileBtn.js"></script>
    <script src="../../ajax/ajax.js"></script>
    <script src="./findTutor.js"></script>
</body>

</html>