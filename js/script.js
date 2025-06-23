// toggle class active
const navbarNav = document.querySelector(".navbar-nav");
// ketika hamburger menu di click
document.querySelector("#hamburger-menu").onclick = () => {
  navbarNav.classList.toggle("active");
};
// Login modal toggle
const loginIcon = document.querySelector("#user");
const loginModal = document.querySelector("#login-modal");
const closeLogin = document.querySelector("#close-login");

loginIcon.addEventListener("click", function () {
  loginModal.style.display = "block";
});

closeLogin.addEventListener("click", function () {
  loginModal.style.display = "none";
});

window.addEventListener("click", function (event) {
  if (event.target == loginModal) {
    loginModal.style.display = "none";
  }
});
// Validasi Login
document.addEventListener("DOMContentLoaded", function () {
  const loginForm = document.querySelector("#login-modal form");
  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
      const userid = loginForm.userid.value.trim();
      const passw = loginForm.passw.value.trim();

      if (!userid || !passw) {
        alert("User ID dan Password wajib diisi!");
        e.preventDefault();
      } else if (passw.length < 6) {
        alert("Password minimal 6 karakter.");
        e.preventDefault();
      }
    });
  }
});


// klik di luar sidebar untuk menghilangkan nav
const hamburger = document.querySelector("#hamburger-menu");

document.addEventListener("click", function (e) {
  if (!hamburger.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
});
