/*!
 * WP Offers v1.2.0 - https://www.kitthemes.com/wp-offers
 * KitThemes - https://www.kitthemes.com/
 * (c) 2020 - 2022 KitThemes
 * GPLv2 or later
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/core/classes/templateManager.js":
/*!*********************************************!*\
  !*** ./src/core/classes/templateManager.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var TemplateManager = /*#__PURE__*/function () {
  function TemplateManager() {
    _classCallCheck(this, TemplateManager);

    _defineProperty(this, "templates", {});
  }

  _createClass(TemplateManager, [{
    key: "add",
    value: function add(id, comp) {
      this.templates[id] = comp;
    }
  }, {
    key: "remove",
    value: function remove(id) {
      delete this.templates[id];
    }
  }, {
    key: "get",
    value: function get(id) {
      return this.templates[id];
    }
  }]);

  return TemplateManager;
}();

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (TemplateManager);

/***/ }),

/***/ "./src/core/components/preloader/index.tsx":
/*!*************************************************!*\
  !*** ./src/core/components/preloader/index.tsx ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./style.scss */ "./src/core/components/preloader/style.scss");



var Preloader = function Preloader() {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "wpo-preloader"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    width: "127.999",
    height: "64",
    viewBox: "0 0 127.999 64"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("path", {
    d: "M128,64H39.878a11.2,11.2,0,0,0-17.157,0H0V0H22.773A11.192,11.192,0,0,0,31.3,3.938,11.189,11.189,0,0,0,39.826,0H128V64ZM29.759,52.08v3.2h2.56v-3.2Zm0-6v3.2h2.56v-3.2Zm59.28-13.44a6.08,6.08,0,1,0,6.08,6.08A6.087,6.087,0,0,0,89.04,32.639Zm4.839-12.495a1.6,1.6,0,0,0-1.027.374L67.357,41.911a1.6,1.6,0,0,0,1.029,2.826,1.608,1.608,0,0,0,1.029-.374L94.908,22.971a1.6,1.6,0,0,0-1.029-2.826ZM29.759,39.68v3.2h2.56v-3.2Zm0-6.4v3.2h2.56v-3.2ZM73.039,18.56a6.08,6.08,0,1,0,6.08,6.08A6.087,6.087,0,0,0,73.039,18.56Zm-43.28,8.32v3.2h2.56v-3.2Zm0-6.4v3.2h2.56v-3.2Zm0-6.4v3.2h2.56v-3.2Zm0-6.08v3.2h2.56V8ZM89.04,41.6a2.88,2.88,0,1,1,2.88-2.88A2.883,2.883,0,0,1,89.04,41.6Zm-16-14.08a2.88,2.88,0,1,1,2.88-2.88A2.883,2.883,0,0,1,73.039,27.52Z",
    fill: "none"
  })));
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Preloader);

/***/ }),

/***/ "./src/core/functions/ajax-request/index.ts":
/*!**************************************************!*\
  !*** ./src/core/functions/ajax-request/index.ts ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash */ "lodash");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _json_to_serialized__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../json-to-serialized */ "./src/core/functions/json-to-serialized/index.ts");



var ajaxRequest = function ajaxRequest(url) {
  var type = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'POST';
  var data = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
  var events = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {};
  var request = new XMLHttpRequest();
  request.open(type, url, true);
  var serializedData = (0,_json_to_serialized__WEBPACK_IMPORTED_MODULE_1__["default"])(data);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
  (0,lodash__WEBPACK_IMPORTED_MODULE_0__.forEach)(events, function (eventCallback, eventName) {
    request.addEventListener(eventName, function (event) {
      eventCallback(event, request);
    });
  });
  request.send(serializedData);
  return request;
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ajaxRequest);

/***/ }),

/***/ "./src/core/functions/json-to-serialized/index.ts":
/*!********************************************************!*\
  !*** ./src/core/functions/json-to-serialized/index.ts ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _params_loop__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../params-loop */ "./src/core/functions/params-loop/index.ts");


var jsonToSerialized = function jsonToSerialized(items) {
  var params = (0,_params_loop__WEBPACK_IMPORTED_MODULE_0__["default"])(items);
  return params.join('&');
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (jsonToSerialized);

/***/ }),

/***/ "./src/core/functions/params-loop/index.ts":
/*!*************************************************!*\
  !*** ./src/core/functions/params-loop/index.ts ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash */ "lodash");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_0__);


var paramsLoop = function paramsLoop(items) {
  var deep = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  var params = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
  var prep = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : '';
  var mainPrep = prep;
  (0,lodash__WEBPACK_IMPORTED_MODULE_0__.forEach)(items, function (itemValue, itemKey) {
    if ((0,lodash__WEBPACK_IMPORTED_MODULE_0__.isObject)(itemValue)) {
      paramsLoop(itemValue, true, params, deep ? "".concat(mainPrep, "[").concat(itemKey, "]") : itemKey);
    } else {
      params.push("".concat(prep).concat(deep ? '[' + itemKey + ']' : itemKey, "=").concat(encodeURI(itemValue)));
    }
  });
  return params;
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (paramsLoop);

/***/ }),

/***/ "./src/core/functions/phpToMoment.js":
/*!*******************************************!*\
  !*** ./src/core/functions/phpToMoment.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (function (str) {
  var replacements = {
    'd': 'DD',
    'D': 'ddd',
    'j': 'D',
    'l': 'dddd',
    'N': 'E',
    'S': 'o',
    'w': 'e',
    'z': 'DDD',
    'W': 'W',
    'F': 'MMMM',
    'm': 'MM',
    'M': 'MMM',
    'n': 'M',
    't': '',
    // no equivalent
    'L': '',
    // no equivalent
    'o': 'YYYY',
    'Y': 'YYYY',
    'y': 'YY',
    'a': 'a',
    'A': 'A',
    'B': '',
    // no equivalent
    'g': 'h',
    'G': 'H',
    'h': 'hh',
    'H': 'HH',
    'i': 'mm',
    's': 'ss',
    'u': 'SSS',
    'e': 'zz',
    // deprecated since Moment.js 1.6.0
    'I': '',
    // no equivalent
    'O': '',
    // no equivalent
    'P': '',
    // no equivalent
    'T': '',
    // no equivalent
    'Z': '',
    // no equivalent
    'c': '',
    // no equivalent
    'r': '',
    // no equivalent
    'U': 'X'
  };
  return str.split('').map(function (chr) {
    return chr in replacements ? replacements[chr] : chr;
  }).join('');
});

/***/ }),

/***/ "./src/core/functions/registerTemplate.js":
/*!************************************************!*\
  !*** ./src/core/functions/registerTemplate.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _utilities_templates__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/templates */ "./src/core/utilities/templates.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (function (id, comp) {
  _utilities_templates__WEBPACK_IMPORTED_MODULE_0__["default"].add(id, comp);
});

/***/ }),

/***/ "./src/core/utilities/templates.js":
/*!*****************************************!*\
  !*** ./src/core/utilities/templates.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _classes_templateManager__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../classes/templateManager */ "./src/core/classes/templateManager.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (new _classes_templateManager__WEBPACK_IMPORTED_MODULE_0__["default"]());

/***/ }),

/***/ "./src/core/components/preloader/style.scss":
/*!**************************************************!*\
  !*** ./src/core/components/preloader/style.scss ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "lodash":
/*!*************************!*\
  !*** external "lodash" ***!
  \*************************/
/***/ ((module) => {

module.exports = window["lodash"];

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
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
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
/*!***************************!*\
  !*** ./src/core/index.js ***!
  \***************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Preloader": () => (/* reexport safe */ _components_preloader__WEBPACK_IMPORTED_MODULE_6__["default"]),
/* harmony export */   "ajaxRequest": () => (/* reexport safe */ _functions_ajax_request__WEBPACK_IMPORTED_MODULE_5__["default"]),
/* harmony export */   "jsonToSerialized": () => (/* reexport safe */ _functions_json_to_serialized__WEBPACK_IMPORTED_MODULE_4__["default"]),
/* harmony export */   "paramsLoop": () => (/* reexport safe */ _functions_params_loop__WEBPACK_IMPORTED_MODULE_3__["default"]),
/* harmony export */   "phpToMoment": () => (/* reexport safe */ _functions_phpToMoment__WEBPACK_IMPORTED_MODULE_2__["default"]),
/* harmony export */   "registerTemplate": () => (/* reexport safe */ _functions_registerTemplate__WEBPACK_IMPORTED_MODULE_1__["default"]),
/* harmony export */   "templates": () => (/* reexport safe */ _utilities_templates__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _utilities_templates__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./utilities/templates */ "./src/core/utilities/templates.js");
/* harmony import */ var _functions_registerTemplate__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./functions/registerTemplate */ "./src/core/functions/registerTemplate.js");
/* harmony import */ var _functions_phpToMoment__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./functions/phpToMoment */ "./src/core/functions/phpToMoment.js");
/* harmony import */ var _functions_params_loop__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./functions/params-loop */ "./src/core/functions/params-loop/index.ts");
/* harmony import */ var _functions_json_to_serialized__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./functions/json-to-serialized */ "./src/core/functions/json-to-serialized/index.ts");
/* harmony import */ var _functions_ajax_request__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./functions/ajax-request */ "./src/core/functions/ajax-request/index.ts");
/* harmony import */ var _components_preloader__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./components/preloader */ "./src/core/components/preloader/index.tsx");
 // export { default as setConfig } from './utilities/setConfig';





 // Components


})();

((this.wp = this.wp || {}).wpo = this.wp.wpo || {}).core = __webpack_exports__;
/******/ })()
;
//# sourceMappingURL=wp-offers-core.js.map