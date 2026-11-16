
/* =====================================================
   COUPONFLICKER - PRODUCTS PAGE FUNCTIONALITY
===================================================== */

(() => {
    "use strict";

    function initProducts() {
        const page = document.getElementById("prdPage");

        if (!page || page.dataset.ready === "1") return;

        const grid = document.getElementById("prdGrid");
        const search = document.getElementById("prdSearch");
        const store = document.getElementById("prdStore");
        const sort = document.getElementById("prdSort");
        const maxPrice = document.getElementById("prdMaxPrice");
        const maxPriceValue = document.getElementById("prdMaxPriceValue");
        const discountOnly = document.getElementById("prdDiscountOnly");
        const resultCount = document.getElementById("prdResultCount");
        const showing = document.getElementById("prdShowingText");
        const empty = document.getElementById("prdEmpty");
        const pagination = document.getElementById("prdPagination");
        const reset = document.getElementById("prdSidebarReset");
        const emptyReset = document.getElementById("prdEmptyReset");
        const catalog = document.getElementById("prdCatalog");

        const sidebar = document.getElementById("prdSidebar");
        const mobileButton = document.getElementById("prdMobileFilters");
        const backdrop = document.getElementById("prdMobileBackdrop");

        const categoryButtons = [
            ...document.querySelectorAll(
                "#prdCategoryOptions .prd-category-btn"
            )
        ];

        if (!grid || !search || !store || !sort ||
            !maxPrice || !discountOnly || !pagination) {
            console.error("Products: missing required elements");
            return;
        }

        page.dataset.ready = "1";

        const cards = [...grid.querySelectorAll(".prd-card")];

        const originalOrder = new Map(
            cards.map((card, index) => [card, index])
        );

        const state = {
            query: "",
            store: "",
            category: "",
            sort: "featured",
            maxPrice: Number(maxPrice.max) || 750,
            discountOnly: false,
            page: 1,
            perPage: 9
        };

        const normalize = value =>
            String(value ?? "").trim().toLocaleLowerCase();

        const reducedMotion = window.matchMedia(
            "(prefers-reduced-motion: reduce)"
        );

        /* ===============================
           FILTER
        =============================== */

        function getFiltered() {
            return cards.filter(card => {
                const name = normalize(card.dataset.name);
                const cardStore = normalize(card.dataset.store);
                const cardCategory = normalize(card.dataset.category);
                const price = Number(card.dataset.price) || 0;
                const discount = Number(card.dataset.discount) || 0;

                const text = [
                    name,
                    cardStore,
                    cardCategory
                ].join(" ");

                return (
                    (!state.query ||
                        text.includes(normalize(state.query))) &&
                    (!state.store ||
                        cardStore === normalize(state.store)) &&
                    (!state.category ||
                        cardCategory === normalize(state.category)) &&
                    price <= state.maxPrice &&
                    (!state.discountOnly || discount > 0)
                );
            });
        }

        /* ===============================
           SORT
        =============================== */

        function getSorted(items) {
            return [...items].sort((a, b) => {
                const priceA = Number(a.dataset.price) || 0;
                const priceB = Number(b.dataset.price) || 0;
                const discountA = Number(a.dataset.discount) || 0;
                const discountB = Number(b.dataset.discount) || 0;

                let result = 0;

                switch (state.sort) {
                    case "low":
                        result = priceA - priceB;
                        break;

                    case "high":
                        result = priceB - priceA;
                        break;

                    case "discount":
                        result = discountB - discountA;
                        break;

                    case "az":
                        result = String(a.dataset.name || "")
                            .localeCompare(String(b.dataset.name || ""));
                        break;

                    default:
                        result =
                            Number(b.dataset.featured === "1") -
                            Number(a.dataset.featured === "1");
                }

                return result ||
                    originalOrder.get(a) - originalOrder.get(b);
            });
        }

        /* ===============================
           CATEGORY ACTIVE STATE
        =============================== */

        function updateCategories() {
            categoryButtons.forEach(button => {
                const active =
                    normalize(button.dataset.category) ===
                    normalize(state.category);

                button.classList.toggle("active", active);
                button.setAttribute(
                    "aria-pressed",
                    String(active)
                );
            });
        }

        /* ===============================
           PAGINATION
        =============================== */

        function renderPagination(totalPages) {
            pagination.replaceChildren();

            if (totalPages <= 1) return;

            function addButton(label, pageNumber, disabled = false) {
                const button = document.createElement("button");

                button.type = "button";
                button.textContent = label;
                button.dataset.page = String(pageNumber);
                button.disabled = disabled;

                if (pageNumber === state.page && !disabled) {
                    button.classList.add("active");
                    button.setAttribute("aria-current", "page");
                }

                pagination.appendChild(button);
            }

            addButton("‹", state.page - 1, state.page === 1);

            for (let i = 1; i <= totalPages; i++) {
                addButton(String(i), i);
            }

            addButton("›", state.page + 1, state.page === totalPages);
        }

        /* ===============================
           RENDER
        =============================== */

        function render() {
            const results = getSorted(getFiltered());
            const total = results.length;

            const totalPages = Math.ceil(
                total / state.perPage
            );

            state.page = Math.max(
                1,
                Math.min(state.page, totalPages || 1)
            );

            const start = (state.page - 1) * state.perPage;
            const visible = results.slice(
                start,
                start + state.perPage
            );

            const visibleSet = new Set(visible);

            cards.forEach(card => {
                card.hidden = !visibleSet.has(card);
            });

            visible.forEach(card => {
                grid.appendChild(card);
            });

            if (resultCount) {
                resultCount.textContent =
                    `${total} ${total === 1 ? "Product" : "Products"}`;
            }

            if (showing) {
                showing.textContent = total
                    ? `Showing ${start + 1}–${start + visible.length} of ${total} products`
                    : "Showing 0 products";
            }

            if (empty) {
                empty.hidden = total !== 0;
            }

            if (maxPriceValue) {
                maxPriceValue.textContent =
                    "$" + Number(state.maxPrice).toLocaleString("en-US");
            }

            updateCategories();
            renderPagination(totalPages);
        }

        /* ===============================
           URL
        =============================== */

        function updateURL() {
            const url = new URL(location.href);

            const params = {
                q: state.query,
                store: state.store,
                category: state.category
            };

            Object.entries(params).forEach(([key, value]) => {
                if (value) url.searchParams.set(key, value);
                else url.searchParams.delete(key);
            });

            history.replaceState(
                null,
                "",
                url.pathname + url.search + url.hash
            );
        }

        /* ===============================
           FILTER EVENTS
        =============================== */

        function applyFilters() {
            state.query = search.value.trim();
            state.store = store.value;
            state.sort = sort.value;
            state.maxPrice = Number(maxPrice.value);
            state.discountOnly = discountOnly.checked;
            state.page = 1;

            render();
            updateURL();
        }

        search.addEventListener("input", applyFilters);
        store.addEventListener("change", applyFilters);
        sort.addEventListener("change", applyFilters);
        maxPrice.addEventListener("input", applyFilters);
        discountOnly.addEventListener("change", applyFilters);

        categoryButtons.forEach(button => {
            button.addEventListener("click", () => {
                state.category = button.dataset.category || "";
                state.page = 1;

                render();
                updateURL();

                if (window.innerWidth <= 991) {
                    closeSidebar();
                }
            });
        });

        /* ===============================
           RESET
        =============================== */

        function resetFilters() {
            search.value = "";
            store.value = "";
            sort.value = "featured";
            maxPrice.value = maxPrice.max;
            discountOnly.checked = false;
            state.category = "";

            applyFilters();
        }

        reset?.addEventListener("click", resetFilters);
        emptyReset?.addEventListener("click", resetFilters);

        /* ===============================
           PAGINATION EVENTS
        =============================== */

        pagination.addEventListener("click", event => {
            const button = event.target.closest("button[data-page]");

            if (!button || button.disabled) return;

            const requested = Number(button.dataset.page);
            const totalPages = Math.ceil(
                getFiltered().length / state.perPage
            );

            if (
                !Number.isInteger(requested) ||
                requested < 1 ||
                requested > totalPages
            ) return;

            state.page = requested;
            render();

            catalog?.scrollIntoView({
                behavior: reducedMotion.matches ? "auto" : "smooth",
                block: "start"
            });
        });

        /* ===============================
           MOBILE FILTER DRAWER
        =============================== */

        function openSidebar() {
            if (!sidebar || !backdrop) return;

            sidebar.classList.add("is-open");
            backdrop.hidden = false;

            mobileButton?.setAttribute("aria-expanded", "true");
            document.body.style.overflow = "hidden";
        }

        function closeSidebar() {
            if (!sidebar || !backdrop) return;

            sidebar.classList.remove("is-open");
            backdrop.hidden = true;

            mobileButton?.setAttribute("aria-expanded", "false");
            document.body.style.removeProperty("overflow");
        }

        mobileButton?.addEventListener("click", openSidebar);
        backdrop?.addEventListener("click", closeSidebar);

        document.addEventListener("keydown", event => {
            if (event.key === "Escape") closeSidebar();
        });

        window.addEventListener("resize", () => {
            if (window.innerWidth > 991) closeSidebar();
        });

        /* ===============================
           INITIAL URL FILTERS
        =============================== */

        const params = new URLSearchParams(location.search);

        function matchOption(select, value) {
            const wanted = normalize(value);

            const option = [...select.options].find(
                item => normalize(item.value) === wanted
            );

            if (option) select.value = option.value;
        }

        search.value = params.get("q") || "";
        matchOption(store, params.get("store") || "");

        const requestedCategory = normalize(
            params.get("category") || ""
        );

        const matchedCategory = categoryButtons.find(
            button =>
                normalize(button.dataset.category) ===
                requestedCategory
        );

        state.category = matchedCategory
            ? matchedCategory.dataset.category || ""
            : "";

        state.query = search.value.trim();
        state.store = store.value;
        state.sort = sort.value;
        state.maxPrice = Number(maxPrice.value);
        state.discountOnly = discountOnly.checked;

        render();

        console.info(
            "CouponFlicker Products initialized:",
            cards.length,
            "products"
        );
    }

    if (document.readyState === "loading") {
        document.addEventListener(
            "DOMContentLoaded",
            initProducts,
            { once: true }
        );
    } else {
        initProducts();
    }
})();
