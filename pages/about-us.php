<?php
/**
 * Template Name: About Us
 * Description: 
 */
get_header();
?>
<main id="maincontent">
<?php if (get_the_ID() == 274): ?>
<header class="shadow-sm relative bg-cover bg-no-repeat bg-bottom" role="banner"
    style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/3.svg'); ?>');">
    <div class="bg-[#1F3131] pt-4 sm:pt-6 pb-6 sm:pb-8 md:pt-8 md:pb-12">
        <nav aria-label="Primary desktop navigation" class="hidden md:block">
            <?php get_template_part('components/navigation/desktop'); ?>
        </nav>
        <nav aria-label="Primary mobile navigation" class="block md:hidden">
            <?php get_template_part('components/navigation/mobile'); ?>
        </nav>
    </div>

    <div class="relative">
        <?php if (get_field('primary_page_image') || get_field('secondary_page_image')): ?>
        <div class="relative z-10 flex items-center">
            <div class="max-w-6xl mx-auto w-full px-4 sm:px-6 md:px-10 lg:px-0 text-white py-24 lg:py-24">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10 items-center about-header lg:mt-6 lg:mb-48">
                    <div>
                        <div class="text-3xl  lg:text-6xl font-bold leading-tight">
                            <?php echo wp_kses_post(get_field('primary_page_title')); ?>
                        </div>
                    </div>
                    <div class="hidden lg:flex justify-center">
                        <?php if (get_field('primary_page_image')) : ?>
                        <img src="<?php the_field('primary_page_image'); ?>"
                            alt="<?php echo esc_attr(get_bloginfo('name')); ?> team"
                            width="400" height="200"
                            loading="lazy"
                            decoding="async"
                            class="object-cover w-full h-40 sm:h-48 md:h-[200px] object-top max-w-full" />
                        <?php endif; ?>
                    </div>

                    <div class="hidden lg:flex justify-center">
                        <?php if (get_field('secondary_page_image')) : ?>
                        <img src="<?php the_field('secondary_page_image'); ?>"
                            alt="<?php echo esc_attr(get_bloginfo('name')); ?> global operations"
                            width="400" height="200"
                            loading="lazy"
                            decoding="async"
                            class="object-cover w-full h-40 sm:h-48 md:h-[200px] object-top max-w-full" />
                        <?php endif; ?>
                    </div>
                    <div>
                        <div class="text-3xl lg:text-6xl font-bold leading-tight">
                            <?php echo wp_kses_post(get_field('secondary_page_title')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</header>
<?php else: ?>


<section class="shadow-sm">
    <!-- Navigation wrapper: consistent vertical rhythm -->
    <div class="bg-[#1F3131] pt-4 sm:pt-6 md:pt-8 pb-4 sm:pb-6">
        <nav aria-label="Primary desktop navigation" class="hidden md:block">
            <?php get_template_part('components/navigation/desktop'); ?>
        </nav>
        <nav aria-label="Primary mobile navigation" class="block md:hidden">
            <?php get_template_part('components/navigation/mobile'); ?>
        </nav>
    </div>

    <!-- Hero -->
    <div
        class="relative bg-cover bg-center"
        style="background-image: linear-gradient(180deg, rgba(31,49,49,0.5) 0%, #1F3131 80%), url('<?php echo esc_url(get_field('primary_page_image')); ?>');"
    >
        <!-- Overlay + spacing handled via padding, not height -->
        <div class="absolute inset-0"></div>

        <div class="relative max-w-7xl mx-auto px-6 sm:px-10 lg:px-0 pt-12 sm:pt-16 md:pt-20 pb-10 md:pb-14 text-white">
            <h1 class="text-2xl md:text-4xl lg:text-4xl font-bold max-w-4xl">
                <?php echo wp_kses_post(get_the_title()); ?>
            </h1>

            <div class="mt-4 prose prose-invert max-w-4xl">
                <?php echo wp_kses_post(get_field('primary_page_title')); ?>
            </div>

            <div class="mt-8">
                <a
                    href="/contact"
                    class="inline-block bg-[#98C441] text-[#1F3131] px-5 py-2 font-bold text-base shadow-md hover:bg-[#8AB738] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#98C441] transition"
                >
                    Request demo
                </a>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>


<?php if (get_field('introduction_title') || get_field('introduction_content_section_1')): ?>
<section class="py-12 md:py-20 bg-[#F9F8F6]">
    <div class="max-w-7xl mx-auto w-full px-6 md:px-10 lg:px-0 text-[#1F3131]">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">
            <!-- Row 1 -->
            <div>
                <h2 class="text-3xl sm:text-5xl md:text-5xl font-bold" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out">
                    <?php echo wp_kses_post(get_field('introduction_title')); ?>
                </h2>
            </div>
            <div class="prose text-lg lg:text-2xl font-normal space-y-4" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out" data-aos-delay="100">
                <?php echo wp_kses_post(get_field('introduction_content_section_1')); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (get_field('introduction_content_section_2') || get_field('mohameds_image')): ?>
<section class="pb-12 md:pb-10 bg-[#F9F8F6]">
    <div class="max-w-7xl mx-auto w-full px-6 md:px-10 lg:px-0 text-black">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-start">

            <!-- Sticky Content -->
            <div class="relative" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out">
                <div class="sticky top-24">
                    <div class="prose text-lg lg:text-2xl font-normal space-y-4">
                        <?php echo wp_kses_post(get_field('introduction_content_section_2')); ?>
                    </div>
                </div>
            </div>

            <!-- Scrollable Image -->
            <div data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out" data-aos-delay="150">
                <?php if (get_field('mohameds_image')): ?>
                <img src="<?php echo esc_url(get_field('mohameds_image')); ?>" 
                     alt="<?php echo esc_attr(get_field('introduction_title') ?: 'About Piedmont Global'); ?>"
                     width="600" height="500"
                     loading="lazy"
                     decoding="async"
                     class="shadow-md object-cover w-full max-h-[500px] sm:max-h-[500px]">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (get_field('video_id')): ?>
<section class="py-10 lg:py-40 bg-[#F9F8F6]" aria-labelledby="aboutus-video-heading">
    <div class="text-center max-w-4xl mx-auto px-6 md:px-10 lg:px-0">
        <p class="text-lg font-medium text-gray-700 mb-6"><?php echo esc_html(get_field('video_title')); ?></p>
        <h2 id="aboutus-video-heading" class="text-4xl md:text-5xl font-bold text-[#1F3131] [&_*]:!text-[#1F3131]">
            <?php echo esc_html( get_field('animated_text') ?: 'Making cross-cultural operations easier, smarter, and more human.' ); ?>
        </h2>
       <div class="max-3xl mx-auto">
       <?php
       $video_iframe_title = get_field('video_title');
       if ( ! $video_iframe_title ) {
           /* translators: %s: site name */
           $video_iframe_title = sprintf( __( '%s — About video', 'piedmontglobal' ), get_bloginfo( 'name' ) );
       }
       ?>
       <iframe
                class=" w-full h-[400px] pt-8 rounded-[4px] border-gray-300"
                src="https://www.youtube.com/embed/<?php echo esc_attr(get_field('video_id')); ?>"
                title="<?php echo esc_attr( $video_iframe_title ); ?>"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
       </div>

        <?php
        $video_transcript = get_field( 'video_transcript' );
        if ( $video_transcript ) :
        ?>
        <details class="mt-6 text-left bg-white border border-stone-200 rounded-[4px] p-4 md:p-6">
            <summary class="cursor-pointer text-base md:text-lg font-medium text-[#1F3131] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2">
                <?php esc_html_e( 'Read video transcript and audio description', 'piedmont-global-wp' ); ?>
            </summary>
            <div class="prose max-w-none mt-4 text-[#1F3131]">
                <?php echo wp_kses_post( $video_transcript ); ?>
            </div>
        </details>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<?php if (get_field('call_to_action_image')): ?>
<section class="pb-12 md:pb-20 bg-[#F9F8F6]">
    <div class="max-w-7xl mx-auto w-full px-6 md:px-10 lg:px-0 text-black">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-20 md:gap-32 items-center">
            <div data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out">
                <img src="<?php echo esc_url(get_field('call_to_action_image')); ?>" 
                     alt="<?php echo esc_attr(get_field('call_to_action_title') ?: 'Piedmont Global solutions'); ?>"
                     width="600" height="500"
                     loading="lazy"
                     decoding="async"
                     class="shadow-md object-cover object-top-[-30px] w-full max-h-[300px] lg:max-h-[500px]">
            </div>
            <!-- Row 1 -->
            <div data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out" data-aos-delay="100">
                <p class="text-lg font-medium text-gray-700 mb-6">
                    <?php echo wp_kses_post(get_field('call_to_action_subtitle')); ?></p>

                <h2 class="text-3xl md:text-5xl max-w-md font-bold">
                    <?php echo wp_kses_post(get_field('call_to_action_title')); ?></h2>

            </div>

        </div>
    </div>
</section>
<?php endif; ?>

<?php if( have_rows('green_benefits_card_repeater') ): ?>
<section class="pb-12 md:pb-20 px-6 lg:px-0 bg-[#F9F8F6]" aria-labelledby="aboutus-our-solutions-heading">
    <h2 id="aboutus-our-solutions-heading" class="text-xl font-medium text-center text-black mb-6">
        <?php esc_html_e( 'Our solutions create', 'piedmont-global-wp' ); ?>
    </h2>

    <div class="max-w-7xl mx-auto">
        <?php
        if ( function_exists( 'pg_render_carousel_controls' ) ) {
            pg_render_carousel_controls( [
                'base_id'      => 'aboutus-our-solutions',
                'region_label' => __( 'Our solutions', 'piedmont-global-wp' ),
            ] );
        }
        ?>
    </div>

    <!-- //repeatable cards -->
    <div class="aboutus-carousel owl-carousel owl-theme relative"
         role="region"
         aria-roledescription="carousel"
         aria-labelledby="aboutus-our-solutions-heading"
         tabindex="0"
         data-pg-carousel-controls="aboutus-our-solutions"
         style="
        mask: linear-gradient(to right, 
            transparent 0%, 
            black 5%, 
            black 95%, 
            transparent 100%
        );
        -webkit-mask: linear-gradient(to right, 
            transparent 0%, 
            black 5%, 
            black 95%, 
            transparent 100%
        );
    ">
        <?php $card_index = 0; ?>
        <?php while( have_rows('green_benefits_card_repeater') ): the_row(); ?>
            <?php 
                $icon = get_sub_field('icon');
                $title = get_sub_field('title');
                $description = get_sub_field('description');
            ?>

            <!-- Card -->
            <div class="item group bg-[#006155] p-6 text-[#F9F8F6] flex flex-col items-start h-full
                        transition-all duration-500 ease-out 
                        hover:-translate-y-2 hover:bg-[#037a68]"
                 data-aos="fade-up" 
                 data-aos-duration="600" 
                 data-aos-easing="ease-out-cubic" 
                 data-aos-delay="<?php echo $card_index * 100; ?>">
                 
                <div class="mb-6" aria-hidden="true">
                    <?php if($icon): ?>
                        <img src="<?php echo esc_url($icon); ?>" 
                             alt="<?php echo esc_attr($title); ?> icon"
                             width="32" height="32"
                             loading="lazy"
                             decoding="async"
                             class="w-8 h-8 object-contain transition-transform duration-500 group-hover:scale-110">
                    <?php endif; ?>
                </div>

                <?php if($title): ?>
                    <h3 class="text-2xl font-semibold mb-4"><?php echo esc_html($title); ?></h3>
                <?php endif; ?>

                <div class="h-48" aria-hidden="true"></div>

                <?php if($description): ?>
                    <p class="text-lg opacity-90 max-w-sm transition-opacity duration-500 group-hover:opacity-100 mt-auto">
                        <?php echo esc_html($description); ?>
                    </p>
                <?php endif; ?>
            </div>
            <?php $card_index++; ?>
        <?php endwhile; ?>
    </div>
</section>
<?php endif; ?>


<?php if (get_field('gradient_title')): ?>
<section style="background: linear-gradient(to bottom, #F9F8F6 0%, #F7F7F5 50%, #98C44180 100%);"
    aria-labelledby="about-gradient-title">
    <div class="text-center py-40 max-w-2xl mx-auto">
        <p class="text-lg font-medium text-center text-gray-700 mb-6">
            <?php echo wp_kses_post(get_field('gradient_subtitle')); ?></p>
        <h2 id="about-gradient-title" class="text-xl md:text-5xl font-bold"><?php echo wp_kses_post(get_field('gradient_title')); ?></h2>

        <div class="mt-8">
            <a href="/solutions/" 
               class="inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] px-4 py-2 font-bold text-base shadow-md rounded-0 hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-transparent transition-colors duration-200">
                Explore our solutions
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if( have_rows('bentobox_repeater') ): ?>
<section class="bg-[#1F3131] py-24 px-6 lg:px-12">
    <div class="max-w-7xl mx-auto">
        <!-- Heading -->
        <div class="text-center mb-12">
            <h2 class="text-5xl font-bold text-white mb-2"><?php echo wp_kses_post(get_field('bentobox_title')); ?></h2>
            <div class="text-gray-300 mt-4 text-lg max-w-2xl mx-auto">
                <?php echo wp_kses_post(get_field('bentobox_description')); ?>
            </div>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php 
                $counter = 0;
                while ( have_rows('bentobox_repeater') ) : the_row();
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                    $image = get_sub_field('image'); // expected array with url
                    $image_url = $image ? (is_array($image) && isset($image['url']) ? $image['url'] : $image) : '';

                    if ( $counter % 3 == 0 ) : 
                // First item: Tall card with background image, overlay, text block
                ?>
            <div class="md:row-span-2 relative overflow-hidden shadow-lg rounded-[4px] h-96 md:h-auto" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out" data-aos-delay="<?php echo $counter * 100; ?>"
                style="background-image: url('<?php echo esc_url($image_url); ?>'); background-size: cover; background-position: center;">
                <div class="absolute inset-0 bg-black/30 rounded-[4px]"></div>
                <div class="relative z-10 flex flex-col justify-end h-full w-[65%]">
                    <div class="bg-[#006155] p-8 flex flex-col justify-between text-[#F9F8F6] shadow-lg  min-h-56">
                        <h3 class="text-2xl font-bold"><?php echo esc_html($title); ?></h3>
                        <p class="text-lg max-w-[280px] leading-relaxed"><?php echo esc_html($description); ?></p>
                    </div>

                </div>
            </div>
            <?php elseif ( $counter % 3 == 1 ): 
                // Second item: Card (text) on left, image block on right; actually, for grid formatting, output card here
                ?>
            <div class="bg-[#DFDAD4] p-8 flex flex-col justify-between text-[#1F3131] shadow-lg rounded-[4px] min-h-48" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out" data-aos-delay="<?php echo $counter * 100; ?>">
                <h3 class="text-2xl font-bold"><?php echo esc_html($title); ?></h3>
                <p class="text-lg max-w-[280px] leading-relaxed"><?php echo esc_html($description); ?></p>
            </div>

            <div class="relative overflow-hidden shadow-lg rounded-[4px] min-h-48" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out" data-aos-delay="<?php echo ($counter + 1) * 100; ?>">
                <img src="<?php echo esc_url($image_url); ?>" 
                     alt="<?php echo esc_attr($title); ?>"
                     width="400" height="300"
                     loading="lazy"
                     decoding="async"
                     class="w-full h-[300px] object-cover transition-transform duration-500 hover:scale-105">
                <div class="absolute inset-0 bg-black/10 rounded-2xl"></div>
            </div>

            <?php elseif ( $counter % 3 == 2 ):
                // Third item: Image block
                ?>

            <div class="relative overflow-hidden shadow-lg rounded-[4px] min-h-48" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out" data-aos-delay="<?php echo $counter * 100; ?>">
                <img src="<?php echo esc_url($image_url); ?>" 
                     alt="<?php echo esc_attr($title); ?>"
                     width="400" height="300"
                     loading="lazy"
                     decoding="async"
                     class="w-full h-[300px] object-cover transition-transform duration-500 hover:scale-105">
                <div class="absolute inset-0 bg-black/10 rounded-2xl"></div>
            </div>
            <div class="bg-[#550061] p-8 flex flex-col justify-between text-white shadow-lg rounded-[4px] min-h-48" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out" data-aos-delay="<?php echo ($counter + 1) * 100; ?>">
                <h3 class="text-2xl font-bold"><?php echo esc_html($title); ?></h3>
                <p class="text-lg max-w-[280px] leading-relaxed"><?php echo esc_html($description); ?></p>
            </div>

            <?php endif; ?>
            <?php 
            $counter++;
        endwhile;
        ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (have_rows('timeline_repeater')): ?>
<section class="grid grid-cols-1 lg:grid-cols-20 gap-8 max-w-7xl mx-auto py-16 lg:py-24 px-6 lg:px-0">
    <!-- 30%: Sticky Title -->
    <div class="lg:col-span-6">
        <div class="lg:sticky lg:top-24" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out">
            <p class="text-3xl md:text-5xl font-bold leading-tight">From startup to strategic partner</p>
        </div>
    </div>

    <!-- 25%: Vertical Timeline -->
    <div class="lg:col-span-5">
        <div class="lg:sticky lg:top-32" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out" data-aos-delay="100">
            <p class="text-base text-left lg:text-center mx-auto font-bold leading-tight mb-8">Milestones along the way
            </p>

            <!-- Timeline bar -->
            <div class="hidden lg:flex justify-center">
                <ol class="relative w-px bg-gray-300 list-none m-0 p-0" style="height: 215px;" aria-label="<?php echo esc_attr__( 'Company milestones', 'piedmontglobal' ); ?>">
                    <?php 
                        $total_items = count(get_field('timeline_repeater'));
                        $count = 0;
                        while (have_rows('timeline_repeater')): the_row();
                            $count++;
                            $top_percent = $total_items > 1 ? (($count - 1) * 100 / ($total_items - 1)) : 0;
                            $dot_title   = get_sub_field('title');
                            /* translators: 1: milestone position, 2: total milestones, 3: milestone title. */
                            $dot_label   = sprintf( __( 'Milestone %1$d of %2$d: %3$s', 'piedmontglobal' ), $count, $total_items, (string) $dot_title );
                    ?>
                    <li class="absolute left-1/2 w-3 h-3 rounded-full -translate-x-1/2 timeline-dot"
                        data-timeline-index="<?= esc_attr($count - 1); ?>"
                        aria-label="<?php echo esc_attr( $dot_label ); ?>"
                        <?php echo $count === 1 ? 'aria-current="true"' : ''; ?>
                        style="top:<?= $top_percent ?>%;background: linear-gradient(180deg, #006155 0%, #98C441 100%);list-style:none;">
                    </li>
                    <?php endwhile; ?>
                </ol>
            </div>
        </div>
    </div>


    <!-- 45%: Timeline Cards -->
    <div class="lg:col-span-9 space-y-24">
        <?php 
            $timeline_index = 0;
            while (have_rows('timeline_repeater')): the_row();
                $title       = get_sub_field('title');
                $description = get_sub_field('description');
                $icon        = get_sub_field('icon'); // icon url or svg
        ?>
        <div class="relative timeline-card" data-timeline-index="<?php echo esc_attr($timeline_index); ?>" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out" data-aos-delay="<?php echo $timeline_index * 120; ?>">
            <div class="hidden lg:block absolute -left-2 top-1/2 transform -translate-y-1/2 w-0 h-0 border-t-[12px] border-t-transparent border-b-[12px] border-b-transparent border-r-[16px] border-r-[#550061] text-[#550061]"
                style="
                color: #550061;
            "></div>
            <div
                class="bg-[#550061] text-[#F9F8F6] p-6 md:p-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 flex flex-col gap-4">
                <?php if ($title): ?>
                <h3 class="text-xl md:text-2xl font-bold"><?= esc_html($title); ?></h3>
                <?php endif; ?>
                <?php if ($description): ?>
                <p class="text-[#F9F8F6] text-base md:text-lg"><?= esc_html($description); ?></p>
                <?php endif; ?>
                <div class="h-12"></div>
                <?php if ($icon): ?>
                <img src="<?= esc_url($icon); ?>" 
                     alt="<?= esc_attr($title); ?> icon"
                     width="32" height="32"
                     loading="lazy"
                     decoding="async"
                     class="w-8 h-8 mt-auto">
                <?php endif; ?>
            </div>
        </div>
        <?php $timeline_index++; ?>
        <?php endwhile; ?>
    </div>
</section>
<?php endif; ?>


<?php 
    $images = get_field('affiliations'); // Gallery field returning URLs
    $certifications = get_field('certifications');
    if ($images || $certifications): 
?>
<section class="max-w-7xl mx-auto px-6 lg:px-0 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Left Column -->
        <div data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out">
            <?php 
            if ($images): 
                $col1 = [];
                $col2 = [];
                foreach ($images as $i => $image) {
                    if ($i % 2 == 0) {
                        $col1[] = $image;
                    } else {
                        $col2[] = $image;
                    }
                }
            ?>
            <div class="grid grid-cols-2 gap-6 items-center" role="list" aria-label="<?php echo esc_attr__( 'Affiliations', 'piedmont-global-wp' ); ?>">
                <!-- Column 1 -->
                <div class="lg:space-y-16 space-y-6 lg:pt-24">
                    <?php foreach ($col1 as $img):
                        $img_url   = is_array($img) && isset($img['url']) ? $img['url'] : $img;
                        $img_title = is_array($img) && ! empty( $img['title'] ) ? $img['title'] : '';
                        $raw_alt   = is_array($img) && isset($img['alt']) ? trim( (string) $img['alt'] ) : '';
                        if ( '' !== $raw_alt ) {
                            $img_alt = $raw_alt;
                        } elseif ( function_exists( 'pg_brand_alt' ) ) {
                            $img_alt = pg_brand_alt( $img_title, '', __( 'Affiliation logo', 'piedmont-global-wp' ) );
                        } else {
                            $img_alt = $img_title ?: __( 'Affiliation logo', 'piedmont-global-wp' );
                        }
                    ?>
                    <div role="listitem">
                        <img src="<?= esc_url($img_url); ?>"
                             alt="<?php echo esc_attr($img_alt); ?>"
                             width="100" height="100"
                             loading="lazy"
                             decoding="async"
                             class="h-[70px] w-[70px] mx-auto lg:h-[100px] lg:w-[100px] object-contain transition duration-300 ease-in-out grayscale hover:grayscale-0">
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Column 2 -->
                <div class="lg:space-y-16 space-y-6">
                    <?php foreach ($col2 as $img):
                        $img_url   = is_array($img) && isset($img['url']) ? $img['url'] : $img;
                        $img_title = is_array($img) && ! empty( $img['title'] ) ? $img['title'] : '';
                        $raw_alt   = is_array($img) && isset($img['alt']) ? trim( (string) $img['alt'] ) : '';
                        if ( '' !== $raw_alt ) {
                            $img_alt = $raw_alt;
                        } elseif ( function_exists( 'pg_brand_alt' ) ) {
                            $img_alt = pg_brand_alt( $img_title, '', __( 'Affiliation logo', 'piedmont-global-wp' ) );
                        } else {
                            $img_alt = $img_title ?: __( 'Affiliation logo', 'piedmont-global-wp' );
                        }
                    ?>
                    <div role="listitem">
                        <img src="<?= esc_url($img_url); ?>"
                             alt="<?php echo esc_attr($img_alt); ?>"
                             width="100" height="100"
                             loading="lazy"
                             decoding="async"
                             class="h-[70px] w-[70px] mx-auto lg:h-[100px] lg:w-[100px] object-contain transition duration-300 ease-in-out grayscale hover:grayscale-0">
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Right Column -->
        <div class="text-start lg:sticky lg:top-32 self-start" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out" data-aos-delay="100">
            <p class="text-lg font-medium text-gray-700 mb-6">
                Affiliations & Certifications
            </p>
            <h2 class="text-4xl md:text-5xl font-bold mb-4">
                We are a certified minority-owned business and trusted partner for public and private institutions.
            </h2>

            <?php if ($certifications): ?>
            <ul class="flex flex-wrap md:flex-nowrap gap-4 items-center mt-10 list-none p-0 m-0" aria-label="<?php echo esc_attr__( 'Certifications', 'piedmont-global-wp' ); ?>">
                <?php foreach ($certifications as $cert):
                    $cert_url   = is_array($cert) && isset($cert['url']) ? $cert['url'] : $cert;
                    $cert_title = is_array($cert) && ! empty( $cert['title'] ) ? $cert['title'] : '';
                    $cert_raw   = is_array($cert) && isset($cert['alt']) ? trim( (string) $cert['alt'] ) : '';
                    if ( '' !== $cert_raw ) {
                        $cert_alt = $cert_raw;
                    } elseif ( function_exists( 'pg_brand_alt' ) ) {
                        $cert_alt = pg_brand_alt( $cert_title, '', __( 'Certification logo', 'piedmont-global-wp' ) );
                    } else {
                        $cert_alt = $cert_title ?: __( 'Certification logo', 'piedmont-global-wp' );
                    }
                ?>
                <li>
                    <img src="<?php echo esc_url($cert_url); ?>"
                         alt="<?php echo esc_attr($cert_alt); ?>"
                         width="100" height="100"
                         loading="lazy"
                         decoding="async"
                         class="h-[70px] w-[70px] lg:h-[100px] lg:w-[100px] object-contain object-center transition duration-300 ease-in-out grayscale hover:grayscale-0">
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php 
    $hubspot_form = get_field('cta_hubspot_link');
    if ($hubspot_form): 
?>
<section class="bg-[#1F3131]  pt-20 md:pt-20 px-6 lg:px-0 ">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class=" text-4xl md:text-5xl text-white font-semibold mb-4" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out"><?php echo wp_kses_post(get_field('cta_title')); ?></h2>
        <p class="text-white mb-0 mt-4 text-base md:text-[24px]" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-out" data-aos-delay="100"><?php echo wp_kses_post(get_field('cta_description')); ?></p>
        <?php echo do_shortcode($hubspot_form); ?>
    </div>
</section>
<?php endif; ?>

<style>
.about-header span {
    color: #D16555 !important;
}

/* Ensure About page carousel cards are equal height (match tallest) */
.aboutus-carousel .owl-stage {
    display: flex;
}
.aboutus-carousel .owl-item {
    display: flex;
    height: auto;
}
.aboutus-carousel .owl-item > div {
    height: 100%;
}
</style>



<script>
// Timeline active dot on scroll
document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.timeline-card');
    const dots = document.querySelectorAll('.timeline-dot');

    if (!cards.length || !dots.length) return;

    // Initialize dots inactive (do not alter transform to preserve centering)
    dots.forEach(dot => {
        dot.style.opacity = '0.35';
        dot.style.boxShadow = 'none';
    });

    const setActive = (index) => {
        dots.forEach(dot => {
            dot.style.opacity = '0.35';
            dot.style.boxShadow = 'none';
            dot.removeAttribute('aria-current');
        });
        const active = document.querySelector(`.timeline-dot[data-timeline-index="${index}"]`);
        if (active) {
            active.style.opacity = '1';
            active.style.boxShadow = '0 0 0 4px rgba(152,196,65,0.35)';
            active.setAttribute('aria-current', 'true');
        }
    };

    // Observe cards to set active dot as they enter viewport
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const idx = entry.target.getAttribute('data-timeline-index');
                setActive(idx);
            }
        });
    }, {
        root: null,
        threshold: 0.5
    });

    cards.forEach(card => observer.observe(card));

    // Set first active by default
    setActive(0);
});
</script>

<?php 
// Exclude DMV popup on Minnesota and Washington geo-pages
$current_slug = get_post_field('post_name', get_post());
$excluded_pages = array('language-services-minnesota', 'language-services-washington', 'about');
if (!in_array($current_slug, $excluded_pages)): 
?>
<!-- DMV In-Person Event Popup -->
<div id="dmv-event-popup" 
     role="dialog"
     aria-modal="true"
     aria-labelledby="dmv-event-title"
     class="hidden fixed inset-0 z-[9999] overflow-y-auto">
    
    <!-- Backdrop -->
    <div id="dmv-popup-backdrop" class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity duration-300 opacity-0"></div>

    <!-- Popup Content -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div id="dmv-popup-content" class="relative w-full max-w-5xl bg-white shadow-2xl overflow-hidden transform transition-all duration-300 scale-95 opacity-0">
            
            <!-- Close Button -->
            <button id="dmv-popup-close" class="absolute top-4 right-4 z-20 p-2 bg-white/90 text-[#1F3131] hover:bg-[#98C441] hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-[#98C441]" aria-label="Close dialog">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2">
                
                <!-- Left Column: Content -->
                <div class="bg-[#1F3131] p-8 lg:p-12 text-white order-2 lg:order-1">
                    <span class="inline-block text-[#98C441] text-sm font-semibold uppercase tracking-wider mb-4">In-Person Event</span>
                    
                    <h2 id="dmv-event-title" class="text-2xl lg:text-3xl font-bold leading-tight mb-6">
                        Local to the DMV area? Join us on March 11 for an In-Person Event
                    </h2>
                    
                    <p class="text-gray-300 text-base mb-6">
                        We're hosting a small, in-person gathering focused on practical insights and real conversations — not sales pitches.
                    </p>
                    
                    <div class="mb-8">
                        <p class="text-[#98C441] font-semibold mb-3">What to expect:</p>
                        <ul class="space-y-3 text-gray-300 text-sm">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#98C441] mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Strategic perspectives on how globalization and language access are evolving inside organizations
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#98C441] mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Practical insights into real-world AI applications
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#98C441] mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Live technology demonstrations
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-[#98C441] mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Facilitated peer discussions with leaders across industries and functions
                            </li>
                        </ul>
                    </div>
                    
                    <a href="https://piedmontglobal.com/in-person-dmv-event/" 
                       class="inline-block bg-[#98C441] text-[#1F3131] px-6 py-3 font-bold text-base hover:bg-[#8AB738] transition-colors focus:outline-none focus:ring-2 focus:ring-[#98C441] focus:ring-offset-2 focus:ring-offset-[#1F3131]">
                        Learn more about the event
                    </a>
                </div>

                <!-- Right Column: Image -->
                <div class="relative h-64 lg:h-auto order-1 lg:order-2">
                    <img src="<?php echo esc_url(get_field('call_to_action_image')); ?>" 
                         alt="<?php echo esc_attr(get_field('popup_event_title') ?: 'Upcoming event'); ?>"
                         class="absolute inset-0 w-full h-full object-cover object-center">
                    <!-- Gradient overlay for mobile -->
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1F3131] to-transparent lg:hidden"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// DMV Event Popup - Scroll Triggered at 65%
(function() {
    const popup = document.getElementById('dmv-event-popup');
    const backdrop = document.getElementById('dmv-popup-backdrop');
    const content = document.getElementById('dmv-popup-content');
    const closeBtn = document.getElementById('dmv-popup-close');
    
    if (!popup) return;
    
    let hasShown = false;
    
    // Focus trap for the dialog
    function trapFocus(e) {
        var focusable = popup.querySelectorAll('a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])');
        if (!focusable.length) return;
        var first = focusable[0];
        var last = focusable[focusable.length - 1];
        if (e.key === 'Tab') {
            if (e.shiftKey && document.activeElement === first) {
                e.preventDefault();
                last.focus();
            } else if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault();
                first.focus();
            }
        }
    }

    var previouslyFocused = null;

    // Show popup with animation
    function showPopup() {
        if (hasShown) return;
        hasShown = true;
        previouslyFocused = document.activeElement;
        
        popup.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Trigger animations
        requestAnimationFrame(() => {
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
            closeBtn?.focus();
        });
        document.addEventListener('keydown', trapFocus);
    }
    
    // Hide popup with animation
    function hidePopup() {
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            popup.classList.add('hidden');
            document.body.style.overflow = '';
            if (previouslyFocused) previouslyFocused.focus();
        }, 300);
        document.removeEventListener('keydown', trapFocus);
    }
    
    // Scroll handler - trigger at 65%
    function handleScroll() {
        if (hasShown) return;
        
        const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollProgress = window.scrollY / scrollHeight;
        
        if (scrollProgress >= 0.65) {
            showPopup();
            window.removeEventListener('scroll', handleScroll);
        }
    }
    
    // Event listeners
    window.addEventListener('scroll', handleScroll, { passive: true });
    
    closeBtn.addEventListener('click', hidePopup);
    
    backdrop.addEventListener('click', hidePopup);
    
    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !popup.classList.contains('hidden')) {
            hidePopup();
        }
    });
    
    // Prevent closing when clicking inside content
    content.addEventListener('click', function(e) {
        e.stopPropagation();
    });
})();
</script>
<?php endif; ?>

</main>

<?php
get_footer(); ?>