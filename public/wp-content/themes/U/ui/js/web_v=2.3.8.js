!function (n) {
    var r = {};

    function o(t) {
        if (r[t]) return r[t].exports;
        var e = r[t] = {i: t, l: !1, exports: {}};
        return n[t].call(e.exports, e, e.exports, o), e.l = !0, e.exports
    }

    o.m = n, o.c = r, o.d = function (t, e, n) {
        o.o(t, e) || Object.defineProperty(t, e, {enumerable: !0, get: n})
    }, o.r = function (t) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(t, "__esModule", {value: !0})
    }, o.t = function (e, t) {
        if (1 & t && (e = o(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var n = Object.create(null);
        if (o.r(n), Object.defineProperty(n, "default", {
            enumerable: !0,
            value: e
        }), 2 & t && "string" != typeof e) for (var r in e) o.d(n, r, function (t) {
            return e[t]
        }.bind(null, r));
        return n
    }, o.n = function (t) {
        var e = t && t.__esModule ? function () {
            return t["default"]
        } : function () {
            return t
        };
        return o.d(e, "a", e), e
    }, o.o = function (t, e) {
        return Object.prototype.hasOwnProperty.call(t, e)
    }, o.p = "", o(o.s = 0)
}([function (t, e, n) {
    n(1), n(2), n(3), n(4), n(5), n(6), n(7), n(8), n(9), n(10), n(11), n(12), n(13), n(14), n(15), n(56), n(17), n(18), n(19), n(20), n(21), n(22), n(23), n(24), n(25), n(26), n(27), n(28), n(29), n(30), n(31), n(32), n(33), n(34), n(35), n(36), n(37), n(38), n(39), n(40), n(41), n(42), n(43), n(44), n(45), n(46), n(47), n(48)
}, function (t, e) {
    function o(t) {
        return (o = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (t) {
            return typeof t
        } : function (t) {
            return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
        })(t)
    }

    var i, a, s, c;
    "function" != typeof Object.create && (Object.create = function (t, e) {
        if ("object" !== o(t) && "function" != typeof t) throw new TypeError("Object prototype may only be an Object: " + t);
        if (null === t) throw new Error("This browser's implementation of Object.create is a shim and doesn't support 'null' as the first argument.");
        if (void 0 !== e) throw new Error("This browser's implementation of Object.create is a shim and doesn't support a second argument.");

        function n() {
        }

        return n.prototype = t, new n
    }), Array.prototype.forEach || (Array.prototype.forEach = function (t, e) {
        var n, r;
        if (null == this) throw new TypeError(" this is null or not defined");
        var o = Object(this), i = o.length >>> 0;
        if ("function" != typeof t) throw new TypeError(t + " is not a function");
        for (1 < arguments.length && (n = e), r = 0; r < i;) {
            var a;
            r in o && (a = o[r], t.call(n, a, r, o)), r++
        }
    }), Array.prototype.map || (Array.prototype.map = function (t, e) {
        var n, r, o;
        if (null == this) throw new TypeError(" this is null or not defined");
        var i = Object(this), a = i.length >>> 0;
        if ("[object Function]" != Object.prototype.toString.call(t)) throw new TypeError(t + " is not a function");
        for (e && (n = e), r = new Array(a), o = 0; o < a;) {
            var s, c;
            o in i && (s = i[o], c = t.call(n, s, o, i), r[o] = c), o++
        }
        return r
    }), Array.prototype.filter || (Array.prototype.filter = function (t, e) {
        "use strict";
        if ("Function" != typeof t && "function" != typeof t || !this) throw new TypeError;
        var n = this.length >>> 0, r = new Array(n), o = this, i = 0, a = -1;
        if (e === undefined) for (; ++a != n;) a in this && t(o[a], a, o) && (r[i++] = o[a]); else for (; ++a != n;) a in this && t.call(e, o[a], a, o) && (r[i++] = o[a]);
        return r.length = i, r
    }), Array.prototype.reduce = Array.prototype.reduce || function (t, e) {
        if (null == this) throw new TypeError("Array.prototype.reduce called on null or undefined");
        if ("function" != typeof t) throw new TypeError(t + " is not a function");
        var n, r, o = this.length >>> 0, i = !1;
        for (1 < arguments.length && (r = e, i = !0), n = 0; n < o; ++n) this.hasOwnProperty(n) && (i ? r = t(r, this[n], n, this) : (r = this[n], i = !0));
        if (!i) throw new TypeError("Reduce of empty array with no initial value");
        return r
    }, Object.keys || (Object.keys = (i = Object.prototype.hasOwnProperty, a = !{toString: null}.propertyIsEnumerable("toString"), c = (s = ["toString", "toLocaleString", "valueOf", "hasOwnProperty", "isPrototypeOf", "propertyIsEnumerable", "constructor"]).length, function (t) {
        if ("object" !== o(t) && "function" != typeof t || null === t) throw new TypeError("Object.keys called on non-object");
        var e = [];
        for (var n in t) i.call(t, n) && e.push(n);
        if (a) for (var r = 0; r < c; r++) i.call(t, s[r]) && e.push(s[r]);
        return e
    }))
}, function (t, e) {
    window.requestAnimationFrame = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function (t) {
        window.setTimeout(t, 1e3 / 60)
    }, window.cancelAnimationFrame = window.cancelAnimationFrame || Window.webkitCancelAnimationFrame || window.mozCancelAnimationFrame || window.msCancelAnimationFrame || window.oCancelAnimationFrame || function (t) {
        window.clearTimeout(t)
    }
}, function (t, e) {
    var n, r, o, i, a, s, c, l, u, d, h, f, m, p, v, g, z, y, w, b, k, _, C, j, x, E, T, O, A, S;
    n = window, r = function r(t) {
        return Object.prototype.toString.call(t).slice(8, -1)
    }, o = function o(t) {
        return function () {
            return !t.apply(null, [].slice.apply(arguments, [0]))
        }
    }, i = function i(t) {
        return null != t
    }, a = Boolean, s = function s(t) {
        return !a(t) || 0 == Math.abs(Number(t))
    }, c = function c(t) {
        return function () {
            return t
        }
    }, l = function l(e, n) {
        return e < 1 && (e = 1), "function" != typeof n ? null : function () {
            var t = [].slice.apply(arguments, [0, e]);
            return n.apply(null, t)
        }
    }, u = function u(e) {
        return "function" != typeof e ? null : function () {
            var t = [].slice.apply(arguments, [0]).reverse();
            return e.apply(null, t)
        }
    },
        d = function d(e) {
            return "function" != typeof e ? null : function n() {
                var t = [].slice.apply(arguments, [0]);
                return t.length >= e.length ? e.apply(null, t) : function () {
                    return n.apply(null, t.concat([].slice.apply(arguments, [0])))
                }
            }
        }, h = d(function h(t, e) {
        return i(console) ? console.log(t, e) : (alert(t), alert(opt)), e
    }), f = function f() {
        var n = [].slice.apply(arguments, [0]).reverse();
        return function () {
            for (var t = [].slice.apply(arguments, [0]), e = 0; e < n.length; e++) {
                if ("function" != typeof n[e]) return h("the arguments is not a function", n[e]);
                t = n[e].apply(null, [].concat(t))
            }
            return t
        }
    }, m = u(f), p = d(function p(t, e) {
        return t == e
    }), v = d(function v(t, e) {
        return e < t
    }), g = d(function (t, e) {
        return t < e
    }), z = d(function z(t, e) {
        return p(t, r(e))
    }), y = z("Array"), w = z("Object"), b = z("String"), k = z("Number"), _ = z("Function"), C = z("RegExp"), j = z("Boolean"), x = z("Date"), E = d(function E(t, e) {
        return Array.prototype.map.call(e, t)
    }), T = d(function T(t, e) {
        return Array.prototype.filter.call(e, t)
    }), O = d(function O(t, e) {
        return Array.prototype.reduce.call(e, t)
    }), A = function A(t) {
        var e;
        if (w(t)) for (var n in e = {}, t) t.hasOwnProperty(n) && (e[n] = A(t[n])); else e = y(t) ? E(A, t) : t;
        return e
    }, S = function S(t) {
        var e = [];
        if (w(t)) for (var n in t) t.hasOwnProperty(n) && (w(t[n]) ? e.push([n, S(t[n])]) : e.push([n, t[n]])); else e = e.concat(A(t));
        return e
    },
        n.orz = {
            trace: h,
            arity: l,
            reverseArg: u,
            curry: d,
            compose: f,
            flow: m,
            not: o,
            of: c,
            e: p,
            lt: v,
            gt: g,
            getType: r,
            isType: z,
            isArray: y,
            isObject: w,
            isString: b,
            isDate: x,
            isNumber: k,
            isBoolean: j,
            isFunction: _,
            isRegExp: C,
            isExist: i,
            isTrue: a,
            isEmpty: s,
            map: E,
            filter: T,
            reduce: O,
            deepCopy: A,
            toArray: S
        }, orz && (orz.log = function () {
        var t = Array.prototype.slice.call(arguments, 0);
        window.console ? (console.info ? window.console.info : window.console.log).apply(null, t) : alert(t)
    }), orz && (orz.match = orz.curry(function (t, e) {
        return !orz.isEmpty(e) && String.prototype.match.call(e, t) || !1
    }), orz.replace = orz.curry(function (t, e, n) {
        return orz.isEmpty(n) ? "" : String.prototype.replace.call(n, t, e)
    }), orz.trim = orz.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, ""), orz.pad = orz.curry(function (t, e, n, r) {
        t = orz.isTrue(t), orz.isEmpty(e) && (e = "0"), e = String(e);
        var o = n - (r = String(r)).length;
        if (o <= 0) return r;
        for (var i = ""; i.length < o;) i += e;
        return i = i.substring(0, o), t ? r + i : i + r
    }), orz.lpad = orz.pad(!1), orz.rpad = orz.pad(!0), orz.strToObj = function (t) {
        var n = {};
        if (orz.isString(t)) {
            t = t.split("&");
            var r = new RegExp("([^=]+)=?([^=]*)", "g");
            t.map(function (t) {
                for (var e; (e = r.exec(t)) && (n[e[1]] = decodeURIComponent(e[2])), e;) ;
            })
        }
        return n
    }), orz && (orz.prop = orz.curry(function (t, e) {
        return orz.isObject(t) ? t[e] ? t[e] : orz.trace(e + " is not a prop in the object", t[e]) : orz.trace("the first argument is not an object", null)
    }), orz.props = function (t) {
        return orz.isObject(t) ? Object.keys(t) : orz.trace("the argument is not an object", [])
    }, orz.objToStr = function (t) {
        var e = "";
        if (orz.isObject(t)) {
            for (var n in e = [], t) t.hasOwnProperty(n) && e.push(n + "=" + encodeURIComponent(orz.objToStr(t[n])));
            e = e.join("&")
        }
        return orz.isString(t) && (e = t), e
    }, orz.joinObject = function (t, e) {
        var n = {};
        if (orz.isObject(t) && orz.isObject(e)) {
            for (var r in e) e.hasOwnProperty(r) && (t[r] = e[r]);
            n = t
        }
        return n
    }), orz && (orz.dateFormat = function (t) {
        if (orz.isDate(t)) return t;
        if (orz.isString(t)) {
            var e = orz.match(/^[012]\d{3}[-\/][01]\d[-\/][0-3]\d(\s+[0-2]\d(:[0-5]\d(:[0-5]\d)?)?)?/gi, t);
            return orz.isEmpty(e) ? new Date(t) : new Date(orz.replace(/\-/g, "/", e[0]))
        }
        return orz.isNumber(t) ? new Date(t) : new Date("error")
    }, orz.dateDiff = function (t, e, n) {
        if (e = orz.dateFormat(e).getTime(), n = orz.dateFormat(n).getTime(), isNaN(e) || isNaN(n)) return orz.trace("date is error. ", null);
        var r = n - e, o = 1;
        switch (t) {
            case"week":
                o = 6048e5;
                break;
            case"day":
                o = 864e5;
                break;
            case"hour":
                o = 36e5;
                break;
            case"minute":
                o = 6e4;
                break;
            case"second":
                o = 1e3;
                break;
            default:
                o = 1
        }
        return Math.floor(r / o)
    }), orz && (orz.jsonEncode = function (t) {
        return JSON.stringify(t)
    }, orz.jsonDecode = function (t) {
        var e;
        try {
            e = JSON.parse(t)
        } catch (n) {
            e = null, orz.trace("decode json error: ", n)
        }
        return e
    }), function () {
        if (orz) {
            var e = function e() {
                return navigator.userAgent
            }, t = orz.not(orz.isEmpty);
            orz.getDevice = function () {
                var t = e();
                return -1 != t.indexOf("MicroMessenger") ? "微信" : -1 != t.indexOf("Android") ? "Android" : -1 != t.indexOf("iPhone") ? 812 == screen.height ? "iPhone X" : "iPhone" : -1 != t.indexOf("iPad") || -1 != t.indexOf("Safari") && -1 == t.indexOf("Chrome") ? "iPad" : -1 != t.indexOf("Edge") ? "Edge浏览器" : -1 != t.indexOf("360SE") || -1 != t.indexOf("360EE") ? "360浏览器" : -1 != t.indexOf("Maxthon") ? "傲游浏览器" : -1 != t.indexOf("Tencent") ? "QQ浏览器" : -1 != t.indexOf("MetaSr") ? "搜狗浏览器" : -1 != t.indexOf("Opera") ? "Opera浏览器" : -1 != t.indexOf("Firefox") ? "Firefox浏览器" : -1 != t.indexOf("Chrome") ? "Chrome浏览器" : -1 != t.indexOf("Safari") ? "Safari浏览器" : -1 != t.indexOf("MSIE") ? "IE浏览器" : -1 != t.indexOf("like Gecko") ? -1 != t.indexOf("OPR") ? "Opara浏览器" : "IE浏览器" : void 0
            }, orz.getDocument = function (t) {
                return function () {
                    return document.documentElement[t] || document.body[t] || 0
                }
            }, orz.isIos = orz.flow(e, orz.match(/(iPhone|iPod|ios|iPad)/i), t), orz.isAndroid = orz.flow(e, orz.match(/Android/i), t), orz.isMobile = orz.flow(e, orz.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i), t), orz.isPC = orz.not(orz.isMobile)
        }
    }(), orz && (orz.animate = function (t) {
        var e = 0, n = 0, r = 0, o = !1;

        function i() {
            t.call(this), e = requestAnimationFrame(i)
        }

        return {
            startTime: n, stopTime: r, start: function () {
                o || (n = new Date, e = requestAnimationFrame(i), o = !0)
            }, stop: function () {
                r = new Date, e && cancelAnimationFrame(e), e = 0, o = !1
            }
        }
    }), orz && (orz.urlGet = orz.curry(function (t, e) {
        if (t) {
            for (var n, r, o = new RegExp("[?&]" + e + "=([^&]*)", "g"); (n = o.exec(t)) && (r = n), n;) ;
            if (orz.isArray(r)) return r[1]
        }
        return ""
    }), orz.urlGets = function (t) {
        var e = {};
        if (t) for (var n, r = new RegExp("[?&]([^=&]+)=?([^&]*)", "g"); (n = r.exec(t)) && (e[n[1]] = n[2]), n;) ;
        return e
    }, orz.urlAnchor = function (t) {
        if (t) {
            var e = new RegExp("#([^?&]*)").exec(t);
            if (orz.isArray(e)) return e[1]
        }
        return ""
    }, orz.urlBase = function (t) {
        return orz.isString(t) ? (t = orz.replace(/#.*/, "", t), t = orz.replace(/\?.*/, "", t)) : orz.trace("url is not a string", "")
    }, orz.getUrl = function (t, e) {
        if (orz.isString(t)) {
            var n = orz.urlGets(t), r = orz.urlBase(t);
            orz.isString(e) && (e = orz.strToObj(e)), orz.isObject(e) && (n = orz.joinObject(n, e)), 0 < Object.keys(n).length && (t = r + "?" + orz.objToStr(n))
        }
        return t
    }), orz && (orz.getCookie = function (t) {
        var e, n = new RegExp("(^| )" + t + "=([^;]*)(;|$)");
        return (e = document.cookie.match(n)) ? decodeURIComponent(e[2]) : ""
    }, orz.setCookie = function (t, e, n, r) {
        orz.isExist(n) || (n = 1), n = +n, isNaN(n) && (n = 1), path = orz.isExist(r) ? "" : ";path=/";
        var o = new Date;
        o.setTime(o.getTime() + 24 * n * 60 * 60 * 1e3);
        var i = "expires=" + o.toUTCString();
        document.cookie = t + "=" + encodeURIComponent(e) + "; " + i + path
    }, orz.delCookie = function (t) {
        setCookie(t, "", -1)
    })
}, function (t, e) {
    var o;
    o = jQuery, window.email = "2650232288%40qq.com", orz.isNotEmpty = orz.not(orz.isEmpty), clientWidthBigThen = function (t) {
        var e = orz.not(orz.lt(t));
        return orz.flow(orz.getDocument("clientWidth"), e)
    }, orz.lg = clientWidthBigThen(1330), orz.md = clientWidthBigThen(1024), orz.sm = clientWidthBigThen(768), orz.showLogin = function () {
        o('[data-modal-id="modal_login"]').trigger("click")
    }, orz.get_form_item_val = orz.curry(function (t, e) {
        var n = o(e).find('[name="' + t + '"]'), r = n.val();
        return r == orz.attr("placeholder", n) && (r = ""), r
    }), orz.inArray = function (t, e) {
        for (var n = 0; n < e.length; n++) if (e[n] == t) return n;
        return -1
    }, orz.getDateDiff = function (t) {
        var e = orz.dateDiff("second", t, new Date), n = Math.floor(e / 86400), r = Math.floor(e % 86400 / 3600),
            o = Math.floor(e % 3600 / 60), i = orz.dateFormat(t), a = i.getFullYear(),
            s = orz.lpad("0", 2, i.getMonth() + 1), c = orz.lpad("0", 2, i.getDate());
        return 30 < n ? a + "-" + s + "-" + c : 3 < n ? s + "-" + c : 0 < n ? n + "天前" : 0 < r ? r + "小时前" : 0 < o ? o + "分钟前" : e < 0 ? "预计于：" + a + "-" + s + "-" + c + "发表" : "刚刚发表"
    }, orz.wrong = function () {
        return !1
    }
}, function (t, e) {
    jQuery, orz.scroll = function (e) {
        var n = !1;
        return function (t) {
            n || (window.requestAnimationFrame(function (t) {
                e.call(t), n = !1
            }), n = !0)
        }
    }
}, function (t, e) {
    var o;
    o = jQuery, orz.click = orz.curry(function (t, e) {
        if (orz.isArray(t)) for (var n = 0; n < t.length; n++) orz.isFunction(t[n]) && o("body").on("click", e, t[n]); else orz.isFunction(t) && o("body").on("click", e, t)
    }), orz.outClick = orz.curry(function (e, n) {
        o("body").on("click", function (t) {
            t = t || window.event;
            0 == o(t.target).closest(n).length && e.apply(o(n))
        })
    }), orz.hover = orz.curry(function (t, e, n) {
        if (orz.isArray(t)) for (var r = 0; r < t.length; r++) orz.isFunction(t[r]) && o("body").on("mouseenter", n, t[r]); else orz.isFunction(t) && o("body").on("mouseenter", n, t);
        if (orz.isArray(e)) for (r = 0; r < e.length; r++) orz.isFunction(e[r]) && o("body").on("mouseleave", n, e[r]); else orz.isFunction(e) && o("body").on("mouseleave", n, e)
    }), orz.click(function () {
        return !1
    }, ".disabled")
}, function (t, e) {
    var i;
    i = jQuery,
        orz.ajax =
            orz.curry(function (t, e, n, r, o, mb) {
                if (r.action === 'hot_posts') {
                    mb;
                } else {
                    i.ajax({type: t, url: "/", context: o, data: r, success: n, error: e})
                }
            }),
        orz.get = orz.ajax("GET", function () {
            orz.log("ajax get error"), orz.log(this)
        }),
        orz.post = orz.ajax("POST", function () {
            orz.log("ajax post error"), orz.log(this)
        });
}, function (t, e) {
    var r;
    r = jQuery, orz.attr = orz.curry(function (t, e) {
        return r(e).attr("data-" + t)
    }), orz.setAttr = orz.curry(function (t, e, n) {
        return r(n).attr("data-" + t, e)
    }), orz.attrEq = orz.curry(function (t, e, n) {
        return orz.attr(t, n) == e
    }), orz.addClass = orz.curry(function (t, e) {
        return r(e).addClass(t)
    }), orz.removeClass = orz.curry(function (t, e) {
        return r(e).removeClass(t)
    })
}, function (t, e) {
    orz._get = function (t) {
        var e = location.search;
        if (e) {
            for (var n, r, o = new RegExp(t + "=([^&]*)", "g"); (n = o.exec(e)) && (r = n), n;) ;
            if (orz.isArray(r)) return r[1]
        }
        return null
    }, orz.currentPageUrl = function () {
        var t = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ":" + window.location.port : "") + window.location.pathname;
        return t = orz.replace(/\/page\/.*$/, "", t)
    }
}, function (t, e) {
    jQuery, orz.pending = orz.setAttr("status", "pending"), orz.done = orz.setAttr("status", "done"), orz.disable = orz.setAttr("status", "disable"), orz.enable = orz.setAttr("status", "enable"), orz.init = orz.setAttr("init", "done"), orz.isPending = orz.attrEq("status", "pending"), orz.isDone = orz.attrEq("status", "done"), orz.isDisable = orz.attrEq("status", "disable"), orz.isInit = orz.attrEq("init", "done"), orz.hidden = orz.addClass("hidden"), orz.show = orz.removeClass("hidden")
}, function (t, e) {
    function n() {
        for (var t = 0; t < orz.hash.length; t++) orz.isFunction(orz.hash[t]) && orz.hash[t]()
    }

    var r;
    jQuery, r = location.hash, orz.hash = [], "onhashchange" in window && ("undefined" == typeof document.documentMode || 8 == document.documentMode) ? window.onhashchange = n : setInterval(function () {
        !function e() {
            var t = location.hash;
            return t != r && (r = t, !0)
        }() || n()
    }, 150)
}, function (t, e) {
    !function (r) {
        !function n() {
            r(".modal-mark").length < 1 && r("body").append('<div class="mark modal-mark"></div>')
        }();
        var o = orz.attr("modal-id"), i = orz.attr("modal-mask"), a = orz.attr("modal-login");
        var t = orz.click(function s() {
            var t = o(this), e = i(this), n = a(this);
            if (t) return "need" != n || orz.currentUser ? ("no" != e && r(".modal-mark").addClass("modal-show"), r("#" + t).trigger("modal.show", r(this)), r("#" + t).addClass("modal-show")) : r('[data-modal-id="modal_login"]').trigger("click"), !1
        }), e = orz.click(function c() {
            return r(".modal-show").removeClass("modal-show"), r(".modal-show").trigger("modal.close"), !1
        });
        t(".modal-open"), e(".modal-close"), e(".modal-mark")
    }(jQuery)
}, function (t, e) {
    orz.get_zan_cookie = function (t) {
        return orz.trim(orz.getCookie(t))
    }, orz.set_zan_cookie = orz.curry(function (t, e) {
        var n = orz.get_zan_cookie(t);
        orz.has_zan_cookie(t, e) || (n = n + "," + e), n = (n = orz.trim(n)).replace(/^,|,$/, ""), orz.setCookie(t, n, 365)
    }), orz.has_zan_cookie = orz.curry(function (t, e) {
        var n = orz.get_zan_cookie(t), r = new RegExp("(,|^)" + e + "(,|$)");
        return 0 <= n.search(r)
    }), orz.set_post_zan = orz.set_zan_cookie("post_zan"), orz.set_comment_zan = orz.set_zan_cookie("comment_zan"), orz.has_post_zan = orz.has_zan_cookie("post_zan"), orz.has_comment_zan = orz.has_zan_cookie("comment_zan")
}, function (t, e) {
    function n(t) {
        var e = orz.trim(t.val()), n = orz.trim(t.attr("data-placeholder"));
        e == n && (e = ""), orz.isEmpty(e) ? (t.val(n), t.addClass("placeholder"), t.addClass("txt_empty")) : (t.removeClass("placeholder"), t.removeClass("txt_empty"))
    }

    var r;
    (r = jQuery)("body").on("form.placeholder.ready", function () {
        r("[data-placeholder]").each(function () {
            orz.isInit(this) || (orz.init(this), n(r(this)))
        })
    }), r("body").on("focus", "[data-placeholder]", function () {
        orz.trim(r(this).val()) == orz.trim(r(this).attr("data-placeholder")) && r(this).val(""), r(this).removeClass("placeholder"), r(this).removeClass("txt_empty")
    }), r("body").on("blur", "[data-placeholder]", function () {
        n(r(this))
    }), r("body").on("submit", "form", function () {
        r(this).find("[data-placeholder]").each(function () {
            orz.trim(r(this).val()) == orz.trim(r(this).attr("data-placeholder")) && r(this).val("")
        })
    }), r("body").trigger("form.placeholder.ready")
}, function (t, e) {
    var u, d, h;
    u = jQuery, d = orz.attr("scrollInit"), h = orz.setAttr("scrollInit", "done"), orz.divNeedScrollInit = function n() {
        orz.isMobile() || "iPad" == orz.getDevice() || u(".divNeedScroll").each(function () {
            var n = this;
            if ("done" != d(this)) {
                h(this);
                var a = this.scrollHeight, s = this.clientHeight, r = !1, o = 0, c = Math.floor((1 - s / a) * s),
                    t = function t() {
                        return '<div class="scroll-div"><span class="block"></span></div>'
                    }, l = function l(t, e) {
                        var n = u(e).find(".block"), r = u(e).find(".scroll-div"), o = parseFloat(n.css("top"));
                        (o += t) < 0 && (o = 0), c < o && (o = c);
                        var i = Math.ceil(a * o / s);
                        u(e).scrollTop(i), r.css("top", i), n.css("top", o)
                    };
                u(window).off(".divNeedScroll"), u(this).find(".block").off(".divNeedScroll"), u(this).off(".divNeedScroll"), u(this).find(".scroll-div").length < 1 && u(this).append(t());
                var e = u(this).find(".scroll-div"), i = Math.floor(s / a * s);
                e.children(".block").css("height", i), s < a && orz.sm() ? (e.removeClass("hidden"), u(this).on("mousewheel.divNeedScroll", function (t) {
                    var e = t.originalEvent.wheelDelta;
                    return l(0 - e, this), !1
                }), u(this).find(".block").on("mousedown.divNeedScroll", function (t) {
                    return o = t.clientY, r = !0, n = u(this).parents(".divNeedScroll")[0], !1
                }), u(window).on("mouseup.divNeedScroll", function (t) {
                    o = 0, r = !1
                }), u(window).on("mousemove.divNeedScroll", function (t) {
                    if (r) {
                        var e = t.clientY - o;
                        l(e, n)
                    }
                })) : e.addClass("hidden")
            }
        })
    }
}, function (t, e, n) {
    var r = n(49);
    t.exports = function o(e) {
        return function n(t) {
            return 0 === arguments.length || r(t) ? n : e.apply(this, arguments)
        }
    }
}, function (t, e) {
    !function (t) {
        var i = t(".eye-icon em");
        if (!(i.length < 1)) {
            var e, a, s, c = -3.5, l = -3.5;
            n(), t(window).on("resize", n), t(document).on("mousemove", function (t) {
                document.documentElement.clientWidth, document.documentElement.clientHeight;
                var e = a - t.pageX, n = s - t.pageY,
                    r = Math.sqrt(Math.pow(3.5, 2) / (Math.pow(Math.abs(e / n), 2) + 1)), o = r * Math.abs(e / n);
                l = Math.abs(e) < 15 && Math.abs(n) < 15 ? c = -3.5 : (c = 0 < e ? -4 - o : o - 4, 0 < n ? -4 - r : -4 + r), i.css({
                    "margin-top": l,
                    "margin-left": c
                })
            })
        }

        function n() {
            e = i.offset(), a = Math.ceil(e.left), s = Math.ceil(e.top)
        }
    }(jQuery)
}, function (t, e) {
    var n;
    n = jQuery, orz.click(function () {
        n(".header").hasClass("show-menu") ? (n(".mark").trigger("click"), n(".mark").removeClass("mark-for-header"), n(".header").removeClass("show-menu")) : (n(".header").addClass("show-menu"), n(".mark").addClass("mark-for-header"))
    })(".h-navi"), orz.click(function () {
        n(".header").removeClass("show-menu"), n(".mark").removeClass("mark-for-header")
    }, ".mark-for-header")
}, function (t, e) {
    var n;
    (n = jQuery)(".spark_rm").each(function () {
        var t = n(this).children();
        t.addClass("hidden");
        var e = Math.floor(Math.random() * t.length);
        t.eq(e).removeClass("hidden")
    })
}, function (t, e) {
    var n, r;
    n = jQuery, (r = n("#login")).length < 1 || (n(document).on("userLogged", function () {
        var t = orz.currentUser.menus, e = t.center;
        r.children("a").removeClass("modal-open"), r.children("a").children(".avatar").css("background-image", "url(" + orz.currentUser.avatar + ")");
        var n = '<div class="login-down">';
        n += '<div class="login-div">', n += '<div class="info">', n += '<div class="info-thumb"> <i class="thumb" style="background-image:url(' + orz.currentUser.avatar + ');"></i> </div>', n += '<h2 class="user-name">' + orz.currentUser.name + "</h2>", n += '<h4 class="user-info">' + orz.currentUser.info + "</h4>", n += "</div>", n += '<div class="main">', n += '<div class="main-menu">', n += '<div class="item"><div class="item-content"> <a href="' + e + '"> <i class="icon-Center"></i> 个人中心 </a> </div></div>', n += '<div class="item"><div class="item-content"> <a href="' + e + '#fav"> <i class="icon-1-heart-border"></i> 我收藏的 </a> </div></div>', n += '<div class="item"><div class="item-content"> <a href="' + e + '#publish"> <i class="icon-article"></i> 我发布的 </a> </div></div>', t.edit && (n += '<div class="item"><div class="item-content"> <a href="' + t.edit + '"> <i class="icon-allposts"></i> 文章管理 </a> </div></div>'), t.comment && (n += '<div class="item"><div class="item-content"> <a href="' + t.comment + '"> <i class="icon-comm"></i> 评论管理 </a> </div></div>'), t.admin && (n += '<div class="item"><div class="item-content"> <a href="' + t.admin + '"> <i class="icon-site"></i> 后台管理 </a> </div></div>'), n += "</div>", n += '<div class="main-menu-2">', n += '<div class="item"> <a href="' + e + '#setting"> 帐户管理 </a> </div>', n += '<div class="item"> <a href="' + (t.logout + "&redirect_to=" + decodeURIComponent(location.href)) + '"> 安全退出 </a> </div>', n += "</div>", n += "</div>", n += "</div>", n += "</div>", r.append(n), r.addClass("has-children")
    }), n(document).on("userNotLogged", function () {
        r.children("a").children(".avatar").addClass("avatar-default"), n("body").append(function t() {
            return 0 < n(".modal-login-panel").length ? "" : '<div class="modal-login-panel modal-part" id="modal_login"><div class="login_wrap"><div class="wxlogin-main"><h2> <i class="avatar"></i> 您还没有登录</h2><h4>优设启用更安全省心的 <em><i class="icon-wechat"></i> 微信扫码登录</em></h4><div class="ewm"><iframe id="wechatEwm" src="about:blank" width="288px" height="270px" frameborder="0" sandbox="allow-scripts allow-top-navigation" scrolling="no"></iframe></div><p class="wxlogin-protocol"><label class="checked"><input type="radio" name="check_protocol" checked value="yes"> <i class="ico"></i> 扫码登录即表示您同意并遵守 </label> <a class="link" href="https://www.uisdc.com/agreement" target="_blank">用户协议</a> </p></div><div class="wxlogin-intro"> <p>300万设计师聚集地！优设网是极具人气的设计师平台 <br> 2012年成立至今，一直专注于设计师的学习成长交流</p> </div></div><span class="modal-close"> <i class="icon-close"></i> </span></div>'
        }())
    }), orz.click(function (t) {
        t.stopPropagation(), t.preventDefault(), orz.log(n(this).attr("class")), n(this).toggleClass("checked")
    }, ".wxlogin-protocol label"), orz.click(function () {
        n(this).hasClass("modal-open") && ("微信" == orz.getDevice() ? (location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf2e43f74fc6a84c7&redirect_uri=" + encodeURIComponent("https://www.uisdc.com/ajax.php?action=wechat_login&redirect=" + location.href) + "&state=wechat_login&response_type=code&scope=snsapi_userinfo#wechat_redirect", n("#modal_login").hide()) : n("#wechatEwm").attr("src", uisdc.loginEWM))
    }, '[data-modal-id="modal_login"]'), "微信" == orz.getDevice() && (n(".header .login-panel").addClass("wechat-login"), orz.click(function () {
        return !1
    }, ".header .login-panel .avatar_a")))
}, function (t, e) {
    !function (r) {
        var n = r(".auto_menu");
        if (!(n.length < 1)) {
            var t = r(".fixed-right .menus");
            if (!(t.length < 1)) {
                var e = r(".widget-article-menu");
                e.length < 1 || (e.removeClass("hidden"), e.append(function a() {
                    var e = '<h2 class="widget-title">文章目录</h2>';
                    return e += '<div class="widget-content divNeedScroll"><ul>', n.each(function () {
                        var t = "menu_" + n.index(r(this));
                        r(this).attr("id", t), e += '<li> <a href="#' + t + '">' + r(this).text() + "</a> </li>"
                    }), e += "</ul></div>"
                }()), t.prepend('<span class="item article_menu"> <a href="#article_menu" data-sm="no"> <i class="icon-menu-font"></i> </a> </span>'), orz.divNeedScrollInit(), orz.click(function () {
                    if (!orz.md()) {
                        var t = r(this).attr("href");
                        return (o(t) ? i : function e(t) {
                            r(t).addClass("show_fixed")
                        })(t), !1
                    }
                }, ".article_menu a"), r("body").on("click", function (t) {
                    if (!orz.md()) {
                        t = t || window.event;
                        var e = "#article_menu";
                        o(e) && i(e)
                    }
                }), orz.click(function () {
                    if (!orz.md()) {
                        var t = "#article_menu";
                        o(t) && i(t)
                    }
                }, "#article_menu a"), r(window).on("scroll", function () {
                    var e = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0,
                        n = 0;
                    r(".auto_menu").map(function (t) {
                        r(this).offset().top < e + 70 && (n = t)
                    }), n < 0 && (n = 0), r(".sidebar-fixed .widget-article-menu li").removeClass("current").eq(n).addClass("current")
                }))
            }
        }

        function o(t) {
            return r(t).hasClass("show_fixed")
        }

        function i(t) {
            r(t).removeClass("show_fixed")
        }
    }(jQuery)
}, function (t, e) {
    var n, r, o, i, a, s, c, l, u, d;
    n = jQuery, r = orz.attr("target"), o = orz.attr("body-scroll"), i = orz.removeClass("show"), s = a = 0, c = function c() {
        var e = this;
        return s = (new Date).getTime(), a = setTimeout(function () {
            var t = r(e);
            l(".part-dropdown"), n("#" + t).addClass("show"), "no" == o(e) && n("body").addClass("hideScroll")
        }, 100), !1
    }, l = function l() {
        clearTimeout(a), i(".part-dropdown"), n("body").removeClass("hideScroll")
    }, u = function u() {
        (new Date).getTime() - s < 100 && l()
    }, d = function d() {
        n(".part-dropdown.show").hasClass("dropdown-search") || l()
    }, orz.hover(l, null)('.header a:not([data-component="dropdown-click"])'), orz.hover(c, u, '[data-component="dropdown"]'), orz.outClick(l, ".part-dropdown .container"), orz.hover(null, d, ".part-dropdown .container"), orz.click(c, '[data-component="dropdown-click"]'), orz.click(l, ".dropdown-close"), n("body").on("mouseleave", function (t) {
        t.clientY <= 0 && l()
    })
}, function (t, e) {
    var s;
    (s = jQuery)("[data-component=simpleUpSlide]").each(function () {
        var t = s(this).children("ul");
        if (!(t.length < 1)) {
            var e = t.children("li");
            if (!(e.length < 1)) {
                var n = 1e3, r = 3e3, o = e.outerHeight(), i = 0;
                setTimeout(function a() {
                    ++i >= e.length && (i = 0), t.animate({top: 0 - i * o}, n), setTimeout(a, r)
                }, r)
            }
        }
    })
}, function (t, e) {
    var i, n, a, s, c, l, u, d, r, h, f, m, p, v, o, g, z, y, w, b, k, _, C, mb;
    i = jQuery,
        n = '[data-component="tab"]',
        a = orz.attr("tab-wrap"),
        s = orz.attr("tab-target"),
        c = orz.attr("tab-menus"),
        l = orz.attr("tab-action"),
        u = orz.attr("tab-type"),
        d = orz.attr("ppp"),
        r = orz.attr("event"),
        h = function h(t) {
            return 0 < i(t).children().length
        },
        f = function f(t) {
            i(t).removeClass("hidden")
        },
        m = function m(t) {
            i(t).children().addClass("hidden")
        },
        p = function p(t) {
            i(t).removeClass("current")
        },
        v = function v(t) {
            i(t).addClass("current")
        },
        o = function o(t) {
            var e = '<div class="list-item-default flex">';
            return e += '<div class="item-thumb">', e += '<a href="' + t.href + '" class="h-scale" target="_blank"> <i class="thumb " style="background-image:url(' + t.img + ')"></i> </a>', e += "</div>", e += '<div class="item-content">', e += '<a href="' + t.href + '" target="_blank">', e += '<h2 class="title">  ' + t.title + "  </h2>", e += "<p>" + t.content + "</p>", e += "</a>", e += '<h4> <i class="views">' + t.views + ' 人阅读</i> <i class="time">' + t.time + '</i> <i class="author"> ', t.uLink && (e += '<a href="' + t.uLink + '" target="_blank"> '), e += t.author, t.uLink && (e += " </a>"), e += " </i>", e += "</h4>", e += "</div>", e += "</div>"
        },
        g = function g(t, e) {
            return '<li class="list-item-txt"> <h2 class="title"> <a href="' + t.href + '" target="_blank"> <span class="num">' + (e + 1) + "</span> " + t.title + " </a> </h2> </li>"
        },
        z = function z(t) {
            var e = '<li class="item"><h2 class="title"> <a href="' + t.href + '" target="_blank"> ' + t.title + ' </a> </h2><h4><i class="time">' + t.time + '</i><i class="author">推荐： <a href="' + t.uLink + '" target="_blank"> ' + t.author + ' </a> </i><span class="tags">';
            return t.tags && orz.isArray(t.tags) && orz.map(function (t) {
                e += '<a href="/tag/' + t.slug + '" target="_blank">' + t.name + "</a>"
            }, t.tags), e += "</span></h4></li>"
        },
        y = {"list-default": o, "list-simple": g, "list-post": z},
        w = function w(t, e, n) {
            var r = "", o = u(t);
            orz.map(function (t, e) {
                r += y[o](t, e)
            }, e), i(n).html(r)
        },
        b = function b(t) {
            var e = a(this), n = s(this), r = c(this);
            l(this);
            if (orz.isNotEmpty(t) && (t = orz.jsonDecode(t), orz.isNotEmpty(t))) {
                var o = t.data;
                orz.isNotEmpty(o) && (w(this, o, n), m(e), f(n), p(r), v(this))
            }
        },
        mb = function mb(t) {
            var e = a(t), n = s(t), r = c(t);
            l(t);
            v(t);
            m(e), f(n), p(r), v(t);
        },
        k = function k(t) {
            var e = a(t), n = s(t), r = c(t), o = {action: l(t), ppp: d(t)};

            return h(n) ? (m(e), f(n), p(r), v(t)) : orz.post(b, o, t, mb(t)), !1
        },
        _ = orz.click(function () {
            if ("hover" != r(this)) return k(this)
        }),
        C = orz.hover(function () {
            "hover" == r(this) && k(this)
        }, i.noop), _(n), C(n)
},

    function (t, e) {
        function n() {
            orz.md() && l('[data-component="autofixed"]').each(function () {
                document.documentElement.clientHeight;
                var t = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0,
                    e = l(this), n = l(u(e)), r = l(d(e)), o = n.offset().top, i = r.offset().top, a = h(e), s = o - a,
                    c = i + r.outerHeight() - e.outerHeight() - a;
                e.removeClass("autofixed-fixed"), e.removeClass("autofixed-absolute"), s <= t && t <= c && e.addClass("autofixed-fixed"), c < t && e.addClass("autofixed-absolute")
            })
        }

        var l, u, d, h;
        l = jQuery, u = orz.attr("start"), d = orz.attr("end"), h = orz.attr("top"), n(), l(window).on("scroll", orz.scroll(n)), l(window).resize(n)
    }

    ,

    function (t, e) {
        var i, a;
        i = jQuery, a = orz.attr("autofixed"), function n() {
            i('[data-component="sidebar-autofixed"]').each(function () {
                var t = a(this), e = i(this).children(".sidebar-fixed");
                if (orz.isNotEmpty(t)) {
                    var n = i(t);
                    if (0 < n.length) {
                        var r = i(this).children(".widget"), o = (r.length, !1);
                        n.each(function () {
                            var t = n.index(i(this));
                            o = i(this)[0] == r.eq(r.length - n.length + t)[0]
                        }), e.append(n.clone(!0, !0)), o && (n.addClass("hidden"), e.addClass("show"))
                    }
                }
            })
        }()
    }

    ,

    function (t, e) {
        function n(t) {
            return l(t).attr("data-id")
        }

        function i(t, e) {
            var n = function o(t) {
                return l(t).attr("data-count") || 0
            }(t), r = function i(t) {
                return l(t).attr("data-original-count") || 0
            }(t);
            e = 0 < e ? +r + e : +n + e, l(u).filter('[data-id="' + l(t).attr("data-id") + '"]').children("em").html(e), l(u).filter('[data-id="' + l(t).attr("data-id") + '"]').attr("data-count", e)
        }

        function a() {
            l(u).each(function () {
                l(this).removeClass("has_fav"), c(n(l(this))) ? (l(this).addClass("has_fav"), l(this).find(".txt").html("已收藏"), function e(t) {
                    return i(t, 1)
                }(this)) : l(this).find(".txt").html("收藏")
            })
        }

        function s() {
            return orz.currentUser.fav || []
        }

        function c(t) {
            var e = s();
            return 0 <= orz.inArray(t, e)
        }

        var l, u, r;
        l = jQuery, u = "[data-component=fav]", r = orz.click(function () {
            if (!orz.currentUser) return orz.showLogin(), !1;
            var t = n(this);
            return c(t) ? (function r(e) {
                if (c(e)) {
                    var t = s();
                    t = orz.filter(function (t) {
                        return t != e
                    }, t), orz.currentUser.fav = t;
                    var n = {action: "fav", "do": "remove", uid: orz.currentUser.id, pid: e};
                    orz.post(l.noop, n, this)
                }
            }(t), function e(t) {
                return i(t, -1)
            }(this)) : function o(t) {
                if (!c(t)) {
                    var e = s();
                    e.unshift(+t), orz.currentUser.fav = e;
                    var n = {action: "fav", "do": "add", uid: orz.currentUser.id, pid: t};
                    orz.post(function (t) {
                        if (t && ((t = orz.jsonDecode(t)) && "done" == t.data)) return;
                        location.href = location.href + "#login", location.reload()
                    }, n, this)
                }
            }(t), a(), !1
        }), l(document).on("userLogged", a), r(u)
    }

    ,

    function (t, e) {
        function n(t, e) {
            var n = function r(t) {
                return o(t).attr("data-count") || 0
            }(t);
            o(t).children(".count").html(+n + e)
        }

        var o, r, i, a, s, c, l;
        o = jQuery, r = "[data-component=zan]", i = function i(t) {
            return {action: "zan", pid: orz.attr("pid", o(t)), cid: orz.attr("cid", o(t))}
        }, a = function a(t) {
            var e = orz.attr("pid", o(t)), n = orz.attr("cid", o(t));
            0 < e ? orz.set_post_zan(e) : 0 < n && orz.set_comment_zan(n)
        }, s = function s(t) {
            var e = orz.attr("pid", o(t)), n = orz.attr("cid", o(t));
            return 0 < e ? orz.has_post_zan(e) : 0 < n && orz.has_comment_zan(n)
        }, c = orz.post(function (t) {
            orz.done(this)
        }), l = orz.click(function () {
            if (!orz.isPending(this)) {
                var t = i(this), e = c(t);
                orz.pending(this), o(this).hasClass("has_zan") ? orz.done(this) : (e(this), a(this), orz.zanInit())
            }
        }), orz.zanInit = function () {
            o(r).each(function () {
                o(this).removeClass("has_zan"), s(this) && (o(this).addClass("has_zan"), o(this).find(".txt").html("已赞"), function e(t) {
                    return n(t, 1)
                }(this))
            })
        }, l(r), orz.zanInit()
    }

    ,

    function (t, e) {
        function n() {
            l(o).removeClass("show")
        }

        function r() {
            var t = l(".zoom_in");
            t.length < 1 || (t.removeClass("zoom_in"), t.css({
                transform: "none",
                width: "auto",
                height: "auto"
            }), t.children("img").css({"max-width": "100%"}), l(".modal-mark").removeClass("modal-show"), l(".modal-mark").removeClass("modal-show-for-img"), l("html,body").scrollTop(d))
        }

        var l, u, o, d, h, i;
        l = jQuery, u = ".img-zoom", o = ".img-pn-btn", h = d = 0, i = orz.click(function () {
            document.documentElement.clientWidth;
            if (!orz.md()) return !1;
            l(this).hasClass("zoom_in") ? (r(), n()) : (function c(t) {
                var e = document.documentElement.clientWidth, n = l(t).height(), r = l(t).outerWidth(),
                    o = l(t).offset(),
                    i = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
                nw = e, d = i;
                var a = 0 - o.left + e / 2 - r / 2, s = i - o.top + 58;
                h = l(u).index(l(t)), l(t).addClass("zoom_in"), l(t).css({
                    transform: "translate(" + a + "px," + s + "px)",
                    width: r,
                    height: n
                }), l(t).children("img").css({"max-width": e}), l(".modal-mark").addClass("modal-show"), l(".modal-mark").addClass("modal-show-for-img")
            }(this), function t() {
                l(o).addClass("show")
            }())
        }), orz.click(r, ".modal-show-for-img"), function a() {
            1 < l(u).length && l("body").append('<span class="prev-img img-pn-btn"> <i class="icon-left"></i> </span> <span class="next-img img-pn-btn"> <i class="icon-right"></i> </span>')
        }(), i(u), orz.click(function (t) {
            t.stopPropagation(), t.preventDefault();
            var e = h;
            return l(this).hasClass("prev-img") ? --e <= 0 && (e = 0) : ++e >= l(u).length && l(u).length, e != h && l(u).eq(h).trigger("click"), l(u).eq(e).trigger("click"), !1
        }, o), orz.click(n, ".modal-mark")
    }

    ,

    function (t, e) {
        var n, r, o, i, a, s, c, l, u;
        n = jQuery, r = '[data-component="open-division"]', o = orz.attr("target"), i = orz.attr("event"), a = function a(t) {
            var e = o(t);
            n(e).addClass("show")
        }, s = function s(t) {
            var e = o(t);
            n(e).removeClass("show")
        }, c = orz.click(function () {
            return "click" == i(this) && a(this), !1
        }), l = orz.outClick(function () {
            "click" == i(this) && s(this)
        }), u = orz.hover(function () {
            "hover" == i(this) && a(this)
        }, function () {
            "hover" == i(this) && s(this)
        }), c(r), l(r), u(r)
    }

    ,

    function (t, e) {
        function f(t) {
            p(t).removeClass("disable")
        }

        function m(t) {
            p(t).addClass("disable")
        }

        function n(t, e) {
            var n = p(t).children("ul");
            if (1 == n.length) {
                var r = n.children("li");
                if (!(r.length < 1)) {
                    n.stop(!0, !0);
                    var o = p(t).width() - p(t).children(".fy").outerWidth(), i = n.width(), a = r.filter(".current");
                    a.length < 1 && (a = r.eq(0));
                    var s = r.index(a), c = s - e, l = 0, u = 0;
                    if (e < 0) for (u = s; u < r.length && (c = u, l < o); u++) l += r.eq(u).outerWidth(); else for (u = s - 1; 0 <= u && l < o; u--) l += r.eq(u).outerWidth(), c = u;
                    c >= r.length - 1 && (c = r.length - 1, l -= r.eq(r.length - 1).outerWidth()), c < 0 && (c = 0);
                    var d = parseFloat(n.css("left"));
                    (0 < c ? f : m)(p(t).find(".prev"));
                    var h = d + e * l;
                    0 <= h && (h = 0), (i <= o - h ? m : f)(p(t).find(".next")), n.animate({left: h}, 50, function () {
                        r.removeClass("current").eq(c).addClass("current")
                    })
                }
            }
        }

        function o(t) {
            return n(t, 1)
        }

        function i(t) {
            return n(t, -1)
        }

        function r() {
            p(".auto-scroll-menu").each(function () {
                var t = p(this), e = p(this).children("ul");
                1 == e.length && (t.width() < e.width() ? function n(t) {
                    p(t).hasClass("need-scroll") || (p(t).addClass("need-scroll"), p(t).append('<div class="fy"><span class="prev disable"><i class="icon-left"></i></span><span class="next"><i class="icon-right"></i></span></div>'), p(t).find(".fy span").on("click", function () {
                        p(this).hasClass("disable") || (p(this).hasClass("prev") ? o : i)(t)
                    }), touchEvent.swipeRight(p(t)[0], function () {
                        o(t)
                    }), touchEvent.swipeLeft(p(t)[0], function () {
                        i(t)
                    }))
                } : function r(t) {
                    p(t).removeClass("need-scroll"), p(t).children(".fy").remove()
                })(t)
            })
        }

        var p, a, s;

        function c() {
            if (orz.md()) s.children(".menu-r").children("ul").children(".menu-item").remove(); else {
                if (0 < s.children(".menu-r").children("ul").children(".menu-item").length) return;
                s.children(".menu-r").children("ul").prepend(s.children(".menu").children("li").clone(!0, !0)), s.children(".menu-r").find(".menu-item a").attr("data-tab-menus", ".article-menus .menu-r a")
            }
        }

        p = jQuery, setTimeout(r, 10), p(window).on("resize", r), a = jQuery, (s = a(".article-menus")).length < 1 || (c(), a(window).on("resize", c))
    }

    ,

    function (t, e) {
        var l;
        (l = jQuery)(".scroll-h").each(function () {
            var t = l(this), e = t.children("ul");
            if (!(e.length < 2)) {
                var n = 0, r = e.length, o = t.parent().siblings(".hf-widget-title").children(".pages");
                !function c() {
                    if (!(0 < o.length)) {
                        t.parent().siblings(".hf-widget-title").append('<div class="pages"><i class="prev"> <i class="icon-left"></i> </i><i class="next"> <i class="icon-right"></i> </i></div>'), o = t.parent().siblings(".hf-widget-title").children(".pages")
                    }
                }();
                var i = o.children(".prev"), a = o.children(".next");
                i.on("click", function () {
                    !function t() {
                        --n < 0 && (n = r - 1)
                    }(), s()
                }), a.on("click", function () {
                    !function t() {
                        r <= ++n && (n = 0)
                    }(), s()
                }), touchEvent.swipeLeft(this, function () {
                    a.trigger("click")
                }), touchEvent.swipeRight(this, function () {
                    i.trigger("click")
                })
            }

            function s() {
                e.addClass("holdon"), e.removeClass("holdon-prev"), e.eq(n).removeClass("holdon"), e.eq(n - 1).addClass("holdon-prev")
            }
        })
    }

    ,

    function (t, e) {
        function n() {
            var t = document.documentElement.clientWidth, e = r(".header .container").outerWidth(), n = 0 - e / 2;
            o.removeClass("only-icon"), o.css({"margin-left": n}), orz.show(o), (t - e) / 2 < o.outerWidth() && o.addClass("only-icon")
        }

        var r, o;
        r = jQuery, (o = r(".fixed-sidebar")).length < 1 || (n(), r(window).on("resize", n))
    }

    ,

    function (t, e) {
        !function (e) {
            var t = e(".modal-menu");
            if (!(t.length < 1)) {
                var n = t.children(".modal-content");
                if (!(n.length < 1)) {
                    var r = e(".search-content .form"), o = e(".menu-primary");
                    !function i() {
                        n.append(r.clone()), n.append(o.clone().attr("class", "menu").attr("id", "")), n.find('[data-component="dropdown"]').each(function () {
                            var t = e("#" + e(this).attr("data-target"));
                            t.length < 1 || (e(this).parent().addClass("has-children"), e(this).after(t.find(".section-content").eq(0).clone().addClass("sub-nav")), e(this).attr("data-component", ""))
                        }), n.append(e('<div class="site-info">优设网是国内极具人气的设计平台 <br> 2012年成立至今，一直专注于设计师的学习成长交流</div>'))
                    }(), orz.click(function () {
                        return e(this).parent().hasClass("show") || e(".modal-menu .has-children").removeClass("show"), e(this).parent().toggleClass("show"), !1
                    }, ".modal-menu .has-children .link-0")
                }
            }
        }(jQuery)
    }

    ,

    function (t, e) {
        var s, c, l;
        jQuery, s = 0, c = document.getElementsByTagName("body")[0], l = (l = "富强,民主,文明,和谐,自由,平等,公正,法治,爱国,敬业,诚信,友善,你太棒了~,你发现了~,优设~,隐藏彩蛋！,你知道吗？,蓝剑蓝剑天下无敌！,学设计从这里开始,最后,优设,谢谢你,一直的支持,爱你哟~").split(","), orz.click(function (t) {
            var e = document.createElement("b"), n = 0;
            e.style.color = "#ff5c00", e.style.zIndex = 9999, e.style.position = "absolute", e.style.select = "none";
            var r = t.pageX, o = t.pageY;
            e.style.left = r - 10 + "px", e.style.top = o - 20 + "px", clearInterval(i), ++s % 2 == 1 ? e.innerText = "❤" : ((n = s / 2 % l.length - 1) < 1 && (n = l.length - 1), e.innerText = l[n]), e.style.fontSize = 10 * Math.random() + 8 + "px";
            var i, a = 0;
            setTimeout(function () {
                i = setInterval(function () {
                    150 == ++a && (clearInterval(i), c.removeChild(e)), e.style.top = o - 20 - a + "px", e.style.opacity = (150 - a) / 120
                }, 8)
            }, 70), c.appendChild(e)
        }, '[data-bubble="yes"]')
    }

    ,

    function (t, e) {
        !function (t) {
            var e = t(".all-zt-main");
            if (!(e.length < 1)) {
                var n = e.children(".item"), r = e.parent().siblings(".zt-rest"), o = function o() {
                    return 0 < e.find(".more").length
                }, i = function i() {
                    return '<span class="item more"> <a href="#"><em>更多 <i class="icon-right"></i> </em></a> </span>'
                }, a = function a() {
                    return t(this).addClass("hidden"), r.addClass("show"), !1
                }, s = function s() {
                    e.find(".more").removeClass("hidden"), r.removeClass("show")
                };
                0 < r.length && (o() || n.eq(8).after(i()), e.find(".more").on("click", a), orz.outClick(s, ".all-zt .container"), orz.hover(t.noop, s, ".all-zt .container"))
            }
        }(jQuery)
    }

    ,

    function (t, e) {
        jQuery(function (r) {
            var t = r(".single-post");
            if (t.length < 1 && (t = r(".single-hunter")), t.length < 1 && (t = r(".single-talk")), t.length < 1 && (t = r(".single-job")), !(t.length < 1)) {
                var o = orz.match(/\bpostid-(\d+)\b/), i = function i(t) {
                    var e = r(t).attr("class"), n = o(e);
                    return orz.isArray(n) ? n[1] : 0
                }, e = i(t), n = {action: "views", id: e};
                0 < e && orz.post(function () {
                }, n, this)
            }
        })
    }

    ,

    function (t, e) {
        !function (r) {
            if (!(r(".news-body").length < 1)) {
                var o = r("[data-component=news-more]"), i = r("[data-component=loading]"), a = r(".news-content"),
                    s = orz.attr("paged"), c = function c(t, e) {
                        orz.setAttr("paged", e, t)
                    }, t = orz.click(function () {
                        return o.hide(), i.show(), function e() {
                            var t = {action: "get_news", pd: s(o)};
                            orz.post(n, t, null)
                        }(), !1
                    });
                i.hide(), l(), t("[data-component=news-more] .btn")
            }

            function l() {
                var t = r("[data-views=no]");
                if (!(t.length < 1)) {
                    var e = [];
                    t.each(function () {
                        e.push(orz.attr("pid", this))
                    });
                    var n = {action: "views", ids: e};
                    orz.post(function () {
                    }, n, null), t.attr("data-views", "yes")
                }
            }

            function n(t) {
                if (!orz.isEmpty(t)) {
                    var e = (t = orz.jsonDecode(t)).data, n = +t.total;
                    if (!orz.isEmpty(e)) {
                        a.append(e);
                        var r = s(o);
                        r = +r, ++r < n && (c(o, r), o.show()), l()
                    }
                }
                i.hide()
            }
        }(jQuery)
    }

    ,

    function (t, e) {
        var n, r, o, i, a;
        n = jQuery, r = orz.attr("url"), o = function o() {
            return '<div id="qr" class="qr_box modal-qr modal-show"><div class="show_qr"><h2>把好文章收藏到微信</h2><div id="url_qr"></div><p>打开微信，扫码分享<br>学设计 <span>优设网</span> 在这里</p><span class="close modal-close" data-modal-id="qr"><i class="icon-close"></i></span></div></div>'
        }, i = function i(t) {
            n("#url_qr").html(""), n("#url_qr").qrcode({text: t})
        }, a = function a() {
            return 0 < n("#qr").length
        }, orz.click(function () {
            var t = r(this);
            return orz.log(a()), a() || n("body").append(o()), i(t), !1
        })('[data-modal-id="qr"]')
    }

    ,

    function (t, e) {
        var n, r, o, i, a, s, c, l, u, d, h;

        function f() {
            l.css({"margin-left": 0 - c(".page-content").width() / 2}), l.addClass("show")
        }

        function m() {
            if (!orz.md()) return !1
        }

        n = jQuery, orz.click(function () {
            n(this).siblings(".share-div").toggleClass("show")
        }, ".gongneng .btn-share"), orz.outClick(function () {
            n(".share-div").removeClass("show")
        }, ".gongneng .btn-share"), r = jQuery, o = 0, orz.click(function (t) {
            clearTimeout(o), r(".copyTip").remove(), r(this).children(".copy-content").select(), document.execCommand("copy");
            return function n(t, e) {
                r("body").append('<div class="copyTip">' + t + "</div>"), o = setTimeout(function () {
                    var t = r(e).offset();
                    r(".copyTip").addClass("show"), r(".copyTip").css({
                        left: t.left + r(e).outerWidth() / 2 - 20,
                        top: t.top - r(".copyTip").outerHeight() - 15
                    })
                }, 50), o = setTimeout(function () {
                    r(".copyTip").removeClass("show")
                }, 500), o = setTimeout(function () {
                    r(".copyTip").remove()
                }, 1e3)
            }("已复制", this), !1
        }, ".copy-link"), i = jQuery, a = orz.attr("url"), s = orz.attr("title"), orz.click(function () {
            var t = a(this), e = s(this);
            return orz.isEmpty(t) && (t = location.href), orz.isEmpty(e) && (e = i("title").text()), function r(t, e) {
                try {
                    window.external.addFavorite(e, t)
                } catch (n) {
                    try {
                        window.sidebar.addPanel(t, e, "")
                    } catch (n) {
                        alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请使用Ctrl+D进行添加")
                    }
                }
            }(e, t), !1
        }, ".btn-fav"), c = jQuery, (l = c(".page-sidebar")).length < 1 || (f(), c(window).resize(f)), function (i) {
            if (!(i("body.single").length < 1)) {
                var r = orz.match(/\bpostid-(\d+)\b/), a = function a(t) {
                    var e = i(t).attr("class"), n = r(e);
                    return orz.isArray(n) ? n[1] : 0
                };
                i(document).on("userLogged", function () {
                    var t = function o() {
                        var t = i(".post-header .post-title");
                        return t.length < 1 && (t = i(".zt-singular-header .block-main>h2")), t.length < 1 && (t = i(".hunter-singular-main .title")), t.length < 1 && (t = i(".job-header-main .job-title")), t.length < 1 && (t = i()), t
                    }(), e = a(i("body")), n = orz.currentUser.menus.edit || "";
                    if (orz.isNotEmpty(n)) {
                        var r = '<span class="edit_btn"> <a href="' + (n.replace("edit", "post") + "?post=" + e + "&action=edit") + '" class="btn btn-orange">编辑</a> </span>';
                        t.append(r)
                    }
                })
            }
        }(jQuery), u = jQuery, "IE浏览器" == orz.getDevice() && u("head").append('<link rel="stylesheet" href="https://www.uisdc.com/app/themes/U/ui/css/ie.css" type="text/css" media="all" />'), jQuery, orz.click(m, ".post-recommend .recommend-titles a"), orz.click(m, ".widget-post-tabs .tabs-title a"), orz.click(function () {
            if (!orz.lg()) return !1
        }, '[data-component="dropdown"]'), (d = jQuery)("a").tap(function (t) {
            if (!orz.md()) {
                var e = d(this).attr("href");
                orz.isNotEmpty(e) && (window.location = e)
            }
            return !1
        }), function (t) {
            var e = t(".widget-hunter-revealed");
            if (!(e.length < 1)) {
                var n = e.children(".widget-content");
                n.length < 1 || (r(), t(window).on("resize", r))
            }

            function r() {
                if (orz.md() && !orz.lg()) {
                    var t = parseFloat(n.css("padding-top")), e = parseFloat(n.css("padding-bottom"));
                    n.height(Math.floor(370 * n.outerWidth() / 314 - t - e))
                }
            }
        }(jQuery), function () {
            if (window.app_native && window.app_native.onReceivedTouchIcons) {
                var i = [];
                !function n() {
                    normalElements = document.querySelectorAll("link[rel='apple-touch-icon']"), precomposedElements = document.querySelectorAll("link[rel='apple-touch-icon-precomposed']"), e(normalElements), e(precomposedElements);
                    var t = JSON.stringify(i);
                    window.app_native.onReceivedTouchIcons(document.URL, t)
                }()
            }

            function e(t) {
                for (var e, n = t.length, r = 0; r < n; r++) {
                    var o = {sizes: (e = t[r]).hasAttribute("sizes") ? e.sizes[0] : "", rel: e.rel, href: e.href};
                    i.push(o)
                }
            }
        }(jQuery), (h = jQuery)("body").on("change", ".select-go", function () {
            location.href = h(this).val()
        }), function (o) {
            var i = o(".fixed-right");
            if (!(i.length < 1)) {
                var a = i.outerHeight();
                t(), o(window).on("scroll", t)
            }

            function t() {
                var t = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0,
                    e = o(".footer-navi"), n = e.offset(), r = document.documentElement.clientHeight;
                e.length < 1 || (t + r > n.top + a + 50 ? i.addClass("hidden") : i.removeClass("hidden"))
            }
        }(jQuery)
    }

    ,

    function (t, e) {
        jQuery(function (o) {
            function i(t, e) {
                orz.show(o(e).find(".error")).children("p").html(t)
            }

            o(".is_anonymous").on("change", function () {
                o(this).prop("checked") ? o(this).val("yes") : o(this).val("no")
            }), o("body").on("focusin", ".talk_title", function () {
                !function e(t) {
                    orz.hidden(o(t).find(".error"))
                }(o(this).parent().parent())
            }), o(".talk_write_form").on("submit", function () {
                var t = orz.trim(orz.get_form_item_val("talk_title", this)),
                    e = orz.trim(orz.get_form_item_val("talk_desc", this)),
                    n = orz.get_form_item_val("is_anonymous", this),
                    r = "";
                return orz.isEmpty(t) && (r += "请输入标题"), orz.isNotEmpty(r) ? i(r, o(this)) : orz.post(function (t) {
                    var e = "";
                    if ((t = orz.jsonDecode(t)) ? orz.isNotEmpty(t.error) && (e = t.error) : e = "出错了，请重试。", orz.isNotEmpty(e)) return i(e, this), !1
                }, {action: "post_talk", title: t, desc: e, is_anonymous: n}, this), !1
            })
        })
    }

    ,

    function (t, e) {
        jQuery, orz.get_comments_html = function (t, o) {
            var i = "";
            return orz.isArray(t) && orz.map(function (t) {
                var e = t.author_url, n = t.approved, r = t.content;
                i += '<div class="comment-item appr_' + n + " " + (o ? "animated flash" : "") + " level_" + (0 < t.parent ? "1" : "0") + '" id="comment_' + t.id + '">', i += '<div class="item-avatar">', orz.isNotEmpty(e) && (i += '<a href="' + e + '" target="_blank">'), i += '<i class="thumb" style="background-image:url(' + t.avatar + ');"></i>', orz.isNotEmpty(e) && (i += "</a>"), i += "</div>", i += '<div class="item-content">', i += '<div class="item-main">', i += '<h3 class="item-title">', orz.isNotEmpty(e) && (i += '<a href="' + e + '" target="_blank">'), i += t.author, orz.isNotEmpty(e) && (i += "</a>"), t.parent_author && (i += ' <small>回复给 <a href="#comment_' + t.parent + '">' + t.parent_author + "</a> </small>"), 1 != n && (i += '<span class="pending">评论审核中</span>'), 1 == t.is_sticky && (i += '<span class="sticky">置顶</span>'), i += "</h3>", i += '<div class="item-entry">' + r + "</div>", i += "</div>", i += '<h4 class="meta">', i += "<span>" + orz.getDateDiff(t.time) + "</span>", i += "<span>来自 " + (t.city || "宇宙") + "</span>", i += "<span>" + t.device + "</span>", 1 == n && (i += '<span> <em class="btn-reply" data-cid="' + t.id + '">回复</em> </span>', i += '<span> <em class="btn-zan ' + (0 < t.zan ? "zans" : "") + '"  data-component="zan" data-cid="' + t.id + '" data-count="' + t.zan + '">点赞 <i class="count">' + (t.zan || "") + "</i> </em> </span>"), orz.currentUser && "editor" == orz.currentUser.is && t.parent <= 0 && (1 == t.is_sticky ? i += '<span class="sticky_btn has_sticky" data-cid="' + t.id + '">取消置顶</span>' : i += '<span class="sticky_btn no_sticky" data-cid="' + t.id + '">置顶</span>', 1 != t.is_recommend ? i += '<span class="comment_to_btn" data-action="comment_to_home" data-cid="' + t.id + '">推送热评</span>' : i += '<span class="comment_to_btn" data-action="remove_comment_to_home" data-cid="' + t.id + '">移除热评</span>'), i += "</h4>", i += "</div>", i += "</div>"
            }, t), i
        }, function (t) {
            var e = t(".comment-div");
            if (!(e.length < 1)) {
                var n = e.children(".section-title").children(".sub");
                t(document).on("userNotLogged", function () {
                    n.html('点击 <span class="modal-open clr_orange" data-modal-id="modal_login">登录</span> 微信，亮头像秀观点，' + n.html())
                })
            }
        }(jQuery), function (s) {
            if (!(s(".comment-div").length < 1)) {
                var i = s(".comment-write"), t = (s(".comment-list"), ".comment-write .comment-word"),
                    e = ".comment-write .form-yzm img", c = ".comment-write .btn-submit", n = orz.get_form_item_val,
                    a = orz.attr("total"), l = n("user-name"), u = n("comment"), d = n("prefix"), h = n("yzm"),
                    f = n("pid"), m = n("parent"), p = "";
                r(), v(".lineLen"), s(window).on("resize", r), s(document).on("userLogged", function b() {
                    i.addClass("userLogged"), function e() {
                        var t = orz.currentUser.avatar;
                        s(".comment-write .user-avatar .thumb").css({"background-image": "url(" + t + ")"})
                    }(), function n() {
                        var t = orz.currentUser.name;
                        s(".comment-write .user-name").html(t)
                    }()
                }), s(document).on("userNotLogged", function k() {
                    i.addClass("userNotLogged")
                }), s("body").on("keyup", t, o), s("body").on("mouseup", t, o), s("body").on("focus", t, function _() {
                    y(), i.hasClass("userNotLogged") && function e() {
                        var t = s(".form-yzm");
                        t.removeClass("hidden"), t.find("img").trigger("click")
                    }()
                }), s("body").on("focus", ".comment-write .comment-yzm", function C() {
                    y()
                }), s("body").on("click", e, g), s("body").on("submit", ".comment-write", function j() {
                    if (orz.isPending(c)) return !1;
                    var t, e = "", n = "", r = "", o = f(this), i = m(this);
                    t = u(this), s(this).hasClass("userNotLogged") && (e = l(this), n = d(this), r = h(this));
                    var a = {
                        action: "post_comment",
                        uName: e,
                        comment: t,
                        prefix: n,
                        yzm: r,
                        pid: o,
                        parent: i,
                        city: "",
                        device: orz.getDevice()
                    };
                    return returnCitySN && (a.city = returnCitySN.cname), orz.isEmpty(t) ? z("请输入评论内容") : s(this).hasClass("userNotLogged") && orz.isEmpty(r) ? z("请输入验证码") : t == p ? z("不可以发一样的评论喔。") : (orz.pending(c), orz.post(w, a, null)), !1
                }), s("body").on("click", ".error-box .close", y)
            }

            function r() {
                s(".lineLen").each(function () {
                    var t = parseInt(s(this).css("font-size")), e = s(this).width(),
                        n = parseInt(s(this).css("padding-left")), r = parseInt(s(this).css("padding-right"));
                    orz.setAttr("line", Math.ceil(2 * (e - n - r) / t), s(this))
                })
            }

            function v(t) {
                var e = s(t).val();
                orz.isEmpty(e) && (e = s(t).attr("data-placeholder"));
                for (var n = orz.attr("line", t), r = parseInt(s(t).css("line-height")), o = 1, i = 0, a = 0; a < e.length; a++) 10 == e.charCodeAt(a) ? (i = 0, o++) : (127 < e.charCodeAt(a) ? i += 2 : i++, n <= i && (o++, i = 0));
                s(t).height(o * r)
            }

            function o() {
                v(this), function o(t) {
                    var e = s(t).val(), n = a(t), r = n - e.length;
                    e.length > n && (r = 0, e = e.substring(0, n - 1), s(t).val(e)), s(t).siblings(".rest").children("em").html(r)
                }(this)
            }

            function g() {
                var r = s(e);
                orz.post(function (t) {
                    r.attr("src", function e(t) {
                        return "/wp-content/themes/U/captcha/captcha.php?prefix=" + t + "&nonce=" + (new Date).getTime()
                    }(t)), function n(t) {
                        s('[name="prefix"]').val(t)
                    }(t)
                }, {action: "get_captcha"}, null)
            }

            function z(t) {
                s(".error-box").removeClass("hide").children(".item-content").html(t)
            }

            function y() {
                s(".error-box").addClass("hide").children(".item-content").html("")
            }

            function w(t) {
                if (orz.done(c), orz.isNotEmpty(t)) {
                    var e = orz.jsonDecode(t);
                    if (e) {
                        var n = e.data;
                        orz.isNotEmpty(n) ? (function r(t) {
                            html = orz.get_comments_html(t, !0), i.append(html)
                        }(n), p = n[0].content, function o() {
                            i.find('[name="comment"]').val(""), i.find('[name="yzm"]').val("")
                        }()) : z(e.error.join("<br>"))
                    } else z(t)
                } else z("评论失败，请重试");
                i.hasClass("userNotLogged") && g()
            }
        }(jQuery), function (e) {
            if (!(e(".comment-div").length < 1)) {
                var n = e(".comment-write"), i = e(".comment-list"), a = e(".content-loading"), s = e(".comment-more"),
                    c = e(".comment-nomore"), l = orz.attr("paged"), u = orz.attr("pid");
                t(), orz.click(t, ".btn-more-comments"), orz.click(function h() {
                    var t = orz.attr("cid", e(this));
                    e(this).parents(".meta").after(n), r(t), n.addClass("reply-write")
                }, ".btn-reply"), orz.click(function f() {
                    n.removeClass("reply-write"), r(0), i.before(n)
                }, ".btn-reply-close")
            }

            function t() {
                var t = l(i), e = {action: "get_comments", pid: u(i), pd: t};
                !function n() {
                    a.removeClass("hidden")
                }(), function r() {
                    s.addClass("hidden")
                }(), function o() {
                    c.addClass("hidden")
                }(), orz.post(d, e, null)
            }

            function o() {
                s.removeClass("hidden"), function e() {
                    var t = l(i);
                    t = +t, t++, orz.setAttr("paged", t, i)
                }()
            }

            function d(t) {
                if (t) {
                    var e = orz.jsonDecode(t);
                    e && (i.append(orz.get_comments_html(e.data)), orz.zanInit(), i.find(".item-entry a").attr("target", "_blank"), (20 <= e.data.length ? o : function n() {
                        0 < i.children(".comment-item").length && c.removeClass("hidden")
                    })())
                }
                !function r() {
                    a.addClass("hidden")
                }()
            }

            function r(t) {
                n.find('[name="parent"]').val(t)
            }
        }(jQuery), function (e) {
            if (!(e(".comment-div").length < 1)) {
                var r = orz.attr("cid"), o = function o(t) {
                    return e(t).hasClass("has_sticky")
                }, i = function i(t) {
                    if (orz.isNotEmpty(t)) {
                        if (t = orz.jsonDecode(t), orz.isEmpty(t)) return;
                        (1 == t.data.sticky ? n : a)(this)
                    }
                }, n = function n(t) {
                    e(t).addClass("has_sticky"), e(t).html("取消置顶")
                }, a = function a(t) {
                    e(t).removeClass("has_sticky"), e(t).html("置顶")
                };
                orz.click(function () {
                    var t = r(this), e = "no_sticky";
                    o(this) && (e = "has_sticky");
                    var n = {action: "comment_sticky", status: e, commentId: t};
                    return orz.post(i, n, this), !1
                })(".sticky_btn")
            }
        }(jQuery), function (e) {
            if (!(e(".comment-div").length < 1)) {
                var n = orz.attr("cid"), r = orz.attr("action");
                orz.click(function () {
                    var t = {action: r(this), cid: n(this)};
                    return e(this).remove(), orz.post(function (t) {
                        orz.log(t)
                    }, t, this), !1
                })(".comment_to_btn")
            }
        }(jQuery)
    }

    ,

    function (t, e) {
        var n;
        (n = jQuery)("body").on("click", '[data-target="search_dropdown"]', function () {
            setTimeout(function () {
                n("#search_dropdown").find("input.txt").trigger("focus")
            }, 500)
        }), function (t) {
            var e = t(".dropdown-search");
            if (!(e.length < 1)) {
                var n = e.find(".search-content");
                r(), t(window).on("resize", r)
            }

            function r() {
                var t = document.documentElement.clientHeight;
                n.css({"max-height": t - 59 - 50 - 50})
            }
        }(jQuery), function (n) {
            function r() {
                var t = orz.getCookie("search_history");
                return orz.isNotEmpty(t) && (t = orz.jsonDecode(t), !orz.isEmpty(t) && orz.isObject(t) || (t = {})), t
            }

            var c = orz.lpad("0", 2);

            function t(t) {
                var e, n, r, o, i, a = [];
                if (orz.isObject(t)) for (var s in t) t.hasOwnProperty(s) && a.unshift("<li><span>" + (o = t[s], i = void 0, (i = new Date).setTime(o), c(i.getMonth() + 1) + "-" + c(i.getDate()) + " " + c(i.getHours()) + ":" + c(i.getMinutes())) + '</span><a href="' + (r = s, orz.currentPageUrl() + "?s=" + r) + '" title="' + s + '">' + (n = 8, (e = s).length > n && (e = e.substring(0, n) + "..."), e) + '</a><i class="icon-close search-tag-close" data-tag="' + s + '"></i></li>');
                return orz.isEmpty(a) && (a = ["你还没搜索过喔。"]), (a = a.slice(0, 12)).join("")
            }

            var e = r(), o = t(e);
            0 < n("body.search").length && (!function a() {
                var t = r(), e = orz._get("s");
                orz.isNotEmpty(e) && (delete t[e = decodeURIComponent(e)], t[e] = (new Date).getTime(), orz.setCookie("search_history", orz.jsonEncode(t)))
            }(), function s() {
                var t = n(".search-widget-history .widget-title");
                if (!(t.length < 1)) {
                    var e = r();
                    0 < Object.keys(e).length && t.append('<span class="clear-all-history">全部清除</span>')
                }
            }());
            var i = n("#search_history");
            0 < i.length && (i.html(o), orz.isEmpty(e) && i.parents(".history").addClass("no-history")), orz.click(function l() {
                orz.setCookie("search_history", ""), n(this).remove(), n("#search_history").html(t({}))
            }, ".clear-all-history"), orz.click(function u() {
                var t = r();
                delete t[n(this).attr("data-tag")], orz.setCookie("search_history", orz.jsonEncode(t)), n(this).parent().remove()
            }, ".search-tag-close"), n(".search-item").on("click", function () {
                if (!orz.sm()) return document.location = n(this).children("h3").children("a").attr("href"), !1
            })
        }(jQuery)
    }

    ,

    function (t, e) {
        function n() {
            var t = i(".sidebar .divNeedScroll");
            if (!(t.length < 1)) {
                var e = document.documentElement.clientHeight, n = i(".sidebar-fixed");
                if (!(n.length < 1)) {
                    var r = 0, o = orz.attr("top", n);
                    0 < o && (r += +o), n.children(".widget").each(function () {
                        i(this).hasClass("widget-article-menu") ? (r += +parseFloat(i(this).css("padding-top")), r += +parseFloat(i(this).css("padding-bottom")), r += 52) : (r += +i(this).outerHeight(), r += +parseFloat(i(this).css("margin-bottom")))
                    }), t.css("max-height", e - r), orz.setAttr("scrollInit", "no", t), orz.divNeedScrollInit()
                }
            }
        }

        var i;
        i = jQuery, setTimeout(n, 1e3), i(window).on("resize", n)
    }

    ,

    function (t, e) {
        function n() {
            "#login" == location.hash && r(".modal-open[data-modal-id=modal_login]").trigger("click")
        }

        var r;
        (r = jQuery)(window).on("load", n), orz.hash.push(n)
    }

    ,

    function (t, e) {
        !function (t) {
            orz.currentUser = null;
            var e = orz.getCookie("currentUser");
            e ? (e = orz.jsonDecode(decodeURIComponent(e)), (orz.currentUser = e) && t(document).trigger("userLogged")) : t(document).trigger("userNotLogged")
        }(jQuery)
    }

    ,

    function (t, e) {
        var n, r;
        !function (i) {
            var a = i("#user_center");
            if (!(a.length < 1 || "user_center" != uisdc.page || uisdc.uid < 1)) {
                var s, c, l = {}, f = {}, t = i(".uc-header"), e = i(".user-center .user-avatar"),
                    n = i(".user-center .user-name"), r = i(".user-center .user-job"), o = i(".user-center .user-info"),
                    u = i(".views.count"), d = i(".publish.count"), h = i(".fav.count"), m = i(".user-menu"),
                    p = i(".uc-submenu"), v = i(".user-submenu"), g = i(".sub-title"), z = i(".uc-content .content"),
                    y = i(".uc-content .content .items"), w = i(".uc-content .content .pageds"),
                    b = i(".uc-content .content .pageds .go"), k = i(".uc-content .content .pageds .nav"),
                    _ = i(".mine-center"), C = i(".msg-center"), j = i(".setting-center"), x = !1,
                    E = (i(".user-job"), i(".user-company"), i(".user-info"), i("[data-prop]")),
                    T = {action: "user_center_info", uid: uisdc.uid};
                i("body").on("submit", ".setting-form", function () {
                    if (orz.isPending(this)) return !1;
                    var t = P("info"), e = P("company"), n = P("job");
                    if (orz.pending(this), t || e || n) {
                        var r = {action: "user_setting_save", info: t, company: e, job: n, uid: uisdc.uid};
                        orz.post(function (t) {
                            c = orz.deepCopy(s)
                        }, r, this)
                    }
                    return orz.done(this), function o() {
                        i(".error").addClass("show"), setTimeout(function () {
                            i(".error").removeClass("show")
                        }, 2e3)
                    }(), !1
                });
                var O = {
                    post: function W(t) {
                        var e = '<div class="item">';
                        return e += '<div class="item-post">', e += '<div class="item-thumb">', e += '<a href="' + t.href + '" class="h-mark" target="_blank">', e += '<i class="thumb" style="background-image:url(' + t.image + ');"></i>', e += "</a>", e += "</div>", e += '<div class="item-main">', e += "<h2>", e += '<a href="' + t.href + '" target="_blank">', e += t.title, e += "</a>", e += "</h2>", e += "<h4>", e += '<span class="time">' + t.time + "</span>", e += '<span class="cat"> <a href="' + t.cat_link + '" target="_blank">' + t.cat + " </a> </span>", e += "</h4>", e += "</div>", e += "</div>", e += R(t), e += "</div>"
                    }, hunter: function B(t) {
                        var e = '<div class="item">';
                        return e += '<div class="item-hunter">', e += '<a href="' + t.href + '" target="_blank">', e += "<h2>", e += t.title, e += "</h2>", e += "<h4>", e += '<span class="time">' + t.time + "</span>", e += '<span class="product"> 产品：' + t.product + " </span>", e += "</h4>", e += '<div class="item-main">', e += '<div class="item-entry">', e += t.content, e += "</div>", e += '<div class="item-thumb">', e += '<i class="thumb" style="background-image:url(' + t.image + ');"></i>', e += "</div>", e += "</div>", e += "</a>", e += "</div>", e += R(t), e += "</div>"
                    }, zt: function H(t) {
                        var e = '<div class="item">';
                        return e += '<div class="zt-item">', e += '<a href="' + t.href + '" target="_blank">', e += '<div class="item-thumb">', e += '<i class="thumb" style="background-image:url(' + t.image + ');"></i>', e += "<h5>", e += '<span class="l">' + t.views + "人看过</span>", e += '<span class="r">' + t.count + "篇文章</span>", e += "</h5>", e += "</div>", e += "<h2>", e += t.title, e += "</h2>", e += "<h4>" + t.subtitle + "</h4>", e += '<div class="btns"> <span class="btn">查看专题</span> </div>', e += "</a>", e += "</div>", e += R(t), e += "</div>"
                    }, talk: function Y(t) {
                        var e = '<div class="item">';
                        return e += '<div class="item-talk">', e += '<a href="' + t.href + '" target="_blank">', e += '<div class="item-main">', e += '<div class="item-thumb">', e += '<i class="thumb" style="background-image:url(' + t.image + ');"></i>', e += "</div>", e += "<h3>" + t.author + "</h3>", e += "<h4>" + t.time + "</h4>", e += "<h2>" + t.title + "</h2>", e += '<div class="item-entry">' + t.content + "</div>", e += "</div>", e += '<div class="item-extra">', e += '<div class="extra">', e += "<strong>" + t.zan + "</strong><span>赞</span>", e += "</div>", e += '<div class="extra">', e += "<strong>" + t.comment_count + "</strong><span>评论</span>", e += "</div>", e += "</div>", e += "</a>", e += "</div>", e += "</div>"
                    }
                };
                A() ? m.html(' <a href="#fav">我收藏的</a>  <a href="#publish">我发布的</a>  <a href="#setting">帐户设置</a> ') : m.html(' <a href="#publish">发布</a>  <a href="#fav">收藏</a> '), i(window).on("load", M), orz.hash.push(M), orz.post(function G(t) {
                    if (t) {
                        var e = (t = orz.jsonDecode(t)).data;
                        e && (s = e, c = orz.deepCopy(e), 0 < e.publish && 0, F(), E.each(function () {
                            i(this).val(s[i(this).attr("data-prop")]), i(this).siblings().find('[data-name="' + i(this).attr("data-prop") + '"]').html(s[i(this).attr("data-prop")])
                        }), 0 < e.views ? u.children("strong").html(e.views) : u.addClass("hidden"), 0 < e.publish ? d.children("strong").html(e.publish) : (d.addClass("hidden"), function n() {
                            A() || (m.children("a").eq(0).remove(), M(), S())
                        }()), 0 < e.fav ? h.children("strong").html(e.fav) : (h.children("strong").html(e.fav), function r() {
                            A() || S()
                        }()), i("body").trigger("user_info_ready"))
                    }
                }, T, a), orz.click(function () {
                    var t = i(".uc-menus").offset();
                    i("html,body").animate({scrollTop: t.top}, 10)
                }, ".nav-pages a"), i("body").on("user_info_ready", function $() {
                    x || (x = !0, E.on("blur", I))
                }), i("body").on("user_info_change", F), orz.click(function () {
                    var t = i(this).parents(".item"),
                        e = {action: "fav", "do": "remove", uid: orz.attr("uid", this), pid: orz.attr("pid", this)};
                    return t.remove(), orz.post(function (t) {
                    }, e, this), !1
                }, ".remove_fav")
            }

            function A() {
                return orz.currentUser && orz.currentUser.id == uisdc.uid
            }

            function S() {
                var t = i(".user-404");
                if (t.length < 1) {
                    z.after('<div class="user-404">很抱歉，没有更多内容了喔。</div>')
                } else t.removeClass("hidden");
                z.addClass("hidden")
            }

            function Q() {
                var t = i(".user-404");
                0 < t.length && t.addClass("hidden"), z.removeClass("hidden")
            }

            function N() {
                var t = orz.match(/#\d+$/)(location.hash);
                return t ? t[0] : "#1"
            }

            function D() {
                var t = orz.match(/#[^#]+/)(location.hash);
                return t ? m.children('[href="' + t[0] + '"]') : m.children("a").eq(0)
            }

            function F() {
                t.removeClass("hidden"), e.css("background-image", "url(" + s.avatar + ")"), n.html(s.name), r.html(s.company + " " + s.job), o.html(s.info)
            }

            function q(t) {
                var e = 18;
                switch (t) {
                    case"#publish#post":
                    case"#fav#post":
                        e = 18;
                        break;
                    case"#publish#hunter":
                    case"#fav#hunter":
                        e = 9;
                        break;
                    case"#publish#talk":
                        e = 3;
                        break;
                    case"#fav#zt":
                        e = 8
                }
                return e
            }

            function M() {
                Q(), v.html(""), p.addClass("hidden"), _.addClass("hidden"), z.addClass("hidden"), C.addClass("hidden"), j.addClass("hidden"), y.html("");
                var t = D();
                switch (m.children("a").removeClass("current"), t.addClass("current"), t.attr("href")) {
                    case"#publish":
                        z.removeClass("hidden"), v.html(' <a href="#publish#post">设计文章</a>  <a href="#publish#hunter">细节猎人</a>  <a href="#publish#talk">设计话题</a> '), p.removeClass("hidden");
                        break;
                    case"#fav":
                        z.removeClass("hidden"), v.html(' <a href="#fav#post">设计文章</a>  <a href="#fav#zt">设计专题</a>  <a href="#fav#hunter">细节猎人</a> '), p.removeClass("hidden");
                        break;
                    case"#mine":
                        _.removeClass("hidden");
                        break;
                    case"#msg":
                        C.removeClass("hidden"), v.html(' <a href="#msg#all">全部消息</a>  <a href="#msg#system">系统消息</a>  <a href="#msg#comment">评论回复</a> '), p.removeClass("hidden");
                        break;
                    case"#setting":
                        j.removeClass("hidden"), v.html("<span>以下资料来自微信</span>"), p.removeClass("hidden")
                }
                g.html(t.text());
                var e = function o() {
                    var t = orz.match(/#[^#]+#[^#]+/)(location.hash);
                    return t ? v.children('[href="' + t[0] + '"]') : v.children("a").eq(0)
                }();
                v.children("a").removeClass("current"), e.addClass("current");
                var n = N().substring(1);
                n < 1 && (n = 1);
                var r = {
                    action: "user_center_data",
                    uid: uisdc.uid,
                    type: e.attr("href"),
                    paged: n,
                    ppp: q(e.attr("href"))
                };
                "#mine" == t.attr("href") && (r.type = "#mine"), "#setting" == t.attr("href") && (r.type = "#setting"), function i(t) {
                    var e = t.type, n = t.paged;
                    if (orz.match("#fav")(e) || orz.match("#publish")(e)) {
                        if (orz.isArray(l[e]) && (l[e][n] || orz.match("#fav")(e))) return L(l[e][n], e);
                        orz.post(U, t, a)
                    }
                    orz.match("#mine")(e);
                    orz.match("#msg")(e);
                    orz.match("#setting")(e)
                }(r)
            }

            function I() {
                var t = i(this).attr("data-prop"), e = (s[t], i(this).val());
                s[t] = e, F(), function n(t) {
                    i(t).siblings(".holdTxt").removeClass("hidden").children("em").html(i(t).val()), i(t).addClass("hidden")
                }(this)
            }

            function P(t) {
                return s[t] != c[t] ? s[t] : ""
            }

            function U(t) {
                if (t) {
                    var e, n = (t = orz.jsonDecode(t)).data, r = t.type, o = t.post_type, i = t.pages, a = t.paged,
                        s = "#" + r + "#" + o;
                    if (n) {
                        if ("publish" == r && (f[s] = i, orz.isArray(l[s]) || (l[s] = []), l[s][a] = n[o]), "fav" == r) for (var c in n) if (n.hasOwnProperty(c)) {
                            for (e = n[c], l["#fav#" + c] = [], l["#fav#" + c].push([]); 0 < e.length;) l["#fav#" + c].push(e.splice(0, q("#fav#" + c)));
                            f["#fav#" + c] = l["#fav#" + c].length - 1
                        }
                        L(l[s][a], s)
                    }
                }
            }

            function L(t, e) {
                if (t && 0 < t.length) {
                    Q();
                    var n = t[0].post_type;
                    y.attr("class", "items"), y.addClass("items-" + n), y.html(orz.map(O[n], t).join("")), w.removeClass("hidden"), function o(t) {
                        var e, n, r;
                        switch (orz.log(t), t) {
                            case"post":
                                e = "/archives", n = "设计文章";
                                break;
                            case"hunter":
                                e = "/hunters", n = "细节猎人";
                                break;
                            case"talk":
                                e = "/talk", n = "设计话题";
                                break;
                            case"zt":
                                e = "/zt", n = "设计专题"
                        }
                        r = '<a href="' + e + '" target="_blank" class="btn btn-orange">前往' + n + ' <i class="icon-right"></i> </a>', b.html(r)
                    }(n), function h(t) {
                        var e = f[t], n = "", r = N().substring(1), o = "", i = "", a = r - 1, s = +r + 1,
                            c = r - Math.ceil(2);
                        c < 1 && (c = 1);
                        var l = c + 4;
                        if (e < l && (c = (l = e) - 4) < 1 && (c = 1), 0 < e) {
                            1 == r && (o = "hidden"), r == e && (i = "hidden"), n += '<li class="fy ' + o + '"><a href="' + t + "#" + a + '" data-nav="prev"><span><i class="icon-left-open-big"></i> 上一页</span></a></li>', 1 < c && (n += '<li><a href="' + t + '#1"><span>1</span></a></li>'), 2 < c && (n += '<li class="disabled"><a class="disabled" href="' + t + '"><span>...</span></a></li>');
                            for (var u = "", d = c; d <= l; d++) u = "", d == r && (u = ' class="active disabled"'), n += "<li " + u + '><a href="' + t + "#" + d + '"><span>' + d + "</span></a></li>";
                            l < e - 1 && (n += '<li class="disabled"><a class="disabled" href="' + t + '"><span>...</span></a></li>'), l < e && (n += '<li><a href="' + t + "#" + e + '"><span>' + e + "</span></a></li>"), n += '<li class="fy ' + i + '"><a href="' + t + "#" + s + '" data-nav="next"><span>下一页 <i class="icon-right-open-big"></i></span></a></li>', k.html(n)
                        }
                    }(e)
                } else S(), w.addClass("hidden")
            }

            function R(t) {
                var e = "";
                return "#fav" == D().attr("href") && A() && (e += '<div class="fav-edit">', e += '已看完 <span class="btn btn-orange-border remove_fav" data-uid="' + uisdc.uid + '" data-pid="' + t.ID + '">移除</span>', e += "</div>"), e
            }
        }(jQuery), function (t) {
            if (!(t(".usercenter-body").length < 1)) t(".header .container"), t(".header .site-menu"), t(".header .logo"), t(".header .header-login-search")
        }(jQuery), n = jQuery, r = orz.attr("target"), orz.click(function () {
            var t = r(this);
            return n(this).addClass("hidden"), n(this).siblings('[data-prop="' + t + '"]').removeClass("hidden").focus(), !1
        }, ".holdTxt")
    }

    ,

    function (t, e) {
        !function (a) {
            if ("undefined" != typeof _hmt) {
                var s = orz.attr("category"), c = orz.attr("action"), l = orz.attr("label"),
                    t = [{tag: "#spark_slide_homepage_new a", category: "首页轮播"}, {
                        tag: ".menu-primary .link-0",
                        category: "主菜单"
                    }, {tag: ".hf-widget-2 a", category: "首屏设计师必备"}, {
                        tag: ".hf-widget-4 a",
                        category: "首屏大课堂"
                    }, {tag: ".hf-widget-software a", category: "首屏软件教程"}, {
                        tag: ".hf-widget-hot-cats a",
                        category: "首屏热门频道"
                    }, {tag: ".h-images a", category: "首页首屏图文"}, {
                        tag: ".ktuwen a",
                        category: "图文广告",
                        action: location.href
                    }, {tag: ".kingba a", category: "金主爸爸", label: "href"}, {
                        tag: ".widget-show a",
                        category: "侧栏广告",
                        label: "href"
                    }, {tag: ".archiveTopShow a", category: "频道顶部广告", label: "href"}, {
                        tag: ".pageTopShow a",
                        category: "单页顶部广告",
                        label: "href"
                    }, {tag: ".postTopShow a", category: "文章页顶部广告", label: "href"}, {
                        tag: ".archiveShow a",
                        category: "频道底部广告",
                        label: "href"
                    }, {tag: ".news-show a", category: "优设读报广告", label: "href"}, {
                        tag: ".article-show a",
                        category: "内容底部广告",
                        label: "href"
                    }, {tag: ".single-hunter .ts a", category: "细节猎人通栏", label: "href"}, {
                        tag: ".bottomShow a",
                        category: "细节话题底部广告",
                        label: "href"
                    }, {tag: ".article-bt a", category: "正文底部广告", label: "href"}];
                a.map(t, function (i) {
                    orz.click(function () {
                        var t = a(i.tag).index(a(this));
                        t++;
                        var e = i.label;
                        "href" == e && (e = a(this).attr("href"));
                        var n = s(this) || i.category || i.tag, r = c(this) || i.action || "点击",
                            o = l(this) || e || "序号：" + t;
                        _hmt.push(["_trackEvent", n, r, o])
                    }, i.tag)
                })
            }
        }(jQuery)
    }

    ,

    function (t, e) {
        t.exports = function n(t) {
            return null != t && "object" == typeof t && !0 === t["@@functional/placeholder"]
        }
    }

    ,

    function (t, e) {
        t.exports = function n(t, u) {
            switch (t) {
                case 0:
                    return function () {
                        return u.apply(this, arguments)
                    };
                case 1:
                    return function (t) {
                        return u.apply(this, arguments)
                    };
                case 2:
                    return function (t, e) {
                        return u.apply(this, arguments)
                    };
                case 3:
                    return function (t, e, n) {
                        return u.apply(this, arguments)
                    };
                case 4:
                    return function (t, e, n, r) {
                        return u.apply(this, arguments)
                    };
                case 5:
                    return function (t, e, n, r, o) {
                        return u.apply(this, arguments)
                    };
                case 6:
                    return function (t, e, n, r, o, i) {
                        return u.apply(this, arguments)
                    };
                case 7:
                    return function (t, e, n, r, o, i, a) {
                        return u.apply(this, arguments)
                    };
                case 8:
                    return function (t, e, n, r, o, i, a, s) {
                        return u.apply(this, arguments)
                    };
                case 9:
                    return function (t, e, n, r, o, i, a, s, c) {
                        return u.apply(this, arguments)
                    };
                case 10:
                    return function (t, e, n, r, o, i, a, s, c, l) {
                        return u.apply(this, arguments)
                    };
                default:
                    throw new Error("First argument to _arity must be a non-negative integer no greater than ten")
            }
        }
    }

    ,

    function (t, e, n) {
        var o = n(16), i = n(49);
        t.exports = function a(r) {
            return function t(e, n) {
                switch (arguments.length) {
                    case 0:
                        return t;
                    case 1:
                        return i(e) ? t : o(function (t) {
                            return r(e, t)
                        });
                    default:
                        return i(e) && i(n) ? t : i(e) ? o(function (t) {
                            return r(t, n)
                        }) : i(n) ? o(function (t) {
                            return r(e, t)
                        }) : r(e, n)
                }
            }
        }
    }

    ,

    function (t, e, n) {
        var r = n(16), o = n(54), i = r(function i(t) {
            return o(t.length, t)
        });
        t.exports = i
    }

    ,

    function (t, e, n) {
        var r = n(51)(function r(t, e) {
            return null != e && e.constructor === t || e instanceof t
        });
        t.exports = r
    }

    ,

    function (t, e, n) {
        var r = n(50), o = n(16), i = n(51), a = n(55), s = i(function s(t, e) {
            return 1 === t ? o(e) : r(t, a(t, [], e))
        });
        t.exports = s
    }

    ,

    function (t, e, n) {
        var c = n(50), l = n(49);
        t.exports = function u(i, a, s) {
            return function () {
                for (var t = [], e = 0, n = i, r = 0; r < a.length || e < arguments.length;) {
                    var o;
                    r < a.length && (!l(a[r]) || arguments.length <= e) ? o = a[r] : (o = arguments[e], e += 1), t[r] = o, l(o) || --n, r += 1
                }
                return n <= 0 ? s.apply(this, t) : c(n, u(i, t, s))
            }
        }
    }

    ,

    function (t, e, n) {
        "use strict";
        n.r(e);
        var r = n(53), o = n.n(r), i = n(52), a = n.n(i).a, s = o.a, c = jQuery, l = a(function (t, e) {
            if (s(Array, t)) for (var n = 0; n < t.length; n++) s(Function, t[n]) && c("body").on("click", e, t[n]); else s(Function, t) && c("body").on("click", e, t)
        });

        function u(t, u) {
            switch (t) {
                case 0:
                    return function () {
                        return u.apply(this, arguments)
                    };
                case 1:
                    return function (t) {
                        return u.apply(this, arguments)
                    };
                case 2:
                    return function (t, e) {
                        return u.apply(this, arguments)
                    };
                case 3:
                    return function (t, e, n) {
                        return u.apply(this, arguments)
                    };
                case 4:
                    return function (t, e, n, r) {
                        return u.apply(this, arguments)
                    };
                case 5:
                    return function (t, e, n, r, o) {
                        return u.apply(this, arguments)
                    };
                case 6:
                    return function (t, e, n, r, o, i) {
                        return u.apply(this, arguments)
                    };
                case 7:
                    return function (t, e, n, r, o, i, a) {
                        return u.apply(this, arguments)
                    };
                case 8:
                    return function (t, e, n, r, o, i, a, s) {
                        return u.apply(this, arguments)
                    };
                case 9:
                    return function (t, e, n, r, o, i, a, s, c) {
                        return u.apply(this, arguments)
                    };
                case 10:
                    return function (t, e, n, r, o, i, a, s, c, l) {
                        return u.apply(this, arguments)
                    };
                default:
                    throw new Error("First argument to _arity must be a non-negative integer no greater than ten")
            }
        }

        function d(t, e) {
            return function () {
                return e.call(this, t.apply(this, arguments))
            }
        }

        function h(t) {
            return null != t && "object" == typeof t && !0 === t["@@functional/placeholder"]
        }

        function f(e) {
            return function n(t) {
                return 0 === arguments.length || h(t) ? n : e.apply(this, arguments)
            }
        }

        function m(r) {
            return function t(e, n) {
                switch (arguments.length) {
                    case 0:
                        return t;
                    case 1:
                        return h(e) ? t : f(function (t) {
                            return r(e, t)
                        });
                    default:
                        return h(e) && h(n) ? t : h(e) ? f(function (t) {
                            return r(t, n)
                        }) : h(n) ? f(function (t) {
                            return r(e, t)
                        }) : r(e, n)
                }
            }
        }

        function p(i) {
            return function t(n, r, o) {
                switch (arguments.length) {
                    case 0:
                        return t;
                    case 1:
                        return h(n) ? t : m(function (t, e) {
                            return i(n, t, e)
                        });
                    case 2:
                        return h(n) && h(r) ? t : h(n) ? m(function (t, e) {
                            return i(t, r, e)
                        }) : h(r) ? m(function (t, e) {
                            return i(n, t, e)
                        }) : f(function (t) {
                            return i(n, r, t)
                        });
                    default:
                        return h(n) && h(r) && h(o) ? t : h(n) && h(r) ? m(function (t, e) {
                            return i(t, e, o)
                        }) : h(n) && h(o) ? m(function (t, e) {
                            return i(t, r, e)
                        }) : h(r) && h(o) ? m(function (t, e) {
                            return i(n, t, e)
                        }) : h(n) ? f(function (t) {
                            return i(t, r, o)
                        }) : h(r) ? f(function (t) {
                            return i(n, t, o)
                        }) : h(o) ? f(function (t) {
                            return i(n, r, t)
                        }) : i(n, r, o)
                }
            }
        }

        var v = Array.isArray || function v(t) {
            return null != t && 0 <= t.length && "[object Array]" === Object.prototype.toString.call(t)
        };

        function g(t) {
            return "[object String]" === Object.prototype.toString.call(t)
        }

        var z = f(function (t) {
            return !!v(t) || !!t && ("object" == typeof t && (!g(t) && (1 === t.nodeType ? !!t.length : 0 === t.length || 0 < t.length && (t.hasOwnProperty(0) && t.hasOwnProperty(t.length - 1)))))
        }), y = function () {
            function t(t) {
                this.f = t
            }

            return t.prototype["@@transducer/init"] = function () {
                throw new Error("init not implemented on XWrap")
            }, t.prototype["@@transducer/result"] = function (t) {
                return t
            }, t.prototype["@@transducer/step"] = function (t, e) {
                return this.f(t, e)
            }, t
        }();
        var w = m(function (t, e) {
            return u(t.length, function () {
                return t.apply(e, arguments)
            })
        });

        function b(t, e, n) {
            for (var r = n.next(); !r.done;) {
                if ((e = t["@@transducer/step"](e, r.value)) && e["@@transducer/reduced"]) {
                    e = e["@@transducer/value"];
                    break
                }
                r = n.next()
            }
            return t["@@transducer/result"](e)
        }

        function k(t, e, n, r) {
            return t["@@transducer/result"](n[r](w(t["@@transducer/step"], t), e))
        }

        var _ = "undefined" != typeof Symbol ? Symbol.iterator : "@@iterator";

        function C(t, e, n) {
            if ("function" == typeof t && (t = function r(t) {
                return new y(t)
            }(t)), z(n)) return function i(t, e, n) {
                for (var r = 0, o = n.length; r < o;) {
                    if ((e = t["@@transducer/step"](e, n[r])) && e["@@transducer/reduced"]) {
                        e = e["@@transducer/value"];
                        break
                    }
                    r += 1
                }
                return t["@@transducer/result"](e)
            }(t, e, n);
            if ("function" == typeof n["fantasy-land/reduce"]) return k(t, e, n, "fantasy-land/reduce");
            if (null != n[_]) return b(t, e, n[_]());
            if ("function" == typeof n.next) return b(t, e, n);
            if ("function" == typeof n.reduce) return k(t, e, n, "reduce");
            throw new TypeError("reduce: list must be array or iterable")
        }

        var j = p(C);

        function x(n, r) {
            return function () {
                var t = arguments.length;
                if (0 === t) return r();
                var e = arguments[t - 1];
                return v(e) || "function" != typeof e[n] ? r.apply(this, arguments) : e[n].apply(e, Array.prototype.slice.call(arguments, 0, t - 1))
            }
        }

        var E = p(x("slice", function E(t, e, n) {
            return Array.prototype.slice.call(n, t, e)
        })), T = f(x("tail", E(1, Infinity)));
        var O = f(function (t) {
            return g(t) ? t.split("").reverse().join("") : Array.prototype.slice.call(t, 0).reverse()
        });
        var A = f(function A(t) {
            return !t
        }), S = f(function S(t) {
            return null == t
        });
        var Q, N = m(function (t, e) {
            return 1 === t ? f(e) : u(t, function c(i, a, s) {
                return function () {
                    for (var t = [], e = 0, n = i, r = 0; r < a.length || e < arguments.length;) {
                        var o;
                        r < a.length && (!h(a[r]) || arguments.length <= e) ? o = a[r] : (o = arguments[e], e += 1), h(t[r] = o) || --n, r += 1
                    }
                    return n <= 0 ? s.apply(this, t) : u(n, c(i, t, s))
                }
            }(t, [], e))
        }), D = f(function (t) {
            return N(t.length, t)
        }), F = function I() {
            if (0 === arguments.length) throw new Error("compose requires at least one argument");
            return function t() {
                if (0 === arguments.length) throw new Error("pipe requires at least one argument");
                return u(arguments[0].length, j(d, arguments[0], T(arguments)))
            }.apply(this, O(arguments))
        }(A, S), q = D(function q(t, e) {
            return F(console) && console.log(t, e), e
        }), M = q;
        Q = jQuery, l(function () {
            var t = Q(this).attr("href");
            M("click hash :", t);
            var e = 0 - Q(this).attr("data-diff") || -60, n = Q(t);
            if (!(n.length < 1)) {
                if (n.hasClass("hidden") && (n = n.next()), "no" == Q(this).attr("data-sm") && !orz.md()) return !1;
                var r = n.offset();
                return Q("html,body").animate({scrollTop: r.top + e}, 20), !1
            }
        })('[href^="#"]')
    }

])
;
