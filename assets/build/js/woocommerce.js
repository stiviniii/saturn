/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/wc-components/accordion.js":
/*!*******************************************!*\
  !*** ./src/js/wc-components/accordion.js ***!
  \*******************************************/
/***/ (function() {

"use strict";
//? This code is for animating details
//? of summary component and slightly modified
//? https://css-tricks.com/how-to-animate-the-details-element-using-waapi/
//?



function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var Accordion = /*#__PURE__*/function () {
  // The default constructor for each accordion
  function Accordion(el) {
    var _this = this;
    _classCallCheck(this, Accordion);
    // Store the <details> element
    this.el = el;
    // Store the <summary> element
    this.summary = el.querySelector("summary");
    // Store the <div class="panel"> element
    this.content = el.querySelector(".panel");

    // Store the animation object (so we can cancel it, if needed)
    this.animation = null;
    // Store if the element is closing
    this.isClosing = false;
    // Store if the element is expanding
    this.isExpanding = false;
    // Detect user clicks on the summary element
    this.summary.addEventListener("click", function (e) {
      return _this.onClick(e);
    });
  }

  // Function called when user clicks on the summary
  _createClass(Accordion, [{
    key: "onClick",
    value: function onClick(e) {
      // Stop default behaviour from the browser
      e.preventDefault();
      // Add an overflow on the <details> to avoid content overflowing
      this.el.style.overflow = "hidden";
      // Check if the element is being closed or is already closed
      if (this.isClosing || !this.el.open) {
        this.open();
        // this.expand();
        // Check if the element is being openned or is already open
      } else if (this.isExpanding || this.el.open) {
        this.shrink();
      }
    }

    // Function called to close the content with an animation
  }, {
    key: "shrink",
    value: function shrink() {
      var _this2 = this;
      // Set the element as "being closed"
      this.isClosing = true;

      // Store the current height of the element
      var startHeight = "".concat(this.el.offsetHeight, "px");
      // Calculate the height of the summary
      var endHeight = "".concat(this.summary.offsetHeight, "px");

      // If there is already an animation running
      if (this.animation) {
        // Cancel the current animation
        this.animation.cancel();
      }

      // Start a WAAPI animation
      this.animation = this.el.animate({
        // Set the keyframes from the startHeight to endHeight
        height: [startHeight, endHeight]
      }, {
        // If the duration is too slow or fast, you can change it here
        duration: 400,
        // You can also change the ease of the animation
        easing: "ease-out"
      });

      // When the animation is complete, call onAnimationFinish()
      this.animation.onfinish = function () {
        return _this2.onAnimationFinish(false);
      };
      // If the animation is cancelled, isClosing variable is set to false
      this.animation.oncancel = function () {
        return _this2.isClosing = false;
      };
    }
  }, {
    key: "open",
    value: function open() {
      var _this3 = this;
      // Apply a fixed height on the element
      this.el.style.height = "".concat(this.el.offsetHeight, "px");
      // Force the [open] attribute on the details element
      this.el.open = true;
      // Wait for the next frame to call the expand function
      window.requestAnimationFrame(function () {
        return _this3.expand();
      });
    }

    // Function called to open the element after click
  }, {
    key: "expand",
    value: function expand() {
      var _this4 = this;
      // Set the element as "being expanding"
      this.isExpanding = true;
      // Get the current fixed height of the element
      var startHeight = "".concat(this.el.offsetHeight, "px");
      // Calculate the open height of the element (summary height + content height)
      var endHeight = "".concat(this.summary.offsetHeight + this.content.offsetHeight, "px");

      // If there is already an animation running
      if (this.animation) {
        // Cancel the current animation
        this.animation.cancel();
      }

      // Start a WAAPI animation
      this.animation = this.el.animate({
        // Set the keyframes from the startHeight to endHeight
        height: [startHeight, endHeight]
      }, {
        // If the duration is too slow of fast, you can change it here
        duration: 400,
        // You can also change the ease of the animation
        easing: "ease-out"
      });
      // When the animation is complete, call onAnimationFinish()
      this.animation.onfinish = function () {
        return _this4.onAnimationFinish(true);
      };
      // If the animation is cancelled, isExpanding variable is set to false
      this.animation.oncancel = function () {
        return _this4.isExpanding = false;
      };
    }

    // Callback when the shrink or expand animations are done
  }, {
    key: "onAnimationFinish",
    value: function onAnimationFinish(open) {
      // Set the open attribute based on the parameter
      this.el.open = open;
      // Clear the stored animation
      this.animation = null;
      // Reset isClosing & isExpanding
      this.isClosing = false;
      this.isExpanding = false;
      // Remove the overflow hidden and the fixed height
      this.el.style.height = this.el.style.overflow = "";
    }
  }]);
  return Accordion;
}();
document.querySelectorAll("details.accordion").forEach(function (el) {
  new Accordion(el);
});

/***/ }),

/***/ "./src/js/wc-components/login.js":
/*!***************************************!*\
  !*** ./src/js/wc-components/login.js ***!
  \***************************************/
/***/ (function() {

document.addEventListener("DOMContentLoaded", function () {
  var loginLink = document.querySelector(".back-login-link");
  var signupLink = document.querySelector(".signup-link");
  var loginForm = document.querySelector(".entry-content.account-reg #customer_login .u-column1");
  var registrationForm = document.querySelector(".entry-content.account-reg #customer_login .u-column2");
  function handleLoginLinkClick(e) {
    e.preventDefault();
    var parentContainer = this.parentNode;
    parentContainer.style.display = "none";
    signupLink.parentNode.style.display = "block";
    loginForm.style.display = "block";
    registrationForm.style.display = "none";
  }
  function handleSignupLinkClick(e) {
    e.preventDefault();
    var parentContainer = this.parentNode;
    parentContainer.style.display = "none";
    loginLink.parentNode.style.display = "block";
    // parentContainer.style.display = "none";
    loginForm.style.display = "none";
    registrationForm.style.display = "block";
  }
  if (loginLink && signupLink && loginForm && registrationForm) {
    loginLink.addEventListener("click", handleLoginLinkClick);
    signupLink.addEventListener("click", handleSignupLinkClick);
  }
});
jQuery(document).ready(function ($) {
  // Add the show-password-input span with SVG icons to password fields
  $(".password-input").each(function () {
    $(this).append('<span class="show-password-input-custom">' + '<svg width="16" height="16" aria-hidden="true"><use href="#eye-icon"></use></svg>' + '<svg width="16" height="16" aria-hidden="true" style="display:none;"><use href="#eye-slash-icon"></use></svg>' + "</span>");
  });

  // Toggle password visibility
  $(".show-password-input-custom").on("click", function () {
    var passwordField = $(this).siblings('.woocommerce-Input--password, input[name="password"]');
    // const passwordField = $(this).siblings('input[name="password"]');
    var eyeIcons = $(this).find("svg");
    if (passwordField.prop("type") === "password") {
      passwordField.prop("type", "text");
      eyeIcons.eq(0).hide();
      eyeIcons.eq(1).show();
    } else {
      passwordField.prop("type", "password");
      eyeIcons.eq(1).hide();
      eyeIcons.eq(0).show();
    }
  });
});

/***/ }),

/***/ "./src/js/wc-components/shopfilter.js":
/*!********************************************!*\
  !*** ./src/js/wc-components/shopfilter.js ***!
  \********************************************/
/***/ (function() {

"use strict";


document.addEventListener("DOMContentLoaded", function () {
  var filterToggle = document.getElementById("filterToggle");
  var allShade = document.getElementById("allShade");
  var slideSidebar = document.querySelector(".slide-sidebar");

  // Check if slide-sidebar element exists
  if (slideSidebar) {
    var closeIcon = slideSidebar.querySelector(".close-icon");
    var toggleFilter = function toggleFilter() {
      slideSidebar.classList.toggle("active");
      allShade.classList.toggle("allShade");
      filterToggle.setAttribute("aria-expanded", slideSidebar.classList.contains("active"));
    };
    var handleClickOutside = function handleClickOutside(event) {
      if (!slideSidebar.contains(event.target) && !filterToggle.contains(event.target)) {
        slideSidebar.classList.remove("active");
        allShade.classList.remove("allShade");
        filterToggle.setAttribute("aria-expanded", false);
      }
    };
    filterToggle.addEventListener("click", toggleFilter);
    closeIcon.addEventListener("click", toggleFilter);
    document.addEventListener("click", handleClickOutside);
  }
});

/***/ }),

/***/ "./src/sass/woocommerce.scss":
/*!***********************************!*\
  !*** ./src/sass/woocommerce.scss ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
!function() {
"use strict";
/*!*******************************!*\
  !*** ./src/js/woocommerce.js ***!
  \*******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _js_wc_components_accordion__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../js/wc-components/accordion */ "./src/js/wc-components/accordion.js");
/* harmony import */ var _js_wc_components_accordion__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_js_wc_components_accordion__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _js_wc_components_shopfilter__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../js/wc-components/shopfilter */ "./src/js/wc-components/shopfilter.js");
/* harmony import */ var _js_wc_components_shopfilter__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_js_wc_components_shopfilter__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _js_wc_components_login__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../js/wc-components/login */ "./src/js/wc-components/login.js");
/* harmony import */ var _js_wc_components_login__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_js_wc_components_login__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _sass_woocommerce_scss__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../sass/woocommerce.scss */ "./src/sass/woocommerce.scss");
// JS




// Styles

}();
/******/ })()
;
//# sourceMappingURL=woocommerce.js.map