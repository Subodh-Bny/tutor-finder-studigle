const ratingBtn = document.querySelector(".rating-btn");
const reviews = document.querySelector(".review-wrapper");
const cross = document.querySelector(".hide-container");
ratingBtn.addEventListener("click", () => {
  reviews.classList.remove("hide");
  $.ajax({
    type: "POST",
    url: "./storeReview.php",
    data: { btnValue: "rating_btn" },
    success: function (response) {
      reviewContainer.innerHTML = response;
    },
  });
});

cross.addEventListener("click", () => {
  reviews.classList.add("hide");
});

const stars = document.querySelectorAll("#ratingStars i");
const rating = document.querySelector("#ratingValue");
stars.forEach((star, index1) => {
  star.addEventListener("click", () => {
    const value = star.getAttribute("data-value");
    rating.value = value;
    stars.forEach((star, index2) => {
      index1 >= index2
        ? star.classList.add("active")
        : star.classList.remove("active");
    });
  });
});

const postMsg = document.getElementById("post-msg");

const review = document.getElementById("review");
const ratingVal = document.getElementById("ratingValue");
const reviewContainer = document.querySelector(".reviews");

document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("reviewForm")
    .addEventListener("submit", function (event) {
      event.preventDefault();

      if (review.value == "" || ratingVal.value == "") {
        postMsg.textContent = "Please input both rating and review";
        postMsg.style.color = "red";
        return false;
      } else {
        var formData = new FormData(this);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./storeReview.php", true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              /* alert("Review Posted"); */
              postMsg.textContent = "Review Posted";
              stars.forEach((star) => {
                star.classList.remove("active");
              });
              review.value = "";
              reviewContainer.innerHTML = xhr.responseText;
            } else {
              alert("Error: " + xhr.statusText);
            }
          }
        };
        xhr.send(formData);
      }
    });
});

// request button
function requestSend() {
  const requestBtn = document.querySelector(".request");
  if (requestBtn != null) {
    /*  requestBtn.addEventListener("click", () => { */
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./requestSend.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = () => {
      if (xhr.readyState == 4 && xhr.status == 200) {
        requestBtn.textContent = xhr.responseText;
        requestBtn.classList.add("request-sent");

        requestBtn.classList.remove("request");
        // Disable the button after the response is received
      } else {
        requestBtn.textContent = xhr.responseText;
      }
    };
    xhr.send("method=sendRequest");
    /*   });*/
  }
}

function requestUnsend() {
  const requestUnsend = document.querySelector(".request-sent");
  if (requestUnsend != null) {
    /*    requestUnsend.addEventListener("click", () => { */
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./requestSend.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = () => {
      if (xhr.readyState == 4 && xhr.status == 200) {
        requestUnsend.textContent = xhr.responseText;
        requestUnsend.classList.add("request");
        requestUnsend.classList.remove("request-sent");

        // Disable the button after the response is received
      } else {
        requestUnsend.textContent = xhr.responseText;
      }
    };
    xhr.send("method=unsend");
    /*  });*/
  }
}

function accepted() {
  const untutor = document.querySelector(".accepted");
  if (untutor != null) {
    /*    untutor.addEventListener("click", () => { */
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./requestSend.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = () => {
      if (xhr.readyState == 4 && xhr.status == 200) {
        untutor.textContent = xhr.responseText;
        untutor.classList.add("request");
        untutor.classList.remove("accepted");

        // Disable the button after the response is received
      } else {
        untutor.textContent = xhr.responseText;
      }
    };
    xhr.send("method=untutor");
    /*  });*/
  }
}

// check for button status and toggle send or unsend
const checkBtn = document.querySelector(".request-check");
function checkRequest() {
  if (checkBtn != null) {
    checkBtn.addEventListener("click", () => {
      if (checkBtn.classList.contains("request")) {
        requestSend();
      } else if (checkBtn.classList.contains("request-sent")) {
        requestUnsend();
      } else if (checkBtn.classList.contains("accepted")) {
        accepted();
      }
    });
  }
}

checkRequest();
