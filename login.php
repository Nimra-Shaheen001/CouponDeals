
<?php
$pageTitle = "Login | CouponDeals";
$pageDescription = "Sign in to your CouponDeals account.";

require_once __DIR__ . '/includes/header.php';
?>

<link rel="stylesheet" href="/coupon/assets/css/pages.css?v=130">

<main class="cf-login-page">

    <section class="cf-login-section">
        <div class="container">

            <div class="cf-login-wrapper">

                <!-- LEFT SIDE -->
                <div class="cf-login-showcase">

                    <a href="/coupon/" class="cf-login-logo">
                        <span class="cf-login-logo-icon">
                            <i class="bi bi-ticket-perforated-fill"></i>
                        </span>
                        Coupon<span>Flicker</span>.
                    </a>

                    <div class="cf-login-showcase-content">

                        <span class="cf-login-badge">
                            <i class="bi bi-stars"></i>
                            YOUR SHOPPING COMPANION
                        </span>

                        <h1>
                            Welcome Back to
                            <span>Smarter Savings.</span>
                        </h1>

                        <p>
                            Discover exciting deals, explore
                            popular brands and enjoy a more
                            convenient way to find great offers.
                        </p>

                        <div class="cf-login-benefits">

                            <div class="cf-login-benefit">
                                <span>
                                    <i class="bi bi-tags"></i>
                                </span>
                                <div>
                                    <h3>Explore Great Deals</h3>
                                    <p>Discover discounts from popular stores.</p>
                                </div>
                            </div>

                            <div class="cf-login-benefit">
                                <span>
                                    <i class="bi bi-ticket-perforated"></i>
                                </span>
                                <div>
                                    <h3>Find Coupon Codes</h3>
                                    <p>Browse promotional codes and offers.</p>
                                </div>
                            </div>

                            <div class="cf-login-benefit">
                                <span>
                                    <i class="bi bi-shield-check"></i>
                                </span>
                                <div>
                                    <h3>Simple & Convenient</h3>
                                    <p>Enjoy a clean and easy shopping experience.</p>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="cf-login-showcase-footer">
                        <i class="bi bi-patch-check"></i>
                        Find it. Save it. Love it.
                    </div>

                </div>

                <!-- RIGHT SIDE -->
                <div class="cf-login-form-side">

                    <div class="cf-login-form-container">

                        <nav class="cf-login-breadcrumb" aria-label="Breadcrumb">
                            <a href="/coupon/">
                                <i class="bi bi-house-door"></i>
                                Home
                            </a>
                            <i class="bi bi-chevron-right"></i>
                            <span>Login</span>
                        </nav>

                        <div class="cf-login-heading">
                            <span class="cf-login-form-eyebrow">
                                WELCOME BACK
                            </span>

                            <h2>Sign In to Your Account</h2>

                            <p>
                                Enter your email address and password
                                to continue.
                            </p>
                        </div>

                        <div
                            class="cf-login-alert"
                            id="cfLoginAlert"
                            role="status"
                            aria-live="polite"
                            hidden
                        ></div>

                        <form
                            id="cfLoginForm"
                            class="cf-login-form"
                            novalidate
                        >

                            <div class="cf-login-field">

                                <label for="cfLoginEmail">
                                    Email Address
                                </label>

                                <div class="cf-login-input-wrap">
                                    <i class="bi bi-envelope"></i>

                                    <input
                                        type="email"
                                        id="cfLoginEmail"
                                        name="email"
                                        placeholder="Enter your email address"
                                        autocomplete="email"
                                        maxlength="254"
                                        required
                                    >
                                </div>

                                <small
                                    class="cf-login-error"
                                    id="cfLoginEmailError"
                                ></small>

                            </div>

                            <div class="cf-login-field">

                                <div class="cf-login-label-row">
                                    <label for="cfLoginPassword">
                                        Password
                                    </label>

                                    <a href="/coupon/forgot-password.php">
                                        Forgot Password?
                                    </a>
                                </div>

                                <div class="cf-login-input-wrap">
                                    <i class="bi bi-lock"></i>

                                    <input
                                        type="password"
                                        id="cfLoginPassword"
                                        name="password"
                                        placeholder="Enter your password"
                                        autocomplete="current-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="cf-login-password-toggle"
                                        id="cfLoginTogglePassword"
                                        aria-label="Show password"
                                        aria-pressed="false"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>

                                <small
                                    class="cf-login-error"
                                    id="cfLoginPasswordError"
                                ></small>

                            </div>

                            <div class="cf-login-options">

                                <label class="cf-login-remember">
                                    <input
                                        type="checkbox"
                                        name="remember"
                                        value="1"
                                    >
                                    <span>Remember me</span>
                                </label>

                                <span class="cf-login-secure-note">
                                    <i class="bi bi-shield-lock"></i>
                                    Secure Sign In
                                </span>

                            </div>

                            <button
                                type="submit"
                                class="cf-login-submit"
                                id="cfLoginSubmit"
                            >
                                <span>Sign In</span>
                                <i class="bi bi-arrow-right"></i>
                            </button>

                        </form>

                        <div class="cf-login-divider">
                            <span>New to CouponDeals?</span>
                        </div>

                        <a
                            href="/coupon/register.php"
                            class="cf-login-register"
                        >
                            Create an Account
                            <i class="bi bi-arrow-up-right"></i>
                        </a>

                        <p class="cf-login-legal">
                            By continuing, you agree to our
                            <a href="/coupon/terms.php">Terms & Conditions</a>
                            and
                            <a href="/coupon/privacy-policy.php">Privacy Policy</a>.
                        </p>

                    </div>

                </div>

            </div>

        </div>
    </section>

</main>

<script src="/coupon/assets/js/pages.js?v=130" defer></script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
