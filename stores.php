
<?php
/* =====================================================
   COUPONDeals — ALL STORES PAGE
   PHP 8+ | Bootstrap 5.3
   A-Z Directory | Live Search | Featured Stores
===================================================== */

$pageTitle = "All Stores & Brands | CouponDeals";

/* HTML escape helper */
if (!function_exists("sdirE")) {
    function sdirE($value): string
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

/* Brand favicon URL */
if (!function_exists("sdirLogo")) {
    function sdirLogo(string $domain): string
    {
        return "https://www.google.com/s2/favicons?domain="
            . rawurlencode($domain)
            . "&sz=128";
    }
}

/*
 * SAMPLE STORE DIRECTORY
 * Format: Store Name|Domain
 * Replace or expand when database is ready.
 */

$sdirRaw = [

    "A" => [
        "Adidas|adidas.com",
        "Amazon|amazon.com",
        "Apple|apple.com",
        "ASOS|asos.com",
        "Airbnb|airbnb.com",
        "AliExpress|aliexpress.com",
        "Anker|anker.com",
        "Acer|acer.com",
        "American Eagle|ae.com",
        "Anthropologie|anthropologie.com",
        "Aveda|aveda.com"
    ],

    "B" => [
        "Best Buy|bestbuy.com",
        "Booking.com|booking.com",
        "Boohoo|boohoo.com",
        "Bath & Body Works|bathandbodyworks.com",
        "Burberry|burberry.com",
        "Bose|bose.com",
        "Bloomingdale's|bloomingdales.com",
        "Bershka|bershka.com",
        "Birkenstock|birkenstock.com"
    ],

    "C" => [
        "Calvin Klein|calvinklein.us",
        "Canva|canva.com",
        "Chewy|chewy.com",
        "Crocs|crocs.com",
        "Costco|costco.com",
        "Coach|coach.com",
        "Canon|canon.com",
        "Columbia|columbia.com",
        "Converse|converse.com"
    ],

    "D" => [
        "Dell|dell.com",
        "Dyson|dyson.com",
        "DoorDash|doordash.com",
        "Disney Store|disneystore.com",
        "Domino's|dominos.com",
        "DICK'S Sporting Goods|dickssportinggoods.com",
        "Dr. Martens|drmartens.com",
        "Dior|dior.com",
        "Dollar Tree|dollartree.com"
    ],

    "E" => [
        "eBay|ebay.com",
        "Etsy|etsy.com",
        "Expedia|expedia.com",
        "Estee Lauder|esteelauder.com",
        "Epic Games|epicgames.com",
        "ECCO|ecco.com",
        "Everlane|everlane.com",
        "Electrolux|electrolux.com",
        "Epson|epson.com"
    ],

    "F" => [
        "Farfetch|farfetch.com",
        "Foot Locker|footlocker.com",
        "Fossil|fossil.com",
        "Fiverr|fiverr.com",
        "Fabletics|fabletics.com",
        "Fanatics|fanatics.com",
        "Finish Line|finishline.com",
        "Fitbit|fitbit.com",
        "Fashion Nova|fashionnova.com"
    ],

    "G" => [
        "Gap|gap.com",
        "GoDaddy|godaddy.com",
        "Gymshark|gymshark.com",
        "Google Store|store.google.com",
        "Garmin|garmin.com",
        "Gucci|gucci.com",
        "Groupon|groupon.com",
        "GameStop|gamestop.com",
        "Guess|guess.com"
    ],

    "H" => [
        "H&M|hm.com",
        "Harrods|harrods.com",
        "HP|hp.com",
        "Hollister|hollisterco.com",
        "Home Depot|homedepot.com",
        "Hilton|hilton.com",
        "Hugo Boss|hugoboss.com",
        "Hotels.com|hotels.com",
        "Huawei|huawei.com"
    ],

    "I" => [
        "IKEA|ikea.com",
        "Instacart|instacart.com",
        "Indeed|indeed.com",
        "Intel|intel.com",
        "iHerb|iherb.com",
        "iRobot|irobot.com",
        "Insta360|insta360.com",
        "Intimissimi|intimissimi.com",
        "IHG Hotels|ihg.com"
    ],

    "J" => [
        "JD Sports|jdsports.com",
        "JBL|jbl.com",
        "J.Crew|jcrew.com",
        "JCPenney|jcpenney.com",
        "John Lewis|johnlewis.com",
        "Jimmy Choo|jimmychoo.com",
        "Just Eat|just-eat.com",
        "Joma|joma-sport.com",
        "JYSK|jysk.com"
    ],

    "K" => [
        "Kate Spade|katespade.com",
        "Klook|klook.com",
        "Kohl's|kohls.com",
        "Kiehl's|kiehls.com",
        "Kurt Geiger|kurtgeiger.com",
        "Kaspersky|kaspersky.com",
        "KitchenAid|kitchenaid.com",
        "Krispy Kreme|krispykreme.com",
        "Kay Jewelers|kay.com"
    ],

    "L" => [
        "Lacoste|lacoste.com",
        "LEGO|lego.com",
        "Lenovo|lenovo.com",
        "Levi's|levi.com",
        "Lululemon|lululemon.com",
        "L'Oreal|loreal.com",
        "Logitech|logitech.com",
        "Louis Vuitton|louisvuitton.com",
        "Lands' End|landsend.com"
    ],

    "M" => [
        "Macy's|macys.com",
        "Microsoft|microsoft.com",
        "Myprotein|myprotein.com",
        "Marks & Spencer|marksandspencer.com",
        "Michael Kors|michaelkors.com",
        "Mango|shop.mango.com",
        "Motorola|motorola.com",
        "Marriott|marriott.com",
        "Michaels|michaels.com"
    ],

    "N" => [
        "Nike|nike.com",
        "New Balance|newbalance.com",
        "Newegg|newegg.com",
        "Nordstrom|nordstrom.com",
        "Netflix|netflix.com",
        "Nintendo|nintendo.com",
        "Nespresso|nespresso.com",
        "NARS Cosmetics|narscosmetics.com",
        "Norton|norton.com"
    ],

    "O" => [
        "Old Navy|oldnavy.gap.com",
        "Oakley|oakley.com",
        "OnePlus|oneplus.com",
        "Office Depot|officedepot.com",
        "O'Neill|oneill.com",
        "Origin PC|originpc.com",
        "Ocado|ocado.com",
        "Olay|olay.com",
        "Ooni|ooni.com"
    ],

    "P" => [
        "Pandora|pandora.net",
        "Puma|puma.com",
        "Petco|petco.com",
        "PayPal|paypal.com",
        "Philips|philips.com",
        "Pizza Hut|pizzahut.com",
        "Patagonia|patagonia.com",
        "PlayStation|playstation.com",
        "Peacock|peacocktv.com"
    ],

    "Q" => [
        "Quiksilver|quiksilver.com",
        "QVC|qvc.com",
        "Quince|quince.com",
        "Qatar Airways|qatarairways.com",
        "Quiz Clothing|quizclothing.co.uk",
        "QuickBooks|quickbooks.intuit.com",
        "Qobuz|qobuz.com",
        "Quorn|quorn.co.uk",
        "QDOBA|qdoba.com"
    ],

    "R" => [
        "Ralph Lauren|ralphlauren.com",
        "Ray-Ban|ray-ban.com",
        "Reebok|reebok.com",
        "Razer|razer.com",
        "Rakuten|rakuten.com",
        "River Island|riverisland.com",
        "Rituals|rituals.com",
        "Ryanair|ryanair.com",
        "RODE|rode.com"
    ],

    "S" => [
        "Samsung|samsung.com",
        "Sephora|sephora.com",
        "SHEIN|shein.com",
        "Sony|sony.com",
        "Skechers|skechers.com",
        "Spotify|spotify.com",
        "Starbucks|starbucks.com",
        "Shutterstock|shutterstock.com",
        "Swarovski|swarovski.com",
        "Staples|staples.com",
        "Stradivarius|stradivarius.com"
    ],

    "T" => [
        "Target|target.com",
        "The Body Shop|thebodyshop.com",
        "Tommy Hilfiger|tommy.com",
        "Tesco|tesco.com",
        "Timberland|timberland.com",
        "Tory Burch|toryburch.com",
        "T-Mobile|t-mobile.com",
        "Tripadvisor|tripadvisor.com",
        "TUMI|tumi.com"
    ],

    "U" => [
        "UGG|ugg.com",
        "Ulta Beauty|ulta.com",
        "Under Armour|underarmour.com",
        "Uber Eats|ubereats.com",
        "Uniqlo|uniqlo.com",
        "Udemy|udemy.com",
        "Urban Outfitters|urbanoutfitters.com",
        "Ubuy|ubuy.com",
        "US Polo Assn|uspoloassn.com"
    ],

    "V" => [
        "Victoria's Secret|victoriassecret.com",
        "Vans|vans.com",
        "Verizon|verizon.com",
        "Vistaprint|vistaprint.com",
        "Vero Moda|veromoda.com",
        "Vichy|vichyusa.com",
        "Vitamix|vitamix.com",
        "Virgin Atlantic|virginatlantic.com",
        "Vimeo|vimeo.com"
    ],

    "W" => [
        "Walmart|walmart.com",
        "Wayfair|wayfair.com",
        "Wix|wix.com",
        "Walgreens|walgreens.com",
        "Wrangler|wrangler.com",
        "West Elm|westelm.com",
        "Warby Parker|warbyparker.com",
        "Woot|woot.com",
        "Wilson|wilson.com"
    ],

    "X" => [
        "Xbox|xbox.com",
        "Xiaomi|mi.com",
        "Xfinity|xfinity.com",
        "Xero|xero.com",
        "XPG|xpg.com",
        "Xtrons|xtrons.com",
        "X-Sense|x-sense.com",
        "XPPen|xp-pen.com",
        "XTool|xtool.com"
    ],

    "Y" => [
        "YETI|yeti.com",
        "Yves Rocher|yves-rocher.com",
        "Yankee Candle|yankeecandle.com",
        "YOOX|yoox.com",
        "Yamaha|yamaha.com",
        "Yves Saint Laurent|ysl.com",
        "YesStyle|yesstyle.com",
        "YouTube|youtube.com",
        "Yelp|yelp.com"
    ],

    "Z" => [
        "Zappos|zappos.com",
        "Zara|zara.com",
        "Zazzle|zazzle.com",
        "Zenni Optical|zennioptical.com",
        "Zalando|zalando.com",
        "ZAGG|zagg.com",
        "Zotac|zotac.com",
        "Zoom|zoom.us",
        "Zipcar|zipcar.com"
    ],

    "#" => [
        "1-800-Flowers|1800flowers.com",
        "6pm|6pm.com",
        "123Greetings|123greetings.com",
        "2K Games|2k.com",
        "24S|24s.com",
        "3M|3m.com",
        "7 For All Mankind|7forallmankind.com",
        "1800 Contacts|1800contacts.com",
        "10Web|10web.io"
    ]
];

/* =====================================================
   PREPARE A-Z GROUPS
===================================================== */

$sdirLetters = array_merge(range("A", "Z"), ["#"]);

$sdirGroups = [];
$sdirTotalStores = 0;

foreach ($sdirLetters as $letter) {

    $sdirGroups[$letter] = [];

    foreach (($sdirRaw[$letter] ?? []) as $rawStore) {

        $parts = explode("|", $rawStore, 2);

        if (count($parts) !== 2) {
            continue;
        }

        $name = trim($parts[0]);
        $domain = trim($parts[1]);

        if ($name === "" || $domain === "") {
            continue;
        }

        $sdirGroups[$letter][] = [
            "name" => $name,
            "domain" => $domain
        ];
    }

    usort(
        $sdirGroups[$letter],
        static fn($a, $b) =>
            strcasecmp($a["name"], $b["name"])
    );

    $sdirTotalStores += count($sdirGroups[$letter]);
}

/* Search query */

$sdirQuery = "";

if (
    isset($_GET["q"]) &&
    is_string($_GET["q"])
) {
    $sdirQuery = substr(trim($_GET["q"]), 0, 100);
}

/* Load site header */

require_once __DIR__ . "/includes/header.php";
?>

<!-- ==============================================
     ALL STORES PAGE
============================================== -->

<main class="sdir-page" id="sdirPage">

    <!-- HERO SECTION -->

    <section class="sdir-hero" id="storesTop">

        <div class="container">

            <!-- Breadcrumb -->

            <nav class="sdir-breadcrumb"
                 aria-label="Breadcrumb">

                <a href="index.php">
                    <i class="bi bi-house-door"></i>
                    Home
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>All Stores</span>

            </nav>

            <div class="sdir-hero-content">

                <h1>
                    Explore All Stores on
                    <span>CouponDeals</span>
                </h1>

                <p>
                    Discover popular shopping brands and explore
                    our store directory alphabetically.
                    Find your favorite stores in one place.
                </p>

                <!-- Store Search -->

                <form
                    class="sdir-search"
                    id="sdirSearchForm"
                    role="search"
                    action="stores.php"
                    method="get">

                    <i class="bi bi-search"
                       aria-hidden="true"></i>

                    <input
                        type="search"
                        id="sdirSearch"
                        name="q"
                        value="<?= sdirE($sdirQuery) ?>"
                        placeholder="Search stores, e.g. Nike, Amazon, Sephora"
                        aria-label="Search stores"
                        autocomplete="off"
                        maxlength="100">

                    <button
                        type="button"
                        id="sdirClear"
                        class="sdir-clear-btn"
                        aria-label="Clear search"
                        hidden>

                        <i class="bi bi-x-lg"></i>

                    </button>

                </form>

            </div>

            <!-- A-Z + # Alphabet Tiles -->

            <div class="sdir-alphabet"
                 id="sdirAlphabet">

                <?php foreach ($sdirLetters as $letter): ?>

                    <?php
                    $letterCount = count($sdirGroups[$letter]);
                    ?>

                    <button
                        type="button"
                        class="sdir-letter-tile"
                        data-letter="<?= sdirE($letter) ?>"
                        aria-label="Browse <?= sdirE($letter) ?> stores"
                        aria-pressed="false">

                        <strong>
                            <?= sdirE($letter) ?>
                        </strong>

                        <span>
                            <b data-letter-count>
                                <?= $letterCount ?>
                            </b>
                            Stores
                        </span>

                    </button>

                <?php endforeach; ?>

            </div>

            <div class="sdir-browse-label">
                <span>BROWSE STORES BY LETTER</span>
                <i class="bi bi-arrow-down"></i>
            </div>

        </div>

    </section>

    <!-- ==========================================
         LETTER-WISE STORE DIRECTORY
    ========================================== -->

    <section class="sdir-directory"
             id="sdirDirectory">

        <div class="container">

            <!-- Results / Reset -->

            <div class="sdir-results-row">

                <span id="sdirResultCount"
                      aria-live="polite">

                    <?= $sdirTotalStores ?> stores available

                </span>

                <button type="button" id="sdirReset">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Clear Search
                </button>

            </div>

            <div id="sdirGroups">

                <?php foreach ($sdirLetters as $letter): ?>

                    <?php
                    $stores = $sdirGroups[$letter];

                    if (empty($stores)) {
                        continue;
                    }

                    $groupId = $letter === "#"
                        ? "Hash"
                        : $letter;

                    /*
                     * First 6 stores are featured.
                     * Remaining stores display as
                     * horizontal cards.
                     */
                    $featuredStores = array_slice(
                        $stores,
                        0,
                        6
                    );

                    $additionalStores = array_slice(
                        $stores,
                        6
                    );
                    ?>

                    <section
                        class="sdir-group"
                        id="sdirGroup<?= sdirE($groupId) ?>"
                        data-group-letter="<?= sdirE($letter) ?>">

                        <!-- Group Heading -->

                        <div class="sdir-group-heading">

                            <h2>
                                Featured
                                “<?= sdirE($letter) ?>”
                                Stores
                            </h2>

                            <button
                                type="button"
                                class="sdir-view-more"
                                aria-expanded="false">

                                <span>View More</span>

                                <i class="bi bi-arrow-right"></i>

                            </button>

                        </div>

                        <!-- Featured Store Logos -->

                        <div class="sdir-featured-grid">

                            <?php foreach ($featuredStores as $store): ?>

                                <?php
                                $storeUrl = "coupon.php?store=" .
                                    rawurlencode($store["name"]) .
                                    "#ccLatest";
                                ?>

                                <a
                                    href="<?= sdirE($storeUrl) ?>"
                                    class="sdir-featured-item"
                                    data-store-name="<?= sdirE($store["name"]) ?>">

                                    <div class="sdir-featured-logo">

                                        <img
                                            src="<?= sdirE(
                                                sdirLogo($store["domain"])
                                            ) ?>"
                                            alt="<?= sdirE($store["name"]) ?> logo"
                                            loading="lazy"
                                            onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                                        <span hidden>
                                            <?= sdirE(
                                                strtoupper(substr($store["name"], 0, 1))
                                            ) ?>
                                        </span>

                                    </div>

                                    <strong>
                                        <?= sdirE($store["name"]) ?>
                                    </strong>

                                    <small>
                                        View Coupons
                                    </small>

                                </a>

                            <?php endforeach; ?>

                        </div>

                        <!-- Additional Horizontal Stores -->

                        <div class="sdir-small-grid">

                            <?php foreach ($additionalStores as $index => $store): ?>

                                <?php
                                $storeUrl = "coupon.php?store=" .
                                    rawurlencode($store["name"]) .
                                    "#ccLatest";
                                ?>

                                <a
                                    href="<?= sdirE($storeUrl) ?>"
                                    class="sdir-small-card"
                                    data-store-name="<?= sdirE($store["name"]) ?>"
                                    data-extra-index="<?= (int)$index ?>">

                                    <div class="sdir-small-logo">

                                        <img
                                            src="<?= sdirE(
                                                sdirLogo($store["domain"])
                                            ) ?>"
                                            alt="<?= sdirE($store["name"]) ?> logo"
                                            loading="lazy"
                                            onerror="this.hidden=true;this.nextElementSibling.hidden=false;">

                                        <span hidden>
                                            <?= sdirE(
                                                strtoupper(substr($store["name"], 0, 1))
                                            ) ?>
                                        </span>

                                    </div>

                                    <div class="sdir-small-info">

                                        <strong>
                                            <?= sdirE($store["name"]) ?>
                                        </strong>

                                        <span>
                                            Browse Coupons
                                            <i class="bi bi-arrow-up-right"></i>
                                        </span>

                                    </div>

                                </a>

                            <?php endforeach; ?>

                        </div>

                    </section>

                <?php endforeach; ?>

            </div>

            <!-- No Results -->

            <div class="sdir-empty"
                 id="sdirEmpty"
                 hidden>

                <i class="bi bi-search"></i>

                <h3>No Stores Found</h3>

                <p>
                    We couldn't find a matching store.
                    Try another name or clear your search.
                </p>

                <button type="button"
                        id="sdirEmptyReset">

                    Clear Search
                    <i class="bi bi-arrow-right"></i>

                </button>

            </div>

        </div>

    </section>

    <!-- ==========================================
         BOTTOM CTA - TWO BUTTONS
    ========================================== -->

    <section class="sdir-bottom-cta">

        <div class="container">

            <div class="sdir-cta-inner">

                <span class="sdir-cta-eyebrow">
                    <i class="bi bi-stars"></i>
                    YOUR SMART SHOPPING COMPANION
                </span>

                <h2>
                    Discover More.
                    <span>Save Smarter.</span>
                </h2>

                <p>
                    Explore coupon codes and shopping offers
                    from your favorite online stores.
                    Find your next great deal with CouponDeals.
                </p>

                <div class="sdir-cta-actions">

                    <a href="coupon.php"
                       class="sdir-cta-primary">

                        <i class="bi bi-ticket-perforated"></i>

                        Browse Coupons

                        <i class="bi bi-arrow-up-right"></i>

                    </a>

                    <a href="#storesTop"
                       class="sdir-cta-secondary">

                        <i class="bi bi-arrow-up-circle"></i>

                        Back to Top

                        <i class="bi bi-arrow-up-right"></i>

                    </a>

                </div>

            </div>

        </div>

    </section>

</main>

<!-- Stores functionality -->
<script src="assets/js/stores.js?v=7" defer></script>

<!-- Shared footer -->
<?php require_once __DIR__ . "/includes/footer.php"; ?>
