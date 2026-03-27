<?php
/**
 * Template Name: Linguists
 * Description: Page template showcasing language professionals.
 */

get_header();
?>

<header class="shadow-sm bg-[#1F3131]" role="banner">
    <div class="bg-[#1F3131] pt-8 pb-12">
        <!-- Primary Navigation -->
        <nav aria-label="Primary desktop navigation">
            <?php get_template_part('components/navigation/desktop'); ?>
        </nav>
        <nav aria-label="Primary mobile navigation">
            <?php get_template_part('components/navigation/mobile'); ?>
        </nav>
    </div>

    <!-- Hero Section -->
    <div class="relative h-[500px] md:h-[400px] lg:h-[554px] bg-cover bg-no-repeat bg-right-bottom"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/single-industries.svg'); ?>');">

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#1F3131]/90 via-[#1F3131]/70 to-transparent" aria-hidden="true"></div>

        <!-- Hero Content -->
        <div class="relative z-10 h-full flex items-center">
            <div class="max-w-7xl mx-auto w-full px-6 lg:px-0 pb-4 md:pb-12 lg:pb-12 text-white">
                <h1 class="text-2xl mt-4 md:text-4xl lg:text-5xl font-bold"
                    data-aos="fade-up" data-aos-duration="400" data-aos-delay="50">
                    <?php the_title(); ?>
                </h1>
                <p class="text-base lg:text-lg my-4 max-w-4xl"
                    data-aos="fade-up" data-aos-duration="400" data-aos-delay="100">
                    Join Our Network of Expert Language Professionals.
                </p>
                <a target="_blank" href="https://piedmontglobal.zohorecruit.com/jobs/Careers"
                   class="inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] px-4 py-2 mt-4 font-bold text-base shadow-md hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-[#1F3131] transition-colors duration-200"
                   aria-label="Schedule a consultation - opens contact form">
                    <span>Browse open roles</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         class="w-6 h-6" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>


<section class="bg-[#F9F8F6] py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="grid grid-cols-1 gap-8 mt-0 lg:-mt-56 relative z-10">

            <?php if (have_rows('linguists')): ?>
                <?php while (have_rows('linguists')): the_row(); 
                    $name      = get_sub_field('name');
                    $title     = get_sub_field('title');
                    $bio       = get_sub_field('bio');
                    $video_url = get_sub_field('video_url');
                ?>
                    <!-- Single Linguist Card -->
                    <article class="group flex flex-col md:flex-row shadow-lg border bg-white border-[#ab9dba] rounded overflow-hidden transition duration-300 hover:shadow-xl hover:-translate-y-1"
                             data-aos="fade-up" data-aos-duration="300">

                        <!-- Video Section -->
                        <div class="md:w-1/2 w-full bg-[#ab9dba] p-4 flex items-center">
                            <div class="relative w-full min-h-[250px]">
                                <?php if ($video_url): ?>
                                    <iframe 
                                        src="https://www.youtube.com/embed/<?php echo esc_html($video_url); ?>"
                                        title="<?php echo esc_attr($name . ' - ' . $title); ?>"
                                        class="w-full h-full md:h-[350px] rounded-lg"
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="md:w-1/2 w-full p-6 md:p-8 flex flex-col justify-center">
                            <header>
                                <p class="text-sm text-[#d16555] font-semibold mb-2 uppercase tracking-wide">
                                    <?php echo esc_html($title); ?>
                                </p>
                                <h3 class="text-3xl font-bold text-[#1F3131] mb-4 leading-tight">
                                    <?php echo esc_html($name); ?>
                                </h3>
                            </header>
                            <?php if ($bio): ?>
                                <div class="text-[#1F3131] prose">
                                    <?php echo wp_kses_post($bio); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php endif; ?>

        </div>
    </div>
</section>


<?php
get_template_part('components/common/cta');
get_footer();
