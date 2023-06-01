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

function getTimeDifferenceInMinutes(date1, date2) {
  // Convertir les dates en millisecondes
  var time1 = date1.getTime();
  var time2 = date2.getTime();

  // Calculer la différence de temps en millisecondes
  var timeDiff = Math.abs(time2 - time1);

  // Convertir la différence de temps en minutes
  var minutes = Math.floor(timeDiff / (1000 * 60));

  return minutes;
}

function getTimeDifferenceInHours(date1, date2) {
  // Convertir les dates en millisecondes
  var time1 = date1.getTime();
  var time2 = date2.getTime();

  // Calculer la différence de temps en millisecondes
  var timeDiff = Math.abs(time2 - time1);

  // Convertir la différence de temps en heures
  var hours = Math.floor(timeDiff / (1000 * 60 * 60));

  return hours;
}

//--------------------------------------------------------------------------------------------------------------------------------------------


// set the dimensions and margins of the graph
const margin = { top: 40, right: 450, bottom: 100, left: 200 },
  width = 3000 - margin.left - margin.right,
  height = 2000 - margin.top - margin.bottom;

const nomsMois = [
  'janvier', 'février', 'mars', 'avril', 'mai', 'juin',
  'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'
];

function Plot(absc, ord, id, color) {
  //On conserve les données des X dernières minutes
  var Date = absc.slice(-31);
  var Rate = ord.slice(-31);


  // Format the data
  const data = Date.map((date, i) => ({ date: date, rate: Rate[i] }));

  //Temps en minute
  minDiff = getTimeDifferenceInMinutes(Date[0],Date[Date.length-1]);
  hoursDiff = getTimeDifferenceInHours(Date[0],Date[Date.length-1]);


  //--------------------------------------------Crétion du graphique suivant l'évolution du rythme cardiaque--------------------------------------
  // append the svg object to the body of the page

  var svg = d3
    .select(id)
    .append("svg")
    .attr("viewBox", `0 0 ${width + margin.left + margin.right} ${height + margin.top + margin.bottom}`)
    .attr("preserveAspectRatio", "xMidYMid meet")
    .append("g")
    .attr("transform", `translate(${margin.left},${margin.top})`);

  // Create the scale for the horizontal axis (time)
  var x = d3.scaleTime()
    .domain(d3.extent(data, d => d.date))
    .range([0, width]);

  svg.append("g")
    .attr("transform", `translate(0, ${height})`)
    .call(d3.axisBottom(x))
    .selectAll("text")
    .style("font-family", "Krona One")
    .style("font-size", "3em")
    .style("fill", "purple");


  // Add Y axis
  var y = d3.scaleLinear()
    .domain([d3.min(data, d => d.rate) - 20, d3.max(data, d => d.rate) + 20])
    .range([height, 0]);

  svg.append("g")
    .call(d3.axisLeft(y))
    .selectAll("text")
    .style("font-family", "Krona One")
    .style("font-size", "3em")
    .style("fill", "blue");

  // This allows to find the closest X index of the mouse:
  var bisect = d3.bisector(function (d) { return d.date; }).left;

  // Create the circle that travels along the curve of chart
  var focus = svg
    .append('g')
    .append('circle')
    .style("fill", "none")
    .attr("stroke", "black")
    .attr('r', 8.5)
    .style("opacity", 0)

  // Create the text that travels along the curve of chart
  var focusText = svg
    .append('g')
    .append('text')
    .style("opacity", 0)
    .attr("text-anchor", "left")
    .attr("alignment-baseline", "middle")

  //Si on on veut faire un graphique pour la température on fait un graphique different avec un gradient de couleur

  if (id.includes("temp")) {
    // Ajouter la définition du gradient de couleur
    const gradient = svg.append("defs")
      .append("linearGradient")
      .attr("id", "color-gradient")
      .attr("gradientTransform", "rotate(90)");

    gradient.append("stop")
      .attr("offset", "0%")
      .attr("stop-color", "red");

    gradient.append("stop")
      .attr("offset", "50%")
      .attr("stop-color", "orange");

    gradient.append("stop")
      .attr("offset", "100%")
      .attr("stop-color", "green");

    // Ajouter la ligne en utilisant le gradient de couleur
    svg.append("path")
      .datum(data)
      .attr("fill", "none")
      .attr("stroke", "url(#color-gradient)") // Utilisation du gradient de couleur
      .attr("stroke-width", 3)
      .attr("d", d3.line()
        .x(d => x(d.date))
        .y(d => y(d.rate))
      );
  }
  // Add the line
  else {
    svg.append("path")
      .datum(data)
      .attr("fill", "none")
      .attr("stroke", color)
      .attr("stroke-width", 3)
      .attr("d", d3.line()
 // Just add that to have a curve instead of segments
        .x(function (d) { return x(d.date) })
        .y(function (d) { return y(d.rate) })
      )
  }

  // Create a rect on top of the svg area: this rectangle recovers mouse position
  svg
    .append('rect')
    .style("fill", "none")
    .style("pointer-events", "all")
    .attr('width', width+50)
    .attr('height', height)
    .on('mouseover', mouseover)
    .on('mousemove', mousemove)
    .on('mouseout', mouseout);

  // What happens when the mouse move -> show the annotations at the right positions.
  function mouseover() {
    focus.style("opacity", 1)
    focusText.style("opacity", 1)
  }
  function mousemove() {
    // recover coordinate we need
    var x0 = x.invert(d3.mouse(this)[0]);
    var i = bisect(data, x0, 1);
    selectedData = data[i]
    focus
      .attr("cx", x(selectedData.date))
      .attr("cy", y(selectedData.rate))
    if (id.includes("card")) {
      focusText
        .html("x:" + selectedData.date.getHours() + ":" + selectedData.date.getMinutes() + "\n y:" + selectedData.rate + " bpm")
        .attr("x", x(selectedData.date) + 15)
        .attr("y", y(selectedData.rate))
        .style("font-size", "1.5em")

    } else if (id.includes("temp")) {
      focusText
        .html("x:" + selectedData.date.getHours() + ":" + selectedData.date.getMinutes() + "  -  " + " y:" + selectedData.rate + " °C")
        .attr("x", x(selectedData.date) + 15)
        .attr("y", y(selectedData.rate))
        .style("font-size", "1.5em")

    } else if (id.includes("noise")) {
      focusText
        .html("x:" + selectedData.date.getHours() + ":" + selectedData.date.getMinutes() + "  -  " + "y:" + selectedData.rate + " dB")
        .attr("x", x(selectedData.date) + 15)
        .attr("y", y(selectedData.rate))
        .style("font-size", "1.5em")

    } else if (id.includes("dust")) {
      focusText
        .html("x:" + selectedData.date.getHours() + ":" + selectedData.date.getMinutes() + "  -  " + "y:" + selectedData.rate + " µg/m^3")
        .attr("x", x(selectedData.date) + 15)
        .attr("y", y(selectedData.rate))
        .style("font-size", "1.5em")

    } else if (id.includes("co2")) {
      focusText
        .html("x:" + selectedData.date.getHours() + ":" + selectedData.date.getMinutes() + "  -  " + "y:" + selectedData.rate + " ppm")
        .attr("x", x(selectedData.date) + 15)
        .attr("y", y(selectedData.rate))
        .style("font-size", "1.5em")
    }

  }
  function mouseout() {
    focus.style("opacity", 0)
    focusText.style("opacity", 0)
  }


  // Ajouter un label à l'axe X
  svg.append("text")
    .attr("x", width / 2)
    .attr("y", height+90) // Ajustez la position verticale selon vos besoins
    .attr("text-anchor", "middle")
    .style("font-size", "2.5em")
    .text("Temps P.M (en min)");



  //Ajout du titre au graphique et de la moyenne et de l'écart type
  if (id.includes("card")) {
    document.getElementById("titleHeartPlot").innerHTML = "Evolution du rythme cardiaque pour les " + minDiff + " dernières minutes, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanCard").innerHTML = "Rythme cardiaque moyen sur les " + minDiff + " dernières minutes : <strong>" + Math.round(Average(Rate)) + " bpm</strong>";
    document.getElementById("sdCard").innerHTML = "Ecart moyen entre deux pulsations sur les " + minDiff + " dernières minutes : <strong>" + Math.round(Math.pow(Variance(Rate), 0.5)) + " bpm </strong>";
    // Ajouter un label à l'axe Y
    svg.append("text")
      .attr("transform", "rotate(-90)") // Fait pivoter le texte de 90 degrés pour l'axe Y
      .attr("x", 0 - (height / 2))
      .attr("y", -margin.left + 50) // Ajustez la position verticale selon vos besoins
      .attr("text-anchor", "middle")
      .style("font-size", "2.5em")
      .text("Rythme cardiaque (en bpm)");
  }
  else if (id.includes("temp")) {

    document.getElementById("titleTempPlot").innerHTML = "Evolution de la température pour les " + hoursDiff + " dernières heures, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanTemp").innerHTML = "Température moyenne sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Average(Rate)) + " bpm</strong>";
    document.getElementById("sdTemp").innerHTML = "Ecart moyen entre deux mesures sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Math.pow(Variance(Rate), 0.5)) + " °C </strong>";

    // Ajouter un label à l'axe Y
    svg.append("text")
      .attr("transform", "rotate(-90)") // Fait pivoter le texte de 90 degrés pour l'axe Y
      .attr("x", 0 - (height / 2))
      .attr("y", -margin.left + 50) // Ajustez la position verticale selon vos besoins
      .attr("text-anchor", "middle")
      .style("font-size", "2.5em")
      .text("Température (en °C)");


  }
  else if (id.includes("noise")) {
    document.getElementById("titleNoisePlot").innerHTML = "Evolution du niveau sonore pour les " + hoursDiff + " dernières heures, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanNoise").innerHTML = "Niveau sonore moyen sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(calculerMoyenneDecibels(Rate)) + " dB</strong>";
    document.getElementById("sdNoise").innerHTML = "Ecart moyen entre deux mesures sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Math.pow(calculerVarianceDecibels(Rate), 0.5)) + " dB </strong>";
    // Ajouter un label à l'axe Y
    svg.append("text")
      .attr("transform", "rotate(-90)") // Fait pivoter le texte de 90 degrés pour l'axe Y
      .attr("x", 0 - (height / 2))
      .attr("y", -margin.left + 50) // Ajustez la position verticale selon vos besoins
      .attr("text-anchor", "middle")
      .style("font-size", "2.5em")
      .text("Niveau sonore (en dB)");
  }
  else if (id.includes("dust")) {
    document.getElementById("titleDustPlot").innerHTML = "Evolution du taux de microparticulle pour les " + hoursDiff + " dernières heures, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanDust").innerHTML = "Taux de microparticulle moyen sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Average(Rate)) + " µg/m^3</strong>";
    document.getElementById("sdDust").innerHTML = "Ecart moyen entre deux mesures sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Math.pow(Variance(Rate), 0.5)) + " µg/m^3</strong>";
    // Ajouter un label à l'axe Y
    svg.append("text")
      .attr("transform", "rotate(-90)") // Fait pivoter le texte de 90 degrés pour l'axe Y
      .attr("x", 0 - (height / 2))
      .attr("y", -margin.left + 50) // Ajustez la position verticale selon vos besoins
      .attr("text-anchor", "middle")
      .style("font-size", "2.5em")
      .text("Taux de microparticulle (en µg/m^3)");
  }
  else if (id.includes("co2")) {
    document.getElementById("titleCo2Plot").innerHTML = "Evolution du taux de co2 pour les " + hoursDiff + " dernières heures, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanCo2").innerHTML = "Taux de co2 moyen sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Average(Rate)) + " ppm</strong>";
    document.getElementById("sdCo2").innerHTML = "Ecart moyen entre deux mesures sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Math.pow(Variance(Rate), 0.5)) + " ppm </strong>";
    // Ajouter un label à l'axe Y
    svg.append("text")
      .attr("transform", "rotate(-90)") // Fait pivoter le texte de 90 degrés pour l'axe Y
      .attr("x", 0 - (height / 2))
      .attr("y", -margin.left + 50) // Ajustez la position verticale selon vos besoins
      .attr("text-anchor", "middle")
      .style("font-size", "2.5em")
      .text("Taux de microparticulle (en ppm)");
  }



  return svg;
  //--------------------------------------------Fin du code création du graph sur les données cardiaque--------------------------------------

}