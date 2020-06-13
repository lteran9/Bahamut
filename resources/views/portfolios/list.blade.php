@extends('layouts.app')
@section('content')
<div class="container my-5">
   <h1>
      Portfolios
   </h1>
   <hr />
   <div class="row">
      <div class="col-12">
         <div class="text-right">
            <a href="{{route('portfolios.add')}}" class="btn btn-link">
               <i data-feather="plus"></i>
            </a>
         </div>
      </div>
   </div>
   @if (isset($portfolios) && count($portfolios) > 0)
   <div class="container">
      @foreach($portfolios as $portfolio)
      <a href="{{route('portfolios.find', ['id' => $portfolio->id])}}" class="card mb-4" style="color:inherit;text-decoration:none;">
         <div class="card-body">
            <h4 class="card-title">
               {{$portfolio->name}}
            </h4>
            <dl class="text-left">
               <dt>Id</dt>
               <dd>{{$portfolio->id}}</dd>
               <dt>Created at</dt>
               <dd>{{$portfolio->coinbase_created_at}}</dd>
            </dl>
         </div>
      </a>
      @endforeach
   </div>
   @else
   <div class="alert alert-info">
      <div class="text-center">
         No portfolios to display.
      </div>
   </div>
   @endif
   @include('shared._back')
</div>
@endsection