@extends('layouts.app')
@section('content')
<div id="luis" style="width:100%;height:100px;background-color:blue;"></div>
<div id="jorge" style="width:100%;height:100px;background-color:red;"></div>
<div id="diego" style="width:100%;height:100px;background-color:green;"></div>
@endsection

@section('js')
<script type="text/javascript">
   window.onload = function() {
      var luis = document.getElementById('luis');
      luis.style.backgroundColor = "black";

      $('#jorge').css('background-color', 'yellow');
   }
</script>
@endsection