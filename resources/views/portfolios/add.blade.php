@extends('layouts.app')
@section('content')
<div class="container my-2"
>
    <h1>Portfolio</h1>
    <hr />
    @include('shared._errors')
    <form action="{{route('portfolios.create')}}" method="post" autocomplete="off">
        @csrf

        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="form-group">
                    <label>
                        Coinbase
                        <select id="id" name="id" class="form-control">
                            <option selected disabled>-- Select --</option>
                            @foreach($coinbasePortfolios as $portfolio)
                            <option value="{{$portfolio->id}}" {{old('id') == $portfolio->id ? 'selected' : ''}}>{{$portfolio->name}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label>
                        Passphrase
                        <input type="password" id="passphrase" name="passphrase" class="form-control" value="{{old('passphrase')}}" />
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label>
                        Secret Key
                        <input type="password" id="secret-key" name="secret-key" class="form-control" value="{{old('secret-key')}}" />
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <label>
                        Public Key
                        <input type="text" id="public-key" name="public-key" class="form-control" value="{{old('public-key')}}" />
                    </label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-primary">
            Create
        </button>
    </form>
</div>
@endsection
