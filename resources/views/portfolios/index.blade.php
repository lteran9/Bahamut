@extends('layouts.app')
@section('content')
<div class="container my-5">
   <h1>Portfolio</h1>
   <hr />
   @if (isset($portfolio))
   <div class="container">
      <h2>{{$portfolio->name}}</h2>
      <div class="my-3">
         <div class="row">
            @foreach($wallets as $wallet)
            <div class="col-4">
               @include('wallets._card')
            </div>
            @endforeach
         </div>
      </div>
   </div>
   @else
   <div class="alert alert-warning">
      <div class="text-center">
         Portfolio Not Found
      </div>
   </div>
   @endif
</div>
@endsection