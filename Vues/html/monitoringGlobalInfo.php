<?php 
    function getData(){
        include_once("C:/Users/imadr/OneDrive/Documents/ISEP/Projet_syst_num/informatique/xampp/htdocs/take-eir-app/Models/infoDB.php");
        $conn = connectionToDB();
        $sql = "
        SELECT * FROM sensors_data sd ORDER BY sd.measure_date 
                ";

        $commande = $conn->prepare($sql);
        $bool = $commande->execute();

        $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); //tableau d'enregistrements
        return $resultat;

    }
    
    $data = getData();

    function fromDataToString($datam, $key){
        $result =  '[';
        $columnValue = array_column($datam, $key);
        for ($i=0; $i < count($datam)-1; $i++){
            $result = $result . '"' . strval($columnValue[$i]). '", ';
        }
        $result = $result . '"'. strval($columnValue[count($datam)-1]). '"]';
        return $result;
    }

    $date = fromDataToString($data, "measure_date");
    $heart = fromDataToString($data, "heart_rate");
    $temp = fromDataToString($data, "temp_rate");
    $noise = fromDataToString($data, "noise_rate");
    $co2 = fromDataToString($data, "co2_rate");
    $dust = fromDataToString($data, "dust_rate");
   ?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="/take-eir-app/Vues/css/monitoringGlobalInfo.css" />
    <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.anychart.com/releases/8.8.0/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.8.0/js/anychart-data-adapter.min.js"></script>
	<title>Information globale</title>
</head>
<body>
<!--Création des div invisibles pour récuperer les données de la table en javascript-->
<div class="top-bar">
        <div class="top-bar-img">
          <img src="/take-eir-app/Vues/images/logo-notext.png" href="index.html" >
          <img src="/take-eir-app/Vues/images/reglage.png" href = "">
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

<div id="date_data" style="display: none;">
                    <?php
                        
                        echo htmlspecialchars($date);
                    ?>
        </div>

<div id="heart_data" style="display: none;">
                    <?php
                        
                        echo htmlspecialchars($heart); 
                    ?>
</div>

<div id="temp_data" style="display: none;">
                    <?php
                        
                        echo htmlspecialchars($temp); 
                    ?>
</div>

<div id="noise_data" style="display: none;">
                    <?php
                        
                        echo htmlspecialchars($noise); 
                    ?>
</div>

<div id="co2_data" style="display: none;">
                    <?php
                        
                        echo htmlspecialchars($co2); 
                    ?>
</div>

<div id="dust_data" style="display: none;">
                    <?php
                        
                        echo htmlspecialchars($dust); 
                    ?>
</div>

<div class="globalMonitoring">



    <h2 id="titleHeartPlot" class="title_card_graph"></h2>
    <div id = "cardiacGraph" class = "heartPlot"></div>

</div>






















<!--Code Javascript pour plot les data-->
<script src="https://d3js.org/d3.v7.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>        
<script>
//Importation des dates et des données cardiques depuis les div invisibles
var date =  document.getElementById("date_data");
var heartRate = document.getElementById("heart_data");
var tempRate = document.getElementById("temp_data");
var noiseRate = document.getElementById("noise_data");
var co2Rate = document.getElementById("co2_data");
var dustRate = document.getElementById("dust_data");

//Conversion d'un string en en vecteur de string
var dateSplit = JSON.parse(date.textContent);
var heartRateSplit = JSON.parse(heartRate.textContent);
var tempRateSplit = JSON.parse(tempRate.textContent);
var noiseRateSplit = JSON.parse(noiseRate.textContent);
var co2RateSplit = JSON.parse(co2Rate.textContent);
var dustRateSplit = JSON.parse(dustRate.textContent);

// Conversion des données
var convertDate = [];
var convertHeartRate = [];
var convertTempRate = [];
var convertNoiseRate = [];
var convertCo2Rate = [];
var convertDustRate = [];

for (i = 0; i < heartRateSplit.length; i++) { 
    convertDate.push(new Date(dateSplit[i]))
    convertHeartRate.push(parseFloat(heartRateSplit[i]))
    convertTempRate.push(parseFloat(tempRateSplit[i]))
    convertNoiseRate.push(parseFloat(noiseRateSplit[i]))
    convertCo2Rate.push(parseFloat(co2RateSplit[i]))
    convertDustRate.push(parseFloat(dustRateSplit[i]))
}


// Fin de la récupération des données
// set the dimensions and margins of the graph
const margin = { top: 40, right: 30, bottom: 40, left: 60 },
  width = 600 - margin.left - margin.right,
  height = 540 - margin.top - margin.bottom;

// append the svg object to the body of the page
const svg = d3
  .select("#cardiacGraph")
  .append("svg")
  .attr("width", width + margin.left + margin.right)
  .attr("height", height + margin.top + margin.bottom)
  .append("g")
  .attr("transform", `translate(${margin.left},${margin.top})`);

//On conserve les dix dernière minutes
var convertDate = convertDate.slice(-10);
var convertHeartRate = convertHeartRate.slice(-10);
const nomsMois = [
  'janvier', 'février', 'mars', 'avril', 'mai', 'juin',
  'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'
];
// Format the data
const data = convertDate.map((date, i) => ({ date: date, cardiac: convertHeartRate[i] }));


// Create the scale for the horizontal axis (time)
const x = d3.scaleTime()
  .domain(d3.extent(data, d => d.date))
  .range([0, width]);

svg.append("g")
  .attr("transform", `translate(0, ${height})`)
  .call(d3.axisBottom(x))
  .selectAll("text")
  .style("font-family", "Krona One")
  .style("font-size", "12px")
  .style("fill", "#ac94f4");


// Add Y axis
const y = d3.scaleLinear()
  .domain([d3.min(data, d => d.cardiac), d3.max(data, d => d.cardiac)])
  .range([height, 0]);

svg.append("g")
  .call(d3.axisLeft(y))
  .selectAll("text")
  .style("font-family", "Krona One")
  .style("font-size", "12px")
  .style("fill", "red");

// Add the line
svg.append("path")
  .datum(data)
  .attr("fill", "none")
  .attr("stroke", "rgb(224, 88, 76)")
  .attr("stroke-width", 1.5)
  .attr("d", d3.line()
    .x(d => x(d.date))
    .y(d => y(d.cardiac))
  )

// Create a tooltip
const Tooltip = d3
  .select("#cardiacGraph")
  .append("div")
  .style("opacity", 0)
  .attr("class", "tooltip")
  .style("background-color", "white")
  .style("border", "solid")
  .style("border-width", "2px")
  .style("border-radius", "5px")
  .style("padding", "5px");

// Define functions for tooltip interaction
const mouseover = function (event, d) {
  Tooltip.style("opacity", 1);
};

const mousemove = function (event, d) {
  Tooltip
    .html("Rythme cardiaque : " + d.cardiac + " bpm")
    .style("left", `${event.pageX + 10}px`) // Use pageX instead of layerX
    .style("top", `${event.pageY}px`); // Use pageY instead of layerY
};

const mouseleave = function (event, d) {
  Tooltip.style("opacity", 0);
};



// Add the points
svg.append("g")
  .selectAll("dot")
  .data(data)
  .join("circle")
  .attr("class", "myCircle")
  .attr("cx", d => x(d.date))
  .attr("cy", d => y(d.cardiac))
  .attr("r", 8)
  .attr("stroke", "rgb(224, 88, 76, 0.25)")
  .attr("stroke-width", 3)
  .attr("fill", "white")
  .on("mouseover", mouseover)
  .on("mouseover", mouseover)
  .on("mousemove", mousemove)
  .on("mouseleave", mouseleave);

  

//Ajout du titre au graphique
document.getElementById("titleHeartPlot").innerHTML = "Evolution du rythme cardiaque lors du "+ data[data.length-1].date.getDate() + " " + nomsMois[data[data.length-1].date.getMonth()] + " " + data[data.length-1].date.getFullYear();

// Ajouter un label à l'axe X
svg.append("text")
  .attr("x", width / 2)
  .attr("y", height+35) // Ajustez la position verticale selon vos besoins
  .attr("text-anchor", "middle")
  .style("font-size", "12px")
  .text("Temps (en min)");

// Ajouter un label à l'axe Y
svg.append("text")
  .attr("transform", "rotate(-90)") // Fait pivoter le texte de 90 degrés pour l'axe Y
  .attr("x", 0 - (height / 2))
  .attr("y", -margin.left + 10) // Ajustez la position verticale selon vos besoins
  .attr("text-anchor", "middle")
  .style("font-size", "12px")
  .text("Rythme cardiaque (en bpm)");


</script>

</body>
</html>

<!--
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="/take-eir-app/Vues/css/monitoringGlobalInfo.css" />
    <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.anychart.com/releases/8.8.0/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.8.0/js/anychart-data-adapter.min.js"></script>
	<title>Information globale</title>
</head>
<body>

    <div class="top-bar">
        <div class="top-bar-img">
          <img src="/take-eir-app/Vues/images/logo-notext.png" href="index.html" >
          <img src="/take-eir-app/Vues/images/reglage.png" href = "">
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

    <div class="globalMonitoring">

    

    <div class="champ1">

    <div class="cardiacData" id="card">
        <button class="title_card_graph">Données cardiaques du patient</button>
        <hr>
        <img src="/take-eir-app/Vues/images/cardiac_data.png">
        <hr>
        <button class="infoCardiacGraph">Fréquence cardiaque: XX BPM</button>
        
    

    </div>

    <div class="tempData" id="temp">
        <button class="title_temp_graph">Température ambiante</button>
        <hr>
        <img src="/take-eir-app/Vues/images/temp_data.png">
        <hr>
        <button class="infoTempGraph">Température actuelle : XX °C</button>
    </div>

    </div>

    <div class="champ3">
    <div class="noiseData" id="noise">
        <button class="title_noise_graph">Débit sonore</button>
        <hr>
        <img src="/take-eir-app/Vues/images/noise_data.png">
        <hr>
        <button class="infoNoiseGraph">Niveau sonore : Conversation</button>
    </div>
    </div>
    <div class="champ2">

        <div class="co2Data" id="co2">
            <button class="title_co2_graph">Taux de CO2</button>
            <hr>
            <img src="/take-eir-app/Vues/images/co2_data.png">
            <hr>
            <button class="infoCo2Graph">Taux de CO2 : XX %</button>
        </div>
    
        <div class="dustData" id="dust">
            <button class="title_dust_graph">Taux de microparticule</button>
            <hr>
            <img src="/take-eir-app/Vues/images/dust_data.png">
            <hr>
            <button class="infoDustGraph">Taux de microparticule: XX  µg/m²</button>
        </div>
    
    </div>

    <button class="boutonPatient">Information patient</button>

    <div class="infoPatient">
    <br>
    <p>
        Nom: XXXXXXXX
        <hr>
        Prenom: XXXXX
        <hr>
        Contact:
        <hr>
        Email: XXXXXXXXXXXXX@XXXXXXX.XXX
        <hr>
        Téléphone: XX-XX-XX-XX-XX
        <hr>
        Autres:
    </p>
    </div>

    
    

    </div>

    
    

</body>
</html>-->