/**
 * @author lteran9
 */
class Candlestick {

    /**
     *
     * @param {*}
     */
    constructor(data, parent = null) {
        this.high = data.high;
        this.open = data.open;
        this.low = data.low;
        this.close = data.close;

        // this.next is being set by object that calls this constructor
        this.parent = parent;
    }

    side() {
        if (this.open > this.close) {
            return 'red';
        }

        if (this.open < this.close) {
            return 'green';
        }

        return 'same';
    }

    /**
     * The term swing high is used in technical analysis. It refers to a peak reached by an indicator or a
     * security’s price before a decline. A swing high forms when the high reached is greater than a given
     * number of highs positioned around it. A series of consecutively higher swing highs indicates that the
     * given security is in an uptrend.
     *
     * @param {*} prev
     * @param {*} next
     */
    isSwingHigh(prev, next) {
        if (prev != null && next != null) {
            //
        }
    }

    /**
     * Swing low is a term used in technical analysis that refers to the troughs reached by a security’s price
     * or an indicator during a given period of time, usually less than 20 trading periods. A swing low is
     * created when a low is lower than any other surrounding prices in a given period of time.
     *
     * @param {*} prev
     * @param {*} next
     */
    isSwingLow(prev, next) {
        //
    }
}
