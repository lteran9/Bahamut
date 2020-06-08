@extends('layouts.app')
@section('content')
<div class="container my-5">
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
            <label for="time-period">Time Period</label>
            <select id="time-period" name="time-period" class="form-control">
               <option value="1">01m</option>
               <option value="5">05m</option>
               <option value="15">15m</option>
               <option value="60">60m</option>
            </select>
         </div>
         <div class="form-group">
            <button type="submit" class="btn btn-block btn-outline-primary">
               Search
            </button>
         </div>
      </fieldset>

      <input type="hidden" id="id" name="id" value="{{$id}}" />
   </form>

   @if (isset($history))
   <div class="container">
      <div class="row">
         <div class="col">
            <h5>Results</h5>
            <hr />

            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th></th>
                        <th>Time</th>
                        <th>Low</th>
                        <th>High</th>
                        <th>Open</th>
                        <th>Close</th>
                        <th>Volume</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($history as $index=>$entry)
                     <tr>
                        <td>{{$index + 1}}</td>
                        <td>{{$entry[0]}}</td>
                        <td>{{$entry[1]}}</td>
                        <td>{{$entry[2]}}</td>
                        <td>{{$entry[3]}}</td>
                        <td>{{$entry[4]}}</td>
                        <td>{{$entry[5]}}</td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   @endif
</div>
@endsection