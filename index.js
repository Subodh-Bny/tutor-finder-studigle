const isRegistered = new URLSearchParams(window.location.search);

// Check if the 'parameterName' parameter exists in the URL
if (isRegistered.has("registered")) {
  // Get the value of the 'parameterName' parameter
  const parameterValue = isRegistered.get("registered");
  if (parameterValue == "true") {
    alert("Registered now you can login");
  } else {
    alert("registeration failed");
  }
}
