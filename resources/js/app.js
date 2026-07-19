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

// --- Custom Page Loader & Progress Bar (NProgress style) ---
const ProgressBar = {
    status: null, // current percentage (0 to 1)
    timeout: null,
    elements: {
        container: null,
        bar: null,
        spinner: null
    },

    create() {
        if (this.elements.container) return;

        const container = document.createElement('div');
        container.id = 'nprogress';
        
        const bar = document.createElement('div');
        bar.className = 'bar';
        bar.setAttribute('role', 'bar');

        container.appendChild(bar);
        document.body.appendChild(container);

        this.elements.container = container;
        this.elements.bar = bar;
    },

    set(n) {
        this.create();
        n = Math.max(0, Math.min(1, n));
        this.status = n;

        // Force repaint
        this.elements.bar.offsetWidth;

        this.elements.bar.style.width = (n * 100) + '%';
        this.elements.bar.style.opacity = '1';
    },

    start() {
        if (this.status !== null) {
            if (this.status >= 1) this.set(0);
        } else {
            this.set(0);
        }

        const work = () => {
            this.timeout = setTimeout(() => {
                if (this.status === null || this.status >= 0.99) return;
                
                // Slow down progress as it gets closer to 100%
                let amount = 0;
                if (this.status >= 0 && this.status < 0.2) amount = 0.1;
                else if (this.status >= 0.2 && this.status < 0.5) amount = 0.04;
                else if (this.status >= 0.5 && this.status < 0.8) amount = 0.02;
                else if (this.status >= 0.8 && this.status < 0.99) amount = 0.005;

                this.set(this.status + amount);
                work();
            }, 200);
        };

        work();
    },

    done() {
        if (this.status === null) return;

        clearTimeout(this.timeout);
        this.set(1);

        setTimeout(() => {
            if (this.elements.bar) {
                this.elements.bar.style.opacity = '0';
            }
            setTimeout(() => {
                if (this.elements.bar) {
                    this.elements.bar.style.width = '0%';
                }
                this.status = null;
            }, 200);
        }, 300);
    }
};

window.ProgressBar = ProgressBar;

// Automatically start on link click
document.addEventListener('click', (event) => {
    const link = event.target.closest('a');
    if (!link) return;

    const href = link.getAttribute('href');
    const target = link.getAttribute('target');

    if (!href) return;
    if (href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:')) return;
    if (target && target === '_blank') return;
    if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return; 

    // Same origin check
    try {
        const url = new URL(href, window.location.href);
        if (url.origin !== window.location.origin) return;
    } catch (e) {
        return;
    }

    ProgressBar.start();
});

// Run complete animation on load
ProgressBar.start();
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        ProgressBar.done();
    }, 150);
});

window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
        ProgressBar.done();
    }
});

