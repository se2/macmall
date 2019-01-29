/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(2);


/***/ }),
/* 1 */
/***/ (function(module, exports) {

// JQuery's Document Ready Function
(function ($) {
  $(document).ready(function () {
    // Mobile hamburger
    $(".hamburger").click(function () {
      $(this).toggleClass("is-active");
      $("body").toggleClass("overflow-hidden");
      $(".mobile-dropdown").toggleClass("is-active");
    });
    // Mobile sub-menu actions
    $(".mobile-navigation .menu-item-has-children>a").click(function (e) {
      e.preventDefault();
      $(this).parent(".menu-item").toggleClass("is-active");
      $(this).parent(".menu-item").siblings().toggle();
      $(this).parent(".menu-item").find(".sub-menu").toggle();
    });
    // Add mega-menu active class if enable
    $("ul.menu li.menu-item a").hover(function () {
      if ($(this).data("mega")) {
        var menuID = $(this).data("mega");
        $(".js-mega-menu").removeClass("js-active");
        $(".mega-menu-" + menuID).addClass("js-active");
      } else {
        $(".js-mega-menu").removeClass("js-active");
      }
    }, function () {});
    // Remove mega-menu active class when hovering out of .site-header
    $(".site-header").hover(function () {}, function () {
      setTimeout(function () {
        $(".js-mega-menu").removeClass("js-active");
      }, 300);
    });
    // Search toggle icon
    $(".search-toggle").click(function (e) {
      e.preventDefault();
      $(this).find("img").toggleClass("hidden");
      $(".search-form").toggleClass("no-show");
      $(".search-form input[type=search]").focus();
      $(".main-navigation").toggleClass("no-show");
    });
  });
})(jQuery);

/***/ }),
/* 2 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);