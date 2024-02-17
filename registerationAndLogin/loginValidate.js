function loginValidate() {
  const email = document.querySelector(".login-email").value;
  const emailError = document.querySelector(".login-email-error");

  const password = document.querySelector(".login-pass").value;
  const passError = document.querySelector(".login-pass-error");

  const emailRegex = /^[a-zA-Z0-9-_]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/;
  if (!emailRegex.test(email)) {
    emailError.textContent = "*Enter correct email address";
    return false;
  } else {
    emailError.textContent = "";
  }

  if (password == "") {
    passError.textContent = "*Enter password";
    return false;
  } else {
    passError.textContent = "";
  }
}
