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

function fetchFAQ() {
  fetch("/faq.php", {
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
