function createGauge(containerId, minValue, maxValue, label, newValue) {
    // Configuration de la jauge
    var gaugeConfig = {
        id: containerId,
        value: newValue,
        min: minValue,
        max: maxValue,
        gaugeWidthScale: 0.6,
        counter: true,
        label: label,
        levelColors: ['#00FF00','#FFA500','#FF0000'], // Couleurs des niveaux de la jauge
        levelColorsGradient: true, // Utiliser un dégradé de couleur entre les niveaux
    };

    // Créer la jauge
    var gauge = new JustGage(gaugeConfig);

    // Retourner la jauge créée
    return gauge;
}
