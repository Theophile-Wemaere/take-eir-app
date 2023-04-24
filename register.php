<!DOCTYPE html>
<html lang="fr">
<head>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="stylesheet" href="/CSS/register.css" />
    <link rel="stylesheet" href="/CSS/styles.css" />
    <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<title>Register</title>
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
    <div class = "inscription">
        <h1 class="title_register">INSCRIPTION</h1>
        <form action = "" method="get" class="form_inscription">
            <input class="Nom" type="text" name="name" placeholder="Nom :">
            <input class="Prénom" type="text" name="first_name" placeholder="Prenom :">
            <input class="email" type="email" name="E-mail"  placeholder="Email:">
            <input class="mdp" type="password" name="Mot de passe"  placeholder="Mot de passe:">
        </form>
        <button class="register_button">S'inscrire</button>
    </div>
  </div>
</body>
</html>
