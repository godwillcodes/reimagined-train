<?php
/**
 * Template Name: SMS Opt-In
 * Description: 
 */
get_header();
?>

<main id="maincontent">
<section class="shadow-sm">
    <div class="bg-[#1F3131] pt-8 pb-12">
        <?php
        get_template_part('components/navigation/desktop');
        get_template_part('components/navigation/mobile');
        ?>
    </div>

 <div class="h-[300px] md:h-[300px] lg:h-[344px] bg-cover bg-center relative"
        style="background-image: linear-gradient(180deg, rgba(31,49,49,0.5) 0%, #1F3131 80%), url('<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>');">
        <div class="absolute inset-0 flex items-end">
            <div class="max-w-7xl mx-auto w-full px-10 lg:px-0 pb-4 md:pb-12 lg:pb-12 text-white">
                <h1 class="text-2xl md:text-4xl lg:text-4xl font-bold" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                    <?php the_title(); ?>
                </h1>

                <?php if (get_field('page_subheadline')): ?>
    <p class="text-base lg:text-lg my-4 max-w-4xl" 
       data-aos="fade-up" data-aos-delay="400" data-aos-duration="600">
        <?php the_field('page_subheadline'); ?>
    </p>
<?php endif; ?>

               
            </div>
        </div>
    </div>
</section>
<section class="bg-[#F7F7F5] py-16 px-6 md:px-0">
  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
    
    <!-- Copy Section (fixed on scroll for desktop) -->
    <div class="prose text-gray-800 max-w-xl md:sticky md:top-24 self-start">
      <?php the_content(); ?>
    </div>

    <!-- Form Section -->
    <div class="bg-[#006155] rounded-xl shadow-lg p-6 sm:p-8 text-white w-full">
      <h2 class="text-2xl font-bold mb-6">SMS Opt-In Form</h2>
            <div class="text-lg sms-form">
                <?php echo do_shortcode('[forminator_form id="211"]'); ?>
            </div>
    </div>
  </div>
</section>
</main>

<?php
get_template_part( 'components/common/cta' ); 
get_footer(); 