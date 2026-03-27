<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package PiedmontGlobal
 */

get_header();
?>
<header class="shadow-sm bg-[#1F3131]" role="banner">
    <div class="bg-[#1F3131] pt-8 pb-12">
        <nav aria-label="Primary desktop navigation">
            <?php get_template_part('components/navigation/desktop'); ?>
        </nav>
        <nav aria-label="Primary mobile navigation">
            <?php get_template_part('components/navigation/mobile'); ?>
        </nav>
    </div>

    <div class="relative py-20 bg-cover bg-no-repeat bg-right-bottom"
        style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/icons/single-industries.svg'); ?>');">

        <!-- gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#1F3131]/90 via-[#1F3131]/70 to-transparent"
            aria-hidden="true"></div>

        <!-- Content container -->
        <div class="relative z-10 h-full flex items-center">
            <div class="max-w-7xl mx-auto w-full px-6 lg:px-0 pb-4 md:pb-12 lg:pb-12 text-white">

                <h1 class="text-2xl mt-4 md:text-4xl lg:text-5xl font-bold" data-aos="fade-up" data-aos-duration="400"
                    data-aos-delay="50">
                    <?php the_title(); ?>
                </h1>
                <p class="text-base lg:text-lg my-4 max-w-4xl" data-aos="fade-up" data-aos-duration="400"
                    data-aos-delay="100">
                    Conversations that explore language, culture, and the people driving global communication.
                </p>
                <a href="/contact"
                    class="inline-flex items-center gap-2 bg-[#98C441] text-[#1F3131] px-4 py-2 mt-4 font-bold text-base shadow-md rounded-0 hover:bg-[#8AB738] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#98C441] focus:ring-offset-[#1F3131] transition-colors duration-200"
                    aria-label="Schedule a consultation - opens contact form">
                    <span>Schedule a consultation</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>

<section id="webinar-content" class="relative py-20 bg-[#F7F7F5]">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=" 40" height="40" viewBox="0 0 40 40"
        xmlns="http://www.w3.org/2000/svg" %3E%3Cg fill="none" fill-rule="evenodd" %3E%3Cg fill="%23F9F8F6"
        fill-opacity="0.4" %3E%3Cpath
        d="M20 20c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10zm10 0c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10z"
        /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-0">
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-16 items-start">

            <!-- Left Column: Content & Preview -->
            <div class="space-y-12">
                <!-- Webinar Preview Card -->
                <div id="webinar-locked-content"
                    class="group relative overflow-hidden rounded-0 bg-white shadow-2xl border border-gray-200/50">
                    <!-- Image -->
                    <div class="relative aspect-video overflow-hidden">
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                        <!-- Premium Overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-[#1F3131]/80 via-[#1F3131]/20 to-transparent">
                        </div>

                        <!-- Premium Badge -->
                        <div class="absolute top-6 left-6">
                            <div
                                class="flex items-center gap-2 bg-gradient-to-r from-[#98C441] to-[#8AB738] text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                Exclusive Content
                            </div>
                        </div>

                        <!-- Lock Icon with Animation -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="relative">
                                <div
                                    class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/30">
                                    <svg class="w-12 h-12 text-white animate-pulse" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <div class="absolute inset-0 w-24 h-24 bg-white/10 rounded-full animate-ping"></div>
                            </div>
                        </div>

                       
                    </div>

                    <!-- Content Preview -->
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-[#1F3131] mb-3"><?php the_title(); ?></h3>

                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-[#98C441]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Expert-led
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-[#98C441]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Actionable insights
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Description -->
                <div class="prose prose-lg prose-slate max-w-none">
                    <div class="bg-white prose rounded-0 p-8 shadow-xl border border-gray-200/50">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

            <!-- Right Column: Access Form -->
            <div class="sticky top-20">
                <div id="webinar-form-section"
                    class="relative overflow-hidden rounded-0 bg-gradient-to-br from-[#1F3131] via-[#2A3F3F] to-[#1F3131] shadow-2xl border border-[#1F3131]/20">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=" 60" height="60"
                        viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg" %3E%3Cg fill="none" fill-rule="evenodd"
                        %3E%3Cg fill="%23ffffff" fill-opacity="0.02" %3E%3Ccircle cx="30" cy="30" r="1"
                        /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>

                    <!-- Content -->
                    <div class="relative p-8 lg:p-12">
                        <!-- Header -->
                        <div class="text-start mb-8">
                            

                           
                        <h3 class="text-3xl font-bold text-white mb-3">Get instant access to the recorded webinar</h3>

                        </div>



                        <!-- Form -->
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                            <?php echo do_shortcode('[forminator_form id="735"]'); ?>
                        </div>

                    </div>
                </div>
                <!-- Unlocked Content (Hidden initially) -->
                <div id="webinar-unlocked-content" class="hidden mt-16">
                    <div class="max-w-4xl mx-auto">
                        <div class="bg-white rounded-3xl overflow-hidden shadow-2xl border border-gray-200/50">
                            <!-- Video Player -->
                            <div class="aspect-video bg-[#1F3131]">
                                <iframe
                                    src="https://www.youtube.com/embed/<?php the_field('youtube_video_embedd_id'); ?>"
                                    title="<?php the_title(); ?> - Full Recording" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen class="w-full h-full">
                                </iframe>
                            </div>

                            <!-- Video Info -->
                            <div class="p-8">
                                

                                <h3 class="text-xl font-bold text-[#1F3131] mb-3">
                                    <?php the_title(); ?> - Full Recording
                                </h3>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>



<style>
/* Professional Form Styling */
.forminator-label {
    color: #e2e8f0 !important;
    font-size: 16px !important;
    font-weight: 600 !important;
    margin-bottom: 8px !important;
}

.forminator-input,
.forminator-textarea,
.forminator-select {
    background-color: rgba(255, 255, 255, 0.1) !important;
    color: #ffffff !important;
    font-size: 16px !important;
    border: 2px solid rgba(255, 255, 255, 0.2) !important;
    border-radius: 12px !important;
    padding: 16px !important;
    backdrop-filter: blur(10px) !important;
    transition: all 0.3s ease !important;
}

.forminator-input:focus,
.forminator-textarea:focus,
.forminator-select:focus {
    border-color: #98C441 !important;
    box-shadow: 0 0 0 3px rgba(152, 196, 65, 0.1) !important;
    outline: none !important;
}

.forminator-input::placeholder,
.forminator-textarea::placeholder {
    color: rgba(255, 255, 255, 0.6) !important;
}

.forminator-design--default .forminator-button-submit {
    background: linear-gradient(135deg, #98C441 0%, #8AB738 100%) !important;
    color: #1F3131 !important;
    font-size: 16px !important;
    font-weight: 700 !important;
    border: none !important;
    border-radius: 12px !important;
    padding: 16px 32px !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 15px rgba(152, 196, 65, 0.3) !important;
    text-transform: none !important;
    letter-spacing: 0.5px !important;
}

.forminator-design--default .forminator-button-submit:hover {
    background: linear-gradient(135deg, #8AB738 0%, #7BA035 100%) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(152, 196, 65, 0.4) !important;
}

.forminator-design--default .forminator-button-submit:active {
    transform: translateY(0) !important;
}

/* Form container styling */
.forminator-form {
    background: transparent !important;
}

.forminator-field {
    margin-bottom: 24px !important;
}

/* Success message styling */
.forminator-response-message,
.forminator-message-success {
    background: linear-gradient(135deg, #98C441 0%, #8AB738 100%) !important;
    color: #1F3131 !important;
    border: none !important;
    border-radius: 12px !important;
    padding: 16px !important;
    margin-top: 16px !important;
    font-weight: 600 !important;
}

/* Error message styling */
.forminator-message-error {
    background: rgba(239, 68, 68, 0.1) !important;
    color: #fca5a5 !important;
    border: 1px solid rgba(239, 68, 68, 0.3) !important;
    border-radius: 12px !important;
    padding: 16px !important;
    margin-top: 16px !important;
    font-weight: 600 !important;
}

/* Webinar content transition animations */
#webinar-locked-content,
#webinar-unlocked-content,
#webinar-form-section {
    transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
}

#webinar-locked-content.hidden,
#webinar-unlocked-content.hidden,
#webinar-form-section.hidden {
    opacity: 0;
    transform: translateY(20px);
    pointer-events: none;
}

#webinar-unlocked-content:not(.hidden) {
    opacity: 1;
    transform: translateY(0);
    animation: slideInUp 0.6s ease-out;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>



<script>
document.addEventListener("DOMContentLoaded", () => {
    // ========================================
    // WEBINAR FORM TRACKING FUNCTIONALITY
    // ========================================
    // This script tracks when users submit the Forminator form (ID: 735)
    // and stores the submission state in localStorage. Once submitted,
    // the locked content (image with lock overlay) is hidden and the
    // webinar video content is shown instead.
    // ========================================

    const WEBINAR_FORM_ID = '735';
    const STORAGE_KEY = 'webinar_form_submitted_' + WEBINAR_FORM_ID;
    const EXPIRATION_MINUTES = 5; // 5 minutes for testing

    // Check if form was already submitted and not expired
    function checkFormSubmission() {
        try {
            const storedData = localStorage.getItem(STORAGE_KEY);
            if (storedData) {
                const data = JSON.parse(storedData);
                const now = Date.now();
                const expirationTime = data.timestamp + (EXPIRATION_MINUTES * 60 * 1000);

                if (now < expirationTime) {
                    showUnlockedContent();
                    return;
                } else {
                    // Expired, remove from storage
                    localStorage.removeItem(STORAGE_KEY);
                }
            }
        } catch (error) {
            console.warn('Error checking form submission:', error);
            localStorage.removeItem(STORAGE_KEY);
        }
    }

    // Show unlocked content with smooth animation
    function showUnlockedContent() {
        const lockedContent = document.getElementById('webinar-locked-content');
        const unlockedContent = document.getElementById('webinar-unlocked-content');
        const formSection = document.getElementById('webinar-form-section');

        // Hide locked content and form
        if (lockedContent) {
            lockedContent.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
            lockedContent.style.opacity = '0';
            lockedContent.style.transform = 'translateY(20px)';
            setTimeout(() => lockedContent.classList.add('hidden'), 500);
        }

        if (formSection) {
            formSection.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
            formSection.style.opacity = '0';
            formSection.style.transform = 'translateY(20px)';
            setTimeout(() => formSection.classList.add('hidden'), 500);
        }

        // Show unlocked content
        if (unlockedContent) {
            unlockedContent.classList.remove('hidden');
            // Trigger animation
            setTimeout(() => {
                unlockedContent.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                unlockedContent.style.opacity = '1';
                unlockedContent.style.transform = 'translateY(0)';
            }, 100);
        }

        // Scroll to unlocked content
        setTimeout(() => {
            unlockedContent.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }, 800);
    }

    // Track Forminator form submission using multiple methods
    function trackFormSubmission() {
        // Method 1: Listen for Forminator form success events
        document.addEventListener('forminator_submit_success', function(event) {
            if (event.detail && event.detail.form_id == WEBINAR_FORM_ID) {
                const data = {
                    submitted: true,
                    timestamp: Date.now()
                };
                localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
                showUnlockedContent();
            }
        });

        // Method 2: Intercept jQuery AJAX calls (Forminator uses jQuery)
        if (window.jQuery) {
            const originalAjax = window.jQuery.ajax;
            window.jQuery.ajax = function(options) {
                const originalSuccess = options.success;
                options.success = function(data, textStatus, jqXHR) {
                    if (data && data.success && data.data && data.data.form_id == WEBINAR_FORM_ID) {
                        const data = {
                            submitted: true,
                            timestamp: Date.now()
                        };
                        localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
                        showUnlockedContent();
                    }
                    if (originalSuccess) {
                        originalSuccess.call(this, data, textStatus, jqXHR);
                    }
                };
                return originalAjax.call(this, options);
            };
        }

        // Method 3: Monitor DOM changes for success messages (most reliable method)
        const formContainer = document.querySelector('#forminator-module-' + WEBINAR_FORM_ID);
        if (formContainer) {
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'childList') {
                        const successMessage = formContainer.querySelector(
                            '.forminator-response-message, .forminator-message-success');
                        if (successMessage && successMessage.textContent.toLowerCase().includes(
                                'success')) {
                            const data = {
                                submitted: true,
                                timestamp: Date.now()
                            };
                            localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
                            showUnlockedContent();
                            observer.disconnect();
                        }
                    }
                });
            });
            observer.observe(formContainer, {
                childList: true,
                subtree: true
            });
        }

        // Method 4: Listen for form submission button clicks and check for success after delay
        const formButton = document.querySelector('#forminator-module-' + WEBINAR_FORM_ID +
            ' .forminator-button-submit');
        if (formButton) {
            formButton.addEventListener('click', function() {
                setTimeout(() => {
                    // Check if form success message appeared
                    const successMessage = document.querySelector('#forminator-module-' +
                        WEBINAR_FORM_ID + ' .forminator-response-message');
                    const successDiv = document.querySelector('#forminator-module-' +
                        WEBINAR_FORM_ID + ' .forminator-message-success');

                    if ((successMessage && successMessage.textContent.toLowerCase().includes(
                            'success')) ||
                        (successDiv && successDiv.style.display !== 'none')) {
                        const data = {
                            submitted: true,
                            timestamp: Date.now()
                        };
                        localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
                        showUnlockedContent();
                    }
                }, 3000);
            });
        }
    }

    // Initialize
    checkFormSubmission();
    trackFormSubmission();

    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
<section class="pb-40 pt-20"
    style="background: linear-gradient(to bottom, #F7F7F5 0%, #F7F7F5 70%, #98C44180 85%, #00615580 100%);">
    <div class="max-w-3xl mx-auto px-8 lg:px-0 text-center">
        <h2 class="text-3xl lg:text-5xl font-bold text-black mb-6">
            Ready to move from translation to transformation?
        </h2>
        <a href="/contact"
            class="inline-block bg-[#98C441] text-black px-6 py-3 font-bold text-base lg:text-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#98C441] focus:ring-offset-2 focus:ring-offset-[#1F311]"
           >
            Connect with our team
        </a>
    </div>
</section>
<?php
get_footer();