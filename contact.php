
<?php
$pageTitle = "Contact Us | CouponDeals";
$pageDescription = "Contact CouponDeals for questions, coupon issues and business inquiries.";

require_once __DIR__ . "/includes/header.php";

$contactCategories = [
    ["General Questions", "bi-question-circle"],
    ["Coupon Issues", "bi-ticket-perforated"],
    ["Deal Submission", "bi-ticket-detailed"],
    ["Report Expired", "bi-exclamation-circle"],
    ["Merchant Partner", "bi-handshake"],
    ["Advertising", "bi-volume-up"],
    ["Technical Support", "bi-gear"],
    ["Business Inquiry", "bi-briefcase"]
];
?>

<link rel="stylesheet" href="/coupon/assets/css/pages.css?v=40">

<main class="cf-contact-v2">

    <!-- HERO AND CONTACT CARDS -->
    <section class="cfv2-top-section">
        <div class="container">

            <div class="cfv2-hero">
                <div class="cfv2-hero-content">

                    <div class="cfv2-breadcrumb">
                        <a href="index.php">Home</a>
                        <i class="bi bi-chevron-right"></i>
                        <span>Contact Us</span>
                    </div>

                    <h1>Contact Us</h1>

                    <p>
                        We're here to help! Whether you have questions,
                        feedback, partnership inquiries, or need support,
                        our team is ready to assist you.
                    </p>

                </div>
            </div>

            <div class="cfv2-contact-cards">
                <div class="row g-4">

                    <div class="col-lg-4 col-md-6">
                        <div class="cfv2-contact-card">
                            <div class="cfv2-contact-icon">
                                <i class="bi bi-envelope"></i>
                            </div>

                            <h3>Email Us</h3>

                            <a href="mailto:support@yourdomain.com">
                                support@yourdomain.com
                            </a>

                            <p>Send us your questions anytime</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="cfv2-contact-card">
                            <div class="cfv2-contact-icon">
                                <i class="bi bi-telephone"></i>
                            </div>

                            <h3>Call Us</h3>

                            <span class="cfv2-contact-detail">
                                Phone number coming soon
                            </span>

                            <p>Business inquiries</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="cfv2-contact-card">
                            <div class="cfv2-contact-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>

                            <h3>Visit Office</h3>

                            <span class="cfv2-contact-detail">
                                Office address coming soon
                            </span>

                            <p>Business correspondence</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- FORM AND SUPPORT -->
    <section class="cfv2-main-section">
        <div class="container">

            <div class="row g-5 align-items-start">

                <!-- LEFT CONTACT FORM -->
                <div class="col-lg-6">

                    <div class="cfv2-form-box">

                        <form
                            id="cfv2ContactForm"
                            method="post"
                            action="#"
                            enctype="multipart/form-data"
                        >

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <input
                                        type="text"
                                        id="cfv2Name"
                                        name="name"
                                        class="cfv2-input"
                                        placeholder="Name"
                                        minlength="2"
                                        maxlength="100"
                                        autocomplete="name"
                                        aria-label="Name"
                                        required
                                    >
                                </div>

                                <div class="col-md-6">
                                    <input
                                        type="email"
                                        id="cfv2Email"
                                        name="email"
                                        class="cfv2-input"
                                        placeholder="Email"
                                        maxlength="254"
                                        autocomplete="email"
                                        aria-label="Email"
                                        required
                                    >
                                </div>

                                <div class="col-md-6">
                                    <input
                                        type="tel"
                                        id="cfv2Phone"
                                        name="phone"
                                        class="cfv2-input"
                                        placeholder="Phone Number"
                                        maxlength="25"
                                        autocomplete="tel"
                                        aria-label="Phone Number"
                                    >
                                </div>

                                <div class="col-md-6">
                                    <div class="cfv2-select-wrap">
                                        <label for="cfv2Subject">
                                            Subject
                                        </label>

                                        <select
                                            id="cfv2Subject"
                                            name="subject"
                                            required
                                        >
                                            <option value="">
                                                Select Subject
                                            </option>

                                            <?php foreach ($contactCategories as $category): ?>
                                                <option value="<?= htmlspecialchars($category[0], ENT_QUOTES, 'UTF-8') ?>">
                                                    <?= htmlspecialchars($category[0], ENT_QUOTES, 'UTF-8') ?>
                                                </option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <input
                                        type="text"
                                        id="cfv2Store"
                                        name="store_name"
                                        class="cfv2-input"
                                        placeholder="Store Name (Optional)"
                                        maxlength="150"
                                        aria-label="Store Name (Optional)"
                                    >
                                </div>

                                <div class="col-12">
                                    <textarea
                                        id="cfv2Message"
                                        name="message"
                                        class="cfv2-input cfv2-textarea"
                                        placeholder="Your Message"
                                        minlength="10"
                                        maxlength="3000"
                                        aria-label="Your Message"
                                        required
                                    ></textarea>
                                </div>

                                <div class="col-12">
                                    <label class="cfv2-file-upload" for="cfv2File">
                                        <i class="bi bi-cloud-arrow-up"></i>
                                        <span id="cfv2FileName">
                                            Attach File (Optional)
                                        </span>
                                    </label>

                                    <input
                                        type="file"
                                        id="cfv2File"
                                        name="attachment"
                                        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                        class="cfv2-hidden-file"
                                    >
                                </div>

                                <div class="col-12">
                                    <div class="cfv2-privacy">
                                        <input
                                            type="checkbox"
                                            id="cfv2Privacy"
                                            required
                                        >

                                        <label for="cfv2Privacy">
                                            I agree to the
                                            <a href="privacy-policy.php">
                                                Privacy Policy
                                            </a>
                                            and allow CouponDeals to
                                            process my data to respond
                                            to my request.
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button
                                        type="submit"
                                        class="cfv2-submit"
                                    >
                                        Send Message
                                    </button>

                                    <p
                                        id="cfv2FormNotice"
                                        class="cfv2-form-notice"
                                        role="status"
                                        aria-live="polite"
                                    ></p>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>

                <!-- RIGHT SUPPORT CONTENT -->
                <div class="col-lg-6">

                    <div class="cfv2-support-image">

                        <img
                            src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=1200&q=85"
                            alt="Customer support team"
                            loading="lazy"
                        >

                        <div class="cfv2-image-overlay">
                            <h2>Fast &amp; Friendly</h2>

                            <p>
                                Our support team is here to
                                help you with questions,
                                feedback and coupon inquiries.
                            </p>
                        </div>

                    </div>

                    <div class="cfv2-support-features">

                        <div class="cfv2-feature">
                            <div class="cfv2-feature-icon">
                                <i class="bi bi-lightning-charge"></i>
                            </div>

                            <div>
                                <h4>Fast response</h4>
                                <p>
                                    We aim to respond to
                                    inquiries as promptly as possible.
                                </p>
                            </div>
                        </div>

                        <div class="cfv2-feature">
                            <div class="cfv2-feature-icon">
                                <i class="bi bi-emoji-smile"></i>
                            </div>

                            <div>
                                <h4>Friendly support</h4>
                                <p>
                                    Our team is dedicated to
                                    providing a helpful experience.
                                </p>
                            </div>
                        </div>

                        <div class="cfv2-feature">
                            <div class="cfv2-feature-icon">
                                <i class="bi bi-lock"></i>
                            </div>

                            <div>
                                <h4>Secure communication</h4>
                                <p>
                                    We value your privacy and
                                    responsible handling of inquiries.
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- SUPPORT CATEGORIES -->
    <section class="cfv2-categories-section">
        <div class="container">

            <div class="cfv2-categories-box">

                <div class="cfv2-categories-heading">
                    <h2>Support Categories</h2>
                    <p>
                        Select a category to find specialized help faster.
                    </p>
                </div>

                <div class="row g-4">

                    <?php foreach ($contactCategories as $category): ?>

                        <div class="col-lg-3 col-md-4 col-sm-6">

                            <button
                                type="button"
                                class="cfv2-category-card"
                                data-category="<?= htmlspecialchars($category[0], ENT_QUOTES, 'UTF-8') ?>"
                                aria-pressed="false"
                            >
                                <i class="bi <?= htmlspecialchars($category[1], ENT_QUOTES, 'UTF-8') ?>"></i>

                                <span>
                                    <?= htmlspecialchars($category[0], ENT_QUOTES, 'UTF-8') ?>
                                </span>
                            </button>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>
    </section>

</main>

<script src="/coupon/assets/js/pages.js?v=40" defer></script>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
