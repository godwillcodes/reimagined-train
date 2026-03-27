<?php
/**
 * Template Name: Ebooks
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
            <h2 class="text-4xl py-3  md:text-5xl max-w-3xl font-extrabold mb-1 leading-[98%]">
            eBooks for Strategic Globalization
            </h2>
            <div class="text-gray-100 text-xl mb-12 max-w-3xl">
                <?php the_content(); ?>
            </div>

        </div>
    </div>
</header>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Check if 'ebook' post type exists, fallback to 'post' with 'ebook' category
$post_type = 'ebook';
if (!post_type_exists('ebook')) {
    $post_type = 'post';
}

$args = [
  'post_type'      => $post_type,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
  'posts_per_page' => -1,
  'paged'          => $paged
];

// If ebook post type doesn't exist, filter by category instead
if (!post_type_exists('ebook')) {
    $args['category_name'] = 'ebook';
}

$query = new WP_Query($args);
?>

<section class="bg-[#F9F8F6] py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-0 lg:-mt-56 relative z-10 ebooks-grid">
            <?php 
      $counter = 0; // Counter for staggered delays
      while ($query->have_posts()) : $query->the_post(); 
        $delay = $counter * 100; // 100ms delay between each card
      ?>
            <a href="<?php the_permalink(); ?>"
                class="group block shadow-md rounded border bg-white border-[#ffffff]/40 rounded-t-[4px] transition-transform duration-300 hover:shadow-lg"
                data-aos="fade-up" 
                data-aos-duration="400" 
                data-aos-delay="<?php echo $delay; ?>"
                data-aos-easing="ease-out">
                <div class="overflow-hidden rounded-t-[4px]">
                    <img src="<?php the_post_thumbnail_url(); ?>"
                        class="w-full h-60 object-cover object-center transition-transform duration-500 group-hover:scale-105"
                        alt="<?php the_title(); ?>">
                </div>
                <div class="p-8 bg-white">
                    <h3 class="text-2xl font-semibold text-[#1F3131] mb-2"><?php the_title(); ?></h3>
                    <div class="text-gray-500 text-base mb-2"><?php echo wp_trim_words(get_the_content(), 30); ?></div>
                    <div class="h-6 md:h-10"></div>
                    <span class="inline-flex items-center text-base font-medium border-b-2 border-[#D16555]">
                        Get eBook <span class="ml-1 text-lg">→</span>
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
?>