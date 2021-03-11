@extends('layouts.app')
@section('content')
<div class="container my-5">
    <h1>{{$id ?? 'N/A'}}</h1>
    <hr />
    <div class="card">
        <div class="card-body">
            <ajax-form action="{{route('products.history.search')}}" update-target="historyContainer" oncomplete="coinHistory.init">
                @csrf

                @include('shared._form-errors')


                <h2>History</h2>
                <div class="form-group">
                    <label for="from-date">From Date</label>
                    <div class="input-group">
                        <input type="date" id="from-date" name="from-date" class="form-control" aria-label="From Date" value="{{$fromdate ?? old('from-date')}}" max="{{date('Y-m-d')}}" />
                        <div class="input-group-append">
                            <label for="from-date" class="m-0">
                                <span class="input-group-text">
                                    <i data-feather="calendar"></i>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="display:none;">
                    <label for="time-period">Time Period</label>
                    <select id="time-period" name="time-period" class="form-control">
                        <option value="1">01m</option>
                        <option value="5">05m</option>
                        <option value="15">15m</option>
                        <option value="60" selected>60m</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">
                        Search
                    </button>
                </div>

                <input type="hidden" id="id" name="id" value="{{$id}}" />
            </ajax-form>
            <div id="historyContainer">
                @include('products._result')
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{asset('js/ema.js')}}"></script>
<script type="text/javascript" src="{{asset('js/html/page-specific/history.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
      if (coinHistory)
         coinHistory.init();
   });
</script>
@endsection
