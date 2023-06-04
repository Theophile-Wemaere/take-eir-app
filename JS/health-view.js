function getDevices() {
    fetch("/controllers/device-controller.php?action=devices")
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            const devicesList = document.querySelector(".devices-list");

            data.forEach((row) => {
                const deviceDiv = document.createElement("div");
                deviceDiv.classList.add("device");
                deviceDiv.addEventListener("click", function() {
                    window.location.href = "/index.php/monitoring?device=" + row.id_device;
                  });

                const keyParagraph = document.createElement("p");
                keyParagraph.textContent = row.id_device;
                deviceDiv.appendChild(keyParagraph);

                const patientParagraph = document.createElement("p");
                var patient = row.name + " " + row.surname;
                patientParagraph.textContent = patient;
                deviceDiv.appendChild(patientParagraph);

                const heartbeatIcon = document.createElement("i");
                heartbeatIcon.classList.add("fa", "fa-heartbeat");
                deviceDiv.appendChild(heartbeatIcon);

                const heartbeatValue = document.createElement("p");
                heartbeatValue.classList.add("value");
                deviceDiv.appendChild(heartbeatValue);

                const smileIcon = document.createElement("i");
                deviceDiv.appendChild(smileIcon);

                const statusValue = document.createElement("p");
                statusValue.classList.add("value");
                deviceDiv.appendChild(statusValue);

                fetch("/controllers/device-controller.php?action=status&device=" + row.id_device)
                    .then((response) => response.json())
                    .then((data) => {
                        heartbeatValue.textContent = data.value + " bpm";
                        if(data.value < 50 || data.value > 100) {
                            smileIcon.classList.add("fa", "fa-frown-o", "bad");
                            statusValue.textContent = "bad";
                        } else if(data.value > 50 && data.value < 60) {
                            smileIcon.classList.add("fa", "fa-meh-o", "medium");
                            statusValue.textContent = "medium";
                        } else {
                            smileIcon.classList.add("fa", "fa-smile-o", "good");
                            statusValue.textContent = "good";
                        }
                    });
                devicesList.appendChild(deviceDiv);
            });


        })
        .catch((error) => {
            console.error(error);
        });
}