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

      this.ema = new EMA(product);
      this.timer = new Timer(product);
      
      this.secondsElapsed = 0;
      this.updateCallback = updateCallback;
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
         this.updateCallback(e.data);
         //this.onUpdate(e.data);
      };

      this.socket.onclose = (e) => {
         this.status("closed");
         if (this.onStopped) {
            this.onStopped();
         }
      };

      //document.getElementById('version').innerHTML = version;
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

         this.ema.update(this.events);

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

   /**
    * Filters the message received; do not count messages that do not have a market size or 
    * valid date time.
    * 
    * @param update JSON object 
    */
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
      // document.getElementById('status').innerHTML = `
      //    <span class="status">
      //          status:
      //    </span>
      //    <span class="${text}">
      //          ${text}
      //    </span>
      // `;
   }
}