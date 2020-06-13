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
               <div class="card mb-4">
                  <div class="card-body text-center">
                     <h5>{{$wallet->name}}</h5>
                     <ul>
                        <li>{{$wallet->balance}}</li>
                        <li><a href="#!" class="btn btn-link">Deposit</a></li>
                        <li><a href="#!" class="btn btn-link">Transfer</a></li>
                        <li><a href="#!" class="btn btn-link">Withdrawal</a></li>
                     </ul>
                  </div>
               </div>
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