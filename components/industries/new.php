<?php
get_header();
?>

<section class="relative w-full text-white overflow-hidden"
    style="background-image: url('<?php echo esc_url(get_field('header_image')); ?>'); background-size: cover; background-position: top;">

    <?php
    get_template_part('components/navigation/desktop-sandbox');
    get_template_part('components/navigation/mobile');
    ?>

    <!-- Gradient tint overlay -->
    <div class="absolute inset-0 z-10 header-gradient"></div>

    <div class="w-full pt-32 pb-8 px-4 sm:px-6 lg:px-8 relative z-20 flex items-center min-h-[500px]">
        <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center">

            <!-- Left: Text Content -->
            <div class="flex flex-col justify-center">
                <h1 class="sr-only"><?php the_field('header_title'); ?></h1>
                <span
                    class="text-3xl md:text-4xl lg:text-5xl  text-white font-bold leading-[35px] lg:leading-[48px] mt-4 max-w-xl">
                    <?php the_field('header_title'); ?>
                </span>

                <div class="text-base sm:text-lg text-white lg:text-xl mt-8 max-w-xl leading-relaxed">
                    <?php the_field('header_description'); ?>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-8 mt-8 sm:mt-12">
                    <!-- Existing CTA -->
                    <a href="#"
                        class="js-open-sandbox-modal inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] px-4 py-2 font-bold text-base shadow-md rounded-0 hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-[#1F3131] transition-colors duration-200"
                        role="button" aria-haspopup="dialog" aria-expanded="false">
                        Contact our <?php echo strtolower(get_the_title()); ?> expert
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>
                    </a>

                    <?php if (is_page('government')): ?>

                        <!-- Government page only CTA -->
                        <a href="<?php echo esc_url(home_url('/webinar/simplifying-state-local-and-education-procurement-with-piedmont-global/')); ?>"
                            class="inline-flex justify-center lg:justify-start self-start items-center text-base font-medium group focus:outline-none focus:ring-2 focus:ring-[#D16555] focus:ring-offset-2 transition-colors duration-200"
                            aria-label="Watch webinar">
                            <span class="border-b-2 border-[#D16555] pb-0.5 text-white">Watch webinar</span>
                            <span class="ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-white transform transition-transform duration-300 group-hover:translate-x-1"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </span>
                        </a>
                    <?php endif; ?>
                </div>


                <!-- Trusted By Logos -->
                <?php $header_logos = get_field('header_logos'); ?>
                <div
                    class="<?php echo $header_logos && is_array($header_logos) && count($header_logos) > 0 ? 'mt-12 sm:mt-16' : 'mt-12'; ?>">
                    <?php if ($header_logos && is_array($header_logos) && count($header_logos) > 0): ?>
                        <span class="text-white/80 text-sm  font-medium mb-4 block" data-aos="fade"
                            data-aos-duration="400">Trusted partners</span>
                        <div class="grid grid-cols-5 gap-3 sm:gap-8 max-w-md mx-auto sm:mx-0">
                            <?php
                            $logo_index = 0;
                            foreach ($header_logos as $logo):
                                $logo_url = esc_url($logo['url']);
                                $logo_alt = esc_attr($logo['alt'] ?: 'Trusted partner logo');
                                $delay = 80 + ($logo_index * 60);
                                ?>
                                <div class="flex items-center justify-center" data-aos="zoom-in" data-aos-duration="400"
                                    data-aos-delay="<?php echo $delay; ?>" data-aos-easing="ease-out-cubic">
                                    <img src="<?php echo $logo_url; ?>" alt="<?php echo $logo_alt; ?>" width="96" height="96"
                                        loading="lazy" decoding="async"
                                        class="h-20 w-auto object-contain transition duration-300 ease-in-out grayscale hover:grayscale-0" />
                                </div>
                                <?php
                                $logo_index++;
                            endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Form -->
            <div class="relative w-full lg:mt-0">

            </div>

        </div>
    </div>
</section>


<?php get_template_part('components/industries/january/new-content-top-section'); ?>





<?php if (get_field('why_piedmont_global_new_title')): ?>
    <section class="bg-white lg:py-12" aria-labelledby="why-piedmont-title">
        <div
            class="max-w-7xl border-1 p-6 sm:p-10 border-stone-300 rounded-[4px] mx-auto grid grid-cols-1 lg:grid-cols-5 gap-10 items-center">

            <!-- Left side: Title and Description -->
            <div class="lg:col-span-3 text-left">
                <h2 id="why-piedmont-title"
                    class="text-3xl md:text-4xl lg:text-5xl font-bold leading-[35px] lg:leading-[48px] max-w-full mb-6 mx-auto lg:mx-0">
                    <?php the_field('why_piedmont_global_new_title'); ?>
                </h2>
                <div class="text-base md:text-lg text-[#1F3131]  mb-6 prose mx-auto lg:mx-0">
                    <?php the_field('why_piedmont_global_new_description'); ?>
                </div>

                <!-- Two column row with ticks -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10 mx-auto lg:mx-0">
                    <?php
                    if (have_rows('why_piedmont_global_list')):
                        while (have_rows('why_piedmont_global_list')):
                            the_row();
                            $item = get_sub_field('item');
                            if ($item):
                                ?>
                                <div class="flex items-center gap-3">
                                    <svg class="w-6 h-6 text-[#1F3131] flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-base text-[#5E5D59]"><?php echo esc_html($item); ?></span>
                                </div>
                                <?php
                            endif;
                        endwhile;
                    endif;
                    ?>
                </div>

                <?php
                $why_link = get_field('why_piedmont_global_link_new');
                $link_url = $why_link ? esc_url($why_link) : '/solutions/';
                ?>
                <a href="<?php echo $link_url; ?>"
                    class="mt-10 inline-flex justify-center lg:justify-start self-start items-center text-base font-medium group focus:outline-none focus:ring-2 focus:ring-[#D16555] focus:ring-offset-2 transition-colors duration-200"
                    aria-label="Explore full capabilities - opens contact form">
                    <span class="border-b-2 border-[#D16555] pb-0.5">Explore full capabilities</span>
                    <span class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1"
                        aria-hidden="true">→</span>
                </a>
            </div>

            <!-- Right side: Image -->
            <div class="lg:col-span-2 flex justify-center lg:justify-end">
                <?php
                /* translators: %s: industry name */
                $why_alt = sprintf( esc_attr__( 'Piedmont Global team working with %s clients', 'piedmont-global-wp' ), get_the_title() );
                ?>
                <img src="<?php echo esc_url(get_field('why_piedmont_global_photo_new')); ?>"
                    alt="<?php echo esc_attr( $why_alt ); ?>"
                    class="w-full h-auto lg:h-[456px] object-cover"
                    loading="lazy" decoding="async">
            </div>

        </div>
    </section>
<?php endif; ?>

<?php
// Get first tab key for default active state and count tabs
$first_tab_key = '';
$tab_count = 0;
if (have_rows('tabs')) {
    while (have_rows('tabs')) {
        the_row();
        $tab_count++;
        if ($first_tab_key === '') {
            $first_tab_key = get_sub_field('tab_key');
        }
    }
    reset_rows();
}
?>
<?php if (have_rows('tabs')): ?>
    <section class="max-w-7xl mx-auto pb-12 lg:px-0 px-6">
        <div x-data="{ activeTab: '<?php echo esc_attr($first_tab_key); ?>' }">
            <div>
                <!-- Header -->
                <header class="text-center mb-10">
                    <h2 id="tabbed-section-title"
                        class="text-3xl md:text-4xl lg:text-5xl font-bold leading-[35px] lg:leading-[48px] mb-3 mx-auto lg:mx-0">
                        <?php the_field('tab_section_heading'); ?>
                    </h2>
                    <p class="text-lg text-gray-700 max-w-3xl mx-auto leading-relaxed">
                        <?php the_field('tab_section_description'); ?>
                    </p>
                </header>

                <?php if (have_rows('tabs') && $tab_count > 1): ?>
                    <!-- Tabs -->
                    <div class="flex justify-center mb-10" role="tablist" aria-label="Production Tabs">
                        <div class="inline-flex bg-[#F0EEE6] rounded-lg p-1">
                            <?php while (have_rows('tabs')):
                                the_row();
                                $tab_key = get_sub_field('tab_key');
                                $tab_title = get_sub_field('tab_title');
                                ?>
                                <button @click="activeTab = '<?php echo esc_attr($tab_key); ?>'"
                                    :class="activeTab === '<?php echo esc_attr($tab_key); ?>' ? 'bg-white text-[#1F3131] shadow-sm' : 'text-[#5E5D59] hover:text-[#1F3131]'"
                                    class="px-6 py-2 rounded-md text-sm font-medium transition-all" role="tab"
                                    :aria-selected="activeTab === '<?php echo esc_attr($tab_key); ?>'"
                                    aria-controls="<?php echo esc_attr($tab_key); ?>-production">
                                    <?php echo esc_html($tab_title); ?>
                                </button>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (have_rows('tabs')): ?>

                    <!-- Tab Panels -->
                    <?php reset_rows(); ?>
                    <?php while (have_rows('tabs')):
                        the_row();
                        $tab_key = get_sub_field('tab_key');
                        // Count cards to determine grid columns
                        $cards_data = get_sub_field('cards');
                        $card_count = is_array($cards_data) ? count($cards_data) : 0;
                        $lg_cols = ($card_count > 0 && $card_count < 4) ? $card_count : 4;
                        ?>
                        <div x-show="activeTab === '<?php echo esc_attr($tab_key); ?>'"
                            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                            id="<?php echo esc_attr($tab_key); ?>-production"
                            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-<?php echo esc_attr($lg_cols); ?> gap-8 relative"
                            role="tabpanel" aria-labelledby="tabbed-section-title">

                            <?php if (have_rows('cards')): ?>
                                <?php
                                $card_index = 0;
                                $total_cards = $card_count;
                                ?>
                                <?php while (have_rows('cards')):
                                    the_row();
                                    $card_index++;
                                    // Determine if card needs right border (not last in row)
                                    // For lg: check if it's the last card in the row based on $lg_cols
                                    $is_last_in_row_lg = ($card_index % $lg_cols === 0) || ($card_index === $total_cards);
                                    // For sm (2 columns): check if it's the last card in the row
                                    $is_last_in_row_sm = ($card_index % 2 === 0) || ($card_index === $total_cards);

                                    // Build border classes
                                    $border_classes = '';
                                    // On sm screens (2 cols): show border if not last in row
                                    if (!$is_last_in_row_sm) {
                                        $border_classes .= 'sm:border-r sm:border-[#141413] ';
                                    }
                                    // On lg screens: override sm behavior based on lg columns
                                    if (!$is_last_in_row_lg) {
                                        $border_classes .= 'lg:border-r lg:border-[#141413] ';
                                    } else {
                                        // If last in lg row but not last in sm row, remove the border on lg
                                        $border_classes .= 'lg:border-r-0 ';
                                    }
                                    ?>
                                    <article class="bg-white p-6 relative <?php echo trim($border_classes); ?>">
                                        <?php
                                        $card_icon = get_sub_field('card_icon');
                                        $icon_url = '';
                                        if ($card_icon) {
                                            // Handle both array (ID/Array return) and string (URL return) formats
                                            $icon_url = is_array($card_icon) ? $card_icon['url'] : $card_icon;
                                        }
                                        ?>
                                        <?php if ($icon_url): ?>
                                            <div class="mb-4">
                                                <img src="<?php echo esc_url($icon_url); ?>" alt="" class="w-[36px] h-[36px]">
                                            </div>
                                        <?php endif; ?>
                                        <h3 class="text-xl font-normal text-[#30302E] mb-4">
                                            <?php the_sub_field('card_title'); ?>
                                        </h3>
                                        <?php if (have_rows('card_items')): ?>
                                            <ul class="list-disc list-inside space-y-3 marker:text-[#5E5D59]">
                                                <?php while (have_rows('card_items')):
                                                    the_row(); ?>
                                                    <li class="text-[#5E5D59]">
                                                        <?php the_sub_field('item_text'); ?>
                                                    </li>
                                                <?php endwhile; ?>
                                            </ul>

                                        <?php endif; ?>
                                    </article>
                                <?php endwhile; ?>
                            <?php endif; ?>


                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<div class="pb-12">
	<?php get_template_part('components/industries/january/new-content-bottom-section'); ?>

</div>

<?php
$tabbed_terms = get_field('tabbed_section_cards');
if (!empty($tabbed_terms) && is_array($tabbed_terms)):
    ?>
    <section class="bg-white pt-6 lg:pt-0 lg:pb-12" aria-labelledby="tabbed-section-title">
        <div class="max-w-7xl foundation-gradient mx-auto  p-6 sm:p-10 rounded">

            <h2 id="tabbed-section-title"
                class="text-3xl md:text-4xl lg:text-5xl font-bold leading-[35px] lg:leading-[48px] mb-6 mx-auto lg:mx-0">
                <?php the_field('tabbed_section_heading'); ?>
            </h2>

            <div id="tab-description-text" class="text-base md:text-lg text-[#1F3131] mb-8 lg:mx-0">
                <?php
                // Get initial description from first term
                $terms = get_field('tabbed_section_cards');
                $initial_description = '';
                if (!empty($terms) && is_array($terms)) {
                    $first_term = $terms[0];
                    $first_term_id = is_object($first_term) && isset($first_term->term_id) ? $first_term->term_id : (is_numeric($first_term) ? $first_term : null);
                    if ($first_term_id) {
                        $initial_description = get_field('primary_description', 'term_' . $first_term_id);
                    }
                }
                echo wp_kses_post($initial_description ? $initial_description : '');
                ?>
            </div>

            <div class="w-full pb-10">
                <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">

                    <!-- Tab Buttons -->
                    <div class="space-y-4" role="tablist" aria-label="Communication solutions">
                        <?php
                        $terms = get_field('tabbed_section_cards');

                        // Inline lookup: returns ['youtube_id' => '', 'poster_url' => ''] for a given solution term id.
                        // Reads the per-page `tab_media_overrides` repeater on the current industry post.
                        $find_tab_override = function ($lookup_term_id) {
                            $result = ['youtube_id' => '', 'poster_url' => ''];
                            if (!$lookup_term_id || !have_rows('tab_media_overrides')) {
                                return $result;
                            }
                            while (have_rows('tab_media_overrides')) {
                                the_row();
                                $ovr_solution = get_sub_field('solution');
                                $ovr_id = is_object($ovr_solution) ? (int) $ovr_solution->term_id : (int) $ovr_solution;
                                if ($ovr_id === (int) $lookup_term_id) {
                                    $result['youtube_id'] = trim((string) get_sub_field('youtube_video_id'));
                                    $poster = get_sub_field('poster');
                                    if (is_array($poster) && !empty($poster['url'])) {
                                        $result['poster_url'] = $poster['url'];
                                    }
                                    break;
                                }
                            }
                            reset_rows();
                            return $result;
                        };

                        if (!empty($terms) && is_array($terms)):
                            $first = true;
                            foreach ($terms as $term):
                                // Get term ID for ACF field context
                                $term_id = is_object($term) && isset($term->term_id) ? $term->term_id : (is_numeric($term) ? $term : null);
                                $tagline = $term_id ? get_field('tagline', 'term_' . $term_id) : '';
                                $primary_description_raw = $term_id ? get_field('primary_description', 'term_' . $term_id) : '';
                                $primary_description = $primary_description_raw ? wp_kses_post($primary_description_raw) : '';
                                $primary_description_json = $primary_description ? wp_json_encode($primary_description) : '';
                                $image = $term_id ? get_field('featured_image', 'term_' . $term_id) : null;
                                // Handle ACF image field - can be array, URL string, or ID
                                if (is_array($image) && isset($image['url'])) {
                                    $image_url = $image['url'];
                                } elseif (is_string($image) && !empty($image)) {
                                    $image_url = $image;
                                } elseif (is_numeric($image)) {
                                    $image_url = wp_get_attachment_image_url($image, 'full');
                                } else {
                                    $image_url = '';
                                }
                                $term_link = is_object($term) ? get_term_link($term) : '#';

                                $override = $find_tab_override($term_id);
                                ?>
                                <button data-tab="<?php echo esc_attr(is_object($term) ? $term->slug : ''); ?>"
                                    data-title="<?php echo esc_attr(is_object($term) ? $term->name : ''); ?>"
                                    data-description="<?php echo esc_attr($tagline ? $tagline : ''); ?>"
                                    data-primary-description="<?php echo esc_attr($primary_description_json); ?>"
                                    data-image="<?php echo esc_url($image_url ? $image_url : 'https://pgsandbox.wpenginepowered.com/wp-content/uploads/image-mockup-png-min-scaled.png'); ?>"
                                    data-link="<?php echo esc_url($term_link); ?>"
                                    data-youtube-id="<?php echo esc_attr($override['youtube_id']); ?>"
                                    data-poster="<?php echo esc_attr($override['poster_url']); ?>"
                                    class="tab-button w-full flex items-center gap-3 py-3 px-4 text-left transition text-gray-800 border border-transparent rounded-lg"
                                    role="tab" type="button" aria-selected="<?php echo $first ? 'true' : 'false'; ?>"
                                    aria-controls="tab-panel-<?php echo esc_attr(is_object($term) ? $term->slug : ''); ?>">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/hc/icon.png'); ?>" alt=""
                                        class="w-5 h-5 flex-shrink-0" aria-hidden="true">
                                    <span class="flex-1"><?php echo esc_html(is_object($term) ? $term->name : ''); ?></span>
                                    <span class="ml-auto arrow <?php echo $first ? '' : 'hidden'; ?>" aria-hidden="true">→</span>
                                </button>
                                <?php
                                $first = false;
                            endforeach;
                        endif;
                        ?>

                        <?php
                        $tabbed_link_field = get_field('tabbed_section_link');
                        $tabbed_link_url = '#';
                        if ($tabbed_link_field) {
                            if (is_array($tabbed_link_field) && isset($tabbed_link_field['url'])) {
                                $tabbed_link_url = $tabbed_link_field['url'];
                            } elseif (is_string($tabbed_link_field) && filter_var($tabbed_link_field, FILTER_VALIDATE_URL)) {
                                $tabbed_link_url = $tabbed_link_field;
                            } elseif (is_numeric($tabbed_link_field) || is_object($tabbed_link_field)) {
                                $tabbed_link_url = get_permalink($tabbed_link_field);
                            }
                        }
                        ?>
                        <a href="<?php echo esc_url($tabbed_link_url !== '#' ? $tabbed_link_url : '/solutions/'); ?>"
                            class="mt-10 inline-flex self-start items-center text-base font-medium group focus:outline-none focus:ring-2 focus:ring-[#D16555] focus:ring-offset-2 transition-colors duration-200">
                            <span class="border-b-2 border-[#D16555] pb-0.5">Explore full capabilities</span>
                            <span class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1"
                                aria-hidden="true">→</span>
                        </a>
                    </div>

                    <!-- Tab Panel -->
                    <div class="lg:col-span-2 flex mt-8 lg:mt-0 h-[300px] sm:h-[400px] lg:h-[450px]">
                        <div id="tab-content" class="w-full h-full" role="tabpanel">
                            <?php if (!empty($terms) && is_array($terms)):
                                $first_term = $terms[0];
                                $first_term_id = is_object($first_term) && isset($first_term->term_id) ? $first_term->term_id : (is_numeric($first_term) ? $first_term : null);
                                $tagline = $first_term_id ? get_field('tagline', 'term_' . $first_term_id) : '';
                                $image = $first_term_id ? get_field('featured_image', 'term_' . $first_term_id) : null;
                                // Handle ACF image field - can be array, URL string, or ID
                                if (is_array($image) && isset($image['url'])) {
                                    $image_url = $image['url'];
                                } elseif (is_string($image) && !empty($image)) {
                                    $image_url = $image;
                                } elseif (is_numeric($image)) {
                                    $image_url = wp_get_attachment_image_url($image, 'full');
                                } else {
                                    $image_url = '';
                                }
                                $first_term_name = is_object($first_term) ? $first_term->name : '';
                                $first_term_link = is_object($first_term) ? get_term_link($first_term) : '#';

                                $first_override = $find_tab_override($first_term_id);
                                $first_youtube_id = $first_override['youtube_id'];
                                $first_poster_url = $first_override['poster_url'];
                                ?>

                                <?php if ($first_youtube_id !== ''): ?>
                                    <?php
                                    $poster_for_render = $first_poster_url
                                        ? $first_poster_url
                                        : 'https://i.ytimg.com/vi/' . rawurlencode($first_youtube_id) . '/maxresdefault.jpg';
                                    $a11y_label = $first_term_name ? $first_term_name . ' video' : 'Video';
                                    ?>
                                    <div id="tab-image" class="pg-yt relative w-full h-full"
                                        data-youtube-id="<?php echo esc_attr($first_youtube_id); ?>">
                                        <button type="button"
                                            class="pg-yt__play group relative w-full h-full overflow-hidden rounded-[4px] cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] block"
                                            aria-label="<?php echo esc_attr('Play ' . $a11y_label); ?>">
                                            <img src="<?php echo esc_url($poster_for_render); ?>"
                                                alt="<?php echo esc_attr($first_term_name); ?>"
                                                class="absolute inset-0 w-full h-full object-cover" />
                                            <span class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors"
                                                aria-hidden="true"></span>
                                            <span class="absolute inset-0 flex items-center justify-center" aria-hidden="true">
                                                <svg viewBox="0 0 68 48" class="w-16 h-16 md:w-20 md:h-20 drop-shadow-lg" focusable="false">
                                                    <path d="M66.5 7.7c-.8-3-3.1-5.3-6.1-6.1C55 0 34 0 34 0S13 0 7.6 1.6C4.6 2.4 2.3 4.7 1.5 7.7 0 13.1 0 24 0 24s0 10.9 1.5 16.3c.8 3 3.1 5.3 6.1 6.1C13 48 34 48 34 48s21 0 26.4-1.6c3-.8 5.3-3.1 6.1-6.1C68 34.9 68 24 68 24s0-10.9-1.5-16.3z" fill="#D16555"/>
                                                    <path d="M27 34l18-10L27 14v20z" fill="#fff"/>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                <?php else: ?>
                                    <img id="tab-image"
                                        src="<?php echo esc_url($image_url ? $image_url : 'https://pgsandbox.wpenginepowered.com/wp-content/uploads/image-mockup-png-min-scaled.png'); ?>"
                                        alt="<?php echo esc_attr($first_term_name); ?>"
                                        class="w-full h-full object-cover rounded-[4px] transition-opacity duration-300 ease-in-out" />
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function updateTab(button) {
            if (!button) {
                console.error('updateTab: button is null or undefined');
                return;
            }

            // Update all buttons
            document.querySelectorAll('.tab-button').forEach(btn => {
                const isActive = btn === button;
                const arrow = btn.querySelector('.arrow');

                if (isActive) {
                    btn.classList.add('shadow-lg', 'border-gray-300', 'bg-white', 'medium');
                    btn.classList.remove('book');
                    btn.setAttribute('aria-selected', 'true');
                    if (arrow) {
                        arrow.classList.remove('hidden');
                    }
                } else {
                    btn.classList.remove('shadow-lg', 'border-gray-300', 'bg-white', 'medium');
                    btn.classList.add('book');
                    btn.setAttribute('aria-selected', 'false');
                    if (arrow) {
                        arrow.classList.add('hidden');
                    }
                }
            });

            // Update content
            const tabTitle = document.getElementById('tab-title');
            const tabDescription = document.getElementById('tab-description');
            const tabDescriptionText = document.getElementById('tab-description-text');
            const tabContent = document.getElementById('tab-content');
            const tabLink = document.getElementById('tab-link');

            if (tabTitle && button.dataset.title) {
                tabTitle.textContent = button.dataset.title;
            }

            if (tabDescription && button.dataset.description) {
                tabDescription.textContent = button.dataset.description;
            }

            // Update primary description text
            if (tabDescriptionText && button.dataset.primaryDescription) {
                try {
                    const decodedDescription = JSON.parse(button.dataset.primaryDescription);
                    tabDescriptionText.innerHTML = decodedDescription;
                } catch (e) {
                    // Fallback if JSON parsing fails
                    tabDescriptionText.innerHTML = button.dataset.primaryDescription;
                }
            }

            // Update media: branch between YouTube click-to-play and image
            if (tabContent) {
                const ytId = (button.dataset.youtubeId || '').trim();
                const posterUrl = (button.dataset.poster || '').trim();

                if (ytId) {
                    renderYouTube(tabContent, ytId, posterUrl, button.dataset.title || '');
                } else {
                    renderImage(tabContent, button);
                }
            }

            if (tabLink && button.dataset.link) {
                tabLink.href = button.dataset.link;
            }

            if (tabContent && button.dataset.tab) {
                tabContent.setAttribute('aria-labelledby', button.dataset.tab);
            }
        }

        function escapeAttr(s) {
            return String(s).replace(/[&<>"']/g, function (c) {
                return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
            });
        }

        function renderYouTube(container, videoId, posterUrl, titleText) {
            // Sanitize: YouTube IDs are 11 chars from [A-Za-z0-9_-].
            const safeId = String(videoId).replace(/[^A-Za-z0-9_-]/g, '').slice(0, 11);
            if (!safeId) {
                return;
            }

            const fallbackPoster = 'https://i.ytimg.com/vi/' + encodeURIComponent(safeId) + '/maxresdefault.jpg';
            const poster = posterUrl || fallbackPoster;
            const a11yLabel = (titleText ? titleText : 'Video') + ' video';

            // Wipe existing content (image OR previously-injected iframe — kills audio on switch).
            container.innerHTML = '';

            const wrap = document.createElement('div');
            wrap.id = 'tab-image';
            wrap.className = 'pg-yt relative w-full h-full';
            wrap.dataset.youtubeId = safeId;

            const playBtn = document.createElement('button');
            playBtn.type = 'button';
            playBtn.className = 'pg-yt__play group relative w-full h-full overflow-hidden rounded-[4px] cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] block';
            playBtn.setAttribute('aria-label', 'Play ' + a11yLabel);

            playBtn.innerHTML =
                '<img src="' + escapeAttr(poster) + '" alt="' + escapeAttr(titleText) + '" ' +
                'class="absolute inset-0 w-full h-full object-cover" />' +
                '<span class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors" aria-hidden="true"></span>' +
                '<span class="absolute inset-0 flex items-center justify-center" aria-hidden="true">' +
                    '<svg viewBox="0 0 68 48" class="w-16 h-16 md:w-20 md:h-20 drop-shadow-lg" focusable="false">' +
                        '<path d="M66.5 7.7c-.8-3-3.1-5.3-6.1-6.1C55 0 34 0 34 0S13 0 7.6 1.6C4.6 2.4 2.3 4.7 1.5 7.7 0 13.1 0 24 0 24s0 10.9 1.5 16.3c.8 3 3.1 5.3 6.1 6.1C13 48 34 48 34 48s21 0 26.4-1.6c3-.8 5.3-3.1 6.1-6.1C68 34.9 68 24 68 24s0-10.9-1.5-16.3z" fill="#D16555"/>' +
                        '<path d="M27 34l18-10L27 14v20z" fill="#fff"/>' +
                    '</svg>' +
                '</span>';

            playBtn.addEventListener('click', function () {
                const iframe = document.createElement('iframe');
                iframe.src = 'https://www.youtube-nocookie.com/embed/' + encodeURIComponent(safeId) +
                    '?autoplay=1&rel=0&modestbranding=1&playsinline=1';
                iframe.title = a11yLabel;
                iframe.loading = 'lazy';
                iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
                iframe.setAttribute('allowfullscreen', '');
                iframe.className = 'w-full h-full block rounded-[4px]';
                iframe.style.border = '0';
                wrap.innerHTML = '';
                wrap.appendChild(iframe);
            }, { once: true });

            wrap.appendChild(playBtn);
            container.appendChild(wrap);
        }

        function renderImage(container, button) {
            // If we're switching from a video panel, the existing #tab-image is a <div> wrapper —
            // recreate a fresh <img> so the existing fade/preload logic can target it.
            let tabImage = container.querySelector('#tab-image');
            if (!tabImage || tabImage.tagName !== 'IMG') {
                container.innerHTML = '';
                tabImage = document.createElement('img');
                tabImage.id = 'tab-image';
                tabImage.className = 'w-full h-full object-cover rounded-[4px] transition-opacity duration-300 ease-in-out';
                container.appendChild(tabImage);
            }

            const newImageUrl = button.dataset.image;
            const fallbackImage =
                'https://pgsandbox.wpenginepowered.com/wp-content/uploads/image-mockup-png-min-scaled.png';

            // Use the new image URL if available, otherwise use fallback
            const imageToLoad = newImageUrl && newImageUrl.trim() !== '' ? newImageUrl : fallbackImage;

            // Check if we're switching to a different image
            if (tabImage.src !== imageToLoad && imageToLoad) {
                tabImage.classList.add('opacity-0');

                const img = new Image();
                let imageLoaded = false;

                const applyImage = (src) => {
                    if (imageLoaded) return;
                    imageLoaded = true;
                    setTimeout(() => {
                        tabImage.src = src;
                        if (button.dataset.title) {
                            tabImage.alt = button.dataset.title;
                        }
                        tabImage.classList.remove('opacity-0');
                    }, 150);
                };

                img.onload = () => applyImage(imageToLoad);
                img.onerror = () => applyImage(fallbackImage);
                img.src = imageToLoad;

                if (img.complete) {
                    applyImage(imageToLoad);
                }
            } else if (button.dataset.title) {
                tabImage.alt = button.dataset.title;
            }
        }

        // Attach click handlers
        const tabButtons = document.querySelectorAll('.tab-button');

        if (tabButtons.length === 0) {
            console.warn('No tab buttons found with selector .tab-button');
            return;
        }

        tabButtons.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                updateTab(btn);
            });
        });

        // Attach keyboard handlers
        tabButtons.forEach((btn, index, buttons) => {
            btn.addEventListener('keydown', e => {
                let newIndex;
                if (e.key === 'ArrowDown' || e.key === 'ArrowRight') {
                    e.preventDefault();
                    newIndex = (index + 1) % buttons.length;
                } else if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') {
                    e.preventDefault();
                    newIndex = (index - 1 + buttons.length) % buttons.length;
                } else if (e.key === 'Home') {
                    e.preventDefault();
                    newIndex = 0;
                } else if (e.key === 'End') {
                    e.preventDefault();
                    newIndex = buttons.length - 1;
                }
                if (newIndex !== undefined) {
                    buttons[newIndex].focus();
                    updateTab(buttons[newIndex]);
                }
            });
        });

        // Initialize first tab as active on page load
        if (tabButtons.length > 0) {
            updateTab(tabButtons[0]);
        }
    });
</script>

<?php
$visual_moments = get_field('visual_moment');
if ($visual_moments && is_array($visual_moments) && count($visual_moments) > 0):
    ?>
    <section class="lg:pb-10 mt-10 lg:mt-0" aria-labelledby="visual-moment-title">
        <div class="max-w-7xl mx-auto  px-6 lg:px-0">
            <!-- Title and description -->
            <div class="flex flex-col items-center text-center mb-8">
                <h2 id="visual-moment-title"
                    class="text-3xl md:text-4xl lg:text-5xl font-bold leading-[35px] lg:leading-[48px] max-w-lg mb-2">
                    <?php the_field('visual_moment_title'); ?>
                </h2>
                <div class="text-base text-[#1F3131] prose max-w-6xl mx-auto  mb-3">
                    <?php the_field('visual_moment_description'); ?>
                </div>
            </div>

            <!-- Card -->
            <div class="border border-stone-100 rounded-[4px] lg:p-12 p-6 foundation-gradient">

                <?php
                $visual_moments = get_field('visual_moment');
                if ($visual_moments && is_array($visual_moments)):
                    ?>
                    <div class="owl-carousel visual-moment-carousel"
                         role="region"
                         aria-roledescription="carousel"
                         aria-labelledby="visual-moment-title"
                         tabindex="0"
                         data-pg-carousel-controls="visual-moment">
                        <?php foreach ($visual_moments as $index => $row):
                            $small_title = isset($row['small_title']) ? $row['small_title'] : '';
                            $big_title = isset($row['big_title']) ? $row['big_title'] : '';
                            $content = isset($row['content']) ? $row['content'] : '';
                            $image_url = isset($row['image']) ? $row['image'] : '';
                            $list_rows = isset($row['list']) && is_array($row['list']) ? $row['list'] : [];
                            $explore_url = isset($row['url']) ? $row['url'] : '';
                            ?>
                            <div class="item py-4 lg:py-10 lg:px-4" data-slide-index="<?php echo esc_attr($index); ?>">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10 items-center">
                                    <!-- Left side: Text -->
                                    <div class="lg:col-span-1 text-left">
                                        <?php if ($small_title): ?>
                                            <span
                                                class="text-[#D16555] text-sm md:text-base uppercase font-medium mb-2 md:mb-4 inline-block">
                                                <?php
                                                printf(
                                                    /* translators: 1: stage number, 2: stage title */
                                                    esc_html__('STAGE %1$d • %2$s', 'piedmont-global-wp'),
                                                    ($index + 1),
                                                    esc_html($small_title)
                                                );
                                                ?>
                                            </span>
                                        <?php endif; ?>

                                        <?php if ($big_title): ?>
                                            <h3 class="text-xl md:text-3xl lg:text-5xl max-w-xs font-bold mt-2">
                                                <?php echo esc_html($big_title); ?>
                                            </h3>
                                        <?php endif; ?>

                                        <?php if ($content): ?>
                                            <div class="text-sm md:text-base lg:text-lg text-[#1F3131] max-w-xl mb-4 md:mb-6 prose">
                                                <?php echo wp_kses_post($content); ?>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Features -->
                                        <?php if (!empty($list_rows)): ?>
                                            <div class="grid grid-cols-1 gap-2 md:gap-4 mt-4 md:mt-6 max-w-xl">
                                                <?php foreach ($list_rows as $list_row):
                                                    $item = isset($list_row['item']) ? $list_row['item'] : '';
                                                    if (!$item) {
                                                        continue;
                                                    }
                                                    ?>
                                                    <div class="flex items-center gap-2 md:gap-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.5" stroke="currentColor"
                                                            class="w-5 h-5 md:w-6 md:h-6 text-[#D16555] flex-shrink-0" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>

                                                        <span
                                                            class="text-sm md:text-base text-[#1F3131]"><?php echo esc_html($item); ?></span>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>

                                        <a href="<?php echo esc_url($explore_url ? $explore_url : '/solutions/'); ?>"
                                            class="mt-6 md:mt-8 inline-flex items-center text-sm md:text-base font-medium border-b-2 border-[#D16555] pb-0.5">
                                            Explore full capabilities
                                            <span class="ml-1 text-lg">→</span>
                                        </a>
                                    </div>

                                    <!-- Right side: Image -->
                                    <div class="lg:col-span-1 flex justify-center lg:justify-end">
                                        <?php if ($image_url): ?>
                                            <img src="<?php echo esc_url($image_url); ?>"
                                                alt="<?php echo esc_attr($big_title ? $big_title : 'Visual moment image'); ?>"
                                                class="max-w-full h-[250px] md:h-[350px] lg:h-[430px] object-cover rounded-[4px]">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Navigation and markers -->
                <?php if ($visual_moments && is_array($visual_moments) && count($visual_moments) > 0): ?>
                    <div class="mt-10 md:mt-20">
                        <div class="flex flex-col md:flex-row items-center justify-between">

                            <!-- Markers -->
                            <div class="flex justify-center md:justify-start gap-2 md:gap-4 md:flex-1 flex-wrap">
                                <?php foreach ($visual_moments as $index => $row): ?>
                                    <button type="button"
                                        class="visual-moment-marker w-8 h-8 md:w-10 md:h-10 text-sm md:text-base flex items-center justify-center rounded-full font-semibold transition-colors duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2 <?php echo $index === 0 ? 'active bg-[#98C441] text-[#006155] border border-[#006155]' : 'bg-[#006155] text-white hover:bg-[#98C441] hover:text-[#006155] hover:border hover:border-[#006155]'; ?>"
                                        data-index="<?php echo esc_attr($index); ?>"
                                        aria-label="<?php printf(esc_attr__('Go to step %d', 'piedmont-global-wp'), $index + 1); ?>">
                                        <?php echo esc_html($index + 1); ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>

                            <!-- Navigation buttons -->
                            <div class="flex justify-center md:justify-end gap-2 md:gap-3 md:flex-1 mt-4 md:mt-0">
                                <button id="visual-moment-prev" type="button"
                                    data-pg-carousel-prev="visual-moment"
                                    class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center rounded-full bg-[#006155] text-white hover:bg-[#98C441] hover:text-[#006155] hover:border hover:border-[#006155] transition-colors duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2"
                                    aria-label="<?php esc_attr_e('Previous visual moment', 'piedmont-global-wp'); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-5 h-5" aria-hidden="true" focusable="false">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                    </svg>
                                </button>

                                <button id="visual-moment-playpause" type="button"
                                    data-pg-carousel-playpause="visual-moment"
                                    aria-pressed="false"
                                    class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center rounded-full bg-[#006155] text-white hover:bg-[#98C441] hover:text-[#006155] hover:border hover:border-[#006155] transition-colors duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2"
                                    aria-label="<?php esc_attr_e('Pause visual moment auto-rotation', 'piedmont-global-wp'); ?>"
                                    data-label-pause="<?php esc_attr_e('Pause visual moment auto-rotation', 'piedmont-global-wp'); ?>"
                                    data-label-play="<?php esc_attr_e('Play visual moment auto-rotation', 'piedmont-global-wp'); ?>">
                                    <svg data-pg-icon="pause" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 md:w-5 md:h-5" aria-hidden="true" focusable="false">
                                        <rect x="6" y="5" width="4" height="14" rx="1" />
                                        <rect x="14" y="5" width="4" height="14" rx="1" />
                                    </svg>
                                    <svg data-pg-icon="play" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="hidden w-4 h-4 md:w-5 md:h-5" aria-hidden="true" focusable="false">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                </button>

                                <button id="visual-moment-next" type="button"
                                    data-pg-carousel-next="visual-moment"
                                    class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center rounded-full bg-[#006155] text-white hover:bg-[#98C441] hover:text-[#006155] hover:border hover:border-[#006155] transition-colors duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2"
                                    aria-label="<?php esc_attr_e('Next visual moment', 'piedmont-global-wp'); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-5 h-5" aria-hidden="true" focusable="false">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                </button>
                            </div>

                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (get_field('green_section_subtitle')): ?>
    <section class="relative overflow-hidden py-12 " aria-labelledby="why-piedmont-title-green">

        <!-- Background pattern behind everything -->
        <div class="absolute left-0 right-0 top-1/2 -translate-y-1/2 z-[0] w-full h-[600px] pointer-events-none"
            style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/pattern-4.svg'); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;"
            aria-hidden="true"></div>

        <!-- Main container -->
        <div class="relative z-[2] max-w-7xl mx-3 mb-6 lg:mb-0 border-1 p-6 sm:p-12 lg:p-16 rounded-[4px] lg:mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center"
            style="background-image: linear-gradient(to bottom, #1F3131 50%, #006155 100%), url('<?php echo esc_url(get_template_directory_uri() . '/assets/hc/bg-1.svg'); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">

            <!-- Right-bottom image placed behind text but above gradient -->
            <div class="pointer-events-none absolute bottom-0 right-0 z-[1]">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/footer.png'); ?>" alt=""
                    class="w-[300px] md:w-[420px] h-auto object-contain opacity-80" />
            </div>

            <!-- Right column: text (appears first on mobile) -->
            <div class="lg:col-span-1 order-1 lg:order-2">
                <span
                    class="text-[#8dc63f] text-base lg:text-lg mb-6 lg:mb-10 block"><?php the_field('green_section_title'); ?></span>

                <h2 id="why-piedmont-title-green"
                    class="text-2xl md:text-3xl lg:text-6xl font-bold leading-[30px] md:leading-[35px] lg:leading-[60px] mt-3 lg:mt-5 text-white mb-4 lg:mb-6">
                    <?php the_field('green_section_subtitle'); ?>
                </h2>

                <div
                    class="text-sm md:text-base lg:text-lg text-white book max-w-xl mb-4 lg:mb-6 prose-invert mx-auto lg:mx-0">
                    <?php the_field('green_section_description'); ?>
                </div>

                <a href="#"
                    class="js-open-sandbox-modal inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] px-3 py-2 lg:px-4 font-bold text-sm lg:text-base shadow-md rounded-0 hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-[#1F3131] transition-colors duration-200"
                    role="button" aria-haspopup="dialog" aria-expanded="false">
                    Contact our <?php echo strtolower(get_the_title()); ?> expert
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 lg:size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>

            </div>

            <!-- Left column: image (appears second on mobile) -->
            <div class="lg:col-span-1 flex justify-center order-2 lg:order-1">
                <img src="<?php echo esc_url(get_field('green_section_image')); ?>"
                    alt="<?php the_field('green_section_title'); ?>"
                    class="max-w-full p-6 lg:p-12 lg:scale-125 h-auto object-contain">
            </div>

        </div>
    </section>
<?php endif; ?>

<?php if (have_rows('alternate_green_section_repeater')): ?>
    <section class="relative overflow-hidden lg:pb-12 mt-10 lg:mt-0" aria-labelledby="why-piedmont-title-green">

        <!-- Background pattern behind everything -->
        <div class="absolute left-0 right-0 top-1/2 -translate-y-1/2 z-[0] w-full h-[600px] pointer-events-none"
            style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/pattern-4.svg'); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;"
            aria-hidden="true"></div>

        <!-- Main container -->
        <div class="relative z-[2] max-w-7xl mx-3 mb-6 lg:mb-0 border-1 p-8 sm:p-16 rounded-[4px] lg:mx-auto"
            style="background-image: linear-gradient(to bottom, #1F3131 50%, #006155 100%), url('<?php echo esc_url(get_template_directory_uri() . '/assets/hc/bg-1.svg'); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">

            <!-- Centered Title & Description -->
            <div class="text-center mb-12">
                <h2 id="why-piedmont-title-green"
                    class="text-3xl md:text-4xl lg:text-5xl font-bold leading-[35px] lg:leading-[60px] text-white mb-6">
                    <?php the_field('alternate_green_section_title'); ?>
                </h2>
            </div>

            <!-- Columns: image left, button right -->
            <?php
            // Collect repeater data and images
            $repeater_items = [];
            $repeater_images = [];
            if (have_rows('alternate_green_section_repeater')):
                while (have_rows('alternate_green_section_repeater')):
                    the_row();
                    $repeater_items[] = [
                        'title' => get_sub_field('title'),
                        'description' => get_sub_field('description'),
                        'image' => get_sub_field('image')
                    ];
                    $img = get_sub_field('image');
                    if ($img) {
                        $repeater_images[] = is_array($img) ? $img['url'] : $img;
                    }
                endwhile;
            endif;

            // Get first image from repeater, fallback to featured image
            $section_image = '';
            if (!empty($repeater_images)) {
                $section_image = $repeater_images[0];
            } elseif (has_post_thumbnail()) {
                $section_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
            }
            ?>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left column: image -->
                <div class="flex justify-center h-full">
                    <?php if ($section_image): ?>
                        <img id="alternate-section-image" src="<?php echo esc_url($section_image); ?>"
                            alt="<?php the_field('alternate_green_section_title'); ?>"
                            class="max-w-full p-12 h-full object-cover transition-opacity duration-300"
                            data-images="<?php echo esc_attr(json_encode($repeater_images)); ?>">
                    <?php endif; ?>
                </div>

                <!-- Right column: button -->
                <div class="justify-center lg:justify-start">
                    <div id="items-container" class="space-y-6 pb-1">
                        <?php if (!empty($repeater_items)): ?>
                            <?php $index = 0; ?>
                            <?php foreach ($repeater_items as $item): ?>
                                <button type="button" class="w-full text-left transition-all duration-300 py-3 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] rounded-sm" data-index="<?php echo $index; ?>">
                                    <div class="flex items-start gap-4 mb-2">
                                        <div class="flex flex-col items-center gap-2">
                                            <span
                                                class="item-number text-2xl font-bold transition-colors duration-300 <?php echo $index === 0 ? 'text-[#98C441]' : 'text-[#056C62]/40'; ?>"><?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?></span>
                                            <div class="item-timer w-[4px] h-16 bg-[#056C62]/20 rounded-full overflow-hidden <?php echo $index === 0 ? '' : 'hidden'; ?>"
                                                aria-hidden="true">
                                                <div class="w-full h-full bg-[#98C441] origin-top vertical-timer-fill"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <h3
                                                class="item-title text-xl font-normal transition-colors duration-300 <?php echo $index === 0 ? 'text-white' : 'text-[#056C62]/40'; ?>">
                                                <?php echo esc_html($item['title']); ?>
                                            </h3>
                                            <?php if (!empty($item['description'])): ?>
                                                <div
                                                    class="item-description text-base mt-3 leading-relaxed text-white <?php echo $index === 0 ? '' : 'hidden'; ?>">
                                                    <?php echo esc_html($item['description']); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </button>
                                <?php $index++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <a href="#"
                        class="js-open-sandbox-modal inline-flex mt-10 items-center gap-2 bg-[#98C441] text-[#1F3131] px-4 py-2 font-bold text-base shadow-md rounded-0 hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-[#1F3131] transition-colors duration-200"
                        role="button" aria-haspopup="dialog" aria-expanded="false">
                        Contact our <?php echo strtolower(get_the_title()); ?> expert
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </section>
<?php endif; ?>


<script>
    (function () {
        const container = document.getElementById('items-container');
        if (!container) return;

        const section = container.closest('section');
        const itemElements = container.querySelectorAll('[data-index]');
        const totalItems = itemElements.length;
        const sectionImage = document.getElementById('alternate-section-image');

        // Get images array from data attribute
        let images = [];
        if (sectionImage && sectionImage.dataset.images) {
            try {
                images = JSON.parse(sectionImage.dataset.images);
            } catch (e) {
                images = [];
            }
        }

        const DURATION = 5000;
        let activeIndex = 0;
        let autoPlayTimeout = null;
        let isInitialized = false;
        let isInView = false;

        function updateUI() {
            itemElements.forEach((el, index) => {
                const isActive = index === activeIndex;
                const number = el.querySelector('.item-number');
                const title = el.querySelector('.item-title');
                const description = el.querySelector('.item-description');
                const timer = el.querySelector('.item-timer');
                const timerFill = timer?.querySelector('.vertical-timer-fill');

                // Update number color
                number.className = `item-number text-2xl font-bold transition-colors duration-300 ${isActive ? 'text-[#98C441]' : 'text-[#056C62]/40'
                    }`;

                // Update title color
                title.className = `item-title text-2xl font-semibold transition-colors duration-300 ${isActive ? 'text-white' : 'text-[#056C62]/40'
                    }`;

                // Show/hide description and timer
                if (isActive) {
                    if (description) description.classList.remove('hidden');
                    timer.classList.remove('hidden');

                    // Restart animation - sync with DURATION
                    if (timerFill) {
                        timerFill.style.animation = 'none';
                        void timerFill.offsetHeight; // Force reflow
                        timerFill.style.animation = `verticalTimerFill ${DURATION}ms linear`;
                    }
                } else {
                    if (description) description.classList.add('hidden');
                    timer.classList.add('hidden');
                }
            });

            // Update image based on active index
            if (sectionImage && images.length > 0 && images[activeIndex]) {
                const newSrc = images[activeIndex];
                if (sectionImage.src !== newSrc) {
                    sectionImage.classList.add('opacity-0');
                    setTimeout(() => {
                        sectionImage.src = newSrc;
                        sectionImage.classList.remove('opacity-0');
                    }, 150);
                }
            }
        }

        function scheduleNext() {
            if (!isInView) return;
            stopAutoPlay();
            autoPlayTimeout = setTimeout(() => {
                activeIndex = (activeIndex + 1) % totalItems;
                updateUI();
                scheduleNext();
            }, DURATION);
        }

        function startAutoPlay() {
            if (!isInView) return;
            updateUI();
            scheduleNext();
        }

        function stopAutoPlay() {
            if (autoPlayTimeout) {
                clearTimeout(autoPlayTimeout);
                autoPlayTimeout = null;
            }
        }

        function setActive(index) {
            stopAutoPlay();
            activeIndex = index;
            updateUI();
            scheduleNext();
        }

        function init() {
            if (isInitialized) return;
            isInitialized = true;

            itemElements.forEach((el) => {
                el.addEventListener('click', () => {
                    setActive(parseInt(el.dataset.index, 10));
                });
            });

            updateUI();
        }

        // Intersection Observer to start/stop autoplay based on visibility
        function setupIntersectionObserver() {
            if (!section) return;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    isInView = entry.isIntersecting;
                    if (isInView) {
                        init(); // Initialize on first view
                        startAutoPlay();
                    } else {
                        stopAutoPlay();
                    }
                });
            }, {
                threshold: 0.2, // Trigger when 20% visible
                rootMargin: '0px'
            });

            observer.observe(section);
        }

        // Setup observer when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', setupIntersectionObserver);
        } else {
            setupIntersectionObserver();
        }
    })();
</script>

<?php
global $post;
if ($post && $post->ID === 1476) {
    get_template_part('components/industries/community-care');
}
?>

<?php
global $post;
if ($post && $post->ID === 788):
?>
<section class="w-full bg-white py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">
    <!-- Text Content -->
    <div class="max-w-3xl mx-auto text-center mb-12 lg:mb-16">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#1F3131] mb-6 leading-tight">
        Supporting agencies nationwide
      </h2>
      <p class="text-lg lg:text-xl text-[#1F3131]/80 leading-relaxed">
        Piedmont Global supports state and local agencies across the U.S., combining national scale with localized expertise. Our coverage model ensures agencies can deliver consistent, compliant language access while responding to the unique linguistic and cultural needs of their communities.
      </p>
    </div>

    <!-- Map Image -->
    <div class="relative">
      <figure class="m-0">
        <img
          src="https://piedmontglobal.com/wp-content/uploads/Piedmont-Global-National-Coverage-1.png"
          alt="<?php echo esc_attr__( 'Map of the United States showing Piedmont Global coverage across all 50 states, with regional support hubs serving state and local agencies nationwide.', 'piedmont-global-wp' ); ?>"
          aria-describedby="pg-national-coverage-desc"
          class="w-full max-w-5xl mx-auto h-auto object-contain rounded-lg shadow-lg"
          loading="lazy"
          decoding="async">
        <figcaption id="pg-national-coverage-desc" class="sr-only">
          <?php esc_html_e( 'The map highlights every U.S. state served by Piedmont Global, illustrating that we combine national scale with localized expertise so agencies can deliver consistent, compliant language access while responding to the unique linguistic and cultural needs of their communities.', 'piedmont-global-wp' ); ?>
        </figcaption>
      </figure>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
$related_blogs = get_field('related_blogs');
$has_faqs = have_rows('faqs');
if ($related_blogs || $has_faqs):
    ?>
    <section class="lg:pb-10 pt-5 overflow-hidden" id="related-resources" data-research-paper-trigger="true">
        <?php if ($related_blogs): ?>
            <div
                class="max-w-7xl mx-auto foundation-white relative border-1 border-stone-300  border-b-0  rounded-[4px] py-16 px-10">
                <div class="flex items-center justify-between mb-8">
                    <h2 id="industry-related-resources-heading" class="text-3xl lg:text-4xl font-bold max-w-[150px] lg:max-w-lg">
                        <?php esc_html_e( 'Related resources', 'piedmont-global-wp' ); ?>
                    </h2>
                    <?php
                    if ( function_exists( 'pg_render_carousel_controls' ) ) {
                        pg_render_carousel_controls( [
                            'base_id'      => 'industry-related-resources',
                            'region_label' => __( 'Related resources', 'piedmont-global-wp' ),
                        ] );
                    }
                    ?>
                </div>

                <div class="relative z-30 mb-32 pb-10">
                    <div class="owl-carousel sandbox-news-carousel z-30 pt-6"
                         role="region"
                         aria-roledescription="carousel"
                         aria-labelledby="industry-related-resources-heading"
                         tabindex="0"
                         data-pg-carousel-controls="industry-related-resources">

                        <?php
                        $related_blogs = get_field('related_blogs'); // ACF relationship field
                        if ($related_blogs):
                            foreach ($related_blogs as $post):
                                setup_postdata($post);
                                $industry_thumb_id  = get_post_thumbnail_id();
                                $industry_thumb_alt = $industry_thumb_id ? trim( (string) get_post_meta( $industry_thumb_id, '_wp_attachment_image_alt', true ) ) : '';
                                if ( '' === $industry_thumb_alt ) {
                                    $industry_thumb_alt = get_the_title();
                                }
                                ?>
                                <a href="<?php the_permalink(); ?>"
                                    class="group flex flex-col h-[450px] z-30 shadow-md relative rounded border bg-white border-[#ffffff]/40 transition-transform duration-300 hover:shadow-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2">

                                    <div class="overflow-hidden h-1/2 rounded-t-[4px]">
                                        <?php if (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('full', [
                                                'class'    => 'w-full h-auto object-cover object-top transition-transform duration-500 group-hover:scale-105',
                                                'alt'      => $industry_thumb_alt,
                                                'loading'  => 'lazy',
                                                'decoding' => 'async',
                                            ]); ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="px-6 pb-4 flex flex-col flex-1">
                                        <div class="text-gray-500 text-sm mb-2"><?php echo get_the_date('F j, Y'); ?></div>
                                        <h3 class="text-xl font-semibold text-[#1F3131] mb-2"><?php the_title(); ?></h3>
                                        <div class="flex-1"></div>
                                        <div class="self-start">
                                            <span
                                                class="inline-flex items-center lg:text-base text-sm font-medium border-b-2 border-[#D16555]">
                                                Read More <span class="ml-1 text-lg">→</span>
                                            </span>
                                        </div>
                                    </div>

                                </a>
                                <?php
                            endforeach;
                            wp_reset_postdata();
                        endif;
                        ?>

                    </div>
                </div>


                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/pattern-industries.png'); ?>"
                    class="absolute left-1/2 z-0 -translate-x-1/2 bottom-0 w-full max-w-7xl h-auto bg-repeat object-contain mb-1"
                    alt="">



            </div>
        <?php endif; ?>

        <?php if (have_rows('faqs')): ?>
            <div class="max-w-7xl mx-auto foundation-gradient  pt-16 pb-24 px-10">


                <div class="mb-10 text-center">
                    <h2 id="faq-title"
                        class="text-3xl md:text-4xl lg:text-5xl font-bold leading-[35px] lg:leading-[48px] text-[#1F3131]">
                        Frequently asked questions
                    </h2>
                </div>

                <div class="text-left" x-data="{ active: null }">
                    <?php if (have_rows('faqs')):
                        $index = 1;
                        while (have_rows('faqs')):
                            the_row();
                            $question = get_sub_field('question');
                            $answer = get_sub_field('answer');
                            ?>
                            <div class="py-4 border-b" :class="active === <?php echo $index; ?> ? 'border-black' : 'border-gray-200'">

                                <button @click="active = (active === <?php echo $index; ?> ? null : <?php echo $index; ?>)"
                                    :aria-expanded="(active === <?php echo $index; ?>).toString()"
                                    aria-controls="faq-answer-<?php echo $index; ?>"
                                    class="w-full flex justify-between items-center text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2 rounded-sm">

                                    <span class="font-bold text-lg lg:text-xl text-[#1F3131]">
                                        <?php echo esc_html($question); ?>
                                    </span>

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transform transition-transform duration-200"
                                        :class="active === <?php echo $index; ?> ? 'rotate-180 text-[#1F3131]' : 'text-gray-500'"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">

                                        <path x-show="active !== <?php echo $index; ?>" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 5v14m7-7H5"></path>

                                        <path x-show="active === <?php echo $index; ?>" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M19 12H5"></path>
                                    </svg>
                                </button>

                                <div x-show="active === <?php echo $index; ?>" x-collapse
                                    id="faq-answer-<?php echo $index; ?>"
                                    class="mt-3 text-gray-700 prose text-sm leading-relaxed pb-10">
                                    <?php echo wp_kses_post($answer); ?>
                                </div>
                            </div>

                            <?php $index++; endwhile; endif; ?>
                </div>

            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>










<?php if (get_field('cta_title')): ?>
    <?php
    // Randomly alternate between two background SVGs, never showing the same one twice in a row
    $bg_images = array(
        'BigStatement-Prosperity.svg',
        'agenda.svg'
    );
    $cookie_name = 'cta_bg_last';
    $last_shown = isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : '';

    // Pick the other image, or random if no cookie
    if ($last_shown && in_array($last_shown, $bg_images)) {
        $current_bg = ($last_shown === $bg_images[0]) ? $bg_images[1] : $bg_images[0];
    } else {
        $current_bg = $bg_images[array_rand($bg_images)];
    }

    // Set cookie for next visit (expires in 1 day)
    setcookie($cookie_name, $current_bg, time() + 86400, '/');
    $bg_url = get_template_directory_uri() . '/assets/icons/' . $current_bg;
    ?>
    <section class="relative bg-[#1F3131] pt-12 lg:pt-20 lg:mt-40 mt-0" aria-labelledby="why-piedmont-title">
        <div class="max-w-7xl p-6 sm:p-8 lg:p-12 lg:py-20 mx-3 lg:mx-auto -mt-12 lg:-mt-60 rounded-[14px] prosperity-gradient shadow-sm bg-contain relative z-10"
            style="background-image: url('<?php echo esc_url($bg_url); ?>'); background-size: cover; background-color: #006155;">

            <!-- Grid: Title/Description + Image -->
            <div class="grid grid-cols-1 lg:grid-cols-7 gap-8 items-center">
                <!-- Left side: Title and Description -->
                <div class="lg:col-span-3 text-left relative z-20">
                    <?php
                    $cta_first_button_text = get_field('cta_first_button_text');
                    $cta_first_button_link = get_field('cta_first_button_link');
                    ?>
                    <a href="<?php echo esc_url($cta_first_button_link ? $cta_first_button_link : '/solutions/'); ?>"
                        class="inline-flex items-center text-white text-sm lg:text-base font-medium mb-4 lg:mb-6 bg-[#FFFFFF4D] px-3 py-1.5 lg:px-4 lg:py-2 rounded-[4px]">
                        <span><?php echo esc_html($cta_first_button_text ? $cta_first_button_text : 'Explore full capabilities'); ?></span>
                        <span class="ml-2" aria-hidden="true">→</span>
                    </a>
                    <h2 id="why-piedmont-title"
                        class="text-2xl md:text-3xl lg:text-5xl font-bold leading-[28px] md:leading-[35px] lg:leading-[48px] text-white max-w-md mb-4 lg:mb-6">
                        <?php the_field('cta_title'); ?>
                    </h2>
                    <div class="text-sm md:text-base lg:text-lg text-white max-w-xl mb-4 lg:mb-6 prose-invert">
                        <?php the_field('cta_description'); ?>
                    </div>
                </div>

                <!-- Right side: Image -->
                <div class="lg:col-span-4 flex justify-center relative z-20">
                    <?php
                    /* translators: %s: industry name */
                    $cta_alt = sprintf( esc_attr__( 'Piedmont Global team working with %s clients', 'piedmont-global-wp' ), get_the_title() );
                    ?>
                    <img src="<?php echo esc_url(get_field('cta_image')); ?>"
                        alt="<?php echo esc_attr( $cta_alt ); ?>"
                        class="max-w-full w-full h-[200px] md:h-[300px] lg:h-[395px] object-contain"
                        loading="lazy" decoding="async">
                </div>
            </div>

            <!-- Buttons: Outside the grid -->
            <div class="mt-6 lg:mt-10 flex flex-col md:flex-row gap-4 lg:gap-6 relative z-20">
                <a href="#"
                    class="js-open-sandbox-modal inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] px-3 py-2 lg:px-4 font-bold text-sm lg:text-lg shadow-md rounded-0 hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-[#1F3131] transition-colors duration-200"
                    aria-label="Schedule a consultation - opens contact form">
                    Contact our <?php echo strtolower(get_the_title()); ?> expert
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 lg:size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>

                <a href="<?php echo esc_url(get_field('cta_second_link')); ?>"
                    class="group flex items-center text-[#F9F8F6] font-bold text-sm lg:text-lg transition-colors duration-300 hover:text-[#F9F8F6]/80">
                    <?php
                    $cta_title = get_field('cta_second_title');
                    echo $cta_title ? esc_html($cta_title) : 'Download language access guide';
                    ?>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>

        </div>

    </section>
<?php endif; ?>

<!-- Include Dynamic Research Paper Popup -->
<?php
// Ensure we have the post ID
$current_post_id = get_the_ID();
if (!$current_post_id && isset($GLOBALS['post'])) {
    $current_post_id = $GLOBALS['post']->ID;
}

// Debug: Check what we're working with
if (defined('WP_DEBUG') && WP_DEBUG && defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
    error_log('Research Paper Popup Check - Post ID: ' . $current_post_id);
    error_log('Research Paper Popup Check - Post Type: ' . get_post_type($current_post_id));
    error_log('Research Paper Popup Check - Field value: ' . print_r(get_field('research_paper', $current_post_id), true));
    error_log('Research Paper Popup Check - Function result: ' . (pg_industry_has_research_paper() ? 'TRUE' : 'FALSE'));
}

// Check if this industry has a research paper assigned
if (pg_industry_has_research_paper()):
    $research_paper_id = pg_get_industry_research_paper_id();
    if ($research_paper_id) {
        get_template_part('components/popups/research-paper-dynamic', null, array('post_id' => $research_paper_id));
    } else {
        if (defined('WP_DEBUG') && WP_DEBUG && defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
            error_log('Research Paper Popup - Function returned true but ID is false');
        }
    }
else:
    if (defined('WP_DEBUG') && WP_DEBUG && defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
        error_log('Research Paper Popup - Function returned false. Post ID: ' . $current_post_id);
    }
endif;
?>

<?php
get_footer();
?>