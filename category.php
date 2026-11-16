
<?php
/* ==========================================================
   COUPONDEALS - CATEGORY DETAIL PAGE
   Dynamic page for all 22 categories
========================================================== */

require_once __DIR__ . "/includes/categories-data.php";

/* Safely read slug */

$cfRequestedSlug = $_GET["slug"] ?? "";

if (!is_string($cfRequestedSlug)) {
    $cfRequestedSlug = "";
}

$cfRequestedSlug = strtolower(trim($cfRequestedSlug));

/* Find category */

$cfCategoryFound = isset(
    $siteCategories[$cfRequestedSlug]
);

if (!$cfCategoryFound) {
    http_response_code(404);
}

$cfSelectedCategory = $cfCategoryFound
    ? $siteCategories[$cfRequestedSlug]
    : null;

/* Safe category fields */

$cfCategoryName = $cfCategoryFound
    ? (string)($cfSelectedCategory["name"] ?? "Category")
    : "Category Not Found";

$cfCategoryDescription = $cfCategoryFound
    ? (string)($cfSelectedCategory["description"] ?? "")
    : "The requested category could not be found.";

$cfCategoryIcon = $cfCategoryFound
    ? (string)($cfSelectedCategory["icon"] ?? "bi-grid")
    : "bi-search";

$cfCategoryImage = $cfCategoryFound
    ? (string)($cfSelectedCategory["image"] ?? "")
    : "";

$cfCategorySubcategories =
    $cfCategoryFound &&
    is_array($cfSelectedCategory["subcategories"] ?? null)
        ? $cfSelectedCategory["subcategories"]
        : [];

$cfCategoryStores =
    $cfCategoryFound &&
    is_array($cfSelectedCategory["stores"] ?? null)
        ? $cfSelectedCategory["stores"]
        : [];

/* HTML escaping */

if (!function_exists("cfDetailE")) {
    function cfDetailE($value): string
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

/* Brand domains for logos */

$cfStoreDomains = [
    "nike" => "nike.com",
    "adidas" => "adidas.com",
    "zara" => "zara.com",
    "asos" => "asos.com",
    "h&m" => "hm.com",
    "shein" => "shein.com",
    "amazon" => "amazon.com",
    "apple" => "apple.com",
    "samsung" => "samsung.com",
    "best buy" => "bestbuy.com",
    "dell" => "dell.com",
    "sony" => "sony.com",
    "sephora" => "sephora.com",
    "ulta beauty" => "ulta.com",
    "the body shop" => "thebodyshop.com",
    "l'oreal" => "loreal.com",
    "aveda" => "aveda.com",
    "ikea" => "ikea.com",
    "wayfair" => "wayfair.com",
    "walmart" => "walmart.com",
    "target" => "target.com",
    "home depot" => "homedepot.com",
    "puma" => "puma.com",
    "new balance" => "newbalance.com",
    "skechers" => "skechers.com",
    "vans" => "vans.com",
    "iherb" => "iherb.com",
    "myprotein" => "myprotein.com",
    "walgreens" => "walgreens.com",
    "fitbit" => "fitbit.com",
    "garmin" => "garmin.com",
    "booking.com" => "booking.com",
    "expedia" => "expedia.com",
    "airbnb" => "airbnb.com",
    "klook" => "klook.com",
    "hotels.com" => "hotels.com",
    "gymshark" => "gymshark.com",
    "under armour" => "underarmour.com",
    "doordash" => "doordash.com",
    "uber eats" => "ubereats.com",
    "domino's" => "dominos.com",
    "instacart" => "instacart.com",
    "pizza hut" => "pizzahut.com",
    "lego" => "lego.com",
    "pandora" => "pandora.net",
    "fossil" => "fossil.com",
    "swarovski" => "swarovski.com",
    "kate spade" => "katespade.com",
    "ebay" => "ebay.com",
    "udemy" => "udemy.com",
    "canva" => "canva.com",
    "chewy" => "chewy.com",
    "petco" => "petco.com",
    "microsoft" => "microsoft.com",
    "adobe" => "adobe.com",
    "kaspersky" => "kaspersky.com",
    "wix" => "wix.com",
    "godaddy" => "godaddy.com",
    "hostinger" => "hostinger.com",
    "namecheap" => "namecheap.com",
    "playstation" => "playstation.com",
    "xbox" => "xbox.com",
    "nintendo" => "nintendo.com",
    "epic games" => "epicgames.com",
    "steam" => "store.steampowered.com",
    "etsy" => "etsy.com",
    "1-800-flowers" => "1800flowers.com",
    "zazzle" => "zazzle.com",
    "staples" => "staples.com",
    "office depot" => "officedepot.com",
    "hp" => "hp.com",
    "west elm" => "westelm.com",
    "anker" => "anker.com"
];

if (!function_exists("cfDetailStoreLogo")) {
    function cfDetailStoreLogo(
        string $store,
        array $domains
    ): string {
        $key = strtolower(trim($store));

        if (!isset($domains[$key])) {
            return "";
        }

        return "https://www.google.com/s2/favicons?domain=" .
            rawurlencode($domains[$key]) .
            "&sz=128";
    }
}

/* Related categories */

$cfRelatedCategories = [];

foreach ($siteCategories as $cfLoopSlug => $cfLoopData) {
    if ($cfLoopSlug === $cfRequestedSlug) {
        continue;
    }

    $cfRelatedCategories[$cfLoopSlug] = $cfLoopData;

    if (count($cfRelatedCategories) >= 4) {
        break;
    }
}

$pageTitle = $cfCategoryName . " | CouponDeals";

require_once __DIR__ . "/includes/header.php";
?>

<main class="cd-page" id="cdPage">

    <!-- =========================================
         BREADCRUMBS
    ========================================== -->

    <section class="cd-breadcrumb-section">
        <div class="container">

            <nav class="cd-breadcrumb" aria-label="Breadcrumb">

                <a href="index.php">
                    <i class="bi bi-house-door"></i>
                    Home
                </a>

                <i class="bi bi-chevron-right"></i>

                <a href="categories.php">
                    Categories
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>
                    <?= cfDetailE($cfCategoryName) ?>
                </span>

            </nav>

        </div>
    </section>

    <?php if (!$cfCategoryFound): ?>

        <!-- =====================================
             INVALID CATEGORY
        ====================================== -->

        <section class="cd-not-found">
            <div class="container">

                <div class="cd-not-found-inner">

                    <div class="cd-not-found-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <h1>Category Not Found</h1>

                    <p>
                        The category you're looking for
                        isn't available in our directory.
                    </p>

                    <a href="categories.php">
                        Explore All Categories
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>
        </section>

    <?php else: ?>

        <!-- =====================================
             HERO
        ====================================== -->

        <section class="cd-hero">

            <div class="container">

                <div class="cd-hero-layout">

                    <!-- Left side -->

                    <div class="cd-hero-content">

                        <span class="cd-eyebrow">

                            <i class="bi <?= cfDetailE($cfCategoryIcon) ?>"></i>

                            EXPLORE CATEGORY

                        </span>

                        <h1>
                            <?= cfDetailE($cfCategoryName) ?>
                            <span>Deals & Brands</span>
                        </h1>

                        <p>
                            <?= cfDetailE($cfCategoryDescription) ?>
                        </p>

                        <div class="cd-hero-stats">

                            <span>
                                <i class="bi bi-grid-3x3-gap"></i>
                                <?= count($cfCategorySubcategories) ?>
                                Subcategories
                            </span>

                            <span>
                                <i class="bi bi-shop"></i>
                                <?= count($cfCategoryStores) ?>
                                Related Brands
                            </span>

                        </div>

                        <div class="cd-hero-actions">

                            <a href="#cdStores"
                               class="cd-primary-btn">

                                Explore Brands
                                <i class="bi bi-arrow-up-right"></i>

                            </a>

                            <a href="#cdSubcategories"
                               class="cd-secondary-btn">

                                Browse Subcategories
                                <i class="bi bi-arrow-down"></i>

                            </a>

                        </div>

                    </div>

                    <!-- Right side image -->

                    <div class="cd-hero-visual">

                        <div class="cd-hero-image">

                            <?php if ($cfCategoryImage !== ""): ?>

                                <img
                                    src="<?= cfDetailE($cfCategoryImage) ?>"
                                    alt="<?= cfDetailE($cfCategoryName) ?>"
                                    fetchpriority="high"
                                    onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                                <div class="cd-image-fallback" hidden>
                                    <i class="bi <?= cfDetailE($cfCategoryIcon) ?>"></i>
                                </div>

                            <?php else: ?>

                                <div class="cd-image-fallback">
                                    <i class="bi <?= cfDetailE($cfCategoryIcon) ?>"></i>
                                </div>

                            <?php endif; ?>

                        </div>

                        <div class="cd-visual-caption">
                            <i class="bi bi-stars"></i>
                            Discover your favorite shopping brands
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- =====================================
             SUBCATEGORIES
        ====================================== -->

        <section class="cd-section cd-subcategory-section"
                 id="cdSubcategories">

            <div class="container">

                <div class="cd-section-heading">

                    <div>
                        <span class="cd-section-label">
                            SHOP BY INTEREST
                        </span>

                        <h2>
                            Explore
                            <span>Subcategories</span>
                        </h2>

                        <p>
                            Discover popular shopping areas
                            within <?= cfDetailE($cfCategoryName) ?>.
                        </p>
                    </div>

                    <div class="cd-heading-count">
                        <?= count($cfCategorySubcategories) ?>
                        Subcategories
                    </div>

                </div>

                <!-- Subcategory search -->

                <div class="cd-sub-search">

                    <i class="bi bi-search"></i>

                    <input
                        type="search"
                        id="cdSubSearch"
                        placeholder="Search subcategories..."
                        aria-label="Search subcategories"
                        autocomplete="off">

                    <button
                        type="button"
                        id="cdSubClear"
                        aria-label="Clear search"
                        hidden>
                        <i class="bi bi-x-lg"></i>
                    </button>

                </div>

                <div class="cd-sub-grid" id="cdSubGrid">

                    <?php foreach ($cfCategorySubcategories as $cfSubIndex => $cfSubName): ?>

                        <article
                            class="cd-sub-card"
                            data-sub-name="<?= cfDetailE($cfSubName) ?>">

                            <span class="cd-sub-icon">
                                <i class="bi <?= cfDetailE($cfCategoryIcon) ?>"></i>
                            </span>

                            <div class="cd-sub-content">
                                <h3>
                                    <?= cfDetailE($cfSubName) ?>
                                </h3>
                                <span>
                                    <?= cfDetailE($cfCategoryName) ?>
                                </span>
                            </div>

                            <i class="bi bi-check2-circle cd-sub-arrow"></i>

                        </article>

                    <?php endforeach; ?>

                </div>

                <div class="cd-empty"
                     id="cdSubEmpty"
                     hidden>

                    <i class="bi bi-search"></i>

                    <h3>No Subcategories Found</h3>

                    <p>Try another search term.</p>

                    <button type="button" id="cdSubReset">
                        Clear Search
                    </button>

                </div>

            </div>

        </section>

        <!-- =====================================
             RELATED STORES
        ====================================== -->

        <section class="cd-section cd-stores-section"
                 id="cdStores">

            <div class="container">

                <div class="cd-section-heading">

                    <div>
                        <span class="cd-section-label">
                            DISCOVER TOP BRANDS
                        </span>

                        <h2>
                            Popular <span>Stores</span>
                        </h2>

                        <p>
                            Explore brands related to
                            <?= cfDetailE($cfCategoryName) ?>.
                        </p>
                    </div>

                    <a href="stores.php"
                       class="cd-heading-link">

                        View All Stores

                        <i class="bi bi-arrow-up-right"></i>

                    </a>

                </div>

                <div class="cd-store-grid">

                    <?php foreach ($cfCategoryStores as $cfStoreName): ?>

                        <?php
                        $cfStoreLogoUrl = cfDetailStoreLogo(
                            $cfStoreName,
                            $cfStoreDomains
                        );

                        $cfStoreLink =
                            "coupon.php?store=" .
                            rawurlencode($cfStoreName) .
                            "#ccLatest";
                        ?>

                        <a
                            href="<?= cfDetailE($cfStoreLink) ?>"
                            class="cd-store-card">

                            <div class="cd-store-logo">

                                <?php if ($cfStoreLogoUrl !== ""): ?>

                                    <img
                                        src="<?= cfDetailE($cfStoreLogoUrl) ?>"
                                        alt="<?= cfDetailE($cfStoreName) ?> logo"
                                        loading="lazy"
                                        onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                                    <span hidden>
                                        <?= cfDetailE(strtoupper(substr($cfStoreName, 0, 1))) ?>
                                    </span>

                                <?php else: ?>

                                    <span>
                                        <?= cfDetailE(strtoupper(substr($cfStoreName, 0, 1))) ?>
                                    </span>

                                <?php endif; ?>

                            </div>

                            <strong>
                                <?= cfDetailE($cfStoreName) ?>
                            </strong>

                            <small>
                                Browse Coupons
                                <i class="bi bi-arrow-up-right"></i>
                            </small>

                        </a>

                    <?php endforeach; ?>

                </div>

            </div>

        </section>

        <!-- =====================================
             DISCOVER MORE CATEGORIES
        ====================================== -->

        <section class="cd-section cd-related-section">

            <div class="container">

                <div class="cd-section-heading">

                    <div>
                        <span class="cd-section-label">
                            KEEP EXPLORING
                        </span>

                        <h2>
                            Discover More
                            <span>Categories</span>
                        </h2>

                        <p>
                            Explore other popular shopping categories.
                        </p>
                    </div>

                    <a href="categories.php" class="cd-heading-link">
                        All Categories
                        <i class="bi bi-arrow-up-right"></i>
                    </a>

                </div>

                <div class="cd-related-grid">

                    <?php foreach ($cfRelatedCategories as $cfRelatedSlug => $cfRelatedData): ?>

                        <a
                            href="category.php?slug=<?= rawurlencode($cfRelatedSlug) ?>"
                            class="cd-related-card">

                            <span>
                                <i class="bi <?= cfDetailE($cfRelatedData["icon"] ?? "bi-grid") ?>"></i>
                            </span>

                            <strong>
                                <?= cfDetailE($cfRelatedData["name"] ?? "Category") ?>
                            </strong>

                            <i class="bi bi-arrow-up-right"></i>

                        </a>

                    <?php endforeach; ?>

                </div>

            </div>

        </section>

        <!-- =====================================
             BOTTOM CALL TO ACTION
        ====================================== -->

        <section class="cd-bottom-section">

            <div class="container">

                <div class="cd-bottom-panel">

                    <span class="cd-bottom-label">
                        <i class="bi bi-stars"></i>
                        DISCOVER COUPONDEALS
                    </span>

                    <h2>
                        Explore More.
                        <span>Shop Smarter.</span>
                    </h2>

                    <p>
                        Discover stores, browse categories and
                        explore shopping offers in one place.
                    </p>

                    <div class="cd-bottom-actions">

                        <a href="coupon.php" class="cd-bottom-primary">
                            <i class="bi bi-ticket-perforated"></i>
                            Browse Coupons
                        </a>

                        <a href="categories.php" class="cd-bottom-secondary">
                            <i class="bi bi-grid"></i>
                            All Categories
                        </a>

                    </div>

                </div>

            </div>

        </section>

    <?php endif; ?>

</main>

<script src="assets/js/script.js?v=1" defer></script>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
