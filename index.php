
<?php
/* ==========================================================
   COUPONDEALS — COMPLETE HOMEPAGE
   PHP + Bootstrap 5.3

   Features:
   - Hero Slider
   - Top Picks
   - Top Verified Coupons layout
   - Today's Top Deals
   - New-tab Coupon and Deal Popups
   - Store Redirect
   - Products, Categories, Stores, Articles, FAQ
========================================================== */

$pageTitle = "CouponDeals | Coupons, Deals & Stores";

if (!function_exists("homeE")) {
    function homeE($value): string {
        return htmlspecialchars(
            (string) $value,
            ENT_QUOTES | ENT_SUBSTITUTE,
            "UTF-8"
        );
    }
}

function homeLogo(string $domain): string {
    return "https://www.google.com/s2/favicons?domain=" .
        rawurlencode($domain) . "&sz=128";
}

/* ==========================================================
   01. HERO SLIDES
========================================================== */

$slides = [
    [
        "badge" => "YOUR SMART SHOPPING DESTINATION",
        "title" => "Discover Great Deals.",
        "highlight" => "Save More Every Day.",
        "description" => "Explore coupon codes, promotions and shopping discoveries across fashion, electronics, beauty and more.",
        "primary" => "Explore Coupons",
        "primary_url" => "coupons.php",
        "secondary" => "Browse Stores",
        "secondary_url" => "stores.php",
        "image" => "https://images.unsplash.com/photo-1483985988355-763728e1935b?w=2000&auto=format&fit=crop&q=85",
        "position" => "center center"
    ],
    [
        "badge" => "DEALS WORTH DISCOVERING",
        "title" => "More Deals.",
        "highlight" => "Better Shopping.",
        "description" => "Discover popular shopping categories, products and new shopping inspiration.",
        "primary" => "Explore Deals",
        "primary_url" => "deals.php",
        "secondary" => "View Products",
        "secondary_url" => "products.php",
        "image" => "https://images.unsplash.com/photo-1498049794561-7780e7231661?w=2000&auto=format&fit=crop&q=85",
        "position" => "center center"
    ],
    [
        "badge" => "EXPLORE POPULAR STORES",
        "title" => "Your Favorite Brands.",
        "highlight" => "All in One Place.",
        "description" => "Browse popular stores and explore their shopping collections.",
        "primary" => "Browse Stores",
        "primary_url" => "stores.php",
        "secondary" => "All Categories",
        "secondary_url" => "categories.php",
        "image" => "https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=2000&auto=format&fit=crop&q=85",
        "position" => "center center"
    ]
];

$topPickStores = [
    [
        "name" => "Amazon",
        "category" => "Online Shopping",
        "domain" => "amazon.com",
        "image" => "https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=850&auto=format&fit=crop&q=85"
    ],
    [
        "name" => "Nike",
        "category" => "Fashion & Sports",
        "domain" => "nike.com",
        "image" => "https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=850&auto=format&fit=crop&q=85"
    ],
    [
        "name" => "Adidas",
        "category" => "Shoes & Sportswear",
        "domain" => "adidas.com",
        "image" => "https://brand.assets.adidas.com/capi/esCO/Images/blog-page-fw23-outfits-conciertos-co-img-3_195-1079630.jpg"
    ],
    [
        "name" => "Sephora",
        "category" => "Beauty & Skincare",
        "domain" => "sephora.com",
        "image" => "https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=850&auto=format&fit=crop&q=85"
    ],
    [
        "name" => "Walmart",
        "category" => "Everyday Shopping",
        "domain" => "walmart.com",
        "image" => "https://images.unsplash.com/photo-1534723452862-4c874018d66d?w=850&auto=format&fit=crop&q=85"
    ],
    [
        "name" => "Etsy",
        "category" => "Creative Shopping",
        "domain" => "etsy.com",
        "image" => "https://images.unsplash.com/photo-1494438639946-1ebd1d20bf85?w=850&auto=format&fit=crop&q=85"
    ],
    [
        "name" => "eBay",
        "category" => "Online Marketplace",
        "domain" => "ebay.com",
        "image" => "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=850&auto=format&fit=crop&q=85"
    ],
    [
        "name" => "Puma",
        "category" => "Sports & Lifestyle",
        "domain" => "puma.com",
        "image" => "https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=850&auto=format&fit=crop&q=85"
    ]
];


$featuredCoupons = [
    [
        "id" => "nike",
        "store" => "Nike",
        "domain" => "nike.com",
        "discount" => "20%",
        "unit" => "OFF CODE",
        "title" => "Explore Nike Sportswear & Footwear Offers",
        "code" => "DEMO-NIKE",
        "expiry" => "Not confirmed",
        "verified" => false,
        "url" => "https://www.nike.com/"
    ],
    [
        "id" => "adidas",
        "store" => "Adidas",
        "domain" => "adidas.com",
        "discount" => "20%",
        "unit" => "OFF CODE",
        "title" => "Discover Adidas Fashion & Footwear",
        "code" => "DEMO-ADIDAS",
        "expiry" => "Not confirmed",
        "verified" => false,
        "url" => "https://www.adidas.com/"
    ],
    [
        "id" => "amazon",
        "store" => "Amazon",
        "domain" => "amazon.com",
        "discount" => "10%",
        "unit" => "OFF CODE",
        "title" => "Explore Amazon Shopping Collections",
        "code" => "DEMO-SHOP",
        "expiry" => "Not confirmed",
        "verified" => false,
        "url" => "https://www.amazon.com/"
    ],
    [
        "id" => "sephora",
        "store" => "Sephora",
        "domain" => "sephora.com",
        "discount" => "15%",
        "unit" => "OFF CODE",
        "title" => "Discover Beauty & Skincare Collections",
        "code" => "DEMO-BEAUTY",
        "expiry" => "Not confirmed",
        "verified" => false,
        "url" => "https://www.sephora.com/"
    ],
    [
        "id" => "puma",
        "store" => "Puma",
        "domain" => "puma.com",
        "discount" => "10%",
        "unit" => "OFF CODE",
        "title" => "Explore Puma Sports & Lifestyle",
        "code" => "DEMO-PUMA",
        "expiry" => "Not confirmed",
        "verified" => false,
        "url" => "https://us.puma.com/"
    ],
    [
        "id" => "etsy",
        "store" => "Etsy",
        "domain" => "etsy.com",
        "discount" => "15%",
        "unit" => "OFF CODE",
        "title" => "Discover Gifts & Unique Home Finds",
        "code" => "DEMO-ETSY",
        "expiry" => "Not confirmed",
        "verified" => false,
        "url" => "https://www.etsy.com/"
    ],
    [
        "id" => "ebay",
        "store" => "eBay",
        "domain" => "ebay.com",
        "discount" => "$10",
        "unit" => "OFF CODE",
        "title" => "Explore Electronics & Accessories",
        "code" => "DEMO-EBAY",
        "expiry" => "Not confirmed",
        "verified" => false,
        "url" => "https://www.ebay.com/"
    ],
    [
        "id" => "walmart",
        "store" => "Walmart",
        "domain" => "walmart.com",
        "discount" => "$20",
        "unit" => "OFF CODE",
        "title" => "Discover Everyday Shopping Essentials",
        "code" => "DEMO-HOME",
        "expiry" => "Not confirmed",
        "verified" => false,
        "url" => "https://www.walmart.com/"
    ]
];

$topDeals = [
    [
        "id" => "nike-deal",
        "store" => "Nike",
        "domain" => "nike.com",
        "discount" => "20% OFF",
        "title" => "Explore Nike Sportswear and Footwear Offers",
        "url" => "https://www.nike.com/",
        "expiry" => "Not confirmed",
        "verified" => false
    ],
    [
        "id" => "adidas-deal",
        "store" => "Adidas",
        "domain" => "adidas.com",
        "discount" => "10% OFF",
        "title" => "Discover Adidas Fashion and Sports Collections",
        "url" => "https://www.adidas.com/",
        "expiry" => "Not confirmed",
        "verified" => false
    ],
    [
        "id" => "sephora-deal",
        "store" => "Sephora",
        "domain" => "sephora.com",
        "discount" => "OFFER",
        "title" => "Explore Beauty and Skincare Collections at Sephora",
        "url" => "https://www.sephora.com/",
        "expiry" => "Not confirmed",
        "verified" => false
    ],
    [
        "id" => "puma-deal",
        "store" => "Puma",
        "domain" => "puma.com",
        "discount" => "OFFER",
        "title" => "Discover Puma Sports and Lifestyle Essentials",
        "url" => "https://us.puma.com/",
        "expiry" => "Not confirmed",
        "verified" => false
    ],
    [
        "id" => "amazon-deal",
        "store" => "Amazon",
        "domain" => "amazon.com",
        "discount" => "SPECIAL OFFER",
        "title" => "Browse Selected Shopping Collections at Amazon",
        "url" => "https://www.amazon.com/",
        "expiry" => "Not confirmed",
        "verified" => false
    ],
    [
        "id" => "walmart-deal",
        "store" => "Walmart",
        "domain" => "walmart.com",
        "discount" => "DEALS",
        "title" => "Discover Everyday Essentials at Walmart",
        "url" => "https://www.walmart.com/",
        "expiry" => "Not confirmed",
        "verified" => false
    ],
    [
        "id" => "etsy-deal",
        "store" => "Etsy",
        "domain" => "etsy.com",
        "discount" => "SHOP OFFERS",
        "title" => "Explore Handmade Gifts and Unique Home Finds",
        "url" => "https://www.etsy.com/",
        "expiry" => "Not confirmed",
        "verified" => false
    ]
];



$selectedCoupon = null;
$selectedDeal = null;

$requestedCoupon = $_GET["coupon"] ?? "";
$requestedOffer = $_GET["offer"] ?? "";

if (is_string($requestedCoupon)) {
    foreach ($featuredCoupons as $coupon) {
        if ($coupon["id"] === $requestedCoupon) {
            $selectedCoupon = $coupon;
            break;
        }
    }
}

if (is_string($requestedOffer)) {
    foreach ($topDeals as $deal) {
        if ($deal["id"] === $requestedOffer) {
            $selectedDeal = $deal;
            break;
        }
    }
}




/* ==========================================
   POPULAR CATEGORIES - UPDATED DATA
========================================== */

$homeCategories = [
    [
        "name" => "Fashion",
        "slug" => "fashion",
        "image" => "https://images.unsplash.com/photo-1483985988355-763728e1935b?w=600&auto=format&fit=crop&q=85",
        "icon" => "bi-bag"
    ],
    [
        "name" => "Electronics",
        "slug" => "electronics",
        "image" => "https://images.unsplash.com/photo-1498049794561-7780e7231661?w=600&auto=format&fit=crop&q=85",
        "icon" => "bi-laptop"
    ],
    [
        "name" => "Beauty",
        "slug" => "beauty",
        "image" => "https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=600&auto=format&fit=crop&q=85",
        "icon" => "bi-stars"
    ],
    [
        "name" => "Home & Living",
        "slug" => "home",
        "image" => "https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=600&auto=format&fit=crop&q=85",
        "icon" => "bi-house-heart"
    ],
    [
        "name" => "Travel",
        "slug" => "travel",
        "image" => "https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=600&auto=format&fit=crop&q=85",
        "icon" => "bi-airplane"
    ],
    [
        "name" => "Sports",
        "slug" => "sports",
        "image" => "https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=600&auto=format&fit=crop&q=85",
        "icon" => "bi-bicycle"
    ],
    [
        "name" => "Food & Dining",
        "slug" => "food",
        "image" => "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&auto=format&fit=crop&q=85",
        "icon" => "bi-cup-hot"
    ],
    [
        "name" => "Shoes",
        "slug" => "footwear",
        "image" => "https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&auto=format&fit=crop&q=85",
        "icon" => "bi-bag-heart"
    ],
    [
        "name" => "Kids & Baby",
        "slug" => "baby",
        "image" => "https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=600&auto=format&fit=crop&q=85",
        "icon" => "bi-balloon-heart"
    ],
    [
        "name" => "Health",
        "slug" => "health",
        "image" => "https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=600&auto=format&fit=crop&q=85",
        "icon" => "bi-heart-pulse"
    ]
];



/* ==========================================
   POPULAR PRODUCTS DATA
========================================== */

$products = [
    [
        "name" => "Wireless Over-Ear Headphones",
        "category" => "Electronics",
        "store" => "Tech Collection",
        "price" => 49.99,
        "old_price" => 69.99,
        "currency" => "$",
        "image" => "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&auto=format&fit=crop&q=85",
        "url" => "products.php?q=headphones"
    ],
    [
        "name" => "Everyday Fashion Sneakers",
        "category" => "Fashion",
        "store" => "Style Collection",
        "price" => 39.99,
        "old_price" => 55.00,
        "currency" => "$",
        "image" => "https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=85",
        "url" => "products.php?q=sneakers"
    ],
    [
        "name" => "Minimalist Wrist Watch",
        "category" => "Fashion",
        "store" => "Accessories Collection",
        "price" => 89.00,
        "old_price" => 119.00,
        "currency" => "$",
        "image" => "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&auto=format&fit=crop&q=85",
        "url" => "products.php?q=watch"
    ],
    [
        "name" => "Modern Living Room Chair",
        "category" => "Home",
        "store" => "Home Collection",
        "price" => 149.00,
        "old_price" => 189.00,
        "currency" => "$",
        "image" => "https://images.unsplash.com/photo-1503602642458-232111445657?w=800&auto=format&fit=crop&q=85",
        "url" => "products.php?q=chair"
    ],
    [
        "name" => "Professional Digital Camera",
        "category" => "Electronics",
        "store" => "Camera Collection",
        "price" => 399.00,
        "old_price" => 459.00,
        "currency" => "$",
        "image" => "https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=800&auto=format&fit=crop&q=85",
        "url" => "products.php?q=camera"
    ],
    [
        "name" => "Premium Skincare Essentials",
        "category" => "Beauty",
        "store" => "Beauty Collection",
        "price" => 29.99,
        "old_price" => null,
        "currency" => "$",
        "image" => "https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=800&auto=format&fit=crop&q=85",
        "url" => "products.php?q=skincare"
    ],
    [
        "name" => "Modern Wireless Earbuds",
        "category" => "Electronics",
        "store" => "Audio Collection",
        "price" => 59.00,
        "old_price" => 79.00,
        "currency" => "$",
        "image" => "https://images.unsplash.com/photo-1606220588913-b3aacb4d2f46?w=800&auto=format&fit=crop&q=85",
        "url" => "products.php?q=earbuds"
    ],
    [
        "name" => "Premium Running Shoes",
        "category" => "Fashion",
        "store" => "Sports Collection",
        "price" => 75.00,
        "old_price" => 95.00,
        "currency" => "$",
        "image" => "https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=85",
        "url" => "products.php?q=running-shoes"
    ]
];


$recentStores = [
    [
        "name" => "HostSailor",
        "domain" => "hostsailor.com",
        "coupons" => 6
    ],
    [
        "name" => "Hasuit",
        "domain" => "hasuit.com",
        "coupons" => 5
    ],
    [
        "name" => "Summio Parcs",
        "domain" => "summio.com",
        "coupons" => 5
    ],
    [
        "name" => "KaYoTom",
        "domain" => "kayotom.com",
        "coupons" => 7
    ],
    [
        "name" => "magcubic",
        "domain" => "magcubic.com",
        "coupons" => 7
    ],
    [
        "name" => "RedKiss",
        "domain" => "redkiss.com",
        "coupons" => 7
    ],
    [
        "name" => "Fleo",
        "domain" => "fleo.com",
        "coupons" => 7
    ],
    [
        "name" => "ChapStick",
        "domain" => "chapstick.com",
        "coupons" => 7
    ],
    [
        "name" => "Fanka",
        "domain" => "fanka.com",
        "coupons" => 7
    ],
    [
        "name" => "Gliks",
        "domain" => "gliks.com",
        "coupons" => 6
    ],
    [
        "name" => "Sprig",
        "domain" => "sprig.com",
        "coupons" => 4
    ],
    [
        "name" => "DailyLook",
        "domain" => "dailylook.com",
        "coupons" => 4
    ]
];

$articles = [
    [
        "category" => "SHOPPING GUIDE",
        "title" => "How to Find Better Deals When Shopping Online",
        "description" => "Practical ways to compare offers and shop confidently.",
        "image" => "https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=900&auto=format&fit=crop&q=85",
        "url" => "blog.php"
    ],
    [
        "category" => "FASHION",
        "title" => "Everyday Style Essentials Worth Exploring",
        "description" => "Find style inspiration and wardrobe essentials.",
        "image" => "https://images.unsplash.com/photo-1483985988355-763728e1935b?w=900&auto=format&fit=crop&q=85",
        "url" => "blog.php"
    ],
    [
        "category" => "TECHNOLOGY",
        "title" => "A Smarter Guide to Buying Tech Accessories",
        "description" => "Explore features to consider when purchasing gadgets.",
        "image" => "https://images.unsplash.com/photo-1498049794561-7780e7231661?w=900&auto=format&fit=crop&q=85",
        "url" => "blog.php"
    ]
];

$topics = [
    ["Fashion Trends", "fashion"],
    ["Electronics", "electronics"],
    ["Beauty Essentials", "beauty"],
    ["Home Decor", "home"],
    ["Travel Ideas", "travel"],
    ["Footwear", "footwear"],
    ["Gift Ideas", "gifts"],
    ["Smart Shopping", "shopping"]
];

$faqs = [
    [
        "question" => "How can I find coupons on CouponDeals?",
        "answer" => "Browse the Coupons, Stores and Categories pages to discover available offers."
    ],
    [
        "question" => "How do I use a promo code?",
        "answer" => "Copy the code, visit the retailer and enter it at checkout. Confirm the discount before purchasing."
    ],
    [
        "question" => "Do all offers need a coupon code?",
        "answer" => "No. Some offers require a code and others are available directly at the store."
    ],
    [
        "question" => "Can coupon codes expire?",
        "answer" => "Yes. Stores may change or end promotions. Always review the latest offer terms."
    ],
    [
        "question" => "Is CouponDeals free to browse?",
        "answer" => "Visitors can browse stores, categories and coupons without a browsing fee."
    ]
];

require_once __DIR__ . "/includes/header.php";
?>

<main id="homePage" class="cf-home">

    <!-- ==================================================
         01. HERO SLIDER
    ================================================== -->

    <section
        class="hm-hero hm-fashion-hero"
        id="hmHero"
        aria-label="Featured shopping collections"
        aria-roledescription="carousel">

        <div class="hm-fashion-slides">

            <?php foreach ($slides as $index => $slide): ?>

                <article
                    class="hm-hero-slide <?= $index === 0 ? 'is-active' : '' ?>"
                    data-hm-slide
                    aria-roledescription="slide"
                    aria-label="<?= $index + 1 ?> of <?= count($slides) ?>"
                    aria-hidden="<?= $index === 0 ? 'false' : 'true' ?>"
                    <?= $index !== 0 ? 'inert' : '' ?>>

                    <div
                        class="hm-fashion-photo"
                        style="background-image:url('<?= homeE($slide['image']) ?>');background-position:<?= homeE($slide['position']) ?>;">
                    </div>

                    <div class="hm-fashion-overlay"></div>

                    <div class="container hm-fashion-container">
                        <div class="hm-fashion-content">

                            <span class="hm-fashion-badge">
                                <?= homeE($slide["badge"]) ?>
                            </span>

                            <?php $headingTag = $index === 0 ? "h1" : "h2"; ?>

                            <<?= $headingTag ?> class="hm-animated-heading">
                                <span class="hm-heading-line" data-hm-words>
                                    <?= homeE($slide["title"]) ?>
                                </span>

                                <span class="hm-heading-line hm-heading-accent" data-hm-words>
                                    <?= homeE($slide["highlight"]) ?>
                                </span>
                            </<?= $headingTag ?>>

                            <p><?= homeE($slide["description"]) ?></p>

                            <div class="hm-fashion-buttons">

                                <a
                                    href="<?= homeE($slide["primary_url"]) ?>"
                                    class="hm-fashion-btn-primary">

                                    <?= homeE($slide["primary"]) ?>
                                    <i class="bi bi-arrow-up-right"></i>
                                </a>

                                <a
                                    href="<?= homeE($slide["secondary_url"]) ?>"
                                    class="hm-fashion-btn-secondary">

                                    <i class="bi bi-arrow-right"></i>
                                    <?= homeE($slide["secondary"]) ?>
                                </a>

                            </div>
                        </div>
                    </div>

                </article>

            <?php endforeach; ?>

        </div>

        <button
            type="button"
            class="hm-fashion-arrow hm-fashion-prev"
            id="hmHeroPrev"
            aria-label="Previous slide">
            <i class="bi bi-chevron-left"></i>
        </button>

        <button
            type="button"
            class="hm-fashion-arrow hm-fashion-next"
            id="hmHeroNext"
            aria-label="Next slide">
            <i class="bi bi-chevron-right"></i>
        </button>

        <div class="hm-fashion-dots" id="hmHeroDots">

            <?php foreach ($slides as $index => $slide): ?>

                <button
                    type="button"
                    class="hm-hero-dot <?= $index === 0 ? 'active' : '' ?>"
                    data-hm-dot="<?= $index ?>"
                    aria-label="Show slide <?= $index + 1 ?>"
                    <?= $index === 0 ? 'aria-current="true"' : '' ?>>
                </button>

            <?php endforeach; ?>

        </div>
    </section>

    

<!-- ==========================================
     COUPONDEALS - TOP PICKS FOR YOU
     CLEAN & RESPONSIVE CAROUSEL
========================================== -->

<section class="tp-section" id="cfTopPicks">
    <div class="container">

        <!-- Section Header -->
        <div class="tp-header">

            <div class="tp-heading">

                <span class="tp-eyebrow">
                    <i class="bi bi-stars"></i>
                    HANDPICKED SHOPPING STORES
                </span>

                <h2>
                    Top Picks <span>For You</span>
                </h2>

                <p>
                    Explore popular shopping destinations
                    and discover offers from your favorite brands.
                </p>

            </div>

            <div class="tp-header-actions">

                <a href="stores.php" class="tp-view-all">
                    View All Stores
                    <i class="bi bi-arrow-up-right"></i>
                </a>

                <!-- Carousel Navigation -->
                <div class="tp-controls">

                    <button
                        type="button"
                        id="cfPicksPrev"
                        aria-label="Previous stores">

                        <i class="bi bi-arrow-left"></i>

                    </button>

                    <button
                        type="button"
                        id="cfPicksNext"
                        aria-label="Next stores">

                        <i class="bi bi-arrow-right"></i>

                    </button>

                </div>
            </div>
        </div>

        <!-- Carousel Viewport -->
        <div class="tp-viewport">

            <div
                class="tp-track cf-picks-track"
                id="cfPicksTrack"
                tabindex="0"
                aria-label="Popular shopping stores">

                <?php foreach ($topPickStores as $store): ?>

                    <?php
                    $storeUrl = "stores.php?q=" .
                        rawurlencode($store["name"]);
                    ?>

                    <article class="tp-card">

                        <!-- Store Cover -->
                        <a
                            href="<?= homeE($storeUrl) ?>"
                            class="tp-cover"
                            aria-label="Explore <?= homeE($store['name']) ?>">

                            <img
                                src="<?= homeE($store['image']) ?>"
                                alt="<?= homeE($store['category']) ?>"
                                loading="lazy"
                                onerror="this.hidden=true;">

                            <span class="tp-cover-shade"></span>

                            <span class="tp-image-arrow">
                                <i class="bi bi-arrow-up-right"></i>
                            </span>

                        </a>

                        <!-- Floating Store Logo -->
                        <div class="tp-logo-wrap">

                            <div class="tp-logo">

                                <img
                                    src="<?= homeE(homeLogo($store['domain'])) ?>"
                                    alt="<?= homeE($store['name']) ?> logo"
                                    loading="lazy"
                                    onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                                <span class="tp-logo-fallback" hidden>
                                    <?= homeE(strtoupper(substr($store['name'], 0, 1))) ?>
                                </span>

                            </div>

                        </div>

                        <!-- Store Details -->
                        <div class="tp-content">

                            <span class="tp-category">
                                <?= homeE($store['category']) ?>
                            </span>

                            <h3>
                                <a href="<?= homeE($storeUrl) ?>">
                                    <?= homeE($store['name']) ?>
                                </a>
                            </h3>

                            <div class="tp-offer-label">
                                <i class="bi bi-ticket-perforated"></i>
                                <span>Explore Coupons &amp; Deals</span>
                            </div>

                            <!-- CTA -->
                            <a
                                href="<?= homeE($storeUrl) ?>"
                                class="tp-button">

                                <span>View Coupons</span>

                                <i class="bi bi-arrow-up-right"></i>

                            </a>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

        </div>

    </div>
</section>



    <!-- ==================================================
         03. TOP VERIFIED COUPONS LAYOUT
    ================================================== -->

    <section class="cfvc-section" id="cfvcCoupons">
        <div class="container">

            
<!-- TOP VERIFIED COUPONS HEADING -->

<div class="cfvc-header premium-section-header">

    <div class="premium-section-heading">

        <span class="premium-section-eyebrow">
            <i class="bi bi-patch-check-fill"></i>
            HANDPICKED COUPON COLLECTION
        </span>

        <h2>
            Top <span>Verified Coupons</span>
        </h2>

        <p>
            Discover coupon codes and shopping offers
            from popular brands, all in one place.
        </p>

    </div>

    <a href="coupons.php" class="premium-section-link">
        View All Coupons
        <i class="bi bi-arrow-up-right"></i>
    </a>

</div>


            <div class="cfvc-grid">

                <?php foreach ($featuredCoupons as $coupon): ?>

                    <?php
                    $couponPageUrl = "index.php?coupon=" .
                        rawurlencode($coupon["id"]);
                    ?>

                    <article class="cfvc-card">

                        <div class="cfvc-status-row">

                            <span class="cfvc-badge <?= $coupon['verified'] ? 'is-verified' : 'is-preview' ?>">

                                <i class="bi <?= $coupon['verified'] ? 'bi-check2-circle' : 'bi-ticket-perforated' ?>"></i>

                                <?= $coupon['verified'] ? 'VERIFIED' : 'PREVIEW' ?>

                            </span>
                        </div>

                        <div class="cfvc-offer-row">

                            <a
                                href="stores.php?q=<?= rawurlencode($coupon['store']) ?>"
                                class="cfvc-logo">

                                <img
                                    src="<?= homeE(homeLogo($coupon['domain'])) ?>"
                                    alt="<?= homeE($coupon['store']) ?> logo"
                                    loading="lazy"
                                    onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                                <span class="cfvc-logo-fallback" hidden>
                                    <?= homeE($coupon["store"]) ?>
                                </span>
                            </a>

                            <div class="cfvc-offer-value">
                                <strong><?= homeE($coupon["discount"]) ?></strong>
                                <span><?= homeE($coupon["unit"]) ?></span>
                            </div>
                        </div>

                        <div class="cfvc-content">

                            <h3><?= homeE($coupon["title"]) ?></h3>

                            <a
                                href="stores.php?q=<?= rawurlencode($coupon['store']) ?>"
                                class="cfvc-store-link">

                                <?= homeE($coupon["store"]) ?>
                            </a>
                        </div>

                        <div class="cfvc-footer">

                            <a
                                href="<?= homeE($couponPageUrl) ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="cr-reveal-link"
                                aria-label="Reveal <?= homeE($coupon['store']) ?> coupon code">

                                <span class="cr-code-peek" aria-hidden="true">
                                    <?= homeE(substr($coupon["code"], -3)) ?>
                                </span>

                                <span class="cr-reveal-cover">
                                    Reveal Code
                                    <i class="bi bi-arrow-right"></i>
                                </span>
                            </a>

                            <p class="cfvc-expiry">
                                Expires: <?= homeE($coupon["expiry"]) ?>
                            </p>

                        </div>
                    </article>

                <?php endforeach; ?>

            </div>
        </div>
    </section>

    <!-- ==================================================
         04. TODAY'S TOP DEALS
         Activate Offer -> New Tab
    ================================================== -->

    <section class="hm-deals-section td-section" id="todayTopDeals">
        <div class="container">

            
<!-- TODAY'S TOP DEALS HEADING -->

<div class="td-heading premium-section-header">

    <div class="premium-section-heading">

        <span class="premium-section-eyebrow">
            <i class="bi bi-lightning-charge-fill"></i>
            FEATURED SHOPPING OFFERS
        </span>

        <h2>
            Today's <span>Top Deals</span>
        </h2>

        <p>
            Explore exciting shopping offers and discover
            deals from your favorite stores.
        </p>

    </div>

    <a href="deals.php" class="premium-section-link">
        View All Deals
        <i class="bi bi-arrow-up-right"></i>
    </a>

</div>


            <div class="td-grid">

                <?php foreach ($topDeals as $deal): ?>

                    <article class="td-card">

                        <div class="td-card-top">

                            <span class="td-badge <?= $deal['verified'] ? 'td-verified' : 'td-preview' ?>">

                                <i class="bi <?= $deal['verified'] ? 'bi-patch-check-fill' : 'bi-ticket-perforated' ?>"></i>

                                <?= $deal['verified'] ? 'VERIFIED' : 'PREVIEW' ?>
                            </span>
                        </div>

                        <div class="td-offer-row">

                            <div class="td-logo">

                                <img
                                    src="<?= homeE(homeLogo($deal['domain'])) ?>"
                                    alt="<?= homeE($deal['store']) ?> logo"
                                    loading="lazy"
                                    onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                                <span hidden>
                                    <?= homeE($deal["store"]) ?>
                                </span>
                            </div>

                            <div class="td-offer-value">
                                <strong><?= homeE($deal["discount"]) ?></strong>
                                <span>OFFER</span>
                                <small><?= homeE($deal["store"]) ?></small>
                            </div>
                        </div>

                        <h3 class="td-title">
                            <?= homeE($deal["title"]) ?>
                        </h3>

                        <div class="td-card-footer">

                            <!-- FIXED: No nested button tags -->

                            <a
                                href="index.php?offer=<?= rawurlencode($deal['id']) ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="td-activate"
                                data-td-activate
                                aria-label="Activate <?= homeE($deal['store']) ?> offer">

                                Activate Offer
                                <i class="bi bi-arrow-up-right"></i>
                            </a>

                            <p class="td-expiry">
                                Expires: <?= homeE($deal["expiry"]) ?>
                            </p>
                        </div>

                    </article>

                <?php endforeach; ?>

            </div>
        </div>
    </section>

    
<!-- =============================================
     PREMIUM SHOP BY CATEGORY
============================================= -->

<section class="pc-section pc-premium" id="popularCategories">
    <div class="container">

        <div class="pc-header">
            <div class="pc-heading">
                <span class="pc-eyebrow">
                    <span class="pc-eyebrow-dot"></span>
                    CURATED SHOPPING CATEGORIES
                </span>

                <h2>Discover Your <span>Next Favorite.</span></h2>

                <p>
                    Explore exceptional finds across fashion,
                    technology, beauty, home and more.
                </p>
            </div>

            <a href="categories.php" class="pc-view-all">
                All Categories
                <i class="bi bi-arrow-up-right"></i>
            </a>
        </div>

        <div class="pc-premium-grid">

            <?php foreach ($homeCategories as $index => $category): ?>

                <a
                    href="deals.php?category=<?= rawurlencode($category['slug']) ?>"
                    class="pc-premium-card"
                    aria-label="Explore <?= homeE($category['name']) ?> category">

                    <div class="pc-premium-photo">
                        <img
                            src="<?= homeE($category['image']) ?>"
                            alt="<?= homeE($category['name']) ?>"
                            loading="lazy"
                            onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                        <span class="pc-premium-fallback" hidden>
                            <i class="bi <?= homeE($category['icon']) ?>"></i>
                        </span>
                    </div>

                    <span class="pc-premium-number">
                        <?= str_pad((string)($index + 1), 2, "0", STR_PAD_LEFT) ?>
                    </span>

                    <span class="pc-premium-icon">
                        <i class="bi <?= homeE($category['icon']) ?>"></i>
                    </span>

                    <div class="pc-premium-content">
                        <span class="pc-premium-label">
                            EXPLORE COLLECTION
                        </span>

                        <h3><?= homeE($category['name']) ?></h3>

                        <span class="pc-premium-cta">
                            Discover Deals
                            <i class="bi bi-arrow-up-right"></i>
                        </span>
                    </div>

                    <span class="pc-premium-arrow">
                        <i class="bi bi-arrow-up-right"></i>
                    </span>
                </a>

            <?php endforeach; ?>

        </div>
    </div>
</section>


    
<!-- ==========================================
     PREMIUM POPULAR PRODUCTS SECTION
========================================== -->

<section class="pp-section" id="popularProducts">
    <div class="container">

        <!-- Section Heading -->

        <div class="pp-header">

            <div class="pp-heading">

                <span class="pp-eyebrow">
                    <i class="bi bi-stars"></i>
                    HANDPICKED PRODUCTS
                </span>

                <h2>
                    Popular <span>Products</span>
                </h2>

                <p>
                    Discover trending products and explore
                    shopping deals from your favorite stores.
                </p>

            </div>

            <a href="products.php" class="pp-view-all">
                View All Products
                <i class="bi bi-arrow-up-right"></i>
            </a>

        </div>

    

        <!-- Products Grid -->

        <div class="pp-grid hm-product-grid" id="hmProductGrid">

            <?php foreach ($products as $product): ?>

                <article
                    class="pp-card hm-product-card"
                    data-hm-category="<?= homeE($product['category']) ?>">

                    <!-- Product Image -->

                    <a
                        href="<?= homeE($product['url']) ?>"
                        class="pp-image"
                        aria-label="View <?= homeE($product['name']) ?>">

                        <img
                            src="<?= homeE($product['image']) ?>"
                            alt="<?= homeE($product['name']) ?>"
                            loading="lazy">

                        <span class="pp-image-arrow">
                            <i class="bi bi-arrow-up-right"></i>
                        </span>

                    </a>

                    <!-- Product Information -->

                    <div class="pp-content">

                        <div class="pp-store">
                            From:
                            <span><?= homeE($product['store']) ?></span>
                        </div>

                        <h3 class="pp-title">
                            <a href="<?= homeE($product['url']) ?>">
                                <?= homeE($product['name']) ?>
                            </a>
                        </h3>

                        <!-- Price -->

                        <div class="pp-price-row">

                            <strong class="pp-price">
                                <?= homeE($product['currency']) ?><?= number_format($product['price'], 2) ?>
                            </strong>

                            <?php if (
                                $product['old_price'] !== null &&
                                $product['old_price'] > $product['price']
                            ): ?>

                                <del class="pp-old-price">
                                    <?= homeE($product['currency']) ?><?= number_format($product['old_price'], 2) ?>
                                </del>

                            <?php endif; ?>

                        </div>

                        <!-- Go To Deal Button -->

                        <a
                            href="<?= homeE($product['url']) ?>"
                            class="pp-deal-btn">

                            <span>Go To Deal</span>
                            <i class="bi bi-arrow-up-right"></i>

                        </a>

                    </div>

                </article>

            <?php endforeach; ?>

        </div>

    </div>
</section>


    <section class="rs-section" id="recentPartneredStores">
    <div class="container">

        <div class="rs-header">

            <div>
                <span class="rs-eyebrow">
                    <i class="bi bi-shop-window"></i>
                    DISCOVER NEW STORES
                </span>

                <h2>Recently <span>Added Stores</span></h2>

                <p>
                    Explore recently featured shopping stores
                    and discover their latest coupon collections.
                </p>
            </div>

            <a href="stores.php" class="rs-view-all">
                View All Stores
                <i class="bi bi-arrow-up-right"></i>
            </a>

        </div>

        <div class="rs-grid">

            <?php foreach ($recentStores as $store): ?>

                <?php
                $storeLogo =
                    "https://www.google.com/s2/favicons?domain=" .
                    rawurlencode($store["domain"]) .
                    "&sz=128";

                $storeLink =
                    "stores.php?q=" .
                    rawurlencode($store["name"]);
                ?>

                <a
                    href="<?= homeE($storeLink) ?>"
                    class="rs-card"
                    aria-label="View <?= homeE($store['name']) ?> coupons">

                    <div class="rs-logo">

                        <img
                            src="<?= homeE($storeLogo) ?>"
                            alt="<?= homeE($store['name']) ?> logo"
                            loading="lazy"
                            onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                        <span class="rs-logo-fallback" hidden>
                            <?= homeE(strtoupper(substr($store["name"], 0, 1))) ?>
                        </span>

                    </div>

                    <div class="rs-info">

                        <h3><?= homeE($store["name"]) ?></h3>

                        <p>
                            <?= (int)$store["coupons"] ?>
                            Coupons available
                        </p>

                    </div>

                    <span class="rs-arrow">
                        <i class="bi bi-arrow-up-right"></i>
                    </span>

                </a>

            <?php endforeach; ?>

        </div>

    </div>
</section>

    
<!-- ==========================================
     PREMIUM PROMOTIONAL BANNER
========================================== -->

<section class="hm-promo-section cp-promo-section" id="smartSavings">
    <div class="container">

        <div class="cp-promo-banner">

            <!-- Decorative Elements -->
            <span class="cp-promo-glow cp-glow-one" aria-hidden="true"></span>
            <span class="cp-promo-glow cp-glow-two" aria-hidden="true"></span>

            <!-- Left Content -->
            <div class="cp-promo-content">

                <span class="cp-promo-kicker">
                    <i class="bi bi-stars"></i>
                    YOUR SMART SHOPPING COMPANION
                </span>

                <h2>
                    Discover Better Deals.
                    <span>Save Smarter.</span>
                </h2>

                <p>
                    Explore exciting brands, discover coupon codes
                    and find shopping offers for your everyday needs.
                    Your next great find starts here.
                </p>

                <div class="cp-promo-actions">

                    <a href="coupons.php" class="cp-promo-primary">
                        Explore Coupons
                        <i class="bi bi-arrow-up-right"></i>
                    </a>

                    <a href="stores.php" class="cp-promo-secondary">
                        Browse Stores
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

                <div class="cp-promo-benefits">
                    <span>
                        <i class="bi bi-ticket-perforated"></i>
                        Coupon Codes
                    </span>

                    <span>
                        <i class="bi bi-shop"></i>
                        Popular Stores
                    </span>

                    <span>
                        <i class="bi bi-lightning-charge"></i>
                        Shopping Deals
                    </span>
                </div>

            </div>

            <!-- Right Decorative Coupon Illustration -->
            <div class="cp-promo-visual" aria-hidden="true">

                <div class="cp-orbit cp-orbit-one"></div>
                <div class="cp-orbit cp-orbit-two"></div>

                <div class="cp-main-ticket">

                    <div class="cp-ticket-top">
                        <span class="cp-ticket-brand">
                            <i class="bi bi-ticket-perforated-fill"></i>
                            COUPONDEALS
                        </span>

                        <i class="bi bi-stars"></i>
                    </div>

                    <div class="cp-ticket-center">
                        <span>DISCOVER MORE</span>
                        <strong>SAVE MORE</strong>
                        <small>YOUR NEXT DEAL IS WAITING</small>
                    </div>

                    <div class="cp-ticket-bottom">
                        <span>EXPLORE • DISCOVER • SAVE</span>
                        <i class="bi bi-arrow-up-right"></i>
                    </div>

                </div>

                <div class="cp-floating-card cp-floating-one">
                    <span class="cp-floating-icon">
                        <i class="bi bi-bag-check-fill"></i>
                    </span>

                    <div>
                        <strong>Shop Smarter</strong>
                        <small>Discover great finds</small>
                    </div>
                </div>

                <div class="cp-floating-card cp-floating-two">
                    <span class="cp-floating-icon">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </span>

                    <div>
                        <strong>Fresh Deals</strong>
                        <small>Explore new offers</small>
                    </div>
                </div>

                <span class="cp-spark cp-spark-one">
                    <i class="bi bi-stars"></i>
                </span>

                <span class="cp-spark cp-spark-two">
                    <i class="bi bi-plus-lg"></i>
                </span>

            </div>

        </div>
    </div>
</section>


    
<!-- ==========================================
     COUPONDEALS - PREMIUM SHOPPING JOURNAL
========================================== -->

<?php
$featuredStory = $articles[0] ?? null;
$sideStories = array_slice($articles, 1, 2);
?>

<?php if ($featuredStory): ?>

<section class="sj-section" id="shoppingStories">
    <div class="container">

        <!-- Header -->
        <div class="sj-header">

            <div class="sj-heading">

                <span class="sj-eyebrow">
                    <i class="bi bi-stars"></i>
                    THE SAVINGS JOURNAL
                </span>

                <h2>
                    Stories That Inspire
                    <span>Smarter Shopping.</span>
                </h2>

                <p>
                    Discover practical shopping tips,
                    inspiring trends and guides to better buying.
                </p>

            </div>

            <a href="blog.php" class="sj-view-all">
                View All Articles
                <i class="bi bi-arrow-up-right"></i>
            </a>

        </div>

        <!-- Featured + Side Articles -->
        <div class="sj-layout">

            <!-- Featured Article -->
            <article class="sj-featured">

                <a
                    href="<?= homeE($featuredStory['url']) ?>"
                    class="sj-featured-image">

                    <img
                        src="<?= homeE($featuredStory['image']) ?>"
                        alt="<?= homeE($featuredStory['title']) ?>"
                        loading="lazy">

                    <span class="sj-featured-badge">
                        <i class="bi bi-star-fill"></i>
                        EDITOR'S PICK
                    </span>

                </a>

                <div class="sj-featured-content">

                    <span class="sj-category">
                        <?= homeE($featuredStory['category']) ?>
                    </span>

                    <h3>
                        <a href="<?= homeE($featuredStory['url']) ?>">
                            <?= homeE($featuredStory['title']) ?>
                        </a>
                    </h3>

                    <p>
                        <?= homeE($featuredStory['description']) ?>
                    </p>

                    <a
                        href="<?= homeE($featuredStory['url']) ?>"
                        class="sj-read-link">

                        Read Full Story
                        <span>
                            <i class="bi bi-arrow-up-right"></i>
                        </span>

                    </a>

                </div>
            </article>

            <!-- Right Articles -->
            <div class="sj-side-list">

                <?php foreach ($sideStories as $story): ?>

                    <article class="sj-side-card">

                        <a
                            href="<?= homeE($story['url']) ?>"
                            class="sj-side-image">

                            <img
                                src="<?= homeE($story['image']) ?>"
                                alt="<?= homeE($story['title']) ?>"
                                loading="lazy">
                        </a>

                        <div class="sj-side-content">

                            <span class="sj-side-category">
                                <?= homeE($story['category']) ?>
                            </span>

                            <h3>
                                <a href="<?= homeE($story['url']) ?>">
                                    <?= homeE($story['title']) ?>
                                </a>
                            </h3>

                            <p>
                                <?= homeE($story['description']) ?>
                            </p>

                            <a
                                href="<?= homeE($story['url']) ?>"
                                class="sj-side-link">

                                Read Story
                                <i class="bi bi-arrow-up-right"></i>
                            </a>

                        </div>

                    </article>

                <?php endforeach; ?>

                <!-- Bottom CTA -->
                <a href="blog.php" class="sj-explore-card">

                    <span class="sj-explore-icon">
                        <i class="bi bi-journal-richtext"></i>
                    </span>

                    <span class="sj-explore-content">
                        <strong>Explore More Shopping Stories</strong>
                        <small>Tips, inspiration and buying guides.</small>
                    </span>

                    <span class="sj-explore-arrow">
                        <i class="bi bi-arrow-up-right"></i>
                    </span>

                </a>

            </div>

        </div>

    </div>
</section>

<?php endif; ?>


   
<!-- ==========================================
     PREMIUM TRENDING TOPICS
========================================== -->

<?php
$topicIcons = [
    "fashion"     => "bi-bag-heart",
    "electronics" => "bi-cpu",
    "beauty"      => "bi-stars",
    "home"        => "bi-house-heart",
    "travel"      => "bi-airplane",
    "footwear"    => "bi-bag",
    "gifts"       => "bi-gift",
    "shopping"    => "bi-cart-check"
];
?>

<section class="tt-section" id="trendingTopics">
    <div class="container">

        <div class="tt-header">
            <div>
                <span class="tt-eyebrow">
                    <i class="bi bi-lightning-charge-fill"></i>
                    WHAT'S TRENDING
                </span>

                <h2>
                    Explore <span>Trending Topics</span>
                </h2>

                <p>
                    Discover fresh shopping ideas, popular categories
                    and more ways to explore great finds.
                </p>
            </div>

            <a href="categories.php" class="tt-view-all">
                Explore All Categories
                <i class="bi bi-arrow-up-right"></i>
            </a>
        </div>

        <div class="tt-grid">

            <?php foreach ($topics as $index => $topic): ?>

                <?php
                $topicName = $topic[0];
                $topicSlug = $topic[1];

                $topicIcon = $topicIcons[$topicSlug] ?? "bi-grid";
                ?>

                <a
                    href="deals.php?category=<?= rawurlencode($topicSlug) ?>"
                    class="tt-card"
                    aria-label="Explore <?= homeE($topicName) ?>">

                    <span class="tt-number">
                        <?= str_pad(
                            (string) ($index + 1),
                            2,
                            "0",
                            STR_PAD_LEFT
                        ) ?>
                    </span>

                    <span class="tt-icon">
                        <i class="bi <?= homeE($topicIcon) ?>"></i>
                    </span>

                    <span class="tt-content">
                        <strong><?= homeE($topicName) ?></strong>
                        <small>Explore Topic</small>
                    </span>

                    <span class="tt-arrow">
                        <i class="bi bi-arrow-up-right"></i>
                    </span>

                </a>

            <?php endforeach; ?>

        </div>

    </div>
</section>


    
<!-- ==========================================
     COUPONDEALS - PREMIUM FAQ SECTION
========================================== -->

<section class="faqpro-section" id="homeFaq">
    <div class="container">

        <div class="faqpro-heading">
            <span class="faqpro-eyebrow">
                <i class="bi bi-stars"></i>
                SUPPORT & GUIDANCE
            </span>

            <h2>
                Frequently Asked <span>Questions.</span>
            </h2>

            <p>
                Everything you need to know about coupons,
                shopping deals and saving smarter.
            </p>
        </div>

        <div class="faqpro-layout">

            <!-- Left Support Panel -->
            <aside class="faqpro-support">

                <div class="faqpro-support-top">
                    <span class="faqpro-top-icon">
                        <i class="bi bi-chat-square-dots"></i>
                    </span>

                    <span class="faqpro-support-label">
                        WE'RE HERE TO HELP
                    </span>
                </div>

                <h3>
                    Need a little
                    <span>extra help?</span>
                </h3>

                <p>
                    Can't find the answer you're looking for?
                    Explore our help resources or reach out
                    through our contact page.
                </p>

                <div class="faqpro-support-features">

                    <div class="faqpro-feature">
                        <span>
                            <i class="bi bi-ticket-perforated"></i>
                        </span>

                        <div>
                            <strong>Coupon Assistance</strong>
                            <small>Learn how codes and offers work</small>
                        </div>
                    </div>

                    <div class="faqpro-feature">
                        <span>
                            <i class="bi bi-shield-check"></i>
                        </span>

                        <div>
                            <strong>Shopping Guidance</strong>
                            <small>Tips for checking retailer offers</small>
                        </div>
                    </div>

                </div>

                <a href="contact.php" class="faqpro-contact">
                    Contact Support
                    <i class="bi bi-arrow-up-right"></i>
                </a>

                <div class="faqpro-decor faqpro-decor-one"
                     aria-hidden="true"></div>

                <div class="faqpro-decor faqpro-decor-two"
                     aria-hidden="true"></div>

            </aside>

            <!-- Right Accordion -->
            <div class="faqpro-questions">

                <div class="faqpro-question-header">
                    <div>
                        <span>QUICK ANSWERS</span>
                        <h3>How Can We Help You?</h3>
                    </div>

                    <span class="faqpro-question-count">
                        <?= count($faqs) ?> FAQs
                    </span>
                </div>

                <div class="accordion faqpro-accordion"
                     id="hmFaqAccordion">

                    <?php foreach ($faqs as $index => $faq): ?>

                        <div class="accordion-item">

                            <h3 class="accordion-header"
                                id="hmFaqHeading<?= $index ?>">

                                <button
                                    type="button"
                                    class="accordion-button <?= $index !== 0 ? 'collapsed' : '' ?>"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#hmFaqCollapse<?= $index ?>"
                                    aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>"
                                    aria-controls="hmFaqCollapse<?= $index ?>">

                                    <span class="faqpro-number">
                                        <?= str_pad(
                                            (string) ($index + 1),
                                            2,
                                            "0",
                                            STR_PAD_LEFT
                                        ) ?>
                                    </span>

                                    <span class="faqpro-question-title">
                                        <?= homeE($faq["question"]) ?>
                                    </span>

                                    <span class="faqpro-plus">
                                        <i class="bi bi-plus-lg"></i>
                                    </span>

                                </button>

                            </h3>

                            <div
                                id="hmFaqCollapse<?= $index ?>"
                                class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>"
                                aria-labelledby="hmFaqHeading<?= $index ?>"
                                data-bs-parent="#hmFaqAccordion">

                                <div class="accordion-body">
                                    <?= homeE($faq["answer"]) ?>
                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

                <div class="faqpro-footer-note">
                    <span>
                        <i class="bi bi-info-circle"></i>
                        Still need assistance?
                    </span>

                    <a href="contact.php">
                        Get in Touch
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>

            </div>

        </div>

    </div>
</section>

</main>

<!-- ==========================================================
     13. TOP VERIFIED COUPONS POPUP

     Reveal Code -> New Tab
     Close Popup -> Store Website
========================================================== -->

<dialog
    id="crCouponDialog"
    class="cr-dialog"
    aria-labelledby="crDialogTitle"
    data-store-url="<?= $selectedCoupon ? homeE($selectedCoupon['url']) : '' ?>"
    <?= $selectedCoupon ? 'data-auto-open="true"' : '' ?>>

    <button
        type="button"
        id="crCloseDialog"
        class="cr-dialog-close"
        aria-label="Close coupon popup and visit store">

        <i class="bi bi-x-lg"></i>
    </button>

    <?php if ($selectedCoupon): ?>

        <div
            class="cr-dialog-content"
            data-cr-store="<?= homeE($selectedCoupon['id']) ?>">

            <div class="cr-dialog-brand">

                <div class="cr-dialog-logo">

                    <img
                        src="<?= homeE(homeLogo($selectedCoupon['domain'])) ?>"
                        alt="<?= homeE($selectedCoupon['store']) ?> logo"
                        onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                    <span hidden>
                        <?= homeE($selectedCoupon["store"]) ?>
                    </span>
                </div>

                <h3><?= homeE($selectedCoupon["store"]) ?></h3>
            </div>

            <h2 class="cr-dialog-title" id="crDialogTitle">
                <?= homeE($selectedCoupon["title"]) ?>
            </h2>

            <div class="cr-dialog-code-wrap">

                <code id="crDisplayedCode"><?= homeE($selectedCoupon["code"]) ?></code>

                <button
                    type="button"
                    class="cr-dialog-copy"
                    id="crCopyButton">

                    <i class="bi bi-copy"></i>
                    <span>COPY</span>
                </button>
            </div>

            <p
                class="cr-copy-feedback"
                id="crCopyFeedback"
                role="status"
                aria-live="polite"></p>

            <p class="cr-code-instructions">
                Copy this code and visit
                <a href="<?= homeE($selectedCoupon['url']) ?>">
                    <?= homeE($selectedCoupon["store"]) ?>
                </a>
            </p>

            <div class="cr-rating-area">

                <h4>
                    Rate <?= homeE($selectedCoupon["store"]) ?>
                </h4>

                <div
                    class="cr-stars"
                    id="crRatingStars"
                    role="group"
                    aria-label="Rate this store">

                    <?php for ($star = 1; $star <= 5; $star++): ?>

                        <button
                            type="button"
                            data-cr-rating="<?= $star ?>"
                            aria-label="<?= $star ?> stars"
                            aria-pressed="false">★</button>

                    <?php endfor; ?>
                </div>

                <p id="crRatingMessage" aria-live="polite">
                    Be the first to rate this store.
                </p>

                <button
                    type="button"
                    class="cr-review-button"
                    id="crReviewToggle">
                    Leave A Review
                </button>

                <form
                    id="crReviewForm"
                    class="cr-review-form"
                    hidden>

                    <label for="crReviewText">
                        Your Review
                    </label>

                    <textarea
                        id="crReviewText"
                        rows="3"
                        maxlength="500"
                        placeholder="Share your shopping experience..."
                        required></textarea>

                    <button type="submit">
                        Save Demo Review
                    </button>
                </form>

                <p
                    id="crReviewMessage"
                    class="cr-review-message"
                    aria-live="polite"></p>

            </div>

            <p class="cr-expiry">
                Expiry: <?= homeE($selectedCoupon["expiry"]) ?>
            </p>

            <a
                href="<?= homeE($selectedCoupon['url']) ?>"
                class="cr-visit-store">

                Visit <?= homeE($selectedCoupon["store"]) ?> Store
                <i class="bi bi-arrow-up-right"></i>
            </a>

            <p class="cr-disclosure">
                Demo coupon for interface testing.
                This is not a confirmed merchant discount.
                Some links may earn a commission.
            </p>

        </div>

    <?php else: ?>

        <div class="cr-dialog-content">
            <h2 id="crDialogTitle">Coupon Unavailable</h2>
            <p>No coupon was selected.</p>
        </div>

    <?php endif; ?>

</dialog>

<!-- ==========================================================
     14. TODAY'S TOP DEALS POPUP

     Activate Offer -> New Tab Homepage Popup
     Close Popup -> Selected Merchant Website
========================================================== -->

<dialog
    id="tdOfferDialog"
    class="td-dialog"
    aria-labelledby="tdDialogTitle"
    <?= $selectedDeal ? 'data-auto-open="true"' : '' ?>>

    <button
        type="button"
        class="td-close"
        id="tdCloseDialog"
        aria-label="Close popup and visit store">

        <i class="bi bi-x-lg"></i>
    </button>

    <div class="td-dialog-content">

        <div class="td-dialog-logo">

            <img
                id="tdDialogLogo"
                alt="Store logo">

            <span id="tdLogoFallback" hidden></span>
        </div>

        <h3 class="td-dialog-store" id="tdDialogStore"></h3>

        <h2 id="tdDialogTitle"></h2>

        <div
            class="td-dialog-offer"
            id="tdDialogDiscount"></div>

        <a
            href="#"
            class="td-shop-link"
            id="tdShopLink"
            rel="noopener noreferrer">

            Shop at Store
            <i class="bi bi-arrow-up-right"></i>
        </a>

        <p class="td-no-code">
            No coupon code needed. Start shopping at
            <a href="#" id="tdStoreTextLink">the store</a>.
        </p>

        <div class="td-rating-block">

            <h4 id="tdRateHeading">
                Rate this store
            </h4>

            <div
                class="td-rating-stars"
                id="tdRatingStars"
                role="group"
                aria-label="Rate this store">

                <?php for ($star = 1; $star <= 5; $star++): ?>

                    <button
                        type="button"
                        data-td-star="<?= $star ?>"
                        aria-label="<?= $star ?> stars"
                        aria-pressed="false">★</button>

                <?php endfor; ?>
            </div>

            <p id="tdRatingMessage" aria-live="polite">
                Be the first to rate this store.
            </p>

            <button
                type="button"
                class="td-review-toggle"
                id="tdReviewToggle">

                Leave A Review
            </button>

            <form
                id="tdReviewForm"
                class="td-review-form"
                hidden>

                <label for="tdReviewText">
                    Your Review
                </label>

                <textarea
                    id="tdReviewText"
                    rows="3"
                    maxlength="500"
                    placeholder="Share your shopping experience..."
                    required></textarea>

                <button type="submit">
                    Save Demo Review
                </button>
            </form>

            <p
                id="tdReviewMessage"
                aria-live="polite"></p>

        </div>

        <h4
            class="td-dialog-expiry"
            id="tdDialogExpiry">

            Expiry not confirmed
        </h4>

        <p class="td-disclosure">
            Shopping links may earn us a commission.
            Offer availability and terms are determined by the retailer.
        </p>

    </div>
</dialog>

<!-- ==========================================================
     15. SELECTED OFFER DATA FOR JAVASCRIPT
========================================================== -->

<?php if ($selectedDeal): ?>

    <script type="application/json" id="tdSelectedOfferData"><?= json_encode(
        $selectedDeal,
        JSON_HEX_TAG |
        JSON_HEX_AMP |
        JSON_HEX_APOS |
        JSON_HEX_QUOT |
        JSON_UNESCAPED_SLASHES |
        JSON_INVALID_UTF8_SUBSTITUTE
    ) ?></script>

<?php endif; ?>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
