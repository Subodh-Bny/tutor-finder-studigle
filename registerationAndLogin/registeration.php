<?php
include "../connection/connection.php";

if (isset($_POST['registerSubmit'])) {
    $userName = $_POST['name'];
    $userPhone = $_POST['phone'];
    $userEmail = $_POST['reg-email'];
    $userPassHashed = md5($_POST['reg-password']);

    $sql = "insert into users(name, phone, email, password) values ('$userName', $userPhone, '$userEmail', '$userPassHashed')";

    $res = mysqli_query($con, $sql);
    if ($res) {
        header("Location: ../index.html?registered=true");
        exit;

    } else {
        header("Location: ./login.html?registered=false");
        exit;
    }
}



?>