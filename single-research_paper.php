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
<section
    class="relative w-full bg-[#1F3131]  text-white overflow-hidden bg-no-repeat bg-cover bg-bottom transition-opacity duration-300"
    data-bg-svg="http://piedmont-global.local/wp-content/uploads/Hero-1-Dark-1-e1767883098322.png">

    <!-- Background image element -->
    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/pattern-research.svg'); ?>" alt="Background"
        class="absolute inset-0 w-full h-full object-cover object-bottom opacity-20 pointer-events-none select-none"
        decoding="async" loading="lazy">

    <!-- Navigation -->
    <?php get_template_part('components/navigation/desktop'); ?>
    <?php get_template_part('components/navigation/mobile'); ?>

    <div class="relative z-20 mt-10 px-6 md:px-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mt-40 mb-24">

            <!-- Left Column: Content (2/3) -->
            <div class="lg:col-span-6 space-y-6 order-1">
                <span class="text-base font-light text-white">
                    <?php echo wp_kses_post(get_field('small_title')); ?>
                </span>
                <h1
                    class="leading-[40px] md:leading-[55px] lg:leading-[55px] font-semibold text-3xl md:text-4xl lg:text-5xl">
                    <?php echo wp_kses_post(get_field('big_title')); ?>
                </h1>
                <div class="text-lg leading-relaxed prose-invert max-w-prose font-normal">
                    <?php the_content(); ?>
                </div>


            </div>

            <!-- Right Column: Form (1/3) -->
            <div class="lg:col-span-6 order-2 py-10 lg:py-0">
                <div id="research-paper-form-wrapper-single" class="foundation-gradient text-[#1F3131] shadow-lg p-8 lg:p-16 relative">
                    <?php 
                    $white_paper = get_field('white_paper');
                    $paper_title = $white_paper ? $white_paper['title'] : 'White Paper';
                    ?>
                    <h3 class="text-2xl lg:text-4xl font-bold text-[#1F3131] mb-6">
                        Download White Paper
                    </h3>

                    <!-- Minimalistic Artistic Loading Overlay -->
                    <div class="loading-overlay hidden absolute inset-0 bg-gradient-to-br from-[#F9F8F6]/95 to-white/95 backdrop-blur-sm items-center justify-center z-50 rounded-lg transition-opacity duration-700">
                        <div class="text-center space-y-8">
                            <!-- Artistic Dot Animation -->
                            <div class="flex items-center justify-center space-x-3">
                                <div class="loading-dot w-3 h-3 rounded-full transition-all duration-1000 ease-out inactive"></div>
                                <div class="loading-dot w-3 h-3 rounded-full transition-all duration-1000 ease-out inactive"></div>
                                <div class="loading-dot w-3 h-3 rounded-full transition-all duration-1000 ease-out inactive"></div>
                            </div>

                            <!-- Status Text -->
                            <div class="space-y-2">
                                <p class="text-[#1F3131] font-light text-lg tracking-wide animate-fade-in">
                                    <span class="loading-text">Sending your white paper</span>
                                    <span class="success-text hidden text-[#98C441]">Successfully sent!</span>
                                </p>
                                <p class="text-[#006155] text-sm animate-fade-in">
                                    <span class="loading-subtext">Please wait while we process your request</span>
                                    <span class="success-subtext hidden">Check your email inbox</span>
                                </p>
                            </div>

                            <!-- Success State -->
                            <div class="success-checkmark hidden text-center">
                                <div class="inline-flex items-center justify-center w-12 h-12 bg-[#98C441] rounded-full mb-3 animate-bounce">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="text-[#1F3131] font-semibold">White paper delivered!</p>
                                <p class="text-[#006155] text-sm mt-1">Check your email inbox</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Persistent Success Message (shown after loader hides) -->
                    <div class="success-message hidden mb-4 p-4 bg-green-50 border border-green-200 rounded-lg transition-all duration-300" role="alert" aria-live="polite">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-green-800">Success! White paper sent</p>
                                <p class="text-sm text-green-700 mt-1">Check your email inbox for the download link.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Error Message -->
                    <div class="error-message hidden mb-4 p-4 bg-red-50 border border-red-200 rounded-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500" role="alert" aria-live="assertive" tabindex="-1">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-red-800">Submission Error</p>
                                <p class="text-sm text-red-700 mt-1 error-text">There was a problem submitting your request. Please try again or contact us if the issue persists.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Already Submitted Warning -->
                    <div class="already-submitted hidden mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg transition-all duration-300">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-blue-800">Already Submitted</p>
                                <p class="text-sm text-blue-700 mt-1">You've already submitted this form. Check your email for the white paper. You can submit again after 24 hours.</p>
                            </div>
                        </div>
                    </div>

                    <div id="research-paper-form-container">
                        <?php echo do_shortcode('[forminator_form id="1498"]'); ?>
                    </div>

                    <p class="text-sm text-start mt-6">
                        Piedmont Global is committed to protecting your privacy. We use the information you provide to
                        contact you about our services and to respond to your inquiry. To learn more, check out our <a
                            href="/privacy-policy" class="underline text-[#98C441]">Privacy Policy</a>.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


<?php
// Randomly alternate between two background SVGs
$bg_images = array(
    'BigStatement-Prosperity.svg',
    'agenda.svg'
);
$cookie_name = 'cta_bg_last';
$last_shown = isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : '';

if ($last_shown && in_array($last_shown, $bg_images)) {
    $current_bg = ($last_shown === $bg_images[0]) ? $bg_images[1] : $bg_images[0];
} else {
    $current_bg = $bg_images[array_rand($bg_images)];
}

setcookie($cookie_name, $current_bg, time() + 86400, '/');
$bg_url = get_template_directory_uri() . '/assets/icons/' . $current_bg;

// CTA data
$cta_title = "Unlock Your Global Potential";
$cta_description = "Discover how our solutions help organizations deliver multilingual care with clarity and confidence.";
$cta_first_button_text = "Explore full capabilities";
$cta_first_button_link = "/solutions/";
$cta_image = get_template_directory_uri() . '/assets/images/dummy-team.png';
$cta_second_title = "Download language access guide";
$cta_second_link = "/downloads/language-guide.pdf";
?>

<div class="relative w-full bg-[#1F3131] shadow-sm">
    <div class="max-w-7xl mx-auto">

        <!-- Background section -->
        <div class="relative rounded-2xl bg-no-repeat bg-cover p-10 lg:p-16"
            style="background-image: url('<?php echo esc_url($bg_url); ?>'); background-color: #006155;">

            <!-- Grid (content only) -->
            <div class="grid grid-cols-1 lg:grid-cols-8 gap-2 items-center relative z-10">

                <!-- Left: Text -->
                <div class="lg:col-span-4 text-left">
                    <a href="<?php echo esc_url($cta_first_button_link); ?>"
                        class="inline-flex items-center text-white text-sm lg:text-base font-medium mb-4 lg:mb-6 bg-[#FFFFFF4D] px-3 py-1.5 lg:px-4 lg:py-2 rounded">
                        <span><?php echo esc_html($cta_first_button_text); ?></span>
                        <span class="ml-2" aria-hidden="true">→</span>
                    </a>

                    <h2
                        class="text-2xl md:text-3xl lg:text-5xl font-bold leading-[28px] md:leading-[35px] lg:leading-[48px] text-white max-w-md mb-4 lg:mb-6">
                        <?php echo esc_html($cta_title); ?>
                    </h2>

                    <p class="text-sm md:text-base lg:text-lg text-white max-w-xl">
                        <?php echo esc_html($cta_description); ?>
                    </p>
                </div>

                <!-- Right: Image -->
                <div class="lg:col-span-4 flex justify-center">
                    <img src="https://piedmontglobal.com/wp-content/uploads/Desktop.png"
                        alt="Piedmont Global team working with Consumer goods clients"
                        class="w-full h-full object-contain">
                </div>
            </div>

            <div class="">
                <div class="flex flex-col md:flex-row gap-4 lg:gap-6">
                    <a href="/contact"
                        class="js-open-sandbox-modal inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] px-4 py-2 lg:px-5 lg:py-3 font-bold text-sm lg:text-lg shadow-md hover:bg-[#8AB738] transition-colors">
                        Schedule a consultation
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>
                    </a>

                    <a href="<?php echo esc_url($cta_second_link); ?>"
                        class="group inline-flex items-center text-[#F9F8F6] font-bold text-sm lg:text-lg hover:text-[#F9F8F6]/80 transition-colors">
                        <?php echo esc_html($cta_second_title); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- CTA buttons (outside grid, below background) -->


    </div>

    <?php get_footer(); ?>
</div>