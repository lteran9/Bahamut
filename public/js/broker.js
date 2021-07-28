/**
 * @author lteran9
 */
class Broker {

    /**
     * @param {*}
     */
    constructor(coins) {
        this.availableCoins = coins;
    }

    loadData(data) {
        if (data.length > 1) {
            // Create root
            this.chart = new Candlestick(data[0]);
            var copy = this.chart;
            for (var i = 1; i < data.length; i++) {
                // Create candlestick
                copy.next = new Candlestick(data, copy);
                // Move forward
                copy = copy.next;
            }
        }
        debugger;
    }

    /**
     * An engulfing pattern on the bullish side of the market takes place when buyers outpace sellers. This
     * is reflected in the chart by a long green real body engulfing a small red real body. With bulls having
     * established some control, the price could head higher.
     *
     * @returns
     */
    hasBullishEngulfingPattern() {
        if (this.data !== null && this.data.length > 0) {
            for (var i = 0; i < this.data.length; i++) {

            }
            return true;
        }

        return false;
    }
}
