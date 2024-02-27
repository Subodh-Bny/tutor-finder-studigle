<?php
session_start();
if (isset($_POST['delete'])) {
    // Retrieve user ID from the form submission
    $user_id = $_POST['u_id'];
    $user_update_role = $_POST['u_role'];

    // Include the database connection
    include "../../connection/connection.php";

    if ($user_update_role == 'student') {
        $update_student_sql = "DELETE from students where user_id = $user_id";
        $update_student_result = mysqli_query($con, $update_student_sql);
    } else if ($user_update_role == 'tutor') {
        $update_tutor_sql = "DELETE from tutor where user_id = $user_id";
        $update_tutor_result = mysqli_query($con, $update_tutor_sql);
    } else {
        echo "Couldnt Update ";
        exit;
    }

    //delete from tutor database before deleting from user because it contains foreign key

    // set userid in useractivity table to null

    $update_activity_sql = "UPDATE useractivity SET user_id = NULL WHERE user_id = '$user_id'";
    $update_query = mysqli_query($con, $update_activity_sql);

    // Prepare the SQL query to delete the user

    $delete_sql = "DELETE FROM users WHERE id = '$user_id'";
    $result = mysqli_query($con, $delete_sql);
    if ($result) {
        echo "User deleted successfully";
    } else {
        echo mysqli_error($con);
    }
} else if (isset($_POST['update'])) {
    $update_user_id = $_POST['u_id'];
    $_SESSION['update_user_id'] = $update_user_id;

    header("Location: ./updateForm.php");
    exit();

}
?>