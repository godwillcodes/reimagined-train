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


<header class="shadow-sm bg-[#1F3131]" role="banner">
    <div class="bg-[#1F3131] pt-8 pb-12">
        <nav aria-label="Primary desktop navigation">
            <?php get_template_part('components/navigation/desktop'); ?>
        </nav>
        <nav aria-label="Primary mobile navigation">
            <?php get_template_part('components/navigation/mobile'); ?>
        </nav>
    </div>

    <div class="relative h-[300px] md:h-[300px] lg:h-[450px] bg-cover bg-no-repeat bg-right-bottom"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/single-industries.svg'); ?>');">

        <!-- gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#1F3131]/90 via-[#1F3131]/70 to-transparent"
            aria-hidden="true"></div>
        <!-- top fade overlay to soften the image edge -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#1F3131] via-[#1F3131]/60 to-transparent"
            aria-hidden="true"></div>

        <!-- Content container -->
        <div class="relative z-10 h-full flex items-center">
            <div class="max-w-7xl mx-auto w-full px-6 lg:px-0 pb-4 md:pb-12 lg:pb-12 text-white">
                
                <h1 class="text-4xl lg:text-5xl font-bold mb-10" data-aos="fade-up" data-aos-duration="300" data-aos-delay="50">
                <?php the_title(); ?>
                </h1>

                <div class="text-[#F9F8F6] text-lg font-light max-w-2xl mb-8">
                    <?php the_content(); ?>
                </div>
                
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
<section>
<div class="relative bg-[#F9F8F6] py-20 overflow-hidden">
        <div class="max-w-7xl  mx-auto px-6 lg:px-0 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 items-stretch">

                <!-- Left Column: Form -->
                <div id="download-form" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/single-industries.svg'); ?>');"
                    class="col-span-1  shadow-2xl  p-10 flex flex-col justify-center relative overflow-hidden group">
                    <h3 class="text-3xl font-bold text-white mb-4 max-w-sm">Get your free  <?php the_title(); ?> eBook now</h3>
                    <!-- <p class="text-white mb-2 text-lg">sent on email instantly</p> -->
                    <p class="text-white mb-2 text-lg">Provide your email and receive the eBook instantly delivered to your inbox.</p>

                    <?php echo do_shortcode('[forminator_form id="533"]'); ?>
                </div>

                <!-- Right Column: PNG Image with Hover Actions -->
                <div style="background: linear-gradient(to bottom, #F7F7F5 0%, #F7F7F5 70%, #98C44180 85%, #00615580 100%);" class="col-span-1 relative group  rounded-0 shadow-sm flex items-center justify-center overflow-hidden">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"
                        class="w-full h-full max-h-[800px] object-contain drop-shadow-2xl transform transition duration-700 ease-in-out group-hover:scale-105 group-hover:rotate-1 group-hover:drop-shadow-[0_35px_35px_rgba(0,0,0,0.25)]">
                </div>

            </div>
        </div>
    </div>
</section>



<section class="pb-20 pt-10 " style="background: linear-gradient(to bottom, #F7F7F5 0%, #F7F7F5 70%, #98C44180 85%, #00615580 100%);">
    <div class="max-w-xl mx-auto px-8 lg:px-0 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold text-black mb-6">
            Get your free <?php the_title(); ?> eBook now
        </h2>
        <div class="text-lg text-gray-700 mb-8 prose"><?php the_content(); ?></div>
        <a href="#download-form"
            class="inline-block bg-[#98C441] text-black px-6 py-3 font-bold text-base lg:text-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#98C441] focus:ring-offset-2 focus:ring-offset-[#1F311]">
           Download  <?php the_title(); ?> eBook
        </a>
    </div>
</section>



<style>
 .forminator-label {
    color: #fff;
    font-size: 16px !important;
    font-weight: 700;
}
 .forminator-input {
    background-color: #fff;
    color: #000;
    font-size: 16px;
    border: 1px solid #fff;
    border-radius: 5px;
}

.forminator-design--default .forminator-button-submit {
    background-color: #98C441 !important;
    color: #1F3131 !important;
    font-size: 16px !important;
    font-weight: 700;
}
 .forminator-submit:hover {
    background-color: #7BA035;
}

html{
    scroll-behavior: smooth;
}
</style>


<?php
get_footer();