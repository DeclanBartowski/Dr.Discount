(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else if(typeof exports === 'object')
		exports["Cleave"] = factory();
	else
		root["Cleave"] = factory();
})(this, function() {
return /******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(global) {'use strict';

	/**
	 * Construct a new Cleave instance by passing the configuration object
	 *
	 * @param {String | HTMLElement} element
	 * @param {Object} opts
	 */
	var Cleave = function (element, opts) {
	    var owner = this;
	    var hasMultipleElements = false;

	    if (typeof element === 'string') {
	        owner.element = document.querySelector(element);
	        hasMultipleElements = document.querySelectorAll(element).length > 1;
	    } else {
	      if (typeof element.length !== 'undefined' && element.length > 0) {
	        owner.element = element[0];
	        hasMultipleElements = element.length > 1;
	      } else {
	        owner.element = element;
	      }
	    }

	    if (!owner.element) {
	        throw new Error('[cleave.js] Please check the element');
	    }

	    if (hasMultipleElements) {
	      try {
	        // eslint-disable-next-line
	        console.warn('[cleave.js] Multiple input fields matched, cleave.js will only take the first one.');
	      } catch (e) {
	        // Old IE
	      }
	    }

	    opts.initValue = owner.element.value;

	    owner.properties = Cleave.DefaultProperties.assign({}, opts);

	    owner.init();
	};

	Cleave.prototype = {
	    init: function () {
	        var owner = this, pps = owner.properties;

	        // no need to use this lib
	        if (!pps.numeral && !pps.phone && !pps.creditCard && !pps.time && !pps.date && (pps.blocksLength === 0 && !pps.prefix)) {
	            owner.onInput(pps.initValue);

	            return;
	        }

	        pps.maxLength = Cleave.Util.getMaxLength(pps.blocks);

	        owner.isAndroid = Cleave.Util.isAndroid();
	        owner.lastInputValue = '';
	        owner.isBackward = '';

	        owner.onChangeListener = owner.onChange.bind(owner);
	        owner.onKeyDownListener = owner.onKeyDown.bind(owner);
	        owner.onFocusListener = owner.onFocus.bind(owner);
	        owner.onCutListener = owner.onCut.bind(owner);
	        owner.onCopyListener = owner.onCopy.bind(owner);

	        owner.initSwapHiddenInput();

	        owner.element.addEventListener('input', owner.onChangeListener);
	        owner.element.addEventListener('keydown', owner.onKeyDownListener);
	        owner.element.addEventListener('focus', owner.onFocusListener);
	        owner.element.addEventListener('cut', owner.onCutListener);
	        owner.element.addEventListener('copy', owner.onCopyListener);


	        owner.initPhoneFormatter();
	        owner.initDateFormatter();
	        owner.initTimeFormatter();
	        owner.initNumeralFormatter();

	        // avoid touch input field if value is null
	        // otherwise Firefox will add red box-shadow for <input required />
	        if (pps.initValue || (pps.prefix && !pps.noImmediatePrefix)) {
	            owner.onInput(pps.initValue);
	        }
	    },

	    initSwapHiddenInput: function () {
	        var owner = this, pps = owner.properties;
	        if (!pps.swapHiddenInput) return;

	        var inputFormatter = owner.element.cloneNode(true);
	        owner.element.parentNode.insertBefore(inputFormatter, owner.element);

	        owner.elementSwapHidden = owner.element;
	        owner.elementSwapHidden.type = 'hidden';

	        owner.element = inputFormatter;
	        owner.element.id = '';
	    },

	    initNumeralFormatter: function () {
	        var owner = this, pps = owner.properties;

	        if (!pps.numeral) {
	            return;
	        }

	        pps.numeralFormatter = new Cleave.NumeralFormatter(
	            pps.numeralDecimalMark,
	            pps.numeralIntegerScale,
	            pps.numeralDecimalScale,
	            pps.numeralThousandsGroupStyle,
	            pps.numeralPositiveOnly,
	            pps.stripLeadingZeroes,
	            pps.prefix,
	            pps.signBeforePrefix,
	            pps.tailPrefix,
	            pps.delimiter
	        );
	    },

	    initTimeFormatter: function() {
	        var owner = this, pps = owner.properties;

	        if (!pps.time) {
	            return;
	        }

	        pps.timeFormatter = new Cleave.TimeFormatter(pps.timePattern, pps.timeFormat);
	        pps.blocks = pps.timeFormatter.getBlocks();
	        pps.blocksLength = pps.blocks.length;
	        pps.maxLength = Cleave.Util.getMaxLength(pps.blocks);
	    },

	    initDateFormatter: function () {
	        var owner = this, pps = owner.properties;

	        if (!pps.date) {
	            return;
	        }

	        pps.dateFormatter = new Cleave.DateFormatter(pps.datePattern, pps.dateMin, pps.dateMax);
	        pps.blocks = pps.dateFormatter.getBlocks();
	        pps.blocksLength = pps.blocks.length;
	        pps.maxLength = Cleave.Util.getMaxLength(pps.blocks);
	    },

	    initPhoneFormatter: function () {
	        var owner = this, pps = owner.properties;

	        if (!pps.phone) {
	            return;
	        }

	        // Cleave.AsYouTypeFormatter should be provided by
	        // external google closure lib
	        try {
	            pps.phoneFormatter = new Cleave.PhoneFormatter(
	                new pps.root.Cleave.AsYouTypeFormatter(pps.phoneRegionCode),
	                pps.delimiter
	            );
	        } catch (ex) {
	            throw new Error('[cleave.js] Please include phone-type-formatter.{country}.js lib');
	        }
	    },

	    onKeyDown: function (event) {
	        var owner = this,
	            charCode = event.which || event.keyCode;

	        owner.lastInputValue = owner.element.value;
	        owner.isBackward = charCode === 8;
	    },

	    onChange: function (event) {
	        var owner = this, pps = owner.properties,
	            Util = Cleave.Util;

	        owner.isBackward = owner.isBackward || event.inputType === 'deleteContentBackward';

	        var postDelimiter = Util.getPostDelimiter(owner.lastInputValue, pps.delimiter, pps.delimiters);

	        if (owner.isBackward && postDelimiter) {
	            pps.postDelimiterBackspace = postDelimiter;
	        } else {
	            pps.postDelimiterBackspace = false;
	        }

	        this.onInput(this.element.value);
	    },

	    onFocus: function () {
	        var owner = this,
	            pps = owner.properties;
	        owner.lastInputValue = owner.element.value;

	        if (pps.prefix && pps.noImmediatePrefix && !owner.element.value) {
	            this.onInput(pps.prefix);
	        }

	        Cleave.Util.fixPrefixCursor(owner.element, pps.prefix, pps.delimiter, pps.delimiters);
	    },

	    onCut: function (e) {
	        if (!Cleave.Util.checkFullSelection(this.element.value)) return;
	        this.copyClipboardData(e);
	        this.onInput('');
	    },

	    onCopy: function (e) {
	        if (!Cleave.Util.checkFullSelection(this.element.value)) return;
	        this.copyClipboardData(e);
	    },

	    copyClipboardData: function (e) {
	        var owner = this,
	            pps = owner.properties,
	            Util = Cleave.Util,
	            inputValue = owner.element.value,
	            textToCopy = '';

	        if (!pps.copyDelimiter) {
	            textToCopy = Util.stripDelimiters(inputValue, pps.delimiter, pps.delimiters);
	        } else {
	            textToCopy = inputValue;
	        }

	        try {
	            if (e.clipboardData) {
	                e.clipboardData.setData('Text', textToCopy);
	            } else {
	                window.clipboardData.setData('Text', textToCopy);
	            }

	            e.preventDefault();
	        } catch (ex) {
	            //  empty
	        }
	    },

	    onInput: function (value) {
	        var owner = this, pps = owner.properties,
	            Util = Cleave.Util;

	        // case 1: delete one more character "4"
	        // 1234*| -> hit backspace -> 123|
	        // case 2: last character is not delimiter which is:
	        // 12|34* -> hit backspace -> 1|34*
	        // note: no need to apply this for numeral mode
	        var postDelimiterAfter = Util.getPostDelimiter(value, pps.delimiter, pps.delimiters);
	        if (!pps.numeral && pps.postDelimiterBackspace && !postDelimiterAfter) {
	            value = Util.headStr(value, value.length - pps.postDelimiterBackspace.length);
	        }

	        // phone formatter
	        if (pps.phone) {
	            if (pps.prefix && (!pps.noImmediatePrefix || value.length)) {
	                pps.result = pps.prefix + pps.phoneFormatter.format(value).slice(pps.prefix.length);
	            } else {
	                pps.result = pps.phoneFormatter.format(value);
	            }
	            owner.updateValueState();

	            return;
	        }

	        // numeral formatter
	        if (pps.numeral) {
	            // Do not show prefix when noImmediatePrefix is specified
	            // This mostly because we need to show user the native input placeholder
	            if (pps.prefix && pps.noImmediatePrefix && value.length === 0) {
	                pps.result = '';
	            } else {
	                pps.result = pps.numeralFormatter.format(value);
	            }
	            owner.updateValueState();

	            return;
	        }

	        // date
	        if (pps.date) {
	            value = pps.dateFormatter.getValidatedDate(value);
	        }

	        // time
	        if (pps.time) {
	            value = pps.timeFormatter.getValidatedTime(value);
	        }

	        // strip delimiters
	        value = Util.stripDelimiters(value, pps.delimiter, pps.delimiters);

	        // strip prefix
	        value = Util.getPrefixStrippedValue(value, pps.prefix, pps.prefixLength, pps.result, pps.delimiter, pps.delimiters, pps.noImmediatePrefix, pps.tailPrefix, pps.signBeforePrefix);

	        // strip non-numeric characters
	        value = pps.numericOnly ? Util.strip(value, /[^\d]/g) : value;

	        // convert case
	        value = pps.uppercase ? value.toUpperCase() : value;
	        value = pps.lowercase ? value.toLowerCase() : value;

	        // prevent from showing prefix when no immediate option enabled with empty input value
	        if (pps.prefix) {
	            if (pps.tailPrefix) {
	                value = value + pps.prefix;
	            } else {
	                value = pps.prefix + value;
	            }


	            // no blocks specified, no need to do formatting
	            if (pps.blocksLength === 0) {
	                pps.result = value;
	                owner.updateValueState();

	                return;
	            }
	        }

	        // update credit card props
	        if (pps.creditCard) {
	            owner.updateCreditCardPropsByValue(value);
	        }

	        // strip over length characters
	        value = Util.headStr(value, pps.maxLength);

	        // apply blocks
	        pps.result = Util.getFormattedValue(
	            value,
	            pps.blocks, pps.blocksLength,
	            pps.delimiter, pps.delimiters, pps.delimiterLazyShow
	        );

	        owner.updateValueState();
	    },

	    updateCreditCardPropsByValue: function (value) {
	        var owner = this, pps = owner.properties,
	            Util = Cleave.Util,
	            creditCardInfo;

	        // At least one of the first 4 characters has changed
	        if (Util.headStr(pps.result, 4) === Util.headStr(value, 4)) {
	            return;
	        }

	        creditCardInfo = Cleave.CreditCardDetector.getInfo(value, pps.creditCardStrictMode);

	        pps.blocks = creditCardInfo.blocks;
	        pps.blocksLength = pps.blocks.length;
	        pps.maxLength = Util.getMaxLength(pps.blocks);

	        // credit card type changed
	        if (pps.creditCardType !== creditCardInfo.type) {
	            pps.creditCardType = creditCardInfo.type;

	            pps.onCreditCardTypeChanged.call(owner, pps.creditCardType);
	        }
	    },

	    updateValueState: function () {
	        var owner = this,
	            Util = Cleave.Util,
	            pps = owner.properties;

	        if (!owner.element) {
	            return;
	        }

	        var endPos = owner.element.selectionEnd;
	        var oldValue = owner.element.value;
	        var newValue = pps.result;

	        endPos = Util.getNextCursorPosition(endPos, oldValue, newValue, pps.delimiter, pps.delimiters);

	        // fix Android browser type="text" input field
	        // cursor not jumping issue
	        if (owner.isAndroid) {
	            window.setTimeout(function () {
	                owner.element.value = newValue;
	                Util.setSelection(owner.element, endPos, pps.document, false);
	                owner.callOnValueChanged();
	            }, 1);

	            return;
	        }

	        owner.element.value = newValue;
	        if (pps.swapHiddenInput) owner.elementSwapHidden.value = owner.getRawValue();

	        Util.setSelection(owner.element, endPos, pps.document, false);
	        owner.callOnValueChanged();
	    },

	    callOnValueChanged: function () {
	        var owner = this,
	            pps = owner.properties;

	        pps.onValueChanged.call(owner, {
	            target: {
	                name: owner.element.name,
	                value: pps.result,
	                rawValue: owner.getRawValue()
	            }
	        });
	    },

	    setPhoneRegionCode: function (phoneRegionCode) {
	        var owner = this, pps = owner.properties;

	        pps.phoneRegionCode = phoneRegionCode;
	        owner.initPhoneFormatter();
	        owner.onChange();
	    },

	    setRawValue: function (value) {
	        var owner = this, pps = owner.properties;

	        value = value !== undefined && value !== null ? value.toString() : '';

	        if (pps.numeral) {
	            value = value.replace('.', pps.numeralDecimalMark);
	        }

	        pps.postDelimiterBackspace = false;

	        owner.element.value = value;
	        owner.onInput(value);
	    },

	    getRawValue: function () {
	        var owner = this,
	            pps = owner.properties,
	            Util = Cleave.Util,
	            rawValue = owner.element.value;

	        if (pps.rawValueTrimPrefix) {
	            rawValue = Util.getPrefixStrippedValue(rawValue, pps.prefix, pps.prefixLength, pps.result, pps.delimiter, pps.delimiters, pps.noImmediatePrefix, pps.tailPrefix, pps.signBeforePrefix);
	        }

	        if (pps.numeral) {
	            rawValue = pps.numeralFormatter.getRawValue(rawValue);
	        } else {
	            rawValue = Util.stripDelimiters(rawValue, pps.delimiter, pps.delimiters);
	        }

	        return rawValue;
	    },

	    getISOFormatDate: function () {
	        var owner = this,
	            pps = owner.properties;

	        return pps.date ? pps.dateFormatter.getISOFormatDate() : '';
	    },

	    getISOFormatTime: function () {
	        var owner = this,
	            pps = owner.properties;

	        return pps.time ? pps.timeFormatter.getISOFormatTime() : '';
	    },

	    getFormattedValue: function () {
	        return this.element.value;
	    },

	    destroy: function () {
	        var owner = this;

	        owner.element.removeEventListener('input', owner.onChangeListener);
	        owner.element.removeEventListener('keydown', owner.onKeyDownListener);
	        owner.element.removeEventListener('focus', owner.onFocusListener);
	        owner.element.removeEventListener('cut', owner.onCutListener);
	        owner.element.removeEventListener('copy', owner.onCopyListener);
	    },

	    toString: function () {
	        return '[Cleave Object]';
	    }
	};

	Cleave.NumeralFormatter = __webpack_require__(1);
	Cleave.DateFormatter = __webpack_require__(2);
	Cleave.TimeFormatter = __webpack_require__(3);
	Cleave.PhoneFormatter = __webpack_require__(4);
	Cleave.CreditCardDetector = __webpack_require__(5);
	Cleave.Util = __webpack_require__(6);
	Cleave.DefaultProperties = __webpack_require__(7);

	// for angular directive
	((typeof global === 'object' && global) ? global : window)['Cleave'] = Cleave;

	// CommonJS
	module.exports = Cleave;

	/* WEBPACK VAR INJECTION */}.call(exports, (function() { return this; }())))

/***/ }),
/* 1 */
/***/ (function(module, exports) {

	'use strict';

	var NumeralFormatter = function (numeralDecimalMark,
	                                 numeralIntegerScale,
	                                 numeralDecimalScale,
	                                 numeralThousandsGroupStyle,
	                                 numeralPositiveOnly,
	                                 stripLeadingZeroes,
	                                 prefix,
	                                 signBeforePrefix,
	                                 tailPrefix,
	                                 delimiter) {
	    var owner = this;

	    owner.numeralDecimalMark = numeralDecimalMark || '.';
	    owner.numeralIntegerScale = numeralIntegerScale > 0 ? numeralIntegerScale : 0;
	    owner.numeralDecimalScale = numeralDecimalScale >= 0 ? numeralDecimalScale : 2;
	    owner.numeralThousandsGroupStyle = numeralThousandsGroupStyle || NumeralFormatter.groupStyle.thousand;
	    owner.numeralPositiveOnly = !!numeralPositiveOnly;
	    owner.stripLeadingZeroes = stripLeadingZeroes !== false;
	    owner.prefix = (prefix || prefix === '') ? prefix : '';
	    owner.signBeforePrefix = !!signBeforePrefix;
	    owner.tailPrefix = !!tailPrefix;
	    owner.delimiter = (delimiter || delimiter === '') ? delimiter : ',';
	    owner.delimiterRE = delimiter ? new RegExp('\\' + delimiter, 'g') : '';
	};

	NumeralFormatter.groupStyle = {
	    thousand: 'thousand',
	    lakh:     'lakh',
	    wan:      'wan',
	    none:     'none'    
	};

	NumeralFormatter.prototype = {
	    getRawValue: function (value) {
	        return value.replace(this.delimiterRE, '').replace(this.numeralDecimalMark, '.');
	    },

	    format: function (value) {
	        var owner = this, parts, partSign, partSignAndPrefix, partInteger, partDecimal = '';

	        // strip alphabet letters
	        value = value.replace(/[A-Za-z]/g, '')
	            // replace the first decimal mark with reserved placeholder
	            .replace(owner.numeralDecimalMark, 'M')

	            // strip non numeric letters except minus and "M"
	            // this is to ensure prefix has been stripped
	            .replace(/[^\dM-]/g, '')

	            // replace the leading minus with reserved placeholder
	            .replace(/^\-/, 'N')

	            // strip the other minus sign (if present)
	            .replace(/\-/g, '')

	            // replace the minus sign (if present)
	            .replace('N', owner.numeralPositiveOnly ? '' : '-')

	            // replace decimal mark
	            .replace('M', owner.numeralDecimalMark);

	        // strip any leading zeros
	        if (owner.stripLeadingZeroes) {
	            value = value.replace(/^(-)?0+(?=\d)/, '$1');
	        }

	        partSign = value.slice(0, 1) === '-' ? '-' : '';
	        if (typeof owner.prefix != 'undefined') {
	            if (owner.signBeforePrefix) {
	                partSignAndPrefix = partSign + owner.prefix;
	            } else {
	                partSignAndPrefix = owner.prefix + partSign;
	            }
	        } else {
	            partSignAndPrefix = partSign;
	        }
	        
	        partInteger = value;

	        if (value.indexOf(owner.numeralDecimalMark) >= 0) {
	            parts = value.split(owner.numeralDecimalMark);
	            partInteger = parts[0];
	            partDecimal = owner.numeralDecimalMark + parts[1].slice(0, owner.numeralDecimalScale);
	        }

	        if(partSign === '-') {
	            partInteger = partInteger.slice(1);
	        }

	        if (owner.numeralIntegerScale > 0) {
	          partInteger = partInteger.slice(0, owner.numeralIntegerScale);
	        }

	        switch (owner.numeralThousandsGroupStyle) {
	        case NumeralFormatter.groupStyle.lakh:
	            partInteger = partInteger.replace(/(\d)(?=(\d\d)+\d$)/g, '$1' + owner.delimiter);

	            break;

	        case NumeralFormatter.groupStyle.wan:
	            partInteger = partInteger.replace(/(\d)(?=(\d{4})+$)/g, '$1' + owner.delimiter);

	            break;

	        case NumeralFormatter.groupStyle.thousand:
	            partInteger = partInteger.replace(/(\d)(?=(\d{3})+$)/g, '$1' + owner.delimiter);

	            break;
	        }

	        if (owner.tailPrefix) {
	            return partSign + partInteger.toString() + (owner.numeralDecimalScale > 0 ? partDecimal.toString() : '') + owner.prefix;
	        }

	        return partSignAndPrefix + partInteger.toString() + (owner.numeralDecimalScale > 0 ? partDecimal.toString() : '');
	    }
	};

	module.exports = NumeralFormatter;


/***/ }),
/* 2 */
/***/ (function(module, exports) {

	'use strict';

	var DateFormatter = function (datePattern, dateMin, dateMax) {
	    var owner = this;

	    owner.date = [];
	    owner.blocks = [];
	    owner.datePattern = datePattern;
	    owner.dateMin = dateMin
	      .split('-')
	      .reverse()
	      .map(function(x) {
	        return parseInt(x, 10);
	      });
	    if (owner.dateMin.length === 2) owner.dateMin.unshift(0);

	    owner.dateMax = dateMax
	      .split('-')
	      .reverse()
	      .map(function(x) {
	        return parseInt(x, 10);
	      });
	    if (owner.dateMax.length === 2) owner.dateMax.unshift(0);
	    
	    owner.initBlocks();
	};

	DateFormatter.prototype = {
	    initBlocks: function () {
	        var owner = this;
	        owner.datePattern.forEach(function (value) {
	            if (value === 'Y') {
	                owner.blocks.push(4);
	            } else {
	                owner.blocks.push(2);
	            }
	        });
	    },

	    getISOFormatDate: function () {
	        var owner = this,
	            date = owner.date;

	        return date[2] ? (
	            date[2] + '-' + owner.addLeadingZero(date[1]) + '-' + owner.addLeadingZero(date[0])
	        ) : '';
	    },

	    getBlocks: function () {
	        return this.blocks;
	    },

	    getValidatedDate: function (value) {
	        var owner = this, result = '';

	        value = value.replace(/[^\d]/g, '');

	        owner.blocks.forEach(function (length, index) {
	            if (value.length > 0) {
	                var sub = value.slice(0, length),
	                    sub0 = sub.slice(0, 1),
	                    rest = value.slice(length);

	                switch (owner.datePattern[index]) {
	                case 'd':
	                    if (sub === '00') {
	                        sub = '01';
	                    } else if (parseInt(sub0, 10) > 3) {
	                        sub = '0' + sub0;
	                    } else if (parseInt(sub, 10) > 31) {
	                        sub = '31';
	                    }

	                    break;

	                case 'm':
	                    if (sub === '00') {
	                        sub = '01';
	                    } else if (parseInt(sub0, 10) > 1) {
	                        sub = '0' + sub0;
	                    } else if (parseInt(sub, 10) > 12) {
	                        sub = '12';
	                    }

	                    break;
	                }

	                result += sub;

	                // update remaining string
	                value = rest;
	            }
	        });

	        return this.getFixedDateString(result);
	    },

	    getFixedDateString: function (value) {
	        var owner = this, datePattern = owner.datePattern, date = [],
	            dayIndex = 0, monthIndex = 0, yearIndex = 0,
	            dayStartIndex = 0, monthStartIndex = 0, yearStartIndex = 0,
	            day, month, year, fullYearDone = false;

	        // mm-dd || dd-mm
	        if (value.length === 4 && datePattern[0].toLowerCase() !== 'y' && datePattern[1].toLowerCase() !== 'y') {
	            dayStartIndex = datePattern[0] === 'd' ? 0 : 2;
	            monthStartIndex = 2 - dayStartIndex;
	            day = parseInt(value.slice(dayStartIndex, dayStartIndex + 2), 10);
	            month = parseInt(value.slice(monthStartIndex, monthStartIndex + 2), 10);

	            date = this.getFixedDate(day, month, 0);
	        }

	        // yyyy-mm-dd || yyyy-dd-mm || mm-dd-yyyy || dd-mm-yyyy || dd-yyyy-mm || mm-yyyy-dd
	        if (value.length === 8) {
	            datePattern.forEach(function (type, index) {
	                switch (type) {
	                case 'd':
	                    dayIndex = index;
	                    break;
	                case 'm':
	                    monthIndex = index;
	                    break;
	                default:
	                    yearIndex = index;
	                    break;
	                }
	            });

	            yearStartIndex = yearIndex * 2;
	            dayStartIndex = (dayIndex <= yearIndex) ? dayIndex * 2 : (dayIndex * 2 + 2);
	            monthStartIndex = (monthIndex <= yearIndex) ? monthIndex * 2 : (monthIndex * 2 + 2);

	            day = parseInt(value.slice(dayStartIndex, dayStartIndex + 2), 10);
	            month = parseInt(value.slice(monthStartIndex, monthStartIndex + 2), 10);
	            year = parseInt(value.slice(yearStartIndex, yearStartIndex + 4), 10);

	            fullYearDone = value.slice(yearStartIndex, yearStartIndex + 4).length === 4;

	            date = this.getFixedDate(day, month, year);
	        }

	        // mm-yy || yy-mm
	        if (value.length === 4 && (datePattern[0] === 'y' || datePattern[1] === 'y')) {
	            monthStartIndex = datePattern[0] === 'm' ? 0 : 2;
	            yearStartIndex = 2 - monthStartIndex;
	            month = parseInt(value.slice(monthStartIndex, monthStartIndex + 2), 10);
	            year = parseInt(value.slice(yearStartIndex, yearStartIndex + 2), 10);

	            fullYearDone = value.slice(yearStartIndex, yearStartIndex + 2).length === 2;

	            date = [0, month, year];
	        }

	        // mm-yyyy || yyyy-mm
	        if (value.length === 6 && (datePattern[0] === 'Y' || datePattern[1] === 'Y')) {
	            monthStartIndex = datePattern[0] === 'm' ? 0 : 4;
	            yearStartIndex = 2 - 0.5 * monthStartIndex;
	            month = parseInt(value.slice(monthStartIndex, monthStartIndex + 2), 10);
	            year = parseInt(value.slice(yearStartIndex, yearStartIndex + 4), 10);

	            fullYearDone = value.slice(yearStartIndex, yearStartIndex + 4).length === 4;

	            date = [0, month, year];
	        }

	        date = owner.getRangeFixedDate(date);
	        owner.date = date;

	        var result = date.length === 0 ? value : datePattern.reduce(function (previous, current) {
	            switch (current) {
	            case 'd':
	                return previous + (date[0] === 0 ? '' : owner.addLeadingZero(date[0]));
	            case 'm':
	                return previous + (date[1] === 0 ? '' : owner.addLeadingZero(date[1]));
	            case 'y':
	                return previous + (fullYearDone ? owner.addLeadingZeroForYear(date[2], false) : '');
	            case 'Y':
	                return previous + (fullYearDone ? owner.addLeadingZeroForYear(date[2], true) : '');
	            }
	        }, '');

	        return result;
	    },

	    getRangeFixedDate: function (date) {
	        var owner = this,
	            datePattern = owner.datePattern,
	            dateMin = owner.dateMin || [],
	            dateMax = owner.dateMax || [];

	        if (!date.length || (dateMin.length < 3 && dateMax.length < 3)) return date;

	        if (
	          datePattern.find(function(x) {
	            return x.toLowerCase() === 'y';
	          }) &&
	          date[2] === 0
	        ) return date;

	        if (dateMax.length && (dateMax[2] < date[2] || (
	          dateMax[2] === date[2] && (dateMax[1] < date[1] || (
	            dateMax[1] === date[1] && dateMax[0] < date[0]
	          ))
	        ))) return dateMax;

	        if (dateMin.length && (dateMin[2] > date[2] || (
	          dateMin[2] === date[2] && (dateMin[1] > date[1] || (
	            dateMin[1] === date[1] && dateMin[0] > date[0]
	          ))
	        ))) return dateMin;

	        return date;
	    },

	    getFixedDate: function (day, month, year) {
	        day = Math.min(day, 31);
	        month = Math.min(month, 12);
	        year = parseInt((year || 0), 10);

	        if ((month < 7 && month % 2 === 0) || (month > 8 && month % 2 === 1)) {
	            day = Math.min(day, month === 2 ? (this.isLeapYear(year) ? 29 : 28) : 30);
	        }

	        return [day, month, year];
	    },

	    isLeapYear: function (year) {
	        return ((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0);
	    },

	    addLeadingZero: function (number) {
	        return (number < 10 ? '0' : '') + number;
	    },

	    addLeadingZeroForYear: function (number, fullYearMode) {
	        if (fullYearMode) {
	            return (number < 10 ? '000' : (number < 100 ? '00' : (number < 1000 ? '0' : ''))) + number;
	        }

	        return (number < 10 ? '0' : '') + number;
	    }
	};

	module.exports = DateFormatter;


/***/ }),
/* 3 */
/***/ (function(module, exports) {

	'use strict';

	var TimeFormatter = function (timePattern, timeFormat) {
	    var owner = this;

	    owner.time = [];
	    owner.blocks = [];
	    owner.timePattern = timePattern;
	    owner.timeFormat = timeFormat;
	    owner.initBlocks();
	};

	TimeFormatter.prototype = {
	    initBlocks: function () {
	        var owner = this;
	        owner.timePattern.forEach(function () {
	            owner.blocks.push(2);
	        });
	    },

	    getISOFormatTime: function () {
	        var owner = this,
	            time = owner.time;

	        return time[2] ? (
	            owner.addLeadingZero(time[0]) + ':' + owner.addLeadingZero(time[1]) + ':' + owner.addLeadingZero(time[2])
	        ) : '';
	    },

	    getBlocks: function () {
	        return this.blocks;
	    },

	    getTimeFormatOptions: function () {
	        var owner = this;
	        if (String(owner.timeFormat) === '12') {
	            return {
	                maxHourFirstDigit: 1,
	                maxHours: 12,
	                maxMinutesFirstDigit: 5,
	                maxMinutes: 60
	            };
	        }

	        return {
	            maxHourFirstDigit: 2,
	            maxHours: 23,
	            maxMinutesFirstDigit: 5,
	            maxMinutes: 60
	        };
	    },

	    getValidatedTime: function (value) {
	        var owner = this, result = '';

	        value = value.replace(/[^\d]/g, '');

	        var timeFormatOptions = owner.getTimeFormatOptions();

	        owner.blocks.forEach(function (length, index) {
	            if (value.length > 0) {
	                var sub = value.slice(0, length),
	                    sub0 = sub.slice(0, 1),
	                    rest = value.slice(length);

	                switch (owner.timePattern[index]) {

	                case 'h':
	                    if (parseInt(sub0, 10) > timeFormatOptions.maxHourFirstDigit) {
	                        sub = '0' + sub0;
	                    } else if (parseInt(sub, 10) > timeFormatOptions.maxHours) {
	                        sub = timeFormatOptions.maxHours + '';
	                    }

	                    break;

	                case 'm':
	                case 's':
	                    if (parseInt(sub0, 10) > timeFormatOptions.maxMinutesFirstDigit) {
	                        sub = '0' + sub0;
	                    } else if (parseInt(sub, 10) > timeFormatOptions.maxMinutes) {
	                        sub = timeFormatOptions.maxMinutes + '';
	                    }
	                    break;
	                }

	                result += sub;

	                // update remaining string
	                value = rest;
	            }
	        });

	        return this.getFixedTimeString(result);
	    },

	    getFixedTimeString: function (value) {
	        var owner = this, timePattern = owner.timePattern, time = [],
	            secondIndex = 0, minuteIndex = 0, hourIndex = 0,
	            secondStartIndex = 0, minuteStartIndex = 0, hourStartIndex = 0,
	            second, minute, hour;

	        if (value.length === 6) {
	            timePattern.forEach(function (type, index) {
	                switch (type) {
	                case 's':
	                    secondIndex = index * 2;
	                    break;
	                case 'm':
	                    minuteIndex = index * 2;
	                    break;
	                case 'h':
	                    hourIndex = index * 2;
	                    break;
	                }
	            });

	            hourStartIndex = hourIndex;
	            minuteStartIndex = minuteIndex;
	            secondStartIndex = secondIndex;

	            second = parseInt(value.slice(secondStartIndex, secondStartIndex + 2), 10);
	            minute = parseInt(value.slice(minuteStartIndex, minuteStartIndex + 2), 10);
	            hour = parseInt(value.slice(hourStartIndex, hourStartIndex + 2), 10);

	            time = this.getFixedTime(hour, minute, second);
	        }

	        if (value.length === 4 && owner.timePattern.indexOf('s') < 0) {
	            timePattern.forEach(function (type, index) {
	                switch (type) {
	                case 'm':
	                    minuteIndex = index * 2;
	                    break;
	                case 'h':
	                    hourIndex = index * 2;
	                    break;
	                }
	            });

	            hourStartIndex = hourIndex;
	            minuteStartIndex = minuteIndex;

	            second = 0;
	            minute = parseInt(value.slice(minuteStartIndex, minuteStartIndex + 2), 10);
	            hour = parseInt(value.slice(hourStartIndex, hourStartIndex + 2), 10);

	            time = this.getFixedTime(hour, minute, second);
	        }

	        owner.time = time;

	        return time.length === 0 ? value : timePattern.reduce(function (previous, current) {
	            switch (current) {
	            case 's':
	                return previous + owner.addLeadingZero(time[2]);
	            case 'm':
	                return previous + owner.addLeadingZero(time[1]);
	            case 'h':
	                return previous + owner.addLeadingZero(time[0]);
	            }
	        }, '');
	    },

	    getFixedTime: function (hour, minute, second) {
	        second = Math.min(parseInt(second || 0, 10), 60);
	        minute = Math.min(minute, 60);
	        hour = Math.min(hour, 60);

	        return [hour, minute, second];
	    },

	    addLeadingZero: function (number) {
	        return (number < 10 ? '0' : '') + number;
	    }
	};

	module.exports = TimeFormatter;


/***/ }),
/* 4 */
/***/ (function(module, exports) {

	'use strict';

	var PhoneFormatter = function (formatter, delimiter) {
	    var owner = this;

	    owner.delimiter = (delimiter || delimiter === '') ? delimiter : ' ';
	    owner.delimiterRE = delimiter ? new RegExp('\\' + delimiter, 'g') : '';

	    owner.formatter = formatter;
	};

	PhoneFormatter.prototype = {
	    setFormatter: function (formatter) {
	        this.formatter = formatter;
	    },

	    format: function (phoneNumber) {
	        var owner = this;

	        owner.formatter.clear();

	        // only keep number and +
	        phoneNumber = phoneNumber.replace(/[^\d+]/g, '');

	        // strip non-leading +
	        phoneNumber = phoneNumber.replace(/^\+/, 'B').replace(/\+/g, '').replace('B', '+');

	        // strip delimiter
	        phoneNumber = phoneNumber.replace(owner.delimiterRE, '');

	        var result = '', current, validated = false;

	        for (var i = 0, iMax = phoneNumber.length; i < iMax; i++) {
	            current = owner.formatter.inputDigit(phoneNumber.charAt(i));

	            // has ()- or space inside
	            if (/[\s()-]/g.test(current)) {
	                result = current;

	                validated = true;
	            } else {
	                if (!validated) {
	                    result = current;
	                }
	                // else: over length input
	                // it turns to invalid number again
	            }
	        }

	        // strip ()
	        // e.g. US: 7161234567 returns (716) 123-4567
	        result = result.replace(/[()]/g, '');
	        // replace library delimiter with user customized delimiter
	        result = result.replace(/[\s-]/g, owner.delimiter);

	        return result;
	    }
	};

	module.exports = PhoneFormatter;


/***/ }),
/* 5 */
/***/ (function(module, exports) {

	'use strict';

	var CreditCardDetector = {
	    blocks: {
	        uatp:          [4, 5, 6],
	        amex:          [4, 6, 5],
	        diners:        [4, 6, 4],
	        discover:      [4, 4, 4, 4],
	        mastercard:    [4, 4, 4, 4],
	        dankort:       [4, 4, 4, 4],
	        instapayment:  [4, 4, 4, 4],
	        jcb15:         [4, 6, 5],
	        jcb:           [4, 4, 4, 4],
	        maestro:       [4, 4, 4, 4],
	        visa:          [4, 4, 4, 4],
	        mir:           [4, 4, 4, 4],
	        unionPay:      [4, 4, 4, 4],
	        general:       [4, 4, 4, 4]
	    },

	    re: {
	        // starts with 1; 15 digits, not starts with 1800 (jcb card)
	        uatp: /^(?!1800)1\d{0,14}/,

	        // starts with 34/37; 15 digits
	        amex: /^3[47]\d{0,13}/,

	        // starts with 6011/65/644-649; 16 digits
	        discover: /^(?:6011|65\d{0,2}|64[4-9]\d?)\d{0,12}/,

	        // starts with 300-305/309 or 36/38/39; 14 digits
	        diners: /^3(?:0([0-5]|9)|[689]\d?)\d{0,11}/,

	        // starts with 51-55/2221–2720; 16 digits
	        mastercard: /^(5[1-5]\d{0,2}|22[2-9]\d{0,1}|2[3-7]\d{0,2})\d{0,12}/,

	        // starts with 5019/4175/4571; 16 digits
	        dankort: /^(5019|4175|4571)\d{0,12}/,

	        // starts with 637-639; 16 digits
	        instapayment: /^63[7-9]\d{0,13}/,

	        // starts with 2131/1800; 15 digits
	        jcb15: /^(?:2131|1800)\d{0,11}/,

	        // starts with 2131/1800/35; 16 digits
	        jcb: /^(?:35\d{0,2})\d{0,12}/,

	        // starts with 50/56-58/6304/67; 16 digits
	        maestro: /^(?:5[0678]\d{0,2}|6304|67\d{0,2})\d{0,12}/,

	        // starts with 22; 16 digits
	        mir: /^220[0-4]\d{0,12}/,

	        // starts with 4; 16 digits
	        visa: /^4\d{0,15}/,

	        // starts with 62/81; 16 digits
	        unionPay: /^(62|81)\d{0,14}/
	    },

	    getStrictBlocks: function (block) {
	      var total = block.reduce(function (prev, current) {
	        return prev + current;
	      }, 0);

	      return block.concat(19 - total);
	    },

	    getInfo: function (value, strictMode) {
	        var blocks = CreditCardDetector.blocks,
	            re = CreditCardDetector.re;

	        // Some credit card can have up to 19 digits number.
	        // Set strictMode to true will remove the 16 max-length restrain,
	        // however, I never found any website validate card number like
	        // this, hence probably you don't want to enable this option.
	        strictMode = !!strictMode;

	        for (var key in re) {
	            if (re[key].test(value)) {
	                var matchedBlocks = blocks[key];
	                return {
	                    type: key,
	                    blocks: strictMode ? this.getStrictBlocks(matchedBlocks) : matchedBlocks
	                };
	            }
	        }

	        return {
	            type: 'unknown',
	            blocks: strictMode ? this.getStrictBlocks(blocks.general) : blocks.general
	        };
	    }
	};

	module.exports = CreditCardDetector;


/***/ }),
/* 6 */
/***/ (function(module, exports) {

	'use strict';

	var Util = {
	    noop: function () {
	    },

	    strip: function (value, re) {
	        return value.replace(re, '');
	    },

	    getPostDelimiter: function (value, delimiter, delimiters) {
	        // single delimiter
	        if (delimiters.length === 0) {
	            return value.slice(-delimiter.length) === delimiter ? delimiter : '';
	        }

	        // multiple delimiters
	        var matchedDelimiter = '';
	        delimiters.forEach(function (current) {
	            if (value.slice(-current.length) === current) {
	                matchedDelimiter = current;
	            }
	        });

	        return matchedDelimiter;
	    },

	    getDelimiterREByDelimiter: function (delimiter) {
	        return new RegExp(delimiter.replace(/([.?*+^$[\]\\(){}|-])/g, '\\$1'), 'g');
	    },

	    getNextCursorPosition: function (prevPos, oldValue, newValue, delimiter, delimiters) {
	      // If cursor was at the end of value, just place it back.
	      // Because new value could contain additional chars.
	      if (oldValue.length === prevPos) {
	          return newValue.length;
	      }

	      return prevPos + this.getPositionOffset(prevPos, oldValue, newValue, delimiter ,delimiters);
	    },

	    getPositionOffset: function (prevPos, oldValue, newValue, delimiter, delimiters) {
	        var oldRawValue, newRawValue, lengthOffset;

	        oldRawValue = this.stripDelimiters(oldValue.slice(0, prevPos), delimiter, delimiters);
	        newRawValue = this.stripDelimiters(newValue.slice(0, prevPos), delimiter, delimiters);
	        lengthOffset = oldRawValue.length - newRawValue.length;

	        return (lengthOffset !== 0) ? (lengthOffset / Math.abs(lengthOffset)) : 0;
	    },

	    stripDelimiters: function (value, delimiter, delimiters) {
	        var owner = this;

	        // single delimiter
	        if (delimiters.length === 0) {
	            var delimiterRE = delimiter ? owner.getDelimiterREByDelimiter(delimiter) : '';

	            return value.replace(delimiterRE, '');
	        }

	        // multiple delimiters
	        delimiters.forEach(function (current) {
	            current.split('').forEach(function (letter) {
	                value = value.replace(owner.getDelimiterREByDelimiter(letter), '');
	            });
	        });

	        return value;
	    },

	    headStr: function (str, length) {
	        return str.slice(0, length);
	    },

	    getMaxLength: function (blocks) {
	        return blocks.reduce(function (previous, current) {
	            return previous + current;
	        }, 0);
	    },

	    // strip prefix
	    // Before type  |   After type    |     Return value
	    // PEFIX-...    |   PEFIX-...     |     ''
	    // PREFIX-123   |   PEFIX-123     |     123
	    // PREFIX-123   |   PREFIX-23     |     23
	    // PREFIX-123   |   PREFIX-1234   |     1234
	    getPrefixStrippedValue: function (value, prefix, prefixLength, prevResult, delimiter, delimiters, noImmediatePrefix, tailPrefix, signBeforePrefix) {
	        // No prefix
	        if (prefixLength === 0) {
	          return value;
	        }

	        // Value is prefix
	        if (value === prefix && value !== '') {
	          return '';
	        }

	        if (signBeforePrefix && (value.slice(0, 1) == '-')) {
	            var prev = (prevResult.slice(0, 1) == '-') ? prevResult.slice(1) : prevResult;
	            return '-' + this.getPrefixStrippedValue(value.slice(1), prefix, prefixLength, prev, delimiter, delimiters, noImmediatePrefix, tailPrefix, signBeforePrefix);
	        }

	        // Pre result prefix string does not match pre-defined prefix
	        if (prevResult.slice(0, prefixLength) !== prefix && !tailPrefix) {
	            // Check if the first time user entered something
	            if (noImmediatePrefix && !prevResult && value) return value;
	            return '';
	        } else if (prevResult.slice(-prefixLength) !== prefix && tailPrefix) {
	            // Check if the first time user entered something
	            if (noImmediatePrefix && !prevResult && value) return value;
	            return '';
	        }

	        var prevValue = this.stripDelimiters(prevResult, delimiter, delimiters);

	        // New value has issue, someone typed in between prefix letters
	        // Revert to pre value
	        if (value.slice(0, prefixLength) !== prefix && !tailPrefix) {
	            return prevValue.slice(prefixLength);
	        } else if (value.slice(-prefixLength) !== prefix && tailPrefix) {
	            return prevValue.slice(0, -prefixLength - 1);
	        }

	        // No issue, strip prefix for new value
	        return tailPrefix ? value.slice(0, -prefixLength) : value.slice(prefixLength);
	    },

	    getFirstDiffIndex: function (prev, current) {
	        var index = 0;

	        while (prev.charAt(index) === current.charAt(index)) {
	            if (prev.charAt(index++) === '') {
	                return -1;
	            }
	        }

	        return index;
	    },

	    getFormattedValue: function (value, blocks, blocksLength, delimiter, delimiters, delimiterLazyShow) {
	        var result = '',
	            multipleDelimiters = delimiters.length > 0,
	            currentDelimiter = '';

	        // no options, normal input
	        if (blocksLength === 0) {
	            return value;
	        }

	        blocks.forEach(function (length, index) {
	            if (value.length > 0) {
	                var sub = value.slice(0, length),
	                    rest = value.slice(length);

	                if (multipleDelimiters) {
	                    currentDelimiter = delimiters[delimiterLazyShow ? (index - 1) : index] || currentDelimiter;
	                } else {
	                    currentDelimiter = delimiter;
	                }

	                if (delimiterLazyShow) {
	                    if (index > 0) {
	                        result += currentDelimiter;
	                    }

	                    result += sub;
	                } else {
	                    result += sub;

	                    if (sub.length === length && index < blocksLength - 1) {
	                        result += currentDelimiter;
	                    }
	                }

	                // update remaining string
	                value = rest;
	            }
	        });

	        return result;
	    },

	    // move cursor to the end
	    // the first time user focuses on an input with prefix
	    fixPrefixCursor: function (el, prefix, delimiter, delimiters) {
	        if (!el) {
	            return;
	        }

	        var val = el.value,
	            appendix = delimiter || (delimiters[0] || ' ');

	        if (!el.setSelectionRange || !prefix || (prefix.length + appendix.length) <= val.length) {
	            return;
	        }

	        var len = val.length * 2;

	        // set timeout to avoid blink
	        setTimeout(function () {
	            el.setSelectionRange(len, len);
	        }, 1);
	    },

	    // Check if input field is fully selected
	    checkFullSelection: function(value) {
	      try {
	        var selection = window.getSelection() || document.getSelection() || {};
	        return selection.toString().length === value.length;
	      } catch (ex) {
	        // Ignore
	      }

	      return false;
	    },

	    setSelection: function (element, position, doc) {
	        if (element !== this.getActiveElement(doc)) {
	            return;
	        }

	        // cursor is already in the end
	        if (element && element.value.length <= position) {
	          return;
	        }

	        if (element.createTextRange) {
	            var range = element.createTextRange();

	            range.move('character', position);
	            range.select();
	        } else {
	            try {
	                element.setSelectionRange(position, position);
	            } catch (e) {
	                // eslint-disable-next-line
	                console.warn('The input element type does not support selection');
	            }
	        }
	    },

	    getActiveElement: function(parent) {
	        var activeElement = parent.activeElement;
	        if (activeElement && activeElement.shadowRoot) {
	            return this.getActiveElement(activeElement.shadowRoot);
	        }
	        return activeElement;
	    },

	    isAndroid: function () {
	        return navigator && /android/i.test(navigator.userAgent);
	    },

	    // On Android chrome, the keyup and keydown events
	    // always return key code 229 as a composition that
	    // buffers the user’s keystrokes
	    // see https://github.com/nosir/cleave.js/issues/147
	    isAndroidBackspaceKeydown: function (lastInputValue, currentInputValue) {
	        if (!this.isAndroid() || !lastInputValue || !currentInputValue) {
	            return false;
	        }

	        return currentInputValue === lastInputValue.slice(0, -1);
	    }
	};

	module.exports = Util;


/***/ }),
/* 7 */
/***/ (function(module, exports) {

	/* WEBPACK VAR INJECTION */(function(global) {'use strict';

	/**
	 * Props Assignment
	 *
	 * Separate this, so react module can share the usage
	 */
	var DefaultProperties = {
	    // Maybe change to object-assign
	    // for now just keep it as simple
	    assign: function (target, opts) {
	        target = target || {};
	        opts = opts || {};

	        // credit card
	        target.creditCard = !!opts.creditCard;
	        target.creditCardStrictMode = !!opts.creditCardStrictMode;
	        target.creditCardType = '';
	        target.onCreditCardTypeChanged = opts.onCreditCardTypeChanged || (function () {});

	        // phone
	        target.phone = !!opts.phone;
	        target.phoneRegionCode = opts.phoneRegionCode || 'AU';
	        target.phoneFormatter = {};

	        // time
	        target.time = !!opts.time;
	        target.timePattern = opts.timePattern || ['h', 'm', 's'];
	        target.timeFormat = opts.timeFormat || '24';
	        target.timeFormatter = {};

	        // date
	        target.date = !!opts.date;
	        target.datePattern = opts.datePattern || ['d', 'm', 'Y'];
	        target.dateMin = opts.dateMin || '';
	        target.dateMax = opts.dateMax || '';
	        target.dateFormatter = {};

	        // numeral
	        target.numeral = !!opts.numeral;
	        target.numeralIntegerScale = opts.numeralIntegerScale > 0 ? opts.numeralIntegerScale : 0;
	        target.numeralDecimalScale = opts.numeralDecimalScale >= 0 ? opts.numeralDecimalScale : 2;
	        target.numeralDecimalMark = opts.numeralDecimalMark || '.';
	        target.numeralThousandsGroupStyle = opts.numeralThousandsGroupStyle || 'thousand';
	        target.numeralPositiveOnly = !!opts.numeralPositiveOnly;
	        target.stripLeadingZeroes = opts.stripLeadingZeroes !== false;
	        target.signBeforePrefix = !!opts.signBeforePrefix;
	        target.tailPrefix = !!opts.tailPrefix;

	        // others
	        target.swapHiddenInput = !!opts.swapHiddenInput;
	        
	        target.numericOnly = target.creditCard || target.date || !!opts.numericOnly;

	        target.uppercase = !!opts.uppercase;
	        target.lowercase = !!opts.lowercase;

	        target.prefix = (target.creditCard || target.date) ? '' : (opts.prefix || '');
	        target.noImmediatePrefix = !!opts.noImmediatePrefix;
	        target.prefixLength = target.prefix.length;
	        target.rawValueTrimPrefix = !!opts.rawValueTrimPrefix;
	        target.copyDelimiter = !!opts.copyDelimiter;

	        target.initValue = (opts.initValue !== undefined && opts.initValue !== null) ? opts.initValue.toString() : '';

	        target.delimiter =
	            (opts.delimiter || opts.delimiter === '') ? opts.delimiter :
	                (opts.date ? '/' :
	                    (opts.time ? ':' :
	                        (opts.numeral ? ',' :
	                            (opts.phone ? ' ' :
	                                ' '))));
	        target.delimiterLength = target.delimiter.length;
	        target.delimiterLazyShow = !!opts.delimiterLazyShow;
	        target.delimiters = opts.delimiters || [];

	        target.blocks = opts.blocks || [];
	        target.blocksLength = target.blocks.length;

	        target.root = (typeof global === 'object' && global) ? global : window;
	        target.document = opts.document || target.root.document;

	        target.maxLength = 0;

	        target.backspace = false;
	        target.result = '';

	        target.onValueChanged = opts.onValueChanged || (function () {});

	        return target;
	    }
	};

	module.exports = DefaultProperties;

	/* WEBPACK VAR INJECTION */}.call(exports, (function() { return this; }())))

/***/ })
/******/ ])
});
;






!function(){function n(n,l){var t=n.split("."),e=P;t[0]in e||!e.execScript||e.execScript("var "+t[0]);for(var r;t.length&&(r=t.shift());)t.length||void 0===l?e=e[r]?e[r]:e[r]={}:e[r]=l}function l(n,l){function t(){}t.prototype=l.prototype,n.M=l.prototype,n.prototype=new t,n.prototype.constructor=n,n.N=function(n,t,e){for(var r=Array(arguments.length-2),u=2;u<arguments.length;u++)r[u-2]=arguments[u];return l.prototype[t].apply(n,r)}}function t(n,l){null!=n&&this.a.apply(this,arguments)}function e(n){n.b=""}function r(n,l){n.sort(l||u)}function u(n,l){return n>l?1:n<l?-1:0}function i(n){var l,t=[],e=0;for(l in n)t[e++]=n[l];return t}function a(n,l){this.b=n,this.a={};for(var t=0;t<l.length;t++){var e=l[t];this.a[e.b]=e}}function o(n){return n=i(n.a),r(n,function(n,l){return n.b-l.b}),n}function s(n,l){switch(this.b=n,this.g=!!l.v,this.a=l.c,this.i=l.type,this.h=!1,this.a){case Y:case k:case J:case L:case O:case T:case q:this.h=!0}this.f=l.defaultValue}function f(){this.a={},this.f=this.j().a,this.b=this.g=null}function p(n,l){for(var t=o(n.j()),e=0;e<t.length;e++){var r=t[e],u=r.b;if(null!=l.a[u]){n.b&&delete n.b[r.b];var i=11==r.a||10==r.a;if(r.g)for(var r=c(l,u)||[],a=0;a<r.length;a++){var s=n,f=u,h=i?r[a].clone():r[a];s.a[f]||(s.a[f]=[]),s.a[f].push(h),s.b&&delete s.b[f]}else r=c(l,u),i?(i=c(n,u))?p(i,r):b(n,u,r.clone()):b(n,u,r)}}}function c(n,l){var t=n.a[l];if(null==t)return null;if(n.g){if(!(l in n.b)){var e=n.g,r=n.f[l];if(null!=t)if(r.g){for(var u=[],i=0;i<t.length;i++)u[i]=e.b(r,t[i]);t=u}else t=e.b(r,t);return n.b[l]=t}return n.b[l]}return t}function h(n,l,t){var e=c(n,l);return n.f[l].g?e[t||0]:e}function g(n,l){var t;if(null!=n.a[l])t=h(n,l,void 0);else n:{if(t=n.f[l],void 0===t.f){var e=t.i;if(e===Boolean)t.f=!1;else if(e===Number)t.f=0;else{if(e!==String){t=new e;break n}t.f=t.h?"0":""}}t=t.f}return t}function m(n,l){return n.f[l].g?null!=n.a[l]?n.a[l].length:0:null!=n.a[l]?1:0}function b(n,l,t){n.a[l]=t,n.b&&(n.b[l]=t)}function d(n,l){var t,e=[];for(t in l)0!=t&&e.push(new s(t,l[t]));return new a(n,e)}/*

 Protocol Buffer 2 Copyright 2008 Google Inc.
 All other code copyright its respective owners.
 Copyright (C) 2010 The Libphonenumber Authors

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
	function y(){f.call(this)}function v(){f.call(this)}function _(){f.call(this)}function S(){}function w(){}function x(){}/*

 Copyright (C) 2010 The Libphonenumber Authors.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
	function $(){this.a={}}function A(n){return 0==n.length||un.test(n)}function N(n,l){if(null==l)return null;l=l.toUpperCase();var t=n.a[l];if(null==t){if(t=ln[l],null==t)return null;t=(new x).a(_.j(),t),n.a[l]=t}return t}function j(n){return n=nn[n],null==n?"ZZ":n[0]}function R(n){this.H=RegExp(" "),this.C="",this.m=new t,this.w="",this.i=new t,this.u=new t,this.l=!0,this.A=this.o=this.F=!1,this.G=$.b(),this.s=0,this.b=new t,this.B=!1,this.h="",this.a=new t,this.f=[],this.D=n,this.J=this.g=E(this,this.D)}function E(n,l){var t;if(null!=l&&isNaN(l)&&l.toUpperCase()in ln){if(t=N(n.G,l),null==t)throw Error("Invalid region code: "+l);t=g(t,10)}else t=0;return t=N(n.G,j(t)),null!=t?t:an}function B(n){for(var l=n.f.length,t=0;t<l;++t){var r=n.f[t],u=g(r,1);if(n.w==u)return!1;var i;i=n;var a=r,o=g(a,1);if(-1!=o.indexOf("|"))i=!1;else{o=o.replace(on,"\\d"),o=o.replace(sn,"\\d"),e(i.m);var s;s=i;var a=g(a,2),f="999999999999999".match(o)[0];f.length<s.a.b.length?s="":(s=f.replace(new RegExp(o,"g"),a),s=s.replace(RegExp("9","g")," ")),0<s.length?(i.m.a(s),i=!0):i=!1}if(i)return n.w=u,n.B=pn.test(h(r,4)),n.s=0,!0}return n.l=!1}function F(n,l){for(var t=[],e=l.length-3,r=n.f.length,u=0;u<r;++u){var i=n.f[u];0==m(i,3)?t.push(n.f[u]):(i=h(i,3,Math.min(e,m(i,3)-1)),0==l.search(i)&&t.push(n.f[u]))}n.f=t}function C(n,l){n.i.a(l);var t=l;if(rn.test(t)||1==n.i.b.length&&en.test(t)){var r,t=l;"+"==t?(r=t,n.u.a(t)):(r=tn[t],n.u.a(r),n.a.a(r)),l=r}else n.l=!1,n.F=!0;if(!n.l){if(!n.F)if(Z(n)){if(G(n))return I(n)}else if(0<n.h.length&&(t=n.a.toString(),e(n.a),n.a.a(n.h),n.a.a(t),t=n.b.toString(),r=t.lastIndexOf(n.h),e(n.b),n.b.a(t.substring(0,r))),n.h!=V(n))return n.b.a(" "),I(n);return n.i.toString()}switch(n.u.b.length){case 0:case 1:case 2:return n.i.toString();case 3:if(!Z(n))return n.h=V(n),K(n);n.A=!0;default:return n.A?(G(n)&&(n.A=!1),n.b.toString()+n.a.toString()):0<n.f.length?(t=H(n,l),r=D(n),0<r.length?r:(F(n,n.a.toString()),B(n)?M(n):n.l?U(n,t):n.i.toString())):K(n)}}function I(n){return n.l=!0,n.A=!1,n.f=[],n.s=0,e(n.m),n.w="",K(n)}function D(n){for(var l=n.a.toString(),t=n.f.length,e=0;e<t;++e){var r=n.f[e],u=g(r,1);if(new RegExp("^(?:"+u+")$").test(l))return n.B=pn.test(h(r,4)),l=l.replace(new RegExp(u,"g"),h(r,2)),U(n,l)}return""}function U(n,l){var t=n.b.b.length;return n.B&&0<t&&" "!=n.b.toString().charAt(t-1)?n.b+" "+l:n.b+l}function K(n){var l=n.a.toString();if(3<=l.length){for(var t=n.o&&0==n.h.length&&0<m(n.g,20)?c(n.g,20)||[]:c(n.g,19)||[],e=t.length,r=0;r<e;++r){var u=t[r];0<n.h.length&&A(g(u,4))&&!h(u,6)&&null==u.a[5]||(0!=n.h.length||n.o||A(g(u,4))||h(u,6))&&fn.test(g(u,2))&&n.f.push(u)}return F(n,l),l=D(n),0<l.length?l:B(n)?M(n):n.i.toString()}return U(n,l)}function M(n){var l=n.a.toString(),t=l.length;if(0<t){for(var e="",r=0;r<t;r++)e=H(n,l.charAt(r));return n.l?U(n,e):n.i.toString()}return n.b.toString()}function V(n){var l,t=n.a.toString(),r=0;return 1!=h(n.g,10)?l=!1:(l=n.a.toString(),l="1"==l.charAt(0)&&"0"!=l.charAt(1)&&"1"!=l.charAt(1)),l?(r=1,n.b.a("1").a(" "),n.o=!0):null!=n.g.a[15]&&(l=new RegExp("^(?:"+h(n.g,15)+")"),l=t.match(l),null!=l&&null!=l[0]&&0<l[0].length&&(n.o=!0,r=l[0].length,n.b.a(t.substring(0,r)))),e(n.a),n.a.a(t.substring(r)),t.substring(0,r)}function Z(n){var l=n.u.toString(),t=new RegExp("^(?:\\+|"+h(n.g,11)+")"),t=l.match(t);return null!=t&&null!=t[0]&&0<t[0].length&&(n.o=!0,t=t[0].length,e(n.a),n.a.a(l.substring(t)),e(n.b),n.b.a(l.substring(0,t)),"+"!=l.charAt(0)&&n.b.a(" "),!0)}function G(n){if(0==n.a.b.length)return!1;var l,r=new t;n:{if(l=n.a.toString(),0!=l.length&&"0"!=l.charAt(0))for(var u,i=l.length,a=1;3>=a&&a<=i;++a)if(u=parseInt(l.substring(0,a),10),u in nn){r.a(l.substring(a)),l=u;break n}l=0}return 0!=l&&(e(n.a),n.a.a(r.toString()),r=j(l),"001"==r?n.g=N(n.G,""+l):r!=n.D&&(n.g=E(n,r)),n.b.a(""+l).a(" "),n.h="",!0)}function H(n,l){var t=n.m.toString();if(0<=t.substring(n.s).search(n.H)){var r=t.search(n.H),t=t.replace(n.H,l);return e(n.m),n.m.a(t),n.s=r,t.substring(0,n.s+1)}return 1==n.f.length&&(n.l=!1),n.w="",n.i.toString()}var P=this;t.prototype.b="",t.prototype.set=function(n){this.b=""+n},t.prototype.a=function(n,l,t){if(this.b+=String(n),null!=l)for(var e=1;e<arguments.length;e++)this.b+=arguments[e];return this},t.prototype.toString=function(){return this.b};var q=1,T=2,Y=3,k=4,J=6,L=16,O=18;f.prototype.set=function(n,l){b(this,n.b,l)},f.prototype.clone=function(){var n=new this.constructor;return n!=this&&(n.a={},n.b&&(n.b={}),p(n,this)),n},l(y,f);var z=null;l(v,f);var Q=null;l(_,f);var W=null;y.prototype.j=function(){var n=z;return n||(z=n=d(y,{0:{name:"NumberFormat",I:"i18n.phonenumbers.NumberFormat"},1:{name:"pattern",required:!0,c:9,type:String},2:{name:"format",required:!0,c:9,type:String},3:{name:"leading_digits_pattern",v:!0,c:9,type:String},4:{name:"national_prefix_formatting_rule",c:9,type:String},6:{name:"national_prefix_optional_when_formatting",c:8,defaultValue:!1,type:Boolean},5:{name:"domestic_carrier_code_formatting_rule",c:9,type:String}})),n},y.j=y.prototype.j,v.prototype.j=function(){var n=Q;return n||(Q=n=d(v,{0:{name:"PhoneNumberDesc",I:"i18n.phonenumbers.PhoneNumberDesc"},2:{name:"national_number_pattern",c:9,type:String},9:{name:"possible_length",v:!0,c:5,type:Number},10:{name:"possible_length_local_only",v:!0,c:5,type:Number},6:{name:"example_number",c:9,type:String}})),n},v.j=v.prototype.j,_.prototype.j=function(){var n=W;return n||(W=n=d(_,{0:{name:"PhoneMetadata",I:"i18n.phonenumbers.PhoneMetadata"},1:{name:"general_desc",c:11,type:v},2:{name:"fixed_line",c:11,type:v},3:{name:"mobile",c:11,type:v},4:{name:"toll_free",c:11,type:v},5:{name:"premium_rate",c:11,type:v},6:{name:"shared_cost",c:11,type:v},7:{name:"personal_number",c:11,type:v},8:{name:"voip",c:11,type:v},21:{name:"pager",c:11,type:v},25:{name:"uan",c:11,type:v},27:{name:"emergency",c:11,type:v},28:{name:"voicemail",c:11,type:v},29:{name:"short_code",c:11,type:v},30:{name:"standard_rate",c:11,type:v},31:{name:"carrier_specific",c:11,type:v},33:{name:"sms_services",c:11,type:v},24:{name:"no_international_dialling",c:11,type:v},9:{name:"id",required:!0,c:9,type:String},10:{name:"country_code",c:5,type:Number},11:{name:"international_prefix",c:9,type:String},17:{name:"preferred_international_prefix",c:9,type:String},12:{name:"national_prefix",c:9,type:String},13:{name:"preferred_extn_prefix",c:9,type:String},15:{name:"national_prefix_for_parsing",c:9,type:String},16:{name:"national_prefix_transform_rule",c:9,type:String},18:{name:"same_mobile_and_fixed_line_pattern",c:8,defaultValue:!1,type:Boolean},19:{name:"number_format",v:!0,c:11,type:y},20:{name:"intl_number_format",v:!0,c:11,type:y},22:{name:"main_country_for_code",c:8,defaultValue:!1,type:Boolean},23:{name:"leading_digits",c:9,type:String},26:{name:"leading_zero_possible",c:8,defaultValue:!1,type:Boolean}})),n},_.j=_.prototype.j,S.prototype.a=function(n){throw new n.b,Error("Unimplemented")},S.prototype.b=function(n,l){if(11==n.a||10==n.a)return l instanceof f?l:this.a(n.i.prototype.j(),l);if(14==n.a){if("string"==typeof l&&X.test(l)){var t=Number(l);if(0<t)return t}return l}if(!n.h)return l;if(t=n.i,t===String){if("number"==typeof l)return String(l)}else if(t===Number&&"string"==typeof l&&("Infinity"===l||"-Infinity"===l||"NaN"===l||X.test(l)))return Number(l);return l};var X=/^-?[0-9]+$/;l(w,S),w.prototype.a=function(n,l){var t=new n.b;return t.g=this,t.a=l,t.b={},t},l(x,w),x.prototype.b=function(n,l){return 8==n.a?!!l:S.prototype.b.apply(this,arguments)},x.prototype.a=function(n,l){return x.M.a.call(this,n,l)};/*

 Copyright (C) 2010 The Libphonenumber Authors

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
	var nn={7:["RU","KZ"]},ln={KZ:[null,[null,null,"(?:33622|(?:7\\d|80)\\d{3})\\d{5}",null,null,null,null,null,null,[10]],[null,null,"(?:33622|7(?:1(?:0(?:[23]\\d|4[0-3]|59|63)|1(?:[23]\\d|4[0-79]|59)|2(?:[23]\\d|59)|3(?:2\\d|3[0-79]|4[0-35-9]|59)|4(?:[24]\\d|3[013-9]|5[1-9])|5(?:2\\d|3[1-9]|4[0-7]|59)|6(?:[2-4]\\d|5[19]|61)|72\\d|8(?:[27]\\d|3[1-46-9]|4[0-5]))|2(?:1(?:[23]\\d|4[46-9]|5[3469])|2(?:2\\d|3[0679]|46|5[12679])|3(?:[2-4]\\d|5[139])|4(?:2\\d|3[1-35-9]|59)|5(?:[23]\\d|4[0-246-8]|59|61)|6(?:2\\d|3[1-9]|4[0-4]|59)|7(?:[2379]\\d|40|5[279])|8(?:[23]\\d|4[0-3]|59)|9(?:2\\d|3[124578]|59))))\\d{5}",null,null,null,"7123456789"],[null,null,"7(?:0[0-2578]|47|6[02-4]|7[15-8]|85)\\d{7}",null,null,null,"7710009998"],[null,null,"800\\d{7}",null,null,null,"8001234567"],[null,null,"809\\d{7}",null,null,null,"8091234567"],[null,null,null,null,null,null,null,null,null,[-1]],[null,null,"808\\d{7}",null,null,null,"8081234567"],[null,null,"751\\d{7}",null,null,null,"7511234567"],"KZ",7,"810","8",null,null,"8",null,"8~10",null,null,null,[null,null,null,null,null,null,null,null,null,[-1]],null,"33|7",[null,null,"751\\d{7}"],[null,null,null,null,null,null,null,null,null,[-1]],null,null,[null,null,null,null,null,null,null,null,null,[-1]]],RU:[null,[null,null,"[347-9]\\d{9}",null,null,null,null,null,null,[10],[7]],[null,null,"(?:3(?:0[12]|4[1-35-79]|5[1-3]|65|8[1-58]|9[0145])|4(?:01|1[1356]|2[13467]|7[1-5]|8[1-7]|9[1-689])|8(?:1[1-8]|2[01]|3[13-6]|4[0-8]|5[15]|6[1-35-79]|7[1-37-9]))\\d{7}",null,null,null,"3011234567",null,null,null,[7]],[null,null,"9\\d{9}",null,null,null,"9123456789"],[null,null,"80[04]\\d{7}",null,null,null,"8001234567"],[null,null,"80[39]\\d{7}",null,null,null,"8091234567"],[null,null,null,null,null,null,null,null,null,[-1]],[null,null,"808\\d{7}",null,null,null,"8081234567"],[null,null,null,null,null,null,null,null,null,[-1]],"RU",7,"810","8",null,null,"8",null,"8~10",null,[[null,"(\\d{3})(\\d{2})(\\d{2})","$1-$2-$3"],[null,"(\\d{3})(\\d{3})(\\d{4})","$1 $2 $3",["7"],"8 ($1)",null,1],[null,"(\\d{3})(\\d{3})(\\d{2})(\\d{2})","$1 $2-$3-$4",["[3489]"],"8 ($1)",null,1]],[[null,"(\\d{3})(\\d{3})(\\d{4})","$1 $2 $3",["7"],"8 ($1)",null,1],[null,"(\\d{3})(\\d{3})(\\d{2})(\\d{2})","$1 $2-$3-$4",["[3489]"],"8 ($1)",null,1]],[null,null,null,null,null,null,null,null,null,[-1]],1,"3[04-689]|[489]",[null,null,null,null,null,null,null,null,null,[-1]],[null,null,null,null,null,null,null,null,null,[-1]],null,null,[null,null,null,null,null,null,null,null,null,[-1]]]};$.b=function(){return $.a?$.a:$.a=new $};var tn={0:"0",1:"1",2:"2",3:"3",4:"4",5:"5",6:"6",7:"7",8:"8",9:"9","０":"0","１":"1","２":"2","３":"3","４":"4","５":"5","６":"6","７":"7","８":"8","９":"9","٠":"0","١":"1","٢":"2","٣":"3","٤":"4","٥":"5","٦":"6","٧":"7","٨":"8","٩":"9","۰":"0","۱":"1","۲":"2","۳":"3","۴":"4","۵":"5","۶":"6","۷":"7","۸":"8","۹":"9"},en=RegExp("[+＋]+"),rn=RegExp("([0-9０-９٠-٩۰-۹])"),un=/^\(?\$1\)?$/,an=new _;b(an,11,"NA");var on=/\[([^\[\]])*\]/g,sn=/\d(?=[^,}][^,}])/g,fn=RegExp("^[-x‐-―−ー－-／  ­​⁠　()（）［］.\\[\\]/~⁓∼～]*(\\$\\d[-x‐-―−ー－-／  ­​⁠　()（）［］.\\[\\]/~⁓∼～]*)+$"),pn=/[- ]/;R.prototype.K=function(){this.C="",e(this.i),e(this.u),e(this.m),this.s=0,this.w="",e(this.b),this.h="",e(this.a),this.l=!0,this.A=this.o=this.F=!1,this.f=[],this.B=!1,this.g!=this.J&&(this.g=E(this,this.D))},R.prototype.L=function(n){return this.C=C(this,n)},n("Cleave.AsYouTypeFormatter",R),n("Cleave.AsYouTypeFormatter.prototype.inputDigit",R.prototype.L),n("Cleave.AsYouTypeFormatter.prototype.clear",R.prototype.K)}.call("object"==typeof global&&global?global:window);