<?php
/**
 * Template Name: Case Studies
 * Description: 
 */
get_header();
?>

<header class="relative w-full text-white overflow-hidden bg-[linear-gradient(to_bottom,_#1F3131_50%,_#006155_100%)]">
    <?php get_template_part('components/navigation/desktop'); ?>
    <?php get_template_part('components/navigation/mobile'); ?>

    <div class="w-full pt-[30%] lg:pt-[12%] px-6 lg:px-0 relative z-20 pb-10 lg:pb-40">
        <div class="text-start gap-y-8 max-w-7xl mx-auto">


            <h1 class="text-4xl py-5  md:text-5xl max-w-4xl font-extrabold mb-6 leading-[98%]">
                <?php the_title(); ?>
            </h1>
        </div>
    </div>
</header>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = [
  'post_type'      => 'case_study',
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
  'posts_per_page' => -1,
  'paged'          => $paged
];

$query = new WP_Query($args);
?>

<section class="bg-[#F9F8F6] py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-0 lg:-mt-56 relative z-10">
            <?php 
      $counter = 0; // Counter for staggered delays
      while ($query->have_posts()) : $query->the_post(); 
        $delay = $counter * 100; // 100ms delay between each card
      ?>
            <a href="<?php the_permalink(); ?>"
                class="group block shadow-md rounded border bg-white border-[#ffffff]/40 rounded-t-[4px] transition-transform duration-300 hover:shadow-lg">
                <div class="overflow-hidden rounded-t-[4px]">
                    <img src="<?php the_field('logo'); ?>"
                        class="w-[70%] h-40 object-contain mx-auto object-center transition-transform duration-500 group-hover:scale-105"
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
get_template_part( 'components/common/cta' ); 
get_footer(); 
?>