<!DOCTYPE html>

<head>
  <title>health-eir</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="/CSS/styles.css" />
  <link rel="stylesheet" href="/CSS/presentation.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <script src="/JS/scripts.js"></script>
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

      <div class="dropdown">
        <button id="menu-btn" onmouseenter="dropMenuPres()" onmouseleave="dropMenuPres()" class="dropbtn current-button">
          Qui sommes nous ?
        </button>
        <div id="myDropdown" onmouseleave="dropMenuPres()" class="dropdown-content">
          <a href="#title" class="smooth-scroll">Notre Client</a>
          <a href="#sectionNous" class="smooth-scroll">Qui sommes-nous</a>
          <a href="#sectionEquipe" class="smooth-scroll">Notre Equipe</a>
        </div>
      </div>

      <a href="/login.php">
        <button class="login-button" style="margin-right: 10px">
          <?php
          session_start();
          if (isset($_SESSION["email"])) {
            echo $_SESSION["name"] . " " . $_SESSION["surname"];
          } else {
            echo "Se connecter";
          }
          ?>
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
    <a href="/presentation.php"><button class="page-button current-button">
        Qui sommes nous ?
      </button></a>
    <div class="separator"></div>
    <a href="/login.php"><button class="login-button" style="margin-top: 10px">
        <?php
        session_start();
        if (isset($_SESSION["email"])) {
          echo $_SESSION["name"] . " " . $_SESSION["surname"];
        } else {
          echo "Se connecter";
        }
        ?>
      </button></a>
  </div>

  <div class="wrapper">
    <div class="box">
      <h3 id="title">Notre Client :</h3>
      <div class="corps">
        <table>
          <tr>
            <td style="width: 30%">
              <img class="client-img" src="/images/Infinite_measures.png" />
            </td>
            <!-- METTRE LA PHOTO INFINITE MEASURES -->
            <td style="float: right">
              <p class="textcorp">
                Infinite Measure, un client à la recherche de solutions pour
                l'environnement, a lancé un appel d'offre pour la création
                d'un capteur modulaire, paramétrable et bon marché pour une
                diffusion de masse. Nous avons décidé de répondre à leur appel d'offre,
                et en se basant sur leur cahier des charges.
              </p>
              <p class="textcorp">
                Nous avons conçu Health-Eir : un dispositif permettant
                d’optimiser une hospitalisation à domicile.
              </p>
            </td>
          </tr>
        </table>
      </div>

      <h3 id="sectionNous">Qui sommes-nous ?</h3>
      <div class="corps">
        <center>
          <img id="projet-img" src="/images/logo-whitebg.png" />
        </center>
        <div>
          <p class="textcorp" id="paragraph1">
            Nous sommes Take Eir, une jeune startup composée d’ingénieurs
            spécialisés dans la conception de solutions éléctroniques et
            informatiques. Nous travaillons avec des clients de divers
            secteurs pour leur fournir des produits innovants et sur-mesure
            qui répondent au mieux à leurs besoins.
          </p>
        </div>
        <p class="textcorp" id="paragraph2">
          Notre équipe expérimentée est passionnée par la technologie et
          déterminée à fournir des solutions de pointe pour aider nos clients
          à atteindre leurs objectifs. Nous sommes fiers de notre engagement
          envers la qualité et la fiabilité, et nous nous efforçons de
          maintenir des normes élevées dans tout ce que nous faisons.
        </p>

        <p class="textcorp" id="paragraph3">
          Chez Take Eir, nous sommes convaincus que la technologie peut
          changer le monde, et nous sommes déterminés à jouer un rôle clé dans
          cette transformation, tout en respectant l’environnement via des
          méthodes de conception éco-responsables.
        </p>
      </div>
      <h3 id="sectionEquipe">Notre Équipe :</h3>
      <div class="corps">
        <div>
          <p class="textcorp">
            Dîplomés d’une grande école d’ingénieurs, nos membres sont
            spécialisés dans les technologies du numérique. Découvrez-les :
          </p>
        </div>
        <div class="equip-div">
          <div class="equip-grid">
            <figure>
              <img class="equip-img" src="/images/sofiane.png" />
              <figcaption>Sofiane SIFAOUI</figcaption>
            </figure>
          </div>
          <div class="equip-grid">
            <figure>
              <img class="equip-img" src="/images/theo.png" />
              <figcaption>Théophile WEMAERE</figcaption>
            </figure>
          </div>
          <div class="equip-grid">
            <figure>
              <img class="equip-img" src="/images/imad.png" />
              <figcaption>Imad RACHATI</figcaption>
            </figure>
          </div>
          <div class="equip-grid">
            <figure>
              <img class="equip-img" src="/images/maxime.png" />
              <figcaption>Maxime VETTORATO</figcaption>
            </figure>
          </div>
          <div class="equip-grid">
            <figure>
              <img class="equip-img" src="/images/quentin.png" />
              <figcaption>Quentin VERMONT</figcaption>
            </figure>
          </div>
          <div class="equip-grid">
            <figure>
              <img class="equip-img" src="/images/alex.png" />
              <figcaption>Alexandre MELLE</figcaption>
            </figure>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="/JS/smooth-scroll.js"></script>
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
