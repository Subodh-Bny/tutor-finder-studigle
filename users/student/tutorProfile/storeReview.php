<?php
session_start();
if ($_SESSION['user_role'] != 'student' || !isset($_SESSION['user_id'])) {
    header("Location: ../../../registerationAndLogin/login.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo "POSTED";
    if (!empty($_POST['ratingValue']) && !empty($_POST['ratingValue'])) {
        $rating = $_POST['ratingValue'];
        $review = $_POST['review'];

        // var_dump($_POST, $_SESSION);

        $tutor_user_id = $_SESSION['profile_tutor'];
        $student_user_id = $_SESSION['user_id'];



        include "../../../connection/connection.php";


        $tutoridSql = "SELECT tutor_id from tutor where user_id = $tutor_user_id";
        $tutor_id_res = mysqli_query($con, $tutoridSql);
        if ($tutor_id_res) {
            $tutor_id_row = mysqli_fetch_array($tutor_id_res);
        }

        $studentidsql = "SELECT student_id from students where user_id = $student_user_id";
        $student_id_res = mysqli_query($con, $studentidsql);

        if ($student_id_res) {
            $student_id_row = mysqli_fetch_array($student_id_res);

        }

        $tutor_id = $tutor_id_row['tutor_id'];
        $student_id = $student_id_row['student_id'];

        $ratingSql = "INSERT into ratings(tutor_id, student_id, rating, review) values('$tutor_id', '$student_id', '$rating', '$review')";

        $rating_res = mysqli_query($con, $ratingSql);
        if ($rating_res) {
            $_SESSION['posted_msg'] = "review Posted";

        }
    } else if (empty($_POST['ratingValue'])) {
        $_SESSION['posted_msg'] = "Give rating before posting";
    } else if (empty($_POST['review'])) {
        $_SESSION['posted_msg'] = "Write review before posting";
    }
} else {
    echo "hi";
}
?>