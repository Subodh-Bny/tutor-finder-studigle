<?php
session_start();

// Redirect if user role is not 'student' or if user ID is not set
if ($_SESSION['user_role'] != 'tutor' || !isset($_SESSION['user_id'])) {
    header("Location: ../../registerationAndLogin/login.php");
}

include "../../connection/connection.php";

$tutor_user_id = $_SESSION['user_id'];

$get_requests_sql = "SELECT r.*, u.name FROM request r JOIN users u ON r.student_id = u.id WHERE r.tutor_id = '$tutor_user_id' and r.status = 'sent'";
$requests_res = mysqli_query($con, $get_requests_sql);

if (mysqli_num_rows($requests_res) > 0) {
    while ($request_row = mysqli_fetch_assoc($requests_res)) {
        echo "
        <li>
        <span class='name-date'>
       
            <span class='req-name'>" . $request_row['name'] . "</span>
            <br>
            <span class='received-date' style='color:gray; font-size:13px;'>" . $request_row['request_date'] . "</span>
        </span>
        <div class='action-btns'>
            <button class='accept-btn' data-accept-id='" . $request_row['request_id'] . "'>Accept</button>
            <button class='reject-btn' data-reject-id='" . $request_row['request_id'] . "'>Reject</button>
        </div>
        </li>";
    }

} else {
    echo "<h1 style='taxt-align:center; color:lightgray;'>No requests</h1>";
}
