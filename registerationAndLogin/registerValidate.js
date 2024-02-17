function validateRegister() {
  const regName = document.getElementById("name").value;
  const nameError = document.querySelector(".name-error");
  const regPhone = document.getElementById("phone").value;
  const phoneError = document.getElementsByClassName("phone-error");
  const regEmail = document.getElementById("reg-email").value;
  const emailError = document.querySelector(".email-error");

  const regPassword = document.querySelector("#reg-password").value;
  const passError = document.querySelector(".password-error");

  const confirmPass = document.querySelector("#confirm-password").value;
  const confirmPassError = document.querySelector(".confirm-error");

  if (regName.indexOf(" ") <= 0) {
    nameError.textContent = "*Enter Full Name";
    return false;
  } else {
    nameError.textContent = "";
  }

  const phoneRegex = /^9\d{9}$/;
  if (!phoneRegex.test(regPhone)) {
    phoneError[0].textContent =
      "*Phone Number should start from 9 and should contain 10 numbers";
    return false;
  } else {
    phoneError[0].textContent = "";
  }

  const emailRegex = /^[a-zA-Z0-9-_]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/;
  if (!emailRegex.test(regEmail)) {
    emailError.textContent = "*Enter correct email address";
    return false;
  } else {
    emailError.textContent = "";
  }

  const passLower = /[a-z]/;
  const passUpper = /[A-Z]/;
  const passDigit = /\d/;
  const passSymbol = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
  const passLength = /[A-Za-z\d@$!%*?&]{8,}/;

  if (!passLower.test(regPassword)) {
    passError.textContent =
      "Password should contain atleast one Lowercase letter";
    return false;
  } else if (!passUpper.test(regPassword)) {
    passError.textContent =
      "Password should contain atleast one Uppercase letter";
    return false;
  } else if (!passDigit.test(regPassword)) {
    passError.textContent = "Password should contain atleast one digit";
    return false;
  } else if (!passSymbol.test(regPassword)) {
    passError.textContent = "Password should contain atleast one symbol";
    return false;
  } else if (!passLength.test(regPassword)) {
    passError.textContent = "Password should contain more than 7 letters";
    return false;
  } else {
    passError.textContent = "";
  }

  if (confirmPass != regPassword) {
    confirmPassError.textContent = "Confirm password not matched";
    return false;
  } else {
    confirmPassError.textContent = "";
  }
}
