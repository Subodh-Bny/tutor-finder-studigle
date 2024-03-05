<?php
session_start();
$_SESSION['posted_msg'] = "";

// Redirect if user role is not 'student' or if user ID is not set
if ($_SESSION['user_role'] != 'student' || !isset($_SESSION['user_id'])) {
    header("Location: ../../../registerationAndLogin/login.php");
}







include "../../../connection/connection.php";

$tutorid = $_SESSION['profile_tutor'];

$tutorSql = "SELECT users.phone, users.email, users.name, tutor.bio, tutor.subjects_taught, tutor.availability, tutor.hourly_rate
     from users join tutor
     on users.id = tutor.user_id
     where users.id = $tutorid and tutor.user_id = $tutorid";
$tutor_result = mysqli_query($con, $tutorSql);

if ($tutor_result) {
    $tutor_row = mysqli_fetch_array($tutor_result);
} else {
    echo mysqli_error($con);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <!-- External CSS files -->
    <link rel="stylesheet" href="../normalUser.css" />
    <link rel="stylesheet" href="../../../public/utility.css" />
    <link rel="stylesheet" href="./tutorProfile.css">


</head>

<body>
    <div class="main flex">
        <!-- Menu -->
        <div class="menu">
            <div class="logo flex align-center justify-center">
                <a href="#" class="logo">
                    <img class="web-name" src="../../../img/logo-text copy.png" alt="" />
                </a>
            </div>
            <div class="menu-cat flex">
                <ul>
                    <a href="../normalUser.php">
                        <li id="dashboard">Home</li>
                    </a>
                    <a href="../findTutor.php">
                        <li id="find-tutor">Find Tutor</li>
                    </a>
                </ul>
                <!-- Logout Form -->
                <form action="../../../logout/logout.php" method="post" id="logout-form">
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
                        <img src="../../../admin/images/profile.svg" />
                    </div>

                    <div class="profile-container user-control hide ">
                        <div class="profile-contents">
                            <h4>Settings</h4>
                            <ul class="setting-list">
                                <li><a href="../../../update/updateprofile.php">Update Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="main-contents dashboard">
                <div class="tutor-actions">
                    <h1>
                        <?php echo $tutor_row['name']; ?>
                    </h1>
                    <div class="action-btn">
                        <button class="rating-btn">Rating And Review</button>
                        <button class="request">Request</button>

                    </div>
                </div>
                <hr />
                <article class="tutor-profile-container">
                    <h2>Bio</h2>
                    <br>
                    <p>
                        <?php echo $tutor_row['bio']; ?>
                    </p>
                    <br>
                    <hr>
                    <h2>Subjects Taught</h2>
                    <br>
                    <p>
                        <?php echo $tutor_row['subjects_taught']; ?>
                    </p>
                    <br>
                    <hr>
                    <h2>Contacts</h2>
                    <br>
                    <p>Phone:
                        <?php echo $tutor_row['phone']; ?>
                    </p>
                    <p>Email:
                        <?php echo $tutor_row['email']; ?>
                    </p>
                    <hr>
                    <h2>Availability</h2>
                    <br>
                    <p>
                        <?php echo $tutor_row['availability']; ?>
                    </p>
                    <hr>
                    <h2>Hourly rate</h2>
                    <br>
                    <p>
                        <?php echo $tutor_row['hourly_rate']; ?>
                    </p>
                </article>
                <div class="review-wrapper hide">
                    <div class="reviews-container">
                        <h2>Reviews</h2>
                        <hr>
                        <img src="../../../img/x.svg" alt="cross" class="hide-container">
                        <div class="reviews">
                            <?php
                            $get_tutor_id_sql = "SELECT tutor_id FROM tutor WHERE user_id = '$tutorid'";
                            $get_tutor_res = mysqli_query($con, $get_tutor_id_sql);
                            if ($get_tutor_res) {
                                $get_tutor_id_row = mysqli_fetch_array($get_tutor_res);
                                $tutor_unique_id = $get_tutor_id_row['tutor_id'];

                                $getReviewSql = "SELECT * FROM ratings WHERE tutor_id = '$tutor_unique_id'";
                                $reviewRes = mysqli_query($con, $getReviewSql);
                                if ($reviewRes) {
                                    while ($getReviewRow = mysqli_fetch_array($reviewRes)) {
                                        $student_id = $getReviewRow['student_id'];
                                        $get_student_name_sql = "SELECT users.name from students join users on students.user_id = users.id where students.student_id = $student_id";

                                        $get_student_res = mysqli_query($con, $get_student_name_sql);
                                        if ($get_student_res) {

                                            $student_row = mysqli_fetch_array($get_student_res);

                                            ?>
                                            <div class="review">
                                                <div class="user-star">
                                                    <h5>
                                                        <?php echo $student_row['name']; ?>
                                                    </h5><span class="rating-got">
                                                        (
                                                        <?php echo $getReviewRow['rating']; ?> &#9733;)
                                                    </span>
                                                </div>
                                                <div class="posted-review">
                                                    <?php echo $getReviewRow['review']; ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($con);
                                }
                            } else {
                                echo "Error: " . mysqli_error($con);
                            }
                            ?>
                        </div>
                        <form class="review-enter" method="POST" id="reviewForm" onsubmit="">
                            <div class="rating" id="ratingStars">
                                <i class="fa-solid fa-star" data-value="1"></i>
                                <i class="fa-solid fa-star" data-value="2"></i>
                                <i class="fa-solid fa-star" data-value="3"></i>
                                <i class="fa-solid fa-star" data-value="4"></i>
                                <i class="fa-solid fa-star" data-value="5"></i>
                            </div>
                            <input type="hidden" name="ratingValue" id="ratingValue">
                            <div class="review-post">
                                <input type="text" name="review" id="review" />
                                <button name="post" type="submit">Post</button>

                            </div>
                            <br>
                            <span id="post-msg">

                            </span>
                        </form>
                    </div>
                </div>

            </div>



        </div>
    </div>

    <!-- External JavaScript file -->
    <script src="../profileBtn.js"></script>
    <script src="tutorProfile.js"></script>
    <script src="https://kit.fontawesome.com/1a3756e774.js" crossorigin="anonymous"></script>
</body>

</html>