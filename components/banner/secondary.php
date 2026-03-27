<section class="relative bg-[linear-gradient(to_bottom,_#1F3131_85%,_#006155_100%)]  w-full text-white overflow-hidden">
    <?php get_template_part('components/navigation/desktop'); ?>
    <?php get_template_part('components/navigation/mobile'); ?>

    <div class="w-full pt-[30%] lg:pt-[8%] px-4 sm:px-6 md:px-12 relative z-20 pb-60">
        <div class="text-center gap-y-8 max-w-4xl mx-auto">
            <h1 class="text-base sm:text-lg md:text-xl font-bold">
                <?php echo wp_kses_post ( get_field('section_title') ); ?>
            </h1>

            <h2 class="text-3xl py-5 sm:text-4xl md:text-5xl max-w-4xl font-extrabold mb-6 leading-[98%]">
                <?php echo wp_kses_post ( get_field('primary_description') ); ?>
            </h2>

            <p class="text-sm sm:text-base md:text-lg leading-relaxed">
                <?php echo wp_kses_post ( get_field('supporting_description') ); ?>
            </p>

            <a href="/contact"
                class=" inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] mt-10 px-4 py-2 font-bold text-base shadow-md rounded-0 hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-[#1F3131] transition-colors duration-200"
                role="button" aria-haspopup="dialog" aria-expanded="false">
                Schedule a consultation
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                </svg>
            </a>

        </div>
    </div>

    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/pattern-3.svg'); ?>"
        alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
        class="absolute bottom-[-20px] lg:bottom-[-75%] left-0 w-full z-10">
</section>