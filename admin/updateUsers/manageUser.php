<?php
session_start();
if (isset($_POST['delete'])) {
    // Retrieve user ID from the form submission
    $user_id = $_POST['u_id'];
    $user_update_role = $_POST['u_role'];


    // Include the database connection
    include "../../connection/connection.php";






    if ($user_update_role == 'student') {
        $get_student_id = "select student_id from students where user_id = $user_id";
        if ($res = mysqli_query($con, $get_student_id)) {
            $student_id_row = mysqli_fetch_assoc($res);
            if ($student_id_row > 0) {
                $student_id = $student_id_row['student_id'];
                $delete_review_aql = "Delete from ratings where student_id = $student_id";
                $delete_review_res = mysqli_query($con, $delete_review_aql);
                if ($delete_review_res) {
                    echo "User deleted successfully</br>";
                } else {
                    echo mysqli_error($con) . "</br>";
                }
            }

        }

        $delete_message_sql = "DELETE from messages where sender_id = $user_id or receiver_id = $user_id";
        $delete_message_res = mysqli_query($con, $delete_message_sql);
        if ($delete_message_res) {
            echo "Messages deleted</br>";
        } else {
            mysqli_error($con);
        }

        $update_student_sql = "DELETE from students where user_id = $user_id";
        $delete_requests_sql = "DELETE from request where student_id = $user_id";


        $delete_requests_res = mysqli_query($con, $delete_requests_sql);
        if ($delete_requests_res) {
            echo "User deleted successfully</br>";
        } else {
            echo mysqli_error($con) . "</br>";
        }
        $update_student_result = mysqli_query($con, $update_student_sql);
        if ($update_student_result) {
            echo "User deleted successfully</br>";
        } else {
            echo mysqli_error($con) . "</br>";
        }
        $update_activity_sql = "UPDATE useractivity SET user_id = NULL WHERE user_id = '$user_id'";
        $update_query = mysqli_query($con, $update_activity_sql);
        if ($update_query) {
            echo "User deleted successfully</br>";
        } else {
            echo mysqli_error($con) . "</br>";
        }
        // Prepare the SQL query to delete the user

        $delete_sql = "DELETE FROM users WHERE id = '$user_id'";
        $result = mysqli_query($con, $delete_sql);
        if ($result) {
            header("Location: ../index.php");
        } else {
            echo mysqli_error($con) . "</br>";
        }
    } else if ($user_update_role == 'tutor') {

        $get_tutor_id = "select tutor_id from tutor where user_id = $user_id";
        if ($res = mysqli_query($con, $get_tutor_id)) {
            $tutor_id_row = mysqli_fetch_assoc($res);
            if ($tutor_id_row > 0) {
                $tutor_id = $tutor_id_row['tutor_id'];
                $delete_review_aql = "Delete from ratings where tutor_id = $tutor_id";
                $delete_review_res = mysqli_query($con, $delete_review_aql);
                if ($delete_review_res) {
                    echo "User deleted successfully</br>";
                } else {
                    echo mysqli_error($con) . "</br>";
                }
            }

        }
        $delete_subject_sql = "DELETE FROM subjects WHERE tutor_id IN (SELECT tutor_id FROM tutor WHERE user_id = '$user_id')
        ";
        $delete_subject_query = mysqli_query($con, $delete_subject_sql);
        if ($delete_subject_query) {
            echo "Subjects Deleted";
        } else {
            echo mysqli_error($con);
        }

        $delete_message_sql = "DELETE from messages where sender_id = $user_id or receiver_id = $user_id";
        $delete_message_res = mysqli_query($con, $delete_message_sql);
        if ($delete_message_res) {
            echo "Messages deleted</br>";
        } else {
            mysqli_error($con);
        }
        $delete_requests_sql = "DELETE from request where tutor_id = $user_id";
        $delete_requests_res = mysqli_query($con, $delete_requests_sql);
        $update_tutor_sql = "DELETE from tutor where user_id = $user_id";
        $update_tutor_result = mysqli_query($con, $update_tutor_sql);


        if ($delete_requests_res) {
            echo "requests deleted successfully</br>";
        } else {
            echo mysqli_error($con) . "</br>";
        }
        if ($update_tutor_result) {
            echo "User deleted successfully</br>";
        } else {
            echo mysqli_error($con) . "</br>";
        }

        $update_activity_sql = "UPDATE useractivity SET user_id = NULL WHERE user_id = '$user_id'";
        $update_query = mysqli_query($con, $update_activity_sql);

        // Prepare the SQL query to delete the user



        $delete_sql = "DELETE FROM users WHERE id = '$user_id'";
        $result = mysqli_query($con, $delete_sql);
        if ($result) {
            header("Location: ../index.php");
        } else {
            echo mysqli_error($con);
        }
    } else {
        echo "Couldnt Update";
        exit;
    }


    //delete from tutor database before deleting from user because it contains foreign key

    // set userid in useractivity table to null


} else if (isset($_POST['update'])) {
    $update_user_id = $_POST['u_id'];
    $_SESSION['update_user_id'] = $update_user_id;

    header("Location: ./updateForm.php");
    exit();

}
