function changeEmail() {
  const email = document.getElementById("email").value;
  const new_email = document.getElementById("confirm-password").value;
  const error = document.getElementById("error-msg");
  error.style.display = "none";
  const errorEmail = document.getElementById("emailError");
  errorEmail.style.display = "none";

  const success = document.getElementById("success-msg");
  success.style.display = "none";

  if (new_email !== "" && email !== "" && email !== new_email) {
    const data = new FormData();
    data.append("action", "edit_email");
    data.append("email", email);
    data.append("new_email", new_email);

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
