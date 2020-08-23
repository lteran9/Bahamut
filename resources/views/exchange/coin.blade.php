@extends('layouts.app')
@section('content')
<div class="container my-5">
   <div class="row align-items-center">
      <div class="col-md-6">
         <h1 class="mb-0">Bahamut</h1>
      </div>
      <div class="col-md-6">
         <span class="float-right"><i data-feather="clock"></i>&nbsp;<span id="clock">0</span></span>
      </div>
   </div>

   <hr/>

   <div id="crypto-coin" class="card coin-card">
      <div class="card-body">
         <div class="card-title">
            <div class="mb-2">
               <span>BTC-USD</span>
            </div>
            <div class="mb-2">
               <span data-id="current-price">$0</span>
            </div>
         </div>
         <div>
            <div class="card chart-card" style="height:350px;">
               <div class="card-body">
                  <div id="visualizer" style="height:90%; width:100%;"></div>
                  <div>
                     <button class="btn btn-info" onclick="makeHighChart()">High</button>
                     <button class="btn btn-info" onclick="makeLowChart()">Low</button>
                     <button class="btn btn-info" onclick="makeOpeningChart()">Opening</button>
                     <button class="btn btn-info" onclick="makeClosingChart()">Closing</button>
                  </div>
               </div>
            </div>
         </div>
      
         <ul id="averages" class="time-periods">
            <li id="p05" class="period">
               <div class="row">
                  <div class="col-md-6">
                     <div class="title">
                        P(05)
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="balance text-right">
                        <span data-id="balance">$0</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="ema12 text-center">
                        <small class="d-block"><b>EMA12</b></small>
                        <span data-id="ema12">-</span>
                     </div>
                     <div class="progress">
                        <div id="p05-ema12" class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="ema26 text-center">
                        <small class="d-block"><b>EMA26</b></small>
                        <span data-id="ema26">-</span>
                     </div>
                     <div class="progress">
                        <div id="p05-ema26" class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="i-buys text-center">
                        <small class="d-block"><b>Buy Indicators</b></small>
                        <span data-id="buyIndicators">-</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="i-sells text-center">
                        <small class="d-block"><b>Sell Indicators</b></small>
                        <span data-id="sellIndicators">-</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="o-buys text-center">
                        <small class="d-block"><b>Buys</b></small>
                        <span data-id="ourBuys">0</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="o-sells text-center">
                        <small class="d-block"><b>Sells</b></small>
                        <span data-id="ourSells">0</span>
                     </div>
                  </div>
               </div>
            </li>
            <li id="p15" class="period">
               <div class="row">
                  <div class="col-md-6">
                     <div class="title">
                        P(15)
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="balance text-right">
                        <span data-id="balance">$0</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="ema12 text-center">
                        <small class="d-block"><b>EMA12</b></small>
                        <span data-id="ema12">-</span>
                     </div>
                     <div class="progress">
                        <div id="p15-ema12" class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="ema26 text-center">
                        <small class="d-block"><b>EMA26</b></small>
                        <span data-id="ema26">-</span>
                     </div>
                     <div class="progress">
                        <div id="p15-ema26" class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="i-buys text-center">
                        <small class="d-block"><b>Buy Indicators</b></small>
                        <span data-id="buyIndicators">-</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="i-sells text-center">
                        <small class="d-block"><b>Sell Indicators</b></small>
                        <span data-id="sellIndicators">-</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="o-buys text-center">
                        <small class="d-block"><b>Buys</b></small>
                        <span data-id="ourBuys">0</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="o-sells text-center">
                        <small class="d-block"><b>Sells</b></small>
                        <span data-id="ourSells">0</span>
                     </div>
                  </div>
               </div>
            </li>
            <li id="p30" class="period">
               <div class="row">
                  <div class="col-md-6">
                     <div class="title">
                        P(30)
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="balance text-right">
                        <span data-id="balance">$0</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="ema12 text-center">
                        <small class="d-block"><b>EMA12</b></small>
                        <span data-id="ema12">-</span>
                     </div>
                     <div class="progress">
                        <div id="p30-ema12" class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="ema26 text-center">
                        <small class="d-block"><b>EMA26</b></small>
                        <span data-id="ema26">-</span>
                     </div>
                     <div class="progress">
                        <div id="p30-ema26" class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="i-buys text-center">
                        <small class="d-block"><b>Buy Indicators</b></small>
                        <span data-id="buyIndicators">-</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="i-sells text-center">
                        <small class="d-block"><b>Sell Indicators</b></small>
                        <span data-id="sellIndicators">-</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="o-buys text-center">
                        <small class="d-block"><b>Buys</b></small>
                        <span data-id="ourBuys">0</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="o-sells text-center">
                        <small class="d-block"><b>Sells</b></small>
                        <span data-id="ourSells">0</span>
                     </div>
                  </div>
               </div>
            </li>
            <li id="p60" class="period">
               <div class="row">
                  <div class="col-md-6">
                     <div class="title">
                        P(60)
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="balance text-right">
                        <span data-id="balance">$0</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="ema12 text-center">
                        <small class="d-block"><b>EMA12</b></small>
                        <span data-id="ema12">-</span>
                     </div>
                     <div class="progress">
                        <div id="p60-ema12" class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="ema26 text-center">
                        <small class="d-block"><b>EMA26</b></small>
                        <span data-id="ema26">-</span>
                     </div>
                     <div class="progress">
                        <div id="p60-ema26" class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="i-buys text-center">
                        <small class="d-block"><b>Buy Indicators</b></small>
                        <span data-id="buyIndicators">-</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="i-sells text-center">
                        <small class="d-block"><b>Sell Indicators</b></small>
                        <span data-id="sellIndicators">-</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="o-buys text-center">
                        <small class="d-block"><b>Buys</b></small>
                        <span data-id="ourBuys">0</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="o-sells text-center">
                        <small class="d-block"><b>Sells</b></small>
                        <span data-id="ourSells">0</span>
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
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript" src="{{asset('js/ema.js')}}"></script>
<script type="text/javascript" src="{{asset('js/timer.js')}}"></script>
<script type="text/javascript" src="{{asset('js/websocket/feed.js')}}"></script>
<script type="text/javascript" src="{{asset('js/html/elements/coin-view.js')}}"></script>
<script type="text/javascript" src="{{asset('js/html/page-specific/exchange.js')}}"></script>
<script type="text/javascript" src="{{asset('js/visualizer.js')}}"></script>

<script type="text/javascript">
   $(document).ready(function() {
      if (exchange) {
         exchange.init();
      }
   });
</script>
@endsection