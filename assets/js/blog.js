
/* =====================================================
   COUPONFLICKER - BLOG PAGE JAVASCRIPT
   Search, Category Filters, Pagination, Copy Link
===================================================== */

(() => {
    "use strict";

    function initializeBlog() {

        const page = document.getElementById("blPage");
        if (!page || page.dataset.ready === "1") return;

        page.dataset.ready = "1";

        /* Article detail sharing */

        const copyLink = document.getElementById("blCopyLink");

        copyLink?.addEventListener("click", async () => {
            const label = copyLink.querySelector("span");

            try {
                await navigator.clipboard.writeText(
                    window.location.href
                );

                if (label) label.textContent = "Copied!";
            } catch (error) {
                if (label) label.textContent = "Copy unavailable";
            }
        });

        /* Listing elements */

        const grid = document.getElementById("blGrid");
        if (!grid) return;

        const search = document.getElementById("blSearch");
        const category = document.getElementById("blCategory");
        const reset = document.getElementById("blReset");
        const emptyReset = document.getElementById("blEmptyReset");
        const empty = document.getElementById("blEmpty");
        const count = document.getElementById("blResultCount");
        const pagination = document.getElementById("blPagination");

        const chips = [
            ...document.querySelectorAll(
                "#blTopics .bl-topic"
            )
        ];

        if (!search || !category || !pagination) return;

        const cards = [
            ...grid.querySelectorAll(".bl-article-card")
        ];

        const originalOrder = new Map(
            cards.map((card, index) => [card, index])
        );

        const state = {
            query: "",
            category: "",
            page: 1,
            perPage: 6
        };

        const normalize = value =>
            String(value ?? "")
                .trim()
                .toLocaleLowerCase();

        function getMatches() {
            return cards.filter(card => {
                const searchable = normalize(
                    card.dataset.search || card.textContent
                );

                const cardCategory = normalize(
                    card.dataset.category
                );

                return (
                    (!state.query ||
                        searchable.includes(normalize(state.query))) &&
                    (!state.category ||
                        cardCategory === normalize(state.category))
                );
            }).sort((a, b) =>
                originalOrder.get(a) - originalOrder.get(b)
            );
        }

        function updateChips() {
            chips.forEach(chip => {
                const active =
                    normalize(chip.dataset.category || "") ===
                    normalize(state.category);

                chip.classList.toggle("active", active);
                chip.setAttribute("aria-pressed", String(active));
            });
        }

        function createPagination(totalPages) {
            pagination.replaceChildren();

            if (totalPages <= 1) return;

            function addButton(text, pageNumber, disabled = false) {
                const button = document.createElement("button");

                button.type = "button";
                button.textContent = text;
                button.dataset.page = String(pageNumber);
                button.disabled = disabled;

                if (pageNumber === state.page && !disabled) {
                    button.classList.add("active");
                    button.setAttribute("aria-current", "page");
                }

                pagination.appendChild(button);
            }

            addButton("‹", state.page - 1, state.page === 1);

            for (let p = 1; p <= totalPages; p++) {
                addButton(String(p), p);
            }

            addButton("›", state.page + 1, state.page === totalPages);
        }

        function render() {
            const matches = getMatches();
            const total = matches.length;
            const totalPages = Math.ceil(total / state.perPage);

            state.page = Math.max(
                1,
                Math.min(state.page, totalPages || 1)
            );

            const start = (state.page - 1) * state.perPage;
            const visible = matches.slice(
                start,
                start + state.perPage
            );

            const shown = new Set(visible);

            cards.forEach(card => {
                const isVisible = shown.has(card);
                card.hidden = !isVisible;

                if (isVisible) {
                    card.style.removeProperty("display");
                } else {
                    card.style.setProperty(
                        "display",
                        "none",
                        "important"
                    );
                }
            });

            visible.forEach(card => {
                grid.appendChild(card);
            });

            if (count) {
                count.textContent =
                    `${total} ${total === 1 ? "Article" : "Articles"}`;
            }

            if (empty) {
                empty.hidden = total > 0;
            }

            updateChips();
            createPagination(totalPages);
        }

        function updateUrl() {
            const url = new URL(window.location.href);

            if (state.query) {
                url.searchParams.set("q", state.query);
            } else {
                url.searchParams.delete("q");
            }

            if (state.category) {
                url.searchParams.set("category", state.category);
            } else {
                url.searchParams.delete("category");
            }

            history.replaceState(
                null,
                "",
                url.pathname + url.search + url.hash
            );
        }

        function applyFilters() {
            state.query = search.value.trim();
            state.category = category.value;
            state.page = 1;

            render();
            updateUrl();
        }

        search.addEventListener("input", applyFilters);
        category.addEventListener("change", applyFilters);

        chips.forEach(chip => {
            chip.addEventListener("click", () => {
                category.value = chip.dataset.category || "";
                applyFilters();
            });
        });

        function resetFilters() {
            search.value = "";
            category.value = "";
            applyFilters();
        }

        reset?.addEventListener("click", resetFilters);
        emptyReset?.addEventListener("click", resetFilters);

        pagination.addEventListener("click", event => {
            const button = event.target.closest(
                "button[data-page]"
            );

            if (!button || button.disabled) return;

            const target = Number(button.dataset.page);
            const totalPages = Math.ceil(
                getMatches().length / state.perPage
            );

            if (
                !Number.isInteger(target) ||
                target < 1 ||
                target > totalPages
            ) return;

            state.page = target;
            render();

            document.getElementById("blLatest")
                ?.scrollIntoView({
                    behavior: window.matchMedia(
                        "(prefers-reduced-motion: reduce)"
                    ).matches ? "auto" : "smooth",
                    block: "start"
                });
        });

        function loadUrlFilters() {
            const params = new URLSearchParams(location.search);

            search.value = params.get("q") || "";

            const wanted = normalize(
                params.get("category") || ""
            );

            const matched = [...category.options].find(
                option => normalize(option.value) === wanted
            );

            category.value = matched ? matched.value : "";

            state.query = search.value.trim();
            state.category = category.value;
            state.page = 1;

            render();
        }

        window.addEventListener("popstate", loadUrlFilters);

        loadUrlFilters();

        console.info(
            "CouponFlicker Blog ready:",
            cards.length,
            "articles"
        );
    }

    if (document.readyState === "loading") {
        document.addEventListener(
            "DOMContentLoaded",
            initializeBlog,
            { once: true }
        );
    } else {
        initializeBlog();
    }
})();
