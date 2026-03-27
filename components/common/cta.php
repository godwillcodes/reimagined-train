<section id="cta-section" class="bg-[#1F3131] pt-20 md:pt-20 px-6 lg:px-0">
    <div class="max-w-lg mx-auto text-center">
        <h2 class="text-4xl md:text-5xl text-white font-semibold mb-4">
            Say hello to your partner in growth
        </h2>
        <p class="text-white mb-0 mt-4 text-base md:text-[24px]">
            Talk with our team about how we can support your goals today — and shape what’s next.
        </p>
        <div class="hs-form-frame" data-region="na1" data-form-id="65036f60-3b0e-4b86-8a02-dc0281c542b2"
            data-portal-id="22423917" data-cookie-consent="true"></div>
    </div>
</section>

<script>
(function() {
    const ctaSection = document.getElementById('cta-section');
    if (!ctaSection) return;

    // IntersectionObserver options: trigger 100px before entering viewport
    const observerOptions = {
        root: null,
        rootMargin: '100px',
        threshold: 0
    };

    function loadHubSpotScript() {
        if (window.__hsFormLoaded) return;
        const script = document.createElement('script');
        script.src = 'https://js.hsforms.net/forms/embed/22423917.js';
        script.defer = true;
        document.body.appendChild(script);
        window.__hsFormLoaded = true;
    }

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    loadHubSpotScript();
                    obs.disconnect();
                }
            });
        }, observerOptions);

        observer.observe(ctaSection);
    } else {
        // fallback: load immediately if IntersectionObserver not supported
        loadHubSpotScript();
    }
})();
</script>
