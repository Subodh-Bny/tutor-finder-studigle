const profileBtn = document.querySelector(".user-profile");
const controlDiv = document.querySelector(".user-control");
profileBtn.addEventListener("click", () => {
  controlDiv.classList.toggle("hide");
});
