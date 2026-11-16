
<?php
/* ================================================
   COUPONDEALS — ADVERTISE WITH US
   PHP 8+ | Bootstrap 5.3
================================================ */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = "Advertise With Us | CouponDeals";

/* Replace both with real domain email addresses */
$recipientEmail = "advertising@yourdomain.com";
$senderEmail = "no-reply@yourdomain.com";

function advEsc($value): string
{
    return htmlspecialchars(
        (string) ($value ?? ""),
        ENT_QUOTES | ENT_SUBSTITUTE,
        "UTF-8"
    );
}

if (empty($_SESSION["adv_csrf"])) {
    $_SESSION["adv_csrf"] = bin2hex(random_bytes(32));
}

$sectors = [
    "Fashion & Apparel",
    "Electronics & Technology",
    "Beauty & Personal Care",
    "Home & Garden",
    "Travel & Hospitality",
    "Food & Lifestyle",
    "Sports & Fitness",
    "Software & Services",
    "Other"
];

$opportunities = [
    "Sponsored Coupons",
    "Featured Store",
    "Homepage Placement",
    "Product Promotion",
    "Banner Advertising",
    "Long-Term Partnership",
    "Other"
];

$fields = [
    "website",
    "company",
    "contact",
    "email",
    "phone",
    "sector",
    "details",
    "start_date",
    "end_date",
    "opportunity",
    "budget",
    "notes"
];

$values = array_fill_keys($fields, "");
$errors = [];
$success = false;
$formError = "";

if (
    ($_GET["success"] ?? "") === "1" &&
    !empty($_SESSION["adv_submitted"])
) {
    $success = true;
    unset($_SESSION["adv_submitted"]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    foreach ($fields as $field) {
        $value = $_POST[$field] ?? "";
        $values[$field] = is_string($value)
            ? trim($value)
            : "";
    }

    $token = $_POST["csrf"] ?? "";

    if (
        !is_string($token) ||
        !hash_equals($_SESSION["adv_csrf"], $token)
    ) {
        $formError = "Invalid session. Refresh the page and try again.";
    }

    /* Spam honeypot */
    if (!empty($_POST["website_fax"])) {
        $formError = "Unable to process the request.";
    }

    /* Website */
    $scheme = parse_url($values["website"], PHP_URL_SCHEME);

    if (
        strlen($values["website"]) > 500 ||
        !filter_var($values["website"], FILTER_VALIDATE_URL) ||
        !in_array(strtolower((string)$scheme), ["http", "https"], true)
    ) {
        $errors["website"] = "Enter a valid website URL.";
    }

    /* Company and contact */
    if (
        strlen($values["company"]) < 2 ||
        strlen($values["company"]) > 120
    ) {
        $errors["company"] = "Enter a valid company name.";
    }

    if (
        strlen($values["contact"]) < 2 ||
        strlen($values["contact"]) > 120
    ) {
        $errors["contact"] = "Enter a valid contact name.";
    }

    if (
        strlen($values["email"]) > 254 ||
        !filter_var($values["email"], FILTER_VALIDATE_EMAIL)
    ) {
        $errors["email"] = "Enter a valid business email.";
    }

    if (
        $values["phone"] !== "" &&
        !preg_match('/^[+0-9()\s.-]{7,25}$/', $values["phone"])
    ) {
        $errors["phone"] = "Enter a valid phone number.";
    }

    if (!in_array($values["sector"], $sectors, true)) {
        $errors["sector"] = "Select a business sector.";
    }

    if (
        strlen($values["details"]) < 20 ||
        strlen($values["details"]) > 3000
    ) {
        $errors["details"] =
            "Business details must be between 20 and 3000 characters.";
    }

    if (
        !in_array($values["opportunity"], $opportunities, true)
    ) {
        $errors["opportunity"] =
            "Select an advertising opportunity.";
    }

    /* Date validation */
    $start = DateTimeImmutable::createFromFormat(
        "!Y-m-d",
        $values["start_date"]
    );

    $end = DateTimeImmutable::createFromFormat(
        "!Y-m-d",
        $values["end_date"]
    );

    if (
        !$start ||
        $start->format("Y-m-d") !== $values["start_date"]
    ) {
        $errors["start_date"] = "Select a valid start date.";
    }

    if (
        !$end ||
        $end->format("Y-m-d") !== $values["end_date"]
    ) {
        $errors["end_date"] = "Select a valid end date.";
    }

    if ($start && $end && $end < $start) {
        $errors["end_date"] =
            "End date cannot be before start date.";
    }

    if (
        !is_numeric($values["budget"]) ||
        (float)$values["budget"] <= 0 ||
        (float)$values["budget"] > 100000000
    ) {
        $errors["budget"] = "Enter a valid monthly budget.";
    }

    if (strlen($values["notes"]) > 3000) {
        $errors["notes"] = "Notes are too long.";
    }

    if (!$errors && !$formError) {

        if (
            !filter_var($recipientEmail, FILTER_VALIDATE_EMAIL) ||
            !filter_var($senderEmail, FILTER_VALIDATE_EMAIL) ||
            str_contains($recipientEmail, "yourdomain.com") ||
            str_contains($senderEmail, "yourdomain.com")
        ) {
            $formError =
                "The advertising email is not configured yet.";
        } else {

            $labels = [
                "website" => "Website URL",
                "company" => "Company Name",
                "contact" => "Contact Person",
                "email" => "Business Email",
                "phone" => "Phone Number",
                "sector" => "Business Sector",
                "details" => "Business Details",
                "start_date" => "Start Date",
                "end_date" => "End Date",
                "opportunity" => "Opportunity Type",
                "budget" => "Monthly Budget (USD)",
                "notes" => "Additional Notes"
            ];

            $body = "NEW ADVERTISING REQUEST\n\n";

            foreach ($labels as $key => $label) {
                $safeValue = preg_replace(
                    '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/',
                    "",
                    $values[$key]
                );

                $body .= $label . ":\n" . $safeValue . "\n\n";
            }

            $headers = [
                "From" => $senderEmail,
                "Content-Type" => "text/plain; charset=UTF-8"
            ];

            $sent = mail(
                $recipientEmail,
                "CouponDeals Advertising Enquiry",
                $body,
                $headers
            );

            if ($sent) {
                $_SESSION["adv_submitted"] = true;
                $_SESSION["adv_csrf"] = bin2hex(random_bytes(32));

                header("Location: advertise.php?success=1#advForm");
                exit;
            }

            $formError =
                "Unable to send your request. Please try again.";
        }
    }
}

require_once __DIR__ . "/includes/header.php";
?>

<main class="adv-page" id="advPage">

    <!-- PAGE HEADING -->

    <section class="adv-page-heading">

        <div class="container">

            <nav class="adv-breadcrumb" aria-label="Breadcrumb">
                <a href="index.php">Home</a>
                <i class="bi bi-chevron-right"></i>
                <span>Advertise With Us</span>
            </nav>

            <div class="adv-title-block">

                <span class="adv-overline">
                    BUSINESS PARTNERSHIPS
                </span>

                <h1>Advertise With Us</h1>

                <p>
                    Reach shoppers looking for the best deals and
                    coupons. Tell us about your business, and
                    our advertising team can review your enquiry
                    and contact you about available opportunities.
                </p>

            </div>

        </div>

    </section>

    <!-- MAIN FORM -->

    <section class="adv-form-section" id="advForm">

        <div class="container">

            <div class="adv-form-container">

                <?php if ($success): ?>

                    <div class="adv-alert adv-success" role="status">
                        <i class="bi bi-check-circle-fill"></i>

                        <div>
                            <strong>Request submitted</strong>
                            <p>
                                Your enquiry was accepted by the
                                website mail system.
                            </p>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if ($formError): ?>

                    <div class="adv-alert adv-danger" role="alert">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <?= advEsc($formError) ?>
                    </div>

                <?php endif; ?>

                <form
                    id="advFormElement"
                    class="adv-enquiry-form"
                    method="post"
                    action="advertise.php#advForm"
                    novalidate>

                    <input
                        type="hidden"
                        name="csrf"
                        value="<?= advEsc($_SESSION["adv_csrf"]) ?>">

                    <div class="adv-honeypot" aria-hidden="true">
                        <input
                            name="website_fax"
                            type="text"
                            tabindex="-1"
                            autocomplete="off">
                    </div>

                    <div class="adv-form-grid">

                        <!-- Website -->

                        <div class="adv-field">
                            <label for="advWebsite">
                                Website URL <b>*</b>
                            </label>

                            <input
                                id="advWebsite"
                                name="website"
                                type="url"
                                placeholder="https://example.com"
                                maxlength="500"
                                value="<?= advEsc($values["website"]) ?>"
                                required>

                            <?php if (isset($errors["website"])): ?>
                                <small class="adv-error">
                                    <?= advEsc($errors["website"]) ?>
                                </small>
                            <?php endif; ?>
                        </div>

                        <!-- Company -->

                        <div class="adv-field">
                            <label for="advCompany">
                                Company Name <b>*</b>
                            </label>

                            <input
                                id="advCompany"
                                name="company"
                                type="text"
                                placeholder="Enter company name"
                                maxlength="120"
                                value="<?= advEsc($values["company"]) ?>"
                                required>

                            <?php if (isset($errors["company"])): ?>
                                <small class="adv-error">
                                    <?= advEsc($errors["company"]) ?>
                                </small>
                            <?php endif; ?>
                        </div>

                        <!-- Contact -->

                        <div class="adv-field">
                            <label for="advContact">
                                Contact Person Name <b>*</b>
                            </label>

                            <input
                                id="advContact"
                                name="contact"
                                type="text"
                                placeholder="Full Name"
                                maxlength="120"
                                value="<?= advEsc($values["contact"]) ?>"
                                required>

                            <?php if (isset($errors["contact"])): ?>
                                <small class="adv-error">
                                    <?= advEsc($errors["contact"]) ?>
                                </small>
                            <?php endif; ?>
                        </div>

                        <!-- Email -->

                        <div class="adv-field">
                            <label for="advEmail">
                                Business Email <b>*</b>
                            </label>

                            <input
                                id="advEmail"
                                name="email"
                                type="email"
                                placeholder="name@company.com"
                                maxlength="254"
                                value="<?= advEsc($values["email"]) ?>"
                                required>

                            <?php if (isset($errors["email"])): ?>
                                <small class="adv-error">
                                    <?= advEsc($errors["email"]) ?>
                                </small>
                            <?php endif; ?>
                        </div>

                        <!-- Phone -->

                        <div class="adv-field">
                            <label for="advPhone">
                                Phone Number
                                <span>(Optional)</span>
                            </label>

                            <input
                                id="advPhone"
                                name="phone"
                                type="tel"
                                placeholder="+1 (555) 000-0000"
                                maxlength="25"
                                value="<?= advEsc($values["phone"]) ?>">

                            <?php if (isset($errors["phone"])): ?>
                                <small class="adv-error">
                                    <?= advEsc($errors["phone"]) ?>
                                </small>
                            <?php endif; ?>
                        </div>

                        <!-- Sector -->

                        <div class="adv-field">
                            <label for="advSector">
                                Business Sector <b>*</b>
                            </label>

                            <select
                                id="advSector"
                                name="sector"
                                required>

                                <option value="">Select Sector</option>

                                <?php foreach ($sectors as $sector): ?>
                                    <option
                                        value="<?= advEsc($sector) ?>"
                                        <?= $values["sector"] === $sector
                                            ? "selected" : "" ?>>

                                        <?= advEsc($sector) ?>

                                    </option>
                                <?php endforeach; ?>

                            </select>

                            <?php if (isset($errors["sector"])): ?>
                                <small class="adv-error">
                                    <?= advEsc($errors["sector"]) ?>
                                </small>
                            <?php endif; ?>
                        </div>

                        <!-- Business Details -->

                        <div class="adv-field adv-full">
                            <label for="advDetails">
                                Details About Your Business <b>*</b>
                            </label>

                            <textarea
                                id="advDetails"
                                name="details"
                                rows="4"
                                minlength="20"
                                maxlength="3000"
                                placeholder="Tell us about your business, products, services and target audience..."
                                required><?= advEsc($values["details"]) ?></textarea>

                            <?php if (isset($errors["details"])): ?>
                                <small class="adv-error">
                                    <?= advEsc($errors["details"]) ?>
                                </small>
                            <?php endif; ?>
                        </div>

                        <!-- Dates -->

                        <div class="adv-field">
                            <label for="advStart">
                                Start Date <b>*</b>
                            </label>

                            <input
                                id="advStart"
                                name="start_date"
                                type="date"
                                value="<?= advEsc($values["start_date"]) ?>"
                                required>

                            <?php if (isset($errors["start_date"])): ?>
                                <small class="adv-error">
                                    <?= advEsc($errors["start_date"]) ?>
                                </small>
                            <?php endif; ?>
                        </div>

                        <div class="adv-field">
                            <label for="advEnd">
                                End Date <b>*</b>
                            </label>

                            <input
                                id="advEnd"
                                name="end_date"
                                type="date"
                                value="<?= advEsc($values["end_date"]) ?>"
                                required>

                            <?php if (isset($errors["end_date"])): ?>
                                <small class="adv-error">
                                    <?= advEsc($errors["end_date"]) ?>
                                </small>
                            <?php endif; ?>
                        </div>

                        <!-- Opportunity -->

                        <div class="adv-field">
                            <label for="advOpportunity">
                                Opportunity Type <b>*</b>
                            </label>

                            <select
                                id="advOpportunity"
                                name="opportunity"
                                required>

                                <option value="">
                                    Select Opportunity
                                </option>

                                <?php foreach ($opportunities as $type): ?>
                                    <option
                                        value="<?= advEsc($type) ?>"
                                        <?= $values["opportunity"] === $type
                                            ? "selected" : "" ?>>

                                        <?= advEsc($type) ?>

                                    </option>
                                <?php endforeach; ?>

                            </select>

                            <?php if (isset($errors["opportunity"])): ?>
                                <small class="adv-error">
                                    <?= advEsc($errors["opportunity"]) ?>
                                </small>
                            <?php endif; ?>
                        </div>

                        <!-- Budget -->

                        <div class="adv-field">
                            <label for="advBudget">
                                Monthly Advertising Budget <b>*</b>
                            </label>

                            <div class="adv-money-field">
                                <span>$</span>

                                <input
                                    id="advBudget"
                                    name="budget"
                                    type="number"
                                    min="1"
                                    max="100000000"
                                    step="0.01"
                                    placeholder="0.00"
                                    value="<?= advEsc($values["budget"]) ?>"
                                    required>
                            </div>

                            <?php if (isset($errors["budget"])): ?>
                                <small class="adv-error">
                                    <?= advEsc($errors["budget"]) ?>
                                </small>
                            <?php endif; ?>
                        </div>

                        <!-- Notes -->

                        <div class="adv-field adv-full">
                            <label for="advNotes">
                                Additional Notes
                                <span>(Optional)</span>
                            </label>

                            <textarea
                                id="advNotes"
                                name="notes"
                                rows="4"
                                maxlength="3000"
                                placeholder="Tell us anything else about your advertising plans..."><?= advEsc($values["notes"]) ?></textarea>

                            <?php if (isset($errors["notes"])): ?>
                                <small class="adv-error">
                                    <?= advEsc($errors["notes"]) ?>
                                </small>
                            <?php endif; ?>
                        </div>

                    </div>

                    <div class="adv-form-footer">

                        <button
                            type="reset"
                            id="advReset"
                            class="adv-reset-btn">
                            Reset
                        </button>

                        <button
                            type="submit"
                            id="advSubmit"
                            class="adv-submit-btn">

                            <span>Submit Request</span>
                            <i class="bi bi-arrow-right"></i>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

</main>

<script src="assets/js/script.js?v=2" defer></script>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
