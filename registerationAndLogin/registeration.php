<?php
include "../connection/connection.php";

if (isset($_POST['registerSubmit'])) {
    $userName = $_POST['name'];
    $userPhone = $_POST['phone'];
    $userEmail = $_POST['reg-email'];
    $userPassword = $_POST['reg-password'];
    $userRole = $_POST['role'];

    $check_email_exist_sql = "SELECT email FROM users WHERE email = '$userEmail'";
    $check_email_exist_res = mysqli_query($con, $check_email_exist_sql);

    $check_email_exist_admin_sql = "SELECT admin_email FROM admins WHERE admin_email = '$userEmail'";
    $check_email_exist_admin_res = mysqli_query($con, $check_email_exist_admin_sql);

    if (mysqli_num_rows($check_email_exist_res) > 0) {
        header("Location: ./login.php?registered=false");
        exit;
    } else if (mysqli_num_rows($check_email_exist_admin_res) > 0) {
        header("Location: ./login.php?registered=false");
        exit;
    } else {
        // Hash password securely
        $hashedPassword = md5($userPassword);

        // Insert user data into the users table using prepared statement
        $insertUserSql = "INSERT INTO users (name, phone, email, password, role) VALUES (?, ?, ?, ?, ?)";
        $stmtInsertUser = mysqli_stmt_init($con);



        if (!mysqli_stmt_prepare($stmtInsertUser, $insertUserSql)) {
            // Handle SQL statement preparation error
            exit("SQL statement preparation error");
        }

        mysqli_stmt_bind_param($stmtInsertUser, "sssss", $userName, $userPhone, $userEmail, $hashedPassword, $userRole);
        mysqli_stmt_execute($stmtInsertUser);


        $insertedUserId = mysqli_insert_id($con);

        if ($userRole == 'student') {
            $insertToRoleSql = "INSERT into students (user_id) values (?)";
            $stmtInsertUser = mysqli_stmt_init($con);

            if (!mysqli_stmt_prepare($stmtInsertUser, $insertToRoleSql)) {
                // Handle SQL statement preparation error
                exit("SQL statement preparation error");
            }
            mysqli_stmt_bind_param($stmtInsertUser, "s", $insertedUserId);
            mysqli_stmt_execute($stmtInsertUser);

        } else if ($userRole == 'tutor') {
            $insertToRoleSql = "INSERT into tutor (user_id) values (?)";
            $stmtInsertUser = mysqli_stmt_init($con);

            if (!mysqli_stmt_prepare($stmtInsertUser, $insertToRoleSql)) {
                // Handle SQL statement preparation error
                exit("SQL statement preparation error");
            }
            mysqli_stmt_bind_param($stmtInsertUser, "s", $insertedUserId);
            mysqli_stmt_execute($stmtInsertUser);
        }

        // Insert user activity data into the useractivity table using prepared statement
        $insertActivitySql = "INSERT INTO useractivity (user_id, activity_type, activity_details) VALUES (?, ?, ?)";
        $stmtInsertActivity = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmtInsertActivity, $insertActivitySql)) {
            // Handle SQL statement preparation error
            exit("SQL statement preparation error");
        }
        $activityType = "Registration";
        $activityDetails = "$userName registered to the system as a $userRole";
        mysqli_stmt_bind_param($stmtInsertActivity, "iss", $insertedUserId, $activityType, $activityDetails);
        mysqli_stmt_execute($stmtInsertActivity);

        // Redirect to appropriate page after successful registration
        header("Location: ./login.php?registered=true");
        exit;
    }
}
