<!DOCTYPE html>
<html lang="fr">

<head>
  <link rel="stylesheet" href="/CSS/login.css" />
  <link rel="stylesheet" href="/CSS/styles.css" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta charset="utf-8" />
  <title id="connexion">Login</title>
  <script src="/JS/scripts.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Reem+Kufi" rel="stylesheet" />
</head>

<body>
  <div class="wrapper">
    <div class="top-bar">
      <div class="top-bar-img">
        <a href="/"><img src="/images/logo-notext.png" /></a>
      </div>
      <div class="right-items">
        <a href="/produit.html">
          <button class="page-button" style="margin-right: 10px">
            Notre produit
          </button></a>
        <div class="separator" style="margin-right: 10px"></div>
        <a href="/presentation.html">
          <button class="page-button" style="margin-right: 10px">
            Qui sommes nous ?
          </button></a>
        <a href="/login.php">
          <button class="login-button" style="margin-right: 10px">
            Se connecter
          </button></a>
      </div>
      <span style="pointer-events: auto">
        <div class="menu-button" href="javascript:void(0);" onclick="toggleMenu()">
          <div class="sphere" style="background-color: #2d67e0"></div>
          <div class="sphere" style="background-color: #e0584c"></div>
          <div class="sphere" style="background-color: #5dd1b7"></div>
        </div>
      </span>
    </div>
    <div class="drop-menu" id="dropMenu" style="display: none">
      <a href="/produit.html"><button class="page-button">Notre produit</button></a>
      <div class="separator"></div>
      <a href="/presentation.html"><button class="page-button">Qui sommes nous ?</button></a>
      <div class="separator"></div>
      <a href="/login.php"><button class="login-button" style="margin-top: 10px">
          Se connecter
        </button></a>
    </div>

    <div class="login">
      <h1 class="title_connexion">CONNEXION</h1>
      <form action="" method="POST" class="form_log">
        <input class="email" type="email" name="email" placeholder="Email:" />

        <input class="mdp" type="password" name="password" placeholder="Mot de passe:" />

        <a href="">Mot de passe oublié ?</a>
        <div class="remember">
          <input type="checkbox" id="rememberme" name="check" checked />
          <label for="check">Se souvenir de moi</label>
        </div>

        <button id="btn" type="submit" class="connect_button">Se connecter</button>
      </form>
      <div id="loader" class="loader"></div>
      <script>
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

      <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require "database.php";
        // Get the email and password from the form
        $email = $_POST["email"];
        $password = $_POST["password"];
        $stmt = $_DB->execute(
          "SELECT password, surname, name, roles.role_name, roles.role_permission FROM users JOIN roles on users.id_role = roles.id_role WHERE email = :email",
          ["email" => $email]
        );
        if ($stmt->rowCount() > 0) {
          $row = $stmt->fetch();
          $password_hash = $row["password"];
          if (password_verify($password, $password_hash)) {
            echo "Password is valid!";
            session_start();
            $_SESSION["key"] = "take-eir";
            $_SESSION["name"] = $row["name"];
            $_SESSION["surname"] = $row["surname"];
            $_SESSION["email"] = $email;
            $_SESSION["role_name"] = $row["role_name"];
            $_SESSION["role_permission"] = $row["role_permission"];
          } else {
            echo '<p style="color: red;">Error, invalid password !</p>';
          }
        } else {
          echo "Error, bad credentials";
        }
      } ?>

      <a class="link_compt_crea" href="/register.php">Vous n'avez pas de compte ? Créez le</a>
    </div>
  </div>
</body>
<div class="bottom-bar">
  <a>© take-eir</a>
  <a href="/contact/contact.php">Nous contacter</a>
  <div class="medias">
    <!-- https://icons8.com/icons/set/social-media -->
    <a href="https://linkedin.com/"><img src="/images/icons8-linkedin-24.png" />
    </a>
    <a href="https://youtube.com/"><img src="/images/icons8-youtube-logo-24.png" /></a>
    <a href="https://twitter.com/"><img src="/images/icons8-twitter-24.png" />
    </a>
    <a href="https://instagram.com/"><img src="/images/icons8-instagram-24.png" />
    </a>
  </div>
</div>

</html>
