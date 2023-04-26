<!DOCTYPE html>
<html lang="fr">
<head>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="stylesheet" href="/CSS/register.css" />
    <link rel="stylesheet" href="/CSS/styles.css" />
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
        <a href="/produit.html">
          <button class="page-button" style="margin-right: 10px">
            Notre produit
          </button></a
        >
        <div class="separator" style="margin-right: 10px"></div>
        <a href="/presentation.html">
          <button class="page-button" style="margin-right: 10px">
            Qui sommes nous ?
          </button></a
        >
        <a href="/login.php">
          <button class="login-button" style="margin-right: 10px">
            Se connecter
          </button></a
        >
      </div>
      <span style="pointer-events: auto">
        <div
          class="menu-button"
          href="javascript:void(0);"
          onclick="toggleMenu()"
        >
          <div class="sphere" style="background-color: #2d67e0"></div>
          <div class="sphere" style="background-color: #e0584c"></div>
          <div class="sphere" style="background-color: #5dd1b7"></div>
        </div>
      </span>
    </div>
    <div class="drop-menu" id="dropMenu" style="display: none">
      <a href="/produit.html"
        ><button class="page-button">Notre produit</button></a
      >
      <div class="separator"></div>
      <a href="/presentation.html"
        ><button class="page-button">Qui sommes nous ?</button></a
      >
      <div class="separator"></div>
      <a href="/login.php"
        ><button class="login-button" style="margin-top: 10px">
          Se connecter
        </button></a
      >
    </div>
  <div class="wrapper">
    <div class = "inscription">
        <h1 class="title_register">INSCRIPTION</h1>
        <form method="POST" class="form_inscription">

            <select name="personType" class="type">
                <option value="select">Choisissez votre statut</option>
                <option value="Patient/Famille">Patient</option>
                <option value="medecin">Medecin</option>
            </select>

            <label>Êtes-vous un ...</label>
            <hr>
            <div class="sex">
                <div class="h">
                <input type="checkbox" id="h" name="h" checked>
                <label for="h">Homme</label>
                </div>

                <div class="f">
                <input type="checkbox" id="f" name="f">
                <label for="f">Femme</label>
                </div>
              </div>

            <input class="Nom" type="text" name="name" placeholder="Prenom:">
            <input class="Prénom" type="text" name="surname" placeholder="Nom:">
            <input class="email" type="email" name="email"  placeholder="Email:">
            <input class="mdp" type="password"  placeholder="Mot de passe:">
            <input class="mdp" type="password" name="password"  placeholder="Confirmation mot de passe:">
        <button type="submit" class="register_button">S'inscrire</button>
        </form>
       <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
         require "database.php";
         // Get the email and password from the form
         $name = $_POST["name"];
         $surname = $_POST["surname"];
         $email = $_POST["email"];
         $password = $_POST["password"];

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
           "INSERT INTO users (name, surname, email, password, id_role) VALUES (:name, :surname, :email, :password, 3)";
         $stmt = $_DB->execute($sql, [
           "name" => $name,
           "surname" => $surname,
           "email" => $email,
           "password" => $hashedPassword,
         ]);

         // Check if the insert was successful
         if ($stmt->rowCount() > 0) {
           echo "User created successfully";
         } else {
           echo "Error creating user";
         }
       } ?>  
    </div>
  </div>
  <div class="bottom-bar">
    <a>© take-eir</a>
    <a href="/contact/contact.php">Nous contacter</a>
    <div class="medias">
      <!-- https://icons8.com/icons/set/social-media -->
      <a href="https://linkedin.com/"
        ><img src="/images/icons8-linkedin-24.png" />
      </a>
      <a href="https://youtube.com/"
        ><img src="/images/icons8-youtube-logo-24.png"
      /></a>
      <a href="https://twitter.com/"
        ><img src="/images/icons8-twitter-24.png" />
      </a>
      <a href="https://instagram.com/"
        ><img src="/images/icons8-instagram-24.png" />
      </a>
    </div>
  </div>
</body>
</html>
