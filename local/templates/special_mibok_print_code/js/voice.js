/*! jQuery UI - v1.11.4 - 2015-12-18
* http://jqueryui.com
* Includes: core.js, widget.js, mouse.js, slider.js
* Copyright jQuery Foundation and other contributors; Licensed MIT */

(function(e){"function"==typeof define&&define.amd?define(["jquery"],e):e(jQuery)})(function(e){function t(t,s){var n,a,o,r=t.nodeName.toLowerCase();return"area"===r?(n=t.parentNode,a=n.name,t.href&&a&&"map"===n.nodeName.toLowerCase()?(o=e("img[usemap='#"+a+"']")[0],!!o&&i(o)):!1):(/^(input|select|textarea|button|object)$/.test(r)?!t.disabled:"a"===r?t.href||s:s)&&i(t)}function i(t){return e.expr.filters.visible(t)&&!e(t).parents().addBack().filter(function(){return"hidden"===e.css(this,"visibility")}).length}e.ui=e.ui||{},e.extend(e.ui,{version:"1.11.4",keyCode:{BACKSPACE:8,COMMA:188,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,LEFT:37,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SPACE:32,TAB:9,UP:38}}),e.fn.extend({scrollParent:function(t){var i=this.css("position"),s="absolute"===i,n=t?/(auto|scroll|hidden)/:/(auto|scroll)/,a=this.parents().filter(function(){var t=e(this);return s&&"static"===t.css("position")?!1:n.test(t.css("overflow")+t.css("overflow-y")+t.css("overflow-x"))}).eq(0);return"fixed"!==i&&a.length?a:e(this[0].ownerDocument||document)},uniqueId:function(){var e=0;return function(){return this.each(function(){this.id||(this.id="ui-id-"+ ++e)})}}(),removeUniqueId:function(){return this.each(function(){/^ui-id-\d+$/.test(this.id)&&e(this).removeAttr("id")})}}),e.extend(e.expr[":"],{data:e.expr.createPseudo?e.expr.createPseudo(function(t){return function(i){return!!e.data(i,t)}}):function(t,i,s){return!!e.data(t,s[3])},focusable:function(i){return t(i,!isNaN(e.attr(i,"tabindex")))},tabbable:function(i){var s=e.attr(i,"tabindex"),n=isNaN(s);return(n||s>=0)&&t(i,!n)}}),e("<a>").outerWidth(1).jquery||e.each(["Width","Height"],function(t,i){function s(t,i,s,a){return e.each(n,function(){i-=parseFloat(e.css(t,"padding"+this))||0,s&&(i-=parseFloat(e.css(t,"border"+this+"Width"))||0),a&&(i-=parseFloat(e.css(t,"margin"+this))||0)}),i}var n="Width"===i?["Left","Right"]:["Top","Bottom"],a=i.toLowerCase(),o={innerWidth:e.fn.innerWidth,innerHeight:e.fn.innerHeight,outerWidth:e.fn.outerWidth,outerHeight:e.fn.outerHeight};e.fn["inner"+i]=function(t){return void 0===t?o["inner"+i].call(this):this.each(function(){e(this).css(a,s(this,t)+"px")})},e.fn["outer"+i]=function(t,n){return"number"!=typeof t?o["outer"+i].call(this,t):this.each(function(){e(this).css(a,s(this,t,!0,n)+"px")})}}),e.fn.addBack||(e.fn.addBack=function(e){return this.add(null==e?this.prevObject:this.prevObject.filter(e))}),e("<a>").data("a-b","a").removeData("a-b").data("a-b")&&(e.fn.removeData=function(t){return function(i){return arguments.length?t.call(this,e.camelCase(i)):t.call(this)}}(e.fn.removeData)),e.ui.ie=!!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()),e.fn.extend({focus:function(t){return function(i,s){return"number"==typeof i?this.each(function(){var t=this;setTimeout(function(){e(t).focus(),s&&s.call(t)},i)}):t.apply(this,arguments)}}(e.fn.focus),disableSelection:function(){var e="onselectstart"in document.createElement("div")?"selectstart":"mousedown";return function(){return this.bind(e+".ui-disableSelection",function(e){e.preventDefault()})}}(),enableSelection:function(){return this.unbind(".ui-disableSelection")},zIndex:function(t){if(void 0!==t)return this.css("zIndex",t);if(this.length)for(var i,s,n=e(this[0]);n.length&&n[0]!==document;){if(i=n.css("position"),("absolute"===i||"relative"===i||"fixed"===i)&&(s=parseInt(n.css("zIndex"),10),!isNaN(s)&&0!==s))return s;n=n.parent()}return 0}}),e.ui.plugin={add:function(t,i,s){var n,a=e.ui[t].prototype;for(n in s)a.plugins[n]=a.plugins[n]||[],a.plugins[n].push([i,s[n]])},call:function(e,t,i,s){var n,a=e.plugins[t];if(a&&(s||e.element[0].parentNode&&11!==e.element[0].parentNode.nodeType))for(n=0;a.length>n;n++)e.options[a[n][0]]&&a[n][1].apply(e.element,i)}};var s=0,n=Array.prototype.slice;e.cleanData=function(t){return function(i){var s,n,a;for(a=0;null!=(n=i[a]);a++)try{s=e._data(n,"events"),s&&s.remove&&e(n).triggerHandler("remove")}catch(o){}t(i)}}(e.cleanData),e.widget=function(t,i,s){var n,a,o,r,h={},l=t.split(".")[0];return t=t.split(".")[1],n=l+"-"+t,s||(s=i,i=e.Widget),e.expr[":"][n.toLowerCase()]=function(t){return!!e.data(t,n)},e[l]=e[l]||{},a=e[l][t],o=e[l][t]=function(e,t){return this._createWidget?(arguments.length&&this._createWidget(e,t),void 0):new o(e,t)},e.extend(o,a,{version:s.version,_proto:e.extend({},s),_childConstructors:[]}),r=new i,r.options=e.widget.extend({},r.options),e.each(s,function(t,s){return e.isFunction(s)?(h[t]=function(){var e=function(){return i.prototype[t].apply(this,arguments)},n=function(e){return i.prototype[t].apply(this,e)};return function(){var t,i=this._super,a=this._superApply;return this._super=e,this._superApply=n,t=s.apply(this,arguments),this._super=i,this._superApply=a,t}}(),void 0):(h[t]=s,void 0)}),o.prototype=e.widget.extend(r,{widgetEventPrefix:a?r.widgetEventPrefix||t:t},h,{constructor:o,namespace:l,widgetName:t,widgetFullName:n}),a?(e.each(a._childConstructors,function(t,i){var s=i.prototype;e.widget(s.namespace+"."+s.widgetName,o,i._proto)}),delete a._childConstructors):i._childConstructors.push(o),e.widget.bridge(t,o),o},e.widget.extend=function(t){for(var i,s,a=n.call(arguments,1),o=0,r=a.length;r>o;o++)for(i in a[o])s=a[o][i],a[o].hasOwnProperty(i)&&void 0!==s&&(t[i]=e.isPlainObject(s)?e.isPlainObject(t[i])?e.widget.extend({},t[i],s):e.widget.extend({},s):s);return t},e.widget.bridge=function(t,i){var s=i.prototype.widgetFullName||t;e.fn[t]=function(a){var o="string"==typeof a,r=n.call(arguments,1),h=this;return o?this.each(function(){var i,n=e.data(this,s);return"instance"===a?(h=n,!1):n?e.isFunction(n[a])&&"_"!==a.charAt(0)?(i=n[a].apply(n,r),i!==n&&void 0!==i?(h=i&&i.jquery?h.pushStack(i.get()):i,!1):void 0):e.error("no such method '"+a+"' for "+t+" widget instance"):e.error("cannot call methods on "+t+" prior to initialization; "+"attempted to call method '"+a+"'")}):(r.length&&(a=e.widget.extend.apply(null,[a].concat(r))),this.each(function(){var t=e.data(this,s);t?(t.option(a||{}),t._init&&t._init()):e.data(this,s,new i(a,this))})),h}},e.Widget=function(){},e.Widget._childConstructors=[],e.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",defaultElement:"<div>",options:{disabled:!1,create:null},_createWidget:function(t,i){i=e(i||this.defaultElement||this)[0],this.element=e(i),this.uuid=s++,this.eventNamespace="."+this.widgetName+this.uuid,this.bindings=e(),this.hoverable=e(),this.focusable=e(),i!==this&&(e.data(i,this.widgetFullName,this),this._on(!0,this.element,{remove:function(e){e.target===i&&this.destroy()}}),this.document=e(i.style?i.ownerDocument:i.document||i),this.window=e(this.document[0].defaultView||this.document[0].parentWindow)),this.options=e.widget.extend({},this.options,this._getCreateOptions(),t),this._create(),this._trigger("create",null,this._getCreateEventData()),this._init()},_getCreateOptions:e.noop,_getCreateEventData:e.noop,_create:e.noop,_init:e.noop,destroy:function(){this._destroy(),this.element.unbind(this.eventNamespace).removeData(this.widgetFullName).removeData(e.camelCase(this.widgetFullName)),this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName+"-disabled "+"ui-state-disabled"),this.bindings.unbind(this.eventNamespace),this.hoverable.removeClass("ui-state-hover"),this.focusable.removeClass("ui-state-focus")},_destroy:e.noop,widget:function(){return this.element},option:function(t,i){var s,n,a,o=t;if(0===arguments.length)return e.widget.extend({},this.options);if("string"==typeof t)if(o={},s=t.split("."),t=s.shift(),s.length){for(n=o[t]=e.widget.extend({},this.options[t]),a=0;s.length-1>a;a++)n[s[a]]=n[s[a]]||{},n=n[s[a]];if(t=s.pop(),1===arguments.length)return void 0===n[t]?null:n[t];n[t]=i}else{if(1===arguments.length)return void 0===this.options[t]?null:this.options[t];o[t]=i}return this._setOptions(o),this},_setOptions:function(e){var t;for(t in e)this._setOption(t,e[t]);return this},_setOption:function(e,t){return this.options[e]=t,"disabled"===e&&(this.widget().toggleClass(this.widgetFullName+"-disabled",!!t),t&&(this.hoverable.removeClass("ui-state-hover"),this.focusable.removeClass("ui-state-focus"))),this},enable:function(){return this._setOptions({disabled:!1})},disable:function(){return this._setOptions({disabled:!0})},_on:function(t,i,s){var n,a=this;"boolean"!=typeof t&&(s=i,i=t,t=!1),s?(i=n=e(i),this.bindings=this.bindings.add(i)):(s=i,i=this.element,n=this.widget()),e.each(s,function(s,o){function r(){return t||a.options.disabled!==!0&&!e(this).hasClass("ui-state-disabled")?("string"==typeof o?a[o]:o).apply(a,arguments):void 0}"string"!=typeof o&&(r.guid=o.guid=o.guid||r.guid||e.guid++);var h=s.match(/^([\w:-]*)\s*(.*)$/),l=h[1]+a.eventNamespace,u=h[2];u?n.delegate(u,l,r):i.bind(l,r)})},_off:function(t,i){i=(i||"").split(" ").join(this.eventNamespace+" ")+this.eventNamespace,t.unbind(i).undelegate(i),this.bindings=e(this.bindings.not(t).get()),this.focusable=e(this.focusable.not(t).get()),this.hoverable=e(this.hoverable.not(t).get())},_delay:function(e,t){function i(){return("string"==typeof e?s[e]:e).apply(s,arguments)}var s=this;return setTimeout(i,t||0)},_hoverable:function(t){this.hoverable=this.hoverable.add(t),this._on(t,{mouseenter:function(t){e(t.currentTarget).addClass("ui-state-hover")},mouseleave:function(t){e(t.currentTarget).removeClass("ui-state-hover")}})},_focusable:function(t){this.focusable=this.focusable.add(t),this._on(t,{focusin:function(t){e(t.currentTarget).addClass("ui-state-focus")},focusout:function(t){e(t.currentTarget).removeClass("ui-state-focus")}})},_trigger:function(t,i,s){var n,a,o=this.options[t];if(s=s||{},i=e.Event(i),i.type=(t===this.widgetEventPrefix?t:this.widgetEventPrefix+t).toLowerCase(),i.target=this.element[0],a=i.originalEvent)for(n in a)n in i||(i[n]=a[n]);return this.element.trigger(i,s),!(e.isFunction(o)&&o.apply(this.element[0],[i].concat(s))===!1||i.isDefaultPrevented())}},e.each({show:"fadeIn",hide:"fadeOut"},function(t,i){e.Widget.prototype["_"+t]=function(s,n,a){"string"==typeof n&&(n={effect:n});var o,r=n?n===!0||"number"==typeof n?i:n.effect||i:t;n=n||{},"number"==typeof n&&(n={duration:n}),o=!e.isEmptyObject(n),n.complete=a,n.delay&&s.delay(n.delay),o&&e.effects&&e.effects.effect[r]?s[t](n):r!==t&&s[r]?s[r](n.duration,n.easing,a):s.queue(function(i){e(this)[t](),a&&a.call(s[0]),i()})}}),e.widget;var a=!1;e(document).mouseup(function(){a=!1}),e.widget("ui.mouse",{version:"1.11.4",options:{cancel:"input,textarea,button,select,option",distance:1,delay:0},_mouseInit:function(){var t=this;this.element.bind("mousedown."+this.widgetName,function(e){return t._mouseDown(e)}).bind("click."+this.widgetName,function(i){return!0===e.data(i.target,t.widgetName+".preventClickEvent")?(e.removeData(i.target,t.widgetName+".preventClickEvent"),i.stopImmediatePropagation(),!1):void 0}),this.started=!1},_mouseDestroy:function(){this.element.unbind("."+this.widgetName),this._mouseMoveDelegate&&this.document.unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate)},_mouseDown:function(t){if(!a){this._mouseMoved=!1,this._mouseStarted&&this._mouseUp(t),this._mouseDownEvent=t;var i=this,s=1===t.which,n="string"==typeof this.options.cancel&&t.target.nodeName?e(t.target).closest(this.options.cancel).length:!1;return s&&!n&&this._mouseCapture(t)?(this.mouseDelayMet=!this.options.delay,this.mouseDelayMet||(this._mouseDelayTimer=setTimeout(function(){i.mouseDelayMet=!0},this.options.delay)),this._mouseDistanceMet(t)&&this._mouseDelayMet(t)&&(this._mouseStarted=this._mouseStart(t)!==!1,!this._mouseStarted)?(t.preventDefault(),!0):(!0===e.data(t.target,this.widgetName+".preventClickEvent")&&e.removeData(t.target,this.widgetName+".preventClickEvent"),this._mouseMoveDelegate=function(e){return i._mouseMove(e)},this._mouseUpDelegate=function(e){return i._mouseUp(e)},this.document.bind("mousemove."+this.widgetName,this._mouseMoveDelegate).bind("mouseup."+this.widgetName,this._mouseUpDelegate),t.preventDefault(),a=!0,!0)):!0}},_mouseMove:function(t){if(this._mouseMoved){if(e.ui.ie&&(!document.documentMode||9>document.documentMode)&&!t.button)return this._mouseUp(t);if(!t.which)return this._mouseUp(t)}return(t.which||t.button)&&(this._mouseMoved=!0),this._mouseStarted?(this._mouseDrag(t),t.preventDefault()):(this._mouseDistanceMet(t)&&this._mouseDelayMet(t)&&(this._mouseStarted=this._mouseStart(this._mouseDownEvent,t)!==!1,this._mouseStarted?this._mouseDrag(t):this._mouseUp(t)),!this._mouseStarted)},_mouseUp:function(t){return this.document.unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate),this._mouseStarted&&(this._mouseStarted=!1,t.target===this._mouseDownEvent.target&&e.data(t.target,this.widgetName+".preventClickEvent",!0),this._mouseStop(t)),a=!1,!1},_mouseDistanceMet:function(e){return Math.max(Math.abs(this._mouseDownEvent.pageX-e.pageX),Math.abs(this._mouseDownEvent.pageY-e.pageY))>=this.options.distance},_mouseDelayMet:function(){return this.mouseDelayMet},_mouseStart:function(){},_mouseDrag:function(){},_mouseStop:function(){},_mouseCapture:function(){return!0}}),e.widget("ui.slider",e.ui.mouse,{version:"1.11.4",widgetEventPrefix:"slide",options:{animate:!1,distance:0,max:100,min:0,orientation:"horizontal",range:!1,step:1,value:0,values:null,change:null,slide:null,start:null,stop:null},numPages:5,_create:function(){this._keySliding=!1,this._mouseSliding=!1,this._animateOff=!0,this._handleIndex=null,this._detectOrientation(),this._mouseInit(),this._calculateNewMax(),this.element.addClass("ui-slider ui-slider-"+this.orientation+" ui-widget"+" ui-widget-content"+" ui-corner-all"),this._refresh(),this._setOption("disabled",this.options.disabled),this._animateOff=!1},_refresh:function(){this._createRange(),this._createHandles(),this._setupEvents(),this._refreshValue()},_createHandles:function(){var t,i,s=this.options,n=this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),a="<span class='ui-slider-handle ui-state-default ui-corner-all'></span>",o=[];for(i=s.values&&s.values.length||1,n.length>i&&(n.slice(i).remove(),n=n.slice(0,i)),t=n.length;i>t;t++)o.push(a);this.handles=n.add(e(o.join("")).appendTo(this.element)),this.handle=this.handles.eq(0),this.handles.each(function(t){e(this).data("ui-slider-handle-index",t)})},_createRange:function(){var t=this.options,i="";t.range?(t.range===!0&&(t.values?t.values.length&&2!==t.values.length?t.values=[t.values[0],t.values[0]]:e.isArray(t.values)&&(t.values=t.values.slice(0)):t.values=[this._valueMin(),this._valueMin()]),this.range&&this.range.length?this.range.removeClass("ui-slider-range-min ui-slider-range-max").css({left:"",bottom:""}):(this.range=e("<div></div>").appendTo(this.element),i="ui-slider-range ui-widget-header ui-corner-all"),this.range.addClass(i+("min"===t.range||"max"===t.range?" ui-slider-range-"+t.range:""))):(this.range&&this.range.remove(),this.range=null)},_setupEvents:function(){this._off(this.handles),this._on(this.handles,this._handleEvents),this._hoverable(this.handles),this._focusable(this.handles)},_destroy:function(){this.handles.remove(),this.range&&this.range.remove(),this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-widget ui-widget-content ui-corner-all"),this._mouseDestroy()},_mouseCapture:function(t){var i,s,n,a,o,r,h,l,u=this,d=this.options;return d.disabled?!1:(this.elementSize={width:this.element.outerWidth(),height:this.element.outerHeight()},this.elementOffset=this.element.offset(),i={x:t.pageX,y:t.pageY},s=this._normValueFromMouse(i),n=this._valueMax()-this._valueMin()+1,this.handles.each(function(t){var i=Math.abs(s-u.values(t));(n>i||n===i&&(t===u._lastChangedValue||u.values(t)===d.min))&&(n=i,a=e(this),o=t)}),r=this._start(t,o),r===!1?!1:(this._mouseSliding=!0,this._handleIndex=o,a.addClass("ui-state-active").focus(),h=a.offset(),l=!e(t.target).parents().addBack().is(".ui-slider-handle"),this._clickOffset=l?{left:0,top:0}:{left:t.pageX-h.left-a.width()/2,top:t.pageY-h.top-a.height()/2-(parseInt(a.css("borderTopWidth"),10)||0)-(parseInt(a.css("borderBottomWidth"),10)||0)+(parseInt(a.css("marginTop"),10)||0)},this.handles.hasClass("ui-state-hover")||this._slide(t,o,s),this._animateOff=!0,!0))},_mouseStart:function(){return!0},_mouseDrag:function(e){var t={x:e.pageX,y:e.pageY},i=this._normValueFromMouse(t);return this._slide(e,this._handleIndex,i),!1},_mouseStop:function(e){return this.handles.removeClass("ui-state-active"),this._mouseSliding=!1,this._stop(e,this._handleIndex),this._change(e,this._handleIndex),this._handleIndex=null,this._clickOffset=null,this._animateOff=!1,!1},_detectOrientation:function(){this.orientation="vertical"===this.options.orientation?"vertical":"horizontal"},_normValueFromMouse:function(e){var t,i,s,n,a;return"horizontal"===this.orientation?(t=this.elementSize.width,i=e.x-this.elementOffset.left-(this._clickOffset?this._clickOffset.left:0)):(t=this.elementSize.height,i=e.y-this.elementOffset.top-(this._clickOffset?this._clickOffset.top:0)),s=i/t,s>1&&(s=1),0>s&&(s=0),"vertical"===this.orientation&&(s=1-s),n=this._valueMax()-this._valueMin(),a=this._valueMin()+s*n,this._trimAlignValue(a)},_start:function(e,t){var i={handle:this.handles[t],value:this.value()};return this.options.values&&this.options.values.length&&(i.value=this.values(t),i.values=this.values()),this._trigger("start",e,i)},_slide:function(e,t,i){var s,n,a;this.options.values&&this.options.values.length?(s=this.values(t?0:1),2===this.options.values.length&&this.options.range===!0&&(0===t&&i>s||1===t&&s>i)&&(i=s),i!==this.values(t)&&(n=this.values(),n[t]=i,a=this._trigger("slide",e,{handle:this.handles[t],value:i,values:n}),s=this.values(t?0:1),a!==!1&&this.values(t,i))):i!==this.value()&&(a=this._trigger("slide",e,{handle:this.handles[t],value:i}),a!==!1&&this.value(i))},_stop:function(e,t){var i={handle:this.handles[t],value:this.value()};this.options.values&&this.options.values.length&&(i.value=this.values(t),i.values=this.values()),this._trigger("stop",e,i)},_change:function(e,t){if(!this._keySliding&&!this._mouseSliding){var i={handle:this.handles[t],value:this.value()};this.options.values&&this.options.values.length&&(i.value=this.values(t),i.values=this.values()),this._lastChangedValue=t,this._trigger("change",e,i)}},value:function(e){return arguments.length?(this.options.value=this._trimAlignValue(e),this._refreshValue(),this._change(null,0),void 0):this._value()},values:function(t,i){var s,n,a;if(arguments.length>1)return this.options.values[t]=this._trimAlignValue(i),this._refreshValue(),this._change(null,t),void 0;if(!arguments.length)return this._values();if(!e.isArray(arguments[0]))return this.options.values&&this.options.values.length?this._values(t):this.value();for(s=this.options.values,n=arguments[0],a=0;s.length>a;a+=1)s[a]=this._trimAlignValue(n[a]),this._change(null,a);this._refreshValue()},_setOption:function(t,i){var s,n=0;switch("range"===t&&this.options.range===!0&&("min"===i?(this.options.value=this._values(0),this.options.values=null):"max"===i&&(this.options.value=this._values(this.options.values.length-1),this.options.values=null)),e.isArray(this.options.values)&&(n=this.options.values.length),"disabled"===t&&this.element.toggleClass("ui-state-disabled",!!i),this._super(t,i),t){case"orientation":this._detectOrientation(),this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-"+this.orientation),this._refreshValue(),this.handles.css("horizontal"===i?"bottom":"left","");break;case"value":this._animateOff=!0,this._refreshValue(),this._change(null,0),this._animateOff=!1;break;case"values":for(this._animateOff=!0,this._refreshValue(),s=0;n>s;s+=1)this._change(null,s);this._animateOff=!1;break;case"step":case"min":case"max":this._animateOff=!0,this._calculateNewMax(),this._refreshValue(),this._animateOff=!1;break;case"range":this._animateOff=!0,this._refresh(),this._animateOff=!1}},_value:function(){var e=this.options.value;return e=this._trimAlignValue(e)},_values:function(e){var t,i,s;if(arguments.length)return t=this.options.values[e],t=this._trimAlignValue(t);if(this.options.values&&this.options.values.length){for(i=this.options.values.slice(),s=0;i.length>s;s+=1)i[s]=this._trimAlignValue(i[s]);return i}return[]},_trimAlignValue:function(e){if(this._valueMin()>=e)return this._valueMin();if(e>=this._valueMax())return this._valueMax();var t=this.options.step>0?this.options.step:1,i=(e-this._valueMin())%t,s=e-i;return 2*Math.abs(i)>=t&&(s+=i>0?t:-t),parseFloat(s.toFixed(5))},_calculateNewMax:function(){var e=this.options.max,t=this._valueMin(),i=this.options.step,s=Math.floor(+(e-t).toFixed(this._precision())/i)*i;e=s+t,this.max=parseFloat(e.toFixed(this._precision()))},_precision:function(){var e=this._precisionOf(this.options.step);return null!==this.options.min&&(e=Math.max(e,this._precisionOf(this.options.min))),e},_precisionOf:function(e){var t=""+e,i=t.indexOf(".");return-1===i?0:t.length-i-1},_valueMin:function(){return this.options.min},_valueMax:function(){return this.max},_refreshValue:function(){var t,i,s,n,a,o=this.options.range,r=this.options,h=this,l=this._animateOff?!1:r.animate,u={};this.options.values&&this.options.values.length?this.handles.each(function(s){i=100*((h.values(s)-h._valueMin())/(h._valueMax()-h._valueMin())),u["horizontal"===h.orientation?"left":"bottom"]=i+"%",e(this).stop(1,1)[l?"animate":"css"](u,r.animate),h.options.range===!0&&("horizontal"===h.orientation?(0===s&&h.range.stop(1,1)[l?"animate":"css"]({left:i+"%"},r.animate),1===s&&h.range[l?"animate":"css"]({width:i-t+"%"},{queue:!1,duration:r.animate})):(0===s&&h.range.stop(1,1)[l?"animate":"css"]({bottom:i+"%"},r.animate),1===s&&h.range[l?"animate":"css"]({height:i-t+"%"},{queue:!1,duration:r.animate}))),t=i}):(s=this.value(),n=this._valueMin(),a=this._valueMax(),i=a!==n?100*((s-n)/(a-n)):0,u["horizontal"===this.orientation?"left":"bottom"]=i+"%",this.handle.stop(1,1)[l?"animate":"css"](u,r.animate),"min"===o&&"horizontal"===this.orientation&&this.range.stop(1,1)[l?"animate":"css"]({width:i+"%"},r.animate),"max"===o&&"horizontal"===this.orientation&&this.range[l?"animate":"css"]({width:100-i+"%"},{queue:!1,duration:r.animate}),"min"===o&&"vertical"===this.orientation&&this.range.stop(1,1)[l?"animate":"css"]({height:i+"%"},r.animate),"max"===o&&"vertical"===this.orientation&&this.range[l?"animate":"css"]({height:100-i+"%"},{queue:!1,duration:r.animate}))},_handleEvents:{keydown:function(t){var i,s,n,a,o=e(t.target).data("ui-slider-handle-index");switch(t.keyCode){case e.ui.keyCode.HOME:case e.ui.keyCode.END:case e.ui.keyCode.PAGE_UP:case e.ui.keyCode.PAGE_DOWN:case e.ui.keyCode.UP:case e.ui.keyCode.RIGHT:case e.ui.keyCode.DOWN:case e.ui.keyCode.LEFT:if(t.preventDefault(),!this._keySliding&&(this._keySliding=!0,e(t.target).addClass("ui-state-active"),i=this._start(t,o),i===!1))return}switch(a=this.options.step,s=n=this.options.values&&this.options.values.length?this.values(o):this.value(),t.keyCode){case e.ui.keyCode.HOME:n=this._valueMin();break;case e.ui.keyCode.END:n=this._valueMax();break;case e.ui.keyCode.PAGE_UP:n=this._trimAlignValue(s+(this._valueMax()-this._valueMin())/this.numPages);break;case e.ui.keyCode.PAGE_DOWN:n=this._trimAlignValue(s-(this._valueMax()-this._valueMin())/this.numPages);break;case e.ui.keyCode.UP:case e.ui.keyCode.RIGHT:if(s===this._valueMax())return;n=this._trimAlignValue(s+a);break;case e.ui.keyCode.DOWN:case e.ui.keyCode.LEFT:if(s===this._valueMin())return;n=this._trimAlignValue(s-a)}this._slide(t,o,n)},keyup:function(t){var i=e(t.target).data("ui-slider-handle-index");this._keySliding&&(this._keySliding=!1,this._stop(t,i),this._change(t,i),e(t.target).removeClass("ui-state-active"))}}})});

var textAudio = '';

function offsetPosition(element) {
    var offsetLeft = 0, offsetTop = 0;
    do {
        offsetLeft += element.offsetLeft;
        offsetTop  += element.offsetTop;
    } while (element = element.offsetParent);
    return [offsetLeft, offsetTop];
}


var SelectionText = function (){
   var k,obs = [];
 
   (document.body || document.documentElement).onmouseup = function(e){
        e = (e || window.event);
        if($(e.target).parents('.player-bg').length <= 0)
        {
            var text = SelectionText.getText();
            SelectionText.fire({text:text, coord: SelectionText.getCoord(e),/* top:e.clientY,*/ target:(e.target || e.srcElement)});
        }
   }
   return {
      getText:function() {
         if (window.getSelection) {
            return window.getSelection().toString();
        } else if (document.getSelection) {
            return document.getSelection().toString();
        } else if (document.selection) {
            return document.selection.createRange().text.toString();
        }
        return '';
      },
      getCoord:function(e){
            e = e || window.event
            if (e.pageX == null && e.clientX != null ) { 
                var html = document.documentElement
                var body = document.body

                X = e.clientX + (html && html.scrollLeft || body && body.scrollLeft || 0) - (html.clientLeft || 0)
                Y = e.clientY + (html && html.scrollTop || body && body.scrollTop || 0) - (html.clientTop || 0)
                //Y = e.pageY - e.layerY
            }
            else
            {
                X = e.pageX;
                if($('h1').length > 0)
                    scroll = $('h1').offset().top - 100;
                else if($('.welcome').length > 0)
                    scroll = $('.welcome').offset().top - 100;
                else 
                    scroll = 0;
                Y = e.pageY - scroll;
            }
            return { x: X, y: Y  };
      },
      addListener:function(callBack) {
         obs.push(callBack);
      },
      removeListener:function(callBack) {
         var b = [];
         for(k in obs) {
            if(callBack != obs[k]) {
               b.push(obs[k]);
            }
         }
         obs = b;
      },
      fire:function(evt) {
         for(k in obs) {
            try{obs[k](evt);} catch(e){}
         }
      }
 
   };
}();


                                                                                          
SelectionText.addListener(function(evt)
{  
    var offset_top = $(evt.target.parentNode).offset().top;
    var offset_left = $(evt.target.parentNode).offset().left;
    
    $('.voice_btn_play#selectiontext-audio').click();
    $('#selectiontext').find('.wrapper-slider').remove();
    $('audio[link-index="-2"]').remove();
    var button = $('#selectiontext-audio');
    
    setTempSlider(button);
    $('#selectiontext .ui-slider-range-min').css('width', '0% !important');
    $('#selectiontext .ui-corner-all').css('left', '0%  !important');
    if(evt.text != '')
    {
        $('#selectiontext').css({'display':'block', 'top': ((window.pageYOffset > evt.coord.y) ? evt.coord.y : window.pageYOffset)/*, 'left':evt.coord.x*/});
        textAudio = evt.text;
    }
    else
    {
        $('#selectiontext').css('display','none');
        textAudio = '';
    }
});

function sleep(delay) {
    var start = new Date().getTime();
    while (new Date().getTime() < start + delay);
}

var voiceBtnTxt = 'Voice';
var voiceAllBtnTxt = 'Voice';
var voiceStopBtnTxt = 'Stop';
var voiceProcessBtn = 'Process';

$(document).ready(function () {
	if($('#mibok-hid-voice').length > 0)
		voiceBtnTxt = $('#mibok-hid-voice').val();
	if($('#mibok-hid-voice-all').length > 0)
		voiceAllBtnTxt = $('#mibok-hid-voice-all').val();
	if($('#mibok-hid-voice-stop').length > 0)
		voiceStopBtnTxt = $('#mibok-hid-voice-stop').val();
	if($('#mibok-hid-voice-process').length > 0)
		voiceProcessBtn = $('#mibok-hid-voice-process').val();
	
    $('.page_body').prepend('<div class="container-player player-bg"><a class="voice_btn btn btn-default" href="#" audio-index="-1">' + voiceAllBtnTxt + '</a></div>');
    $('#main_content').prepend('<div class="container-player player-bg" id="selectiontext"><a class="voice_btn btn btn-default" id="selectiontext-audio" href="#" audio-index="-2">' + voiceBtnTxt + '</a></div>');
	$('#main_content div[tabindex="-1"], #main_content div[tabindex="0"], #main_content p.welcome, .mibok-voice-block').not('[class^="vjs-"]').each(function(index){
		$(this).prepend('<div class="container-player player-bg"><a class="voice_btn btn btn-default voice_pad" href="#" audio-index="' + index + '">' + voiceBtnTxt + '</a></div>');
	})
	var butAll = $('.voice_btn');
	setTempSlider(butAll);

	if($('[name="captcha_sid"]').length > 0){
		$('[name="captcha_sid"]').each(function(){
			var $img = $(this).parents('form').find('img[src*="captcha_sid"]');
			if($img.length > 0){
				$img.wrap('<div class="voice_captcha_btn_wrapper clearfix"></div>');
				$img.after('<a class="btn btn-default no-margin voice_captcha_btn" href="#" audio-index="-1" aria-label="�������� �����������"><span class="glyphicon glyphicon-play"></span></a>');
			}
		});
	}
});


var bChange;


$(document)
    .on('click', '.voice_btn', function (event) {
        event.preventDefault();
		
		var audio_index = $(this).attr('audio-index');
		
        var play_btn = $('.voice_btn_play');
		if(play_btn.parent().parent().hasClass('page_body'))
			play_btn.text(voiceAllBtnTxt); 
		else
			play_btn.text(voiceBtnTxt);
        play_btn.removeClass('voice_btn_play');
        play_btn.addClass('voice_btn');
		
		
		var button = $(this);
		
		
		//$('.voice_btn').removeClass('no-margin');
		
		if($('audio.play_voice').length > 0)
		{
			
			$('.play_voice').each(function(){
				$(this)[0].pause();
			})
			
			play_btn.nextAll('.wrapper-slider').addClass('disabled').find('.slider').slider('value',0).slider("disable");
		}
		
		if($('audio[link-index="' + audio_index + '"]').length > 0)
		{
			
			var aud = document.querySelector("audio[link-index='" + audio_index + "']");
			aud.volume = parseFloat($('#content').attr('data-volume'));
			
			aud.play();

			button.text('');
			button.text(voiceStopBtnTxt);
			
			//button.parent().addClass('player-bg');
			button.removeClass('voice_btn');
			button.addClass('voice_btn_play no-margin');
			
			
			button.nextAll('.wrapper-slider').removeClass('disabled').find('.slider').slider("enable")					
		}
		else
		{

			var button = $(this);
			button.text('');
			
            if($(this).parents('#selectiontext').length > 0)
                var text = textAudio;
            else
            {
            
                copy_btn = button.parent().parent().clone();
                var bt_html = copy_btn.html()
                copy_btn.find('style').html('');
                copy_btn.find('script').html('');
                copy_btn.find('.voice_btn').html('');
                copy_btn.find('.wrapper-slider').html('');
                var text = copy_btn.text();
            }
			
			button.text(voiceProcessBtn);
			
			button.removeClass('voice_btn');
			button.addClass('voice_btn_play');
			var get_url = $('#start_sound').attr('data-process');
            var get_url_preload = get_url.replace("get_voice.php", "voice_size.php");
            
           $.post(get_url_preload, {'txt':text}, function(data){
                if(data.error == 'y') {
                        button.text('������');
                        button.removeClass('voice_btn_play');
                        button.addClass('voice_btn');
                    } else {
                        $("#start_sound").attr('src', data.url);
                        var audPreload = document.getElementById("start_sound");
                        
                        $.ajax({
                            type: "POST",
                            url: get_url,
                            //async: false,
                            dataType: 'json',
                            data: 'txt=' + text,
                            timeout: 9000000,
                            beforeSend: function () {
                               
                                //document.getElementById("start_sound").play();
                               
                                audPreload.volume = parseFloat($('#content').attr('data-volume'));
                                if(data.loop == 'y')
                                    audPreload.loop = true;
                                //audPreload.play();
                                document.getElementById("start_sound").play();
                                
                            },
                            success: function (data) {
                                //audPreload.pause();
                                if($('#start_sound[loop]').length > 0)
                                    audPreload.pause();
                                sleep(3000);
                                if(data.error == 'y') {
                                    button.text('������');
                                    button.removeClass('voice_btn_play');
                                    button.addClass('voice_btn');
                                } else {


                                    button.text(voiceStopBtnTxt);

                                    $('.container-player').removeClass('player-bg');
                                    button.parent().addClass('player-bg');


                                    $('body').prepend('<audio class="play_voice" autoplay src="' + data.url + '" link-index="' + audio_index + '"></audio>');


                                    var aud = document.querySelector(".play_voice");

                                    aud.volume = parseFloat($('#content').attr('data-volume'));

                                    aud.addEventListener('loadedmetadata', function() {
                                        setSlider(aud, button);
                                    });
                                    aud.addEventListener('timeupdate', function() {
                                        if(bChange)
                                        {
                                            time = aud.currentTime;
                                            button.nextAll('.wrapper-slider').find(".slider").slider('value', time);
                                        }
                                    });


                                    aud.onended = function (event) {
                                        if(button.parent().parent().hasClass('page_body'))
                                            button.text(voiceAllBtnTxt);
                                        else
                                            button.text(voiceBtnTxt);
                                        //button.removeClass('voice_btn_play no-margin');
                                        button.removeClass('voice_btn_play');
                                        button.addClass('voice_btn');
                                        aud.remove();
                                        //$('.container-player').removeClass('player-bg');
                                        button.nextAll('.wrapper-slider').remove();
                                        setTempSlider(button);
                                    };
                                }
                            }
                        });

                    } 
            }, 'json');
            
                    
		}
    })
    .on('click', '.voice_btn_play', function (event) {
        event.preventDefault();
		var audio_index = $(this).attr('audio-index');
        $('audio[link-index="' + audio_index + '"]')[0].pause();
        var button = $(this);
		if(button.parent().parent().hasClass('page_body'))
			button.text(voiceAllBtnTxt);
		else
			button.text(voiceBtnTxt);
        //button.removeClass('voice_btn_play no-margin');
        button.removeClass('voice_btn_play');
        button.addClass('voice_btn');
		//$('.container-player').removeClass('player-bg');
		
		
		button.nextAll('.wrapper-slider').addClass('disabled').find('.slider').slider("disable")
    })
	.on('click', '.voice_captcha_btn', function(event){
		event.preventDefault();
		
		var button = $(this);
		var text = $(this).parents('form').find('[name="captcha_sid"]').val();
		
		//$('.voice_btn').removeClass('no-margin');
		
		if($('audio.play_voice').length > 0)
		{
			
			$('.play_voice').each(function(){
				$(this)[0].pause();
			})
			
		}
		if(button.hasClass('play')){
			button.html('<span class="glyphicon glyphicon-play"></span>').removeClass('play');
			return false;
		}
		
		button.html('<span class="glyphicon glyphicon-transfer"></span>').addClass('play');
		var get_url = $('#start_sound').attr('data-process');
		var get_url_preload = get_url.replace("get_voice.php", "voice_size.php");
		$.post(get_url_preload, {'txt':text}, function(data){
			if(data.error == 'y') {
				button.html('<span class="glyphicon glyphicon-ban-circle"></span>');
				button.removeClass('voice_btn_play');
				button.addClass('voice_btn');
			} else {
				$("#start_sound").attr('src', data.url);
				var audPreload = document.getElementById("start_sound");
				$.ajax({
					type: "POST",
					url: get_url,
					dataType: 'json',
					data: {txt: text, sid: 'Y'},
					timeout: 9000000,
					beforeSend: function () {
					    audPreload.volume = parseFloat($('#content').attr('data-volume'));
						if(data.loop == 'y')
							audPreload.loop = true;
						//audPreload.play();
						document.getElementById("start_sound").play();
						
					},
					success: function (data) {
						 if($('#start_sound[loop]').length > 0)
							audPreload.pause();
							sleep(3000);
							if(data.error == 'y') {
								button.html('<span class="glyphicon glyphicon-ban-circle"></span>');
								button.removeClass('voice_btn_play');
								button.addClass('voice_btn');
							} else {
								button.html('<span class="glyphicon glyphicon-stop"></span>');
								$('body').prepend('<audio class="play_voice" autoplay src="' + data.url + '" link-index="0"></audio>');
								var aud = document.querySelector(".play_voice");
                                aud.volume = parseFloat($('#content').attr('data-volume'));
								aud.onended = function (event) {
									aud.remove();
									button.html('<span class="glyphicon glyphicon-play"></span>').removeClass('play');
								}
							}
					}
				});
			}
		});
	})
	;

var timeFormat = (function (){
    function num(val){
        val = Math.floor(val);
        return val < 10 ? '0' + val : val;
    }
    
    return function (sec){
          minutes = sec / 60 % 60
          , seconds = sec % 60
        ;
        
        return num(minutes) + ":" + num(seconds);
    };
})();

function setSlider(aud, button)
{
	sec = Math.round(aud.duration);
	button.nextAll('.wrapper-slider.disabled').remove();
	button.after('<div style="clear:both;"></div><div class="wrapper-slider"><div class="slider"></div><span class="slider_begin">00:00</span><span class="slider_end">' + timeFormat(sec) +'</span></div><div style="clear:both;"></div>').addClass('no-margin');
	
	var valSlider = aud.currentTime;
	
	button.nextAll('.wrapper-slider').find(".slider").slider({ range: "min",min: 0,max: sec,value: valSlider, /*step:0.25,*/
		create: function(event, ui)
		{
			bChange = true;
		},
		start: function(event, ui)
		{
			bChange = false;
		},
		change: function(event, ui)
		{
			if(event.originalEvent !== undefined)
			{
				
				aud.currentTime = ui.value;
			}
			
		},
		stop: function(event, ui)
		{
			bChange = true;
		}
	});
}

function setTempSlider(button)
{
	
	button.after('<div style="clear:both;"></div><div class="wrapper-slider disabled"><div class="slider"></div><span class="slider_begin">00:00</span><span class="slider_end">__:__</span></div><div style="clear:both;"></div>').addClass('no-margin');
	button.nextAll('.wrapper-slider').find(".slider").slider({ range: "min",min: 0,max: 10,value: 0, disabled: true});
	
}