@extends('layouts.app')
@section('content')
<form action="{{route('products.history.search')}}" method="post">
    @csrf 

    @include('shared._form-errors')

    <fieldset class="history-form">
        <legend>History</legend>
        <div class="form-group">
            <label for="from-date">From Date</label>
            <div class="input-group">
                <input type="date" id="from-date" name="from-date" class="form-control" aria-label="From Date">
                <div class="input-group-append">
                    <label for="from-date" class="m-0">
                        <span class="input-group-text">
                            <i data-feather="calendar"></i>
                        </span>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="to-date">To Date</label>
            <div class="input-group">
                <input type="date" id="to-date" name="to-date" class="form-control" aria-label="From Date">
                <div class="input-group-append">
                    <label for="to-date" class="m-0">
                        <span class="input-group-text">
                            <i data-feather="calendar"></i>
                        </span>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Search
            </button>
        </div>
    </fieldset>

    <input type="hidden" id="id" name="id" value="{{$id}}" />
</form>
@endsection