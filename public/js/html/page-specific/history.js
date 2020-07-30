var coinHistory = (function () {

   var shortAverage = {
      display: false,
      dataPoints: [],
      ema: new EMA('BTC-USD')
   }, longAverage = {
      display: false,
      dataPoints: [],
      ema: new EMA('BTC-USD')
   }, lineChart = {}, candlestickChart = {};

   function getData() {
      var priceData = document.getElementById('priceHistoryData'),
         dates = {
            start: document.getElementById('from-date'),
            end: document.getElementById('to-date')
         }, data = [];

      if (priceData) {
         var history = JSON.parse(priceData.value);

         var start = new Date(dates.start.value);
         var end = new Date(dates.start.value + ' 23:59:59');

         for (var i = 0; i < history.length; i++) {
            var priceDate = new Date(history[i].time);

            if (priceDate >= start && priceDate <= end) {
               data.push(history[i]);
            }
         }
      }

      return data;
   }

   function getCandlestickData() {
      var priceData = document.getElementById('candles'),
         dates = {
            start: document.getElementById('from-date')
         }, data = [];

      if (priceData) {
         var history = JSON.parse(priceData.value);

         var start = new Date(dates.start.value);
         var end = new Date(dates.start.value + ' 23:59:59');

         for (var i = 0; i < history.length; i++) {
            var priceDate = new Date(history[i].time);

            if (priceDate >= start && priceDate <= end) {
               data.push(history[i]);
            }
         }
      }

      return data;
   }

   function loadCharts() {
      function line() {
         var data = getData();

         if (data.length) {
            var dataPoints = [];

            for (var i = 0; i < data.length; i++) {
               dataPoints.push({
                  x: new Date(data[i].time),
                  y: data[i].price
               });
            }

            lineChart = new CanvasJS.Chart('lineChart', {
               title: {
                  text: 'Line Chart'
               },
               axisX: {
                  valueFormatString: 'h tt',
                  interval: 1,
                  intervalType: 'hour'
               },
               axisY2: {
                  prefix: '$',
                  suffix: 'K',
                  includeZero: false
               },
               toolTip: {
                  shared: true,
                  content: '{x}<br/>{y}'
               },
               legend: {
                  cursor: 'pointer',
                  verticalAlign: 'top',
                  horizontalAlign: 'center',
                  dockInsidePlotArea: true
               },
               data: [
                  {
                     type: 'line',
                     axisYType: 'secondary',
                     name: 'Price History',
                     showInLegend: true,
                     markerSize: 0,
                     xValueFormatString: 'hh:mm tt',
                     yValueFormatString: '$#,###.##',
                     dataPoints: dataPoints
                  }
               ]
            });
            lineChart.render();
         }
      }

      function candlestick() {
         var data = getCandlestickData();

         if (data.length) {
            var dataPoints = [];

            for (var i = 0; i < data.length; i++) {
               dataPoints.push({
                  x: new Date(data[i].time),
                  y: [
                     data[i].open,
                     data[i].high,
                     data[i].low,
                     data[i].close
                  ]
               })
            }

            candlestickChart = new CanvasJS.Chart('candlestickChart', {
               title: {
                  text: 'Candlestick Chart'
               },
               axisX: {
                  valueFormatString: 'h tt',
                  interval: 1,
                  intervalType: 'hour'
               },
               axisY2: {
                  includeZero: false,
                  prefix: "$",
                  title: "Price"
               },
               toolTip: {
                  content: "Date: {x}<br /><strong>Open:</strong> {y[0]}, <strong>Close:</strong> {y[3]}<br /><strong>High:</strong> {y[1]}, <strong>Low:</strong> {y[2]}"
               },
               data: [{
                  type: 'candlestick',
                  axisYType: 'secondary',
                  dataPoints: dataPoints,
                  markerSize: 0,
                  xValueFormatString: 'hh:mm tt',
                  yValueFormatString: '$#,###.##',
               }]
            });
            candlestickChart.render();
         }
      }

      line();
      candlestick();
   }

   function init() {
      loadCharts();
   }

   return {
      init: function () {
         init();
      },
      ema12: function () {
         if (shortAverage.display == false) {
            shortAverage.display = true;

            var movingAverages = []

            var priceHistory = JSON.parse(document.getElementById('priceHistoryData').value);

            if (priceHistory.length > 0) {
               for (var i = 0; i < priceHistory.length; i++) {
                  var dataset = [];

                  // Get dataset
                  for (var j = i; j < (i + 12); j++) {
                     dataset.push({ price: priceHistory[j].price });
                  }

                  // Apply formula
                  var avg = shortAverage.ema.calculate12({
                     movingAverages: dataset
                  });

                  // Save answer
                  movingAverages.push({
                     x: new Date(priceHistory[i].time),
                     y: avg
                  });
               }
            }

            lineChart.data.datasets.push({
               label: 'EMA12',
               data: movingAverages,
               borderColor: [
                  'rgb(124, 252, 0)',
               ],
               borderWidth: 1
            });
            lineChart.update();

            //console.log(movingAverages);
         }
      },
      ema26: function () {
         if (longAverage.display == false) {
            longAverage.display = true;

            var movingAverages = [];
            var priceHistory = JSON.parse(document.getElementById('priceHistoryData').value);

            if (priceHistory.length > 0) {
               for (var i = 0; i < priceHistory.length; i++) {
                  var dataset = [];

                  // Get dataset
                  for (var j = i; j < (i + 26); j++) {
                     dataset.push({ price: priceHistory[j].price });
                  }

                  // Apply formula
                  var avg = shortAverage.ema.calculate26({
                     movingAverages: dataset
                  });

                  // Save answer
                  movingAverages.push({
                     x: new Date(priceHistory[i].time),
                     y: avg
                  });
               }
            }

            lineChart.data.datasets.push({
               label: 'EMA26',
               data: movingAverages,
               borderColor: [
                  'rgb(233,150,122)',
               ],
               borderWidth: 1
            });
            lineChart.update();

            //console.log(movingAverages);
         }
      }
   }

})();