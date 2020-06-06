@extends('layouts.app')
@section('content')
<h2>Bahamut</h2>
<div id="status"></div>
<div id="version"></div>

<div class="row">
    <div class="col-md-6 mb-4">
        <feed-view data-product-id="ETH-USD"></feed-view>   
    </div>
    <div class="col-md-6 mb-4">
        <feed-view data-product-id="BTC-USD"></feed-view>   
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-4">
        <feed-view data-product-id="XRP-USD"></feed-view>   
    </div>
    <div class="col-md-6 mb-4">
        <feed-view data-product-id="XLM-USD"></feed-view>   
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-4">
        <feed-view data-product-id="LTC-USD"></feed-view>   
    </div>
</div>
@endsection
@section('scripts')

<script type="text/javascript" src="{{asset('js/html/elements/feed-view.js')}}"></script>
<script type="text/javascript" src="{{asset('js/websocket/feed.js')}}"></script>
<script type="text/javascript" src="{{asset('js/ema.js')}}"></script>
<script type="text/javascript" src="{{asset('js/timer.js')}}"></script>
<script type="text/javascript" src="{{asset('js/coinbase.js')}}"></script>
<script>
    if (coinbase) {
        coinbase.init();    
    }
</script>
@endsection