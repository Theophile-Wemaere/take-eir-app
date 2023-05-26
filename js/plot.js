//Initialisation de fonction qui nous servirons a données des informations primaire sur les données
//------------------------------------------------fonction stat--------------------------------------------------------------------------------
//Moyenne
function Average(a) {
  var b = a.length,
      c = 0, i;
  for (i = 0; i < b; i++) {
      c += a[i];
  }
  return c / b;
}

//Variance
function Variance(a) {
  var b = a.length,
      c = 0, i,
      moy = Average(a);
  for (i = 0; i < b; i++) {
      c += Math.pow((a[i] - moy), 2);
  }
  return c / (b - 1);
}

function calculerMoyenneDecibels(niveauxSonores) {
  if (niveauxSonores.length === 0) {
      return 0; // Retourne 0 si le tableau est vide
  }

  // Conversion des niveaux sonores en puissance (Watt)
  const puissances = niveauxSonores.map(decibel => Math.pow(10, decibel / 10));

  // Calcul de la moyenne des puissances
  const sommePuissances = puissances.reduce((acc, val) => acc + val, 0);
  const moyennePuissances = sommePuissances / puissances.length;

  // Conversion de la moyenne en dB
  const moyenneDecibels = 10 * Math.log10(moyennePuissances);

  return moyenneDecibels;
}

function calculerVarianceDecibels(niveauxSonores) {
  if (niveauxSonores.length === 0) {
      return 0; // Retourne 0 si le tableau est vide
  }

  // Conversion des niveaux sonores en puissance (Watt)
  const puissances = niveauxSonores.map(decibel => Math.pow(10, decibel / 10));

  // Calcul de la moyenne des puissances
  const sommePuissances = puissances.reduce((acc, val) => acc + val, 0);
  const moyennePuissances = sommePuissances / puissances.length;

  // Calcul de la somme des écarts à la moyenne
  const sommeEcarts = puissances.reduce((acc, val) => acc + Math.pow(val - moyennePuissances, 2), 0);

  // Calcul de la variance
  const variance = sommeEcarts / puissances.length;

  // Conversion de la variance en dB
  const varianceDecibels = 10 * Math.log10(variance);

  return varianceDecibels;
}


    //--------------------------------------------------------------------------------------------------------------------------------------------


// Fin de la récupération des données
// set the dimensions and margins of the graph
const margin = { top: 40, right: 30, bottom: 40, left: 60 },
  width = 1000 - margin.left - margin.right,
  height = 700 - margin.top - margin.bottom;

const nomsMois = [
  'janvier', 'février', 'mars', 'avril', 'mai', 'juin',
  'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'
];

function Plot(absc, ord, id, color) {
  //On conserve les données des X dernières minutes
  var Date = absc.slice(-15);
  var Rate = ord.slice(-15);


  // Format the data
  const data = Date.map((date, i) => ({ date: date, rate: Rate[i] }));


  //--------------------------------------------Crétion du graphique suivant l'évolution du rythme cardiaque--------------------------------------
  // append the svg object to the body of the page

  var svg = d3
    .select(id)
    .append("svg")
    .attr("viewBox", `0 0 ${width + margin.left + margin.right} ${height + margin.top + margin.bottom}`)
    .attr("preserveAspectRatio", "xMidYMid meet")
    .attr("width", "70%")
    .attr("height", "40%")
    .append("g")
    .attr("transform", `translate(${margin.left},${margin.top})`);

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
    .style("fill", "purple");


  // Add Y axis
  const y = d3.scaleLinear()
    .domain([d3.min(data, d => d.rate)-20, d3.max(data, d => d.rate)+20])
    .range([height, 0]);

  svg.append("g")
    .call(d3.axisLeft(y))
    .selectAll("text")
    .style("font-family", "Krona One")
    .style("font-size", "12px")
    .style("fill", "blue");

  // Add the line
  svg.append("path")
    .datum(data)
    .attr("fill", "none")
    .attr("stroke", color)
    .attr("stroke-width", 1.5)
    .attr("d", d3.line()
      .x(d => x(d.date))
      .y(d => y(d.rate))
    )

  // Create a tooltip
  const Tooltip = d3
    .select(id)
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
      .html("Rythme cardiaque : " + d.rate + " bpm")
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
    .attr("cy", d => y(d.rate))
    .attr("r", 8)
    .attr("stroke", "white")
    .attr("stroke-width", 3)
    .attr("fill", "black")
    .on("mouseover", mouseover)
    .on("mouseover", mouseover)
    .on("mousemove", mousemove)
    .on("mouseleave", mouseleave);

  // Ajouter un label à l'axe X
  svg.append("text")
    .attr("x", width / 2)
    .attr("y", height + 35) // Ajustez la position verticale selon vos besoins
    .attr("text-anchor", "middle")
    .style("font-size", "12px")
    .text("Temps (en min)");

  

  //Ajout du titre au graphique et de la moyenne et de l'écart type
  if (id.includes("card")) {
    document.getElementById("titleHeartPlot").innerHTML = "Evolution du rythme cardiaque pour les " + Date.length + " dernière minutes, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanCard").innerHTML = "Rythme cardiaque moyen sur les " + Date.length + " dernières minutes : <strong>" + Math.round(Average(Rate)) + " bpm</strong>";
    document.getElementById("sdCard").innerHTML = "Ecart entre deux pulsations sur les " + Date.length + " dernières minutes : <strong>" + Math.round(Math.pow(Variance(Rate), 0.5)) + " bpm </strong>";
    // Ajouter un label à l'axe Y
    svg.append("text")
      .attr("transform", "rotate(-90)") // Fait pivoter le texte de 90 degrés pour l'axe Y
      .attr("x", 0 - (height / 2))
      .attr("y", -margin.left + 10) // Ajustez la position verticale selon vos besoins
      .attr("text-anchor", "middle")
      .style("font-size", "12px")
      .text("Rythme cardiaque (en bpm)");
  }
  else if (id.includes("temp")) {
    document.getElementById("titleTempPlot").innerHTML = "Evolution de la température pour les " + Date.length + " dernière minutes, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanTemp").innerHTML = "Température moyenne sur les " + Date.length + " dernières minutes : <strong>" + Math.round(Average(Rate)) + " bpm</strong>";
    document.getElementById("sdTemp").innerHTML = "Ecart entre deux mesures sur les " + Date.length + " dernières minutes : <strong>" + Math.round(Math.pow(Variance(Rate), 0.5)) + " °C </strong>";
    // Ajouter un label à l'axe Y
    svg.append("text")
      .attr("transform", "rotate(-90)") // Fait pivoter le texte de 90 degrés pour l'axe Y
      .attr("x", 0 - (height / 2))
      .attr("y", -margin.left + 10) // Ajustez la position verticale selon vos besoins
      .attr("text-anchor", "middle")
      .style("font-size", "12px")
      .text("Température (en °C)");
  }
  else if (id.includes("noise")) {
    document.getElementById("titleNoisePlot").innerHTML = "Evolution du niveau sonore pour les " + Date.length + " dernière minutes, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanNoise").innerHTML = "Niveau sonore moyen sur les " + Date.length + " dernières minutes : <strong>" + Math.round(calculerMoyenneDecibels(Rate)) + " dB</strong>";
    document.getElementById("sdNoise").innerHTML = "Ecart entre deux mesures sur les " + Date.length + " dernières minutes : <strong>" + Math.round(Math.pow(calculerVarianceDecibels(Rate), 0.5)) + " dB </strong>";
    // Ajouter un label à l'axe Y
    svg.append("text")
      .attr("transform", "rotate(-90)") // Fait pivoter le texte de 90 degrés pour l'axe Y
      .attr("x", 0 - (height / 2))
      .attr("y", -margin.left + 10) // Ajustez la position verticale selon vos besoins
      .attr("text-anchor", "middle")
      .style("font-size", "12px")
      .text("Niveau sonore (en dB)");
  }
  else if (id.includes("dust")) {
    document.getElementById("titleDustPlot").innerHTML = "Evolution du taux de microparticulle pour les " + Date.length + " dernière minutes, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanDust").innerHTML = "Taux de microparticulle moyen sur les " + Date.length + " dernières minutes : <strong>" + Math.round(Average(Rate)) + " µg/m^3</strong>";
    document.getElementById("sdDust").innerHTML = "Ecart entre deux mesures sur les " + Date.length + " dernières minutes : <strong>" + Math.round(Math.pow(Variance(Rate), 0.5)) + " µg/m^3</strong>";
    // Ajouter un label à l'axe Y
    svg.append("text")
      .attr("transform", "rotate(-90)") // Fait pivoter le texte de 90 degrés pour l'axe Y
      .attr("x", 0 - (height / 2))
      .attr("y", -margin.left + 10) // Ajustez la position verticale selon vos besoins
      .attr("text-anchor", "middle")
      .style("font-size", "12px")
      .text("Taux de microparticulle (en µg/m^3)");
  }
  else if (id.includes("co2")) {
    document.getElementById("titleCo2Plot").innerHTML = "Evolution du taux de co2 pour les " + Date.length + " dernière minutes, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanCo2").innerHTML = "Taux de co2 moyen sur les " + Date.length + " dernières minutes : <strong>" + Math.round(Average(Rate)) + " ppm</strong>";
    document.getElementById("sdCo2").innerHTML = "Ecart entre deux mesures sur les " + Date.length + " dernières minutes : <strong>" + Math.round(Math.pow(Variance(Rate), 0.5)) + " ppm </strong>";
    // Ajouter un label à l'axe Y
    svg.append("text")
      .attr("transform", "rotate(-90)") // Fait pivoter le texte de 90 degrés pour l'axe Y
      .attr("x", 0 - (height / 2))
      .attr("y", -margin.left + 10) // Ajustez la position verticale selon vos besoins
      .attr("text-anchor", "middle")
      .style("font-size", "12px")
      .text("Taux de microparticulle (en ppm)");
  }



  return svg;
  //--------------------------------------------Fin du code création du graph sur les données cardiaque--------------------------------------

}