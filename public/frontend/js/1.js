/*!
 * imagesLoaded v4.1.4
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */
! function(e, t) {
    "use strict";
    "function" == typeof define && define.amd ? define(["ev-emitter/ev-emitter"], (function(i) {
        return t(e, i)
    })) : "object" == typeof module && module.exports ? module.exports = t(e, require("ev-emitter")) : e.imagesLoaded = t(e, e.EvEmitter)
}("undefined" != typeof window ? window : this, (function(e, t) {
    "use strict";
    var i = e.jQuery,
        o = e.console;

    function r(e, t) {
        for (var i in t) e[i] = t[i];
        return e
    }
    var n = Array.prototype.slice;

    function s(e, t, h) {
        if (!(this instanceof s)) return new s(e, t, h);
        var a, d = e;
        ("string" == typeof e && (d = document.querySelectorAll(e)), d) ? (this.elements = (a = d, Array.isArray(a) ? a : "object" == typeof a && "number" == typeof a.length ? n.call(a) : [a]), this.options = r({}, this.options), "function" == typeof t ? h = t : r(this.options, t), h && this.on("always", h), this.getImages(), i && (this.jqDeferred = new i.Deferred), setTimeout(this.check.bind(this))) : o.error("Bad element for imagesLoaded " + (d || e))
    }
    s.prototype = Object.create(t.prototype), s.prototype.options = {}, s.prototype.getImages = function() {
        this.images = [], this.elements.forEach(this.addElementImages, this)
    }, s.prototype.addElementImages = function(e) {
        "IMG" == e.nodeName && this.addImage(e), !0 === this.options.background && this.addElementBackgroundImages(e);
        var t = e.nodeType;
        if (t && h[t]) {
            for (var i = e.querySelectorAll("img"), o = 0; o < i.length; o++) {
                var r = i[o];
                this.addImage(r)
            }
            if ("string" == typeof this.options.background) {
                var n = e.querySelectorAll(this.options.background);
                for (o = 0; o < n.length; o++) {
                    var s = n[o];
                    this.addElementBackgroundImages(s)
                }
            }
        }
    };
    var h = {
        1: !0,
        9: !0,
        11: !0
    };

    function a(e) {
        this.img = e
    }

    function d(e, t) {
        this.url = e, this.element = t, this.img = new Image
    }
    return s.prototype.addElementBackgroundImages = function(e) {
        var t = getComputedStyle(e);
        if (t)
            for (var i = /url\((['"])?(.*?)\1\)/gi, o = i.exec(t.backgroundImage); null !== o;) {
                var r = o && o[2];
                r && this.addBackground(r, e), o = i.exec(t.backgroundImage)
            }
    }, s.prototype.addImage = function(e) {
        var t = new a(e);
        this.images.push(t)
    }, s.prototype.addBackground = function(e, t) {
        var i = new d(e, t);
        this.images.push(i)
    }, s.prototype.check = function() {
        var e = this;

        function t(t, i, o) {
            setTimeout((function() {
                e.progress(t, i, o)
            }))
        }
        this.progressedCount = 0, this.hasAnyBroken = !1, this.images.length ? this.images.forEach((function(e) {
            e.once("progress", t), e.check()
        })) : this.complete()
    }, s.prototype.progress = function(e, t, i) {
        this.progressedCount++, this.hasAnyBroken = this.hasAnyBroken || !e.isLoaded, this.emitEvent("progress", [this, e, t]), this.jqDeferred && this.jqDeferred.notify && this.jqDeferred.notify(this, e), this.progressedCount == this.images.length && this.complete(), this.options.debug && o && o.log("progress: " + i, e, t)
    }, s.prototype.complete = function() {
        var e = this.hasAnyBroken ? "fail" : "done";
        if (this.isComplete = !0, this.emitEvent(e, [this]), this.emitEvent("always", [this]), this.jqDeferred) {
            var t = this.hasAnyBroken ? "reject" : "resolve";
            this.jqDeferred[t](this)
        }
    }, a.prototype = Object.create(t.prototype), a.prototype.check = function() {
        this.getIsImageComplete() ? this.confirm(0 !== this.img.naturalWidth, "naturalWidth") : (this.proxyImage = new Image, this.proxyImage.addEventListener("load", this), this.proxyImage.addEventListener("error", this), this.img.addEventListener("load", this), this.img.addEventListener("error", this), this.proxyImage.src = this.img.src)
    }, a.prototype.getIsImageComplete = function() {
        return this.img.complete && this.img.naturalWidth
    }, a.prototype.confirm = function(e, t) {
        this.isLoaded = e, this.emitEvent("progress", [this, this.img, t])
    }, a.prototype.handleEvent = function(e) {
        var t = "on" + e.type;
        this[t] && this[t](e)
    }, a.prototype.onload = function() {
        this.confirm(!0, "onload"), this.unbindEvents()
    }, a.prototype.onerror = function() {
        this.confirm(!1, "onerror"), this.unbindEvents()
    }, a.prototype.unbindEvents = function() {
        this.proxyImage.removeEventListener("load", this), this.proxyImage.removeEventListener("error", this), this.img.removeEventListener("load", this), this.img.removeEventListener("error", this)
    }, d.prototype = Object.create(a.prototype), d.prototype.check = function() {
        this.img.addEventListener("load", this), this.img.addEventListener("error", this), this.img.src = this.url, this.getIsImageComplete() && (this.confirm(0 !== this.img.naturalWidth, "naturalWidth"), this.unbindEvents())
    }, d.prototype.unbindEvents = function() {
        this.img.removeEventListener("load", this), this.img.removeEventListener("error", this)
    }, d.prototype.confirm = function(e, t) {
        this.isLoaded = e, this.emitEvent("progress", [this, this.element, t])
    }, s.makeJQueryPlugin = function(t) {
        (t = t || e.jQuery) && ((i = t).fn.imagesLoaded = function(e, t) {
            return new s(this, e, t).jqDeferred.promise(i(this))
        })
    }, s.makeJQueryPlugin(), s
}));
window.FizzyDocs = {}, window.filterBind = function(n, i, t, e) {
    n.addEventListener(i, (function(n) {
        n.target.matches(t) && e(n)
    }))
};
FizzyDocs["commercial-license-agreement"] = function(e) {
    let t = {
            developer: {
                title: "Developer",
                "for-official": "one (1) Licensed Developer",
                "for-plain": "one individual Developer"
            },
            team: {
                title: "Team",
                "for-official": "up to eight (8) Licensed Developer(s)",
                "for-plain": "up to 8 Developers"
            },
            organization: {
                title: "Organization",
                "for-official": "an unlimited number of Licensed Developer(s)",
                "for-plain": "an unlimited number of Developers"
            }
        },
        o = e.querySelector(".button-group"),
        i = e.querySelector("h2"),
        n = i.cloneNode(!0);
    n.style.borderTop = "none", n.style.marginTop = 0, n.id = "", n.innerHTML = n.innerHTML.replace("Commercial License", 'Commercial <span data-license-property="title"></span> License'), i.textContent = "", o.parentNode.insertBefore(n, o.nextSibling);
    let r = [],
        l = e.querySelectorAll("[data-license-property]");
    for (let e = 0, t = l.length; e < t; e++) {
        let t = l[e],
            o = {
                property: t.getAttribute("data-license-property"),
                element: t
            };
        r.push(o)
    }

    function a(e) {
        let i = o.querySelector(".is-selected");
        i && i.classList.remove("is-selected"), e.classList.add("is-selected");
        let n = e.getAttribute("data-license-option"),
            l = t[n];
        r.forEach((function(e) {
            e.element.textContent = l[e.property]
        }))
    }
    a(o.querySelector(".button--developer")), filterBind(o, "click", ".button", (function(e) {
        a(e.target)
    }))
};
! function() {
    let t = 0;
    FizzyDocs["gh-button"] = function(e) {
        let n = e.href.split("/"),
            c = n[3],
            o = n[4],
            a = e.querySelector(".gh-button__stat__text");
        t++;
        let l = "ghButtonCallback" + t;
        window[l] = function(t) {
            let e = t.data.stargazers_count.toString().replace(/(\d)(?=(\d{3})+$)/g, "$1,");
            a.textContent = e
        };
        let i = document.createElement("script");
        i.src = "https://api.github.com/repos/" + c + "/" + o + "?callback=" + l, document.head.appendChild(i)
    }
}();
FizzyDocs["shirt-promo"] = function(e) {
    let t = new Date(2017, 9, 6),
        o = Math.round((t - new Date) / 864e5);
    e.querySelector(".shirt-promo__title").textContent += `. Only on sale for ${o} more days.`
};
window.InfiniteScrollDocs = {}, window.utils = fizzyUIUtils;
InfiniteScrollDocs["image-grid"] = function(e) {
    let t = new Masonry(e, {
        itemSelector: "none",
        columnWidth: ".image-grid__col-sizer",
        gutter: ".image-grid__gutter-sizer",
        percentPosition: !0,
        stagger: 30,
        visibleStyle: {
            transform: "translateY(0)",
            opacity: 1
        },
        hiddenStyle: {
            transform: "translateY(100px)",
            opacity: 0
        }
    });
    imagesLoaded(e, (function() {
        e.classList.remove("are-images-unloaded"), t.options.itemSelector = ".image-grid__item";
        let i = e.querySelectorAll(".image-grid__item");
        t.appended(i)
    })), new InfiniteScroll(e, {
        path: ".pagination__next",
        hideNav: ".pagination",
        append: ".image-grid__item",
        outlayer: t,
        status: ".scroller-status",
        debug: !0
    })
};
! function() {
    let t;
    InfiniteScrollDocs["page-nav"] = function(e) {
        let n = e.querySelector(".page-nav__list"),
            i = getComputedStyle(e, ":after").content.match("sticky");
        t && i ? e.style.display = "none" : (t = e, n.clientHeight <= window.innerHeight && i && e.classList.add("is-sticky"))
    }
}();
InfiniteScrollDocs["site-scroll"] = function(e) {
    let n, t = e.querySelector(".button"),
        i = ["index", "options", "api", "events", "extras", "license"],
        o = document.body.getAttribute("data-basename"),
        l = i.indexOf(o) + 1;

    function a(e, n, t) {
        for (let e = 0; e < t.length; e++) InfiniteScrollDocs.initElementJS(t[e])
    }
    t.addEventListener("click", (function e() {
        n = new InfiniteScroll(".main .container", {
            path: function() {
                let e = l + this.loadCount,
                    n = i[e];
                return n && n + ".html"
            },
            append: ".main__page"
        }), n.on("append", a), n.loadNextPage(), t.style.display = "none", t.removeEventListener("click", e)
    }))
};
InfiniteScrollDocs["button-option"] = function(e) {
    let t = e.querySelector(".scroller__content");
    new InfiniteScroll(t, {
        path: "demo/element-scroll/page{{#}}.html",
        append: ".scroller-item",
        elementScroll: e,
        checkLastPage: ".pagination__next",
        scrollThreshold: !1,
        button: e.querySelector(".view-more-button"),
        status: e.querySelector(".scroller-status"),
        history: !1
    })
};
InfiniteScrollDocs.append = function(e) {
    let t = e.querySelector(".scroller__content");
    new InfiniteScroll(t, {
        path: "demo/element-scroll/page{{#}}.html",
        append: ".scroller-item",
        checkLastPage: ".pagination__next",
        elementScroll: e,
        status: e.querySelector(".scroller-status"),
        history: !1
    })
};
InfiniteScrollDocs["button-start"] = function(e) {
    let t = e.querySelector(".scroller__content"),
        l = new InfiniteScroll(t, {
            path: "demo/element-scroll/page{{#}}.html",
            append: ".scroller-item",
            checkLastPage: ".pagination__next",
            elementScroll: e,
            loadOnScroll: !1,
            status: e.querySelector(".scroller-status"),
            history: !1
        }),
        o = e.querySelector(".view-more-button");
    o.addEventListener("click", (function e() {
        l.loadNextPage(), l.options.loadOnScroll = !0, o.style.display = "none", o.removeEventListener("click", e)
    }))
};
InfiniteScrollDocs["check-last-page-disabled"] = function(e) {
    let l = e.querySelector(".scroller__content");
    new InfiniteScroll(l, {
        path: "demo/element-scroll/page{{#}}.html",
        append: ".scroller-item",
        elementScroll: e,
        checkLastPage: !1,
        scrollThreshold: !1,
        button: e.querySelector(".view-more-button"),
        status: e.querySelector(".scroller-status"),
        history: !1
    })
};
InfiniteScrollDocs.debug = function(e) {
    let t = e.querySelector(".scroller__content");
    new InfiniteScroll(t, {
        path: "demo/element-scroll/page{{#}}.html",
        append: ".scroller-item",
        checkLastPage: ".pagination__next",
        elementScroll: e,
        status: e.querySelector(".scroller-status"),
        history: !1,
        debug: !0
    })
};
InfiniteScrollDocs["element-scroll-container"] = function(e) {
    new InfiniteScroll(e, {
        path: "demo/element-scroll/page{{#}}.html",
        append: ".scroller-item",
        checkLastPage: ".pagination__next",
        elementScroll: !0,
        history: !1
    })
};
InfiniteScrollDocs["load-count"] = function(e) {
    let t = e.querySelector(".scroller"),
        o = e.querySelector(".scroller__content"),
        l = e.querySelector(".demo-status"),
        n = new InfiniteScroll(o, {
            path: "demo/element-scroll/page{{#}}.html",
            append: ".scroller-item",
            checkLastPage: ".pagination__next",
            elementScroll: t,
            status: e.querySelector(".scroller-status"),
            history: !1
        });
    n.on("load", (function() {
        l.textContent = n.loadCount + " page" + (n.loadCount > 1 ? "s" : "") + " loaded"
    }))
};
InfiniteScrollDocs["masonry-small"] = function(e) {
    let t = e.querySelector(".scroller__content"),
        r = new Masonry(t, {
            itemSelector: ".image-grid__item",
            columnWidth: ".image-grid__col-sizer",
            gutter: ".image-grid__gutter-sizer",
            percentPosition: !0,
            stagger: 30,
            visibleStyle: {
                transform: "translateY(0)",
                opacity: 1
            },
            hiddenStyle: {
                transform: "translateY(100px)",
                opacity: 0
            }
        });
    imagesLoaded(t, (function() {
        r.layout()
    })), new InfiniteScroll(t, {
        path: "demo/masonry/page{{#}}.html",
        append: ".image-grid__item",
        checkLastPage: ".pagination__next",
        outlayer: r,
        history: !1,
        elementScroll: e,
        status: e.querySelector(".scroller-status")
    })
};
InfiniteScrollDocs["page-index"] = function(e) {
    let t = e.querySelector(".scroller"),
        l = e.querySelector(".scroller__content"),
        o = e.querySelector(".demo-status"),
        n = new InfiniteScroll(l, {
            path: "demo/element-scroll/page{{#}}.html",
            append: ".scroller-item",
            checkLastPage: ".pagination__next",
            elementScroll: t,
            status: e.querySelector(".scroller-status"),
            history: !1
        });
    n.on("load", (function() {
        o.textContent = `Loaded page: ${n.pageIndex}`
    }))
};
InfiniteScrollDocs.prefill = function(e) {
    let l = e.querySelector(".scroller"),
        t = e.querySelector(".scroller__content"),
        r = e.querySelector(".button");
    r.addEventListener("click", (function c() {
        new InfiniteScroll(t, {
            path: "demo/element-scroll/page{{#}}.html",
            append: ".scroller-item",
            checkLastPage: ".pagination__next",
            elementScroll: l,
            prefill: !0,
            status: e.querySelector(".scroller-status"),
            history: !1
        }), r.disabled = "disabled", r.removeEventListener("click", c)
    }))
};
InfiniteScrollDocs["scroll-2"] = function(e) {
    let l = e.querySelector(".scroller__content"),
        o = e.querySelector(".view-more-button"),
        t = new InfiniteScroll(l, {
            path: "demo/element-scroll/page{{#}}.html",
            append: ".scroller-item",
            checkLastPage: ".pagination__next",
            elementScroll: e,
            button: o,
            status: e.querySelector(".scroller-status"),
            history: !1
        });
    t.on("load", (function e() {
        1 == t.loadCount && (t.options.loadOnScroll = !1, o.style.display = "inline-block", t.off(e))
    }))
};
InfiniteScrollDocs["scroll-threshold-option"] = function(e) {
    let l = e.querySelector(".scroller__content");
    new InfiniteScroll(l, {
        path: "demo/element-scroll/page{{#}}.html",
        append: ".scroller-item",
        checkLastPage: ".pagination__next",
        elementScroll: e,
        status: e.querySelector(".scroller-status"),
        scrollThreshold: 100,
        history: !1
    })
};
InfiniteScrollDocs.status = function(e) {
    let l = e.querySelector(".scroller__content");
    new InfiniteScroll(l, {
        path: "demo/element-scroll/page{{#}}.html",
        append: ".scroller-item",
        checkLastPage: ".pagination__next",
        elementScroll: e,
        status: e.querySelector(".scroller-status"),
        scrollThreshold: 50,
        history: !1
    })
};
InfiniteScrollDocs.initElementJS = function(t) {
    let e = t.querySelectorAll("[data-js]");
    for (let t = 0; t < e.length; t++) {
        let l = e[t],
            n = l.getAttribute("data-js"),
            i = InfiniteScrollDocs[n] || FizzyDocs[n];
        i && i(l)
    }
}, InfiniteScrollDocs.initElementJS(document);