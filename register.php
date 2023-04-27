<!DOCTYPE html>
<html lang="fr">
<?php
session_start();
if (isset($_SESSION["name"])) {
  header("Location: /");
}
?>

<head>
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <link rel="stylesheet" href="/CSS/register.css" />
  <link rel="stylesheet" href="/CSS/styles.css" />
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <title>Register</title>
  <script src="/JS/scripts.js"></script>
</head>

<body>
  <div class="top-bar">
    <div class="top-bar-img">
      <a href="/"><img src="/images/logo-notext.png" /></a>
    </div>
    <div class="right-items">
      <a href="/produit.php">
        <button class="page-button" style="margin-right: 10px">
          Notre produit
        </button></a>
      <div class="separator" style="margin-right: 10px"></div>
      <a href="/presentation.php">
        <button class="page-button" style="margin-right: 10px">
          Qui sommes nous ?
        </button></a>
      <a href="/login.php">
        <button class="login-button" style="margin-right: 10px">
          Se connecter
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
    <a href="/produit.php"><button class="page-button">Notre produit</button></a>
    <div class="separator"></div>
    <a href="/presentation.php"><button class="page-button">Qui sommes nous ?</button></a>
    <div class="separator"></div>
    <a href="/login.php"><button class="login-button" style="margin-top: 10px">
        Se connecter
      </button></a>
  </div>
  <div class="wrapper">
    <div class="inscription">
      <h1 class="title_register">INSCRIPTION</h1>
      <form method="POST" class="form_inscription">
        <select name="role" class="type">
          <option value=3>Choisissez votre statut</option>
          <option value=3>Patient/Famille</option>
          <option value=2>Medecin</option>
        </select>

        <div class="gender">
          <div class="h">
            <input type="checkbox" id="h" name="gender" value="M" checked>
            <label for="h">Homme</label>
          </div>

          <div class="f">
            <input type="checkbox" id="f" name="gender" value="F">
            <label for="f">Femme</label>
          </div>
        </div>

        <script>
          const checkboxes = document.querySelectorAll('input[name="gender"]');

          checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", (event) => {
              checkboxes.forEach((cb) => {
                if (cb !== event.target) {
                  cb.checked = false;
                }
              });
            });
          });
        </script>

        <input class="Nom" type="text" name="name" placeholder="Prenom:" required>
        <input class="Prénom" type="text" name="surname" placeholder="Nom:" required>
        <input class="email" type="email" name="email" placeholder="Email:" required>
        <input id="password" class="mdp" type="password" placeholder="Mot de passe:" required>
        <input id="confirm-password" class="mdp" type="password" name="password" placeholder="Confirmation mot de passe:" required>
        <div id="password-match-message" style="display:none;color:red;">Passwords doesn't match</div>
        <button id="submit-button" type="submit" class="register_button">S'inscrire</button>
        <script>
          const passwordInput = document.getElementById("password");
          const confirmPasswordInput = document.getElementById("confirm-password");
          const submitButton = document.getElementById("submit-button")
          const message = document.getElementById("password-match-message");

          function checkPasswordMatch() {
            if (passwordInput.value !== confirmPasswordInput.value) {
              submitButton.disabled = true;
              submitButton.style.pointerEvents = 'none';
              submitButton.style.opacity = '0.5';
              message.style.display = "block";
            } else {
              submitButton.disabled = false;
              submitButton.style.pointerEvents = 'auto';
              submitButton.style.opacity = '1';
              message.style.display = "none";
            }
          }

          passwordInput.addEventListener("input", checkPasswordMatch);
          confirmPasswordInput.addEventListener("input", checkPasswordMatch);
        </script>

      </form>
      <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require "database.php";
        // Get the email and password from the form
        $role = $_POST["role"] == null ? 2 : $_POST["role"];
        $gender = $_POST["gender"];
        $name = htmlspecialchars($_POST["name"]);
        $surname = htmlspecialchars($_POST["surname"]);
        $email = htmlspecialchars($_POST["email"]);
        $id = md5($email);
        $password = $_POST["password"];

        $stmt = $_DB->execute("SELECT * FROM users WHERE id_user = :id", [
          "id" => $id,
        ]);
        if ($stmt->rowCount() > 0) {
          echo '<p style="color: red;">Error, user with this email already exist !</p>';
        } else {
          // Generate hashed password using PASSWORD_ARGON2ID algorithm
          $options = [
            "memory_cost" => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
            "time_cost" => PASSWORD_ARGON2_DEFAULT_TIME_COST,
            "threads" => PASSWORD_ARGON2_DEFAULT_THREADS,
          ];
          $hashedPassword = password_hash(
            $password,
            PASSWORD_ARGON2ID,
            $options
          );

          // Prepare and execute the query to insert the new user into the database
          $sql =
            "INSERT INTO users (id_user, name, surname, email, password, id_role, gender) VALUES (:id,:name, :surname, :email, :password, :role, :gender)";
          $stmt = $_DB->execute($sql, [
            "id" => $id,
            "name" => $name,
            "surname" => $surname,
            "email" => $email,
            "password" => $hashedPassword,
            "role" => $role,
            "gender" => $gender,
          ]);

          // Check if the insert was successful
          if ($stmt->rowCount() > 0) {
            echo "User created successfully";
            session_start();
            $_SESSION["name"] = $name;
            $_SESSION["surname"] = $surname;
            $_SESSION["email"] = $email;
            $row = $_DB
              ->execute(
                "SELECT role_name,role_permission from roles where id_role = :id",
                [
                  "id" => $role,
                ]
              )
              ->fetch();
            $_SESSION["role_name"] = $row["role_name"];
            $_SESSION["role_permission"] = $row["role_permission"];
          } else {
            echo '<p style="color: red;">Error creating user !</p>';
          }
        }
      } ?>

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
