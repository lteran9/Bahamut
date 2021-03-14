@extends('layouts.app')
@section('content')
<div class="container my-2"
>
    <h1>
        Exchange

        <span class="float-right">
            <a href="{{ route('exchange') }}" class="btn btn-sm btn-primary">
                @include('shared.svg.refresh', ['width' => 16, 'height' => 16])
            </a>
        </span>
    </h1>
    <hr />
    <div class="bhm-exchange">
        @if (isset($favorites))
        <div class="row">

            @foreach($favorites as $coin)
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('exchange.coin', ['coin' => $coin->id])}}" class="product-link">
                            <h2>{{$coin->id}}</h2>
                            <dl class="coin-stats">
                                <dt>Latest Price</dt>
                                <dd>${{number_format($coin->price, 2)}}</dd>
                                <dt>Holding Size</dt>
                                <dd>{{$coin->size}}</dd>
                                <dt>Total (USD)</dt>
                                <dd>${{number_format($coin->price * $coin->size, 2)}}</dd>
                            </dl>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="alert alert-info">
            <div class="text-center">No products to display.</div>
        </div>
        @endif
    </div>
</div>
@endsection
