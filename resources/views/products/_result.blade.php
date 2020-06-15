@if (isset($history))
<div class="accordion coin-history" id="accordionHistory">
   <div class="card">
      @include('products._chart')
   </div>
   <div class="card">
      <div class="card-header">
         <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
               Results
            </button>
         </h5>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionHistory">
         <div class="card-body">
            <div class="row">
               <div class="col">
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
                              <td>{{date('m/d/Y H:i:s', $entry[0])}}</td>
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
      </div>
   </div>
</div>

@endif