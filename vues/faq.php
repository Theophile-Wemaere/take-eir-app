<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>F.A.Q</title>
  <link rel="stylesheet" href="/CSS/styles.css">
  <link rel="stylesheet" href="/CSS/faq.css">
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <script src="/JS/scripts.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Nunito&display=swap"
    rel="stylesheet" />

</head>

<body>

  <!-- partial:index.partial.html -->
  <!--=============== FONT AWESOME ===============-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

  <?php require "top-bar.php"; ?>
  <div class="wrapper">


    <h1>Foire aux questions</h1>
    <div id="faq" class="faq-container">
<script>
fetchFAQ()
</script>
    </div>
    <h3 class="noResponse" style="color: #3f2de1; padding: 10px 20px;">Vous n'avez pas trouvé de réponse à votre
      question ? <a href="../contact/contact.php" style="text-decoration:none; color:#e0584c;">Contactez-nous !</a></h3>
    <!-- partial -->
  </div>
  <?php require "bottom-bar.php"; ?>

</body>

</html>
