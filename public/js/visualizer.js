/**
 * Handles the code necessary to display and update a Trade Visualizer.
 */
class Visualizer {

    /**
     *  Defaults to display price at current value and updates every second.
     * 
     */
    constructor() {
        this.data = [];
        this.counter = 0;

        this.maxlength = 20;
        this.chart = new CanvasJS.Chart("visualizer", {
            exportEnabled: false,
            animationEnabled: true,
            zoomEnabled: false,
            toolTip: {
                shared: true
            },
            axisY: {
                //title: "Dollars",
                gridThickness: 1,
                //valueFormatString: "#0,,.",
                prefix: "$",
                minimum: 11600,
                //maximum: 11410,
            },
            axisX: {
                title: "Trades (updates every three seconds)",
                gridThickness: 1,
                labelWrap: true,
                interlacedColor: "rgb(255,250,250)",
                gridColor: "#FFBFD5"
            },
            theme: "light2",
            data: [{    
                //yValueFormatString: "##,### Units",    
                type: "spline",
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

    }

    makeHighChart(){
        
    }

    makeOpeningChart(){
        
    }

    makeClosingChart(){
        
    }
}