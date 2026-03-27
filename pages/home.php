<?php
/**
 * Template Name: Home
 * Description: 
 */
get_header();
get_template_part( 'components/banner/primary' );
?>

<main id="maincontent">
    <section class="bg-[#1F3131] text-white py-20 px-4">
        <div class="max-w-7xl mx-auto ">
            <h2 class="text-3xl md:text-4xl font-semibold mb-12 text-center">What brings you here today?</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <?php if (have_rows('what_brings_you_here_today')): ?>
                <?php while (have_rows('what_brings_you_here_today')): the_row(); 
                $title       = get_sub_field('title');
                $description = get_sub_field('description');
                $link        = get_sub_field('link_');
                $size        = get_sub_field('size_of_card'); // only "small"
                $cta    = get_sub_field('cta_title');
                if (strtolower($size) !== 'small') {
                    continue;
                }
            ?>

                <a href="<?php echo esc_url($link); ?>" class="block h-full group">
                    <div class="overflow-hidden rounded shadow-md h-full bg-[#F9F8F6] text-black p-10"
                        data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out">

                        <div class="text-start">
                            <?php if ($title): ?>
                            <h3 class="text-2xl font-semibold max-w-[250px]">
                                <?php echo esc_html($title); ?>
                            </h3>
                            <?php endif; ?>

                            <?php if ($description): ?>
                            <div class="text-gray-700 mt-4 space-y-3 text-base">
                                <?php echo wp_kses_post($description); ?>
                            </div>
                            <?php endif; ?>

                            <span
                                class="inline-flex items-center gap-1 text-sm font-medium mt-6 border-b-2 border-[#D16555] transition-colors duration-300 group-hover:border-[#D16555]">
                                <?php echo esc_html($cta ?: 'Explore our approach'); ?> <span class="text-lg inline-block transition-transform duration-300 ease-out group-hover:translate-x-1">→</span>
                            </span>
                        </div>
                    </div>
                </a>

                <?php endwhile; ?>
                <?php endif; ?>
            </div>


            <!-- Government CTA -->
            <?php if (have_rows('what_brings_you_here_today')): ?>
            <?php while (have_rows('what_brings_you_here_today')): the_row(); 
            $title       = get_sub_field('title');
            $description = get_sub_field('description');
            $link        = get_sub_field('link_');
            $size        = get_sub_field('size_of_card'); // only "big"
            if (strtolower($size) !== 'big') {
                continue;
            }
        ?>
            <a href="<?php echo esc_url($link); ?>" class="block h-full">
                <div class="bg-[#F9F8F6] text-black mt-12 rounded-lg p-8 text-center group relative overflow-hidden"
                    data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out">

                    <div class="relative z-10 transition-opacity duration-500 ease-in-out group-hover:opacity-0">
                        <?php if ($title): ?>
                        <h3
                            class="text-2xl font-semibold mb-2 transition-transform duration-500 group-hover:-translate-y-2">
                            <?php echo esc_html($title); ?>
                        </h3>
                        <?php endif; ?>

                        <?php if ($description): ?>
                        <p class="text-gray-700 mb-4 transition-opacity duration-500">
                            <?php echo esc_html($description); ?>
                        </p>
                        <?php endif; ?>

                        <div class="h-20"></div>

                        <span
                            class="inline-flex items-center gap-1 text-sm font-medium mt-6 border-b-2 border-[#D16555] hover:border-[#D16555] transition-colors duration-300">
                            Explore our approach <span class="text-lg">→</span>
                        </span>
                    </div>

                    <div
                        class="absolute inset-0 z-20 flex flex-col items-center justify-center px-6 text-center
                    opacity-0 group-hover:opacity-100 transition-all duration-200 ease-out
                    bg-[linear-gradient(180deg,_rgba(152,196,65,0)_46.15%,_rgba(152,196,65,0.5)_80%,_rgba(0,97,85,0.5)_100%)] scale-95 group-hover:scale-100">

                        <div
                            class="flex flex-col items-center justify-center gap-6 text-center text-xl md:text-2xl px-6 md:px-20 font-semibold text-black mb-6 transition-transform duration-500 ease-in-out group-hover:translate-y-1">

                            <span>Explore our approach</span>

                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/arrow-side.svg'); ?>"
                                alt="" width="40" height="40" loading="lazy" decoding="async" aria-hidden="true"
                                class="h-10 w-10 text-white bg-black p-3 rounded-full transition-transform duration-500 ease-in-out group-hover:scale-110">
                        </div>
                    </div>
                </div>
            </a>

            <?php endwhile; ?>
            <?php endif; ?>


        </div>
    </section>


    <section class="bg-[#F9F8F6] py-16 px-6 md:px-0">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full mb-10 gap-6">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 max-w-xl" data-aos="fade-up"
                    data-aos-duration="400" data-aos-easing="ease-out">
                    The trusted partner for local and global growth
                </h2>
            </div>

            <?php if (have_rows('partners_repeater', 'option')): ?>
            <div class="owl-carousel owl-theme mb-16 partners-carousel" role="region" aria-roledescription="carousel" aria-label="Partners">
                <?php $partner_index = 0; ?>
                <?php while (have_rows('partners_repeater', 'option')): the_row(); ?>
                <div class="item flex items-center justify-center h-28 w-28" data-aos="fade-up" data-aos-duration="400"
                    data-aos-easing="ease-out" data-aos-delay="<?php echo $partner_index * 100; ?>">
                    <?php $partner_name = get_sub_field('partner_name'); ?>
                    <a href="<?php the_sub_field('url'); ?>" target="_blank" rel="noopener"
                        aria-label="<?php echo esc_attr( ($partner_name ?: 'Partner') . ' (opens in new tab)' ); ?>">
                        <img src="<?php the_sub_field('partner_logo'); ?>" alt="<?php echo esc_attr($partner_name ?: 'Partner logo'); ?>" width="112"
                            height="112" loading="lazy" decoding="async"
                            class="h-full w-full object-contain transition duration-300 ease-in-out grayscale hover:grayscale-0" />
                    </a>
                </div>
                <?php $partner_index++; ?>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>

            <div class="grid gap-6 md:grid-cols-2 mb-8">
                <?php if (have_rows('the_trusted_partner_for_local_and_global_growth_cards')): ?>
                <?php $card_index = 0; ?>
                <?php while (have_rows('the_trusted_partner_for_local_and_global_growth_cards')): the_row(); ?>
                <?php
                $image       = get_sub_field('image');
                $title       = get_sub_field('title');
                $description = get_sub_field('description');
            ?>
                <div class="items-justify gap-4 border border-[#DFDAD4] rounded-lg p-12 shadow-md" data-aos="fade-up"
                    data-aos-duration="400" data-aos-easing="ease-out"
                    data-aos-delay="<?php echo $card_index * 150; ?>">

                    <?php if (!empty($image)): ?>
                    <div class="flex-shrink-0">
                        <img src="<?php echo esc_url($image); ?>" alt="" width="48" height="48"
                            loading="lazy" decoding="async" class="h-12 w-12" aria-hidden="true" />
                    </div>
                    <?php endif; ?>

                    <div class="pt-4">
                        <?php if (!empty($title)): ?>
                        <h3 class="text-2xl text-[#1F3131] font-semibold">
                            <?php echo esc_html($title); ?>
                        </h3>
                        <?php endif; ?>

                        <?php if (!empty($description)): ?>
                        <p class="text-gray-600 text-lg pt-2">
                            <?php echo esc_html($description); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php $card_index++; ?>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <div class="grid gap-6 md:grid-cols-2 mb-8 overflow-hidden">
                <!-- Certified -->
                <div class="rounded-lg border border-[#DFDAD4] p-8 md:p-12 shadow-md" data-aos="fade-up"
                    data-aos-duration="400" data-aos-easing="ease-out">
                    <h3 class="text-xl md:text-2xl text-[#1F3131] font-semibold mb-8">
                        We’ve been certified
                    </h3>

                    <?php if (have_rows('certified_by', 'option')): ?>
                    <div class="owl-carousel owl-theme certificate-carousel" role="region" aria-roledescription="carousel" aria-label="Certifications">
                        <?php while (have_rows('certified_by', 'option')): the_row(); ?>
                        <div class="item">
                            <div
                                class="relative flex items-center justify-center h-28 w-28 sm:h-32 sm:w-32 md:h-36 md:w-36 rounded-full">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/circle.svg" alt=""
                                    width="144" height="144" loading="lazy" decoding="async"
                                    class="absolute inset-0 h-full w-full object-cover" />

                                <?php $cert_name = get_sub_field('name'); ?>
                                <img src="<?php the_sub_field('logo'); ?>" alt="<?php echo esc_attr($cert_name ?: 'Certification'); ?>" width="96"
                                    height="96" loading="lazy" decoding="async"
                                    class="relative max-h-16 max-w-16 sm:max-h-20 sm:max-w-20 md:max-h-24 md:max-w-24 object-contain transition duration-300 ease-in-out grayscale hover:grayscale-0" />
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Contracting Vehicles -->
                <div class="rounded-lg border border-[#DFDAD4] p-8 md:p-12 shadow-md" data-aos="fade-up"
                    data-aos-duration="400" data-aos-easing="ease-out">
                    <h3 class="text-xl md:text-2xl text-[#1F3131] font-semibold mb-8">
                        Contracting vehicles
                    </h3>

                    <div class="owl-carousel owl-theme contracting-vehicles-carousel" role="region" aria-roledescription="carousel" aria-label="Contracting vehicles">
                        <?php while (have_rows('contracting_vehicles', 'option')): the_row(); ?>
                        <div class="item">
                            <?php $cv_name = get_sub_field('name'); ?>
                            <?php if (get_sub_field('url')) : ?>
                            <a href="<?php the_sub_field('url'); ?>" target="_blank" rel="noopener"
                                aria-label="<?php echo esc_attr( ($cv_name ?: 'Contracting vehicle') . ' (opens in new tab)' ); ?>"
                                class="relative flex items-center justify-center h-28 w-28 sm:h-32 sm:w-32 md:h-36 md:w-36 rounded-full">
                                <?php else: ?>
                                <div
                                    class="relative flex items-center justify-center h-28 w-28 sm:h-32 sm:w-32 md:h-36 md:w-36 rounded-full">
                                    <?php endif; ?>

                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/circle.svg"
                                        alt="" width="144" height="144" loading="lazy" decoding="async"
                                        class="absolute inset-0 h-full w-full object-cover" aria-hidden="true" />
                                    <img src="<?php the_sub_field('logo'); ?>" alt="<?php echo esc_attr($cv_name ?: 'Contracting vehicle'); ?>"
                                        width="96" height="96" loading="lazy" decoding="async"
                                        class="relative max-h-16 max-w-16 sm:max-h-20 sm:max-w-20 md:max-h-24 md:max-w-24 object-contain transition duration-300 ease-in-out grayscale hover:grayscale-0" />

                                    <?php if (get_sub_field('url')) : ?>
                            </a>
                            <?php else: ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <!-- Recognized By -->
        <div class="rounded-lg border border-[#DFDAD4] p-8 md:p-12 shadow-md" data-aos="fade-up" data-aos-duration="400"
            data-aos-easing="ease-out">
            <h3 class="text-xl md:text-2xl text-[#1F3131] font-semibold mb-8">
                We've been recognized
            </h3>

            <?php if (have_rows('recognized_by', 'option')): ?>
            <div class="owl-carousel owl-theme recognized-carousel" role="region" aria-roledescription="carousel" aria-label="Recognized by">
                <?php while (have_rows('recognized_by', 'option')): the_row(); ?>
                <div class="item">
                    <?php $recog_name = get_sub_field('name'); ?>
                    <?php if (get_sub_field('url')) : ?>
                    <a href="<?php the_sub_field('url'); ?>" target="_blank" rel="noopener"
                        aria-label="<?php echo esc_attr( ($recog_name ?: 'Recognition') . ' (opens in new tab)' ); ?>"
                        class="relative flex items-center justify-center h-28 w-28 sm:h-32 sm:w-32 md:h-36 md:w-36 rounded-full">
                        <?php else: ?>
                        <div
                            class="relative flex items-center justify-center h-28 w-28 sm:h-32 sm:w-32 md:h-36 md:w-36 rounded-full">
                            <?php endif; ?>

                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/circle.svg" alt=""
                                width="144" height="144" loading="lazy" decoding="async"
                                class="absolute inset-0 h-full w-full object-cover" aria-hidden="true" />

                            <img src="<?php the_sub_field('logo'); ?>" alt="<?php echo esc_attr($recog_name ?: 'Recognition'); ?>" width="96"
                                height="96" loading="lazy" decoding="async"
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

        </div> <!-- closes max-w-7xl -->
    </section>




    <section class="bg-[#F7F7F5] py-16 px-6 md:px-0 ">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full mb-20 gap-6">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900" data-aos="fade-up" data-aos-duration="400"
                    data-aos-easing="ease-out">
                    From LSP to SGO
                </h2>
                <a href="/solutions"
                    class="group inline-flex items-center text-lg font-medium border-b-2 border-[#D16555] hover:border-[#D16555] transition-colors duration-300"
                    data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out" data-aos-delay="100">
                    Explore full capabilities
                    <span
                        class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1">→</span>
                </a>

            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-10 lg:gap-16">
                <div data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out" data-aos-delay="150"
                    class="flex flex-col justify-center">
                    <div class="space-y-10">
                        <?php if (have_rows('capabilities')): ?>
                        <?php 
                                $row_count = count(get_field('capabilities')); 
                                $index = 0;
                            ?>
                        <?php while (have_rows('capabilities')): the_row(); 
                                    $title       = get_sub_field('title');
                                    $description = get_sub_field('description');
                                ?>
                        <div class="<?php echo $index < ($row_count - 1) ? 'pb-6 border-b border-gray-300' : ''; ?>">
                            <?php if (!empty($title)): ?>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-4">
                                <?php echo esc_html($title); ?>
                            </h3>
                            <?php endif; ?>
                            <?php if (!empty($description)): ?>
                            <p class="text-gray-700 text-lg">
                                <?php echo esc_html($description); ?>
                            </p>
                            <?php endif; ?>
                        </div>
                        <?php $index++; ?>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out" data-aos-delay="200"
                    class="flex justify-center items-center">
                    <div class="rounded-[4px] overflow-hidden md:mx-0"
                        style="background: linear-gradient(180deg, #550061 0%, #550061 70%, #D16555 100%);">
                        <img src="/wp-content/uploads/Rectangle-21027.png" alt="Team collaboration" width="600"
                            height="400" loading="lazy" decoding="async"
                            class="h-full w-full object-cover rounded-[6px] p-6 md:p-20" />
                    </div>
                </div>
            </div>








        </div>
    </section>

    <section class="bg-[#1F3131] text-white py-20 px-6 md:px-0">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full mb-20 gap-6">
                <h2 class="text-3xl md:text-5xl font-bold text-white max-w-lg" data-aos="fade-up"
                    data-aos-duration="400" data-aos-easing="ease-out">
                    Deep industry insight. Proven across sectors.
                </h2>
                <a href="/industries"
                    class="group inline-flex items-center text-lg font-medium border-b-2 border-[#D16555] hover:border-[#D16555] transition-colors duration-300"
                    data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out" data-aos-delay="100">
                    Explore industry solutions
                    <span
                        class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1">→</span>
                </a>

            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
        $industries_query = new WP_Query([
            'post_type' => 'industry',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC'
        ]);
        $i = 0;

        if ($industries_query->have_posts()) :
            while ($industries_query->have_posts()) : $industries_query->the_post();
                $icon = get_field('industry_icon');
                $tagline = get_field('industry_tagline');
        ?>
                <a href="<?php the_permalink(); ?>" class="group block h-full">
                    <div class="bg-[#006155] text-white rounded-[4px] shadow-md p-10 flex flex-col justify-between h-full
                transform transition-all duration-500 ease-out group-hover:scale-[1.01]" data-aos="fade-up"
                        data-aos-duration="400" data-aos-easing="ease-out" data-aos-delay="<?= $i * 100 ?>">

                        <?php if ($icon) : ?>
                        <img src="<?php echo wp_kses_post($icon); ?>" width="64" height="64" loading="lazy"
                            decoding="async" class="mb-6 h-16 w-16" alt="<?php echo esc_attr(get_the_title()); ?> icon">
                        <?php endif; ?>

                        <h3 class="text-xl text-white font-semibold mb-4"><?php the_title(); ?></h3>

                        <?php if ($tagline) : ?>
                        <p class="text-white mt-auto mb-0 font-normal text-lg">
                            <?php echo wp_kses_post($tagline); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </a>
                <?php
        $i++;
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
            </div>

        </div>
    </section>

    <?php
$args = [
    'post_type'      => 'case_study',
    'posts_per_page' => 1,
];

$query = new WP_Query($args);

if ($query->have_posts()):
    while ($query->have_posts()): $query->the_post();
        $percentage  = get_field('value');        // ACF field
        $description = get_field('description');  // ACF field
        $image       = get_field('image');        // ACF image field
        $logo        = get_field('logo');         // ACF image field
        $link        = get_permalink();           
        ?>

    <section class="bg-[#f9f9f6] py-20 px-6 md:px-20">
        <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-8 items-stretch">

            <!-- Testimonial -->
            <div class="md:col-span-2 bg-white rounded border border-[#DFDAD4] p-8 shadow-sm flex flex-col">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/quote.svg'); ?>"
                    alt="" width="64" height="64" loading="lazy" decoding="async" class="h-16 w-16 mb-4" aria-hidden="true" />

                <div class="text-base md:text-xl text-gray-800 font-medium flex-grow max-w-2xl">
                    <?php the_field('testimonials_content'); ?>
                </div>

                <div class="mt-6">
                    <p class="font-semibold text-gray-900"><?php the_field('testimonials_name'); ?></p>
                    <p class="text-gray-600"><?php the_field('testimonials_title'); ?></p>
                </div>
            </div>

            <!-- Case study Card -->
            <a href="<?php the_permalink(); ?>"
                class="group block bg-white rounded border border-[#DFDAD4] p-5 shadow-sm rounded-t-[4px] transition-transform duration-300 hover:shadow-lg">

                <div class="overflow-hidden rounded-t-[4px]">
                    <img src="<?php echo esc_url(get_field('logo')); ?>" width="200" height="160" loading="lazy" decoding="async"
                        class="w-[70%] h-40 object-contain mx-auto object-center transition-transform duration-500 group-hover:scale-105"
                        alt="<?php echo esc_attr(get_field('title')); ?> logo">
                </div>

                <div class="p-8 bg-white">
                    <div class="text-gray-500 text-base mb-2"><?php the_field('industry'); ?></div>
                    <h3 class="text-2xl font-semibold text-[#1F3131] mb-2"><?php the_field('title'); ?></h3>
                    <div class="h-6 md:h-10"></div>

                    <span class="inline-flex items-center text-base font-medium border-b-2 border-[#D16555]">
                        Read case study
                        <span
                            class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1">→</span>
                    </span>
                </div>
            </a>

        </div>
    </section>

    <?php
    endwhile;
    wp_reset_postdata();
endif;
?>


    <section class="h-[450px] bg-repeat-x bg-top pb-10 bg-[#F9F8F6]" aria-hidden="true"
        style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/icons/pattern-2.svg' ); ?>')">
    </section>

    <!-- Visual Moment Section -->
    <section class="py-10 lg:py-20 bg-[#F9F8F6]">
        <div class="text-center max-w-4xl mx-auto px-6 md:px-10 lg:px-0">
            <p class="text-lg font-medium text-gray-700 mb-6">What is Strategic Globalization</p>
            <h2 class="text-2xl md:text-5xl font-bold">
                The foundation that makes success inevitable, whether your audience is across the globe or across the street.
            </h2>

            <a href="/strategic-globalization/"
                class="inline-flex items-center text-lg font-medium mt-12 border-b-2 border-[#D16555] hover:border-[#D16555] transition-colors duration-300"
                data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out" data-aos-delay="100">
                Learn more about Strategic Globalization <span
                    class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1">→</span>
            </a>
        </div>
    </section>






    <section class="bg-[#F7F7F5] py-20 px-6 md:px-0">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full mb-20 gap-6">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 max-w-2xl" data-aos="fade-up"
                    data-aos-duration="400" data-aos-easing="ease-out">
                    Solutions built for your moment and your mission
                </h2>
                <a href="/solutions"
                    class="inline-flex items-center text-lg font-medium border-b-2 border-[#D16555] hover:border-[#D16555] transition-colors duration-300"
                    data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out" data-aos-delay="100">
                    Explore full capabilities <span
                        class="ml-1 text-lg transform transition-transform duration-300 group-hover:translate-x-1">→</span>
                </a>
            </div>

            <!-- Solutions Taxonomy Grid -->
            <div class="grid md:grid-cols-3 gap-12 max-w-7xl mx-auto">
                <?php
            // Get terms in 'solution' taxonomy
            $terms = get_terms([
                'taxonomy'   => 'solution', // adjust taxonomy slug accordingly
                'hide_empty' => false,
                'number'     => 6,
            ]);

            if (!is_wp_error($terms) && !empty($terms)) :
                $delay = 0;
                foreach ($terms as $term) :
                    // Get ACF fields for the term
                    $tagline = get_field('solution_tagline', $term->taxonomy . '_' . $term->term_id);
                    $image = get_field('featured_image', $term->taxonomy . '_' . $term->term_id);

                    // Fallback image URL if no image set
                    $image_url = $image && is_array($image) && isset($image['url'])
                        ? $image['url']
                        : '/wp-content/uploads/Rectangle-21027.png';

                    // Term archive link
                    $term_link = get_term_link($term);
                    if (is_wp_error($term_link)) {
                        continue; // skip if error getting link
                    }
                    ?>
                <!-- Individual Solution Taxonomy Card -->
                <a href="<?php echo esc_url($term_link); ?>"
                    class="group relative bg-white border border-gray-200 shadow-sm overflow-hidden flex flex-col transform transition-all duration-500 hover:-translate-y-1 hover:shadow-sm"
                    data-aos="fade-up" data-aos-duration="400" data-aos-easing="ease-out"
                    data-aos-delay="<?php echo esc_attr($delay); ?>"
                    aria-label="Learn more about <?php echo esc_attr($term->name); ?>">

                    <!-- Card Image -->
                    <div class="overflow-hidden">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($term->name); ?>" width="400"
                            height="240" loading="lazy" decoding="async"
                            class="w-full h-60 object-cover transition-transform duration-700 ease-out group-hover:scale-105" />
                    </div>

                    <!-- Card Content -->
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-2"><?php echo esc_html($term->name); ?></h3>
                        <div class="text-gray-700 mb-6 text-lg flex-1">
                            <?php echo wp_kses_post($tagline); ?>
                        </div>
                        <div class="h-6 md:h-20"></div>

                        <!-- Learn More Indicator -->
                        <div
                            class="flex items-center mt-auto text-sm font-semibold text-gray-900 transition-colors duration-300 group-hover:text-[#D16555]">
                            Learn more
                            <span
                                class="ml-2 text-lg transition-transform duration-300 group-hover:translate-x-1">→</span>
                        </div>
                        <div class="h-0.5 w-8 mt-1 bg-[#D16555] transition-all duration-300 group-hover:w-24"></div>
                    </div>
                </a>

                <?php
                    $delay += 100;
                endforeach;
            else :
                ?>
                <p class="text-center text-lg text-gray-900">No solutions found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>






</main>

<?php
get_template_part( 'components/common/cta' ); 
get_footer(); 
?>