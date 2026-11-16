
<?php
/* =====================================================
   COUPONDEALS - PREMIUM PRODUCTS PAGE
   PHP 8+ / Bootstrap 5.3
===================================================== */

$pageTitle = "Explore Products | CouponFDeals";

if (!function_exists("cfProductEsc")) {
    function cfProductEsc($value): string {
        return htmlspecialchars(
            (string)($value ?? ""),
            ENT_QUOTES | ENT_SUBSTITUTE,
            "UTF-8"
        );
    }
}

/*
 * DEMO PRODUCTS
 * Prices and discounts are illustrative only.
 * Replace URLs and prices with verified product-specific
 * merchant data before using the site commercially.
 */

$cfProducts = [
    [
        "id" => 1,
        "name" => "Air Max Lifestyle Sneakers",
        "store" => "Nike",
        "category" => "Fashion",
        "price" => 84,
        "old_price" => 120,
        "image" => "https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.nike.com",
        "featured" => true
    ],
    [
        "id" => 2,
        "name" => "Premium Wireless Headphones",
        "store" => "Sony",
        "category" => "Electronics",
        "price" => 89,
        "old_price" => 129,
        "image" => "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.sony.com",
        "featured" => true
    ],
    [
        "id" => 3,
        "name" => "Classic Minimal Wrist Watch",
        "store" => "Fossil",
        "category" => "Accessories",
        "price" => 95,
        "old_price" => 145,
        "image" => "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.fossil.com",
        "featured" => true
    ],
    [
        "id" => 4,
        "name" => "Modern Lounge Accent Chair",
        "store" => "Wayfair",
        "category" => "Home",
        "price" => 139,
        "old_price" => 199,
        "image" => "https://images.unsplash.com/photo-1598300053653-a5a962921f10?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.wayfair.com",
        "featured" => true
    ],
    [
        "id" => 5,
        "name" => "Professional Mirrorless Camera",
        "store" => "Canon",
        "category" => "Electronics",
        "price" => 599,
        "old_price" => 749,
        "image" => "https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.usa.canon.com",
        "featured" => true
    ],
    [
        "id" => 6,
        "name" => "Premium Skincare Essentials Set",
        "store" => "Sephora",
        "category" => "Beauty",
        "price" => 42,
        "old_price" => 60,
        "image" => "https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.sephora.com",
        "featured" => false
    ],
    [
        "id" => 7,
        "name" => "Everyday Streetwear Sneakers",
        "store" => "Adidas",
        "category" => "Fashion",
        "price" => 65,
        "old_price" => 95,
        "image" => "https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.adidas.com",
        "featured" => false
    ],
    [
        "id" => 8,
        "name" => "Minimal Ceramic Table Lamp",
        "store" => "IKEA",
        "category" => "Home",
        "price" => 39,
        "old_price" => 59,
        "image" => "https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.ikea.com",
        "featured" => false
    ],
    [
        "id" => 9,
        "name" => "Smart Fitness Activity Watch",
        "store" => "Samsung",
        "category" => "Electronics",
        "price" => 129,
        "old_price" => 179,
        "image" => "https://images.unsplash.com/photo-1579586337278-3befd40fd17a?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.samsung.com",
        "featured" => false
    ],
    [
        "id" => 10,
        "name" => "Elegant Everyday Shoulder Bag",
        "store" => "Zara",
        "category" => "Fashion",
        "price" => 49,
        "old_price" => 79,
        "image" => "https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.zara.com",
        "featured" => false
    ],
    [
        "id" => 11,
        "name" => "Luxury Everyday Fragrance",
        "store" => "Sephora",
        "category" => "Beauty",
        "price" => 55,
        "old_price" => 85,
        "image" => "https://images.unsplash.com/photo-1541643600914-78b084683601?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.sephora.com",
        "featured" => false
    ],
    [
        "id" => 12,
        "name" => "Portable Bluetooth Speaker",
        "store" => "Sony",
        "category" => "Electronics",
        "price" => 69,
        "old_price" => 99,
        "image" => "https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.sony.com",
        "featured" => false
    ],
    [
        "id" => 13,
        "name" => "Modern Professional Office Desk",
        "store" => "IKEA",
        "category" => "Home",
        "price" => 179,
        "old_price" => 249,
        "image" => "https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.ikea.com",
        "featured" => false
    ],
    [
        "id" => 14,
        "name" => "Lightweight Running Shoes",
        "store" => "Nike",
        "category" => "Sports",
        "price" => 72,
        "old_price" => 110,
        "image" => "https://images.unsplash.com/photo-1552674605-db6ffd4facb5?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.nike.com",
        "featured" => false
    ],
    [
        "id" => 15,
        "name" => "Wireless Gaming Headset",
        "store" => "Sony",
        "category" => "Gaming",
        "price" => 79,
        "old_price" => 119,
        "image" => "https://images.unsplash.com/photo-1599669454699-248893623440?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.sony.com",
        "featured" => false
    ],
    [
        "id" => 16,
        "name" => "Classic Leather Accessories",
        "store" => "Fossil",
        "category" => "Accessories",
        "price" => 45,
        "old_price" => 68,
        "image" => "https://images.unsplash.com/photo-1547949003-9792a18a2601?w=750&auto=format&fit=crop&q=85",
        "url" => "https://www.fossil.com",
        "featured" => false
    ]
];

$cfProductStores = array_values(array_unique(
    array_column($cfProducts, "store")
));

sort($cfProductStores, SORT_NATURAL | SORT_FLAG_CASE);

$cfProductCategories = array_values(array_unique(
    array_column($cfProducts, "category")
));

sort($cfProductCategories, SORT_NATURAL | SORT_FLAG_CASE);

function cfProductDiscount(array $product): int {
    $old = (float)($product["old_price"] ?? 0);
    $price = (float)($product["price"] ?? 0);

    return ($old > $price && $old > 0)
        ? (int)round((($old - $price) / $old) * 100)
        : 0;
}

require_once __DIR__ . "/includes/header.php";
?>

<main class="prd-page" id="prdPage">

    <!-- =========================================
         PAGE HEADER
    ========================================== -->

    <section class="prd-heading-section">

        <div class="container">

            <nav class="prd-breadcrumb" aria-label="Breadcrumb">
                <a href="index.php">
                    <i class="bi bi-house-door"></i>
                    Home
                </a>
                <i class="bi bi-chevron-right"></i>
                <span>Products</span>
            </nav>

            <div class="prd-page-heading">

                <div class="prd-heading-content">

                    <span class="prd-eyebrow">
                        <i class="bi bi-bag-heart"></i>
                        PRODUCT DISCOVERY
                    </span>

                    <h1>
                        Discover Products
                        <span>You'll Love.</span>
                    </h1>

                    <p>
                        Explore a curated product collection across
                        fashion, electronics, beauty, home and more.
                        Find your next favorite shopping discovery.
                    </p>

                </div>

                <div class="prd-heading-decoration" aria-hidden="true">
                    <i class="bi bi-bag-check"></i>
                </div>

            </div>

        </div>

    </section>

    <!-- =========================================
         MAIN PRODUCTS LAYOUT
    ========================================== -->

    <section class="prd-catalog-section" id="prdCatalog">

        <div class="container">

            <div class="prd-catalog-top">

                <div>
                    <span class="prd-section-eyebrow">
                        EXPLORE THE COLLECTION
                    </span>

                    <h2>
                        All <span>Products</span>
                    </h2>

                    <p>
                        Browse products from popular shopping brands.
                    </p>
                </div>

                <div class="prd-result-summary">
                    <span id="prdResultCount" aria-live="polite">
                        <?= count($cfProducts) ?> Products
                    </span>
                </div>

            </div>

            <!-- FILTER AND PRODUCT COLUMNS -->

            <div class="prd-layout">

                <!-- =====================================
                     SIDEBAR FILTERS
                ====================================== -->

                <aside class="prd-sidebar" id="prdSidebar">

                    <div class="prd-sidebar-header">
                        <div>
                            <i class="bi bi-sliders"></i>
                            <h3>Filters</h3>
                        </div>

                        <button type="button" id="prdSidebarReset">
                            Clear All
                        </button>
                    </div>

                    <!-- SEARCH -->

                    <div class="prd-filter-group">

                        <label class="prd-filter-title" for="prdSearch">
                            Search Products
                        </label>

                        <div class="prd-search-box">
                            <i class="bi bi-search"></i>

                            <input
                                type="search"
                                id="prdSearch"
                                placeholder="Search products..."
                                autocomplete="off">
                        </div>

                    </div>

                    <!-- CATEGORIES -->

                    <div class="prd-filter-group">

                        <h4 class="prd-filter-title">
                            Categories
                        </h4>

                        <div class="prd-category-options"
                             id="prdCategoryOptions">

                            <button type="button"
                                    class="prd-category-btn active"
                                    data-category=""
                                    aria-pressed="true">
                                <span>All Categories</span>
                                <i class="bi bi-chevron-right"></i>
                            </button>

                            <?php foreach ($cfProductCategories as $cfCategory): ?>

                                <button
                                    type="button"
                                    class="prd-category-btn"
                                    data-category="<?= cfProductEsc($cfCategory) ?>"
                                    aria-pressed="false">

                                    <span><?= cfProductEsc($cfCategory) ?></span>
                                    <i class="bi bi-chevron-right"></i>

                                </button>

                            <?php endforeach; ?>

                        </div>

                    </div>

                    <!-- STORE -->

                    <div class="prd-filter-group">

                        <label class="prd-filter-title" for="prdStore">
                            Stores
                        </label>

                        <select id="prdStore" class="prd-filter-select">
                            <option value="">All Stores</option>

                            <?php foreach ($cfProductStores as $cfStore): ?>

                                <option value="<?= cfProductEsc($cfStore) ?>">
                                    <?= cfProductEsc($cfStore) ?>
                                </option>

                            <?php endforeach; ?>
                        </select>

                    </div>

                    <!-- PRICE -->

                    <div class="prd-filter-group">

                        <h4 class="prd-filter-title">
                            Price Range
                        </h4>

                        <div class="prd-price-values">
                            <span>$0</span>
                            <strong id="prdMaxPriceValue">$750</strong>
                        </div>

                        <input
                            id="prdMaxPrice"
                            class="prd-price-range"
                            type="range"
                            min="0"
                            max="750"
                            step="10"
                            value="750"
                            aria-label="Maximum product price">

                        <p class="prd-filter-hint">
                            Adjust to your shopping budget.
                        </p>

                    </div>

                    <!-- DISCOUNT -->

                    <div class="prd-filter-group">

                        <h4 class="prd-filter-title">
                            Discount
                        </h4>

                        <label class="prd-checkbox-label">
                            <input type="checkbox" id="prdDiscountOnly">
                            <span>Discounted products only</span>
                        </label>

                    </div>

                </aside>

                <!-- =====================================
                     PRODUCT RESULTS
                ====================================== -->

                <div class="prd-results">

                    <!-- SORT TOOLBAR -->

                    <div class="prd-toolbar">

                        <div class="prd-toolbar-left">
                            <button
                                type="button"
                                class="prd-mobile-filter-btn"
                                id="prdMobileFilters">

                                <i class="bi bi-sliders"></i>
                                Filters
                            </button>

                            <span id="prdShowingText">
                                Showing products
                            </span>
                        </div>

                        <div class="prd-toolbar-right">

                            <label for="prdSort">
                                Sort by
                            </label>

                            <select id="prdSort">
                                <option value="featured">Featured</option>
                                <option value="low">Price: Low to High</option>
                                <option value="high">Price: High to Low</option>
                                <option value="discount">Biggest Discount</option>
                                <option value="az">Name A–Z</option>
                            </select>

                        </div>

                    </div>

                    <!-- PRODUCT GRID -->

                    <div class="prd-grid" id="prdGrid">

                        <?php foreach ($cfProducts as $cfIndex => $cfProduct): ?>

                            <?php
                            $cfDiscount = cfProductDiscount($cfProduct);
                            ?>

                            <article
                                class="prd-card"
                                data-name="<?= cfProductEsc($cfProduct["name"]) ?>"
                                data-store="<?= cfProductEsc($cfProduct["store"]) ?>"
                                data-category="<?= cfProductEsc($cfProduct["category"]) ?>"
                                data-price="<?= cfProductEsc($cfProduct["price"]) ?>"
                                data-discount="<?= $cfDiscount ?>"
                                data-featured="<?= $cfProduct["featured"] ? "1" : "0" ?>"
                                data-order="<?= $cfIndex ?>">

                                <div class="prd-card-image">

                                    <img
                                        src="<?= cfProductEsc($cfProduct["image"]) ?>"
                                        alt="<?= cfProductEsc($cfProduct["name"]) ?>"
                                        loading="lazy">

                                    <?php if ($cfDiscount > 0): ?>
                                        <span class="prd-discount-badge">
                                            -<?= $cfDiscount ?>%
                                        </span>
                                    <?php endif; ?>

                                    <span class="prd-image-store">
                                        <?= cfProductEsc($cfProduct["store"]) ?>
                                    </span>

                                </div>

                                <div class="prd-card-content">

                                    <span class="prd-card-store">
                                        From: <?= cfProductEsc($cfProduct["store"]) ?>
                                    </span>

                                    <h3>
                                        <?= cfProductEsc($cfProduct["name"]) ?>
                                    </h3>

                                    <div class="prd-card-price">

                                        <strong>
                                            $<?= number_format($cfProduct["price"], 2) ?>
                                        </strong>

                                        <?php if ($cfProduct["old_price"] > $cfProduct["price"]): ?>
                                            <del>
                                                $<?= number_format($cfProduct["old_price"], 2) ?>
                                            </del>
                                        <?php endif; ?>

                                    </div>

                                    <a
                                        href="<?= cfProductEsc($cfProduct["url"]) ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="prd-card-btn">

                                        Go To Store
                                        <i class="bi bi-arrow-up-right"></i>

                                    </a>

                                </div>

                            </article>

                        <?php endforeach; ?>

                    </div>

                    <!-- NO RESULTS -->

                    <div class="prd-empty" id="prdEmpty" hidden>
                        <i class="bi bi-search"></i>
                        <h3>No Products Found</h3>
                        <p>
                            Try another keyword or change your filters.
                        </p>

                        <button type="button" id="prdEmptyReset">
                            Clear Filters
                        </button>
                    </div>

                    <!-- PAGINATION -->

                    <nav class="prd-pagination"
                         id="prdPagination"
                         aria-label="Product pagination">
                    </nav>

                </div>

            </div>

        </div>

    </section>

    <!-- MOBILE FILTER OVERLAY -->

    <button type="button"
            class="prd-mobile-backdrop"
            id="prdMobileBackdrop"
            aria-label="Close filters"
            hidden>
    </button>

</main>

<script src="assets/js/products.js?v=1" defer></script>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
