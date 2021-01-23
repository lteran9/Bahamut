const version = "v1.0.0";

/**
 * Handles the coinbase event stream over websocket.
 */
class Feed {

    constructor(product, updateCallback) {
        this.product_id = product;
        this.events = [];
        this.buys = 0;
        this.sells = 0;

        // if (EMA) {
        //     this.ema = new EMA(product);
        // }

        this.secondsElapsed = 0;
        this.updateCallback = updateCallback;
    }

    /**
     * Starts the feed - connecting to the websocket endpoint and subscribing to the given ticker.
     * @param maxEvents the max number of events to display in the buffer.
     * @param callback called when started.
     */
    start(maxEvents) {
        this.maxEvents = maxEvents || 16;

        this.status('connecting');
        this.socket = new WebSocket("wss://ws-feed.pro.coinbase.com/");

        this.socket.onopen = (e) => {
            this.status('connected');
            this.subscribe();
        };

        this.socket.onmessage = (e) => {
            this.updateCallback(e.data);
        };

        this.socket.onclose = (e) => {
            this.status('closed');
            if (this.onStopped) {
                this.onStopped();
            }
        };
    }

    /**
     * Subscribes to the given trading pair. Unsubscribes to any pairs already subscribed to.
     *
     */
    subscribe() {
        if (this.product_id) {
            let subscribe = {
                "type": "subscribe",
                "product_ids": [
                    this.product_id
                ],
                "channels": [
                    "heartbeat",
                    {
                        "name": "ticker",
                        "product_ids": [
                            this.product_id
                        ]
                    }
                ]
            };

            this.socket.send(JSON.stringify(subscribe));
        }
    }

    /**
     * Stops the feed - closing the websocket.
     * @param stopped callback invoked when the socket is closed.
     * The close operation is asynchronous - we don't really need to wait for the old socket to close first.
     * This is just so the status messages will be shown in the correct order.
     */
    stop(stopped) {
        if (this.socket) {
            this.onStopped = stopped;
            this.socket.close();
        } else {
            stopped();
        }
    }

    /**
     * Updates the status element.
     * @param text representing the current status.
     */
    status(text) {
        document.getElementById('status').innerHTML = `
           <span class="status">
                 status:
           </span>
           <span class="${text}">
                 ${text}
           </span>
        `;
    }
}
