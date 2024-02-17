<?php
$serverName = "localhost";
$user = "root";
$pass = "";
$dbname = "tutor_finder";

$conn = mysqli_connect($serverName, $user, $pass, $dbname);

if ($conn) {
    echo "Connected";
}
?>