<!DOCTYPE html>
<html lang="fr">

<head>
  <link rel="stylesheet" href="/CSS/produit.css" />
  <link rel="stylesheet" href="/CSS/styles.css" />
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta charset="utf-8" />
  <title id="Pres_prod">Notre produit HEALTH EIR</title>
  <script src="/JS/scripts.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />
</head>

<body>
  <?php require "top-bar.php"; ?>
  <div class="wrapper">
    <div class="main-box">
      <div class="text-container">
        <h1 class="Title_prod">Notre dispositif Health-Eir</h1>
      </div>
      <div class="introduction">
        <p>
          La crise de la Covid-19 a démocratisé la télémédecine en entrainant
          une hausse historique des téléconsultations et des hospitalisations
          à domicile.
          <br />
          C’est pourquoi nous développons le dispositif Health-Eir. Notre
          produit est destiné à monitorer l'état de santé d'un patient
          hospitalisé à domicile. Il permet non seulement d'évaluer la qualité
          environnementale de la chambre d'hospitalisation, mais aussi suivre
          en temps réel l'état de santé du patient, grâce à divers capteurs.
          <br />
          <br />
          Nous travaillons en étroite collaboration avec le corps médical pour
          vous proposer la meilleure solution possible!
        </p>
        <div class="image-prod"></div>
      </div>

      <div class="arrow">
        <a href="#ancrage"><span></span></a>
        <a href="#ancrage"><span></span></a>
        <a href="#ancrage"><span></span></a>
      </div>

      <div class="text-container">
        <h2 class="texte-milieu" id="ancrage">
          Notre dispositif embarque les capteurs suivants :
        </h2>
      </div>

      <div class="dust-cpt">
        <p>
          Le suivi de la qualité de l’air et de sa concentration en
          microparticules est nécessaire, afin de favoriser le bien-être et la
          guérison des patients. Pour cela, le capteur SHARP récolte les
          données liées au taux de microparticules dans l’air.
          <br />
          <br />
          Ce capteur détecte les microparticules grâce à une technologie
          infrarouge innovante et fournit des mesures de grande précision !
        </p>
        <div class="image-dust-cpt"></div>
      </div>

      <div class="co2-cpt">
        <div class="image-co2-cpt"></div>

        <p>
          Couplé à notre capteur de microparticules, le capteur MICS-VZ-89TE
          permet de mesurer le taux de C02 de la chambre d'hospitalisation.
          <br />
          C'est l’indicateur principal qui permet de déterminer à partir de
          quel moment il faut aérer.
        </p>
      </div>

      <div class="temp-cpt">
        <p>
          De nombreuses études démontrent l’influence directe de la
          température et de l’humidité sur la qualité de l’air ambiant, ainsi
          que sur les occupants des lieux intérieurs. La mesure régulière et
          automatisée de ces deux paramètres constitue alors une bonne
          estimation de la qualité de l’air intérieur, et permet de limiter
          l’impact négatif – sur la santé, le bien-être et la productivité –
          d’un environnement pollué.
          <br />
          Le capteur DHT11 permet cette fonctionnalité.
        </p>
        <div class="image-temp-cpt"></div>
      </div>

      <div class="noise-cpt">
        <div class="image-noise-cpt"></div>

        <p>
          Le bruit, même à un faible niveau sonore, peut causer des effets
          néfastes sur la santé des patients. Dans ce cadre, nous proposons
          d'évaluer la qualité de l’ambiance sonore de votre pièce
          d'hospitalisation, grâce à notre capteur audio MAX4466.
        </p>
      </div>

      <div class="heart-cpt">
        <p>
          Le rythme cardiaque du patient hospitalisé à domicile est mesuré
          grâce au capteur Grove Ear-Clip Heart Sensor, qui utilise une
          technique de variation de luminosité induite par la pulsation
          cardiaque dans un vaisseau sanguin.
          <br />
          <br />
          Cette mesure est particulièrement pertinente dans notre cas
          d’utilisation, puisqu'elle permet de suivre, en temps réel, l'état
          de santé du patient hospitalisé. C’est en effet l’un des facteurs
          que les professionnels de santé regardent en premier lorsqu’ils
          doivent évaluer l’état de santé d’une personne.
        </p>
        <div class="image-heart-cpt"></div>
      </div>
    </div>
  </div>
  <?php require "bottom-bar.php"; ?>
</body>

</html>
