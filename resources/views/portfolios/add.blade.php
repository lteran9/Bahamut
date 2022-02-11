@extends('layouts.app')
@section('content')

<div class="container my-2">
    <h1>Portfolio</h1>
    <hr />
    @include('shared._errors')
    <form action="{{route('portfolios.create')}}" method="post" autocomplete="off">
        @csrf

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label>
                        Coinbase Portfolio Name
                        <input type="text" class="form-control" disabled value="{{$coinbasePortfolio->name ?? ''}}" />
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label>
                        Coinbase Portfolio ID
                        <input type="text" class="form-control" disabled value="{{$coinbasePortfolio->id ?? ''}}" />
                    </label>
                </div>
            </div>
        </div>
        <p>First off, please verify that the above values match your Coinbase portfolio exactly.</p>
        <p>Secondly, go into your account's API settings. Create a new API key for your trading portfolio and copy/past the values below.</p>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label>
                        Passphrase
                        <input type="password" id="passphrase" name="passphrase" class="form-control" value="{{old('passphrase')}}" />
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label>
                        Secret Key
                        <input type="password" id="secret-key" name="secret-key" class="form-control" value="{{old('secret-key')}}" />
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label>
                        Public Key
                        <input type="text" id="public-key" name="public-key" class="form-control" value="{{old('public-key')}}" />
                    </label>
                </div>
            </div>
        </div>
        <p>Please note that you have to manually enter this information as a security measure on top of other layers.</p>
        <button type="submit" class="btn btn-primary">
            Create
        </button>
    </form>
</div>

@endsection
