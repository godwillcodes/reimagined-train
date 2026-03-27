( function () {
	'use strict';

	/* ------------------------------------------------------------------ */
	/*  Environment                                                       */
	/* ------------------------------------------------------------------ */

	var canHover = window.matchMedia( '(hover: hover) and (pointer: fine)' );
	var reducedMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' );

	/* ------------------------------------------------------------------ */
	/*  SVG factories — size preserved dynamically on toggle              */
	/* ------------------------------------------------------------------ */

	function pauseSvg( size ) {
		return '<svg class="' + size + '" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">' +
			'<rect x="6" y="4" width="4" height="16" rx="1"/>' +
			'<rect x="14" y="4" width="4" height="16" rx="1"/></svg>';
	}

	function playSvg( size ) {
		return '<svg class="' + size + '" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">' +
			'<path d="M8 5v14l11-7z"/></svg>';
	}

	var PREV_SVG = '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">' +
		'<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>';

	var NEXT_SVG = '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">' +
		'<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>';

	/* ------------------------------------------------------------------ */
	/*  Brand-matched button classes                                      */
	/* ------------------------------------------------------------------ */

	var ARROW_CLS = [
		'w-10', 'h-10',
		'flex', 'items-center', 'justify-center',
		'rounded-full',
		'bg-[#006155]', 'text-white', 'shadow-md',
		'hover:bg-[#98C441]', 'hover:text-[#006155]',
		'hover:scale-105',
		'transition-all', 'duration-200',
		'focus:outline-none', 'focus-visible:ring-2',
		'focus-visible:ring-[#98C441]', 'focus-visible:ring-offset-2',
		'cursor-pointer'
	].join( ' ' );

	var PAUSE_CLS = [
		'w-8', 'h-8',
		'flex', 'items-center', 'justify-center',
		'rounded-full',
		'bg-[#006155]/80', 'text-white',
		'backdrop-blur-sm', 'shadow-md',
		'hover:bg-[#98C441]', 'hover:text-[#006155]',
		'hover:scale-105',
		'transition-all', 'duration-200',
		'focus:outline-none', 'focus-visible:ring-2',
		'focus-visible:ring-[#98C441]', 'focus-visible:ring-offset-2',
		'cursor-pointer'
	].join( ' ' );

	/* ------------------------------------------------------------------ */
	/*  Carousel name helpers                                             */
	/* ------------------------------------------------------------------ */

	var NAMES = [
		'partners-carousel', 'aboutus-carousel', 'recognized-carousel',
		'contracting-vehicles-carousel', 'certificate-carousel',
		'testimonial-carousel', 'sandbox-news-carousel',
		'sandbox-recognized-carousel', 'related-blogs-carousel',
		'visual-moment-carousel'
	];

	function getCarouselName( el ) {
		var cls = el.className.split( /\s+/ );
		for ( var i = 0; i < cls.length; i++ ) {
			if ( NAMES.indexOf( cls[ i ] ) !== -1 ) {
				return cls[ i ];
			}
		}
		return '';
	}

	function getCarouselSelector( el ) {
		var n = getCarouselName( el );
		return n ? '.' + n : '';
	}

	/* ------------------------------------------------------------------ */
	/*  External-control detection                                        */
	/* ------------------------------------------------------------------ */

	function hasExternalNav( el ) {
		var name = getCarouselName( el );
		if ( ! name ) {
			return false;
		}
		return !! document.getElementById( name.replace( '-carousel', '' ) + '-prev' );
	}

	function hasExternalPause( el ) {
		var sel = getCarouselSelector( el );
		return sel && !! document.querySelector( '[data-carousel-pause-target="' + sel + '"]' );
	}

	/* ------------------------------------------------------------------ */
	/*  Autoplay helpers                                                  */
	/* ------------------------------------------------------------------ */

	function isAutoplay( el ) {
		if ( typeof jQuery === 'undefined' ) {
			return false;
		}
		var d = jQuery( el ).data( 'owl.carousel' );
		return !! ( d && d.settings && d.settings.autoplay );
	}

	function usesHoverPause( el ) {
		if ( typeof jQuery === 'undefined' ) {
			return false;
		}
		var d = jQuery( el ).data( 'owl.carousel' );
		return !! ( d && d.settings && d.settings.autoplayHoverPause );
	}

	function hasCssMask( el ) {
		return !! ( el.style.mask || el.style.webkitMask );
	}

	/* ------------------------------------------------------------------ */
	/*  SVG size detection — preserves the icon size on toggle            */
	/* ------------------------------------------------------------------ */

	function getSvgSize( button ) {
		var svg = button.querySelector( 'svg' );
		if ( ! svg ) {
			return 'w-4 h-4';
		}
		var raw = svg.getAttribute( 'class' ) || '';
		var match = raw.match( /w-\S+\s+h-\S+/ );
		return match ? match[ 0 ] : 'w-4 h-4';
	}

	/* ------------------------------------------------------------------ */
	/*  Pause / play toggle (works for both external and overlay buttons) */
	/* ------------------------------------------------------------------ */

	function setPauseButtonState( button, isPlaying ) {
		var size = getSvgSize( button );

		if ( isPlaying ) {
			button.innerHTML = pauseSvg( size );
			button.setAttribute( 'aria-label', 'Pause auto-rotation' );
			button.dataset.playing = 'true';
			return;
		}

		button.innerHTML = playSvg( size );
		button.setAttribute( 'aria-label', 'Resume auto-rotation' );
		button.dataset.playing = 'false';
	}

	function syncPauseButtonState( carouselEl ) {
		var button = findPauseButton( carouselEl );
		var isPlaying = isAutoplay( carouselEl ) &&
			carouselEl.dataset.manualPaused !== 'true' &&
			carouselEl.dataset.hoverPaused !== 'true' &&
			carouselEl.dataset.reducedMotionPaused !== 'true';

		if ( button ) {
			setPauseButtonState( button, isPlaying );
		}
	}

	function togglePause( button, carouselEl ) {
		if ( typeof jQuery === 'undefined' ) {
			return;
		}
		var playing = button.dataset.playing === 'true';

		if ( playing ) {
			carouselEl.dataset.manualPaused = 'true';
			jQuery( carouselEl ).trigger( 'stop.owl.autoplay' );
		} else {
			carouselEl.dataset.manualPaused = 'false';
			jQuery( carouselEl ).trigger( 'play.owl.autoplay' );
		}

		syncPauseButtonState( carouselEl );
	}

	/* ------------------------------------------------------------------ */
	/*  Locate the pause button for a given carousel                      */
	/* ------------------------------------------------------------------ */

	function findPauseButton( carouselEl ) {
		var sel = getCarouselSelector( carouselEl );
		if ( sel ) {
			var ext = document.querySelector( '[data-carousel-pause-target="' + sel + '"]' );
			if ( ext ) {
				return ext;
			}
		}

		var inside = carouselEl.querySelector( '[data-carousel-pause]' );
		if ( inside ) {
			return inside;
		}

		var wrapper = carouselEl.closest( '.pg-carousel-wrap' );
		if ( wrapper ) {
			var btn = wrapper.querySelector( '[data-carousel-pause]' );
			if ( btn ) {
				return btn;
			}
		}

		return null;
	}

	/* ------------------------------------------------------------------ */
	/*  Stop autoplay and sync UI                                         */
	/* ------------------------------------------------------------------ */

	function stopAutoplay( carouselEl ) {
		if ( typeof jQuery === 'undefined' ) {
			return;
		}
		carouselEl.dataset.manualPaused = 'true';
		jQuery( carouselEl ).trigger( 'stop.owl.autoplay' );
		syncPauseButtonState( carouselEl );
	}

	/* ------------------------------------------------------------------ */
	/*  Hover pause state sync                                            */
	/* ------------------------------------------------------------------ */

	function bindHoverPauseSync( carouselEl ) {
		if ( ! usesHoverPause( carouselEl ) ) {
			return;
		}

		carouselEl.addEventListener( 'pointerenter', function () {
			if ( ! canHover.matches ) {
				return;
			}

			carouselEl.dataset.hoverPaused = 'true';
			syncPauseButtonState( carouselEl );
		} );

		carouselEl.addEventListener( 'pointerleave', function () {
			carouselEl.dataset.hoverPaused = 'false';
			syncPauseButtonState( carouselEl );
		} );

		canHover.addEventListener( 'change', function () {
			if ( canHover.matches ) {
				return;
			}

			carouselEl.dataset.hoverPaused = 'false';
			syncPauseButtonState( carouselEl );
		} );
	}

	/* ------------------------------------------------------------------ */
	/*  Overlay visibility — coordinated show / hide for all controls     */
	/* ------------------------------------------------------------------ */

	function showAll( overlays ) {
		for ( var i = 0; i < overlays.length; i++ ) {
			overlays[ i ].style.opacity = '1';
		}
	}

	function hideAll( overlays ) {
		var val = canHover.matches ? '0' : '0.5';
		for ( var i = 0; i < overlays.length; i++ ) {
			overlays[ i ].style.opacity = val;
		}
	}

	function anyHasFocus( overlays ) {
		var active = document.activeElement;
		for ( var i = 0; i < overlays.length; i++ ) {
			if ( overlays[ i ].contains( active ) ) {
				return true;
			}
		}
		return false;
	}

	/* ------------------------------------------------------------------ */
	/*  Overlay element factory                                           */
	/* ------------------------------------------------------------------ */

	function createOverlay( pos ) {
		var el = document.createElement( 'div' );
		el.className = 'pg-carousel-ctrl absolute z-30 pointer-events-none transition-opacity duration-300';
		el.style.opacity = canHover.matches ? '0' : '0.5';

		if ( pos.top ) {
			el.style.top = pos.top;
		}
		if ( pos.right ) {
			el.style.right = pos.right;
		}
		if ( pos.left ) {
			el.style.left = pos.left;
		}
		if ( pos.transform ) {
			el.style.transform = pos.transform;
		}

		return el;
	}

	function createCtrlButton( cls, label, svg ) {
		var btn = document.createElement( 'button' );
		btn.type = 'button';
		btn.className = cls;
		btn.setAttribute( 'aria-label', label );
		btn.innerHTML = svg;
		btn.style.pointerEvents = 'auto';
		return btn;
	}

	/* ------------------------------------------------------------------ */
	/*  Inject overlay controls (arrows + pause)                          */
	/* ------------------------------------------------------------------ */

	function injectOverlayControls( carouselEl ) {
		var overlays = [];
		var needsNav = ! hasExternalNav( carouselEl );
		var needsPause = ! hasExternalPause( carouselEl );

		if ( ! needsNav && ! needsPause ) {
			return;
		}

		var masked = hasCssMask( carouselEl );
		var anchor;

		if ( masked ) {
			var wrap = document.createElement( 'div' );
			wrap.className = 'pg-carousel-wrap';
			wrap.style.position = 'relative';
			carouselEl.parentNode.insertBefore( wrap, carouselEl );
			wrap.appendChild( carouselEl );
			anchor = wrap;
		} else {
			anchor = carouselEl;
		}

		if ( needsNav ) {
			var prevOvr = createOverlay( { top: '50%', left: '12px', transform: 'translateY(-50%)' } );
			var prevBtn = createCtrlButton( ARROW_CLS, 'Previous slide', PREV_SVG );
			prevBtn.addEventListener( 'click', function ( e ) {
				e.preventDefault();
				e.stopPropagation();
				if ( typeof jQuery !== 'undefined' ) {
					stopAutoplay( carouselEl );
					jQuery( carouselEl ).trigger( 'prev.owl.carousel' );
				}
			} );
			prevOvr.appendChild( prevBtn );
			overlays.push( prevOvr );

			var nextOvr = createOverlay( { top: '50%', right: '12px', transform: 'translateY(-50%)' } );
			var nextBtn = createCtrlButton( ARROW_CLS, 'Next slide', NEXT_SVG );
			nextBtn.addEventListener( 'click', function ( e ) {
				e.preventDefault();
				e.stopPropagation();
				if ( typeof jQuery !== 'undefined' ) {
					stopAutoplay( carouselEl );
					jQuery( carouselEl ).trigger( 'next.owl.carousel' );
				}
			} );
			nextOvr.appendChild( nextBtn );
			overlays.push( nextOvr );
		}

		if ( needsPause ) {
			var pauseOvr = createOverlay( { top: '-44px', right: '0px' } );
			var pauseBtn = createCtrlButton( PAUSE_CLS, 'Pause auto-rotation', pauseSvg( 'w-4 h-4' ) );
			pauseBtn.setAttribute( 'data-carousel-pause', '' );
			pauseBtn.dataset.playing = 'true';
			pauseBtn.addEventListener( 'click', function ( e ) {
				e.preventDefault();
				e.stopPropagation();
				togglePause( pauseBtn, carouselEl );
			} );
			pauseOvr.appendChild( pauseBtn );
			overlays.push( pauseOvr );
		}

		for ( var i = 0; i < overlays.length; i++ ) {
			anchor.appendChild( overlays[ i ] );
		}

		/* --- Coordinated show / hide ---------------------------------- */

		var hoverTarget = anchor;

		hoverTarget.addEventListener( 'pointerenter', function () {
			showAll( overlays );
		} );

		hoverTarget.addEventListener( 'pointerleave', function () {
			if ( ! anyHasFocus( overlays ) ) {
				hideAll( overlays );
			}
		} );

		hoverTarget.addEventListener( 'focusin', function ( e ) {
			if ( e.target.closest && e.target.closest( '.pg-carousel-ctrl' ) ) {
				showAll( overlays );
			}
		} );

		hoverTarget.addEventListener( 'focusout', function () {
			setTimeout( function () {
				if ( ! anyHasFocus( overlays ) ) {
					hideAll( overlays );
				}
			}, 0 );
		} );

		/* --- Touch: respond to hover-capability changes --------------- */

		canHover.addEventListener( 'change', function () {
			if ( ! canHover.matches ) {
				for ( var j = 0; j < overlays.length; j++ ) {
					overlays[ j ].style.opacity = '0.5';
				}
			}
		} );
	}

	/* ------------------------------------------------------------------ */
	/*  Keyboard bindings                                                 */
	/* ------------------------------------------------------------------ */

	function bindKeyboard( carouselEl ) {
		carouselEl.addEventListener( 'keydown', function ( e ) {
			if ( typeof jQuery === 'undefined' ) {
				return;
			}
			var $c = jQuery( carouselEl );

			switch ( e.key ) {
				case 'ArrowRight':
				case 'ArrowDown':
					e.preventDefault();
					stopAutoplay( carouselEl );
					$c.trigger( 'next.owl.carousel' );
					break;

				case 'ArrowLeft':
				case 'ArrowUp':
					e.preventDefault();
					stopAutoplay( carouselEl );
					$c.trigger( 'prev.owl.carousel' );
					break;

				case 'Escape':
					stopAutoplay( carouselEl );
					break;
			}
		} );
	}

	/* ------------------------------------------------------------------ */
	/*  Focus pause — any focus inside carousel stops rotation            */
	/* ------------------------------------------------------------------ */

	function bindFocusPause( carouselEl ) {
		carouselEl.addEventListener( 'focusin', function () {
			stopAutoplay( carouselEl );
		} );
	}

	/* ------------------------------------------------------------------ */
	/*  Reduced motion                                                    */
	/* ------------------------------------------------------------------ */

	function enforceReducedMotion( carouselEl ) {
		if ( typeof jQuery === 'undefined' || ! reducedMotion.matches ) {
			return;
		}
		carouselEl.dataset.reducedMotionPaused = 'true';
		jQuery( carouselEl ).trigger( 'stop.owl.autoplay' );
		syncPauseButtonState( carouselEl );
	}

	/* ------------------------------------------------------------------ */
	/*  External pause-button wiring                                      */
	/* ------------------------------------------------------------------ */

	function bindExternalPauseButtons() {
		var buttons = document.querySelectorAll( '[data-carousel-pause-target]' );

		for ( var i = 0; i < buttons.length; i++ ) {
			( function ( btn ) {
				if ( btn.dataset.a11yBound === 'true' ) {
					return;
				}
				btn.dataset.a11yBound = 'true';

				var target = document.querySelector( btn.dataset.carouselPauseTarget );
				if ( ! target ) {
					return;
				}

				syncPauseButtonState( target );
				btn.addEventListener( 'click', function ( e ) {
					e.preventDefault();
					togglePause( btn, target );
				} );
			} )( buttons[ i ] );
		}
	}

	/* ------------------------------------------------------------------ */
	/*  Per-carousel initialisation                                       */
	/* ------------------------------------------------------------------ */

	function initCarousel( carouselEl ) {
		if ( carouselEl.dataset.a11yReady === 'true' ) {
			return;
		}
		if ( ! isAutoplay( carouselEl ) ) {
			return;
		}

		carouselEl.dataset.a11yReady = 'true';
		carouselEl.dataset.manualPaused = 'false';
		carouselEl.dataset.hoverPaused = 'false';
		carouselEl.dataset.reducedMotionPaused = 'false';

		if ( ! carouselEl.hasAttribute( 'tabindex' ) ) {
			carouselEl.setAttribute( 'tabindex', '0' );
		}

		bindFocusPause( carouselEl );
		bindHoverPauseSync( carouselEl );
		bindKeyboard( carouselEl );
		injectOverlayControls( carouselEl );
		syncPauseButtonState( carouselEl );
		enforceReducedMotion( carouselEl );
	}

	/* ------------------------------------------------------------------ */
	/*  Scan & observe                                                    */
	/* ------------------------------------------------------------------ */

	function scanAndInit() {
		var all = document.querySelectorAll( '.owl-carousel.owl-loaded' );
		for ( var i = 0; i < all.length; i++ ) {
			initCarousel( all[ i ] );
		}
		bindExternalPauseButtons();
	}

	function startObserver() {
		if ( typeof MutationObserver === 'undefined' ) {
			fallbackPoll();
			return;
		}

		var observer = new MutationObserver( function ( mutations ) {
			var hit = false;

			for ( var i = 0; i < mutations.length && ! hit; i++ ) {
				var m = mutations[ i ];

				if ( m.type === 'attributes' &&
					m.target.classList &&
					m.target.classList.contains( 'owl-loaded' ) ) {
					hit = true;
				}

				if ( m.type === 'childList' ) {
					for ( var j = 0; j < m.addedNodes.length && ! hit; j++ ) {
						var node = m.addedNodes[ j ];
						if ( node.nodeType === 1 &&
							( node.classList.contains( 'owl-loaded' ) ||
							  ( node.querySelector && node.querySelector( '.owl-loaded' ) ) ) ) {
							hit = true;
						}
					}
				}
			}

			if ( hit ) {
				scanAndInit();
			}
		} );

		observer.observe( document.body, {
			childList: true,
			subtree: true,
			attributes: true,
			attributeFilter: [ 'class' ]
		} );

		scanAndInit();
	}

	function fallbackPoll() {
		var n = 0;
		var id = setInterval( function () {
			n++;
			scanAndInit();
			if ( n >= 40 ) {
				clearInterval( id );
			}
		}, 500 );
	}

	/* ------------------------------------------------------------------ */
	/*  Global reduced-motion listener                                    */
	/* ------------------------------------------------------------------ */

	reducedMotion.addEventListener( 'change', function () {
		if ( ! reducedMotion.matches ) {
			return;
		}
		var all = document.querySelectorAll( '.owl-carousel.owl-loaded' );
		for ( var i = 0; i < all.length; i++ ) {
			if ( typeof jQuery !== 'undefined' ) {
				jQuery( all[ i ] ).trigger( 'stop.owl.autoplay' );
			}
		}
	} );

	/* ------------------------------------------------------------------ */
	/*  Boot                                                              */
	/* ------------------------------------------------------------------ */

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', startObserver );
	} else {
		startObserver();
	}
}() );
