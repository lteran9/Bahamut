@extends('layouts.app')
@section('content')
<div id="content">
    <h2>Bahamut</h2>

    <feed-view></feed-view>

    <div class="form-group">
        <select class="form-control" id="ticker" onchange="Coinbase.setFeed()">
            <option value="ETH-USD" selected>ETH-USD</option>
            <option value="ETH-EUR">ETH-EUR</option>
            <option value="BTC-USD">BTC-USD</option>
            <option value="BTC-EUR">BTC-EUR</option>
        </select>
    </div>
    <button id="start" class="btn btn-primary" onclick="Coinbase.cast()">CAST</button>
</div>
@endsection
@section('scripts')

<script type="text/javascript" src="{{asset('js/websocket/sender.js')}}"></script>
<script type="text/javascript" src="{{asset('js/websocket/feed.js')}}"></script>
<script type="text/javascript" src="{{asset('js/websocket/receiver.js')}}"></script>
{{-- <script src="https://www.gstatic.com/cv/js/sender/v1/cast_sender.js?loadCastFramework=1"></script> --}}

<script type="text/javascript" src="{{asset('js/coinbase.js')}}"></script>
<script>
    if (Coinbase) {
        //var coinbase = Coinbase.init();
        Coinbase.init();    
    }
</script>
@endsection