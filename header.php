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
    <!-- Google Fonts: Open Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

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