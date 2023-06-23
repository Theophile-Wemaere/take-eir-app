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
      var datas = JSON.parse(xhr.responseText);
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

      var tauxVOC = [];

      // Parcourir les données et les trier en fonction du type de métrique
      datas.forEach((element) => {
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
          case 7:
            tauxVOC.push(parseFloat(value));
            break;
        }
      });

      createChart(
        "chartECG",
        "Frequence Cardiaque",
        "battements / min (bpm)",
        rythmeCardiaque,
        rythmeCardiaqueTime,
        'rgb(255, 0, 0)'
      );
      createChart(
        "chartTemp",
        "Température",
        "temperature (°C)",
        temperature,
        temperatureTime,
        'rgb(0, 128, 0)'
      );
      createChart(
        "chartHumidity",
        "Humidité",
        "humidité (%)",
        humidity,
        humidityTime,
        'rgb(100, 0, 100)'
      );
      createChart(
        "chartNoise",
        "Bruit ambiant",
        "niveau de bruit (dB)",
        niveauSonore,
        niveauSonoreTime,
        'rgb(255, 165, 0)'
      );
      createChart(
        "chartDust",
        "Taux de microparticules",
        "microparticules (µg/m³)",
        tauxMicroparticules,
        tauxMicroparticulesTime,
        'rgb(0, 0, 255)'
      );
      createChart(
        "chartCO2",
        "CO2 et VOC",
        "taux de CO2 (ppm)",
        tauxCO2,
        tauxCO2Time,
        'rgb(128, 0, 128)'
      );

      var chart = Chart.getChart("chartCO2");
      var data = chart.data;
      data.datasets.push({
        label: 'taux de particules organiques (ppb)',
        data: [],
        borderColor: 'rgb(0, 128, 128)', // Customize the line color
        borderWidth: 1, // Customize the line width
        fill: false, // Disable filling the area under the line
      });
      for (var i = 0; i < tauxVOC.length; i++) {
        data.datasets[1].data.push(tauxVOC[i]);
      }

      document.getElementById("0_0").style.display = "flex";

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

function createChart(id, name, label, values, entry_time, color) {
  var ctx = document.getElementById(id).getContext("2d");
  var chart = new Chart(ctx, {
    type: "line",
    data: {
      labels: [], // initial empty labels array
      datasets: [
        {
          label: label,
          data: [], // initial empty data array
          fill: false,
          borderColor: color,
          tension: 0.1,
        },
      ],
    },
    options: {
      responsive: true,
      scales: {
        x: {
          display: true,
          title: {
            display: true,
            text: "Temps",
          },
        },
        y: {
          display: true,
          title: {
            display: true,
            text: name,
          },
          suggestedMin: 0,
          suggestedMax: Math.max(...values) * 2,
        },
      },
    },
  });
  var data = chart.data;
  for (var i = 0; i < entry_time.length; i++) {
    data.labels.push(entry_time[i].split(" ")[1]);
    data.datasets[0].data.push(values[i]);
  }
}

function updateChart(type, id) {
  var canvas = document.getElementById(id);
  var chart = Chart.getChart(canvas);
  const urlParams = new URLSearchParams(window.location.search);
  const id_device = urlParams.get("device");

  fetch(
    "/controllers/monitor-controller.php?action=" +
    type +
    "&device=" +
    id_device,
    {
      method: "GET",
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
        data.labels.push(entryTime.split(" ")[1]);
        data.datasets[0].data.push(newData);

        // Remove the first data point if the dataset becomes too large
        if (data.labels.length > 100) {
          data.labels.shift();
          data.datasets[0].data.shift();
        }

        // Update the chart
        chart.update();
      }
    });
}

function refreshChart() {
  const metricTypes = {
    1: 'chartECG',
    2: 'chartTemp',
    3: 'chartNoise',
    4: 'chartDust',
    5: 'chartCO2',
    6: 'chartHumidity',
    7: 'chartCO2'
  };

  const urlParams = new URLSearchParams(window.location.search);
  const id_device = urlParams.get("device");

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

  var tauxVOC = [];

  fetch("/controllers/monitor-controller.php?action=metrics&device=" + id_device, {
    method: 'GET',
  })
    .then((res) => res.json())
    .then((res) => {
      if (res !== null) {
        // Parcourir les données et les trier en fonction du type de métrique
        res.forEach((element) => {
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
            case 7:
              tauxVOC.push(parseFloat(value));
              break;
          }
        });
      }
    });

  for (var i = 1; i <= 7; i++) {
    const id = metricTypes[i];
    const chart = Chart.getChart(document.getElementById(id));
    var values = [];
    var times = [];
    switch (i) {
      case 1:
        values = rythmeCardiaque;
        times = rythmeCardiaqueTime;
        break;
      case 2:
        values = temperature;
        times = temperatureTime;
        break;
      case 3:
        values = niveauSonore;
        times = niveauSonoreTime;
        break;
      case 4:
        values = tauxMicroparticules;
        times = tauxMicroparticulesTime;
        break;
      case 5:
        values = tauxCO2;
        times = tauxCO2Time;
        break;
      case 6:
        values = humidity;
        times = humidityTime;
        break;
      case 7:
        values = tauxVOC;
        break;
    }
    var data = chart.data;
    if (i != 7) {
      data.labels = [];
      data.datasets[0].data = [];
      for (var i = 0; i < times.length; i++) {
        data.labels.push(times[i].split(" ")[1]);
        data.datasets[0].data.push(values[i]);
      }
    } else {
      data.datasets[1].data = [];
      for (var i = 0; i < times.length; i++) {
        data.datasets[1].data.push(values[i]);
      }
    }
  }
}

function updateCharts() {
  const metricTypes = {
    1: 'chartECG',
    2: 'chartTemp',
    3: 'chartNoise',
    4: 'chartDust',
    5: 'chartCO2',
    6: 'chartHumidity',
    7: 'chartCO2'
  };

  const urlParams = new URLSearchParams(window.location.search);
  const id_device = urlParams.get('device');

  fetch('/controllers/monitor-controller.php?action=update&device=' + id_device, {
    method: 'GET',
  })
    .then((res) => res.json())
    .then((res) => {
      if (res !== null) {
        console.log(res);
        res.forEach((dataPoint) => {
          const metricType = dataPoint.metric_type;
          const id = metricTypes[metricType];
          const chartCanvas = document.getElementById(id)
          const chart = Chart.getChart(chartCanvas);

          const newData = dataPoint.value;
          const entryTime = dataPoint.entry_time;

          const data = chart.data;

          var modifiedData = Object.assign({}, data);

          modifiedData.labels = data.labels.slice();
          modifiedData.datasets[0].data = data.datasets[0].data.slice();
          modifiedData.labels.push(entryTime.split(" ")[1]);

          if (metricType === 7 ) {
            modifiedData.datasets[1] = Object.assign({}, data.datasets[1]);
            modifiedData.datasets[1].data = data.datasets[1].data.slice();
            modifiedData.datasets[1].data.push(newData);
            
          } else {
            if (metricType === 5) {
              modifiedData.datasets[1] = Object.assign({}, data.datasets[1]);
              modifiedData.datasets[1].data = data.datasets[1].data.slice();
              modifiedData.datasets[1].data.shift();
            }
            modifiedData.datasets[0].data.push(newData);
            modifiedData.datasets[0].data.shift();
          }

          modifiedData.labels.shift();
          

          chart.data = modifiedData;

          chart.update();
        });
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
