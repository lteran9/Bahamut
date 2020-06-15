<div class="card-header">
   <h5 class="mb-0">
      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         Charts
      </button>
   </h5>
</div>
<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionHistory">
   <div class="card-body history-graph">
      <div class="row">
         <div class="col-12">
            <div class="btn-group-toggle" data-toggle="buttons">
               <label class="btn btn-secondary">
                  <input type="checkbox" onchange="window.coinHistory.ema12();"> EMA 12
               </label>
               <label class="btn btn-secondary">
                  <input type="checkbox" onchange="window.coinHistory.ema26();"> EMA 26
               </label>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <canvas id="priceHistory"></canvas>

            <input type="hidden" id="priceHistoryData" name="" value="{{json_encode($closingPrices)}}" />
         </div>
      </div>
   </div>
</div>