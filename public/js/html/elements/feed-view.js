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
                  <b>P(12sec):</b>
                  <span id="time-period-12-${product}"></span>
               </div>
               <div class="col-4">
                  <div id="ema12-12-${product}"></div>
               </div>
                <div class="col-4">
                  <div id="ema26-12-${product}"></div>
               </div>
            </div>
            <div class="row">
               <div class="col-4 text-left">
                  <b>P(24sec):</b>
                  <span id="time-period-24-${product}"></span>
               </div>
               <div class="col-4">
                  <div id="ema12-24-${product}"></div>
               </div>
                <div class="col-4">
                  <div id="ema26-24-${product}"></div>
               </div>
            </div>
            <div class="row">
              <div class="col-4 text-left">
                  <b>P(36sec):</b>
                  <span id="time-period-36-${product}"></span>
               </div>
               <div class="col-4">
                  <div id="ema12-36-${product}"></div>
               </div>
                <div class="col-4">
                  <div id="ema26-36-${product}"></div>
               </div>
            </div>
            <div class="row">
               <div class="col-4 text-left">
                  <b>P(48sec):</b>
                  <span id="time-period-48-${product}"></span>
               </div>
               <div class="col-4">
                  <div id="ema12-48-${product}"></div>
               </div>
                <div class="col-4">
                  <div id="ema26-48-${product}"></div>
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