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
      <p class="h1alt">Forgot your password ?</p>
      <div class="separation"></div>
      <div class="corps-formulaire">
        <div class="groupe">
          <label>Enter your email below</label>
          <label>You will receive an email to create a password</label>
          <input id="email"/>
          <p id="emailError" class="error-match">Please enter a valdi email</p>
          <div id="error-msg" class="error-match">Error, this email doesn't exists</div>
          <div id="success-msg" class="error-match" style="color: green">An email was sent !</div>
        </div>

      </div>
      <div class="pied-formulaire">
        <button id="submit-btn" type="button" onclick=resetPassword()>Send</button>
        <script>checkEmail("email")
        const input = document.getElementById("email");
        input.addEventListener("input", function () {
            const error = document.getElementById("emailError");
            const btn = document.getElementById("submit-btn");
            if(error.style.display == "none") {
                btn.disabled = false;
                btn.style.pointerEvents = "auto";
                btn.style.opacity = "1";
            } else {
                btn.disabled = true;
                btn.style.pointerEvents = "none";
                btn.style.opacity = "0.5";
            }
        });
        </script>
      </div>
    </form>
    </div>

  </div>
  <?php require "bottom-bar.php"; ?>
</body>

</html>
