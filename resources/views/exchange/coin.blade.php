@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="mb-0">Bahamut</h1>
        </div>
        <div class="col-md-6">
            <span class="float-right d-flex align-items-center"><i data-feather="clock"></i>&nbsp;<span id="clock">0</span></span>
        </div>
    </div>
    <hr />
    <div id="crypto-coin" class="card coin-card">
        <div class="card-body">
            <div class="card-title">
                <h2 id="product">{{$coin}}</h2>
                <div class="mb-2">
                    <span data-id="current-price">$0</span>
                </div>
                <div class="mb-2">
                    <small id="status"></small>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>
                            Buy
                            <input type="text" class="form-control" placeholder="$" />
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-success btn-block">Submit</button>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>
                            Sell
                            <input type="text" class="form-control" placeholder="$" />
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-danger btn-block">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- <script type="text/javascript" src="{{asset('js/ema.js')}}"></script> --}}
<script type="text/javascript" src="{{asset('js/timer.js')}}"></script>
<script type="text/javascript" src="{{asset('js/websocket/feed.js')}}"></script>
<script type="text/javascript" src="{{asset('js/html/page-specific/exchange.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
      if (exchange) {
         exchange.init();
      }
   });
</script>
@endsection
