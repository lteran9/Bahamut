@extends('layouts.app')
@section('content')
   <div class="container my-2">
      <h1>{{ $product }}</h1>
      <hr />
      <div class="card">
         <div class="card-body">
            <div class="row">
               <div class="col">
                  <h3 class="text-center">Bids</h3>
                  <table class="table table-hover table-responsive">
                     <thead>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Orders</th>
                     </thead>
                     <tbody>
                        @foreach (array_reverse($orders['bids']) as $bid)
                           <tr>
                              <td>${{ number_format($bid[0], 2) }}</td>
                              <td>{{ $bid[1] }}</td>
                              <td>{{ $bid[2] }}</td>
                           </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                           <td colspan="3" class="text-right">
                              Rows {{ count($orders['bids']) }}
                           </td>
                        </tr>
                     </tfoot>
                  </table>
               </div>
               <div class="col">
                  <h3 class="text-center">Asks</h3>
                  <table class="table table-hover table-responsive">
                     <thead>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Orders</th>
                     </thead>
                     <tbody>
                        @foreach ($orders['asks'] as $ask)
                           <tr>
                              <td>${{ number_format($ask[0], 2) }}</td>
                              <td>{{ $ask[1] }}</td>
                              <td>{{ $ask[2] }}</td>
                           </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                           <td colspan="3" class="text-right">
                              Rows {{ count($orders['asks']) }}
                           </td>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
