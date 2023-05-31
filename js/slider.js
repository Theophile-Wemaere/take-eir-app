function sliderRange(idRange, idValue, step, min, max,){
    $(function () {
        $(idRange).slider({
          step: step,
          range: true,
          min: min,
          max: max,
          values: [min, max],
          slide: function (event, ui) { $(idValue).val(ui.values[0] + " - " + ui.values[1]); }
        });
        $(idValue).val($(idRange).slider("values", 0) + " - " + $(idRange).slider("values", 1));
      });
}