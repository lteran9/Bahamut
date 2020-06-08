@extends('layouts.app')
@section('content')
<div class="container my-5">
   <h1>24 Hour Stats - {{$product ?? 'n/a'}}</h1>
   <hr />

   @if (isset($stats))
   <div class="row">
      <div class="col">
         <dl>
            <dt>Open</dt>
            <dd>{{$stats["open"]}}</dd>
            <dt>High</dt>
            <dd>{{$stats["high"]}}</dd>
            <dt>Low</dt>
            <dd>{{$stats["low"]}}</dd>
            <dt>Volume</dt>
            <dd>{{$stats["volume"]}}</dd>
            <dt>Last</dt>
            <dd>{{$stats["last"]}}</dd>
            <dt>Volume 30 Day</dt>
            <dd>{{$stats["volume_30day"]}}</dd>
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

   <div class="row">
      <div class="col">
         @include('shared._back')
      </div>
   </div>
</div>
@endsection

<script type="text/javascript">
   window.onload = function() {
      setTimeout(function() {
         window.location.reload(true);
      }, 15000)
   }
</script>