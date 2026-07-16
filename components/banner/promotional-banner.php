<?php if (is_front_page()) : ?>
<div x-data="{ scrolled: window.scrollY > 100 }"
    x-init="
        const bar = $refs.bar;
        const sync = () => {
            const h = (!scrolled && bar && bar.offsetParent !== null) ? bar.offsetHeight : 0;
            document.documentElement.style.setProperty('--promo-h', h + 'px');
        };
        $watch('scrolled', () => sync());
        if (bar && window.ResizeObserver) { new ResizeObserver(sync).observe(bar); }
        sync();
        window.addEventListener('scroll', () => { scrolled = window.scrollY > 100; }, { passive: true });
        window.addEventListener('resize', sync);
    ">
    <section x-ref="bar" id="promo-banner" x-show="!scrolled"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-y-full"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-full"
        class="fixed bottom-0 left-0 right-0 z-[60]"
        style="will-change: transform, opacity;">

        <!-- Solid, vivid, high-contrast card so the message stays crisp and readable -->
        <div class="relative mx-auto max-w-7xl px-3 sm:px-6 py-3 sm:py-4">
            <div
                class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-6 lg:gap-10 rounded-2xl bg-[#98C441] px-5 py-3.5 md:px-8 shadow-[0_10px_30px_rgba(0,0,0,0.28)] ring-1 ring-black/5">
                <p
                    class="flex items-center gap-2.5 text-[#1F3131] font-semibold text-base text-center sm:text-left tracking-[-0.01em]">
                    <span class="relative flex h-2.5 w-2.5 shrink-0" aria-hidden="true">
                        <span
                            class="absolute inline-flex h-full w-full rounded-full bg-[#D16555] opacity-75 motion-safe:animate-ping"></span>
                        <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-[#D16555]"></span>
                    </span>
                    <span><span class="font-bold">Connexus is live:</span> One platform for phone, video, onsite, and AI interpretation in 300+ languages.</span>
                </p>
                <a href="/connexus/"
                    class="group inline-flex shrink-0 items-center gap-2 rounded-full bg-[#1F3131] px-5 py-2.5 text-white text-sm font-semibold shadow-[0_2px_10px_rgba(31,49,49,0.3)] transition-all duration-300 hover:bg-[#2C4646] hover:-translate-y-0.5 hover:shadow-[0_6px_20px_rgba(31,49,49,0.4)] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#1F3131] focus-visible:ring-offset-2 focus-visible:ring-offset-[#98C441]">
                    See it in action
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-4 transition-transform duration-300 group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
</div>

<!-- Float the AI tools widget above the bottom banner while it's showing -->
<style>
#aiShare {
    bottom: var(--promo-h, 0px);
    transition: bottom 0.45s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: bottom;
}
</style>
<?php endif; ?>
