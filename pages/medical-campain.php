<?php
/**
 * Template Name: Medical Campain
 * Description: 
 */
get_header();
?>

<main id="maincontent">
<header class="relative w-full text-white overflow-hidden"
    style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>'); background-size: cover; background-position: center;">
    <?php get_template_part('components/navigation/desktop'); ?>
    <?php get_template_part('components/navigation/mobile'); ?>

    <div class="w-full pt-[30%] lg:pt-[12%] px-6 lg:px-0 relative z-20 pb-10 lg:pb-40">
        <div class="text-start gap-y-8 max-w-7xl mx-auto">
            <h1 class="text-lg max-w-3xl font-extrabold mb-6 leading-[98%]" 
                data-aos="fade-up" data-aos-duration="300" data-aos-delay="100">
                <?php the_title(); ?>
            </h1>

            <?php if (get_field('banner_title')): ?>
            <h2 class="text-4xl py-3 md:text-5xl max-w-3xl font-extrabold mb-6 leading-[98%]"
                data-aos="fade-up" data-aos-duration="300" data-aos-delay="200">
                <?php echo wp_kses_post(get_field('banner_title')); ?>
            </h2>
            <?php endif; ?>

            <?php if (get_field('banner_description')): ?>
            <p class="text-base lg:text-lg my-4 max-w-4xl"
               data-aos="fade-up" data-aos-duration="300" data-aos-delay="300">
                <?php echo wp_kses_post(get_field('banner_description')); ?>
            </p>
            <?php endif; ?>

            <a href="/contact" class="group inline-flex items-center gap-2 mt-8 bg-[#98C441] text-[#1F3131] px-6 py-3 
                      font-semibold text-base shadow-md transition-all duration-300 hover:bg-[#8AB738] 
                      focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 
                      focus-visible:ring-[#98C441]"
               data-aos="fade-up" data-aos-duration="300" data-aos-delay="400">
                <span>Schedule a consultation</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                </svg>
            </a>

        </div>
    </div>
</header>

<section class="bg-white py-20 px-6 md:px-10 lg:px-0">
    <div class="max-w-7xl mx-auto text-center">
        <?php if (get_field('section_1_title')): ?>
        <h2 class="text-4xl py-3 md:text-4xl max-w-3xl mx-auto font-extrabold mb-6 leading-[98%]"
            data-aos="fade-up" data-aos-duration="300" data-aos-delay="100">
            <?php echo wp_kses_post(get_field('section_1_title')); ?>
        </h2>
        <?php endif; ?>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-start">
            <?php if (have_rows('section_1_repeater')): ?>
            <?php 
        $card_index = 0;
        while (have_rows('section_1_repeater')): the_row(); 
            $icon = get_sub_field('icon'); // returns URL since it's not an array
            $title = get_sub_field('title');
            $description = get_sub_field('description');
            $card_index++;
        ?>
            <div class="group bg-[#006155] p-6 text-[#F9F8F6] flex flex-col items-start transition-all duration-500 ease-out hover:-translate-y-2 hover:bg-[#037a68]"
                data-aos="fade-up" data-aos-duration="300" data-aos-delay="<?php echo $card_index * 100; ?>">

                <?php if ($icon): ?>
                <div class="mb-6" aria-hidden="true">
                    <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title ?: 'Icon'); ?>"
                        class="w-8 h-8 object-contain transition-transform duration-500 group-hover:scale-110">
                </div>
                <?php endif; ?>

                <div class="h-48" aria-hidden="true"></div>
                <?php if ($title): ?>
                <h3 class="text-2xl font-semibold mb-4">
                    <?php echo esc_html($title); ?>
                </h3>
                <?php endif; ?>

                <?php if ($description): ?>
                <p class="text-lg opacity-90 max-w-sm transition-opacity duration-500 group-hover:opacity-100">
                    <?php echo esc_html($description); ?>
                </p>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>

    </div>
</section>

<section class="pb-12 md:pb-10">
    <div class="max-w-7xl mx-auto w-full px-6 md:px-10 lg:px-0 text-black">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">

            <!-- Sticky Content -->
            <div class="relative" data-aos="fade-up" data-aos-duration="300" data-aos-delay="100">
                <div class="sticky top-24">
                    <?php if (get_field('section_2_title')): ?>
                    <h2 class="text-4xl py-3 md:text-4xl font-extrabold mb-6 leading-[98%]"
                        data-aos="fade-up" data-aos-duration="300" data-aos-delay="200">
                        <?php echo wp_kses_post(get_field('section_2_title')); ?>
                    </h2>
                    <?php endif; ?>
                    
                    <?php if (get_field('section_2_description')): ?>
                    <div class="text-lg font-normal space-y-4 mb-10"
                         data-aos="fade-up" data-aos-duration="300" data-aos-delay="300">
                        <p><?php echo wp_kses_post(get_field('section_2_description')); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if (have_rows('section_2_repeater')): ?>
                    <?php 
                    $bullet_index = 0;
                    while (have_rows('section_2_repeater')): the_row(); 
                        $title = get_sub_field('title');
                        $bullet_index++;
                    ?>
                    <div class="flex gap-4 mt-3" 
                         data-aos="fade-up" data-aos-duration="300" data-aos-delay="<?php echo 400 + ($bullet_index * 100); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/dot3.svg" alt="Bullet point"
                            class="w-4 h-4 mt-1">
                        <?php if ($title): ?>
                        <p class="text-lg font-normal">
                            <?php echo esc_html($title); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>

                </div>
            </div>

            <!-- Scrollable Image -->
            <div data-aos="fade-up" data-aos-duration="300" data-aos-delay="200">
                <?php if (get_field('section_2_image')): ?>
                <img src="<?php echo esc_url(get_field('section_2_image')); ?>" alt="Section illustration"
                    class="shadow-md object-cover w-full h-[300px] md:h-[500px]" loading="lazy" decoding="async">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="max-w-7xl mx-auto w-full px-6 py-20 md:px-10 lg:px-0 text-[#1F3131]">
        <?php if (get_field('section_3_subtitle')): ?>
        <p class="text-xl font-medium text-[#1F3131]" 
           data-aos="fade-up" data-aos-duration="300" data-aos-delay="100">
            <?php echo wp_kses_post(get_field('section_3_subtitle')); ?>
        </p>
        <?php endif; ?>
        
        <?php if (get_field('section_3_title')): ?>
        <h2 class="text-4xl mt-3 md:text-4xl font-extrabold mb-6 leading-[98%]"
            data-aos="fade-up" data-aos-duration="300" data-aos-delay="200">
            <?php echo wp_kses_post(get_field('section_3_title')); ?>
        </h2>
        <?php endif; ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-12 md:gap-5 items-center">
            <?php if (have_rows('section_3_repeater')): ?>
            <?php 
            $section3_card_index = 0;
            while (have_rows('section_3_repeater')): the_row(); 
                $icon = get_sub_field('icon'); // URL
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                $section3_card_index++;
            ?>
            <div class="bg-[#AB9DBA66] shadow-lg p-6 text-[#1F3131] flex flex-col items-start transition-transform duration-200 hover:scale-95 hover:shadow-xl focus-within:ring-2 focus-within:ring-[#98C441] focus-within:ring-offset-2 focus-within:ring-offset-[#1F3131]"
                 data-aos="fade-up" data-aos-duration="300" data-aos-delay="<?php echo 300 + ($section3_card_index * 150); ?>">

                <?php if ($icon): ?>
                <div class="mb-6" aria-hidden="true">
                    <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title ?: 'Icon'); ?>"
                        class="w-8 h-8 object-contain">
                </div>
                <?php endif; ?>

                <div class="h-24" aria-hidden="true"></div>

                <?php if ($title): ?>
                <h3 class="text-2xl font-semibold mb-2">
                    <?php echo esc_html($title); ?>
                </h3>
                <?php endif; ?>

                <?php if ($description): ?>
                <p class="text-base opacity-90">
                    <?php echo esc_html($description); ?>
                </p>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>

        </div>
    </div>
</section>

<section class="py-20 px-6 md:px-20">
    <?php if (have_rows('testimonials_repeater')): ?>
    <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-8 items-stretch">
        <?php 
        $testimonial_index = 0;
        while (have_rows('testimonials_repeater')): the_row(); 
            $title   = get_sub_field('title');
            $logo    = get_sub_field('logo'); // URL
            $name    = get_sub_field('name');
            $company = get_sub_field('company');
            $link    = get_sub_field('link');
            $testimonial_index++;
        ?>
        <!-- 2/3 Column -->
        <div class="md:col-span-2 bg-[#DFDAD433] rounded border border-[#DFDAD4] p-8 shadow-sm flex flex-col"
             data-aos="fade-up" data-aos-duration="300" data-aos-delay="<?php echo $testimonial_index * 200; ?>">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/quote.svg'); ?>" alt="Quote Icon"
                class="h-10 w-10 mb-4">
            <div class="h-24"></div>
            <?php if ($title): ?>
            <p class="text-base md:text-3xl text-gray-800 font-medium flex-grow max-w-xl">
                <?php echo esc_html($title); ?>
            </p>
            <?php endif; ?>
        </div>

        <!-- 1/3 Column -->
        <div class="bg-[#006155] rounded border border-[#DFDAD4] overflow-hidden shadow-sm"
             data-aos="fade-up" data-aos-duration="300" data-aos-delay="<?php echo ($testimonial_index * 200) + 100; ?>">
            <div class="py-6 px-8 space-y-1 text-white">
                <?php if ($logo): ?>
                <img src="<?php echo esc_url($logo); ?>" class="w-32 h-auto object-contain mb-4"
                    alt="<?php echo esc_attr($company); ?>">
                <?php endif; ?>

                <?php if ($name): ?>
                <p class="text-lg font-semibold"><?php echo esc_html($name); ?></p>
                <?php endif; ?>

                <?php if ($company): ?>
                <p class="text-lg"><?php echo esc_html($company); ?></p>
                <?php endif; ?>

                <div class="h-24"></div>

                <?php if ($link): ?>
                <a href="<?php echo esc_url($link); ?>"
                    class="inline-flex items-center mt-10 text-sm text-white font-medium border-b-2 border-[#ffffff] hover:border-[#ffffff] transition-colors duration-300">
                    View Case study <span class="ml-1 text-lg">→</span>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>

</section>

<section class="bg-[#1F3131] py-28 text-center" aria-labelledby="industry-cta-title">
    <div class="max-w-3xl mx-auto px-4">
        <!-- Heading -->
        <h2 id="industry-cta-title" class="text-3xl sm:text-4xl md:text-5xl font-bold text-[#F9F8F6] tracking-tight"
            data-aos="fade-up" data-aos-duration="300" data-aos-delay="100">
            Let’s build a better patient experience.
        </h2>

        <!-- Subheading -->
        <p class="mt-6 text-base lg:text-lg text-[#F9F8F6] leading-relaxed" 
           data-aos="fade-up" data-aos-duration="300" data-aos-delay="200">
            Connect with a healthcare strategist today to assess your current language access approach and explore
            what’s possible.
        </p>

        <!-- CTA Buttons -->
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-6" 
             data-aos="fade-up" data-aos-duration="300" data-aos-delay="300">
            <a href="/contact"
                class="bg-[#8DC63F] hover:bg-[#7AB22E] text-black font-medium px-6 py-3 text-base lg:text-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#7AB22E] focus:ring-offset-2 focus:ring-offset-[#1F3131]"
                aria-label="Schedule a consultation - opens contact form">
                Schedule a consultation
            </a>
            <a href="/resources" class="group flex items-center text-[#F9F8F6] font-medium text-base lg:text-lg
       transition-colors duration-300 hover:text-[#F9F8F6]/80">
                Explore our resources
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</section>

</main>

<?php
get_footer(); 