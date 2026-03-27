<?php
/**
 * Template Name: Terms, Privacy
 * Description: 
 */
get_header();
?>

<section class="relative bg-[linear-gradient(to_bottom,_#1F3131_85%,_#006155_100%)]  w-full text-white overflow-hidden">
    <?php get_template_part('components/navigation/desktop'); ?>
    <?php get_template_part('components/navigation/mobile'); ?>

    <div class="w-full pt-[30%] lg:pt-[8%] px-4 sm:px-6 md:px-12 relative z-20 pb-40">
        <div class="text-center gap-y-8 max-w-4xl mx-auto">
            <h1 class="text-base sm:text-lg md:text-xl font-bold hidden">
                <?php the_title(); ?>
            </h1>

            <h2 class="text-3xl py-5 sm:text-4xl md:text-5xl max-w-4xl font-extrabold mb-6 leading-[98%]">
                <?php the_title(); ?>
            </h2>
        </div>
    </div>

    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/pattern-3.svg'); ?>"
         alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
         class="absolute bottom-[-20px] lg:bottom-[-150%] left-0 w-full z-10">
</section>



<section class="max-w-7xl mx-auto my-12 px-8 lg:px-0">
  <div class="prose lg:prose-xl">
    <?php the_content(); ?>
  </div>
</section>



<?php
get_template_part( 'components/common/cta' ); 
get_footer(); 
