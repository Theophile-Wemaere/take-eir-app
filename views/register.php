<!DOCTYPE html>
<html lang="fr">
<?php
session_start();
if (isset($_SESSION["name"])) {
  header("Location: /");
}
?>

<head>
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <link rel="stylesheet" href="/CSS/register.css" />
  <link rel="stylesheet" href="/CSS/styles.css" />
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Register</title>
  <script src="/JS/scripts.js"></script>
  <script src="/JS/users.js"></script>
</head>

<body>
  <?php require "top-bar.php"; ?>
  <div class="wrapper">
    <form action="">
      <h1>INSCRIPTION</h1>
      <div class="separation"></div>
      <div class="corps-formulaire">

        <div class="gauche">

          <select id="role" name="role" class="type">
            <option value=select>Choisissez votre statut</option>
            <option value=famille>Patient/Famille</option>
            <option value=medecin>Medecin</option>
          </select>

          <div class="gender">
            <div class="h">
              <input type="checkbox" id="h" name="gender" value="M" checked>
              <label for="h">Homme</label>
            </div>

            <div class="f">
              <input type="checkbox" id="f" name="gender" value="F">
              <label for="f">Femme</label>
            </div>
          </div>

          <script>
            const checkboxes = document.querySelectorAll('input[name="gender"]');

            checkboxes.forEach((checkbox) => {
              checkbox.addEventListener("change", (event) => {
                checkboxes.forEach((cb) => {
                  if (cb !== event.target) {
                    cb.checked = false;
                  }
                });
              });
            });
          </script>

          <div class="groupe">
            <label>* Prénom</label>
            <input id="name" type="text" name="name" required>
            <i class="fa-solid fa-user"></i>
          </div>

          <div class="groupe">
            <label>* Nom</label>
            <input id="surname" type="text" name="surname" required>
            <i class="fa-solid fa-user"></i>
          </div>

          <div class="groupe">
            <label>* Email</label>
            <input id="email" type="email" name="email" required/>
            <i class="fa-solid fa-envelope"></i>
            <p id="emailError" style="color:red;font-size: 14px;margin-top: 5px;display: none;">Please enter a valid email</p>
          </div>
          <script>checkEmail()</script>

          <div class="groupe">
            <label>* Mot de passe</label>
            <input id="password" type="password" name="password" required/>
            <i class="fa-solid fa-key"></i>
          </div>

          <div class="groupe">
            <label>* Confirmation du mot de passe</label>
            <input id="confirm-password" type="password" name="password" required>
            <i class="fa-solid fa-key"></i>
          </div>

          <div id="password-match-message" style="margin-top:20px;display:none;color:red;">Passwords doesn't match</div>
          <div class="pied-formulaire">
            <button id="submit-btn" type="button" onclick=doRegister()>S'inscrire</button>
            <script>
              const passwordInput = document.getElementById("password");
              const confirmPasswordInput = document.getElementById("confirm-password");
              const submitButton = document.getElementById("submit-btn")
              const message = document.getElementById("password-match-message");

              function checkPasswordMatch() {
                if (passwordInput.value !== confirmPasswordInput.value) {
                  submitButton.disabled = true;
                  submitButton.style.pointerEvents = 'none';
                  submitButton.style.opacity = '0.5';
                  message.style.display = "block";
                } else {
                  submitButton.disabled = false;
                  submitButton.style.pointerEvents = 'auto';
                  submitButton.style.opacity = '1';
                  message.style.display = "none";
                }
              }

              passwordInput.addEventListener("input", checkPasswordMatch);
              confirmPasswordInput.addEventListener("input", checkPasswordMatch);
            </script>
          </div>
          <div id="loader" class="loader"></div>
          <script>
            const btn = document.getElementById("submit-btn");
            const loader = document.getElementById("loader");

            btn.addEventListener("click", () => {
              loader.style.display = "block";
              // Code pour lancer une requête ou une opération qui prend du temps
              setTimeout(() => {
                loader.style.display = "none";
              }, 2000); // Temps en millisecondes avant de cacher le loader
            });
          </script>
          <p id="error-msg" style="color: red;display: none;"></p> 
        </div>
        <div class="separation" style="margin-top: 20px;margin-bottom: 20px;"></div>
        <div class="droite">
          <a>J'ai déjà un compte</a>
          <a class="link" href="/index.php/login">Me connecter</a>
        </div>
      </div>
    
    </form>
  </div>
  <?php require "bottom-bar.php"; ?>
</body>

</html>
