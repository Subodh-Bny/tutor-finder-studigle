<?php
session_start();
if (isset($_POST['reqId'])) {
    include '../../connection/connection.php';
    $req_id = $_POST['reqId'];
    $del_sql = "DELETE from request where request_id = $req_id";
    $del_query = mysqli_query($con, $del_sql);

    $student = $_SESSION['user_id'];
    $get_accepted_sql = "SELECT r.*, users.name, users.phone, users.email, users.id, stu.grade_level, stu.subjects_needed FROM request r INNER JOIN users ON r.student_id = users.id INNER JOIN students stu ON stu.user_id = users.id WHERE r.student_id = $student AND r.status = 'accepted'";
    $get_accepted_res = mysqli_query($con, $get_accepted_sql);

    if ($get_accepted_res) {
        while ($row = mysqli_fetch_array($get_accepted_res)) {
            echo "<div class='student'>
            <h3>" . $row['name'] . "</h3>
            <div class='buttons'>
            <a href='./message/messages.php'><button class='chat-open' data-chat-id='" . $row['tutor_id'] . "' >Say hi👋</button></a>
            <button class='remove-tutor' data-request-id='" . $row['request_id'] . "'>Remove</button>
            </div>
            </div>";
        }


    } else {
        echo mysqli_error($con);
    }


}