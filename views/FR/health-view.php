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
    <link rel="stylesheet" href="/CSS/health-view.css">
    <script src="/JS/scripts.js"></script>
    <script src="/JS/health-view.js"></script>
    <title>HEALTH-VIEW</title>
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
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/FR/top-bar.php"; ?>

    <div class="wrapper">
        <form id="myForm">
            <h1>Votre profil :</h1>
            <div class="separation"></div>
            <div class="corps-formulaire">
                <div class="groupe img-container">
                    <img id="profil_picture" />
                </div>
                <script>getProfilPicture()</script>

                <p class="role">
                    <?php echo $_SESSION["role_name"]; ?>
                </p>

                <div class="groupe">
                    <label><i class="fa-solid fa-user"></i>Prénom : </label>
                    <p>
                        <?php echo $_SESSION["name"]; ?>
                    </p>
                </div>

                <div class="groupe">
                    <label><i class="fa-solid fa-user"></i>Nom de famille : </label>
                    <p>
                        <?php echo $_SESSION["surname"]; ?>
                    </p>
                </div>

                <div class="groupe">
                    <label><i class="fa-solid fa-envelope"></i>Email : </label>
                    <p>
                        <?php echo $_SESSION["email"]; ?>
                    </p>
                </div>
                <a class="link" href="/index.php/settings-profil">Accéder aux paramètres</a>
            </div>
        </form>
        <div class="devices">
            <p class="patients">
                <?php
                if ($_SESSION["role_permission"] == "3") {
                    echo "Patients";
                } else {
                    echo "Vos appareils";
                } ?>
            </p>

            <div class="search">
                <input type="text" id="search" placeholder="Rechercher par nom, prénom, ..."
                    onkeydown="handleKeyDown(event)">
                <button type="button" onclick="getDevices()"><i class="fa fa-search"></i></button>
            </div>
            <script>
                function handleKeyDown(event) {
                    if (event.key === "Enter") {
                        getDevices();
                    }
                }
            </script>
            <div class="devices-list">
                <!--                 
                <div class="device">
                    <p id="key">123-456-789</p>
                    <p id="patient">Etienne Delorme</p>
                    <i class="fa fa-heartbeat"></i>
                    <p class="value">87 bpm</p>
                    <i class="fa fa-smile-o good"></i>
                    <p class="value">Good</p>
                </div> -->
            </div>
            <script>getDevices()</script>

            <div class="add">
                <p>Entrer votre health-key pour ajouter un appareil</p>
                <input type="text" id="health-key" placeholder="XXX-XXX-XXX">
                <button type="button" onclick="addKey()"><i class="fa fa-arrow-circle-right"></i></button>
            </div>
        </div>

    </div>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/views/bottom-bar.php"; ?>
</body>

</html>