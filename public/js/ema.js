/**
 * Handles the code necessary to compute the Exponential Moving Average.
 */
class EMA {

   /**
    * 
    * @param {*} product 
    */
   constructor(product) {
      // Time in seconds

      /**
      var i;
      for (i = 0; i < 48; i+=12) {
         this.periods += {
            period: 'p'+str(i),
            seconds: i,
            movingAverages: [],
            shortAvg: 0,
            longAvg: 0,
            product_id: product
         }
      }
      */

      this.periods = [
         {
            period: 'p12',
            seconds: 12,
            movingAverages: [],
            shortAvg: 0,
            longAvg: 0,
            product_id: product
         },
         {
            period: 'p24',
            seconds: 24,
            movingAverages: [],
            shortAvg: 0,
            longAvg: 0,
            product_id: product
         },
         {
            period: 'p36',
            seconds: 36,
            movingAverages: [],
            shortAvg: 0,
            longAvg: 0,
            product_id: product
         },
         {
            period: 'p48',
            seconds: 48,
            movingAverages: [],
            shortAvg: 0,
            longAvg: 0,
            product_id: product
         }
      ]


      

      // Global messages list
      this.messages = [];
   }

   /**
    * 
    * @param {*} dataset 
    */
   update(dataset) {
      this.messages = dataset;

      for (var i = 0; i < this.periods.length; i++) {
         this.getSampleData(dataset, this.periods[i].movingAverages, this.periods[i].seconds);
         this.periods[i].shortAvg = this.calculate12(this.periods[i]);
         this.periods[i].longAvg = this.calculate26(this.periods[i]);
      }

      //this.analyze();
   }

   getPeriods() {
      return this.periods;
   }

   /**
    * 
    * @param {*} dataset 
    * @param {*} movingAverages 
    * @param {*} slicePeriod 
    */
   getSampleData(dataset, movingAverages, slicePeriod) {
      if (movingAverages.length == 0 || (dataset[0].datetime.getTime() - movingAverages[0].datetime.getTime()) / 1000 > slicePeriod) {
         movingAverages.unshift(dataset[0]);
      }

      if (movingAverages.length > 52) {
         movingAverages.pop();
      }
   }

   /**
    * 
    */
   analyze() {
      function volatility(self) {
         // true = bullish, false = bearish
         var analysis = 0;

         for (var i = 0; i < self.periods.length; i++) {
            var period = self.periods[i];

            // UI
            if (period.shortAvg > 0 && period.longAvg > 0) {
               if (period.shortAvg > period.longAvg) {
                  document.getElementById('ema12-' + period.seconds + '-' + period.product_id).className = 'over';
                  document.getElementById('ema26-' + period.seconds + '-' + period.product_id).className = 'under';
               }

               if (period.shortAvg < period.longAvg) {
                  document.getElementById('ema12-' + period.seconds + '-' + period.product_id).className = 'under';
                  document.getElementById('ema26-' + period.seconds + '-' + period.product_id).className = 'over';
               }
            }

            // Volatility
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

         if (analysis == self.periods.length) {
            // Strong indication that the market is bullish
            console.log(self.product_id + ' coin is bullish!');
         }

         if (analysis == -self.periods.length) {
            // Strong indication that the market is bearish
            console.log(self.product_id + ' coin is bearish');
         }
      }

      volatility(this);
   }

   /**
    * 
    * @param {*} period 
    */
   calculate12(period) {
      if (period.movingAverages.length >= 12) {
         var avg = this.expMovingAvg(period.movingAverages, 12)[0];
         period.shortAvg = avg;
         
         // Update UI
         //document.getElementById('ema12-' + period.seconds + '-' + period.product_id).innerHTML = avg.toFixed(6);
         return avg;
      }

      return '-';
   }

   /**
    * 
    * @param {*} period 
    */
   calculate26(period) {
      if (period.movingAverages.length >= 26) {
         var avg = this.expMovingAvg(period.movingAverages, 26)[0];
         period.longAvg = avg;
         
         // Update UI
         //document.getElementById('ema26-' + period.seconds + '-' + period.product_id).innerHTML = avg.toFixed(6);
         return avg;
      }

      return '-';
   }

   /**
    * 
    * @param {*} mArray 
    * @param {*} mRange 
    */
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
