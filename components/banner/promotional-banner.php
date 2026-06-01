<?php if (is_front_page()) : ?>
<div x-data="{ scrolled: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 100 })">
    <section x-show="!scrolled" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-full" 
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" 
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-full"
        class="bg-[#98C441] py-3 fixed top-0 left-0 right-0 z-[60]"
        style="will-change: transform, opacity;">
        <div
            class="max-w-7xl mx-auto px-4 md:px-6 lg:px-0 flex flex-col sm:flex-row items-center justify-center gap-4 lg:gap-12">
            <p class="text-[#1F3131] font-semibold text-base text-center sm:text-left">
                <span class="font-bold">Connexus is live:</span> One platform for phone, video, onsite, and AI interpretation in 300+ languages.
            </p>
            <a href="/connexus/"
                class="inline-flex items-center text-[#1F3131] text-base font-semibold transition-colors relative">
                See it in action
                <span class="ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>

                </span>
                <span class="absolute left-0 bottom-[-12px] w-full h-[2px] bg-[#D16555]"></span>
            </a>

        </div>
    </section>
    <!-- Spacer to push content down when banner is visible -->
    <div x-show="!scrolled" class="h-[52px] sm:h-[44px]"></div>
</div>
<?php endif; ?>