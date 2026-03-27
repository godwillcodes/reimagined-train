<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package PiedmontGlobal
 */

get_header();
?>

<main id="maincontent">
    <!-- 404 Hero Section -->
    <section class="relative w-full text-white overflow-hidden bg-no-repeat bg-cover bg-bottom min-h-[90vh] flex items-center"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/primary-bg.svg'); ?>');">

        <!-- Navigation -->
    <?php get_template_part('components/navigation/desktop'); ?>
    <?php get_template_part('components/navigation/mobile'); ?>

        
        <div class="w-full px-6 md:px-12 relative z-20">
            <div class="max-w-5xl mx-auto text-center">
                <!-- 404 Number with Animation -->
                <div class="text-4xl md:text-6xl font-extrabold text-[#98C441] mb-8 drop-shadow-lg" 
                     data-aos="fade-up" data-aos-duration="500" data-aos-delay="100">
                    404
                </div>
                
                <!-- Main Heading -->
                <h1 class="text-2xl md:text-4xl lg:text-4xl font-bold mb-8 leading-tight"
                    data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">
                    Oops! Page Not Found
                </h1>
                
                <!-- Description -->
                <p class="text-base md:text-xl mb-12 max-w-2xl mx-auto leading-relaxed opacity-90"
                   data-aos="fade-up" data-aos-duration="500" data-aos-delay="300">
                   The page you are looking for could not be found. It may have been moved, renamed, or is no longer available.
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6"
                     data-aos="fade-up" data-aos-duration="500" data-aos-delay="400">
                    <a href="<?php echo esc_url(home_url('/')); ?>" 
                       class="group bg-[#98C441] hover:bg-[#8AB738] text-[#1F3131] px-10 py-2 font-semibold text-lg shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#98C441] focus:ring-offset-2 focus:ring-offset-white transform hover:scale-105">
                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Go Home
                        </span>
                    </a>
                   
                </div>
            </div>
        </div>
    </section>

    

   
</main>

<?php
get_footer();
