<?php
/**
 * Template Name: Blog
 */
get_header();

// parent category
$parent = get_category_by_slug('blog');
$children = get_categories([
    'parent'     => $parent->term_id,
    'hide_empty' => 1
]);

$selected = get_query_var('category_name');
$paged    = get_query_var('paged') ? get_query_var('paged') : 1;

// query
$args = [
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'posts_per_page' => -1,
    'paged'          => $paged,
    'tax_query'      => [
        [
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $selected ? $selected : $parent->slug,
        ]
    ]
];

$query = new WP_Query($args);
?>

<header class="relative w-full text-white overflow-hidden bg-[linear-gradient(to_bottom,_#1F3131_50%,_#006155_100%)]">
    <?php get_template_part('components/navigation/desktop'); ?>
    <?php get_template_part('components/navigation/mobile'); ?>

    <div class="w-full pt-[30%] lg:pt-[12%] px-6 lg:px-0 relative z-20 pb-10 lg:pb-40">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between max-w-7xl mx-auto py-5 gap-4 md:gap-0">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-[98%]">
                <?php the_title(); ?>
            </h1>

            <form method="get" class="md:ml-6 w-full md:w-auto">
                <div class="inline-flex flex-col items-stretch md:items-end w-full md:w-auto space-y-2">
                    <label for="blog-category-filter" class="text-xs font-semibold tracking-[0.16em] uppercase text-white/70">
                        Filter by category
                    </label>
                    <div class="relative w-full md:w-64">
                        <select
                            id="blog-category-filter"
                            name="category_name"
                            onchange="this.form.submit()"
                            class="w-full appearance-none rounded-[4px] border border-white/30 bg-white/10 px-4 pr-10 py-2.5 text-sm md:text-base text-white placeholder-white/60 backdrop-blur-sm shadow-[0_0_0_1px_rgba(255,255,255,0.06)] focus:outline-none focus:ring-2 focus:ring-[#D16555] focus:border-transparent transition duration-200 cursor-pointer"
                        >
                            <option value="" class="text-slate-800">
                                All posts
                            </option>
                            <?php
                            foreach ($children as $cat) {
                                $sel = $selected === $cat->slug ? 'selected' : '';
                                echo "<option class='text-slate-800' value='{$cat->slug}' {$sel}>{$cat->name}</option>";
                            }
                            ?>
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                            <svg class="h-4 w-4 text-white/80" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</header>

<section class="bg-[#F9F8F6] py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-0 lg:-mt-56 relative z-10 blog-grid">

            <?php 
            $counter = 0;
            while ($query->have_posts()) : $query->the_post(); 
                $delay = $counter * 100;
            ?>

            <a href="<?php the_permalink(); ?>"
               class="group block shadow-md rounded border bg-white border-[#ffffff]/40 rounded-t-[4px] transition-transform duration-300 hover:shadow-lg">
                <div class="overflow-hidden rounded-t-[4px]">
                    <img src="<?php the_post_thumbnail_url(); ?>"
                         class="w-full h-auto object-contain object-top transition-transform duration-500 group-hover:scale-105"
                         alt="<?php the_title(); ?>">
                </div>
                <div class="p-8 bg-white">
                    <div class="text-gray-500 text-sm mb-2"><?php echo get_the_date(); ?></div>
                    <h3 class="lg:text-2xl text-xl font-semibold text-[#1F3131] mb-2"><?php the_title(); ?></h3>
                    <div class="h-6 md:h-10"></div>
                    <span class="inline-flex items-center lg:text-base text-sm font-medium border-b-2 border-[#D16555]">
                        Read More <span class="ml-1 text-lg">→</span>
                    </span>
                </div>
            </a>

            <?php 
            $counter++;
            endwhile; 
            wp_reset_postdata();
            ?>

        </div>
    </div>
</section>

<?php
get_template_part('components/common/cta');
get_footer();
?>
