$(function(){
    $("#db-range").slider({
        step: 1,
        range: true,
        min: 0,
        max: 100,
        values: [0,100],
        slide: function(event, ui)
        {$("#dbRange").val(ui.values[0] + " - " + ui.values[1]);}
    });
    $("#dbRange").val($("price-range").slider("values", 0)+ " - " + $("#db-range").slider("values",1));
});