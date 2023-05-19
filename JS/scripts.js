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
  console.log("here");
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

function logout() {
  if (confirm("Êtes-vous sûr(e) de vouloir vous déconnecter ?")) {
    window.location.href = "/controllers/logout.php";
  }
}

function checkEmail() {
  const emailInput = document.getElementById("email");
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

function checkLogin() {
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  const error = document.getElementById("error-msg");
  error.style.display = "none";

  const emailError = document.getElementById("emailError").style.display;

  if (emailError === "none" && email !== "" && password !== "") {
    const data = new FormData();
    data.append("email", email);
    data.append("password", password);

    fetch("/controllers/login-controller.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((data) => {
        switch (data.trim()) {
          case "redirect_admin":
            window.location.href = "/admin/admin.php";
            break;
          case "redirect_user":
            window.location.href = "/";
            break;
          case "bad_passwd":
            error.style.display = "block";
            error.textContent = "Error, invalid password";
            break;
          case "bad_credentials":
            error.style.display = "block";
            error.textContent = "Error, bad credentials";
            break;
        }
      });
  } else {
    error.style.display = "block";
    error.textContent = "Please fill all information required";
  }
}

function doRegister() {
  const role = document.getElementById("role").value;

  const M = document.getElementById("h");
  const F = document.getElementById("f");

  var gender = null;

  if (M.checked) {
    gender = "M";
  } else if (F.checked) {
    gender = "F";
  }

  const name = document.getElementById("name").value;
  const surname = document.getElementById("surname").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("confirm-password").value;

  const error = document.getElementById("error-msg");
  error.style.display = "none";

  const emailError = document.getElementById("emailError").style.display;
  if (
    emailError === "none" &&
    name !== "" &&
    surname !== "" &&
    email !== "" &&
    password !== ""
  ) {
    const data = new FormData();
    data.append("role", role);
    data.append("gender", gender);
    data.append("name", name);
    data.append("surname", surname);
    data.append("email", email);
    data.append("password", password);
    fetch("/controllers/register-controller.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((data) => {
        switch (data.trim()) {
          case "mail_exist":
            error.style.display = "block";
            error.textContent = "Error, this mail is already used";
            break;

          case "redirect_user":
            window.location.href = "/";
            break;
          case "error_creation":
            error.style.display = "block";
            error.textContent = "Error creating the account, try again";
            break;
        }
      });
  } else {
    error.style.display = "block";
    error.textContent = "Please fill all information required";
  }
}

function fetchFAQ() {
  fetch("/controllers/faq-controller.php", {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      const outputElement = document.getElementById("faq");
      data.forEach((item) => {
        const faqDiv = document.createElement("div");
        faqDiv.classList.add("faq");

        const titleH3 = document.createElement("h3");
        titleH3.classList.add("faq-title");
        titleH3.textContent = item.subject;

        const textP = document.createElement("p");
        textP.classList.add("faq-text");
        textP.textContent = item.body;

        const toggleButton = document.createElement("button");
        toggleButton.classList.add("faq-toggle");
        toggleButton.innerHTML = '<i class="fas fa-angle-down"></i>';
        toggleButton.addEventListener("click", () =>
          toggleButton.parentElement.classList.toggle("active")
        );

        faqDiv.appendChild(titleH3);
        faqDiv.appendChild(textP);
        faqDiv.appendChild(toggleButton);

        outputElement.appendChild(faqDiv);
      });
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
