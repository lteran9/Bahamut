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
    @if (isset($coin))
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
            <hr />
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Coinbase</th>
                            <th>Price</th>
                            <th>Size</th>
                            <th>Side</th>
                            <th>Settled</th>
                            <th>Ticket</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order->coinbase_id}}</td>
                            <td>${{number_format($order->price, 2)}}</td>
                            <td>{{$order->size}}</td>
                            <td>{{$order->side}}</td>
                            <td>{{$order->settled}}</td>
                            <td>${{$order->price * $order->size}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                Size: {{$balance}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                Balance: <span data-realtime data-size="{{$balance}}">$</span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <form action="{{ route('exchange.orders') }}" method="post">
                        @csrf

                        @include('shared._form-errors', ['errors' => $errors->buy])

                        <div class="form-group">
                            <label>
                                Buy
                                <input id="amount" name="amount" type="text" class="form-control" placeholder="$" />
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                        </div>

                        <input type="hidden" name="product" value="{{$coin}}" />
                        <input type="hidden" name="side" value="buy" />
                    </form>
                </div>
                <div class="col-12 col-md-6">
                    <form action="{{ route('exchange.orders') }}" method="post">
                        @csrf

                        @include('shared._form-errors', ['errors' => $errors->sell])

                        <div class="form-group">
                            <label>
                                Sell
                                <input id="amount" name="amount" type="text" class="form-control" placeholder="$" />
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-block">Submit</button>
                        </div>

                        <input type="hidden" name="product" value="{{$coin}}" />
                        <input type="hidden" name="side" value="sell" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-info">
        <div class="text-center">Coin not defined.</div>
    </div>
    @endif
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
