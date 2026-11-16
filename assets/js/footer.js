
document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    const newsletterForm = document.getElementById("cfxNewsletterForm");
    const newsletterEmail = document.getElementById("cfxNewsletterEmail");
    const newsletterFeedback = document.getElementById("cfxNewsletterFeedback");
    const backToTop = document.getElementById("cfxBackToTop");

    /* NEWSLETTER VALIDATION */

    function showFeedback(message, type = "info") {
        if (!newsletterFeedback) return;

        newsletterFeedback.textContent = message;
        newsletterFeedback.classList.remove("info", "error");
        newsletterFeedback.classList.add(type);
    }

    newsletterForm?.addEventListener("submit", function (event) {
        event.preventDefault();

        if (!newsletterEmail) return;

        newsletterEmail.value = newsletterEmail.value.trim();

        if (!newsletterEmail.value || !newsletterEmail.checkValidity()) {
            showFeedback(
                "Please enter a valid email address.",
                "error"
            );

            newsletterEmail.focus();
            return;
        }

        showFeedback(
            "Email validated. Newsletter subscriptions will be available after backend integration.",
            "info"
        );
    });

    newsletterEmail?.addEventListener("input", function () {
        if (newsletterFeedback) {
            newsletterFeedback.textContent = "";
            newsletterFeedback.classList.remove("info", "error");
        }
    });

    /* BACK TO TOP */

    backToTop?.addEventListener("click", function () {
        const reduceMotion = window.matchMedia(
            "(prefers-reduced-motion: reduce)"
        ).matches;

        window.scrollTo({
            top: 0,
            behavior: reduceMotion ? "auto" : "smooth"
        });
    });

    /* SOCIAL LINKS — DEMO PLACEHOLDERS */

    document.querySelectorAll("[data-cfx-social]").forEach(link => {
        link.addEventListener("click", function (event) {
            if (this.getAttribute("href") === "#") {
                event.preventDefault();
            }
        });
    });
});
