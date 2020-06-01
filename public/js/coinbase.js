var Coinbase = (function() {
    // start the websocket feed.
    const buffer = 12;
    
    var websocket = {
        feed: null,
        receiver: null,
        sender: null
    };

    function feedStart() {
        let ticker = document.getElementById('ticker');
        websocket.feed.start(buffer, () => {
            websocket.feed.subscribe(ticker.value);
        });
    }

    function setFeed() {
        let ticker = document.getElementById('ticker');
        websocket.feed.subscribe(ticker.value);
        websocket.sender.onFeedChanged(ticker.value);
    }

    function cast() {
        let ticker = document.getElementById('ticker');
        websocket.sender.cast(ticker.value);
    }

    return {
        init: function() {
            websocket.feed = new Feed();
            websocket.receiver = new Receiver();
            websocket.sender = new Sender();

            feedStart();
        }, 
        feedStart: function() {
           feedStart();
        }, 
        setFeed: function() {
           setFeed();
        },
        cast: function() {
           cast();
        }
    }
})();