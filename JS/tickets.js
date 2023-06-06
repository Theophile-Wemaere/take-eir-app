function getTags(id) {
    const tags = document.getElementById(id);
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
    const tag_filter = document.getElementById("tags-filter");

    fetch("/controllers/tickets-controller.php?action=tickets&search="+tag_filter.value, {
      method: "GET",
    })
      .then((response) => response.json())
      .then((data) => {
        const container = document.getElementById("tickets");
        if (data !== null) {
          const conv = document.getElementById("conv");
          container.innerHTML = "";
          conv.style.display = "flex";
          data.forEach((item) => {
            const ticketDiv = document.createElement("div");
            ticketDiv.classList.add("ticket");
  
            const title = document.createElement("p");
            title.classList.add("ticket-title");
            title.textContent = `[${item.name} ${item.surname}] ${item.subject}`;
  
            const tagContainer = document.createElement("div");
            tagContainer.classList.add("tags");
            const tag = document.createElement("p");
            tag.classList.add("ticket-tag")
            tag.textContent = item.tag_name;
            tagContainer.appendChild(tag);
  
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
            ticketDiv.appendChild(tagContainer);
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
  
            const buttonClose = document.createElement("button");
            buttonClose.style.marginLeft = "5px";
            buttonClose.textContent = "close";
            buttonClose.addEventListener("click", function () {
              const confirmMessage = "Close ticket ?";
              if (confirm(confirmMessage)) {
                sendMessage("", item.tickets_id, "CLOSED");
              }
            });
            ticketDiv.appendChild(buttonClose);
  
            const buttonDelete = document.createElement("button");
            buttonDelete.style.marginLeft = "5px";
            buttonDelete.textContent = "delete";
            buttonDelete.addEventListener("click", function () {
              const confirmMessage = "Delete ticket ?";
              if (confirm(confirmMessage)) {
                sendMessage("", item.tickets_id, "DELETED");
              }
            });
            ticketDiv.appendChild(buttonDelete);
  
            container.appendChild(ticketDiv);
          });
        }
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
    getTickets();
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
    const tag = document.getElementById("tags-filter");
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