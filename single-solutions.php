<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package PiedmontGlobal
 */

get_header();
?>
<section class="shadow-sm">
    <div class="bg-[#1F3131] pt-8 pb-12">

        <?php
        if (is_single('healthcare-staffing')):
            get_template_part('components/navigation/desktop-sandbox');
        else:
            get_template_part('components/navigation/desktop');
        endif;
        ?>


        <?php get_template_part('components/navigation/mobile'); ?>
        ?>
    </div>

    <div class="h-[500px] md:h-[400px] lg:h-[554px] bg-cover bg-center relative"
        style="background-image: linear-gradient(180deg, rgba(31,49,49,0.5) 0%, #1F3131 80%), url('<?php echo esc_url(get_field('featured_image')); ?>');">
        <div class="absolute inset-0 flex items-end">
            <div class="max-w-7xl mx-auto w-full px-10 lg:px-0 pb-4 md:pb-12 lg:pb-12 text-white">
                <h1 class="text-2xl md:text-4xl lg:text-4xl font-bold">
                    <?php the_title(); ?>
                </h1>


                <p class="text-base lg:text-lg my-4 max-w-4xl">
                    <?php echo esc_html(get_field('tagline')); ?>
                </p>


                <?php if (is_single('healthcare-staffing')): ?>
                    <a href="#"
                        class="js-open-sandbox-modal inline-flex items-center mt-10 gap-2 bg-[#98C441] text-[#1F3131] px-4 py-2 font-bold text-base shadow-md rounded-0 hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-[#1F3131] transition-colors duration-200"
                        role="button" aria-haspopup="dialog" aria-expanded="false">
                        Connect with our <?php echo strtolower(get_the_title()); ?> team
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                <?php else: ?>
                    <a href="/contact"
                        class="inline-block bg-[#98C441] text-[#1F3131] px-5 py-2 mt-4 font-bold text-base shadow-md hover:bg-[#8AB738] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#98C441] transition">
                        Request demo
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<section class="bg-[linear-gradient(to_bottom,_#006155_0.1%,_#1F3131_20%)] w-full py-20 shadow-sm">
    <div class="max-w-7xl mx-auto px-8 lg:px-0 flex flex-col md:flex-row gap-8">
        <div class="md:w-2/3 space-y-6">

            <?php if (get_field('section_title')): ?>
            <div class="inline-flex items-stretch border border-[#ffffff15] overflow-hidden mb-6" role="doc-subtitle">
                <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
                <div class="flex items-center gap-[7px] px-3 py-[6px]">
                    <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-white/80">
                        <?php echo wp_kses_post(get_field('section_title')); ?>
                    </span>
                </div>
            </div>
            <?php endif; ?>



            <div class="text-white  text-base md:text-xl leading-relaxed max-w-3xl">
                <?php echo wp_kses_post(get_field('primary_description')); ?>
            </div>

        </div>

        <div class="md:w-1/3 flex items-center">

            <div class="text-white text-base leading-relaxed">
                <?php echo wp_kses_post(get_field('supporting_description')); ?>
            </div>
        </div>
    </div>
</section>


<section class="relative py-20 bg-[#F7F7F5]">
    <div class="max-w-7xl mx-auto px-8 lg:px-0 text-center mb-16">
        <?php if (get_field('eyebrow_text')): ?>
        <div class="inline-flex items-stretch border border-[#1F3131]/15 overflow-hidden mb-6 mx-auto" role="doc-subtitle">
            <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
            <div class="flex items-center gap-[7px] px-3 py-[6px]">
                <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-[#1F3131]/80">
                    <?php echo wp_kses_post(get_field('eyebrow_text')); ?>
                </span>
            </div>
        </div>
        <?php endif; ?>

        <h3 class="text-3xl lg:text-4xl font-extrabold leading-tight max-w-4xl mx-auto text-[#0F1E1E]">
            <?php echo esc_html(get_field('sub_solutions_section_title')); ?>
        </h3>

        <div class="text-base lg:text-xl text-[#1F3131] max-w-3xl mx-auto mt-4">
            <?php echo wp_kses_post(get_field('sub_solutions_section_description')); ?>
        </div>

        <hr class="border-t-[0.5px] border-[#1F3131] mt-10" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-7xl mx-auto px-5 lg:px-0 items-stretch">
        <?php
        global $post;

        // Query children of current solution
        $children = get_posts([
            'post_type' => 'solutions',
            'post_parent' => $post->ID,
            'numberposts' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);

        if ($children):
            foreach ($children as $child): ?>
                <a href="<?php echo get_permalink($child->ID); ?>" class="block group h-full">
                    <div
                        class="relative bg-[#006155] w-full mx-auto overflow-hidden border border-white/20 cursor-pointer p-8 hover:scale-[1.02] transition-transform duration-500 ease-in-out h-full flex flex-col">

                        <h2 class="text-2xl md:text-2xl font-bold text-white mb-6 tracking-tight leading-snug">
                            <?php echo esc_html(get_the_title($child->ID)); ?>
                        </h2>

                        <div
                            class="text-white/90 mt-8 text-base max-w-2xl line-clamp-3 group-hover:line-clamp-none transition-all duration-500 leading-relaxed flex-grow">
                            <?php echo esc_html(get_field('tagline', $child->ID)); ?>
                        </div>

                        <div class="mt-8">
                            <span
                                class="inline-flex items-center text-base font-medium text-white/90 border-b border-[#98c441]  transition-colors duration-500">
                                Read More →
                            </span>
                        </div>

                    </div>
                </a>



            <?php endforeach;

        elseif (have_rows('non_pages_solutions')):
            while (have_rows('non_pages_solutions')):
                the_row();
                $image = get_sub_field('image');
                $title = get_sub_field('title');
                $description = get_sub_field('description'); ?>
                <div
                    class="relative bg-[#ab9dba] w-full mx-auto rounded-[4px] overflow-hidden shadow-sm group cursor-pointer p-8 h-full flex flex-col">
                    <h2 class="text-xl md:text-xl font-extrabold text-black mb-3">
                        <?php echo esc_html($title); ?>
                    </h2>
                    <div class="text-black text-base max-w-prose flex-grow">
                        <?php echo esc_html($description); ?>
                    </div>
                </div>
            <?php endwhile;

        else: ?>
            <p class="text-center mx-auto">No child solutions or non-pages solutions found.</p>
        <?php endif; ?>
    </div>

</section>


<section class="py-24 text-white bg-[linear-gradient(to_bottom,_#1F3131_50%,_#006155_100%)]">
    <div class="max-w-7xl mx-auto px-6 lg:px-0 text-center lg:text-left">
        <?php if (get_field('why_piedmont_global_eyebrow')): ?>
        <div class="inline-flex items-stretch border border-[#ffffff15] overflow-hidden mb-6 lg:mx-0 mx-auto" role="doc-subtitle">
            <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
            <div class="flex items-center gap-[7px] px-3 py-[6px]">
                <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-white/80">
                    <?php echo esc_html(get_field('why_piedmont_global_eyebrow')); ?>
                </span>
            </div>
        </div>
        <?php endif; ?>

        <h2 class="text-3xl sm:text-4xl md:text-5xl max-w-4xl font-extrabold mb-6 leading-[98%]">
            <?php echo esc_html(get_field('why_piedmont_global_section_title')); ?>
        </h2>

        <p class="text-base sm:text-lg text-gray-300 max-w-2xl lg:mx-0 mb-12">
            <?php echo esc_html(get_field('why_piedmont_global_description')); ?>
        </p>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <?php
            $why_piedmont_cards = get_field('why_piedmont_global_cards');
            if ($why_piedmont_cards && is_array($why_piedmont_cards)) {
                foreach ($why_piedmont_cards as $card):
                    ?>
                    <div
                        class="bg-[#006155] p-6 flex flex-col h-full transition-transform duration-300 ease-in-out hover:scale-[1.03] hover:shadow-lg hover:bg-[#007766]">

                        <h3 class="font-semibold text-lg  lg:text-xl mb-4 text-start w-full lg:max-w-[80px]">
                            <?php echo esc_html($card['card_title']); ?>
                        </h3>

                        <div class="flex-grow h-20 lg:h-40"></div>

                        <p class="text-gray-100 text-base  text-start lg:text-lg leading-relaxed">
                            <?php echo esc_html($card['card_description']); ?>
                        </p>
                    </div>
                <?php endforeach;
            } ?>
        </div>


    </div>
</section>

<section class="py-20 bg-[#F9F9F6] text-[#1F3131]">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="inline-flex items-stretch border border-[#1F3131]/15 overflow-hidden mb-6" role="doc-subtitle">
            <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
            <div class="flex items-center gap-[7px] px-3 py-[6px]">
                <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-[#1F3131]/80">
                    Industries we support
                </span>
            </div>
        </div>

        <h2 class="text-3xl sm:text-4xl md:text-5xl max-w-4xl font-extrabold mb-6 leading-[98%]">
            Tailored solutions for regulated, high-impact sectors.
        </h2>

        <div class="grid gap-x-24 gap-y-6 sm:grid-cols-2 mt-16">
            <?php
            $industries_section = get_field('industries_section');
            if ($industries_section && is_array($industries_section)) {
                foreach ($industries_section as $industry):
                    ?>
                    <a href="<?php echo esc_url(get_permalink($industry->ID)); ?>"
                        class="group block border-b border-gray-300 px-4 py-6 transition-colors duration-200 ease-in-out hover:border-[#98C441]"
                        aria-label="<?php echo esc_attr(get_the_title($industry) . ': ' . get_field('industry_tagline', $industry->ID)); ?>">
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <h3
                                    class="font-semibold text-lg sm:text-xl text-[#1F3131] transition-colors duration-200 ease-in-out group-hover:text-[#0F2A2A]">
                                    <?php echo esc_html(get_the_title($industry)); ?>
                                </h3>
                                <?php if (get_field('industry_tagline', $industry->ID)): ?>
                                    <div
                                        class="mt-2 text-base lg:text-lg text-gray-500 transition-colors duration-200 ease-in-out group-hover:text-gray-700">
                                        <?php echo wp_kses_post(get_field('industry_tagline', $industry->ID)); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/wierd-arrow.svg'); ?>"
                                alt="" aria-hidden="true"
                                class="w-8 h-8 sm:w-10 sm:h-10 flex-shrink-0 transform transition duration-200 ease-in-out group-hover:rotate-45 group-hover:scale-110">
                        </div>
                    </a>
                <?php endforeach;
            } ?>
        </div>


        <div class="grid gap-6 grid-cols-1 lg:grid-cols-2">
            <?php
            $cards = get_field('non_paged_industries_cards');

            if ($cards && is_array($cards)) {
                foreach ($cards as $card) {
                    ?>
                    <div class="group block border-b border-gray-300 px-4 py-6 transition-colors duration-200 ease-in-out hover:border-[#98C441]"
                        aria-label="<?php echo esc_attr(
                            $card['title'] . ': ' . wp_strip_all_tags($card['description'])
                        ); ?>">
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <h3
                                    class="font-semibold text-lg sm:text-xl text-[#1F3131] transition-colors duration-200 ease-in-out group-hover:text-[#0F2A2A]">
                                    <?php echo esc_html($card['title']); ?>
                                </h3>

                                <?php if (!empty($card['description'])): ?>
                                    <div
                                        class="mt-2 text-base lg:text-lg text-gray-500 transition-colors duration-200 ease-in-out group-hover:text-gray-700">
                                        <?php echo wp_kses_post($card['description']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>


                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>


    </div>
</section>


<?php if (have_rows('outcomes')): ?>
<section class="bg-white py-20 lg:py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-16">
            <div class="inline-flex items-stretch border border-[#1F3131]/15 overflow-hidden mb-6 mx-auto"
                role="doc-subtitle">
                <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
                <div class="flex items-center gap-[7px] px-3 py-[6px]">
                    <span
                        class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-[#1F3131]/80">Outcomes</span>
                </div>
            </div>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-6 leading-[98%] text-[#1F3131]">
                Results you can expect
            </h2>
        </div>

        <?php
        // Modern flexible bento: 3-col grid with featured image as 2x2 anchor.
        // Outcome cards are uniform 1x1 tiles with brand color rotation.
        $bento_variants = [
            'bg-[#1F3131] text-white',
            'bg-[#98C441] text-[#1F3131]',
            'bg-[#006155] text-white',
            'bg-[#F0EEE6] text-[#1F3131] border border-[#1F3131]/10',
        ];
        $featured_image = get_field('featured_image');
        ?>

        <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 lg:gap-4 auto-rows-[200px] sm:auto-rows-[220px] lg:auto-rows-[240px] [grid-auto-flow:dense]">
            <?php if ($featured_image): ?>
            <div class="relative overflow-hidden rounded-lg shadow-sm group sm:col-span-2 sm:row-span-2">
                <img src="<?php echo esc_url($featured_image); ?>"
                    alt="<?php echo esc_attr(get_the_title()); ?>"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 ease-out motion-safe:group-hover:scale-[1.04]"
                    loading="lazy" decoding="async" />
                <div class="absolute inset-0 bg-gradient-to-t from-[#1F3131]/40 via-transparent to-transparent"
                    aria-hidden="true"></div>
            </div>
            <?php endif; ?>

            <?php
            $i = 0;
            while (have_rows('outcomes')): the_row();
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                $variant = $bento_variants[$i % count($bento_variants)];
            ?>
            <div class="<?php echo esc_attr($variant); ?> p-6 flex flex-col justify-between rounded-lg shadow-sm transition-shadow duration-300 motion-safe:hover:shadow-md">
                <div class="text-xl md:text-2xl font-extrabold leading-tight">
                    <?php echo esc_html($title); ?>
                </div>
                <p class="text-base lg:text-lg font-normal opacity-90 mt-4">
                    <?php echo esc_html($description); ?>
                </p>
            </div>
            <?php $i++; endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
global $post;
if ($post && $post->ID === 1463):
?>
<section x-data="{ open: false }" class="relative py-20 px-6 lg:px-0 bg-[#F9F8F6]">
    <div class="max-w-2xl mx-auto">
        <!-- Section header -->
        <div class="mb-10 text-center">
            <h2 class="text-3xl lg:text-4xl font-semibold text-[#1F3131]">
                Competitor Landscape
            </h2>
        </div>

        <!-- Infographic card -->
        <div class="group relative cursor-zoom-in overflow-hidden rounded-[4px] border border-gray-200 shadow-sm transition duration-300 hover:shadow-lg"
            @click="open = true">
            <img src="https://piedmontglobal.com/wp-content/uploads/Competitor.webp" alt=""
                class="w-full h-auto object-contain transition-transform duration-300 group-hover:scale-[1.02]" />

            <!-- Hover overlay -->
            <div
                class="absolute inset-0 bg-black/40 opacity-0 transition duration-300 group-hover:opacity-100 flex items-center justify-center">
                <span class="text-white text-sm font-semibold tracking-wide">
                    View Full Image
                </span>
            </div>
        </div>
    </div>

    <!-- Fullscreen modal -->
    <div x-show="open" x-transition.opacity x-cloak
        class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center px-6"
        @keydown.escape.window="open = false">
        <button @click="open = false" class="absolute top-6 right-6 text-white text-3xl leading-none focus:outline-none"
            aria-label="Close image">
            &times;
        </button>

        <img src="https://piedmontglobal.com/wp-content/uploads/Competitor.webp" alt=""
            class="max-w-full max-h-[90vh] object-contain" @click.stop />
    </div>
</section>
<?php endif; ?>



<?php get_template_part('components/common/faqs-related'); ?>


<section class="bg-[#1F3131] py-28 text-center">
    <div class="max-w-2xl mx-auto px-4">
        <!-- Heading -->
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-[#F9F8F6] tracking-tight">
            Let’s talk about making success inevitable.
        </h2>

        <!-- Subheading -->
        <p class="mt-6 text-base lg:text-lg text-[#F9F8F6] leading-relaxed">
            Looking for a partner to help you solve today’s challenges — and prepare for tomorrow’s opportunities? Let's
            build something lasting—together.
        </p>


        <!-- CTA Buttons -->
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-6">
            <a href="/contact"
                class="bg-[#8DC63F] hover:bg-[#7AB22E] text-[#1F3131] font-bold px-6 py-3 text-base lg:text-lg transition">
                Schedule a consultation
            </a>
            <a href="/resources" class="group flex items-center text-[#F9F8F6] font-medium text-base lg:text-lg
       transition-colors duration-300 hover:text-[#F9F8F6]/80">
                Explore our resources
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</section>

<?php
get_footer();