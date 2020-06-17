/**
 * Custom element to simplify crypto currency analysis.
 */
class CoinView extends HTMLElement {
   connectedCallback() {
      this.coin = this.getAttribute('coin-id');

      this.innerHTML = `
         <div class="card coin-card">
            <div class="card-body">
               <div class="cart-title">
                  <div class="coin-name">
                     <span id="coinName">${this.coin}</span>
                     <span id="timeSlice">0</span>
                  </div>
               </div>
               <ul class="time-periods">
                  <li class="period">
                     <div id="alpha"></div>
                  </li>
                  <li class="period">
                     <div id="beta"></div>
                  </li>
                  <li class="period">
                     <div id="gamma"></div>
                  </li>
                  <li class="period">
                     <div id="delta"></div>
                  </li>
               </ul>
            </div>
         </div>
      `;
   }

   getAnalysis(slice) {
      return `
         <div class="card">
            <div class="card-body">
               <ul class="">
                  <li id=""></li>
                  <li id=""></li>
                  <li id=""></li>
                  <li id=""></li>
                  <li id=""></li>
                  <li id=""></li>
               </ul>
            </div>
         </div>
      `;
   }
}

window.customElements.define('coin-view', CoinView);