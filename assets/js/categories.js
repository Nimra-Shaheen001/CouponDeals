
/* ======================================================
   COUPONFLICKER - CATEGORIES DIRECTORY
   Live Search | A-Z Filtering | Scroll Animations
====================================================== */

(() => {
    "use strict";

    function initCategoriesDirectory() {
        const page = document.getElementById("cdirPage");

        if (!page || page.dataset.initialized === "1") {
            return;
        }

        page.dataset.initialized = "1";

        const search = document.getElementById("cdirSearch");
        const form = document.getElementById("cdirSearchForm");
        const clear = document.getElementById("cdirClear");
        const reset = document.getElementById("cdirReset");
        const emptyReset = document.getElementById("cdirEmptyReset");
        const empty = document.getElementById("cdirEmpty");
        const count = document.getElementById("cdirCount");

        const cards = [...page.querySelectorAll(".cdir-card")];
        const letterButtons = [
            ...page.querySelectorAll(".cdir-letter")
        ];

        if (!search || !form) return;

        const state = {
            query: search.value || "",
            letter: "all"
        };

        const normalize = value =>
            String(value || "")
                .trim()
                .toLocaleLowerCase();

        function matchesQuery(card) {
            const searchable = normalize(card.dataset.search);
            return !state.query ||
                searchable.includes(normalize(state.query));
        }

        function render() {
            let visible = 0;

            cards.forEach(card => {
                const nameLetter =
                    (card.dataset.letter || "").toUpperCase();

                const matchSearch = matchesQuery(card);

                const matchLetter =
                    state.letter === "all" ||
                    state.letter === nameLetter;

                const show = matchSearch && matchLetter;

                card.hidden = !show;

                if (show) {
                    visible++;

                    // Filtering should never leave cards invisible.
                    if (card.classList.contains("cdir-reveal")) {
                        card.classList.add("cdir-visible");
                    }
                }
            });

            if (count) {
                count.textContent =
                    `${visible} ${visible === 1
                        ? "category"
                        : "categories"}`;
            }

            if (empty) {
                empty.hidden = visible > 0;
            }

            if (clear) {
                clear.hidden = search.value.length === 0;
            }

            letterButtons.forEach(button => {
                const letter = button.dataset.letter;

                const active = letter === state.letter;

                button.classList.toggle("active", active);
                button.setAttribute(
                    "aria-pressed",
                    String(active)
                );

                if (letter === "all") {
                    button.disabled = false;
                    return;
                }

                button.disabled = !cards.some(card =>
                    card.dataset.letter === letter &&
                    matchesQuery(card)
                );
            });
        }

        function updateUrl() {
            const url = new URL(window.location.href);

            if (state.query.trim()) {
                url.searchParams.set("q", state.query.trim());
            } else {
                url.searchParams.delete("q");
            }

            window.history.replaceState(
                null,
                "",
                url.pathname + url.search + url.hash
            );
        }

        function clearFilters() {
            state.query = "";
            state.letter = "all";
            search.value = "";

            render();
            updateUrl();
        }

        search.addEventListener("input", () => {
            state.query = search.value;
            state.letter = "all";
            render();
            updateUrl();
        });

        form.addEventListener("submit", event => {
            event.preventDefault();

            state.query = search.value;
            state.letter = "all";

            render();
            updateUrl();

            document.getElementById("cdirDirectory")
                ?.scrollIntoView({
                    behavior: window.matchMedia(
                        "(prefers-reduced-motion: reduce)"
                    ).matches ? "auto" : "smooth",
                    block: "start"
                });
        });

        clear?.addEventListener("click", () => {
            clearFilters();
            search.focus();
        });

        reset?.addEventListener("click", clearFilters);
        emptyReset?.addEventListener("click", clearFilters);

        letterButtons.forEach(button => {
            button.addEventListener("click", () => {
                if (button.disabled) return;

                state.letter = button.dataset.letter || "all";
                render();
            });
        });

        /* Initial search from URL */

        const params = new URLSearchParams(window.location.search);
        search.value = params.get("q") || "";
        state.query = search.value;

        render();

        /* =======================================
           SCROLL REVEAL
        ======================================== */

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
                    ".cdir-hero-content",
                    ".cdir-section-heading",
                    ".cdir-card",
                    ".cdir-spotlight-card",
                    ".cdir-bottom-panel"
                ].join(",")
            )
        ];

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;

                entry.target.classList.add("cdir-visible");
                observer.unobserve(entry.target);
            });
        }, {
            threshold: 0.04,
            rootMargin: "0px 0px -20px 0px"
        });

        elements.forEach((element, index) => {
            element.classList.add("cdir-reveal");

            if (element.matches(
                ".cdir-card, .cdir-spotlight-card"
            )) {
                element.style.setProperty(
                    "--cdir-delay",
                    `${(index % 3) * 75}ms`
                );
            }

            if (!element.hidden) {
                observer.observe(element);
            }
        });

        page.classList.add("cdir-motion-ready");

        /* Keep revealed cards visible when filtering */
        const grid = document.getElementById("cdirGrid");

        if (grid) {
            const mutationObserver = new MutationObserver(mutations => {
                for (const mutation of mutations) {
                    if (
                        mutation.attributeName !== "hidden" ||
                        mutation.target.hidden
                    ) {
                        continue;
                    }

                    const card = mutation.target;

                    if (!card.matches(".cdir-card")) continue;

                    card.classList.add("cdir-visible");
                }
            });

           mutationObserver.observe(grid, {
    attributes: true,
    attributeFilter: ["hidden"],
    subtree: true
});
        }
    }

    if (document.readyState === "loading") {
        document.addEventListener(
            "DOMContentLoaded",
            initCategoriesDirectory,
            { once: true }
        );
    } else {
        initCategoriesDirectory();
    }
})();
