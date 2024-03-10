<?php
if ($_POST['method'] == 'sendRequest') {
    session_start();
    include "../../../connection/connection.php";

    $student = $_SESSION['user_id'];
    $tutor = $_SESSION['profile_tutor'];
    $requestSql = "INSERT into request(student_id, tutor_id, status) values('$student','$tutor','sent')";
    $requestResult = mysqli_query($con, $requestSql);
    if ($requestResult) {
        echo "Request Sent";
    } else {
        echo mysqli_error($con);
    }
} else if ($_POST['method'] == 'unsend') {
    session_start();
    include "../../../connection/connection.php";

    $student = $_SESSION['user_id'];
    $tutor = $_SESSION['profile_tutor'];
    $requestDeleteSql = "DELETE from request where student_id = '$student' and tutor_id = $tutor";
    $requestDeleteResult = mysqli_query($con, $requestDeleteSql);
    if ($requestDeleteResult) {
        echo "Request";
    } else {
        echo mysqli_error($con);
    }
} else if ($_POST['method'] == 'untutor') {
    session_start();
    include "../../../connection/connection.php";

    $student = $_SESSION['user_id'];
    $tutor = $_SESSION['profile_tutor'];
    $requestDeleteSql = "DELETE from request where student_id = '$student' and tutor_id = $tutor";
    $requestDeleteResult = mysqli_query($con, $requestDeleteSql);
    if ($requestDeleteResult) {
        echo "Request";
    } else {
        echo mysqli_error($con);
    }
} else {
    echo var_dump($_POST);
}


?>