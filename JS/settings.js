function changeEmail() {
  const email = document.getElementById("email");
  const new_email = document.getElementById("confirm-password");

  const error = document.getElementById("error-msg");
  error.style.display = "none";

  const errorEmail = document.getElementById("emailError");
  errorEmail.style.display = "none";

  const success = document.getElementById("success-msg");
  success.style.display = "none";

  if (new_email.value !== "" && email.value !== "" && email.value !== new_email.value) {
    const data = new FormData();
    data.append("action", "edit_email");
    data.append("email", email.value);
    data.append("new_email", new_email.value);

    fetch("/controllers/settings-controller.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.text())
      .then((res) => {
        if (res === "mail_exist") {
          error.style.display = "block";
        } else if (res == "success") {
          success.style.display = "block";
          email.value = new_email.value;
          new_email.value = "";
          document.getElementById("password").value = "";
        }
      });
  } else {
    errorEmail.style.display = "block";
  }
}

function changePassword() {
  const password = document.getElementById("current-password").value;
  const new_password = document.getElementById("confirm-password").value;
  const error = document.getElementById("error-msg");
  error.style.display = "none";

  const success = document.getElementById("success-msg");
  success.style.display = "none";

  if (new_password !== password) {
    const data = new FormData();
    data.append("action", "edit_password");
    data.append("password", password);
    data.append("new_password", new_password);
    fetch("/controllers/settings-controller.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.text())
      .then((res) => {
        if (res === "bad_password") {
          error.style.display = "block";
        } else if (res === "success") {
          success.style.display = "block";
        }
      });
  }
}

function getNotification() {
  const switcher = document.getElementById("switchA1");

  fetch("/controllers/settings-controller.php?action=notification", {
    method: "GET",
  })
    .then((response) => response.text())
    .then((response) => {
      if (response === "Y") {
        switcher.checked = true;
      } else {
        switcher.checked = false;
      }
    });
}

function updateNotification() {
  const switcher = document.getElementById("switchA1");
  const data = new FormData();
  const success = document.getElementById("success-msg");
  success.style.display = "none";

  data.append("action", "update_notif");
  if (switcher.checked) {
    data.append("notif", "Y");
  } else {
    data.append("notif", "N");
  }

  fetch("/controllers/settings-controller.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.text())
    .then((res) => {
      if (res === "success") {
        success.style.display = "block";
      }
    });
}

function deleteAccount() {
  const msg = "Êtes-vous sure de vouloir supprimer votre compte ?";
  const msg2 = "Dernière chance ?";
  const password = document.getElementById("password").value;
  const reason = document.getElementById("reason").value;
  const error = document.getElementById("error-msg");
  error.style.display = "none";

  const errorPassword = document.getElementById("error-password");
  errorPassword.style.display = "none";

  if (password !== "" && reason != "") {
    if (confirm(msg) && confirm(msg2)) {
      const data = new FormData();
      data.append("action", "delete_user");
      data.append("reason", reason);
      data.append("password", password);
      fetch("/controllers/settings-controller.php", {
        method: "POST",
        body: data,
      })
        .then((res) => res.text())
        .then((res) => {
          if (res === "success") {
            logout(false);
          } else if (res === "bad_password") {
            errorPassword.style.display = "block";
          }
        });
    }
  } else {
    error.style.display = "block";
  }
}

function getProfil() {
  const M = document.getElementById("h");
  const F = document.getElementById("f");
  const role = document.getElementById("role");

  fetch("/controllers/settings-controller.php?action=profil", {
    method: "GET",
  })
    .then((response) => response.json())
    .then((response) => {
      if (response !== null) {
        switch (response.role_name) {
          case "Doctor":
            role.value = "medecin";
            break;
          case "Family":
            role.value = "famille";
            break;
          default:
            role.value = "select";
            break;
        }

        if (response.gender === "M") {
          M.checked = true;
          F.checked = false;
        } else if (response.gender === "F") {
          M.checked = false;
          F.checked = true;
        }
      }
    });
}

function updateProfil() {
  const h = document.getElementById("h");
  const f = document.getElementById("f");

  var gender;
  if (h.checked) {
    gender = "M";
  } else {
    gender = "F";
  }

  const role = document.getElementById("role").value;
  const name = document.getElementById("name").value;
  const surname = document.getElementById("surname").value;
  const picture = document.getElementById("picture_file").files[0];

  const error = document.getElementById("error-msg");
  error.style.display = "none";

  const success = document.getElementById("success-msg");
  success.style.display = "none";

  if (name !== "" && surname !== "") {
    data = new FormData();
    data.append("action", "update_profil");
    data.append("name", name);
    data.append("surname", surname);
    data.append("gender", gender);
    data.append("role", role);
    data.append("picture", picture);

    fetch("/controllers/settings-controller.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.text())
      .then((res) => {
        console.log(res);
        if (res == "success") {
          success.style.display = "block";
          getProfilPicture();
        }
      });
  } else {
    error.style.display = "block";
  }
}