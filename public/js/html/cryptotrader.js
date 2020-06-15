/**
 * Handles the coinbase event stream over websocket.
 */
class CyrpoTrader {

   constructor(product) {
      this.product = product;
      this.balance = parseFloat(500);

      this.lastPeriodSeen = '';

      this.periods = [
         {
            seconds: 5,
            history: [
               {
                  volatility: [],
                  volume: [],
                  price: [],
                  adjustment: parseFloat(0.1)  
               }
            ],
            balance: 0
         }
      ];
   }

   /**
    * Starts the feed - connecting to the websocket endpoint and subscribing to the given ticker.
    * @param maxEvents the max number of events to display in the buffer.
    * @param callback called when started.
    */
   analyze(periods) {
      function volatility(periods) {
         // true = bullish, false = bearish
         var analysis = 0;

         for (var i = 0; i < periods.length; i++) {
            var period = periods[i];

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

         if (analysis == periods.length) {
            // Strong indication that the market is bullish
            console.log(period.product_id + ' coin is bullish!');
         }

         if (analysis == -periods.length) {
            // Strong indication that the market is bearish
            console.log(period.product_id + ' coin is bearish');
         }
      }

      volatility(periods);



   }

   purchase() {

   }

   sell() {

   }
}