<?php
/**
 * Template Name: Strategic Globalization
 * Description:
 */
get_header();
?>

<header class="shadow-sm bg-[#1F3131]" role="banner">
    <div class="bg-[#1F3131] pt-8 pb-12">
        <nav aria-label="Primary desktop navigation">
            <?php get_template_part('components/navigation/desktop'); ?>
        </nav>
        <nav aria-label="Primary mobile navigation">
            <?php get_template_part('components/navigation/mobile'); ?>
        </nav>
    </div>

    <div class="relative h-[500px] md:h-[400px] lg:h-[554px] bg-cover bg-no-repeat bg-right-bottom"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/single-industries.svg'); ?>');">

        <!-- gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#1F3131]/90 via-[#1F3131]/70 to-transparent"
            aria-hidden="true"></div>

        <!-- Content container -->
        <div class="relative z-10 h-full flex items-center">
            <div class="max-w-7xl mx-auto w-full px-6 lg:px-0 pb-4 md:pb-12 lg:pb-12 text-white">
                <p class="text-lg font-medium text-[#F9F8F6]" data-aos="fade-up" data-aos-duration="400">
                    <?php the_title(); ?>
                </p>
                <h1 class="text-2xl mt-4 md:text-4xl lg:text-5xl font-bold" data-aos="fade-up" data-aos-duration="400"
                    data-aos-delay="50">
                    <?php the_field('industry_callout'); ?>
                </h1>
                <p class="text-base lg:text-lg my-4 max-w-4xl" data-aos="fade-up" data-aos-duration="400"
                    data-aos-delay="100">
                    <?php the_field('industry_description'); ?>
                </p>
                <a href="/contact"
                    class="inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] px-4 py-2 mt-4 font-bold text-base shadow-md rounded-0 hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-[#1F3131] transition-colors duration-200"
                    aria-label="Schedule a consultation - opens contact form">
                    <span>Schedule a consultation</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>

<main id="maincontent">

    <section class="bg-white lg:pt-0 pt-10" aria-labelledby="why-piedmont-title">
        <div class="max-w-7xl mx-auto px-6 lg:px-0 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Left side: Title and Description -->
            <div>
                <h2 id="why-piedmont-title" class="text-2xl mt-4 md:text-4xl lg:text-4xl max-w-sm font-bold pt-10 mb-6"
                    data-aos="fade-up" data-aos-duration="400">
                    <?php the_field('why_piedmont_global_title'); ?>
                </h2>
                <div class="text-base md:text-lg text-black  mb-6 prose" data-aos="fade-up" data-aos-duration="400"
                    data-aos-delay="50">
                    <?php echo wp_kses_post(get_field('why_piedmont_global_description')); ?>
                </div>
            </div>

            <!-- Right side: Image -->
            <div class="flex justify-center lg:justify-end" data-aos="fade-up" data-aos-duration="400"
                data-aos-delay="100">
                <?php 
                $why_piedmont_photo = get_field('why_piedmont_global_photo');
                $industry_title = get_the_title();
                ?>
                <img src="<?php echo esc_url($why_piedmont_photo); ?>"
                    alt="Piedmont Global team working with <?php echo esc_attr($industry_title); ?> clients"
                    class="max-w-full h-[300px] lg:h-[500px] object-contain" />
            </div>

        </div>
    </section>

    <section
        class="max-w-7xl mx-auto flex flex-col md:flex-row items-start w-full relative px-6 sm:px-8 lg:px-0 py-16 sm:py-20 lg:py16 gap-10 lg:gap-16"
        aria-labelledby="industry-challenge-title">

        <!-- Left (1/3 width gradient box on desktop, full on mobile) -->
        <div class="w-full md:w-1/3 text-start lg:sticky lg:top-28 lg:self-start">
            <div class="flex flex-col justify-center p-6 sm:p-10 lg:p-14 xl:p-16 w-full h-[400px] md:h-auto rounded-lg"
                data-aos="fade-up" data-aos-duration="400"
                style="background: linear-gradient(144.23deg, rgba(223, 218, 212, 0.3) 13.38%, rgba(152, 196, 65, 0.3) 148.4%);">


                <div class="text-xl text-[#1F3131]  font-bold">
                    <?php echo wp_kses_post(get_field('gradient_section_description')); ?>
                </div>
            </div>
        </div>

        <!-- Right (2/3 content on desktop, full on mobile) -->
        <div class="w-full md:w-2/3 text-start flex flex-col justify-start h-full" data-aos="fade-up"
            data-aos-duration="400" data-aos-delay="50" aria-labelledby="secondary-title">

            <div>
                <h2 id="secondary-title"
                    class="text-xl sm:text-2xl mt-4 md:mt-0 md:text-3xl lg:text-4xl xl:text-5xl font-bold mb-4 sm:mb-6">
                    <?php the_field('secondary_title'); ?>
                </h2>
                <div class="text-sm sm:text-base lg:text-lg prose text-black mb-4 sm:mb-6">
                    <?php echo wp_kses_post(get_field('secondary_description')); ?>
                </div>
            </div>

            <a href="/why-its-time-to-rethink-global-growth-from-translation-to-transformation/"
                class="mt-6 sm:mt-8 inline-flex self-start items-center text-sm sm:text-base lg:text-lg font-medium group focus:outline-none focus:ring-2 focus:ring-[#D16555] focus:ring-offset-2 transition-colors duration-200"
                aria-label="Explore full capabilities - opens contact form">
                <span class="border-b-2 border-[#D16555] pb-0.5">Read our full perspective</span>
                <span class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1"
                    aria-hidden="true">→</span>
            </a>

        </div>

    </section>

    <section class="bg-[#1F3131] bg-cover bg-center relative"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/1.svg'); ?>');"
        aria-labelledby="strategic-approach-title">
        <div class="max-w-7xl mx-auto py-20 px-6 lg:px-0">
            <header class="text-center space-y-4">
                <p class="text-lg text-[#F9F8F6]" data-aos="fade-up" data-aos-duration="400">
                    <?php the_field('our_strategic_approach_small_title'); ?>
                </p>
                <h2 id="strategic-approach-title"
                    class="font-bold text-2xl mt-4 md:text-4xl lg:text-5xl leading-[98%] tracking-[-0.02em] text-[#F9F8F6]"
                    data-aos="fade-up" data-aos-duration="400" data-aos-delay="50">
                    <?php the_field('our_strategic_approach_big_title'); ?>
                </h2>
                <p class="text-base md:text-lg leading-[160%] tracking-[-0.02em] max-w-3xl mx-auto font-normal text-[#F9F8F6]"
                    data-aos="fade-up" data-aos-duration="400" data-aos-delay="100">
                    <?php the_field('our_strategic_approach_description'); ?>
                </p>
            </header>

            <?php if (have_rows('green_cards_repeater')): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-10 py-20 lg:px-0">
                <?php $card_index = 0; ?>
                <?php while (have_rows('green_cards_repeater')): the_row(); ?>
                <?php $card_index++; ?>
                <div class="bg-[#006155] shadow-lg p-6 text-white flex items-center 
                    transition-transform duration-200 hover:shadow-xl 
                    focus-within:ring-2 focus-within:ring-[#98C441] focus-within:ring-offset-2 
                    focus-within:ring-offset-[#1F3131] h-24" data-aos="fade-up" data-aos-duration="400"
                    data-aos-delay="<?php echo $card_index * 50; ?>">

                    <?php if (get_sub_field('description')): ?>
                    <p class="text-lg font-bold text-start w-full">
                        <?php the_sub_field('description'); ?>
                    </p>
                    <?php endif; ?>

                </div>
                <?php endwhile; ?>
            </div>

            <?php endif; ?>

        </div>
    </section>

    <section style="background: linear-gradient(to bottom, #F7F7F5 0%, #F7F7F5 90%, #98C44180 100%);"
        aria-labelledby="case-study-title">
        <?php if (have_rows('case_study')): ?>
        <div class="max-w-7xl mx-auto px-4 py-24 grid grid-cols-1 md:grid-cols-12 gap-6">
            <?php while (have_rows('case_study')): the_row(); ?>
            <!-- Left Card (1/3 width) -->
            <div class="bg-[#1F3131] p-8 flex flex-col justify-between text-white md:col-span-4" data-aos="fade-up"
                data-aos-duration="400">
                <div>
                    <h2 id="case-study-title" class="text-2xl md:text-3xl font-bold mb-6 text-white">
                        <?php the_sub_field('title'); ?>
                    </h2>
                </div>

                <div class="h-24" aria-hidden="true"></div>

                <p class="text-base text-[#fff] leading-relaxed opacity-90">
                    <?php the_sub_field('description'); ?>
                </p>
            </div>

            <!-- Right Card (2/3 width) -->
            <div class="bg-[#DFDAD433] border-[1px] border-[#DFDAD4] p-8 flex flex-col justify-between md:col-span-8"
                data-aos="fade-up" data-aos-duration="400" data-aos-delay="50">
                <div>
                    <img src="https://piedmontglobal.com/wp-content/uploads/language_100dp_98C441_FILL0_wght400_GRAD0_opsz48.svg"
                        alt="" class="h-12 w-12 mb-4" aria-hidden="true" />
                    <blockquote>
                        <p class="text-xl md:text-3xl font-normal leading-snug text-gray-800 mb-6">
                            <?php the_sub_field('testimonial_description'); ?>
                        </p>
                    </blockquote>
                </div>
                <footer class="flex flex-col md:flex-row md:items-center md:justify-between mt-auto gap-4">
                    <cite class="text-base font-semibold text-gray-900 not-italic">
                        <?php the_sub_field('testimonial_source'); ?>
                    </cite>
                    <?php $link = get_sub_field('case_study_link'); ?>
                    <?php if ($link): ?>
                    <a href="<?php echo esc_url($link); ?>"
                        class="inline-flex self-start items-center w-auto text-base font-medium group focus:outline-none focus:ring-2 focus:ring-[#D16555] focus:ring-offset-2 transition-colors duration-200"
                        aria-label="Read full Case study">
                        <span class="border-b-2 border-[#D16555] pb-0.5">Explore full capabilities</span>
                        <span class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1"
                            aria-hidden="true">→</span>
                    </a>

                    <?php endif; ?>
                </footer>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>

        <div class="max-w-7xl mx-auto px-6 pb-16 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center"
            aria-labelledby="compliance-title">
            <!-- Left Box (Image) -->
            <div class="h-full flex items-center justify-center" aria-labelledby="<?php the_title(); ?>">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full') ?: '/wp-content/uploads/iStock-1454186321-2.png'); ?>"
                    class="h-[300px] lg:h-[500px] w-full object-contain object-center" alt="<?php the_title(); ?>">
            </div>

            <!-- Right Content -->
            <div class="h-full flex flex-col justify-center" data-aos="fade-up" data-aos-duration="400">
                <h2 id="compliance-title" class="text-2xl mt-4 md:text-4xl lg:text-4xl font-bold text-gray-900 mb-6">
                    <?php the_field('compliance_title'); ?>
                </h2>
                <div class="text-lg prose text-gray-700 mb-6">
                    <?php echo wp_kses_post(get_field('compliance_description')); ?>
                </div>
            </div>
        </div>

    </section>


    <?php get_template_part('components/common/faqs-related'); ?>
	
	
</main>

<section class="bg-[#1F3131] pt-28 text-center" aria-labelledby="industry-cta-title">
    <div class="max-w-3xl mx-auto px-4">
        <!-- Heading -->
        <h2 id="industry-cta-title" class="text-3xl sm:text-4xl md:text-4xl font-bold text-[#F9F8F6] tracking-tight">
            <?php the_field('industry_cta_title'); ?>
        </h2>

        <!-- Subheading -->
        <p class="mt-6 text-base lg:text-lg text-[#F9F8F6] leading-relaxed" data-aos-delay="50">
            <?php the_field('industry_cta_description'); ?>
        </p>

        <!-- CTA Buttons -->
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-6" data-aos="fade-up"
            data-aos-duration="400" data-aos-delay="100">
            <a href="/contact"
                class="bg-[#8DC63F] hover:bg-[#7AB22E] text-black font-medium px-6 py-3 text-base lg:text-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#7AB22E] focus:ring-offset-2 focus:ring-offset-[#1F3131]"
                aria-label="Schedule a consultation - opens contact form">
                Schedule a consultation
            </a>
            <a href="<?php echo esc_url(get_field('industry_cta_secondary_button_link') ?: '/resources'); ?>"
                class="flex items-center text-[#F9F8F6] font-medium text-base lg:text-lg hover:underline focus:outline-none focus:ring-2 focus:ring-[#F9F8F6] focus:ring-offset-2 focus:ring-offset-[#1F3131] transition-colors duration-200">
                <?php echo esc_html(get_field('industry_cta_secondary_button_title') ?: 'Explore our resources'); ?>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>