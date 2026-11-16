
<?php
if (!function_exists('cfFooterE')) {
    function cfFooterE($value) {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}


$footerExplore = [
    ['Home', 'index.php'],
    ['All Stores', 'stores.php'],
    ['Latest Coupons', 'coupon.php'],
    ["Today's Deals", 'deals.php'],
    ['Trending Products', 'products.php'],
    ['Blog & Guides', 'blog.php']
];



$footerCategories = [
    ['Fashion & Clothing', 'fashion'],
    ['Electronics & Gadgets', 'electronics'],
    ['Beauty & Personal Care', 'beauty'],
    ['Home & Living', 'home'],
    ['Travel & Hotels', 'travel'],
    ['Health & Wellness', 'health']
];


$footerCompany = [
    ['About Us', 'about.php'],
    ['Contact Us', 'contact.php'],
    ['Advertise With Us', 'advertise.php'],
    ['Frequently Asked Questions', 'faq.php'],
    ['Privacy Policy', 'privacy-policy.php'],
    ['Terms & Conditions', 'terms.php']
];
?>

<footer class="cfx-footer" id="cfxFooter">

    <!-- NEWSLETTER -->

    <section class="cfx-newsletter">
        <div class="container">

            <div class="cfx-newsletter-layout">

                <div class="cfx-newsletter-copy">
                    <span class="cfx-eyebrow">
                        <span class="cfx-eyebrow-line"></span>
                        THE COUPONDEALS NEWSLETTER
                    </span>

                    <h2>Better deals.<br>
                        <span>Less searching.</span>
                    </h2>

                    <p>
                        Fresh discoveries, shopping inspiration and
                        coupon updates delivered to your inbox.
                    </p>
                </div>

                <div class="cfx-newsletter-action">

                    <form id="cfxNewsletterForm"
                          class="cfx-newsletter-form"
                          novalidate>

                        <label class="visually-hidden"
                               for="cfxNewsletterEmail">
                            Your email address
                        </label>

                        <span class="cfx-input-icon">
                            <i class="bi bi-envelope"></i>
                        </span>

                        <input type="email"
                               id="cfxNewsletterEmail"
                               name="email"
                               placeholder="Enter your email address"
                               autocomplete="email"
                               required>

                        <button type="submit">
                            <span>Subscribe</span>
                            <i class="bi bi-arrow-up-right"></i>
                        </button>

                    </form>

                    <p class="cfx-newsletter-feedback"
                       id="cfxNewsletterFeedback"
                       role="status"
                       aria-live="polite"></p>

                    <span class="cfx-newsletter-note">
                        <i class="bi bi-shield-check"></i>
                        No spam. Only helpful shopping updates.
                    </span>

                </div>

            </div>

        </div>
    </section>

    <!-- MAIN FOOTER -->

    <div class="cfx-main">
        <div class="container">

            <div class="cfx-columns">

                <!-- BRAND -->

                <div class="cfx-brand-column">

                    <a href="index.php"
                       class="cfx-brand"
                       aria-label="CouponDeals Home">

                        <span class="cfx-brand-icon">
                            <svg viewBox="0 0 64 64"
                                 width="34"
                                 height="34"
                                 aria-hidden="true">

                                <path d="M9 15H55V26C50 26 47 29 47 32S50 38 55 38V49H9V38C14 38 17 35 17 32S14 26 9 26Z"
                                      fill="#FCA311"/>

                                <path d="M32 20V44"
                                      stroke="#14213D"
                                      stroke-width="2"
                                      stroke-dasharray="3 4"/>

                                <circle cx="25" cy="26" r="3"
                                        fill="#14213D"/>

                                <circle cx="39" cy="38" r="3"
                                        fill="#14213D"/>

                                <path d="M24 40L40 24"
                                      stroke="#14213D"
                                      stroke-width="3.5"
                                      stroke-linecap="round"/>
                            </svg>
                        </span>

                        <span class="cfx-brand-word">
                            Coupon<span>Deals</span><b>.</b>
                        </span>

                    </a>

                    <p class="cfx-brand-description">
                        Discover inspiring deals, fresh coupons
                        and favorite brands—all in one smarter
                        shopping destination.
                    </p>

                    <div class="cfx-socials">
                        <!-- Replace # with your real social URLs -->

                        <a href="#"
                           data-cfx-social
                           aria-label="Facebook"
                           title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <a href="#"
                           data-cfx-social
                           aria-label="Instagram"
                           title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>

                        <a href="#"
                           data-cfx-social
                           aria-label="Pinterest"
                           title="Pinterest">
                            <i class="bi bi-pinterest"></i>
                        </a>

                        <a href="#"
                           data-cfx-social
                           aria-label="YouTube"
                           title="YouTube">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>

                </div>

                <!-- EXPLORE -->

                <div class="cfx-link-column">
                    <h3>Explore</h3>

                    <ul>
                        <?php foreach ($footerExplore as $link): ?>
                            <li>
                                <a href="<?= cfFooterE($link[1]) ?>">
                                    <?= cfFooterE($link[0]) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                
<!-- CATEGORIES -->

<div class="cfx-link-column">

    <h3>Popular Categories</h3>

    <ul>
        <?php foreach ($footerCategories as $category): ?>
            <li>
                <a href="category.php?slug=<?= rawurlencode($category[1]) ?>">
                    <?= cfFooterE($category[0]) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

</div>


                <!-- COMPANY -->

                <div class="cfx-link-column">
                    <h3>Company & Support</h3>

                    <ul>
                        <?php foreach ($footerCompany as $link): ?>
                            <li>
                                <a href="<?= cfFooterE($link[1]) ?>">
                                    <?= cfFooterE($link[0]) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>

            <!-- SUBTLE FOOTER STATEMENT -->

            <div class="cfx-footer-statement">

                <span class="cfx-statement-line"></span>

                <p>
                    Find it. Save it. Love it.
                    <span>Shop smarter with CouponDeals.</span>
                </p>

                <span class="cfx-statement-line"></span>

            </div>

        </div>
    </div>

    <!-- COPYRIGHT -->

    <div class="cfx-bottom">
        <div class="container">

            <div class="cfx-bottom-inner">

                <p>
                    &copy; <?= date('Y') ?>
                    <strong>CouponDeals.</strong>
                    All rights reserved.
                </p>

                <nav class="cfx-legal-links"
                     aria-label="Footer legal links">

                    <a href="privacy-policy.php">Privacy Policy</a>
                    <a href="terms.php">Terms of Use</a>
                    <a href="contact.php">Contact</a>

                </nav>

                <button type="button"
                        class="cfx-top-button"
                        id="cfxBackToTop"
                        aria-label="Back to top">

                    <span>Back to Top</span>
                    <i class="bi bi-arrow-up"></i>

                </button>

            </div>
        </div>
    </div>

</footer>

<!-- SCRIPTS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/header.js?v=21"></script>
<script src="assets/js/script.js?v=201"></script>
<script src="assets/js/footer.js?v=21"></script>
<script src="assets/js/pages.js?v=10" defer></script>

</body>
</html>
