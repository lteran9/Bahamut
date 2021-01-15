@extends('layouts.app')
@section('content')
<div class="container my-5">
    <h1>Exchange</h1>
    <hr />
    <div class="bhm-exchange">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="{{route('exchange.coin', ['coin' => 'BTC-USD'])}}" class="product-link">
                            <h2 class="text-center">BTC-USD</h2>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="{{route('exchange.coin', ['coin' => 'ETH-USD'])}}" class="product-link">
                            <h2 class="text-center">ETH-USD</h2>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="{{route('exchange.coin', ['coin' => 'LTC-USD'])}}" class="product-link">
                            <h2 class="text-center">LTC-USD</h2>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="{{route('exchange.coin', ['coin' => 'LINK-USD'])}}" class="product-link">
                            <h2 class="text-center">LINK-USD</h2>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="{{route('exchange.coin', ['coin' => 'OMG-USD'])}}" class="product-link">
                            <h2 class="text-center">OMG-USD</h2>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="{{route('exchange.coin', ['coin' => 'GRT-USD'])}}" class="product-link">
                            <h2 class="text-center">GRT-USD</h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
