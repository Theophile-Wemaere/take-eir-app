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
  document.getElementById("userDropdown").classList.toggle("showMenu");
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

function checkPassword(id) {
  const passwordInput = document.getElementById(id);
  const passwordError = document.getElementById("passwordError");
  passwordInput.addEventListener("input", function () {
    // at least 8 char with min, maj, number and special char
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (passwordRegex.test(password)) {
      passwordError.style.display = "none";
    } else {
      passwordError.style.display = "block";
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

function setupPasswordValidation() {
  const passwordInput = document.getElementById("password");
  const confirmPasswordInput = document.getElementById("confirm-password");
  const passwordError = document.getElementById("passwordError");
  const submitButton = document.getElementById("submit-btn");
  const matchMessage = document.getElementById("password-match-message");

  passwordInput.addEventListener("input", function () {
    const password = passwordInput.value;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (passwordRegex.test(password)) {
      passwordError.style.display = "none";
    } else {
      passwordError.style.display = "block";
    }

    checkValidity();
  });

  confirmPasswordInput.addEventListener("input", function () {
    checkValidity();
  });

  function checkValidity() {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;
    const passwordMatch = password === confirmPassword;
    const passwordPolicyMet = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password);

    if (passwordMatch && passwordPolicyMet) {
      submitButton.disabled = false;
      submitButton.style.pointerEvents = "auto";
      submitButton.style.opacity = "1";
      matchMessage.style.display = "none";
    } else {
      submitButton.disabled = true;
      submitButton.style.pointerEvents = "none";
      submitButton.style.opacity = "0.5";
      matchMessage.style.display = "block";
    }
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

function resetPassword() {
  const email = document.getElementById("email");

  const error = document.getElementById("error-msg");
  error.style.display = "none";

  const success = document.getElementById("success-msg");
  success.style.display = "none";

  if (email.value !== "") {
    const data = new FormData();
    data.append("reset_passwd", "true");
    data.append("email", email.value);
    fetch("/controllers/email-controller.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.text())
      .then((res) => {
        if (res === "email_not_found") {
          error.style.display = "block";
        } else if (res === "success") {
          success.style.display = "block";
          email.value = "";
        }
      });
  }
}

function newPassword() {
  const urlParams = new URLSearchParams(window.location.search);
  const token = urlParams.get("token");
  const password = document.getElementById("confirm-password").value;

  const error = document.getElementById("error-msg");
  error.style.display = "none";

  if (password !== "") {
    const data = new FormData();
    data.append("reset_passwd", "true");
    data.append("password", password);
    data.append("token", token);
    fetch("/controllers/password-controller.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.text())
      .then((res) => {
        if (res === "invalid_token") {
          error.style.display = "block";
        } else if (res === "success") {
          window.location.href = "/index.php/login";
        }
      });
  }
}

function getProfilPicture() {
  const img = document.getElementById("profil_picture");
  fetch("/controllers/settings-controller.php?action=picture", {
    method: "GET",
  })
    .then((response) => response.blob())
    .then((blob) => {
      if (blob !== null) {
        const imgUrl = URL.createObjectURL(blob);
        img.src = imgUrl;
      }
    });
}