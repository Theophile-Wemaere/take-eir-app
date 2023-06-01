<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="/take-eir-app/Vues/css/monitoringGlobalInfo.css" />
  <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <script src="https://cdn.anychart.com/releases/8.8.0/js/anychart-base.min.js"></script>
  <script src="https://cdn.anychart.com/releases/8.8.0/js/anychart-data-adapter.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="/take-eir-app/js/plot.js"></script>
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

  <div class="globalMonitoring">

    <div class="tabs">
      <div class="tab-registers">
        <button class="active-tab"><img src="/take-eir-app/Vues/images/logo_card.png"></button>
        <button><img src="/take-eir-app/Vues/images/temperature.png"></button>
        <button><img src="/take-eir-app/Vues/images/logo_son.png"></button>
        <button><img src="/take-eir-app/Vues/images/poussiere.png"></button>
        <button><img src="/take-eir-app/Vues/images/co2.png"></button>
      </div>

      <div class="infoPatient">
        <p>Prenom :</p>
        <p>Nom :</p>
        <p>Email :</p>
        <p>Telephone :</p>
        <p>Health-Key :</p>
      </div>

      <div class="tab-bodies">

        <div style="display:block;" class="graph">
          <!--slider html code-->
          <div class="slider-box">
            <label for="heartPathRange">Seuil d'alerte du rythme cardiaque</label>
            <br>
            <input type="text" id="heartRange" readonly>
            <div id="heart-range" class="slider"></div>
          </div>
          <!--graph html code-->
          <h3 id="titleHeartPlot" class="title"></h3>
          <div class="info">
            <p id="meanCard"></p>
            <p id="sdCard"></p>
          </div>
          <div id="cardiacGraph" class="Plot"></div>

        </div>

        <div style="display:none;" class="graph">
          <!--slider html code-->
          <div class="slider-box">
            <label for="tempPathRange">Seuil d'alerte pour la temperature</label>
            <br>
            <input type="text" id="tempRange" readonly>
            <div id="temp-range" class="slider"></div>
          </div>
          <!--graph html code-->
          <h3 id="titleTempPlot" class="title"></h3>
          <div id="infoCard" class="info">
            <p id="meanTemp"></p>
            <p id="sdTemp"></p>
          </div>
          <div id="tempGraph" class="Plot"></div>
        </div>

        <div style="display:none;" class="graph">
          <!--slider html code-->
          <div class="slider-box">
            <label for="noisePathRange">Seuil d'alerte du niveau sonore</label>
            <br>
            <input type="text" id="noiseRange" readonly>
            <div id="noise-range" class="slider"></div>
          </div>
          <!--graph html code-->
          <h3 id="titleNoisePlot" class="title"></h3>
          <div class="info">
            <p id="meanNoise"></p>
            <p id="sdNoise"></p>
          </div>
          <div id="noiseGraph" class="Plot"></div>
        </div>

        <div style="display:none;" class="graph">
          <!--slider html code-->
          <!--<div class="slider-box">
            <label for="dustPathRange">Seuil d'alerte du taux de microparticulle</label>
            <br>
            <input type="text" id="dustRange" readonly>
            <div id="dust-range" class="slider"></div>
          </div>-->
          <!--graph html code-->
          <h3 id="titleDustPlot" class="title"></h3>
          <div class="info">
            <p id="meanDust"></p>
            <p id="sdDust"></p>
          </div>
          <div id="dustGraph" class="Plot"></div>
        </div>

        <div style="display:none;" class="graph">
          <!--slider html code-->
          <!--<div class="slider-box">
            <label for="co2PathRange">Seuil d'alerte du taux de CO2</label>
            <br>
            <input type="text" id="co2Range" readonly>
            <div id="co2-range" class="slider"></div>
          </div>-->
          <!--graph html code-->
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
  <script src="https://d3js.org/d3.v4.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

  <script>
    // Code JavaScript avec Ajax
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'database_test.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
      if (xhr.status === 200) {
        var data = JSON.parse(xhr.responseText);
        var rythmeCardiaqueTime = [];
        var rythmeCardiaque = [];

        var temperatureTime = [];
        var temperature = [];

        var niveauSonoreTime = [];
        var niveauSonore = [];

        var tauxMicroparticulesTime = [];
        var tauxMicroparticules = [];

        var tauxCO2Time = [];
        var tauxCO2 = [];

        var dateFormat = "YYYY-MM-DD HH:mm:ss";

        // Parcourir les données et les trier en fonction du type de métrique
        data.forEach(element => {
          var metricType = element.metrics_type;
          var entryTime = moment(element.entry_time, dateFormat).toDate();
          var value = element.value;

          // Tri des données en fonction du type de métrique
          switch (metricType) {
            case "1":
              rythmeCardiaqueTime.push(new Date(entryTime));
              rythmeCardiaque.push(parseFloat(value));
              break;
            case "2":
              temperatureTime.push(new Date(entryTime));
              temperature.push(parseFloat(value));
              break;
            case "3":
              niveauSonoreTime.push(new Date(entryTime));
              niveauSonore.push(parseFloat(value));
              break;
            case "4":
              tauxMicroparticulesTime.push(new Date(entryTime));
              tauxMicroparticules.push(parseFloat(value));
              break;
            case "5":
              tauxCO2Time.push(new Date(entryTime));
              tauxCO2.push(parseFloat(value));
              break;
          }
        });

        // Appeler la fonction Plot() ici, une fois que les données sont disponibles
        Plot(rythmeCardiaqueTime, rythmeCardiaque, '#cardiacGraph', "rgb(224, 88, 76)");
        Plot(temperatureTime, temperature, '#tempGraph', "#5DD1B7");
        Plot(niveauSonoreTime, niveauSonore, '#noiseGraph', "#712DE0");
        Plot(tauxMicroparticulesTime, tauxMicroparticules, '#dustGraph', "#67B4C5");
        Plot(tauxCO2Time, tauxCO2, '#co2Graph', "grey");
      }
    };

    xhr.send();
  </script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src="/take-eir-app/js/slider.js"></script>

  <!--Code Javascript pour le slider range-->
  <script>
    sliderRange("#heart-range", "#heartRange", 1, 0, 120);
    sliderRange("#temp-range", "#tempRange", 1, -10, 40);
    sliderRange("#noise-range", "#noiseRange", 1, 0, 120);
   //sliderRange("#dust-range","#dustRange",50,0,250);
   //sliderRange("#co2-range","#co2Range",100,0,2000);
  </script>

</body>

</html>