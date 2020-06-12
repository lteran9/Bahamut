var app = (function () {

   function initAjaxForms() {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

      $('form[data-ajax]').on('submit', function () {
         var url = $(this).attr('action');
         var method = $(this).attr('method');
         var updateTarget = $(this).attr('data-update-target');
         var target = document.getElementById(updateTarget);
         var callback = $(this).attr('data-callback');

         $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function (response) {
               if (target) {
                  target.innerHTML = response;
               } else {
                  console.log('could not find target');
               }

               $('.collapse').collapse();

               if (callback)
                  (new Function('return ' + callback)())();
            },
            error: function () {
               console.log('an error occurred');
            }
         });

         return false;
      });
   }

   return {
      init: function () {
         initAjaxForms();
      }
   }
})();