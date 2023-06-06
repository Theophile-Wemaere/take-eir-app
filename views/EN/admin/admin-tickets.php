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
  <script src="/JS/admin-tickets.js"></script>
  <script src="/JS/tickets.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Nunito&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/EN/top-bar.php"; ?>
  <div class="wrapper">
    <div class="tabs">
      <a href="/index.php/admin-faq" class="page-button">Manage FAQ</a>
      <a href="/index.php/admin-users" class="page-button">Manage utilisateurs</a>
      <a href="/index.php/admin-tickets" class="page-button active-tab">Manage tickets</a>
    </div>
    <div class="main-box">
      <div class="left-part">
        <select id="tags-filter">
          <option value=select>Choose a tag</option>
        </select>
        <script>
          getTags("tags-filter")
          const selectElement = document.getElementById("tags-filter");
          selectElement.addEventListener("change", function () {
            getTickets();
          });
        </script>
        <div id="tickets" class="tickets-container">
          <p style="text-align: center;height: 200px;">No tickets :(</p>
          <script>getTickets()</script>
        </div>
      </div>
      <div id="conv" class="conv">
        <p style="text-align: center;">Click on a ticket to display the conversation</p>
      </div>
    </div>
  </div>
  <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/EN/bottom-bar.php"; ?>
</body>

</html>