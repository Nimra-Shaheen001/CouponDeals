
<?php
$pageTitle = "Terms & Conditions | CouponDeals";
$pageDescription = "Read the terms and conditions for using CouponDeals, including coupon usage, merchant offers, affiliate links and website policies.";

require_once __DIR__ . "/includes/header.php";

$termsUpdated = "October 27, 2026";

$termsNavigation = [
    ["id" => "acceptance", "label" => "Acceptance of Terms"],
    ["id" => "services", "label" => "Our Services"],
    ["id" => "eligibility", "label" => "Eligibility"],
    ["id" => "coupons", "label" => "Coupons & Discounts"],
    ["id" => "merchants", "label" => "Third-Party Merchants"],
    ["id" => "affiliate", "label" => "Affiliate Disclosure"],
    ["id" => "conduct", "label" => "Acceptable Use"],
    ["id" => "ownership", "label" => "Intellectual Property"],
    ["id" => "disclaimer", "label" => "Disclaimer"],
    ["id" => "liability", "label" => "Limitation of Liability"],
    ["id" => "changes", "label" => "Changes to Terms"],
    ["id" => "contact", "label" => "Contact Us"]
];
?>

<link rel="stylesheet" href="/coupon/assets/css/pages.css?v=90">

<main class="cf-terms-page">

    <!-- PAGE HERO -->
    <section class="cf-terms-hero-section">
        <div class="container">

            <div class="cf-terms-hero">

                <nav class="cf-terms-breadcrumb" aria-label="Breadcrumb">
                    <a href="/coupon/">
                        <i class="bi bi-house-door"></i>
                        Home
                    </a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Terms & Conditions</span>
                </nav>

                <div class="cf-terms-hero-label">
                    <i class="bi bi-file-earmark-text"></i>
                    Website Guidelines & Policies
                </div>

                <h1>Terms & Conditions</h1>

                <p>
                    Please review the following terms carefully
                    before using CouponDeals. These guidelines
                    explain how our website, coupons, deals
                    and merchant links are intended to work.
                </p>

                <div class="cf-terms-hero-meta">
                    <span>
                        <i class="bi bi-calendar-check"></i>
                        Last Updated:
                        <?php echo htmlspecialchars($termsUpdated); ?>
                    </span>
                    <span>
                        <i class="bi bi-globe2"></i>
                        CouponDeals Website
                    </span>
                </div>

            </div>

        </div>
    </section>

    <!-- MAIN CONTENT -->
    <section class="cf-terms-main-section">
        <div class="container">

            <div class="cf-terms-layout">

                <!-- CONTENT -->
                <article class="cf-terms-article">

                    <div class="cf-terms-welcome">
                        <div class="cf-terms-welcome-icon">
                            <i class="bi bi-journal-check"></i>
                        </div>

                        <div>
                            <h2>Welcome to CouponDeals</h2>
                            <p>
                                These Terms & Conditions govern your
                                use of the CouponDeals website.
                                By accessing or using our services,
                                you agree to comply with these terms.
                                If you do not agree, please discontinue
                                using the website.
                            </p>
                        </div>
                    </div>

                    <!-- 01 -->
                    <section class="cf-terms-section" id="acceptance">
                        <div class="cf-terms-section-title">
                            <span>01</span>
                            <h2>Acceptance of Terms</h2>
                        </div>

                        <p>
                            By visiting, browsing or using CouponDeals,
                            you acknowledge that you have read and
                            agree to these Terms & Conditions,
                            together with any applicable policies
                            referenced on our website.
                        </p>

                        <p>
                            If you use CouponDeals on behalf of
                            an organization, you are responsible
                            for ensuring you have the authority
                            to act on its behalf.
                        </p>
                    </section>

                    <!-- 02 -->
                    <section class="cf-terms-section" id="services">
                        <div class="cf-terms-section-title">
                            <span>02</span>
                            <h2>About Our Services</h2>
                        </div>

                        <p>
                            CouponDeals is an online coupon and
                            deals discovery platform that helps
                            visitors find promotional offers,
                            discount codes and shopping deals
                            from various brands and merchants.
                        </p>

                        <p>
                            Our website may provide:
                        </p>

                        <ul>
                            <li>Promotional coupon codes and discounts.</li>
                            <li>Deals and special shopping offers.</li>
                            <li>Merchant and store information.</li>
                            <li>Links to third-party shopping websites.</li>
                            <li>Informational articles and shopping guides.</li>
                        </ul>

                        <p>
                            We may modify, suspend or discontinue
                            particular website features when necessary.
                        </p>
                    </section>

                    <!-- 03 -->
                    <section class="cf-terms-section" id="eligibility">
                        <div class="cf-terms-section-title">
                            <span>03</span>
                            <h2>Eligibility to Use Our Website</h2>
                        </div>

                        <p>
                            Users must comply with applicable laws
                            when accessing CouponDeals and
                            using offers linked from our website.
                        </p>

                        <p>
                            Purchases from external merchants may
                            be subject to additional eligibility,
                            location, age or account requirements
                            imposed by those merchants.
                        </p>
                    </section>

                    <!-- 04 -->
                    <section class="cf-terms-section" id="coupons">
                        <div class="cf-terms-section-title">
                            <span>04</span>
                            <h2>Coupon Codes, Deals & Discounts</h2>
                        </div>

                        <p>
                            CouponDeals aims to provide useful
                            information about available promotional
                            offers. However, coupon codes and
                            discounts are controlled by the
                            respective merchants.
                        </p>

                        <div class="cf-terms-notice">
                            <i class="bi bi-info-circle"></i>
                            <p>
                                <strong>Important:</strong>
                                Coupon availability, validity,
                                eligibility and discount amounts
                                may change without notice.
                                Always confirm the final offer
                                on the merchant's website.
                            </p>
                        </div>

                        <ul>
                            <li>Some coupons may have expiration dates.</li>
                            <li>Offers may apply only to selected products.</li>
                            <li>Minimum purchase requirements may apply.</li>
                            <li>Some discounts may be location-specific.</li>
                            <li>Merchants may modify or withdraw offers.</li>
                        </ul>

                        <p>
                            We do not guarantee that every listed
                            coupon will work for every visitor
                            or transaction.
                        </p>
                    </section>

                    <!-- 05 -->
                    <section class="cf-terms-section" id="merchants">
                        <div class="cf-terms-section-title">
                            <span>05</span>
                            <h2>Third-Party Merchants & Websites</h2>
                        </div>

                        <p>
                            CouponDeals may link to independent
                            merchants and other third-party websites.
                            These websites operate under their own
                            terms, privacy policies and purchasing rules.
                        </p>

                        <p>
                            Unless expressly stated otherwise,
                            purchases, payments, shipping,
                            returns, refunds and customer service
                            are handled by the relevant merchant.
                        </p>

                        <p>
                            We encourage visitors to review
                            the merchant's terms before
                            completing a purchase.
                        </p>
                    </section>

                    <!-- 06 -->
                    <section class="cf-terms-section" id="affiliate">
                        <div class="cf-terms-section-title">
                            <span>06</span>
                            <h2>Affiliate Links & Commissions</h2>
                        </div>

                        <p>
                            CouponDeals may participate in
                            affiliate marketing programs.
                            Some links on our website may
                            be affiliate links.
                        </p>

                        <p>
                            If you click an eligible affiliate
                            link and complete a qualifying purchase,
                            CouponDeals may receive a commission
                            from the merchant or affiliate network.
                        </p>

                        <p>
                            Any affiliate relationship does not
                            guarantee the accuracy or continued
                            availability of a particular offer.
                        </p>
                    </section>

                    <!-- 07 -->
                    <section class="cf-terms-section" id="conduct">
                        <div class="cf-terms-section-title">
                            <span>07</span>
                            <h2>Acceptable Use of the Website</h2>
                        </div>

                        <p>
                            When using CouponDeals, you agree
                            not to engage in activities that
                            interfere with the website or
                            harm other visitors.
                        </p>

                        <ul>
                            <li>Do not attempt unauthorized access.</li>
                            <li>Do not introduce malicious software.</li>
                            <li>Do not misuse contact or submission forms.</li>
                            <li>Do not impersonate another person or business.</li>
                            <li>Do not interfere with website availability.</li>
                            <li>Do not reproduce protected content without permission.</li>
                        </ul>
                    </section>

                    <!-- 08 -->
                    <section class="cf-terms-section" id="ownership">
                        <div class="cf-terms-section-title">
                            <span>08</span>
                            <h2>Intellectual Property Rights</h2>
                        </div>

                        <p>
                            Original CouponDeals branding,
                            website designs and content may be
                            protected by applicable intellectual
                            property laws.
                        </p>

                        <p>
                            Third-party trademarks, brand names,
                            product images and logos remain
                            the property of their respective owners.
                        </p>

                        <p>
                            Displaying a merchant's name or
                            promotional offer does not necessarily
                            indicate sponsorship or endorsement.
                        </p>
                    </section>

                    <!-- 09 -->
                    <section class="cf-terms-section" id="disclaimer">
                        <div class="cf-terms-section-title">
                            <span>09</span>
                            <h2>Disclaimer of Warranties</h2>
                        </div>

                        <p>
                            CouponDeals provides information
                            about coupons and promotional offers
                            for general informational purposes.
                        </p>

                        <p>
                            Although we aim to keep information
                            useful and current, we cannot
                            guarantee the accuracy, completeness
                            or availability of every offer.
                        </p>

                        <p>
                            The website and its content are
                            provided subject to warranties
                            and consumer protections that
                            cannot legally be excluded.
                        </p>
                    </section>

                    <!-- 10 -->
                    <section class="cf-terms-section" id="liability">
                        <div class="cf-terms-section-title">
                            <span>10</span>
                            <h2>Limitation of Liability</h2>
                        </div>

                        <p>
                            To the extent permitted by applicable
                            law, CouponDeals is not responsible
                            for losses arising solely from
                            inaccurate third-party promotions,
                            unavailable coupon codes or
                            independent merchant transactions.
                        </p>

                        <p>
                            Nothing in these terms excludes
                            liability or statutory rights
                            that cannot legally be limited.
                        </p>
                    </section>

                    <!-- 11 -->
                    <section class="cf-terms-section" id="changes">
                        <div class="cf-terms-section-title">
                            <span>11</span>
                            <h2>Changes to These Terms</h2>
                        </div>

                        <p>
                            We may update these Terms & Conditions
                            to reflect changes to our services,
                            operational practices or applicable laws.
                        </p>

                        <p>
                            Revised terms will be published
                            on this page with an updated date.
                            Visitors are encouraged to review
                            this page periodically.
                        </p>
                    </section>

                    <!-- 12 -->
                    <section class="cf-terms-section cf-terms-last" id="contact">
                        <div class="cf-terms-section-title">
                            <span>12</span>
                            <h2>Contact Information</h2>
                        </div>

                        <p>
                            If you have questions about these
                            Terms & Conditions, our website
                            or a listed promotional offer,
                            please contact us using our
                            official contact page.
                        </p>

                        <a class="cf-terms-contact-link" href="/coupon/contact.php">
                            Contact Our Team
                            <i class="bi bi-arrow-up-right"></i>
                        </a>
                    </section>

                </article>

                <!-- RIGHT SIDEBAR -->
                <aside class="cf-terms-sidebar">

                    <div class="cf-terms-sidebar-card">
                        <h3>
                            <i class="bi bi-list-ul"></i>
                            On This Page
                        </h3>

                        <nav class="cf-terms-nav" aria-label="Terms sections">
                            <?php foreach ($termsNavigation as $index => $item): ?>
                                <a
                                    href="#<?php echo htmlspecialchars($item['id']); ?>"
                                    class="<?php echo $index === 0 ? 'active' : ''; ?>"
                                >
                                    <?php echo htmlspecialchars($item['label']); ?>
                                </a>
                            <?php endforeach; ?>
                        </nav>
                    </div>

                    <div class="cf-terms-sidebar-support">
                        <div class="cf-terms-support-icon">
                            <i class="bi bi-headset"></i>
                        </div>

                        <h3>Have Questions?</h3>
                        <p>
                            Need help understanding our terms
                            or reporting a coupon issue?
                        </p>

                        <a href="/coupon/contact.php">
                            Contact Support
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                </aside>

            </div>

        </div>
    </section>

    <!-- BOTTOM CTA -->
    <section class="cf-terms-cta-section">
        <div class="container">

            <div class="cf-terms-cta">
                <div class="cf-terms-cta-content">
                    <span>NEED MORE INFORMATION?</span>
                    <h2>We're Here to Help You</h2>
                    <p>
                        Have questions about our policies,
                        coupons or website services?
                        Reach out to our support team.
                    </p>
                </div>

                <a href="/coupon/contact.php">
                    Get in Touch
                    <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

        </div>
    </section>

</main>

<script src="/coupon/assets/js/pages.js?v=90" defer></script>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
