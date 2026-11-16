
/* =====================================================
   COUPONFLICKER - DEALS PAGE JAVASCRIPT
   Compatible with deals.php above
===================================================== */

(() => {
    "use strict";

    function initDealsPage() {

        const page = document.getElementById("dlPage");

        if (!page || page.dataset.initialized === "1") {
            return;
        }

        const grid = document.getElementById("dlProductGrid");
        const search = document.getElementById("dlSearch");
        const store = document.getElementById("dlStore");
        const category = document.getElementById("dlCategory");
        const sort = document.getElementById("dlSort");
        const reset = document.getElementById("dlReset");
        const emptyReset = document.getElementById("dlEmptyReset");

        const empty = document.getElementById("dlEmpty");
        const count = document.getElementById("dlResultCount");
        const pagination = document.getElementById("dlPagination");

        const heroForm = document.getElementById("dlHeroForm");
        const heroInput = document.getElementById("dlHeroInput");

        const hotTrack = document.getElementById("dlHotTrack");
        const hotPrev = document.getElementById("dlHotPrev");
        const hotNext = document.getElementById("dlHotNext");

        if (!grid || !search || !store || !category ||
            !sort || !pagination) {
            console.error("Deals: required elements missing.");
            return;
        }

        page.dataset.initialized = "1";

        const cards = [
            ...grid.querySelectorAll(".dl-list-card")
        ];

        const orderMap = new Map(
            cards.map((card, index) => [card, index])
        );

        const state = {
            query: "",
            store: "",
            category: "",
            sort: "featured",
            page: 1,
            perPage: 8
        };

        const normalize = value =>
            String(value ?? "")
                .trim()
                .toLocaleLowerCase();

        const reduceMotion = window.matchMedia(
            "(prefers-reduced-motion: reduce)"
        );

        /* ==================================
           FILTER PRODUCTS
        =================================== */

        function filterProducts() {

            return cards.filter(card => {

                const searchText = normalize([
                    card.dataset.title,
                    card.dataset.store,
                    card.dataset.category
                ].join(" "));

                const queryMatch =
                    !state.query ||
                    searchText.includes(normalize(state.query));

                const storeMatch =
                    !state.store ||
                    normalize(card.dataset.store) ===
                    normalize(state.store);

                const categoryMatch =
                    !state.category ||
                    normalize(card.dataset.category) ===
                    normalize(state.category);

                return (
                    queryMatch &&
                    storeMatch &&
                    categoryMatch
                );
            });
        }

        /* ==================================
           SORT PRODUCTS
        =================================== */

        function sortProducts(items) {

            return [...items].sort((a, b) => {

                const priceA = Number(a.dataset.price) || 0;
                const priceB = Number(b.dataset.price) || 0;

                const discountA =
                    Number(a.dataset.discount) || 0;

                const discountB =
                    Number(b.dataset.discount) || 0;

                const titleA = a.dataset.title || "";
                const titleB = b.dataset.title || "";

                if (state.sort === "low") {
                    return priceA - priceB ||
                        orderMap.get(a) - orderMap.get(b);
                }

                if (state.sort === "high") {
                    return priceB - priceA ||
                        orderMap.get(a) - orderMap.get(b);
                }

                if (state.sort === "discount") {
                    return discountB - discountA ||
                        orderMap.get(a) - orderMap.get(b);
                }

                if (state.sort === "az") {
                    return titleA.localeCompare(titleB) ||
                        orderMap.get(a) - orderMap.get(b);
                }

                /* Featured first */

                const featuredA =
                    a.dataset.featured === "1" ? 1 : 0;

                const featuredB =
                    b.dataset.featured === "1" ? 1 : 0;

                return featuredB - featuredA ||
                    orderMap.get(a) - orderMap.get(b);
            });
        }

        /* ==================================
           CARD VISIBILITY
        =================================== */

        function hideCard(card) {
            card.hidden = true;
            card.style.setProperty(
                "display",
                "none",
                "important"
            );
        }

        function showCard(card) {
            card.hidden = false;
            card.style.setProperty(
                "display",
                "flex",
                "important"
            );
        }

        /* ==================================
           PAGINATION
        =================================== */

        function renderPagination(totalPages) {

            pagination.replaceChildren();

            if (totalPages <= 1) return;

            const makeButton = (
                label,
                number,
                disabled = false,
                current = false
            ) => {

                const button = document.createElement("button");

                button.type = "button";
                button.textContent = label;
                button.dataset.page = String(number);
                button.disabled = disabled;

                if (current) {
                    button.classList.add("active");
                    button.setAttribute(
                        "aria-current",
                        "page"
                    );
                }

                return button;
            };

            pagination.appendChild(
                makeButton(
                    "‹",
                    state.page - 1,
                    state.page === 1
                )
            );

            for (let number = 1; number <= totalPages; number++) {

                pagination.appendChild(
                    makeButton(
                        String(number),
                        number,
                        false,
                        number === state.page
                    )
                );
            }

            pagination.appendChild(
                makeButton(
                    "›",
                    state.page + 1,
                    state.page === totalPages
                )
            );
        }

        /* ==================================
           MAIN RENDER
        =================================== */

        function render() {

            const results = sortProducts(
                filterProducts()
            );

            const total = results.length;

            const totalPages = Math.ceil(
                total / state.perPage
            );

            state.page = Math.max(
                1,
                Math.min(state.page, totalPages || 1)
            );

            const start =
                (state.page - 1) * state.perPage;

            const visible = results.slice(
                start,
                start + state.perPage
            );

            cards.forEach(hideCard);

            visible.forEach(card => {
                grid.appendChild(card);
                showCard(card);
            });

            if (count) {
                count.textContent =
                    `${total} ${total === 1
                        ? "Product"
                        : "Products"}`;
            }

            if (empty) {
                empty.hidden = total !== 0;
            }

            renderPagination(totalPages);
        }

        /* ==================================
           KEEP URL IN SYNC
        =================================== */

        function updateUrl() {

            const url = new URL(window.location.href);

            if (state.query) {
                url.searchParams.set("q", state.query);
            } else {
                url.searchParams.delete("q");
            }

            if (state.store) {
                url.searchParams.set("store", state.store);
            } else {
                url.searchParams.delete("store");
            }

            if (state.category) {
                url.searchParams.set(
                    "category",
                    state.category
                );
            } else {
                url.searchParams.delete("category");
            }

            if (state.sort !== "featured") {
                url.searchParams.set("sort", state.sort);
            } else {
                url.searchParams.delete("sort");
            }

            history.replaceState(
                null,
                "",
                url.pathname + url.search + url.hash
            );
        }

        /* ==================================
           FILTER CHANGES
        =================================== */

        function applyFilters() {

            state.query = search.value.trim();
            state.store = store.value;
            state.category = category.value;
            state.sort = sort.value;
            state.page = 1;

            render();
            updateUrl();
        }

        search.addEventListener("input", applyFilters);
        store.addEventListener("change", applyFilters);
        category.addEventListener("change", applyFilters);
        sort.addEventListener("change", applyFilters);

        /* ==================================
           RESET
        =================================== */

        function resetFilters() {

            search.value = "";
            store.value = "";
            category.value = "";
            sort.value = "featured";

            if (heroInput) {
                heroInput.value = "";
            }

            applyFilters();
        }

        reset?.addEventListener("click", resetFilters);
        emptyReset?.addEventListener("click", resetFilters);

        /* ==================================
           HERO SEARCH
        =================================== */

        heroForm?.addEventListener("submit", event => {

            event.preventDefault();

            search.value = heroInput?.value || "";

            store.value = "";
            category.value = "";
            sort.value = "featured";

            applyFilters();

            document.getElementById("dlAllDeals")
                ?.scrollIntoView({
                    behavior: reduceMotion.matches
                        ? "auto"
                        : "smooth",
                    block: "start"
                });
        });

        /* ==================================
           PAGINATION CLICKS
        =================================== */

        pagination.addEventListener("click", event => {

            const button = event.target.closest(
                "button[data-page]"
            );

            if (!button || button.disabled) return;

            const target = Number(button.dataset.page);

            const totalPages = Math.ceil(
                filterProducts().length / state.perPage
            );

            if (
                !Number.isInteger(target) ||
                target < 1 ||
                target > totalPages
            ) {
                return;
            }

            state.page = target;

            render();

            document.getElementById("dlAllDeals")
                ?.scrollIntoView({
                    behavior: reduceMotion.matches
                        ? "auto"
                        : "smooth",
                    block: "start"
                });
        });

        /* ==================================
           INITIAL URL FILTERS
        =================================== */

        function selectOption(element, value) {

            const option = [
                ...element.options
            ].find(item =>
                normalize(item.value) === normalize(value)
            );

            if (option) {
                element.value = option.value;
            }
        }

        function loadUrlFilters() {

            const params = new URLSearchParams(
                window.location.search
            );

            search.value = params.get("q") || "";

            selectOption(
                store,
                params.get("store") || ""
            );

            selectOption(
                category,
                params.get("category") || ""
            );

            selectOption(
                sort,
                params.get("sort") || "featured"
            );

            state.query = search.value.trim();
            state.store = store.value;
            state.category = category.value;
            state.sort = sort.value;
            state.page = 1;

            if (heroInput) {
                heroInput.value = search.value;
            }

            render();
        }

        window.addEventListener(
            "popstate",
            loadUrlFilters
        );

        /* ==================================
           HOT RIGHT NOW SLIDER
        =================================== */

        function updateSliderButtons() {

            if (!hotTrack) return;

            const maxScroll =
                hotTrack.scrollWidth -
                hotTrack.clientWidth;

            if (hotPrev) {
                hotPrev.disabled =
                    hotTrack.scrollLeft <= 2;
            }

            if (hotNext) {
                hotNext.disabled =
                    hotTrack.scrollLeft >= maxScroll - 2;
            }
        }

        function moveSlider(direction) {

            if (!hotTrack) return;

            const card = hotTrack.querySelector(
                ".dl-hot-card"
            );

            if (!card) return;

            const gap = parseFloat(
                getComputedStyle(hotTrack).gap
            ) || 18;

            const distance =
                card.getBoundingClientRect().width + gap;

            hotTrack.scrollBy({
                left: distance * direction,
                behavior: reduceMotion.matches
                    ? "instant"
                    : "smooth"
            });
        }

        hotPrev?.addEventListener(
            "click",
            () => moveSlider(-1)
        );

        hotNext?.addEventListener(
            "click",
            () => moveSlider(1)
        );

        hotTrack?.addEventListener(
            "scroll",
            updateSliderButtons,
            { passive: true }
        );

        window.addEventListener(
            "resize",
            updateSliderButtons
        );

        /* ==================================
           INITIALIZE
        =================================== */

        loadUrlFilters();
        updateSliderButtons();

        console.info(
            "CouponFlicker Deals ready:",
            cards.length,
            "products"
        );
    }

    if (document.readyState === "loading") {
        document.addEventListener(
            "DOMContentLoaded",
            initDealsPage,
            { once: true }
        );
    } else {
        initDealsPage();
    }

})();
