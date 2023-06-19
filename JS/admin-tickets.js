function getTicketsAdmin() {
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
          title.textContent = item.subject;
  
          const tag = document.createElement("p");
          tag.classList.add("ticket-tag");
          tag.textContent = item.tag_name;
  
          const stateSpan = document.createElement("span");
          stateSpan.classList.add("ticket-state");
          stateSpan.textContent = item.state;
          if (item.state === "OPEN") {
            stateSpan.style.color = "green";
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
            focusConversation(item.tickets_id);
          });
  
          container.appendChild(ticketDiv);
        });
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }