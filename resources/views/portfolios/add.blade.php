@extends('layouts.app')
@section('content')
<div class="container my-5">
   <h1>Portfolio</h1>
   <hr />
   @include('shared._errors')
   <form action="{{route('portfolios.create')}}" method="post" autocomplete="off">
      @csrf

      <div class="form-group">
         <label>
            Coinbase
            <select id="id" name="id" class="form-control">
               <option selected disabled>-- Select --</option>
               @foreach($portfolios as $portfolio)
               <option value="{{$portfolio->id}}" {{old('id') == $portfolio->id ? 'selected' : ''}}>{{$portfolio->name}}</option>
               @endforeach
            </select>
         </label>
      </div>
      <div class="form-group">
         <label>
            Secret Key
            <input type="password" id="secret-key" name="secret-key" class="form-control" value="{{old('secret-key')}}" />
         </label>
      </div>
      <div class="form-group">
         <label>
            Public Key
            <input type="text" id="public-key" name="public-key" class="form-control" value="{{old('public-key')}}" />
         </label>
      </div>
      <div class="form-group">
         <label>
            Passphrase
            <input type="text" id="passphrase" name="passphrase" class="form-control" value="{{old('passphrase')}}" />
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