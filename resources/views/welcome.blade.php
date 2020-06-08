@extends('layouts.app')
@section('content')
<div class="flex-center position-ref full-height">
   <div class="content">

      <div class="title m-b-md">
         Bahamut <small class="sub-title">powered by Coinbase</small>
      </div>

      <div class="links">
         <a href="{{route('exchange')}}">Exchange</a>
         <a href="{{route('products')}}">Products</a>
         <a href="#!">History</a>
         <a href="{{route('profiles')}}">Profiles</a>
         <a href="https://github.com/lteran9/Bahamut">GitHub</a>
      </div>

   </div>
</div>
@endsection