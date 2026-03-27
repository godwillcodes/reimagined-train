<style>
/* Responsive banner width */
@media (max-width: 640px) {
    #cookie-consent-banner {
        max-width: calc(100% - 1rem) !important;
        margin: 0.5rem !important;
    }
}

/* Banner animation */
.cookie-fade-in {
    animation: fadeSlideUp 0.4s ease-out forwards;
}

@keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(2rem); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Overlay for blur/glass effect */
#page-overlay {
    position: fixed;
    inset: 0;
    background: rgba(31, 49, 49, 0.3);
    backdrop-filter: blur(8px);
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease-out;
    z-index: 97;
}

/* Show overlay */
#page-overlay.active {
    opacity: 1;
    pointer-events: auto;
}

/* Banner focus outline */
#cookie-consent-banner button:focus-visible {
    outline: 2px solid #98C441;
    outline-offset: 2px;
}
</style>




    <!-- Glassmorphic overlay -->
    <div id="page-overlay"></div>

    <!-- Cookie Consent Banner -->
   <!-- Cookie Banner -->
<div id="cookie-consent-banner"
     class="fixed bottom-6 right-6 z-99 w-[calc(100%-2rem)] sm:max-w-lg bg-white/95 backdrop-blur-md rounded-[4px] shadow-xl overflow-hidden opacity-0 scale-95 transform transition-all duration-500"
     role="dialog"
     aria-modal="true"
     aria-labelledby="cookieConsentHeader"
     aria-describedby="cookieConsentText"
     style="display:none">

    <div class="relative px-6 sm:px-8 pt-8 pb-7 text-gray-900">

        <!-- Close Button -->
        <button id="cookie-close"
                class="absolute top-4 right-4 p-2 rounded-lg hover:bg-green-400/20 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2"
                aria-label="Close cookie banner">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Header -->
        <div class="flex items-center gap-4 mb-6">
            <div class="flex-shrink-0 w-12 h-12 rounded-[4px] bg-[#98C441] flex items-center justify-center shadow-inner shadow-green-400/40">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.623 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                </svg>
            </div>
            <h2 id="cookieConsentHeader" class="text-lg sm:text-xl font-semibold tracking-tight">
                Cookie Preferences
            </h2>
        </div>

        <div class="h-px bg-gradient-to-r from-transparent via-[#1F3131] to-transparent mb-6"></div>

        <!-- Body Text -->
        <div id="cookieConsentText" class="text-sm sm:text-base leading-relaxed space-y-4 mb-8">
            <p>
                We use cookies to enhance your experience and deliver tailored content. 
                <strong class="font-medium text-gray-900">Essential cookies</strong> keep the site running smoothly — no tracking fluff.
            </p>
            <p>
                Learn more in our 
                <a href="/privacy-policy" class="font-medium underline underline-offset-4 text-gray-900 hover:text-[#98C441] focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 rounded">
                    Privacy Policy
                </a>.
            </p>
        </div>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-3">
            <button id="cookie-decline"
                    class="flex-1 px-6 py-3.5 text-sm sm:text-base rounded-[4px] bg-stone-100 text-gray-900 font-medium focus:outline-none  transition hover:bg-stone-200">
                Decline
            </button>
            <button id="cookie-accept"
                    class="flex-1 px-6 py-3.5 text-sm sm:text-base rounded-[4px] bg-[#98C441] text-[#1F3131] font-semibold shadow-md hover:shadow-lg   transition">
                Accept All
            </button>
        </div>

    </div>
</div>


    <script>
(function() {
    'use strict';

    const COOKIE_KEY = 'piedmont_cookie_consent';
    const COOKIE_EXPIRY_DAYS = 365;

    const overlay = document.getElementById('page-overlay');
    const banner = document.getElementById('cookie-consent-banner');

    // Cookie utilities
    const setCookie = (name, value, days) => {
        const expires = new Date();
        expires.setTime(expires.getTime() + (days*24*60*60*1000));
        const secure = location.protocol === 'https:' ? ';Secure' : '';
        document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/;SameSite=Lax${secure}`;
    };
    const getCookie = (name) => {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if(parts.length === 2) return parts.pop().split(';').shift();
        return null;
    };
    const hasConsent = () => {
        const c = getCookie(COOKIE_KEY);
        return c === 'accepted' || c === 'declined';
    };

    // Google Analytics is now loaded in the header via functions.php
    // No need to manage it through cookie consent

    // Track script loading status
    const trackScriptStatus = () => {
        const scripts = {
            'HubSpot': window.__hsLoaded || false,
            'Hotjar': window.__hjLoaded || false,
            'Leadsy': window.__leadsyLoaded || false
        };
        
        console.log('📊 Tracking Scripts Status:', scripts);
        
        const loadedCount = Object.values(scripts).filter(Boolean).length;
        const totalCount = Object.keys(scripts).length;
        
        console.log(`📊 Tracking Scripts: ${loadedCount}/${totalCount} loaded successfully`);
        
        if (loadedCount === totalCount) {
            console.log('🎉 All tracking scripts loaded successfully!');
        }
    };

    // HubSpot
    const HUBSPOT_PORTAL_ID = '22423917';
    const loadHubspot = () => {
        if(window.__hsLoaded) {
            console.log('🎯 HubSpot: Already loaded, skipping');
            return;
        }
        
        console.log('🎯 HubSpot: Starting to load...');
        const s = document.createElement('script');
        s.type = 'text/javascript';
        s.id = 'hs-script-loader';
        s.async = true;
        s.defer = true;
        s.src = `//js.hs-scripts.com/${HUBSPOT_PORTAL_ID}.js`;
        s.onload = () => {
            console.log('🎯 HubSpot: Script loaded successfully!');
        };
        s.onerror = () => {
            console.error('🎯 HubSpot: Failed to load script');
        };
        document.head.appendChild(s);
        window.__hsLoaded = true;
        console.log('🎯 HubSpot: Loading initiated');
    };

    // Hotjar
    const loadHotjar = () => {
        if(window.__hjLoaded) {
            console.log('🔥 Hotjar: Already loaded, skipping');
            return;
        }
        
        console.log('🔥 Hotjar: Starting to load...');
        
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:6548928,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            
            // Add load event listener for debugging
            r.onload = function() {
                console.log('🔥 Hotjar: Script loaded successfully!');
                console.log('🔥 Hotjar: Settings:', h._hjSettings);
                console.log('🔥 Hotjar: hj object available:', typeof h.hj);
            };
            
            r.onerror = function() {
                console.error('🔥 Hotjar: Failed to load script');
            };
            
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        
        window.__hjLoaded = true;
        console.log('🔥 Hotjar: Loading initiated');
    };


    // Leadsy
    const loadLeadsy = () => {
        if(window.__leadsyLoaded) {
            console.log('🎯 Leadsy: Already loaded, skipping');
            return;
        }
        
        console.log('🎯 Leadsy: Starting to load...');
        
        const script = document.createElement('script');
        script.id = 'vtag-ai-js';
        script.async = true;
        script.src = 'https://r2.leadsy.ai/tag.js';
        script.setAttribute('data-pid', 'GeczIRxy0NUvXRTE');
        script.setAttribute('data-version', '062024');
        script.onload = () => {
            console.log('🎯 Leadsy: Script loaded successfully!');
            console.log('🎯 Leadsy: PID: GeczIRxy0NUvXRTE');
            console.log('🎯 Leadsy: Version: 062024');
        };
        script.onerror = () => {
            console.error('🎯 Leadsy: Failed to load script');
        };
        
        document.head.appendChild(script);
        window.__leadsyLoaded = true;
        console.log('🎯 Leadsy: Loading initiated');
    };

    // Obfuscated vendor script (load only after consent)
    const loadZiScript = () => {
        if (window.__ziLoaded) return;
        try {
            window[(function(_Yi8,_CB){var _Et='';for(var _hz=0;_hz<_Yi8.length;_hz++){_Et==_Et;var _JC=_Yi8[_hz].charCodeAt();_JC!=_hz;_CB>5;_JC-=_CB;_JC+=61;_JC%=94;_JC+=33;_Et+=String.fromCharCode(_JC)}return _Et})(atob('Z1ZdIXx3cnAjWHIo'), 13)] = 'f6d469a0c51680314542';    var zi = document.createElement('script');    (zi.type = 'text/javascript'),    (zi.async = true),    (zi.src = (function(_3NN,_KC){var _me='';for(var _5W=0;_5W<_3NN.length;_5W++){var _Re=_3NN[_5W].charCodeAt();_Re!=_5W;_me==_me;_Re-=_KC;_Re+=61;_KC>4;_Re%=94;_Re+=33;_me+=String.fromCharCode(_Re)}return _me})(atob('KTU1MTRZTk4rNE07Kkw0JDMqMTU0TSQwLk47Kkw1IihNKzQ='), 31)),    document.readyState === 'complete'?document.body.appendChild(zi):    window.addEventListener('load', function(){        document.body.appendChild(zi)    });
            window.__ziLoaded = true;
            console.log('🧩 Zi script: Loading initiated');
        } catch (e) {
            console.error('🧩 Zi script: Failed to initialize', e);
        }
    };

    // Banner control
    const showBanner = () => {
        console.log('🍪 Cookie Consent: showBanner called');
        console.log('🍪 Cookie Consent: banner element:', banner);
        console.log('🍪 Cookie Consent: overlay element:', overlay);
        
        if(!banner || !overlay) {
            console.error('🍪 Cookie Consent: Banner or overlay not found!');
            return;
        }
        
        console.log('🍪 Cookie Consent: Showing banner...');
        overlay.classList.add('active');
        banner.style.display = 'block';
        banner.offsetHeight;
        banner.classList.add('cookie-fade-in');
        document.getElementById('cookie-accept')?.focus();
        console.log('🍪 Cookie Consent: Banner should now be visible');
    };

    const hideBanner = () => {
        if(!banner || !overlay) return;
        overlay.classList.remove('active');
        banner.style.opacity = '0';
        banner.style.transform = 'translateY(2rem)';
        setTimeout(() => {
            banner.style.display = 'none';
            banner.classList.remove('cookie-fade-in');
        }, 300);
    };

    // Consent actions
    const acceptCookies = () => {
        console.log('🍪 Cookie Consent: User accepted cookies');
        setCookie(COOKIE_KEY, 'accepted', COOKIE_EXPIRY_DAYS);
        setCookie('cookie_preferences', 'all', COOKIE_EXPIRY_DAYS);
        loadHubspot();
        loadHotjar();
        loadLeadsy();
        loadZiScript();
        // Site Kit scripts are now managed by the plugin itself
        // No need to manually load them through cookie consent
        hideBanner();
        document.dispatchEvent(new CustomEvent('cookieConsentAccepted', {
            detail: { type: 'all', timestamp: Date.now() }
        }));
    };

    const declineCookies = () => {
        setCookie(COOKIE_KEY, 'declined', COOKIE_EXPIRY_DAYS);
        setCookie('cookie_preferences', 'essential', COOKIE_EXPIRY_DAYS);
        hideBanner();
        document.dispatchEvent(new CustomEvent('cookieConsentDeclined', {
            detail: { type: 'essential', timestamp: Date.now() }
        }));
    };

    // Event listeners
    document.getElementById('cookie-accept')?.addEventListener('click', acceptCookies);
    document.getElementById('cookie-decline')?.addEventListener('click', declineCookies);
    document.getElementById('cookie-close')?.addEventListener('click', hideBanner);

    document.addEventListener('keydown', (e) => {
        if(e.key === 'Escape' && banner && banner.style.display !== 'none') hideBanner();
    });

    // Check if user is admin (for testing purposes)
    const isAdminMode = () => {
        // Check for WordPress admin indicators
        return document.body.classList.contains('wp-admin') || 
               document.body.classList.contains('admin-bar') ||
               document.querySelector('#wpadminbar') !== null ||
               window.location.href.includes('/wp-admin/');
    };

    // Initialize
    const init = () => {
        console.log('🍪 Cookie Consent: Initializing...');
        const consent = getCookie(COOKIE_KEY);
        console.log('🍪 Cookie Consent: Current consent value:', consent);
        console.log('🍪 Cookie Consent: Has consent?', hasConsent());
        console.log('🍪 Cookie Consent: Admin mode detected:', isAdminMode());

        // Site Kit scripts are now managed by the plugin itself
        // No need to manually load them through cookie consent

        if(consent === 'accepted') {
            console.log('🍪 Cookie Consent: User previously accepted, loading tracking scripts');
            loadHubspot();
            loadHotjar();
            loadLeadsy();
            loadZiScript();
            // Site Kit scripts are now managed by the plugin itself
            // No need to manually load them through cookie consent
        } else {
            console.log('🍪 Cookie Consent: No previous consent, setting up tracking scripts');
        }

        if(!hasConsent()) {
            console.log('🍪 Cookie Consent: No consent found, showing banner in 1 second');
            setTimeout(showBanner, 1000);
        } else {
            console.log('🍪 Cookie Consent: Consent found, not showing banner');
        }
    };

    if(document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
</script>

