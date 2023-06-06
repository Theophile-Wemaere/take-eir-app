<?php
if (!isset($_SESSION["email"])) {
    header("Location: /index.php/login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/styles.css" />
    <link rel="stylesheet" href="/CSS/mdp_settings.css">
    <script src="/JS/scripts.js"></script>
    <script src="/JS/settings.js"></script>
    <title>Update password</title>
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
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/EN/top-bar.php"; ?>


    <div class="wrapper">
        <h4 class="sent-notification"></h4>
        <form id="myForm">
            <h1>Update your password :</h1>
            <div class="separation"></div>

            <div class="corps-formulaire">
                <div class="droite">
                    <div class="groupe">
                        <div class="test">
                            <a href="/index.php/settings-profil"><i class="fa-solid fa-user"></i></a>
                            <a href="/index.php/settings-profil"><label>Profil</label></a>
                        </div>
                        <div class="test">
                            <a href="/index.php/settings-email"><i class="fa-solid fa-envelope"></i></a>
                            <a href="/index.php/settings-email"><label> E-mail </label></a>
                        </div>
                        <div class="test">
                            <a href="#"><i class="fa-solid fa-key"></i></a>
                            <a href="#"><label><span class="current">Password</span></label></a>
                        </div>
                        <div class="test">
                            <a href="/index.php/settings-notif"><i class="fa-solid fa-comment"></i></a>
                            <a href="/index.php/settings-notif"><label>Notifications</label></a>
                        </div>
                        <div class="test">
                            <a href="/index.php/settings-delete"><i class="fa-solid fa-trash"></i></a>
                            <a href="/index.php/settings-delete"><label><span class="supprimer">Delete account</span></label></a>
                        </div>
                    </div>
                </div>

                <div class="gauche">
                    <div class="groupe">
                        <label>Current password</label>
                        <input id="current-password" type="password" name="name" require>
                        <i class="fa-solid fa-user"></i>
                        <div id="error-msg" class="error-match">Wrong password !</div>
                    </div>
                    <div class="groupe">
                        <label>New password</label>
                        <input id="password" type="password" name="email" require>
                        <i class="fa-solid fa-key"></i>
                        <p id="passwordError" class="error-match">Minimum 8 characters with:</br>
              one uppercase letter,</br> one number,</br> and one special character (@$!%*?&)</p>
                    </div>
                    <div class="groupe">
                        <label>Confirm password</label>
                        <input id="confirm-password" type="password" name="phoneNumber">
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <div id="password-match-message" class="error-match">passwords don't match !</div>
                    <div id="success-msg" class="error-match" style="color: green">Password updated !</div>
                    <a style="margin-top:20px;" href="/index.php/reset-passwd">Forgot password ?</a>
                </div>
            </div>

            <center>
                <div class="pied-formulaire">
                    <button type="button" id="submit-btn" onclick="changePassword()">Confirm</button>
                    <div id="loader" class="loader"></div>
                    <script>
                        setupPasswordValidation();
                        checkValidity();
                        
                        const btn = document.getElementById("submit-btn");
                        const loader = document.getElementById("loader");

                        btn.addEventListener("click", () => {
                            loader.style.display = "block";
                            // Code pour lancer une requête ou une opération qui prend du temps
                            setTimeout(() => {
                                loader.style.display = "none";
                            }, 2000); // Temps en millisecondes avant de cacher le loader
                        });
                    </script>
                </div>
            </center>


        </form>
    </div>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/EN/bottom-bar.php"; ?>
</body>

</html>
