@extends('layouts.app')
@section('content')
<div class="container my-5">
   <h1>Portfolio</h1>
   <hr />
   <div class="alert alert-dark">
      <div class="display-6">Add</div>
   </div>
   <form action="{{route('portfolios.create')}}" method="post" autocomplete="off">
      @csrf

      <div class="form-group">
         <label>
            ID
            <input type="text" class="form-control" />
         </label>
      </div>
      <div class="form-group">
         <button type="submit" class="btn btn-sm btn-primary">
            Create
         </button>
      </div>
   </form>
</div>
@endsection