/**
 * Handles the code necessary to compute the Exponential Moving Average.
 */
class EMA {

    constructor() {
        this.movingAverages = [];
        this.periodCutoff = 7;
    }

    getSampleData(dataset) {

        if (this.movingAverages.length == 0 || (dataset[0].time.getTime() - this.movingAverages[0].time.getTime()) / 1000 > this.periodCutoff)
            this.movingAverages.unshift(dataset[0]);

        if (this.movingAverages.length > 52)
            this.movingAverages.pop();
    }

    expMovingAvg2(mArray, mRange) {
        var averages = [];

        for (var i = mRange - 1; i >= 0; i--) {
            var expAvg = 0;

            if (i == 11) {
                expAvg = parseFloat(mArray[i].price);
            } else {
                var previous = averages[0];
                var smoothingFactor = 2 / (1 + mRange);

                expAvg = previous + (smoothingFactor * (parseFloat(mArray[i].price) - previous));
            }

            averages.unshift(expAvg);
        }

        return averages;
    }

    calculate12(dataset) {
        this.getSampleData(dataset);

        if (this.movingAverages.length >= 12) {
            return this.expMovingAvg2(this.movingAverages, 12)[0];
        }
    }

    calculate26(dataset) {
        this.getSampleData(dataset);

        if (this.movingAverages.length >= 26) {

            return this.expMovingAvg2(this.movingAverages, 26)[0]
        }
    }

}
