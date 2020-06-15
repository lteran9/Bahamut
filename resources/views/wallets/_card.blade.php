<!-- /views/wallets/_card -->
<div class="card mb-4">
   <div class="card-body text-center">
      @if (isset($wallet))
      <h5>{{$wallet->name}}</h5>
      <ul>
         <li>{{$wallet->balance}}</li>
         <li>
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#wDepositModal_{{$wallet->currency}}">Deposit</button>
         </li>
         <li><a href="#!" class="btn btn-link">Transfer</a></li>
         <li><a href="#!" class="btn btn-link">Withdrawal</a></li>
      </ul>
      @endif
   </div>
</div>

@include('wallets._card-actions')