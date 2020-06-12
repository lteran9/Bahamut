/**
 * Custom element to simplify base page.
 */
class AjaxForm extends HTMLElement {
   connectedCallback() {
      var action = this.getAttribute('action');
      var updateTarget = this.getAttribute('update-target');
      var userDefined = this.innerHTML;

      this.innerHTML = `
         <form action="${action}" method="post" data-ajax data-update-target="${updateTarget}">
            ${userDefined}
         </form>    
      `;
   }
}

window.customElements.define('ajax-form', AjaxForm);