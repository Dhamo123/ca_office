var e;e=function(e){function n(n,o){var t=n.getLine(o),i=t.search(/\S/);return-1==i||/\bcomment\b/.test(n.getTokenTypeAt(e.Pos(o,i+1)))?-1:e.countColumn(t,null,n.getOption("tabSize"))}e.registerHelper("fold","indent",(function(o,t){var i=n(o,t.line);if(!(i<0)){for(var r=null,l=t.line+1,f=o.lastLine();l<=f;++l){var u=n(o,l);if(-1==u);else{if(!(u>i))break;r=l}}return r?{from:e.Pos(t.line,o.getLine(t.line).length),to:e.Pos(r,o.getLine(r).length)}:void 0}}))},"object"==typeof exports&&"object"==typeof module?e(require("../../lib/codemirror")):"function"==typeof define&&define.amd?define(["../../lib/codemirror"],e):e(CodeMirror);