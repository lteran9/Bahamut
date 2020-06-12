/**
 * Handles the code necessary to compute the Exponential Moving Average.
 */
class EMA {

   constructor(product) {
      // Time in seconds
      this.periods = [
         {
            seconds: 5,
            movingAverages: [],
            shortAvg: 0,
            longAvg: 0,
            product_id: product
         },
         {
            seconds: 15,
            movingAverages: [],
            shortAvg: 0,
            longAvg: 0,
            product_id: product
         },
         {
            seconds: 30,
            movingAverages: [],
            shortAvg: 0,
            longAvg: 0,
            product_id: product
         },
         {
            seconds: 60,
            movingAverages: [],
            shortAvg: 0,
            longAvg: 0,
            product_id: product
         }
      ]
   }

   update(dataset) {
      for (var i = 0; i < this.periods.length; i++) {
         this.getSampleData(dataset, this.periods[i].movingAverages, this.periods[i].seconds);
         this.calculate12(this.periods[i]);
         this.calculate26(this.periods[i]);
      }

      this.analyze();
   }

   getSampleData(dataset, movingAverages, slicePeriod) {
      if (movingAverages.length == 0 || (dataset[0].time.getTime() - movingAverages[0].time.getTime()) / 1000 > slicePeriod) {
         movingAverages.unshift(dataset[0]);
      }

      if (movingAverages.length > 52) {
         movingAverages.pop();
      }
   }

   analyze() {
      // true = bullish, false = bearish
      var analysis = 0;

      for (var i = 0; i < this.periods.length; i++) {
         var period = this.periods[i];

         if (period.movingAverages.length >= 12 && period.movingAverages.length >= 26) {
            var ema12 = period.shortAvg
            var ema26 = period.longAvg;

            if (ema12 > ema26) {
               // bullish
               analysis += 1;
            }

            if (ema12 < ema26) {
               // bearish
               analysis -= 1;
            }
         }
      }

      if (analysis == this.periods.length) {
         // Strong indication that the market is bullish
         console.log(this.product_id + ' coin is bullish!');
      }

      if (analysis == -this.period.length) {
         // Strong indication that the market is bearish
         console.log(this.product_id + ' coin is bearish');
      }
   }

   calculate12(period) {
      if (period.movingAverages.length >= 12) {
         var avg = this.expMovingAvg(period.movingAverages, 12)[0];
         period.shortAvg = avg;
         document.getElementById('ema12-' + period.seconds + '-' + period.product_id).innerHTML = avg.toFixed(6);
      }
   }

   calculate26(period) {
      if (period.movingAverages.length >= 26) {
         var avg = this.expMovingAvg(period.movingAverages, 26)[0];
         period.longAvg = avg;
         document.getElementById('ema26-' + period.seconds + '-' + period.product_id).innerHTML = avg.toFixed(6);
      }
   }

   expMovingAvg(mArray, mRange) {
      var averages = [];
      var smoothingFactor = 2 / (1 + mRange);

      for (var i = mRange - 1; i >= 0; i--) {
         var expAvg = 0;

         if (i == 11) {
            expAvg = parseFloat(mArray[i].price);
         } else {
            var previous = averages[0];

            expAvg = previous + (smoothingFactor * (parseFloat(mArray[i].price) - previous));
         }

         averages.unshift(expAvg);
      }

      return averages;
   }
}
