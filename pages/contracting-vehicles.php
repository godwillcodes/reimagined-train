<?php
/**
 * Template Name: Contracting Vehicles
 * Description: 
 */
get_header();
?>
<header class="relative w-full text-white overflow-hidden bg-[linear-gradient(to_bottom,_#1F3131_50%,_#006155_100%)]">
    <?php get_template_part('components/navigation/desktop'); ?>
    <?php get_template_part('components/navigation/mobile'); ?>

    <div class="w-full pt-[30%] lg:pt-[12%] px-6 lg:px-0 relative z-20 pb-10 lg:pb-40">
        <div class="text-start gap-y-8 max-w-7xl mx-auto">

           <h1 class="text-lg text-gray-200 max-w-4xl font-extrabold mb-1 leading-[98%]">
                <?php the_title(); ?>
            </h1>
            
            <div class="text-gray-100 text-xl mb-12 max-w-3xl">
                <?php the_content(); ?>
            </div>

        </div>
    </div>
</header>

<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-0 lg:-mt-56 relative z-10 contracting-vehicles-grid">
            <?php 
      if (have_rows('contracting_vehicles_repeater')):
        $counter = 0; // Counter for staggered delays
        while (have_rows('contracting_vehicles_repeater')): the_row(); 
          $delay = $counter * 100; // 100ms delay between each card
          $title = get_sub_field('title');
          $description = get_sub_field('description');
          $image = get_sub_field('image');
          $link = get_sub_field('link');
        ?>
            <a href="<?php echo esc_url($link); ?>"
                class="group block shadow-md rounded border bg-white border-[#ffffff]/40 rounded-t-[4px] transition-transform duration-300 hover:shadow-lg"
                data-aos="fade-up" 
                data-aos-duration="400" 
                data-aos-delay="<?php echo $delay; ?>"
                data-aos-easing="ease-out">
                <div class="overflow-hidden rounded-t-[4px]">
                    <?php if ($image): ?>
                    <img src="<?php echo esc_url($image); ?>"
                        class="w-full h-60 object-contain object-center transition-transform duration-500 group-hover:scale-105"
                        alt="<?php echo esc_attr($title); ?>">
                    <?php endif; ?>
                </div>
                <div class="p-8 bg-white">
                    <h3 class="text-2xl font-semibold text-[#1F3131] mb-2"><?php echo esc_html($title); ?></h3>
                    <div class="text-gray-500 text-base mb-2"><?php echo esc_html($description); ?></div>
                    <div class="h-6 md:h-10"></div>
                    <span class="inline-flex items-center text-base font-medium border-b-2 border-[#D16555]">
                        Learn More <span class="ml-1 text-lg">→</span>
                    </span>
                </div>
            </a>
            <?php 
          $counter++; // Increment counter for next iteration
        endwhile; 
      endif;
      ?>
        </div>
        
    </div>
</section>

<!-- Contracting Vehicles Carousel -->
<?php if (have_rows('contracting_vehicles', 'option')): ?>
<section class="bg-white pb-16 md:pb-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="text-start mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-[#1F3131] mb-4">Our Contracting Vehicles</h2>
            <p class="text-gray-600 text-lg max-w-2xl">Streamlined procurement through trusted government contract vehicles</p>
        </div>
        
        <div class="owl-carousel owl-theme contracting-vehicles-carousel">
            <?php while (have_rows('contracting_vehicles', 'option')): the_row(); ?>
            <div class="item">
                <?php if (get_sub_field('url')) : ?>
                <a href="<?php the_sub_field('url'); ?>" target="_blank" rel="noopener"
                    class="group relative flex items-center justify-center h-32 w-32 sm:h-36 sm:w-36 md:h-40 md:w-40 rounded-full mx-auto transition-transform duration-300 hover:scale-105">
                <?php else: ?>
                <div class="group relative flex items-center justify-center h-32 w-32 sm:h-36 sm:w-36 md:h-40 md:w-40 rounded-full mx-auto">
                <?php endif; ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/circle.svg"
                        alt="" width="160" height="160" loading="lazy" decoding="async"
                        class="absolute inset-0 h-full w-full object-cover" />
                    <img src="<?php the_sub_field('logo'); ?>" alt="Contracting Vehicle Logo"
                        width="96" height="96" loading="lazy" decoding="async"
                        class="relative max-h-20 max-w-20 sm:max-h-24 sm:max-w-24 md:max-h-28 md:max-w-28 object-contain transition duration-300 ease-in-out grayscale group-hover:grayscale-0" />
                <?php if (get_sub_field('url')) : ?>
                </a>
                <?php else: ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>





<?php
get_template_part( 'components/common/cta' ); 
get_footer(); 
?>