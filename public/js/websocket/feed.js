const version = "v1.0.0";

/**
 * Handles the coinbase event stream over websocket.
 */
class Feed {

   constructor(product) {
      this.product_id = product;
      this.events = [];
      this.buys = 0;
      this.sells = 0;

      this.ema_5_period = new EMA();
      this.ema_15_period = new EMA();
      this.ema_30_period = new EMA();
      this.ema_60_period = new EMA();

      this.timer = new Timer(product);
      this.secondsElapsed = 0;
      this.pause = false;
   }

   /**
    * Starts the feed - connecting to the websocket endpoint and subscribing to the given ticker.
    * @param maxEvents the max number of events to display in the buffer.
    * @param callback called when started.
    */
   start(maxEvents, callback) {
      this.maxEvents = maxEvents || 16;

      this.status('connecting');
      this.socket = new WebSocket("wss://ws-feed.pro.coinbase.com/");

      this.socket.onopen = (e) => {
         this.status('connected');
         callback();
      };

      this.socket.onmessage = (e) => {
         this.onUpdate(e.data);
      };

      this.socket.onclose = (e) => {
         this.status("closed");
         if (this.onStopped) {
            this.onStopped();
         }
      };

      document.getElementById('version').innerHTML = version;


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

         console.log('sending subscribe request for pair ' + this.product_id);

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
         this.pause = true;
         this.onStopped = stopped;
         this.socket.close();
      } else {
         stopped();
      }
   }

   /**
    * Handles an update event from the websocket API.
    * @param msg the update message from Coinbase.
    */
   onUpdate(msg) {
      let messages = document.getElementById('items-' + this.product_id);
      let update = JSON.parse(msg);

      if (this.filter(update)) {
         update.rawtime = update.time;
         update.time = new Date(Date.parse(update.time));
         this.events.unshift(update);

         if (this.events.length > this.maxEvents) {
            this.events.pop();
         }

         let element = document.createElement('div');
         element.className = 'item';

         // render the element using a template literal.
         element.innerHTML = `
                    <span class="rawtime">${update.trade_id}</span>
                    <span class="date">${update.time.toLocaleDateString()}</span>
                    <span class="time">${update.time.toLocaleTimeString()}</span>
                    <span class="size">${this.truncate(update.last_size)}</span>
                    <span>@</span>
                    <span class="${update.side === 'buy' ? 'up' : 'down'}">$${parseFloat(update.price).toFixed(2)}</span>
                    <span class="total">$${parseFloat(update.last_size * update.price).toFixed(2)}</span>
                `;

         // perform DOM manipulation with insertBefore and removeChild - it's fast.
         messages.insertBefore(element, messages.firstChild);

         if (messages.childNodes.length > this.maxEvents) {
            messages.removeChild(messages.lastChild);
         }

         document.getElementById('price-' + update.product_id).innerHTML = '$' + update.price;
         document.getElementById('volume-' + update.product_id).innerHTML = Math.round(update.volume_24h);

         var ema12_5 = this.ema_5_period.calculate12(this.events, 5);
         var ema26_5 = this.ema_5_period.calculate26(this.events, 5);

         if (ema12_5)
            document.getElementById('ema12-5-' + update.product_id).innerHTML = ema12_5.toFixed(6);
         if (ema26_5)
            document.getElementById('ema26-5-' + update.product_id).innerHTML = ema26_5.toFixed(6);

         var ema12_15 = this.ema_15_period.calculate12(this.events, 15);
         var ema26_15 = this.ema_15_period.calculate26(this.events, 15);

         if (ema12_15)
            document.getElementById('ema12-15-' + update.product_id).innerHTML = ema12_15.toFixed(6);
         if (ema26_15)
            document.getElementById('ema26-15-' + update.product_id).innerHTML = ema26_15.toFixed(6);

         var ema12_30 = this.ema_30_period.calculate12(this.events, 30);
         var ema26_30 = this.ema_30_period.calculate26(this.events, 30);

         if (ema12_30)
            document.getElementById('ema12-30-' + update.product_id).innerHTML = ema12_30.toFixed(6);
         if (ema26_30)
            document.getElementById('ema26-30-' + update.product_id).innerHTML = ema26_30.toFixed(6);

         var ema12_60 = this.ema_60_period.calculate12(this.events, 60);
         var ema26_60 = this.ema_60_period.calculate26(this.events, 60);

         if (ema12_60)
            document.getElementById('ema12-60-' + update.product_id).innerHTML = ema12_60.toFixed(6);
         if (ema26_60)
            document.getElementById('ema26-60-' + update.product_id).innerHTML = ema26_60.toFixed(6);

         if (update.side === 'buy') {
            this.buys += 1;
            document.getElementById('buys-' + update.product_id).innerHTML = 'Buys: ' + this.buys;
         } else {
            this.sells += 1;
            document.getElementById('sells-' + update.product_id).innerHTML = 'Sells: ' + this.sells;
         }
      }
   }

   truncate(size) {
      return (size + "").substring(0, 7);
   }

   filter(update) {
      // decide if the update should be shown or not - we only handler ticker updates.
      update.time = update.time || new Date().toISOString();
      update.last_size = update.last_size || 0.0;

      return update.type === 'ticker' && update.price > 0;
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
            </span>`;
   }
}