/**
 * Handles the code necessary to compute the Exponential Moving Average.
 */
class Timer {

   constructor(callback) {
      this.seconds = 0;
      this.active = true;
      this.callback = callback;

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

         this.callback(this.seconds);
      }
   }
}