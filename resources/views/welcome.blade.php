@extends('layouts.app')
@section('content')
<div class="title m-b-md">
    Bahamut <small style="font-size:15%;display:block;margin-top:-15px;">powered by Coinbase</small>
</div>

<div class="links">
    <a href="#!">History</a>
    <a href="{{route('products')}}">Products</a>
    <a href="{{route('profiles')}}">Profiles</a>
    <a href="https://github.com/lteran9/Bahamut">GitHub</a>
</div>
@endsection