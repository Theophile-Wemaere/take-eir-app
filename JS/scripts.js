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
    window.location.href = "/logout.php";
  }
}
