( function () {
	const hoverMedia = window.matchMedia( '(hover: hover) and (pointer: fine)' );
	const desktopMedia = window.matchMedia( '(min-width: 1024px)' );
	const HOVER_OPEN_DELAY_MS = 3000;
	const HOVER_CLOSE_DELAY_MS = 300;

	class DesktopNavigationController {
		constructor( root ) {
			this.root = root;
			this.triggers = Array.from( root.querySelectorAll( '[data-nav-trigger]' ) );
			this.triggerMap = new Map();
			this.panelMap = new Map();
			this.currentMenuId = null;
			this.currentSource = null;
			this.hoverOpenTimer = null;
			this.hoverCloseTimer = null;
			this.hoverSuppressed = false;
			this.destroyed = false;
			this.removalObserver = null;
			this.listenerCleanup = [];
			this.handleDocumentClick = this.handleDocumentClick.bind( this );
			this.handleMediaChange = this.handleMediaChange.bind( this );

			this.triggers.forEach( ( trigger ) => {
				const menuId = trigger.dataset.navTrigger;
				const panel = root.querySelector( '[data-nav-panel="' + menuId + '"]' );

				if ( ! menuId || ! panel ) {
					return;
				}

				this.triggerMap.set( menuId, trigger );
				this.panelMap.set( menuId, panel );
			} );

			if ( ! this.triggerMap.size ) {
				return;
			}

			this.bindEvents();
			this.syncState();
			this.observeRootRemoval();
		}

		bindEvents() {
			this.triggerMap.forEach( ( trigger, menuId ) => {
				const menuWrapper = trigger.closest( '[data-nav-menu]' );
				const handleTriggerClick = ( event ) => {
					event.preventDefault();
					this.toggleFromClick( menuId );
				};
				const handleTriggerKeydown = ( event ) => {
					this.handleTriggerKeydown( event, menuId );
				};

				trigger.addEventListener( 'click', handleTriggerClick );
				this.listenerCleanup.push( () => {
					trigger.removeEventListener( 'click', handleTriggerClick );
				} );
				trigger.addEventListener( 'keydown', handleTriggerKeydown );
				this.listenerCleanup.push( () => {
					trigger.removeEventListener( 'keydown', handleTriggerKeydown );
				} );

				if ( menuWrapper ) {
					const handlePointerEnter = () => {
						this.handlePointerEnter( menuId );
					};
					const handlePointerLeave = () => {
						this.handlePointerLeave( menuId );
					};

					menuWrapper.addEventListener( 'pointerenter', handlePointerEnter );
					this.listenerCleanup.push( () => {
						menuWrapper.removeEventListener( 'pointerenter', handlePointerEnter );
					} );
					menuWrapper.addEventListener( 'pointerleave', handlePointerLeave );
					this.listenerCleanup.push( () => {
						menuWrapper.removeEventListener( 'pointerleave', handlePointerLeave );
					} );
				}
			} );

			const handleRootKeydown = ( event ) => {
				this.handleMenuKeydown( event );
			};
			const handleRootPointerLeave = () => {
				this.hoverSuppressed = false;
			};

		this.root.addEventListener( 'keydown', handleRootKeydown, true );
		this.listenerCleanup.push( () => {
			this.root.removeEventListener( 'keydown', handleRootKeydown, true );
		} );
		this.root.addEventListener( 'pointerleave', handleRootPointerLeave );
		this.listenerCleanup.push( () => {
			this.root.removeEventListener( 'pointerleave', handleRootPointerLeave );
		} );

		document.addEventListener( 'click', this.handleDocumentClick );
		this.listenerCleanup.push( () => {
			document.removeEventListener( 'click', this.handleDocumentClick );
		} );

		// WCAG 1.4.13 (Content on Hover or Focus): Esc must dismiss hover-opened
		// menus even when focus is not on the trigger/panel (e.g. mouse user hovered
		// a menu open, then pressed Esc to close it).
		this.handleGlobalEscape = ( event ) => {
			if ( this.destroyed || ! this.currentMenuId ) {
				return;
			}
			if ( event.key !== 'Escape' && event.key !== 'Esc' ) {
				return;
			}
			// Only act if this controller currently owns an open menu and focus is
			// NOT already inside the nav (that path is handled by handleMenuKeydown).
			const activeElement = document.activeElement;
			if ( this.root.contains( activeElement ) ) {
				return;
			}
			this.closeMenu();
		};
		document.addEventListener( 'keydown', this.handleGlobalEscape );
		this.listenerCleanup.push( () => {
			document.removeEventListener( 'keydown', this.handleGlobalEscape );
		} );

			if ( typeof desktopMedia.addEventListener === 'function' ) {
				desktopMedia.addEventListener( 'change', this.handleMediaChange );
				this.listenerCleanup.push( () => {
					desktopMedia.removeEventListener( 'change', this.handleMediaChange );
				} );
			} else if ( typeof desktopMedia.addListener === 'function' ) {
				desktopMedia.addListener( this.handleMediaChange );
				this.listenerCleanup.push( () => {
					desktopMedia.removeListener( this.handleMediaChange );
				} );
			}
		}

		handleDocumentClick( event ) {
			if ( this.destroyed ) {
				return;
			}

			if ( ! this.root.contains( event.target ) ) {
				this.closeMenu();
			}
		}

		handleMediaChange() {
			if ( ! desktopMedia.matches ) {
				this.closeMenu();
			}
		}

		observeRootRemoval() {
			if ( typeof MutationObserver !== 'function' || ! document.body ) {
				return;
			}

			this.removalObserver = new MutationObserver( () => {
				if ( ! document.body.contains( this.root ) ) {
					this.destroy();
				}
			} );

			this.removalObserver.observe( document.body, {
				childList: true,
				subtree: true,
			} );
		}

		destroy() {
			if ( this.destroyed ) {
				return;
			}

			this.clearHoverTimers();
			this.closeMenu();
			this.destroyed = true;
			this.listenerCleanup.forEach( ( cleanup ) => {
				cleanup();
			} );
			this.listenerCleanup = [];

			if ( this.removalObserver ) {
				this.removalObserver.disconnect();
				this.removalObserver = null;
			}
		}

		canUseHoverEnhancement() {
			return desktopMedia.matches && hoverMedia.matches && ! this.hoverSuppressed;
		}

		clearHoverTimers() {
			window.clearTimeout( this.hoverOpenTimer );
			window.clearTimeout( this.hoverCloseTimer );
			this.hoverOpenTimer = null;
			this.hoverCloseTimer = null;
		}

		getTrigger( menuId ) {
			return this.triggerMap.get( menuId ) || null;
		}

		getPanel( menuId ) {
			return this.panelMap.get( menuId ) || null;
		}

		getMenuItems( menuId ) {
			const panel = this.getPanel( menuId );

			if ( ! panel ) {
				return [];
			}

			return Array.from( panel.querySelectorAll( '[data-nav-item]' ) ).filter( ( item ) => {
				return ! item.hasAttribute( 'hidden' ) && item.offsetParent !== null;
			} );
		}

		getFocusableElements( menuId ) {
			const trigger = this.getTrigger( menuId );
			const items = this.getMenuItems( menuId );

			return [ trigger, ...items ].filter( Boolean );
		}

		syncState() {
			this.triggerMap.forEach( ( trigger, menuId ) => {
				const panel = this.getPanel( menuId );
				const isOpen = this.currentMenuId === menuId;
				const chevron = trigger.querySelector( '[data-nav-chevron]' );

				trigger.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );

				if ( chevron ) {
					chevron.classList.toggle( 'rotate-180', isOpen );
				}

				if ( panel ) {
					panel.hidden = ! isOpen;
					panel.setAttribute( 'aria-hidden', isOpen ? 'false' : 'true' );
				}
			} );
		}

		focusMenuItem( menuId, position ) {
			const items = this.getMenuItems( menuId );

			if ( ! items.length ) {
				const trigger = this.getTrigger( menuId );
				if ( trigger ) {
					trigger.focus();
				}
				return;
			}

			if ( position === 'last' ) {
				items[ items.length - 1 ].focus();
				return;
			}

			items[ 0 ].focus();
		}

		openMenu( menuId, options = {} ) {
			const source = options.source || 'click';
			const focusTarget = Object.prototype.hasOwnProperty.call( options, 'focusTarget' ) ? options.focusTarget : 'first';

			if ( ! this.triggerMap.has( menuId ) ) {
				return;
			}

			this.clearHoverTimers();
			this.currentMenuId = menuId;
			this.currentSource = source;
			this.syncState();

			if ( source === 'click' && focusTarget !== null ) {
				window.requestAnimationFrame( () => {
					this.focusMenuItem( menuId, focusTarget );
				} );
			}
		}

		closeMenu( options = {} ) {
			const restoreFocus = !! options.restoreFocus;
			const suppressHover = !! options.suppressHover;
			const previousMenuId = this.currentMenuId;

			this.clearHoverTimers();
			this.currentMenuId = null;
			this.currentSource = null;
			this.hoverSuppressed = suppressHover;
			this.syncState();

			if ( restoreFocus && previousMenuId ) {
				const trigger = this.getTrigger( previousMenuId );
				if ( trigger ) {
					trigger.focus();
				}
			}
		}

		toggleFromClick( menuId ) {
			if ( this.currentMenuId === menuId && this.currentSource === 'click' ) {
				this.closeMenu( { restoreFocus: true, suppressHover: true } );
				return;
			}

			this.openMenu( menuId, { source: 'click', focusTarget: 'first' } );
		}

		handlePointerEnter( menuId ) {
			if ( ! this.canUseHoverEnhancement() || this.currentSource === 'click' ) {
				return;
			}

			this.clearHoverTimers();
			this.hoverOpenTimer = window.setTimeout( () => {
				if ( this.currentSource === 'click' || ! this.canUseHoverEnhancement() ) {
					return;
				}

				this.openMenu( menuId, { source: 'hover', focusTarget: null } );
			}, HOVER_OPEN_DELAY_MS );
		}

		handlePointerLeave( menuId ) {
			if ( ! hoverMedia.matches || this.currentSource === 'click' ) {
				return;
			}

			this.clearHoverTimers();

			if ( this.currentMenuId === menuId ) {
				this.hoverCloseTimer = window.setTimeout( () => {
					if ( this.currentSource !== 'click' ) {
						this.closeMenu();
					}
				}, HOVER_CLOSE_DELAY_MS );
			}
		}

		moveTriggerFocus( currentMenuId, direction, options = {} ) {
			const triggerIds = Array.from( this.triggerMap.keys() );
			const currentIndex = triggerIds.indexOf( currentMenuId );

			if ( currentIndex === -1 ) {
				return;
			}

			const nextIndex = ( currentIndex + direction + triggerIds.length ) % triggerIds.length;
			const nextMenuId = triggerIds[ nextIndex ];
			const nextTrigger = this.getTrigger( nextMenuId );

			if ( ! nextTrigger ) {
				return;
			}

			if ( options.openMenu ) {
				this.openMenu( nextMenuId, { source: 'click', focusTarget: options.focusTarget || 'first' } );
				return;
			}

			this.closeMenu();
			nextTrigger.focus();
		}

		handleTriggerKeydown( event, menuId ) {
			switch ( event.key ) {
				case ' ':
				case 'Enter':
					event.preventDefault();
					this.toggleFromClick( menuId );
					break;
				case 'ArrowDown':
					event.preventDefault();
					this.openMenu( menuId, { source: 'click', focusTarget: 'first' } );
					break;
				case 'ArrowUp':
					event.preventDefault();
					this.openMenu( menuId, { source: 'click', focusTarget: 'last' } );
					break;
				case 'ArrowRight':
					event.preventDefault();
					this.moveTriggerFocus( menuId, 1 );
					break;
				case 'ArrowLeft':
					event.preventDefault();
					this.moveTriggerFocus( menuId, -1 );
					break;
				case 'Escape':
					if ( this.currentMenuId === menuId ) {
						event.preventDefault();
						this.closeMenu( { restoreFocus: true } );
					}
					break;
				default:
					break;
			}
		}

		moveMenuItemFocus( direction ) {
			if ( ! this.currentMenuId ) {
				return;
			}

			const items = this.getMenuItems( this.currentMenuId );

			if ( ! items.length ) {
				return;
			}

			const activeElement = document.activeElement;
			const currentIndex = items.indexOf( activeElement );
			const nextIndex = currentIndex === -1
				? ( direction < 0 ? items.length - 1 : 0 )
				: ( currentIndex + direction + items.length ) % items.length;

			items[ nextIndex ].focus();
		}

		trapFocus( event ) {
			if ( ! this.currentMenuId ) {
				return;
			}

			const focusable = this.getFocusableElements( this.currentMenuId );

			if ( ! focusable.length ) {
				return;
			}

			const activeElement = document.activeElement;
			let currentIndex = focusable.indexOf( activeElement );

			if ( currentIndex === -1 ) {
				currentIndex = 0;
			}

			const nextIndex = event.shiftKey
				? ( currentIndex - 1 + focusable.length ) % focusable.length
				: ( currentIndex + 1 ) % focusable.length;

			event.preventDefault();
			focusable[ nextIndex ].focus();
		}

		handleMenuKeydown( event ) {
			if ( ! this.currentMenuId ) {
				return;
			}

			const panel = this.getPanel( this.currentMenuId );
			const trigger = this.getTrigger( this.currentMenuId );
			const activeElement = document.activeElement;
			const activeInsidePanel = !! panel && panel.contains( activeElement );
			const activeOnTrigger = activeElement === trigger;

			if ( ! activeInsidePanel && ! activeOnTrigger ) {
				return;
			}

			switch ( event.key ) {
				case 'Tab':
					this.trapFocus( event );
					break;
				case 'Escape':
					event.preventDefault();
					this.closeMenu( { restoreFocus: true } );
					break;
				case 'ArrowDown':
					if ( activeInsidePanel ) {
						event.preventDefault();
						this.moveMenuItemFocus( 1 );
					}
					break;
				case 'ArrowUp':
					if ( activeInsidePanel ) {
						event.preventDefault();
						this.moveMenuItemFocus( -1 );
					}
					break;
				case 'Home':
					if ( activeInsidePanel ) {
						event.preventDefault();
						this.focusMenuItem( this.currentMenuId, 'first' );
					}
					break;
				case 'End':
					if ( activeInsidePanel ) {
						event.preventDefault();
						this.focusMenuItem( this.currentMenuId, 'last' );
					}
					break;
				case 'ArrowRight':
					if ( activeInsidePanel ) {
						event.preventDefault();
						this.moveTriggerFocus( this.currentMenuId, 1, { openMenu: true, focusTarget: 'first' } );
					}
					break;
				case 'ArrowLeft':
					if ( activeInsidePanel ) {
						event.preventDefault();
						this.moveTriggerFocus( this.currentMenuId, -1, { openMenu: true, focusTarget: 'first' } );
					}
					break;
				default:
					break;
			}
		}
	}

	function initDesktopNavigation() {
		document.querySelectorAll( '[data-desktop-nav]' ).forEach( ( root ) => {
			if ( root.dataset.desktopNavReady === 'true' ) {
				return;
			}

			root.dataset.desktopNavReady = 'true';
			new DesktopNavigationController( root );
		} );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', initDesktopNavigation );
	} else {
		initDesktopNavigation();
	}
}() );
