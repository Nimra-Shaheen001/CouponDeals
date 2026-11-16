
<?php
/* =======================================================
   COUPONDEALS — PREMIUM EDITORIAL BLOG
   Listing + Detail Page
======================================================= */

$pageTitle = "Shopping Guides & Insights | CouponDeals";

if (!function_exists("cfBlogE")) {
    function cfBlogE($value): string {
        return htmlspecialchars(
            (string)($value ?? ""),
            ENT_QUOTES | ENT_SUBSTITUTE,
            "UTF-8"
        );
    }
}

/* Original demonstration articles */

$cfBlogPosts = [
    [
        "slug" => "find-working-coupon-codes",
        "title" => "How to Find Coupon Codes That Actually Work",
        "category" => "Shopping Tips",
        "date" => "2026-10-20",
        "read" => "6 min read",
        "author" => "CouponDeals Editorial",
        "image" => "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1200&auto=format&fit=crop&q=85",
        "excerpt" => "A practical guide to checking coupon conditions, finding better offers and avoiding expired promo codes.",
        "content" => [
            "Coupon codes can make online shopping more affordable, but finding an offer that applies to your order requires a little preparation. Start with the retailer's current promotion details instead of relying only on an advertised discount percentage.",
            "Always check minimum order values, eligible categories, regional restrictions and expiration dates. Some codes apply exclusively to first-time customers, while others exclude sale items.",
            "At checkout, confirm that the promotional discount has been applied before completing payment. Compare shipping costs and the final order total to evaluate the actual saving.",
            "When an offer is unavailable, check the merchant's official promotions or compare the same product at another reputable store."
        ]
    ],
    [
        "slug" => "smart-online-shopping",
        "title" => "The Complete Guide to Smarter Online Shopping",
        "category" => "Shopping Tips",
        "date" => "2026-10-18",
        "read" => "7 min read",
        "author" => "CouponDeals Editorial",
        "image" => "https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=1100&auto=format&fit=crop&q=85",
        "excerpt" => "Small changes to your shopping habits can help you make better purchases.",
        "content" => [
            "Smarter online shopping begins with understanding what you need. Make a short list of priorities and establish a budget before browsing products.",
            "Compare equivalent models and review total costs, including delivery, taxes and any additional charges.",
            "Look at current customer feedback and confirm return conditions. Product details such as measurements, materials and compatibility can matter more than promotional labels.",
            "Avoid rushing into a purchase simply because a countdown or limited-time banner is displayed."
        ]
    ],
    [
        "slug" => "fashion-sale-shopping",
        "title" => "How to Shop Fashion Sales Like a Pro",
        "category" => "Fashion",
        "date" => "2026-10-16",
        "read" => "5 min read",
        "author" => "CouponDeals Editorial",
        "image" => "https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1100&auto=format&fit=crop&q=85",
        "excerpt" => "Find clothing and accessories that offer genuine value beyond the sale price.",
        "content" => [
            "Start a fashion sale with an idea of which pieces you want to add to your wardrobe. Focus on fit, materials and versatility.",
            "Use the retailer's size charts carefully and confirm whether discounted products are eligible for returns.",
            "Compare the quality and intended use of similar items before making a choice.",
            "A versatile item that you wear frequently may be a better purchase than a heavily discounted item you rarely use."
        ]
    ],
    [
        "slug" => "electronics-buying-guide",
        "title" => "What to Check Before Buying Electronics Online",
        "category" => "Technology",
        "date" => "2026-10-14",
        "read" => "8 min read",
        "author" => "CouponDeals Editorial",
        "image" => "https://images.unsplash.com/photo-1498049794561-7780e7231661?w=1100&auto=format&fit=crop&q=85",
        "excerpt" => "Compare specifications, warranties and seller information before buying.",
        "content" => [
            "Electronics are easier to compare when you begin with your actual use case and the specifications that support it.",
            "Review storage, battery life, connectivity and compatibility where relevant. A newer model is not automatically the better choice for every buyer.",
            "Check seller credibility and warranty coverage. Some marketplace listings may have different warranty terms.",
            "Compare the final price of the same model from reputable retailers, and account for shipping and return costs."
        ]
    ],
    [
        "slug" => "beauty-shopping-essentials",
        "title" => "Beauty Shopping Essentials Worth Knowing",
        "category" => "Beauty",
        "date" => "2026-10-12",
        "read" => "5 min read",
        "author" => "CouponDeals Editorial",
        "image" => "https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=1100&auto=format&fit=crop&q=85",
        "excerpt" => "Find products that meet your needs while comparing size, ingredients and value.",
        "content" => [
            "When comparing beauty products, consider what you need from the product and review the manufacturer's directions.",
            "Ingredient lists, packaging sizes and shelf life can be helpful when making comparisons.",
            "Bundles are not necessarily better value. Compare price per unit and whether you will use everything included.",
            "Follow the manufacturer's safety instructions and be cautious about unsupported claims."
        ]
    ],
    [
        "slug" => "home-decor-on-budget",
        "title" => "Refreshing Your Home on a Realistic Budget",
        "category" => "Home & Living",
        "date" => "2026-10-11",
        "read" => "6 min read",
        "author" => "CouponDeals Editorial",
        "image" => "https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=1100&auto=format&fit=crop&q=85",
        "excerpt" => "Simple ways to shop for home décor, furniture and everyday essentials.",
        "content" => [
            "A home refresh does not always require replacing large furniture pieces. Smaller accessories can make a noticeable difference.",
            "Measure your space before ordering furniture and check material specifications and assembly requirements.",
            "Compare delivery fees carefully, particularly for bulky items.",
            "Choose pieces that complement your existing space rather than purchasing only because they are discounted."
        ]
    ],
    [
        "slug" => "holiday-shopping-plan",
        "title" => "How to Prepare for Seasonal Shopping Events",
        "category" => "Seasonal Savings",
        "date" => "2026-10-09",
        "read" => "6 min read",
        "author" => "CouponDeals Editorial",
        "image" => "https://images.unsplash.com/photo-1513201099705-a9746e1e201f?w=1100&auto=format&fit=crop&q=85",
        "excerpt" => "Plan ahead, compare regular prices and avoid unnecessary spending.",
        "content" => [
            "Seasonal shopping events can be useful opportunities to purchase items you already intend to buy.",
            "Prepare a list and compare historical or normal prices where reliable information is available.",
            "Check shipping deadlines, retailer terms and return windows before checkout.",
            "Stick to a planned budget and evaluate the final cost instead of focusing solely on discount labels."
        ]
    ],
    [
        "slug" => "free-shipping-explained",
        "title" => "Free Shipping Offers: When Are They Worth It?",
        "category" => "Shopping Tips",
        "date" => "2026-10-07",
        "read" => "4 min read",
        "author" => "CouponDeals Editorial",
        "image" => "https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=1100&auto=format&fit=crop&q=85",
        "excerpt" => "Understand minimum spend requirements and total-order savings.",
        "content" => [
            "A free shipping offer can be attractive, but many retailers require a minimum spend before it applies.",
            "Compare the delivery fee with the cost of adding more products to your order.",
            "Buying additional products only to qualify for free shipping may cost more overall.",
            "Review delivery speeds and return-shipping policies as part of the total purchase cost."
        ]
    ],
    [
        "slug" => "choose-better-gifts",
        "title" => "How to Choose Thoughtful Gifts Online",
        "category" => "Lifestyle",
        "date" => "2026-10-05",
        "read" => "5 min read",
        "author" => "CouponDeals Editorial",
        "image" => "https://images.unsplash.com/photo-1513201099705-a9746e1e201f?w=1100&auto=format&fit=crop&q=85",
        "excerpt" => "Find suitable gift ideas and compare options without overspending.",
        "content" => [
            "A good gift starts with thinking about the recipient's interests, preferences and practical needs.",
            "Compare product descriptions, materials and packaging when purchasing gifts online.",
            "Confirm delivery dates if the item is needed for a particular occasion.",
            "A thoughtful, useful gift is often more meaningful than an expensive impulse purchase."
        ]
    ]
];

usort($cfBlogPosts, function ($a, $b) {
    return strcmp($b["date"], $a["date"]);
});

$cfBlogCategories = array_values(
    array_unique(array_column($cfBlogPosts, "category"))
);
sort($cfBlogCategories, SORT_NATURAL | SORT_FLAG_CASE);

$cfSlug = $_GET["slug"] ?? "";
$cfPost = null;

if (is_string($cfSlug) && $cfSlug !== "") {
    foreach ($cfBlogPosts as $post) {
        if ($post["slug"] === $cfSlug) {
            $cfPost = $post;
            break;
        }
    }

    if (!$cfPost) {
        http_response_code(404);
    }
}

if ($cfPost) {
    $pageTitle = $cfPost["title"] . " | CouponDeals";
}

function cfBlogDate(string $date): string {
    return date("M d, Y", strtotime($date));
}

require_once __DIR__ . "/includes/header.php";
?>

<main class="bl-page" id="blPage">

<?php if ($cfSlug !== ""): ?>

    <!-- ARTICLE DETAIL -->

    <?php if ($cfPost): ?>

        <article class="bl-detail">

            <div class="container">

                <nav class="bl-breadcrumb" aria-label="Breadcrumb">
                    <a href="index.php">Home</a>
                    <i class="bi bi-chevron-right"></i>
                    <a href="blog.php">Blog</a>
                    <i class="bi bi-chevron-right"></i>
                    <span><?= cfBlogE($cfPost["category"]) ?></span>
                </nav>

                <header class="bl-detail-header">

                    <span class="bl-category-label">
                        <?= cfBlogE($cfPost["category"]) ?>
                    </span>

                    <h1><?= cfBlogE($cfPost["title"]) ?></h1>

                    <p><?= cfBlogE($cfPost["excerpt"]) ?></p>

                    <div class="bl-article-meta">
                        <span>
                            <i class="bi bi-person-circle"></i>
                            <?= cfBlogE($cfPost["author"]) ?>
                        </span>

                        <span>
                            <i class="bi bi-calendar3"></i>
                            <?= cfBlogDate($cfPost["date"]) ?>
                        </span>

                        <span>
                            <i class="bi bi-clock"></i>
                            <?= cfBlogE($cfPost["read"]) ?>
                        </span>
                    </div>

                </header>

                <div class="bl-detail-cover">
                    <img
                        src="<?= cfBlogE($cfPost["image"]) ?>"
                        alt="<?= cfBlogE($cfPost["title"]) ?>">
                </div>

                <div class="bl-detail-layout">

                    <div class="bl-article-body">

                        <p class="bl-lead">
                            <?= cfBlogE($cfPost["excerpt"]) ?>
                        </p>

                        <?php foreach ($cfPost["content"] as $index => $paragraph): ?>

                            <?php if ($index === 1): ?>
                                <h2>What Should You Consider?</h2>
                            <?php elseif ($index === 3): ?>
                                <h2>Final Shopping Tips</h2>
                            <?php endif; ?>

                            <p><?= cfBlogE($paragraph) ?></p>

                        <?php endforeach; ?>

                        <div class="bl-article-note">
                            <i class="bi bi-lightbulb"></i>
                            <p>
                                Always compare current merchant prices
                                and review the retailer's terms before
                                completing a purchase.
                            </p>
                        </div>

                        <div class="bl-share-row">
                            <strong>Share this article</strong>

                            <button type="button"
                                    id="blCopyLink"
                                    aria-label="Copy article link">
                                <i class="bi bi-link-45deg"></i>
                                <span>Copy Link</span>
                            </button>
                        </div>

                    </div>

                    <aside class="bl-detail-aside">

                        <h3>More From Our Journal</h3>

                        <?php
                        $related = array_values(array_filter(
                            $cfBlogPosts,
                            fn($p) => $p["slug"] !== $cfPost["slug"]
                        ));
                        ?>

                        <?php foreach (array_slice($related, 0, 3) as $relatedPost): ?>

                            <a href="blog.php?slug=<?= rawurlencode($relatedPost["slug"]) ?>"
                               class="bl-related-item">

                                <img
                                    src="<?= cfBlogE($relatedPost["image"]) ?>"
                                    alt=""
                                    loading="lazy">

                                <span>
                                    <small><?= cfBlogE($relatedPost["category"]) ?></small>
                                    <strong><?= cfBlogE($relatedPost["title"]) ?></strong>
                                </span>

                            </a>

                        <?php endforeach; ?>

                        <a href="blog.php" class="bl-aside-all">
                            View All Articles
                            <i class="bi bi-arrow-up-right"></i>
                        </a>

                    </aside>

                </div>

            </div>

        </article>

    <?php else: ?>

        <section class="bl-not-found container">
            <h1>Article Not Found</h1>
            <p>The article you're looking for is unavailable.</p>
            <a href="blog.php">Browse Articles</a>
        </section>

    <?php endif; ?>

<?php else: ?>

    <!-- LISTING HERO -->

    <section class="bl-hero">
        <div class="container">

            <nav class="bl-breadcrumb" aria-label="Breadcrumb">
                <a href="index.php">
                    <i class="bi bi-house-door"></i> Home
                </a>
                <i class="bi bi-chevron-right"></i>
                <span>Blog</span>
            </nav>

            <div class="bl-hero-heading">
                <div>
                    <span class="bl-eyebrow">
                        <i class="bi bi-journal-richtext"></i>
                        THE COUPONDeals JOURNAL
                    </span>

                    <h1>Shopping Stories <span>& Smart Savings.</span></h1>

                    <p>
                        In-depth shopping guides, fresh ideas and
                        helpful advice to make better buying decisions.
                    </p>
                </div>

                <a href="#blLatest" class="bl-explore-link">
                    Explore Articles
                    <i class="bi bi-arrow-down-right"></i>
                </a>
            </div>

        </div>
    </section>

    <!-- MAGAZINE HERO: FEATURED + TWO STORIES -->

    <section class="bl-featured-section">
        <div class="container">

            <div class="bl-section-heading">
                <div>
                    <span class="bl-eyebrow">EDITOR'S SELECTION</span>
                    <h2>Featured <span>Stories</span></h2>
                </div>
            </div>

            <div class="bl-featured-layout">

                <?php $mainPost = $cfBlogPosts[0]; ?>

                <a class="bl-main-feature"
                   href="blog.php?slug=<?= rawurlencode($mainPost["slug"]) ?>">

                    <img
                        src="<?= cfBlogE($mainPost["image"]) ?>"
                        alt="<?= cfBlogE($mainPost["title"]) ?>">

                    <span class="bl-image-shade"></span>

                    <div class="bl-main-feature-content">
                        <span class="bl-feature-tag">
                            <i class="bi bi-stars"></i>
                            FEATURED GUIDE
                        </span>

                        <h2><?= cfBlogE($mainPost["title"]) ?></h2>

                        <p><?= cfBlogE($mainPost["excerpt"]) ?></p>

                        <span class="bl-feature-read">
                            Read Story
                            <i class="bi bi-arrow-up-right"></i>
                        </span>
                    </div>
                </a>

                <div class="bl-side-features">

                    <?php foreach (array_slice($cfBlogPosts, 1, 2) as $post): ?>

                        <a href="blog.php?slug=<?= rawurlencode($post["slug"]) ?>"
                           class="bl-side-feature">

                            <img
                                src="<?= cfBlogE($post["image"]) ?>"
                                alt="<?= cfBlogE($post["title"]) ?>"
                                loading="lazy">

                            <div>
                                <span class="bl-side-category">
                                    <?= cfBlogE($post["category"]) ?>
                                </span>

                                <h3><?= cfBlogE($post["title"]) ?></h3>

                                <small>
                                    <?= cfBlogDate($post["date"]) ?>
                                    <span>•</span>
                                    <?= cfBlogE($post["read"]) ?>
                                </small>
                            </div>

                        </a>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>
    </section>

    <!-- ARTICLE DIRECTORY -->

    <section class="bl-latest-section" id="blLatest">
        <div class="container">

            <div class="bl-section-heading bl-latest-heading">
                <div>
                    <span class="bl-eyebrow">LATEST FROM THE JOURNAL</span>
                    <h2>Latest <span>Articles</span></h2>
                    <p>Explore our newest shopping stories and guides.</p>
                </div>

                <span class="bl-result-count"
                      id="blResultCount"
                      aria-live="polite">
                    <?= count($cfBlogPosts) ?> Articles
                </span>
            </div>

            <!-- FILTER BAR -->

            <div class="bl-filter-panel">

                <label class="bl-search-box">
                    <i class="bi bi-search"></i>
                    <input
                        type="search"
                        id="blSearch"
                        placeholder="Search articles, topics or guides..."
                        aria-label="Search articles">
                </label>

                <select id="blCategory" aria-label="Select article category">
                    <option value="">All Categories</option>

                    <?php foreach ($cfBlogCategories as $cat): ?>
                        <option value="<?= cfBlogE($cat) ?>">
                            <?= cfBlogE($cat) ?>
                        </option>
                    <?php endforeach; ?>

                </select>

                <button type="button" id="blReset">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </button>

            </div>

            <!-- TOPIC CHIPS -->

            <div class="bl-topics" id="blTopics">

                <button type="button"
                        class="bl-topic active"
                        data-category=""
                        aria-pressed="true">
                    All Articles
                </button>

                <?php foreach ($cfBlogCategories as $cat): ?>
                    <button type="button"
                            class="bl-topic"
                            data-category="<?= cfBlogE($cat) ?>"
                            aria-pressed="false">
                        <?= cfBlogE($cat) ?>
                    </button>
                <?php endforeach; ?>

            </div>

            <!-- CARDS -->

            <div class="bl-articles-grid" id="blGrid">

                <?php foreach ($cfBlogPosts as $post): ?>

                    <article
                        class="bl-article-card"
                        data-search="<?= cfBlogE($post["title"] . ' ' . $post["excerpt"] . ' ' . $post["category"]) ?>"
                        data-category="<?= cfBlogE($post["category"]) ?>">

                        <a class="bl-card-image"
                           href="blog.php?slug=<?= rawurlencode($post["slug"]) ?>">

                            <img
                                src="<?= cfBlogE($post["image"]) ?>"
                                alt="<?= cfBlogE($post["title"]) ?>"
                                loading="lazy">

                            <span class="bl-card-category">
                                <?= cfBlogE($post["category"]) ?>
                            </span>

                        </a>

                        <div class="bl-card-content">

                            <div class="bl-card-meta">
                                <span>
                                    <i class="bi bi-calendar3"></i>
                                    <?= cfBlogDate($post["date"]) ?>
                                </span>

                                <span>
                                    <i class="bi bi-clock"></i>
                                    <?= cfBlogE($post["read"]) ?>
                                </span>
                            </div>

                            <h3>
                                <a href="blog.php?slug=<?= rawurlencode($post["slug"]) ?>">
                                    <?= cfBlogE($post["title"]) ?>
                                </a>
                            </h3>

                            <p><?= cfBlogE($post["excerpt"]) ?></p>

                            <div class="bl-card-footer">

                                <span>
                                    <i class="bi bi-person-circle"></i>
                                    Editorial Team
                                </span>

                                <a href="blog.php?slug=<?= rawurlencode($post["slug"]) ?>"
                                   aria-label="Read <?= cfBlogE($post["title"]) ?>">
                                    <i class="bi bi-arrow-up-right"></i>
                                </a>

                            </div>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

            <div class="bl-empty" id="blEmpty" hidden>
                <i class="bi bi-search"></i>
                <h3>No Articles Found</h3>
                <p>Try another search or browse a different topic.</p>
                <button type="button" id="blEmptyReset">
                    Clear Filters
                </button>
            </div>

            <nav class="bl-pagination"
                 id="blPagination"
                 aria-label="Article pagination">
            </nav>

        </div>
    </section>

<?php endif; ?>

</main>

<script src="assets/js/blog.js?v=5" defer></script>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
