(window.__googlesitekit_webpackJsonp=window.__googlesitekit_webpackJsonp||[]).push([[7],{144:function(t,n,e){"use strict";var r=e(2),o=Object(r.createContext)(!1);n.a=o},289:function(t,n,e){"use strict";e.d(n,"a",(function(){return o}));var r=e(376);function o(t){return Object(r.a)(t)}},30:function(t,n,e){"use strict";e.d(n,"b",(function(){return r})),e.d(n,"a",(function(){return o}));var r="core/ui",o="activeContextID"},569:function(t,n,e){"use strict";(function(t){var r,o=e(581),c=e(113),u=e(479),i=e(965),a=e(395),f=e(968),s=e(970),l=e(570),p=e(876),d=e(71),v=e(289),b=Object(o.a)({},null===(r=t.wp)||void 0===r?void 0:r.data);b.combineStores=d.a,b.commonActions=d.b,b.commonControls=d.c,b.commonStore=d.d,b.createReducer=v.a,b.useInViewSelect=p.a,b.createRegistryControl=c.a,b.createRegistrySelector=c.b,b.useSelect=u.a,b.useDispatch=i.a,b.useRegistry=a.a,b.withSelect=f.a,b.withDispatch=s.a,b.RegistryProvider=l.b,n.a=b}).call(this,e(25))},71:function(t,n,e){"use strict";e.d(n,"a",(function(){return A})),e.d(n,"b",(function(){return P})),e.d(n,"c",(function(){return E})),e.d(n,"d",(function(){return T})),e.d(n,"e",(function(){return _})),e.d(n,"g",(function(){return D})),e.d(n,"f",(function(){return G}));var r,o=e(5),c=e.n(o),u=e(26),i=e.n(u),a=e(6),f=e.n(a),s=e(9),l=e.n(s),p=e(69),d=e.n(p),v=e(13),b=e(113);function y(t,n){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);n&&(r=r.filter((function(n){return Object.getOwnPropertyDescriptor(t,n).enumerable}))),e.push.apply(e,r)}return e}function g(t){for(var n=1;n<arguments.length;n++){var e=null!=arguments[n]?arguments[n]:{};n%2?y(Object(e),!0).forEach((function(n){f()(t,n,e[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):y(Object(e)).forEach((function(n){Object.defineProperty(t,n,Object.getOwnPropertyDescriptor(e,n))}))}return t}var O=function(){for(var t=arguments.length,n=new Array(t),e=0;e<t;e++)n[e]=arguments[e];var r=n.reduce((function(t,n){return g(g({},t),n)}),{}),o=n.reduce((function(t,n){return[].concat(i()(t),i()(Object.keys(n)))}),[]),c=I(o);return l()(0===c.length,"collect() cannot accept collections with duplicate keys. Your call to collect() contains the following duplicated functions: ".concat(c.join(", "),". Check your data stores for duplicates.")),r},h=O,j=O,w=function(){for(var t=arguments.length,n=new Array(t),e=0;e<t;e++)n[e]=arguments[e];var r,o=[].concat(n);return"function"!=typeof o[0]&&(r=o.shift()),function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:r,n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return o.reduce((function(t,e){return e(t,n)}),t)}},m=O,S=O,k=O,R=function(t){return t},A=function(){for(var t=arguments.length,n=new Array(t),e=0;e<t;e++)n[e]=arguments[e];var r=k.apply(void 0,i()(n.map((function(t){return t.initialState||{}}))));return{initialState:r,controls:j.apply(void 0,i()(n.map((function(t){return t.controls||{}})))),actions:h.apply(void 0,i()(n.map((function(t){return t.actions||{}})))),reducer:w.apply(void 0,[r].concat(i()(n.map((function(t){return t.reducer||R}))))),resolvers:m.apply(void 0,i()(n.map((function(t){return t.resolvers||{}})))),selectors:S.apply(void 0,i()(n.map((function(t){return t.selectors||{}}))))}},P={getRegistry:function(){return{payload:{},type:"GET_REGISTRY"}},await:c.a.mark((function t(n){return c.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.abrupt("return",{payload:{value:n},type:"AWAIT"});case 1:case"end":return t.stop()}}),t)}))},E=(r={},f()(r,"GET_REGISTRY",Object(b.a)((function(t){return function(){return t}}))),f()(r,"AWAIT",(function(t){return t.payload.value})),r),I=function(t){for(var n=[],e={},r=0;r<t.length;r++){var o=t[r];e[o]=e[o]>=1?e[o]+1:1,e[o]>1&&n.push(o)}return n},T={actions:P,controls:E,reducer:R},_=function(t){return function(n){return C(t(n))}},C=d()((function(t){return Object(v.mapValues)(t,(function(t,n){return function(){var e=t.apply(void 0,arguments);return l()(void 0!==e,"".concat(n,"(...) is not resolved")),e}}))}));function D(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},e=n.negate,r=void 0!==e&&e,o=Object(b.b)((function(n){return function(e){var o=!r,c=!!r;try{for(var u=arguments.length,i=new Array(u>1?u-1:0),a=1;a<u;a++)i[a-1]=arguments[a];return t.apply(void 0,[n,e].concat(i)),o}catch(t){return c}}})),c=Object(b.b)((function(n){return function(e){for(var r=arguments.length,o=new Array(r>1?r-1:0),c=1;c<r;c++)o[c-1]=arguments[c];t.apply(void 0,[n,e].concat(o))}}));return{safeSelector:o,dangerousSelector:c}}function G(t,n){return l()("function"==typeof t,"a validator function is required."),l()("function"==typeof n,"an action creator function is required."),l()("Generator"!==t[Symbol.toStringTag]&&"GeneratorFunction"!==t[Symbol.toStringTag],"an action’s validator function must not be a generator."),function(){return t.apply(void 0,arguments),n.apply(void 0,arguments)}}},876:function(t,n,e){"use strict";e.d(n,"a",(function(){return d}));var r=e(26),o=e.n(r),c=e(479),u=e(2),i=e(14),a=e.n(i),f=e(565),s=e(144),l=e(30),p=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},n=t.sticky,e=void 0!==n&&n,r=Object(u.useContext)(s.a),o=Object(u.useState)(!1),i=a()(o,2),p=i[0],d=i[1],v=Object(c.a)((function(t){return t(l.b).getInViewResetHook()})),b=Object(c.a)((function(t){return t(l.b).getValue("forceInView")}));return Object(u.useEffect)((function(){r.value&&!p&&d(!0)}),[p,r,d]),Object(u.useEffect)((function(){b&&d(!0)}),[b]),Object(f.a)((function(){d(!1)}),[v]),!(!e||!p)||!!r.value},d=function(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:[],e=p({sticky:!0}),r=Object(u.useRef)(),i=Object(u.useCallback)(t,[].concat(o()(n),[t])),a=Object(c.a)(e?i:function(){});return e&&(r.current=a),r.current}},911:function(t,n,e){"use strict";e.r(n),function(t){var r=e(569);void 0===t.googlesitekit&&(t.googlesitekit={}),t.googlesitekit.data=r.a,n.default=r.a}.call(this,e(25))}},[[911,1,0]]]);