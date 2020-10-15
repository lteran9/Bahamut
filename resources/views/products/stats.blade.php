@extends('layouts.app')
@section('content')
<div class="container my-5">
    <h1>{{$product ?? 'n/a'}}</h1>
    <hr />
    <div class="card">
        <div class="card-body">
            <h2>24 Hours Stats</h2>
            @if (isset($stats))
            <div class="row">
                <div class="col">
                    <dl>
                        <dt>Open</dt>
                        <dd>${{number_format($stats["open"], 2)}}</dd>
                        <dt>High</dt>
                        <dd>${{number_format($stats["high"], 2)}}</dd>
                        <dt>Low</dt>
                        <dd>${{number_format($stats["low"], 2)}}</dd>
                        <dt>Last</dt>
                        <dd>${{number_format($stats["last"], 2)}}</dd>
                        <dt>Volume</dt>
                        <dd>{{number_format($stats["volume"], 6)}} x ${{$stats["last"]}} = ${{number_format($stats["volume"]*$stats["last"], 2)}}</dd>
                        <dt>Volume 30 Day</dt>
                        <dd>{{number_format($stats["volume_30day"], 6)}} x ${{$stats["last"]}} = ${{number_format($stats["volume_30day"]*$stats["last"], 2)}}</dd>
                    </dl>
                </div>
            </div>
            @else
            <div class="alert alert-warning">
                <div class="text-center">
                    <div>
                        <i data-feather="alert-triangle"></i>
                    </div>
                    <div>
                        There are no stats to display.
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>


    <div class="row">
        <div class="col">
            @include('shared._back')
        </div>
    </div>
</div>
@endsection
