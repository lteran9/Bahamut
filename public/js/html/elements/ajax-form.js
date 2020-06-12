/**
 * Custom element to simplify base page.
 */
class AjaxForm extends HTMLElement {
   connectedCallback() {
      var action = this.getAttribute('action');
      var updateTarget = this.getAttribute('update-target');
      var onCompleteTarget = this.getAttribute('oncomplete');
      var userDefined = this.innerHTML;

      this.innerHTML = `
         <form action="${action}" method="post" data-ajax data-update-target="${updateTarget}" data-callback="${onCompleteTarget}">
            ${userDefined}
         </form>    
      `;
   }
}

window.customElements.define('ajax-form', AjaxForm);