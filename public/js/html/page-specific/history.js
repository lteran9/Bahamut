var coinHistory = (function () {

   function loadCharts() {
      function priceChart() {
         var data = document.getElementById('priceHistoryData');

         if (data) {
            var labels = [],
               dataPoints = [];

            data = JSON.parse(data.value);

            for (var i = 0; i < data.length; i++) {
               labels.push(data[i].time);
               dataPoints.push({
                  x: new Date(data[i].time),
                  y: data[i].price
               });
            }

            console.log(dataPoints);

            var ctx = document.getElementById('priceHistory').getContext('2d');
            ctx.height = 600;
            new Chart(ctx, {
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

   return {
      init: function () {
         loadCharts();
      }
   }
})();