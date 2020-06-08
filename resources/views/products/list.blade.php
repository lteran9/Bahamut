@extends('layouts.app')
@section('content')
<div class="container my-5">
   <h1>Products</h1>
   <hr>

   @if (isset($products) && count($products) > 0)
   <div class="container bhm-container">
      @foreach($products as $product)
      <div class="card mb-4">
         <div class="card-body">
            <h4 class="card-title">
               {{$product->display_name}}
            </h4>
            <div class="row">
               <div class="col-12">
                  <ul class="bhm-list">
                     <li>
                        <a href="{{route('products.history', ['id' => $product->id])}}">
                           Trade History
                        </a>
                     </li>
                     <li>
                        <a href="#!">
                           Order Book
                        </a>
                     </li>
                     <li>
                        <a href="#!">
                           Ticker
                        </a>
                     </li>
                     <li>
                        <a href="{{route('products.stats', ['id' => $product->id])}}">
                           24hr Stats
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      @endforeach
      <div class="row">
         <div class="col-12">
            <div class="text-right">
               Count: <b>{{count($products)}}</b>
            </div>
         </div>
      </div>
   </div>
   @else
   <div class="card">
      <div class="card-body text-center">
         No products to display.
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