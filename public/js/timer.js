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
        setInterval(function(_self) {
            _self.tick();
        }, 1000, this);
    }

    /**
     * Increments the seconds elapsed by 1.
     */
    tick() {
        if (this.active) {
            this.seconds += 1;
        }

        //console.log(this.product);
        document.getElementById('time-elapsed-' + this.product).innerHTML = parseInt(this.seconds / 7);
    }
}