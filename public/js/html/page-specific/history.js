var coinHistory = (function () {

   var shortAverage = {
      display: false,
      dataPoints: [],
      ema: new EMA('BTC-USD')
   }, longAverage = {
      display: false,
      dataPoints: [],
      ema: new EMA('BTC-USD')
   }, jsChart = {}

   function getData() {
      var priceData = document.getElementById('priceHistoryData'),
         dates = {
            start: document.getElementById('from-date'),
            end: document.getElementById('to-date')
         }, data = [];

      if (priceData) {
         var history = JSON.parse(priceData.value);
         console.log(history);
         var start = new Date(dates.start.value);
         var end = new Date(dates.end.value + ' 23:59:59');

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
      function priceChart() {
         var data = getData();

         if (data.length) {
            var labels = [],
               dataPoints = [];

            for (var i = 0; i < data.length; i++) {
               labels.push(data[i].time);
               dataPoints.push({
                  x: new Date(data[i].time),
                  y: data[i].price
               })
            }

            var ctx = document.getElementById('priceHistory').getContext('2d');
            ctx.height = 600;

            jsChart = new Chart(ctx, {
               type: 'line',
               data: {
                  datasets: [{
                     label: 'Price History',
                     data: dataPoints,
                     backgroundColor: 'rgba(255, 99, 132, 0.2)',
                     borderColor: [
                        'rgba(255, 99, 132, 1)',
                     ],
                     borderWidth: 1
                  }]
               },
               options: {
                  scales: {
                     xAxes: [{
                        type: 'time'
                     }],
                     yAxes: [{
                        type: 'linear',
                        ticks: {
                           beginAtZero: false
                        }
                     }]
                  }
               }
            });
         }
      }

      priceChart();
   }

   function init() {
      loadCharts();
   }

   return {
      init: function () {
         init();
      },
      ema12: function () {
         shortAverage.display = true;

         var movingAverages = []

         var priceHistory = JSON.parse(document.getElementById('priceHistoryData').value);

         if (priceHistory.length > 0) {
            for (var i = 0; i < getData().length; i++) {
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

         jsChart.data.datasets.push({
            label: 'EMA12',
            data: movingAverages,
            borderColor: [
               'rgb(124, 252, 0)',
            ],
            borderWidth: 1
         });
         jsChart.update();

         console.log(movingAverages);
      },
      ema26: function () {
         longAverage.display = true;

         var movingAverages = [];
         var priceHistory = JSON.parse(document.getElementById('priceHistoryData').value);

         if (priceHistory.length > 0) {
            for (var i = 0; i < getData().length; i++) {
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

         jsChart.data.datasets.push({
            label: 'EMA26',
            data: movingAverages,
            borderColor: [
               'rgb(233,150,122)',
            ],
            borderWidth: 1
         });
         jsChart.update();

         console.log(movingAverages);
      }
   }

})();