var n;n=function(n){function o(o,r,t,f){if(t&&t.call){var l=t;t=null}else l=i(o,t,"rangeFinder");"number"==typeof r&&(r=n.Pos(r,0));var d=i(o,t,"minFoldSize");function a(n){var e=l(o,r);if(!e||e.to.line-e.from.line<d)return null;if("fold"===f)return e;for(var i=o.findMarksAt(e.from),t=0;t<i.length;++t)if(i[t].__isFold){if(!n)return null;e.cleared=!0,i[t].clear()}return e}var u=a(!0);if(i(o,t,"scanUp"))for(;!u&&r.line>o.firstLine();)r=n.Pos(r.line-1,0),u=a(!1);if(u&&!u.cleared&&"unfold"!==f){var c=e(o,t,u);n.on(c,"mousedown",(function(o){s.clear(),n.e_preventDefault(o)}));var s=o.markText(u.from,u.to,{replacedWith:c,clearOnEnter:i(o,t,"clearOnEnter"),__isFold:!0});s.on("clear",(function(e,r){n.signal(o,"unfold",o,e,r)})),n.signal(o,"fold",o,u.from,u.to)}}function e(n,o,e){var r=i(n,o,"widget");if("function"==typeof r&&(r=r(e.from,e.to)),"string"==typeof r){var t=document.createTextNode(r);(r=document.createElement("span")).appendChild(t),r.className="CodeMirror-foldmarker"}else r&&(r=r.cloneNode(!0));return r}n.newFoldFunction=function(n,e){return function(r,i){o(r,i,{rangeFinder:n,widget:e})}},n.defineExtension("foldCode",(function(n,e,r){o(this,n,e,r)})),n.defineExtension("isFolded",(function(n){for(var o=this.findMarksAt(n),e=0;e<o.length;++e)if(o[e].__isFold)return!0})),n.commands.toggleFold=function(n){n.foldCode(n.getCursor())},n.commands.fold=function(n){n.foldCode(n.getCursor(),null,"fold")},n.commands.unfold=function(n){n.foldCode(n.getCursor(),{scanUp:!1},"unfold")},n.commands.foldAll=function(o){o.operation((function(){for(var e=o.firstLine(),r=o.lastLine();e<=r;e++)o.foldCode(n.Pos(e,0),{scanUp:!1},"fold")}))},n.commands.unfoldAll=function(o){o.operation((function(){for(var e=o.firstLine(),r=o.lastLine();e<=r;e++)o.foldCode(n.Pos(e,0),{scanUp:!1},"unfold")}))},n.registerHelper("fold","combine",(function(){var n=Array.prototype.slice.call(arguments,0);return function(o,e){for(var r=0;r<n.length;++r){var i=n[r](o,e);if(i)return i}}})),n.registerHelper("fold","auto",(function(n,o){for(var e=n.getHelpers(o,"fold"),r=0;r<e.length;r++){var i=e[r](n,o);if(i)return i}}));var r={rangeFinder:n.fold.auto,widget:"↔",minFoldSize:0,scanUp:!1,clearOnEnter:!0};function i(n,o,e){if(o&&void 0!==o[e])return o[e];var i=n.options.foldOptions;return i&&void 0!==i[e]?i[e]:r[e]}n.defineOption("foldOptions",null),n.defineExtension("foldOption",(function(n,o){return i(this,n,o)}))},"object"==typeof exports&&"object"==typeof module?n(require("../../lib/codemirror")):"function"==typeof define&&define.amd?define(["../../lib/codemirror"],n):n(CodeMirror);