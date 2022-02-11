@extends('layouts.app')
@section('content')
<div class="container my-2">
    <h1>{{$portfolio->name}}</h1>
    <h2>Accounts</h2>
    <hr />
    @if (isset($accounts))
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Currency</th>
                    <th>Available</th>
                    <th>Balance</th>
                    <th>Hold</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accounts as $account)
                <tr>
                    <td>{{$account->currency}}</td>
                    <td>{{$account->available}}</td>
                    <td>{{$account->balance}}</td>
                    <td>{{$account->hold}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
