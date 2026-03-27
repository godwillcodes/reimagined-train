<?php
/**
 * Template Name: Industries
 * Description: Industries page template for Piedmont Global.
 */
get_header();
get_template_part( 'components/banner/secondary' );
?>
<section
  class="px-8 lg:px-0 py-12 sm:py-16"
  style="background: 
    linear-gradient(0deg, rgba(249, 248, 246, 0.95), rgba(249, 248, 246, 0.95)),
    linear-gradient(180deg, rgba(152, 196, 65, 0) 64.73%, rgba(152, 196, 65, 0.5) 112.2%, rgba(0, 97, 85, 0.5) 140.25%);
">    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full mb-20 gap-6">
                <h2 class="text-3xl md:text-4xl font-bold text-[#1F3131] max-w-lg" data-aos="fade-right">
                    Industries we serve
</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                <?php
            // Create a new query for the 'industry' post type
            $industries_query = new WP_Query([
                'post_type'      => 'industry',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
                'orderby'        => 'title',
                'order'          => 'ASC'
            ]);
            $i = 0; // Initialize a counter for the AOS delay

            if ($industries_query->have_posts()) :
                while ($industries_query->have_posts()) : $industries_query->the_post();
                    // Get custom fields for each post
                    $icon = get_field('industry_icon');
                    $tagline = get_field('industry_tagline');
            ?>
                <a href="<?php the_permalink(); ?>" class="group block">
    <div class="bg-[#F9F8F6] text-[#1F3131] rounded-[4px] border border-gray-300 p-8 flex flex-col justify-between
                transition-all duration-500 ease-out
                group-hover:-translate-y-1 group-hover:shadow-lg group-hover:shadow-gray-200/70 group-hover:scale-[1.01]"
        data-aos="fade-up" data-aos-delay="<?= $i * 50 ?>">
        
        <?php if ($icon) : ?>
            <img src="<?php echo wp_kses_post($icon); ?>" class="mb-6 h-10 w-10 transition-transform duration-500 group-hover:scale-110" alt="">
        <?php endif; ?>
        
        <h3 class="text-xl text-[#1F3131] font-semibold mb-4">
            <?php the_title(); ?>
        </h3>
        
        <?php if ($tagline) : ?>
            <p class="text-[#1F3131] mb-3 mt-2 font-normal text-lg">
                <?php echo wp_kses_post($tagline); ?>
            </p>
        <?php endif; ?>
    </div>
</a>

                <?php
                    $i++; // Increment the counter
                endwhile;
                wp_reset_postdata(); // Restore the original post data
            endif;
            ?>
            </div>
        </div>
    </div>

</section>



<?php
get_template_part( 'components/common/cta' ); 
get_footer(); 
?>