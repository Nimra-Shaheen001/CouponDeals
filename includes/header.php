
<?php
/**
 * CouponDeals - Shared Website Header
 * Bootstrap 5.3 | Responsive Navigation
 */

$siteName = "CouponDeals";
$pageTitle = $pageTitle ?? "CouponDeals | Coupons & Deals";
$pageDescription = $pageDescription ??
    "Discover the latest coupons, promo codes and exclusive shopping deals at CouponDeals.";

$currentPage = basename($_SERVER["SCRIPT_NAME"] ?? "index.php");

if (!function_exists("cfEscape")) {
    function cfEscape($value): string
    {
        return htmlspecialchars(
            is_scalar($value) || $value === null
                ? (string) ($value ?? "")
                : "",
            ENT_QUOTES | ENT_SUBSTITUTE,
            "UTF-8"
        );
    }
}

/* Main navigation */

$navLinks = [
    ["Home", "index.php"],
    ["Stores", "stores.php"],
    ["Coupons", "coupon.php"],
    ["Deals", "deals.php"],
    ["Products", "products.php"],
    ["Blog", "blog.php"]
];

/* Category navigation */

$cfHeaderCategories = [
    ["Fashion & Clothing", "fashion"],
    ["Electronics & Gadgets", "electronics"],
    ["Beauty & Personal Care", "beauty"],
    ["Home & Garden", "home"],
    ["Shoes & Footwear", "footwear"],
    ["Health & Wellness", "health"],
    ["Travel & Hotels", "travel"],
    ["Sports & Outdoors", "sports"],
    ["Food & Restaurants", "food"],
    ["Baby & Kids", "baby"],
    ["Jewelry & Watches", "jewelry"],
    ["Automotive", "automotive"],
    ["Books & Education", "education"],
    ["Pet Supplies", "pets"],
    ["Software & Apps", "software"],
    ["Web Hosting & Domains", "hosting"],
    ["Gaming & Entertainment", "gaming"],
    ["Gifts & Flowers", "gifts"],
    ["Office Supplies", "office"],
    ["Furniture & Decor", "furniture"],
    ["Mobile Accessories", "mobile-accessories"],
    ["Groceries & Essentials", "groceries"]
];

/* Logo and stylesheet paths */

$cfBase = "/coupon/";
$logoPath = $cfBase . "assets/images/logo (2).png";

$pageStyles = [
    "stores.php" => "stores.css?v=7",
    "categories.php" => "categories.css?v=5",
    "deals.php" => "deals.css?v=1",
    "products.php" => "products.css?v=1",
    "blog.php" => "blog.css?v=5"
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title><?= cfEscape($pageTitle) ?></title>

    <meta
        name="description"
        content="<?= cfEscape($pageDescription) ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Shared CSS -->
    <link
        rel="stylesheet"
        href="<?= cfEscape($cfBase) ?>assets/css/style.css?v=40">

    <link
        rel="stylesheet"
        href="<?= cfEscape($cfBase) ?>assets/css/footer.css?v=22">

    <link
        rel="stylesheet"
        href="<?= cfEscape($cfBase) ?>assets/css/header.css?v=61">

    <!-- Page-specific CSS -->
    <?php if (isset($pageStyles[$currentPage])): ?>
        <link
            rel="stylesheet"
            href="<?= cfEscape($cfBase . 'assets/css/' . $pageStyles[$currentPage]) ?>">
    <?php endif; ?>

    <!-- Shared page styling -->
    <link
        rel="stylesheet"
        href="<?= cfEscape($cfBase) ?>assets/css/pages.css?v=131">

</head>

<body>

<!-- ==========================================
     ANNOUNCEMENT BAR
========================================== -->

<div class="cf-topbar" id="cfTopbar">
    <div class="container">
        <div class="cf-topbar-inner">
            <div class="cf-announcement-window">

                <div
                    class="cf-announcement-slide"
                    id="cfAnnouncementSlide">

                    <span id="cfAnnouncementText">
                        Discover today's exciting shopping deals
                    </span>

                    <a
                        href="deals.php"
                        id="cfAnnouncementLink">

                        <span>Shop Deals</span>
                        <i class="bi bi-arrow-up-right"></i>

                    </a>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- ==========================================
     MAIN HEADER
========================================== -->

<header class="cf-header" id="cfHeader">
    <div class="container">
        <div class="cf-header-inner">

            <!-- COUPONDEALS LOGO -->
            <a
                href="index.php"
                class="cf-logo cf-brand-logo"
                aria-label="CouponDeals Home">

                <img
                    src="<?= cfEscape($logoPath) ?>"
                    alt="CouponDeals"
                    class="cf-logo-image"
                    width="140"
                    height="123"
                    fetchpriority="high">

            </a>

            <!-- DESKTOP NAVIGATION -->
            <nav
                class="cf-nav"
                aria-label="Main navigation">

                <?php foreach (array_slice($navLinks, 0, 4) as $link): ?>
                    <?php $isActive = $currentPage === $link[1]; ?>

                    <a
                        href="<?= cfEscape($link[1]) ?>"
                        class="cf-nav-link <?= $isActive ? 'active' : '' ?>"
                        <?= $isActive ? 'aria-current="page"' : '' ?>>

                        <?= cfEscape($link[0]) ?>

                    </a>
                <?php endforeach; ?>

                <!-- CATEGORIES DROPDOWN -->
                <div class="cf-category" id="cfCategory">

                    <div class="cf-category-nav">

                        <a
                            href="categories.php"
                            class="cf-nav-link cf-category-main-link <?= in_array($currentPage, ['categories.php', 'category.php'], true) ? 'active' : '' ?>">

                            Categories

                        </a>

                        <button
                            type="button"
                            class="cf-category-arrow"
                            id="cfCategoryToggle"
                            aria-label="Toggle categories"
                            aria-expanded="false"
                            aria-controls="cfCategoryMenu">

                            <i class="bi bi-chevron-down"></i>

                        </button>

                    </div>

                    <div
                        class="cf-category-menu"
                        id="cfCategoryMenu">

                        <div class="cf-category-menu-header">
                            <a
                                href="categories.php"
                                class="cf-category-all-link">

                                <i class="bi bi-grid-3x3-gap"></i>
                                All Categories
                                <i class="bi bi-arrow-up-right"></i>

                            </a>
                        </div>

                        <div class="cf-category-grid">
                            <?php foreach ($cfHeaderCategories as $category): ?>
                                <a
                                    href="category.php?slug=<?= rawurlencode($category[1]) ?>"
                                    class="cf-category-link">

                                    <?= cfEscape($category[0]) ?>

                                </a>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>

                <!-- PRODUCTS AND BLOG -->
                <?php foreach (array_slice($navLinks, 4) as $link): ?>
                    <?php $isActive = $currentPage === $link[1]; ?>

                    <a
                        href="<?= cfEscape($link[1]) ?>"
                        class="cf-nav-link <?= $isActive ? 'active' : '' ?>"
                        <?= $isActive ? 'aria-current="page"' : '' ?>>

                        <?= cfEscape($link[0]) ?>

                    </a>
                <?php endforeach; ?>

            </nav>

            <!-- HEADER ACTIONS -->
            <div class="cf-actions">

                <!-- SEARCH -->
                <button
                    type="button"
                    class="cf-icon-button"
                    id="cfSearchToggle"
                    aria-label="Open search"
                    aria-expanded="false"
                    aria-controls="cfSearchPanel">

                    <i class="bi bi-search"></i>

                </button>

                <!-- ACCOUNT: DIRECT LOGIN LINK -->
                <div class="cf-account" id="cfAccount">
                    <a
                        href="login.php"
                        class="cf-icon-button cf-login-icon"
                        id="cfAccountToggle"
                        aria-label="Sign In or Register"
                        title="Sign In / Register">

                        <i class="bi bi-person"></i>

                    </a>
                </div>

                <!-- ADVERTISE -->
                <a
                    href="advertise.php"
                    class="cf-advertise">

                    <span>Advertise With Us</span>

                    <span class="cf-advertise-arrow">
                        <i class="bi bi-arrow-up-right"></i>
                    </span>

                </a>

                <!-- MOBILE MENU BUTTON -->
                <button
                    type="button"
                    class="cf-menu-toggle"
                    id="cfMenuToggle"
                    aria-label="Open mobile menu"
                    aria-expanded="false"
                    aria-controls="cfMobileMenu">

                    <i class="bi bi-list"></i>

                </button>

            </div>
        </div>

        <!-- SEARCH PANEL -->
        <div
            class="cf-search-panel"
            id="cfSearchPanel">

            <form
                action="stores.php"
                method="get"
                class="cf-search-form"
                id="cfSearchForm"
                role="search"
                autocomplete="off">

                <span class="cf-search-icon">
                    <i class="bi bi-search"></i>
                </span>

                <input
                    type="search"
                    id="cfSearchInput"
                    name="q"
                    placeholder="Search stores, coupons, brands or products..."
                    aria-label="Search stores, coupons, brands or products"
                    aria-expanded="false"
                    aria-controls="cfSearchSuggestions"
                    required>

                <button
                    type="submit"
                    class="cf-search-submit">

                    <span>Search</span>
                    <i class="bi bi-arrow-right"></i>

                </button>

                <button
                    type="button"
                    class="cf-search-close"
                    id="cfSearchClose"
                    aria-label="Close search">

                    <i class="bi bi-x-lg"></i>

                </button>

                <div
                    class="cf-search-suggestions"
                    id="cfSearchSuggestions"></div>

            </form>
        </div>

    </div>
</header>

<!-- ==========================================
     MOBILE MENU
========================================== -->

<div
    class="cf-mobile-overlay"
    id="cfMobileOverlay"></div>

<aside
    class="cf-mobile-menu"
    id="cfMobileMenu"
    aria-label="Mobile navigation"
    aria-hidden="true"
    inert>

    <!-- MOBILE MENU HEADER -->
    <div class="cf-mobile-head">

        <a
            href="index.php"
            class="cf-logo cf-brand-logo"
            aria-label="CouponDeals Home">

            <img
                src="<?= cfEscape($logoPath) ?>"
                alt="CouponDeals"
                class="cf-logo-image"
                width="110"
                height="97">

        </a>

        <button
            type="button"
            id="cfMobileClose"
            aria-label="Close mobile menu">

            <i class="bi bi-x-lg"></i>

        </button>

    </div>

    <!-- MOBILE MENU LINKS -->
    <div class="cf-mobile-body">

        <span class="cf-mobile-label">
            MAIN MENU
        </span>

        <?php foreach ($navLinks as $link): ?>
            <?php $isActive = $currentPage === $link[1]; ?>

            <a
                href="<?= cfEscape($link[1]) ?>"
                class="cf-mobile-link <?= $isActive ? 'active' : '' ?>">

                <?= cfEscape($link[0]) ?>

            </a>
        <?php endforeach; ?>

        <div class="cf-mobile-divider"></div>

        <!-- CATEGORIES -->
        <span class="cf-mobile-label">
            CATEGORIES
        </span>

        <a
            href="categories.php"
            class="cf-mobile-link cf-mobile-all-categories <?= in_array($currentPage, ['categories.php', 'category.php'], true) ? 'active' : '' ?>">

            <i class="bi bi-grid"></i>
            All Categories

        </a>

        <div class="cf-mobile-categories">
            <?php foreach ($cfHeaderCategories as $category): ?>

                <a
                    href="category.php?slug=<?= rawurlencode($category[1]) ?>">

                    <?= cfEscape($category[0]) ?>

                </a>

            <?php endforeach; ?>
        </div>

        <div class="cf-mobile-divider"></div>

        <!-- LOGIN -->
        <a
            href="login.php"
            class="cf-mobile-link cf-mobile-login">

            <i class="bi bi-person"></i>
            Sign In / Register

        </a>

        <div class="cf-mobile-divider"></div>

        <!-- ADVERTISE -->
        <a
            href="advertise.php"
            class="cf-advertise cf-mobile-advertise">

            <span>Advertise With Us</span>

            <span class="cf-advertise-arrow">
                <i class="bi bi-arrow-up-right"></i>
            </span>

        </a>

    </div>
</aside>

<!-- END HEADER -->
