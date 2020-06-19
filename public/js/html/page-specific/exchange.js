var exchange = (function () {

   const buffer = 52;

   var websockets = []
      rawTransactions = []
      curatedDataset = [];

   var elements = {
      container: document.getElementById('crypto-coin'),
      averages: document.getElementById('averages'),
      clock: document.getElementById('clock')
   }

   function updateUI(periods) {
      for (var i = 0; i < periods.length; i++) {
         var shortAvg = periods[i].shortAvg,
            longAvg = periods[i].longAvg;

         var container = $(elements.averages).find('#' + periods[i].period);
         if (container) {
            var shortElement = $(container).find('[data-id="ema12"]'),
               longElement = $(container).find('[data-id="ema26"]');
            if (shortAvg != '-') {
               $(shortElement).html(shortAvg.toFixed(4));
               if (shortAvg > longAvg) {
                  $(shortElement).addClass('on');
               } else {
                  if ($(shortElement).hasClass('on'))
                     $(shortElement).removeClass('on');
               }
            }

            if (longAvg != '-') {
               $(longElement).html(longAvg.toFixed(4));
               if (shortAvg < longAvg) {
                  $(longElement).addClass('on');
               } else {
                  if ($(longElement).hasClass('on'))
                     $(longElement).removeClass('on');
               }
            }
         }
      }
   }

   function updatePrice(price) {
      var element = $(elements.container).find('[data-id="current-price"]');
      if (element)
         $(element).html('$' + price);
   }

   function updateTimer(seconds) {
      $(elements.clock).html(seconds);
   }

   function messageReceived(msg) {
      function filter(update) {
         // decide if the update should be shown or not - we only handler ticker updates.
         update.time = update.time || new Date().toISOString();
         update.last_size = update.last_size || 0.0;

         return update.type === 'ticker' && update.price > 0;
      }

      function ajaxSend(data) {
         $.ajax({
            url: '/exchange/tick',
            method: 'post',
            data: data,
            error: function () {
               console.log('error sending data');
            },
            complete: function () {
               //console.log('message sent');
            }
         });
      }

      var ticker = JSON.parse(msg);

      ticker.rawtime = ticker.time;
      ticker.time = new Date(Date.parse(ticker.time));

      //console.log(ticker);
      // Only get data we are intersted in
      if (filter(ticker)) {
         var data = {
            trade_id: ticker.trade_id,
            epoch: ticker.rawtime,
            datetime: ticker.time,
            product_id: ticker.product_id,
            size: ticker.last_size,
            price: ticker.price,
            side: ticker.side,
            sequence: ticker.sequence
         }

         // Send data
         ajaxSend(data);

         if (curatedDataset.length == 0 || parseInt((ticker.time.getTime() - curatedDataset[0].datetime.getTime()) / 1000) >= 5) {
            // Store data
            curatedDataset.unshift(data);

            this.ema.update(curatedDataset);
            updateUI(this.ema.getPeriods());
         }

         updatePrice(ticker.price);
         rawTransactions.unshift(ticker);
      }

      if (rawTransactions.length > 52) {
         rawTransactions.pop();
      }

      if (curatedDataset.length > 52) {
         curatedDataset.pop();
      }
   }

   function initCoinViews() {
      function feedStart() {
         if (websockets.length > 0) {
            websockets.forEach(function (item, index) {
               item.feed.start(buffer, () => {
                  item.feed.subscribe();
               });
            });
         }
      }

      // Add websocket to elements
      var product = 'BTC-USD';

      websockets.push({
         feed: new Feed(product, messageReceived)
      });

      feedStart();

      this.ema = new EMA(product);
      this.clock = new Timer(updateTimer);
   }

   return {
      init: function () {
         initCoinViews();
      }
   }
})();