
/* =====================================================
   COUPONFLICKER - ALL STORES
   Live Search | A-Z Navigation | View More
===================================================== */

(() => {
    "use strict";

    function initStoresPage() {

        const page = document.getElementById("sdirPage");

        if (!page || page.dataset.initialized === "1") {
            return;
        }

        page.dataset.initialized = "1";

        /* Elements */

        const search = document.getElementById("sdirSearch");
        const searchForm = document.getElementById("sdirSearchForm");
        const clearButton = document.getElementById("sdirClear");

        const alphabetButtons = [
            ...document.querySelectorAll(".sdir-letter-tile")
        ];

        const groups = [
            ...document.querySelectorAll(".sdir-group")
        ];

        const resultCount =
            document.getElementById("sdirResultCount");

        const resetButton =
            document.getElementById("sdirReset");

        const emptyReset =
            document.getElementById("sdirEmptyReset");

        const empty =
            document.getElementById("sdirEmpty");

        if (!search || !searchForm || !groups.length) {
            return;
        }

        const expandedGroups = new Set();

        /* Default horizontal cards per letter */
        const previewLimit = 3;

        /* Normalize for case-insensitive search */

        const normalize = value =>
            String(value || "").trim().toLowerCase();

        function getAllCards(group) {
            return [
                ...group.querySelectorAll(
                    ".sdir-featured-item, .sdir-small-card"
                )
            ];
        }

        function getMatches(group, query) {
            return getAllCards(group).filter(card => {
                const name = normalize(card.dataset.storeName);
                return !query || name.includes(query);
            });
        }

        /* =====================================
           RENDER LETTER GROUP
        ===================================== */

        function renderGroup(group, query) {

            const letter = group.dataset.groupLetter;

            const matches = getMatches(group, query);
            const matchSet = new Set(matches);

            group.hidden = matches.length === 0;

            if (!matches.length) {
                return 0;
            }

            const featured = [
                ...group.querySelectorAll(".sdir-featured-item")
            ];

            const smallCards = [
                ...group.querySelectorAll(".sdir-small-card")
            ];

            const expanded = expandedGroups.has(letter);
            const searching = query.length > 0;

            /* Featured stores */

            featured.forEach(card => {
                card.hidden = !matchSet.has(card);
            });

            /* Additional stores */

            let matchingIndex = 0;

            smallCards.forEach(card => {

                if (!matchSet.has(card)) {
                    card.hidden = true;
                    return;
                }

                const shouldShow =
                    searching ||
                    expanded ||
                    matchingIndex < previewLimit;

                card.hidden = !shouldShow;
                matchingIndex++;
            });

            /* Show / hide View More */

            const moreButton = group.querySelector(
                ".sdir-view-more"
            );

            if (moreButton) {

                const matchingSmallCount =
                    smallCards.filter(card => matchSet.has(card)).length;

                const canExpand =
                    !searching &&
                    matchingSmallCount > previewLimit;

                moreButton.hidden = !canExpand;

                moreButton.setAttribute(
                    "aria-expanded",
                    String(expanded)
                );

                const label = moreButton.querySelector("span");
                const icon = moreButton.querySelector("i");

                if (label) {
                    label.textContent = expanded
                        ? "Show Less"
                        : "View More";
                }

                if (icon) {
                    icon.className = expanded
                        ? "bi bi-arrow-up"
                        : "bi bi-arrow-right";
                }
            }

            return matches.length;
        }

        /* =====================================
           ALPHABET COUNTS
        ===================================== */

        function updateAlphabet(query) {

            alphabetButtons.forEach(button => {

                const letter = button.dataset.letter;

                const group = groups.find(item =>
                    item.dataset.groupLetter === letter
                );

                const count = group
                    ? getMatches(group, query).length
                    : 0;

                const number = button.querySelector(
                    "[data-letter-count]"
                );

                if (number) {
                    number.textContent = count;
                }

                button.disabled = count === 0;

                if (button.disabled) {
                    button.classList.remove("active");
                    button.setAttribute("aria-pressed", "false");
                }
            });
        }

        /* =====================================
           RENDER ALL
        ===================================== */

        function render() {

            const query = normalize(search.value);
            let total = 0;

            groups.forEach(group => {
                total += renderGroup(group, query);
            });

            updateAlphabet(query);

            if (resultCount) {
                resultCount.textContent =
                    `${total} ${total === 1 ? "store" : "stores"} available`;
            }

            if (empty) {
                empty.hidden = total !== 0;
            }

            if (clearButton) {
                clearButton.hidden = search.value.length === 0;
            }
        }

        /* =====================================
           SCROLL HELPER
        ===================================== */

        function scrollToElement(element) {

            if (!element) return;

            const reducedMotion = window.matchMedia(
                "(prefers-reduced-motion: reduce)"
            ).matches;

            element.scrollIntoView({
                behavior: reducedMotion ? "auto" : "smooth",
                block: "start"
            });
        }

        /* =====================================
           UPDATE SEARCH URL
        ===================================== */

        function updateUrl() {

            const url = new URL(window.location.href);
            const query = search.value.trim();

            if (query) {
                url.searchParams.set("q", query);
            } else {
                url.searchParams.delete("q");
            }

            window.history.replaceState(
                null,
                "",
                url.pathname + url.search + url.hash
            );
        }

        /* =====================================
           CLEAR SEARCH
        ===================================== */

        function clearSearch() {

            search.value = "";
            expandedGroups.clear();

            alphabetButtons.forEach(button => {
                button.classList.remove("active");
                button.setAttribute("aria-pressed", "false");
            });

            render();
            updateUrl();

            search.focus();
        }

        /* =====================================
           LIVE SEARCH
        ===================================== */

        search.addEventListener("input", () => {

            expandedGroups.clear();

            alphabetButtons.forEach(button => {
                button.classList.remove("active");
                button.setAttribute("aria-pressed", "false");
            });

            render();
        });

        /* =====================================
           FORM SUBMIT
        ===================================== */

        searchForm.addEventListener("submit", event => {

            event.preventDefault();

            render();
            updateUrl();

            scrollToElement(
                document.getElementById("sdirDirectory")
            );
        });

        /* =====================================
           CLEAR / RESET BUTTONS
        ===================================== */

        clearButton?.addEventListener(
            "click",
            clearSearch
        );

        resetButton?.addEventListener(
            "click",
            clearSearch
        );

        emptyReset?.addEventListener(
            "click",
            clearSearch
        );

        /* =====================================
           A-Z LETTER NAVIGATION
        ===================================== */

        alphabetButtons.forEach(button => {

            button.addEventListener("click", () => {

                if (button.disabled) return;

                const selectedLetter = button.dataset.letter;

                const targetGroup = groups.find(group =>
                    group.dataset.groupLetter === selectedLetter
                );

                if (!targetGroup || targetGroup.hidden) {
                    return;
                }

                alphabetButtons.forEach(item => {
                    const active = item === button;

                    item.classList.toggle("active", active);
                    item.setAttribute(
                        "aria-pressed",
                        String(active)
                    );
                });

                scrollToElement(targetGroup);
            });
        });

        /* =====================================
           VIEW MORE / SHOW LESS
        ===================================== */

        groups.forEach(group => {

            const moreButton = group.querySelector(
                ".sdir-view-more"
            );

            if (!moreButton) return;

            moreButton.addEventListener("click", () => {

                const letter = group.dataset.groupLetter;

                if (expandedGroups.has(letter)) {
                    expandedGroups.delete(letter);
                } else {
                    expandedGroups.add(letter);
                }

                render();

                // When collapsing, restore section position.
                if (!expandedGroups.has(letter)) {
                    scrollToElement(group);
                }
            });
        });

        /* =====================================
           INITIAL SEARCH QUERY
        ===================================== */

        const urlParams = new URLSearchParams(
            window.location.search
        );

        search.value = urlParams.get("q") || "";

        render();
    }

    /* Initialize page */

    if (document.readyState === "loading") {

        document.addEventListener(
            "DOMContentLoaded",
            initStoresPage,
            { once: true }
        );

    } else {
        initStoresPage();
    }

})();


/* ============================================
   COUPONFLICKER - SCROLL REVEAL
   IntersectionObserver Animation
============================================ */

(() => {
    "use strict";

    function initStoresScrollAnimations() {
        const page = document.getElementById("sdirPage");

        if (!page || page.dataset.motionInitialized === "1") {
            return;
        }

        page.dataset.motionInitialized = "1";

        const reduceMotion = window.matchMedia(
            "(prefers-reduced-motion: reduce)"
        ).matches;

        if (reduceMotion || !("IntersectionObserver" in window)) {
            return;
        }

        const elements = [
            ...page.querySelectorAll(
                [
                    ".sdir-hero-content",
                    ".sdir-alphabet",
                    ".sdir-results-row",
                    ".sdir-group-heading",
                    ".sdir-featured-item",
                    ".sdir-small-card",
                    ".sdir-cta-inner"
                ].join(",")
            )
        ];

        if (!elements.length) return;

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;

                const element = entry.target;

                element.classList.add("sdir-visible");
                observer.unobserve(element);
            });
        }, {
            threshold: 0.08,
            rootMargin: "0px 0px -35px 0px"
        });

        elements.forEach((element, index) => {
            element.classList.add("sdir-animate");

            /*
             * Small stagger effect between cards.
             * The delay repeats every 6 elements.
             */
            const isCard = element.matches(
                ".sdir-featured-item, .sdir-small-card"
            );

            if (isCard) {
                const parent = element.parentElement;
                const cardIndex = [...parent.children]
                    .filter(child =>
                        child.matches(
                            ".sdir-featured-item, .sdir-small-card"
                        )
                    )
                    .indexOf(element);

                element.style.setProperty(
                    "--sdir-delay",
                    `${(cardIndex % 6) * 85}ms`
                );
            }

            observer.observe(element);
        });

        page.classList.add("sdir-motion-ready");

        /*
         * If users search or click View More,
         * dynamically revealed cards should
         * animate when they appear.
         */
        const groups = document.getElementById("sdirGroups");

        if (groups) {
            const mutationObserver = new MutationObserver(mutations => {
                mutations.forEach(mutation => {
                    if (
                        mutation.type !== "attributes" ||
                        mutation.attributeName !== "hidden"
                    ) {
                        return;
                    }

                    const target = mutation.target;

                    if (
                        !target.matches(
                            ".sdir-featured-item, .sdir-small-card, .sdir-group"
                        ) ||
                        target.hidden
                    ) {
                        return;
                    }

                    if (target.classList.contains("sdir-animate")) {
                        target.classList.remove("sdir-visible");
                        observer.observe(target);
                    }
                });
            });

            mutationObserver.observe(groups, {
                attributes: true,
                attributeFilter: ["hidden"],
                subtree: true
            });
        }
    }

    if (document.readyState === "loading") {
        document.addEventListener(
            "DOMContentLoaded",
            initStoresScrollAnimations,
            { once: true }
        );
    } else {
        initStoresScrollAnimations();
    }
})();
