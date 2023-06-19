<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="/take-eir-app/Vues/css/monitoringGlobalInfo.css" />
  <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
  <script src="https://cdn.anychart.com/releases/8.8.0/js/anychart-base.min.js"></script>
  <script src="https://cdn.anychart.com/releases/8.8.0/js/anychart-data-adapter.min.js"></script>
  <link rel="stylesheet" type="text/css"
    href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="/take-eir-app/js/plot.js"></script>
  <script src="/take-eir-app/js/justgage-master/raphael.min.js"></script>
  <script src="/take-eir-app/js/justgage-master/justgage.js"></script>
  <script src="/take-eir-app/js/gauge_plot.js"></script>
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
    <h1 class="labelJauge">Monitoring global</h1>
    <div style="display:flex;" class="jauge">
      <div id="cardGaugeContainer" class="plotJauge" style="width:20%"></div>
      <div id="tempGaugeContainer" class="plotJauge" style="width:20%"></div>
      <div id="humidityGaugeContainer" class="plotJauge" style="width:20%"></div>
      <div id="noiseGaugeContainer" class="plotJauge" style="width:20%"></div>
      <div id="dustGaugeContainer" class="plotJauge" style="width:20%"></div>
      <div id="co2GaugeContainer" class="plotJauge" style="width:20%"></div>
    </div>
    <div class="labelJauge" style="font-size:none">
      <div class="infoPatient">
        <p><span class="cadre"><i>Prénom</i></span><br><br>Luc</p>
        <p><span class="cadre"><i>Nom</i></span><br><br>Dupond</p>
        <p><span class="cadre"><i>Email</i></span><br><br>luc.dupond@gmail.com</p>
        <p><span class="cadre"><i>Téléphone</i></span><br><br>0785623475</p>
        <div class="hk">
          <p><span class="cadre"><i>Health-Key</i></span><br><br>1478a7cz54</p>
        </div>
      </div>
    </div>
    <div class="tabs">
      <div class="tab-registers">
        <button class="active-tab"><img src="/take-eir-app/Vues/images/logo_card.png"></button>
        <button><img src="/take-eir-app/Vues/images/temperature.png"></button>
        <button><img src="/take-eir-app/Vues/images/humidite.png"></button>
        <button><img src="/take-eir-app/Vues/images/logo_son.png"></button>
        <button><img src="/take-eir-app/Vues/images/poussiere.png"></button>
        <button><img src="/take-eir-app/Vues/images/co2.png"></button>
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
          <!--line graph html code-->
          <h3 id="titleHeartPlot" class="title"></h3>
          <div class="info">
            <p id="meanCard"></p>
            <p id="sdCard"></p>
          </div>
          <div id="cardiacGraph" class="Plot"></div>
        </div>

        <div style="display:none;" class="graph">
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

        <div style="display:none;" class="graph">
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



        <div style="display:none;" class="graph">

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

        <div style="display:none;" class="graph">
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

        <div style="display:none;" class="graph">
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
  <script src="/take-eir-app/js/onglet.js"></script>







  <!--Code Javascript pour plot les data-->
  <script src="https://d3js.org/d3.v7.min.js"></script>
  <script src="https://d3js.org/d3.v4.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

  <script>
    // Code JavaScript avec Ajax
    function fetchPeriodicData() {
      return new Promise(function (resolve, reject) {
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

            var humidityTime = [];
            var humidity = [];

            var niveauSonoreTime = [];
            var niveauSonore = [];

            var tauxMicroparticulesTime = [];
            var tauxMicroparticules = [];

            var tauxCO2Time = [];
            var tauxCO2 = [];

            // Parcourir les données et les trier en fonction du type de métrique
            data.forEach(element => {
              var metricType = element.metrics_type;
              var entryTime = new Date(element.entry_time);
              var value = element.value;

              // Tri des données en fonction du type de métrique
              switch (metricType) {
                case "1":
                  rythmeCardiaqueTime.push(entryTime);
                  rythmeCardiaque.push(parseFloat(value));
                  break;
                case "2":
                  temperatureTime.push(entryTime);
                  temperature.push(parseFloat(value));
                  break;
                case "3":
                  niveauSonoreTime.push(entryTime);
                  niveauSonore.push(parseFloat(value));
                  break;
                case "4":
                  tauxMicroparticulesTime.push(entryTime);
                  tauxMicroparticules.push(parseFloat(value));
                  break;
                case "5":
                  tauxCO2Time.push(entryTime);
                  tauxCO2.push(parseFloat(value));
                  break;
                case "6":
                  humidityTime.push(entryTime);
                  humidity.push(parseFloat(value));
                  break;
              }
            });

            resolve({
              rythmeCardiaqueTime: rythmeCardiaqueTime,
              rythmeCardiaque: rythmeCardiaque,
              temperatureTime: temperatureTime,
              temperature: temperature,
              humidityTime: humidityTime,
              humidity: humidity,
              niveauSonoreTime: niveauSonoreTime,
              niveauSonore: niveauSonore,
              tauxMicroparticulesTime: tauxMicroparticulesTime,
              tauxMicroparticules: tauxMicroparticules,
              tauxCO2Time: tauxCO2Time,
              tauxCO2: tauxCO2
            });
          } else {
            reject(xhr.status);
          }
        };

        xhr.onerror = function () {
          reject(xhr.status);
        };

        xhr.send();
      });
    }

    // Utilisation de la promesse
      fetchPeriodicData()
        .then(function (sensor_data) {
          let cardTime = sensor_data.rythmeCardiaqueTime,
            card = sensor_data.rythmeCardiaque,
            tempTime = sensor_data.temperatureTime,
            temp = sensor_data.temperature,
            humidTime = sensor_data.humidityTime,
            humid = sensor_data.humidity,
            noiseTime = sensor_data.niveauSonoreTime,
            noise = sensor_data.niveauSonore,
            dustTime = sensor_data.tauxMicroparticulesTime,
            dust = sensor_data.tauxMicroparticules,
            co2Time = sensor_data.tauxCO2Time,
            co2 = sensor_data.tauxCO2;

          // Appeler la fonction Plot() et createGauge() ici, une fois que les données sont disponibles
          Plot(cardTime, card, '#cardiacGraph', "rgb(224, 88, 76)");
          Plot(tempTime, temp, '#tempGraph', "#5DD1B7",humid,"#6883F5");
          Plot(humidTime, humid, '#humidityGraph', "#6883F5");
          Plot(noiseTime, noise, '#noiseGraph', "#712DE0");
          Plot(dustTime, dust, '#dustGraph', "#67B4C5");
          Plot(co2Time, co2, '#co2Graph', "grey");

          createGauge("cardGaugeContainer", 40, 180, 'BPM', card[card.length - 1]);
          createGauge("tempGaugeContainer", 0, 40, '°C', temp[temp.length - 1]);
          createGauge("humidityGaugeContainer", 0, 100, '% humidité', humid[humid.length - 1]);
          createGauge("noiseGaugeContainer", 0, 120, 'DB', noise[noise.length - 1]);
          createGauge("dustGaugeContainer", 0, 2500, 'µg/m^3', dust[dust.length - 1]);
          createGauge("co2GaugeContainer", 0, 2000, 'PPM', co2[co2.length - 1]);
         
        })
        .catch(function (error) {
          console.error("Une erreur s'est produite lors de la récupération des données :", error);
          
        });


    //updateData()
    // Planifier l'exécution périodique de la fonction
    setInterval(fetchPeriodicData, 5000); // Exécuter toutes les 5 secondes (5000 millisecondes)
  </script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src="/take-eir-app/js/slider.js"></script>

  <!--Code Javascript pour le slider range-->
  <script>
    sliderRange("#heart-range", "#heartRange", 1, 0, 120);
    //sliderRange("#temp-range", "#tempRange", 1, -10, 40);
    //sliderRange("#humidity-range", "#humidityRange", 1, 0, 100);
    //sliderRange("#noise-range", "#noiseRange", 1, 0, 120);
    //sliderRange("#dust-range", "#dustRange", 50, 0, 250);
    //sliderRange("#co2-range", "#co2Range", 100, 0, 2000);
  </script>

</body>

</html>