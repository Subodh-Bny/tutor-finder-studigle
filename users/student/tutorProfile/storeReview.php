<?php
session_start();
if ($_SESSION['user_role'] != 'student' || !isset($_SESSION['user_id'])) {
    header("Location: ../../../registerationAndLogin/login.php");
    exit;
}
include "../../../connection/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo "POSTED";
    if (!empty($_POST['ratingValue']) && !empty($_POST['ratingValue'])) {
        $rating = $_POST['ratingValue'];
        $review = $_POST['review'];

        // var_dump($_POST, $_SESSION);

        $tutor_user_id = $_SESSION['profile_tutor'];
        $student_user_id = $_SESSION['user_id'];






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

            //review show
            showRating($con);


        }
    } else if (empty($_POST['ratingValue'])) {
        $_SESSION['posted_msg'] = "Give rating before posting";
    } else if (empty($_POST['review'])) {
        $_SESSION['posted_msg'] = "Write review before posting";
    }
} else {
    echo "hi";
}

if (
    isset($_POST['btnValue'])
) {
    showRating($con);
}

function showRating($con)
{
    $get_tutor_id_sql = "SELECT tutor_id FROM tutor WHERE user_id = '" . $_SESSION['profile_tutor'] . "'";
    $get_tutor_res = mysqli_query($con, $get_tutor_id_sql);
    if ($get_tutor_res) {
        $get_tutor_id_row = mysqli_fetch_array($get_tutor_res);
        $tutor_unique_id = $get_tutor_id_row['tutor_id'];

        $getReviewSql = "SELECT * FROM ratings WHERE tutor_id = '$tutor_unique_id' order by rating desc";
        $reviewRes = mysqli_query($con, $getReviewSql);
        if ($reviewRes) {
            while ($getReviewRow = mysqli_fetch_array($reviewRes)) {
                $student_id = $getReviewRow['student_id'];
                $get_student_name_sql = "SELECT users.name from students join users on students.user_id = users.id where students.student_id = $student_id";

                $get_student_res = mysqli_query($con, $get_student_name_sql);
                if ($get_student_res) {

                    $student_row = mysqli_fetch_array($get_student_res);

                    echo "<div class='review'>
                            <div class='user-star'>
                                <h5>" .
                        $student_row['name'] . "
                                </h5><span class='rating-got'>
                                    (
                                  round(" . $getReviewRow['rating'] . ") &#9733;)
                                </span>
                            </div>
                            <div class='posted-review'>"
                        . $getReviewRow['review'] .
                        "</div>
                        </div>";
                }
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }

}
?>