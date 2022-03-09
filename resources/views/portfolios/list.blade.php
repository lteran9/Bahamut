@extends('layouts.app')
@section('content')
   <div class="container my-2">
      <h1>Portfolios</h1>
      <p>In this page you can manage your trading accounts. Each portfolio should be linked to a specific trading strategy to make the most out
         of the state machine.</p>
      <p>Note that Bahamut is a read-only system when it comes to Coinbase. We attempt to keep local copies of keys and important information
         to reduce the number of API calls. If you would like to create a new trading profile you must first initiate the process on their
         website and then create a corresponding extension in Bahamut. This procedural step helps reinforce the idea that this system is only
         an enhancement and not a replacement.</p>
      <hr />
      <h2>Coinbase Profiles</h2>
      @if (isset($coinbasePortfolios) && count($coinbasePortfolios) > 0)
         <div class="row">
            @foreach ($coinbasePortfolios as $portfolio)
               <div class="col-12 col-md-6">
                  @if ($portfolios->contains($portfolio->id))
                     <div class="card mb-4">
                        <div class="card-body">
                           <h4 class="card-title">
                              {{ $portfolio->name }}
                           </h4>
                        </div>
                     </div>
                  @else
                     <a href="{{ route('portfolios.add', ['id' => $portfolio->id]) }}" class="card mb-4"
                        style="color:inherit;text-decoration:none;">
                        <div class="card-body">
                           <div class="row g-0 justify-content-between">
                              <div class="col">
                                 <h4 class="card-title">
                                    {{ $portfolio->name }}
                                 </h4>
                              </div>
                              <div class="col">
                                 <div class="text-end">
                                    ADD
                                 </div>
                              </div>
                           </div>
                        </div>
                     </a>
                  @endif
               </div>
            @endforeach
         </div>
      @endif
      <h2>Bahamut Extension Profiles</h2>
      @if (isset($portfolios) && count($portfolios) > 0)
         <div class="row">
            @foreach ($portfolios as $portfolio)
               <div class="col-12 col-md-6">
                  <a href="{{ route('portfolios.accounts', ['id' => $portfolio->id]) }}" class="card mb-4"
                     style="color:inherit;text-decoration:none;">
                     <div class="card-body">
                        <h4 class="card-title">
                           {{ $portfolio->name }}
                        </h4>
                     </div>
                  </a>
               </div>
            @endforeach
         </div>
      @else
         <div class="alert alert-info">
            <div class="text-center">
               No portfolios to display. Please click above to add a portfolio.
            </div>
         </div>
      @endif
   </div>
@endsection
