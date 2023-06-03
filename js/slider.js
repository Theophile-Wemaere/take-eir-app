function sliderRange(idRange, idValue, step, min, max) {
    $(function () {
        $(idRange).slider({
            step: step,
            range: true,
            min: min,
            max: max,
            values: [min, max],
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
        $(idValue).val($(idRange).slider("values", 0) + " - " + $(idRange).slider("values", 1));
    });
}
