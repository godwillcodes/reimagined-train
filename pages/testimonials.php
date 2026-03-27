<?php
/**
 * Template Name: Testimonials
 * Description:
 */
get_header();
?>



<header class="shadow-sm bg-[#1F3131]" role="banner">
    <div class="bg-[#1F3131] pt-16 pb-16">
        <nav aria-label="Primary desktop navigation">
            <?php get_template_part('components/navigation/desktop'); ?>
        </nav>
        <nav aria-label="Primary mobile navigation">
            <?php get_template_part('components/navigation/mobile'); ?>
        </nav>
    </div>

    <div class="relative h-[200px] md:h-[200px] lg:h-[404px] bg-cover bg-no-repeat bg-right-bottom"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/single-industries.svg'); ?>');">

        <!-- gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#1F3131]/90 via-[#1F3131]/70 to-transparent"
            aria-hidden="true"></div>
        <!-- top fade overlay to soften the image edge -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#1F3131] via-[#1F3131]/60 to-transparent"
            aria-hidden="true"></div>

        <!-- Content container -->
        <div class="relative z-10 h-full flex items-center pt-10 pb-40">
            <div class="max-w-7xl mx-auto w-full px-6 lg:px-0 pb-4 md:pb-12 lg:pb-12 text-white">
                
                <h1 class="text-4xl lg:text-5xl font-bold mb-10" data-aos="fade-up" data-aos-duration="300" data-aos-delay="50">
                <?php the_title(); ?>
                </h1>
                
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
$testimonials = [];
if (have_rows('testimonials', 'option')):
  while (have_rows('testimonials', 'option')): the_row();
    $testimonials[] = [
      'description' => get_sub_field('description'),
      'title'       => get_sub_field('title'),
      'location'    => get_sub_field('location'),
    ];
  endwhile;
endif;
?>

<!-- Testimonials -->
<section class="relative bg-[#F9F8F6] py-20 px-6 lg:px-0">
    <div class="max-w-7xl mx-auto">

        <?php if (!empty($testimonials)): ?>
        <div class="testimonial-carousel owl-carousel mt-0 lg:-mt-40" role="list" aria-label="Testimonials">
            <?php $i=0; foreach ($testimonials as $testimonial): $i++; ?>
            <div class="bg-white border border-[#DFDAD4] p-8 shadow-md flex flex-col h-full text-left">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/quote.svg" alt="Quote icon"
                    class="h-8 w-8 mb-6 self-start">

                <div class="text-base text-gray-800 font-normal leading-relaxed flex-grow">
                    <p class="italic">"<?php echo esc_html($testimonial['description']); ?>"</p>
                </div>

                <div class="mt-auto pt-6">
                    <p class="font-semibold text-gray-900"><?php echo esc_html($testimonial['title']); ?></p>
                    <?php if (!empty($testimonial['location'])) : ?>
                    <p class="text-sm text-gray-600"><?php echo esc_html($testimonial['location']); ?></p>
                    <?php endif; ?>
                </div>
            </div>


            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- Partners -->
<section class="bg-[#F9F8F6] pb-16 px-6 lg:px-0">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full mb-20 gap-6">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 max-w-lg" data-aos="fade-up">
                The trusted partner for local and global growth
            </h2>
        </div>

        <?php if (have_rows('partners_repeater', 'option')): ?>
        <ul class="owl-carousel owl-theme mb-16 partners-carousel" role="list" aria-roledescription="carousel"
            aria-label="Partners">
            <?php $j=0; while (have_rows('partners_repeater', 'option')): the_row(); $j++; ?>
            <li role="listitem" data-aos="fade-up" data-aos-delay="<?php echo $j * 100; ?>" data-aos-duration="500">
                <a href="<?php the_sub_field('url'); ?>" target="_blank" rel="noopener">
                    <img src="<?php the_sub_field('partner_logo'); ?>"
                        alt="<?php the_sub_field('partner_name') ?: 'Partner Logo'; ?>"
                        class="h-24 w-auto mx-auto object-contain transition duration-300 ease-in-out grayscale hover:grayscale-0" />
                </a>
            </li>
            <?php endwhile; ?>
        </ul>
        <?php endif; ?>

    </div>
</section>

<!-- Recognition -->
<section class="bg-[#F9F8F6] pb-16 px-6 lg:px-0">
    <div class="max-w-7xl mx-auto">
        <div class=" rounded-lg border border-[#DFDAD4] p-8 md:p-12 shadow-md" data-aos="fade-up"
            data-aos-duration="400" data-aos-easing="ease-out">
            <h3 class="text-xl md:text-2xl text-[#1F3131] font-semibold mb-8">
                We've been recognized
            </h3>
            <?php if (have_rows('recognized_by', 'option')): ?>
              <div class="owl-carousel owl-theme recognized-carousel">
    <?php while (have_rows('recognized_by', 'option')): the_row(); ?>
        <div class="item">
            <?php if (get_sub_field('url')) : ?>
                <a href="<?php the_sub_field('url'); ?>" target="_blank" rel="noopener"
                   class="relative flex items-center justify-center h-28 w-28 sm:h-32 sm:w-32 md:h-36 md:w-36 rounded-full">
            <?php else: ?>
                <div class="relative flex items-center justify-center h-28 w-28 sm:h-32 sm:w-32 md:h-36 md:w-36 rounded-full">
            <?php endif; ?>

                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/circle.svg" alt=""
                         class="absolute inset-0 h-full w-full object-cover" />

                    <img src="<?php the_sub_field('logo'); ?>" alt="Piedmont Global Recognition"
                         class="relative max-h-16 max-w-16 sm:max-h-20 sm:max-w-20 md:max-h-24 md:max-w-24 object-contain transition duration-300 ease-in-out grayscale hover:grayscale-0" />

            <?php if (get_sub_field('url')) : ?>
                </a>
            <?php else: ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>

            <?php endif; ?>
        </div>
    </div>
</section>

<?php
?>
<style>
/* Equal-height testimonial cards within Owl Carousel */
.testimonial-carousel .owl-stage {
    display: flex;
}

.testimonial-carousel .owl-item {
    display: flex;
}

.testimonial-carousel .owl-item>div {
    height: 100%;
}
</style>
<?php
get_template_part( 'components/common/cta' ); 
get_footer();