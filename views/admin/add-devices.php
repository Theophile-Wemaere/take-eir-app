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
  <link rel="stylesheet" href="/CSS/form.css">
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<style>

.main-box {
  flex-direction: column;
}

#container {
  display: flex;
  align-items: center;
  justify-content: center;
}

</style>

<html>

<body>
  <?php require "../views/top-bar.php"; ?>
  <div class="wrapper">
    <div class="main-box">
      <form>
        <p class="h1alt">Add devices</p>
        <div class="separation"></div>
        <div class="corps-formulaire">
          <div class="groupe">
            <label>how many devices to add ?</label>
            <input id="number" />
          </div>

        </div>
        <div class="pied-formulaire">
          <button id="submit-btn" type="button" onclick=addDevices()>envoyer</button>
          </script>
        </div>
      </form>

    <div id="container">
    </div>
    <script>getDevices()</script>
    </div>

  </div>
  <?php require "../views/bottom-bar.php"; ?>
</body>

</html>