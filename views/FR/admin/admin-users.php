<?php
if (!isset($_SESSION["role_permission"])) {
  header("Location: /index.php/login");
} elseif ($_SESSION["role_permission"] < 6) {
  header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <title>health-eir</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="/CSS/styles.css" />
  <link rel="stylesheet" href="/CSS/admin-users.css" />
  <link rel="stylesheet" href="/CSS/admin.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <script src="/JS/scripts.js"></script>
  <script src="/JS/admin-users.js"></script>
  <link rel="stylesheet" href="https://kit.fontawesome.com/bc424452bc.css" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Nunito&display=swap"
    rel="stylesheet" />
</head>

<html>

<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/FR/top-bar.php"; ?>
  <div class="wrapper">
    <div class="tabs">
      <a href="/index.php/admin-faq" class="page-button">Gérer FAQ</a>
      <a href="/index.php/admin-users" class="page-button active-tab">Gérer utilisateurs</a>
      <a href="/index.php/admin-tickets" class="page-button">Gérer tickets</a>
    </div>
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
  <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/FR/bottom-bar.php"; ?>
</body>

</html>