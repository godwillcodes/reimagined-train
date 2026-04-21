<?php
/**
 * Template Name: Careers
 * Description:
 */
get_header();
get_template_part( 'components/banner/single-common' );

/**
 * Render the page content, but post-process any <iframe> so it always has
 * an accessible name. The Beacon audit flagged the jobs-board iframe under
 * WCAG 4.1.2 Name, Role, Value ("ensuring frames have accessible names")
 * and 1.3.1 Info and Relationships (screen readers announcing
 * "blocked application application" with no surrounding label).
 *
 * We do the post-process inline (not via a global `the_content` filter) so
 * the behaviour is scoped to this template only.
 */
ob_start();
the_content();
$pg_careers_content = ob_get_clean();

if ( is_string( $pg_careers_content ) && $pg_careers_content !== '' ) {
    $pg_careers_iframe_title = apply_filters(
        'pg_careers_iframe_title',
        __( 'Open positions at Piedmont Global — job board', 'piedmont-global-wp' )
    );

    $pg_careers_content = preg_replace_callback(
        '/<iframe\b([^>]*)>/i',
        static function ( $m ) use ( $pg_careers_iframe_title ) {
            $attrs = $m[1];
            if ( ! preg_match( '/\btitle\s*=\s*["\']/i', $attrs ) ) {
                $attrs .= ' title="' . esc_attr( $pg_careers_iframe_title ) . '"';
            }
            if ( ! preg_match( '/\bloading\s*=\s*["\']/i', $attrs ) ) {
                $attrs .= ' loading="lazy"';
            }
            if ( ! preg_match( '/\bname\s*=\s*["\']/i', $attrs ) ) {
                $attrs .= ' name="' . esc_attr( $pg_careers_iframe_title ) . '"';
            }
            return '<iframe' . $attrs . '>';
        },
        $pg_careers_content
    );
}
?>
<main id="maincontent">
    <section
        class="px-6 lg:px-0 py-20"
        aria-labelledby="careers-positions-heading"
    >
        <div class="max-w-7xl mx-auto my-10">
            <h2 id="careers-positions-heading" class="text-3xl md:text-4xl font-bold text-[#1F3131] mb-6">
                <?php esc_html_e( 'Open positions', 'piedmont-global-wp' ); ?>
            </h2>
            <p class="sr-only">
                <?php esc_html_e( 'Search and apply for current roles at Piedmont Global. The jobs board below is loaded from our applicant tracking system; use its keyword and category filters to find roles that match your experience.', 'piedmont-global-wp' ); ?>
            </p>
            <div class="pg-careers-content">
                <?php echo $pg_careers_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- post_content is already filtered through the_content() and iframes are post-processed above. ?>
            </div>
        </div>
    </section>
</main>

<?php
get_template_part( 'components/common/cta' );
get_footer();
?>
