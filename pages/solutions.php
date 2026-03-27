<?php
/**
 * Template Name: Solutions
 * Description: Solutions page template for Piedmont Global.
 */
get_header();
?> 

<section class="relative w-full overflow-hidden text-white bg-[linear-gradient(to_bottom,_#1F3131_85%,_#006155_100%)]">
    <?php get_template_part('components/navigation/desktop'); ?>
    <?php get_template_part('components/navigation/mobile'); ?>

    <div class="relative z-20 flex min-h-[85vh] items-center justify-center px-4 sm:px-6 md:px-12">
        <div class="mx-auto w-full max-w-6xl text-center">
            <h2 class="mx-auto max-w-5xl text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight">
                <?php echo wp_kses_post ( get_field('section_title') ); ?>
            </h2>

            <h3 class="mx-auto mt-6 max-w-6xl text-2xl sm:text-3xl font-extrabold leading-snug">
                <?php echo wp_kses_post ( get_field('primary_description') ); ?>
            </h3>

            <p class="mx-auto mt-6 max-w-4xl prose-invert text-lg leading-relaxed">
                <?php echo wp_kses_post(get_field('supporting_description')); ?>
            </p>

            <div class="mt-10 flex justify-center">
                <a href="#solutions"
                   class="inline-flex items-center gap-2 bg-[#98C441] px-6 py-3 text-lg font-bold text-[#1F3131] shadow-md transition-colors duration-200 hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-[#98C441] focus:ring-offset-2 focus:ring-offset-[#1F3131]"
                   role="button">
                    Explore solutions
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/pattern-3.svg'); ?>"
         alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
         class="pointer-events-none absolute bottom-[-20px] left-0 z-10 w-full lg:bottom-[-60%]">
</section>


<div class="bg-[#F9F8F6] text-center px-6 sm:px-8 lg:px-0 py-12 sm:py-16 mx-auto">
    <h3 class="font-bold text-base sm:text-lg">Why partner with Piedmont Global?</h3>
    <h4 class="font-black text-2xl sm:text-3xl lg:text-4xl my-4 sm:my-6 leading-snug">
        We don’t just fill gaps. <br class="hidden sm:block"> We build what others overlook.
    </h4>
    <p class="max-w-5xl mx-auto text-base sm:text-lg leading-relaxed">
Piedmont Global brings together over-the-phone (OPI) and video remote interpreting (VRI), on-site ASL/sign language interpreting, translation, localization, multilingual media production, technology, data, staffing, and consulting into one strategic operating model. The result: fewer vendors, stronger compliance, higher quality, and faster execution across complex, cross-cultural environments. This is Strategic Globalization, whether local or cross-border.    </p>
</div>

<section class="bg-[#F7F7F5] py-12 sm:py-16 px-6 sm:px-8 lg:px-0">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full mb-8 sm:mb-10 gap-4 sm:gap-6">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 max-w-2xl" data-aos="fade-right">
               Solutions
            </h2>
        </div>

        <div id="solutions" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10 lg:gap-12 max-w-7xl mx-auto">
        <?php
            // Get terms in 'solution' taxonomy
            $terms = get_terms([
                'taxonomy'   => 'solution', // adjust taxonomy slug accordingly
                'hide_empty' => false,
            ]);

            if (!is_wp_error($terms) && !empty($terms)) :
                $delay = 0;
                foreach ($terms as $term) :
                    // Get ACF fields for the term
                    $tagline = get_field('solution_tagline', $term->taxonomy . '_' . $term->term_id);
                    $image = get_field('featured_image', $term->taxonomy . '_' . $term->term_id);

                    // Fallback image URL if no image set
                    $image_url = $image && is_array($image) && isset($image['url'])
                        ? $image['url']
                        : '/wp-content/uploads/Rectangle-21027.png';

                    // Term archive link
                    $term_link = get_term_link($term);
                    if (is_wp_error($term_link)) {
                        continue; // skip if error getting link
                    }
                    ?>
                    <!-- Individual Solution Taxonomy Card -->
                    <a href="<?php echo esc_url($term_link); ?>"
                        class="group relative bg-white  border border-gray-200 shadow-sm overflow-hidden flex flex-col transform transition-all duration-500 hover:-translate-y-1 hover:shadow-sm"
                        data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>" data-aos-duration="600"
                        aria-label="Learn more about <?php echo esc_attr($term->name); ?>">

                        <!-- Card Image -->
                        <div class="overflow-hidden">
                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($term->name); ?>"
                                class="w-full h-60 object-cover transition-transform duration-700 ease-out group-hover:scale-105" />
                        </div>

                        <!-- Card Content -->
                        <div class="p-6 flex flex-col flex-1">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-2"><?php echo esc_html($term->name); ?></h3>
                            <div class="text-gray-700 mb-6 text-lg flex-1">
                                <?php echo wp_kses_post($tagline); ?>
                            </div>
                            <div class="h-6 md:h-20"></div>

                            <!-- Learn More Indicator -->
                            <div
                                class="flex items-center mt-auto text-sm font-semibold text-gray-900 transition-colors duration-300 group-hover:text-[#D16555]">
                                Learn more
                                <span class="ml-2 text-lg transition-transform duration-300 group-hover:translate-x-1">→</span>
                            </div>
                            <div class="h-0.5 w-8 mt-1 bg-[#D16555] transition-all duration-300 group-hover:w-24"></div>
                        </div>
                    </a>

                    <?php
                    $delay += 100;
                endforeach;
            else :
                ?>
                <p class="text-center text-lg text-gray-900">No solutions found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>



<?php
get_template_part( 'components/common/cta' ); 
get_footer(); 
?>