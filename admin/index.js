//navigate through menu
let dashboard = document.querySelector(".dashboard");
let charts = document.querySelector(".charts");
let manageUsers = document.querySelector(".manage-users");
let chat = document.querySelector(".chat");

let dashboardLink = document.querySelector("#dashboard");
let chartsLink = document.querySelector("#charts");
let manageUsersLink = document.querySelector("#manage-users");

let active = dashboard;
function openPage(link, content) {
  link.addEventListener("click", () => {
    active.classList.toggle("hide");
    content.classList.toggle("hide");
    active = content;
  });
}
openPage(dashboardLink, dashboard);
openPage(chartsLink, charts);
openPage(manageUsersLink, manageUsers);

//click profile icon
let profileIcon = document.querySelector(".profile");
let profileMenu = document.querySelector(".profile-container");
profileMenu.classList.add("hide");
profileIcon.addEventListener("click", () => {
  profileMenu.classList.toggle("hide");
});
