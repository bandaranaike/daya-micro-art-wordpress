!function(){"use strict";var t={2819:function(t){t.exports=window.lodash},4981:function(t){t.exports=window.wp.blocks},9818:function(t){t.exports=window.wp.data},5736:function(t){t.exports=window.wp.i18n}},e={};function n(r){var i=e[r];if(void 0!==i)return i.exports;var o=e[r]={exports:{}};return t[r](o,o.exports,n),o.exports}n.d=function(t,e){for(var r in e)n.o(e,r)&&!n.o(t,r)&&Object.defineProperty(t,r,{enumerable:!0,get:e[r]})},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)};var r={};!function(){n.d(r,{CP:function(){return o}});var t=n(2819),e=n(9818),i=n(4981);function o(e,n){return{function:t.isFunction,date:t.isDate,array:t.isArray,object:t.isPlainObject,string:t.isString,undefined:t.isUndefined,null:t.isNull,number:t.isNumber,boolean:t.isBoolean}[n](e)}window.isAttributeUpdated=function(n,r){const s=(0,e.select)("core/block-editor").getBlock(r);if(!s)return!1;const u=(0,i.getBlockType)(s.name),c=(0,t.has)(u.attributes,[n,"default"]),a=(0,t.get)(s.attributes,n);if(!c)return o(a,(0,t.get)(u.attributes,[n,"type"]));const d=(0,t.get)(u.attributes,[n,"default"]);return!(0,t.isEqual)(d,a)},n(5736),(0,t.memoize)((()=>{const e=(0,t.get)(window,"blockslider.isPremium",!1);return!!(0,t.get)(window,"isCypressRunning23214321423423",!1)||"1"===e||!0===e}))}()}();