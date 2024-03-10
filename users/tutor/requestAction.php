<?php
session_start();

// Redirect if user role is not 'student' or if user ID is not set
if ($_SESSION['user_role'] != 'tutor' || !isset($_SESSION['user_id'])) {
    header("Location: ../../registerationAndLogin/login.php");
}

include "../../connection/connection.php";

$tutor_user_id = $_SESSION['user_id'];

if (isset($_POST['reject_id'])) {
    $req_id = $_POST['reject_id'];
    $del_sql = "DELETE from request where request_id = $req_id";
    $del_query = mysqli_query($con, $del_sql);

}

if (isset($_POST['reqId'])) {
    $req_id = $_POST['reqId'];
    $del_sql = "DELETE from request where request_id = $req_id";
    $del_query = mysqli_query($con, $del_sql);

    $tutor_user_id = $_SESSION['user_id'];
    $get_accepted_sql = "SELECT r.*, users.name, users.phone, users.email, users.id, stu.grade_level, stu.subjects_needed FROM request r INNER JOIN users ON r.student_id = users.id INNER JOIN students stu ON stu.user_id = users.id WHERE r.tutor_id = $tutor_user_id AND r.status = 'accepted'";
    $get_accepted_res = mysqli_query($con, $get_accepted_sql);

    if ($get_accepted_res) {
        while ($row = mysqli_fetch_array($get_accepted_res)) {
            echo "<div class='student'>
            <h3>" . $row['name'] . "</h3>
            <div class='buttons'>
            <button class='' >Chat</button>
            <button class='remove-student' data-request-id='" . $row['request_id'] . "'>Remove</button>
            </div>
            </div>";
        }


    } else {
        echo mysqli_error($con);
    }


}

if (isset($_POST['accept_id'])) {
    $req_id = $_POST['accept_id'];
    $accept_sql = "UPDATE request set status = 'accepted' where request_id = $req_id";
    $accept_query = mysqli_query($con, $accept_sql);
}
?>