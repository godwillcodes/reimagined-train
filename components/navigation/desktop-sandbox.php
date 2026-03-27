<?php
$trigger_classes = 'inline-flex items-center gap-1 transition-colors duration-200 hover:text-[#98C441] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2 focus-visible:ring-offset-transparent rounded-sm';
$panel_link_classes = 'relative block pl-3 text-base font-normal text-[#1F3131] group overflow-hidden hover:text-[#98C441] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#1F3131] focus-visible:ring-offset-2 focus-visible:ring-offset-[#F9F8F6] rounded-sm';
$panel_heading_link_classes = 'block mb-3 font-semibold text-[#1F3131] hover:text-[#98C441] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#1F3131] focus-visible:ring-offset-2 focus-visible:ring-offset-[#F9F8F6] rounded-sm';
$panel_footer_link_classes = 'flex flex-col space-y-1 mt-8 pt-6 border-t border-[#DFDAD4] transition-all duration-300 w-[90%] mx-auto transform group focus:outline-none focus-visible:ring-2 focus-visible:ring-[#1F3131] focus-visible:ring-offset-2 focus-visible:ring-offset-[#F9F8F6] rounded-sm';
$panel_footer_link_compact_classes = 'flex flex-col space-y-1 mt-4 pt-4 border-t border-[#DFDAD4] transition-all duration-300 w-[90%] mx-auto transform group focus:outline-none focus-visible:ring-2 focus-visible:ring-[#1F3131] focus-visible:ring-offset-2 focus-visible:ring-offset-[#F9F8F6] rounded-sm';
?>
<!-- Desktop Navigation Component -->
<header class="hidden lg:block fixed w-full top-0 z-50 transition-colors duration-300" x-data="{
        scrolled: false,
        logoDefault: '<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>',
        logoScrolled: '<?php echo esc_url( get_template_directory_uri() . '/assets/icons/pglogo-light.svg' ); ?>'
        }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 100 })"
    :class="{ 'bg-gradient-to-b from-[#F9F8F6]/95 to-[#F9F8F6]/70 mt-0 backdrop-blur-xl shadow-[0_4px_30px_rgba(0,0,0,0.1)] text-black': scrolled }">
    <div class="max-w-7xl mx-auto py-4 px-6 lg:px-0 flex items-center justify-between">
        <div class="flex items-center">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Home"
                class="rounded-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441] focus-visible:ring-offset-2 focus-visible:ring-offset-transparent">
                <img :src="scrolled ? logoScrolled : logoDefault" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                    class="h-8 w-auto transition-all duration-300 hover:scale-95" />
            </a>
        </div>

        <nav class="flex items-center space-x-6 text-base font-medium transition-colors duration-300"
            :class="scrolled ? 'text-black' : 'text-white'" aria-label="Main navigation" data-desktop-nav>
            <div class="relative" data-nav-menu="solutions">
                <button type="button" id="sandbox-solutions-trigger" data-nav-trigger="solutions"
                    class="<?php echo esc_attr( $trigger_classes ); ?>" aria-expanded="false" aria-haspopup="menu"
                    aria-controls="sandbox-solutions-menu">
                    <span class="font-normal">Solutions</span>
                    <svg class="w-5 h-5 transition-transform duration-200" data-nav-chevron fill="currentColor"
                        viewBox="0 0 20 20" aria-hidden="true">
                        <path
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" />
                    </svg>
                </button>

                <div id="sandbox-solutions-menu" data-nav-panel="solutions" hidden
                    class="absolute left-1/2 top-full z-40 mt-0 w-[950px] -translate-x-1/2 rounded bg-gradient-to-b from-[#F9F8F6]/95 to-[#F9F8F6]/95 backdrop-blur-sm shadow-[0_4px_30px_rgba(0,0,0,0.1)] p-8 overflow-hidden"
                    role="menu" aria-labelledby="sandbox-solutions-trigger" aria-hidden="true">
                    <?php
                    if ( taxonomy_exists( 'solution' ) ) {
                        $parents = get_terms(
                            [
                                'taxonomy'   => 'solution',
                                'hide_empty' => false,
                                'parent'     => 0,
                                'orderby'    => 'name',
                                'order'      => 'ASC',
                            ]
                        );
                    } else {
                        $parents = [];
                    }
                    ?>

                    <?php if ( ! empty( $parents ) && ! is_wp_error( $parents ) ) : ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
                        <?php foreach ( $parents as $parent ) : ?>
                        <div>
                            <a href="<?php echo esc_url( get_term_link( $parent ) ); ?>"
                                class="<?php echo esc_attr( $panel_heading_link_classes ); ?>" role="menuitem" tabindex="-1"
                                data-nav-item>
                                <?php echo esc_html( $parent->name ); ?>
                            </a>

                            <?php
                            $child_posts = get_posts(
                                [
                                    'post_type'      => 'solutions',
                                    'tax_query'      => [
                                        [
                                            'taxonomy' => 'solution',
                                            'field'    => 'term_id',
                                            'terms'    => $parent->term_id,
                                        ],
                                    ],
                                    'posts_per_page' => -1,
                                    'orderby'        => 'title',
                                    'order'          => 'ASC',
                                ]
                            );
                            ?>

                            <?php if ( ! empty( $child_posts ) ) : ?>
                            <ul class="space-y-2" role="none">
                                <?php foreach ( $child_posts as $post ) : ?>
                                <li role="none">
                                    <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"
                                        class="<?php echo esc_attr( $panel_link_classes ); ?>" role="menuitem" tabindex="-1"
                                        data-nav-item>
                                        <span
                                            class="absolute left-0 top-0 h-full w-1 bg-[#98C441] scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-top"></span>
                                        <span class="relative z-10 text-sm"><?php echo esc_html( get_the_title( $post->ID ) ); ?></span>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php elseif ( ! empty( $parent->description ) ) : ?>
                            <div class="mt-2 text-sm text-gray-600">
                                <?php echo wp_kses_post( $parent->description ); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else : ?>
                    <?php
                    $flat_terms = taxonomy_exists( 'solution' )
                        ? get_terms(
                            [
                                'taxonomy'   => 'solution',
                                'hide_empty' => true,
                                'orderby'    => 'name',
                                'order'      => 'ASC',
                            ]
                        )
                        : [];
                    ?>
                    <?php if ( ! empty( $flat_terms ) && ! is_wp_error( $flat_terms ) ) : ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        <?php foreach ( $flat_terms as $term ) : ?>
                        <?php
                        $term_posts = get_posts(
                            [
                                'post_type'      => 'solutions',
                                'tax_query'      => [
                                    [
                                        'taxonomy' => 'solution',
                                        'field'    => 'term_id',
                                        'terms'    => $term->term_id,
                                    ],
                                ],
                                'posts_per_page' => 1,
                            ]
                        );
                        ?>
                        <div>
                            <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"
                                class="<?php echo esc_attr( $panel_link_classes ); ?>" role="menuitem" tabindex="-1"
                                data-nav-item>
                                <span
                                    class="absolute left-0 top-0 h-full w-1 bg-[#98C441] scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-top"></span>
                                <span class="relative z-10"><?php echo esc_html( $term->name ); ?></span>
                            </a>
                            <?php if ( empty( $term_posts ) && ! empty( $term->description ) ) : ?>
                            <div class="mt-2 text-sm text-gray-600">
                                <?php echo wp_kses_post( $term->description ); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else : ?>
                    <p>No taxonomy terms found in the 'solution' taxonomy.</p>
                    <?php endif; ?>
                    <?php endif; ?>

                    <a href="<?php echo esc_url( site_url( '/solutions' ) ); ?>"
                        class="<?php echo esc_attr( $panel_footer_link_classes ); ?>" role="menuitem" tabindex="-1"
                        data-nav-item>
                        <div class="flex items-center justify-center">
                            <p class="text-sm font-bold text-[#1F3131] text-center group-hover:text-[#98C441] transition-colors duration-300">
                                Explore all solutions
                            </p>
                            <svg class="w-4 h-4 ml-2 text-[#1F3131] group-hover:text-[#98C441] group-hover:translate-x-1 transition-colors duration-300"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>

            <div class="relative" data-nav-menu="industries">
                <button type="button" id="sandbox-industries-trigger" data-nav-trigger="industries"
                    class="<?php echo esc_attr( $trigger_classes ); ?>" aria-expanded="false" aria-haspopup="menu"
                    aria-controls="sandbox-industries-menu">
                    <span class="font-normal">Industries</span>
                    <svg class="w-5 h-5 transition-transform duration-200" data-nav-chevron fill="currentColor"
                        viewBox="0 0 20 20" aria-hidden="true">
                        <path
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" />
                    </svg>
                </button>

                <div id="sandbox-industries-menu" data-nav-panel="industries" hidden
                    class="absolute left-1/2 top-full z-40 mt-4 w-72 -translate-x-1/2 rounded bg-gradient-to-b from-[#F9F8F6]/95 to-[#F9F8F6]/95 backdrop-blur-xl shadow-[0_4px_30px_rgba(0,0,0,0.1)] p-6 overflow-hidden"
                    role="menu" aria-labelledby="sandbox-industries-trigger" aria-hidden="true">
                    <div class="space-y-4">
                        <?php
                        $industries = new WP_Query(
                            [
                                'post_type'      => 'industry',
                                'posts_per_page' => -1,
                                'post_status'    => 'publish',
                                'orderby'        => 'title',
                                'order'          => 'ASC',
                            ]
                        );

                        if ( $industries->have_posts() ) :
                            while ( $industries->have_posts() ) :
                                $industries->the_post();
                                ?>
                        <a href="<?php the_permalink(); ?>"
                            class="flex flex-col space-y-1 pt-2 relative group overflow-hidden hover:text-[#98C441] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#1F3131] focus-visible:ring-offset-2 focus-visible:ring-offset-[#F9F8F6] rounded-sm"
                            role="menuitem" tabindex="-1" data-nav-item>
                            <div class="pl-3 relative">
                                <p class="text-base font-normal text-[#1F3131] transition-colors duration-300"><?php the_title(); ?></p>
                                <span
                                    class="absolute left-0 top-0 h-full w-1 bg-[#98C441] scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-top"></span>
                            </div>
                        </a>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>

                        <a href="<?php echo esc_url( site_url( '/industries' ) ); ?>"
                            class="<?php echo esc_attr( $panel_footer_link_compact_classes ); ?>" role="menuitem" tabindex="-1"
                            data-nav-item>
                            <div class="flex items-center justify-center">
                                <p class="text-sm font-bold text-[#1F3131] text-center group-hover:text-[#98C441] transition-colors duration-300">
                                    Explore all industries
                                </p>
                                <svg class="w-4 h-4 ml-2 text-[#1F3131] group-hover:text-[#98C441] group-hover:translate-x-1 transition-all duration-500 ease-in-out"
                                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="relative" data-nav-menu="about">
                <button type="button" id="sandbox-about-trigger" data-nav-trigger="about"
                    class="<?php echo esc_attr( $trigger_classes ); ?>" aria-expanded="false" aria-haspopup="menu"
                    aria-controls="sandbox-about-menu">
                    <span class="font-normal">Who we are</span>
                    <svg class="w-5 h-5 transition-transform duration-200" data-nav-chevron fill="currentColor"
                        viewBox="0 0 20 20" aria-hidden="true">
                        <path
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" />
                    </svg>
                </button>

                <div id="sandbox-about-menu" data-nav-panel="about" hidden
                    class="absolute left-1/2 top-full z-40 mt-4 w-60 -translate-x-1/2 rounded bg-gradient-to-b from-[#F9F8F6]/95 to-[#F9F8F6]/90 backdrop-blur-xl shadow-[0_4px_30px_rgba(0,0,0,0.1)] p-6 overflow-hidden"
                    role="menu" aria-labelledby="sandbox-about-trigger" aria-hidden="true">
                    <div class="space-y-6">
                        <?php
                        $about_items = wp_get_nav_menu_items( 13 );
                        if ( $about_items ) {
                            foreach ( $about_items as $menu_item ) {
                                echo '<a href="' . esc_url( $menu_item->url ) . '" class="' . esc_attr( $panel_link_classes ) . '" role="menuitem" tabindex="-1" data-nav-item><span class="relative z-10">' . esc_html( $menu_item->title ) . '</span><span class="absolute left-0 top-0 h-full w-1 bg-[#98C441] scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-top"></span></a>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="relative" data-nav-menu="resources">
                <button type="button" id="sandbox-resources-trigger" data-nav-trigger="resources"
                    class="<?php echo esc_attr( $trigger_classes ); ?>" aria-expanded="false" aria-haspopup="menu"
                    aria-controls="sandbox-resources-menu">
                    <span class="font-normal">Resources</span>
                    <svg class="w-5 h-5 transition-transform duration-200" data-nav-chevron fill="currentColor"
                        viewBox="0 0 20 20" aria-hidden="true">
                        <path
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" />
                    </svg>
                </button>

                <div id="sandbox-resources-menu" data-nav-panel="resources" hidden
                    class="absolute left-1/2 top-full z-40 mt-4 w-72 -translate-x-1/2 rounded bg-gradient-to-b from-[#F9F8F6]/95 to-[#F9F8F6]/90 backdrop-blur-xl shadow-[0_4px_30px_rgba(0,0,0,0.1)] p-6 overflow-hidden"
                    role="menu" aria-labelledby="sandbox-resources-trigger" aria-hidden="true">
                    <div class="space-y-6">
                        <?php
                        $resource_items = wp_get_nav_menu_items( 14 );
                        if ( $resource_items ) {
                            foreach ( $resource_items as $menu_item ) {
                                echo '<a href="' . esc_url( $menu_item->url ) . '" class="' . esc_attr( $panel_link_classes ) . '" role="menuitem" tabindex="-1" data-nav-item><span class="relative z-10">' . esc_html( $menu_item->title ) . '</span><span class="absolute left-0 top-0 h-full w-1 bg-[#98C441] scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-top"></span></a>';
                            }
                        }
                        ?>
                    </div>

                    <a href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"
                        class="<?php echo esc_attr( $panel_footer_link_compact_classes ); ?>" role="menuitem" tabindex="-1"
                        data-nav-item>
                        <div class="flex items-center justify-center">
                            <p class="text-sm font-bold text-[#1F3131] text-center group-hover:text-[#98C441] transition-colors duration-300">
                                Explore all resources
                            </p>
                            <svg class="w-4 h-4 ml-2 text-[#1F3131] group-hover:text-[#98C441] group-hover:translate-x-1 transition-all duration-500 ease-in-out"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </nav>

        <div>
            <a href="#" role="button"
                class="js-open-sandbox-modal inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] px-4 py-2 font-bold text-base shadow-md rounded-0 hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-[#1F3131] transition-colors duration-200"
                aria-label="Schedule a consultation - opens contact form">
                <span>Schedule a consultation</span>
            </a>
        </div>
    </div>
</header>
<!-- Modal: Contact Form (Navigation) -->
<div id="sandbox-nav-modal" class="fixed inset-0 z-[1000] hidden overflow-y-auto">
    <div class="absolute inset-0 bg-white/10 backdrop-blur-sm"></div>
    <div class="absolute inset-0 flex items-start sm:items-center justify-center px-2 sm:px-4 py-4 sm:py-8">
        <div role="dialog" aria-modal="true" aria-labelledby="sandbox-nav-modal-title"
            class="relative w-full max-w-full sm:max-w-2xl md:max-w-4xl lg:max-w-6xl xl:max-w-7xl my-auto">
            <div class="absolute -inset-2 sm:-inset-4 rounded-[4px] opacity-70 blur-2xl pointer-events-none"
                style="background: radial-gradient(60% 60% at 50% 50%, rgba(2,25,22,0.55) 0%, rgba(2,25,22,0) 70%);">
            </div>
            <div class="relative bg-white rounded-[4px] shadow-2xl ring-1 ring-black/5 overflow-hidden">
                <button type="button" aria-label="Close modal"
                    class="absolute right-2 sm:right-3 top-2 sm:top-3 z-30 p-1.5 sm:p-2 rounded-[4px] text-red-500 hover:text-red-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#1F3131]/30 transition-colors"
                    id="sandbox-nav-modal-close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 md:h-7 md:w-7"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="grid grid-cols-1 lg:grid-cols-2 z-20 relative">
                    <div
                        class="relative p-6 sm:p-8 md:p-12 lg:p-16 xl:p-20 text-white min-h-[300px] sm:min-h-[400px] lg:min-h-auto">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/icons/primary-bg.svg' ); ?>"
                            alt=""
                            class="absolute inset-0 z-0 w-full h-full object-cover object-bottom opacity-95 pointer-events-none select-none"
                            decoding="async" loading="lazy">
                        <div class="absolute inset-0 z-0 bg-[#0E3C35]/60"></div>
                        <div class="relative z-10">
                            <h3 id="sandbox-nav-modal-title"
                                class="text-2xl sm:text-3xl md:text-4xl font-semibold leading-tight">
                                Let’s solve your <?php echo strtolower( get_the_title() ); ?> challenges.
                            </h3>

                            <p class="mt-3 sm:mt-4 text-white/85 text-sm sm:text-base leading-relaxed">
                                Work with experienced teams to design, build, and optimize
                                <?php echo strtolower( get_the_title() ); ?> systems that scale, remain compliant,
                                and perform under real-world constraints.
                            </p>

                            <a target="_blank" href="/careers"
                                class="mt-4 sm:mt-6 inline-flex items-center text-[#98C441] text-sm sm:text-base font-medium underline underline-offset-4 hover:text-[#8DC63F] transition-colors">
                                Looking for a new career? View job openings
                                <svg class="ml-1 h-3 w-3 sm:h-4 sm:w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h4m0 0v4m0-4L10 14" />
                                </svg>
                            </a>
                            <div class="mt-8 sm:mt-12 lg:mt-16">
                                <?php
                                $hubspot_link = get_field( 'hubspot_link' );
                                $expert_name = get_field( 'expert_name' );

                                if ( $hubspot_link ) :
                                    ?>
                                <a target="_blank" href="<?php echo esc_url( $hubspot_link ); ?>"
                                    class="inline-block bg-[#8DC63F] hover:bg-[#7AB22E] text-black font-bold px-4 sm:px-6 py-2.5 sm:py-3 text-sm sm:text-base transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#7AB22E] focus:ring-offset-2 focus:ring-offset-[#1F3131] whitespace-nowrap"
                                    aria-label="Schedule a consultation - opens contact form">
                                    Request a meeting with
                                    <?php echo esc_html( $expert_name ? $expert_name : 'our expert' ); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white p-4 sm:p-6 md:p-8 lg:p-6 xl:p-8 rounded-[4px] shadow-2xl lg:mt-0 lg:pt-16 xl:pt-16">
                        <?php
                        $hubspot_form_embed = get_field( 'hubspot_form_embedd' );
                        if ( $hubspot_form_embed ) :
                            echo $hubspot_form_embed;
                        else :
                            ?>
                        <p class="text-gray-500 italic">Coming Soon</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    var modal = document.getElementById('sandbox-nav-modal');
    if (!modal) return;

    function openModal(e) {
        if (e) e.preventDefault();
        modal.classList.remove('hidden');
        // Prevent body scroll on mobile while allowing modal scroll
        document.body.style.overflow = 'hidden';
        document.documentElement.style.overflow = 'hidden';
        // Scroll to top of modal on mobile
        setTimeout(function() {
            modal.scrollTop = 0;
        }, 10);
        var c = document.getElementById('sandbox-nav-modal-close');
        if (c) c.focus();
    }

    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        document.documentElement.style.overflow = '';
    }

    document.addEventListener('click', function(e) {
        var trigger = e.target.closest('.js-open-sandbox-modal');
        if (trigger) {
            openModal(e);
        }
    });

    var closeBtn = document.getElementById('sandbox-nav-modal-close');
    if (closeBtn) closeBtn.addEventListener('click', closeModal);

    // Close on backdrop click (but not on modal content)
    modal.addEventListener('click', function(e) {
        // Close if clicking on the backdrop or the first child (backdrop blur div)
        if (e.target === modal || e.target === modal.firstElementChild) {
            closeModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
})();
</script>
