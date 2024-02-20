<?php
session_start();
$errorMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $loginEmail = $_POST['email'];
  $loginPassword = $_POST['password'];


  include "../connection/connection.php";


  $sql = "SELECT * FROM users WHERE email = ?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("s", $loginEmail);
  $stmt->execute();
  $result = $stmt->get_result();


  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row['password'];
    $hashedLoginPassword = md5($loginPassword);

    if ($hashedLoginPassword == $hashedPassword) {
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_name'] = $row['name'];

      if ($row['role'] == "admin") {
        header("Location: ../admin/index.php");
        exit;
      } else if ($row['role'] == "user") {
        header("Location: ../users/normalUser.php");
        exit;

      } else if ($row['role'] == "tutor") {
        header("Location: ../users/tutor.php");
        exit;


      }


    } else {

      $errorMessage = "Invalid email or password";
    }
  } else {
    // No user with the entered email found

    $errorMessage = "Invalid email or password";

  }

  // Close the prepared statement and database connection
  $stmt->close();
  $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Studigle</title>
  <link rel="stylesheet" href="../public/loginstyle.css" />
  <link rel="stylesheet" href="../public/login.css" />
  <link rel="stylesheet" href="../public/responsive.css" />
</head>

<body>
  <header>
    <div class="nav">
      <div class="logo">
        <a href="../index.html">
          <img src="../img/logo copy.png" alt="logo" />
          <img class="web-name" src="../img/logo-text copy.png" alt="" />
        </a>
      </div>
      <div class="links">
        <ul>
          <li class="nav-link"><a href="../index.html">HOME</a></li>
          <li class="nav-link"><a href="../public/about.html">ABOUT</a></li>
          <li class="nav-link">
            <a href="../public/contact.html">CONTACT</a>
          </li>
        </ul>
        <a href="#" class="login-href nav-link">
          <button class="login-btn">LOGIN</button></a>
      </div>
    </div>

    <div class="hamburger">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="hamburger-svg">
        <path fill="#644bb1"
          d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
      </svg>
    </div>
  </header>
  <div class="main-container">
    <div class="main">
      <div class="content-2">
        <div class="image-2">
          <img src="../img/Creativity-bro.png" alt="" />
        </div>
        <!-- Login -->
        <div class="wrapper">
          <div class="card-switch">
            <label class="switch">
              <input type="checkbox" class="toggle" />
              <span class="slider"></span>
              <span class="card-side"></span>
              <div class="flip-card__inner">
                <div class="flip-card__front">
                  <div class="title">Log in</div>
                  <form class="flip-card__form" method="POST" onsubmit="return loginValidate()"
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input class="flip-card__input login-email" name="email" placeholder="Email" type="email" />
                    <span class="error-message login-email-error"></span>
                    <input class="flip-card__input login-pass" name="password" placeholder="Password" type="password" />
                    <span class="error-message login-pass-error">
                      <?php
                      echo $errorMessage;
                      ?>
                    </span>
                    <button type="submit" class="flip-card__btn login-submit" name="loginSubmit">
                      Login
                    </button>
                  </form>
                </div>
                <div class="flip-card__back">
                  <div class="title">Sign up</div>
                  <form class="flip-card__form" onsubmit="return validateRegister()" action="./registeration.php"
                    method="POST">
                    <input class="flip-card__input reg-name" placeholder="Name" type="text" id="name" name="name" />
                    <span class="error-message name-error"></span>
                    <input class="flip-card__input" id="phone" name="phone" placeholder="Phone" type="number" style="
                          -webkit-appearance: none;
                          -moz-appearance: textfield;
                          appearance: input;
                        " />
                    <span class="error-message phone-error"></span>
                    <input class="flip-card__input number_input" name="reg-email" placeholder="Email" type="email"
                      id="reg-email" />
                    <span class="error-message email-error"></span>

                    <input class="flip-card__input" name="reg-password" placeholder="Password" type="password"
                      id="reg-password" />
                    <span class="error-message password-error"></span>
                    <input class="flip-card__input" name="confirm-password" placeholder="Confirm Password"
                      type="password" id="confirm-password" />
                    <span class="error-message confirm-error"></span>
                    <button class="flip-card__btn" type="submit" name="registerSubmit">
                      Next
                    </button>
                  </form>
                </div>
              </div>
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./loginValidate.js"></script>
  <script src="./registerValidate.js"></script>
  <script src="../public/responsiveness.js"></script>

</body>

</html>