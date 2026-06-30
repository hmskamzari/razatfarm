document.addEventListener('DOMContentLoaded', () => {
    // Scroll-reveal
    const revealEls = document.querySelectorAll('.reveal-up');
    if ('IntersectionObserver' in window && revealEls.length) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry, i) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => entry.target.classList.add('is-visible'), i * 60);
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.15, rootMargin: '0px 0px -40px 0px' }
        );
        revealEls.forEach((el) => observer.observe(el));
    } else {
        revealEls.forEach((el) => el.classList.add('is-visible'));
    }

    // Hero slider
    document.querySelectorAll('[data-hero-slider]').forEach((slider) => {
        const slides = slider.querySelectorAll('.hero-slide');
        const dots = slider.querySelectorAll('[data-hero-dot]');
        if (slides.length < 2) return;

        let index = 0;
        const show = (i) => {
            slides.forEach((s, si) => s.classList.toggle('is-active', si === i));
            dots.forEach((d, di) => d.classList.toggle('bg-gold', di === i));
            index = i;
        };

        dots.forEach((dot, i) => dot.addEventListener('click', () => show(i)));

        setInterval(() => show((index + 1) % slides.length), 6000);
    });

    // Mobile nav toggle
    const navToggle = document.querySelector('[data-nav-toggle]');
    const mobileNav = document.querySelector('[data-mobile-nav]');
    if (navToggle && mobileNav) {
        navToggle.addEventListener('click', () => {
            mobileNav.classList.toggle('hidden');
        });
    }
});
