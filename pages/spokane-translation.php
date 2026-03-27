<?php
/**
 * Template Name: Spokane Translation
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

    <div class="relative h-[200px] md:h-[200px] lg:h-[444px] bg-cover bg-no-repeat bg-right-bottom"
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

                 <h1 class="text-4xl lg:text-5xl max-w-4xl font-bold mb-10" 
                     data-aos="fade-up" 
                     data-aos-duration="400" 
                     data-aos-easing="ease-out">
                     <?php the_title(); ?>
                 </h1>

                 <div class="text-base lg:text-lg max-w-4xl my-5 prose-invert"
                      data-aos="fade-up" 
                      data-aos-duration="400" 
                      data-aos-easing="ease-out" 
                      data-aos-delay="100">
                     <?php the_content(); ?>
                 </div>

                 <a href="/contact"
                     class="inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] px-4 py-2 mt-4 font-bold text-base shadow-md rounded-0 hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-[#1F3131] transition-colors duration-200"
                     aria-label="Schedule a consultation - opens contact form"
                     data-aos="fade-up" 
                     data-aos-duration="400" 
                     data-aos-easing="ease-out" 
                     data-aos-delay="200">
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

<section class="bg-[#F9F8F6]">
    <div class="max-w-7xl mx-auto py-20 px-6 lg:px-0">

        <!-- Top Image -->
        <div class="flex justify-center mb-12" data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out">
            <?php if( $image = get_field('spokane_icon') ): ?>
            <img src="<?php echo esc_url($image); ?>" alt="Spokane International Translation"
                class="h-16 w-auto" />
            <?php endif; ?>

        </div>

        <!-- Cards Grid -->
        <div class="grid gap-8 md:grid-cols-3">
            <?php if( have_rows('contact_cards') ): ?>
            <?php 
            $card_index = 0;
            while( have_rows('contact_cards') ): the_row(); 
            $icon = get_sub_field('icon'); 
            $title = get_sub_field('title'); 
            $content = get_sub_field('content'); 
        ?>
            <div
                class="text-black border border-[#E7E5E0] bg-white shadow-lg p-10 flex flex-col items-start space-y-6 hover:shadow-xl transition"
                data-aos="fade-up" 
                data-aos-duration="400" 
                data-aos-easing="ease-out" 
                data-aos-delay="<?php echo $card_index * 100; ?>">

                <?php if($icon): ?>
                <div class="p-4 rounded-xl bg-[#F9F8F6]">
                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($title); ?>"
                        class="h-12 w-12">
                </div>
                <?php endif; ?>

            

                <?php if($content): ?>
                <div class="text-base leading-relaxed prose">
                    <?php echo wp_kses_post($content); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php 
            $card_index++;
            endwhile; ?>
            <?php endif; ?>
        </div>

    </div>
</section>


<?php
get_template_part( 'components/common/cta' ); 
get_footer(); 
?>