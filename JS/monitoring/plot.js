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
  height = 1200 - margin.top - margin.bottom;

const nomsMois = [
  'janvier', 'février', 'mars', 'avril', 'mai', 'juin',
  'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'
];

function Plot(time, ord1, id) {
  //On conserve les données des X dernières minutes
  new_dates = [];

  time.forEach(element => {
    new_dates.push(new Date(element));
  });

  var dates = new_dates.slice();
  var Rate = ord1.slice();

  // Format the data
  const data = dates.map((date, i) => ({ date: new Date(date), rate: Rate[i] }));

  // Temps en minute
  minDiff = getTimeDifferenceInMinutes(new Date(dates[0]), new Date(dates[dates.length - 1]));
  hoursDiff = getTimeDifferenceInHours(new Date(dates[0]), new Date(dates[dates.length - 1]));

  // Ajout du titre au graphique et de la moyenne et de l'écart type
  if (id.includes("card")) {
    document.getElementById("titleHeartPlot").innerHTML = "Évolution du rythme cardiaque du patient sur les " + minDiff + " dernières minutes, pour la journée du " + dates[dates.length - 1].getDate() + " " + nomsMois[dates[dates.length - 1].getMonth()] + " " + dates[dates.length - 1].getFullYear();
    document.getElementById("meanCard").innerHTML = "Rythme cardiaque moyen sur les " + minDiff + " dernières minutes : <strong>" + Math.round(Average(Rate)) + " bpm</strong>";
    document.getElementById("sdCard").innerHTML = "Écart moyen entre deux pulsations sur les " + minDiff + " dernières minutes : <strong>" + Math.round(Math.pow(Variance(Rate), 0.5)) + " bpm</strong>";
  } else if (id.includes("temp")) {
    document.getElementById("titleTempPlot").innerHTML = "Évolution de la température dans la chambre sur les " + hoursDiff + " dernières heures, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanTemp").innerHTML = "Température moyenne sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Average(Rate)) + " °C</strong>";
    document.getElementById("sdTemp").innerHTML = "Écart moyen entre deux mesures sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Math.pow(Variance(Rate), 0.5)) + " °C </strong>";
  } else if (id.includes("noise")) {
    document.getElementById("titleNoisePlot").innerHTML = "Évolution du niveau sonore dans la chambre sur les " + hoursDiff + " dernières heures, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanNoise").innerHTML = "Niveau sonore moyen sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(calculerMoyenneDecibels(Rate)) + " dB</strong>";
    document.getElementById("sdNoise").innerHTML = "Écart moyen entre deux mesures sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Math.pow(calculerVarianceDecibels(Rate), 0.5)) + " dB </strong>";
  } else if (id.includes("dust")) {
    document.getElementById("titleDustPlot").innerHTML = "Évolution du taux de microparticules dans la chambre sur les " + hoursDiff + " dernières heures, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanDust").innerHTML = "Taux de microparticules moyen sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Average(Rate)) + " µg/m^3</strong>";
    document.getElementById("sdDust").innerHTML = "Écart moyen entre deux mesures sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Math.pow(Variance(Rate), 0.5)) + " µg/m^3</strong>";
  } else if (id.includes("co2")) {
    document.getElementById("titleCo2Plot").innerHTML = "Évolution du taux de CO2 dans la chambre sur les " + hoursDiff + " dernières heures, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanCo2").innerHTML = "Taux de CO2 moyen sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Average(Rate)) + " ppm</strong>";
    document.getElementById("sdCo2").innerHTML = "Écart moyen entre deux mesures sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Math.pow(Variance(Rate), 0.5)) + " ppm </strong>";
  } else if (id.includes("humidity")) {
    document.getElementById("titleHumidityPlot").innerHTML = "Évolution du taux d'humidité dans la chambre sur les " + hoursDiff + " dernières heures, pour la journée du " + data[data.length - 1].date.getDate() + " " + nomsMois[data[data.length - 1].date.getMonth()] + " " + data[data.length - 1].date.getFullYear();
    document.getElementById("meanHumidity").innerHTML = "Taux d'humidité moyen sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Average(Rate)) + " %</strong>";
    document.getElementById("sdHumidity").innerHTML = "Écart moyen entre deux mesures sur les " + hoursDiff + " dernières heures : <strong>" + Math.round(Math.pow(Variance(Rate), 0.5)) + " %</strong>";
  }
}