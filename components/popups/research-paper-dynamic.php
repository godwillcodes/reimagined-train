<?php
/**
 * Dynamic Research Paper Popup Component
 * Renders a Research Paper popup based on a given post ID
 * 
 * @package PiedmontGlobal
 * 
 * @param int $post_id Research Paper post ID
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get the research paper post ID from the arguments
$post_id = isset($args['post_id']) ? intval($args['post_id']) : 0;

if (!$post_id) {
    return;
}

// Get the post
$research_paper = get_post($post_id);

if (!$research_paper || $research_paper->post_type !== 'research_paper') {
    return;
}

// Setup post data for template functions
global $post;
$original_post = $post;
$post = $research_paper;
setup_postdata($post);

// Get ACF fields
$white_paper = get_field('white_paper');
$paper_title = $white_paper ? $white_paper['title'] : 'White Paper';
$small_title = get_field('small_title');
$big_title = get_field('big_title');
?>

<!-- Dynamic Research Paper Popup -->
<div id="research-paper-popup-<?php echo esc_attr($post_id); ?>" 
     role="dialog"
     aria-modal="true"
     aria-labelledby="research-paper-title-<?php echo esc_attr($post_id); ?>"
     aria-describedby="research-paper-description-<?php echo esc_attr($post_id); ?>"
     class="hidden fixed inset-0 z-[9999] overflow-y-auto">
    
    <!-- Backdrop -->
    <div class="popup-backdrop hidden fixed inset-0 bg-black/50 backdrop-blur-sm"></div>

    <!-- Popup Content -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="popup-content hidden relative w-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden">
            
            <!-- Close Button -->
            <button class="popup-close absolute top-4 right-4 z-10 p-2 text-gray-400 hover:text-gray-600 transition-colors focus:outline-none focus:ring-2 focus:ring-[#98C441] focus:ring-offset-2 rounded" aria-label="Close dialog">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                
                <!-- Left Column: Content -->
                <div class="bg-gradient-to-br from-[#1F3131] to-[#006155] p-8 lg:p-20 text-white relative overflow-hidden">
                    <!-- Background Pattern -->
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/pattern-research.svg'); ?>" 
                         alt="Background pattern" 
                         class="absolute inset-0 w-full h-full object-cover opacity-20 pointer-events-none select-none"
                         decoding="async" loading="lazy">
                    
                    <div class="relative z-10">
                        <span class="text-base font-light text-white">
                            <?php echo wp_kses_post($small_title); ?>
                        </span>
                        
                        <h2 id="research-paper-title-<?php echo esc_attr($post_id); ?>" class="text-2xl lg:text-4xl font-bold leading-tight mt-4 mb-6">
                            <?php echo wp_kses_post($big_title); ?>
                        </h2>
                        
                        <div id="research-paper-description-<?php echo esc_attr($post_id); ?>" class="text-lg leading-relaxed prose-invert max-w-prose font-normal">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Form -->
                <div class="p-8 lg:p-12 relative foundation-gradient">
                    <div id="research-paper-popup-<?php echo esc_attr($post_id); ?>-form-wrapper" class="forminator-gradient text-[#1F3131] relative">
                        <h3 class="text-2xl lg:text-4xl font-bold text-[#1F3131] mb-6">
                            Download White Paper
                        </h3>
                        
                        <!-- Minimalistic Artistic Loading Overlay -->
                        <div class="loading-overlay hidden absolute inset-0 bg-gradient-to-br from-[#F9F8F6]/95 to-white/95 backdrop-blur-sm items-center justify-center z-50 rounded-lg transition-opacity duration-700">
                            <div class="text-center space-y-8">
                                <!-- Artistic Dot Animation -->
                                <div class="flex items-center justify-center space-x-3">
                                    <div class="loading-dot w-3 h-3 rounded-full transition-all duration-1000 ease-out inactive"></div>
                                    <div class="loading-dot w-3 h-3 rounded-full transition-all duration-1000 ease-out inactive"></div>
                                    <div class="loading-dot w-3 h-3 rounded-full transition-all duration-1000 ease-out inactive"></div>
                                </div>
                                
                                <!-- Status Text -->
                                <div class="space-y-2">
                                    <p class="text-[#1F3131] font-light text-lg tracking-wide animate-fade-in">
                                        <span class="loading-text">Sending your white paper</span>
                                        <span class="success-text hidden text-[#98C441]">Successfully sent!</span>
                                    </p>
                                    <p class="text-[#006155] text-sm animate-fade-in">
                                        <span class="loading-subtext">Please wait while we process your request</span>
                                        <span class="success-subtext hidden">Check your email inbox</span>
                                    </p>
                                </div>
                                
                                <!-- Success State -->
                                <div class="success-checkmark hidden text-center">
                                    <div class="inline-flex items-center justify-center w-12 h-12 bg-[#98C441] rounded-full mb-3 animate-bounce">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <p class="text-[#1F3131] font-semibold">White paper delivered!</p>
                                    <p class="text-[#006155] text-sm mt-1">Check your email inbox</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Persistent Success Message (shown after loader hides) -->
                        <div class="success-message hidden mb-4 p-4 bg-green-50 border border-green-200 rounded-lg transition-all duration-300" role="alert" aria-live="polite">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-green-800">Success! White paper sent</p>
                                    <p class="text-sm text-green-700 mt-1">Check your email inbox for the download link. The popup will close automatically.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Already Submitted Warning -->
                        <div class="already-submitted hidden mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg transition-all duration-300">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-blue-800">Already Submitted</p>
                                    <p class="text-sm text-blue-700 mt-1">You've already submitted this form. Check your email for the white paper. You can submit again after 24 hours.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Error Message -->
                        <div class="error-message hidden mb-4 p-4 bg-red-50 border border-red-200 rounded-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500" role="alert" aria-live="assertive" tabindex="-1">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-red-800">Submission Error</p>
                                    <p class="text-sm text-red-700 mt-1 error-text">There was a problem submitting your request. Please try again or contact us if the issue persists.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div id="research-paper-form-container">
                            <!-- Hidden field with the research paper ID -->
                            <input type="hidden" name="hidden-1" value="<?php echo esc_attr($post_id); ?>">
                            <?php echo do_shortcode('[forminator_form id="1498"]'); ?>
                        </div>
                        
                        <p class="text-sm text-start mt-6">
                            Piedmont Global is committed to protecting your privacy. We use the information you provide to
                            contact you about our services and to respond to your inquiry. To learn more, check out our <a
                                href="/privacy-policy" class="underline text-[#98C441]">Privacy Policy</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Restore original post data
wp_reset_postdata();
$post = $original_post;
?>
