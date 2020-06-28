<?php

namespace App\Model;

class Candlestick {

   function __construct($high, $low, $open, $close)
   {
      $this->high = $high;
      $this->low = $low;
      $this->open = $open;
      $this->close = $close;

      $this->up = $open > $close;
      $this->down = $open <= $close;
   }

}
