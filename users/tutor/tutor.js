let profileIcon = document.querySelector(".profile");
let profileMenu = document.querySelector(".profile-container");
profileMenu.classList.add("hide");
profileIcon.addEventListener("click", () => {
  profileMenu.classList.toggle("hide");
});
