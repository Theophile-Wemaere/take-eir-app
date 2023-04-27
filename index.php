<!DOCTYPE html>

<head>
    <title>health-eir</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="/CSS/styles.css" />
    <link rel="stylesheet" href="/CSS/carroussel.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="/JS/scripts.js"></script>
    <link rel="stylesheet" href="https://kit.fontawesome.com/bc424452bc.css" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Nunito&display=swap" rel="stylesheet" />
</head>

<html>

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
            <div class="dropdown">
                <a href="/login.php">
                    <button class="login-button" id="user-menu" onmouseenter="dropMenuUser()" onmouseleave="dropMenuUser()">
                        <?php
                        session_start();
                        if (isset($_SESSION["email"])) {
                            echo $_SESSION["name"] .
                                " " .
                                $_SESSION["surname"] .
                                " &nabla;";
                        } else {
                            echo "Se connecter";
                        }
                        ?>
                    </button></a>
                <?php if (isset($_SESSION["email"])) {
                    echo '<div id="userDropdown" onmouseleave="dropMenuUser()" class="dropdown-content">';
                    echo "<p>" . $_SESSION["role_name"] . "</p>";
                    echo '<a href="/monitor.php">HEALTH-EIR View</a>
          <a href="#" onclick="logout()">Se deconnecter</a>
        </div>';
                } ?>
            </div>

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
        <a href="/login.php"><button class="login-button" style="margin-top: 10px;margin-bottom: 10px;">
                <?php
                session_start();
                if (isset($_SESSION["email"])) {
                    echo $_SESSION["name"] . " " . $_SESSION["surname"];
                } else {
                    echo "Se connecter";
                }
                ?>
            </button></a>
        <?php if (isset($_SESSION["email"])) {
            echo "<p>" . $_SESSION["role_name"] . "</p>";
            echo '<a href="/monitor.php"><button class="page-button">HEALTH-EIR View</button></a>
          <a href="#" onclick="logout()"><button class="page-button">Se deconnecter</button></a>';
        } ?>

    </div>
    <div class="wrapper">

        <div class="main-box">
            <div class="left-part">
                <h1>La révolution de l’hospitalisation à domicile !</h1>
                <h3>
                    Le dispositif Health-EIR permet d’évaluer, en temps réel, la qualité
                    de votre prise en charge à domicile. Il intègre différents capteurs
                    permettant de mesurer des grandeurs environnementales et
                    physiologiques.
                </h3>
            </div>
            <img src="/images/ai-render.png" />
        </div>
        <div class="container">
            <div class="carousel">
                <div class="carousel__face"><span>Health-Eir</span></div>
                <div class="carousel__face"><span>Révolutionne</span></div>
                <div class="carousel__face"><span>Le concept</span></div>
                <div class="carousel__face"><span>De l'hospitalisation à domicile</span></div>
                <div class="carousel__face"><span>Notre équipe</span></div>
                <div class="carousel__face"><span>a travaillé dur</span></div>
                <div class="carousel__face"><span>pour vous proposer</span></div>
                <div class="carousel__face"><span>ce produit d'exception</span></div>
                <div class="carousel__face"><span>Essayez-le !</span></div>
            </div>
        </div>
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
