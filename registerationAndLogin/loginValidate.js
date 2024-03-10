function loginValidate() {
  const email = document.querySelector(".login-email").value;
  const emailError = document.querySelector(".login-email-error");

  const password = document.querySelector(".login-pass").value;
  const passError = document.querySelector(".login-pass-error");

  const emailRegex = /^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/;
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

document.addEventListener("DOMContentLoaded", () => {
  const isRegistered = new URLSearchParams(window.location.search);

  // Check if the 'parameterName' parameter exists in the URL
  if (isRegistered.has("registered")) {
    // Get the value of the 'parameterName' parameter
    const parameterValue = isRegistered.get("registered");
    if (parameterValue == "true") {
      alert("Registered now you can login");
    } else {
      alert("Email Already Exists");
    }
  }
});
