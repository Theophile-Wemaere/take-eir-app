<!DOCTYPE html>
<html lang="fr">
<?php
session_start();
if (!isset($_SESSION["role_permission"])) {
  header("Location: /index.php/login");
} elseif($_SESSION["role_permission"] < 6) {
  header("Location: /");
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>F.A.Q</title>
  <link rel="stylesheet" href="/CSS/styles.css">
  <link rel="stylesheet" href="/CSS/form.css">
  <link rel="stylesheet" href="/CSS/tickets.css">
  <link rel="stylesheet" href="/CSS/admin.css" />
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <script src="/JS/scripts.js"></script>
  <script src="/JS/admin-page.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Nunito&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>
  <?php require "../views/top-bar.php"; ?>
  <div class="wrapper">
    <div class="tabs">
      <a href="/admin/admin-faq.php" class="page-button">Gérer FAQ</a>  
      <a href="/admin/admin-users.php"  class="page-button">Gérer utilisateurs</a>  
      <a href="/admin/admin-tickets.php" class="page-button active">Gérer tickets</a>  
    </div>
    <div class="main-box">
        <div class="left-part">
          <div id="tickets" class="tickets-container">
            <p style="text-align: center;height: 200px;">Aucun tickets :(</p>
            <script>getTickets()</script>
          </div>
        </div>
        <div id="conv" class="conv">
          <p style="text-align: center;">Cliquer sur un ticket pour afficher la conversation</p>
        </div>
    </div>
  </div>
  <?php require "../views/bottom-bar.php"; ?>
</body>

</html>
