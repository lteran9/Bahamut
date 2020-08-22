/**
 * Handles the code necessary to display and update a Trade Visualizer.
 */
class Visualizer {

    /**
     *  Defaults to display price at current value and updates every second.
     * 
     */
    constructor() {
        this.data = []
        this.counter = 0;

        this.maxlength = 20;
        this.chart = new CanvasJS.Chart("visualizer", {
            exportEnabled: true,
            animationEnabled: true,
            zoomEnabled: false,
            axisY: {
                title: "Dollars",
                //valueFormatString: "#0,,.",
                prefix: "$",
                minimum: 11400,
                maximum: 11410,
                stripLines: [{
                    value: 11000,
                    label: "Average"
                }]
            },
            axisX: {
                title: "Seconds",
                gridThickness: 1,
                labelWrap: true,
            },
            theme: "light2",
            data: [{    
                //yValueFormatString: "##,### Units",    
                type: "line",
                  indexLabelFontSize: 16,
                dataPoints: this.data
            }]
        });
        this.chart.render();
    }

    getVisualizer(){
        return this.chart;
    }

    /**
    * Update chart in real time (with just price for now)
    * 
    * @param {*} price
    */
    updateChartPrice(price) {
        this.data.push({
			x: this.counter,
			y: price
        });
        
        this.counter++;

        if (this.data.length > this.maxlength) {
            this.data.shift();
        }
        this.chart.render();
        console.log(this.data);

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