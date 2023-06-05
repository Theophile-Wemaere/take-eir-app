// Code JavaScript avec Ajax
function fetchPeriodicData() {
    var xhr = new XMLHttpRequest();
    const urlParams = new URLSearchParams(window.location.search);
    const id_device = urlParams.get("device");
    xhr.open('POST', '/controllers/monitor-controller.php?action=metrics&device=' + id_device, true);
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
                var metricType = element.metric_type;
                var entryTime = new Date(element.entry_time);
                var value = element.value;

                // Tri des données en fonction du type de métrique
                switch (parseInt(metricType)) {
                    case 1:
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

            // Appeler la fonction Plot() ici, une fois que les données sont disponibles
            Plot(rythmeCardiaqueTime, rythmeCardiaque, '#cardiacGraph', "rgb(224, 88, 76)");
            Plot(temperatureTime, temperature, '#tempGraph', "#5DD1B7");
            Plot(humidityTime, humidity, '#humidityGraph', "#6883F5");
            Plot(niveauSonoreTime, niveauSonore, '#noiseGraph', "#712DE0");
            Plot(tauxMicroparticulesTime, tauxMicroparticules, '#dustGraph', "#67B4C5");
            Plot(tauxCO2Time, tauxCO2, '#co2Graph', "grey");

            // Appeler la fonction createGauge() ici, une fois que les données sont disponibles
            createGauge("cardGaugeContainer", 0, 120, 'BPM', rythmeCardiaque[rythmeCardiaque.length - 1]);
            createGauge("tempGaugeContainer", 0, 40, '°C', temperature[temperature.length - 1]);
            createGauge("humidityGaugeContainer", 0, 100, '%', humidity[humidity.length - 1]);
            createGauge("noiseGaugeContainer", 0, 120, 'DB', niveauSonore[niveauSonore.length - 1]);
            createGauge("dustGaugeContainer", 0, 250, 'µg/m^3', tauxMicroparticules[tauxMicroparticules.length - 1]);
            createGauge("co2GaugeContainer", 0, 2000, 'PPM', tauxCO2[tauxCO2.length - 1]);
        }
    };

    xhr.send();
}

function getPatient() {
    const urlParams = new URLSearchParams(window.location.search);
    const id_device = urlParams.get("device");

    const name = document.getElementById("name");
    const surname = document.getElementById("surname");
    const email = document.getElementById("email");
    const key = document.getElementById("key");

    fetch("/controllers/monitor-controller.php?action=patient&device=" + id_device, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data)
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

    const data = new FormData()
    data.append("action","update_patient");
    data.append("name",name);
    data.append("surname",surname);
    data.append("doctor_email",email);
    data.append("id_device",id_device);

    fetch("/controllers/device-controller.php", {
        method: "POST",
        body: data,
    })
        .then((res) => res.text())
        .then((res) => {
            if(res === "success") {
                success.style.display = "block";
            }
        });
}

