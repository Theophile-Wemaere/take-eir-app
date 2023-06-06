<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="/CSS/produit.css" />
  <link rel="stylesheet" href="/CSS/styles.css" />
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta charset="utf-8" />
  <title id="Pres_prod">Our HEALTH EIR product</title>
  <script src="/JS/scripts.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />
</head>

<body>
  <?php require "top-bar.php"; ?>
  <div class="wrapper">
    <div class="main-box">
      <div class="text-container">
        <h1 class="Title_prod">Our Health-Eir system</h1>
      </div>
      <div class="introduction">
        <p>
        The Covid-19 crisis has democratized telemedicine, leading to
          teleconsultations and hospitalizations at home.
          at home.
          <br />
          That's why we're developing the Health-Eir system. Our
          product is designed to monitor a patient's state of health
          at home. In addition to assessing the environmental quality
          the environmental quality of the hospital room, but also to monitor
          the patient's state of health in real time, thanks to a range of sensors.
          <br />
          <br />
          We work closely with the medical profession to offer you the best possible
          to offer you the best possible solution!
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
        Our device is equipped with the following sensors:
        </h2>
      </div>

      <div class="dust-cpt">
        <p>
        Monitoring air quality and its concentration of microparticles
          microparticles is necessary to promote patient well-being and
          healing of patients. To achieve this, the SHARP sensor collects data
          microparticle levels in the air.
          <br />
          <br />
          This sensor detects microparticles using innovative infrared
          technology and delivers highly accurate measurements!
        </p>
        <div class="image-dust-cpt"></div>
      </div>

      <div class="co2-cpt">
        <div class="image-co2-cpt"></div>

        <p>
        Coupled with our microparticle sensor, the MICS-VZ-89TE
          sensor measures C02 levels in the hospital room.
          <br />
          It's the main indicator of when you need to ventilate.
          when it's time to ventilate.
        </p>
      </div>

      <div class="temp-cpt">
        <p>
        Numerous studies demonstrate the direct influence of temperature
          temperature and humidity on indoor air quality, and on the occupants of
          as well as on the occupants of indoor spaces. Regular, automated measurement
          of these two parameters is a good way of estimating
          of indoor air quality, and helps to limit the negative impact
          the negative impact - on health, well-being and productivity - of a
          of a polluted environment.
          <br />
          The DHT11 sensor makes this possible.
        </p>
        <div class="image-temp-cpt"></div>
      </div>

      <div class="noise-cpt">
        <div class="image-noise-cpt"></div>

        <p>
        Noise, even at low levels, can have a detrimental effect on patients' health.
          on patients' health. In this context, we propose to
          assess the quality of the sound environment in your hospital room
          with our MAX4466 audio sensor.
        </p>
      </div>

      <div class="heart-cpt">
        <p>
        The heart rate of a patient hospitalized at home is measured
          with the Grove Ear-Clip Heart Sensor, which uses a pulse-induced
          light variation technique induced by the heartbeat
          in a blood vessel.
          <br />
          <br />
          This measurement is particularly relevant in our
          case study, as it enables real-time monitoring of the in-patient's
          patient's state of health. Indeed, this is one of the factors
          that healthcare professionals look at first when assessing
          evaluate a person's state of health.
        </p>
        <div class="image-heart-cpt"></div>
      </div>
    </div>
  </div>
  <?php require "bottom-bar.php"; ?>
</body>

</html>
