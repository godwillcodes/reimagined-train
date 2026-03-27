/**
 * Research Paper Form Handler - Vanilla JavaScript
 * Handles form submission states, loading animations, and user feedback
 */

(function() {
    'use strict';

    /**
     * Research Paper Form Controller
     */
    class ResearchPaperForm {
        constructor(containerId, options = {}) {
            this.container = document.getElementById(containerId);
            if (!this.container) return;

            this.formId = options.formId || 1498;
            this.isPopup = options.isPopup || false;
            this.popupId = options.popupId || null;
            
            // State
            this.state = {
                submitting: false,
                success: false,
                error: false,
                errorMessage: '',
                submittedOnce: false,
                dots: [0, 0, 0]
            };

            // DOM elements
            this.elements = {};
            this.init();
        }

        init() {
            this.findElements();
            this.checkPreviousSubmission();
            this.setupEventListeners();
            this.updateUI();
        }

        findElements() {
            const container = this.container;
            this.elements = {
                loadingOverlay: container.querySelector('.loading-overlay'),
                successMessage: container.querySelector('.success-message'),
                errorMessage: container.querySelector('.error-message'),
                alreadySubmitted: container.querySelector('.already-submitted'),
                formContainer: container.querySelector('#research-paper-form-container'),
                dots: container.querySelectorAll('.loading-dot')
            };
        }

        checkPreviousSubmission() {
            const submitted = localStorage.getItem('research-paper-' + this.formId + '-submitted');
            if (submitted) {
                const submittedTime = parseInt(submitted);
                const hoursSinceSubmission = (Date.now() - submittedTime) / (1000 * 60 * 60);
                if (hoursSinceSubmission < 24) {
                    this.state.submittedOnce = true;
                }
            }
        }

        setupEventListeners() {
            const formContainer = this.elements.formContainer;
            const parentContainer = this.isPopup 
                ? document.querySelector('#' + this.popupId)
                : this.container.closest('.foundation-gradient');

            // Form submission events
            const handleSubmit = (event) => {
                const formId = event?.detail?.form_id || event?.detail?.formId || this.formId;
                if (formId == this.formId && this.isFormContainer(event, formContainer, parentContainer)) {
                    if (!this.state.submittedOnce) {
                        this.startLoading();
                    }
                }
            };

            const handleSubmitted = (event) => {
                const formId = event?.detail?.form_id || event?.detail?.formId || this.formId;
                if (formId == this.formId && this.isFormContainer(event, formContainer, parentContainer)) {
                    this.showSuccess();
                    this.state.submittedOnce = true;
                    localStorage.setItem('research-paper-' + this.formId + '-submitted', Date.now().toString());
                }
            };

            const handleError = (event) => {
                const formId = event?.detail?.form_id || event?.detail?.formId || this.formId;
                if (formId == this.formId && this.isFormContainer(event, formContainer, parentContainer)) {
                    this.hideLoader();
                    const errorMsg = event?.detail?.message || event?.detail?.error || 'Unknown error occurred';
                    this.showError(errorMsg);
                }
            };

            // Multiple event listeners for reliability
            document.addEventListener('forminator-form-submit', handleSubmit);
            document.addEventListener('forminator-form-submitted', handleSubmitted);
            document.addEventListener('forminator-form-error', handleError);
            document.addEventListener('forminator_submit_success', handleSubmitted);
            document.addEventListener('forminator_submit_error', handleError);

            // Intercept jQuery AJAX for Forminator
            if (window.jQuery && !window.jQuery._researchPaperIntercepted) {
                const self = this;
                const originalAjax = window.jQuery.ajax;
                window.jQuery.ajax = function(options) {
                    const originalSuccess = options.success;
                    const originalError = options.error;

                    options.success = function(data, textStatus, jqXHR) {
                        if (data && data.data && data.data.form_id == self.formId) {
                            if (data.success) {
                                handleSubmitted({ detail: { form_id: data.data.form_id } });
                            } else {
                                handleError({ detail: { form_id: data.data.form_id, message: data.message || 'Submission failed' } });
                            }
                        }
                        if (originalSuccess) originalSuccess.call(this, data, textStatus, jqXHR);
                    };

                    options.error = function(jqXHR, textStatus, errorThrown) {
                        if (jqXHR.responseJSON && jqXHR.responseJSON.data && jqXHR.responseJSON.data.form_id == self.formId) {
                            handleError({ detail: { form_id: jqXHR.responseJSON.data.form_id, message: errorThrown || 'Network error' } });
                        }
                        if (originalError) originalError.call(this, jqXHR, textStatus, errorThrown);
                    };

                    return originalAjax.call(this, options);
                };
                window.jQuery._researchPaperIntercepted = true;
            }
        }

        isFormContainer(event, formContainer, parentContainer) {
            if (!formContainer) return false;
            if (this.isPopup) {
                return formContainer.closest('#' + this.popupId) !== null;
            }
            return parentContainer && parentContainer.contains(formContainer);
        }

        startLoading() {
            if (this.state.submittedOnce) return;

            this.state.submitting = true;
            this.state.dots = [0, 0, 0];
            this.state.success = false;
            this.state.error = false;
            this.state.errorMessage = '';

            // Disable form inputs
            const formInputs = this.elements.formContainer.querySelectorAll('input, button');
            formInputs.forEach(input => {
                if (input.type !== 'hidden') {
                    input.disabled = true;
                }
            });

            // Hide Forminator's default spinner
            const forminatorSpinners = document.querySelectorAll('.forminator-loader, .forminator-spinner');
            forminatorSpinners.forEach(spinner => spinner.style.display = 'none');

            // Animate dots
            setTimeout(() => {
                this.state.dots.forEach((_, i) => {
                    setTimeout(() => {
                        this.state.dots[i] = 1;
                        this.updateDots();
                    }, i * 200);
                });
            }, 100);

            this.updateLiveRegion('Submitting form, please wait...');
            this.updateUI();
        }

        showSuccess() {
            this.state.success = true;
            this.state.error = false;
            this.state.errorMessage = '';

            // Re-enable form inputs
            const formInputs = this.elements.formContainer.querySelectorAll('input, button');
            formInputs.forEach(input => {
                input.disabled = false;
            });

            this.updateLiveRegion('Form submitted successfully! Check your email inbox for the white paper.');

            this.updateUI();

            setTimeout(() => {
                this.state.submitting = false;
                this.updateUI();
                
                // Auto-close popup after 6 seconds total if it's a popup
                if (this.isPopup) {
                    setTimeout(() => {
                        if (this.state.success) {
                            const popupController = window.researchPaperPopups && window.researchPaperPopups[this.popupId];
                            if (popupController) {
                                popupController.close();
                            }
                            this.state.success = false;
                            this.updateUI();
                        }
                    }, 3000);
                }
            }, 3000);
        }

        hideLoader() {
            this.state.submitting = false;

            // Re-enable form inputs
            const formInputs = this.elements.formContainer.querySelectorAll('input, button');
            formInputs.forEach(input => {
                if (input.type !== 'hidden') {
                    input.disabled = false;
                }
            });

            // Reset Forminator's form state
            const forminatorForms = document.querySelectorAll('.forminator-form');
            forminatorForms.forEach(form => {
                form.classList.remove('forminator-submitting');
            });

            this.updateUI();
        }

        showError(message = '') {
            this.state.error = true;
            this.state.errorMessage = message || 'There was a problem submitting your request. Please try again or contact us if the issue persists.';
            this.state.success = false;

            this.updateLiveRegion('Error: ' + this.state.errorMessage);

            // Focus on error message for accessibility
            setTimeout(() => {
                const errorElement = this.elements.errorMessage;
                if (errorElement) {
                    errorElement.focus();
                    errorElement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            }, 100);

            setTimeout(() => {
                this.state.error = false;
                this.state.errorMessage = '';
                this.updateUI();
            }, 8000);

            this.updateUI();
        }

        updateDots() {
            if (!this.elements.dots || this.elements.dots.length === 0) return;
            this.elements.dots.forEach((dot, i) => {
                if (this.state.dots[i] === 0) {
                    dot.classList.remove('active');
                    dot.classList.add('inactive');
                } else {
                    dot.classList.remove('inactive');
                    dot.classList.add('active');
                }
            });
        }

        updateUI() {
            // Loading overlay
            if (this.elements.loadingOverlay) {
                if (this.state.submitting) {
                    this.elements.loadingOverlay.classList.remove('hidden');
                    this.elements.loadingOverlay.classList.add('visible');
                    
                    // Update loading text visibility
                    const loadingText = this.elements.loadingOverlay.querySelector('.loading-text');
                    const loadingSubtext = this.elements.loadingOverlay.querySelector('.loading-subtext');
                    const successText = this.elements.loadingOverlay.querySelector('.success-text');
                    const successSubtext = this.elements.loadingOverlay.querySelector('.success-subtext');
                    const successCheckmark = this.elements.loadingOverlay.querySelector('.success-checkmark');
                    
                    if (this.state.success) {
                        if (loadingText) loadingText.classList.add('hidden');
                        if (loadingSubtext) loadingSubtext.classList.add('hidden');
                        if (successText) successText.classList.remove('hidden');
                        if (successSubtext) successSubtext.classList.remove('hidden');
                        if (successCheckmark) successCheckmark.classList.remove('hidden');
                    } else {
                        if (loadingText) loadingText.classList.remove('hidden');
                        if (loadingSubtext) loadingSubtext.classList.remove('hidden');
                        if (successText) successText.classList.add('hidden');
                        if (successSubtext) successSubtext.classList.add('hidden');
                        if (successCheckmark) successCheckmark.classList.add('hidden');
                    }
                } else {
                    this.elements.loadingOverlay.classList.remove('visible');
                    this.elements.loadingOverlay.classList.add('hidden');
                }
            }

            // Success message
            if (this.elements.successMessage) {
                if (this.state.success && !this.state.submitting) {
                    this.elements.successMessage.classList.remove('hidden');
                    this.elements.successMessage.classList.add('visible');
                } else {
                    this.elements.successMessage.classList.remove('visible');
                    this.elements.successMessage.classList.add('hidden');
                }
            }

            // Error message
            if (this.elements.errorMessage) {
                const errorText = this.elements.errorMessage.querySelector('.error-text');
                if (errorText) {
                    errorText.textContent = this.state.errorMessage || 'There was a problem submitting your request. Please try again or contact us if the issue persists.';
                }
                if (this.state.error) {
                    this.elements.errorMessage.classList.remove('hidden');
                    this.elements.errorMessage.classList.add('visible');
                } else {
                    this.elements.errorMessage.classList.remove('visible');
                    this.elements.errorMessage.classList.add('hidden');
                }
            }

            // Already submitted message
            if (this.elements.alreadySubmitted) {
                if (this.state.submittedOnce && !this.state.submitting && !this.state.success) {
                    this.elements.alreadySubmitted.classList.remove('hidden');
                    this.elements.alreadySubmitted.classList.add('visible');
                } else {
                    this.elements.alreadySubmitted.classList.remove('visible');
                    this.elements.alreadySubmitted.classList.add('hidden');
                }
            }

            // Update dots
            this.updateDots();
        }

        updateLiveRegion(message) {
            const liveRegionId = this.isPopup 
                ? 'research-paper-live-region-' + this.popupId
                : 'research-paper-live-region-single';
            let liveRegion = document.getElementById(liveRegionId);
            if (!liveRegion) {
                liveRegion = document.createElement('div');
                liveRegion.id = liveRegionId;
                liveRegion.setAttribute('role', 'status');
                liveRegion.setAttribute('aria-live', 'polite');
                liveRegion.setAttribute('aria-atomic', 'true');
                liveRegion.className = 'sr-only';
                document.body.appendChild(liveRegion);
            }
            liveRegion.textContent = message;
        }
    }

    /**
     * Popup Controller
     */
    class ResearchPaperPopup {
        constructor(popupId) {
            this.popupId = popupId;
            
            // Initialize ALL properties FIRST, before any early returns
            // This ensures the object is always in a valid state, even if popup doesn't exist yet
            this.state = {
                open: false
            };
            this.formController = null;
            this.listenersSetup = false; // Track if listeners are already set up
            this.eventHandlers = {}; // Store bound handlers for cleanup
            this.elements = {}; // Initialize elements object to prevent errors
            
            // Now check if popup exists
            this.popup = document.getElementById(popupId);
            if (!this.popup) {
                console.warn('Research paper popup not found:', popupId);
                // Safe to return now - all properties are initialized
                return;
            }

            // Popup exists - proceed with full initialization
            this.init();
        }

        init() {
            this.findElements();
            this.setupEventListeners();
            this.updateUI();
        }

        findElements() {
            this.elements = {
                backdrop: this.popup.querySelector('.popup-backdrop'),
                closeButton: this.popup.querySelector('.popup-close'),
                formContainer: this.popup.querySelector('#research-paper-form-container')
            };
        }

        removeEventListeners() {
            // Safety check - ensure eventHandlers exists (defensive programming)
            if (!this.eventHandlers) {
                this.eventHandlers = {};
            }

            // Remove keyboard listener
            if (this.eventHandlers.keydown) {
                document.removeEventListener('keydown', this.eventHandlers.keydown);
                delete this.eventHandlers.keydown;
            }

            // Remove backdrop click listener
            // Safety check for elements object
            if (this.elements && this.elements.backdrop && this.eventHandlers.backdropClick) {
                this.elements.backdrop.removeEventListener('click', this.eventHandlers.backdropClick);
                delete this.eventHandlers.backdropClick;
            }

            // Remove popup content click listener
            const popupContent = this.popup ? this.popup.querySelector('.popup-content') : null;
            if (popupContent && this.eventHandlers.contentClick) {
                popupContent.removeEventListener('click', this.eventHandlers.contentClick);
                delete this.eventHandlers.contentClick;
            }

            // Remove close button click listener
            // Safety check for elements object
            if (this.elements && this.elements.closeButton && this.eventHandlers.closeClick) {
                this.elements.closeButton.removeEventListener('click', this.eventHandlers.closeClick);
                delete this.eventHandlers.closeClick;
            }

            this.listenersSetup = false;
        }

        setupEventListeners() {
            // Remove existing listeners first to prevent duplicates
            if (this.listenersSetup) {
                this.removeEventListeners();
            }

            // Note: Event listener is set up globally in init() function
            // This is just for popup-specific handlers

            // Keyboard navigation - ESC to close
            this.eventHandlers.keydown = (e) => {
                if (e.key === 'Escape' && this.state.open) {
                    const formController = this.formController;
                    if (!formController || !formController.state.submitting) {
                        this.close();
                    }
                }
            };
            document.addEventListener('keydown', this.eventHandlers.keydown);

            // Backdrop click
            if (this.elements.backdrop) {
                this.eventHandlers.backdropClick = (e) => {
                    e.stopPropagation();
                    const formController = this.formController;
                    if (!formController || !formController.state.submitting) {
                        this.close();
                    }
                };
                this.elements.backdrop.addEventListener('click', this.eventHandlers.backdropClick);
            }
            
            // Prevent closing when clicking inside popup content
            const popupContent = this.popup.querySelector('.popup-content');
            if (popupContent) {
                this.eventHandlers.contentClick = (e) => {
                    e.stopPropagation();
                };
                popupContent.addEventListener('click', this.eventHandlers.contentClick);
            }

            // Close button
            if (this.elements.closeButton) {
                this.eventHandlers.closeClick = () => {
                    const formController = this.formController;
                    if (!formController || !formController.state.submitting) {
                        this.close();
                    }
                };
                this.elements.closeButton.addEventListener('click', this.eventHandlers.closeClick);
            }

            // Initialize form controller
            if (this.elements.formContainer) {
                // Find the form wrapper (it should have an ID like research-paper-popup-{id}-form-wrapper)
                const formWrapper = this.elements.formContainer.closest('[id*="form-wrapper"]');
                if (formWrapper) {
                    this.formController = new ResearchPaperForm(formWrapper.id, {
                        formId: 1498,
                        isPopup: true,
                        popupId: this.popup.id
                    });
                }
            }

            this.listenersSetup = true;
        }

        open() {
            // Re-check popup exists (in case DOM changed)
            if (!this.popup) {
                this.popup = document.getElementById(this.popupId);
                if (!this.popup) {
                    console.error('Cannot open popup - element not found:', this.popupId);
                    return;
                }
                // Re-initialize if popup was recreated
                // Remove old listeners first to prevent duplicates
                // Safety: removeEventListeners() now handles undefined properties gracefully
                this.removeEventListeners();
                this.findElements();
                this.setupEventListeners();
            }
            
            // Safety check - ensure state exists before accessing
            if (!this.state) {
                this.state = { open: false };
            }
            
            this.state.open = true;
            this.updateUI();
            
            // Focus management
            setTimeout(() => {
                if (this.elements && this.elements.closeButton) {
                    this.elements.closeButton.focus();
                }
            }, 100);
        }

        close() {
            // Safety check - ensure state exists
            if (!this.state) {
                this.state = { open: false };
            }
            this.state.open = false;
            this.updateUI();
        }

        updateUI() {
            // Safety check - ensure state exists
            if (!this.state) {
                this.state = { open: false };
            }
            
            // Safety check - ensure popup exists
            if (!this.popup) {
                return;
            }
            
            if (this.state.open) {
                this.popup.classList.remove('hidden');
                this.popup.classList.add('visible');
                if (this.elements.backdrop) {
                    this.elements.backdrop.classList.remove('hidden');
                    this.elements.backdrop.classList.add('visible');
                }
                if (this.elements.closeButton) {
                    const formController = this.formController;
                    if (formController && formController.state.submitting) {
                        this.elements.closeButton.disabled = true;
                        this.elements.closeButton.classList.add('opacity-50', 'cursor-not-allowed');
                    } else {
                        this.elements.closeButton.disabled = false;
                        this.elements.closeButton.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                }
                const popupContent = this.popup.querySelector('.popup-content');
                if (popupContent) {
                    popupContent.classList.remove('hidden');
                    popupContent.classList.add('visible');
                }
                document.body.style.overflow = 'hidden';
            } else {
                this.popup.classList.remove('visible');
                this.popup.classList.add('hidden');
                if (this.elements.backdrop) {
                    this.elements.backdrop.classList.remove('visible');
                    this.elements.backdrop.classList.add('hidden');
                }
                const popupContent = this.popup.querySelector('.popup-content');
                if (popupContent) {
                    popupContent.classList.remove('visible');
                    popupContent.classList.add('hidden');
                }
                document.body.style.overflow = '';
            }
        }
    }

    /**
     * Scroll Detection for Research Paper Modal
     */
    class ResearchPaperScrollTrigger {
        constructor() {
            this.modalShown = false;
            this.init();
        }

        init() {
            const triggerSection = document.getElementById('related-resources');
            if (!triggerSection) {
                console.warn('Related resources section not found. Scroll trigger will not work.');
                return;
            }

            // Use requestAnimationFrame to ensure DOM is ready
            requestAnimationFrame(() => {
                // Check immediately on load
                this.checkScroll();
            });

            // Check on scroll with throttling
            let scrollTimeout;
            window.addEventListener('scroll', () => {
                if (scrollTimeout) {
                    cancelAnimationFrame(scrollTimeout);
                }
                scrollTimeout = requestAnimationFrame(() => {
                    this.checkScroll();
                });
            }, { passive: true });
            
            // Also check on resize (in case viewport changes)
            let resizeTimeout;
            window.addEventListener('resize', () => {
                if (resizeTimeout) {
                    clearTimeout(resizeTimeout);
                }
                resizeTimeout = setTimeout(() => {
                    this.checkScroll();
                }, 100);
            }, { passive: true });
        }

        checkScroll() {
            if (this.modalShown) return;

            const section = document.getElementById('related-resources');
            if (!section) {
                // Section doesn't exist yet, try again later
                return;
            }

            const rect = section.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom >= 0;

            if (isVisible) {
                // Check if popup exists BEFORE setting modalShown
                // This allows retry if popup loads later
                const popups = document.querySelectorAll('[id^="research-paper-popup-"]');
                if (popups.length === 0) {
                    // Popup doesn't exist yet - don't set modalShown, allow retry
                    // This is normal if no research paper is assigned OR if popup is still loading
                    console.debug('Research paper popup not found. Will retry when popup loads or if research paper is assigned.');
                    return;
                }
                
                // Only set modalShown if popups exist and we're going to dispatch the event
                // This prevents the flag from blocking future attempts
                this.modalShown = true;
                
                setTimeout(() => {
                    // Dispatch custom event to open the research paper popup
                    window.dispatchEvent(new CustomEvent('open-research-paper-modal'));
                }, 1000);
            }
        }
    }

    // Global event listener for opening popup (works even if popup loads later)
    function setupGlobalPopupListener() {
        // Use a named function so we can remove it if needed, and ensure it only runs once
        if (window._researchPaperModalListenerSetup) {
            return; // Already set up
        }
        window._researchPaperModalListenerSetup = true;
        
        window.addEventListener('open-research-paper-modal', function handleOpenModal() {
            // Find all popups and open the first one (or all if multiple)
            const popups = document.querySelectorAll('[id^="research-paper-popup-"]');
            
            if (popups.length === 0) {
                console.warn('Research paper popup not found in DOM when event fired. Make sure pg_industry_has_research_paper() returns true and the popup is rendered.');
                // Try again after a short delay in case popup is still loading
                setTimeout(function() {
                    const retryPopups = document.querySelectorAll('[id^="research-paper-popup-"]');
                    if (retryPopups.length > 0) {
                        handleOpenModal();
                    }
                }, 500);
                return;
            }
            
            // Open the first popup (or all if needed)
            popups.forEach(popup => {
                const popupId = popup.id;
                let popupController = window.researchPaperPopups && window.researchPaperPopups[popupId];
                
                // Check if cached controller is valid (has a popup element)
                // If controller exists but is broken (no popup), recreate it
                if (popupController && !popupController.popup) {
                    // Broken controller in cache - remove it and create new one
                    delete window.researchPaperPopups[popupId];
                    popupController = null;
                }
                
                // If popup controller doesn't exist yet or was broken, create it
                if (!popupController) {
                    popupController = new ResearchPaperPopup(popupId);
                    // Only cache if controller is fully initialized (has popup element)
                    if (popupController && popupController.popup) {
                        if (!window.researchPaperPopups) {
                            window.researchPaperPopups = {};
                        }
                        window.researchPaperPopups[popupId] = popupController;
                    } else {
                        // Don't cache broken controllers - let MutationObserver handle it when popup appears
                        console.warn('Popup controller created but popup element not found. Will retry when popup loads.');
                        return; // Skip opening this popup
                    }
                }
                
                // Open the popup
                if (popupController && popupController.popup) {
                    popupController.open();
                } else {
                    console.error('Failed to initialize popup controller for:', popupId);
                }
            });
        }, { once: false }); // Allow multiple calls
    }

    // Initialize on DOM ready
    function init() {
        // Set up global event listener FIRST (before popups are initialized)
        setupGlobalPopupListener();
        
        // Store popup controllers globally for access
        window.researchPaperPopups = window.researchPaperPopups || {};
        
        // Single page form
        const singleFormContainer = document.getElementById('research-paper-form-wrapper-single');
        if (singleFormContainer) {
            new ResearchPaperForm('research-paper-form-wrapper-single', {
                formId: 1498,
                isPopup: false
            });
        }

        // Popup forms - initialize existing popups
        // Only cache controllers that are fully initialized (have popup element)
        document.querySelectorAll('[id^="research-paper-popup-"]').forEach(popup => {
            const popupController = new ResearchPaperPopup(popup.id);
            // Only cache if controller is fully initialized (has popup element)
            // This prevents broken controllers from blocking proper initialization later
            if (popupController && popupController.popup) {
                window.researchPaperPopups[popup.id] = popupController;
            } else {
                console.warn('Popup controller not cached - popup element not found:', popup.id);
            }
        });

        // Scroll trigger for research paper modal
        // Initialize whenever the trigger attribute exists (popup may load later)
        const triggerSection = document.getElementById('related-resources');
        const popupsExist = document.querySelectorAll('[id^="research-paper-popup-"]').length > 0;
        
        if (triggerSection && triggerSection.hasAttribute('data-research-paper-trigger')) {
            // Always initialize scroll trigger if attribute exists
            // The checkScroll() method handles the case where no popup exists yet
            if (!window.researchPaperScrollTrigger) {
                window.researchPaperScrollTrigger = new ResearchPaperScrollTrigger();
                
                // Log info if no popup exists initially (it may load later)
                if (!popupsExist) {
                    console.info('Research paper scroll trigger initialized. Waiting for popup to load...');
                }
            }
        }
        
        // Also check for popups that might load later (lazy loaded, AJAX, etc.)
        // Use MutationObserver to watch for new popups
        const popupObserver = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1) { // Element node
                        // Check if the added node is a popup
                        if (node.id && node.id.startsWith('research-paper-popup-')) {
                            // Check if controller doesn't exist OR is broken (no popup element)
                            const existingController = window.researchPaperPopups && window.researchPaperPopups[node.id];
                            if (!existingController || !existingController.popup) {
                                // Remove broken controller if it exists
                                if (existingController) {
                                    delete window.researchPaperPopups[node.id];
                                }
                                // Create new controller
                                const popupController = new ResearchPaperPopup(node.id);
                                // Only cache if fully initialized
                                if (popupController && popupController.popup) {
                                    if (!window.researchPaperPopups) {
                                        window.researchPaperPopups = {};
                                    }
                                    window.researchPaperPopups[node.id] = popupController;
                                }
                            }
                        }
                        // Check if any child is a popup
                        const childPopups = node.querySelectorAll && node.querySelectorAll('[id^="research-paper-popup-"]');
                        if (childPopups) {
                            childPopups.forEach(function(popup) {
                                // Check if controller doesn't exist OR is broken (no popup element)
                                const existingController = window.researchPaperPopups && window.researchPaperPopups[popup.id];
                                if (!existingController || !existingController.popup) {
                                    // Remove broken controller if it exists
                                    if (existingController) {
                                        delete window.researchPaperPopups[popup.id];
                                    }
                                    // Create new controller
                                    const popupController = new ResearchPaperPopup(popup.id);
                                    // Only cache if fully initialized
                                    if (popupController && popupController.popup) {
                                        if (!window.researchPaperPopups) {
                                            window.researchPaperPopups = {};
                                        }
                                        window.researchPaperPopups[popup.id] = popupController;
                                    }
                                }
                            });
                        }
                    }
                });
            });
        });
        
        // Start observing
        popupObserver.observe(document.body, {
            childList: true,
            subtree: true
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();

