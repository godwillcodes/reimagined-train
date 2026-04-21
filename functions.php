<?php
/**
 * PiedmontGlobal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PiedmontGlobal
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pg_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on PiedmontGlobal, use a find and replace
		* to change 'pg' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'pg', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'pg' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'pg_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'pg_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pg_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pg_content_width', 640 );
}
add_action( 'after_setup_theme', 'pg_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pg_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pg' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pg' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pg_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pg_scripts() {
	// Tailwind CSS - Load with high priority but defer non-critical parts
	$tailwind_path = get_template_directory() . '/assets/css/output.css';
	$tailwind_uri  = get_template_directory_uri() . '/assets/css/output.css';

	if ( file_exists( $tailwind_path ) ) {
		wp_enqueue_style(
			'pg-tailwind',
			$tailwind_uri,
			array(),
			filemtime( $tailwind_path )
		);
	} elseif ( WP_DEBUG ) {
		error_log( 'Missing Tailwind CSS: ' . $tailwind_path );
	}

	// AOS CSS
	$aos_css_path = get_template_directory() . '/assets/css/aos.css';
	$aos_css_uri  = get_template_directory_uri() . '/assets/css/aos.css';

	if ( file_exists( $aos_css_path ) ) {
		wp_enqueue_style(
			'pg-aos',
			$aos_css_uri,
			array(),
			filemtime( $aos_css_path )
		);
	} elseif ( WP_DEBUG ) {
		error_log( 'Missing AOS CSS: ' . $aos_css_path );
	}

	// Owl Carousel CSS - Removed from global enqueue for lazy loading

	// Alpine.js (self-hosted)
	$alpine_path = get_template_directory() . '/assets/js/alpine.min.js';
	$alpine_uri  = get_template_directory_uri() . '/assets/js/alpine.min.js';

	if ( file_exists( $alpine_path ) ) {
		// Research Paper Form Handler
		wp_enqueue_script(
			'pg-research-paper-form',
			get_template_directory_uri() . '/assets/js/research-paper-form.js',
			array(),
			'1.0.0',
			true
		);

		wp_enqueue_script(
			'pg-alpine',
			$alpine_uri,
			array(),
			filemtime( $alpine_path ),
			true
		);

		$navigation_path = get_template_directory() . '/assets/js/navigation.js';
		$navigation_uri  = get_template_directory_uri() . '/assets/js/navigation.js';

		if ( file_exists( $navigation_path ) ) {
			wp_enqueue_script(
				'pg-navigation',
				$navigation_uri,
				array(),
				filemtime( $navigation_path ),
				true
			);
		} elseif ( WP_DEBUG ) {
			error_log( 'Missing navigation JS: ' . $navigation_path );
		}
	} elseif ( WP_DEBUG ) {
		error_log( 'Missing Alpine JS: ' . $alpine_path );
	}

	// AOS JS
	$aos_js_path = get_template_directory() . '/assets/js/aos.js';
	$aos_js_uri  = get_template_directory_uri() . '/assets/js/aos.js';

	if ( file_exists( $aos_js_path ) ) {
		wp_enqueue_script(
			'pg-aos',
			$aos_js_uri,
			array(),
			filemtime( $aos_js_path ),
			true
		);
	} elseif ( WP_DEBUG ) {
		error_log( 'Missing AOS JS: ' . $aos_js_path );
	}

	// jQuery (conditional loading - only when needed)
	if ( pg_needs_jquery() ) {
		$jquery_path = get_template_directory() . '/assets/js/jquery.min.js';
		$jquery_uri  = get_template_directory_uri() . '/assets/js/jquery.min.js';

		if ( file_exists( $jquery_path ) ) {
			wp_enqueue_script(
				'pg-jquery',
				$jquery_uri,
				array(),
				filemtime( $jquery_path ),
				true
			);
		} elseif ( WP_DEBUG ) {
			error_log( 'Missing jQuery: ' . $jquery_path );
		}
	}

	// Owl Carousel JS - Removed from global enqueue for lazy loading


	// Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pg_scripts' );

/**
 * Add Google Analytics to header
 */
function pg_google_analytics() {
	?>
	<!-- Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-DW83JK7897"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'G-DW83JK7897', {
			anonymize_ip: true,
			cookie_flags: 'SameSite=Lax;Secure'
		});
	</script>
	<?php
}
add_action( 'wp_head', 'pg_google_analytics', 1 );

/**
 * Enqueue single post TOC script only on single.php pages
 */
function pg_single_toc_script() {
	if ( is_single() ) {
		$toc_script_path = get_template_directory() . '/assets/js/single-toc.js';
		$toc_script_uri  = get_template_directory_uri() . '/assets/js/single-toc.js';

		if ( file_exists( $toc_script_path ) ) {
			wp_enqueue_script(
				'pg-single-toc',
				$toc_script_uri,
				array(),
				filemtime( $toc_script_path ),
				true // Load in footer
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'pg_single_toc_script' );


/**
 * Remove WordPress Block Library CSS (render blocker)
 * Since we use Classic Editor + ACF, we don't need Gutenberg styles
 */
function pg_remove_wp_block_library_css() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' ); // WooCommerce blocks
	wp_dequeue_style( 'global-styles' ); // Global styles
}
add_action( 'wp_enqueue_scripts', 'pg_remove_wp_block_library_css', 100 );




/**
 * Determine if jQuery is needed on current page
 * Only load jQuery when actually required
 */
function pg_needs_jquery() {
	// Always load on pages with carousels
	$carousel_pages = array( 'home', 'about-us', 'testimonials', 'resources', 'strategic-globalization' );
	if ( is_page( $carousel_pages ) || is_front_page() ) {
		return true;
	}

	// Load wherever we know a carousel exists via centralized helper.
	if ( function_exists( 'pg_has_carousel' ) && pg_has_carousel() ) {
		return true;
	}
	
	// Load on webinar pages (Forminator dependency)
	if ( is_singular( 'webinar' ) || is_page( 'webinars' ) ) {
		return true;
	}
	
	// Load on pages with comments (WordPress dependency)
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		return true;
	}
	
	// Load if any carousel elements exist in content
	$content = get_the_content();
	$carousel_selectors = array(
		'partners-carousel',
		'aboutus-carousel', 
		'recognized-carousel',
		'contracting-vehicles-carousel',
		'certificate-carousel',
		'testimonial-carousel',
		'sandbox-news-carousel',
		'sandbox-recognized-carousel',
		'related-blogs-carousel',
		'visual-moment-carousel',
		'symposium-speakers-carousel'
	);
	
	foreach ( $carousel_selectors as $selector ) {
		if ( strpos( $content, $selector ) !== false ) {
			return true;
		}
	}
	
	// Also check the current page template file content for carousel classes
	$current_template = get_page_template_slug();
	if ( $current_template ) {
		$template_path = get_template_directory() . '/' . $current_template;
		if ( file_exists( $template_path ) ) {
			$template_content = file_get_contents( $template_path );
			foreach ( $carousel_selectors as $selector ) {
				if ( strpos( $template_content, $selector ) !== false ) {
					return true;
				}
			}
		}
	}
	
	// Load if Forminator forms are present
	if ( function_exists( 'forminator_has_form' ) ) {
		// Check if any Forminator forms are on this page
		global $post;
		if ( $post && has_shortcode( $post->post_content, 'forminator_form' ) ) {
			return true;
		}
	}
	
	return false;
}

/**
 * Defer non-critical CSS loading (safe approach)
 */
function pg_defer_non_critical_css( $html, $handle ) {
	// Defer non-critical CSS files
	$defer_handles = array( 'pg-aos' );
	
	if ( in_array( $handle, $defer_handles ) ) {
		$html = str_replace( 
			"rel='stylesheet'", 
			"rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"", 
			$html 
		);
		// Add noscript fallback
		$html .= '<noscript>' . str_replace( "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"", "rel='stylesheet'", $html ) . '</noscript>';
	}
	
	return $html;
}
add_filter( 'style_loader_tag', 'pg_defer_non_critical_css', 10, 2 );

/**
 * Lazy load Owl Carousel assets when needed
 */
/**
 * Determine if the current page/post/taxonomy uses a carousel.
 */
function pg_has_carousel() {

    // 1. Essential static pages (by slug)
    $carousel_pages = array(
        'home',
        'about',
        'testimonials',
        'resources',
        'strategic-globalization',
		'sandbox',
		'contracting-vehicles'
    );

    if ( is_front_page() || is_page( $carousel_pages ) ) {
        return true;
    }
    
    // Check for any page with 'language-services' in the slug
    if ( is_page() ) {
        global $post;
        if ( $post && strpos( $post->post_name, 'language-services' ) !== false ) {
            return true;
        }
    }

    if ( is_page_template( 'pages/language-access-symposium.php' ) ) {
        return true;
    }

    // 2. Custom post types that feature carousels
    $carousel_post_types = array(
        'industry',
        'solution',
    );

    if ( is_singular( $carousel_post_types ) ) {
        return true;
    }

    // 3. Taxonomies that feature carousels
    $carousel_taxonomies = array(
        'solution', // Solution taxonomy
    );

    foreach ( $carousel_taxonomies as $taxonomy ) {
        if ( is_tax( $taxonomy ) ) {
            return true;
        }
    }

    // 4. Optional: ACF or block field detection (dynamic carousels)
    if ( function_exists( 'get_field' ) && get_field( 'related_blogs' ) ) {
        return true;
    }

    return false;
}

/**
 * Enqueue Owl Carousel assets only if needed.
 */
function pg_lazy_load_owl_carousel() {

    if ( ! pg_has_carousel() ) {
        return;
    }

    // Enqueue the bulletproof lazy loader
    wp_enqueue_script(
        'pg-owl-bulletproof-loader',
        get_template_directory_uri() . '/assets/js/owl-bulletproof-loader.js',
        array( 'pg-jquery' ),
        filemtime( get_template_directory() . '/assets/js/owl-bulletproof-loader.js' ),
        true
    );

    // Pass configuration to the script
    wp_localize_script( 'pg-owl-bulletproof-loader', 'owlBulletproofConfig', array(
        'cssUrl'         => get_template_directory_uri() . '/assets/css/owl.carousel.min.css',
        'themeCssUrl'    => get_template_directory_uri() . '/assets/css/owl.theme.default.min.css',
        'jsUrl'          => get_template_directory_uri() . '/assets/js/owl.carousel.min.js',
        'fallbackTimeout' => 5000,  // 5 seconds fallback
        'retryAttempts'   => 3,
        'retryDelay'      => 1000,
    ) );

    $carousel_a11y_path = get_template_directory() . '/assets/js/carousel-a11y.js';
    if ( file_exists( $carousel_a11y_path ) ) {
        wp_enqueue_script(
            'pg-carousel-a11y',
            get_template_directory_uri() . '/assets/js/carousel-a11y.js',
            array( 'pg-jquery', 'pg-owl-bulletproof-loader' ),
            filemtime( $carousel_a11y_path ),
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'pg_lazy_load_owl_carousel', 20 );


/**
 * Generate responsive image with srcset for better performance
 */
function pg_responsive_image($image_url, $alt, $width, $height, $class = '', $loading = 'lazy', $fetchpriority = '') {
    // For now, return optimized single image
    // In the future, you can implement actual responsive images with multiple sizes
    $attributes = [
        'src' => esc_url($image_url),
        'alt' => esc_attr($alt),
        'width' => $width,
        'height' => $height,
        'loading' => $loading,
        'decoding' => 'async'
    ];
    
    if ($fetchpriority) {
        $attributes['fetchpriority'] = $fetchpriority;
    }
    
    if ($class) {
        $attributes['class'] = esc_attr($class);
    }
    
    $attr_string = '';
    foreach ($attributes as $key => $value) {
        $attr_string .= $key . '="' . $value . '" ';
    }
    
    return '<img ' . trim($attr_string) . ' />';
}



// Font Loading API for LCP optimization
add_action( 'wp_head', function () {
	echo "<script>
		// Font Loading API to prevent LCP delays
		if ('fonts' in document) {
			document.documentElement.classList.add('fonts-loading');
			
			Promise.all([
				document.fonts.load('400 16px Oracle'),
				document.fonts.load('700 16px Oracle')
			]).then(function() {
				document.documentElement.classList.remove('fonts-loading');
				document.documentElement.classList.add('fonts-loaded');
			}).catch(function() {
				// Fallback if fonts fail to load
				document.documentElement.classList.remove('fonts-loading');
				document.documentElement.classList.add('fonts-loaded');
			});
		} else {
			// Fallback for browsers without Font Loading API
			document.documentElement.classList.add('fonts-loaded');
		}
	</script>";
}, 1);

// AOS initialization
add_action( 'wp_footer', function () {
	echo "<script>
		// AOS initialization handled by lazy-init in footer.php

		// Optimize SVG background loading for primary banner
		document.addEventListener('DOMContentLoaded', function() {
			const bannerSection = document.querySelector('[data-bg-svg]');
			if (bannerSection) {
				const svgUrl = bannerSection.getAttribute('data-bg-svg');
				
				// Preload the SVG if not already cached
				if (svgUrl && !document.querySelector('link[href=\"' + svgUrl + '\"]')) {
					const link = document.createElement('link');
					link.rel = 'preload';
					link.as = 'image';
					link.href = svgUrl;
					link.fetchPriority = 'high';
					document.head.appendChild(link);
				}
				
				// Ensure SVG is loaded before showing the section
				const img = new Image();
				img.onload = function() {
					bannerSection.style.opacity = '1';
				};
				img.src = svgUrl;
			}
		});
		
		// Fix Alpine.js null reference errors
		document.addEventListener('DOMContentLoaded', function() {
			// Alpine.js auto-starts by default, no need to manually call Alpine.start()
			// This prevents the 'Alpine has already been initialized' warning
			
			// Auto-open external links in new tab (for hardcoded template links only)
			var siteDomain = window.location.hostname;
			var links = document.querySelectorAll('a[href]:not([target])');
			
			links.forEach(function(link) {
				var href = link.getAttribute('href');
				
				// Skip mailto, tel, and anchor links
				if (href.indexOf('mailto:') === 0 || href.indexOf('tel:') === 0 || href.indexOf('#') === 0) {
					return;
				}
				
				// Check if external
				var isExternal = false;
				
				if (href.indexOf('http') === 0) {
					try {
						var linkDomain = new URL(href).hostname;
						isExternal = (linkDomain !== siteDomain);
					} catch(e) {
						// Invalid URL, skip
						return;
					}
				} else if (href.indexOf('//') === 0) {
					isExternal = true;
				} else if (href.indexOf('/') !== 0) {
					isExternal = true;
				}
				
				if (isExternal) {
					link.setAttribute('target', '_blank');
					link.setAttribute('rel', 'noopener noreferrer');
					
					// Add accessibility indicator
					var existingAria = link.getAttribute('aria-label');
					if (!existingAria) {
						link.setAttribute('aria-label', link.textContent.trim() + ' (opens in new tab)');
					}
				}
			});
		});
	</script>";
}, 100 );

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Table of Contents
function pg_generate_toc($content) {
    // Check if we're on a single post or if content is provided directly
    if (is_single() || !empty($content)) {
        $matches = [];
        // Match all headings from h2 to h6
        preg_match_all('/<h([2-6])(.*?)>(.*?)<\/h[2-6]>/', $content, $matches, PREG_SET_ORDER);

        if ($matches) {
            $toc = '<ul class="space-y-2">';
            foreach ($matches as $i => $heading) {
                $title = wp_strip_all_tags($heading[3]);
                $id = 'toc-' . $i;
				$toc .= '<li class="pb-4 pt-2 border-b border-[#1F3131]/10">
    <a href="#' . esc_attr($id) . '" 
       class="relative block pl-3 text-base font-medium text-[#1F3131] group overflow-hidden transition-colors duration-300">
        <span class="relative z-10">' . esc_html($title) . '</span>
        <span class="absolute left-0 top-0 h-full w-1 bg-[#98C441] scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-top"></span>
    </a>
</li>';

	

                // Inject ID into heading tag
                $content = preg_replace(
                    '/'.preg_quote($heading[0], '/').'/',
                    '<h'.$heading[1].' id="'.$id.'"'.$heading[2].'>'.$heading[3].'</h'.$heading[1].'>',
                    $content,
                    1
                );
            }
            $GLOBALS['pg_toc'] = $toc . '</ul>';
        }
    }
    return $content;
}
add_filter('the_content', 'pg_generate_toc');





/**
 * Local Email Handling + Custom Forminator Hook for eBook PDF Delivery
 *
 * - Configures WordPress PHPMailer to route email through MailHog in local dev.
 * - Hooks into Forminator AJAX submission for a specific eBook download form.
 * - Processes form data, retrieves the correct eBook PDF, and emails it to the user.
 */

// --- Configure WordPress to use MailHog in local environment ---
add_action('phpmailer_init', function($phpmailer) {
    /**
     * Only apply SMTP settings if:
     * - The site is running in "local" environment.
     * - Required SMTP constants are defined in wp-config.php (SMTP_HOST, SMTP_PORT, etc.).
     */
    if (
        defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local'
        && defined('SMTP_HOST') && defined('SMTP_PORT')
    ) {
        $phpmailer->isSMTP();
        $phpmailer->Host       = SMTP_HOST;
        $phpmailer->Port       = SMTP_PORT;
        $phpmailer->SMTPAuth   = SMTP_AUTH;
        $phpmailer->Username   = SMTP_USER;
        $phpmailer->Password   = SMTP_PASS;
        $phpmailer->SMTPSecure = SMTP_SECURE;
    }
});


// --- Hook Forminator AJAX submission for eBook form (ID: 530) ---

/**
 * Handles unauthenticated (public) submissions.
 */
add_action('wp_ajax_nopriv_forminator_submit_form_custom-forms', function() {
    if (isset($_POST['form_id']) && $_POST['form_id'] == 533) {
        pg_process_ebook_pdf($_POST);
    }
}, 5);

/**
 * Handles authenticated (logged-in) submissions.
 */
add_action('wp_ajax_forminator_submit_form_custom-forms', function() {
    if (isset($_POST['form_id']) && $_POST['form_id'] == 533) {
        pg_process_ebook_pdf($_POST);
    }
}, 5);

// --- Hook Forminator AJAX submission for Webinar form (ID: 734) ---

/**
 * Handles unauthenticated (public) submissions for webinar form.
 */
add_action('wp_ajax_nopriv_forminator_submit_form_custom-forms', function() {
    if (isset($_POST['form_id']) && $_POST['form_id'] == 734) {
        pg_process_webinar_access($_POST);
    }
}, 5);

/**
 * Handles authenticated (logged-in) submissions for webinar form.
 */
add_action('wp_ajax_forminator_submit_form_custom-forms', function() {
    if (isset($_POST['form_id']) && $_POST['form_id'] == 734) {
        pg_process_webinar_access($_POST);
    }
}, 5);


// --- Core function: process eBook form submission ---
/**
 * Process the Forminator form data and send eBook PDF to the user.
 *
 * Steps:
 *  1. Extract user data (first name, last name, email) from $_POST.
 *  2. Identify which eBook to send based on current page ID.
 *  3. Fetch the eBook PDF (from ACF field) and validate file existence.
 *  4. Build and send a styled HTML email with the PDF attached.
 *  5. Log success or failure to debug.log for troubleshooting.
 *
 * @param array $post_data Raw $_POST data from AJAX submission.
 */
function pg_process_ebook_pdf($post_data) {
    $user_email = '';
    $first_name = '';
    $last_name  = '';
    
    // --- Extract and sanitize form fields ---
    if (isset($post_data['email-1'])) {
        $user_email = sanitize_email($post_data['email-1']);
    }
    if (isset($post_data['name-1'])) {
        $first_name = sanitize_text_field($post_data['name-1']);
    }
    if (isset($post_data['name-2'])) {
        $last_name = sanitize_text_field($post_data['name-2']);
    }
    
    // --- Identify which eBook to send (based on the page the form was submitted from) ---
    $page_id  = isset($post_data['page_id']) ? intval($post_data['page_id']) : 0;
    $ebook_id = $page_id;
    
    if ($page_id <= 0) {
        error_log('EBOOK PDF ERROR: No page ID found');
        return;
    }
    
    $user_name = trim($first_name . ' ' . $last_name);
    
    // --- Validate essential inputs ---
    if (empty($user_email)) {
        error_log('EBOOK PDF ERROR: No email provided');
        return;
    }
    if (empty($ebook_id)) {
        error_log('EBOOK PDF ERROR: No Ebook ID provided');
        return;
    }
    
    // --- Fetch eBook PDF file from ACF field on Ebook CPT ---
    $pdf_file = get_field('ebook_pdf', $ebook_id);
    
    if (empty($pdf_file) || empty($pdf_file['ID'])) {
        error_log('EBOOK PDF ERROR: No PDF file found for Ebook ID: ' . $ebook_id);
        return;
    }
    
    $pdf_path = get_attached_file($pdf_file['ID']);
    
    if (!file_exists($pdf_path)) {
        error_log('EBOOK PDF ERROR: PDF file does not exist at path: ' . $pdf_path);
        return;
    }
    
    // --- Format eBook title (strip trailing "Ebook") ---
    $ebook_title = get_the_title($ebook_id);
    $ebook_title = str_replace(' Ebook', '', $ebook_title);
    
    // --- Compose HTML email body ---
    $subject = 'Your requested eBook: ' . $ebook_title;
    
    $message  = '<html><body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">';
    $message .= '<div style="max-width:600px; margin:0 auto; padding:20px;">';
    $message .= '<h2 style="color:#1F3131; margin-bottom:20px;">Thank you for your interest!</h2>';
    
    if (!empty($user_name)) {
        $message .= '<p>Hi ' . esc_html($user_name) . ',</p>';
    } else {
        $message .= '<p>Hi there,</p>';
    }
    
    $message .= '<p>Thank you for requesting our eBook: <strong>' . esc_html($ebook_title) . '</strong></p>';
    $message .= '<p>Please find your free copy attached to this email.</p>';
    $message .= '<p>If you have any questions or would like to learn more about our services, feel free to reach out to us.</p>';
    $message .= '<p>Best regards,<br>The Piedmont Global Team</p>';
    $message .= '</div></body></html>';
    
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: Piedmont Global <noreply@piedmontglobal.com>'
    ];
    
    // --- Send email with PDF attachment ---
    $mail_sent = wp_mail($user_email, $subject, $message, $headers, [$pdf_path]);
    
    if ($mail_sent) {
        error_log('EBOOK PDF SUCCESS: Email successfully sent to ' . $user_email);
    } else {
        error_log('EBOOK PDF ERROR: Failed to send email to ' . $user_email);
    }
}

// --- Core function: process Webinar form submission ---
/**
 * Process the Forminator form data for webinar access.
 * This function logs the submission and can be extended for additional processing.
 *
 * @param array $post_data Raw $_POST data from AJAX submission.
 */
function pg_process_webinar_access($post_data) {
    $user_email = '';
    $first_name = '';
    $last_name  = '';
    
    // --- Extract and sanitize form fields ---
    if (isset($post_data['email-1'])) {
        $user_email = sanitize_email($post_data['email-1']);
    }
    if (isset($post_data['name-1'])) {
        $first_name = sanitize_text_field($post_data['name-1']);
    }
    if (isset($post_data['name-2'])) {
        $last_name = sanitize_text_field($post_data['name-2']);
    }
    
    // --- Get page ID for context ---
    $page_id = isset($post_data['page_id']) ? intval($post_data['page_id']) : 0;
    
    $user_name = trim($first_name . ' ' . $last_name);
    
    // --- You can add additional processing here ---
    // For example: send confirmation email, add to CRM, etc.
    
    // --- Return success response for AJAX ---
    wp_send_json_success([
        'message' => 'Webinar access granted',
        'form_id' => 735,
        'user_email' => $user_email
    ]);
}

/**
 * Check if a URL is external to the current site
 * Hardened and optimized
 */
function pg_is_external_url($url) {
    if (!is_string($url) || $url === '') {
        return false;
    }

    // Trim whitespace
    $url = trim($url);

    // Sanitize input
    $url = esc_url_raw($url);

    // Skip special protocols and anchors
    if (strpos($url, 'mailto:') === 0 || strpos($url, 'tel:') === 0 || strpos($url, 'ftp:') === 0 || strpos($url, 'javascript:') === 0 || strpos($url, '#') === 0) {
        return false;
    }

    static $site_domain;
    if (!$site_domain) {
        $parsed = wp_parse_url(home_url());
        $site_domain = isset($parsed['host']) ? strtolower(preg_replace('/^www\./', '', $parsed['host'])) : '';
    }

    // Absolute URLs
    if (strpos($url, 'http') === 0) {
        $parsed = wp_parse_url($url);
        if (empty($parsed['host'])) return true;

        $link_domain = strtolower(preg_replace('/^www\./', '', $parsed['host']));
        return $link_domain !== $site_domain;
    }

    // Protocol-relative
    if (strpos($url, '//') === 0) {
        $parsed = wp_parse_url('http:' . $url);
        if (empty($parsed['host'])) return true;

        $link_domain = strtolower(preg_replace('/^www\./', '', $parsed['host']));
        return $link_domain !== $site_domain;
    }

    // Relative path without leading slash → external
    if ($url[0] !== '/') {
        return true;
    }

    return false;
}

/**
 * Add target="_blank" to external navigation menu links
 */
function pg_nav_menu_link_attributes($atts, $item, $args) {
    if (!empty($atts['href']) && pg_is_external_url($atts['href'])) {
        $atts['target'] = '_blank';

        $existing_rel = isset($atts['rel']) ? $atts['rel'] : '';
        $rel_parts = array_filter(array_map('trim', explode(' ', $existing_rel)));

        foreach (['noopener', 'noreferrer'] as $rel) {
            if (!in_array($rel, $rel_parts, true)) {
                $rel_parts[] = $rel;
            }
        }

        $atts['rel'] = implode(' ', array_unique($rel_parts));
    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'pg_nav_menu_link_attributes', 10, 3);

/**
 * Add target="_blank" to external links in post content and excerpts
 * Optimized for speed using regex instead of DOMDocument
 */
function pg_external_links_content($content) {
    // Quick exit checks
    if (strpos($content, '<a ') === false) {
        return $content;
    }

    // Use WordPress core first for rel attributes
    $content = wp_targeted_link_rel($content);

    // Simple regex for most cases (much faster than DOMDocument)
    $pattern = '/<a\s+([^>]*?)href=["\']([^"\']*)["\']([^>]*?)>/i';
    
    return preg_replace_callback($pattern, function($matches) {
        $before_href = $matches[1];
        $url = $matches[2];
        $after_href = $matches[3];
        
        // Skip if already has target
        if (strpos($before_href, 'target=') !== false || strpos($after_href, 'target=') !== false) {
            return $matches[0];
        }
        
        // Quick external check
        if (pg_is_external_url($url)) {
            return '<a ' . $before_href . 'href="' . $url . '"' . $after_href . ' target="_blank">';
        }
        
        return $matches[0];
    }, $content);
}
add_filter('the_content', 'pg_external_links_content');
add_filter('the_excerpt', 'pg_external_links_content');


//post redirect to categories to prevent 404s
add_action('template_redirect', function() {
    if (is_404()) {
        $request_uri = trim($_SERVER['REQUEST_URI'], '/');

        // Check if slug exists as a post
        $post = get_page_by_path($request_uri, OBJECT, 'post');

        if ($post) {
            // Get the primary category slug
            $categories = get_the_category($post->ID);
            if (!empty($categories)) {
                $category_slug = $categories[0]->slug;
                $new_url = home_url("/$category_slug/$request_uri/");
                wp_redirect($new_url, 301);
                exit;
            }
        }
    }
});




/**
 * Load Research Paper Form Handler
 */
require_once get_template_directory() . '/inc/research-paper-form-handler.php';

/**
 * TTS Audio Cache — invalidate cached MP3 when a post is updated.
 *
 * Deletes all tts-{post_id}-*.mp3 files so fresh audio is generated on the
 * next "Listen" click. Fires on save_post (covers edits, quick-edit, REST API
 * updates, and bulk actions).
 */
add_action( 'save_post', 'pg_tts_clear_cache', 10, 2 );

function pg_tts_clear_cache( $post_id, $post ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}
	if ( 'post' !== $post->post_type ) {
		return;
	}

	$upload_dir = wp_upload_dir();
	$cache_dir  = $upload_dir['basedir'] . '/tts-cache';

	if ( ! is_dir( $cache_dir ) ) {
		return;
	}

	$pattern = $cache_dir . '/tts-' . $post_id . '-*.mp3';
	$files   = glob( $pattern );

	if ( ! empty( $files ) ) {
		foreach ( $files as $file ) {
			// phpcs:ignore WordPress.WP.AlternativeFunctions.unlink_unlink
			unlink( $file );
		}
	}
}


// =============================================================================
// Schema Markup
// =============================================================================

/**
 * Extend Yoast's Organization schema node with language-services-specific
 * properties and remove incorrectly mapped policy fields.
 */
add_filter( 'wpseo_schema_graph', 'pg_extend_organization_schema' );

function pg_extend_organization_schema( $graph ) {
	foreach ( $graph as &$node ) {
		$type = isset( $node['@type'] ) ? (array) $node['@type'] : [];

		if ( ! in_array( 'Organization', $type, true ) ) {
			continue;
		}

		unset( $node['publishingPrinciples'], $node['actionableFeedbackPolicy'] );

		// Representative set of primary languages from Piedmont's 200+ language catalog.
		// Covers the highest-demand LEP populations in US healthcare, government,
		// education, and legal sectors. 'ase' is ISO 639-3 for American Sign Language.
		$node['knowsLanguage'] = [
			'en', 'es', 'zh', 'hi', 'fr', 'ar', 'vi', 'tl', 'ko', 'ru',
			'ht', 'pt', 'so', 'am', 'fa', 'pl', 'de', 'ja', 'it', 'hmn',
			'ne', 'my', 'ps', 'ase',
		];

		$node['areaServed']   = 'Worldwide';
		$node['foundingDate'] = '2013';

		$node['hasOfferCatalog'] = [
			'@type' => 'OfferCatalog',
			'name'  => 'Language & Globalization Services',
			'url'   => home_url( '/solutions/' ),
		];

		$node['numberOfEmployees'] = [
			'@type' => 'QuantitativeValue',
			'value' => 200,
		];

		$node['award'] = [
			'ISO 13485:2016 — Medical Devices Quality Management System',
			'ISO 17100:2015 — Translation Services Quality Management',
			'ISO 27001:2022 — Information Security Management System',
			'ISO 9001:2015 — Quality Management System',
		];
	}

	return $graph;
}

/**
 * Inject an ItemList schema block on the homepage for the Solutions taxonomy
 * cards rendered in the "Solutions built for your moment" section.
 */
add_action( 'wp_head', 'pg_homepage_solutions_itemlist_schema' );

function pg_homepage_solutions_itemlist_schema() {
	if ( ! is_front_page() ) {
		return;
	}

	$terms = get_terms( [
		'taxonomy'   => 'solution',
		'hide_empty' => false,
		'number'     => 6,
		'orderby'    => 'name',
		'order'      => 'ASC',
	] );

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return;
	}

	$items    = [];
	$position = 1;

	foreach ( $terms as $term ) {
		$term_link = get_term_link( $term );

		if ( is_wp_error( $term_link ) ) {
			continue;
		}

		$items[] = [
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => $term->name,
			'url'      => $term_link,
		];

		$position++;
	}

	if ( empty( $items ) ) {
		return;
	}

	$schema = [
		'@context'        => 'https://schema.org',
		'@type'           => 'ItemList',
		'name'            => 'Solutions',
		'description'     => 'Language and globalization service categories offered by Piedmont Global.',
		'numberOfItems'   => count( $items ),
		'itemListElement' => $items,
	];

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. '</script>' . "\n";
}

/**
 * Inject ItemList schema on the Solutions catalog page.
 * Each ListItem wraps a Service object — semantically represents this page
 * as a service catalog rather than a generic link list.
 */
add_action( 'wp_head', 'pg_solutions_page_itemlist_schema' );

function pg_solutions_page_itemlist_schema() {
	if ( ! is_page_template( 'pages/solutions.php' ) ) {
		return;
	}

	$terms = get_terms( [
		'taxonomy'   => 'solution',
		'hide_empty' => false,
		'orderby'    => 'name',
		'order'      => 'ASC',
	] );

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return;
	}

	$items    = [];
	$position = 1;

	foreach ( $terms as $term ) {
		$term_link = get_term_link( $term );

		if ( is_wp_error( $term_link ) ) {
			continue;
		}

		$tagline = get_field( 'solution_tagline', $term->taxonomy . '_' . $term->term_id );

		$items[] = [
			'@type'    => 'ListItem',
			'position' => $position,
			'item'     => [
				'@type'       => 'Service',
				'name'        => $term->name,
				'description' => $tagline ? wp_strip_all_tags( $tagline ) : '',
				'url'         => $term_link,
				'provider'    => [
					'@type' => 'Organization',
					'@id'   => home_url( '/#organization' ),
				],
				'areaServed'  => 'Worldwide',
			],
		];

		$position++;
	}

	if ( empty( $items ) ) {
		return;
	}

	$schema = [
		'@context'        => 'https://schema.org',
		'@type'           => 'ItemList',
		'name'            => 'Language & Globalization Services',
		'description'     => 'Complete catalog of language access, accessibility, and globalization solutions offered by Piedmont Global.',
		'numberOfItems'   => count( $items ),
		'itemListElement' => $items,
	];

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. '</script>' . "\n";
}

/**
 * Inject FAQPage schema on any singular page/post where the 'faqs' ACF
 * repeater is populated. Works across all templates that include
 * components/common/faqs-related.php — no per-template configuration needed.
 */
add_action( 'wp_head', 'pg_faqpage_schema' );

function pg_faqpage_schema() {
	$faqs = null;

	if ( is_singular() ) {
		$faqs = get_field( 'faqs' );
	} elseif ( is_tax( 'solution' ) ) {
		$term     = get_queried_object();
		$term_key = $term->taxonomy . '_' . $term->term_id;
		$faqs     = get_field( 'faqs', $term_key );
	}

	if ( ! $faqs || ! is_array( $faqs ) ) {
		return;
	}

	$entities = [];

	foreach ( $faqs as $faq ) {
		$question = isset( $faq['question'] ) ? wp_strip_all_tags( $faq['question'] ) : '';
		$answer   = isset( $faq['answer'] )   ? wp_strip_all_tags( $faq['answer'] )   : '';

		if ( ! $question || ! $answer ) {
			continue;
		}

		$entities[] = [
			'@type'          => 'Question',
			'name'           => $question,
			'acceptedAnswer' => [
				'@type' => 'Answer',
				'text'  => $answer,
			],
		];
	}

	if ( empty( $entities ) ) {
		return;
	}

	$schema = [
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $entities,
	];

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. '</script>' . "\n";
}

/**
 * Inject Service schema on individual solution CPT pages (single-solutions.php).
 */
add_action( 'wp_head', 'pg_single_solution_service_schema' );

function pg_single_solution_service_schema() {
	if ( ! is_singular( 'solutions' ) ) {
		return;
	}

	$name        = get_the_title();
	$description = get_field( 'tagline' ) ?: get_field( 'primary_description' );

	if ( ! $name ) {
		return;
	}

	// Resolve the solution taxonomy term for serviceType.
	$terms       = get_the_terms( get_the_ID(), 'solution' );
	$service_type = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : 'Language Services';

	$schema = [
		'@context'    => 'https://schema.org',
		'@type'       => 'Service',
		'name'        => $name,
		'description' => $description ? wp_strip_all_tags( $description ) : '',
		'serviceType' => $service_type,
		'provider'    => [
			'@type' => 'Organization',
			'@id'   => home_url( '/#organization' ),
		],
		'areaServed'  => 'Worldwide',
		'url'         => get_permalink(),
	];

	// For child solution pages, link back to the parent service.
	global $post;
	if ( $post->post_parent > 0 ) {
		$schema['isPartOf'] = [
			'@type' => 'Service',
			'name'  => get_the_title( $post->post_parent ),
			'url'   => get_permalink( $post->post_parent ),
		];
	}

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. '</script>' . "\n";
}

/**
 * Inject Service schema and sub-solutions ItemList on solution taxonomy pages
 * (taxonomy-solution.php). The Service represents the category; the ItemList
 * represents the individual offerings within it.
 */
add_action( 'wp_head', 'pg_taxonomy_solution_schema' );

function pg_taxonomy_solution_schema() {
	if ( ! is_tax( 'solution' ) ) {
		return;
	}

	$term     = get_queried_object();
	$term_key = $term->taxonomy . '_' . $term->term_id;

	$description = get_field( 'tagline', $term_key ) ?: get_field( 'primary_description', $term_key );

	// Service schema for the taxonomy term itself.
	$service_schema = [
		'@context'    => 'https://schema.org',
		'@type'       => 'Service',
		'name'        => $term->name,
		'description' => $description ? wp_strip_all_tags( $description ) : '',
		'serviceType' => $term->name,
		'provider'    => [
			'@type' => 'Organization',
			'@id'   => home_url( '/#organization' ),
		],
		'areaServed'  => 'Worldwide',
		'url'         => get_term_link( $term ),
	];

	echo '<script type="application/ld+json">'
		. wp_json_encode( $service_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. '</script>' . "\n";

	// ItemList of individual solution posts within this taxonomy term.
	$posts = get_posts( [
		'post_type'      => 'solutions',
		'tax_query'      => [ [
			'taxonomy' => $term->taxonomy,
			'field'    => 'term_id',
			'terms'    => $term->term_id,
		] ],
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	] );

	if ( empty( $posts ) ) {
		return;
	}

	$items    = [];
	$position = 1;

	foreach ( $posts as $post ) {
		$post_tagline = get_field( 'tagline', $post->ID ) ?: get_field( 'solution_tagline', $post->ID );

		$items[] = [
			'@type'    => 'ListItem',
			'position' => $position,
			'item'     => [
				'@type'       => 'Service',
				'name'        => get_the_title( $post->ID ),
				'description' => $post_tagline ? wp_strip_all_tags( $post_tagline ) : '',
				'url'         => get_permalink( $post->ID ),
				'provider'    => [
					'@type' => 'Organization',
					'@id'   => home_url( '/#organization' ),
				],
			],
		];

		$position++;
	}

	$itemlist_schema = [
		'@context'        => 'https://schema.org',
		'@type'           => 'ItemList',
		'name'            => $term->name . ' Services',
		'numberOfItems'   => count( $items ),
		'itemListElement' => $items,
	];

	echo '<script type="application/ld+json">'
		. wp_json_encode( $itemlist_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. '</script>' . "\n";
}

/**
 * Inject Service schema on the Strategic Globalization page.
 */
add_action( 'wp_head', 'pg_strategic_service_schema' );

function pg_strategic_service_schema() {
	if ( ! is_page_template( 'pages/strategic.php' ) ) {
		return;
	}

	$name        = get_field( 'industry_callout' ) ?: get_the_title();
	$description = get_field( 'industry_description' ) ?: get_field( 'why_piedmont_global_description' );

	if ( ! $name ) {
		return;
	}

	$schema = [
		'@context'    => 'https://schema.org',
		'@type'       => 'Service',
		'name'        => wp_strip_all_tags( $name ),
		'description' => $description ? wp_strip_all_tags( $description ) : '',
		'serviceType' => 'Strategic Globalization',
		'provider'    => [
			'@type' => 'Organization',
			'@id'   => home_url( '/#organization' ),
		],
		'areaServed'  => 'Worldwide',
		'url'         => get_permalink(),
	];

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. '</script>' . "\n";
}

/**
 * Inject VideoObject schema on the About page for the embedded YouTube video.
 * Enables video rich results (thumbnail previews) in Google Search.
 */
add_action( 'wp_head', 'pg_about_video_schema' );

function pg_about_video_schema() {
	if ( ! is_page_template( 'pages/about-us.php' ) ) {
		return;
	}

	$video_id = get_field( 'video_id' );
	if ( ! $video_id ) {
		return;
	}

	$video_title = get_field( 'video_title' ) ?: 'Piedmont Global — Your Strategic Globalization Partner';

	$schema = [
		'@context'     => 'https://schema.org',
		'@type'        => 'VideoObject',
		'name'         => $video_title,
		'description'  => 'Piedmont Global helps organizations scale globally with language access and cross-cultural solutions that drive lasting impact.',
		'thumbnailUrl' => 'https://img.youtube.com/vi/' . esc_attr( $video_id ) . '/hqdefault.jpg',
		'uploadDate'   => '2025-09-30',
		'embedUrl'     => 'https://www.youtube.com/embed/' . esc_attr( $video_id ),
		'contentUrl'   => 'https://www.youtube.com/watch?v=' . esc_attr( $video_id ),
		'publisher'    => [
			'@type' => 'Organization',
			'@id'   => home_url( '/#organization' ),
		],
	];

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. '</script>' . "\n";
}

/**
 * Inject ItemList schema on the Industries catalog page.
 * Represents all industry CPT posts as a flat list — schema.org has no
 * Industry type, so ListItems carry name, description, and url only.
 */
add_action( 'wp_head', 'pg_industries_page_itemlist_schema' );

function pg_industries_page_itemlist_schema() {
	if ( ! is_page_template( 'pages/industries.php' ) ) {
		return;
	}

	$query = new WP_Query( [
		'post_type'      => 'industry',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'orderby'        => 'title',
		'order'          => 'ASC',
	] );

	if ( ! $query->have_posts() ) {
		return;
	}

	$items    = [];
	$position = 1;

	while ( $query->have_posts() ) {
		$query->the_post();

		$tagline = get_field( 'industry_tagline' );

		$items[] = [
			'@type'       => 'ListItem',
			'position'    => $position,
			'name'        => get_the_title(),
			'url'         => get_permalink(),
			'description' => $tagline ? wp_strip_all_tags( $tagline ) : '',
		];

		$position++;
	}

	wp_reset_postdata();

	if ( empty( $items ) ) {
		return;
	}

	$schema = [
		'@context'        => 'https://schema.org',
		'@type'           => 'ItemList',
		'name'            => 'Industries We Serve',
		'description'     => 'Industry sectors served by Piedmont Global with language access, accessibility, and globalization solutions.',
		'numberOfItems'   => count( $items ),
		'itemListElement' => $items,
	];

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. '</script>' . "\n";
}

/**
 * Inject Service schema on individual industry CPT pages (single-industry.php).
 * The 'audience' property scopes the service to the specific industry sector,
 * distinguishing it from generic solution-level Service schema.
 */
add_action( 'wp_head', 'pg_single_industry_schema' );

function pg_single_industry_schema() {
	if ( ! is_singular( 'industry' ) ) {
		return;
	}

	$name        = get_the_title();
	$description = get_field( 'header_description' ) ?: get_field( 'industry_tagline' );

	$schema = [
		'@context'    => 'https://schema.org',
		'@type'       => 'Service',
		'name'        => $name . ' Language Services',
		'description' => $description ? wp_strip_all_tags( $description ) : '',
		'serviceType' => 'Language Access Services',
		'provider'    => [
			'@type' => 'Organization',
			'@id'   => home_url( '/#organization' ),
		],
		'areaServed'  => 'Worldwide',
		'audience'    => [
			'@type'        => 'Audience',
			'audienceType' => $name . ' Industry',
		],
		'url'         => get_permalink(),
	];

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. '</script>' . "\n";
}

/**
 * Inject Blog schema on the blog listing page.
 * Represents the blog as a named entity published by Piedmont Global.
 * Individual post Article schema is handled by Yoast on each single.php.
 */
add_action( 'wp_head', 'pg_blog_page_schema' );

function pg_blog_page_schema() {
	if ( ! is_page_template( 'pages/blog.php' ) ) {
		return;
	}

	$schema = [
		'@context'    => 'https://schema.org',
		'@type'       => 'Blog',
		'name'        => 'Piedmont Global Blog',
		'description' => 'Insights, strategies, and stories from Piedmont Global on globalization, language access, and cross-cultural growth.',
		'url'         => get_permalink(),
		'publisher'   => [
			'@type' => 'Organization',
			'@id'   => home_url( '/#organization' ),
		],
		'inLanguage'  => 'en-US',
	];

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. '</script>' . "\n";
}

/**
 * Inject ItemList schema on the Resources hub page.
 * Represents the five resource section links — Blog, eBooks, Case Studies,
 * Webinars, Podcasts. Individual content items have their own schema via Yoast.
 */
add_action( 'wp_head', 'pg_resources_page_schema' );

function pg_resources_page_schema() {
	if ( ! is_page_template( 'pages/resources.php' ) ) {
		return;
	}

	$schema = [
		'@context'        => 'https://schema.org',
		'@type'           => 'ItemList',
		'name'            => 'Piedmont Global Resources',
		'description'     => 'Resource hub covering blogs, eBooks, case studies, webinars, and podcasts on globalization, language access, and cross-cultural growth.',
		'numberOfItems'   => 5,
		'itemListElement' => [
			[
				'@type'    => 'ListItem',
				'position' => 1,
				'name'     => 'Blog',
				'url'      => home_url( '/blog/' ),
			],
			[
				'@type'    => 'ListItem',
				'position' => 2,
				'name'     => 'eBooks',
				'url'      => home_url( '/ebooks/' ),
			],
			[
				'@type'    => 'ListItem',
				'position' => 3,
				'name'     => 'Case Studies',
				'url'      => home_url( '/case-studies/' ),
			],
			[
				'@type'    => 'ListItem',
				'position' => 4,
				'name'     => 'Webinars',
				'url'      => home_url( '/webinars/' ),
			],
			[
				'@type'    => 'ListItem',
				'position' => 5,
				'name'     => 'Podcasts',
				'url'      => home_url( '/podcasts/' ),
			],
		],
	];

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. '</script>' . "\n";
}

/**
 * Inject ItemList of Person schema on the Team page.
 * Each team member is a named entity with name, jobTitle, image, LinkedIn,
 * and a worksFor link to the Organization.
 */
add_action( 'wp_head', 'pg_team_page_schema' );

function pg_team_page_schema() {
	if ( ! is_page_template( 'pages/teams.php' ) ) {
		return;
	}

	$members  = [];
	$position = 1;

	if ( have_rows( 'team_repeater' ) ) {
		while ( have_rows( 'team_repeater' ) ) {
			the_row();

			$name        = get_sub_field( 'name' );
			$designation = get_sub_field( 'designation' );
			$photo       = get_sub_field( 'photo' );
			$linkedin    = get_sub_field( 'linkedin_url' );

			if ( ! $name ) {
				continue;
			}

			$image_url = '';
			if ( is_array( $photo ) && isset( $photo['url'] ) ) {
				$image_url = $photo['url'];
			} elseif ( is_string( $photo ) ) {
				$image_url = $photo;
			}

			$person = [
				'@type'    => 'Person',
				'name'     => $name,
				'worksFor' => [
					'@type' => 'Organization',
					'@id'   => home_url( '/#organization' ),
				],
			];

			if ( $designation ) {
				$person['jobTitle'] = $designation;
			}

			if ( $image_url ) {
				$person['image'] = $image_url;
			}

			if ( $linkedin ) {
				$person['sameAs'] = $linkedin;
			}

			$members[] = [
				'@type'    => 'ListItem',
				'position' => $position++,
				'item'     => $person,
			];
		}
	}

	if ( empty( $members ) ) {
		return;
	}

	$schema = [
		'@context'        => 'https://schema.org',
		'@type'           => 'ItemList',
		'name'            => 'Piedmont Global Leadership Team',
		'numberOfItems'   => count( $members ),
		'itemListElement' => $members,
	];

	echo '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. '</script>' . "\n";
}

/**
 * Build a descriptive alt text for a brand logo.
 *
 * Uses the brand name when available; otherwise derives a Title-Cased label from
 * the URL hostname (e.g. "https://microsoft.com" -> "Microsoft"). Falls back to
 * a generic label. This helps keep 1.1.1 / 1.4.5 alt text meaningful when the
 * ACF name field is empty.
 *
 * @param string $name     Brand name from ACF.
 * @param string $url      Optional brand URL used to derive a label.
 * @param string $fallback Generic fallback label.
 * @return string
 */
function pg_brand_alt( $name, $url = '', $fallback = '' ) {
	$name = is_string( $name ) ? trim( $name ) : '';
	if ( $name !== '' ) {
		return $name;
	}

	if ( is_string( $url ) && $url !== '' ) {
		$host = wp_parse_url( $url, PHP_URL_HOST );
		if ( is_string( $host ) && $host !== '' ) {
			$host = preg_replace( '/^www\./i', '', $host );
			$root = strtok( $host, '.' );
			if ( is_string( $root ) && $root !== '' ) {
				return ucwords( str_replace( [ '-', '_' ], ' ', $root ) );
			}
		}
	}

	return $fallback !== '' ? $fallback : __( 'Logo', 'piedmontglobal' );
}

/**
 * Render an accessible Prev / Pause-Play / Next toolbar for a logo carousel.
 *
 * Outputs three <button>s that the bulletproof loader wires up by data-attribute.
 * Intended for carousels that lack visible arrows so keyboard / touch / SR users
 * can meet WCAG 2.1.1, 2.1.2, and 2.2.2.
 *
 * @param array $args {
 *     @type string $base_id      Stable id base (e.g. "home-partners").
 *     @type string $region_label Visible label of the carousel (for button names).
 * }
 */
function pg_render_carousel_controls( $args = [] ) {
	$defaults = [
		'base_id'      => '',
		'region_label' => __( 'logos', 'piedmontglobal' ),
	];
	$args = wp_parse_args( $args, $defaults );

	if ( $args['base_id'] === '' ) {
		return;
	}

	$base  = sanitize_html_class( $args['base_id'] );
	$label = (string) $args['region_label'];

	$btn_class = 'inline-flex h-9 w-9 items-center justify-center rounded-md border border-[#DFDAD4] bg-white text-[#1F3131] shadow-sm transition-colors duration-200 hover:bg-[#98C441] hover:text-[#1F3131] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#98C441]';

	/* translators: %s: carousel region label */
	$group_label = sprintf( __( '%s controls', 'piedmontglobal' ), $label );
	/* translators: %s: carousel region label */
	$prev_label = sprintf( __( 'Previous %s', 'piedmontglobal' ), $label );
	/* translators: %s: carousel region label */
	$next_label = sprintf( __( 'Next %s', 'piedmontglobal' ), $label );
	/* translators: %s: carousel region label */
	$pause_label = sprintf( __( 'Pause %s auto-rotation', 'piedmontglobal' ), $label );
	/* translators: %s: carousel region label */
	$play_label = sprintf( __( 'Play %s auto-rotation', 'piedmontglobal' ), $label );
	?>
	<div class="mb-4 flex items-center justify-end gap-2" role="group" aria-label="<?php echo esc_attr( $group_label ); ?>">
		<button type="button"
			id="<?php echo esc_attr( $base ); ?>-prev"
			data-pg-carousel-prev="<?php echo esc_attr( $base ); ?>"
			class="<?php echo esc_attr( $btn_class ); ?>"
			aria-label="<?php echo esc_attr( $prev_label ); ?>">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4" aria-hidden="true" focusable="false">
				<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
			</svg>
		</button>
		<button type="button"
			id="<?php echo esc_attr( $base ); ?>-playpause"
			data-pg-carousel-playpause="<?php echo esc_attr( $base ); ?>"
			class="<?php echo esc_attr( $btn_class ); ?>"
			aria-pressed="false"
			aria-label="<?php echo esc_attr( $pause_label ); ?>"
			data-label-pause="<?php echo esc_attr( $pause_label ); ?>"
			data-label-play="<?php echo esc_attr( $play_label ); ?>">
			<svg data-pg-icon="pause" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4" aria-hidden="true" focusable="false">
				<rect x="6" y="5" width="4" height="14" rx="1" />
				<rect x="14" y="5" width="4" height="14" rx="1" />
			</svg>
			<svg data-pg-icon="play" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="hidden h-4 w-4" aria-hidden="true" focusable="false">
				<path d="M8 5v14l11-7z" />
			</svg>
		</button>
		<button type="button"
			id="<?php echo esc_attr( $base ); ?>-next"
			data-pg-carousel-next="<?php echo esc_attr( $base ); ?>"
			class="<?php echo esc_attr( $btn_class ); ?>"
			aria-label="<?php echo esc_attr( $next_label ); ?>">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4" aria-hidden="true" focusable="false">
				<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
			</svg>
		</button>
	</div>
	<?php
}
