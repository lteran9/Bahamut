var products = (function() {

   function autoSearch() {
      var elements = {
         search: document.getElementById('search'),
         cards: document.querySelectorAll('[data-filter]')
      }

      if (elements.cards.length) {
         $(elements.search).on('input', function() {
            var keywords = $(this).val();

            if (keywords.length > 0) {
               $(elements.cards).each(function () {
                  var cardValue = $(this).attr('data-filter').toLowerCase();

                  if (cardValue.indexOf(keywords) >= 0) {
                     $(this).removeClass('d-none');
                  } else {
                     $(this).addClass('d-none');
                  }
               });
            } else {
               $(elements.cards).each(function() {
                  $(this).removeClass('d-none');
               });
            }
           
         });
      }
   }

   return {
      init: function() {
         autoSearch();
      }
   }
})();