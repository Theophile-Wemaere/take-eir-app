<!DOCTYPE html>

<?php
session_start();
if (!isset($_SESSION["role_permission"]) || $_SESSION["role_permission"] < 6) {
  header("Location: /");
}
?>

<head>
  <title>health-eir</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="/CSS/styles.css" />
  <link rel="stylesheet" href="/CSS/admin.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <script src="/JS/scripts.js"></script>
  <script src="/JS/admin-page.js"></script>
  <link rel="stylesheet" href="https://kit.fontawesome.com/bc424452bc.css" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Nunito&display=swap" rel="stylesheet" />
</head>

<html>

<body>
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
          <?php
          session_start();
          if (isset($_SESSION["key"])) {
            echo $_SESSION["name"] . " " . $_SESSION["surname"];
          } else {
            echo "Se connecter";
          }
          ?>

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
  <div class="wrapper">
    <div class="main-box">
      <form id="mySearch" onsubmit="return doSearch()">
        <input type="text" name="search" />
        <input type="submit" value="Search" />
      </form>
      <div id="results"></div>
      <script>
        doSearch();
      </script>
    </div>
  </div>
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
</body>

</html>