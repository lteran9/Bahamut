<!-- /views/wallets/_card-actions -->

{{-- DEPOSIT --}}
<div class="modal fade" id="wDepositModal_{{$wallet->currency}}" tabindex="-1" role="dialog" aria-labelledby="wDepositModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="wDepositModalLabel">
               Add Funds - {{$wallet->currency}}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            @include('wallets.actions._deposit')
         </div>
      </div>
   </div>
</div>

{{-- TRANSFER --}}
<div class="modal fade" id="wTransferModal_{{$wallet->currency}}" tabindex="-1" role="dialog" aria-labelledby="wTransferModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="wTransferModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            Body
         </div>
      </div>
   </div>
</div>

{{-- WITHDRAW --}}
<div class="modal fade" id="wWithdrawModal_{{$wallet->currency}}" tabindex="-1" role="dialog" aria-labelledby="wWithdrawModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="wWithdrawModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            Body
         </div>
      </div>
   </div>
</div>