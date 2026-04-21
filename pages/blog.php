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

            <form method="get" class="md:ml-6 w-full md:w-auto" role="search" aria-label="<?php echo esc_attr__( 'Filter blog posts by category', 'piedmont-global-wp' ); ?>">
                <div class="flex flex-col items-stretch md:items-end w-full md:w-auto space-y-2">
                    <label for="blog-category-filter" class="text-xs font-semibold tracking-[0.16em] uppercase text-white">
                        <?php esc_html_e( 'Filter by category', 'piedmont-global-wp' ); ?>
                    </label>
                    <p id="blog-category-filter-help" class="sr-only">
                        <?php esc_html_e( 'Choose a category, then activate Apply to update the list of posts.', 'piedmont-global-wp' ); ?>
                    </p>
                    <div class="flex w-full md:w-auto items-stretch gap-2">
                        <div class="relative flex-1 md:w-64">
                            <select
                                id="blog-category-filter"
                                name="category_name"
                                aria-describedby="blog-category-filter-help"
                                aria-controls="blog-results"
                                class="w-full appearance-none rounded-[4px] border border-white/40 bg-white/10 px-4 pr-10 py-2.5 text-sm md:text-base text-white backdrop-blur-sm shadow-[0_0_0_1px_rgba(255,255,255,0.06)] focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#98C441] focus-visible:ring-2 focus-visible:ring-[#1F3131] transition duration-200 cursor-pointer"
                            >
                                <option value="" class="text-slate-800">
                                    <?php esc_html_e( 'All posts', 'piedmont-global-wp' ); ?>
                                </option>
                                <?php
                                foreach ( $children as $cat ) {
                                    printf(
                                        '<option class="text-slate-800" value="%1$s" %2$s>%3$s</option>',
                                        esc_attr( $cat->slug ),
                                        $selected === $cat->slug ? 'selected' : '',
                                        esc_html( $cat->name )
                                    );
                                }
                                ?>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <svg class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                                    <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-[4px] bg-[#D16555] px-4 py-2.5 text-sm md:text-base font-semibold text-white shadow-sm hover:bg-[#b9533f] focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#98C441] focus-visible:ring-2 focus-visible:ring-white transition"
                        >
                            <?php esc_html_e( 'Apply', 'piedmont-global-wp' ); ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</header>

<main id="maincontent">
    <section class="bg-[#F9F8F6] py-20" aria-label="<?php echo esc_attr__( 'Blog posts', 'piedmont-global-wp' ); ?>">
        <div class="max-w-7xl mx-auto px-6 lg:px-0">
            <p id="blog-results-status" class="sr-only" aria-live="polite">
                <?php
                $total = (int) $query->found_posts;
                if ( $selected ) {
                    $current_term = get_term_by( 'slug', $selected, 'category' );
                    $term_name    = $current_term && ! is_wp_error( $current_term ) ? $current_term->name : $selected;
                    printf(
                        esc_html( _n( '%1$d post in %2$s.', '%1$d posts in %2$s.', $total, 'piedmont-global-wp' ) ),
                        $total,
                        esc_html( $term_name )
                    );
                } else {
                    printf(
                        esc_html( _n( '%d post.', '%d posts.', $total, 'piedmont-global-wp' ) ),
                        $total
                    );
                }
                ?>
            </p>
            <div id="blog-results" class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-0 lg:-mt-56 relative z-10 blog-grid">

                <?php
                $counter = 0;
                while ( $query->have_posts() ) :
                    $query->the_post();
                    $delay = $counter * 100;
                ?>

                <a href="<?php the_permalink(); ?>"
                   class="group block shadow-md rounded border bg-white border-[#ffffff]/40 rounded-t-[4px] transition-transform duration-300 hover:shadow-lg focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#D16555] hover:shadow-lg">
                    <div class="overflow-hidden rounded-t-[4px]" aria-hidden="true">
                        <?php
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail(
                                'large',
                                [
                                    'class'    => 'w-full h-auto object-contain object-top transition-transform duration-500 group-hover:scale-105',
                                    'alt'      => '',
                                    'loading'  => 'lazy',
                                    'decoding' => 'async',
                                ]
                            );
                        }
                        ?>
                    </div>
                    <div class="p-8 bg-white">
                        <div class="text-gray-600 text-sm mb-2"><?php echo esc_html( get_the_date() ); ?></div>
                        <h3 class="lg:text-2xl text-xl font-semibold text-[#1F3131] mb-2"><?php the_title(); ?></h3>
                        <div class="h-6 md:h-10"></div>
                        <span class="inline-flex items-center lg:text-base text-sm font-medium border-b-2 border-[#D16555]">
                            <?php esc_html_e( 'Read More', 'piedmont-global-wp' ); ?> <span class="ml-1 text-lg" aria-hidden="true">&rarr;</span>
                            <span class="sr-only"> <?php
                                /* translators: %s: post title */
                                printf( esc_html__( 'about %s', 'piedmont-global-wp' ), esc_html( get_the_title() ) );
                            ?></span>
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
</main>

<?php
get_template_part('components/common/cta');
get_footer();
?>
