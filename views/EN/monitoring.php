<?php
if (!isset($_SESSION["name"])) {
  header("Location: /");
} elseif (!isset($_GET["device"])) {
  header("Location: /index.php/health-view");
}

?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <meta charset="utf-8" />
  <title>Monitoring</title>

  <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <script src="https://cdn.anychart.com/releases/8.8.0/js/anychart-base.min.js"></script>
  <script src="https://cdn.anychart.com/releases/8.8.0/js/anychart-data-adapter.min.js"></script>
  <link rel="stylesheet" type="text/css"
    href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">

  <link rel="stylesheet" href="/CSS/styles.css" />
  <link rel="stylesheet" href="/CSS/monitoring.css" />


  <script src="/JS/monitoring/plot.js"></script>
  <!-- <script src="/JS/monitoring/justgage-master/raphael.min.js"></script>
  <script src="/JS/monitoring/justgage-master/justgage.js"></script> -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/justgage/1.2.9/justgage.min.js"></script>
  <script src="/JS/monitoring/gauge_plot.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src="/JS/monitoring/slider.js"></script>
  <script src="/JS/scripts.js"></script>
  <script src="/JS/monitoring/monitoring.js"></script>

</head>

<body>

  <?php require "top-bar.php"; ?>
  <div class="wrapper">

    <!--Création des div invisibles pour récuperer les données de la table en javascript-->

    <div class="globalMonitoring">
      <h3 for="jauge" class="labelJauge">Global monitoring</h3>
      <div class="jauge">
        <div class="groupe">
          <div class="jauge-container">
            <div id="cardGaugeContainer" class="plotJauge"></div>
            <p> Heart rate </p>
          </div>
          <div class="jauge-container">
            <div id="tempGaugeContainer" class="plotJauge"></div>
            <p> Temperature </p>
          </div>
        </div>
        <div class="groupe">
          <div class="jauge-container">
            <div id="humidityGaugeContainer" class="plotJauge"></div>
            <p> Humidity </p>
          </div>
          <div class="jauge-container">
            <div id="noiseGaugeContainer" class="plotJauge"></div>
            <p> Noise level </p>
          </div>
        </div>
        <div class="groupe">
          <div class="jauge-container">
            <div id="dustGaugeContainer" class="plotJauge"></div>
            <p> Dust </p>
          </div>
          <div class="jauge-container">
            <div id="co2GaugeContainer" class="plotJauge"></div>
            <p> CO2 </p>
          </div>
        </div>
      </div>

      <h3 for="jauge" class="labelJauge" style="font-size:none">
        <div class="infoPatient">
          <h3 class="labelJauge">Patient information</h3>
          <div class="row">
            <div class="groupe">
              <p class="title">Name : </p>
              <input id="name">
            </div>
            <div class="groupe">
              <p class="title">Surname : </p>
              <input id="surname">
            </div>
            <div class="groupe">
              <p class="title">Doctor email: </p>
              <input id="email">
              <p id="emailError" style="color:red;font-size: 14px;margin-top: 5px;display: none;">Please enter a valid email</p>
              <script>checkEmail("email")</script>
            </div>
            <div class="groupe">
              <p class="title">Health-Key : </p>
              <p id="key" readonly></p>
            </div>
          </div>
          <div class="row">
            <button onclick=updatePatient()>Confirm</button>
          </div>
          <div id="success-msg" class="error-match" style="display: none;color: green">Profil updated !</div>
        </div>
        <script>getPatient()</script>
      </h3>
      <div class="tabs">
        <div class="tab-registers">
          <button class="active-tab"><img src="/images/logo_card.png"></button>
          <button><img src="/images/temperature.png"></button>
          <button><img src="/images/humidite.png"></button>
          <button><img src="/images/logo_son.png"></button>
          <button><img src="/images/poussiere.png"></button>
          <button><img src="/images/co2.png"></button>
        </div>



        <div class="tab-bodies">

          <div style="display:flex;" class="graph graph-container">
            <!--line graph html code-->
            <h3 id="titleHeartPlot" class="title"></h3>
            <div class="info">
              <p id="meanCard"></p>
              <p id="sdCard"></p>
            </div>
            <div id="cardiacGraph" class="Plot"></div>
            <!--slider html code-->
            <div class="slider-box">
              <label for="heartPathRange">Heart rate alert threshold</label>
              <br>
              <input type="text" id="heartRange" readonly>
              <div id="heart-range" class="slider"></div>
              <button onclick="setThreshold('#heart-range',1)">Confirm</button>
              <div id="success-msg2" class="error-match" style="color: green">threshold updated!</div>
              <div id="error-msg" class="error-match">You are not allowed to modify these values</div>
            </div>
          </div>

          <div style="display:none;" class="graph graph-container">
            <!--slider html code-->
            <!--<div class="slider-box">
            <label for="tempPathRange">Seuil d'alerte pour la temperature</label>
            <br>
            <input type="text" id="tempRange" readonly>
            <div id="temp-range" class="slider"></div>
          </div>-->

            <!--line graph html code-->
            <h3 id="titleTempPlot" class="title"></h3>
            <div id="infoCard" class="info">
              <p id="meanTemp"></p>
              <p id="sdTemp"></p>
            </div>
            <div id="tempGraph" class="Plot"></div>
          </div>

          <div style="display:none;" class="graph graph-container">
            <!--slider html code-->
            <!--<div class="slider-box">
            <label for="humidityPathRange">Seuil d'alerte pour l'humidité</label>
            <br>
            <input type="text" id="humidityRange" readonly>
            <div id="humidity-range" class="slider"></div>
          </div>-->

            <!--line graph html code-->
            <h3 id="titleHumidityPlot" class="title"></h3>
            <div id="infoHumidity" class="info">
              <p id="meanHumidity"></p>
              <p id="sdHumidity"></p>
            </div>
            <div id="humidityGraph" class="Plot"></div>
          </div>



          <div style="display:none;" class="graph graph-container">

            <!--slider html code-->
            <!--<div class="slider-box">
            <label for="noisePathRange">Seuil d'alerte du niveau sonore</label>
            <br>
            <input type="text" id="noiseRange" readonly>
            <div id="noise-range" class="slider"></div>
          </div>-->

            <!--line graph html code-->
            <h3 id="titleNoisePlot" class="title"></h3>
            <div class="info">
              <p id="meanNoise"></p>
              <p id="sdNoise"></p>
            </div>
            <div id="noiseGraph" class="Plot"></div>
          </div>

          <div style="display:none;" class="graph graph-container">
            <!--slider html code-->
            <!--<div class="slider-box">
            <label for="dustPathRange">Seuil d'alerte du taux de microparticulle</label>
            <br>
            <input type="text" id="dustRange" readonly>
            <div id="dust-range" class="slider"></div>
          </div>-->

            <!--line graph html code-->
            <h3 id="titleDustPlot" class="title"></h3>
            <div class="info">
              <p id="meanDust"></p>
              <p id="sdDust"></p>
            </div>
            <div id="dustGraph" class="Plot"></div>
          </div>

          <div style="display:none;" class="graph graph-container">
            <!--slider html code-->
            <!--<div class="slider-box">
            <label for="co2PathRange">Seuil d'alerte du taux de CO2</label>
            <br>
            <input type="text" id="co2Range" readonly>
            <div id="co2-range" class="slider"></div>
          </div>-->

            <!--line graph html code-->
            <h3 id="titleCo2Plot" class="title"></h3>
            <div class="info">
              <p id="meanCo2"></p>
              <p id="sdCo2"></p>
            </div>
            <div id="co2Graph" class="Plot"></div>
          </div>

        </div>
      </div>
    </div>
    <script src="/JS/monitoring/onglet.js"></script>

    <!--Code Javascript pour plot les data-->
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="https://d3js.org/d3.v4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
      // Appeler la fonction initiale pour récupérer les données une première fois
      fetchPeriodicData();
    // Planifier l'exécution périodique de la fonction
    //setInterval(fetchPeriodicData, 5000); // Exécuter toutes les 5 secondes (5000 millisecondes)
    </script>
    <!--Code Javascript pour le slider range-->
    <script>
      getThreshold();
    //sliderRange("#temp-range", "#tempRange", 1, -10, 40);
    //sliderRange("#humidity-range", "#humidityRange", 1, 0, 100);
    //sliderRange("#noise-range", "#noiseRange", 1, 0, 120);
    //sliderRange("#dust-range", "#dustRange", 50, 0, 250);
    //sliderRange("#co2-range", "#co2Range", 100, 0, 2000);

    </script>
  </div>
  <?php require "bottom-bar.php"; ?>
</body>

</html>