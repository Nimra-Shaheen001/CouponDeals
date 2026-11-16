
<?php
$pageTitle = "Frequently Asked Questions | CouponDeals";
$pageDescription = "Find answers to frequently asked questions about coupon codes, discounts, deals, shopping and CouponDeals.";

$faqGroups = [
    [
        'id' => 'general',
        'title' => 'General Questions',
        'icon' => 'bi-question-circle',
        'description' => 'Learn more about CouponDeals and how it works.',
        'questions' => [
            [
                'q' => 'What is CouponDeals?',
                'a' => 'CouponDeals is a coupon and deals discovery platform that helps shoppers find promotional codes, discounts and special offers from different online stores.'
            ],
            [
                'q' => 'Is CouponDeals free to use?',
                'a' => 'Yes. Visitors can browse coupon listings, explore stores and discover promotional offers without paying a fee to CouponDeals.'
            ],
            [
                'q' => 'Do I need to create an account?',
                'a' => 'You can browse publicly available coupons and deals without creating an account. Some third-party merchants may require you to sign in to their own websites to redeem certain offers.'
            ],
            [
                'q' => 'Does CouponDeals sell products directly?',
                'a' => 'CouponDeals primarily helps users discover promotional offers. Products and services linked from our website are generally sold by independent third-party merchants.'
            ]
        ]
    ],
    [
        'id' => 'coupons',
        'title' => 'Coupons & Promo Codes',
        'icon' => 'bi-ticket-perforated',
        'description' => 'Understand how to find, copy and redeem coupons.',
        'questions' => [
            [
                'q' => 'How do I use a coupon code?',
                'a' => 'Find an offer on CouponDeals, copy the available promo code, visit the relevant merchant website, add eligible items to your cart and enter the code in the promotional code field during checkout.'
            ],
            [
                'q' => 'Why is my coupon code not working?',
                'a' => 'A coupon may have expired, reached its redemption limit, become restricted to certain products or customers, or require a minimum purchase amount. Check the merchant terms and verify that your order meets the promotion requirements.'
            ],
            [
                'q' => 'Can I use more than one coupon at checkout?',
                'a' => 'That depends on the merchant. Some stores allow multiple promotions while others permit only one coupon code per order.'
            ],
            [
                'q' => 'Are all coupons guaranteed to work?',
                'a' => 'No. We aim to provide useful coupon information, but merchants control their promotional codes and can change or deactivate offers without notice.'
            ],
            [
                'q' => 'What is the difference between a coupon code and a deal?',
                'a' => 'A coupon code usually requires entering a promotional code during checkout. A deal may offer an automatic discount, a reduced price or another promotion without requiring a code.'
            ]
        ]
    ],
    [
        'id' => 'offers',
        'title' => 'Deals & Discounts',
        'icon' => 'bi-tags',
        'description' => 'Explore promotional offers, savings and restrictions.',
        'questions' => [
            [
                'q' => 'How can I find the latest deals?',
                'a' => 'Visit the Deals page or browse individual store and category pages to explore currently listed promotions.'
            ],
            [
                'q' => 'Why has a listed discount changed?',
                'a' => 'Merchants may update prices, promotional terms or product availability. The final offer displayed on the merchant website takes precedence over information shown on CouponDeals.'
            ],
            [
                'q' => 'Do coupons work in every country?',
                'a' => 'Not necessarily. Some promotions are limited to particular countries, regions, currencies or shipping destinations. Always check the merchant conditions.'
            ],
            [
                'q' => 'Are discounts available on all products?',
                'a' => 'Some promotions exclude particular brands, products, sale items or categories. The merchant determines which items qualify.'
            ]
        ]
    ],
    [
        'id' => 'shopping',
        'title' => 'Shopping & Orders',
        'icon' => 'bi-bag-check',
        'description' => 'Get answers about purchases, returns and payments.',
        'questions' => [
            [
                'q' => 'Where do I complete my purchase?',
                'a' => 'Purchases are generally completed on the merchant website after you follow a promotional link from CouponDeals.'
            ],
            [
                'q' => 'Can CouponDeals cancel or refund my order?',
                'a' => 'CouponDeals generally does not process third-party merchant orders. For cancellations, refunds, shipping issues or returns, contact the store where you placed your order.'
            ],
            [
                'q' => 'Is it safe to shop through links on CouponDeals?',
                'a' => 'Before purchasing, check that you are on the intended merchant website, review its payment security and privacy policies, and confirm the final order details. CouponDeals cannot guarantee the security or practices of independent websites.'
            ],
            [
                'q' => 'What should I do if a merchant does not honor a discount?',
                'a' => 'First review the offer conditions and contact the merchant customer support team. You can also report an inaccurate coupon listing to CouponDeals through our Contact page.'
            ]
        ]
    ],
    [
        'id' => 'account',
        'title' => 'Newsletter & Website',
        'icon' => 'bi-envelope-paper',
        'description' => 'Information about website updates and email subscriptions.',
        'questions' => [
            [
                'q' => 'How can I receive coupon updates?',
                'a' => 'You can browse the website regularly for newly listed offers. Email newsletter subscriptions will become available when the subscription service is enabled.'
            ],
            [
                'q' => 'Why am I not receiving newsletter emails?',
                'a' => 'Our newsletter subscription backend is not currently enabled. Once the service is launched, subscription and delivery instructions will be provided on the website.'
            ],
            [
                'q' => 'How can I report a broken link or expired coupon?',
                'a' => 'Use our Contact page to share the store name, coupon information and a short explanation of the issue.'
            ],
            [
                'q' => 'How does CouponDeals earn revenue?',
                'a' => 'Some promotional links may be affiliate links. CouponDeals may earn a commission when eligible purchases are completed through those links, subject to the relevant affiliate program.'
            ]
        ]
    ]
];

$totalFaqs = array_sum(array_map(
    fn($group) => count($group['questions']),
    $faqGroups
));

require_once __DIR__ . '/includes/header.php';
?>

<link rel="stylesheet" href="/coupon/assets/css/pages.css?v=120">

<main class="cf-faq-page">

    <!-- HERO -->
    <section class="cf-faq-hero-section">
        <div class="container">

            <div class="cf-faq-hero">

                <nav class="cf-faq-breadcrumb" aria-label="Breadcrumb">
                    <a href="/coupon/">
                        <i class="bi bi-house-door"></i>
                        Home
                    </a>

                    <i class="bi bi-chevron-right"></i>
                    <span>FAQs</span>
                </nav>

                <span class="cf-faq-eyebrow">
                    <i class="bi bi-chat-square-text"></i>
                    COUPONDEALS HELP CENTER
                </span>

                <h1>
                    Frequently Asked
                    <span>Questions</span>
                </h1>

                <p>
                    Find helpful answers about coupon codes,
                    promotional deals, shopping and using
                    CouponDeals.
                </p>

                <div class="cf-faq-search-box">

                    <i class="bi bi-search"></i>

                    <label class="visually-hidden" for="cfFaqSearch">
                        Search frequently asked questions
                    </label>

                    <input
                        type="search"
                        id="cfFaqSearch"
                        placeholder="Search for answers..."
                        autocomplete="off"
                    >

                    <button
                        type="button"
                        id="cfFaqSearchClear"
                        aria-label="Clear search"
                        hidden
                    >
                        <i class="bi bi-x-lg"></i>
                    </button>

                </div>

                <div class="cf-faq-hero-meta">
                    <span>
                        <i class="bi bi-check-circle"></i>
                        Helpful Answers
                    </span>

                    <span>
                        <i class="bi bi-collection"></i>
                        <?= count($faqGroups) ?> Topics
                    </span>

                    <span>
                        <i class="bi bi-question-circle"></i>
                        <?= $totalFaqs ?> Questions
                    </span>
                </div>

            </div>
        </div>
    </section>

    <!-- FAQ CONTENT -->
    <section class="cf-faq-main-section">
        <div class="container">

            <div class="cf-faq-layout">

                <!-- SIDEBAR -->
                <aside class="cf-faq-sidebar">

                    <div class="cf-faq-sidebar-card">

                        <h2>
                            <i class="bi bi-grid"></i>
                            Browse Topics
                        </h2>

                        <nav class="cf-faq-topic-nav" aria-label="FAQ topics">

                            <?php foreach ($faqGroups as $index => $group): ?>

                                <a
                                    href="#faq-<?= htmlspecialchars($group['id']) ?>"
                                    class="<?= $index === 0 ? 'active' : '' ?>"
                                >
                                    <i class="bi <?= htmlspecialchars($group['icon']) ?>"></i>

                                    <span>
                                        <?= htmlspecialchars($group['title']) ?>
                                    </span>

                                    <i class="bi bi-chevron-right cf-faq-nav-arrow"></i>
                                </a>

                            <?php endforeach; ?>

                        </nav>

                    </div>

                    <div class="cf-faq-sidebar-help">

                        <div class="cf-faq-sidebar-help-icon">
                            <i class="bi bi-headset"></i>
                        </div>

                        <h3>Need More Help?</h3>

                        <p>
                            Can't find what you're looking for?
                            Send us your question.
                        </p>

                        <a href="/coupon/contact.php">
                            Contact Support
                            <i class="bi bi-arrow-up-right"></i>
                        </a>

                    </div>

                </aside>

                <!-- QUESTIONS -->
                <div class="cf-faq-content">

                    <div class="cf-faq-content-heading">
                        <div>
                            <span>HELP & SUPPORT</span>
                            <h2>How Can We Help You?</h2>
                            <p>
                                Browse the topics below or search
                                for a specific question.
                            </p>
                        </div>

                        <span class="cf-faq-count">
                            <?= $totalFaqs ?> FAQs
                        </span>
                    </div>

                    <div
                        class="cf-faq-search-status"
                        id="cfFaqSearchStatus"
                        role="status"
                        aria-live="polite"
                    ></div>

                    <?php foreach ($faqGroups as $group): ?>

                        <section
                            class="cf-faq-group"
                            id="faq-<?= htmlspecialchars($group['id']) ?>"
                        >

                            <div class="cf-faq-group-heading">

                                <div class="cf-faq-group-icon">
                                    <i class="bi <?= htmlspecialchars($group['icon']) ?>"></i>
                                </div>

                                <div>
                                    <h2><?= htmlspecialchars($group['title']) ?></h2>
                                    <p><?= htmlspecialchars($group['description']) ?></p>
                                </div>

                            </div>

                            <div class="cf-faq-accordion">

                                <?php foreach ($group['questions'] as $index => $faq): ?>

                                    <div class="cf-faq-item">

                                        <h3>
                                            <button
                                                type="button"
                                                class="cf-faq-question"
                                                aria-expanded="false"
                                                aria-controls="cf-faq-answer-<?= htmlspecialchars($group['id']) ?>-<?= $index ?>"
                                                id="cf-faq-question-<?= htmlspecialchars($group['id']) ?>-<?= $index ?>"
                                            >
                                                <span>
                                                    <?= htmlspecialchars($faq['q']) ?>
                                                </span>

                                                <span class="cf-faq-toggle" aria-hidden="true">
                                                    <i class="bi bi-plus-lg"></i>
                                                </span>
                                            </button>
                                        </h3>

                                        <div
                                            class="cf-faq-answer"
                                            id="cf-faq-answer-<?= htmlspecialchars($group['id']) ?>-<?= $index ?>"
                                            role="region"
                                            aria-labelledby="cf-faq-question-<?= htmlspecialchars($group['id']) ?>-<?= $index ?>"
                                            hidden
                                        >
                                            <p>
                                                <?= htmlspecialchars($faq['a']) ?>
                                            </p>
                                        </div>

                                    </div>

                                <?php endforeach; ?>

                            </div>

                        </section>

                    <?php endforeach; ?>

                    <div class="cf-faq-empty" id="cfFaqEmpty" hidden>
                        <i class="bi bi-search"></i>
                        <h3>No matching questions found</h3>
                        <p>
                            Try another keyword or contact
                            our support team for assistance.
                        </p>
                        <a href="/coupon/contact.php">Contact Us</a>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- BOTTOM SUPPORT -->
    <section class="cf-faq-bottom-section">
        <div class="container">

            <div class="cf-faq-bottom-card">

                <div class="cf-faq-bottom-icon">
                    <i class="bi bi-chat-dots"></i>
                </div>

                <div class="cf-faq-bottom-copy">
                    <span>WE'RE HERE TO HELP</span>
                    <h2>Still Have Questions?</h2>
                    <p>
                        Have a coupon issue, partnership inquiry
                        or general question? Get in touch.
                    </p>
                </div>

                <a href="/coupon/contact.php">
                    Contact Our Team
                    <i class="bi bi-arrow-up-right"></i>
                </a>

            </div>

        </div>
    </section>

</main>



<?php require_once __DIR__ . '/includes/footer.php'; ?>
