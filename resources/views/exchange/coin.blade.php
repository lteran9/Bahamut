@extends('layouts.app')
@section('content')
<div class="container my-5">
   <h2>Bahamut</h2>
   <hr />
   <div class="card coin-card">
      <div class="card-body">
         <div class="card-title">
            <span>BTC-USD</span>
            <span class="float-right"><i data-feather="clock"></i>&nbsp;0</span>
         </div>
      </div>
      <ul class="">
         <li class="">
            <div class="card">
               <div class="card-body"></div>
            </div>
         </li>
         <li class="">
            <div class="card">
               <div class="card-body"></div>
            </div>
         </li>
         <li class="">
            <div class="card">
               <div class="card-body"></div>
            </div>
         </li>
         <li class="">
            <div class="card">
               <div class="card-body"></div>
            </div>
         </li>
      </ul>
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