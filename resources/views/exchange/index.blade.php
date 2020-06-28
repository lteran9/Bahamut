@extends('layouts.app')
@section('content')
<div class="container my-5">
   <h1>Exchange</h1>
   <hr />
   <div class="bhm-exchange">
      <div class="row">
         <div class="col-md-4">
            <div class="card">
               <div class="card-body">
                  <a href="{{route('exchange.coin', ['coin' => 'BTC-USD'])}}" class="product-link">
                     <h2 class="text-center">BTC-USD</h2>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection