
/* ======================================================
   COUPONFLICKER - LATEST COUPONS & CODES

   Compatible with existing coupon.php

   Features:
   - Category filtering
   - Store filtering
   - Sorting
   - Pagination
   - Reset filters
   - URL store filtering
   - Reveal popup copy functionality

====================================================== */

(() => {
    "use strict";

    function initCouponPage() {

        /* ==========================================
           ELEMENTS
        ========================================== */

        const page = document.getElementById("ccCouponPage");

        if (!page) {
            initRevealPage();
            return;
        }

        if (page.dataset.jsInitialized === "true") {
            return;
        }

        const grid = document.getElementById("ccCouponGrid");

        const categoryButtons = [
            ...document.querySelectorAll(
                "#ccCategoryNav .cc-category-btn"
            )
        ];

        const storeSelect = document.getElementById(
            "ccStoreSelect"
        );

        const sortSelect = document.getElementById(
            "ccSortSelect"
        );

        const resetButton = document.getElementById(
            "ccResetFilters"
        );

        const emptyReset = document.getElementById(
            "ccEmptyReset"
        );

        const empty = document.getElementById(
            "ccEmpty"
        );

        const resultCount = document.getElementById(
            "ccResultCount"
        );

        const pagination = document.getElementById(
            "ccPagination"
        );

        if (!grid || !storeSelect || !sortSelect) {
            return;
        }

        page.dataset.jsInitialized = "true";

        /* ==========================================
           ALL COUPON CARDS
        ========================================== */

        const cards = [
            ...grid.querySelectorAll(".cc-coupon-card")
        ];

        const originalOrder = new Map();

        cards.forEach((card, index) => {
            originalOrder.set(card, index);
        });

        /* ==========================================
           STATE
        ========================================== */

        const state = {
            category: "All",
            store: "all",
            sort: "featured",
            page: 1,
            perPage: 6
        };

        function normalize(value) {
            return String(value ?? "")
                .trim()
                .toLocaleLowerCase();
        }

        function getFilteredCards() {

            return cards.filter(card => {

                const cardCategory = normalize(
                    card.dataset.category
                );

                const cardStore = normalize(
                    card.dataset.store
                );

                const categoryMatch =
                    state.category === "All" ||
                    cardCategory === normalize(state.category);

                const storeMatch =
                    normalize(state.store) === "all" ||
                    cardStore === normalize(state.store);

                return categoryMatch && storeMatch;

            });
        }

        /* ==========================================
           SORT FUNCTIONALITY
        ========================================== */

        function sortCards(filteredCards) {

            return [...filteredCards].sort((a, b) => {

                const storeA = String(
                    a.dataset.store || ""
                );

                const storeB = String(
                    b.dataset.store || ""
                );

                if (state.sort === "az") {

                    return (
                        storeA.localeCompare(storeB) ||
                        originalOrder.get(a) -
                        originalOrder.get(b)
                    );

                }

                if (state.sort === "za") {

                    return (
                        storeB.localeCompare(storeA) ||
                        originalOrder.get(a) -
                        originalOrder.get(b)
                    );

                }

                /* Featured first */

                const featuredA =
                    a.dataset.featured === "1" ? 1 : 0;

                const featuredB =
                    b.dataset.featured === "1" ? 1 : 0;

                return (
                    featuredB - featuredA ||
                    originalOrder.get(a) -
                    originalOrder.get(b)
                );

            });

        }

        /* ==========================================
           CATEGORY BUTTON ACTIVE STATE
        ========================================== */

        function updateCategoryButtons() {

            categoryButtons.forEach(button => {

                const category =
                    button.dataset.category || "All";

                const active =
                    normalize(category) ===
                    normalize(state.category);

                button.classList.toggle(
                    "active",
                    active
                );

                button.classList.toggle(
                    "is-active",
                    active
                );

                button.setAttribute(
                    "aria-pressed",
                    String(active)
                );

            });

        }

        /* ==========================================
           PAGINATION
        ========================================== */

        function renderPagination(totalPages) {

            if (!pagination) {
                return;
            }

            pagination.innerHTML = "";

            if (totalPages <= 1) {
                return;
            }

            function createButton(
                label,
                targetPage,
                disabled = false,
                active = false,
                ariaLabel = ""
            ) {

                const button = document.createElement(
                    "button"
                );

                button.type = "button";

                button.className = "cc-page-btn";

                button.textContent = label;

                button.dataset.page = String(
                    targetPage
                );

                button.disabled = disabled;

                if (active) {
                    button.classList.add("active");
                    button.classList.add("is-active");

                    button.setAttribute(
                        "aria-current",
                        "page"
                    );
                }

                if (ariaLabel) {
                    button.setAttribute(
                        "aria-label",
                        ariaLabel
                    );
                }

                pagination.appendChild(button);

            }

            /* Previous */

            createButton(
                "‹",
                state.page - 1,
                state.page === 1,
                false,
                "Previous page"
            );

            /* Page numbers */

            for (
                let i = 1;
                i <= totalPages;
                i++
            ) {

                createButton(
                    String(i),
                    i,
                    false,
                    i === state.page,
                    `Page ${i}`
                );

            }

            /* Next */

            createButton(
                "›",
                state.page + 1,
                state.page === totalPages,
                false,
                "Next page"
            );

        }

        /* ==========================================
           RENDER COUPON CARDS
        ========================================== */

        function render() {

            const filtered = getFilteredCards();

            const sorted = sortCards(filtered);

            const totalResults = sorted.length;

            const totalPages = Math.ceil(
                totalResults / state.perPage
            );

            state.page = Math.max(
                1,
                Math.min(
                    state.page,
                    totalPages || 1
                )
            );

            const start =
                (state.page - 1) * state.perPage;

            const visibleCards = sorted.slice(
                start,
                start + state.perPage
            );

            /*
             * Hide all cards first.
             * Then put visible cards back
             * in the correct sorted order.
             */

            cards.forEach(card => {
                card.hidden = true;
                card.style.display = "none";
            });

            visibleCards.forEach(card => {

                grid.appendChild(card);

                card.hidden = false;
                card.style.removeProperty("display");

            });

            /* Result count */

            if (resultCount) {

                if (totalResults === 0) {
                    resultCount.textContent =
                        "0 Coupons Found";
                } else {

                    resultCount.textContent =
                        `${totalResults} ${
                            totalResults === 1
                                ? "Coupon"
                                : "Coupons"
                        }`;

                }

            }

            /* Empty state */

            if (empty) {

                empty.hidden = totalResults !== 0;

            }

            /* Pagination */

            renderPagination(totalPages);

            /* Category active */

            updateCategoryButtons();

        }

        /* ==========================================
           CATEGORY EVENTS
        ========================================== */

        categoryButtons.forEach(button => {

            button.addEventListener(
                "click",
                () => {

                    state.category =
                        button.dataset.category || "All";

                    state.page = 1;

                    render();

                }
            );

        });

        /* ==========================================
           STORE FILTER
        ========================================== */

        storeSelect.addEventListener(
            "change",
            () => {

                state.store = storeSelect.value;

                state.page = 1;

                render();

                updateStoreUrl();

            }
        );

        /* ==========================================
           SORT FILTER
        ========================================== */

        sortSelect.addEventListener(
            "change",
            () => {

                state.sort = sortSelect.value;

                state.page = 1;

                render();

            }
        );

        /* ==========================================
           RESET FILTERS
        ========================================== */

        function resetFilters() {

            state.category = "All";
            state.store = "all";
            state.sort = "featured";
            state.page = 1;

            storeSelect.value = "all";
            sortSelect.value = "featured";

            render();

            updateStoreUrl();

        }

        resetButton?.addEventListener(
            "click",
            resetFilters
        );

        emptyReset?.addEventListener(
            "click",
            resetFilters
        );

        /* ==========================================
           PAGINATION CLICKS
        ========================================== */

        pagination?.addEventListener(
            "click",
            event => {

                const button = event.target.closest(
                    "button[data-page]"
                );

                if (!button || button.disabled) {
                    return;
                }

                const pageNumber = Number(
                    button.dataset.page
                );

                const totalPages = Math.ceil(
                    getFilteredCards().length /
                    state.perPage
                );

                if (
                    !Number.isInteger(pageNumber) ||
                    pageNumber < 1 ||
                    pageNumber > totalPages
                ) {
                    return;
                }

                state.page = pageNumber;

                render();

                document.getElementById("ccLatest")
                    ?.scrollIntoView({
                        behavior: window.matchMedia(
                            "(prefers-reduced-motion: reduce)"
                        ).matches
                            ? "auto"
                            : "smooth",
                        block: "start"
                    });

            }
        );

        /* ==========================================
           URL STORE FILTER
        ========================================== */

        function updateStoreUrl() {

            const url = new URL(
                window.location.href
            );

            if (
                normalize(state.store) !== "all"
            ) {

                url.searchParams.set(
                    "store",
                    state.store
                );

            } else {

                url.searchParams.delete("store");

            }

            window.history.replaceState(
                null,
                "",
                url.pathname +
                url.search +
                url.hash
            );

        }

        function applyInitialStore() {

            const params = new URLSearchParams(
                window.location.search
            );

            const requestedStore =
                params.get("store") ||
                page.dataset.initialStore ||
                "all";

            const matchingOption = [
                ...storeSelect.options
            ].find(option => {

                return normalize(option.value) ===
                    normalize(requestedStore);

            });

            if (matchingOption) {

                state.store = matchingOption.value;

                storeSelect.value =
                    matchingOption.value;

            }

        }

        /* Initial state */

        applyInitialStore();
        render();

    }

    /* ==================================================
       REVEAL CODE PAGE

       coupon.php?reveal=1
    ================================================== */

    function initRevealPage() {

        const page = document.getElementById(
            "ccRevealPage"
        );

        if (!page) return;

        if (page.dataset.jsInitialized === "true") {
            return;
        }

        page.dataset.jsInitialized = "true";

        const overlay = document.getElementById(
            "ccRevealOverlay"
        );

        const closeButton = document.getElementById(
            "ccRevealClose"
        );

        const copyButton = document.getElementById(
            "ccCopyCode"
        );

        const codeElement = document.getElementById(
            "ccCodeValue"
        );

        /* ======================================
           COPY CODE
        ====================================== */

        async function copyCode() {

            if (!codeElement || !copyButton) {
                return;
            }

            const code = codeElement.textContent.trim();

            if (!code) return;

            let copied = false;

            try {

                if (navigator.clipboard?.writeText) {

                    await navigator.clipboard.writeText(
                        code
                    );

                    copied = true;
                }

            } catch (error) {
                copied = false;
            }

            /* Fallback for localhost / older browsers */

            if (!copied) {

                const textarea = document.createElement(
                    "textarea"
                );

                textarea.value = code;

                textarea.style.position = "fixed";
                textarea.style.opacity = "0";

                document.body.appendChild(textarea);

                textarea.select();

                try {

                    copied = document.execCommand(
                        "copy"
                    );

                } catch (error) {
                    copied = false;
                }

                textarea.remove();

            }

            const label = copyButton.querySelector(
                "span"
            );

            if (copied) {

                if (label) {
                    label.textContent = "Copied!";
                } else {
                    copyButton.textContent = "Copied!";
                }

                copyButton.classList.add(
                    "copied"
                );

            } else {

                if (label) {
                    label.textContent = "Select & Copy";
                }

                /* Select code manually */

                const selection =
                    window.getSelection();

                const range =
                    document.createRange();

                range.selectNodeContents(
                    codeElement
                );

                selection.removeAllRanges();
                selection.addRange(range);

            }

        }

        copyButton?.addEventListener(
            "click",
            copyCode
        );

        /* ======================================
           CLOSE REVEAL POPUP
        ====================================== */

        function closeReveal() {

            /*
             * This page opens in a new tab.
             * Try closing it. If blocked by browser,
             * navigate back to coupon directory.
             */

            window.close();

            window.location.href = "coupon.php";

        }

        closeButton?.addEventListener(
            "click",
            closeReveal
        );

        /* Escape key */

        document.addEventListener(
            "keydown",
            event => {

                if (event.key === "Escape") {
                    closeReveal();
                }

            }
        );

        /* Optional outside click */

        overlay?.addEventListener(
            "click",
            event => {

                if (event.target === overlay) {
                    closeReveal();
                }

            }
        );

    }

    /* ==========================================
       INITIALIZE
    ========================================== */

    function initialize() {

        initCouponPage();
        initRevealPage();

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


/* ============================================
   COUPONFLICKER - ADVERTISE FORM
============================================ */

(() => {
    "use strict";

    function initAdvertise() {
        const form = document.getElementById("advFormElement");

        if (!form || form.dataset.ready === "1") return;
        form.dataset.ready = "1";

        const start = document.getElementById("advStart");
        const end = document.getElementById("advEnd");
        const submit = document.getElementById("advSubmit");

        const requiredFields = [
            ...form.querySelectorAll("[required]")
        ];

        function validate(field) {
            let valid = field.checkValidity();

            if (field.id === "advDetails") {
                valid = valid && field.value.trim().length >= 20;
            }

            if (field === end && start.value && end.value) {
                valid = valid && end.value >= start.value;
            }

            field.classList.toggle("adv-invalid", !valid);
            field.setAttribute("aria-invalid", String(!valid));

            return valid;
        }

        requiredFields.forEach(field => {
            field.addEventListener("input", () => {
                if (field.classList.contains("adv-invalid")) {
                    validate(field);
                }
            });

            field.addEventListener("change", () => {
                validate(field);
            });
        });

        start.addEventListener("change", () => {
            end.min = start.value || "";

            if (end.value && end.value < start.value) {
                end.value = "";
            }
        });

        form.addEventListener("submit", event => {
            let firstInvalid = null;

            requiredFields.forEach(field => {
                if (!validate(field) && !firstInvalid) {
                    firstInvalid = field;
                }
            });

            const phone = document.getElementById("advPhone");

            if (
                phone.value.trim() &&
                !/^[+0-9()\s.-]{7,25}$/.test(phone.value.trim())
            ) {
                phone.classList.add("adv-invalid");
                firstInvalid ||= phone;
            }

            if (firstInvalid) {
                event.preventDefault();
                firstInvalid.focus();
                return;
            }

            submit.disabled = true;

            const label = submit.querySelector("span");
            if (label) label.textContent = "Submitting...";
        });

        form.addEventListener("reset", () => {
            requestAnimationFrame(() => {
                form.querySelectorAll(".adv-invalid").forEach(field => {
                    field.classList.remove("adv-invalid");
                    field.removeAttribute("aria-invalid");
                });

                end.min = "";
            });
        });

        if (start.value) {
            end.min = start.value;
        }

        console.info("CouponFlicker Advertise form initialized");
    }

    if (document.readyState === "loading") {
        document.addEventListener(
            "DOMContentLoaded",
            initAdvertise,
            { once: true }
        );
    } else {
        initAdvertise();
    }
})();


/* ====================================
   COUPONFLICKER CONTACT PAGE JS
==================================== */

(function () {
    "use strict";

    function initContactPage() {

        const page = document.querySelector(".cf-contact-v2");

        if (!page) return;

        const form = document.getElementById("cfv2ContactForm");
        const subject = document.getElementById("cfv2Subject");
        const fileInput = document.getElementById("cfv2File");
        const fileName = document.getElementById("cfv2FileName");
        const notice = document.getElementById("cfv2FormNotice");

        const categoryButtons = page.querySelectorAll(
            ".cfv2-category-card"
        );

        // CATEGORY SELECTION
        categoryButtons.forEach(function (button) {
            button.addEventListener("click", function () {

                const selected = button.dataset.category;

                if (subject) {
                    subject.value = selected;
                }

                categoryButtons.forEach(function (item) {
                    item.classList.remove("cfv2-active");
                    item.setAttribute("aria-pressed", "false");
                });

                button.classList.add("cfv2-active");
                button.setAttribute("aria-pressed", "true");

                if (form) {
                    form.scrollIntoView({
                        behavior: "smooth",
                        block: "center"
                    });
                }
            });
        });

        // FILE UPLOAD LABEL
        if (fileInput && fileName) {
            fileInput.addEventListener("change", function () {
                const file = fileInput.files[0];

                fileName.textContent = file
                    ? file.name
                    : "Attach File (Optional)";
            });
        }

        // FORM VALIDATION
        if (form && notice) {
            form.addEventListener("submit", function (event) {
                event.preventDefault();

                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                const name = document.getElementById("cfv2Name");
                const message = document.getElementById("cfv2Message");

                if (name.value.trim().length < 2) {
                    notice.textContent =
                        "Please enter a valid name.";
                    name.focus();
                    return;
                }

                if (message.value.trim().length < 10) {
                    notice.textContent =
                        "Please enter at least 10 characters.";
                    message.focus();
                    return;
                }

                if (fileInput.files.length) {
                    const file = fileInput.files[0];
                    const allowedExtensions = [
                        "pdf", "jpg", "jpeg", "png", "doc", "docx"
                    ];

                    const extension = file.name
                        .split(".")
                        .pop()
                        .toLowerCase();

                    if (!allowedExtensions.includes(extension)) {
                        notice.textContent =
                            "Please choose a PDF, image or Word document.";
                        return;
                    }

                    if (file.size > 5 * 1024 * 1024) {
                        notice.textContent =
                            "File size must not exceed 5 MB.";
                        return;
                    }
                }

                notice.textContent =
                    "Your form is valid. Message sending will work once the PHP backend is connected.";
            });
        }
    }

    if (document.readyState === "loading") {
        document.addEventListener(
            "DOMContentLoaded",
            initContactPage
        );
    } else {
        initContactPage();
    }
})();


/* ==========================================
   PRIVACY POLICY SIDEBAR NAVIGATION
========================================== */

(function () {
    "use strict";

    const page = document.querySelector(".cf-policy-page");

    if (!page) return;

    const links = Array.from(
        page.querySelectorAll(".cf-policy-nav a")
    );

    const sections = Array.from(
        page.querySelectorAll(".cf-policy-section[id]")
    );

    if (!links.length || !sections.length) return;

    function updateActive(id) {
        links.forEach((link) => {
            const active = link.getAttribute("href") === "#" + id;

            link.classList.toggle("active", active);

            if (active) {
                link.setAttribute("aria-current", "location");
            } else {
                link.removeAttribute("aria-current");
            }
        });
    }

    links.forEach((link) => {
        link.addEventListener("click", function (event) {
            const hash = this.getAttribute("href");
            const target = document.getElementById(hash.slice(1));

            if (!target) return;

            event.preventDefault();

            target.scrollIntoView({
                behavior: window.matchMedia(
                    "(prefers-reduced-motion: reduce)"
                ).matches ? "auto" : "smooth",
                block: "start"
            });

            updateActive(target.id);
        });
    });

    if ("IntersectionObserver" in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                const visible = entries
                    .filter((entry) => entry.isIntersecting)
                    .sort(
                        (a, b) =>
                            a.boundingClientRect.top -
                            b.boundingClientRect.top
                    );

                if (visible.length) {
                    updateActive(visible[0].target.id);
                }
            },
            {
                rootMargin: "-100px 0px -55% 0px",
                threshold: 0
            }
        );

        sections.forEach((section) => observer.observe(section));
    }
})();


/* ==========================================
   TERMS & CONDITIONS - ACTIVE NAVIGATION
========================================== */

(function () {
    "use strict";

    const termsPage = document.querySelector(".cf-terms-page");

    if (!termsPage) return;

    const navLinks = Array.from(
        termsPage.querySelectorAll(".cf-terms-nav a")
    );

    const sections = Array.from(
        termsPage.querySelectorAll(".cf-terms-section[id]")
    );

    if (!navLinks.length || !sections.length) return;

    function setActiveSection(id) {
        navLinks.forEach((link) => {
            const isActive =
                link.getAttribute("href") === "#" + id;

            link.classList.toggle("active", isActive);

            if (isActive) {
                link.setAttribute("aria-current", "location");
            } else {
                link.removeAttribute("aria-current");
            }
        });
    }

    navLinks.forEach((link) => {
        link.addEventListener("click", function (event) {
            const targetId = this.getAttribute("href").slice(1);
            const target = document.getElementById(targetId);

            if (!target) return;

            event.preventDefault();

            target.scrollIntoView({
                behavior: window.matchMedia(
                    "(prefers-reduced-motion: reduce)"
                ).matches ? "auto" : "smooth",
                block: "start"
            });

            setActiveSection(targetId);
        });
    });

    if ("IntersectionObserver" in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                const visible = entries
                    .filter((entry) => entry.isIntersecting)
                    .sort(
                        (a, b) =>
                            a.boundingClientRect.top -
                            b.boundingClientRect.top
                    );

                if (visible.length) {
                    setActiveSection(visible[0].target.id);
                }
            },
            {
                rootMargin: "-110px 0px -55% 0px",
                threshold: 0
            }
        );

        sections.forEach((section) => observer.observe(section));
    }
})();

/* ============================================
   COUPONFLICKER FAQ - ACCORDION + SEARCH
============================================ */

(function () {
    "use strict";

    function initCouponFlickerFAQ() {

        const page = document.querySelector(".cf-faq-page");
        if (!page) return;

        const search = page.querySelector("#cfFaqSearch");
        const clearButton = page.querySelector("#cfFaqSearchClear");
        const status = page.querySelector("#cfFaqSearchStatus");
        const empty = page.querySelector("#cfFaqEmpty");

        const groups = Array.from(
            page.querySelectorAll(".cf-faq-group")
        );

        const questions = Array.from(
            page.querySelectorAll(".cf-faq-question")
        );

        const navLinks = Array.from(
            page.querySelectorAll(".cf-faq-topic-nav a")
        );

        /* ACCORDION */

        questions.forEach(button => {

            button.addEventListener("click", function () {

                const expanded =
                    this.getAttribute("aria-expanded") === "true";

                questions.forEach(other => {
                    other.setAttribute("aria-expanded", "false");

                    const otherAnswer = document.getElementById(
                        other.getAttribute("aria-controls")
                    );

                    if (otherAnswer) {
                        otherAnswer.hidden = true;
                    }

                    const otherIcon =
                        other.querySelector(".cf-faq-toggle i");

                    if (otherIcon) {
                        otherIcon.className = "bi bi-plus-lg";
                    }
                });

                if (!expanded) {

                    this.setAttribute("aria-expanded", "true");

                    const answer = document.getElementById(
                        this.getAttribute("aria-controls")
                    );

                    if (answer) {
                        answer.hidden = false;
                    }

                    const icon =
                        this.querySelector(".cf-faq-toggle i");

                    if (icon) {
                        icon.className = "bi bi-dash-lg";
                    }
                }
            });
        });

        /* SEARCH */

        function filterQuestions() {

            const term = search.value.trim().toLowerCase();

            let visibleCount = 0;

            groups.forEach(group => {

                let groupVisible = 0;

                const items = group.querySelectorAll(".cf-faq-item");

                items.forEach(item => {

                    const content = item.textContent.toLowerCase();
                    const matches = content.includes(term);

                    item.hidden = !matches;

                    if (matches) {
                        groupVisible++;
                        visibleCount++;
                    }
                });

                group.hidden = groupVisible === 0;
            });

            clearButton.hidden = term.length === 0;

            status.textContent = term
                ? `${visibleCount} matching question${visibleCount === 1 ? "" : "s"} found`
                : "";

            empty.hidden = visibleCount !== 0;
        }

        if (search) {
            search.addEventListener("input", filterQuestions);
        }

        if (clearButton) {
            clearButton.addEventListener("click", function () {
                search.value = "";
                filterQuestions();
                search.focus();
            });
        }

        /* SIDEBAR NAVIGATION */

        navLinks.forEach(link => {

            link.addEventListener("click", function (event) {

                const id = this.getAttribute("href").slice(1);
                const target = document.getElementById(id);

                if (!target || target.hidden) return;

                event.preventDefault();

                target.scrollIntoView({
                    behavior: window.matchMedia(
                        "(prefers-reduced-motion: reduce)"
                    ).matches ? "auto" : "smooth",
                    block: "start"
                });

                navLinks.forEach(nav => {
                    nav.classList.remove("active");
                });

                this.classList.add("active");
            });
        });

        if ("IntersectionObserver" in window) {

            const observer = new IntersectionObserver(
                entries => {

                    const visible = entries
                        .filter(entry => entry.isIntersecting)
                        .sort(
                            (a, b) =>
                                a.boundingClientRect.top -
                                b.boundingClientRect.top
                        );

                    if (!visible.length) return;

                    const id = visible[0].target.id;

                    navLinks.forEach(link => {
                        link.classList.toggle(
                            "active",
                            link.getAttribute("href") === "#" + id
                        );
                    });
                },
                {
                    rootMargin: "-110px 0px -55% 0px",
                    threshold: 0
                }
            );

            groups.forEach(group => observer.observe(group));
        }
    }

    if (document.readyState === "loading") {
        document.addEventListener(
            "DOMContentLoaded",
            initCouponFlickerFAQ
        );
    } else {
        initCouponFlickerFAQ();
    }

})();

/* ============================================
   COUPONFLICKER - LOGIN FORM VALIDATION
============================================ */

(function () {
    "use strict";

    function initCouponFlickerLogin() {

        const form = document.getElementById("cfLoginForm");
        if (!form) return;

        const email = document.getElementById("cfLoginEmail");
        const password = document.getElementById("cfLoginPassword");
        const toggle = document.getElementById("cfLoginTogglePassword");
        const alertBox = document.getElementById("cfLoginAlert");

        const emailError = document.getElementById("cfLoginEmailError");
        const passwordError = document.getElementById("cfLoginPasswordError");

        function showError(input, errorElement, message) {
            errorElement.textContent = message;
            input.parentElement.classList.add("cf-login-invalid");
            input.setAttribute("aria-invalid", "true");
        }

        function clearError(input, errorElement) {
            errorElement.textContent = "";
            input.parentElement.classList.remove("cf-login-invalid");
            input.removeAttribute("aria-invalid");
        }

        /* PASSWORD VISIBILITY */

        toggle.addEventListener("click", function () {

            const isPassword = password.type === "password";

            password.type = isPassword ? "text" : "password";

            this.setAttribute(
                "aria-label",
                isPassword ? "Hide password" : "Show password"
            );

            this.setAttribute(
                "aria-pressed",
                String(isPassword)
            );

            const icon = this.querySelector("i");

            icon.className = isPassword
                ? "bi bi-eye-slash"
                : "bi bi-eye";
        });

        /* FIELD VALIDATION */

        email.addEventListener("input", function () {
            clearError(email, emailError);
        });

        password.addEventListener("input", function () {
            clearError(password, passwordError);
        });

        /* FORM SUBMIT */

        form.addEventListener("submit", function (event) {
            event.preventDefault();

            let valid = true;

            alertBox.hidden = true;
            alertBox.textContent = "";

            clearError(email, emailError);
            clearError(password, passwordError);

            email.value = email.value.trim();

            if (!email.value || !email.checkValidity()) {
                showError(
                    email,
                    emailError,
                    "Please enter a valid email address."
                );
                valid = false;
            }

            if (!password.value) {
                showError(
                    password,
                    passwordError,
                    "Please enter your password."
                );
                valid = false;
            }

            if (!valid) return;

            alertBox.textContent =
                "Form validated successfully. Account authentication will be available after backend integration.";

            alertBox.hidden = false;

            alertBox.style.background = "#F0FDF4";
            alertBox.style.borderColor = "#BBF7D0";
            alertBox.style.color = "#166534";
        });

    }

    if (document.readyState === "loading") {
        document.addEventListener(
            "DOMContentLoaded",
            initCouponFlickerLogin
        );
    } else {
        initCouponFlickerLogin();
    }

})();

