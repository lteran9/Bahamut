/**
 * Handles the code necessary to display and update a Trade Visualizer.
 */
class Visualizer {

    /**
     *  Defaults to display price at current value and updates every second.
     * 
     */
    constructor() {
        this.ctx = document.getElementById('visualizer').getContext('2d');
        this.chart = new Chart(this.ctx, {
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
            options: {}
        });
    }

    getVisualizer(){
        return this.chart;
    }

    /**
    * Update chart in real time (with just price for now)
    * 
    * @param {*} price
    */
    updateChart(price) {

        this.chart.data.datasets[0].data.push(price);
        this.chart.update();
        // pop = remove last
        // shift = remove first
        // unshift = add first
        // push = add last
    }

    makeLowChart(){
        this.chart.data.datasets[0].label.pop();
        this.chart.data.datasets[0].label.push("Low");
        this.chart.update();
    }

    makeHighChart(){
        
    }

    makeOpeningChart(){
        
    }

    makeClosingChart(){
        
    }
}