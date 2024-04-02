<?php
session_start();


// Redirect if user role is not 'student' or if user ID is not set
if ($_SESSION['user_role'] != 'student' || !isset ($_SESSION['user_id'])) {
    header("Location: ../../../registerationAndLogin/login.php");
}


$user_id = $_SESSION['user_id'];


include "../../../connection/connection.php";

if (isset ($_POST['loaded'])) {
    $fetch_sql = "SELECT u.id, u.name
    FROM users u
    WHERE u.id IN (
        SELECT sender_id
        FROM messages
        WHERE receiver_id = $user_id
        UNION
        SELECT receiver_id
        FROM messages
        WHERE sender_id = $user_id
    )
    ORDER BY (
        SELECT MAX(sent_at)
        FROM messages
        WHERE (sender_id = u.id AND receiver_id = $user_id)
            OR (receiver_id = u.id AND sender_id = $user_id)
    ) DESC
    ";
    $fetch_res = mysqli_query($con, $fetch_sql);
    while ($row = mysqli_fetch_assoc($fetch_res)) {

        echo " <div class='chat-tutor' data-tutor-chat-id =" . $row['id'] . ">
        <h4>" . $row['name'] . "</h4>
       
    </div>";
    }

}

if (isset ($_POST['chatId'])) {
    $chat_id = $_POST['chatId'];

    $get_chat_name = "SELECT name from users where id = $chat_id";
    $get_name_res = mysqli_query($con, $get_chat_name);
    $name_row = mysqli_fetch_assoc($get_name_res);

    $name = trim($name_row['name']);

    $get_messqge_sql = "Select * from messages where (sender_id = $user_id and receiver_id = $chat_id) or (sender_id = $chat_id and receiver_id =$user_id); ";
    $get_msg_res = mysqli_query($con, $get_messqge_sql);
    $msgResponses = array(); // Initialize an array to store message responses

    while ($message_row = mysqli_fetch_assoc($get_msg_res)) {
        if ($message_row['sender_id'] == $user_id) {
            $sent_msg = trim($message_row['message']);


            $sent_html = "<p class='sent'>$sent_msg</p>";
            $msgResponse = array(
                'html' => $sent_html,
                'name' => $name
            );

            $msgResponses[] = $msgResponse; // Add the message response to the array
        } else {
            $received_msg = trim($message_row['message']);
            $received_html = "<p class='received'>$received_msg</p>";
            $msgResponse = array(
                'html' => $received_html,
                'name' => $name
            );

            $msgResponses[] = $msgResponse;
        }
    }

    echo json_encode($msgResponses);
    exit();


}

if (isset ($_POST['messagesId'])) {
    $chat_person_id = $_POST['messagesId'];
    $chat_message = $_POST['message'];
    $message_store_sql = "INSERT into messages(sender_id, receiver_id, message) values('$user_id',' $chat_person_id','$chat_message')";
    $message_store_res = mysqli_query($con, $message_store_sql);
    if ($message_store_res) {
        echo "Stored";
    } else {
        echo mysqli_error($con);
    }
}





?>