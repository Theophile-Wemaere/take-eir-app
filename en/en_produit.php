<!DOCTYPE html>
<html lang="fr">

<head>
  <link rel="stylesheet" href="/CSS/styles.css" />
  <link rel="stylesheet" href="/CSS/produit.css" />
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta charset="utf-8" />
  <title id="Pres_prod">Our product HEALTH EIR</title>
  <script src="/JS/scripts.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />
</head>

<body>
  <?php require "../top-bar.php"; ?>
  <div class="wrapper">
    <div class="main-box">
      <div class="text-container">
        <h1 class="Title_prod">Our Health-Eir device</h1>
      </div>
      <div class="introduction">
        <p>
         The Covid-19 crisis has democratized telemedicine by leading to
          a historic increase in teleconsultations and hospitalizations
          at home.
          <br />
          This is why we are developing the Health-Eir device. Our
          product is designed to monitor the health status of a patient
          hospitalized at home. It allows not only to evaluate the environmental quality
          quality of the hospital room, but also to follow in real time the
          the patient's health status in real time, thanks to various sensors.
          <br />
          <br />
          We work closely with the medical profession to offer you the best possible
          the best possible solution for you!
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
            Our device embeds the following sensors:
        </h2>
      </div>

      <div class="dust-cpt">
        <p>
          The monitoring of air quality and its concentration in microparticles is
          microparticles is necessary in order to promote the well-being and
          healing of patients. For this purpose, the SHARP sensor collects
          data related to the level of microparticles in the air.
          <br />
          <br />
          This sensor detects microparticles using innovative infrared technology
          technology and provides highly accurate measurements!
        </p>
        <div class="image-dust-cpt"></div>
      </div>

      <div class="co2-cpt">
        <div class="image-co2-cpt"></div>

        <p>
        Coupled with our microparticle sensor, the MICS-VZ-89TE
          sensor allows to measure the C02 rate of the hospital room.
          <br />
          This is the main indicator to determine when to ventilate.
          when it is necessary to ventilate.
        </p>
      </div>

      <div class="temp-cpt">
        <p>
        Numerous studies show the direct influence of temperature and humidity on
          temperature and humidity on the quality of the ambient air, as well as on the occupants
          as well as on the occupants of indoor spaces. The regular and automated measurement of
          of these two parameters constitutes a good estimate of the quality of
          of the indoor air quality, and allows to limit the negative impact
          the negative impact - on health, well-being and productivity - of a polluted
          of a polluted environment.
          <br />
          The DHT11 sensor allows this functionality.
        </p>
        <div class="image-temp-cpt"></div>
      </div>

      <div class="noise-cpt">
        <div class="image-noise-cpt"></div>

        <p>
        Noise, even at a low level, can cause adverse health effects
          on the health of patients. In this context, we propose
          to evaluate the quality of the sound environment in your hospital room
          with our MAX4466 audio sensor.
        </p>
      </div>

      <div class="heart-cpt">
        <p>
        The heart rate of the hospitalized patient at home is measured
          with the Grove Ear-Clip Heart Sensor, which uses a pulse-induced
          technique of light variation induced by the heartbeat in a blood
          in a blood vessel.
          <br />
          <br />
          This measure is particularly relevant in our use case, since it allows to follow, in real time, the
          use case, since it allows to follow, in real time, the state of health of the
          of the hospitalized patient. This is indeed one of the factors
          that health professionals look at first when they have to evaluate the
          when they have to evaluate the health status of a person.
        </p>
        <div class="image-heart-cpt"></div>
      </div>
    </div>
  </div>
  <div class="bottom-bar">
    <a>© take-eir</a>
    <a href="/contact/contact.php">Contact us</a>
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
