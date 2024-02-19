<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Studigle</title>
  <link rel="stylesheet" href="./tutor.css" />
</head>

<body>
  <header>
    <div class="nav">
      <div class="logo">
        <a href="#">
          <img src="../img/logo copy.png" alt="logo" />
          <img class="web-name" src="../img/logo-text copy.png" alt="" />
        </a>
      </div>
      <div class="links">
        <ul>
          <li><a href="#">HOME</a></li>

        </ul>
      </div>
      <a href="">
        <form action="../logout/logout.php" method="post">
          <button class="logout-btn" type="submit">Logout</button>
        </form>
      </a>
    </div>
  </header>
  <div class="main-container">
    <div class="main">
      <div class="content">
        <div class="text">
          <h1>Tutor's Dashboard
            <span>&quot;
              <?php echo $_SESSION['user_name']; ?>&quot;
            </span><br />

          </h1>
        </div>
        <div class="image">
          <img src="./img/Creativity-pana.png" alt="" />
        </div>
      </div>
    </div>
  </div>
</body>

</html>