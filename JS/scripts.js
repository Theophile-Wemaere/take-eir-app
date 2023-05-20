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

function fetchFAQ_user() {
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

function getTags() {
  const tags = document.getElementById("tag");
  fetch("/controllers/tickets-controller.php?action=tag", {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      data.forEach((item) => {
        option = document.createElement("option");
        option.value = item.id_tag;
        option.innerHTML = item.tag_name;
        tags.appendChild(option);
      });
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function getTickets() {
  fetch("/controllers/tickets-controller.php?action=tickets", {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      const container = document.getElementById("tickets");
      data.forEach((item) => {
        const ticketDiv = document.createElement("div");
        ticketDiv.classList.add("ticket");

        const title = document.createElement("p");
        title.classList.add("ticket-title");
        title.textContent = `[${item.name} ${item.surname}] ${item.subject}`;

        const tag = document.createElement("p");
        tag.classList.add("ticket-tag");
        tag.textContent = item.tag_name;

        const stateSpan = document.createElement("span");
        stateSpan.classList.add("ticket-state");
        stateSpan.textContent = item.state;
        if (item.state === "OPEN") {
          stateSpan.style.color = "green";
        } else if (item.state === "IN PROGRESS") {
          stateSpan.style.color = "red";
        } else {
          stateSpan.style.color = "purple";
        }

        const timestampSpan = document.createElement("span");
        timestampSpan.classList.add("ticket-timestamp");
        const createdAt = new Date(item.created_at);
        timestampSpan.textContent = createdAt.toLocaleString();

        ticketDiv.appendChild(title);
        ticketDiv.appendChild(tag);
        ticketDiv.appendChild(stateSpan);
        ticketDiv.appendChild(timestampSpan);

        ticketDiv.addEventListener("click", function () {
          var ticketDivs = document.querySelectorAll("div.ticket");
          ticketDivs.forEach(function (div) {
            if (div.classList.contains("current-ticket")) {
              div.classList.remove("current-ticket");
            }
          });
          ticketDiv.classList.add("current-ticket");
          focusConversation(item.tickets_id);
        });
        const button = document.createElement("button");
        button.style.marginLeft = "5px";
        button.textContent = "Close ticket";
        button.addEventListener("click", function () {
          const confirmMessage = "Close ticket ?";
          if (confirm(confirmMessage)) {
            sendMessage("", item.tickets_id, "CLOSED");
          }
        });
        ticketDiv.appendChild(button);
        container.appendChild(ticketDiv);
      });
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function focusConversation(ticket_id) {
  const focus = document.getElementById("conv");
  focus.innerHTML = "";
  const conv = document.createElement("div");
  conv.classList.add("conversation");
  fetch("/controllers/tickets-controller.php?action=conv&id=" + ticket_id, {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      const messages = data.body.split("]");
      messages.forEach((message) => {
        const sender = message.split("[")[0];
        const content = message.split("[")[1];

        if (content != null) {
          const messageElement = document.createElement("div");
          messageElement.classList.add("messagerow");
          messageElement.textContent =
            sender + " : " + unicodeBase64Decode(content);

          const you = data.surname + " " + data.name;
          if (sender == you) {
            messageElement.style.fontWeight = "bold";
          } else {
            messageElement.style.fontWeight = "normal";
          }

          conv.appendChild(messageElement);
        }
      });
      focus.appendChild(conv);
      conv.scrollTop = conv.scrollHeight;

      const resp = document.createElement("div");
      resp.classList.add("respbox");

      const inputElement = document.createElement("textarea");
      inputElement.classList.add("messagebox");

      const buttonElement = document.createElement("button");
      buttonElement.classList.add("send-btn");
      buttonElement.innerHTML = "<i class='fa fa-arrow-right'></i>";

      buttonElement.addEventListener("click", function () {
        const newMessage = inputElement.value;
        sendMessage(newMessage, ticket_id, "IN PROGRESS");
        inputElement.value = "";
        focusConversation(ticket_id);
      });

      resp.appendChild(inputElement);
      resp.appendChild(buttonElement);
      focus.appendChild(resp);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function sendMessage(newMessage, ticket_id, state) {
  const data = new FormData();
  data.append("edit_ticket", "true");
  data.append("id", ticket_id);
  data.append("message", newMessage);
  data.append("state", state);

  fetch("/controllers/tickets-controller.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.json())
    .then((res) => {
      return true;
    });
}

function unicodeBase64Decode(content) {
  try {
    var text = content
      .replace(/\s+/g, "")
      .replace(/\-/g, "+")
      .replace(/\_/g, "/");

    return decodeURIComponent(
      Array.prototype.map
        .call(window.atob(text), function (c) {
          return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
        })
        .join("")
    );
  } catch (error) {
    console.error("Error decoding Base64:", error);
    return ""; // Return a fallback value or handle the error accordingly
  }
}

function createTicket() {
  const tag = document.getElementById("tag");
  const subject = document.getElementById("subject");
  const body = document.getElementById("body");

  const error = document.getElementById("error-msg");
  error.style.display = "none";

  if (subject.value !== "" && body.value !== "") {
    const data = new FormData();
    data.append("create_ticket", "true");
    data.append("tag", tag.value);
    data.append("subject", subject.value);
    data.append("body", body.value);

    fetch("/controllers/tickets-controller.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.json())
      .then((res) => {
        window.location.href = "/index.php/tickets";
      });

    subject.value = "";
    body.value = "";
  } else {
    error.style.display = "block";
    error.textContent = "Merci de remplir tout les champs";
  }
}
