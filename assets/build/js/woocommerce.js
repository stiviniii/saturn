!function(){var e={667:function(){document.querySelectorAll("summary.accordion-summary").forEach((function(e){e.addEventListener("click",(function(){var e=this.nextElementSibling,t="true"===this.getAttribute("aria-expanded");e.setAttribute("aria-hidden",t),this.setAttribute("aria-expanded",!t)}))}))},801:function(){document.addEventListener("DOMContentLoaded",(function(){var e=document.getElementById("filterToggle"),t=document.getElementById("allShade"),n=document.querySelector(".slide-sidebar");if(n){var r=n.querySelector(".close-icon"),i=function(){n.classList.toggle("active"),t.classList.toggle("allShade"),e.setAttribute("aria-expanded",n.classList.contains("active"))};e.addEventListener("click",i),r.addEventListener("click",i),document.addEventListener("click",(function(r){n.contains(r.target)||e.contains(r.target)||(n.classList.remove("active"),t.classList.remove("allShade"),e.setAttribute("aria-expanded",!1))}))}}))}},t={};function n(r){var i=t[r];if(void 0!==i)return i.exports;var a=t[r]={exports:{}};return e[r](a,a.exports,n),a.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var r in t)n.o(t,r)&&!n.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){"use strict";n(667),n(801)}()}();
//# sourceMappingURL=woocommerce.js.map