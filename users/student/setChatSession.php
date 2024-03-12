<?php
session_start();

// Redirect if user role is not 'student' or if user ID is not set
if ($_SESSION['user_role'] != 'student' || !isset($_SESSION['user_id'])) {
    header("Location: ../../registerationAndLogin/login.php");
}
include "../../connection/connection.php";
if (isset($_POST['chatId'])) {
    $user_id = $_SESSION['user_id'];
    $chat_person_id = $_POST['chatId'];
    $chat_message = "Hi👋";
    $message_store_sql = "INSERT into messages(sender_id, receiver_id, message) values('$user_id',' $chat_person_id','$chat_message')";
    $message_store_res = mysqli_query($con, $message_store_sql);
    if ($message_store_res) {
        echo "Stored";
    } else {
        echo mysqli_error($con);
    }

} else {
    echo 'NO id caught';
}