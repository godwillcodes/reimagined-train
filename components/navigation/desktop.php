<!-- Desktop Navigation Component -->
 
<header class="hidden lg:block fixed w-full z-50 transition-all duration-300" x-data="{ 
        scrolled: false, 
        logoDefault: '<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod("custom_logo"), "full" )[0] ); ?>',
        logoScrolled: '<?php echo esc_url( get_template_directory_uri() . "/assets/icons/pglogo-light.svg" ); ?>'
        }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 100 })"
    :class="scrolled ? 'bg-gradient-to-b from-[#F9F8F6]/95 to-[#F9F8F6]/70 top-0 backdrop-blur-xl shadow-[0_4px_30px_rgba(0,0,0,0.1)] text-black' : '<?php echo is_front_page() ? 'top-[60px]' : 'top-0'; ?>'"
    style="will-change: transform;">
    <div class="max-w-7xl mx-auto py-4 px-6 lg:px-0 flex items-center justify-between">

        <!-- Logo -->
        <div class="flex items-center">
            <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="Home">
                <img :src="scrolled ? logoScrolled : logoDefault" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>"
                    class="h-8 w-auto transition-all duration-300 hover:scale-95" />
            </a>
        </div>


        <!-- Navigation -->
        <nav class="flex items-center space-x-6 text-base font-medium transition-colors duration-300"
            :class="scrolled ? 'text-black' : 'text-white'" role="menubar" aria-label="Main navigation">
            <!-- Solutions Dropdown -->
            <div class="relative" x-data="{ open: false, init() { this.$watch('open', v => { if (v) this.$nextTick(() => { const first = this.$refs.panel?.querySelector('a[href], button'); if (first) first.focus(); }); }); } }" @mouseenter="open = true" @mouseleave="open = false" @keydown.escape.window="if(open) { open = false; $nextTick(() => $refs.trigger?.focus()) }">
                <button x-ref="trigger" @click="open = !open"
                    class="inline-flex items-center gap-1 hover:text-[#98C441] transition-colors duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441]"
                    :aria-expanded="open.toString()" aria-haspopup="true" aria-controls="solutions-menu" id="solutions-trigger">
                    <span class="font-normal">Solutions</span>
                    <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': open }"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" />
                    </svg>
                </button>
                <!-- Dropdown Panel -->
                <div id="solutions-menu" x-ref="panel" x-show="open" x-cloak x-transition:enter="transition ease-out duration-300 delay-100"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute left-1/2 top-full  z-40 mt-0 w-[950px] -translate-x-1/2 rounded bg-gradient-to-b from-[#F9F8F6]/95 to-[#F9F8F6]/95 backdrop-blur-sm shadow-[0_4px_30px_rgba(0,0,0,0.1)]  p-8 overflow-hidden  "
                    @click.away="open = false" role="menu" aria-label="Solutions menu">

                    <?php 
                        // Ensure taxonomy exists and fetch parent terms
                        if (taxonomy_exists('solution')) {
                            $parents = get_terms([
                                'taxonomy'   => 'solution',
                                'hide_empty' => false,
                                'parent'     => 0,
                                'orderby'    => 'name',
                                'order'      => 'ASC',
                            ]);
                        } else {
                            $parents = [];
                        }
                        ?>

                    <?php if (!empty($parents) && !is_wp_error($parents)) : ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
                         <?php foreach ($parents as $parent) : ?>
                        <div>
                            <a href="<?php echo esc_url(get_term_link($parent)); ?>"
                                class="block mb-3 font-semibold text-[#1F3131] hover:text-[#98C441]">
                                <?php echo esc_html($parent->name); ?>
                            </a>

                            <?php 
                                // Fetch posts assigned to this taxonomy term
                                $child_posts = get_posts([
                                    'post_type'      => 'solutions',
                                    'tax_query'      => [[
                                        'taxonomy' => 'solution',
                                        'field'    => 'term_id',
                                        'terms'    => $parent->term_id,
                                    ]],
                                    'posts_per_page' => -1,
                                    'orderby'        => 'title',
                                    'order'          => 'ASC',
                                ]);
                                 ?>

                             <?php if (!empty($child_posts)) : ?>
                            <ul class="space-y-2">
                                <?php foreach ($child_posts as $post) : ?>
                                <li>
                                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"
                                        class="relative block pl-3 text-base font-normal text-[#1F3131] group overflow-hidden">
                                        <span class="absolute left-0 top-0 h-full w-1 bg-[#98C441] scale-y-0 
                                                 group-hover:scale-y-100 transition-transform duration-300 origin-top"></span>
                                        <span class="relative z-10 text-sm"><?php echo esc_html(get_the_title($post->ID)); ?></span>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                             <?php else : ?>
                                 <?php if (!empty($parent->description)) : ?>
                                     <div class="mt-2 text-sm text-gray-600">
                                         <?php echo wp_kses_post($parent->description); ?>
                                     </div>
                                 <?php endif; ?>
                             <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else : ?>
                    <?php 
                        // Fallback: flat list of terms
                        $flat_terms = taxonomy_exists('solution') ? get_terms([
                            'taxonomy'   => 'solution',
                            'hide_empty' => true,
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                        ]) : [];
                        ?>
                    <?php if (!empty($flat_terms) && !is_wp_error($flat_terms)) : ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                         <?php foreach ($flat_terms as $t) : ?>
                         <?php 
                             $t_posts = get_posts([
                                 'post_type'      => 'solutions',
                                 'tax_query'      => [[
                                     'taxonomy' => 'solution',
                                     'field'    => 'term_id',
                                     'terms'    => $t->term_id,
                                 ]],
                                 'posts_per_page' => 1,
                             ]);
                         ?>
                         <div>
                             <a href="<?php echo esc_url(get_term_link($t)); ?>"
                                 class="relative block pl-3 text-base font-normal text-[#1F3131] group overflow-hidden">
                                 <span class="absolute left-0 top-0 h-full w-1 bg-[#98C441] scale-y-0 
                                      group-hover:scale-y-100 transition-transform duration-300 origin-top"></span>
                                 <span class="relative z-10"><?php echo esc_html($t->name); ?></span>
                             </a>
                             <?php if (empty($t_posts) && !empty($t->description)) : ?>
                                 <div class="mt-2 text-sm text-gray-600">
                                     <?php echo wp_kses_post($t->description); ?>
                                 </div>
                             <?php endif; ?>
                         </div>
                         <?php endforeach; ?>
                    </div>
                    <?php else : ?>
                    <p>No taxonomy terms found in the 'solution' taxonomy.</p>
                    <?php endif; ?>
                    <?php endif; ?>


                    <a href="<?php echo esc_url(site_url('/solutions')); ?>"
                        class="flex flex-col space-y-1 mt-8 pt-6 border-t border-[#DFDAD4] transition-all duration-300 w-[90%] mx-auto transform group outline-none">
                        <div class="flex items-center justify-center">
                            <p
                                class="text-sm font-bold text-[#1F3131] text-center group-hover:text-[#98C441] transition-colors duration-300">
                                Explore all solutions
                            </p>
                            <!-- Right Arrow SVG -->
                            <svg class="w-4 h-4 ml-2 text-[#1F3131] group-hover:text-[#98C441] group-hover:translate-x-1 transition-colors duration-300"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>

                </div>
            </div>
            <!-- Industries Dropdown -->
            <div class="relative" x-data="{ open: false, init() { this.$watch('open', v => { if (v) this.$nextTick(() => { const first = this.$refs.panel?.querySelector('a[href], button'); if (first) first.focus(); }); }); } }" @mouseenter="open = true" @mouseleave="open = false" @keydown.escape.window="if(open) { open = false; $nextTick(() => $refs.trigger?.focus()) }">
                <button x-ref="trigger" @click="open = !open"
                    class="inline-flex items-center gap-1 hover:text-[#98C441] transition-colors duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441]"
                    :aria-expanded="open.toString()" aria-haspopup="true" aria-controls="industries-menu" id="industries-trigger">
                    <span class="font-normal">Industries</span>
                    <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': open }"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" />
                    </svg>
                </button>
                <!-- Dropdown Panel -->
                <div id="industries-menu" x-ref="panel" x-show="open" x-cloak x-transition:enter="transition ease-out duration-300 delay-100"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute left-1/2 top-full  z-40 mt-4 w-72 -translate-x-1/2 rounded bg-gradient-to-b from-[#F9F8F6]/95 to-[#F9F8F6]/95 backdrop-blur-xl shadow-[0_4px_30px_rgba(0,0,0,0.1)]  p-6 overflow-hidden  "
                    @click.away="open = false" role="menu" aria-label="Industries menu">

                    <div class="space-y-4">
                        <?php
                        $solutions = new WP_Query([
                            'post_type'      => 'industry',
                            'posts_per_page' => -1,
                            'post_status'    => 'publish',
                            'orderby'        => 'title',
                            'order'          => 'ASC'
                        ]);

                        if ($solutions->have_posts()) :
                            while ($solutions->have_posts()) : $solutions->the_post(); ?>
                        <a href="<?php the_permalink(); ?>"
                            class="flex flex-col space-y-1 pt-2 relative group outline-none overflow-hidden">
                            <div class="pl-3 relative">
                                <p class="text-base font-normal text-[#1F3131] transition-colors duration-300">
                                    <?php the_title(); ?>
                                </p>
                                <!-- left bar -->
                                <span
                                    class="absolute left-0 top-0 h-full w-1 bg-[#98C441] scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-top"></span>
                            </div>
                        </a>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>

                        <a href="<?php echo esc_url(site_url('/industries')); ?>"
                            class="flex flex-col space-y-1 mt-6 pt-4 border-t border-[#DFDAD4] transition-all duration-300 w-[90%] mx-auto transform group outline-none">
                            <div class="flex items-center justify-center">
                                <p
                                    class="text-sm font-bold text-[#1F3131] text-center group-hover:text-[#98C441] transition-colors duration-300">
                                    Explore all industries
                                </p>
                                <!-- Right Arrow SVG -->
                                <svg class="w-4 h-4 ml-2 text-[#1F3131] group-hover:text-[#98C441] group-hover:translate-x-1 transition-all duration-500 ease-in-out"
                                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>

                    </div>
                </div>
            </div>


            <!-- ABOUT US DROPDOWN -->
            <div class="relative" x-data="{ openAbout: false, init() { this.$watch('openAbout', v => { if (v) this.$nextTick(() => { const first = this.$refs.aboutPanel?.querySelector('a[href], button'); if (first) first.focus(); }); }); } }" @mouseenter="openAbout = true"
                @mouseleave="openAbout = false" @keydown.escape.window="if(openAbout) { openAbout = false; $nextTick(() => $refs.aboutTrigger?.focus()) }">
                <button x-ref="aboutTrigger" @click="openAbout = !openAbout"
                    class="inline-flex items-center gap-1 hover:text-[#98C441] transition-colors duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441]"
                    :aria-expanded="openAbout.toString()" aria-haspopup="true" aria-controls="about-menu" id="about-trigger">
                    <span class="font-normal">Who we are</span>
                    <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': openAbout }"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" />
                    </svg>
                </button>
                <div id="about-menu" x-ref="aboutPanel" x-show="openAbout" x-cloak x-transition:enter="transition ease-out duration-300 delay-100"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute left-1/2 top-full  z-40 mt-4 w-60 -translate-x-1/2 rounded bg-gradient-to-b from-[#F9F8F6]/95 to-[#F9F8F6]/90 backdrop-blur-xl shadow-[0_4px_30px_rgba(0,0,0,0.1)]  p-6 overflow-hidden  "
                    @click.away="openAbout = false" role="menu" aria-label="About menu">

                    <div class="space-y-6">
                        <?php
    $menu_items = wp_get_nav_menu_items(13); // About menu
    if ($menu_items) {
        foreach ($menu_items as $menu_item) {
            echo '
            <a href="' . esc_url($menu_item->url) . '" 
               class="relative block pl-3 text-base font-normal text-[#1F3131] group overflow-hidden">
                <span class="relative z-10">' . esc_html($menu_item->title) . '</span>
                <span class="absolute left-0 top-0 h-full w-1 bg-[#98C441] scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-top"></span>
            </a>';
        }
    }
    ?>
                    </div>

                </div>
            </div>

            <!-- RESOURCES DROPDOWN -->
            <div class="relative" x-data="{ openResources: false, init() { this.$watch('openResources', v => { if (v) this.$nextTick(() => { const first = this.$refs.resourcesPanel?.querySelector('a[href], button'); if (first) first.focus(); }); }); } }" @mouseenter="openResources = true"
                @mouseleave="openResources = false" @keydown.escape.window="if(openResources) { openResources = false; $nextTick(() => $refs.resourcesTrigger?.focus()) }">
                <button x-ref="resourcesTrigger" @click="openResources = !openResources"
                    class="inline-flex items-center gap-1 hover:text-[#98C441] transition-colors duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#98C441]"
                    :aria-expanded="openResources.toString()" aria-haspopup="true" aria-controls="resources-menu" id="resources-trigger">
                    <span class="font-normal">Resources</span>
                    <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': openResources }"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" />
                    </svg>
                </button>
                <div id="resources-menu" x-ref="resourcesPanel" x-show="openResources" x-cloak x-transition:enter="transition ease-out duration-300 delay-100"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute left-1/2 top-full  z-40 mt-4 w-72 -translate-x-1/2 rounded bg-gradient-to-b from-[#F9F8F6]/95 to-[#F9F8F6]/90 backdrop-blur-xl shadow-[0_4px_30px_rgba(0,0,0,0.1)]  p-6 overflow-hidden  "
                    @click.away="openResources = false" role="menu" aria-label="Resources menu">

                    <div class="space-y-6">
                        <?php
    $menu_items = wp_get_nav_menu_items(14); // Resources menu
    if ($menu_items) {
        foreach ($menu_items as $menu_item) {
            echo '
            <a href="' . esc_url($menu_item->url) . '" 
               class="relative block pl-3 text-base font-normal text-[#1F3131] group overflow-hidden">
                <span class="relative z-10">' . esc_html($menu_item->title) . '</span>
                <span class="absolute left-0 top-0 h-full w-1 bg-[#98C441] scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-top"></span>
            </a>';
        }
    }
    ?>
                    </div>

                    <a href="/resources/"
                        class="flex flex-col space-y-1 mt-4 pt-4 border-t border-[#DFDAD4] transition-all duration-300 w-[90%] mx-auto transform group outline-none">
                        <div class="flex items-center justify-center">
                            <p
                                class="text-sm font-bold text-[#1F3131] text-center group-hover:text-[#98C441] transition-colors duration-300">
                                Explore all resources
                            </p>
                            <!-- Right Arrow SVG -->
                            <svg class="w-4 h-4 ml-2 text-[#1F3131] group-hover:text-[#98C441] group-hover:translate-x-1 transition-all duration-500 ease-in-out"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>



        </nav>

        <!-- CTA Button -->
        <div>
            <a href="/contact"
                class="inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] px-4 py-2  font-bold text-base shadow-md rounded-0 hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-[#1F3131] transition-colors duration-200"
                aria-label="Schedule a consultation - opens contact form">
                <span>Schedule a consultation</span>

            </a>

        </div>
    </div>
</header>