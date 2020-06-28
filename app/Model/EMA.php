<?php 

class EMA {

   function __construct($shortAvgLength = 12, $longAvgLength = 26)
   {
      $this->shortAvgLength = $shortAvgLength;
      $this->longAvgLength = $longAvgLength;
   }

   /// Expects most recent price point at position 0
   public function calcShortAverage($data) {
      if (isset($data) && count($data) > $this->shortAvgLength) {

      }

      throw new Exception("Not enough data provided.");
   }

   /// Expects most recent price point at position 0
   public function calcLongAverage($data) {
      if (isset($data) && count($data) > $this->longAvgLength) {

      }

      throw new Exception("Not enough data provided");
   }
}