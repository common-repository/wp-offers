/*!
 * WP Offers v1.2.0 - https://www.kitthemes.com/wp-offers
 * KitThemes - https://www.kitthemes.com/
 * (c) 2020 - 2022 KitThemes
 * GPLv2 or later
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/frontend/scss/style.scss":
/*!**************************************!*\
  !*** ./src/frontend/scss/style.scss ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

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
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!******************************!*\
  !*** ./src/frontend/main.js ***!
  \******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _scss_style_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./scss/style.scss */ "./src/frontend/scss/style.scss");

var clipboard = new ClipboardJS('.wpo-clipboard');
clipboard.on('success', function (e) {
  var text = e.trigger.innerText;
  e.trigger.innerText = 'Copied!'; // @todo: Need to translate.

  setTimeout(function () {
    e.trigger.innerText = text;
  }, 800);
  e.clearSelection();
});
var printBtns = document.querySelectorAll('.wpo-print');

var onPrint = function onPrint(e) {
  e.preventDefault();
  var win = window.open('');
  var url = e.target.dataset.url;
  win.stop();
  win.document.write("<img style=\"max-width:100%\" src=".concat(url, " onload=\"window.print();window.close()\" />"));
};

printBtns.forEach(function (printBtn) {
  printBtn.addEventListener('click', onPrint);
});
tippy('[data-tippy-content]');
})();

/******/ })()
;
//# sourceMappingURL=wp-offers-frontend.js.map