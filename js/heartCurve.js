//Importation des dates et des données cardiques depuis les div invisibles
var date =  document.getElementById("date_data");
var heartRate = document.getElementById("heart_data");
var tempRate = document.getElementById("temp_data");
var noiseRate = document.getElementById("noise_data");
var co2Rate = document.getElementById("co2_data");
var dustRate = document.getElementById("dust_data");

//Conversion d'un string en en vecteur de string
var dateSplit = JSON.parse(date.textContent);
var heartRateSplit = JSON.parse(heartRate.textContent);
var tempRateSplit = JSON.parse(tempRate.textContent);
var noiseRateSplit = JSON.parse(noiseRate.textContent);
var co2RateSplit = JSON.parse(co2Rate.textContent);
var dustRateSplit = JSON.parse(dustRate.textContent);

// Conversion des données
var convertDate = [];
var convertHeartRate = [];
var convertTempRate = [];
var convertNoiseRate = [];
var convertCo2Rate = [];
var convertDustRate = [];

for (i = 0; i < heartRateSplit.length; i++) { 
    convertDate.push(new Date(dateSplit[i]))
    convertHeartRate.push(parseFloat(heartRateSplit[i]))
    convertTempRate.push(parseFloat(tempRateSplit[i]))
    convertNoiseRate.push(parseFloat(noiseRateSplit[i]))
    convertCo2Rate.push(parseFloat(co2RateSplit[i]))
    convertDustRate.push(parseFloat(dustRateSplit[i]))
}

// set the dimensions and margins of the graph
const margin = { top: 10, right: 30, bottom: 30, left: 60 },
  width = 460 - margin.left - margin.right,
  height = 400 - margin.top - margin.bottom;

// append the svg object to the body of the page
const svg = d3
  .select("#cardiacGraph")
  .append("svg")
  .attr("width", width + margin.left + margin.right)
  .attr("height", height + margin.top + margin.bottom)
  .append("g")
  .attr("transform", `translate(${margin.left},${margin.top})`);

var convertDate = convertDate.slice(-10);
var convertHeartRate = convertHeartRate.slice(-10);
// Format the data
const data = convertDate.map((date, i) => ({ date: date, cardiac: convertHeartRate[i] }));


// Create the scale for the horizontal axis (time)
const x = d3.scaleTime()
  .domain(d3.extent(data, d => d.date))
  .range([0, width]);

svg.append("g")
  .attr("transform", `translate(0, ${height})`)
  .call(d3.axisBottom(x));

// Add Y axis
const y = d3.scaleLinear()
  .domain([d3.min(data, d => d.cardiac), d3.max(data, d => d.cardiac)])
  .range([height, 0]);

svg.append("g")
  .call(d3.axisLeft(y));

// Add the line
svg.append("path")
  .datum(data)
  .attr("fill", "none")
  .attr("stroke", "black")
  .attr("stroke-width", 1.5)
  .attr("d", d3.line()
    .x(d => x(d.date))
    .y(d => y(d.cardiac))
  );

// Create a tooltip
const Tooltip = d3
  .select("#cardiacGraph")
  .append("div")
  .style("opacity", 0)
  .attr("class", "tooltip")
  .style("background-color", "white")
  .style("border", "solid")
  .style("border-width", "2px")
  .style("border-radius", "5px")
  .style("padding", "5px");

// Define functions for tooltip interaction
const mouseover = function (event, d) {
  Tooltip.style("opacity", 1);
};

const mousemove = function (event, d) {
  Tooltip
    .html("Exact value: " + d.cardiac)
    .style("left", `${event.pageX + 10}px`) // Use pageX instead of layerX
    .style("top", `${event.pageY}px`); // Use pageY instead of layerY
};

const mouseleave = function (event, d) {
  Tooltip.style("opacity", 0);
};

const nomsMois = [
  'janvier', 'février', 'mars', 'avril', 'mai', 'juin',
  'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'
];

// Add the points
svg
.append("g")
  .selectAll("dot")
  .data(data)
  .join("circle")
  .attr("class", "myCircle")
  .attr("cx", d => x(d.date))
  .attr("cy", d => y(d.cardiac))
  .attr("r", 8)
  .attr("stroke", "#69b3a2")
  .attr("stroke-width", 3)
  .attr("fill", "white")
  .on("mouseover", mouseover)
  .on("mouseover", mouseover)
  .on("mousemove", mousemove)
  .on("mouseleave", mouseleave);



svg.append("text").text("Evolution du rythme cardiaque pour le "+data[data.length].date.getDay()+ " " +nomsMois[data[data.length].date.getMonth()] + " " + data[data.length].date.getFullYear() )

