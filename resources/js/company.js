document.addEventListener("DOMContentLoaded", function () {
    // Scroll Reveal Animation using Intersection Observer
    function initRevealObserver() {
        const revealElements = document.querySelectorAll('.reveal, .reveal-stagger');

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -30px 0px'
        });

        revealElements.forEach(el => {
            revealObserver.observe(el);
        });
    }

    initRevealObserver();

    // Re-observe when tabs are switched (for layanan page)
    document.querySelectorAll('.tab-btn').forEach(tab => {
        tab.addEventListener('click', () => {
            setTimeout(initRevealObserver, 50);
        });
    });
});
