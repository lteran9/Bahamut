@extends('layouts.app')
@section('content')
<div class="container my-5">
   <h1>
      Profiles
   </h1>
   <hr />
   @include('shared._back')

   @if (isset($profiles) && count($profiles) > 0)
   <div class="container">
      @foreach($profiles as $profile)
      <a href="#!" class="card mb-4" style="color:inherit;text-decoration:none;">
         <div class="card-body">
            <h4 class="card-title">
               {{$profile->name}}
            </h4>
            <dl class="text-left">
               <dt>Id</dt>
               <dd>{{$profile->id}}</dd>
               <dt>Created at</dt>
               <dd>{{$profile->coinbase_created_at}}</dd>
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
</div>
@endif
@endsection