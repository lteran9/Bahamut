/**
 * Custom element to simplify base page.
 */
class FeedElement extends HTMLElement {
    connectedCallback() {
        let product = this.getAttribute('data-product-id');

        var emas = `
            <div class="row">
                <div class="col-6">
                    <div id="ema12-${product}"></div>
                </div>
                <div class="col-6">
                    <div id="ema26-${product}"></div>
                </div>
            </div>
        `;

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

        this.innerHTML = `
            <div class="feed-header">
                <div class="product-key">${product}</div>
                ${timeElapsed}
            </div>
            <div id="overview">
                <div id="price-${product}"></div>
                <div id="volume-${product}"></div>
                ${emas}
                ${trades}
            </div>
            <div id="items-${product}" style="position:absolute;width:100%;top:75px"></div>`;
    }
}

window.customElements.define('feed-view', FeedElement);