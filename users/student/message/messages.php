<?php
session_start();


// Redirect if user role is not 'student' or if user ID is not set
if ($_SESSION['user_role'] != 'student' || !isset($_SESSION['user_id'])) {
    header("Location: ../../../registerationAndLogin/login.php");
}


include "../../../connection/connection.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <!-- External CSS files -->
    <link rel="stylesheet" href="../normalUser.css" />
    <link rel="stylesheet" href="../../../public/utility.css" />
    <link rel="stylesheet" href="./messages.css">


</head>

<body>
    <div class="main flex">
        <!-- Menu -->
        <div class="menu">
            <div class="logo flex align-center justify-center">
                <a href="#" class="logo">
                    <img class="web-name" src="../../../img/logo-text copy.png" alt="" />
                </a>
            </div>
            <div class="menu-cat flex">
                <ul>
                    <a href="../normalUser.php">
                        <li id="dashboard">Home</li>
                    </a>
                    <a href="../findTutor.php">
                        <li id="find-tutor">Find Tutor</li>
                    </a>
                    <a href='../yourTutors.php'>
                        <li id='acceptedTutor'>Your Tutors</li>
                    </a>
                    <a href='./messages.php'>
                        <li id='messages'>Messages</li>
                    </a>

                </ul>
                <!-- Logout Form -->
                <form action="../../../logout/logout.php" method="post" id="logout-form">
                    <button name="logout">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                        </svg>Logout</button>
                </form>
            </div>
        </div>

        <!-- Contents Container -->
        <div class="contents-container">
            <!-- Navigation -->
            <div class="nav">
                <h2>Welcome
                    <?php echo $_SESSION['user_name']; ?>
                </h2>
                <div class="nav-icons">
                    <!-- Profile Icon -->
                    <div class="profile icons user-profile">
                        <img src="../../../admin/images/profile.svg" />
                    </div>

                    <div class="profile-container user-control hide ">
                        <div class="profile-contents">
                            <h4>Settings</h4>
                            <ul class="setting-list">
                                <li><a href="../updateprofile.php">Update Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="main-contents dashboard">
                <h2>Messages</h2>

                <div class="messages-cont">
                    <div class="chat-list">


                    </div>
                    <div class="chat">
                        <div class="chat-name">

                        </div>
                        <div class="messages">

                        </div>
                        <div class="message-send">
                            <input type="text" id="send-message">
                            <button id="send-btn">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- External JavaScript file -->
    <script src="../profileBtn.js"></script>
    <script src="https://kit.fontawesome.com/1a3756e774.js" crossorigin="anonymous"></script>
    <script src="../../../ajax/ajax.js"></script>
    <script src="./message.js"></script>
</body>

</html>