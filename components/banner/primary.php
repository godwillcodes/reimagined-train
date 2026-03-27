<section
    class="relative h-auto w-full text-white overflow-hidden bg-no-repeat bg-cover bg-bottom transition-opacity duration-300"
    data-bg-svg="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/primary-bg.svg'); ?>">

    <!-- Background image element -->
    <img
        src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/primary-bg.svg'); ?>"
        alt=""
        class="absolute inset-0 w-full h-full object-cover object-bottom opacity-95  pointer-events-none select-none"
        decoding="async"
        loading="lazy">

    <!-- Navigation -->
    <?php get_template_part('components/navigation/desktop'); ?>
    <?php get_template_part('components/navigation/mobile'); ?>

    <div class="w-full px-6 md:px-12 relative z-20 mt-10">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-2 items-center mt-36">
            <!-- Left Column -->
            <div class="lg:col-span-6 space-y-6 order-1 lg:mb-40">
                <h1 class="leading-[40px] md:leading-[55px] lg:leading-[55px] font-semibold">
                    <?php echo wp_kses_post(get_field('bannner_title')); ?>
                </h1>
                <div class="text-xl leading-relaxed font-normal">
                    <?php echo wp_kses_post(get_field('banner_description')); ?>
                </div>

                <div class="flex flex-wrap items-center gap-7">
                    <a href="<?php echo wp_kses_post(get_field('primary_button_link')); ?>"
                        class="inline-block bg-[#98C441] text-[#1F3131] px-5 py-3 font-semibold text-base shadow-md hover:bg-[#8AB738] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#98C441] transition">
                        <?php echo wp_kses_post(get_field('primary_button_title')); ?>
                    </a>
                    <a href="<?php echo wp_kses_post(get_field('secondary_button_link')); ?>"
                        class="group flex items-center text-white text-base font-semibold focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2 rounded-sm">
                        <?php echo wp_kses_post(get_field('secondary_button_title')); ?>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/arrow-right.svg'); ?>"
                            class="ml-2 h-6 w-6 transform transition-transform duration-300 group-hover:translate-x-1"
                            alt="" aria-hidden="true">
                    </a>
                </div>
            </div>

            <!-- Right Column Image -->
            <div class="lg:col-span-6 order-2 py-20 lg:py-0 ">
                <?php 
                $banner_image = get_field('banner_image');
                if ($banner_image) {
                    $image_url = is_array($banner_image) ? $banner_image['url'] : $banner_image;
                    $image_alt = is_array($banner_image) ? $banner_image['alt'] : get_bloginfo('name');
                    $image_id = is_array($banner_image) ? $banner_image['ID'] : attachment_url_to_postid($banner_image);
                    
                    if ($image_id) {
                        $sizes = array(
                            '(max-width: 768px)' => 'medium',
                            '(max-width: 1024px)' => 'large',
                            '' => 'full'
                        );
                        
                        $srcset = array();
                        foreach ($sizes as $media => $size) {
                            $img = wp_get_attachment_image_src($image_id, $size);
                            if ($img) {
                                $srcset[] = $img[0] . ' ' . $img[1] . 'w';
                            }
                        }
                        
                        echo '<img src="' . esc_url($image_url) . '"';
                        echo ' srcset="' . esc_attr(implode(', ', $srcset)) . '"';
                        echo ' sizes="(max-width: 768px) 100vw, (max-width: 1024px) 100vw, 600px"';
                        echo ' alt="' . esc_attr($image_alt) . '"';
                        echo ' class="max-w-full hidden lg:block lg:h-[620px] h-auto object-cover object-center"';
                        echo ' loading="eager" fetchpriority="high" decoding="sync" width="600" height="620">';
                    } else {
                        echo '<img src="' . esc_url($image_url) . '"';
                        echo ' alt="' . esc_attr($image_alt) . '"';
                        echo ' width="600" height="600"';
                        echo ' class="max-w-full h-auto object-contain"';
                        echo ' style="object-position: right bottom;"';
                        echo ' loading="eager" fetchpriority="high" decoding="sync">';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>
