// Code JavaScript avec Ajax
/*function fetchPeriodicData() {
  var xhr = new XMLHttpRequest();
  const urlParams = new URLSearchParams(window.location.search);
  const id_device = urlParams.get("device");
  xhr.open(
    "POST",
    "/controllers/monitor-controller.php?action=metrics&device=" + id_device,
    true
  );
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

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
      data.forEach((element) => {
        var metricType = element.metric_type;
        var entryTime = new Date(element.entry_time);
        var value = element.value;

        // Tri des données en fonction du type de métrique
        switch (parseInt(metricType)) {
          case 1:
            rythmeCardiaqueTime.push(entryTime);
            rythmeCardiaque.push(parseFloat(value));
            break;
          case 2:
            temperatureTime.push(entryTime);
            temperature.push(parseFloat(value));
            break;
          case 3:
            niveauSonoreTime.push(entryTime);
            niveauSonore.push(parseFloat(value));
            break;
          case 4:
            tauxMicroparticulesTime.push(entryTime);
            tauxMicroparticules.push(parseFloat(value));
            break;
          case 5:
            tauxCO2Time.push(entryTime);
            tauxCO2.push(parseFloat(value));
            break;
          case 6:
            humidityTime.push(entryTime);
            humidity.push(parseFloat(value));
            break;
        }
      });

      // Initial plot
      Plot(
        rythmeCardiaqueTime,
        rythmeCardiaque,
        "#cardiacGraph",
        "rgb(224, 88, 76)"
      );

      Plot(temperatureTime, temperature, "#tempGraph", "#5DD1B7");
      Plot(humidityTime, humidity, "#humidityGraph", "#6883F5");
      Plot(niveauSonoreTime, niveauSonore, "#noiseGraph", "#712DE0");
      Plot(
        tauxMicroparticulesTime,
        tauxMicroparticules,
        "#dustGraph",
        "#67B4C5"
      );
      Plot(tauxCO2Time, tauxCO2, "#co2Graph", "grey");

      // Appeler la fonction createGauge() ici, une fois que les données sont disponibles
      createGauge(
        "cardGaugeContainer",
        0,
        120,
        "BPM",
        rythmeCardiaque[rythmeCardiaque.length - 1]
      );
      createGauge(
        "tempGaugeContainer",
        0,
        40,
        "°C",
        temperature[temperature.length - 1]
      );
      createGauge(
        "humidityGaugeContainer",
        0,
        100,
        "%",
        humidity[humidity.length - 1]
      );
      createGauge(
        "noiseGaugeContainer",
        0,
        120,
        "DB",
        niveauSonore[niveauSonore.length - 1]
      );
      createGauge(
        "dustGaugeContainer",
        0,
        250,
        "µg/m^3",
        tauxMicroparticules[tauxMicroparticules.length - 1]
      );
      createGauge(
        "co2GaugeContainer",
        0,
        2000,
        "PPM",
        tauxCO2[tauxCO2.length - 1]
      );
    }
  };

  xhr.send();
}*/

function fetchPeriodicData() {
  var xhr = new XMLHttpRequest();
  const urlParams = new URLSearchParams(window.location.search);
  const id_device = urlParams.get("device");
  xhr.open(
    "POST",
    "/controllers/monitor-controller.php?action=metrics&device=" + id_device,
    true
  );
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

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
      data.forEach((element) => {
        var metricType = element.metric_type;
        var entryTime = element.entry_time;
        var value = element.value;

        // Tri des données en fonction du type de métrique
        switch (parseInt(metricType)) {
          case 1:
            rythmeCardiaqueTime.push(entryTime);
            rythmeCardiaque.push(parseFloat(value));
            break;
          case 2:
            temperatureTime.push(entryTime);
            temperature.push(parseFloat(value));
            break;
          case 3:
            niveauSonoreTime.push(entryTime);
            niveauSonore.push(parseFloat(value));
            break;
          case 4:
            tauxMicroparticulesTime.push(entryTime);
            tauxMicroparticules.push(parseFloat(value));
            break;
          case 5:
            tauxCO2Time.push(entryTime);
            tauxCO2.push(parseFloat(value));
            break;
          case 6:
            humidityTime.push(entryTime);
            humidity.push(parseFloat(value));
            break;
        }
      });

      createChart('chartECG', 'Frequence Cardiaque', 'battements / min (bpm)', rythmeCardiaque, rythmeCardiaqueTime);
      createChart('chartTemp', 'Température', 'temperature (°C)', temperature, temperatureTime);
      createChart('chartHumidity', 'Humidité', 'humidité (%)', humidity, humidityTime);
      createChart('chartNoise', 'Bruit ambiant', 'niveau de bruit (dB)', niveauSonore, niveauSonoreTime);
      createChart('chartDust', 'Taux de microparticules', 'microparticules (µg/m³)', tauxMicroparticules, tauxMicroparticulesTime);
      createChart('chartCO2', 'CO2 et VOC', 'taux de CO2 (ppm)', tauxCO2, tauxCO2Time);

      document.getElementById('0_0').style.display = "flex";

      // Appeler la fonction createGauge() ici, une fois que les données sont disponibles
      createGauge(
        "cardGaugeContainer",
        0,
        120,
        "BPM",
        rythmeCardiaque[rythmeCardiaque.length - 1]
      );
      createGauge(
        "tempGaugeContainer",
        0,
        40,
        "°C",
        temperature[temperature.length - 1]
      );
      createGauge(
        "humidityGaugeContainer",
        0,
        100,
        "%",
        humidity[humidity.length - 1]
      );
      createGauge(
        "noiseGaugeContainer",
        0,
        120,
        "DB",
        niveauSonore[niveauSonore.length - 1]
      );
      createGauge(
        "dustGaugeContainer",
        0,
        250,
        "µg/m^3",
        tauxMicroparticules[tauxMicroparticules.length - 1]
      );
      createGauge(
        "co2GaugeContainer",
        0,
        2000,
        "PPM",
        tauxCO2[tauxCO2.length - 1]
      );
    }
  };

  xhr.send();
}

function createChart(id, name, label, values, entry_time) {
  var ctx = document.getElementById(id).getContext('2d');
  var chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [],  // initial empty labels array
      datasets: [{
        label: label,
        data: [],   // initial empty data array
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
      }]
    },
    options: {
      responsive: true,
      scales: {
        x: {
          display: true,
          title: {
            display: true,
            text: 'Temps'
          }
        },
        y: {
          display: true,
          title: {
            display: true,
            text: name
          },
          suggestedMin: Math.min(...values),
          suggestedMax: Math.max(...values)
        }
      }
    }
  });
  var data = chart.data;
  for (var i = 0; i < entry_time.length; i++) {
    data.labels.push(entry_time[i].split(' ')[1]);
    data.datasets[0].data.push(values[i]);
  }
}

function updateChart(type,id) {
  console.log("ddd");
  var canvas = document.getElementById(id);
  var chart = Chart.getChart(canvas);
  // Fetch data from the controller or data source
  // Here, we'll use a random value for demonstration purposes
  const urlParams = new URLSearchParams(window.location.search);
  const id_device = urlParams.get("device");

  fetch(
    "/controllers/monitor-controller.php?action=" + type + "&device=" + id_device,
    {
      method: "GET"
    }
  )
    .then((res) => res.json())
    .then((res) => {
      if (res !== null) {

        console.log(res.at(0));
        newData = res.at(0).value;
        entryTime = res.at(0).entry_time;

        // Get the current chart data
        var data = chart.data;

        // Add the new data point to the dataset
        data.labels.push(entryTime.split(' ')[1]);
        data.datasets[0].data.push(newData);

        // Remove the first data point if the dataset becomes too large
        if (data.labels.length > 10) {
          data.labels.shift();
          data.datasets[0].data.shift();
        }

        // Update the chart
        chart.update();
      }
    });
}

function getPatient() {
  const urlParams = new URLSearchParams(window.location.search);
  const id_device = urlParams.get("device");

  const name = document.getElementById("name");
  const surname = document.getElementById("surname");
  const email = document.getElementById("email");
  const key = document.getElementById("key");

  fetch(
    "/controllers/monitor-controller.php?action=patient&device=" + id_device,
    {
      method: "GET",
    }
  )
    .then((response) => response.json())
    .then((data) => {
      name.value = data.name;
      surname.value = data.surname;
      email.value = data.doctor_email;
      key.textContent = id_device;
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function updatePatient() {
  const name = document.getElementById("name").value;
  const surname = document.getElementById("surname").value;
  const email = document.getElementById("email").value;
  const urlParams = new URLSearchParams(window.location.search);
  const id_device = urlParams.get("device");

  const success = document.getElementById("success-msg");
  success.style.display = "none";

  const data = new FormData();
  data.append("action", "update_patient");
  data.append("name", name);
  data.append("surname", surname);
  data.append("doctor_email", email);
  data.append("id_device", id_device);

  fetch("/controllers/device-controller.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.text())
    .then((res) => {
      if (res === "success") {
        success.style.display = "block";
      }
    });
}
