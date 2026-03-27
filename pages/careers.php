<?php
/**
 * Template Name: Careers
 * Description: 
 */
get_header();
get_template_part( 'components/banner/single-common' );
?>
<section class="px-6 lg:px-0 py-20">
  <div class="max-w-7xl mx-auto my-10">
    <?php the_content(); ?>
  </div>
</section>

<?php
get_template_part( 'components/common/cta' ); 
get_footer(); 
?>                          