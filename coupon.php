
<?php
/* =====================================================
   COUPONDEALS - PREMIUM COUPON DIRECTORY
   PHP + Bootstrap 5.3
   Sample offers for frontend demonstration
===================================================== */

$pageTitle = "Coupons & Promo Codes | CouponDeals";

/* Unique helper names prevent conflicts */

if (!function_exists("cfCouponEsc")) {
    function cfCouponEsc($value): string
    {
        if (!is_scalar($value) && $value !== null) {
            return "";
        }

        return htmlspecialchars(
            (string) ($value ?? ""),
            ENT_QUOTES | ENT_SUBSTITUTE,
            "UTF-8"
        );
    }
}

if (!function_exists("cfCouponLogo")) {
    function cfCouponLogo(string $domain): string
    {
        return "https://www.google.com/s2/favicons?domain=" .
            rawurlencode($domain) . "&sz=128";
    }
}

/* -----------------------------------------------------
   DEMO COUPON DATA
   These are not real or verified promotional codes.
----------------------------------------------------- */

$cfCouponItems = [
    [
        "id" => 1,
        "store" => "Nike",
        "domain" => "nike.com",
        "category" => "Fashion",
        "discount" => "20%",
        "title" => "Discover Nike Sportswear and Lifestyle",
        "description" => "Explore activewear, footwear and accessories.",
        "code" => "DEMO-NIKE20",
        "url" => "https://www.nike.com/",
        "featured" => true
    ],
    [
        "id" => 2,
        "store" => "Adidas",
        "domain" => "adidas.com",
        "category" => "Fashion",
        "discount" => "15%",
        "title" => "Explore Adidas Shoes and Apparel",
        "description" => "Discover sports fashion and lifestyle products.",
        "code" => "DEMO-ADI15",
        "url" => "https://www.adidas.com/",
        "featured" => true
    ],
    [
        "id" => 3,
        "store" => "Amazon",
        "domain" => "amazon.com",
        "category" => "Electronics",
        "discount" => "10%",
        "title" => "Discover Electronics and Shopping Essentials",
        "description" => "Browse technology and everyday products.",
        "code" => "DEMO-AMZ10",
        "url" => "https://www.amazon.com/",
        "featured" => true
    ],
    [
        "id" => 4,
        "store" => "Sephora",
        "domain" => "sephora.com",
        "category" => "Beauty",
        "discount" => "15%",
        "title" => "Discover Beauty and Skincare Favorites",
        "description" => "Explore cosmetics and skincare collections.",
        "code" => "DEMO-BEAUTY",
        "url" => "https://www.sephora.com/",
        "featured" => true
    ],
    [
        "id" => 5,
        "store" => "Puma",
        "domain" => "puma.com",
        "category" => "Sports",
        "discount" => "10%",
        "title" => "Explore Puma Sports and Lifestyle",
        "description" => "Discover sportswear, shoes and accessories.",
        "code" => "DEMO-PUMA",
        "url" => "https://us.puma.com/",
        "featured" => false
    ],
    [
        "id" => 6,
        "store" => "Etsy",
        "domain" => "etsy.com",
        "category" => "Home",
        "discount" => "15%",
        "title" => "Discover Handmade Gifts and Home Decor",
        "description" => "Explore creative products and unique gifts.",
        "code" => "DEMO-ETSY",
        "url" => "https://www.etsy.com/",
        "featured" => false
    ],
    [
        "id" => 7,
        "store" => "eBay",
        "domain" => "ebay.com",
        "category" => "Electronics",
        "discount" => "$10",
        "title" => "Explore Technology and Accessories",
        "description" => "Browse electronics and accessories.",
        "code" => "DEMO-EBAY",
        "url" => "https://www.ebay.com/",
        "featured" => false
    ],
    [
        "id" => 8,
        "store" => "Walmart",
        "domain" => "walmart.com",
        "category" => "Home",
        "discount" => "$20",
        "title" => "Discover Home and Everyday Essentials",
        "description" => "Explore home, living and family collections.",
        "code" => "DEMO-WMT",
        "url" => "https://www.walmart.com/",
        "featured" => false
    ],
    [
        "id" => 9,
        "store" => "Nike",
        "domain" => "nike.com",
        "category" => "Sports",
        "discount" => "15%",
        "title" => "Explore Nike Running Collections",
        "description" => "Discover running gear and training essentials.",
        "code" => "DEMO-RUN",
        "url" => "https://www.nike.com/",
        "featured" => false
    ],
    [
        "id" => 10,
        "store" => "Adidas",
        "domain" => "adidas.com",
        "category" => "Sports",
        "discount" => "10%",
        "title" => "Discover Adidas Training Essentials",
        "description" => "Browse workout apparel and training products.",
        "code" => "DEMO-TRAIN",
        "url" => "https://www.adidas.com/",
        "featured" => false
    ],
    [
        "id" => 11,
        "store" => "Sephora",
        "domain" => "sephora.com",
        "category" => "Beauty",
        "discount" => "10%",
        "title" => "Explore Skincare and Makeup Collections",
        "description" => "Discover popular beauty products.",
        "code" => "DEMO-SKIN",
        "url" => "https://www.sephora.com/",
        "featured" => false
    ],
    [
        "id" => 12,
        "store" => "Etsy",
        "domain" => "etsy.com",
        "category" => "Home",
        "discount" => "$5",
        "title" => "Discover Personalized Gifts",
        "description" => "Browse handmade and personalized items.",
        "code" => "DEMO-GIFT",
        "url" => "https://www.etsy.com/",
        "featured" => false
    ]
];

/* Important: unique category variable */
$cfCouponCategories = [
    "All",
    "Fashion",
    "Electronics",
    "Beauty",
    "Home",
    "Sports"
];

/* Store directory */
$cfCouponStores = [];

foreach ($cfCouponItems as $item) {
    $cfCouponStores[$item["store"]] = $item["domain"];
}

ksort($cfCouponStores, SORT_NATURAL | SORT_FLAG_CASE);

/* Optional URL filters */
$cfInitialStore = "all";

if (
    isset($_GET["store"]) &&
    is_string($_GET["store"]) &&
    isset($cfCouponStores[$_GET["store"]])
) {
    $cfInitialStore = $_GET["store"];
}

/* Reveal code page */
$cfRevealRequested = isset($_GET["reveal"]);
$cfRevealedCoupon = null;

if ($cfRevealRequested) {
    $requestedId = filter_var(
        $_GET["reveal"],
        FILTER_VALIDATE_INT
    );

    foreach ($cfCouponItems as $item) {
        if ($item["id"] === $requestedId) {
            $cfRevealedCoupon = $item;
            break;
        }
    }

    if ($cfRevealedCoupon === null) {
        http_response_code(404);
    }
}

/* Header and footer stay shared */
require_once __DIR__ . "/includes/header.php";
?>

<?php if ($cfRevealRequested): ?>

<!-- ===============================================
     REVEAL CODE - NEW TAB POPUP
================================================ -->

<main class="cc-reveal-page" id="ccRevealPage">

    <?php if ($cfRevealedCoupon): ?>

        <div
            class="cc-reveal-overlay"
            id="ccRevealOverlay"
            data-store-url="<?= cfCouponEsc($cfRevealedCoupon["url"]) ?>">

            <div
                class="cc-reveal-dialog"
                role="dialog"
                aria-modal="true"
                aria-labelledby="ccRevealHeading">

                <button
                    type="button"
                    class="cc-reveal-close"
                    id="ccRevealClose"
                    aria-label="Close coupon popup">
                    <i class="bi bi-x-lg"></i>
                </button>

                <div class="cc-reveal-logo">
                    <img
                        src="<?= cfCouponEsc(
                            cfCouponLogo($cfRevealedCoupon["domain"])
                        ) ?>"
                        alt="<?= cfCouponEsc($cfRevealedCoupon["store"]) ?> logo"
                        onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                    <span hidden>
                        <?= cfCouponEsc(substr($cfRevealedCoupon["store"], 0, 1)) ?>
                    </span>
                </div>

                <span class="cc-reveal-eyebrow">
                    <i class="bi bi-ticket-perforated"></i>
                    COUPON PREVIEW
                </span>

                <h1 id="ccRevealHeading">
                    <?= cfCouponEsc($cfRevealedCoupon["store"]) ?>
                    Coupon Code
                </h1>

                <p class="cc-reveal-title">
                    <?= cfCouponEsc($cfRevealedCoupon["title"]) ?>
                </p>

                <div class="cc-reveal-code-box">

                    <strong id="ccCodeValue">
                        <?= cfCouponEsc($cfRevealedCoupon["code"]) ?>
                    </strong>

                    <button type="button" id="ccCopyCode">
                        <i class="bi bi-copy"></i>
                        <span>Copy Code</span>
                    </button>
                </div>

                <p class="cc-reveal-note">
                    Demo coupon for design testing only.
                    This code is not verified for checkout.
                </p>

                <a
                    class="cc-reveal-shop"
                    href="<?= cfCouponEsc($cfRevealedCoupon["url"]) ?>"
                    target="_blank"
                    rel="noopener noreferrer">
                    Visit <?= cfCouponEsc($cfRevealedCoupon["store"]) ?>
                    <i class="bi bi-arrow-up-right"></i>
                </a>

                <a class="cc-reveal-back" href="coupon.php">
                    Browse More Coupons
                </a>

            </div>
        </div>

    <?php else: ?>

        <div class="cc-reveal-error">
            <h1>Coupon Not Found</h1>
            <p>This coupon is not available.</p>
            <a href="coupon.php">Browse Coupons</a>
        </div>

    <?php endif; ?>

</main>

<?php else: ?>

<!-- ===============================================
     MAIN COUPONS DIRECTORY
================================================ -->

<main class="cc-page"
      id="ccCouponPage"
      data-initial-store="<?= cfCouponEsc($cfInitialStore) ?>">

    
<!-- ==========================================
     COUPONDEALS - PREMIUM COUPONS HERO
========================================== -->

<section class="cc-hero">

    <div class="container">

        <div class="cc-premium-hero">

            <!-- Decorative Elements -->
            <span class="cc-hero-decoration cc-deco-left"
                  aria-hidden="true">
            </span>

            <span class="cc-hero-decoration cc-deco-right"
                  aria-hidden="true">
            </span>

            <!-- Eyebrow -->
            <div class="cc-premium-eyebrow">
                <i class="bi bi-patch-check-fill"></i>
                <span>DISCOVER SMARTER SAVINGS</span>
            </div>

            <!-- Heading -->
            <h1>
                Verified
                <span>Coupons &amp; Codes</span>
            </h1>

            <!-- Description -->
            <p class="cc-premium-description">
                Discover handpicked coupon codes, explore
                popular brands and find better ways to save
                on your favorite products.
            </p>

            <!-- Feature Highlights -->
            <div class="cc-premium-features">

                <span>
                    <i class="bi bi-check-circle-fill"></i>
                    Popular Brands
                </span>

                <span>
                    <i class="bi bi-check-circle-fill"></i>
                    Coupon Codes
                </span>

                <span>
                    <i class="bi bi-check-circle-fill"></i>
                    Shopping Deals
                </span>

            </div>

            <!-- Bottom Accent -->
            <div class="cc-hero-accent" aria-hidden="true">
                <span></span>
            </div>

        </div>

    </div>

</section>


    <!-- FEATURED STORES -->
    <section class="cc-featured-section">
        <div class="container">

            <div class="cc-section-header">

                <div>
                    <span class="cc-section-eyebrow">
                        <i class="bi bi-stars"></i>
                        HANDPICKED SHOPPING BRANDS
                    </span>

                    <h2>
                        Featured <span>Stores</span>
                    </h2>

                    <p>
                        Discover popular shopping destinations.
                    </p>
                </div>

                <a href="stores.php" class="cc-view-all">
                    View All Stores
                    <i class="bi bi-arrow-up-right"></i>
                </a>

            </div>

            <div class="cc-featured-grid">

                <?php
                $cfFeaturedNames = [
                    "Nike", "Amazon", "Sephora"
                ];
                ?>

                <?php foreach ($cfFeaturedNames as $storeName): ?>

                    <?php
                    $storeDomain = $cfCouponStores[$storeName];
                    $storeUrl = "coupon.php?store=" .
                        rawurlencode($storeName) . "#ccLatest";
                    ?>

                    <a
                        href="<?= cfCouponEsc($storeUrl) ?>"
                        class="cc-featured-card">

                        <div class="cc-featured-logo">
                            <img
                                src="<?= cfCouponEsc(cfCouponLogo($storeDomain)) ?>"
                                alt="<?= cfCouponEsc($storeName) ?> logo"
                                loading="lazy"
                                onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                            <span hidden>
                                <?= cfCouponEsc(substr($storeName, 0, 1)) ?>
                            </span>
                        </div>

                        <div class="cc-featured-info">
                            <span>FEATURED BRAND</span>
                            <h3><?= cfCouponEsc($storeName) ?></h3>

                            <div>
                                Explore Coupons
                                <i class="bi bi-arrow-up-right"></i>
                            </div>
                        </div>

                        <i class="bi bi-stars cc-featured-decoration"></i>

                    </a>

                <?php endforeach; ?>

            </div>
        </div>
    </section>

    <!-- COUPON LIST -->
    <section class="cc-directory-section" id="ccLatest">
        <div class="container">

            <div class="cc-section-header">

                <div>
                    <span class="cc-section-eyebrow">
                        <i class="bi bi-ticket-perforated"></i>
                        LATEST COUPON COLLECTION
                    </span>

                    <h2>
                        Latest <span>Coupons & Codes</span>
                    </h2>

                    <p>
                        Browse popular offers and discover new brands.
                    </p>
                </div>

                <span class="cc-result-count"
                      id="ccResultCount"
                      aria-live="polite"></span>

            </div>

            <!-- FILTERS -->
            <div class="cc-filter-panel">

                <div class="cc-category-nav" id="ccCategoryNav">

                    <?php foreach ($cfCouponCategories as $category): ?>

                        <button
                            type="button"
                            class="cc-category-btn"
                            data-category="<?= cfCouponEsc($category) ?>"
                            aria-pressed="false">

                            <?php if ($category === "All"): ?>
                                <i class="bi bi-grid"></i>
                                All Coupons
                            <?php else: ?>
                                <?= cfCouponEsc($category) ?>
                            <?php endif; ?>

                        </button>

                    <?php endforeach; ?>

                </div>

                <div class="cc-filter-bottom">

                    <div class="cc-filter-fields">

                        <label for="ccStoreSelect">
                            <i class="bi bi-shop"></i>
                            Store
                        </label>

                        <select id="ccStoreSelect">
                            <option value="all">All Stores</option>

                            <?php foreach ($cfCouponStores as $name => $domain): ?>
                                <option value="<?= cfCouponEsc($name) ?>">
                                    <?= cfCouponEsc($name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="ccSortSelect">Sort by</label>

                        <select id="ccSortSelect">
                            <option value="featured">Featured First</option>
                            <option value="az">Store A–Z</option>
                            <option value="za">Store Z–A</option>
                        </select>

                    </div>

                    <button
                        type="button"
                        id="ccResetFilters"
                        class="cc-reset-btn">

                        <i class="bi bi-arrow-counterclockwise"></i>
                        Reset Filters
                    </button>

                </div>
            </div>

            <!-- COUPON CARDS -->
            <div class="cc-coupon-grid" id="ccCouponGrid">

                <?php foreach ($cfCouponItems as $index => $coupon): ?>

                    <?php
                    $searchText = strtolower(
                        $coupon["store"] . " " .
                        $coupon["category"] . " " .
                        $coupon["title"] . " " .
                        $coupon["description"]
                    );
                    ?>

                    <article
                        class="cc-coupon-card"
                        data-store="<?= cfCouponEsc($coupon["store"]) ?>"
                        data-category="<?= cfCouponEsc($coupon["category"]) ?>"
                        data-featured="<?= $coupon["featured"] ? "1" : "0" ?>"
                        data-order="<?= (int)$index ?>"
                        data-search="<?= cfCouponEsc($searchText) ?>">

                        <div class="cc-card-top">

                            <span class="cc-preview-badge">
                                <i class="bi bi-info-circle"></i>
                                PREVIEW
                            </span>

                            <span class="cc-card-category">
                                <?= cfCouponEsc($coupon["category"]) ?>
                            </span>

                        </div>

                        <div class="cc-card-brand-row">

                            <div class="cc-card-logo">
                                <img
                                    src="<?= cfCouponEsc(cfCouponLogo($coupon["domain"])) ?>"
                                    alt="<?= cfCouponEsc($coupon["store"]) ?> logo"
                                    loading="lazy"
                                    onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                                <span hidden>
                                    <?= cfCouponEsc(substr($coupon["store"], 0, 1)) ?>
                                </span>
                            </div>

                            <div class="cc-card-brand-name">
                                <span>POPULAR BRAND</span>
                                <h3><?= cfCouponEsc($coupon["store"]) ?></h3>
                            </div>

                        </div>

                        <div class="cc-card-discount">

                            <strong>
                                <?= cfCouponEsc($coupon["discount"]) ?>
                            </strong>

                            <span>OFF CODE</span>
                        </div>

                        <h4 class="cc-card-title">
                            <?= cfCouponEsc($coupon["title"]) ?>
                        </h4>

                        <p class="cc-card-description">
                            <?= cfCouponEsc($coupon["description"]) ?>
                        </p>

                        <!-- HOMEPAGE-STYLE REVEAL BUTTON -->
                        <div class="cc-card-footer">

                            <a
                                href="coupon.php?reveal=<?= (int)$coupon["id"] ?>"
                                class="cc-reveal-btn"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Reveal <?= cfCouponEsc($coupon["store"]) ?> demo coupon">

                                <span class="cc-code-peek" aria-hidden="true">
                                    CODE
                                </span>

                                <span class="cc-reveal-cover">
                                    <i class="bi bi-ticket-perforated"></i>
                                    Reveal Code
                                </span>

                            </a>

                            <div class="cc-card-meta">
                                <i class="bi bi-info-circle"></i>
                                Sample code • Not verified
                            </div>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

            <!-- EMPTY STATE -->
            <div class="cc-empty" id="ccEmpty" hidden>
                <i class="bi bi-search"></i>
                <h3>No Coupons Found</h3>
                <p>
                    Try another keyword, store or category.
                </p>

                <button type="button" id="ccEmptyReset">
                    Clear Filters
                </button>
            </div>

            <nav
                id="ccPagination"
                class="cc-pagination"
                aria-label="Coupon pagination">
            </nav>

        </div>
    </section>

    <!-- POPULAR STORES -->
    <section class="cc-stores-section">
        <div class="container">

            <div class="cc-section-header">

                <div>
                    <span class="cc-section-eyebrow">
                        <i class="bi bi-shop"></i>
                        EXPLORE YOUR FAVORITE BRANDS
                    </span>

                    <h2>
                        Popular Coupon <span>Stores</span>
                    </h2>

                    <p>
                        Find offers from popular shopping destinations.
                    </p>
                </div>

                <a href="stores.php" class="cc-view-all">
                    All Stores
                    <i class="bi bi-arrow-up-right"></i>
                </a>

            </div>

            <div class="cc-store-grid">

                <?php foreach ($cfCouponStores as $name => $domain): ?>

                    <a
                        href="coupon.php?store=<?= rawurlencode($name) ?>#ccLatest"
                        class="cc-store-card">

                        <div class="cc-store-logo">
                            <img
                                src="<?= cfCouponEsc(cfCouponLogo($domain)) ?>"
                                alt="<?= cfCouponEsc($name) ?> logo"
                                loading="lazy"
                                onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                            <span hidden>
                                <?= cfCouponEsc(substr($name, 0, 1)) ?>
                            </span>
                        </div>

                        <strong><?= cfCouponEsc($name) ?></strong>

                        <span>
                            Explore Coupons
                            <i class="bi bi-arrow-right"></i>
                        </span>

                    </a>

                <?php endforeach; ?>

            </div>
        </div>
    </section>

    <!-- PROMOTIONAL BANNER -->
    <section class="cc-promo-section">
        <div class="container">

            <div class="cc-promo-banner">

                <div>
                    <span>
                        <i class="bi bi-stars"></i>
                        COUPONDEALS
                    </span>

                    <h2>
                        More Brands.
                        <em>More Discoveries.</em>
                    </h2>

                    <p>
                        Discover popular shopping stores
                        and explore their latest collections.
                    </p>
                </div>

                <a href="stores.php">
                    Explore Stores
                    <i class="bi bi-arrow-up-right"></i>
                </a>

            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="cc-faq-section">
        <div class="container">

            <div class="cc-faq-grid">

                <div class="cc-faq-intro">

                    <span class="cc-section-eyebrow">
                        <i class="bi bi-question-circle"></i>
                        HELP & SUPPORT
                    </span>

                    <h2>
                        Frequently Asked
                        <span>Questions</span>
                    </h2>

                    <p>
                        Learn how coupon codes work and
                        how to shop more confidently.
                    </p>

                    <a href="contact.php">
                        Contact Support
                        <i class="bi bi-arrow-up-right"></i>
                    </a>

                </div>

                <div
                    class="accordion cc-accordion"
                    id="ccFaqAccordion">

                    <?php
                    $cfCouponFaqs = [
                        [
                            "How do I use a coupon code?",
                            "Click Reveal Code, copy the coupon, visit the retailer and enter the code at checkout."
                        ],
                        [
                            "Are these codes verified?",
                            "The current codes are demonstration examples. They have not been verified for real purchases."
                        ],
                        [
                            "Are coupons free to use?",
                            "Browsing CouponDeals is free. Individual retailers may apply their own purchase terms."
                        ],
                        [
                            "Why might a coupon not work?",
                            "Coupon codes can expire, have regional restrictions, or exclude specific products."
                        ],
                        [
                            "How can I find a store coupon?",
                            "Use the search box or store filter to view coupons associated with a particular brand."
                        ]
                    ];
                    ?>

                    <?php foreach ($cfCouponFaqs as $i => $faq): ?>

                        <div class="accordion-item">

                            <h3 class="accordion-header">

                                <button
                                    class="accordion-button <?= $i === 0 ? "" : "collapsed" ?>"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#ccFaqItem<?= $i ?>"
                                    aria-expanded="<?= $i === 0 ? "true" : "false" ?>">

                                    <?= cfCouponEsc($faq[0]) ?>

                                </button>
                            </h3>

                            <div
                                class="accordion-collapse collapse <?= $i === 0 ? "show" : "" ?>"
                                id="ccFaqItem<?= $i ?>"
                                data-bs-parent="#ccFaqAccordion">

                                <div class="accordion-body">
                                    <?= cfCouponEsc($faq[1]) ?>
                                </div>

                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </section>

</main>

<?php endif; ?>



<?php require_once __DIR__ . "/includes/footer.php"; ?>
