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
              const url = "/admin-controller.php";
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
  console.log("here pls");
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
}
