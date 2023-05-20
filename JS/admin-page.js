function doSearch() {
  const existingTable = document.getElementById("results-table");
  if (existingTable) {
    existingTable.remove(); // delete the existing table
  }

  var data = new FormData(document.getElementById("mySearch"));

  // (A2) AJAX - USE HTTP:// NOT FILE://
  fetch("/controllers/admin-controller.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.json())
    .then((res) => {
      if (res !== null) {
        const table = document.createElement("table");
        table.id = "results-table";
        const thead = table.createTHead();
        const row = thead.insertRow();
        row.innerHTML =
          "<th>ID</th><th>Name</th><th>Surname</th><th>Email</th><th>Role</th><th>Created At</th><th>Gender</th><th>Action</th>";
        const tbody = table.createTBody();
        for (let r of res) {
          const newRow = tbody.insertRow();
          newRow.insertCell().textContent = r.id_user;
          newRow.insertCell().textContent = r.name;
          newRow.insertCell().textContent = r.surname;
          newRow.insertCell().textContent = r.email;
          newRow.insertCell().textContent = r.role_name;
          newRow.insertCell().textContent = r.created_at;
          newRow.insertCell().textContent = r.gender;
          const actionCell = newRow.insertCell();
          const select = document.createElement("select");
          select.innerHTML =
            "<option value=''>Select Action</option><option value='delete'>Delete</option><option value='reset'>Reset pwd</option>";
          actionCell.appendChild(select);
          const button = document.createElement("button");
          button.textContent = "Execute";
          button.disabled = true;
          actionCell.appendChild(button);
          select.addEventListener("change", function () {
            const selectedOption = this.value;
            if (selectedOption !== "") {
              button.disabled = false;
            } else {
              button.disabled = true;
            }
          });
          button.addEventListener("click", function () {
            const selectedOption = select.value;
            const email = r.email;
            const id = r.id_user;
            const confirmMessage = `Are you sure you want to ${selectedOption} user ${email}?`;
            if (confirm(confirmMessage)) {
              const url = "/controllers/admin-controller.php";
              const data = new FormData();
              data.append("action", selectedOption);
              data.append("id_user", id);
              fetch(url, {
                method: "POST",
                body: data,
              })
                .then((res) => res.json())
                .then((res) => {
                  // Handle response from server
                  console.log(res);
                })
                .catch((error) => {
                  console.error(error);
                });
            }
            doSearch();
          });
        }
        results.appendChild(table);
      }
    });

  return false;
}

function createArticle() {
  const subject = document.getElementById("subject");
  const body = document.getElementById("body");

  const data = new FormData();
  data.append("create_faq", "true");
  data.append("subject", subject.value);
  data.append("body", body.value);

  fetch("/controllers/admin-controller.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.json())
    .then((res) => {
      if (res !== null) {
      }
    });

  subject.value = "";
  body.value = "";
  fetchFAQ_admin();
}

function fetchFAQ_admin() {
  const faqContainer = document.getElementById("faq");
  if (faqContainer) {
    faqContainer.innerHTML = "";
  }

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

        const deleteButton = document.createElement("button");
        deleteButton.classList.add("faq-delete");
        deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
        deleteButton.addEventListener("click", () => {
          const id_post = item.id_post;
          const confirmMessage = `Are you sure you want to delete this post ?`;
          if (confirm(confirmMessage)) {
            const url = "/controllers/admin-controller.php";
            const data = new FormData();
            console.log(id_post);
            data.append("action", "delete_faq");
            data.append("id_post", id_post);
            fetch(url, {
              method: "POST",
              body: data,
            })
              .then((res) => res.json())
              .then((res) => {
                // Handle response from server
                console.log(res);
              })
              .catch((error) => {
                console.error(error);
              });
            fetchFAQ_admin();
          }
        });

        faqDiv.appendChild(titleH3);
        faqDiv.appendChild(textP);
        faqDiv.appendChild(toggleButton);
        faqDiv.appendChild(deleteButton);

        outputElement.appendChild(faqDiv);
      });
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

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
