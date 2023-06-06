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
    <title>Change your password</title>
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

<style>
    form div.corps-formulaire {
        flex-direction: column;
    }

    form {
        width: 30%;
        min-width: 250px;
    }

    .gauche {
        max-width: 100%;
        width: 100%;
        justify-content: center;
        align-items: center;
    }
</style>

<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/EN/top-bar.php"; ?>


    <div class="wrapper">
        <h4 class="sent-notification"></h4>
        <form id="myForm">
            <h1>Change your password :</h1>
            <div class="separation"></div>

            <div class="corps-formulaire">
                <div class="gauche">
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
                    <div id="password-match-message" class="error-match">Passwords don't match!</div>
                    <div id="error-msg" class="error-match">Error, this token is invalid or incorrect</div>
                </div>
            </div>

            <center>
                <div class="pied-formulaire">
                    <button type="button" id="submit-btn" onclick="newPassword()">Confirm</button>
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
                        setupPasswordValidation();
                        checkValidity();
                    </script>
                </div>
            </center>


        </form>
    </div>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/EN/bottom-bar.php"; ?>
</body>

</html>
