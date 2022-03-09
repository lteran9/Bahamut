@component('mail::message')

   @if (count($coins) > 0)
      @foreach ($coins as $coin)
         <h1>{{ $coin->id }}</h1>
         @if (isset($coin->stats) && $coin->stats->count() > 0)
            Last 24 hour statistics.

            <dl>
               <dt>Close</dt>
               <dd>${{ number_format($coin->stats['last'], 2) }}</dd>
               <dt>Open</dt>
               <dd>${{ number_format($coin->stats['open'], 2) }}</dd>
               <dt>High</dt>
               <dd>${{ number_format($coin->stats['high'], 2) }}</dd>
               <dt>Low</dt>
               <dd>${{ number_format($coin->stats['low'], 2) }}</dd>
               <dt>Volume</dt>
               <dd>{{ number_format($coin->stats['volume'], 2) }} x ${{ $coin->stats['last'] }} =
                  ${{ number_format($coin->stats['volume'] * $coin->stats['last'], 2) }}</dd>
            </dl>
         @else
            Stats Not Set
         @endif

         @if (isset($coin->history[0]))
            <dl>
               <dt>7 Days Ago</dt>
               <dd>${{ number_format($coin->history[0][4], 2) }}
                  ({{ number_format((1 - $coin->history[0][4] / $coin->stats['last']) * 100, 2) }}%)</dd>
            </dl>
         @endif

         @if (isset($coin->history[1]))
            <dl>
               <dt>28 Days Ago</dt>
               <dd>${{ number_format($coin->history[1][4], 2) }}
                  ({{ number_format((1 - $coin->history[1][4] / $coin->stats['last']) * 100, 2) }}%)</dd>
            </dl>
         @endif

         @if (isset($coin->history[2]))
            <dl>
               <dt>90 Days Ago</dt>
               <dd>${{ number_format($coin->history[2][4], 2) }}
                  ({{ number_format((1 - $coin->history[2][4] / $coin->stats['last']) * 100, 2) }}%)</dd>
            </dl>
         @endif

         <br /><br />
      @endforeach
   @else
      No Coins
   @endif

@endcomponent
