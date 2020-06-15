<form action="{{route('wallets.deposit')}}" method="post">
   @csrf

   <div class="form-group">
      <div class="input-group">
         <input type="number" id="amount" name="amount" class="form-control" required />
         <div class="input-group-append">
            <span class="input-group-text">USD</span>
         </div>
      </div>
   </div>
   <div class="corm-group">
      <button type="submit" class="btn btn-sm btn-primary">
         Deposit
      </button>
   </div>

   <input type="hidden" id="id" name="id" value="{{$wallet->wallet_id}}" />
   <input type="hidden" id="portfolio-id" name="portfolio-id" value="{{$portfolio->id}}" />
</form>