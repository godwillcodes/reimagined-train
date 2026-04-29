<?php
get_header();

$term = get_queried_object(); // Current taxonomy term
$term_key = $term->taxonomy . '_' . $term->term_id;

$featured_image = get_field('featured_image', $term_key);
$tagline = get_field('tagline', $term_key);
$section_title = get_field('section_title', $term_key);
$primary_description = get_field('primary_description', $term_key);
$supporting_description = get_field('supporting_description', $term_key);
$eyebrow_text = get_field('eyebrow_text', $term_key);
$sub_solutions_section_title = get_field('sub_solutions_section_title', $term_key);
$sub_solutions_section_description = get_field('sub_solutions_section_description', $term_key);
$why_piedmont_global_eyebrow = get_field('why_piedmont_global_eyebrow', $term_key);
$why_piedmont_global_section_title = get_field('why_piedmont_global_section_title', $term_key);
$why_piedmont_global_description = get_field('why_piedmont_global_description', $term_key);
$why_piedmont_global_cards = get_field('why_piedmont_global_cards', $term_key);
$industries_section = get_field('industries_section', $term_key); // ACF Relationship field
$non_paged_industries_cards = get_field('non_paged_industries_cards', $term_key); // ACF Repeater fallback
$outcomes_section = get_field('outcomes', $term_key); // Repeater field
?>

<section class="shadow-sm">
    <div class="bg-[#1F3131] pt-8 pb-12">
        <?php
        get_template_part('components/navigation/desktop');
        get_template_part('components/navigation/mobile');
        ?>
    </div>

    <div class="h-[500px] md:h-[400px] lg:h-[554px] bg-cover bg-top relative"
        style="background-image: linear-gradient(180deg, rgba(31,49,49,0.5) 0%, #1F3131 80%), url('<?php echo esc_url($featured_image); ?>');">
        <div class="absolute inset-0 flex items-end">
            <div class="max-w-7xl mx-auto w-full px-10 lg:px-0 pb-4 md:pb-12 lg:pb-12 text-white">
                <h1 class="text-2xl md:text-4xl lg:text-4xl font-bold" data-aos="fade-up" data-aos-delay="200"
                    data-aos-duration="800">
                    <?php echo esc_html($term->name); ?>
                </h1>

                <?php if ($tagline): ?>
                <p class="text-base lg:text-lg my-4 max-w-4xl" data-aos="fade-up" data-aos-delay="400"
                    data-aos-duration="600">
                    <?php echo esc_html($tagline); ?>
                </p>
                <?php endif; ?>

                <a href="/contact" data-aos="fade-up" data-aos-delay="600" data-aos-duration="500"
                    class="inline-block bg-[#98C441] text-[#1F3131] px-5 py-2 mt-4 font-bold text-base shadow-md hover:bg-[#8AB738] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#98C441] transition">
                    Talk to our team
                </a>
            </div>
        </div>
    </div>
</section>

<section class="relative w-full py-20 lg:py-28 foundation-white overflow-hidden shadow-sm">
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-[linear-gradient(to_right,_#006155_0%,_#98C441_50%,_#006155_100%)]"
        aria-hidden="true"></div>

    <div class="absolute inset-0 opacity-[0.05] pointer-events-none"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/pattern-4.svg'); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;"
        aria-hidden="true"></div>

    <div
        class="relative max-w-7xl mx-auto px-8 lg:px-0 grid grid-cols-1 md:grid-cols-12 gap-10 md:gap-12 lg:gap-16 items-start">
        <div class="md:col-span-7" data-aos="fade-up" data-aos-delay="100" data-aos-duration="900"
            data-aos-easing="ease-out-cubic">
            <?php if ($section_title): ?>
            <p class="text-3xl lg:text-4xl font-extrabold leading-tight max-w-4xl mx-auto text-black">
                <?php echo wp_kses_post($section_title); ?>
            </p>
            <?php endif; ?>

            <?php if ($primary_description): ?>
            <div class="prose max-w-3xl">
                <?php echo wp_kses_post($primary_description); ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="md:col-span-5 md:pt-2" data-aos="fade-up" data-aos-delay="400" data-aos-duration="800"
            data-aos-easing="ease-out-cubic">
            <?php if ($supporting_description): ?>
            <div class="prose md:border-l-2 md:border-[#98C441] md:pl-6 lg:pl-8">
                <?php echo wp_kses_post($supporting_description); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="relative py-20 bg-[#F7F7F5]">
    <div class="max-w-7xl mx-auto px-8 lg:px-0 text-center mb-10">
        <?php if ($eyebrow_text): ?>
        <div class="inline-flex items-stretch border border-[#1F3131]/15 overflow-hidden mb-6 mx-auto"
            role="doc-subtitle" data-aos="fade-up" data-aos-delay="50" data-aos-duration="500">
            <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
            <div class="flex items-center gap-[7px] px-3 py-[6px]">
                <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-[#1F3131]/80">
                    <?php echo wp_kses_post($eyebrow_text); ?>
                </span>
            </div>
        </div>
        <?php endif; ?>

        <h3 class="text-3xl lg:text-4xl font-extrabold leading-tight max-w-4xl mx-auto text-[#0F1E1E]"
            data-aos="fade-up" data-aos-delay="100" data-aos-duration="700">
            <?php echo esc_html($sub_solutions_section_title); ?>
        </h3>

        <div class="text-base lg:text-xl text-[#1F3131] max-w-3xl mx-auto mt-4" data-aos="fade-up" data-aos-delay="150"
            data-aos-duration="900">
            <?php echo wp_kses_post($sub_solutions_section_description); ?>
        </div>

    </div>
    <?php
        $args = [
            'post_type'      => 'solutions',
            'tax_query'      => [
                [
                    'taxonomy' => $term->taxonomy,
                    'field'    => 'term_id',
                    'terms'    => $term->term_id,
                ],
            ],
            'posts_per_page' => -1,
        ];

        $query = new WP_Query($args);

        if ($query->have_posts()):
            $posts = $query->posts; // store posts
    ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto px-5 lg:px-0 items-stretch">
        <?php foreach ($posts as $post):
            setup_postdata($post);
            $featured_image = get_the_post_thumbnail_url($post->ID, 'full');
            $solution_tagline = get_field('solution_tagline', $post->ID);
        ?>
        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"
            class="group relative block overflow-hidden rounded-xl shadow-lg h-full min-h-[360px] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2">
            <?php if ($featured_image): ?>
            <img src="<?php echo esc_url($featured_image); ?>"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                alt="<?php echo esc_attr(get_the_title($post->ID)); ?>" loading="lazy" />
            <?php endif; ?>

            <div
                class="relative z-10 h-full bg-gradient-to-b from-black/40 to-black/70 flex flex-col justify-end p-6 transition-all duration-300 group-hover:from-black/50 group-hover:to-black/80">
                <h2 class="text-xl md:text-2xl font-extrabold text-white">
                    <?php echo esc_html(get_the_title($post->ID)); ?>
                </h2>

                <div class="mt-2 text-white text-base md:text-lg max-w-prose">
                    <?php
                        if ($solution_tagline) {
                            echo wp_kses_post($solution_tagline);
                        } else {
                            echo wp_trim_words(get_the_content(null, false, $post->ID), 35, '...');
                        }
                    ?>
                </div>

                <span
                    class="mt-4 inline-block bg-[#98C441] text-[#1F3131] font-bold px-4 py-2 rounded-md text-sm self-start transition-opacity duration-300 opacity-90 group-hover:opacity-100">
                    Read More
                </span>
            </div>
        </a>
        <?php endforeach;
        wp_reset_postdata(); ?>
    </div>
    <?php elseif ( have_rows('non_pages_solutions', $term_key) ): ?>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-7xl mx-auto px-5 lg:px-0">
        <?php while ( have_rows('non_pages_solutions', $term_key) ): the_row();
            $image = get_sub_field('image');
            $title = get_sub_field('title');
            $description = get_sub_field('description');
        ?>
        <div
            class="relative bg-[#ab9dba] w-full mx-auto rounded-[4px] overflow-hidden shadow-sm group cursor-pointer p-8">
            <h2 class="text-xl md:text-xl font-extrabold text-black">
                <?php echo esc_html($title); ?>
            </h2>

            <div class="h-6 md:h-10"></div>

            <div class="mt-2 text-black text-base max-w-prose">
                <?php echo esc_html($description); ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <?php else: ?>
    <p class="text-center mx-auto max-w-7xl px-5 lg:px-0">No solutions or non-pages solutions found.</p>
    <?php endif; ?>
</section>

<?php if ($why_piedmont_global_cards): ?>
<section class="py-24 text-white bg-[linear-gradient(to_bottom,_#1F3131_50%,_#006155_100%)]">
    <div class="max-w-7xl mx-auto px-6 lg:px-0 text-center lg:text-left">
        <?php if ($why_piedmont_global_eyebrow): ?>
        <div class="inline-flex items-stretch border border-[#ffffff15] overflow-hidden mb-6"
            role="doc-subtitle" data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
            <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
            <div class="flex items-center gap-[7px] px-3 py-[6px]">
                <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-white/80">
                    <?php echo esc_html($why_piedmont_global_eyebrow); ?>
                </span>
            </div>
        </div>
        <?php endif; ?>

        <h2 data-aos="fade-up" data-aos-delay="200" data-aos-duration="700"
            class="text-3xl sm:text-4xl md:text-5xl max-w-4xl font-extrabold mb-6 leading-[98%]">
            <?php echo esc_html($why_piedmont_global_section_title); ?>
        </h2>

        <p data-aos="fade-up" data-aos-delay="300" data-aos-duration="600"
            class="text-base sm:text-lg text-gray-300 max-w-2xl lg:mx-0 mb-12">
            <?php echo esc_html($why_piedmont_global_description); ?>
        </p>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <?php 
            $delay = 0;
            foreach ($why_piedmont_global_cards as $card): 
                $delay += 100;  // increment delay for staggered animation
            ?>
            <div class="bg-[#006155] p-6 flex flex-col h-full transition-transform duration-300 ease-in-out hover:scale-[1.03] hover:shadow-lg hover:bg-[#007766]"
                data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>" data-aos-duration="600">
                <?php if (!empty($card['card_title'])): ?>
                <h3 class="font-semibold text-lg lg:text-xl mb-4 text-start w-full">
                    <?php echo esc_html($card['card_title']); ?>
                </h3>
                <?php endif; ?>

                <div class="mt-10"></div>

                <?php if (!empty($card['card_description'])): ?>
                <p class="text-gray-100 text-base  text-start lg:text-lg leading-relaxed">
                    <?php echo esc_html($card['card_description']); ?>
                </p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
<?php endif; ?>

<?php if (!empty($industries_section) || !empty($non_paged_industries_cards)): ?>
<section class="py-20 bg-[#F9F9F6] text-[#1F3131]">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="inline-flex items-stretch border border-[#1F3131]/15 overflow-hidden mb-6"
            role="doc-subtitle" data-aos="fade-up" data-aos-delay="100" data-aos-duration="900">
            <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
            <div class="flex items-center gap-[7px] px-3 py-[6px]">
                <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-[#1F3131]/80">
                    Industries we support
                </span>
            </div>
        </div>

        <h2 data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"
            class="text-3xl sm:text-4xl md:text-5xl max-w-4xl font-extrabold mb-6 leading-[98%]">
            Tailored solutions for regulated, high-impact sectors.
        </h2>

        <?php if (!empty($industries_section)): ?>
        <div class="grid gap-x-24 gap-y-6 sm:grid-cols-2 mt-16">
            <?php
            $industry_delay = 0;
            foreach ($industries_section as $industry):
                    $title = get_the_title($industry);
                    $desc = get_field('industry_tagline', $industry->ID);
                    $industry_delay += 150;
                    ?>
            <a href="<?php echo esc_url(get_permalink($industry->ID)); ?>"
                class="group block border-b border-gray-300 px-4 py-6 transition-colors duration-200 ease-in-out hover:border-[#98C441]"
                data-aos="fade-up" data-aos-delay="<?php echo $industry_delay; ?>" data-aos-duration="600"
                aria-label="<?php echo esc_attr($title . ': ' . $desc); ?>">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <h3
                            class="font-semibold text-lg sm:text-xl text-[#1F3131] transition-colors duration-200 ease-in-out group-hover:text-[#0F2A2A]">
                            <?php echo esc_html($title); ?>
                        </h3>
                        <?php if ($desc): ?>
                        <div
                            class="mt-2 text-base lg:text-lg text-gray-500 transition-colors duration-200 ease-in-out group-hover:text-gray-700">
                            <?php echo wp_kses_post($desc); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/wierd-arrow.svg'); ?>"
                        alt="" aria-hidden="true"
                        class="w-8 h-8 sm:w-10 sm:h-10 flex-shrink-0 transform transition duration-200 ease-in-out group-hover:rotate-45 group-hover:scale-110">
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="grid gap-x-24 gap-y-6 sm:grid-cols-2 mt-16">
            <?php
            $card_delay = 0;
            foreach ($non_paged_industries_cards as $card):
                $card_delay += 150;
                ?>
            <div class="group block border-b border-gray-300 px-4 py-6 transition-colors duration-200 ease-in-out hover:border-[#98C441]"
                data-aos="fade-up" data-aos-delay="<?php echo $card_delay; ?>" data-aos-duration="600"
                aria-label="<?php echo esc_attr($card['title'] . ': ' . wp_strip_all_tags($card['description'])); ?>">
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
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<?php if ($outcomes_section): ?>
<section class="bg-white py-20 lg:py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-16">
            <div class="inline-flex items-stretch border border-[#1F3131]/15 overflow-hidden mb-6 mx-auto"
                role="doc-subtitle" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
                <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
                <div class="flex items-center gap-[7px] px-3 py-[6px]">
                    <span
                        class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-[#1F3131]/80">Outcomes</span>
                </div>
            </div>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-6 leading-[98%] text-[#1F3131]"
                data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                Results you can expect
            </h2>
        </div>

        <?php
        // Modern flexible bento: 3-col grid with featured image as 2x2 anchor.
        // Outcome cards are uniform 1x1 tiles with brand color rotation.
        // Works gracefully for 3-12 outcomes thanks to [grid-auto-flow:dense].
        $bento_variants = [
            'bg-[#1F3131] text-white',
            'bg-[#98C441] text-[#1F3131]',
            'bg-[#006155] text-white',
            'bg-[#F0EEE6] text-[#1F3131] border border-[#1F3131]/10',
        ];
        $featured_image = get_field('featured_image', $term_key);
        ?>

        <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 lg:gap-4 auto-rows-[200px] sm:auto-rows-[220px] lg:auto-rows-[240px] [grid-auto-flow:dense]">
            <?php if ($featured_image): ?>
            <div class="relative overflow-hidden rounded-lg shadow-sm group sm:col-span-2 sm:row-span-2"
                data-aos="fade-up" data-aos-delay="100" data-aos-duration="700">
                <img src="<?php echo esc_url($featured_image); ?>"
                    alt="<?php echo esc_attr($term->name); ?>"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 ease-out motion-safe:group-hover:scale-[1.04]"
                    loading="lazy" decoding="async" />
                <div class="absolute inset-0 bg-gradient-to-t from-[#1F3131]/40 via-transparent to-transparent"
                    aria-hidden="true"></div>
            </div>
            <?php endif; ?>

            <?php
            $i = 0;
            while (have_rows('outcomes', $term_key)): the_row();
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                $variant = $bento_variants[$i % count($bento_variants)];
                $delay = 100 + (($i + 1) * 100);
            ?>
            <div class="<?php echo esc_attr($variant); ?> p-6 flex flex-col justify-between rounded-lg shadow-sm transition-shadow duration-300 motion-safe:hover:shadow-md"
                data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>" data-aos-duration="700">
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
// Service Tiers + How It Works — only on Translation Services term (term_id 46)
if ( $term && (int) $term->term_id === 46 ):
?>

<section class="relative py-16 md:py-20 lg:py-28 bg-white overflow-hidden" aria-labelledby="service-tiers-title">
    <div class="relative max-w-7xl mx-auto px-6 lg:px-0">
        <div class="mb-14 lg:mb-16">
            <div class="inline-flex items-stretch border border-[#1F3131]/15 overflow-hidden mb-6"
                role="doc-subtitle" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
                <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
                <div class="flex items-center gap-[7px] px-3 py-[6px]">
                    <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-[#1F3131]/80">
                        Service Tiers
                    </span>
                </div>
            </div>
            <h2 id="service-tiers-title" data-aos="fade-up" data-aos-delay="200" data-aos-duration="700"
                class="text-3xl sm:text-4xl md:text-4xl max-w-4xl font-extrabold mb-6 leading-[98%] text-[#1F3131]">
                Three review levels, matched to your risk
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-5 lg:gap-8 items-stretch">
            <article class="relative bg-white border border-[#1F3131]/10 rounded-[4px] shadow-sm p-6 md:p-6 lg:p-8 flex flex-col h-full transition-all duration-300 motion-safe:hover:border-[#98C441] motion-safe:hover:shadow-md"
                data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#98C441]/15"
                        aria-hidden="true">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#98C441]"></span>
                    </span>
                    <span class="text-sm font-bold uppercase tracking-[0.12em] text-[#1F3131]/60">Tier 1</span>
                </div>
                <h3 class="text-xl md:text-2xl font-extrabold text-[#1F3131] mb-4">Standard Review</h3>
                <p class="text-base lg:text-lg text-[#1F3131] leading-relaxed mb-6">
                    Professional linguist plus QA score.
                </p>
                <div class="mt-auto pt-6 border-t border-[#1F3131]/10">
                    <p class="text-sm font-bold uppercase tracking-[0.12em] text-[#1F3131]/60 mb-2">Best for</p>
                    <p class="text-base lg:text-lg text-[#1F3131]/80 leading-relaxed">
                        Internal communications, HR materials, training content, and general business documents.
                    </p>
                </div>
            </article>

            <article class="relative bg-white border border-[#1F3131]/10 rounded-[4px] shadow-sm p-6 md:p-6 lg:p-8 flex flex-col h-full transition-all duration-300 motion-safe:hover:border-[#98C441] motion-safe:hover:shadow-md"
                data-aos="fade-up" data-aos-delay="250" data-aos-duration="600">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#98C441]/20"
                        aria-hidden="true">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#98C441]"></span>
                    </span>
                    <span class="text-sm font-bold uppercase tracking-[0.12em] text-[#1F3131]/60">Tier 2</span>
                </div>
                <h3 class="text-xl md:text-2xl font-extrabold text-[#1F3131] mb-4">Technical Review</h3>
                <p class="text-base lg:text-lg text-[#1F3131] leading-relaxed mb-6">
                    Domain SME review, risk-flagged tracking, and full audit trail.
                </p>
                <div class="mt-auto pt-6 border-t border-[#1F3131]/10">
                    <p class="text-sm font-bold uppercase tracking-[0.12em] text-[#1F3131]/60 mb-2">Best for</p>
                    <p class="text-base lg:text-lg text-[#1F3131]/80 leading-relaxed">
                        Clinical documentation, contracts, financial disclosures, and regulated B2B content.
                    </p>
                </div>
            </article>

            <article class="relative bg-white border border-[#1F3131]/10 rounded-[4px] shadow-sm p-6 md:p-6 lg:p-8 flex flex-col h-full transition-all duration-300 motion-safe:hover:border-[#98C441] motion-safe:hover:shadow-md"
                data-aos="fade-up" data-aos-delay="400" data-aos-duration="600">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#98C441]/20"
                        aria-hidden="true">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#98C441]"></span>
                    </span>
                    <span class="text-sm font-bold uppercase tracking-[0.12em] text-[#1F3131]/60">Tier 3</span>
                </div>
                <h3 class="text-xl md:text-2xl font-extrabold text-[#1F3131] mb-4">Regulatory Review</h3>
                <p class="text-base lg:text-lg text-[#1F3131] leading-relaxed mb-6">
                    Clinical, Legal, or Regulatory SME plus ISO 17100 plus certification letter.
                </p>
                <div class="mt-auto pt-6 border-t border-[#1F3131]/10">
                    <p class="text-sm font-bold uppercase tracking-[0.12em] text-[#1F3131]/60 mb-2">Best for</p>
                    <p class="text-base lg:text-lg text-[#1F3131]/80 leading-relaxed">
                        Section 1557 materials, court filings, USCIS submissions, FDA filings, MDR labeling, and CMS-regulated content.
                    </p>
                </div>
            </article>
        </div>

        <div class="relative mt-12 md:mt-14 lg:mt-20" data-aos="fade-up" data-aos-delay="500" data-aos-duration="600">
            <div class="absolute -inset-4 lg:-inset-8 pointer-events-none" aria-hidden="true">
                <div class="absolute top-0 left-[12%] w-56 h-56 md:w-72 md:h-72 bg-[#98C441] rounded-full blur-[100px] md:blur-[110px] opacity-25"></div>
                <div class="absolute bottom-0 right-[18%] w-56 h-56 md:w-72 md:h-72 bg-[#006155] rounded-full blur-[100px] md:blur-[110px] opacity-20"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 md:w-[28rem] h-32 md:h-44 bg-[#D16555] rounded-full blur-[110px] md:blur-[130px] opacity-[0.08]"></div>
            </div>

            <div class="relative bg-white/65 backdrop-blur-xl border border-white rounded-2xl shadow-[0_10px_50px_-12px_rgba(31,49,49,0.18)] p-5 md:p-7 lg:p-10">
                <div class="flex flex-col lg:flex-row lg:items-center gap-6 md:gap-8 lg:gap-10">
                    <div class="flex items-center gap-4 lg:flex-shrink-0">
                        <span class="relative inline-flex items-center justify-center w-11 h-11 md:w-12 md:h-12 flex-shrink-0 rounded-2xl bg-gradient-to-br from-[#98C441] to-[#006155] shadow-lg shadow-[#006155]/20"
                            aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="white" class="w-5 h-5 md:w-6 md:h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        </span>
                        <div class="min-w-0">
                            <p class="text-xs md:text-sm font-bold uppercase tracking-[0.12em] text-[#1F3131]/60 mb-0.5">
                                Included with</p>
                            <p class="text-base lg:text-lg font-extrabold text-[#1F3131] leading-tight">Every tier</p>
                        </div>
                    </div>

                    <div class="hidden lg:block w-px h-16 bg-gradient-to-b from-transparent via-[#1F3131]/20 to-transparent"
                        aria-hidden="true"></div>

                    <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-3 lg:gap-4">
                        <div class="flex items-start gap-3 p-3 md:p-4 rounded-xl bg-white/50 backdrop-blur-sm border border-white/80 transition-colors duration-300 motion-safe:hover:bg-white/90 motion-safe:hover:border-[#98C441]/30">
                            <span class="inline-flex items-center justify-center w-9 h-9 flex-shrink-0 rounded-lg bg-[#98C441]/20 text-[#1F3131]"
                                aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.75" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-bold text-[#1F3131] leading-tight">Translation Memory</p>
                                <p class="text-xs text-[#1F3131]/60 mt-1">Maintained across projects</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3 md:p-4 rounded-xl bg-white/50 backdrop-blur-sm border border-white/80 transition-colors duration-300 motion-safe:hover:bg-white/90 motion-safe:hover:border-[#006155]/30">
                            <span class="inline-flex items-center justify-center w-9 h-9 flex-shrink-0 rounded-lg bg-[#006155]/20 text-[#1F3131]"
                                aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.75" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-bold text-[#1F3131] leading-tight">Glossary updates</p>
                                <p class="text-xs text-[#1F3131]/60 mt-1">On every delivery</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3 md:p-4 rounded-xl bg-white/50 backdrop-blur-sm border border-white/80 transition-colors duration-300 motion-safe:hover:bg-white/90 motion-safe:hover:border-[#D16555]/30">
                            <span class="inline-flex items-center justify-center w-9 h-9 flex-shrink-0 rounded-lg bg-[#D16555]/20 text-[#1F3131]"
                                aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.75" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-bold text-[#1F3131] leading-tight">Secure delivery</p>
                                <p class="text-xs text-[#1F3131]/60 mt-1">SFTP or portal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="relative py-16 md:py-20 lg:py-28 bg-white overflow-hidden" aria-labelledby="how-it-works-title">
    <div class="relative max-w-7xl mx-auto px-6 lg:px-0">
        <div class="mb-14 lg:mb-20">
            <div class="inline-flex items-stretch border border-[#1F3131]/15 overflow-hidden mb-6"
                role="doc-subtitle" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
                <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
                <div class="flex items-center gap-[7px] px-3 py-[6px]">
                    <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-[#1F3131]/80">
                        How It Works
                    </span>
                </div>
            </div>
            <h2 id="how-it-works-title" data-aos="fade-up" data-aos-delay="200" data-aos-duration="700"
                class="text-3xl sm:text-4xl md:text-4xl max-w-4xl font-extrabold mb-6 leading-[98%] text-[#1F3131]">
                AI scale, human accountability, certified delivery
            </h2>
        </div>

        <ol class="relative grid grid-cols-1 lg:grid-cols-3 gap-5 md:gap-6 lg:gap-8">
            <span class="hidden lg:block absolute top-[6rem] left-0 right-0 h-[2px] bg-[linear-gradient(to_right,_transparent_0%,_#98C441_15%,_#98C441_85%,_transparent_100%)] z-0"
                aria-hidden="true"></span>

            <li class="relative z-10 group" data-aos="fade-up" data-aos-delay="100" data-aos-duration="700">
                <div class="relative h-full bg-white border border-[#1F3131]/10 rounded-2xl p-6 md:p-7 lg:p-8 shadow-sm transition-all duration-500 ease-out motion-safe:group-hover:-translate-y-1.5 motion-safe:group-hover:shadow-xl motion-safe:group-hover:border-[#98C441]/40">
                    <div class="flex items-center justify-between mb-5">
                        <span class="text-xs font-bold uppercase tracking-[0.18em] text-[#1F3131]/40">Step 01</span>
                        <span class="relative flex w-2 h-2" aria-hidden="true">
                            <span class="absolute inline-flex w-full h-full rounded-full bg-[#98C441]/50 motion-safe:animate-ping"></span>
                            <span class="relative inline-flex w-2 h-2 rounded-full bg-[#98C441]"></span>
                        </span>
                    </div>

                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-[#98C441] to-[#7BA433] text-[#1F3131] text-lg font-extrabold shadow-lg shadow-[#98C441]/30 mb-6 transition-transform duration-500 ease-out motion-safe:group-hover:rotate-3 motion-safe:group-hover:scale-105"
                        aria-hidden="true">
                        01
                    </div>

                    <h3 class="text-xl md:text-2xl font-extrabold text-[#1F3131] mb-3 leading-snug">
                        AI generates risk scores
                    </h3>
                    <p class="text-base lg:text-lg text-[#1F3131]/80 leading-relaxed">
                        Content submitted via portal or API. AI translation runs at scale. Automated QA scores every segment and assigns a Standard, Technical, or Regulatory risk tier.
                    </p>

                    <div class="mt-6 pt-5 border-t border-[#1F3131]/10 flex items-center gap-2 text-[#1F3131]/60">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                            stroke="currentColor" class="w-5 h-5 flex-shrink-0" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                        </svg>
                        <span class="text-xs font-semibold uppercase tracking-[0.12em]">Automated</span>
                    </div>
                </div>
            </li>

            <li class="relative z-10 group" data-aos="fade-up" data-aos-delay="250" data-aos-duration="700">
                <div class="relative h-full bg-white border border-[#1F3131]/10 rounded-2xl p-6 md:p-7 lg:p-8 shadow-sm transition-all duration-500 ease-out motion-safe:group-hover:-translate-y-1.5 motion-safe:group-hover:shadow-xl motion-safe:group-hover:border-[#98C441]/40">
                    <div class="flex items-center justify-between mb-5">
                        <span class="text-xs font-bold uppercase tracking-[0.18em] text-[#1F3131]/40">Step 02</span>
                        <span class="relative flex w-2 h-2" aria-hidden="true">
                            <span class="absolute inline-flex w-full h-full rounded-full bg-[#98C441]/50 motion-safe:animate-ping"></span>
                            <span class="relative inline-flex w-2 h-2 rounded-full bg-[#98C441]"></span>
                        </span>
                    </div>

                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-[#98C441] to-[#7BA433] text-[#1F3131] text-lg font-extrabold shadow-lg shadow-[#98C441]/30 mb-6 transition-transform duration-500 ease-out motion-safe:group-hover:rotate-3 motion-safe:group-hover:scale-105"
                        aria-hidden="true">
                        02
                    </div>

                    <h3 class="text-xl md:text-2xl font-extrabold text-[#1F3131] mb-3 leading-snug">
                        Human review, matched to risk level
                    </h3>
                    <p class="text-base lg:text-lg text-[#1F3131]/80 leading-relaxed">
                        Professional linguist, domain SME, or Regulatory SME assigned by risk tier. All material changes are tracked and documented with a rationale. No segment bypasses review when risk is flagged.
                    </p>

                    <div class="mt-6 pt-5 border-t border-[#1F3131]/10 flex items-center gap-2 text-[#1F3131]/60">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                            stroke="currentColor" class="w-5 h-5 flex-shrink-0" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                        <span class="text-xs font-semibold uppercase tracking-[0.12em]">Expert reviewed</span>
                    </div>
                </div>
            </li>

            <li class="relative z-10 group" data-aos="fade-up" data-aos-delay="400" data-aos-duration="700">
                <div class="relative h-full bg-white border border-[#1F3131]/10 rounded-2xl p-6 md:p-7 lg:p-8 shadow-sm transition-all duration-500 ease-out motion-safe:group-hover:-translate-y-1.5 motion-safe:group-hover:shadow-xl motion-safe:group-hover:border-[#98C441]/40">
                    <div class="flex items-center justify-between mb-5">
                        <span class="text-xs font-bold uppercase tracking-[0.18em] text-[#1F3131]/40">Step 03</span>
                        <span class="relative flex w-2 h-2" aria-hidden="true">
                            <span class="absolute inline-flex w-full h-full rounded-full bg-[#98C441]/50 motion-safe:animate-ping"></span>
                            <span class="relative inline-flex w-2 h-2 rounded-full bg-[#98C441]"></span>
                        </span>
                    </div>

                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-[#98C441] to-[#7BA433] text-[#1F3131] text-lg font-extrabold shadow-lg shadow-[#98C441]/30 mb-6 transition-transform duration-500 ease-out motion-safe:group-hover:rotate-3 motion-safe:group-hover:scale-105"
                        aria-hidden="true">
                        03
                    </div>

                    <h3 class="text-xl md:text-2xl font-extrabold text-[#1F3131] mb-3 leading-snug">
                        Certified delivery
                    </h3>
                    <p class="text-base lg:text-lg text-[#1F3131]/80 leading-relaxed">
                        Final translation, QA report, full audit trail, and certification letter (when applicable) delivered as one package. Ready for the regulatory file, counsel review, or production.
                    </p>

                    <div class="mt-6 pt-5 border-t border-[#1F3131]/10 flex items-center gap-2 text-[#1F3131]/60">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                            stroke="currentColor" class="w-5 h-5 flex-shrink-0" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                        </svg>
                        <span class="text-xs font-semibold uppercase tracking-[0.12em]">Audit-ready</span>
                    </div>
                </div>
            </li>
        </ol>
    </div>
</section>

<?php
// Compliance categories for term_id 46. Defined inline; can be moved to ACF later.
$compliance_columns = [
    [
        'title' => 'Privacy &amp; data protection',
        'badges' => ['GDPR', 'CCPA', 'HIPAA / BAA'],
    ],
    [
        'title' => 'Healthcare &amp; clinical',
        'badges' => ['Section 1557', 'CMS communications', 'Joint Commission 2026'],
    ],
    [
        'title' => 'Legal &amp; translation',
        'badges' => ['ISO 17100', 'USCIS certified', 'Court-admissible', 'ABA-aligned'],
    ],
    [
        'title' => 'Life sciences &amp; regulated industries',
        'badges' => ['FDA 21 CFR Part 11', 'EU MDR / IVDR', 'GCP / GMP'],
    ],
    [
        'title' => 'AI &amp; security',
        'badges' => ['NIST AI RMF', 'EU AI Act', 'SOC 2 Type II'],
    ],
];
$compliance_total = array_sum(array_map(fn($c) => count($c['badges']), $compliance_columns));
?>

<section class="relative pb-20  bg-white" aria-labelledby="compliance-coverage-title">
    <div class="relative max-w-7xl mx-auto px-6 lg:px-0">

        <div class="border-t border-[#1F3131]/15 pt-8 md:pt-10 mb-12 md:mb-16 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-6 sm:gap-10">
            <div class="max-w-3xl">
                <div class="inline-flex items-stretch border border-[#1F3131]/15 overflow-hidden mb-6"
                    role="doc-subtitle" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
                    <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
                    <div class="flex items-center gap-[7px] px-3 py-[6px]">
                        <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-[#1F3131]/80">
                            Compliance Coverage
                        </span>
                    </div>
                </div>

                <h2 id="compliance-coverage-title" data-aos="fade-up" data-aos-delay="200" data-aos-duration="700"
                    class="text-3xl sm:text-4xl md:text-4xl font-extrabold leading-[98%] text-[#1F3131]">
                    Built for the
                   most regulated
                    industries on earth.
                </h2>
            </div>

            <div class="hidden sm:block flex-shrink-0 sm:text-right" data-aos="fade-up" data-aos-delay="300"
                data-aos-duration="700">
                <span class="block text-5xl md:text-6xl font-extrabold leading-none text-[#1F3131]">
                    <?php echo (int) $compliance_total; ?>
                </span>
                <span class="block mt-3 text-[10px] font-semibold tracking-[.14em] uppercase text-[#1F3131]/50">
                    Active certifications
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-6 lg:gap-x-8">
            <?php foreach ($compliance_columns as $idx => $column):
                $num = str_pad((string) ($idx + 1), 2, '0', STR_PAD_LEFT);
            ?>
            <div class="pt-6 pb-6 border-t border-[#1F3131]/10 lg:border-t-0 lg:pt-0 lg:pb-0 lg:border-l lg:border-[#1F3131]/10 lg:pl-6 lg:first:border-l-0 lg:first:pl-0"
                data-aos="fade-up" data-aos-delay="<?php echo 100 + ($idx * 80); ?>" data-aos-duration="600">

                <div class="flex items-center gap-2 mb-5">
                    <span class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#1F3131]/40 flex-shrink-0">
                        <?php echo esc_html($num); ?>
                    </span>
                    <span class="flex-1 h-px bg-[linear-gradient(to_right,_#1F3131_0%,_transparent_100%)] opacity-20"
                        aria-hidden="true"></span>
                </div>

                <p class="text-sm md:text-base font-bold text-[#1F3131] leading-snug mb-5 min-h-0 md:min-h-[3rem]">
                    <?php echo wp_kses_post($column['title']); ?>
                </p>

                <ul class="flex flex-col gap-2">
                    <?php foreach ($column['badges'] as $badge): ?>
                    <li>
                        <span class="inline-flex items-center gap-2 bg-[#F0EEE6] border border-[#1F3131]/10 rounded px-3 py-1.5 text-xs font-medium text-[#1F3131] transition-all duration-200 motion-safe:hover:-translate-y-0.5 motion-safe:hover:bg-[#E8E7DE] motion-safe:hover:border-[#1F3131]/20">
                            <span class="inline-flex items-center justify-center w-3.5 h-3.5 rounded-full bg-[#98C441] flex-shrink-0"
                                aria-hidden="true">
                                <svg width="8" height="6" viewBox="0 0 8 6" fill="none">
                                    <path d="M1 3l2 2 4-4" stroke="#1F3131" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <?php echo esc_html($badge); ?>
                        </span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-12 md:mt-16 pt-8 border-t border-[#1F3131]/15 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
            <p class="text-sm md:text-base text-[#1F3131]/60 leading-relaxed max-w-xl">
                All certifications maintained continuously. 
            </p>
            <a href="/contact"
                class="group inline-flex items-center gap-2 text-xs font-semibold tracking-[0.12em] uppercase text-[#1F3131] hover:text-[#006155] transition-colors duration-200 whitespace-nowrap focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#98C441]">
               Schedule a consultation
                <svg width="14" height="14" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"
                    class="transition-transform duration-200 motion-safe:group-hover:translate-x-1" aria-hidden="true">
                    <path d="M2 6h8M6 2l4 4-4 4" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </div>
</section>

<?php endif; ?>


<?php if( have_rows('faqs', $term_key) ): ?>
<section class="py-20 bg-[#F9F8F6]">
    <div class="max-w-4xl mx-auto px-6 text-center" x-data="{ active: null }">
        <div class="mb-10">
            <div
                class="inline-flex items-center gap-2 rounded-full bg-[#1f3131] px-4 py-2 text-sm font-semibold text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                FAQ
            </div>
            <h2 class="mt-4 text-3xl md:text-3xl font-bold text-gray-900">Frequently asked questions</h2>
        </div>

        <div class="divide-y divide-gray-200 text-left">
            <?php $i = 0; while( have_rows('faqs', $term_key) ): the_row(); $i++; 
                $question = get_sub_field('question');
                $answer = get_sub_field('answer');
            ?>
            <div class="py-4">
                <button @click="active === <?= $i ?> ? active = null : active = <?= $i ?>"
                    :aria-expanded="(active === <?= $i ?>).toString()"
                    aria-controls="sol-faq-panel-<?= $i ?>"
                    class="w-full flex justify-between items-center text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2 rounded-sm">
                    <span class="font-bold text-gray-900 text-lg lg:text-xl"
                        :class="{ 'text-[#1F3131]': active === <?= $i ?> }">
                        <?php echo esc_html($question); ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-gray-500 transform transition-transform duration-200"
                        :class="{ 'rotate-180 text-[#1F3131]': active === <?= $i ?> }" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path x-show="active !== <?= $i ?>" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M12 5v14m7-7H5" />
                        <path x-show="active === <?= $i ?>" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M19 12H5" />
                    </svg>
                </button>

                <div x-show="active === <?= $i ?>" x-collapse
                    id="sol-faq-panel-<?= $i ?>"
                    class="mt-3 text-gray-700 prose text-base leading-relaxed">
                    <?php echo wp_kses_post($answer); ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php
$related_blogs = get_field('related_blogs', $term_key);
if ($related_blogs):
    global $post;
?>
<section class="bg-white py-20" aria-labelledby="related-resources-heading">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-12">
            <h2 id="related-resources-heading" class="text-2xl md:text-3xl font-bold text-gray-900">
                <?php esc_html_e( 'Related resources', 'piedmontglobal' ); ?>
            </h2>
            <?php
            if ( function_exists( 'pg_render_carousel_controls' ) ) {
                pg_render_carousel_controls( [
                    'base_id'      => 'related-resources',
                    'region_label' => __( 'Related resources', 'piedmontglobal' ),
                ] );
            }
            ?>
        </div>

        <div class="relative">
            <div class="owl-carousel related-blogs-carousel"
                role="region"
                aria-roledescription="carousel"
                aria-labelledby="related-resources-heading"
                tabindex="0"
                data-pg-carousel-controls="related-resources">
            <?php foreach ($related_blogs as $post): setup_postdata($post);
                $thumb_id  = get_post_thumbnail_id();
                $thumb_alt = $thumb_id ? trim( (string) get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ) : '';
                if ( '' === $thumb_alt ) {
                    $thumb_alt = get_the_title();
                }
            ?>
            <a href="<?php the_permalink(); ?>"
                class="group flex flex-col h-full shadow-md relative rounded-lg border bg-white border-gray-200 transition-all duration-300 hover:shadow-xl hover:border-stone-300/30 mx-3 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2">

                <div class="overflow-hidden rounded-t-lg">
                    <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('full', [
                        'class'    => 'w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105',
                        'alt'      => esc_attr( $thumb_alt ),
                        'loading'  => 'lazy',
                        'decoding' => 'async',
                    ]); ?>
                    <?php endif; ?>
                </div>

                <div class="p-6 flex flex-col flex-1 min-h-[230px]">
                    <div class="flex items-center gap-2 text-gray-500 text-sm mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></span>
                    </div>
                    <h3 class="text-xl font-semibold text-[#1F3131] mb-3 flex-grow"><?php the_title(); ?></h3>
                    <div class="mt-auto pt-4">
                        <span
                            class="inline-flex items-center text-sm font-semibold text-[#D16555] group-hover:gap-2 transition-all duration-300">
                            <?php esc_html_e( 'Read More', 'piedmontglobal' ); ?>
                            <svg class="w-5 h-5 ml-1 transform group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
            <?php endforeach; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if ( $term && (int) $term->term_id === 46 ): ?>
<section id="cta-section" class="bg-[#1F3131] pt-20 md:pt-20 px-6 lg:px-0">
    <div class="max-w-2xl mx-auto text-center">
        <div class="inline-flex items-stretch border border-[#ffffff15] overflow-hidden mb-6 mx-auto"
            role="doc-subtitle" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
            <div class="w-[3px] bg-[#98C441] self-stretch flex-shrink-0"></div>
            <div class="flex items-center gap-[7px] px-3 py-[6px]">
                <span class="text-[10px] font-semibold tracking-[.11em] uppercase leading-none text-white/80">
                    Next Step
                </span>
            </div>
        </div>

        <h2 class="text-3xl sm:text-4xl md:text-5xl text-white font-extrabold mb-4 leading-[98%]"
            data-aos="fade-up" data-aos-delay="200" data-aos-duration="700">
            Tell us which content lives in your
            <span class="text-[#98C441]">highest-risk pile</span>.
        </h2>

        <p class="text-white/80 mb-0 mt-5 text-base md:text-lg leading-relaxed"
            data-aos="fade-up" data-aos-delay="300" data-aos-duration="700">
            We will show you what an ARIA audit trail would look like for that specific workflow.
        </p>

        <div class="hs-form-frame" data-region="na1" data-form-id="65036f60-3b0e-4b86-8a02-dc0281c542b2"
            data-portal-id="22423917" data-cookie-consent="true"></div>
    </div>
</section>

<script>
(function() {
    const ctaSection = document.getElementById('cta-section');
    if (!ctaSection) return;

    const observerOptions = {
        root: null,
        rootMargin: '100px',
        threshold: 0
    };

    function loadHubSpotScript() {
        if (window.__hsFormLoaded) return;
        const script = document.createElement('script');
        script.src = 'https://js.hsforms.net/forms/embed/22423917.js';
        script.defer = true;
        document.body.appendChild(script);
        window.__hsFormLoaded = true;
    }

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    loadHubSpotScript();
                    obs.disconnect();
                }
            });
        }, observerOptions);

        observer.observe(ctaSection);
    } else {
        loadHubSpotScript();
    }
})();
</script>
<?php else: ?>
<?php get_template_part( 'components/common/cta' ); ?>
<?php endif; ?>


<?php get_footer(); ?>