! function($, b) {
    "use strict";
    let a = {
        eventID: "AsThemeJs",
        document: $(document),
        window: $(window),
        body: $("body"),
        classes: {
            toggled: "active", isOverlay: "overlay--enabled", mobileMainMenuActive: "dt__mobilenav-mainmenu--active", headerSearchActive: "dt__header-search--active"
        },
        init: function() {
            this.document.on("ready", this.documentReadyRender.bind(this)), this.document.on("ready", this.mobileNavRight.bind(this)), this.window.on("ready", this.headerHeight.bind(this)), this.window.on("ready", this.documentReadyRender.bind(this))
        },
        documentReadyRender: function() {
            this.document.on("click." + this.eventID, ".dt__mobilenav-mainmenu-toggle", this.menuToggleHandler.bind(this)).on("click." + this.eventID, ".dt__header-closemenu", this.menuToggleHandler.bind(this)).on("click." + this.eventID, this.hideHeaderMobilePopup.bind(this)).on("click." + this.eventID, ".dt__mobilenav-dropdown-toggle", this.verticalMobileSubMenuLinkHandle.bind(this)).on("click." + this.eventID, ".dt__header-closemenu", this.resetVerticalMobileMenu.bind(this)).on("hideHeaderMobilePopup." + this.eventID, this.resetVerticalMobileMenu.bind(this)).on("click." + this.eventID, ".dt__navbar-search-toggle", this.searchPopupHandler.bind(this)).on("click." + this.eventID, ".dt__search-close", this.searchPopupHandler.bind(this)), this.window.on("scroll." + this.eventID, this.scrollToSticky.bind(this)).on("load." + this.eventID, this.menuFocusAccessibility.bind(this)).on("load." + this.customID, this.topbarMobile.bind(this)).on("resize." + this.eventID, this.headerHeight.bind(this))
        },
        scrollToSticky: function(b) {
            var a = $(".is--sticky");
            this.window.scrollTop() >= 220 ? a.addClass("on") : a.removeClass("on")
        },
        headerHeight: function(d) {
            var a = $(".dt__header-navwrapper"),
                b = $(".dt__header-navwrapperinner"),
                c = 0;
            $("body").find("div").hasClass("is--sticky") && (b.each(function() {
                var a = this.clientHeight;
                a > c && (c = a)
            }), a.css("min-height", c))
        },
        topbarAccessibility: function() {
            var b, a, d, c = document.querySelector(".dt__mobilenav-topbar");
            let f = document.querySelector(".dt__mobilenav-topbar-toggle"),
                e = c.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
                g = e[e.length - 1];
            if (!c) return !1;
            for (a = 0, d = (b = c.getElementsByTagName("a")).length; a < d; a++) b[a].addEventListener("focus", h, !0), b[a].addEventListener("blur", h, !0);

            function h() {
                for (var a = this; - 1 === a.className.indexOf("dt__mobilenav-topbar");) "*" === a.tagName.toLowerCase() && (-1 !== a.className.indexOf("focus") ? a.className = a.className.replace(" focus", "") : a.className += " focus"), a = a.parentElement
            }
            document.addEventListener("keydown", function(a) {
                ("Tab" === a.key || 9 === a.keyCode) && f.classList.contains("active") && (a.shiftKey ? document.activeElement === f && (g.focus(), a.preventDefault()) : document.activeElement === g && (f.focus(), a.preventDefault()))
            })
        },
        topbarMobile: function() {
            var c = $(".dt__mobilenav-topbar-content"),
                b = $(".dt__header-widget"),
                a = $(".dt__mobilenav-topbar-toggle");
            !b.children().length > 0 ? a.hide() : (a.show(), a.on("click", function(b) {
                c.slideToggle(), a.toggleClass("active"), b.preventDefault()
            }), this.topbarAccessibility())
        },
        mobileNavRight: function() {
            $(".dt__navbar-right .dt__navbar-cart-item").clone().prependTo(".dt__mobilenav-right .dt__navbar-list-right");
        },
        menuFocusAccessibility: function(a) {
            $(".dt__navbar-nav, .widget_nav_menu").find("a").on("focus blur", function() {
                $(this).parents("ul, li").toggleClass("focus")
            })
        },
        menuToggleHandler: function(c) {
            var b = $(".dt__mobilenav-mainmenu-content"),
                a = $(".dt__mobilenav-mainmenu-toggle");
            this.body.toggleClass(this.classes.mobileMainMenuActive), this.body.toggleClass(this.classes.isOverlay), a.toggleClass(this.classes.toggled), b.fadeToggle(), this.body.hasClass(this.classes.mobileMainMenuActive) ? $(".dt__header-closemenu").focus() : a.focus(), this.menuAccessibility()
        },
        hideHeaderMobilePopup: function(a) {
            var b = $(".dt__mobilenav-mainmenu-toggle"),
                c = $(".dt__mobilenav-mainmenu");
            !$(a.target).closest(b).length && !$(a.target).closest(c).length && this.body.hasClass(this.classes.mobileMainMenuActive) && (this.body.removeClass(this.classes.mobileMainMenuActive), this.body.removeClass(this.classes.isOverlay), b.removeClass(this.classes.toggled), mobileMainmenuContent.fadeOut(), this.document.trigger("hideHeaderMobilePopup." + this.eventID), a.stopPropagation())
        },
        verticalMobileSubMenuLinkHandle: function(a) {
            a.preventDefault();
            var b = $(a.currentTarget);
            b.closest(".dt__mobilenav-mainmenu .dt__navbar-mainmenu"), b.parents(".dropdown-menu").length, this.isRTL, setTimeout(function() {
                b.parent().toggleClass("current"), b.next().slideToggle()
            }, 250)
        },
        resetVerticalMobileMenu: function(a) {
            $(".dt__mobilenav-mainmenu .dt__navbar-mainmenu");
            var b = $(".dt__mobilenav-mainmenu  .menu-item"),
                c = $(".dt__mobilenav-mainmenu .dropdown-menu");
            setTimeout(function() {
                b.removeClass("current"), c.hide()
            }, 250)
        },
        menuAccessibility: function() {
            var b, a, d, c = document.querySelector(".dt__mobilenav-mainmenu-content");
            let f = document.querySelector(".dt__header-closemenu"),
                e = c.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
                g = e[e.length - 1];
            if (!c) return !1;
            for (a = 0, d = (b = c.getElementsByTagName("a")).length; a < d; a++) b[a].addEventListener("focus", h, !0), b[a].addEventListener("blur", h, !0);

            function h() {
                for (var a = this; - 1 === a.className.indexOf("dt__mobilenav-mainmenu-inner");) "li" === a.tagName.toLowerCase() && (-1 !== a.className.indexOf("focus") ? a.className = a.className.replace(" focus", "") : a.className += " focus"), a = a.parentElement
            }
            document.addEventListener("keydown", function(a) {
                ("Tab" === a.key || 9 === a.keyCode) && (a.shiftKey ? document.activeElement === f && (g.focus(), a.preventDefault()) : document.activeElement === g && (f.focus(), a.preventDefault()))
            })
        },
        searchPopupHandler: function(c) {
            var a = $(".dt__navbar-search-toggle"),
                b = $(".dt__search-field");
            this.body.toggleClass(this.classes.headerSearchActive), this.body.toggleClass(this.classes.isOverlay), this.body.hasClass(this.classes.headerSearchActive) ? b.focus() : a.focus(), this.searchPopupAccessibility()
        },
        searchPopupAccessibility: function() {
            var b, a, d, c = document.querySelector(".search--header");
            let f = document.querySelector(".dt__search-field"),
                e = c.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
                g = e[e.length - 1];
            if (!c) return !1;
            for (a = 0, d = (b = c.getElementsByTagName("button")).length; a < d; a++) b[a].addEventListener("focus", h, !0), b[a].addEventListener("blur", h, !0);

            function h() {
                for (var a = this; - 1 === a.className.indexOf("search--header");) "input" === a.tagName.toLowerCase() && (-1 !== a.className.indexOf("focus") ? a.className = a.className.replace("focus", "") : a.className += " focus"), a = a.parentElement
            }
            document.addEventListener("keydown", function(a) {
                ("Tab" === a.key || 9 === a.keyCode) && (a.shiftKey ? document.activeElement === f && (g.focus(), a.preventDefault()) : document.activeElement === g && (f.focus(), a.preventDefault()))
            })
        }
    };
    a.init()
}(jQuery, window.asConfig)