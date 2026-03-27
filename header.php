<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PiedmontGlobal
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <!-- Google Tag Manager -->
    <script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5CZ96R6N');
    </script>
    <!-- End Google Tag Manager -->
    
    <!-- Lemlist Tracking -->
    <script type="text/javascript" src="https://app.lemlist.com/api/visitors/tracking?k=5pcD3B19aPkL5dWwGtDjJKLwPPTs89%2FwUqmdkiTWm%2B0%3D&t=tea_fghJMWXAC4pyq3gJv"></script>
    
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <!-- Critical font preloading for LCP optimization -->
    <link rel="preload"
        href="<?php echo esc_url(get_template_directory_uri() . '/assets/fonts/ABCOracle-Book.woff2'); ?>" as="font"
        type="font/woff2" crossorigin>
    <link rel="preload"
        href="<?php echo esc_url(get_template_directory_uri() . '/assets/fonts/ABCOracle-Medium.woff2'); ?>" as="font"
        type="font/woff2" crossorigin>

    <!-- Font loading optimization -->
    <style>
    /* Critical font loading styles for all text elements */
    .fonts-loading p,
    .fonts-loading a,
    .fonts-loading h1,
    .fonts-loading h2,
    .fonts-loading h3,
    .fonts-loading h4,
    .fonts-loading h5,
    .fonts-loading h6,
    .fonts-loading .text-xl,
    .fonts-loading .text-3xl,
    .fonts-loading .text-4xl,
    .fonts-loading .text-5xl {
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        font-weight: 400;
    }

    .fonts-loading .font-semibold,
    .fonts-loading .font-bold,
    .fonts-loading h1,
    .fonts-loading h2,
    .fonts-loading h3,
    .fonts-loading h4,
    .fonts-loading h5,
    .fonts-loading h6 {
        font-weight: 600;
    }
    </style>

    <!-- CSS is loaded via wp_enqueue_scripts with deferral logic -->

    <!-- jQuery is loaded in footer, so no preload needed -->

    <!-- Preload critical banner image only -->
    <?php 
	$banner_image = get_field('banner_image');
	if ($banner_image && is_array($banner_image)) {
		echo '<link rel="preload" as="image" href="' . esc_url($banner_image['url']) . '" fetchpriority="high">';
	}
	?>

    <!-- Preload primary banner background SVG for better performance -->
    <?php 
    // Define critical pages that use primary-bg.svg
    $is_critical_page = is_front_page() || is_page('home') || is_404();
    
    if ($is_critical_page) {
        echo '<link rel="preload" as="image" href="' . esc_url(get_template_directory_uri() . '/assets/icons/primary-bg.svg') . '" fetchpriority="high">';
    }
    ?>

    <!-- Cookie consent meta tag -->
    <meta name="cookie-consent"
        content="This site uses cookies for form functionality and analytics. By continuing to use this site, you consent to our use of cookies.">

    <!-- Skip link accessibility styles -->
    <style>
    .skip-link {
        position: absolute;
        left: -9999px;
        top: 0;
        z-index: 999999;
        text-decoration: none;
        padding: 8px 16px;
        background: #000;
        color: #fff;
        font-weight: bold;
    }

    .skip-link:focus {
        left: 6px;
        top: 7px;
    }

    /* Prevent FOUC during CSS loading */
    html:not(.css-loaded) {
        visibility: hidden;
    }

    html.css-loaded {
        visibility: visible;
        transition: opacity 0.1s ease-in;
    }

    /* Ensure smooth loading experience */
    html:not(.all-css-loaded) body {
        opacity: 0.99;
    }

    html.all-css-loaded body {
        opacity: 1;
        transition: opacity 0.2s ease-in;
    }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5CZ96R6N" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#maincontent"><?php esc_html_e( 'Skip to content', 'pg' ); ?></a>
        <?php get_template_part('components/banner/promotional-banner'); ?>