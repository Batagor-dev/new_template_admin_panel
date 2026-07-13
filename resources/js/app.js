window.togglePassword = function (inputId, button) {
    const input = document.getElementById(inputId);
    if (!input) return;

    const openEye =
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
    const closedEye =
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.75 18.75 0 0 1 5.06-6.06"></path><path d="M1 1l22 22"></path><path d="M9.88 9.88a3 3 0 0 0 4.24 4.24"></path><path d="M14.12 14.12a3 3 0 0 1-4.24-4.24"></path></svg>';

    if (input.type === "password") {
        input.type = "text";
        button.innerHTML = closedEye;
    } else {
        input.type = "password";
        button.innerHTML = openEye;
    }
};

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[data-sidebar-toggle]").forEach((button) => {
        const targetId = button.dataset.target;
        if (!targetId) return;

        const target = document.getElementById(targetId);
        if (!target) return;

        const setInitialHeight = () => {
            if (button.getAttribute("aria-expanded") === "true") {
                target.style.maxHeight = "none";
            } else {
                target.style.maxHeight = "0px";
            }
        };

        setInitialHeight();

        const handleTransitionEnd = () => {
            if (button.getAttribute("aria-expanded") === "true") {
                target.style.maxHeight = "none";
            }
        };

        button.addEventListener("click", () => {
            const isExpanded = button.getAttribute("aria-expanded") === "true";
            target.removeEventListener("transitionend", handleTransitionEnd);

            if (isExpanded) {
                target.style.maxHeight = `${target.scrollHeight}px`;
                // Force repaint
                target.offsetHeight;

                button.setAttribute("aria-expanded", "false");
                requestAnimationFrame(() => {
                    target.style.maxHeight = "0px";
                });
            } else {
                button.setAttribute("aria-expanded", "true");
                target.style.maxHeight = `${target.scrollHeight}px`;
                target.addEventListener("transitionend", handleTransitionEnd, { once: true });
            }
        });

        window.addEventListener("resize", setInitialHeight);
    });
});
