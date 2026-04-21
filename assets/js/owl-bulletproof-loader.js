/**
 * Bulletproof Owl Carousel Lazy Loader
 * Robust lazy loading with error handling, retries, and performance monitoring
 */
(function() {
    'use strict';
    
    // Configuration from WordPress
    const config = window.owlBulletproofConfig || {};
    
    // State management
    const state = {
        assetsLoaded: false,
        carouselsInitialized: false,
        loadingAttempts: 0,
        maxRetries: config.retryAttempts || 3,
        retryDelay: config.retryDelay || 1000,
        fallbackTimeout: config.fallbackTimeout || 5000,
        startTime: performance.now(),
        errors: []
    };
    
    // Performance monitoring
    const perf = {
        assetLoadStart: null,
        assetLoadEnd: null,
        initStart: null,
        initEnd: null
    };
    
    // Error handling
    function handleError(error, context = '') {
        state.errors.push({
            message: error.message,
            context: context,
            timestamp: new Date().toISOString()
        });
    }
    
    // Asset loading with retry mechanism
    function loadAsset(url, type = 'script') {
        return new Promise((resolve, reject) => {
            const element = document.createElement(type === 'script' ? 'script' : 'link');
            let settled = false;
            
            if (type === 'script') {
                element.src = url;
                element.async = true;
                element.defer = true;
            } else {
                element.rel = 'stylesheet';
                element.href = url;
            }
            
            element.onload = () => {
                if (settled) {
                    return;
                }
                settled = true;
                clearTimeout(timeoutId);
                resolve(element);
            };
            
            element.onerror = (error) => {
                if (settled) {
                    return;
                }
                settled = true;
                clearTimeout(timeoutId);
                reject(new Error(`Failed to load ${url}`));
            };
            
            // Timeout fallback
            const timeoutId = setTimeout(() => {
                if (settled) {
                    return;
                }
                settled = true;
                reject(new Error(`Timeout loading ${url}`));
            }, 10000); // 10 second timeout
            
            document.head.appendChild(element);
        });
    }
    
    // Load all Owl Carousel assets with retry logic
    async function loadOwlAssets() {
        if (state.assetsLoaded) {
            return Promise.resolve();
        }
        
        perf.assetLoadStart = performance.now();
        state.loadingAttempts++;
        
        try {
            // Load CSS files in parallel
            const cssPromises = [
                loadAsset(config.cssUrl, 'link'),
                loadAsset(config.themeCssUrl, 'link')
            ];
            
            await Promise.all(cssPromises);
            
            // Load JS file
            await loadAsset(config.jsUrl, 'script');
            
            state.assetsLoaded = true;
            perf.assetLoadEnd = performance.now();
            
        } catch (error) {
            handleError(error, 'Asset loading');
            
            if (state.loadingAttempts < state.maxRetries) {
                await new Promise(resolve => setTimeout(resolve, state.retryDelay));
                return loadOwlAssets();
            } else {
                throw new Error(`Failed to load Owl Carousel assets after ${state.maxRetries} attempts`);
            }
        }
    }
    
    // Initialize carousels with comprehensive error handling
    function initCarousels() {
        if (state.carouselsInitialized || typeof jQuery === 'undefined') {
            return;
        }
        
        perf.initStart = performance.now();
        
        try {
            jQuery(document).ready(function($) {
                // Honor user's motion preference (WCAG 2.3.3 / reinforces 2.2.2).
                var prefersReducedMotion = !!(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches);

                // Wire an accessible control toolbar rendered via pg_render_carousel_controls()
                // to the given Owl instance. Adds Prev / Next / Pause-Play click handlers, keeps
                // aria-pressed + label in sync with autoplay state, and enables arrow-key paging
                // on the carousel region itself.
                function wireAccessibleControls($carousel) {
                    if (!$carousel || !$carousel.length) return;
                    var baseId = $carousel.attr('data-pg-carousel-controls');
                    if (!baseId) return;

                    var $prev = $('[data-pg-carousel-prev="' + baseId + '"]');
                    var $next = $('[data-pg-carousel-next="' + baseId + '"]');
                    var $toggle = $('[data-pg-carousel-playpause="' + baseId + '"]');

                    $prev.off('click.pgCarousel').on('click.pgCarousel', function(e) {
                        e.preventDefault();
                        $carousel.trigger('prev.owl.carousel');
                    });
                    $next.off('click.pgCarousel').on('click.pgCarousel', function(e) {
                        e.preventDefault();
                        $carousel.trigger('next.owl.carousel');
                    });

                    // Determine initial autoplay state from the stored instance options.
                    var instance = $carousel.data('owl.carousel');
                    var autoplayOn = !!(instance && instance.options && instance.options.autoplay);

                    function setToggleState(isPlaying) {
                        if (!$toggle.length) return;
                        $toggle.attr('aria-pressed', isPlaying ? 'false' : 'true');
                        var pauseLabel = $toggle.attr('data-label-pause');
                        var playLabel = $toggle.attr('data-label-play');
                        $toggle.attr('aria-label', isPlaying ? pauseLabel : playLabel);
                        var $pauseIcon = $toggle.find('[data-pg-icon="pause"]');
                        var $playIcon = $toggle.find('[data-pg-icon="play"]');
                        if (isPlaying) {
                            $pauseIcon.removeClass('hidden');
                            $playIcon.addClass('hidden');
                        } else {
                            $pauseIcon.addClass('hidden');
                            $playIcon.removeClass('hidden');
                        }
                    }
                    setToggleState(autoplayOn);

                    $toggle.off('click.pgCarousel').on('click.pgCarousel', function(e) {
                        e.preventDefault();
                        if (autoplayOn) {
                            $carousel.trigger('stop.owl.autoplay');
                            autoplayOn = false;
                        } else {
                            $carousel.trigger('play.owl.autoplay');
                            autoplayOn = true;
                        }
                        setToggleState(autoplayOn);
                    });

                    // Arrow-key navigation on the carousel region itself.
                    $carousel.off('keydown.pgCarousel').on('keydown.pgCarousel', function(e) {
                        if (e.key === 'ArrowLeft') {
                            e.preventDefault();
                            $carousel.trigger('prev.owl.carousel');
                        } else if (e.key === 'ArrowRight') {
                            e.preventDefault();
                            $carousel.trigger('next.owl.carousel');
                        }
                    });
                }

                const carouselConfigs = {
                    '.partners-carousel': {
                        loop: true,
                        margin: 30,
                        nav: false,
                        dots: false,
                        autoplay: !prefersReducedMotion,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true,
                        responsiveClass: true,
                        responsive: {
                            0: { items: 2 },
                            640: { items: 3 },
                            1024: { items: 5.5 }
                        }
                    },
                    '.sandbox-news-carousel': {
                        loop: true,
                        margin: 24,
                        nav: false,
                        dots: false,
                        autoplay: false,
                        smartSpeed: 600,
                        responsiveClass: true,
                        responsive: {
                            0: { items: 1 },
                            640: { items: 2 },
                            1024: { items: 3 }
                        }
                    },
                    '.sandbox-recognized-carousel': {
                        loop: true,
                        margin: 20,
                        nav: false,
                        dots: false,
                        autoWidth: true,
                        autoplay: true,
                        autoplayTimeout: 2500,
                        autoplayHoverPause: true,
                        responsive: {
                            0: { items: 1.6 },
                            768: { items: 5 },
                            1024: { items: 7.5 }
                        }
                    },
                    '.aboutus-carousel': {
                        loop: true,
                        margin: 10,
                        nav: false,
                        dots: false,
                        autoplay: !prefersReducedMotion,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true,
                        responsiveClass: true,
                        responsive: {
                            0: { items: 1 },
                            640: { items: 3 },
                            1024: { items: 4.5 }
                        }
                    },
                    '.recognized-carousel': {
                        loop: true,
                        margin: 20,
                        nav: false,
                        dots: false,
                        autoWidth: true,
                        autoplay: !prefersReducedMotion,
                        autoplayTimeout: 2500,
                        autoplayHoverPause: true,
                        responsive: {
                            0: { items: 1.6 },
                            768: { items: 5 },
                            1024: { items: 7.5 }
                        }
                    },
                    '.contracting-vehicles-carousel': {
                        loop: true,
                        margin: 20,
                        nav: false,
                        dots: false,
                        autoplay: !prefersReducedMotion,
                        autoWidth: true,
                        autoplayTimeout: 2500,
                        autoplayHoverPause: true,
                        responsive: {
                            0: { items: 1.6, autoWidth: true },
                            768: { items: 3, autoWidth: true },
                            1024: { items: 4.5, autoWidth: true }
                        }
                    },
                    '.certificate-carousel': {
                        loop: true,
                        margin: 20,
                        nav: false,
                        dots: false,
                        autoWidth: true,
                        autoplay: !prefersReducedMotion,
                        autoplayTimeout: 2500,
                        autoplayHoverPause: true,
                        responsive: {
                            0: { items: 1.6 },
                            768: { items: 2 },
                            1024: { items: 3 }
                        }
                    },
                    '.testimonial-carousel': {
                        loop: true,
                        margin: 30,
                        nav: false,
                        dots: false,
                        autoplay: true,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: true,
                        smartSpeed: 600,
                        responsive: {
                            0: { items: 1 },
                            768: { items: 2 },
                            1024: { items: 3 }
                        }
                    },
                    '.related-blogs-carousel': {
                        loop: true,
                        margin: 24,
                        nav: false,
                        dots: false,
                        autoplay: !prefersReducedMotion,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true,
                        responsive: {
                            0: { items: 1 },
                            768: { items: 2 },
                            1024: { items: 3 }
                        }
                    },
                    '.symposium-speakers-carousel': {
                        loop: true,
                        margin: 24,
                        nav: false,
                        dots: false,
                        autoplay: !prefersReducedMotion,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true,
                        smartSpeed: 600,
                        responsive: {
                            0: { items: 1 },
                            768: { items: 2 },
                            1024: { items: 3 }
                        }
                    },
                    '.visual-moment-carousel': {
                        loop: true,
                        margin: 10,
                        nav: false,
                        dots: false,
                        autoplay: !prefersReducedMotion,
                        autoplayTimeout: 6000,
                        autoplayHoverPause: true,
                        smartSpeed: 1000,
                        responsiveClass: true,
                        responsive: {
                            0: { items: 1 },
                            1024: { items: 1 }
                        }
                    }
                };
                
                let initializedCount = 0;
                
                Object.entries(carouselConfigs).forEach(([selector, config]) => {
                    try {
                        const $carousel = $(selector);
                        if ($carousel.length && !$carousel.hasClass('owl-loaded')) {
                            $carousel.owlCarousel(config);
                            // Wire accessible Prev / Pause-Play / Next toolbar when present.
                            $carousel.each(function() {
                                var $this = $(this);
                                if ($this.attr('data-pg-carousel-controls')) {
                                    wireAccessibleControls($this);
                                }
                            });
                            // Custom external controls for sandbox news carousel
                            if (selector === '.sandbox-news-carousel') {
                                const $instance = $carousel;
                                $('#sandbox-news-prev').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $instance.trigger('prev.owl.carousel');
                                });
                                $('#sandbox-news-next').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $instance.trigger('next.owl.carousel');
                                });
                            }
                            // Custom external controls for sandbox recognized carousel
                            if (selector === '.sandbox-recognized-carousel') {
                                const $instance2 = $carousel;
                                $('#sandbox-recognized-prev').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $instance2.trigger('prev.owl.carousel');
                                });
                                $('#sandbox-recognized-next').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $instance2.trigger('next.owl.carousel');
                                });
                            }
                            // Custom external controls for related blogs carousel
                            if (selector === '.related-blogs-carousel') {
                                const $instance3 = $carousel;
                                $('#related-blogs-prev').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $instance3.trigger('prev.owl.carousel');
                                });
                                $('#related-blogs-next').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $instance3.trigger('next.owl.carousel');
                                });
                            }
                            // Symposium speakers (Language Access Symposium template)
                            if (selector === '.symposium-speakers-carousel') {
                                const $symposiumSpeakers = $carousel;
                                $('#symposium-speakers-prev').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $symposiumSpeakers.trigger('prev.owl.carousel');
                                });
                                $('#symposium-speakers-next').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $symposiumSpeakers.trigger('next.owl.carousel');
                                });
                            }
                            // Custom external controls for visual moment carousel
                            if (selector === '.visual-moment-carousel') {
                                const $instance4 = $carousel;
                                let currentSlideIndex = 0;
                                
                                // Function to update marker active state
                                function updateMarkerState(activeIndex) {
                                    $('.visual-moment-marker').each(function() {
                                        const markerIndex = parseInt($(this).data('index'), 10);
                                        const isActive = markerIndex === activeIndex;
                                        const $marker = $(this);
                                        
                                        if (isActive) {
                                            // Active state - matches arrow button hover styles exactly
                                            $marker.addClass('active');
                                            $marker.css({
                                                'background-color': '#98C441',
                                                'color': '#006155',
                                                'border': '1px solid #006155',
                                                'border-width': '1px',
                                                'border-style': 'solid',
                                                'border-color': '#006155'
                                            });
                                        } else {
                                            // Inactive state - base colors (matches arrow button base state)
                                            $marker.removeClass('active');
                                            $marker.css({
                                                'background-color': '#006155',
                                                'color': '#ffffff',
                                                'border': 'none',
                                                'border-width': '0',
                                                'border-style': 'none',
                                                'border-color': 'transparent'
                                            });
                                        }
                                    });
                                }
                                
                                // Navigation buttons
                                $('#visual-moment-prev').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $instance4.trigger('prev.owl.carousel');
                                });
                                $('#visual-moment-next').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $instance4.trigger('next.owl.carousel');
                                });
                                
                                // Marker buttons - go to specific slide
                                $('.visual-moment-marker').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    const index = parseInt($(this).data('index'), 10);
                                    if (!isNaN(index)) {
                                        currentSlideIndex = index;
                                        $instance4.trigger('to.owl.carousel', [index, 600]);
                                        updateMarkerState(index);
                                    }
                                });
                                
                                // Function to get current slide index (handles loop mode)
                                function getCurrentIndex(event) {
                                    const totalItems = $('.visual-moment-marker').length;
                                    
                                    // Primary method: use carousel's relative() function
                                    try {
                                        const carouselData = $instance4.data('owl.carousel');
                                        if (carouselData && typeof carouselData.relative === 'function') {
                                            const current = carouselData.current();
                                            const relativeIndex = carouselData.relative(current);
                                            if (relativeIndex >= 0 && relativeIndex < totalItems) {
                                                return relativeIndex;
                                            }
                                        }
                                    } catch(e) {
                                        // Continue to fallback
                                    }
                                    
                                    // Fallback: find the active item's data-index from the DOM
                                    const activeOwlItem = $instance4.find('.owl-item.active').first();
                                    if (activeOwlItem.length) {
                                        const slideContent = activeOwlItem.find('[data-slide-index]');
                                        if (slideContent.length) {
                                            return parseInt(slideContent.attr('data-slide-index'), 10) || 0;
                                        }
                                    }
                                    
                                    return 0;
                                }
                                
                                // Update marker active state on carousel change
                                $instance4.on('changed.owl.carousel', function(event) {
                                    setTimeout(function() {
                                        currentSlideIndex = getCurrentIndex(event);
                                        updateMarkerState(currentSlideIndex);
                                    }, 50);
                                });
                                
                                // Also listen to translated event for autoplay
                                $instance4.on('translated.owl.carousel', function(event) {
                                    setTimeout(function() {
                                        currentSlideIndex = getCurrentIndex(event);
                                        updateMarkerState(currentSlideIndex);
                                    }, 50);
                                });
                                
                                // Set initial active marker
                                $instance4.on('initialized.owl.carousel', function() {
                                    currentSlideIndex = 0;
                                    updateMarkerState(0);
                                });
                            }
                            initializedCount++;
                        }
                    } catch (error) {
                        handleError(error, `Carousel initialization: ${selector}`);
                    }
                });
                
                state.carouselsInitialized = true;
                perf.initEnd = performance.now();
                
                // Performance reporting
                if (typeof performance !== 'undefined' && performance.mark) {
                    performance.mark('owl-carousels-initialized');
                    performance.measure('owl-lazy-load-total', 'owl-lazy-load-start', 'owl-carousels-initialized');
                }
                
            });
            
        } catch (error) {
            handleError(error, 'Carousel initialization');
            throw error;
        }
    }
    
    // Fallback mechanism - load assets immediately if lazy loading fails
    function fallbackLoad() {
        
        // Create fallback script that loads assets immediately
        const fallbackScript = document.createElement('script');
        fallbackScript.textContent = `
            (function() {
                // Load CSS
                var css1 = document.createElement('link');
                css1.rel = 'stylesheet';
                css1.href = '${config.cssUrl}';
                document.head.appendChild(css1);
                
                var css2 = document.createElement('link');
                css2.rel = 'stylesheet';
                css2.href = '${config.themeCssUrl}';
                document.head.appendChild(css2);
                
                // Load JS
                var script = document.createElement('script');
                script.src = '${config.jsUrl}';
                script.onload = function() {
                    if (typeof jQuery !== 'undefined') {
                        jQuery(document).ready(function($) {
                            var prefersReducedMotion = !!(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches);
                            $('.partners-carousel, .aboutus-carousel, .recognized-carousel, .contracting-vehicles-carousel, .certificate-carousel, .testimonial-carousel, .sandbox-news-carousel, .related-blogs-carousel, .symposium-speakers-carousel').each(function() {
                                if (!$(this).hasClass('owl-loaded')) {
                                    $(this).owlCarousel({
                                        loop: true,
                                        margin: 20,
                                        nav: false,
                                        dots: false,
                                        autoplay: !prefersReducedMotion,
                                        autoplayTimeout: 3000,
                                        responsive: {
                                            0: { items: 1 },
                                            640: { items: 2 },
                                            1024: { items: 3 }
                                        }
                                    });
                                }
                            });
                            // Wire up accessible toolbars rendered via pg_render_carousel_controls().
                            $('[data-pg-carousel-controls]').each(function() {
                                var $c = $(this);
                                var baseId = $c.attr('data-pg-carousel-controls');
                                if (!baseId) return;
                                $('[data-pg-carousel-prev="' + baseId + '"]').off('click.pgCarousel').on('click.pgCarousel', function(e) { e.preventDefault(); $c.trigger('prev.owl.carousel'); });
                                $('[data-pg-carousel-next="' + baseId + '"]').off('click.pgCarousel').on('click.pgCarousel', function(e) { e.preventDefault(); $c.trigger('next.owl.carousel'); });
                                var $toggle = $('[data-pg-carousel-playpause="' + baseId + '"]');
                                var inst = $c.data('owl.carousel');
                                var on = !!(inst && inst.options && inst.options.autoplay);
                                function sync(p) {
                                    $toggle.attr('aria-pressed', p ? 'false' : 'true');
                                    $toggle.attr('aria-label', p ? $toggle.attr('data-label-pause') : $toggle.attr('data-label-play'));
                                    $toggle.find('[data-pg-icon="pause"]').toggleClass('hidden', !p);
                                    $toggle.find('[data-pg-icon="play"]').toggleClass('hidden', p);
                                }
                                sync(on);
                                $toggle.off('click.pgCarousel').on('click.pgCarousel', function(e) {
                                    e.preventDefault();
                                    if (on) { $c.trigger('stop.owl.autoplay'); on = false; } else { $c.trigger('play.owl.autoplay'); on = true; }
                                    sync(on);
                                });
                                $c.off('keydown.pgCarousel').on('keydown.pgCarousel', function(e) {
                                    if (e.key === 'ArrowLeft') { e.preventDefault(); $c.trigger('prev.owl.carousel'); }
                                    else if (e.key === 'ArrowRight') { e.preventDefault(); $c.trigger('next.owl.carousel'); }
                                });
                            });
                            // External controls for sandbox in fallback
                            var $sandboxNews = $('.sandbox-news-carousel');
                            if ($sandboxNews.length) {
                                $('#sandbox-news-prev').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $sandboxNews.trigger('prev.owl.carousel');
                                });
                                $('#sandbox-news-next').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $sandboxNews.trigger('next.owl.carousel');
                                });
                            }
                            var $sandboxRecog = $('.sandbox-recognized-carousel');
                            if ($sandboxRecog.length) {
                                $('#sandbox-recognized-prev').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $sandboxRecog.trigger('prev.owl.carousel');
                                });
                                $('#sandbox-recognized-next').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $sandboxRecog.trigger('next.owl.carousel');
                                });
                            }
                            var $relatedBlogs = $('.related-blogs-carousel');
                            if ($relatedBlogs.length) {
                                $('#related-blogs-prev').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $relatedBlogs.trigger('prev.owl.carousel');
                                });
                                $('#related-blogs-next').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $relatedBlogs.trigger('next.owl.carousel');
                                });
                            }
                            var $symposiumSpeakers = $('.symposium-speakers-carousel');
                            if ($symposiumSpeakers.length) {
                                $('#symposium-speakers-prev').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $symposiumSpeakers.trigger('prev.owl.carousel');
                                });
                                $('#symposium-speakers-next').off('click.owl').on('click.owl', function(e) {
                                    e.preventDefault();
                                    $symposiumSpeakers.trigger('next.owl.carousel');
                                });
                            }
                        });
                    }
                };
                document.head.appendChild(script);
            })();
        `;
        document.head.appendChild(fallbackScript);
    }
    
    // Main lazy loading function
    async function lazyLoadCarousels() {
        try {
            // Performance mark
            if (typeof performance !== 'undefined' && performance.mark) {
                performance.mark('owl-lazy-load-start');
            }
            
            await loadOwlAssets();
            initCarousels();
            
        } catch (error) {
            handleError(error, 'Lazy loading');
            fallbackLoad();
        }
    }
    
    // Intersection Observer with enhanced options
    function setupIntersectionObserver() {
        if (!('IntersectionObserver' in window)) {
            fallbackLoad();
            return;
        }
        
        const observerOptions = {
            root: null,
            rootMargin: '100px', // Load earlier for better UX
            threshold: [0, 0.1, 0.5] // Multiple thresholds for better detection
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !state.carouselsInitialized) {
                    lazyLoadCarousels();
                    observer.disconnect();
                }
            });
        }, observerOptions);
        
        // Observe all carousel elements
        const carouselSelectors = [
            '.partners-carousel',
            '.aboutus-carousel', 
            '.recognized-carousel',
            '.contracting-vehicles-carousel',
            '.certificate-carousel',
            '.testimonial-carousel',
            '.sandbox-news-carousel',
            '.sandbox-recognized-carousel',
            '.related-blogs-carousel',
            '.visual-moment-carousel',
            '.symposium-speakers-carousel'
        ];
        
        carouselSelectors.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => observer.observe(element));
        });
        
        // Fallback timeout
        setTimeout(() => {
            if (!state.carouselsInitialized) {
                lazyLoadCarousels();
            }
        }, state.fallbackTimeout);
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setupIntersectionObserver);
    } else {
        setupIntersectionObserver();
    }
    
    // Global error handler for unhandled promise rejections
    window.addEventListener('unhandledrejection', (event) => {
        if (event.reason && event.reason.message && event.reason.message.includes('owl')) {
            handleError(event.reason, 'Unhandled promise rejection');
            fallbackLoad();
        }
    });
    
})();

