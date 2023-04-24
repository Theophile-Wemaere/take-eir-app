<!DOCTYPE html>
<html lang="fr">
  <head>
    <link rel="stylesheet" href="/CSS/login.css" />
    <link rel="stylesheet" href="/CSS/styles.css" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="utf-8"/>
    <title id="connexion">Login TAKE-EIR</title>
    <script src="/JS/scripts.js"></script>
    <link
      href="https://fonts.googleapis.com/css?family=Krona+One"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Reem+Kufi"
      rel="stylesheet"
    />
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
            </button></a
          >
          <div class="separator" style="margin-right: 10px"></div>
          <a href="/presentation.html">
            <button class="page-button" style="margin-right: 10px">
              Qui sommes nous ?
            </button></a
          >
          <a href="/login.php">
            <button class="login-button" style="margin-right: 10px">
              Se connecter
            </button></a
          >
        </div>
        <span style="pointer-events: auto">
          <div
            class="menu-button"
            href="javascript:void(0);"
            onclick="toggleMenu()"
          >
            <div class="sphere" style="background-color: #2d67e0"></div>
            <div class="sphere" style="background-color: #e0584c"></div>
            <div class="sphere" style="background-color: #5dd1b7"></div>
          </div>
        </span>
      </div>
      <div class="drop-menu" id="dropMenu" style="display: none">
        <a href="/produit.html"
          ><button class="page-button">Notre produit</button></a
        >
        <div class="separator"></div>
        <a href="/presentation.html"
          ><button class="page-button">Qui sommes nous ?</button></a
        >
        <div class="separator"></div>
        <a href="/login.php"
          ><button class="login-button" style="margin-top: 10px">
            Se connecter
          </button></a
        >
      </div>

      <div class="login">
        <h1 class="title_connexion">CONNEXION</h1>
        <form action="" method="get" class="form_log">
          <input
            class="email"
            type="email"
            name="E-mail"
            placeholder="Email:"
          />

          <input
            class="mdp"
            type="password"
            name="Mot de passe"
            placeholder="Mot de passe:"
          />

          <a href="">Mot de passe oublié ?</a>
          <div class="remember">
            <input type="checkbox" id="check" name="check" checked />
            <label for="check">Se souvenir de moi</label>
          </div>
        </form>

        <button id="btn" class="connect_button">Se connecter</button>
        <div id="loader" class="loader"></div>
        <script>
          const btn = document.getElementById("btn");
          const loader = document.getElementById("loader");

          btn.addEventListener("click", () => {
            loader.style.display = "block";
            // Code pour lancer une requête ou une opération qui prend du temps
            setTimeout(() => {
              loader.style.display = "none";
            }, 3000); // Temps en millisecondes avant de cacher le loader
          });
        </script>
        
       <?php
       require "database.php";
       // Get the email and password from the form
       $email = $_POST["email"];
       $password = $_POST["password"];
       $results = $_DB->execute("show tables");
       echo $results;
       ?>  

        <a class="link_compt_crea" href="/register.php"
          >Vous n'avez pas de compte ? Créez le</a
        >
      </div>
    </div>
  </body>
  <div class="bottom-bar">
    <a>© take-eir</a>
    <a href="/contact.html">Nous contacter</a>
    <div class="medias">
      <!-- https://icons8.com/icons/set/social-media -->
      <a href="https://linkedin.com/"
        ><img src="/images/icons8-linkedin-24.png" />
      </a>
      <a href="https://youtube.com/"
        ><img src="/images/icons8-youtube-logo-24.png"
      /></a>
      <a href="https://twitter.com/"
        ><img src="/images/icons8-twitter-24.png" />
      </a>
      <a href="https://instagram.com/"
        ><img src="/images/icons8-instagram-24.png" />
      </a>
    </div>
  </div>
</html>
