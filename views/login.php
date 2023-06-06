<?php
if (isset($_SESSION["name"])) {
  if ($_SESSION["role_permission"] == 6) {
    header("Location: /index.php/admin-users");
  } else {
    header("Location: /index.php/health-view");
  }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <link rel="stylesheet" href="/CSS/login.css" />
  <link rel="stylesheet" href="/CSS/styles.css" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <meta charset="utf-8" />
  <title id="connexion">Login</title>
  <script src="/JS/scripts.js"></script>
  <script src="/JS/users.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Reem+Kufi" rel="stylesheet" />
</head>

<body>
  <?php require "top-bar.php"; ?>
  <div class="wrapper">
    <form action="" method="POST">
      <h1>CONNEXION</h1>
      <div class="separation"></div>
      <div class="corps-formulaire">
        <div class="gauche">
          <div class="groupe">
            <label>Email</label>
            <input id="email" type="email" name="email" required />
            <i class="fa-solid fa-envelope"></i>
            <p id="emailError" style="color:red;font-size: 14px;margin-top: 5px;display: none;">Merci d'entrer un email
              valide</p>
          </div>


          <div class="groupe">
            <label>Mot de passe</label>
            <input id="password" type="password" name="password" required />
            <i class="fa-solid fa-key"></i>
          </div>

          <a class="link" href="/index.php/reset-passwd">Mot de passe oublié ?</a>
          <div class="remember">
            <input type="checkbox" id="rememberme" name="check" checked />
            <label for="check">Se souvenir de moi</label>
          </div>
          <div class="pied-formulaire">
            <button id="btn" onclick=checkLogin() type="button">Se connecter</button>
          </div>
          <div id="loader" class="loader"></div>
          <script>
            checkEmail("email")
            const input = document.getElementById("email");
            input.addEventListener("input", function () {
              const error = document.getElementById("emailError");
              const btn = document.getElementById("btn");
              if (error.style.display == "none") {
                btn.disabled = false;
                btn.style.pointerEvents = "auto";
                btn.style.opacity = "1";
              } else {
                btn.disabled = true;
                btn.style.pointerEvents = "none";
                btn.style.opacity = "0.5";
              }
            });
            const btn = document.getElementById("btn");
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
          <a>Je n'ai pas encore de compte</a>
          <a class="link" href="/index.php/register">M'inscrire</a>
        </div>
      </div>
    </form>

  </div>
  <?php require "bottom-bar.php"; ?>
</body>

</html>