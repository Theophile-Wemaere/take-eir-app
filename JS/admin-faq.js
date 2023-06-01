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