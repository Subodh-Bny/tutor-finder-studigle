<?php
if (isset($_POST['message'])) {
    $chat_person_id = $_POST['chatId'];
    $chat_message = $_POST['message'];
    $message_store_sql = "INSERT into messeges(sender_id, receiver_id, message) values('$user_id','$chat_pserson_id','$chat_message')";
    $message_store_res = mysqli_query($con, $message_store_sql);
    if ($message_store_res) {
        echo "Stored";
    }
}

