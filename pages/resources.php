<?php
/**
 * Template Name: Resources
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

    <div class="relative h-[200px] md:h-[200px] lg:h-[304px] bg-cover bg-no-repeat bg-right-bottom"
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

$args = [
  'post_type'      => 'post',
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
  'category_name'  => 'blog',
  'posts_per_page' =>3,
  'paged'          => $paged
];

$query = new WP_Query($args);
?>

<section class="bg-[#F9F8F6] py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full mb-10 gap-6">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900" data-aos="fade-up" data-aos-duration="400"
                data-aos-easing="ease-out">
                Blog
            </h2>
            <a href="/blog/"
                class="group inline-flex items-center text-lg font-medium border-b-2 border-[#D16555] hover:border-[#D16555] transition-colors duration-300"
                data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out" data-aos-delay="100">
                Explore all blogs
                <span
                    class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1">→</span>
            </a>

        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6  relative z-10 blog-grid">
            <?php 
      $counter = 0; // Counter for staggered delays
      while ($query->have_posts()) : $query->the_post(); 
        $delay = $counter * 100; // 100ms delay between each card
      ?>
            <a href="<?php the_permalink(); ?>"
                class="group block shadow-md rounded border bg-white border-[#ffffff]/40 rounded-t-[4px] transition-transform duration-300 hover:shadow-lg">
                <div class="overflow-hidden rounded-t-[4px]">
                    <img src="<?php the_post_thumbnail_url(); ?>"
                        class="w-full h-60 object-cover object-top transition-transform duration-500 group-hover:scale-105"
                        alt="<?php the_title(); ?>">
                </div>
                <div class="p-8 bg-white">
                    <div class="text-gray-500 text-sm mb-2"><?php echo get_the_date(); ?></div>
                    <h3 class="text-2xl font-semibold text-[#1F3131] mb-2"><?php the_title(); ?></h3>
                    <div class="h-6 md:h-10"></div>
                    <span class="inline-flex items-center text-base font-medium border-b-2 border-[#D16555]">
                        Read More <span class="ml-1 text-lg">→</span>
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
$args = [
  'post_type'      => 'ebook',
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
  'posts_per_page' => 3
];

$query = new WP_Query($args);
?>

<section class="bg-[#F9F8F6]">

    <div class="max-w-7xl mx-auto px-6 lg:px-0 pb-20">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full mb-10 gap-6">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900" data-aos="fade-up" data-aos-duration="400"
                data-aos-easing="ease-out">
                eBooks
            </h2>
            <a href="/ebooks/"
                class="group inline-flex items-center text-lg font-medium border-b-2 border-[#D16555] hover:border-[#D16555] transition-colors duration-300"
                data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out" data-aos-delay="100">
                Explore all eBooks
                <span
                    class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1">→</span>
            </a>

        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-0  relative z-10 ebooks-grid">
            <?php 
      $counter = 0; // Counter for staggered delays
      while ($query->have_posts()) : $query->the_post(); 
        $delay = $counter * 100; // 100ms delay between each card
      ?>
            <a href="<?php the_permalink(); ?>"
                class="group block shadow-md rounded border bg-white border-[#ffffff]/40 rounded-t-[4px] transition-transform duration-300 hover:shadow-lg"
                data-aos="fade-up" data-aos-duration="400" data-aos-delay="<?php echo $delay; ?>"
                data-aos-easing="ease-out">
                <div class="overflow-hidden rounded-t-[4px]">
                    <img src="<?php the_post_thumbnail_url(); ?>"
                        class="w-full h-60 object-cover object-center transition-transform duration-500 group-hover:scale-105"
                        alt="<?php the_title(); ?>">
                </div>
                <div class="p-8 bg-white shadow">
                    <h3 class="text-2xl font-semibold text-[#1F3131] mb-2"><?php the_title(); ?></h3>
                    <div class="text-gray-500 text-base mb-2"><?php echo wp_trim_words(get_the_content(), 30); ?></div>
                    <div class="h-6 md:h-10"></div>
                    <span class="inline-flex items-center text-base font-medium border-b-2 border-[#D16555]">
                        Get <?php the_title(); ?> eBook <span class="ml-1 text-lg">→</span>
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
$args = [
  'post_type'      => 'case_study',
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
  'posts_per_page' =>3
];

$query = new WP_Query($args);
?>

<section class="bg-[#F9F8F6]">

    <div class="max-w-7xl mx-auto px-6 lg:px-0 pb-20">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full mb-10 gap-6">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900" data-aos="fade-up" data-aos-duration="400"
                data-aos-easing="ease-out">
                Case Studies
            </h2>
            <a href="/case-studies/"
                class= "group inline-flex items-center text-lg font-medium border-b-2 border-[#D16555] hover:border-[#D16555] transition-colors duration-300"
                data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out" data-aos-delay="100">
                Explore all case studies
                <span
                    class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1">→</span>
            </a>

        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-0  relative z-10 ebooks-grid">
            <?php 
      $counter = 0; // Counter for staggered delays
      while ($query->have_posts()) : $query->the_post(); 
        $delay = $counter * 100; // 100ms delay between each card
      ?>
            <a href="<?php the_permalink(); ?>"
                class="group block shadow-md rounded border bg-white border-[#ffffff]/40 rounded-t-[4px] transition-transform duration-300 hover:shadow-lg">
                <div class="overflow-hidden rounded-t-[4px]">
                    <img src="<?php the_field('logo'); ?>"
                        class="w-[70%] h-60 object-contain mx-auto object-center transition-transform duration-500 group-hover:scale-105"
                        alt="<?php the_title(); ?>">
                </div>
                <div class="p-8 bg-white">
                    <div class="text-gray-500 text-base mb-2"><?php the_field('industry'); ?></div>
                    <h3 class="text-2xl font-semibold text-[#1F3131] mb-2"><?php the_field('title'); ?></h3>
                    <div class="h-6 md:h-10"></div>
                    <span class="inline-flex items-center text-base font-medium border-b-2 border-[#D16555]">
                        Read Case study <span class="ml-1 text-lg">→</span>
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
$args = [
  'post_type'      => 'webinar',
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
  'posts_per_page' => 3
];

$query = new WP_Query($args);
?>

<section class="bg-[#F9F8F6]">

    <div class="max-w-7xl mx-auto px-6 lg:px-0 pb-20">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full mb-10 gap-6">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900" data-aos="fade-up" data-aos-duration="400"
                data-aos-easing="ease-out">
                Webinars
            </h2>
            <a href="/webinars/"
                class="group inline-flex items-center text-lg font-medium border-b-2 border-[#D16555] hover:border-[#D16555] transition-colors duration-300"
                data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out" data-aos-delay="100">
                Explore all webinars
                <span
                    class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1">→</span>
            </a>

        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-0  relative z-10 ebooks-grid">
            <?php 
      $counter = 0; // Counter for staggered delays
      while ($query->have_posts()) : $query->the_post(); 
        $delay = $counter * 100; // 100ms delay between each card
      ?>
            <a href="<?php the_permalink(); ?>"
                class="group block shadow-md rounded border bg-white border-[#ffffff]/40 rounded-t-[4px] transition-transform duration-300 hover:shadow-lg"
                data-aos="fade-up" data-aos-duration="400" data-aos-delay="<?php echo $delay; ?>"
                data-aos-easing="ease-out">
                <div class="overflow-hidden rounded-t-[4px]">
                    <img src="<?php the_post_thumbnail_url(); ?>"
                        class="w-full h-60 object-cover object-center transition-transform duration-500 group-hover:scale-105"
                        alt="<?php the_title(); ?>">
                </div>
                <div class="p-8 bg-white shadow">
                    <h3 class="text-2xl font-semibold text-[#1F3131] mb-2"><?php the_title(); ?></h3>
                    <div class="text-gray-500 text-base mb-2"><?php echo wp_trim_words(get_the_content(), 20); ?></div>
                    <div class="h-6 md:h-10"></div>
                    <span class="inline-flex items-center text-base font-medium border-b-2 border-[#D16555]">
                        Read More <span class="ml-1 text-lg">→</span>
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
$args = [
  'post_type'      => 'podcast',
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
  'posts_per_page' => 3
];

$query = new WP_Query($args);
?>

<section class="bg-[#F9F8F6]">

    <div class="max-w-7xl mx-auto px-6 lg:px-0 pb-20">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full mb-10 gap-6">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900" data-aos="fade-up" data-aos-duration="400"
                data-aos-easing="ease-out">
                Podcasts
            </h2>
            <a href="/podcasts/"
                class="group inline-flex items-center text-lg font-medium border-b-2 border-[#D16555] hover:border-[#D16555] transition-colors duration-300"
                data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out" data-aos-delay="100">
                Explore all podcasts
                <span
                    class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1">→</span>
            </a>

        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-0  relative z-10 ebooks-grid">
            <?php 
      $counter = 0; // Counter for staggered delays
      while ($query->have_posts()) : $query->the_post(); 
        $delay = $counter * 100; // 100ms delay between each card
      ?>
            <a href="<?php the_permalink(); ?>"
                class="group block shadow-md rounded border bg-white border-[#ffffff]/40 rounded-t-[4px] transition-transform duration-300 hover:shadow-lg"
                data-aos="fade-up" data-aos-duration="400" data-aos-delay="<?php echo $delay; ?>"
                data-aos-easing="ease-out">
                <div class="overflow-hidden rounded-t-[4px]">
                    <img src="<?php the_post_thumbnail_url(); ?>"
                        class="w-full h-60 object-cover object-center transition-transform duration-500 group-hover:scale-105"
                        alt="<?php the_title(); ?>">
                </div>
                <div class="p-8 bg-white ">
                    <h3 class="text-2xl font-semibold text-[#1F3131] mb-2"><?php the_title(); ?></h3>
                    <div class="text-gray-500 text-base mb-2"><?php echo wp_trim_words(get_the_content(), 20); ?></div>
                    <div class="h-6 md:h-10"></div>
                    <span class="inline-flex items-center text-base font-medium border-b-2 border-[#D16555]">
                        Read More <span class="ml-1 text-lg">→</span>
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
<section class="relative bg-[#F9F8F6] px-6 lg:px-0">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full mb-10 gap-6">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900" data-aos="fade-up" data-aos-duration="400"
                data-aos-easing="ease-out">
                Testimonials
            </h2>
            <a href="/testimonials/"
                class="group inline-flex items-center text-lg font-medium border-b-2 border-[#D16555] hover:border-[#D16555] transition-colors duration-300"
                data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out" data-aos-delay="100">
                Explore all testimonials
                <span
                    class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1">→</span>
            </a>

        </div>

        <?php if (!empty($testimonials)): ?>
            <ul
  class="testimonial-carousel owl-carousel flex [&_.owl-stage]:flex [&_.owl-item]:flex [&_.owl-item]:items-stretch"
  role="list"
  aria-label="Testimonials"
>
  <?php foreach ($testimonials as $testimonial): ?>
  <div class="flex flex-col justify-between bg-white border border-[#DFDAD4] p-8 shadow-md h-full">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/quote.svg"
         alt="Quote icon"
         class="h-6 w-6 mb-6 self-start">

    <div class="text-base text-gray-800 font-normal mt-4 leading-relaxed flex-grow">
      <p class="italic">"<?php echo esc_html($testimonial['description']); ?>"</p>
    </div>

    <div class="pt-6">
      <p class="font-semibold text-gray-900"><?php echo esc_html($testimonial['title']); ?></p>
      <?php if (!empty($testimonial['location'])): ?>
      <p class="text-sm text-gray-600"><?php echo esc_html($testimonial['location']); ?></p>
      <?php endif; ?>
    </div>
  </div>
  <?php endforeach; ?>
</ul>

        <?php endif; ?>

    </div>
</section>


<section class="pb-40 pt-20"
    style="background: linear-gradient(to bottom, #F7F7F5 0%, #F7F7F5 70%, #98C44180 85%, #00615580 100%);">

    <div class="max-w-3xl mx-auto px-8 lg:px-0 text-center">
        <h2 class="text-3xl lg:text-5xl font-bold text-black mb-6" data-aos="fade-up" data-aos-duration="400"
            data-aos-delay="200" data-aos-easing="ease-out">
            Ready to move from translation to transformation?
        </h2>
        <a href="/contact"
            class="inline-block bg-[#98C441] text-black px-6 py-3 font-bold text-base lg:text-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#98C441] focus:ring-offset-2 focus:ring-offset-[#1F311]"
            data-aos="fade-up" data-aos-duration="400" data-aos-delay="300" data-aos-easing="ease-out">
            Connect with our team
        </a>
    </div>



</section>


<?php
get_template_part( 'components/common/cta' ); 
get_footer(); 
?>