( function () {
	'use strict';

	var canHover = window.matchMedia( '(hover: hover) and (pointer: fine)' );
	var reducedMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' );

	var PREV_SVG = '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">' +
		'<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>';

	var NEXT_SVG = '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">' +
		'<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>';

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

	var NAMES = [
		'partners-carousel', 'aboutus-carousel', 'recognized-carousel',
		'contracting-vehicles-carousel', 'certificate-carousel',
		'testimonial-carousel', 'sandbox-news-carousel',
		'sandbox-recognized-carousel', 'related-blogs-carousel',
		'visual-moment-carousel', 'symposium-speakers-carousel'
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

	function hasExternalNav( el ) {
		// Accessible toolbar rendered by pg_render_carousel_controls().
		if ( el.getAttribute && el.getAttribute( 'data-pg-carousel-controls' ) ) {
			return true;
		}
		var name = getCarouselName( el );
		if ( ! name ) {
			return false;
		}
		return !! document.getElementById( name.replace( '-carousel', '' ) + '-prev' );
	}

	function isAutoplay( el ) {
		if ( typeof jQuery === 'undefined' ) {
			return false;
		}
		var d = jQuery( el ).data( 'owl.carousel' );
		return !! ( d && d.settings && d.settings.autoplay );
	}

	function hasCssMask( el ) {
		return !! ( el.style.mask || el.style.webkitMask );
	}

	function stopAutoplay( carouselEl ) {
		if ( typeof jQuery === 'undefined' ) {
			return;
		}
		jQuery( carouselEl ).trigger( 'stop.owl.autoplay' );
	}

	/* ------------------------------------------------------------------ */
	/*  Overlay visibility                                                 */
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
	/*  Overlay element factory                                            */
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
	/*  Inject overlay arrow controls                                      */
	/* ------------------------------------------------------------------ */

	function injectOverlayControls( carouselEl ) {
		if ( hasExternalNav( carouselEl ) ) {
			return;
		}

		var overlays = [];
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

		for ( var i = 0; i < overlays.length; i++ ) {
			anchor.appendChild( overlays[ i ] );
		}

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

		canHover.addEventListener( 'change', function () {
			if ( ! canHover.matches ) {
				for ( var j = 0; j < overlays.length; j++ ) {
					overlays[ j ].style.opacity = '0.5';
				}
			}
		} );
	}

	/* ------------------------------------------------------------------ */
	/*  Keyboard bindings                                                  */
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
	/*  Focus pause                                                        */
	/* ------------------------------------------------------------------ */

	function bindFocusPause( carouselEl ) {
		carouselEl.addEventListener( 'focusin', function () {
			stopAutoplay( carouselEl );
		} );
	}

	/* ------------------------------------------------------------------ */
	/*  Reduced motion                                                     */
	/* ------------------------------------------------------------------ */

	function enforceReducedMotion( carouselEl ) {
		if ( typeof jQuery === 'undefined' || ! reducedMotion.matches ) {
			return;
		}
		jQuery( carouselEl ).trigger( 'stop.owl.autoplay' );
	}

	/* ------------------------------------------------------------------ */
	/*  Hide cloned slides from assistive tech                              */
	/*                                                                      */
	/*  Owl Carousel duplicates slides at the head/tail when `loop: true`.  */
	/*  By default the cloned `<div class="owl-item cloned">` is visible to */
	/*  screen readers and its inner `<a>` / `<button>` remain in the tab   */
	/*  order, which causes the "screen reader skips back to parts of the   */
	/*  page earlier said" perception (WCAG 1.3.2 / 2.4.3).                 */
	/*                                                                      */
	/*  We mark every cloned slide with `aria-hidden="true"` and replace    */
	/*  any focusable descendant's tabindex with `-1` so the same item is   */
	/*  only ever announced/focused once.                                   */
	/* ------------------------------------------------------------------ */

	function hideClonedSlides( carouselEl ) {
		var clones = carouselEl.querySelectorAll( '.owl-item.cloned' );
		for ( var i = 0; i < clones.length; i++ ) {
			var clone = clones[ i ];
			clone.setAttribute( 'aria-hidden', 'true' );
			var focusables = clone.querySelectorAll(
				'a, button, input, select, textarea, [tabindex]'
			);
			for ( var j = 0; j < focusables.length; j++ ) {
				focusables[ j ].setAttribute( 'tabindex', '-1' );
				focusables[ j ].setAttribute( 'aria-hidden', 'true' );
			}
		}
	}

	function bindClonedSlideHider( carouselEl ) {
		if ( typeof jQuery === 'undefined' ) {
			return;
		}
		var $c = jQuery( carouselEl );
		hideClonedSlides( carouselEl );
		$c.on( 'initialized.owl.carousel refreshed.owl.carousel resized.owl.carousel', function () {
			hideClonedSlides( carouselEl );
		} );
	}

	/* ------------------------------------------------------------------ */
	/*  Per-carousel init                                                  */
	/* ------------------------------------------------------------------ */

	function initCarousel( carouselEl ) {
		if ( carouselEl.dataset.a11yReady === 'true' ) {
			return;
		}

		// Cloned-slide hiding applies to every Owl Carousel that loaded,
		// regardless of autoplay state, because the duplicate-content
		// reading-order issue exists even on non-autoplaying loops.
		bindClonedSlideHider( carouselEl );

		if ( ! isAutoplay( carouselEl ) ) {
			carouselEl.dataset.a11yReady = 'true';
			return;
		}

		carouselEl.dataset.a11yReady = 'true';

		if ( ! carouselEl.hasAttribute( 'tabindex' ) ) {
			carouselEl.setAttribute( 'tabindex', '0' );
		}

		bindFocusPause( carouselEl );
		bindKeyboard( carouselEl );
		injectOverlayControls( carouselEl );
		enforceReducedMotion( carouselEl );
	}

	/* ------------------------------------------------------------------ */
	/*  Scan & observe                                                     */
	/* ------------------------------------------------------------------ */

	function scanAndInit() {
		var all = document.querySelectorAll( '.owl-carousel.owl-loaded' );
		for ( var i = 0; i < all.length; i++ ) {
			initCarousel( all[ i ] );
		}
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
	/*  Global reduced-motion listener                                     */
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
	/*  Boot                                                               */
	/* ------------------------------------------------------------------ */

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', startObserver );
	} else {
		startObserver();
	}
}() );
