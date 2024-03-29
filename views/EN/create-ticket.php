<?php
if (!isset($_SESSION["email"])) {
  header("Location: /index.php/login");
}
?>
<!DOCTYPE html>
<html lang="en">

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
  <script src="/JS/tickets.js"></script>
  <link rel="stylesheet" href="https://kit.fontawesome.com/bc424452bc.css" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Nunito&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<html>

<body>
  <?php require "top-bar.php"; ?>
  <div class="wrapper">
<div class="main-box">
    <form>
      <p class="h1alt">Open a ticket</p>
      <div class="separation"></div>
      <div class="corps-formulaire">
        <div class="groupe">
          <label>Ticket topic</label>
          <input id="subject" name="subject" />
        </div>

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

        <textarea id="body" placeholder="Enter here..." name="body"></textarea>
      </div>
      <div class="pied-formulaire">
              <button id="btn" type="button" onclick=createTicket()>send</button>
      </div>
      <p id="error-msg" style="text-align:center;color: red;display: none;"></p> 
    </form>
    </div>

  </div>
  <?php require "bottom-bar.php"; ?>
</body>

</html>
