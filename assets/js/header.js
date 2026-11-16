
document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    const $ = id => document.getElementById(id);

    const header = $("cfHeader");
    const reduceMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    );

    /* STICKY HEADER */

    const updateHeader = () => {
        header?.classList.toggle("scrolled", window.scrollY > 25);
    };

    window.addEventListener("scroll", updateHeader, { passive: true });
    updateHeader();

    /* ANNOUNCEMENT SLIDER */

    const promoSlide = $("cfAnnouncementSlide");
    const promoText = $("cfAnnouncementText");
    const promoLink = $("cfAnnouncementLink");
    const promoBar = $("cfTopbar");

    const promotions = [
        {
            text: "Discover today's exciting shopping deals",
            label: "Shop Deals",
            url: "deals.php"
        },
        {
            text: "Find offers from your favorite online stores",
            label: "Explore Stores",
            url: "stores.php"
        },
        {
            text: "Explore the latest fashion and lifestyle finds",
            label: "Discover Fashion",
            url: "deals.php?category=fashion"
        },
        {
            text: "Find exciting coupons for your next purchase",
            label: "View Coupons",
            url: "coupons.php"
        }
    ];

    let promoIndex = 0;
    let promoTimer = null;
    let promoPaused = false;

    function showPromo(index, direction = 1) {
        if (!promoSlide || !promoText || !promoLink) return;

        promoIndex = (index + promotions.length) % promotions.length;
        const item = promotions[promoIndex];

        promoText.textContent = item.text;
        promoLink.href = item.url;

        const label = promoLink.querySelector("span");
        if (label) label.textContent = item.label;

        promoSlide.classList.remove("enter-next", "enter-prev");

        if (!reduceMotion.matches) {
            void promoSlide.offsetWidth;
            promoSlide.classList.add(
                direction >= 0 ? "enter-next" : "enter-prev"
            );
        }
    }

    function stopPromo() {
        clearInterval(promoTimer);
        promoTimer = null;
    }

    function startPromo() {
        stopPromo();

        if (document.hidden || promoPaused || reduceMotion.matches) {
            return;
        }

        promoTimer = setInterval(() => {
            showPromo(promoIndex + 1, 1);
        }, 4500);
    }

   

    promoBar?.addEventListener("mouseenter", () => {
        promoPaused = true;
        stopPromo();
    });

    promoBar?.addEventListener("mouseleave", () => {
        promoPaused = false;
        startPromo();
    });

    promoBar?.addEventListener("focusin", () => {
        promoPaused = true;
        stopPromo();
    });

    promoBar?.addEventListener("focusout", event => {
        if (!promoBar.contains(event.relatedTarget)) {
            promoPaused = false;
            startPromo();
        }
    });

    document.addEventListener("visibilitychange", startPromo);
    reduceMotion.addEventListener?.("change", startPromo);

    startPromo();

    /* CATEGORIES DROPDOWN */

    const category = $("cfCategory");
    const categoryToggle = $("cfCategoryToggle");

    function closeCategory() {
        category?.classList.remove("open");
        categoryToggle?.setAttribute("aria-expanded", "false");
    }

    function openCategory() {
        closeSearch();
        closeAccount();

        category?.classList.add("open");
        categoryToggle?.setAttribute("aria-expanded", "true");
    }

    categoryToggle?.addEventListener("click", () => {
        if (category?.classList.contains("open")) {
            closeCategory();
        } else {
            openCategory();
        }
    });

    category?.addEventListener("mouseenter", () => {
        if (window.matchMedia("(hover:hover)").matches) {
            openCategory();
        }
    });

    category?.addEventListener("mouseleave", closeCategory);

    category?.addEventListener("focusout", event => {
        if (!category.contains(event.relatedTarget)) {
            closeCategory();
        }
    });

    /* ACCOUNT */

    const account = $("cfAccount");
    const accountToggle = $("cfAccountToggle");

    function closeAccount() {
        account?.classList.remove("open");
        accountToggle?.setAttribute("aria-expanded", "false");
    }

    accountToggle?.addEventListener("click", () => {
        const shouldOpen = !account?.classList.contains("open");

        closeCategory();
        closeSearch();
        closeAccount();

        if (shouldOpen) {
            account?.classList.add("open");
            accountToggle?.setAttribute("aria-expanded", "true");
        }
    });

    $("cfLoginPreview")?.addEventListener("click", () => {
        const status = $("cfAccountStatus");

        if (status) {
            status.textContent =
                "Login functionality is not connected yet.";
        }
    });

    /* CLEAN SEARCH PANEL */

    const searchToggle = $("cfSearchToggle");
    const searchPanel = $("cfSearchPanel");
    const searchClose = $("cfSearchClose");
    const searchInput = $("cfSearchInput");
    const searchForm = $("cfSearchForm");
    const suggestions = $("cfSearchSuggestions");

    function closeSuggestions() {
        suggestions?.classList.remove("show");
        suggestions?.replaceChildren();
        searchInput?.setAttribute("aria-expanded", "false");
    }

    function closeSearch() {
        if (searchPanel?.contains(document.activeElement)) {
            searchToggle?.focus();
        }

        searchPanel?.classList.remove("open");
        searchToggle?.setAttribute("aria-expanded", "false");
        closeSuggestions();
    }

    function openSearch() {
        closeCategory();
        closeAccount();

        searchPanel?.classList.add("open");
        searchToggle?.setAttribute("aria-expanded", "true");

        searchInput?.focus({ preventScroll: true });
    }

    searchToggle?.addEventListener("click", () => {
        if (searchPanel?.classList.contains("open")) {
            closeSearch();
        } else {
            openSearch();
        }
    });

    searchClose?.addEventListener("click", closeSearch);

    /* SEARCH SUGGESTIONS */

    const searchData = [
        ["Amazon", "Store", "stores.php?q=Amazon"],
        ["Nike", "Store", "stores.php?q=Nike"],
        ["Adidas", "Store", "stores.php?q=Adidas"],
        ["Sephora", "Store", "stores.php?q=Sephora"],
        ["Fashion", "Category", "deals.php?category=fashion"],
        ["Electronics", "Category", "deals.php?category=electronics"],
        ["Beauty", "Category", "deals.php?category=beauty"],
        ["Headphones", "Product", "products.php?q=Headphones"],
        ["Smartwatch", "Product", "products.php?q=Smartwatch"]
    ];

    function renderSuggestions(query) {
        if (!suggestions) return;

        suggestions.replaceChildren();

        if (query.length < 2) {
            closeSuggestions();
            return;
        }

        const matches = searchData.filter(item =>
            item[0].toLowerCase().includes(query.toLowerCase())
        ).slice(0, 6);

        if (!matches.length) {
            closeSuggestions();
            return;
        }

        matches.forEach(item => {
            const link = document.createElement("a");
            link.href = item[2];
            link.className = "cf-suggestion";

            const name = document.createElement("strong");
            name.textContent = item[0];

            const type = document.createElement("small");
            type.textContent = item[1];

            link.append(name, type);
            suggestions.appendChild(link);
        });

        suggestions.classList.add("show");
        searchInput?.setAttribute("aria-expanded", "true");
    }

    searchInput?.addEventListener("input", function () {
        renderSuggestions(this.value.trim());
    });

    searchInput?.addEventListener("keydown", event => {
        if (event.key === "Escape") {
            closeSuggestions();
        }

        if (event.key === "ArrowDown") {
            const first = suggestions?.querySelector("a");

            if (first) {
                event.preventDefault();
                first.focus();
            }
        }
    });

    suggestions?.addEventListener("keydown", event => {
        const links = [...suggestions.querySelectorAll("a")];
        const index = links.indexOf(document.activeElement);

        if (event.key === "Escape") {
            closeSuggestions();
            searchInput?.focus();
        } else if (event.key === "ArrowDown" && links.length) {
            event.preventDefault();
            links[(index + 1) % links.length].focus();
        } else if (event.key === "ArrowUp" && links.length) {
            event.preventDefault();

            if (index <= 0) {
                searchInput?.focus();
            } else {
                links[index - 1].focus();
            }
        }
    });

    searchForm?.addEventListener("submit", event => {
        const query = searchInput?.value.trim() || "";

        if (!query) {
            event.preventDefault();
            searchInput?.focus();
        } else {
            searchInput.value = query;
        }
    });

    /* MOBILE MENU */

    const mobileMenu = $("cfMobileMenu");
    const mobileOverlay = $("cfMobileOverlay");
    const menuToggle = $("cfMenuToggle");
    const mobileClose = $("cfMobileClose");

    let previousFocus = null;

    function openMobile() {
        previousFocus = document.activeElement;

        closeCategory();
        closeAccount();
        closeSearch();

        mobileMenu?.classList.add("active");
        mobileOverlay?.classList.add("active");
        document.body.classList.add("cf-menu-open");

        mobileMenu?.removeAttribute("inert");
        mobileMenu?.setAttribute("aria-hidden", "false");
        menuToggle?.setAttribute("aria-expanded", "true");
        mobileClose?.focus();
    }

    function closeMobile() {
        if (!mobileMenu?.classList.contains("active")) return;

        if (mobileMenu.contains(document.activeElement)) {
            if (
                previousFocus instanceof HTMLElement &&
                previousFocus.isConnected
            ) {
                previousFocus.focus();
            } else {
                menuToggle?.focus();
            }
        }

        mobileMenu.classList.remove("active");
        mobileOverlay?.classList.remove("active");
        document.body.classList.remove("cf-menu-open");

        mobileMenu.setAttribute("aria-hidden", "true");
        mobileMenu.setAttribute("inert", "");
        menuToggle?.setAttribute("aria-expanded", "false");
    }

    menuToggle?.addEventListener("click", openMobile);
    mobileClose?.addEventListener("click", closeMobile);
    mobileOverlay?.addEventListener("click", closeMobile);

    /* CLICK OUTSIDE */

    document.addEventListener("click", event => {
        if (!category?.contains(event.target)) {
            closeCategory();
        }

        if (!account?.contains(event.target)) {
            closeAccount();
        }

        if (!header?.contains(event.target)) {
            closeSearch();
        } else if (
            !searchForm?.contains(event.target) &&
            !searchToggle?.contains(event.target)
        ) {
            closeSuggestions();
        }
    });

    /* ESCAPE + KEYBOARD */

    document.addEventListener("keydown", event => {
        if (event.key === "Escape") {
            closeMobile();
            closeCategory();
            closeAccount();
            closeSearch();
        }

        if (
            event.key === "Tab" &&
            mobileMenu?.classList.contains("active")
        ) {
            const elements = [...mobileMenu.querySelectorAll(
                "a[href],button:not([disabled])"
            )];

            if (!elements.length) return;

            const first = elements[0];
            const last = elements[elements.length - 1];

            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault();
                last.focus();
            } else if (
                !event.shiftKey &&
                document.activeElement === last
            ) {
                event.preventDefault();
                first.focus();
            }
        }
    });

    window.addEventListener("resize", () => {
        if (window.innerWidth > 1180) {
            closeMobile();
        }
    });
});

const account = $("cfAccount");
const accountToggle = $("cfAccountToggle");

function closeAccount() {
    account?.classList.remove("open");
    accountToggle?.setAttribute("aria-expanded", "false");
}

// No account click handler required.
// The icon is now a direct link to login.php.
