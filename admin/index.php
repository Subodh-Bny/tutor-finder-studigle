<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
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
          <li id="dashboard">Dashboard</li>
          <li id="charts">Charts</li>
          <li id="manage-users">Manage Users</li>
          <li id="chat">Chat</li>
        </ul>
        <button>Setting</button>
      </div>
    </div>
    <div class="contents-container">
      <div class="nav">
        <h2>Welcome
          <?php echo $_SESSION['user_name']; ?>
        </h2>
        <div class="nav-icons">
          <div class="noti icons">
            <img src="./images/noti.svg " alt="" />
            <span>3</span>
          </div>
          <div class="mail icons">
            <img src="./images/mail.svg" alt="" />
            <span>2</span>
          </div>
          <div class="profile icons">
            <img src="./images/profile.svg" />
          </div>
          <div class="profile-container">
            <div class="profile-contents">
              <h4>Hi, Admin</h4>
              <hr />
              Manage Profile

              <br />
              <form action="../index.html" method="post">
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
              23,136 <br />
              users
            </h3>
          </div>
          <div class="watch-time dash-content">
            <img src="./images/clock.svg" alt="" />
            <h3>
              123.456 <br />
              Average Time
            </h3>
          </div>
          <div class="collections dash-content">
            <img src="./images/dollar.svg" alt="" />
            <h3>
              $ 12300.456 <br />
              Total Collection
            </h3>
          </div>
          <div class="collections dash-content">
            <img src="./images/cart.svg" alt="" />
            <h3>$ 3435 Orders</h3>
          </div>
        </div>
      </div>
      <div class="main-contents charts hide">
        <h2>Charts</h2>
        <hr />
        <div class="chart-container">
          <img class="bar-chart" src="./public/chart.jpg" alt="" />
          <img src="./public/piechart.webp" alt="" class="pie-chart" />
        </div>
      </div>
      <div class="main-contents manage-users hide">
        <h2>Manage Users</h2>
        <hr />
        <div class="manage-container">
          <div class="users">
            <img src="./images/user.svg" alt="" />
            <h3>User</h3>
            <button>Update</button>
          </div>
          <div class="users">
            <img src="./images/user.svg" alt="" />
            <h3>User</h3>
            <button>Update</button>
          </div>
          <div class="users">
            <img src="./images/user.svg" alt="" />
            <h3>User</h3>
            <button>Update</button>
          </div>
          <div class="users">
            <img src="./images/user.svg" alt="" />
            <h3>User</h3>
            <button>Update</button>
          </div>
          <div class="users">
            <img src="./images/user.svg" alt="" />
            <h3>User</h3>
            <button>Update</button>
          </div>
          <div class="users">
            <img src="./images/user.svg" alt="" />
            <h3>User</h3>
            <button>Update</button>
          </div>
          <div class="users">
            <img src="./images/user.svg" alt="" />
            <h3>User</h3>
            <button>Update</button>
          </div>
          <div class="users">
            <img src="./images/user.svg" alt="" />
            <h3>User</h3>
            <button>Update</button>
          </div>
          <div class="users">
            <img src="./images/user.svg" alt="" />
            <h3>User</h3>
            <button>Update</button>
          </div>
          <div class="users">
            <img src="./images/user.svg" alt="" />
            <h3>User</h3>
            <button>Update</button>
          </div>
        </div>
      </div>
      <div class="main-contents chat hide">
        <h2>Chat</h2>
        <hr />
      </div>
    </div>
  </div>

  <script src="index.js"></script>
</body>

</html>