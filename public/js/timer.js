/**
 * Handles the code necessary to compute the Exponential Moving Average.
 */
class Timer {

   constructor(product) {
      this.seconds = 0;
      this.active = true;
      this.product = product;

      this.start();
   }

   start() {
      setInterval(function (_self) {
         _self.tick();
      }, 1000, this);
   }

   /**
    * Increments the time period elapsed by 1.
    */
   tick() {
      if (this.active) {
         this.seconds += 1;
      }

      // document.getElementById('time-elapsed-' + this.product).innerHTML = '<abbr title="Time Periods Elapsed">' + parseInt(this.seconds) + '</abbr>';
      // document.getElementById('time-period-5-' + this.product).innerHTML = parseInt(this.seconds / 5);
      // document.getElementById('time-period-15-' + this.product).innerHTML = parseInt(this.seconds / 15);
      // document.getElementById('time-period-30-' + this.product).innerHTML = parseInt(this.seconds / 30);
      // document.getElementById('time-period-60-' + this.product).innerHTML = parseInt(this.seconds / 60);
   }
}