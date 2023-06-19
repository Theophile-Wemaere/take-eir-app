<?php
if (!isset($_SESSION["role_permission"])) {
  header("Location: /index.php/login");
} elseif ($_SESSION["role_permission"] < 6) {
  header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>health-eir</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="/CSS/styles.css" />
  <link rel="stylesheet" href="/CSS/faq.css">
  <link rel="stylesheet" href="/CSS/admin-faq.css" />
  <link rel="stylesheet" href="/CSS/admin.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <script src="/JS/scripts.js"></script>
  <script src="/JS/admin-faq.js"></script>
  <link rel="stylesheet" href="https://kit.fontawesome.com/bc424452bc.css" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Nunito&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<html>

<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/EN/top-bar.php"; ?>
  <div class="wrapper">
    <div class="tabs">
      <a href="/index.php/admin-faq" class="page-button active-tab">Manage FAQ</a>
      <a href="/index.php/admin-users" class="page-button">Manage utilisateurs</a>
      <a href="/index.php/admin-tickets" class="page-button">Manage tickets</a>
    </div>
    <form>
      <p class="h1alt">Create an article</p>
      <div class="separation"></div>
      <div class="corps-formulaire">
        <div class="groupe">
          <label>Topic of the article</label>
          <input id="subject" name="subject" />
        </div>
        <textarea id="body" placeholder="Enter here..." name="body"></textarea>
      </div>
      <div class="pied-formulaire">
        <button id="btn" type="button" onclick=createArticle()>Create article</button>
      </div>
    </form>
    <div id="faq" class="faq-container">
      <script>
        fetchFAQ_admin()
      </script>
    </div>

  </div>
  <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/EN/bottom-bar.php"; ?>
</body>

</html>