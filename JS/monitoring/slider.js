function sliderRange(idRange, idValue, step,v1,v2, min, max) {
    
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
        console.log(unit);
        $(idValue).val($(idRange).slider("values", 0) + "DB" + " - " + $(idRange).slider("values", 1));
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
    fetch("/controllers/monitor-controller.php?action=threshold&device=123-456-789", {
        method: "GET",
      })
        .then((response) => response.json())
        .then((response) => {
          if (response !== null) {
            response.forEach(element => {
                if(element.metric_type === 1) {
                    const [min, max] = element.value.split(":");
                    const minValue = parseInt(min, 10);
                    const maxValue = parseInt(max, 10);
                    sliderRange("#heart-range", "#heartRange", 1, minValue, maxValue, 0, 150);
                }
            });
          }
        });
}