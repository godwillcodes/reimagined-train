<?php
/**
 * Template Name: NASPO
 * Description: 
 */
get_header();
?>

<main id="maincontent">
    <header class="relative w-full text-white overflow-visible"
        style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url()); ?>'); background-size: cover; background-position: center;">
        <?php get_template_part('components/navigation/desktop'); ?>
        <?php get_template_part('components/navigation/mobile'); ?>

        <!-- Gradient tint overlay -->
        <div class="absolute inset-0 z-10 bg-gradient-to-r from-[#1F3131]/90 via-[#1F3131]/90 to-transparent"></div>

        <div class="w-full pt-24 px-6 lg:px-0 relative z-20 ">
            <div class="max-w-7xl mx-auto w-full grid grid-cols-1 md:grid-cols-4 gap-8 items-start text-white">

                <!-- Left: Text Content -->
                <div class="md:col-span-2 relative z-20">
                    <h1 class="text-lg max-w-3xl font-extrabold mb-6 leading-[98%]" data-aos="fade-up"
                        data-aos-duration="300" data-aos-delay="100">
                        <?php the_title(); ?>
                    </h1>

                    <?php if (get_field('banner_title')): ?>
                        <h2 class="text-4xl py-3 md:text-5xl max-w-3xl font-extrabold mb-6 leading-[98%]" data-aos="fade-up"
                            data-aos-duration="300" data-aos-delay="200">
                            <?php echo wp_kses_post(get_field('banner_title')); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (get_field('banner_description')): ?>
                        <p class="text-base lg:text-lg my-4 max-w-4xl" data-aos="fade-up" data-aos-duration="300"
                            data-aos-delay="300">
                            <?php echo wp_kses_post(get_field('banner_description')); ?>
                        </p>
                    <?php endif; ?>

                    <a href="https://meetings.hubspot.com/jsmith207" class="group inline-flex items-center gap-2 mt-8 bg-[#98C441] text-[#1F3131] px-6 py-3 
                      font-semibold text-base shadow-md transition-all duration-300 hover:bg-[#8AB738] 
                      focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 
                      focus-visible:ring-[#98C441]" data-aos="fade-up" data-aos-duration="300" data-aos-delay="400">
                        <span>Book an intro call with Jon</span>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>

                    </a>
                </div>

                <!-- Right: Form -->
                <div class="md:col-span-2 relative overflow-visible">
                    <div class="relative bg-white w-full p-6 sm:p-8 shadow-xl z-30 mt-8 md:mt-0" data-aos="fade-left"
                        data-aos-delay="400">
                        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/embed/v2.js">
                        </script>
                        <script>
                            hbspt.forms.create({
                                portalId: "22423917",
                                formId: "04859de3-3eac-4708-a3a6-9c50c803f8d1",
                                region: "na1"
                            });
                        </script>
                        <div class="hs-form-container"></div>
                    </div>
                </div>

            </div>
        </div>
    </header>


    <section class="py-20">
        <div class="max-w-7xl mx-auto w-full px-6 md:px-10 lg:px-0 text-black">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">

                <!-- Sticky Content -->
                <div class="relative" data-aos="fade-up" data-aos-duration="300" data-aos-delay="100">
                    <div class="sticky top-24">
                        <?php if (get_field('section_2_title')): ?>
                            <h2 class="text-4xl py-3 md:text-4xl font-extrabold mb-6 leading-[98%]" data-aos="fade-up"
                                data-aos-duration="300" data-aos-delay="200">
                                <?php echo wp_kses_post(get_field('section_2_title')); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (get_field('section_2_description')): ?>
                            <div class="text-lg font-normal space-y-4 mb-10" data-aos="fade-up" data-aos-duration="300"
                                data-aos-delay="300">
                                <p><?php echo wp_kses_post(get_field('section_2_description')); ?></p>
                            </div>

                            <a href="https://piedmontglobal.com/webinar/simplifying-state-local-and-education-procurement-with-piedmont-global/"
                                class="group inline-flex items-center gap-2 mt-2 bg-[#98C441] text-[#1F3131] px-6 py-3 
                      font-semibold text-base shadow-md transition-all duration-300 hover:bg-[#8AB738] 
                      focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 
                      focus-visible:ring-[#98C441]" data-aos="fade-up" data-aos-duration="300" data-aos-delay="400">
                                <span>View webinar: Simplifying SLED procurement</span>



                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>

                            </a>
                        <?php endif; ?>
                        <?php if (have_rows('section_2_repeater')): ?>
                            <?php
                            $bullet_index = 0;
                            while (have_rows('section_2_repeater')):
                                the_row();
                                $title = get_sub_field('title');
                                $bullet_index++;
                                ?>
                                <div class="flex gap-4 mt-3" data-aos="fade-up" data-aos-duration="300"
                                    data-aos-delay="<?php echo 400 + ($bullet_index * 100); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/dot3.svg"
                                        alt="Bullet point" class="w-4 h-4 mt-1">
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
                <div class="w-full h-auto max-w-3xl mx-auto" data-aos="fade-up" data-aos-duration="300"
                    data-aos-delay="200">
                    <img src="/wp-content/uploads/Naspo-Servers-Storage-_-Public-Sector-Site.png" alt="NASPO Section 2"
                        class="w-full h-auto object-scale-down">
                </div>

            </div>
        </div>
    </section>

    <section class="pb-20">
        <div class="max-w-7xl mx-auto w-full px-6 md:px-10 lg:px-0 text-black">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">
                <div data-aos="fade-up" data-aos-duration="300" data-aos-delay="200">
                    <?php if (get_field('naspo_webinar_photo')): ?>
                        <img src="<?php echo esc_url(get_field('naspo_webinar_photo')); ?>" alt="Section illustration"
                            class="shadow-md object-contain w-full" loading="lazy" decoding="async">
                    <?php endif; ?>
                </div>

                <!-- Sticky Content -->
                <div class="relative" data-aos="fade-up" data-aos-duration="300" data-aos-delay="100">
                    <div class="sticky top-24">


                        <?php if (get_field('naspo_webinar_content')): ?>
                            <div class="text-lg font-normal prose space-y-4 mb-10" data-aos="fade-up"
                                data-aos-duration="300" data-aos-delay="300">
                                <?php echo wp_kses_post(get_field('naspo_webinar_content')); ?>
                            </div>
                        <?php endif; ?>

                        <a href="https://piedmontglobal.com/webinar/your-procurement-advantage-piedmont-global-with-naspo-valuepoint/"
                            class="group inline-flex items-center gap-2  bg-[#98C441] text-[#1F3131] px-6 py-3 
                      font-semibold text-base shadow-md transition-all duration-300 hover:bg-[#8AB738] 
                      focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 
                      focus-visible:ring-[#98C441]" data-aos="fade-up" data-aos-duration="300" data-aos-delay="400">
                            <span>View the recorded webinar</span>




                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                            </svg>


                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="bg-white pb-20 px-6 md:px-10 lg:px-0">
        <div class="max-w-7xl mx-auto text-center">
            <?php if (get_field('section_1_title')): ?>
                <h2 class="text-4xl py-3 md:text-4xl max-w-3xl mx-auto font-extrabold mb-6 leading-[98%]" data-aos="fade-up"
                    data-aos-duration="300" data-aos-delay="100">
                    <?php echo wp_kses_post(get_field('section_1_title')); ?>
                </h2>
            <?php endif; ?>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-start">
                <?php if (have_rows('section_1_repeater')): ?>
                    <?php
                    $card_index = 0;
                    while (have_rows('section_1_repeater')):
                        the_row();
                        $icon = get_sub_field('icon');
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

                            <div class="h-24" aria-hidden="true"></div>
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


    <section class="">
        <div class="max-w-7xl mx-auto w-full px-6 pb-20 md:px-10 lg:px-0 text-[#1F3131]">
            <?php if (get_field('section_3_subtitle')): ?>
                <p class="text-xl font-medium text-[#1F3131]" data-aos="fade-up" data-aos-duration="300"
                    data-aos-delay="100">
                    <?php echo wp_kses_post(get_field('section_3_subtitle')); ?>
                </p>
            <?php endif; ?>

            <?php if (get_field('section_3_title')): ?>
                <h2 class="text-4xl mt-3 md:text-4xl font-extrabold mb-6 leading-[98%]" data-aos="fade-up"
                    data-aos-duration="300" data-aos-delay="200">
                    <?php echo wp_kses_post(get_field('section_3_title')); ?>
                </h2>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-12 md:gap-5 items-center">
                <?php if (have_rows('section_3_repeater')): ?>
                    <?php
                    $section3_card_index = 0;
                    while (have_rows('section_3_repeater')):
                        the_row();
                        $icon = get_sub_field('icon');
                        $title = get_sub_field('title');
                        $description = get_sub_field('description');
                        $link = get_sub_field('link');
                        $section3_card_index++;
                        ?>

                        <?php if ($link): ?>
                            <a href="<?php echo esc_url($link); ?>"
                                class="bg-[#AB9DBA66] shadow-lg p-6 text-[#1F3131] flex flex-col items-start transition-transform duration-200 hover:scale-95 hover:shadow-xl focus-within:ring-2 focus-within:ring-[#98C441] focus-within:ring-offset-2 focus-within:ring-offset-[#1F3131]"
                                data-aos="fade-up" data-aos-duration="300"
                                data-aos-delay="<?php echo 300 + ($section3_card_index * 150); ?>">
                            <?php else: ?>
                                <div class="bg-[#AB9DBA66] shadow-lg p-6 text-[#1F3131] flex flex-col items-start transition-transform duration-200 hover:scale-95 hover:shadow-xl focus-within:ring-2 focus-within:ring-[#98C441] focus-within:ring-offset-2 focus-within:ring-offset-[#1F3131]"
                                    data-aos="fade-up" data-aos-duration="300"
                                    data-aos-delay="<?php echo 300 + ($section3_card_index * 150); ?>">
                                <?php endif; ?>

                                <?php if ($icon): ?>
                                    <div class="mb-6" aria-hidden="true">
                                        <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title ?: 'Icon'); ?>"
                                            class="w-8 h-8 object-contain">
                                    </div>
                                <?php endif; ?>

                                <div class="h-24" aria-hidden="true"></div>

                                <?php if ($title): ?>
                                    <h3 class="text-2xl font-semibold mb-2"><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>

                                <?php if ($description): ?>
                                    <p class="text-base opacity-90"><?php echo esc_html($description); ?></p>
                                <?php endif; ?>

                                <?php if ($link): ?>
                            </a>
                        <?php else: ?>
                        </div>
                    <?php endif; ?>

                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        </div>
    </section>


    <section class="pb-20">
        <div class="max-w-7xl mx-auto w-full px-6 md:px-10 lg:px-0 text-black">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">
                <div data-aos="fade-up" data-aos-duration="300" data-aos-delay="200">
                    <?php if (get_field('section_21_image')): ?>
                        <img src="<?php echo esc_url(get_field('section_21_image')); ?>" alt="Section illustration"
                            class="shadow-md object-cover w-full h-[300px] md:h-[500px]" loading="lazy" decoding="async">
                    <?php endif; ?>
                </div>

                <!-- Sticky Content -->
                <div class="relative" data-aos="fade-up" data-aos-duration="300" data-aos-delay="100">
                    <div class="sticky top-24">
                        <?php if (get_field('section_21_title')): ?>
                            <h2 class="text-4xl py-3 md:text-4xl font-extrabold mb-6 leading-[98%]" data-aos="fade-up"
                                data-aos-duration="300" data-aos-delay="200">
                                <?php echo wp_kses_post(get_field('section_21_title')); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (get_field('section_21_description')): ?>
                            <div class="text-lg font-normal prose space-y-4 mb-10" data-aos="fade-up"
                                data-aos-duration="300" data-aos-delay="300">
                                <?php echo wp_kses_post(get_field('section_21_description')); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-[#1F3131] py-28 text-center" aria-labelledby="industry-cta-title">
        <div class="max-w-3xl mx-auto px-4">
            <h2 id="industry-cta-title" class="text-3xl sm:text-4xl md:text-5xl font-bold text-[#F9F8F6] tracking-tight"
                data-aos="fade-up" data-aos-duration="300" data-aos-delay="100">
                Ready to get started?
            </h2>

            <p class="mt-6 text-base lg:text-lg text-[#F9F8F6] leading-relaxed" data-aos="fade-up"
                data-aos-duration="300" data-aos-delay="200">
                Use the trusted NASPO ValuePoint contract to simplify procurement and strengthen language access today.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6" data-aos="fade-up"
                data-aos-duration="300" data-aos-delay="300">

                <a href="https://meetings.hubspot.com/jsmith207" class="group inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] px-6 py-3 font-semibold text-base shadow-md 
            transition-all duration-300 hover:bg-[#8AB738] focus:outline-none focus-visible:ring-2 
            focus-visible:ring-offset-2 focus-visible:ring-[#98C441]" data-aos="fade-up" data-aos-duration="300"
                    data-aos-delay="400">
                    <span>Book an intro call with Jon</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                </a>

                <a href="/resources" class="group inline-flex items-center gap-2 text-[#F9F8F6] font-medium text-base lg:text-lg 
            transition-colors duration-300 hover:text-[#F9F8F6]/80">
                    <span>Explore our resources</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none"
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
