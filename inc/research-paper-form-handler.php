<?php
/**
 * Research Paper Form Handler
 * Handles Forminator form 1498 submission with file attachment and email delivery
 * 
 * @package PiedmontGlobal
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom handler for Forminator form 1498 - Research Paper Download
 * Sends email with attached white paper from ACF field
 */
// Try multiple Forminator hooks to catch the submission
add_action('forminator_form_submit_before_set_fields', 'pg_handle_research_paper_form', 10, 3);
add_action('forminator_form_submit_after_set_fields', 'pg_handle_research_paper_form', 10, 3);
add_action('forminator_custom_form_submit_before_set_fields', 'pg_handle_research_paper_form', 10, 3);
add_action('forminator_custom_form_submit_after_set_fields', 'pg_handle_research_paper_form', 10, 3);
add_action('forminator_form_submission_complete', 'pg_handle_research_paper_form_complete', 10, 3);
add_action('forminator_custom_form_submission_complete', 'pg_handle_research_paper_form_complete', 10, 3);

/**
 * Helper function to convert file URL to file path reliably
 * 
 * @param string $file_url The file URL from ACF
 * @param array $white_paper The white paper array from ACF
 * @return string|false The file path or false on failure
 */
function pg_get_research_paper_file_path($file_url, $white_paper) {
    $file_path = null;
    
    // Method 1: Try using WordPress upload directory (most reliable)
    $upload_dir = wp_upload_dir();
    if (strpos($file_url, $upload_dir['baseurl']) !== false) {
        $file_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $file_url);
    }
    
    // Method 2: Try attachment ID approach if available
    if (!$file_path && isset($white_paper['ID'])) {
        $file_path = get_attached_file($white_paper['ID']);
    }
    
    // Method 3: Fallback to simple replacement
    if (!$file_path) {
        $file_path = str_replace(home_url('/'), ABSPATH, $file_url);
    }
    
    // Security: Validate file path is within WordPress directory
    if ($file_path) {
        $file_path = realpath($file_path); // Resolve symlinks and ..
        if (!$file_path || strpos($file_path, ABSPATH) !== 0) {
            error_log('Invalid file path detected for research paper: ' . $file_url);
            return false;
        }
    }
    
    return $file_path;
}

function pg_handle_research_paper_form($entry, $form_id, $field_data_array) {
    static $processed_submissions = array();
    
    // Only handle form 1498
    if ($form_id != 1498) {
        return;
    }

    // Get user email first to create unique key for duplicate prevention
    $user_email = '';
    $user_name = '';
    
    foreach ($field_data_array as $field) {
        if (isset($field['name']) && $field['name'] === 'email-1') {
            $user_email = sanitize_email($field['value']);
        }
        if (isset($field['name']) && $field['name'] === 'name-1') {
            $user_name = sanitize_text_field($field['value']);
        }
    }

    if (empty($user_email)) {
        return;
    }
    
    // Create unique key for this submission (email + timestamp within same second)
    $submission_key = md5($user_email . time());
    
    // Prevent duplicate processing
    if (isset($processed_submissions[$submission_key])) {
        return; // Already processed
    }
    $processed_submissions[$submission_key] = true;

    // Get the white paper file from ACF field
    // Try to get post ID from multiple sources since form submission is AJAX
    $post_id = null;
    
    // Method 1: Check if we have a post ID in the field data
    foreach ($field_data_array as $field) {
        if (isset($field['name']) && $field['name'] === 'hidden-1') {
            $post_id = intval($field['value']);
            break;
        }
    }
    
    // Method 2: Try to get from HTTP referer
    if (!$post_id && isset($_SERVER['HTTP_REFERER'])) {
        $referer_url = $_SERVER['HTTP_REFERER'];
        $parsed_url = wp_parse_url($referer_url);
        if (isset($parsed_url['path'])) {
            $path_parts = explode('/', trim($parsed_url['path'], '/'));
            // Look for a research paper by slug
            foreach ($path_parts as $part) {
                $post_by_slug = get_page_by_path($part, OBJECT, 'research_paper');
                if ($post_by_slug) {
                    $post_id = $post_by_slug->ID;
                    break;
                }
            }
        }
    }
    
    // Method 3: Get the most recent research paper as fallback
    if (!$post_id) {
        $recent_papers = get_posts(array(
            'post_type' => 'research_paper',
            'numberposts' => 1,
            'orderby' => 'date',
            'order' => 'DESC'
        ));
        if ($recent_papers && !empty($recent_papers)) {
            $post_id = $recent_papers[0]->ID;
        }
    }
    
    if (!$post_id) {
        error_log('Research paper form submission: Could not determine post ID for email: ' . $user_email);
        return;
    }
    
    $white_paper = get_field('white_paper', $post_id);
    
    if (!$white_paper || !isset($white_paper['url'])) {
        error_log('Research paper form submission: No white paper file found for post ID: ' . $post_id);
        return;
    }

    // Get file details using improved path conversion
    $file_url = $white_paper['url'];
    $file_path = pg_get_research_paper_file_path($file_url, $white_paper);
    
    if (!$file_path) {
        error_log('Research paper form submission: Could not resolve file path for URL: ' . $file_url . ' (Post ID: ' . $post_id . ')');
        return;
    }
    
    $file_name = isset($white_paper['filename']) ? $white_paper['filename'] : basename($file_path);
    $paper_title = isset($white_paper['title']) ? $white_paper['title'] : 'Research Paper';

    // Check if file exists
    if (!file_exists($file_path)) {
        error_log('Research paper form submission: File does not exist: ' . $file_path . ' (Post ID: ' . $post_id . ')');
        return;
    }

    // Prepare email
    $to = $user_email;
    $subject = 'Your Research Paper from Piedmont Global';
    $greeting = $user_name ? "Hi $user_name," : "Hello,";
    
    // Email body with Piedmont Global branding
    $message = pg_get_research_paper_email_template($greeting, $paper_title);
    
    // Email headers
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: Piedmont Global <noreply@piedmontglobal.com>',
        'Reply-To: info@piedmontglobal.com'
    );

    // Attach the file
    $attachments = array($file_path);

    // Send email immediately
    $sent = wp_mail($to, $subject, $message, $headers, $attachments);
    
    // Error handling and logging
    if (!$sent) {
        $error_msg = sprintf(
            'Research paper email failed - Email: %s, Post ID: %s, File: %s',
            $user_email,
            $post_id,
            basename($file_path)
        );
        error_log($error_msg);
        
        // Log to WordPress debug log if enabled
        if (defined('WP_DEBUG') && WP_DEBUG && defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
            error_log('Research Paper Email Error: ' . $error_msg);
        }
    }
}

/**
 * Alternative handler for Forminator submission complete hooks
 */
function pg_handle_research_paper_form_complete($form_id, $response, $form_settings) {
    static $processed_submissions = array();
    
    // Only handle form 1498
    if ($form_id != 1498) {
        return;
    }
    
    // Get the entry data from response
    $entry_data = isset($response['data']) ? $response['data'] : array();
    
    // Get user email first to create unique key for duplicate prevention
    $user_email = '';
    $user_name = '';
    
    foreach ($entry_data as $field) {
        if (isset($field['name']) && $field['name'] === 'email-1') {
            $user_email = sanitize_email($field['value']);
        }
        if (isset($field['name']) && $field['name'] === 'name-1') {
            $user_name = sanitize_text_field($field['value']);
        }
    }

    if (empty($user_email)) {
        return;
    }
    
    // Create unique key for this submission (email + timestamp within same second)
    $submission_key = md5($user_email . time());
    
    // Prevent duplicate processing
    if (isset($processed_submissions[$submission_key])) {
        return; // Already processed
    }
    $processed_submissions[$submission_key] = true;

    // Get the white paper file from ACF field
    // Try to get post ID from multiple sources since form submission is AJAX
    $post_id = null;
    
    // Method 1: Check if we have a post ID in the field data
    foreach ($entry_data as $field) {
        if (isset($field['name']) && $field['name'] === 'hidden-1') {
            $post_id = intval($field['value']);
            break;
        }
    }
    
    // Method 2: Try to get from HTTP referer
    if (!$post_id && isset($_SERVER['HTTP_REFERER'])) {
        $referer_url = $_SERVER['HTTP_REFERER'];
        $parsed_url = wp_parse_url($referer_url);
        if (isset($parsed_url['path'])) {
            $path_parts = explode('/', trim($parsed_url['path'], '/'));
            // Look for a research paper by slug
            foreach ($path_parts as $part) {
                $post_by_slug = get_page_by_path($part, OBJECT, 'research_paper');
                if ($post_by_slug) {
                    $post_id = $post_by_slug->ID;
                    break;
                }
            }
        }
    }
    
    // Method 3: Get the most recent research paper as fallback
    if (!$post_id) {
        $recent_papers = get_posts(array(
            'post_type' => 'research_paper',
            'numberposts' => 1,
            'orderby' => 'date',
            'order' => 'DESC'
        ));
        if ($recent_papers && !empty($recent_papers)) {
            $post_id = $recent_papers[0]->ID;
        }
    }
    
    if (!$post_id) {
        error_log('Research paper form submission: Could not determine post ID for email: ' . $user_email);
        return;
    }
    
    $white_paper = get_field('white_paper', $post_id);
    
    if (!$white_paper || !isset($white_paper['url'])) {
        error_log('Research paper form submission: No white paper file found for post ID: ' . $post_id);
        return;
    }

    // Get file details using improved path conversion
    $file_url = $white_paper['url'];
    $file_path = pg_get_research_paper_file_path($file_url, $white_paper);
    
    if (!$file_path) {
        error_log('Research paper form submission: Could not resolve file path for URL: ' . $file_url . ' (Post ID: ' . $post_id . ')');
        return;
    }
    
    $file_name = isset($white_paper['filename']) ? $white_paper['filename'] : basename($file_path);
    $paper_title = isset($white_paper['title']) ? $white_paper['title'] : 'Research Paper';

    // Check if file exists
    if (!file_exists($file_path)) {
        error_log('Research paper form submission: File does not exist: ' . $file_path . ' (Post ID: ' . $post_id . ')');
        return;
    }

    // Prepare email
    $to = $user_email;
    $subject = 'Your Research Paper from Piedmont Global';
    $greeting = $user_name ? "Hi $user_name," : "Hello,";
    
    // Email body with Piedmont Global branding
    $message = pg_get_research_paper_email_template($greeting, $paper_title);
    
    // Email headers
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: Piedmont Global <noreply@piedmontglobal.com>',
        'Reply-To: info@piedmontglobal.com'
    );

    // Attach the file
    $attachments = array($file_path);

    // Send email immediately
    $sent = wp_mail($to, $subject, $message, $headers, $attachments);
    
    // Error handling and logging
    if (!$sent) {
        $error_msg = sprintf(
            'Research paper email failed - Email: %s, Post ID: %s, File: %s',
            $user_email,
            $post_id,
            basename($file_path)
        );
        error_log($error_msg);
        
        // Log to WordPress debug log if enabled
        if (defined('WP_DEBUG') && WP_DEBUG && defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
            error_log('Research Paper Email Error: ' . $error_msg);
        }
    }
}

/**
 * Email template for research paper download
 */
function pg_get_research_paper_email_template($greeting, $paper_title) {
    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Research Paper</title>
    </head>
    <body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #f9f8f6;">
        <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f9f8f6; padding: 40px 20px;">
            <tr>
                <td align="center">
                    <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        
                        <!-- Header with brand color -->
                        <tr>
                            <td style="background: linear-gradient(135deg, #1F3131 0%, #006155 100%); padding: 40px 30px; text-align: center;">
                                <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 700;">Piedmont Global</h1>
                                <p style="margin: 10px 0 0 0; color: #98C441; font-size: 14px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase;">Language Access Solutions</p>
                            </td>
                        </tr>

                        <!-- Content -->
                        <tr>
                            <td style="padding: 40px 30px;">
                                <p style="margin: 0 0 20px 0; color: #1F3131; font-size: 16px; line-height: 1.6;">
                                    <?php echo esc_html($greeting); ?>
                                </p>
                                
                                <p style="margin: 0 0 20px 0; color: #1F3131; font-size: 16px; line-height: 1.6;">
                                    Thank you for your interest in our research! We're excited to share <strong><?php echo esc_html($paper_title); ?></strong> with you.
                                </p>

                                <p style="margin: 0 0 20px 0; color: #1F3131; font-size: 16px; line-height: 1.6;">
                                    You'll find the white paper attached to this email. We hope you find the insights valuable as you explore language access solutions for your organization.
                                </p>

                                <!-- CTA Box -->
                                <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0; background-color: #f9f8f6; border-left: 4px solid #98C441; border-radius: 4px;">
                                    <tr>
                                        <td style="padding: 20px;">
                                            <p style="margin: 0 0 10px 0; color: #1F3131; font-size: 14px; font-weight: 600;">
                                                Want to learn more?
                                            </p>
                                            <p style="margin: 0; color: #006155; font-size: 14px; line-height: 1.6;">
                                                Our team is ready to discuss how Piedmont Global can help your organization deliver multilingual care with clarity and confidence.
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <!-- Button -->
                                <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                    <tr>
                                        <td align="center">
                                            <a href="https://piedmontglobal.com/contact" style="display: inline-block; background-color: #98C441; color: #1F3131; text-decoration: none; padding: 14px 32px; border-radius: 4px; font-size: 16px; font-weight: 700; text-align: center;">
                                                Schedule a Consultation
                                            </a>
                                        </td>
                                    </tr>
                                </table>

                                <p style="margin: 30px 0 0 0; color: #1F3131; font-size: 16px; line-height: 1.6;">
                                    Best regards,<br>
                                    <strong>The Piedmont Global Team</strong>
                                </p>
                            </td>
                        </tr>

                        <!-- Footer -->
                        <tr>
                            <td style="background-color: #1F3131; padding: 30px; text-align: center;">
                                <p style="margin: 0 0 10px 0; color: #ffffff; font-size: 14px;">
                                    <strong>Piedmont Global</strong>
                                </p>
                                <p style="margin: 0 0 15px 0; color: #98C441; font-size: 13px;">
                                    Empowering organizations with language access solutions
                                </p>
                                <p style="margin: 0; color: #ffffff; font-size: 12px; line-height: 1.6;">
                                    <a href="https://piedmontglobal.com" style="color: #98C441; text-decoration: none;">piedmontglobal.com</a> | 
                                    <a href="mailto:info@piedmontglobal.com" style="color: #98C441; text-decoration: none;">info@piedmontglobal.com</a>
                                </p>
                                <p style="margin: 15px 0 0 0; color: #888888; font-size: 11px;">
                                    <a href="https://piedmontglobal.com/privacy-policy" style="color: #888888; text-decoration: underline;">Privacy Policy</a>
                                </p>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>
    <?php
    return ob_get_clean();
}

/**
 * Check if the current industry page has a research paper assigned
 * 
 * @return bool True if a research paper is assigned, false otherwise
 */
function pg_industry_has_research_paper() {
    global $post;
    
    if (!$post) {
        // Try to get the current post ID if global $post is not set
        $post_id = get_the_ID();
        if (!$post_id) {
            return false;
        }
    } else {
        $post_id = $post->ID;
    }
    
    // Get the post type for debugging (industry pages use 'industry' post type)
    $post_type = get_post_type($post_id);
    
    // Get the research paper field (ACF field name: 'research_paper')
    // This field should be assigned to the 'industry' post type
    $research_paper = get_field('research_paper', $post_id);
    
    // Debug logging (only if WP_DEBUG is enabled)
    if (defined('WP_DEBUG') && WP_DEBUG && defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
        error_log('pg_industry_has_research_paper() - Post ID: ' . $post_id . ', Post Type: ' . $post_type);
        error_log('pg_industry_has_research_paper() - Field value: ' . print_r($research_paper, true));
        error_log('pg_industry_has_research_paper() - Is array: ' . (is_array($research_paper) ? 'yes' : 'no'));
        error_log('pg_industry_has_research_paper() - Is object: ' . (is_object($research_paper) ? 'yes' : 'no'));
        error_log('pg_industry_has_research_paper() - Is numeric: ' . (is_numeric($research_paper) ? 'yes' : 'no'));
    }
    
    // If it's a relationship field, it returns an array or post object
    if (is_array($research_paper) && !empty($research_paper)) {
        return true;
    }
    
    // If it's a post object
    if (is_object($research_paper) && isset($research_paper->ID)) {
        return true;
    }
    
    // If it's a post ID
    if (is_numeric($research_paper) && $research_paper > 0) {
        return true;
    }
    
    // Also check if it's a WP_Post object (sometimes ACF returns this)
    if (is_object($research_paper) && property_exists($research_paper, 'ID')) {
        return true;
    }
    
    return false;
}

/**
 * Get the research paper ID assigned to the current industry page
 * 
 * @return int|false The research paper post ID, or false if not found
 */
function pg_get_industry_research_paper_id() {
    global $post;
    
    // Try to get the current post ID if global $post is not set
    if (!$post) {
        $post_id = get_the_ID();
        if (!$post_id) {
            return false;
        }
    } else {
        $post_id = $post->ID;
    }
    
    // Get the research paper field (assuming ACF field name is 'research_paper')
    $research_paper = get_field('research_paper', $post_id);
    
    // If it's a relationship field returning an array, get the first item
    if (is_array($research_paper) && !empty($research_paper)) {
        $first_item = reset($research_paper);
        if (is_object($first_item) && isset($first_item->ID)) {
            return intval($first_item->ID);
        }
        if (is_numeric($first_item)) {
            return intval($first_item);
        }
        // If array contains post objects directly
        if (is_object($first_item) && property_exists($first_item, 'ID')) {
            return intval($first_item->ID);
        }
    }
    
    // If it's a post object
    if (is_object($research_paper)) {
        if (isset($research_paper->ID)) {
            return intval($research_paper->ID);
        }
        // Also check for property_exists in case it's a WP_Post object
        if (property_exists($research_paper, 'ID')) {
            return intval($research_paper->ID);
        }
    }
    
    // If it's a post ID
    if (is_numeric($research_paper) && $research_paper > 0) {
        return intval($research_paper);
    }
    
    return false;
}
