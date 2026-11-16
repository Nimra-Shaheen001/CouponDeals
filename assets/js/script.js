
/* ==========================================================
   COUPONFLICKER - COMPLETE HOMEPAGE JAVASCRIPT

   01. Hero Slider + Heading Animation
   02. Top Picks Carousel
   03. Product Filters
   04. Reveal Code Popup
   05. Copy Coupon Code
   06. Coupon Rating & Review
   07. Activate Offer - New Tab
   08. Today's Deals Popup
   09. Store Redirect
   10. Deal Rating & Review

   All coupon and deal popup handlers are separate.
========================================================== */

(() => {
    "use strict";

    const $ = id => document.getElementById(id);

    const reducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    );

    /* ======================================================
       SHARED HELPERS
    ====================================================== */

    function validStoreUrl(value) {
        if (typeof value !== "string" || !value.trim()) {
            return null;
        }

        try {
            const url = new URL(value);

            if (
                url.protocol !== "https:" ||
                !url.hostname ||
                url.username ||
                url.password
            ) {
                return null;
            }

            return url.href;
        } catch {
            return null;
        }
    }

    function getSaved(key) {
        try {
            return localStorage.getItem(key);
        } catch {
            return null;
        }
    }

    function saveValue(key, value) {
        try {
            localStorage.setItem(key, value);
            return true;
        } catch {
            return false;
        }
    }

    function getRating(key) {
        const value = Number(getSaved(key));

        return Number.isInteger(value) &&
            value >= 1 &&
            value <= 5
                ? value
                : 0;
    }

    function selectText(element) {
        if (!element) return;

        const selection = window.getSelection();
        const range = document.createRange();

        range.selectNodeContents(element);

        selection?.removeAllRanges();
        selection?.addRange(range);
    }

    async function copyText(text) {
        if (!text) return false;

        if (
            navigator.clipboard?.writeText &&
            window.isSecureContext
        ) {
            try {
                await navigator.clipboard.writeText(text);
                return true;
            } catch {
                // Try local HTTP fallback below.
            }
        }

        const textarea = document.createElement("textarea");

        textarea.value = text;
        textarea.readOnly = true;
        textarea.style.position = "fixed";
        textarea.style.left = "-9999px";
        textarea.style.opacity = "0";

        document.body.appendChild(textarea);

        textarea.focus();
        textarea.select();

        let success = false;

        try {
            success = document.execCommand("copy");
        } catch {
            success = false;
        }

        textarea.remove();

        return success;
    }

    function setButtonContent(button, label, iconClass) {
        if (!button) return;

        const icon = document.createElement("i");
        icon.className = iconClass;

        button.replaceChildren(
            document.createTextNode(label + " "),
            icon
        );
    }

    /* ======================================================
       REUSABLE STAR RATING
    ====================================================== */

    function setupStars(options) {
        const {
            container,
            selector,
            message,
            storageKey,
            defaultMessage
        } = options;

        if (!container) return;

        const stars = Array.from(
            container.querySelectorAll(selector)
        );

        if (!stars.length) return;

        let selectedRating = 0;

        function paint(value) {
            stars.forEach(button => {
                const number = Number(
                    button.dataset.crRating ||
                    button.dataset.tdStar
                );

                button.classList.toggle(
                    "is-active",
                    number <= value
                );

                button.setAttribute(
                    "aria-pressed",
                    String(number === value)
                );
            });
        }

        function updateMessage() {
            if (!message) return;

            message.textContent = selectedRating
                ? `Your demo rating: ${selectedRating}/5 stars.`
                : defaultMessage;
        }

        function load(key) {
            selectedRating = getRating(key);
            paint(selectedRating);
            updateMessage();
        }

        stars.forEach(button => {
            const value = Number(
                button.dataset.crRating ||
                button.dataset.tdStar
            );

            button.addEventListener("mouseenter", () => {
                paint(value);
            });

            button.addEventListener("focus", () => {
                paint(value);
            });

            button.addEventListener("click", () => {
                const key = storageKey();

                if (!key) return;

                selectedRating = value;

                paint(selectedRating);
                updateMessage();

                saveValue(key, String(selectedRating));
            });
        });

        container.addEventListener("mouseleave", () => {
            paint(selectedRating);
        });

        container.addEventListener("focusout", event => {
            if (!container.contains(event.relatedTarget)) {
                paint(selectedRating);
            }
        });

        load(storageKey());

        return { load };
    }

    /* ======================================================
       REUSABLE DEMO REVIEW
    ====================================================== */

    function setupReview(options) {
        const {
            toggle,
            form,
            textarea,
            message,
            storageKey
        } = options;

        if (!toggle || !form || !textarea) return;

        function updateButton() {
            toggle.textContent = !form.hidden
                ? "Hide Review Form"
                : getSaved(storageKey())
                    ? "Edit Demo Review"
                    : "Leave A Review";
        }

        function load(key) {
            form.hidden = true;
            textarea.value = getSaved(key) || "";

            if (message) {
                message.textContent = "";
            }

            updateButton();
        }

        toggle.addEventListener("click", () => {
            form.hidden = !form.hidden;
            updateButton();

            if (!form.hidden) {
                textarea.focus();
            }
        });

        form.addEventListener("submit", event => {
            event.preventDefault();

            const key = storageKey();
            const review = textarea.value.trim();

            if (!key) return;

            if (!review) {
                if (message) {
                    message.textContent =
                        "Please enter your review.";
                }
                return;
            }

            const success = saveValue(key, review);

            if (message) {
                message.textContent = success
                    ? "Your demo review was saved in this browser."
                    : "Unable to save your review.";
            }

            if (success) {
                form.hidden = true;
                updateButton();
            }
        });

        load(storageKey());

        return { load };
    }

    /* ======================================================
       01. HERO SLIDER
    ====================================================== */

    function initHeroSlider() {
        const hero = $("hmHero");
        if (!hero) return;

        const slides = Array.from(
            hero.querySelectorAll("[data-hm-slide]")
        );

        const dots = Array.from(
            hero.querySelectorAll("[data-hm-dot]")
        );

        const previous = $("hmHeroPrev");
        const next = $("hmHeroNext");

        if (!slides.length) return;

        const duration = 5000;

        let currentIndex = 0;
        let timer = null;
        let focusPaused = false;
        let touchStartX = 0;
        let touchStartY = 0;

        /* Animated heading words */

        function prepareHeadings() {
            hero.querySelectorAll("[data-hm-words]")
                .forEach(line => {
                    if (line.dataset.prepared === "true") {
                        return;
                    }

                    const words = line.textContent
                        .trim()
                        .split(/\s+/)
                        .filter(Boolean);

                    const fragment =
                        document.createDocumentFragment();

                    words.forEach((word, index) => {
                        const wrapper =
                            document.createElement("span");

                        const inner =
                            document.createElement("span");

                        wrapper.className = "hm-word";
                        inner.className = "hm-word-inner";
                        inner.textContent = word;

                        inner.style.setProperty(
                            "--word-index",
                            String(index)
                        );

                        wrapper.appendChild(inner);
                        fragment.appendChild(wrapper);

                        if (index < words.length - 1) {
                            fragment.appendChild(
                                document.createTextNode(" ")
                            );
                        }
                    });

                    line.replaceChildren(fragment);
                    line.dataset.prepared = "true";
                });
        }

        function restartAnimations(slide) {
            if (!slide || reducedMotion.matches) return;

            const elements = slide.querySelectorAll(
                ".hm-fashion-badge, " +
                ".hm-word-inner, " +
                ".hm-fashion-content > p, " +
                ".hm-fashion-buttons"
            );

            elements.forEach(element => {
                element.style.animation = "none";
            });

            void slide.offsetWidth;

            elements.forEach(element => {
                element.style.removeProperty("animation");
            });
        }

        function showSlide(index) {
            currentIndex =
                (index + slides.length) % slides.length;

            slides.forEach((slide, i) => {
                const active = i === currentIndex;

                slide.classList.toggle(
                    "is-active",
                    active
                );

                slide.setAttribute(
                    "aria-hidden",
                    String(!active)
                );

                if (active) {
                    slide.removeAttribute("inert");
                } else {
                    slide.setAttribute("inert", "");
                }
            });

            dots.forEach((dot, i) => {
                const active = i === currentIndex;

                dot.classList.toggle("active", active);

                if (active) {
                    dot.setAttribute(
                        "aria-current",
                        "true"
                    );
                } else {
                    dot.removeAttribute("aria-current");
                }
            });

            restartAnimations(slides[currentIndex]);
        }

        function stopAutoplay() {
            if (timer !== null) {
                clearTimeout(timer);
                timer = null;
            }
        }

        function startAutoplay() {
            stopAutoplay();

            if (
                slides.length < 2 ||
                document.hidden ||
                reducedMotion.matches ||
                focusPaused
            ) {
                return;
            }

            timer = window.setTimeout(() => {
                showSlide(currentIndex + 1);
                startAutoplay();
            }, duration);
        }

        function changeSlide(index) {
            showSlide(index);
            startAutoplay();
        }

        previous?.addEventListener("click", () => {
            changeSlide(currentIndex - 1);
        });

        next?.addEventListener("click", () => {
            changeSlide(currentIndex + 1);
        });

        dots.forEach((dot, index) => {
            dot.addEventListener("click", () => {
                changeSlide(index);
            });
        });

        /* Keyboard navigation */

        hero.addEventListener("keydown", event => {
            if (event.target.closest("a")) return;

            if (event.key === "ArrowLeft") {
                event.preventDefault();
                changeSlide(currentIndex - 1);
            } else if (event.key === "ArrowRight") {
                event.preventDefault();
                changeSlide(currentIndex + 1);
            }
        });

        /* Pause while user is interacting */

        hero.addEventListener("focusin", () => {
            focusPaused = true;
            stopAutoplay();
        });

        hero.addEventListener("focusout", event => {
            if (!hero.contains(event.relatedTarget)) {
                focusPaused = false;
                startAutoplay();
            }
        });

        /* Mobile swipe */

        hero.addEventListener(
            "touchstart",
            event => {
                if (!event.touches.length) return;

                touchStartX = event.touches[0].clientX;
                touchStartY = event.touches[0].clientY;
            },
            { passive: true }
        );

        hero.addEventListener(
            "touchend",
            event => {
                if (!event.changedTouches.length) return;

                const differenceX =
                    event.changedTouches[0].clientX -
                    touchStartX;

                const differenceY =
                    event.changedTouches[0].clientY -
                    touchStartY;

                if (
                    Math.abs(differenceX) > 55 &&
                    Math.abs(differenceX) >
                    Math.abs(differenceY)
                ) {
                    changeSlide(
                        currentIndex +
                        (differenceX < 0 ? 1 : -1)
                    );
                }
            },
            { passive: true }
        );

        document.addEventListener(
            "visibilitychange",
            startAutoplay
        );

        reducedMotion.addEventListener?.(
            "change",
            startAutoplay
        );

        prepareHeadings();
        showSlide(0);
        startAutoplay();
    }

    /* ======================================================
       02. TOP PICKS CAROUSEL
    ====================================================== */

    function initTopPicks() {
        const track = $("cfPicksTrack");
        const previous = $("cfPicksPrev");
        const next = $("cfPicksNext");

        if (!track || !previous || !next) return;

        function getScrollStep() {
            const card = track.querySelector(
                ".cf-picks-card"
            );

            if (!card) return 240;

            const gap =
                parseFloat(
                    getComputedStyle(track).columnGap
                ) || 0;

            return (
                card.getBoundingClientRect().width +
                gap
            );
        }

        function updateArrows() {
            const maxScroll = Math.max(
                0,
                track.scrollWidth - track.clientWidth
            );

            previous.disabled =
                track.scrollLeft <= 2;

            next.disabled =
                track.scrollLeft >= maxScroll - 2;
        }

        function move(direction) {
            track.scrollBy({
                left: direction * getScrollStep(),
                behavior: reducedMotion.matches
                    ? "auto"
                    : "smooth"
            });
        }

        previous.addEventListener(
            "click",
            () => move(-1)
        );

        next.addEventListener(
            "click",
            () => move(1)
        );

        track.addEventListener(
            "scroll",
            updateArrows,
            { passive: true }
        );

        window.addEventListener(
            "resize",
            updateArrows
        );

        track.addEventListener("keydown", event => {
            if (event.target !== track) return;

            if (event.key === "ArrowRight") {
                event.preventDefault();
                move(1);
            } else if (event.key === "ArrowLeft") {
                event.preventDefault();
                move(-1);
            }
        });

        updateArrows();
    }

    /* ======================================================
       03. PRODUCT CATEGORY FILTERS
    ====================================================== */

    function initProductFilters() {
        const home = $("homePage");
        if (!home) return;

        const buttons = Array.from(
            home.querySelectorAll("[data-hm-filter]")
        );

        const cards = Array.from(
            home.querySelectorAll("[data-hm-category]")
        );

        if (!buttons.length || !cards.length) return;

        buttons.forEach(button => {
            button.addEventListener("click", () => {
                const category =
                    button.dataset.hmFilter || "All";

                cards.forEach(card => {
                    card.hidden =
                        category !== "All" &&
                        card.dataset.hmCategory !== category;
                });

                buttons.forEach(item => {
                    const active = item === button;

                    item.classList.toggle(
                        "active",
                        active
                    );

                    item.setAttribute(
                        "aria-pressed",
                        String(active)
                    );
                });
            });
        });
    }

    /* ======================================================
       04. REVEAL CODE POPUP

       New tab:
       index.php?coupon=nike

       Closing popup:
       Redirect to selected coupon store.
    ====================================================== */

    function initCouponPopup() {
        const dialog = $("crCouponDialog");
        if (!dialog) return;

        if (dialog.dataset.initialized === "true") {
            return;
        }

        dialog.dataset.initialized = "true";

        const closeButton = $("crCloseDialog");
        const codeElement = $("crDisplayedCode");
        const copyButton = $("crCopyButton");
        const copyFeedback = $("crCopyFeedback");

        const storeId =
            dialog.querySelector("[data-cr-store]")
                ?.dataset.crStore || "";

        const storeUrl = validStoreUrl(
            dialog.dataset.storeUrl || ""
        );

        const shouldOpen =
            dialog.dataset.autoOpen === "true";

        let redirectStarted = false;

        /* Open selected coupon */

        if (
            shouldOpen &&
            !dialog.open &&
            typeof dialog.showModal === "function"
        ) {
            dialog.showModal();
        }

        /* Close dialog */

        function closeCouponPopup() {
            if (!dialog.open) return;
            dialog.close();
        }

        closeButton?.addEventListener(
            "click",
            closeCouponPopup
        );

        /* Close on backdrop click */

        dialog.addEventListener("click", event => {
            if (event.target === dialog) {
                closeCouponPopup();
            }
        });

        /* Redirect only from an opened coupon popup */

        function redirectCouponStore() {
            if (
                !shouldOpen ||
                !storeUrl ||
                redirectStarted
            ) {
                return;
            }

            redirectStarted = true;

            window.location.replace(storeUrl);
        }

        /*
         * Fires when the popup closes using:
         * X button, backdrop or Escape.
         */
        dialog.addEventListener(
            "close",
            redirectCouponStore
        );

        /* Copy code */

        copyButton?.addEventListener(
            "click",
            async () => {
                const code =
                    codeElement?.textContent?.trim() || "";

                if (!code) return;

                const copied = await copyText(code);

                if (copied) {
                    copyButton.classList.add(
                        "is-copied"
                    );

                    setButtonContent(
                        copyButton,
                        "COPIED",
                        "bi bi-check2"
                    );

                    if (copyFeedback) {
                        copyFeedback.textContent =
                            "Coupon code copied successfully.";
                    }
                } else {
                    selectText(codeElement);

                    if (copyFeedback) {
                        copyFeedback.textContent =
                            "Please copy the selected code manually.";
                    }
                }
            }
        );

        /* Store rating */

        const ratingKey =
            `couponflicker-rating-${storeId}`;

        setupStars({
            container: $("crRatingStars"),
            selector: "[data-cr-rating]",
            message: $("crRatingMessage"),
            storageKey: () => storeId ? ratingKey : "",
            defaultMessage: "Be the first to rate this store."
        });

        /* Store review */

        const reviewKey =
            `couponflicker-review-${storeId}`;

        setupReview({
            toggle: $("crReviewToggle"),
            form: $("crReviewForm"),
            textarea: $("crReviewText"),
            message: $("crReviewMessage"),
            storageKey: () => storeId ? reviewKey : ""
        });
    }

    /* ======================================================
       05. TODAY'S TOP DEALS

       Activate Offer -> New homepage tab
       Popup close -> Selected merchant website
    ====================================================== */

    function initTodayDeals() {
        const section = $("todayTopDeals");
        const dialog = $("tdOfferDialog");

        if (!dialog) return;

        if (dialog.dataset.initialized === "true") {
            return;
        }

        dialog.dataset.initialized = "true";

        const closeButton = $("tdCloseDialog");
        const logo = $("tdDialogLogo");
        const logoFallback = $("tdLogoFallback");

        const storeElement = $("tdDialogStore");
        const titleElement = $("tdDialogTitle");
        const discountElement = $("tdDialogDiscount");

        const shopLink = $("tdShopLink");
        const storeTextLink = $("tdStoreTextLink");

        const expiryElement = $("tdDialogExpiry");
        const rateHeading = $("tdRateHeading");
        const ratingMessage = $("tdRatingMessage");

        const reviewToggle = $("tdReviewToggle");
        const reviewForm = $("tdReviewForm");
        const reviewText = $("tdReviewText");
        const reviewMessage = $("tdReviewMessage");

        const dataElement = $("tdSelectedOfferData");

        let activeDeal = null;
        let merchantUrl = null;
        let redirectStarted = false;
        let popupWasOpened = false;

        /* ==================================================
           READ OFFER FROM PHP JSON
        ================================================== */

        if (dataElement) {
            try {
                const parsed = JSON.parse(
                    dataElement.textContent
                );

                if (
                    parsed &&
                    typeof parsed === "object" &&
                    !Array.isArray(parsed)
                ) {
                    activeDeal = parsed;
                }
            } catch (error) {
                console.error(
                    "CouponFlicker: Invalid deal JSON",
                    error
                );
            }
        }

        /* ==================================================
           NEW TAB LINK

           Existing anchor:
           index.php?offer=nike-deal

           Anchors with target="_blank" naturally open
           in a new tab. No window.open is required.
        ================================================== */

        section?.querySelectorAll(
            "a[data-td-activate]"
        ).forEach(link => {
            link.setAttribute("target", "_blank");
            link.setAttribute(
                "rel",
                "noopener noreferrer"
            );
        });

        /*
         * Optional compatibility with old BUTTON elements.
         * Recommended implementation is an anchor.
         */
        section?.addEventListener("click", event => {
            const button = event.target.closest(
                "button[data-td-activate]"
            );

            if (!button) return;

            const offerId =
                button.dataset.id || "";

            if (!offerId) return;

            const offerPage = new URL(
                window.location.href
            );

            offerPage.searchParams.delete("coupon");
            offerPage.searchParams.set(
                "offer",
                offerId
            );

            window.open(
                offerPage.href,
                "_blank",
                "noopener,noreferrer"
            );
        });

        /* ==================================================
           POPULATE OFFER POPUP
        ================================================== */

        function populateOffer() {
            if (!activeDeal) return false;

            merchantUrl = validStoreUrl(
                activeDeal.url || ""
            );

            if (!merchantUrl) {
                console.error(
                    "CouponFlicker: Invalid merchant URL"
                );
                return false;
            }

            const store =
                String(activeDeal.store || "Store");

            const title =
                String(activeDeal.title || "Shopping Offer");

            const discount =
                String(activeDeal.discount || "Offer");

            const expiry =
                String(activeDeal.expiry || "Not confirmed");

            if (storeElement) {
                storeElement.textContent = store;
            }

            if (titleElement) {
                titleElement.textContent = title;
            }

            if (discountElement) {
                discountElement.textContent = discount;
            }

            /* Merchant buttons */

            if (shopLink) {
                shopLink.href = merchantUrl;

                setButtonContent(
                    shopLink,
                    `Shop at ${store}`,
                    "bi bi-arrow-up-right"
                );
            }

            if (storeTextLink) {
                storeTextLink.href = merchantUrl;
                storeTextLink.textContent = store;
            }

            /* Expiry */

            if (expiryElement) {
                expiryElement.textContent =
                    expiry === "Not confirmed"
                        ? "Expiry not confirmed"
                        : `Expires: ${expiry}`;
            }

            if (rateHeading) {
                rateHeading.textContent =
                    `Rate ${store}`;
            }

            /* Store logo */

            if (logoFallback) {
                logoFallback.textContent = store;
                logoFallback.hidden = true;
            }

            if (logo) {
                logo.hidden = true;
                logo.removeAttribute("src");
                logo.alt = `${store} logo`;

                const domain =
                    String(activeDeal.domain || "");

                if (
                    domain &&
                    /^[a-z0-9.-]+$/i.test(domain)
                ) {
                    logo.src =
                        "https://www.google.com/s2/favicons?domain=" +
                        encodeURIComponent(domain) +
                        "&sz=128";

                    logo.hidden = false;
                } else if (logoFallback) {
                    logoFallback.hidden = false;
                }
            }

            return true;
        }

        /* Logo image fallback */

        logo?.addEventListener("error", () => {
            logo.hidden = true;

            if (logoFallback) {
                logoFallback.hidden = false;
            }
        });

        /* ==================================================
           RATING AND REVIEW
        ================================================== */

        const ratingController = setupStars({
            container: $("tdRatingStars"),
            selector: "[data-td-star]",
            message: ratingMessage,
            storageKey: () => activeDeal?.id
                ? `cf-deal-rating-${activeDeal.id}`
                : "",
            defaultMessage: "Be the first to rate this store."
        });

        const reviewController = setupReview({
            toggle: reviewToggle,
            form: reviewForm,
            textarea: reviewText,
            message: reviewMessage,
            storageKey: () => activeDeal?.id
                ? `cf-deal-review-${activeDeal.id}`
                : ""
        });

        /* ==================================================
           AUTO OPEN IN NEW TAB
        ================================================== */

        if (
            activeDeal &&
            dialog.dataset.autoOpen === "true" &&
            populateOffer()
        ) {
            const dealId =
                String(activeDeal.id || "");

            ratingController?.load(
                `cf-deal-rating-${dealId}`
            );

            reviewController?.load(
                `cf-deal-review-${dealId}`
            );

            if (
                typeof dialog.showModal === "function" &&
                !dialog.open
            ) {
                dialog.showModal();
                popupWasOpened = true;
            }
        }

        /* ==================================================
           CLOSE OFFER POPUP
        ================================================== */

        function closeOfferPopup() {
            if (!dialog.open) return;

            dialog.close();
        }

        closeButton?.addEventListener(
            "click",
            closeOfferPopup
        );

        /* Outside click */

        dialog.addEventListener("click", event => {
            if (event.target === dialog) {
                closeOfferPopup();
            }
        });

        /* ==================================================
           REDIRECT TO MERCHANT

           Runs only after closing the selected offer.
           The navigation replaces this new tab's page.
        ================================================== */

        function redirectToMerchant() {
            if (
                !popupWasOpened ||
                !activeDeal ||
                !merchantUrl ||
                redirectStarted
            ) {
                return;
            }

            redirectStarted = true;

            window.location.replace(merchantUrl);
        }

        /*
         * The close event also fires when the user
         * presses the Escape key.
         */
        dialog.addEventListener(
            "close",
            redirectToMerchant
        );

        /* ==================================================
           OPTIONAL SHOP LINK

           Shop at Store directly opens the merchant
           in the currently opened offer tab.
        ================================================== */

        shopLink?.addEventListener("click", () => {
            redirectStarted = true;
        });

        storeTextLink?.addEventListener("click", () => {
            redirectStarted = true;
        });
    }

    /* ======================================================
       INITIALIZE ALL COMPONENTS
    ====================================================== */

    function initialize() {
        if (!$("homePage")) return;

        initHeroSlider();
        initTopPicks();
        initProductFilters();

        /* Separate popup functionality */

        initCouponPopup();
        initTodayDeals();
    }

    if (document.readyState === "loading") {
        document.addEventListener(
            "DOMContentLoaded",
            initialize,
            { once: true }
        );
    } else {
        initialize();
    }
})();


/* ==========================================
   COUPONFLICKER - WORKING HOMEPAGE REVEAL
========================================== */

(() => {
    "use strict";

    function initHomepageReveal() {

        // Only run on homepage
        const sections = [
            "cfTopPicks",
            "cfvcCoupons",
            "todayTopDeals",
            "popularCategories",
            "popularProducts",
            "recentPartneredStores",
            "smartSavings",
            "shoppingStories",
            "trendingTopics",
            "homeFaq"
        ];

        const presentSections = sections
            .map(id => document.getElementById(id))
            .filter(Boolean);

        if (!presentSections.length) return;

        if (document.body.dataset.cfRevealReady === "1") {
            return;
        }

        document.body.dataset.cfRevealReady = "1";

        const reducedMotion = window.matchMedia(
            "(prefers-reduced-motion: reduce)"
        ).matches;

        if (
            reducedMotion ||
            !("IntersectionObserver" in window)
        ) {
            return;
        }

        const observer = new IntersectionObserver(entries => {

            entries.forEach(entry => {

                if (!entry.isIntersecting) return;

                entry.target.classList.add("cf-show");

                observer.unobserve(entry.target);
            });

        }, {
            threshold: 0.05,
            rootMargin: "0px 0px -25px 0px"
        });

        /*
         * We target the actual section's direct content
         * instead of relying on old class names.
         */

        const items = [];

        presentSections.forEach(section => {

            // Animate section headings
            const heading = section.querySelector("h2");

            if (heading) {
                items.push(heading);
            }

            /*
             * Find cards within each section
             * using common card/element classes.
             */
            const cards = section.querySelectorAll(
                [
                    ".tp-card",
                    ".cfvc-card",
                    ".td-card",
                    ".pc-card",
                    ".pp-card",
                    ".rps-card",
                    "[class*='coupon-card']",
                    "[class*='deal-card']",
                    "[class*='category-card']",
                    "[class*='story-card']"
                ].join(",")
            );

            if (cards.length) {

                cards.forEach((card, index) => {

                    card.style.setProperty(
                        "--cf-delay",
                        `${(index % 4) * 90}ms`
                    );

                    items.push(card);
                });

            } else {
                /*
                 * Fallback: animate the section's
                 * first main content container.
                 */
                const fallback = section.querySelector(
                    ".container > div"
                );

                if (fallback && fallback !== heading) {
                    items.push(fallback);
                }
            }

        });

        const uniqueItems = [...new Set(items)];

        uniqueItems.forEach(item => {
            item.classList.add("cf-scroll-item");
        });

        document.body.classList.add("cf-scroll-ready");

        uniqueItems.forEach(item => {
            observer.observe(item);
        });
    }

    if (document.readyState === "loading") {
        document.addEventListener(
            "DOMContentLoaded",
            initHomepageReveal,
            { once: true }
        );
    } else {
        initHomepageReveal();
    }

})();


/* ==================================================
   COUPONFLICKER - CATEGORY DETAIL
   Subcategory Search + Scroll Reveal
================================================== */

(() => {
    "use strict";

    function initCategoryDetail() {
        const page = document.getElementById("cdPage");

        if (!page || page.dataset.initialized === "1") {
            return;
        }

        page.dataset.initialized = "1";

        const search = document.getElementById("cdSubSearch");
        const clear = document.getElementById("cdSubClear");
        const reset = document.getElementById("cdSubReset");
        const empty = document.getElementById("cdSubEmpty");

        const cards = [
            ...page.querySelectorAll(".cd-sub-card")
        ];

        function normalize(value) {
            return String(value || "").trim().toLowerCase();
        }

        function filterSubcategories() {
            if (!search) return;

            const query = normalize(search.value);
            let visible = 0;

            cards.forEach(card => {
                const name = normalize(card.dataset.subName);
                const match = !query || name.includes(query);

                card.hidden = !match;

                if (match) visible++;
            });

            if (empty) {
                empty.hidden = visible !== 0;
            }

            if (clear) {
                clear.hidden = search.value.length === 0;
            }
        }

        function clearSearch() {
            if (!search) return;

            search.value = "";
            filterSubcategories();
            search.focus();
        }

        search?.addEventListener(
            "input",
            filterSubcategories
        );

        clear?.addEventListener(
            "click",
            clearSearch
        );

        reset?.addEventListener(
            "click",
            clearSearch
        );

        filterSubcategories();

        /* Scroll reveal */

        const reducedMotion = window.matchMedia(
            "(prefers-reduced-motion: reduce)"
        ).matches;

        if (
            reducedMotion ||
            !("IntersectionObserver" in window)
        ) {
            return;
        }

        const elements = [
            ...page.querySelectorAll(
                [
                    ".cd-hero-content",
                    ".cd-hero-visual",
                    ".cd-section-heading",
                    ".cd-sub-card",
                    ".cd-store-card",
                    ".cd-related-card",
                    ".cd-bottom-panel"
                ].join(",")
            )
        ];

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;

                entry.target.classList.add("cd-visible");
                observer.unobserve(entry.target);
            });
        }, {
            threshold: 0.05,
            rootMargin: "0px 0px -25px 0px"
        });

        elements.forEach(element => {
            element.classList.add("cd-reveal");

            if (element.matches(
                ".cd-sub-card, .cd-store-card, .cd-related-card"
            )) {
                const siblings = [
                    ...element.parentElement.children
                ];

                const index = siblings.indexOf(element);

                element.style.setProperty(
                    "--cd-delay",
                    `${(index % 5) * 65}ms`
                );
            }

            observer.observe(element);
        });

        page.classList.add("cd-motion-ready");

        /* Search results should never remain invisible */

        const grid = document.getElementById("cdSubGrid");

        if (grid) {
            const mutationObserver = new MutationObserver(
                mutations => {
                    mutations.forEach(mutation => {
                        if (
                            mutation.attributeName !== "hidden" ||
                            mutation.target.hidden
                        ) {
                            return;
                        }

                        const card = mutation.target;

                        if (!card.matches(".cd-sub-card")) {
                            return;
                        }

                        observer.observe(card);
                    });
                }
            );

            mutationObserver.observe(grid, {
                subtree: true,
                attributes: true,
                attributeFilter: ["hidden"]
            });
        }
    }

    if (document.readyState === "loading") {
        document.addEventListener(
            "DOMContentLoaded",
            initCategoryDetail,
            { once: true }
        );
    } else {
        initCategoryDetail();
    }
})();
