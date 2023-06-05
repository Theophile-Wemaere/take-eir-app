<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: /index.php/login");
    exit();
}
?>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/styles.css" />
    <link rel="stylesheet" href="/CSS/settings.css">
    <script src="/JS/scripts.js"></script>
    <script src="/JS/users.js"></script>
    <script src="/JS/settings.js"></script>
    <title>Modifier son e-mail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Nunito&display=swap"
        rel="stylesheet" />
</head>

<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/top-bar.php"; ?>

    <div class="wrapper">
        <h4 class="sent-notification"></h4>
        <form id="myForm">
            <h1>Modifiez votre adresse e-mail :</h1>
            <div class="separation"></div>
            <div class="corps-formulaire">
                <div class="droite">
                    <div class="groupe">
                        <div class="test">
                            <a href="/index.php/settings-profil"><i class="fa-solid fa-user"></i></a>
                            <a href="/index.php/settings-profil"><label>Profil</label></a>
                        </div>
                        <div class="test">
                            <a href="#"><i class="fa-solid fa-envelope current"></i></a>
                            <a href="#"><label> <span class="current"> E-mail</span> </label></a>
                        </div>
                        <div class="test">
                            <a href="/index.php/settings-mdp"><i class="fa-solid fa-key"></i></a>
                            <a href="/index.php/settings-mdp"><label>Mot de passe</label></a>
                        </div>
                        <div class="test">
                            <a href="/index.php/settings-notif"><i class="fa-solid fa-comment"></i></a>
                            <a href="/index.php/settings-notif"><label>Notifications</label></a>
                        </div>
                        <div class="test">
                            <a href="/index.php/settings-delete"><i class="fa-solid fa-trash"></i></a>
                            <a href="/index.php/settings-delete"><label><span class="supprimer">Supprimer le
                                        compte</span></label></a>
                        </div>
                    </div>
                </div>

                <div class="gauche">
                    <div class="groupe">
                        <label>E-mail actuel</label>
                        <input type="email" id="email" value=<?php echo $_SESSION["email"]; ?> disabled="disabled"
                            required>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="groupe">
                        <label>Nouvel e-mail</label>
                        <input id="password" name="email" required>
                        <i class="fa-solid fa-envelope"></i>
                        <p id="emailError" class="error-match">Merci d'entrer un email valide</p>
                    </div>
                    <div class="groupe">
                        <label>Vérification de l'e-mail</label>
                        <input id="confirm-password" type="email" name="confirm-email" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <script>
                        checkEmail("password");
                    </script>
                    <div id="password-match-message" class="error-match">Emails différents!</div>
                    <div id="error-msg" class="error-match">Cet email est déjà utilisé</div>
                    <div id="success-msg" class="error-match" style="color: green">Email mis à jour !</div>
                </div>
            </div>

            <center>
                <div class="pied-formulaire">
                    <button type="button" id='submit-btn' onclick="changeEmail()">Confirmer</button>
                    <div id="loader" class="loader"></div>
                    <script>
                        const btn = document.getElementById("submit-btn");
                        const loader = document.getElementById("loader");

                        btn.addEventListener("click", () => {
                            loader.style.display = "block";
                            // Code pour lancer une requête ou une opération qui prend du temps
                            setTimeout(() => {
                                loader.style.display = "none";
                            }, 2000); // Temps en millisecondes avant de cacher le loader
                        });
                        const passwordInput = document.getElementById("password");
                        const confirmPasswordInput = document.getElementById("confirm-password");
                        passwordInput.addEventListener("input", checkPasswordMatch);
                        confirmPasswordInput.addEventListener("input", checkPasswordMatch);
                    </script>
                </div>
            </center>
        </form>
    </div>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/bottom-bar.php"; ?>
</body>

</html>
