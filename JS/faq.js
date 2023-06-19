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