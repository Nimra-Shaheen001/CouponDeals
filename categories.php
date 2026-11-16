
<?php
/* ======================================================
   COUPONDeals - PREMIUM ALL CATEGORIES
   Dynamic PHP + Bootstrap 5.3
====================================================== */

require_once __DIR__ . "/includes/categories-data.php";

$pageTitle = "Explore All Categories | CouponDeals";

/* Escape HTML safely */

if (!function_exists("cfCategoriesEsc")) {
    function cfCategoriesEsc($value): string
    {
        return htmlspecialchars(
            is_scalar($value) || $value === null
                ? (string)($value ?? "")
                : "",
            ENT_QUOTES | ENT_SUBSTITUTE,
            "UTF-8"
        );
    }
}

/*
 * Read the central categories dataset.
 * Use distinct variable names to avoid
 * collisions with header.php.
 */

$cfDirectoryCategories =
    isset($siteCategories) && is_array($siteCategories)
        ? $siteCategories
        : [];

/* Count actual category and related brand records */

$cfDirectoryCategoryCount = count($cfDirectoryCategories);

$cfDirectoryUniqueStores = [];

foreach ($cfDirectoryCategories as $cfDirSlug => $cfDirData) {
    foreach (($cfDirData["stores"] ?? []) as $cfDirStore) {
        if (is_string($cfDirStore)) {
            $cfDirectoryUniqueStores[strtolower($cfDirStore)] = true;
        }
    }
}

$cfDirectoryStoreCount = count($cfDirectoryUniqueStores);

/* Initial search query */

$cfDirectoryQuery = "";

if (isset($_GET["q"]) && is_string($_GET["q"])) {
    $cfDirectoryQuery = substr(trim($_GET["q"]), 0, 100);
}

/* Data-derived spotlight categories, not live trends */

$cfSpotlightSlugs = [
    "fashion",
    "home",
    "beauty",
    "electronics"
];

require_once __DIR__ . "/includes/header.php";
?>

<main class="cdir-page" id="cdirPage">

    <!-- ======================================
         HERO
    ======================================= -->

    <section class="cdir-hero" id="cdirTop">
        <div class="container">

            <nav class="cdir-breadcrumb"
                 aria-label="Breadcrumb">

                <a href="index.php">
                    <i class="bi bi-house-door"></i>
                    Home
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>All Categories</span>

            </nav>

            <div class="cdir-hero-content">

                <span class="cdir-eyebrow">
                    <i class="bi bi-grid-3x3-gap"></i>
                    DISCOVER YOUR FAVORITE CATEGORIES
                </span>

                <h1>
                    Explore All <span>Categories</span>
                </h1>

                <p>
                    Explore popular shopping categories,
                    discover related brands and browse
                    everything from fashion and electronics
                    to beauty, home and travel.
                </p>

                <!-- Search -->

                <form
                    class="cdir-search"
                    id="cdirSearchForm"
                    action="categories.php"
                    method="get"
                    role="search">

                    <i class="bi bi-search"
                       aria-hidden="true"></i>

                    <input
                        type="search"
                        id="cdirSearch"
                        name="q"
                        aria-label="Search categories"
                        placeholder="Search categories, brands or subcategories..."
                        autocomplete="off"
                        maxlength="100"
                        value="<?= cfCategoriesEsc($cfDirectoryQuery) ?>">

                    <button
                        type="button"
                        id="cdirClear"
                        aria-label="Clear search"
                        hidden>
                        <i class="bi bi-x-lg"></i>
                    </button>

                </form>

                <div class="cdir-hero-meta">

                    <span>
                        <i class="bi bi-grid"></i>
                        <?= $cfDirectoryCategoryCount ?> Categories
                    </span>

                    <span>
                        <i class="bi bi-shop-window"></i>
                        <?= $cfDirectoryStoreCount ?> Related Brands
                    </span>

                    <span>
                        <i class="bi bi-arrow-left-right"></i>
                        Easy Category Navigation
                    </span>

                </div>

            </div>

        </div>
    </section>

    
<!-- =====================================================
     COUPONDeals — PREMIUM BROWSE CATEGORIES
===================================================== -->

<section class="cdir-directory cdir-premium-directory" id="cdirDirectory">

    <div class="container">

        <!-- =========================================
             SECTION HEADER
        ========================================== -->

        <div class="cdir-directory-header">

            <div class="cdir-directory-heading">

                <span class="cdir-premium-eyebrow">
                    <span class="cdir-eyebrow-line"></span>
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                    DISCOVER YOUR SHOPPING WORLD
                </span>

                <h2>
                    Browse <span>Categories</span>
                </h2>

                <p>
                    Explore fashion, electronics, beauty, lifestyle
                    and more. Discover your favorite brands and
                    shopping categories in one place.
                </p>

                <div class="cdir-heading-highlights">

                    <span>
                        <i class="bi bi-patch-check-fill"></i>
                        Popular Shopping Categories
                    </span>

                    <span>
                        <i class="bi bi-stars"></i>
                        Discover More Brands
                    </span>

                </div>

            </div>

            <!-- Category Counter -->

            <div class="cdir-directory-tools">

                <div class="cdir-premium-count">

                    <div class="cdir-count-icon">
                        <i class="bi bi-collection"></i>
                    </div>

                    <div class="cdir-count-details">

                        <strong id="cdirCount">
                            <?= count($cfDirectoryCategories) ?> categories
                        </strong>

                        <span>
                            Available to explore
                        </span>

                    </div>

                </div>

                <button
                    type="button"
                    class="cdir-premium-reset"
                    id="cdirReset">

                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset Filters

                </button>

            </div>

        </div>

        <!-- =========================================
             PREMIUM FILTER SECTION
        ========================================== -->

        <div class="cdir-filter-panel">

            <div class="cdir-filter-header">

                <div class="cdir-filter-heading">

                    <span class="cdir-filter-heading-icon">
                        <i class="bi bi-funnel"></i>
                    </span>

                    <div>
                        <h3>Find Your Category</h3>
                        <p>
                            Choose a letter to explore
                            matching shopping categories.
                        </p>
                    </div>

                </div>

                <div class="cdir-filter-caption">
                    <i class="bi bi-sort-alpha-down"></i>
                    A–Z CATEGORY DIRECTORY
                </div>

            </div>

            <!-- Alphabet Filters -->

            <div
                class="cdir-letters cdir-premium-letters"
                id="cdirQuickLetters"
                role="group"
                aria-label="Filter categories alphabetically">

                <button
                    type="button"
                    class="cdir-letter active"
                    data-letter="all"
                    aria-pressed="true">

                    ALL

                </button>

                <?php foreach (range("A", "Z") as $cfLetter): ?>

                    <button
                        type="button"
                        class="cdir-letter"
                        data-letter="<?= $cfLetter ?>"
                        aria-pressed="false">

                        <?= $cfLetter ?>

                    </button>

                <?php endforeach; ?>

            </div>

        </div>

        <!-- =========================================
             CATEGORY GRID
        ========================================== -->

        
<!-- ==========================================
     MINIMAL PREMIUM CATEGORY CARDS
========================================== -->

<div class="cdir-grid cdir-premium-grid" id="cdirGrid">

    <?php foreach ($cfDirectoryCategories as $cfCardSlug => $cfCardData): ?>

        <?php
        $cfCardName = (string)($cfCardData["name"] ?? $cfCardSlug);
        $cfCardImage = (string)($cfCardData["image"] ?? "");
        $cfCardIcon = (string)($cfCardData["icon"] ?? "bi-grid");

        $cfCardSubs = is_array($cfCardData["subcategories"] ?? null)
            ? $cfCardData["subcategories"]
            : [];

        $cfCardStores = is_array($cfCardData["stores"] ?? null)
            ? $cfCardData["stores"]
            : [];

        $cfCardUrl = "category.php?slug=" .
            rawurlencode((string)$cfCardSlug);

        $cfSearchText = $cfCardName . " " .
            implode(" ", array_filter($cfCardSubs, "is_string")) . " " .
            implode(" ", array_filter($cfCardStores, "is_string"));

        $cfShortSubs = array_slice($cfCardSubs, 0, 3);
        ?>

        <article
            class="cdir-card cdir-minimal-card"
            data-name="<?= cfCategoriesEsc($cfCardName) ?>"
            data-letter="<?= cfCategoriesEsc(strtoupper(substr($cfCardName, 0, 1))) ?>"
            data-search="<?= cfCategoriesEsc($cfSearchText) ?>">

            <!-- Entire card clickable -->

            <a
                href="<?= cfCategoriesEsc($cfCardUrl) ?>"
                class="cdir-minimal-link"
                aria-label="Explore <?= cfCategoriesEsc($cfCardName) ?>">

                <!-- Category image -->

                <div class="cdir-minimal-image">

                    <?php if ($cfCardImage !== ""): ?>

                        <img
                            src="<?= cfCategoriesEsc($cfCardImage) ?>"
                            alt="<?= cfCategoriesEsc($cfCardName) ?>"
                            loading="lazy"
                            onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                        <div class="cdir-minimal-fallback" hidden>
                            <i class="bi <?= cfCategoriesEsc($cfCardIcon) ?>"></i>
                        </div>

                    <?php else: ?>

                        <div class="cdir-minimal-fallback">
                            <i class="bi <?= cfCategoriesEsc($cfCardIcon) ?>"></i>
                        </div>

                    <?php endif; ?>

                </div>

                <!-- Card content -->

                <div class="cdir-minimal-body">

                    <div class="cdir-minimal-heading">

                        <h3>
                            <?= cfCategoriesEsc($cfCardName) ?>
                        </h3>

                        <span class="cdir-minimal-arrow">
                            <i class="bi bi-arrow-up-right"></i>
                        </span>

                    </div>

                    <?php if (!empty($cfShortSubs)): ?>

                        <p class="cdir-minimal-subcategories">

                            <?= cfCategoriesEsc(
                                implode(" · ", $cfShortSubs)
                            ) ?>

                        </p>

                    <?php endif; ?>

                </div>

            </a>

        </article>

    <?php endforeach; ?>

</div>

        <!-- =========================================
             EMPTY SEARCH RESULT
        ========================================== -->

        <div class="cdir-empty" id="cdirEmpty" hidden>

            <i class="bi bi-search"></i>

            <h3>No Categories Found</h3>

            <p>
                We couldn't find a matching category.
                Try searching by another name or browse all categories.
            </p>

            <button type="button" id="cdirEmptyReset">

                <i class="bi bi-arrow-counterclockwise"></i>
                Clear Filters

            </button>

        </div>

        <!-- Bottom information -->

        <div class="cdir-directory-bottom">

            <span>
                <i class="bi bi-lightbulb"></i>
                Looking for a particular brand?
                Explore our complete store directory.
            </span>

            <a href="stores.php">
                Browse All Stores
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>

    </div>

</section>

    <!-- ======================================
         CATEGORY SPOTLIGHT
    ======================================= -->

    <section class="cdir-spotlight">

        <div class="container">

            <div class="cdir-section-heading">

                <div>
                    <span class="cdir-section-kicker">
                        POPULAR SHOPPING INTERESTS
                    </span>

                    <h2>
                        Categories to <span>Explore</span>
                    </h2>

                    <p>
                        Start browsing these featured
                        shopping categories.
                    </p>
                </div>

            </div>

            <div class="cdir-spotlight-grid">

                <?php foreach ($cfSpotlightSlugs as $cfSpotSlug): ?>

                    <?php
                    if (!isset($cfDirectoryCategories[$cfSpotSlug])) {
                        continue;
                    }

                    $cfSpotData = $cfDirectoryCategories[$cfSpotSlug];

                    $cfSpotName = (string)(
                        $cfSpotData["name"] ?? $cfSpotSlug
                    );

                    $cfSpotIcon = (string)(
                        $cfSpotData["icon"] ?? "bi-grid"
                    );

                    $cfSpotImage = (string)(
                        $cfSpotData["image"] ?? ""
                    );

                    $cfSpotUrl = "category.php?slug=" .
                        rawurlencode($cfSpotSlug);
                    ?>

                    <a
                        class="cdir-spotlight-card"
                        href="<?= cfCategoriesEsc($cfSpotUrl) ?>">

                        <?php if ($cfSpotImage !== ""): ?>

                            <img
                                src="<?= cfCategoriesEsc($cfSpotImage) ?>"
                                alt=""
                                loading="lazy">

                        <?php endif; ?>

                        <span class="cdir-spotlight-overlay"></span>

                        <span class="cdir-spotlight-content">

                            <i class="bi <?= cfCategoriesEsc($cfSpotIcon) ?>"></i>

                            <strong>
                                <?= cfCategoriesEsc($cfSpotName) ?>
                            </strong>

                            <small>
                                Explore Category
                                <i class="bi bi-arrow-right"></i>
                            </small>

                        </span>

                    </a>

                <?php endforeach; ?>

            </div>

        </div>

    </section>

    <!-- ======================================
         FINAL CTA
    ======================================= -->

    <section class="cdir-bottom">

        <div class="container">

            <div class="cdir-bottom-panel">

                <span class="cdir-bottom-label">
                    <i class="bi bi-stars"></i>
                    DISCOVER MORE WITH COUPONDEALS
                </span>

                <h2>
                    Find Your Favorite Brands.
                    <span>Explore Better Deals.</span>
                </h2>

                <p>
                    Browse popular stores or explore
                    our coupon listings for shopping inspiration.
                </p>

                <div class="cdir-bottom-actions">

                    <a href="stores.php" class="cdir-button-primary">
                        <i class="bi bi-shop"></i>
                        Explore Stores
                        <i class="bi bi-arrow-up-right"></i>
                    </a>

                    <a href="coupon.php" class="cdir-button-outline">
                        <i class="bi bi-ticket-perforated"></i>
                        Browse Coupons
                        <i class="bi bi-arrow-up-right"></i>
                    </a>

                </div>

            </div>

        </div>

    </section>

</main>

<script src="assets/js/categories.js?v=3" defer></script>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
