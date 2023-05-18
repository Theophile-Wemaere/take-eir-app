<!DOCTYPE html>
<html lang="fr">
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
  <?php require "../vues/top-bar.php"; ?>
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
  <?php require "../vues/bottom-bar.php"; ?>
</body>

</html>
