var coinbase = (function () {
   // start the websocket feed.
   const buffer = 52;

   // handle multiple websockets
   var websockets = [];

   function feedStart() {
      if (websockets.length > 0) {
         websockets.forEach(function (item, index) {
            item.feed.start(buffer, () => {
               item.feed.subscribe();
            });
         });
      }
   }

   return {
      init: function () {
         $('feed-view').each(function () {
            var product = $(this).attr('data-product-id');

            // Initialize feed
            var feed = new Feed(product);
            websockets.push({
               feed: feed
            });
         });

         feedStart();
      }
   }
})();