<?php
session_start();

if ($_SESSION['user_role'] != 'admin' || !isset($_SESSION['user_id'])) {
  header("Location: ../registerationAndLogin/login.php");
  exit;
}

include "../connection/connection.php";

$sql = "SELECT count(id) as users from users";
$res = mysqli_query($con, $sql);

if ($res) {
  $row = mysqli_fetch_array($res);
} else {
  echo "Couldn't fetch users count";
}

$reportSql = "SELECT * from useractivity ORDER BY activity_id DESC";
$reportRes = mysqli_query($con, $reportSql);
$reports = [];

if ($reportRes) {
  while ($new_row = mysqli_fetch_assoc($reportRes)) {
    $reports[] = $new_row;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Kanit:wght@300&family=Libre+Baskerville&family=Open+Sans&family=Poppins:wght@300&family=Roboto+Slab:wght@500&display=swap");
  </style>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="utility.css" />
</head>

<body>
  <div class="main flex">
    <div class="menu">
      <div class="logo flex align-center justify-center">
        <h2>Studigle</h2>
      </div>
      <div class="menu-cat flex">
        <ul>
          <li id="dashboard">Home</li>
          <li id="charts">Reports</li>
          <li id="manage-users">Manage Users</li>
        </ul>
        <button>Settings</button>
      </div>
    </div>
    <div class="contents-container">
      <div class="nav">
        <h2>Welcome,
          <?php echo $_SESSION['user_name']; ?>
        </h2>
        <div class="nav-icons">

          <div class="profile icons">
            <img src="./images/profile.svg" />
          </div>
          <div class="profile-container">
            <div class="profile-contents">
              <h4>Hi, Admin</h4>
              <hr />
              Manage Profile
              <br />
              <form action="../logout/logout.php" method="post">
                <button type="submit" class="logout-btn">Logout</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="main-contents dashboard">
        <h2>Dashboard</h2>
        <hr />
        <div class="dash-container">
          <div class="users dash-content">
            <img src="./images/profile.svg" alt="" />
            <h3>
              <?php echo $row['users']; ?> users
            </h3>
          </div>
        </div>
      </div>
      <div class="main-contents charts hide">
        <h2>Activity Reports</h2>
        <hr />
        <div class="report-container">
          <h1>Id</h1>
          <h1>User ID</h1>
          <h1>Type</h1>
          <h1>Date</h1>
          <h1>Details</h1>
          <?php foreach ($reports as $report): ?>
            <div>
              <?php echo $report['activity_id']; ?>
            </div>
            <div>
              <?php echo $report['user_id']; ?>
            </div>
            <div>
              <?php echo $report['activity_type']; ?>
            </div>
            <div>
              <?php echo $report['activity_date']; ?>
            </div>
            <div>
              <?php echo $report['activity_details']; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="main-contents manage-users hide">
        <h2>Manage Users</h2>
        <hr />
        <div class="manage-container">
          <?php
          $get_users_sql = "SELECT id, role, name FROM users";
          $users_result = mysqli_query($con, $get_users_sql);
          while ($users_row = mysqli_fetch_array($users_result)):
            $user_id = $users_row['id'];
            $user_role = $users_row['role'];

            ?>
            <div class="users">
              <img src="./images/user.svg" alt="" />
              <h3>
                <?php echo $users_row['name']; ?>
              </h3>
              <?php echo $users_row['role']; ?>
              <form action="./updateUsers/manageUser.php" method="POST" class="manage_form">
                <input type="hidden" name="u_id" value="<?php echo $user_id ?>">
                <input type="hidden" name="u_role" value="<?php echo $user_role ?>">
                <button type="submit" name="update">Update</button>
                <button type="submit" name="delete">Delete</button>
              </form>
            </div>
          <?php endwhile; ?>
        </div>
        <div class="main-contents chat hide">
          <h2>Chat</h2>
          <hr />
        </div>
      </div>
    </div>
  </div>
  <script src="index.js"></script>
</body>

</html>