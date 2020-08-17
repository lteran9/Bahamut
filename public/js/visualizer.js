var ctx = document.getElementById('visualizer').getContext('2d');
window.chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: [],
        datasets: [{
            label: 'Price',
            //backgroundColor: 'rgb(0, 99, 132)',
            borderColor: 'rgb(0, 99, 132)',
            data: []
        }]
    },

    // Configuration options go here
    options: {
    }
});

function updateChart(price) {
    // Update chart in real time
    
    if(chart.data.labels.length < 10){
        chart.data.labels = data.labels.push(((chart.data.labels.length)+1));
    }
    if (chart.data.dataset[0].data.length >= 10){
        chart.data.dataset[0].data.shift;
        chart.data.labels.shift;
    }
    chart.data.datasets[0].data.push(price);
    chart.update();

    // pop = remove last
    // shift = remove first
    // unshift = add first
    // push = add last
}

updateChart();
setInterval(() => {
  updateChart();
}, 1000);