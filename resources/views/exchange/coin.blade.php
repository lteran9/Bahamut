@extends('layouts.app')
@section('content')
<div class="container my-5">
   <h2>Bahamut</h2>
   <hr />
   <div class="card coin-card">
      <div class="card-body">
         <div class="card-title">
            <div class="mb-4">
               <span>BTC-USD</span>
               <span class="float-right"><i data-feather="clock"></i>&nbsp;0</span>
            </div>
         </div>
         <ul class="time-periods">
            <li class="period">
               <div class="row">
                  <div class="col-6">
                     <div class="">
                        P(05)
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-right">
                        <span id="p05-balance">$500</span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <small class="d-block"><b>EMA12</b></small>
                        <span id="p05-ema12">-</span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <small class="d-block"><b>EMA26</b></small>
                        <span id="p05-ema26">-</span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <small class="d-block"><b>Buy Indicators</b></small>
                        <span id="buyIndicators">-</span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <small class="d-block"><b>Sell Indicators</b></small>
                        <span id="sellIndicators">-</span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <small class="d-block"><b>Buys</b></small>
                        <span id="ourBuys">0</span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <small class="d-block"><b>Sells</b></small>
                        <span id="ourSells">0</span>
                     </div>
                  </div>
               </div>
            </li>
            <li class="period">
               <div class="row">
                  <div class="col-6">
                     <div class="">
                        P(15)
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-right">
                        <span id="balance">$500</span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="ema12"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="ema26"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="buyIndicators"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="sellIndicators"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="ourBuyds"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="ourSells"></span>
                     </div>
                  </div>
               </div>
            </li>
            <li class="period">
               <div class="row">
                  <div class="col-6">
                     <div class="">
                        P(30)
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-right">
                        <span id="balance">$500</span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="ema12"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="ema26"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="buyIndicators"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="sellIndicators"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="ourBuyds"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="ourSells"></span>
                     </div>
                  </div>
               </div>
            </li>
            <li class="period">
               <div class="row">
                  <div class="col-6">
                     <div class="">
                        P(60)
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-right">
                        <span id="balance">$500</span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="ema12"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="ema26"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="buyIndicators"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="sellIndicators"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="ourBuyds"></span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="text-center">
                        <span id="ourSells"></span>
                     </div>
                  </div>
               </div>
            </li>
         </ul>
      </div>
   </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{asset('js/ema.js')}}"></script>
<script type="text/javascript" src="{{asset('js/timer.js')}}"></script>
<script type="text/javascript" src="{{asset('js/websocket/feed.js')}}"></script>
<script type="text/javascript" src="{{asset('js/html/elements/coin-view.js')}}"></script>
<script type="text/javascript" src="{{asset('js/html/page-specific/exchange.js')}}"></script>
<script type="text/javascript">
   $(document).ready(function() {
      if (exchange) {
         exchange.init();
      }
   });
</script>
@endsection