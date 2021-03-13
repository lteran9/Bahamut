@extends('layouts.app')
@section('content')
<div class="container my-5">
   <h1>
      Portfolios
   </h1>
   <hr />
   <div class="row">
      <div class="col-12">
         <div class="text-right mb-3">
            <a href="{{route('portfolios.add')}}" class="btn btn-link m-0 p-0">
               <i data-feather="plus"></i>
            </a>
         </div>
      </div>
   </div>
   @if (isset($portfolios) && count($portfolios) > 0)
   <div class="container">
      @foreach($portfolios as $portfolio)
      <a href="{{route('portfolios.accounts', ['id' => $portfolio->id])}}" class="card mb-4" style="color:inherit;text-decoration:none;">
         <div class="card-body">
            <div class="row">
               <div class="col-md-6">
                  <h4 class="card-title mb-0">
                     {{$portfolio->name}}
                  </h4>
               </div>
               <div class="col-md-6">
                  <div class="text-right">
                     <i data-feather="check" class="text-success"></i>
                  </div>
               </div>
            </div>

         </div>
      </a>
      @endforeach
   </div>
   @else
   <div class="alert alert-info">
      <div class="text-center">
         No portfolios to display. Please click above to add a portfolio.
      </div>
   </div>
   @endif
   @include('shared._back')
</div>
@endsection
