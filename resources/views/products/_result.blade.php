@if (isset($history))
   <div class="accordion coin-history" id="accordionHistory">
      <div class="accordion-item">
         @include('products._line-chart')
      </div>
      <div class="accordion-item">
         @include('products._candlestick-chart')
      </div>
      <div class="accordion-item">
         @include('products._raw-data')
      </div>
   </div>
@endif

@if (isset($closingPrices))
   <input type="hidden" id="priceHistoryData" value="{{ json_encode($closingPrices) }}" />
@endif

@if (isset($candles))
   <input type="hidden" id="candles" value="{{ json_encode($candles) }}" />
@endif
