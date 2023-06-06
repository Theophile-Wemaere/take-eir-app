<?php
if (!isset($_SESSION["email"])) {
    header("Location: /index.php/login");
    exit();
}
?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/styles.css" />
    <link rel="stylesheet" href="/CSS/settings.css">
    <script src="/JS/scripts.js"></script>
    <script src="/JS/settings.js"></script>
    <title>Modifier son profil</title>
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
            <h1>Modifiez votre profil :</h1>
            <div class="separation"></div>

            <div class="corps-formulaire">
                <div class="droite">
                    <div class="groupe">
                        <div class="test">
                            <a href="#"><i class="fa-solid fa-user current"></i></a>
                            <a href="#"><label><span class="current">Profil</span></label></a>
                        </div>
                        <div class="test">
                            <a href="/index.php/settings-email"><i class="fa-solid fa-envelope"></i></a>
                            <a href="/index.php/settings-email"><label>E-mail</label></a>
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
                    
                    <div class="groupe img-container">
                        <img id="profil_picture"/>
                            <input type="file" accept="image/*" id="picture_file" required>
                    </div>
                    <script>getProfilPicture()</script>


                    <select id="role" name="role" class="type">
                        <option value=select>Choisissez votre statut</option>
                        <option value=famille>Patient/Famille</option>
                        <option value=medecin>Medecin</option>
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

                    <div class="groupe">
                        <label>Prénom</label>
                        <input id="name" value=<?php echo $_SESSION["name"]; ?> required>
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <div class="groupe">
                        <label>Nom de famille</label>
                        <input id="surname" value=<?php echo $_SESSION["surname"]; ?> required>
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <script>
                        getProfil();
                    </script>
                    <div id="error-msg" class="error-match">Merci de remplir tous les champs</div>
                    <div id="error-upload" class="error-match">Merci image</div>
                    <div id="success-msg" class="error-match" style="color: green">Profil mis à jour !</div>
                </div>
            </div>

            <center>
                <div class="pied-formulaire">
                    <button type="button" id='submit-btn' onclick="updateProfil()">Confirmer</button>
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
                    </script>
                </div>
            </center>
        </form>
    </div>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/bottom-bar.php"; ?>
</body>

</html>
