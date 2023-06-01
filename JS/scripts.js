function toggleMenu() {
  const menu = document.getElementById("dropMenu");
  if (menu.style.display === "none") {
    menu.style.display = "flex";
  } else {
    menu.style.display = "none";
  }
}

window.onclick = function (e) {
  if (!e.target.matches(".menu-button")) {
    var menu = document.getElementById("dropMenu");
    if (menu.style.display === "flex") {
      menu.style.display = "none";
    }
  }
};

function dropMenuPres() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function (event) {
  if (!event.target.matches(".menu-button")) {
    var menu = document.getElementById("dropMenu");
    if (menu.style.display === "flex") {
      menu.style.display = "none";
    }
  }
  if (!event.target.matches(".dropbtn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};

function dropMenuUser() {
  document.getElementById("userDropdown").classList.toggle("show");
}

window.onclick = function (event) {
  if (!event.target.matches(".menu-button")) {
    var menu = document.getElementById("dropMenu");
    if (menu.style.display === "flex") {
      menu.style.display = "none";
    }
  }
  if (!event.target.matches(".dropbtn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content-user");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};

function checkEmail(id) {
  const emailInput = document.getElementById(id);
  const emailError = document.getElementById("emailError");
  emailInput.addEventListener("input", function () {
    const email = emailInput.value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailRegex.test(email)) {
      emailError.style.display = "none";
    } else {
      emailError.style.display = "block";
    }
  });
}

function logout(confirmation = true) {
  var ok = false;
  if (confirmation) {
    ok = confirm("Êtes-vous sûr(e) de vouloir vous déconnecter ?");
  } else {
    ok = true;
  }
  if (ok) {
    window.location.href = "/controllers/logout.php";
  }
}

function checkPasswordMatch() {
  const passwordInput = document.getElementById("password");
  const confirmPasswordInput = document.getElementById("confirm-password");
  const submitButton = document.getElementById("submit-btn");
  const message = document.getElementById("password-match-message");
  if (passwordInput.value !== confirmPasswordInput.value) {
    submitButton.disabled = true;
    submitButton.style.pointerEvents = "none";
    submitButton.style.opacity = "0.5";
    message.style.display = "block";
  } else {
    submitButton.disabled = false;
    submitButton.style.pointerEvents = "auto";
    submitButton.style.opacity = "1";
    message.style.display = "none";
  }
}
