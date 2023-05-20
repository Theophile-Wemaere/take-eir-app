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
  <?php require "top-bar.php"; ?>
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
          <div class="equip-block">
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
          </div>
          <div class="equip-block">
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
    </div>
    <script type="text/javascript" src="/JS/smooth-scroll.js"></script>
  </div>
  <?php require "bottom-bar.php"; ?>
</body>

</html>
