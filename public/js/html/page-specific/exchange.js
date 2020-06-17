var exchange = (function () {

   const buffer = 52;

   var websockets = []
   rawTransactions = []
   curatedDataset = [];

   function ajaxSend(data) {
      $.ajax({
         url: '/exchange/tick',
         method: 'post',
         data: data,
         error: function () {
            console.log('error sending data');
         }
      });
   }

   function messageReceived(msg) {
      function filter(update) {
         // decide if the update should be shown or not - we only handler ticker updates.
         update.time = update.time || new Date().toISOString();
         update.last_size = update.last_size || 0.0;

         return update.type === 'ticker' && update.price > 0;
      }

      var ticker = JSON.parse(msg);

      ticker.rawtime = ticker.time;
      ticker.time = new Date(Date.parse(ticker.time));

      //console.log(ticker);
      // Only get data we are intersted in
      if (filter(ticker)) {
         if (curatedDataset.length == 0 || parseInt((ticker.time.getTime() - curatedDataset[0].datetime.getTime()) / 1000) >= 5) {
            var data = {
               trade_id: ticker.trade_id,
               epoch: ticker.rawtime,
               date: ticker.time.getFullYear() + '-' + ticker.time.getMonth() + '-' + ticker.time.getDate(),
               time: ticker.time.getHours() + ':' + ticker.time.getMinutes() + ':' + ticker.time.getMinutes(),
               datetime: ticker.time,
               product_id: ticker.product_id,
               size: ticker.last_size,
               price: ticker.prize,
               side: ticker.side,
               sequence: ticker.sequence
            }

            // Store data
            curatedDataset.unshift(data);
            // Send data
            ajaxSend(data);
         }

         rawTransactions.unshift(ticker);
      }

      if (rawTransactions.length > 52) {
         rawTransactions.pop();
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
   }

   return {
      init: function () {
         initCoinViews();
      }
   }
})();