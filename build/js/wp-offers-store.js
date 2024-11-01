/*!
 * WP Offers v1.2.0 - https://www.kitthemes.com/wp-offers
 * KitThemes - https://www.kitthemes.com/
 * (c) 2020 - 2022 KitThemes
 * GPLv2 or later
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/store/category.js":
/*!*******************************!*\
  !*** ./src/store/category.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }



var reducer = function reducer() {
  var state = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
  var action = arguments.length > 1 ? arguments[1] : undefined;

  switch (action.type) {
    case 'SET':
      return _toConsumableArray(action.categories);

    case 'ADD':
      return [].concat(_toConsumableArray(state), [action.category]);
  }

  return state;
};

var actions = {
  set: function set(categories) {
    return {
      type: 'SET',
      categories: categories
    };
  },
  add: function add(category) {
    return {
      type: 'ADD',
      category: category
    };
  }
};
var selectors = {
  getAll: function getAll(state) {
    return state;
  }
};
var store = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.createReduxStore)('wpo/tax/category', {
  reducer: reducer,
  actions: actions,
  selectors: selectors
});
(0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.register)(store);

/***/ }),

/***/ "./src/store/data.js":
/*!***************************!*\
  !*** ./src/store/data.js ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! lodash */ "lodash");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_1__);
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }



var initState = {
  mediaUpload: false,
  isNew: false,
  user: {},
  notices: [],
  taxonomies: {},
  featuredImage: {}
};

var reducer = function reducer() {
  var state = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : initState;
  var action = arguments.length > 1 ? arguments[1] : undefined;

  switch (action.type) {
    case 'IS_NEW':
      return _objectSpread(_objectSpread({}, state), {}, {
        isNew: action.isNew
      });

    case 'UPLOAD_PERMISSION':
      return _objectSpread(_objectSpread({}, state), {}, {
        mediaUpload: action.isAllow
      });

    case 'USER_DATA':
      return _objectSpread(_objectSpread({}, state), {}, {
        user: action.user
      });

    case 'ADD_NOTICE':
      return _objectSpread(_objectSpread({}, state), {}, {
        notices: [].concat(_toConsumableArray(state.notices), _toConsumableArray(action.notices))
      });

    case 'REMOVE_NOTICE':
      return _objectSpread(_objectSpread({}, state), {}, {
        notices: _toConsumableArray((0,lodash__WEBPACK_IMPORTED_MODULE_1__.reject)(state.notices, {
          id: action.noticeId
        }))
      });

    case 'ADD_TAX':
      return _objectSpread(_objectSpread({}, state), {}, {
        taxonomies: _objectSpread(_objectSpread({}, state.taxonomies), {}, _defineProperty({}, action.tax, action.data))
      });

    case 'UPDATE_FEATURED_IMAGE':
      return _objectSpread(_objectSpread({}, state), {}, {
        featuredImage: _objectSpread({}, action.image)
      });
  }

  return state;
};

var actions = {
  setIsNew: function setIsNew(isNew) {
    return {
      type: 'UPDATE_DATE',
      isNew: isNew
    };
  },
  setUploadMediaPermission: function setUploadMediaPermission(isAllow) {
    return {
      type: 'UPLOAD_PERMISSION',
      isAllow: isAllow
    };
  },
  setUserData: function setUserData(user) {
    return {
      type: 'USER_DATA',
      user: user
    };
  },
  addNotice: function addNotice(notices) {
    return {
      type: 'ADD_NOTICE',
      notices: notices
    };
  },
  removeNotice: function removeNotice(noticeId) {
    return {
      type: 'REMOVE_NOTICE',
      noticeId: noticeId
    };
  },
  updateTaxData: function updateTaxData(tax, data) {
    return {
      type: 'ADD_TAX',
      tax: tax,
      data: data
    };
  },
  updateFeaturedImage: function updateFeaturedImage(image) {
    return {
      type: 'UPDATE_FEATURED_IMAGE',
      image: image
    };
  }
};
var selectors = {
  canPublishPost: function canPublishPost(_ref) {
    var user = _ref.user;
    return user && user.capabilities && user.capabilities.publish_posts;
  },
  canEditPost: function canEditPost(_ref2) {
    var user = _ref2.user;
    return user && user.capabilities && user.capabilities.edit_posts;
  },
  canManageCategories: function canManageCategories(_ref3) {
    var user = _ref3.user;
    return user && user.capabilities && user.capabilities.manage_categories;
  },
  canUploadMedia: function canUploadMedia(_ref4) {
    var mediaUpload = _ref4.mediaUpload;
    return mediaUpload;
  },
  getNotices: function getNotices(_ref5) {
    var notices = _ref5.notices;
    return notices;
  },
  isTaxQueryable: function isTaxQueryable(_ref6, tax) {
    var taxonomies = _ref6.taxonomies;
    return taxonomies[tax] && taxonomies[tax].visibility && taxonomies[tax].visibility.publicly_queryable;
  },
  getAll: function getAll(state) {
    return state;
  },
  getFeaturedImag: function getFeaturedImag(_ref7) {
    var featuredImage = _ref7.featuredImage;
    return featuredImage;
  }
};
var store = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.createReduxStore)('wpo/data', {
  reducer: reducer,
  actions: actions,
  selectors: selectors
});
(0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.register)(store);

/***/ }),

/***/ "./src/store/post.js":
/*!***************************!*\
  !*** ./src/store/post.js ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }



var reducer = function reducer() {
  var state = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
  var action = arguments.length > 1 ? arguments[1] : undefined;

  switch (action.type) {
    case 'INIT':
      return action.post;

    case 'UPDATE_TITLE':
      return Object.assign({}, state, {
        title: Object.assign({}, state.title, {
          raw: action.title
        })
      });

    case 'UPDATE_FEATURED_MEDIA':
      return _objectSpread(_objectSpread({}, state), {}, {
        featured_media: action.featured_media
      });

    case 'UPDATE_DATE':
      return _objectSpread(_objectSpread({}, state), {}, {
        date: action.date
      });

    case 'UPDATE_META':
      return Object.assign({}, state, {
        meta: Object.assign({}, state.meta, _defineProperty({}, action.metaKey, action.metaValue))
      });

    case 'UPDATE_TAXONOMY':
      return Object.assign({}, state, _defineProperty({}, action.taxonomy, action.taxValue));
  }

  return state;
};

var actions = {
  init: function init(post) {
    return {
      type: 'INIT',
      post: post
    };
  },
  updateTitle: function updateTitle(title) {
    return {
      type: 'UPDATE_TITLE',
      title: title
    };
  },
  updateFeaturedMedia: function updateFeaturedMedia(featured_media) {
    return {
      type: 'UPDATE_FEATURED_MEDIA',
      featured_media: featured_media
    };
  },
  updateDate: function updateDate(date) {
    return {
      type: 'UPDATE_DATE',
      date: date
    };
  },
  updateMeta: function updateMeta(metaKey, metaValue) {
    return {
      type: 'UPDATE_META',
      metaKey: metaKey,
      metaValue: metaValue
    };
  },
  updateTaxonomy: function updateTaxonomy(taxonomy, taxValue) {
    return {
      type: 'UPDATE_TAXONOMY',
      taxonomy: taxonomy,
      taxValue: taxValue
    };
  }
};
var selectors = {
  get: function get(state) {
    return state;
  },
  getMeta: function getMeta(_ref, metaKye, defaultValue) {
    var meta = _ref.meta;
    var metaValue = meta && meta[metaKye];

    if (undefined === metaValue) {
      return defaultValue;
    }

    return metaValue;
  },
  getMetaAll: function getMetaAll(_ref2) {
    var meta = _ref2.meta;
    return meta;
  },
  getTitleRaw: function getTitleRaw(_ref3) {
    var title = _ref3.title;
    return title !== undefined && title.raw !== undefined ? title.raw : '';
  },
  getMedia: function getMedia(_ref4) {
    var featured_media = _ref4.featured_media;
    return featured_media;
  },
  getCategory: function getCategory(state) {
    return state['wpo-category'];
  },
  getStore: function getStore(state) {
    return state['wpo-store'];
  }
};
var store = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.createReduxStore)('wpo/post', {
  reducer: reducer,
  actions: actions,
  selectors: selectors
});
(0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.register)(store);

/***/ }),

/***/ "./src/store/saved.js":
/*!****************************!*\
  !*** ./src/store/saved.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);


var reducer = function reducer() {
  var state = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
  var action = arguments.length > 1 ? arguments[1] : undefined;

  switch (action.type) {
    case 'SAVE':
      return action.post;
  }

  return state;
};

var actions = {
  save: function save(post) {
    return {
      type: 'SAVE',
      post: post
    };
  }
};
var selectors = {
  get: function get(state) {
    return state;
  }
};
var store = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.createReduxStore)('wpo/saved', {
  reducer: reducer,
  actions: actions,
  selectors: selectors
});
(0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.register)(store);

/***/ }),

/***/ "./src/store/store.js":
/*!****************************!*\
  !*** ./src/store/store.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }



var reducer = function reducer() {
  var state = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
  var action = arguments.length > 1 ? arguments[1] : undefined;

  switch (action.type) {
    case 'SET':
      return _toConsumableArray(action.stores);

    case 'ADD':
      return [].concat(_toConsumableArray(state), [action.store]);
  }

  return state;
};

var actions = {
  set: function set(stores) {
    return {
      type: 'SET',
      stores: stores
    };
  },
  add: function add(store) {
    return {
      type: 'ADD',
      store: store
    };
  }
};
var selectors = {
  getAll: function getAll(state) {
    return state;
  }
};
var store = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.createReduxStore)('wpo/tax/store', {
  reducer: reducer,
  actions: actions,
  selectors: selectors
});
(0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.register)(store);

/***/ }),

/***/ "lodash":
/*!*************************!*\
  !*** external "lodash" ***!
  \*************************/
/***/ ((module) => {

module.exports = window["lodash"];

/***/ }),

/***/ "@wordpress/data":
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["data"];

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
/*!****************************!*\
  !*** ./src/store/index.js ***!
  \****************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _category__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./category */ "./src/store/category.js");
/* harmony import */ var _data__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./data */ "./src/store/data.js");
/* harmony import */ var _post__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./post */ "./src/store/post.js");
/* harmony import */ var _saved__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./saved */ "./src/store/saved.js");
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./store */ "./src/store/store.js");
// import './config';





})();

/******/ })()
;
//# sourceMappingURL=wp-offers-store.js.map