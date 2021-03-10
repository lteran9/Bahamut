var exchange = (function () {

    const buffer = 52;

    var websockets = [],
        rawTransactions = [],
        curatedDataset = [];

    var elements = {
        container: document.getElementById('crypto-coin'),
        averages: document.getElementById('averages'),
        clock: document.getElementById('clock'),
        progressBars: [
            {
                id: 'p05-ema12',
                progress: 0
            },
            {
                id: 'p05-ema26',
                progress: 0
            },
            {
                id: 'p15-ema12',
                progress: 0
            },
            {
                id: 'p15-ema26',
                progress: 0
            },
            {
                id: 'p30-ema12',
                progress: 0
            },
            {
                id: 'p30-ema26',
                progress: 0
            },
            {
                id: 'p60-ema12',
                progress: 0
            },
            {
                id: 'p60-ema26',
                progress: 0
            }
        ]
    }

    function updateUI(periods) {
        function updateEMAs(shortAvg, longAvg, container) {
            var shortElement = $(container).find('[data-id="ema12"]'),
                longElement = $(container).find('[data-id="ema26"]'),
                buyIndicators = $(container).find('[data-id="buyIndicators"]')[0],
                sellIndicators = $(container).find('[data-id="sellIndicators"]')[0];

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

        function updateProgressBars(period, container) {
            if (period.movingAverages.length <= 12) {
                var progressBar = $(container).find('#' + period.period + '-ema12');
                if (progressBar) {
                    var width = (period.movingAverages.length / 12) * 100;
                    $(progressBar).css('width', width + '%');
                }
            } else {
                $(container).find('#' + period.period + '-ema12').parent().remove();
            }

            if (period.movingAverages.length <= 26) {
                var progressBar = $(container).find('#' + period.period + '-ema26');
                if (progressBar) {
                    var width = (period.movingAverages.length / 26) * 100;
                    $(progressBar).css('width', width + '%');
                }
            } else {
                $(container).find('#' + period.period + '-ema26').parent().remove();
            }
        }

        for (var i = 0; i < periods.length; i++) {
            var shortAvg = periods[i].shortAvg,
                longAvg = periods[i].longAvg;

            var container = $(elements.averages).find('#' + periods[i].period);
            if (container) {
                updateEMAs(shortAvg, longAvg, container);
                updateProgressBars(periods[i], container);
            }
        }
    }

    function updatePrice(price) {
        // Update Main Element
        var element = $(elements.container).find('[data-id="current-price"]');
        if (element) {
            $(element).html('$' + price);
        }

        // Update Totals
        var balance = document.querySelector('[data-realtime]');
        if (balance) {
            var size = balance.getAttribute('data-size');
            balance.innerHTML = '$' + (price * size).toFixed(2);
        }
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
            //ajaxSend(data);

            if (curatedDataset.length == 0 || parseInt((ticker.time.getTime() - curatedDataset[0].datetime.getTime()) / 1000) >= 5) {
                // Store data
                curatedDataset.unshift(data);

                // this.ema.update(curatedDataset);
                // updateUI(this.ema.getPeriods());
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
                    item.feed.start(buffer);
                });
            }
        }

        // Add websocket to elements
        var product = document.getElementById('product');
        if (product) {
            websockets.push({
                feed: new Feed(product.innerText, messageReceived)
            });

            feedStart();

            // this.ema = new EMA(product);
            this.clock = new Timer(updateTimer);
        }
    }

    return {
        init: function () {
            initCoinViews();
        }
    }
})();
