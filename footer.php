<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PiedmontGlobal
 */

?>

<footer class="bg-[linear-gradient(to_bottom,_#1F3131_50%,_#006155_100%)] text-white pt-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">

            <!-- Column 1 -->
            <div>
                <span class="text-lg font-semibold">Solutions</span>
                <?php
                    $terms = get_terms(array(
                        'taxonomy'   => 'solution',  // your taxonomy slug
                        'hide_empty' => false,        // only show terms with posts
                        'orderby'    => 'name',
                        'order'      => 'ASC',
                    ));

                    if (!is_wp_error($terms) && !empty($terms)): ?>
                <ul class="space-y-4 mt-4 text-base font-normal text-[#F9F8F6]/70">
                    <?php foreach ($terms as $term): ?>
                    <li>
                        <a href="<?php echo esc_url(get_term_link($term)); ?>" class="hover:text-white">
                            <?php echo esc_html($term->name); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

            </div>


            <!-- Column 2 -->
            <div>
                <span class="text-lg font-semibold">Industries</span>
                <ul class="space-y-4 mt-4  text-base font-normal text-[#F9F8F6]/70">
                    <?php
                        $industries = new WP_Query([
                            'post_type' => 'industry',
                            'posts_per_page' => -1, // Get all posts
                            'post_status' => 'publish', // Get only published posts
                            'orderby' => 'title', // Order by title
                            'order' => 'ASC' // In ascending order
                        ]);

                        if ($industries->have_posts()) :
                            while ($industries->have_posts()) : $industries->the_post();
                        ?>
                                    <li><a href="<?php the_permalink(); ?>" class="hover:text-white"><?php the_title(); ?></a></li>
                                    <?php
                            endwhile;
                            wp_reset_postdata(); // Reset the post data to the main query
                        endif;
                        ?>
                </ul>
            </div>

            

            <div>
                <span class="text-lg font-semibold">Careers</span>
                <ul class="space-y-4 mt-4 text-base font-normal text-[#F9F8F6]/70">
                            <?php
                        $menu_items = wp_get_nav_menu_items(16);

                        if ($menu_items) {
                            foreach ($menu_items as $menu_item) {
                                echo '<li><a href="' . esc_url($menu_item->url) . '" class="hover:text-white normal-case">' . esc_html($menu_item->title) . '</a></li>';
                            }
                        }
                        ?>
                </ul>

            </div>


            <!-- Column 4 -->
            <div>
                <span class="text-lg font-semibold mb-4">Company</span>
                <ul class="space-y-4 mt-4 text-base font-normal text-[#F9F8F6]/70">
                                <?php
                $menu_items = wp_get_nav_menu_items(7);

                if ($menu_items) {
                    foreach ($menu_items as $menu_item) {
                        echo '<li><a href="' . esc_url($menu_item->url) . '" class="hover:text-white normal-case">' . esc_html($menu_item->title) . '</a></li>';
                    }
                }
                ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Logo, Address, Footer Image -->

    <footer class="relative text-white overflow-hidden pt-24">
        <!-- Content -->
        <div
            class="relative z-10 flex flex-col md:flex-row items-start justify-between max-w-7xl mx-auto px-6 md:px-5 gap-8">
            <!-- Logo + Address -->
            <div class="flex flex-col space-y-8 items-start pb-24 md:pb-32">
                <?php
                $custom_logo_id = get_theme_mod('custom_logo');
                $home_url = esc_url(home_url('/'));
                if ($custom_logo_id) {
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    echo '<a href="' . $home_url . '" aria-label="Homepage" class="inline-block transition-transform duration-300 hover:scale-[0.98]">
                            <img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="h-10 object-contain md:h-16 w-auto mb-4" />
                        </a>';
                } else {
                    echo '<a href="' . $home_url . '" class="text-xl font-bold inline-block transition-transform duration-300 hover:scale-[0.98]" aria-label="Homepage">' . get_bloginfo('name') . '</a>';
                }
                ?>

                <p class="not-italic text-base text-[#F9F8F6] leading-relaxed">
                    <?php the_field('company_address', 'option'); ?>
                </p>

                <p class="not-italic text-base text-[#F9F8F6] leading-relaxed">
                    <a href="tel:<?php echo preg_replace('/\s+/', '', get_field('company_phone_number', 'option')); ?>">
                        <?php the_field('company_phone_number', 'option'); ?>
                    </a>
                    <br>
                    <a href="mailto:<?php the_field('company_mail', 'option'); ?>">
                        <?php the_field('company_mail', 'option'); ?>
                    </a>
                </p>
                <p class="not-italic text-base text-[#F9F8F6] leading-relaxed">
                    <?php
                $year = date('Y');
                echo '&copy; ' . $year . ' ' . get_bloginfo('name') . '. All rights reserved.';
                ?>
                </p>
                
            </div>
        </div>

        <!-- Footer Image -->
        <div class="relative w-full">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/footer.png'); ?>"
                alt="Footer Image" class="w-full h-auto md:w-auto md:h-auto md:absolute md:bottom-0 md:right-0" />
        </div>
    </footer>

</footer>



</div><!-- #page -->

<?php wp_footer(); ?>

<?php if (is_tax('solution') || is_page_template('taxonomy-solution.php') || is_singular('solutions')) : ?>
<script>
// Section navigation script - runs on solution taxonomy and single solution pages
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.menu-btn');
    const sections = document.querySelectorAll('div[id^="section-"]');
    const rightContent = document.querySelector('.lg\\:w-2\\/3');

    // Double-check elements exist (safety measure)
    if (buttons.length === 0 || sections.length === 0 || !rightContent) {
        return;
    }

    function clearActive() {
        buttons.forEach(btn => {
            btn.classList.remove('opacity-100', 'border-l-4', 'border-l-[#98C441]', 'font-semibold',
                'text-[#0F1E1E]');
            btn.classList.add('opacity-50', 'border-l-0', 'font-medium', 'text-[#555F58]');
            btn.setAttribute('aria-current', 'false');
        });
    }

    function setActive(index) {
        if (index >= 0 && index < buttons.length) {
            clearActive();
            buttons[index].classList.add('opacity-100', 'border-l-4', 'border-l-[#98C441]', 'font-semibold', 'text-[#0F1E1E]');
            buttons[index].classList.remove('opacity-50', 'border-l-0', 'font-medium', 'text-[#555F58]');
            buttons[index].setAttribute('aria-current', 'true');
        }
    }

    // Add click event listeners to buttons
    buttons.forEach((btn, i) => {
        btn.addEventListener('click', () => {
            if (sections[i]) {
                sections[i].scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                setActive(i);
            }
        });
    });

    // Add scroll event listener with throttling
    let ticking = false;
    rightContent.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                const scrollPos = rightContent.scrollTop + rightContent.offsetHeight / 3;
                for (let i = sections.length - 1; i >= 0; i--) {
                    if (scrollPos >= sections[i].offsetTop) {
                        setActive(i);
                        break;
                    }
                }
                ticking = false;
            });
            ticking = true;
        }
    });

    // Initialize with first section active
    setActive(0);
});
</script>
<?php endif; ?>

<!-- Owl Carousel lazy loading is now handled by owl-lazy-loader.js -->


<!-- About Us carousel moved to lazy loading system above -->



<!-- Recognized carousel moved to lazy loading system above -->



<!-- Contracting vehicles carousel moved to lazy loading system above -->





<!-- Certificate carousel moved to lazy loading system above -->




<!-- Testimonial carousel moved to lazy loading system above -->

<!-- Owl Carousel initialization now handled by bulletproof lazy loader -->

<script>
(function() {
    // Lazy-init AOS on first interaction or when any [data-aos] nears viewport
    if (!document.querySelector('[data-aos]')) return;

    var initialized = false;
    function initAOS() {
        if (initialized) return;
        initialized = true;
        if (window.AOS && typeof window.AOS.init === 'function') {
            window.AOS.init({ once: true, duration: 600 });
        }
        // Cleanup listeners after init
        ['scroll','mousemove','touchstart','keydown'].forEach(function(evt) {
            window.removeEventListener(evt, initAOSPassive, passiveOpts);
        });
        if (io) io.disconnect();
    }

    var passiveOpts = { once: true, passive: true };
    function initAOSPassive() { initAOS(); }
    ['scroll','mousemove','touchstart','keydown'].forEach(function(evt) {
        window.addEventListener(evt, initAOSPassive, passiveOpts);
    });

    var io = null;
    if ('IntersectionObserver' in window) {
        io = new IntersectionObserver(function(entries) {
            for (var i = 0; i < entries.length; i++) {
                if (entries[i].isIntersecting) { initAOS(); break; }
            }
        }, { rootMargin: '200px' });
        var targets = document.querySelectorAll('[data-aos]');
        for (var j = 0; j < targets.length; j++) io.observe(targets[j]);
    }
})();
</script>


<!-- Cookie Consent Component -->
<?php get_template_part('components/common/cookie-consent'); ?>
<?php get_template_part('components/common/ai-widget'); ?>
<script src="https://static.claydar.com/init.v1.js?id=ckaaQABdft"></script>
</body>

</html>