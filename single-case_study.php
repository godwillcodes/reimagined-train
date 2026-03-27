<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package PiedmontGlobal
 */

get_header();
?>
<header class="relative w-full text-[#F9F8F6] overflow-hidden bg-[linear-gradient(to_bottom,_#1F3131_50%,_#006155_100%)]">
    <?php get_template_part('components/navigation/desktop'); ?>
    <?php get_template_part('components/navigation/mobile'); ?>

    <div class="relative z-20 w-full px-6 lg:px-0 pt-[30%] lg:pt-[10%] pb-10 lg:pb-24">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- Title -->
            <h1 class="text-4xl md:text-4xl font-extrabold normal-case leading-[98%] max-w-3xl">
                <?php the_field('title'); ?>
            </h1>

            <!-- Intro Text -->
            <div class="text-lg font-light max-w-5xl">
                <?php the_content(); ?>
            </div>

            <!-- Client Info -->
            <div class="flex items-center gap-4 pt-3">
                <?php if (get_field('logo')) : ?>
                <img src="<?php the_field('logo'); ?>" alt="Client Logo"
                    class="w-[80px] h-[80px] bg-white p-1 rounded-full object-contain object-center" />
                <?php endif; ?>

                <div>
                    <div class="text-base font-bold"><?php the_field('testimonials_name'); ?> from  <?php the_title(); ?> </div>
                    <div class="text-base font-light">Industry: <?php the_field('industry'); ?></div>
                </div>
            </div>

        </div>
    </div>
</header>



<section class=" px-6 lg:px-0 py-16 bg-[#F9F8F6]">
    <div class="grid grid-cols-1 max-w-7xl mx-auto md:grid-cols-2 lg:grid-cols-1 gap-8 lg:gap-12">

        <!-- Card -->
        <div class="group relative" data-aos="fade-up" data-aos-duration="600" data-aos-easing="ease-out">
            <div class="relative bg-white p-8 lg:p-10  border border-gray-200  h-full shadow-sm">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-[#d16555] rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" stroke="#fff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M6.30928 9C8.59494 5 9.96832 3 12 3C14.3107 3 15.7699 5.58716 18.6883 10.7615L19.0519 11.4063C21.4771 15.7061 22.6897 17.856 21.5937 19.428C20.4978 21 17.7864 21 12.3637 21H11.6363C6.21356 21 3.50217 21 2.40626 19.428C1.45498 18.0635 2.24306 16.2635 4.05373 13"
                                    stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path>
                                <path d="M12 8V13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path>
                                <circle cx="12" cy="16" r="1" fill="#fff"></circle>
                            </g>
                        </svg>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-bold text-[#1F3131]"> Challenge</h3>
                </div>
                <div class="text-gray-600 prose leading-relaxed text-base lg:text-lg">
                    <?php the_field('challenge'); ?>
                </div>
            </div>
        </div>

        <!-- Duplicate cards for demo -->
        <div class="group relative" data-aos="fade-up" data-aos-duration="600" data-aos-easing="ease-out"
            data-aos-delay="100">
            <div class="relative bg-white p-8 lg:p-10 border border-gray-200  h-full shadow-sm">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-[#d16555] rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" viewBox="0 0 1024 1024" class="icon" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M434.2 878.1c15.4 16.9 38.5 22.9 82.6 24 57.9 1.4 75.4-8.5 92.5-48.5 2.8-6.5 5.5-13.6 8.2-21.5l-183.3 46zM377.6 707c2 7.4 4 15.4 6.1 24 0.7 2.8 7.7 32.1 10.8 44.3l256.7-64.5c0.4-1.3 0.7-2.6 1.1-3.9H377.6v0.1z m-18.3-55.9c-8-18-17.2-30.9-30-42.2-22.8-20.2-42-43.7-57-69.6h484.4c-14.5 25.1-33 48-54.9 67.8-12.8 11.6-22.2 25.1-30.6 44H359.3zM235 399.5c0-154.4 125.2-279.6 279.6-279.6s279.6 125.2 279.6 279.6c0 39.3-8.1 77.2-23.2 111.8H258.2c-15.1-34.7-23.2-72.6-23.2-111.8z m57.3 251.3c-69.4-61.5-113.2-151.3-113.2-251.3C179.1 214.2 329.3 64 514.6 64S850.1 214.2 850.1 399.5c0 98.8-42.7 187.7-110.7 249.1-32.6 29.5-46 151.1-78.6 227-26.8 62.4-66 84.2-145.2 82.3-77.3-1.8-120.4-21.3-147.2-80.8-34.1-75.5-43-197-76.1-226.3z"
                                    fill="#FFFFFF"></path>
                                <path
                                    d="M235 399.5c0-154.4 125.2-279.6 279.6-279.6s279.6 125.2 279.6 279.6c0 39.3-8.1 77.2-23.2 111.8H258.2c-15.1-34.7-23.2-72.6-23.2-111.8zM359.3 651.1c-8-18-17.2-30.9-30-42.2-22.8-20.2-42-43.7-57-69.6h484.4c-14.5 25.1-33 48-54.9 67.8-12.8 11.6-22.2 25.1-30.6 44H359.3zM418.8 853.1c-5.9-13.4-11.4-29.6-17.3-50.7L643 741.8c-3.1 11.8-7.3 28.4-8.8 34-2.4 9.1-4.7 17.4-6.9 25l-208.5 52.3z"
                                    fill="#FFFFFF"></path>
                                <path
                                    d="M304.9 400.8c-14 0-13.4-20.6-12.2-30C305.6 270 385.6 190.2 486.4 177.6c7-0.9 29.4-1.7 29.4 12.2 0 14-31.5 16.3-31.5 16.3-83.8 13-150.1 79.3-163.1 163.1 0 0-2.4 31.6-16.3 31.6z"
                                    fill="#FFFFFF"></path>
                            </g>
                        </svg>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-bold text-[#1F3131]"> Solution</h3>
                </div>
                <div class="text-gray-600 prose leading-relaxed text-base lg:text-lg">
                    <?php the_field('solution'); ?>
                </div>
            </div>
        </div>

        <div class="group relative" data-aos="fade-up" data-aos-duration="600" data-aos-easing="ease-out"
            data-aos-delay="200">
            <div class="relative bg-white p-8 lg:p-10 border border-gray-200  h-full shadow-sm">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-[#d16555] rounded-2xl flex items-center justify-center">

                        <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M17 6C17 4.11438 17 3.17157 16.4142 2.58579C15.8284 2 14.8856 2 13 2H11C9.11438 2 8.17157 2 7.58579 2.58579C7 3.17157 7 4.11438 7 6"
                                    stroke="#fff" stroke-width="1.5"></path>
                                <path
                                    d="M11.1459 11.0225C11.5259 10.3408 11.7159 10 12 10C12.2841 10 12.4741 10.3408 12.8541 11.0225L12.9524 11.1989C13.0603 11.3926 13.1143 11.4894 13.1985 11.5533C13.2827 11.6172 13.3875 11.641 13.5972 11.6884L13.7881 11.7316C14.526 11.8986 14.895 11.982 14.9828 12.2643C15.0706 12.5466 14.819 12.8407 14.316 13.429L14.1858 13.5812C14.0429 13.7483 13.9714 13.8319 13.9392 13.9353C13.9071 14.0387 13.9179 14.1502 13.9395 14.3733L13.9592 14.5763C14.0352 15.3612 14.0733 15.7536 13.8435 15.9281C13.6136 16.1025 13.2682 15.9435 12.5773 15.6254L12.3986 15.5431C12.2022 15.4527 12.1041 15.4075 12 15.4075C11.8959 15.4075 11.7978 15.4527 11.6014 15.5431L11.4227 15.6254C10.7318 15.9435 10.3864 16.1025 10.1565 15.9281C9.92674 15.7536 9.96476 15.3612 10.0408 14.5763L10.0605 14.3733C10.0821 14.1502 10.0929 14.0387 10.0608 13.9353C10.0286 13.8319 9.95713 13.7483 9.81418 13.5812L9.68403 13.429C9.18097 12.8407 8.92945 12.5466 9.01723 12.2643C9.10501 11.982 9.47396 11.8986 10.2119 11.7316L10.4028 11.6884C10.6125 11.641 10.7173 11.6172 10.8015 11.5533C10.8857 11.4894 10.9397 11.3926 11.0476 11.1989L11.1459 11.0225Z"
                                    stroke="#fff" stroke-width="1.5"></path>
                                <path
                                    d="M15.5777 20.2111C13.8221 21.089 12.9443 21.5279 12 21.5279C11.0557 21.5279 10.1779 21.089 8.42229 20.2111C6.27063 19.1353 5.19479 18.5974 4.5974 17.6308C4 16.6642 4 15.4614 4 13.0557V12C4 9.17157 4 7.75736 4.87868 6.87868C5.75736 6 7.17157 6 10 6H14C16.8284 6 18.2426 6 19.1213 6.87868C20 7.75736 20 9.17157 20 12V13.0557C20 15.4614 20 16.6642 19.4026 17.6308C19.2876 17.8169 19.1548 17.9872 19 18.1484"
                                    stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-bold text-[#1F3131]"> Results</h3>
                </div>
                <div class="text-gray-600 prose leading-relaxed text-base lg:text-lg">
                    <?php the_field('results'); ?>

                </div>
            </div>
        </div>

    </div>
    
    <?php 
    $video_id = get_field('video_id');
    if ($video_id): 
    ?>
    <div class="max-w-4xl mx-auto mt-12" data-aos="fade-up" data-aos-duration="600" data-aos-easing="ease-out" data-aos-delay="300">
        <div class="relative w-full" style="padding-bottom: 56.25%;">
            <iframe 
                class="absolute top-0 left-0 w-full h-full"
                src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>" 
                title="Case Study Video"
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen>
            </iframe>
        </div>
    </div>
    <?php endif; ?>

    <div class="mx-auto max-w-2xl lg:max-w-4xl pt-20 text-center"
    data-aos="fade-up"
    data-aos-duration="600"
    data-aos-easing="ease-out"
    data-aos-delay="300">

    <?php if (get_field('logo')) : ?>
        <div class="mx-auto h-36 w-36 flex items-center justify-center">
            <img src="<?php the_field('logo'); ?>"
                 alt="<?php the_field('client'); ?>"
                 class="max-h-full max-w-full object-contain" />
        </div>
    <?php endif; ?>

    <figure class="mt-10 md:mt-12">
        <blockquote class="text-lg md:text-xl lg:text-2xl font-semibold text-black leading-relaxed">
            <p><?php the_field('testimonials_content'); ?></p>
        </blockquote>
        <figcaption class="mt-6 flex flex-col items-center">
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-3 text-base md:text-lg">
                <span class="font-semibold text-black">
                    <?php the_field('testimonials_name'); ?>
                </span>
                <span class="hidden sm:inline-block text-gray-400">•</span>
                <span class="text-gray-500">
                    <?php the_field('testimonials_title'); ?>
                </span>
            </div>
        </figcaption>
    </figure>
</div>

</section>





<section class="pb-40 pt-20"
    style="background: linear-gradient(to bottom, #F7F7F5 0%, #F7F7F5 70%, #98C44180 85%, #00615580 100%);">

    <div class="max-w-3xl mx-auto px-8 lg:px-0 text-center" data-aos="fade-up" data-aos-duration="600"
        data-aos-easing="ease-out" data-aos-delay="400">
        <h2 class="text-3xl lg:text-5xl font-bold text-black mb-6">
            Ready to move from translation to transformation?
        </h2>
        <a href="/contact"
            class="inline-block bg-[#98C441] capitalize text-black px-6 py-3 font-bold text-base lg:text-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#98C441] focus:ring-offset-2 focus:ring-offset-[#1F311]">
            Connect with our team
        </a>
    </div>
</section>



<?php
get_footer();