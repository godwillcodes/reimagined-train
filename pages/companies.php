<?php
/**
 * Template Name: Companies
 * Description:
 */
get_header();
get_template_part( 'components/banner/single-common' );
?>

<section class="bg-[#F9F8F6] py-24 px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Heading -->
        <div class="text-center mb-20" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl lg:text-4xl font-bold text-[#1F3131] mb-6">
                Our Strategic Partnerships
            </h2>
            <p class="max-w-4xl mx-auto text-lg md:text-xl text-[#1F3131]/80 leading-relaxed">
                At Piedmont Global, we are ambitious, entrepreneurial, and bold. We are always thinking about how we can leverage partnerships with organizations that share our ambition and vision to drive growth for our customers, partners and ourselves.
            </p>
        </div>

        <!-- Timeline Container -->
        <div class="relative">
            <!-- Timeline Line -->
            <div class="absolute left-8 md:left-1/2 md:-translate-x-1/2 top-0 bottom-0 w-0.5 bg-gradient-to-b from-[#006155] via-[#98C441] to-[#006155]"></div>

            <!-- Timeline Items -->
            <div class="space-y-16 md:space-y-24">
                <?php if ( have_rows('companies_repeater') ) : ?>
                <?php $index = 0; while ( have_rows('companies_repeater') ) : the_row(); 
                    $logo        = get_sub_field('logo');
                    $year        = get_sub_field('year');
                    $title       = get_sub_field('title');
                    $description = get_sub_field('description');
                    $is_even = $index % 2 === 0;
                ?>
                <div class="relative flex items-center" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                    <!-- Year Circle -->
                    <div class="absolute left-0 md:left-1/2 md:-translate-x-1/2 flex items-center justify-center w-16 h-16 rounded-full text-white text-lg font-bold shadow-xl z-20 bg-gradient-to-br from-[#006155] to-[#98C441] border-4 border-[#F9F8F6]">
                        <?php echo esc_html($year); ?>
                    </div>
                    
                    <!-- Content Card -->
                    <div class="ml-20 md:ml-0 md:w-1/2 <?php echo $is_even ? 'md:pr-16' : 'md:pl-16 md:ml-auto'; ?>">
                        <div class="bg-white shadow-lg hover:shadow-2xl transition-all duration-500 p-6 md:p-8 border border-[#DFDAD4]/50 hover:border-[#98C441]/30 group">
                            <!-- Logo and Content Side by Side -->
                            <div class="flex flex-col sm:flex-row items-center gap-4 md:gap-6">
                                <!-- Logo Section -->
                                <?php if ( $logo ) : ?>
                                <div class="flex-shrink-0">
                                    <div class=" p-2 group-hover:bg-[#98C441]/5 transition-colors duration-300">
                                        <img src="<?php echo esc_url($logo); ?>"
                                            alt="<?php echo esc_attr($title); ?> Logo"
                                            class="h-16 w-auto object-contain max-w-32 sm:h-16 sm:max-w-40">
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                                <!-- Content -->
                                <div class="flex-1 text-center sm:text-left">
                                    <?php if ( $title ) : ?>
                                    <h3 class="text-lg md:text-xl font-bold text-[#1F3131] mb-2 md:mb-3">
                                        <?php echo esc_html($title); ?>
                                    </h3>
                                    <?php endif; ?>
                                    
                                    <?php if ( $description ) : ?>
                                    <div class="text-[#1F3131]/80 text-sm md:text-base leading-relaxed">
                                        <?php echo wp_kses_post($description); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Decorative Element -->
                            <div class="absolute top-4 <?php echo $is_even ? 'right-4' : 'left-4'; ?> w-2 h-2 bg-[#98C441] rounded-full opacity-60"></div>
                        </div>
                    </div>
                </div>
                <?php $index++; endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>



<?php
get_template_part( 'components/common/cta' );
get_footer();