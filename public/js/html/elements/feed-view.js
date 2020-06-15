/**
 * Custom element to simplify base page.
 */
class FeedElement extends HTMLElement {
   connectedCallback() {
      let product = this.getAttribute('data-product-id');

      var trades = `
         <div class="row">
               <div class="col-6">
                  <div id="buys-${product}"></div>
               </div>
               <div class="col-6">
                  <div id="sells-${product}"></div>
               </div>
         </div>
      `;

      var timeElapsed = `
            <i data-feather="clock" class="timer"></i>&nbsp;<small id="time-elapsed-${product}"></small>
        `;

      var timePeriods = `
         <div class="p-3">
            <div class="row">
               <div class="col-4 text-left">
                  <b>P(05sec):</b>
                  <span id="time-period-5-${product}"></span>
               </div>
               <div class="col-4">
                  <div id="ema12-5-${product}"></div>
               </div>
                <div class="col-4">
                  <div id="ema26-5-${product}"></div>
               </div>
            </div>
            <div class="row">
               <div class="col-4 text-left">
                  <b>P(15sec):</b>
                  <span id="time-period-15-${product}"></span>
               </div>
               <div class="col-4">
                  <div id="ema12-15-${product}"></div>
               </div>
                <div class="col-4">
                  <div id="ema26-15-${product}"></div>
               </div>
            </div>
            <div class="row">
              <div class="col-4 text-left">
                  <b>P(30sec):</b>
                  <span id="time-period-30-${product}"></span>
               </div>
               <div class="col-4">
                  <div id="ema12-30-${product}"></div>
               </div>
                <div class="col-4">
                  <div id="ema26-30-${product}"></div>
               </div>
            </div>
            <div class="row">
               <div class="col-4 text-left">
                  <b>P(60sec):</b>
                  <span id="time-period-60-${product}"></span>
               </div>
               <div class="col-4">
                  <div id="ema12-60-${product}"></div>
               </div>
                <div class="col-4">
                  <div id="ema26-60-${product}"></div>
               </div>
            </div>
         </div>
      `;

      this.innerHTML = `
         <div class="feed-header">
               <div class="product-key">${product}</div>
               ${timeElapsed}
         </div>
         <div id="overview">
               <div id="price-${product}"></div>
               <div id="volume-${product}"></div>
               ${trades}
               ${timePeriods}
         </div>
         <div id="items-${product}" style="position:absolute;width:100%;top:75px"></div>
      `;
   }
}

window.customElements.define('feed-view', FeedElement);