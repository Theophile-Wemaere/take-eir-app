function recupData() {
    //Importation des dates et des données cardiques depuis les div invisibles
    var date = document.getElementById("date_data");
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

    return [convertDate, convertHeartRate, convertTempRate, convertNoiseRate, convertCo2Rate, convertDustRate];
    // Fin de la récupération des données

}