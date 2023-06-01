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
                        window.location.href = "/admin/admin-users.php";
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