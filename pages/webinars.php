<?php
/**
 * Template Name: Webinars
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

                <h1 class="text-2xl mt-4 md:text-4xl lg:text-5xl font-bold" data-aos="fade-up" data-aos-duration="400"
                    data-aos-delay="50">
                    <?php the_title(); ?>
                </h1>
                <p class="text-base lg:text-lg my-4 max-w-4xl" data-aos="fade-up" data-aos-duration="400"
                    data-aos-delay="100">
                    Conversations that explore language, culture, and the people driving global communication.
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


<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = [
  'post_type'      => 'webinar',
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
  'posts_per_page' => -1,
  'paged'          => $paged
];

$query = new WP_Query($args);
?>

<section class="bg-[#F9F8F6] py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-12 mt-0 lg:-mt-56 relative z-10">
            <?php 
      $counter = 0; // Counter for staggered delays
      while ($query->have_posts()) : $query->the_post(); 
        $delay = $counter * 100; // 100ms delay between each card
      ?>
            <a href="<?php the_permalink(); ?>"
                class="group flex flex-col md:flex-row shadow-md border bg-white border-[#ab9dba] rounded-[4px] overflow-hidden transition duration-300 hover:shadow-xl hover:-translate-y-1">

                <!-- Image -->
                <div class="md:w-1/2 w-full h-auto md:h-auto overflow-hidden p-6 bg-[#ab9dba]">
                    <img src="<?php the_post_thumbnail_url(); ?>"
                        class="w-full h-full object-cover object-center transition-transform duration-500"
                        alt="<?php the_title(); ?>">
                </div>

                <!-- Content -->
                <div class="md:w-1/2 w-full p-6 md:p-10 flex flex-col justify-between bg-white">
                    <div>
                        <div class="text-base text-gray-500 mb-3"><?php echo get_the_date(); ?></div>
                        <h3 class="text-2xl font-semibold text-[#1F3131] mb-4 leading-snug">
                            <?php the_title(); ?>
                        </h3>
                        <p class="text-gray-200 text-base md:text-lg leading-relaxed mb-6">
                            <?php the_excerpt(); ?>
                        </p>
                    </div>

                    <span
                        class="inline-flex items-center mt-5 text-base font-medium text-[#D16555] group-hover:text-[#B74C3D] transition-colors duration-300">
                        Read More <span class="ml-2 text-lg">→</span>
                    </span>
                </div>
            </a>


            <?php 
        $counter++; // Increment counter for next iteration
        endwhile; 
      ?>
        </div>

    </div>
</section>


<?php
get_template_part( 'components/common/cta' );
get_footer(); 