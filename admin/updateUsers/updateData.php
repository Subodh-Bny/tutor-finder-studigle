<?php
session_start();

if (isset($_POST['update'])) {
    $update_user_id = $_SESSION['update_user_id'];
    if ($_SESSION['update_user_role'] == "student") {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $grade = $_POST['grade'];

        include "../../connection/connection.php";

        $sql = "UPDATE users as t1 join students as std on t1.id = std.user_id 
                set t1.name = '$name', t1.phone = '$phone', t1.email = '$email', std.grade_level = '$grade' 
                where t1.id = '$update_user_id'";

        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['update_msg'] = "Updated Successfully";
            header("Location: ./updateForm.php");
            exit;
        } else {
            $_SESSION['error_update_msg'] = "Update Failed";
            header("Location: ./updateForm.php");
            exit;
        }

    } else if ($_SESSION['update_user_role'] == "tutor") {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $bio = $_POST['bio'];
        $subjects = $_POST['subjects'];
        $availability = $_POST['availability'];
        $rate = $_POST['rate'];

        include "../../connection/connection.php";

        $sql = "UPDATE users as t1 join tutor as tut on t1.id = tut.user_id join subjects as sub on tut.tutor_id= sub.tutor_id
                set t1.name = '$name', t1.phone = '$phone', t1.email = '$email', tut.bio = '$bio', sub.subject = '$subjects', tut.availability = '$availability', tut.hourly_rate = '$rate'
                where t1.id = '$update_user_id'";

        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['update_msg'] = "Updated Successfully";
            header("Location: ./updateForm.php");
            exit;
        } else {
            $_SESSION['error_update_msg'] = "Update Failed";
            header("Location: ./updateForm.php");
            exit;
        }


    }
}
?>