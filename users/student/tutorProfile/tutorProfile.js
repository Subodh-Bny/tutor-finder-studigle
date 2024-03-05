const ratingBtn = document.querySelector(".rating-btn");
const reviews = document.querySelector(".review-wrapper");
const cross = document.querySelector(".hide-container");
ratingBtn.addEventListener("click", () => {
  reviews.classList.remove("hide");
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
document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("reviewForm")
    .addEventListener("submit", function (event) {
      event.preventDefault();

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
            setTimeout(() => {
              location.reload();
            }, 2000);
          } else {
            alert("Error: " + xhr.statusText);
          }
        }
      };
      xhr.send(formData);
    });
});
