function sliderRange(idRange, idValue, step, v1, v2, min, max) {

    $(function () {
        $(idRange).slider({
            step: step,
            range: true,
            min: min,
            max: max,
            values: [v1, v2],
            slide: function (event, ui) {
                if (idRange.includes("heart")) {
                    $(idValue).val(ui.values[0] + " bpm - " + ui.values[1] + " bpm");
                }
                else if (idRange.includes("temp")) {
                    $(idValue).val(ui.values[0] + " °C - " + ui.values[1] + " °C");
                }
                else if (idRange.includes("noise")) {
                    $(idValue).val(ui.values[0] + " dB - " + ui.values[1] + " dB");
                }
            }
        });
    });
    var unit = "";
    if (idRange.includes("heart")) {
        unit = " bpm";
    }
    else if (idRange.includes("temp")) {
        unit = " °C";
    }
    else if (idRange.includes("noise")) {
        unit = " dB";
    }
    $(idValue).val($(idRange).slider("values", 0) + unit + " - " + $(idRange).slider("values", 1) + unit);
}

function getThreshold() {
    const urlParams = new URLSearchParams(window.location.search);
    const id_device = urlParams.get("device");
    fetch("/controllers/monitor-controller.php?action=threshold&device=" + id_device, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((response) => {
            if (response !== null) {
                response.forEach(element => {
                    if (parseInt(element.metric_type) === 1) {
                        const [min, max] = element.value.split(":");
                        const minValue = parseInt(min, 10);
                        const maxValue = parseInt(max, 10);
                        sliderRange("#heart-range", "#heartRange", 1, minValue, maxValue, 0, 150);
                    }
                });
            }
        });
}

function setThreshold(idRange, type) {
    const urlParams = new URLSearchParams(window.location.search);
    const id_device = urlParams.get("device");
    const min = $(idRange).slider("values", 0);
    const max = $(idRange).slider("values", 1);

    const error = document.getElementById("error-msg");
    error.style.display = "none";

    const success = document.getElementById("success-msg2");
    success.style.display = "none";

    if (confirm("Mettre à jour le seuil d'alerte ?")) {
        data = new FormData();
        data.append("action", "set_threshold");
        data.append("type", type);
        data.append("min", min);
        data.append("max", max);
        data.append("device", id_device);
        fetch("/controllers/monitor-controller.php", {
            method: "POST",
            body: data,
        })
            .then((res) => res.text())
            .then((res) => {
                
                if(res === "success") {
                    success.style.display = "block";
                    console.log(success.style.display);
                } else if (res === "error_doctor") {
                    error.style.display = "block";
                }

            });
    }
}
