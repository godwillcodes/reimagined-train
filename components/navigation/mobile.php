<div
    class="max-w-7xl mx-auto px-6 py-6 fixed top-0 w-full z-50 bg-[#1F3131] flex lg:hidden justify-between items-center">
    <div class="flex items-center">
    <?php
$custom_logo_id = get_theme_mod('custom_logo');
$home_url = esc_url(home_url('/'));

if ($custom_logo_id) {
  $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
  echo '<a href="' . $home_url . '" class="inline-block">
          <img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="h-8 w-auto" />
        </a>';
} else {
  echo '<a href="' . $home_url . '" class="text-xl font-bold">' . get_bloginfo('name') . '</a>';
}
?>

    </div>

    <div x-data="{ 
        open: false, 
        submenu: null,
        isTransitioning: false,
        subSolutionTermId: null,
        subSolutionTermName: '',
        toggleMenu() {
            this.open = !this.open;
            if (!this.open) {
                this.submenu = null;
                this.isTransitioning = false;
            }
        },
        openSubmenu(menu) {
            if (this.isTransitioning) return;
            this.isTransitioning = true;
            this.submenu = menu;
            // Reset transition flag after animation completes
            setTimeout(() => {
                this.isTransitioning = false;
            }, 300);
        },
        openSolutionTerm(id, name) {
            if (this.isTransitioning) return;
            this.isTransitioning = true;
            this.subSolutionTermId = id;
            this.subSolutionTermName = name;
            this.submenu = 'solutions-term';
            setTimeout(() => {
                this.isTransitioning = false;
            }, 300);
        },
        closeSubmenu() {
            if (this.isTransitioning) return;
            this.isTransitioning = true;
            this.submenu = null;
            this.subSolutionTermId = null;
            this.subSolutionTermName = '';
            // Reset transition flag after animation completes
            setTimeout(() => {
                this.isTransitioning = false;
            }, 200);
        }
    }" 
    @keydown.escape.window="open = false; submenu = null; isTransitioning = false" 
    x-cloak>
        
        <button @click="toggleMenu()" 
                :aria-expanded="open"
                aria-label="Toggle main menu" 
                class="focus:outline-none focus:ring-2 focus:ring-white/50 rounded-md p-1">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/menu.svg'); ?>"
                class="h-6 w-auto transition-opacity duration-200"
                :class="{ 'opacity-50': open }"
                alt="Menu Icon">
        </button>

        <!-- Overlay -->
        <div x-show="open" 
             x-cloak 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-300" 
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm"
             @click="open = false; submenu = null" 
             aria-hidden="true"></div>

        <!-- Mobile Menu -->
        <div x-show="open" 
             x-cloak 
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="translate-y-full opacity-0" 
             x-transition:enter-end="translate-y-0 opacity-100"
             x-transition:leave="transition ease-in duration-300" 
             x-transition:leave-start="translate-y-0 opacity-100"
             x-transition:leave-end="translate-y-full opacity-0"
             class="fixed inset-x-4 bottom-4 z-50 rounded-2xl bg-white/20 backdrop-blur-2xl ring-1 ring-white/10 shadow-xl p-6 text-white max-h-[80vh] overflow-y-auto"
             style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(20px);" 
             role="dialog"
             aria-label="Mobile menu"
             @click.away="open = false; submenu = null; isTransitioning = false">

            <!-- Main Menu -->
            <div x-show="submenu === null" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-4">
                <div class="flex justify-end mb-6">
                    <button @click="open = false" 
                            class="text-white hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-white/50 rounded-md p-1">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="space-y-3">
                    <button @click="openSubmenu('solutions')"
                        class="w-full text-left text-base font-semibold text-white hover:text-[#98C441] transition-colors duration-200 flex items-center justify-between py-2 px-1 rounded-md hover:bg-white/10">
                        Solutions
                        <svg class="h-4 w-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <button @click="openSubmenu('industries')"
                        class="w-full text-left text-base font-semibold text-white hover:text-[#98C441] transition-colors duration-200 flex items-center justify-between py-2 px-1 rounded-md hover:bg-white/10">
                        Industries
                        <svg class="h-4 w-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <button @click="openSubmenu('resources')"
                        class="w-full text-left text-base font-semibold text-white hover:text-[#98C441] transition-colors duration-200 flex items-center justify-between py-2 px-1 rounded-md hover:bg-white/10">
                        Resources
                        <svg class="h-4 w-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <button @click="openSubmenu('about')"
                        class="w-full text-left text-base font-semibold text-white hover:text-[#98C441] transition-colors duration-200 flex items-center justify-between py-2 px-1 rounded-md hover:bg-white/10">
                        Who We Are
                        <svg class="h-4 w-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </nav>

                <div class="mt-6">
                    <a href="/contact"
                        class="block w-full text-center bg-[#98C441] text-[#1F3131] font-medium py-3 rounded-lg hover:bg-[#8ABF3B] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#98C441]/50">
                        Request Demo
                    </a>
                </div>
            </div>

            <!-- Submenus -->
            <div x-show="submenu !== null" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-x-8"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 translate-x-8">
                <div class="flex justify-between items-center mb-6">
                    <button @click="closeSubmenu()" 
                            class="text-white hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-white/50 rounded-md p-1">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <span class="text-base font-semibold"
                        x-text="submenu ? submenu.charAt(0).toUpperCase() + submenu.slice(1) : ''"></span>
                    <button @click="open = false" 
                            class="text-white hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-white/50 rounded-md p-1">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Solutions (Level 1) -->
                <div x-show="submenu === 'solutions'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-4"
                     class="space-y-3">
                    <?php 
                $terms = get_terms([
                    'taxonomy'   => 'solution',
                    'hide_empty' => false,
                ]);
                if (!empty($terms) && !is_wp_error($terms)) :
                    foreach ($terms as $term) : 
                        $child_posts = get_posts([
                            'post_type'      => 'solutions',
                            'tax_query'      => [[
                                'taxonomy' => 'solution',
                                'field'    => 'term_id',
                                'terms'    => $term->term_id,
                            ]],
                            'posts_per_page' => 1,
                        ]);
                        $has_children = !empty($child_posts);
                        ?>
                        <?php if ($has_children) : ?>
                            <button @click="openSolutionTerm(<?php echo (int)$term->term_id; ?>, '<?php echo esc_js($term->name); ?>')"
                                class="w-full text-left text-white hover:text-[#98C441] transition-colors duration-200 flex items-center justify-between py-2 px-1 rounded-md hover:bg-white/10">
                                <span><?php echo esc_html($term->name); ?></span>
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        <?php else : ?>
                            <a href="<?php echo esc_url(get_term_link($term)); ?>"
                                class="block text-white hover:text-[#98C441] transition-colors duration-200 py-2 px-1 rounded-md hover:bg-white/10">
                                <?php echo esc_html($term->name); ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; endif; ?>
                    <a href="/solutions"
                        class="block text-base my-6 font-semibold text-white hover:text-[#98C441] transition-colors duration-200 py-2 px-1 rounded-md hover:bg-white/10">
                        Explore All Solutions
                    </a>
                </div>

                <!-- Solutions (Level 2: Posts within selected term) -->
                <div x-show="submenu === 'solutions-term'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-4"
                     class="space-y-3">
                    <div class="flex justify-between items-center mb-2">
                        <button @click="openSubmenu('solutions')" 
                                class="text-white hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-white/50 rounded-md p-1">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <span class="text-base font-semibold" x-text="subSolutionTermName"></span>
                        <span class="w-5"></span>
                    </div>

                    <?php 
                    // Pre-render post lists for each term and toggle via Alpine by term id
                    $level2_terms = get_terms([
                        'taxonomy'   => 'solution',
                        'hide_empty' => false,
                    ]);
                    if (!empty($level2_terms) && !is_wp_error($level2_terms)) :
                        foreach ($level2_terms as $t) :
                            $posts_in_term = get_posts([
                                'post_type'      => 'solutions',
                                'tax_query'      => [[
                                    'taxonomy' => 'solution',
                                    'field'    => 'term_id',
                                    'terms'    => $t->term_id,
                                ]],
                                'posts_per_page' => -1,
                                'orderby'        => 'title',
                                'order'          => 'ASC',
                            ]);
                            ?>
                            <div x-show="subSolutionTermId === <?php echo (int)$t->term_id; ?>" x-cloak>
                                <?php if (!empty($posts_in_term)) : ?>
                                    <?php foreach ($posts_in_term as $p) : ?>
                                        <a href="<?php echo esc_url(get_permalink($p->ID)); ?>"
                                            class="block text-white hover:text-[#98C441] transition-colors duration-200 py-2 px-1 rounded-md hover:bg-white/10">
                                            <?php echo esc_html(get_the_title($p->ID)); ?>
                                        </a>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <?php if (!empty($t->description)) : ?>
                                        <div class="text-white/80 text-sm">
                                            <?php echo wp_kses_post($t->description); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; endif; ?>
                </div>

                <!-- Industries -->
                <div x-show="submenu === 'industries'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-4"
                     class="space-y-3">
                    <?php
                $industries = new WP_Query([
                    'post_type'      => 'industry',
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                ]);
                if ($industries->have_posts()) {
                    while ($industries->have_posts()) {
                        $industries->the_post();
                        echo '<a href="' . esc_url(get_permalink()) . '" class="block text-white hover:text-[#98C441] transition-colors duration-200 py-2 px-1 rounded-md hover:bg-white/10">' . esc_html(get_the_title()) . '</a>';
                    }
                    wp_reset_postdata();
                }
                ?>
                    <a href="/industries" 
                       class="block text-base font-semibold text-white hover:text-[#98C441] my-6 transition-colors duration-200 py-2 px-1 rounded-md hover:bg-white/10">
                        Explore All Industries
                    </a>
                </div>

                <!-- Resources -->
                <div x-show="submenu === 'resources'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-4"
                     class="space-y-3">
                    <?php
                $menu_items = wp_get_nav_menu_items(14); // Resources menu
                if ($menu_items) {
                    foreach ($menu_items as $menu_item) {
                        echo '<a href="' . esc_url($menu_item->url) . '" class="block text-white hover:text-[#98C441] transition-colors duration-200 py-2 px-1 rounded-md hover:bg-white/10">' . esc_html($menu_item->title) . '</a>';
                    }
                }
                ?>
                 <a href="/resources/" 
                    class="block text-base font-semibold text-white hover:text-[#98C441] my-6 transition-colors duration-200 py-2 px-1 rounded-md hover:bg-white/10">
                    Explore All Resources
                 </a>
                </div>

                <!-- About -->
                <div x-show="submenu === 'about'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-4"
                     class="space-y-3">
                    <?php
                $menu_items = wp_get_nav_menu_items(13); // About menu
                if ($menu_items) {
                    foreach ($menu_items as $menu_item) {
                        echo '<a href="' . esc_url($menu_item->url) . '" class="block text-white hover:text-[#98C441] transition-colors duration-200 py-2 px-1 rounded-md hover:bg-white/10">' . esc_html($menu_item->title) . '</a>';
                    }
                }
                ?>
                </div>

                <div class="mt-6">
                    <a href="/contact"
                        class="block w-full text-center bg-[#98C441] text-[#1F3131] font-medium py-3 rounded-lg hover:bg-[#8ABF3B] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#98C441]/50">
                        Schedule a consultation
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>