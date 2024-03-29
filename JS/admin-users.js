function doSearch() {
  const existingTable = document.getElementById("results-table");
  if (existingTable) {
    existingTable.remove();
  }

  var data = new FormData(document.getElementById("mySearch"));

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

function addDevices() {
  const num = document.getElementById("number").value;
  data = new FormData();
  data.append("action", "add_devices");
  data.append("number", num);
  fetch("/controllers/admin-controller.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.text())
    .then((res) => { 
    });
  getDevices();
}

function getDevices() {
  fetch("/controllers/admin-controller.php?action=get_devices")
    .then((res) => res.json())
    .then((res) => {
      if (res !== null) {
        console.log(res);
        const container = document.getElementById("container");
        container.innerHTML = "";
        const table = document.createElement("table");
        res.forEach((device) => {
          const row = document.createElement("tr");
          const idCell = document.createElement("td");
          idCell.textContent = device.id_device;
          row.appendChild(idCell);
          table.appendChild(row);
        });
        container.appendChild(table);
      } else {
        console.log("null");
      }
    });
}