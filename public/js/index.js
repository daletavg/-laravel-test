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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/index.js":
/*!*******************************!*\
  !*** ./resources/js/index.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function checkErrors(errors) {
  var _errors$responseJSON$ = errors.responseJSON.errors,
      name = _errors$responseJSON$.name,
      phone = _errors$responseJSON$.phone,
      surname = _errors$responseJSON$.surname,
      email = _errors$responseJSON$.email;

  if (name !== undefined) {
    name.map(function (el) {
      $.notify(el, "error");
    });
  }

  if (phone !== undefined) {
    phone.map(function (el) {
      $.notify(el, "error");
    });
  }

  if (surname !== undefined) {
    surname.map(function (el) {
      $.notify(el, "error");
    });
  }

  if (email !== undefined) {
    email.map(function (el) {
      $.notify(el, "error");
    });
  }
}

function formSend(currentForm, method, onSuccess) {
  var data = $(currentForm).serialize();
  var url = $(currentForm).attr('action');
  console.log(url);
  $.ajax({
    type: method,
    url: url,
    data: data,
    success: function success(data) {
      onSuccess(data);
    },
    error: function error(errors) {
      checkErrors(errors);
    }
  });
}

$('#saveForm').on('submit', function (e) {
  e.preventDefault();
  var currentForm = this;
  formSend(this, 'POST', function (data) {
    $.notify(data['msg'], "success");
    $(currentForm)[0].reset();
  });
});
$('#editForm').on('submit', function (e) {
  e.preventDefault();
  formSend(this, 'PUT', function (data) {
    $.notify(data['msg'], "success");
  });
});
$('.deleteContact').on('submit', function (e) {
  e.preventDefault();
  var row = $(this).parents('.contact-row');
  row = $(this).parent().parent().parent().parent();
  formSend(this, 'DELETE', function (data) {
    $.notify(data['msg'], "success");
    row.remove();
  });
});

/***/ }),

/***/ 0:
/*!*************************************!*\
  !*** multi ./resources/js/index.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/programmer/Desktop/test-app/resources/js/index.js */"./resources/js/index.js");


/***/ })

/******/ });