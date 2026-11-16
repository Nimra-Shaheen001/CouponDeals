
<?php
/* ======================================================
   COUPONDEALS - MODERN DEALS DIRECTORY
   Bootstrap 5.3 + PHP + Separate CSS / JS
====================================================== */

$pageTitle = "Today's Best Deals | CouponDeals";

if (!function_exists("cfDealE")) {
    function cfDealE($value): string
    {
        return htmlspecialchars(
            (string)($value ?? ""),
            ENT_QUOTES | ENT_SUBSTITUTE,
            "UTF-8"
        );
    }
}

/*
|--------------------------------------------------------------------------
| SAMPLE PRODUCTS
|--------------------------------------------------------------------------
| Prices, old prices and discounts are illustrative.
| Replace with verified product-specific offers before
| publishing this as a live deal directory.
|
| Each record:
| id, title, store, category, image, price, old price,
| product URL and featured flag.
|--------------------------------------------------------------------------
*/

$cfDeals = [
    [
        "id" => 1,
        "title" => "Air Max Lifestyle Sneakers",
        "store" => "Nike",
        "category" => "Fashion",
        "image" => "https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=700&auto=format&fit=crop&q=85",
        "price" => 84,
        "old_price" => 120,
        "url" => "https://www.nike.com",
        "featured" => true
    ],
    [
        "id" => 2,
        "title" => "Wireless Over-Ear Headphones",
        "store" => "Sony",
        "category" => "Electronics",
        "image" => "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=700&auto=format&fit=crop&q=85",
        "price" => 89,
        "old_price" => 129,
        "url" => "https://www.sony.com",
        "featured" => true
    ],
    [
        "id" => 3,
        "title" => "Classic Minimal Wrist Watch",
        "store" => "Fossil",
        "category" => "Accessories",
        "image" => "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=700&auto=format&fit=crop&q=85",
        "price" => 95,
        "old_price" => 145,
        "url" => "https://www.fossil.com",
        "featured" => true
    ],
    [
        "id" => 4,
        "title" => "Comfortable Modern Lounge Chair",
        "store" => "Wayfair",
        "category" => "Home",
        "image" => "https://images.unsplash.com/photo-1598300053653-a5a962921f10?w=700&auto=format&fit=crop&q=85",
        "price" => 139,
        "old_price" => 199,
        "url" => "https://www.wayfair.com",
        "featured" => true
    ],
    [
        "id" => 5,
        "title" => "Professional Mirrorless Camera",
        "store" => "Canon",
        "category" => "Electronics",
        "image" => "https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=700&auto=format&fit=crop&q=85",
        "price" => 599,
        "old_price" => 749,
        "url" => "https://www.usa.canon.com",
        "featured" => true
    ],
    [
        "id" => 6,
        "title" => "Premium Skincare Essentials",
        "store" => "Sephora",
        "category" => "Beauty",
        "image" => "https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=700&auto=format&fit=crop&q=85",
        "price" => 42,
        "old_price" => 60,
        "url" => "https://www.sephora.com",
        "featured" => true
    ],
    [
        "id" => 7,
        "title" => "Everyday Streetwear Sneakers",
        "store" => "Adidas",
        "category" => "Fashion",
        "image" => "https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?w=700&auto=format&fit=crop&q=85",
        "price" => 65,
        "old_price" => 95,
        "url" => "https://www.adidas.com",
        "featured" => false
    ],
    [
        "id" => 8,
        "title" => "Warm Ceramic Table Lamp",
        "store" => "IKEA",
        "category" => "Home",
        "image" => "https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=700&auto=format&fit=crop&q=85",
        "price" => 39,
        "old_price" => 59,
        "url" => "https://www.ikea.com",
        "featured" => false
    ],
    [
        "id" => 9,
        "title" => "Smart Fitness Activity Watch",
        "store" => "Samsung",
        "category" => "Electronics",
        "image" => "https://images.unsplash.com/photo-1579586337278-3befd40fd17a?w=700&auto=format&fit=crop&q=85",
        "price" => 129,
        "old_price" => 179,
        "url" => "https://www.samsung.com",
        "featured" => false
    ],
    [
        "id" => 10,
        "title" => "Elegant Everyday Shoulder Bag",
        "store" => "Zara",
        "category" => "Fashion",
        "image" => "https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=700&auto=format&fit=crop&q=85",
        "price" => 49,
        "old_price" => 79,
        "url" => "https://www.zara.com",
        "featured" => false
    ],
    [
        "id" => 11,
        "title" => "Luxury Daily Fragrance",
        "store" => "Sephora",
        "category" => "Beauty",
        "image" => "https://images.unsplash.com/photo-1541643600914-78b084683601?w=700&auto=format&fit=crop&q=85",
        "price" => 55,
        "old_price" => 85,
        "url" => "https://www.sephora.com",
        "featured" => false
    ],
    [
        "id" => 12,
        "title" => "Portable Bluetooth Speaker",
        "store" => "Sony",
        "category" => "Electronics",
        "image" => "https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=700&auto=format&fit=crop&q=85",
        "price" => 69,
        "old_price" => 99,
        "url" => "https://www.sony.com",
        "featured" => false
    ],
    [
        "id" => 13,
        "title" => "Clean Design Office Desk",
        "store" => "IKEA",
        "category" => "Home",
        "image" => "https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=700&auto=format&fit=crop&q=85",
        "price" => 179,
        "old_price" => 249,
        "url" => "https://www.ikea.com",
        "featured" => false
    ],
    [
        "id" => 14,
        "title" => "Modern Sports Running Shoes",
        "store" => "Nike",
        "category" => "Sports",
        "image" => "https://images.unsplash.com/photo-1552674605-db6ffd4facb5?w=700&auto=format&fit=crop&q=85",
        "price" => 72,
        "old_price" => 110,
        "url" => "https://www.nike.com",
        "featured" => false
    ],
    [
        "id" => 15,
        "title" => "Wireless Gaming Headphones",
        "store" => "Sony",
        "category" => "Gaming",
        "image" => "https://images.unsplash.com/photo-1599669454699-248893623440?w=700&auto=format&fit=crop&q=85",
        "price" => 79,
        "old_price" => 119,
        "url" => "https://www.sony.com",
        "featured" => false
    ],
    [
        "id" => 16,
        "title" => "Timeless Leather Accessories",
        "store" => "Fossil",
        "category" => "Accessories",
        "image" => "https://images.unsplash.com/photo-1547949003-9792a18a2601?w=700&auto=format&fit=crop&q=85",
        "price" => 45,
        "old_price" => 68,
        "url" => "https://www.fossil.com",
        "featured" => false
    ]
];

/* Store directory */

$cfStoreDomains = [
    "Nike" => "nike.com",
    "Adidas" => "adidas.com",
    "Sony" => "sony.com",
    "Fossil" => "fossil.com",
    "Wayfair" => "wayfair.com",
    "Canon" => "canon.com",
    "Sephora" => "sephora.com",
    "IKEA" => "ikea.com",
    "Samsung" => "samsung.com",
    "Zara" => "zara.com"
];

/* Category directory */

$cfDealCategories = [
    "Fashion" => "bi-bag",
    "Electronics" => "bi-laptop",
    "Beauty" => "bi-stars",
    "Home" => "bi-house",
    "Accessories" => "bi-watch",
    "Sports" => "bi-trophy",
    "Gaming" => "bi-controller"
];

/* Real counts from demo dataset */

$cfStoreNames = array_values(array_unique(
    array_column($cfDeals, "store")
));

sort($cfStoreNames, SORT_NATURAL | SORT_FLAG_CASE);

$cfCategoryNames = array_values(array_unique(
    array_column($cfDeals, "category")
));

sort($cfCategoryNames, SORT_NATURAL | SORT_FLAG_CASE);

$cfDiscounts = [];

foreach ($cfDeals as $cfDeal) {
    $old = (float)$cfDeal["old_price"];
    $new = (float)$cfDeal["price"];

    if ($old > $new && $old > 0) {
        $cfDiscounts[] = ($old - $new) / $old * 100;
    }
}

$cfAvgDiscount = count($cfDiscounts)
    ? round(array_sum($cfDiscounts) / count($cfDiscounts))
    : 0;

function cfDealDiscount(array $deal): int
{
    $old = (float)($deal["old_price"] ?? 0);
    $new = (float)($deal["price"] ?? 0);

    return $old > 0 && $new < $old
        ? (int)round((($old - $new) / $old) * 100)
        : 0;
}

require_once __DIR__ . "/includes/header.php";
?>

<main class="dl-page" id="dlPage">

    <!-- =====================================
         HERO + STATISTICS
    ====================================== -->

    <section class="dl-hero">

        <div class="container">

            <nav class="dl-breadcrumb" aria-label="Breadcrumb">
                <a href="index.php">
                    <i class="bi bi-house-door"></i>
                    Home
                </a>

                <i class="bi bi-chevron-right"></i>
                <span>Best Deals</span>
            </nav>

            <div class="dl-hero-main">

                <span class="dl-eyebrow">
                    <i class="bi bi-stars"></i>
                    DISCOVER YOUR NEXT FAVORITE FIND
                </span>

                <h1>
                    Today's Best Deals
                    <span>& Biggest Savings</span>
                </h1>

                <p>
                    Explore products from your favorite brands.
                    Browse fashion, electronics, beauty, home,
                    accessories and more in one place.
                </p>

                <form id="dlHeroForm" class="dl-hero-search">

                    <i class="bi bi-search"></i>

                    <input
                        type="search"
                        id="dlHeroInput"
                        placeholder="Search products, stores and categories..."
                        aria-label="Search shopping deals">

                    <button type="submit">
                        Find Deals
                        <i class="bi bi-arrow-right"></i>
                    </button>

                </form>

                <small class="dl-demo-label">
                    <i class="bi bi-info-circle"></i>
                    Product data shown here is for design demonstration.
                </small>

            </div>

            <div class="dl-stats">

                <div class="dl-stat">
                    <i class="bi bi-tags"></i>
                    <div>
                        <strong><?= count($cfDeals) ?></strong>
                        <span>Product Listings</span>
                    </div>
                </div>

                <div class="dl-stat">
                    <i class="bi bi-shop-window"></i>
                    <div>
                        <strong><?= count($cfStoreNames) ?></strong>
                        <span>Stores</span>
                    </div>
                </div>

                <div class="dl-stat">
                    <i class="bi bi-grid"></i>
                    <div>
                        <strong><?= count($cfCategoryNames) ?></strong>
                        <span>Categories</span>
                    </div>
                </div>

                <div class="dl-stat">
                    <i class="bi bi-percent"></i>
                    <div>
                        <strong><?= $cfAvgDiscount ?>%</strong>
                        <span>Avg. Demo Discount</span>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <!-- =====================================
         TOP STORES
    ====================================== -->

    <section class="dl-section dl-stores-section">

        <div class="container">

            <div class="dl-section-head">

                <div>
                    <span class="dl-section-kicker">
                        EXPLORE YOUR FAVORITE BRANDS
                    </span>
                    <h2>Top <span>Stores</span></h2>
                </div>

                <a href="stores.php" class="dl-section-link">
                    All Stores
                    <i class="bi bi-arrow-up-right"></i>
                </a>

            </div>

            <div class="dl-stores-grid">

                <?php foreach ($cfStoreNames as $cfName): ?>

                    <?php
                    $cfDomain = $cfStoreDomains[$cfName] ?? "";
                    $cfLogo = $cfDomain
                        ? "https://www.google.com/s2/favicons?domain=" .
                          rawurlencode($cfDomain) . "&sz=128"
                        : "";
                    ?>

                    <a
                        href="deals.php?store=<?= rawurlencode($cfName) ?>#dlAllDeals"
                        class="dl-store-item">

                        <span class="dl-store-logo">

                            <?php if ($cfLogo): ?>
                                <img
                                    src="<?= cfDealE($cfLogo) ?>"
                                    alt="<?= cfDealE($cfName) ?> logo"
                                    loading="lazy"
                                    onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                                <b hidden>
                                    <?= cfDealE(substr($cfName, 0, 1)) ?>
                                </b>
                            <?php else: ?>
                                <b><?= cfDealE(substr($cfName, 0, 1)) ?></b>
                            <?php endif; ?>

                        </span>

                        <strong><?= cfDealE($cfName) ?></strong>

                    </a>

                <?php endforeach; ?>

            </div>

        </div>

    </section>

    <!-- =====================================
         HOT RIGHT NOW
    ====================================== -->

    <section class="dl-section dl-hot-section">

        <div class="container">

            <div class="dl-section-head">

                <div>
                    <span class="dl-section-kicker">
                        FEATURED COLLECTION
                    </span>
                    <h2>Hot <span>Right Now</span></h2>
                </div>

                <div class="dl-slider-controls">
                    <button type="button" id="dlHotPrev"
                            aria-label="Previous products">
                        <i class="bi bi-arrow-left"></i>
                    </button>

                    <button type="button" id="dlHotNext"
                            aria-label="Next products">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>

            </div>

            <div class="dl-hot-track" id="dlHotTrack">

                <?php foreach ($cfDeals as $cfDeal): ?>
                    <?php if (!$cfDeal["featured"]) continue; ?>

                    <article class="dl-product-card dl-hot-card">

                        <div class="dl-product-image">

                            <img
                                src="<?= cfDealE($cfDeal["image"]) ?>"
                                alt="<?= cfDealE($cfDeal["title"]) ?>"
                                loading="lazy">

                            <?php if (cfDealDiscount($cfDeal) > 0): ?>
                                <span class="dl-discount">
                                    -<?= cfDealDiscount($cfDeal) ?>%
                                </span>
                            <?php endif; ?>

                        </div>

                        <div class="dl-product-content">

                            <span class="dl-product-store">
                                From: <?= cfDealE($cfDeal["store"]) ?>
                            </span>

                            <h3>
                                <?= cfDealE($cfDeal["title"]) ?>
                            </h3>

                            <div class="dl-prices">
                                <strong>
                                    $<?= number_format($cfDeal["price"], 2) ?>
                                </strong>

                                <del>
                                    $<?= number_format($cfDeal["old_price"], 2) ?>
                                </del>
                            </div>

                            <a href="<?= cfDealE($cfDeal["url"]) ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="dl-product-btn">

                                Visit Store
                                <i class="bi bi-arrow-up-right"></i>

                            </a>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

        </div>

    </section>

    <!-- =====================================
         SHOP BY CATEGORIES
    ====================================== -->

    <section class="dl-section dl-category-section">

        <div class="container">

            <div class="dl-section-head">

                <div>
                    <span class="dl-section-kicker">
                        DISCOVER BY INTEREST
                    </span>

                    <h2>Shop by <span>Categories</span></h2>
                </div>

                <a href="categories.php" class="dl-section-link">
                    See All
                    <i class="bi bi-arrow-up-right"></i>
                </a>

            </div>

            <div class="dl-categories-grid">

                <?php foreach ($cfDealCategories as $cfName => $cfIcon): ?>

                    <a
                        href="deals.php?category=<?= rawurlencode($cfName) ?>#dlAllDeals"
                        class="dl-category-item">

                        <span>
                            <i class="bi <?= cfDealE($cfIcon) ?>"></i>
                        </span>

                        <strong><?= cfDealE($cfName) ?></strong>

                        <i class="bi bi-arrow-up-right"></i>

                    </a>

                <?php endforeach; ?>

            </div>

        </div>

    </section>

    <!-- =====================================
         ALL DEALS
    ====================================== -->

    <section class="dl-section dl-all-section" id="dlAllDeals">

        <div class="container">

            <div class="dl-section-head">

                <div>
                    <span class="dl-section-kicker">
                        EXPLORE PRODUCTS
                    </span>
                    <h2>All <span>Deals</span></h2>
                </div>

                <span class="dl-result-count"
                      id="dlResultCount"
                      aria-live="polite">
                    <?= count($cfDeals) ?> Products
                </span>

            </div>

            <!-- Filters -->

            <div class="dl-filter-bar">

                <label class="dl-search-field">
                    <i class="bi bi-search"></i>

                    <input
                        id="dlSearch"
                        type="search"
                        placeholder="Search products..."
                        aria-label="Search products">
                </label>

                <select id="dlStore" aria-label="Filter stores">
                    <option value="">All Stores</option>

                    <?php foreach ($cfStoreNames as $cfName): ?>
                        <option value="<?= cfDealE($cfName) ?>">
                            <?= cfDealE($cfName) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select id="dlCategory" aria-label="Filter categories">
                    <option value="">All Categories</option>

                    <?php foreach ($cfCategoryNames as $cfName): ?>
                        <option value="<?= cfDealE($cfName) ?>">
                            <?= cfDealE($cfName) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select id="dlSort" aria-label="Sort products">
                    <option value="featured">Featured First</option>
                    <option value="low">Price: Low to High</option>
                    <option value="high">Price: High to Low</option>
                    <option value="discount">Highest Discount</option>
                    <option value="az">Product A–Z</option>
                </select>

                <button type="button"
                        class="dl-reset"
                        id="dlReset">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </button>

            </div>

            <!-- Product grid -->

            <div class="dl-product-grid" id="dlProductGrid">

                <?php foreach ($cfDeals as $cfIndex => $cfDeal): ?>

                    <article
                        class="dl-product-card dl-list-card"
                        data-id="<?= (int)$cfDeal["id"] ?>"
                        data-title="<?= cfDealE($cfDeal["title"]) ?>"
                        data-store="<?= cfDealE($cfDeal["store"]) ?>"
                        data-category="<?= cfDealE($cfDeal["category"]) ?>"
                        data-price="<?= cfDealE($cfDeal["price"]) ?>"
                        data-discount="<?= cfDealDiscount($cfDeal) ?>"
                        data-featured="<?= $cfDeal["featured"] ? "1" : "0" ?>"
                        data-order="<?= $cfIndex ?>">

                        <div class="dl-product-image">

                            <img
                                src="<?= cfDealE($cfDeal["image"]) ?>"
                                alt="<?= cfDealE($cfDeal["title"]) ?>"
                                loading="lazy">

                            <?php if (cfDealDiscount($cfDeal) > 0): ?>
                                <span class="dl-discount">
                                    -<?= cfDealDiscount($cfDeal) ?>%
                                </span>
                            <?php endif; ?>

                        </div>

                        <div class="dl-product-content">

                            <span class="dl-product-store">
                                From: <?= cfDealE($cfDeal["store"]) ?>
                            </span>

                            <h3><?= cfDealE($cfDeal["title"]) ?></h3>

                            <div class="dl-prices">

                                <strong>
                                    $<?= number_format($cfDeal["price"], 2) ?>
                                </strong>

                                <del>
                                    $<?= number_format($cfDeal["old_price"], 2) ?>
                                </del>

                            </div>

                            <a href="<?= cfDealE($cfDeal["url"]) ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="dl-product-btn">

                                Go To Store
                                <i class="bi bi-arrow-up-right"></i>

                            </a>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

            <div class="dl-empty" id="dlEmpty" hidden>

                <i class="bi bi-search"></i>
                <h3>No products found</h3>
                <p>Try another search or change your filters.</p>

                <button type="button" id="dlEmptyReset">
                    Clear Filters
                </button>

            </div>

            <nav class="dl-pagination"
                 id="dlPagination"
                 aria-label="Product pagination">
            </nav>

        </div>

    </section>

    <!-- =====================================
         FAQ
    ====================================== -->

    <section class="dl-section dl-faq-section">

        <div class="container">

            <div class="dl-section-head">
                <div>
                    <span class="dl-section-kicker">
                        HELP & SUPPORT
                    </span>
                    <h2>Frequently Asked <span>Questions</span></h2>
                </div>
            </div>

            <?php
            $cfFaqs = [
                [
                    "What types of shopping deals are listed?",
                    "You can browse products across fashion, technology, home, beauty, sports and accessories."
                ],
                [
                    "Do I need a coupon code to use a deal?",
                    "Not necessarily. Some offers are applied directly at the store, while others require a coupon code."
                ],
                [
                    "Are the product prices updated automatically?",
                    "Not yet. This demonstration uses sample data. Live retailer prices require a database or product feed."
                ],
                [
                    "Can prices and offers change?",
                    "Yes. Retailers may change prices and availability at any time. Always confirm the current price before purchasing."
                ]
            ];
            ?>

            <div class="accordion dl-faq-accordion" id="dlFaqAccordion">

                <?php foreach ($cfFaqs as $cfFaqIndex => $cfFaq): ?>

                    <div class="accordion-item">

                        <h3 class="accordion-header">

                            <button
                                class="accordion-button <?= $cfFaqIndex ? 'collapsed' : '' ?>"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#dlFaq<?= $cfFaqIndex ?>"
                                aria-controls="dlFaq<?= $cfFaqIndex ?>"
                                aria-expanded="<?= $cfFaqIndex ? 'false' : 'true' ?>">

                                <?= cfDealE($cfFaq[0]) ?>

                            </button>

                        </h3>

                        <div
                            id="dlFaq<?= $cfFaqIndex ?>"
                            class="accordion-collapse collapse <?= !$cfFaqIndex ? 'show' : '' ?>"
                            data-bs-parent="#dlFaqAccordion">

                            <div class="accordion-body">
                                <?= cfDealE($cfFaq[1]) ?>
                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </section>

</main>

<script src="assets/js/deals.js?v=3" defer></script>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
