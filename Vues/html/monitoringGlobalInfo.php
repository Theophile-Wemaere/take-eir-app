<?php require "C:/Users/imadr/OneDrive/Documents/ISEP/Projet_syst_num/informatique/xampp/htdocs/take-eir-app/Vues/html/database_test.php" ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="/take-eir-app/Vues/css/monitoringGlobalInfo.css" />
  <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <script src="https://cdn.anychart.com/releases/8.8.0/js/anychart-base.min.js"></script>
  <script src="https://cdn.anychart.com/releases/8.8.0/js/anychart-data-adapter.min.js"></script>
  <script src="/take-eir-app/js/plot.js"></script>
  <script src="/take-eir-app/js/recupData.js"></script>
  <title>Information globale</title>
</head>

<body>

  <div class="top-bar">
    <div class="top-bar-img">
      <img src="/take-eir-app/Vues/images/logo-notext.png" href="index.html">
      <img src="/take-eir-app/Vues/images/reglage.png" href="">
      <img src="/take-eir-app/Vues/images/barre-graphique.png" href="monitoringGlobalInfo.html">
    </div>

    <a href="/take-eir-app/Vues/html/produit.html"><button class="page-button">Notre produit</button></a>
    <div class="separator"></div>
    <button class="page-button">Qui sommes nous ?</button>
    <a href="/take-eir-app/Vues/html/login.html"><button class="login-button">Médecin</button></a>
    <div class="sphere" style="background-color: #2d67e0"></div>
    <div class="sphere" style="background-color: #e0584c"></div>
    <div class="sphere" style="background-color: #5dd1b7"></div>
  </div>
  <!--Création des div invisibles pour récuperer les données de la table en javascript-->

  <div id="date_data" style="display: none;">
    <?php echo htmlspecialchars($date); ?>
  </div>

  <div id="heart_data" style="display: none;">
    <?php echo htmlspecialchars($heart); ?>
  </div>

  <div id="temp_data" style="display: none;">
    <?php echo htmlspecialchars($temp); ?>
  </div>

  <div id="noise_data" style="display: none;">
    <?php echo htmlspecialchars($noise); ?>
  </div>

  <div id="co2_data" style="display: none;">
    <?php echo htmlspecialchars($co2); ?>
  </div>

  <div id="dust_data" style="display: none;">
    <?php echo htmlspecialchars($dust); ?>
  </div>

  <div class="globalMonitoring">

    <div class="tabs">
      <div class="tab-registers">
        <button class="active-tab"><img src="/take-eir-app/Vues/images/logo_card.png"></button>
        <button><img src="/take-eir-app/Vues/images/temperature.png"></button>
        <button><img src="/take-eir-app/Vues/images/monter-le-son.png"></button>
        <button><img src="/take-eir-app/Vues/images/poussiere.png"></button>
        <button><img src="/take-eir-app/Vues/images/co2.png"></button>
      </div>
      <div class="tab-bodies">
        <div style="display:block;">
          <h3 id="titleHeartPlot" class="title"></h3>
          <div class="info">
            <p id="meanCard"></p>
            <p id="sdCard"></p>
          </div>
          <div id="cardiacGraph" class="Plot"></div>
        </div>
        <div style="display:none;">
          <h3 id="titleTempPlot" class="title"></h3>
          <div id="infoCard" class="info">
            <p id="meanTemp"></p>
            <p id="sdTemp"></p>
          </div>
          <div id="tempGraph" class="Plot"></div>

        </div>
        <div style="display:none;">
          <h3 id="titleNoisePlot" class="title"></h3>
          <div class="info">
            <p id="meanNoise"></p>
            <p id="sdNoise"></p>
          </div>
          <div id="noiseGraph" class="Plot"></div>

        </div>
        <div style="display:none;">
          <h3 id="titleDustPlot" class="title"></h3>
          <div class="info">
            <p id="meanDust"></p>
            <p id="sdDust"></p>
          </div>
          <div id="dustGraph" class="Plot"></div>
        </div>
        <div style="display:none;">
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






    <!--Code Javascript pour plot les data-->
    <script src="/take-eir-app/js/onglet.js"></script>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script>

      const [time, card, temp, noise, dust, co2] = recupData();

      Plot(time, card, '#cardiacGraph', "rgb(224, 88, 76)");
      Plot(time, temp, '#tempGraph', "#5DD1B7");
      Plot(time, noise, '#noiseGraph', "#712DE0");
      Plot(time, dust, '#dustGraph', "#67B4C5");
      Plot(time, co2, '#co2Graph', "grey");
    </script>


</body>

</html>