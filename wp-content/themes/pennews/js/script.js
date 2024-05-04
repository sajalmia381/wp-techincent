/* global PENCILOCALIZE */
/* global penciBlocksArray */
jQuery( function ( $ ) {
	'use strict';

	var $body = $( 'body' );

	var penciOnScreen = new OnScreen({
		tolerance: 500,
		debounce: 300,
		container: window
	}) ;

	var PENCI = PENCI || {};

	PENCI.general = {
		// Init the module
		init: function () {
			PENCI.general.showOnlyBlock();
			PENCI.general.topSearch();
			PENCI.general.toggleMobileSidebar();
			PENCI.general.toggleMenuHumburger();
			PENCI.general.removeFrameBorder();
			PENCI.general.scrollToTop();
			PENCI.general.fitvids( $( ".site-content" ) );
			PENCI.general.dropdownNavigation( $( '.primary-menu-mobile' ), '.menu-item-has-children' );
			PENCI.general.Buddypress();
			PENCI.general.CookieLaw();
		},
		CookieLaw: function(){

			var wrapCookie = $( '.penci-wrap-gprd-law' ),
				classAction = 'penci-wrap-gprd-law-close',
				penciCookieName = 'penci_law_footer';

			if( ! wrapCookie.length ){
				return false;
			}

			var penciCookie = {
				set: function ( name, value ) {
					var date = new Date();
					date.setTime( date.getTime() + (31536000000) );
					var expires = "; expires=" + date.toGMTString();
					document.cookie = name + "=" + value + expires + "; path=/";
				},
				read: function ( name ) {
					var namePre = name + "=";
					var cookieSplit = document.cookie.split( ';' );
					for ( var i = 0; i < cookieSplit.length; i ++ ) {
						var cookie = cookieSplit[i];
						while ( cookie.charAt( 0 ) == ' ' ) {
							cookie = cookie.substring( 1, cookie.length );
						}
						if ( cookie.indexOf( namePre ) === 0 ) {
							return cookie.substring( namePre.length, cookie.length );
						}
					}
					return null;
				},
				remove: function ( name ) {
					this.set( name, "", - 1 );
				},
				exists: function ( name ) {
					return (
						this.read( name ) !== null
					);
				}
			};

			if (! penciCookie.exists(penciCookieName) || ( penciCookie.exists(penciCookieName) && 1 == penciCookie.read(penciCookieName) ) ) {
				wrapCookie.removeClass( classAction );
			}else {
				wrapCookie.addClass( classAction );
			}

			$( '.penci-gprd-accept, .penci-gdrd-show' ).on( 'click', function ( e ) {
				e.preventDefault();

				var $this = $(this),
					$parent_law = $this.closest( '.penci-wrap-gprd-law' );

				$parent_law.toggleClass('penci-wrap-gprd-law-close');

				if ( $parent_law.hasClass( 'penci-wrap-gprd-law-close' ) ) {
					penciCookie.set( penciCookieName, '2' );
				}else {
					penciCookie.set( penciCookieName, '1' );
				}

				return false;
			} );
		},
		Buddypress: function () {
			// Call back fitvid when click load more button on buddypress
			$( 'body.buddypress .activity .load-more a' ).on( 'click', function () {
				$( document ).ajaxStop( function () {
					$( ".container,.penci-container" ).fitVids();
				} );
			} );
		},

		// Read a page's GET URL variables and return them as an associative array.
		getUrlVars: function () {
			var vars = [], hash;
			var hashes = window.location.href.slice( window.location.href.indexOf( '?' ) + 1 ).split( '&' );
			for ( var i = 0; i < hashes.length; i ++ ) {
				hash = hashes[i].split( '=' );
				vars.push( hash[0] );
				vars[hash[0]] = hash[1];
			}
			return vars;
		},

		showOnlyBlock: function () {
			if ( ! $body.hasClass( 'penci_show_only_block' ) ) {
				return;
			}

			var blockID = PENCI.general.getUrlVars()["show_only"],
				$block = $( '#' + blockID ),
				$rowParent = $block.closest( '.vc_row' );

			$rowParent.addClass( 'penci_vc_row_show_only' );


		},

		removeFrameBorder: function () {
			$( '#main iframe' ).removeAttr( 'frameborder' );
		},

		//Top search
		topSearch: function () {
			$( '#top-search a.search-click, #top-search-mobile a.search-click' ).on( 'click', function () {
				$( this ).toggleClass( 'search-click-active' );

				var $showSearch = $( this ).next( '.show-search' );
				$showSearch.slideToggle( 'fast' );
			} );
		},

		// Scroll to top
		scrollToTop: function () {
			var $window = $( window ),
				$button = $( '#scroll-to-top' );
			$window.scroll( function () {
				if ( $window.scrollTop() > 300 ) {
					$button.addClass( 'active' );
				}
				else {
					$button.removeClass( 'active' );
				}
			} );
			$button.on( 'click', function ( e ) {
				e.preventDefault();
				$( 'body, html' ).animate( {
					scrollTop: 0
				}, 500 );
			} );
		},

		// Toggle mobile sidebar
		toggleMobileSidebar: function () {
			var $button = $( '.navbar-toggle,#close-sidebar-nav' ),
				sidebarClass = 'mobile-sidebar-open';

			// Click to show mobile menu
			$button.on( 'click', function ( e ) {
				e.preventDefault();

				if ( $body.hasClass( sidebarClass ) ) {
					$body.removeClass( sidebarClass );
					$button.removeClass( 'active' );

					return;
				}
				e.stopPropagation(); // Do not trigger click event on '.site' below
				$body.addClass( sidebarClass );
				$button.addClass( 'active' );
			} );
			// When mobile menu is open, click on page content will close it
			$( '#page' ).on( 'click', function ( e ) {

				if ( ! $body.hasClass( sidebarClass ) ) {
					return;
				}
				e.preventDefault();
				$body.removeClass( sidebarClass );
				$button.removeClass( 'active' );

			} );
		},
		toggleMenuHumburger: function () {
			var $button = $( '.penci-vernav-toggle,.penci-menuhbg-toggle,#penci-close-hbg,.penci-menu-hbg-overlay' ),
				sidebarClass = 'penci-menuhbg-open';

			// Click to show mobile menu
			$button.on( 'click', function ( e ) {
				e.preventDefault();

				if ( $body.hasClass( sidebarClass ) ) {
					$body.removeClass( sidebarClass );
					$button.removeClass( 'active' );

					return;
				}
				e.stopPropagation(); // Do not trigger click event on '.site' below
				$body.addClass( sidebarClass );
				$button.addClass( 'active' );
			} );
			// When mobile menu is open, click on page content will close it
			$( '#page' ).on( 'click', function ( e ) {

				if ( ! $body.hasClass( sidebarClass ) ) {
					return;
				}
				e.preventDefault();
				$body.removeClass( sidebarClass );
				$button.removeClass( 'active' );

			} );
		},
		// Add toggle dropdown icon for mobile menu.
		dropdownNavigation: function ( $container, $ahasChildren ) {
			// Add dropdown toggle that displays child menu items.
			var $dropdownToggle = $( '<u class="dropdown-toggle fa fa-angle-down"></u>' );

			$container.find( $ahasChildren + ' > a' ).append( $dropdownToggle );
			$container.find( '.current-menu-ancestor' ).addClass( 'toggled-on-first' );

			$container.find( '.dropdown-toggle' ).click( function ( e ) {
				e.preventDefault();
				var $this = $( this );

				$container.find( 'li' ).removeClass( 'toggled-on-first' );
				$this.closest( 'li' ).toggleClass( 'toggled-on' );
				$this.parent().next( '.children, .sub-menu' ).slideToggle();
				$this.parent().next().next( '.children, .sub-menu' ).slideToggle();
			} );
		},
		fitvids: function ( $item ) {
			if ( $().fitVids ) {
				// Target your .container, .wrapper, .post, etc.
				$item.fitVids();
			}
		}

	};

	PENCI.sticky = {
		init: function () {

			PENCI.sticky.stickySidebar();
			PENCI.sticky.headerSticky();
			PENCI.sticky.headerMobileSticky();

			$( window ).resize( function () {
				$( ".site-header" ).unstick();

				PENCI.sticky.headerSticky();

				if ( ! $( '.penci-header-mobile' ).hasClass( 'mobile' ) ) {
					$( '.penci-header-mobile' ).unstick();
					PENCI.sticky.headerMobileSticky();
				}
			} );
		},

		headerSticky: function () {
			if ( ! $( 'body' ).hasClass( 'header-sticky' ) || ! $().sticky || $( window ).width() < 1024 ) {
				return;
			}

			$( ".site-header" ).sticky( {
				topSpacing: (
					$( '#wpadminbar' ).length ? $( '#wpadminbar' ).height() : 0
				)
			} );
		},
		headerMobileSticky: function () {

			if ( ! $( 'body' ).hasClass( 'header-sticky' ) || ! $().sticky || $( window ).width() > 1024 ) {
				return false;
			}
			var offset = $( '#wpadminbar' ).length && $( window ).width() > 480 ? $( '#wpadminbar' ).height() : 0;

			$( '.penci-header-mobile' ).sticky( {
				topSpacing: offset,
				className: 'mobile-is-sticky',
				wrapperClassName: 'mobile-sticky-wrapper',
			} );

			return false;
		},
		stickySidebar: function () {

			if ( ! $().theiaStickySidebar || $( window ).width() < 992 ) {
				return false;
			}

			var top_margin = $( '.site-header' ).data( 'height' );

			if ( ! $( 'body' ).hasClass( 'penci-dis-sticky-block_vc' ) ) {
				$( '.penci_vc_sticky_sidebar > div > .penci-content-main, .penci_vc_sticky_sidebar > div > .widget-area, .penci_vc_sticky_sidebar.penci-con_innner .penci-con_innner-item' ).theiaStickySidebar( {
					additionalMarginTop: top_margin,
					additionalMarginBottom: 0
				} );
			}

			if ( $( 'body' ).hasClass( 'penci_sticky_content_sidebar' ) ) {
				$( '.penci-sticky-sidebar, .penci-sticky-content' ).theiaStickySidebar( {
					additionalMarginTop: top_margin,
					additionalMarginBottom: 0
				} );
			}
		}
	};
	/* Video
	 ----------------------------------------------------------------*/
	PENCI.penciVideo = function () {

		if ( $().magnificPopup ) {
			$( '.penci-popup-video' ).magnificPopup( {
				type: 'iframe',
				mainClass: 'mfp-fade'
			} );
		}

		if ( $( '.post-format-meta .wp-video' ).length ) {
			$( '.mejs-overlay-loading' ).closest( '.mejs-overlay' ).addClass( 'load' );

			var $video = $( 'div.video video' );
			var vidWidth = $video.attr( 'width' );
			var vidHeight = $video.attr( 'height' );

			$( window ).resize( function () {
				var targetWidth = $( this ).width();
				$( 'div.video, div.video .mejs-container' ).css( 'height', Math.ceil( vidHeight * (
					targetWidth / vidWidth
				) ) );
			} ).resize();
		}
	};

	/* Toggle social media
	 ----------------------------------------------------------------*/
	PENCI.toggleSocialMedia = function () {
		var $socialToggle = $( ".social-buttons__toggle" ),
			socialButtons = $( '.penci-block-vc .social-buttons' );

		$socialToggle.on( 'click', function ( e ) {
			e.preventDefault();

			socialButtons.removeClass( 'active' );

			var socailMedia = $( this ).closest( '.social-buttons' );

			if ( socailMedia.hasClass( 'active' ) ) {
				socailMedia.addClass( 'pbutton_close_click' ).removeClass( 'active' );

				setTimeout( function () {
					socailMedia.removeClass( 'pbutton_close_click' );
				}, 400 );
			}
		} );

		$( '#page' ).on( 'click', function ( e ) {

			if ( socialButtons.hasClass( 'active' ) ) {
				socialButtons.removeClass( 'active' );
			}
		} );

		$socialToggle.on( 'mouseover touchstart', function () {
			var $this = $( this ),
				parent = $this.parent();

			if ( parent.hasClass( 'active' ) ) {
				return false;
			}

			socialButtons.removeClass( 'active' );
			parent.addClass( 'active' );

		} );
	}


	/* Popup Gallery
	 ---------------------------------------------------------------*/
	PENCI.popupGallery = function () {
		if ( ! $().magnificPopup ) {
			return false;
		}

		$('.penci-image-popup-no-margins').magnificPopup({
			type: 'image',
			closeOnContentClick: true,
			closeBtnInside: false,
			fixedContentPos: true,
			mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
			image: {
				verticalFit: true
			}
		});

		$( '.popup-gallery-slider a' ).magnificPopup( {
			type: 'image'
		} );


		$( '.penci-popup-gallery' ).each( function () {
			var $this = $( this ),
				id = $this.attr( 'id' );

			$( '#' + id + ' a' ).magnificPopup( {
				type: 'image',
				closeOnContentClick: true,
				closeBtnInside: false,
				fixedContentPos: true,
				image: {
					verticalFit: true
				},
				gallery: {
					enabled: true
				},
				zoom: {
					enabled: false,
					duration: 300
				}
			} );
		} );
	}


	/* Ajax block
	 ----------------------------------------------------------------*/
	PENCI.ajaxDoBlockRequest = {
		// Init the module
		init: function () {
			PENCI.ajaxDoBlockRequest.link();
			PENCI.ajaxDoBlockRequest.nextPrev();
			PENCI.ajaxDoBlockRequest.loadMore();
			PENCI.ajaxDoBlockRequest.infinityScroll();
			PENCI.ajaxDoBlockRequest.megamenu();
		},
		megamenu: function () {

			$( 'body' ).on( 'click', '.penci-mega-pag', function ( event ) {
				event.preventDefault();

				if ( $( this ).hasClass( 'penci-pag-disabled' ) ) {
					return false;
				}

				var currentBlockObj = $( this ).data( 'block_id' ),
					$currentBlockObj = $( '#' + currentBlockObj ),
					$blockVC = $currentBlockObj.closest( '.penci-mega-row' ),
					dataFilter = $blockVC.data( 'atts_json' ),
					paged = $blockVC.attr( 'data-current' ),
					blockHeight = $currentBlockObj.height(),
					$is_cache = false;

				var OBjBlockData = PENCI.ajaxDoBlockRequest.getOBjBlockData( $blockVC.attr( 'data-blockUid' ) );
				dataFilter = OBjBlockData.atts_json ? JSON.parse( OBjBlockData.atts_json ) : OBjBlockData.atts_json;

				if ( $( this ).hasClass( 'penci-slider-next' ) ) {
					paged ++;
				}

				if ( $( this ).hasClass( 'penci-slider-prev' ) ) {
					paged --;
				}

				$blockVC.find( '.penci-block-pag' ).removeClass( 'penci-pag-disabled' );

				// Fix height block
				$currentBlockObj.css( 'min-height', blockHeight + 'px' );

				var data = {
					action: 'penci_ajax_mega_menu',
					datafilter: dataFilter,
					paged: paged.toString(),
					styleAction: 'next_prev',
					nonce: PENCILOCALIZE.nonce
				};

				var currentBlockObjSignature = JSON.stringify( data );

				if ( PENCILOCALCACHE.exist( currentBlockObjSignature ) ) {
					var responseData = PENCILOCALCACHE.get( currentBlockObjSignature );

					$is_cache = true;
					setTimeout( function () {
						$blockVC.attr( 'data-current', paged );
						$currentBlockObj.html( responseData.items ).removeClass( 'ajax-loading' );

						PENCI.ajaxDoBlockRequest.animateMegaLoadITems( $currentBlockObj, $is_cache );
						PENCI.ajaxDoBlockRequest.hidePag( $blockVC, responseData );
					}, 300 );

					return false;
				}

				$currentBlockObj.addClass( 'ajax-loading' );

				$.post( PENCILOCALIZE.ajaxUrl, data, function ( response ) {
					$blockVC.attr( 'data-current', paged );


					$currentBlockObj.html( response.data.items );

					PENCI.ajaxDoBlockRequest.animateMegaLoadITems( $currentBlockObj, $is_cache );
					PENCI.ajaxDoBlockRequest.hidePag( $blockVC, response.data );
					PENCI.ajaxDoBlockRequest.saveAjaxData( currentBlockObjSignature, response.data );
				} );

				// Save items page 1 of block
				if ( 1 === paged - 1 ) {

					var dataFirstItems = {
						action: 'penci_ajax_mega_menu',
						datafilter: dataFilter,
						paged: '1',
						styleAction: 'next_prev',
						nonce: PENCILOCALIZE.nonce
					};

					$.post( PENCILOCALIZE.ajaxUrl, dataFirstItems, function ( response ) {
						PENCI.ajaxDoBlockRequest.saveAjaxData( JSON.stringify( dataFirstItems ), response.data );
					} );
				}

			} );
		},
		link: function () {
			$( '.penci-subcat-link' ).click( function ( event ) {
				event.preventDefault();

				if ( $( this ).hasClass( 'active' ) ) {
					return false;
				}

				var currentBlockObj = $( this ).data( 'block_id' ),
					$currentBlockObj = $( '#' + currentBlockObj ),
					$blockVC = $currentBlockObj.closest( '.penci-block-vc' ),
					blockHeight = $currentBlockObj.height(),
					$is_cache = false;

				$blockVC.find( '.penci-subcat-link' ).removeClass( 'active' );
				$( this ).addClass( 'active clicked' );

				var dataFilter = $blockVC.data( 'atts_json' ),
					dataContent = $blockVC.data( 'content' ),
					filterValue = $( this ).data( 'filter_value' ),
					filterTax = $( this ).data( 'filter_tax' );



				var OBjBlockData = PENCI.ajaxDoBlockRequest.getOBjBlockData( $blockVC.attr( 'data-blockUid' ) );
				dataFilter = JSON.parse( OBjBlockData.atts_json );
				dataContent = OBjBlockData.content;

				if ( filterValue ) {
					dataFilter['category_ids'] = filterValue.toString();
				}

				if ( filterTax ) {
					dataFilter['taxonomy'] = filterTax.toString();

				}

				var data = {
					action: 'penci_ajax_block',
					datafilter: dataFilter,
					datacontent: dataContent,
					styleAction: 'link',
					nonce: PENCILOCALIZE.nonce
				};

				// Fix height block
				$currentBlockObj.css( 'min-height', blockHeight + 'px' );

				var currentBlockObjSignature = JSON.stringify( data );
				if ( PENCILOCALCACHE.exist( currentBlockObjSignature ) ) {
					var responseData = PENCILOCALCACHE.get( currentBlockObjSignature );
					$is_cache = true;
					setTimeout( function () {
						$blockVC.attr( 'data-atts_json', JSON.stringify( dataFilter ) ).attr( 'data-current', 1 );

						$currentBlockObj.html( responseData.items ).removeClass( 'ajax-loading' );

						PENCI.ajaxDoBlockRequest.animateLoadITems( $currentBlockObj, '1', $is_cache );
						PENCI.ajaxDoBlockRequest.hidePag( $blockVC, responseData );
					}, 300 );

					return false;
				}

				$currentBlockObj.addClass( 'ajax-loading' );

				$.post( PENCILOCALIZE.ajaxUrl, data, function ( response ) {

					$blockVC.attr( 'data-atts_json', JSON.stringify( dataFilter ) ).attr( 'data-current', 1 );

					$currentBlockObj.html( response.data.items ).removeClass( 'ajax-loading' );

					PENCI.ajaxDoBlockRequest.animateLoadITems( $currentBlockObj, '1', $is_cache );
					PENCI.ajaxDoBlockRequest.hidePag( $blockVC, response.data );
					PENCI.ajaxDoBlockRequest.saveAjaxData( currentBlockObjSignature, response.data );
				} );

				// Save items page 1 of block
				var preFilterValue = $blockVC.find( '.penci-subcat-item-1' ).data( 'filter_value' );
				dataFilter['category_ids'] = preFilterValue ? preFilterValue.toString() : '';

				var preFilterTax = $blockVC.find( '.penci-subcat-item-1' ).data( 'filter_tax' );
				dataFilter['taxonomy'] = preFilterTax ? preFilterTax.toString() : '';

				var dataFirstItems = {
					action: 'penci_ajax_block',
					datafilter: dataFilter,
					datacontent: dataContent,
					styleAction: 'link',
					nonce: PENCILOCALIZE.nonce
				};

				var currentBlockObjFirstItems = JSON.stringify( dataFirstItems );
				if ( filterValue && ! PENCILOCALCACHE.exist( currentBlockObjFirstItems ) ) {
					$.post( PENCILOCALIZE.ajaxUrl, dataFirstItems, function ( response ) {

						PENCI.ajaxDoBlockRequest.saveAjaxData( currentBlockObjFirstItems, response.data );
					} );
				}
			} );
		},
		nextPrev: function () {
			$( 'body' ).on( 'click', '.penci-block-pag', function ( event ) {
				event.preventDefault();

				var start = new Date().getTime();
				if ( $( this ).hasClass( 'penci-pag-disabled' ) ) {
					return false;
				}

				var currentBlockObj = $( this ).data( 'block_id' ),
					$currentBlockObj = $( '#' + currentBlockObj ),
					$blockVC = $currentBlockObj.closest( '.penci-block-vc' ),
					dataContent = $blockVC.data( 'content' ),
					dataFilter = $blockVC.data( 'atts_json' ),
					paged = $blockVC.attr( 'data-current' ),
					filterValue = $blockVC.find( '.penci-subcat-link.active' ).data( 'filter_value' ),
					filterTax = $blockVC.find( '.penci-subcat-link.active' ).data( 'filter_tax' ),
					blockHeight = $currentBlockObj.height(),
					$is_cache = false;


				var OBjBlockData = PENCI.ajaxDoBlockRequest.getOBjBlockData( $blockVC.attr( 'data-blockUid' ) );

				dataFilter = OBjBlockData.atts_json ? JSON.parse( OBjBlockData.atts_json ) : OBjBlockData.atts_json;
				dataContent = OBjBlockData.content;

				if ( filterValue ) {
					dataFilter['category_ids'] = filterValue.toString();
				}
				if ( filterTax ) {
					dataFilter['taxonomy'] = filterTax.toString();
				}

				if ( $( this ).hasClass( 'penci-slider-next' ) ) {
					paged ++;
				}

				if ( $( this ).hasClass( 'penci-slider-prev' ) ) {
					paged --;
				}

				$blockVC.find( '.penci-block-pag' ).removeClass( 'penci-pag-disabled' );

				// Fix height block
				$currentBlockObj.css( 'min-height', blockHeight + 'px' );

				var data = {
					action: 'penci_ajax_block',
					datafilter: dataFilter,
					paged: paged.toString(),
					styleAction: 'next_prev',
					datacontent: dataContent,
					nonce: PENCILOCALIZE.nonce
				};

				var currentBlockObjSignature = JSON.stringify( data );

				if ( PENCILOCALCACHE.exist( currentBlockObjSignature ) ) {

					var responseData = PENCILOCALCACHE.get( currentBlockObjSignature );
					$is_cache = true;

					$blockVC.attr( 'data-current', paged );

					var content = jQuery( responseData.items );
					$currentBlockObj.html( content );

					PENCI.ajaxDoBlockRequest.animateLoadITems( $currentBlockObj, paged, $is_cache );
					PENCI.ajaxDoBlockRequest.hidePag( $blockVC, responseData );

					return false;
				}

				$currentBlockObj.addClass( 'ajax-loading' );

				$.post( PENCILOCALIZE.ajaxUrl, data, function ( response ) {

					$blockVC.attr( 'data-current', paged );

					var content = jQuery( response.data.items );
					$currentBlockObj.html( content );
					PENCI.ajaxDoBlockRequest.animateLoadITems( $currentBlockObj, paged, $is_cache );
					PENCI.ajaxDoBlockRequest.hidePag( $blockVC, response.data );
					PENCI.ajaxDoBlockRequest.saveAjaxData( currentBlockObjSignature, response.data );

				} );

				// Save items page 1 of block
				if ( 1 === paged - 1 ) {

					var dataFirstItems = {
						action: 'penci_ajax_block',
						datafilter: dataFilter,
						paged: '1',
						styleAction: 'next_prev',
						datacontent: dataContent,
						nonce: PENCILOCALIZE.nonce
					};

					$.post( PENCILOCALIZE.ajaxUrl, dataFirstItems, function ( response ) {
						PENCI.ajaxDoBlockRequest.saveAjaxData( JSON.stringify( dataFirstItems ), response.data );
					} );
				}

			} );
		},
		loadMore: function () {
			$( 'body' ).on( 'click', '.penci-block-ajax-more-button', function ( event ) {
				PENCI.ajaxDoBlockRequest.actionLoadMore( $( this ) );
			} );
		},

		infinityScroll: function () {
			var $this_scroll = $( '.penci-block-ajax-more-button.infinite_scroll' );

			if ( ! $this_scroll.length ) {
				return false;
			}

			$( window ).on( 'scroll', function () {
				
				var hT = $this_scroll.offset().top,
					hH = $this_scroll.outerHeight(),
					wH = $( window ).height(),
					wS = $( this ).scrollTop();

				if ( ( wS > ( hT + hH - ( 3 * wH ) ) ) ){
					PENCI.ajaxDoBlockRequest.actionLoadMore( $this_scroll );
				}
			} ).scroll();
		},
		getOBjBlockData: function ( $blockID ) {
			var $obj = new penciBlock();
			$.each( penciBlocksArray, function ( index, block ) {

				if ( block.blockID === $blockID ) {
					$obj = penciBlocksArray[index];
				}
			} );

			return $obj;
		},

		actionLoadMore: function ( $this ) {

			if ( $this.hasClass( 'loading-posts' ) ) {
				return false;
			}

			var mes = $this.data( 'mes' ),
				currentBlockObj = $this.data( 'block_id' ),
				$currentBlockObj = $( '#' + currentBlockObj ),
				$ajaxLoading = $currentBlockObj.find( '.penci-loader-effect' ),
				$blockVC = $currentBlockObj.closest( '.penci-block-vc' ),
				$contentItems = $currentBlockObj.find( '.penci-block_content__items' ),
				dataFilter = $blockVC.data( 'atts_json' ),
				dataContent = $blockVC.data( 'content' ),
				filterValue = $blockVC.find( '.penci-subcat-link.active' ).data( 'filter_value' ),
				filterTax = $blockVC.find( '.penci-subcat-link.active' ).data( 'filter_tax' ),
				paged = $blockVC.attr( 'data-current' ),
				$is_cache = false;

			var OBjBlockData = PENCI.ajaxDoBlockRequest.getOBjBlockData( $blockVC.attr( 'data-blockUid' ) );
			dataFilter = JSON.parse( OBjBlockData.atts_json );
			dataContent = OBjBlockData.content;

			if ( filterValue ) {
				dataFilter['category_ids'] = filterValue.toString();
			}
			if ( filterTax ) {
				dataFilter['taxonomy'] = filterTax.toString();
			}

			paged ++;

			$this.addClass( 'loading-posts' );

			var data = {
				action: 'penci_ajax_block',
				datafilter: dataFilter,
				styleAction: 'load_more',
				paged: paged,
				datacontent: dataContent,
				nonce: PENCILOCALIZE.nonce
			};

			$.post( PENCILOCALIZE.ajaxUrl, data, function ( response ) {

				if ( response.data.items ) {

					$ajaxLoading.remove();
					$currentBlockObj.append( response.data.items ).removeClass( 'ajax-loading' );
					$this.removeClass( 'loading-posts' );

				} else {
					$this.find( ".ajax-more-text" ).text( mes );
					$this.find( "i" ).remove();
					$this.removeClass( 'loading-posts' );
					setTimeout( function () {
						$this.parent( '.penci-ajax-more' ).remove();
					}, 1200 );
				}

				$blockVC.attr( 'data-current', paged );
				PENCI.ajaxDoBlockRequest.animateLoadITems( $currentBlockObj, paged, $is_cache );
			} );
		},

		animateLoadITems: function ( $currentBlockObj, currentPage, $is_cache ) {
			var theBlockListPostItem = $currentBlockObj.find( '.penci-block-items__' + currentPage );

			// Animate the loaded items
			theBlockListPostItem.find( '.penci-post-item' ).velocity( {opacity: 0} );
			$currentBlockObj.removeClass( 'ajax-loading' );
			theBlockListPostItem.find( '.penci-post-item' ).velocity( 'stop' ).velocity( 'transition.slideUpIn', {
				stagger: 100,
				duration: 500,
				complete: function () {
					$currentBlockObj.attr( 'style', '' );
					PENCI.ajaxDoBlockRequest.ajaxSuccess( $currentBlockObj, $is_cache );
				}
			} );

		},
		animateMegaLoadITems: function ( $currentBlockObj, $is_cache ) {
			// Animate the loaded items
			$currentBlockObj.find( '.penci-mega-post' ).velocity( {opacity: 0} );
			$currentBlockObj.removeClass( 'ajax-loading' );
			$currentBlockObj.find( '.penci-mega-post' ).velocity( 'stop' ).velocity( 'transition.slideUpIn', {
				stagger: 100,
				duration: 200,
				complete: function () {
					PENCI.ajaxDoBlockRequest.ajaxSuccess( $currentBlockObj, $is_cache );
					$currentBlockObj.attr( 'style', '' );
				}
			} );
		},

		hidePag: function ( $blockVC, responseData ) {

			var $pagNext = $blockVC.find( '.penci-slider-next' ),
				$pagPrev = $blockVC.find( '.penci-slider-prev' ),
				$pagination = $blockVC.find( '.penci-pagination' );

			if ( responseData.hidePagNext ) {
				$pagNext.addClass( 'penci-pag-disabled' );
				$pagination.addClass( 'penci-ajax-more-disabled' );
			} else {
				$pagNext.removeClass( 'penci-pag-disabled' );
				$pagination.removeClass( 'penci-ajax-more-disabled' );
			}

			if ( responseData.hidePagPrev ) {
				$pagPrev.addClass( 'penci-pag-disabled' );
			} else {
				$pagPrev.removeClass( 'penci-pag-disabled' );
			}
		},

		ajaxSuccess: function ( $currentBlockObj, $is_cache ) {
			if ( ! $is_cache ) {
				PENCI.penciLazy();
			}

			PENCI.general.fitvids( $currentBlockObj );
			PENCI.toggleSocialMedia();
			PENCI.popupGallery();
			PENCI.penciVideo();
			PENCI.sticky.stickySidebar();
			PENCI.EasyPieChart();
		},

		saveAjaxData: function ( key, data ) {

			var dataPost = data.items;
			dataPost = dataPost.replace( /data-src="/g, 'style="background-image: url(' );
			dataPost = dataPost.replace( /" data-delay/g, ');" data-delay' );

			$.each( data, function ( index, value ) {
				if ( 'items' === index ) {
					data[index] = dataPost;
				}
			} );

			PENCILOCALCACHE.set( key, data );
		}
	};

	/* Lazy load
	 ---------------------------------------------------------------*/
	PENCI.penciLazy = function () {

		$( '.penci-lazy' ).Lazy( {
			effect: 'fadeIn',
			effectTime: 300,
			scrollDirection: 'both'
		} );
	};

	/* Load more post
	 ---------------------------------------------------------------*/
	PENCI.loadMorePost = {
		init: function () {
			PENCI.loadMorePost.click();
			PENCI.loadMorePost.infinite_scroll();
		},
		click: function () {
			$( 'body' ).on( 'click', '.penci-ajax-more-button', function ( event ) {
				PENCI.loadMorePost.run( $( this ) );
			} );
		},
		infinite_scroll: function () {
			var $handle = $( '.penci-ajax-more' ),
				$button_load = $handle.find( '.penci-ajax-more-button' );

			if ( $handle.hasClass( 'infinite_scroll' ) ) {
				$( window ).on( 'scroll', function () {

					var hT = $button_load.offset().top,
						hH = $button_load.outerHeight(),
						wH = $( window ).height(),
						wS = $( this ).scrollTop();

					if ( ( wS > ( hT + hH - ( 3 * wH ) ) ) ){
						PENCI.loadMorePost.run( $button_load );
					}
				} ).scroll();
			}
		},
		run: function ( $button_load ) {
			if ( ! $button_load.hasClass( 'loading-posts' ) ) {
				var ppp = $button_load.data( 'number' ),
					mes = $button_load.data( 'mes' ),
					archiveType = $button_load.data( 'archivetype' ),
					archiveValue = $button_load.data( 'archivevalue' ),
					template = $button_load.attr( 'data-template' ),
					layoutStyle = $button_load.attr( 'data-layoutstyle' ),
					offset = $button_load.attr( 'data-offset' ),
					page = $button_load.attr( 'data-page' );

				$button_load.addClass( 'loading-posts' );

				var data = {
					action: 'penci_more_post_ajax',
					offset: offset,
					ppp: ppp,
					page: page,
					template: template,
					layoutstyle: layoutStyle,
					archivetype: archiveType,
					archivevalue: archiveValue,
					nonce: PENCILOCALIZE.nonce
				};

				$.post( PENCILOCALIZE.ajaxUrl, data, function ( r ) {
					if ( r.data ) {

						var data_offset = parseInt( offset ) + ppp;
						$button_load.attr( 'data-offset', data_offset );

						$( "#main .penci-archive__content .penci-archive__list_posts > article:last" ).after( r.data );
						$button_load.removeClass( 'loading-posts' );

						PENCI.general.fitvids( $( ".site-content" ) );

						PENCI.penciLazy();
						PENCI.toggleSocialMedia();
						PENCI.popupGallery();
						PENCI.penciVideo();
						PENCI.sticky.stickySidebar();
						PENCI.EasyPieChart();

					} else {
						$( ".penci-ajax-more-button .ajax-more-text" ).text( mes );
						$( ".penci-ajax-more-button i" ).remove();
						$button_load.removeClass( 'loading-posts' );
						setTimeout( function () {
							$button_load.remove();
						}, 1200 );
					}
				} );
			}
		}
	};

	// Slider
	PENCI.sliderOwl = function ( $item ) {
		$item.each( function () {
			var $this = $( this ),
				$penciBlock = $this.closest( '.penci-block-vc' ),
				$penciNav = $penciBlock.find( '.penci-slider-nav' ),
				$customNext = $penciBlock.find( '.penci-slider-next' ),
				$customPrev = $penciBlock.find( '.penci-slider-prev' ),
				$dataStyle = $this.data( 'style' ),
				$dataItems = $this.data( 'items' ),
				$dataAutoWidth = $this.data( 'autowidth' ),
				$dataAutoHeight = $this.data( 'autoheight' ),
				$dataAuto = $this.data( 'auto' ),
				$dataAutoTime = $this.data( 'autotime' ),
				$dataSpeed = $this.data( 'speed' ),
				$dataLoop = $this.data( 'loop' ),
				$dataDots = $this.data( 'dots' ),
				$dataNav = $this.data( 'nav' ),
				$dataCenter = $this.data( 'center' ),
				$dataVideo = $this.data( 'video' ),
				$dataVertical = $this.data( 'vertical' ),
				$dataMagrin = $this.data( 'magrin' ),
				$dataDisMouseDrag = $this.data( 'dismousedrag' ),
				$dataDisTouchDrag = $this.data( 'distouchdrag' ),
				$lazyLoad = true,
				$rtl = false,
				$items_desktop = '',
				$items_tablet = '',
				$items_tabsmall = '',
				$dataReponsive = {};

			if( $('html').attr('dir') === 'rtl' ) {
				$rtl = true;
			}

			if ( 2 === $dataItems ) {
				$dataReponsive = {
					0: {items: 1, autoWidth: false},
					480: {items: 2}
				};
			}

			if ( (
				     3 === $dataItems || $this.hasClass( 'penci-related-carousel' )
			     ) && 'style-27' !== $dataStyle ) {
				$dataReponsive = {
					0: {items: 1, autoWidth: false},
					480: {items: 2, autoWidth: false},
					992: {items: 3}
				};
			}

			if ( 4 === $dataItems ) {
				$dataReponsive = {
					0: {items: 1, autoWidth: false},
					480: {items: 2, autoWidth: false},
					960: {items: 3},
					1100: {items: 4}
				};
			}

			if ( 'style-7' === $dataStyle ) {
				$dataReponsive = {
					0: {items: 1, autoWidth: false},
					900: {items: 1, autoWidth: true}
				};
			}

			if ( 'style-18' === $dataStyle ) {
				$dataReponsive = {
					0: {items: 1, autoWidth: false},
					768: {items: 2, autoWidth: false}
				};
			}

			if ( 'style-10' === $dataStyle ) {
				$dataReponsive = {
					0: {items: 1, autoWidth: false},
					768: {items: 1, autoWidth: false},
					690: {items: 2}
				};
			}

			if ( 1 === $dataAutoWidth && 'style-27' !== $dataStyle && 'style-7' !== $dataStyle ) {
				$dataReponsive = {
					0: {items: 1, autoWidth: false},
					480: {items: 2},
					768: {items: 2},
					992: {items: 3}
				};
			}

			if ( $this.attr('data-desktop') ) {
				$items_desktop = parseInt( $this.data('desktop') );
			}
			if ( $this.attr('data-tablet') ) {
				$items_tablet = parseInt( $this.data('tablet') );
			}
			if ( $this.attr('data-tabsmall') ) {
				$items_tabsmall = parseInt( $this.data('tabsmall') );
			}

			if( $items_desktop && $items_tablet && $items_tabsmall ){
				$dataReponsive = {
					0   : {
						items: 1
					},
					480 : {
						items  : $items_tabsmall,
						slideBy: $items_tabsmall
					},
					768 : {
						items  : $items_tablet,
						slideBy: $items_tablet
					},
					1170: {
						items  : $items_desktop,
						slideBy: $items_desktop
					}
				};
			}

			var owl_args = {
				rtl : $rtl,
				loop: 1 === $dataLoop ? false : true,
				margin: $dataMagrin,
				items: $dataItems ? $dataItems : 3,
				navSpeed: $dataSpeed,
				dotsSpeed: $dataSpeed,
				nav: 1 === $dataNav ? true : false,
				dots: 1 === $dataDots ? true : false,
				navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
				autoplay: 1 === $dataAuto ? true : false,
				autoplayTimeout: $dataAutoTime,
				autoHeight: 1 === $dataAutoHeight ? true : false,
				center: 1 === $dataCenter ? true : false,
				autoWidth: 1 === $dataAutoWidth ? true : false,
				autoplayHoverPause: true,
				autoplaySpeed: $dataSpeed,
				video: 1 === $dataVideo ? true : false,
				animateOut: 1 === $dataVertical ? 'fadeOutRightNewsTicker' : false,
				animateIn: 1 === $dataVertical ? 'fadeInRightNewsTicker' : false,
				lazyLoad: $lazyLoad,
				mouseDrag: 1 === $dataDisMouseDrag ? false : true,
				touchDrag: 1 === $dataDisTouchDrag ? false : true,
				responsive: $dataReponsive,
			};

			if( $this.hasClass( 'penci-slider-fullscreen' ) ){
				var slideHeight = parseFloat( $(window).height() ),
					slidewidth = parseFloat( $(window).width() ),
					sliderRatio = slideHeight / slidewidth * 100,
				    sliderRatio = sliderRatio.toFixed(2) + '%';

				$this.find( '.penci-slider__item.penci-jarallax-slider' ).css('padding-top',sliderRatio);
				$this.find( '.penci-jarallax-video, .penci-jarallax-slider' ).css('height',slideHeight);
			}

			$this.imagesLoaded( { background: '.penci-slider__item' }, function () {
				$this.owlCarousel( owl_args );
			} );

			$this.on( 'initialized.owl.carousel', function ( event ) {
				PENCI.penciLazy();

				var $jarallax = $this.find( '.penci-jarallax-slider' );

				if( $jarallax.length ){
					$jarallax.jarallax({elementInViewport: $this, imgPosition : '30% 50%' }  );
				}
			} );

			// Go to the next item
			$customNext.click( function ( ev ) {
				ev.preventDefault();
				$this.trigger( 'next.owl.carousel' );
				return false;
			} );

			// Go to the previous item
			$customPrev.click( function ( ev ) {
				ev.preventDefault();
				$this.trigger( 'prev.owl.carousel' );
				return false;
			} );


		} );
	},
		PENCI.Jarallax = function () {
			if ( ! $.fn.jarallax || ! $( '.penci-jarallax' ).length ) {
				return false;
			}

			$( '.penci-jarallax' ).each( function () {
				var $this = $( this ),
					$jarallaxArgs = {};

				if ( $this.hasClass( 'penci-jarallax-inviewport' ) ) {
					var $parent = $this.closest( '.penci-owl-featured-area' );
					$jarallaxArgs = {elementInViewport: $parent, imgPosition : '30% 50%' };
				}

				$this.imagesLoaded( { background: true }, function () {
					jarallax( $this, $jarallaxArgs );
				} );


			} );
		},

		PENCI.sliderSync = function () {
			if ( ! $().owlCarousel ) {
				return false;
			}

			$( '.penci-slider-sync' ).each( function () {
				var $this = $( this ),
					$rtl = false,
					$dataAuto = $this.data( 'auto' ),
					$dataAutoTime = $this.data( 'autotime' ),
					$dataSpeed = $this.data( 'speed' ),
					$dataLoop = $this.data( 'loop' ),
					$dataNav = $this.data( 'nav' ),
					$dataAutowidth = $this.data( 'autowidth' ),
					$dataStyle = $this.data( 'style' ),
					$dataItems = $this.data( 'items' ),
					$dataAutoHeight1 = $this.data( 'autoheight1' ),
					$dataAutoHeight2 = $this.data( 'autoheight2' ),
					$dataReponsive = {};

				if( $('html').attr('dir') === 'rtl' ) {
					$rtl = true;
				}

				if ( 'style-12' === $dataStyle ) {
					$dataReponsive = {
						0: {items: 1},
						1000: {items: 2},
						1400: {items: 3}
					};
				} else if ( 'style-13' === $dataStyle ) {
					$dataReponsive = {
						0: {items: 1},
						1000: {items: 2},
						1200: {items: 3},
						1400: {items: 4}
					};
				}

				var sync1 = $this.find( '.penci-big_items' );
				var sync2 = $this.find( '.penci-small_items' );

				if ( sync1.hasClass( 'popup-gallery' ) ) {
					sync1.magnificPopup( {
						delegate: 'a',
						type: 'image',
						closeOnContentClick: false,
						closeBtnInside: false,
						mainClass: 'penci-with-zoom',
						gallery: {
							enabled: true,
							navigateByImgClick: true,
							preload: [0, 1]
						}
					} );
				}


				sync1.imagesLoaded( function () {
					sync1.owlCarousel( {
						rtl : $rtl,
						items: 1,
						autoplayTimeout: $dataAutoTime,
						nav: 1 === $dataNav ? true : false,
						autoplay: 1 === $dataAuto ? true : false,
						loop: 1 === $dataLoop ? false : true,
						responsiveRefreshRate: 200,
						smartSpeed: $dataSpeed,
						navSpeed: $dataSpeed,
						autoplaySpeed: $dataSpeed,
						dots: false,
						mouseDrag: false,
						lazyLoad: true,
						autoplayHoverPause: true,
						autoHeight: 1 === $dataAutoHeight1 ? false : true,
						navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
					} ).on( 'changed.owl.carousel', syncPosition );
				} );

				sync1.on( 'changed.owl.carousel', function ( event ) {
					PENCI.penciLazy();
				} );

				sync2.imagesLoaded( function () {
					sync2.on( 'initialized.owl.carousel', function () {
						sync2.find( ".owl-item" ).eq( 0 ).addClass( "current" );
					} )
					     .owlCarousel( {
						     rtl : $rtl,
						     autoplay: false,
						     items: $dataItems ? $dataItems : 3,
						     dots: false,
						     nav: false,
						     autoWidth: 1 === $dataAutowidth ? true : false,
						     smartSpeed: $dataSpeed,
						     navSpeed: $dataSpeed,
						     slideSpeed: $dataSpeed,
						     slideBy: 1,
						     autoplayTimeout: $dataAutoTime,
						     responsiveRefreshRate: 200,
						     lazyLoad: true,
						     autoplayHoverPause: true,
						     responsive: $dataReponsive,
						     autoHeight: 1 === $dataAutoHeight2 ? false : true,
					     } );
				} );

				sync2.on( 'changed.owl.carousel', function () {
					sync2.find( '.owl-item' ).eq( 0 ).addClass( 'item-active-1' );
					sync2.find( '.owl-item' ).eq( 1 ).addClass( 'item-active-2' );
					sync2.find( '.owl-item' ).eq( 2 ).addClass( 'item-active-3' );
				} );

				sync2.on( "click", ".owl-item", function ( e ) {
					e.preventDefault();
					var number = $( this ).index();
					sync1.data( 'owl.carousel' ).to( number, 700, true );
				} );

				function syncPosition( el ) {
					var count = el.item.count - 1;
					var current = Math.round( el.item.index - (
						el.item.count / 2
					) - .5 );

					if ( current < 0 ) {
						current = count;
					}
					if ( current > count ) {
						current = 0;
					}

					// End block

					sync2.find( ".owl-item" ).removeClass( "current" ).eq( current ).addClass( "current" );

					var onscreen = sync2.find( '.owl-item.active' ).length - 1;
					var start = sync2.find( '.owl-item.active' ).first().index();
					var end = sync2.find( '.owl-item.active' ).last().index();

					if ( current > end ) {
						sync2.data( 'owl.carousel' ).to( current, 700, true );
					}
					if ( current < start ) {
						sync2.data( 'owl.carousel' ).to( current - onscreen, 700, true );
					}

					if ( onscreen > 0 ) {
						sync2.find( '.owl-item' ).removeClass( 'item-active-1' ).removeClass( 'item-active-2' ).removeClass( 'item-active-3' );
						sync2.find( '.owl-item.active' ).eq( 0 ).addClass( 'item-active-1' );
						sync2.find( '.owl-item.active' ).eq( 1 ).addClass( 'item-active-2' );
						sync2.find( '.owl-item.active' ).eq( 2 ).addClass( 'item-active-3' );
					}
				}
			} );

		};

	// Mega menu
	PENCI.mega_menu = function () {
		// Load item
		$( "#site-navigation .penci-mega-child-categories a" ).bind( 'mouseenter', function ( event ) {

			var $this = $( this );

			if ( $this.hasClass( 'cat-active' ) ) {
				return false;
			}

			var $row_active = $this.data( 'id' ),
				$parentA = $this.parent().children( 'a' ),
				$parent = $this.closest( '.penci-megamenu' ),
				$blockContent = $parent.find( '.' + $row_active ).find( '.penci-block_content' ),
				$latestPosts = $this.closest( '.penci-megamenu' ).find( '.penci-mega-latest-posts' ),
				blockHeight = $latestPosts.height(),
				$rows = $latestPosts.children( '.penci-mega-row' );

			$parentA.removeClass( 'cat-active' );
			$this.addClass( 'cat-active' );

			PENCI.ajaxDoBlockRequest.animateMegaLoadITems( $blockContent, 'transition.slideUpIn' );

			if ( ! $this.hasClass( 'mega-cat-child-loaded' ) ) {

				event.preventDefault();
				if ( $this.hasClass( 'penci-pag-disabled' ) ) {
					return false;
				}

				var $blockVC = $parent.find( '.' + $this.data( 'id' ) ),
					$currentBlockObj = $blockVC.find( '.penci-block_content' ),
					dataFilter = $blockVC.data( 'atts_json' ),
					paged = $blockVC.attr( 'data-current' ),
					$is_cache = false;

				var OBjBlockData = PENCI.ajaxDoBlockRequest.getOBjBlockData( $blockVC.attr( 'data-blockUid' ) );
				dataFilter = OBjBlockData.atts_json ? JSON.parse( OBjBlockData.atts_json ) : OBjBlockData.atts_json;


				$blockVC.find( '.penci-slider-nav' ).hide();

				$latestPosts.addClass( 'penci-mega-latest-posts-loading' );
				$rows.addClass( 'ajax-loading' );
				$currentBlockObj.css( 'min-height', blockHeight + 'px' );
				var data = {
					action: 'penci_ajax_mega_menu',
					datafilter: dataFilter,
					paged: paged.toString(),
					styleAction: 'next_prev',
					nonce: PENCILOCALIZE.nonce
				};

				var currentBlockObjSignature = JSON.stringify( data );

				if ( PENCILOCALCACHE.exist( currentBlockObjSignature ) ) {
					var responseData = PENCILOCALCACHE.get( currentBlockObjSignature );

					$blockVC.attr( 'data-current', paged );

					$currentBlockObj.html( responseData.items );
					PENCI.ajaxDoBlockRequest.animateMegaLoadITems( $currentBlockObj, $is_cache );
					PENCI.ajaxDoBlockRequest.hidePag( $blockVC, responseData );
					$this.addClass( 'mega-cat-child-loaded' );
					$rows.removeClass( 'ajax-loading' );
					$latestPosts.removeClass( 'penci-mega-latest-posts-loading' );

					if ( ! responseData.hidePagNext || ! responseData.hidePagNext ) {
						$blockVC.find( '.penci-slider-nav' ).show();
					}
					$rows.hide();
					$parent.find( '.' + $row_active ).fadeIn( 'normal' ).css( 'display', 'inline-block' );

					return false;
				}

				$.post( PENCILOCALIZE.ajaxUrl, data, function ( response ) {
					$blockVC.attr( 'data-current', paged );

					$currentBlockObj.html( response.data.items );
					PENCI.ajaxDoBlockRequest.animateMegaLoadITems( $currentBlockObj, $is_cache );
					PENCI.ajaxDoBlockRequest.hidePag( $blockVC, response.data );
					PENCI.ajaxDoBlockRequest.saveAjaxData( JSON.stringify( data ), response.data );
					$this.addClass( 'mega-cat-child-loaded' );
					$rows.removeClass( 'ajax-loading' );
					$latestPosts.removeClass( 'penci-mega-latest-posts-loading' );
					if ( ! response.data.hidePagNext || ! response.data.hidePagNext ) {
						$blockVC.find( '.penci-slider-nav' ).show();
					}
					$rows.hide();
					$parent.find( '.' + $row_active ).fadeIn( 'normal' ).css( 'display', 'inline-block' );
				} );
			} else {
				$rows.hide();
				$parent.find( '.' + $row_active ).fadeIn( 'normal' ).css( 'display', 'inline-block' );
			}
		} );
	};

	PENCI.postLike = function () {
		$( 'body' ).on( 'click', '.penci-post-like', function ( event ) {
			event.preventDefault();
			var $this = $( this ),
				post_id = $this.data( "post_id" ),
				like_text = $this.data( "like" ),
				unlike_text = $this.data( "unlike" ),
				$selector = $this.children( '.penci-share-number' );

			var $like = parseInt( $selector.text() );

			if ( $this.hasClass( 'single-like-button' ) ) {
				$selector = $( '.single-like-button .penci-share-number' );
				$this = $( '.single-like-button' );
			}

			if ( $this.hasClass( 'liked' ) ) {
				$this.removeClass( 'liked' );
				$this.prop( 'title', like_text );
				$selector.html( (
					$like - 1
				) );
			}
			else {
				$this.addClass( 'liked' );
				$this.prop( 'title', unlike_text );
				$selector.html( (
					$like + 1
				) );
			}

			var data = {
				action: 'penci_post_like',
				post_id: post_id,
				penci_post_like: '',
				nonce: PENCILOCALIZE.nonce
			};

			$.post( PENCILOCALIZE.ajaxUrl, data, function ( r ) {
			} );
		} );
	}

	PENCI.loginRegisterPopup = {
		// Init the module
		init: function () {
			this.login();
			this.register();
			this.VCregister();
		},
		//Login
		login: function () {
			if( ! $( '#penci-popup-login' ).length ) {
				return false;
			}

			var $body = $( 'body' ),
				$popupLogin = $( '#penci-popup-login' ),
				$loginContainer = $popupLogin.find( '.penci-login-container' ),
				login = '#penci_login',
				pass = '#penci_pass';

			$( '#penci-popup-login #penci_login' ).attr( 'placeholder', PENCILOCALIZE.login );
			$( '#penci-popup-login #penci_pass' ).attr( 'placeholder', PENCILOCALIZE.password );

			$body.on( 'click', '#penci-popup-login .close-popup', function ( e ) {
				e.preventDefault();
				$body.removeClass( 'penci-popup-active' );
				$popupLogin.removeClass( 'active' );
			} );

			$body.on( 'click', '.penci-topbar  .login-popup', function ( e ) {
				if ( $( window ).width() > 0 ) {
					e.preventDefault();
					$( 'body' ).addClass( 'penci-popup-active' );
					$popupLogin.addClass( 'active' );

					if ( $loginContainer.length ) {

						var el_H = $loginContainer.outerHeight(),
							win_H = $( window ).height();

						if ( win_H > el_H ) {
							$loginContainer.css( 'top', parseInt( (
								                                      win_H - el_H
							                                      ) / 2 ) );
						}
					}
				}
			} );

			$body.on( 'click', '#penci-popup-login', function ( e ) {
				if ( $( e.target ).attr( 'id' ) == 'penci-popup-login' ) {
					$body.removeClass( 'penci-popup-active' );
					$popupLogin.removeClass( 'active' );
				}
			} );

			$( '#penci_login,#penci_pass' ).on( 'focus', function () {
				$( this ).removeClass( 'invalid' );
			} );

			$( '#penci-popup-login #loginform' ).submit( function ( e ) {

				var $this = $( this ),
					inputUsername = $this.find( '#penci_login' ),
					inputPass = $this.find( '#penci_pass' ),
					valUsername = inputUsername.val(),
					valPass = inputPass.val(),
					captcha = $this.find( '.g-recaptcha-response' ).val();

				if ( inputUsername.length > 0 && valUsername == '' ) {
					inputUsername.addClass( 'invalid' );
					e.preventDefault();
				}

				if ( inputPass.length > 0 && valPass == '' ) {
					inputPass.addClass( 'invalid' );
					e.preventDefault();
				}

				if ( valUsername == '' || valPass == '' ) {
					return false;
				}

				$loginContainer.addClass( 'ajax-loading' );
				$loginContainer.find( '.message' ).slideDown().remove();

				var data = {
					action: 'penci_login_ajax',
					username: valUsername,
					password: valPass,
					captcha: captcha,
					remember: $loginContainer.find( '#rememberme' ).val()
				};

				$.post( PENCILOCALIZE.ajaxUrl, data, function ( response ) {

					$loginContainer.removeClass( 'ajax-loading' )
					               .find( '.penci-login' )
					               .append( response.data );

					if ( ! response.success ) {
						return;
					}

					window.location = window.location;
				} );

				e.preventDefault();
				return false;
			} );
		},
		register: function () {

			if( ! $( '#penci-popup-register' ).length ) {
				return false;
			}

			var $body = $( 'body' ),
				$popupLogin = $( '#penci-popup-login' ),
				$loginContainer = $popupLogin.find( '.penci-login-container' ),
				$popupRegister = $( '#penci-popup-register' ),
				$registerContainer = $popupRegister.find( '.penci-login-container' );

			if ( $registerContainer.length ) {

				var el_H = $registerContainer.outerHeight(),
					win_H = $( window ).height();

				if ( win_H > el_H ) {
					$registerContainer.css( 'top', ( win_H - el_H ) / 2 );
				}
			}

			$body.on( 'click', '#penci-popup-register .close-popup', function ( e ) {
				e.preventDefault();
				$body.removeClass( 'penci-popup-active' );
				$popupRegister.removeClass( 'active' );
			} );

			$body.on( 'click', '#penci-popup-login  .register a', function ( e ) {
				e.preventDefault();
				$popupRegister.addClass( 'active' );
				$popupLogin.removeClass( 'active' );

				if ( $registerContainer.length ) {

					var el_H = $registerContainer.outerHeight(),
						win_H = $( window ).height();

					if ( win_H > el_H ) {
						$registerContainer.css( 'top', parseInt( ( win_H - el_H ) / 2 ) );
					}
				}

				return false;
			} );

			$body.on( 'click', '#registration  .login a', function ( e ) {
				e.preventDefault();
				$popupRegister.removeClass( 'active' );
				$popupLogin.addClass( 'active' );

				if ( $loginContainer.length ) {

					var el_H = $loginContainer.outerHeight(),
						win_H = $( window ).height();

					if ( win_H > el_H ) {
						$loginContainer.css( 'top', parseInt( (win_H - el_H) / 2 ) );
					}
				}

				return false;
			} );

			$body.on( 'click', '#penci-popup-register', function ( e ) {
				if ( $( e.target ).attr( 'id' ) == 'penci-popup-register' ) {
					$body.removeClass( 'penci-popup-active' );
					$popupRegister.removeClass( 'active' );
				}
			} );

			var $allInput = $( '.penci_user_name,.penci_user_name,.penci_user_email,.penci_user_pass,.penci_user_pass_confirm' );

			$allInput.on( 'focus', function () {
				$( this ).removeClass( 'invalid' );
			} );


			$( '#penci-popup-register #registration, .penci-register #registration' ).submit( function ( event ) {
				event.preventDefault();

				var $this = $( this ),
					$registerContainer = $( '#penci-popup-register .penci-login-container, .penci-register .penci-login-container' ),
					inputUsername = $this.find( '.penci_user_name' ),
					inputEmail = $this.find( '.penci_user_email' ),
					$inputPass = $this.find( '.penci_user_pass' ),
					$inputPassConfirm = $this.find( '.penci_user_pass_confirm' ),
					valUsername = inputUsername.val(),
					valEmail = inputEmail.val(),
					valPass = $inputPass.val(),
					valPassConfirm = $inputPassConfirm.val(),
					captcha = $this.find( '.g-recaptcha-response' ).val();

				$allInput.removeClass( 'invalid' );

				if ( inputUsername.length > 0 && valUsername == '' ) {
					inputUsername.addClass( 'invalid' );
					event.preventDefault();
				}

				if ( inputEmail.length > 0 && valEmail == '' ) {
					inputEmail.addClass( 'invalid' );
					event.preventDefault();
				}

				if ( $inputPass.length > 0 && valPass == '' ) {
					$inputPass.addClass( 'invalid' );
					event.preventDefault();
				}

				if ( $inputPassConfirm.length > 0 && valPassConfirm == '' ) {
					$inputPassConfirm.addClass( 'invalid' );
					event.preventDefault();
				}
				if ( valUsername == '' || valEmail == '' || valPass == '' || valPassConfirm == '' ) {
					return false;
				}

				// Password does not match the confirm password
				if ( valPassConfirm !== valPass ) {
					$inputPass.addClass( 'invalid' );
					$inputPassConfirm.addClass( 'invalid' );
					$registerContainer.find( '.penci-login' ).append( PENCILOCALIZE.errorPass );
					event.preventDefault();

					return false;
				}
				$registerContainer.addClass( 'ajax-loading' );
				$registerContainer.find( '.message' ).slideDown().remove();

				var data = {
					action: 'penci_register_ajax',
					fistName: $this.find( '.penci_first_name' ).val(),
					lastName: $this.find( '.penci_last_name' ).val(),
					username: valUsername,
					password: valPass,
					confirmPass: valPassConfirm,
					email: valEmail,
					captcha : captcha
				};

				$.post( PENCILOCALIZE.ajaxUrl, data, function ( response ) {

					$registerContainer.removeClass( 'ajax-loading' ).find( '.penci-login' ).append( response.data );

					if ( ! response.success ) {
						return;
					}

					window.location = window.location;
				} );

				event.preventDefault();
				return false;
			} );
		},
		VCregister:function(){
			var $form = $( '.penci-registration-form' );

			if( ! $form.length ){
				return false;
			}

			$form.submit( function ( event ) {
				event.preventDefault();

				var $this = $( this ),
					$registerContainer = $this.closest( '.penci-register-container' ),
					inputUsername = $this.find( '.penci_user_name' ),
					inputEmail = $this.find( '.penci_user_email' ),
					$inputPass = $this.find( '.penci_user_pass' ),
					$inputPassConfirm = $this.find( '.penci_user_pass_confirm' ),
					valUsername = inputUsername.val(),
					valEmail = inputEmail.val(),
					valPass = $inputPass.val(),
					valPassConfirm = $inputPassConfirm.val(),
					captcha = $this.find( '.g-recaptcha-response' ).val();

				var $allInput = $( '.penci_user_name,.penci_user_email,.penci_user_pass,.penci_user_pass_confirm' );

				$allInput.removeClass( 'invalid' );

				if ( inputUsername.length > 0 && valUsername == '' ) {
					inputUsername.addClass( 'invalid' );
					event.preventDefault();
				}


				if ( inputEmail.length > 0 && valEmail == '' ) {
					inputEmail.addClass( 'invalid' );
					event.preventDefault();
				}


				if ( $inputPass.length > 0 && valPass == '' ) {
					$inputPass.addClass( 'invalid' );
					event.preventDefault();
				}

				if ( $inputPassConfirm.length > 0 && valPassConfirm == '' ) {
					$inputPassConfirm.addClass( 'invalid' );
					event.preventDefault();
				}
				if ( valUsername == '' || valEmail == '' || valPass == '' || valPassConfirm == '' ) {
					return false;
				}

				// Password does not match the confirm password
				if ( valPassConfirm !== valPass ) {
					$inputPass.addClass( 'invalid' );
					$inputPassConfirm.addClass( 'invalid' );
					$registerContainer.find( '.penci-register-container' ).append( PENCILOCALIZE.errorPass );
					event.preventDefault();

					return false;
				}

				$registerContainer.addClass( 'ajax-loading' );
				$registerContainer.find( '.message' ).slideDown().remove();

				var data = {
					action: 'penci_register_ajax',
					fistName: $this.find( '.penci_first_name' ).val(),
					lastName: $this.find( '.penci_last_name' ).val(),
					username: valUsername,
					password: valPass,
					confirmPass: valPassConfirm,
					email: valEmail,
					captcha : captcha
				};

				$.post( PENCILOCALIZE.ajaxUrl, data, function ( response ) {

					$registerContainer.removeClass( 'ajax-loading' ).find( '.penci-register-container' ).append( response.data );

					if ( ! response.success ) {
						return;
					}

					window.location = window.location;

				} );

				event.preventDefault();
				return false;
			} );
		}
	};

	/* Gallery
	 ----------------------------------------------------------------*/
	PENCI.gallery = function () {
		var $justified_gallery = $( '.penci-post-gallery-container.justified' );
		var $masonry_gallery = $( '.penci-post-gallery-container.masonry' );
		if ( $().justifiedGallery && $justified_gallery.length ) {
			$( '.penci-post-gallery-container.justified' ).each( function () {
				var $this = $( this );
				$this.justifiedGallery( {
					rowHeight: $this.data( 'height' ),
					lastRow: 'nojustify',
					margins: $this.data( 'margin' ),
					randomize: false
				} );
			} ); // each .penci-post-gallery-container
		}

		if ( $().isotope && $masonry_gallery.length ) {

			$( '.penci-post-gallery-container.masonry .item-gallery-masonry' ).each( function () {
				var $this = $( this );
				if ( $this.attr( 'title' ) ) {
					var $title = $this.attr( 'title' );
					$this.children().append( '<div class="caption">' + $title + '</div>' );
				}
			} );

			$ ( window ) .on ('load', function () {
				if ( $masonry_gallery.length ) {
					$masonry_gallery.each( function () {
						var $this = $( this );
						// initialize isotope
						$this.isotope( {
							itemSelector: '.item-gallery-masonry',
							transitionDuration: '.55s',
							layoutMode: 'masonry'
						} );

						$this.addClass( 'loaded' );

						$( '.penci-post-gallery-container.masonry .item-gallery-masonry' ).each( function () {
							var $this = $( this );
							$this.one( 'inview', function ( event, isInView, visiblePartX, visiblePartY ) {
								$this.addClass( 'animated' );
							} ); // inview
						} ); // each

					} );
				}
			} );
		}

	};

	/* Portfolio
	 ----------------------------------------------------------------*/
	PENCI.portfolio = {
		init: function () {
			var $penci_portfolio = $( '.wrapper-penci-portfolio' );


			if ( $().isotope && $penci_portfolio.length ) {
				$penci_portfolio.each( function () {

					var $this = $( this ),
						unique_id = $( this ).attr( 'id' ),
						DataFilter = null;

					if( typeof(portfolioDataJs) != "undefined" && portfolioDataJs !== null) {
						for ( var e in portfolioDataJs ) {
							if ( portfolioDataJs[e].instanceId == unique_id ) {
								var DataFilter = portfolioDataJs[e];
							}
						}
					}


					PENCI.portfolio.isotopeLoad( $this, DataFilter );
					PENCI.portfolio.loadMore( $this, DataFilter );
					PENCI.portfolio.infinityScroll( DataFilter );

				} );
			}
		},

		lazy: function(){
			$( '.penci-pfl-lazy' ).Lazy( {
				effect: 'fadeIn',
				effectTime: 300,
				scrollDirection: 'both',
				afterLoad: function(element) {
					element.addClass('penci-lazyloaded');
					element.parent().addClass('penci-lazyloaded-parent');
				}
			} );
		},
		isotopeLoad: function ( $pfl_wapper, DataFilter ) {
			var $portfolio = $pfl_wapper.find( '.penci-portfolio' ),
				$portfolioLazy = $('.penci-portfolio .penci-lazy'),
				$filter = $pfl_wapper.find( '.penci-portfolio-filter' ),
				$afilter = $filter.find( 'a' ),
				location = window.location.hash.toString();

			$pfl_wapper.imagesLoaded( function() {
				$portfolio.isotope( {
					itemSelector: '.portfolio-item'
				} );
				$portfolio.addClass( 'loaded' );
				PENCI.portfolio.lazy();
			} );

			$afilter.on( 'click', function () {

				var term = $( this ).data( "term" );
				PENCI.portfolio.cacheFilter( term, $filter );

				var element = 0,
					item = "*" == term,
					_count = 0;

				$portfolio.isotope( {
					filter: function () {
						var $this = $( this ),
							_terms = $this.data( "terms" );
						return item ? (
							$this.hasClass( "pfl-appended" ) && _count ++, element ++, ! 0) : ! (! _terms || (_terms = _terms.toString().split( " " ), - 1 == $.inArray( term, _terms ))) && ($this.hasClass( "pfl-appended" ) && _count ++, element ++, ! 0);
					}
				} );
				PENCI.portfolio.lazy();

				PENCI.portfolio.filterIsotope( $( this ), $filter, $portfolio, DataFilter );

				return false;
			} );

			if ( location.length ) {
				location = location.replace( '#', '' );
				location.match( /:/ );
				var Mlocation = location.match( /^([^:]+)/ )[1];
				location = location.replace( Mlocation + ":", "" );

				if ( location.length > 1 ) {

					var $termActive = $afilter.filter( '[data-term="' + location + '"]' );
					if ( $termActive.length ) {
						var term = location,
							element = 0,
							item = "*" == term,
							_count = 0;

						$portfolio.isotope( {
							filter: function () {
								var $this = $( this ),
									terms = $this.data( "terms" );
								return item ? (
									$this.hasClass( "penci-pfl-appended" ) && _count ++, element ++, ! 0
								) : ! (
									! terms || (
										        terms = terms.toString().split( " " ), - 1 == $.inArray( term, terms )
									        )
								) && (
								    $this.hasClass( "penci-pfl-appended" ) && _count ++, element ++, ! 0
								    );
							}
						} );
						PENCI.portfolio.filterIsotope( $termActive, $filter, $portfolio, DataFilter );
					}
				}
			}
		},
		cacheFilter: function ( term, $filter ) {
			var $e_dataTerm = $filter.find( 'a' ).filter( '[data-term="' + term + '"]' ),
				scrollTop = $( window ).scrollTop();

			if ( $e_dataTerm.length ) {
				window.location.hash = "*" == term ? "" : term;
				$( window ).scrollTop( scrollTop );
			}
		},
		filterIsotope: function ( $this, $filter, $portfolio, DataFilter ) {
			var $e_parent = $this.parent(),
				$e_parent_ul = $e_parent.parent();

			$filter.find( 'li' ).removeClass( 'active' );
			$e_parent.addClass( 'active' );

			var dataTerm = $this.data( "term" ),
				dataTax = $this.data( "tax" ),
				$subCarFilter = $filter.find( 'ul' ).filter( '[data-subcatof="' + dataTerm + '"]' ),
				$e_dataTerm = $filter.find( 'a' ).filter( '[data-term="' + dataTerm + '"]' );

			DataFilter.currentTerm = dataTerm;
			DataFilter.currentTax = dataTax;

			if ( $subCarFilter.length ) {

				if ( ! $subCarFilter.hasClass( 'is-active' ) ) {
					if ( $e_parent_ul.hasClass( 'penci-pfl-root-cats' ) ) {
						$filter.addClass( 'subcategory-active' );
						$subCarFilter.addClass( 'is-active' );
					}
				} else {
					$e_dataTerm.parent().not( ".penci-pfl-subcat-back" ).addClass( 'active' );
					$filter.removeClass( 'subcategory-active' );
					$subCarFilter.removeClass( 'is-active' );
				}
			}

			var p = {},
				portfolioItem = $portfolio.find( '.portfolio-item' ),
				$buttonLoadMore = $portfolio.closest( '.wrapper-penci-portfolio' ).find( '.penci-portfolio-more-button' );


			$.each( DataFilter.countByTerms, function ( t, e ) {
				p[t] = 0
			} );

			$portfolio.find( '.portfolio-item' ).each( function ( t, e ) {
				$.each( (
					$( e ).data( "terms" ) + ""
				).split( " " ), function ( t, e ) {
					p[e] ++;
				} )
			} );

			var $show_button = 'number' == typeof p[dataTerm] && p[dataTerm] == DataFilter.countByTerms[dataTerm];

			if ( $buttonLoadMore.length ){

				var $parentMore = $buttonLoadMore.parent();
				if ( portfolioItem.length !== DataFilter.count && ! $show_button ) {
					var parentMoreHeight = $buttonLoadMore.outerHeight( true );

					$buttonLoadMore.removeClass( 'is-finished' );
					TweenMax.to( $parentMore, .5, {
						height: parentMoreHeight,
						autoAlpha: 1,
						delay: 1
					} )
				} else {
					TweenMax.to( $parentMore, .5, {
						height: 0,
						autoAlpha: 0,
						delay: 2
					} );
				}
			}

		},
		loadMore: function ( $pfl_wapper, DataFilter ) {
			$pfl_wapper.on( 'click', '.penci-portfolio-more-button', function ( e ) {
				PENCI.portfolio.actionLoadMore( $( this ), $pfl_wapper, DataFilter );
			} );
		},
		infinityScroll: function ( DataFilter ) {
			var $this_scroll = $( '.penci-portfolio-more-button.infinite' );

			if ( ! $this_scroll.length ) {
				return false;
			}

			$( window ).on( 'scroll', function () {
				var hT = $this_scroll.offset().top,
					hH = $this_scroll.outerHeight(),
					wH = $( window ).height(),
					wS = $( this ).scrollTop();

				if ( wS > (
						hT + hH - wH
					) && ! $this_scroll.hasClass( 'loading-posts' ) ) {
					var $pfl_wapper = $this_scroll.closest( '.wrapper-penci-portfolio' );
					PENCI.portfolio.actionLoadMore( $this_scroll, $pfl_wapper, DataFilter );
				}
			} ).scroll();
		},
		actionLoadMore: function ( $this, $pfl_wapper, DataFilter ) {
			var $currentFilter = $pfl_wapper.find( '.penci-portfolio-filter' ).find( '.active a' ).attr( 'data-filter' ),
				$parentMore = $this.parent(),
				$portfolio = $pfl_wapper.find( '.penci-portfolio' );

			if ( ! $this.hasClass( 'load_more' ) && ! $this.hasClass( 'infinite' ) ) {
				return false;
			}

			$this.addClass( 'loading-posts' );

			DataFilter.pflShowIds = [];

			$portfolio.find( '.portfolio-item' ).each( function ( t, e ) {
				DataFilter.pflShowIds.push( $( e ).data( 'pflid' ) );
			} );

			var data = {
				action: 'penci_ajax_portfolio',
				datafilter: DataFilter,
				nonce: PENCILOCALIZE.nonce
			};

			$.post( PENCILOCALIZE.ajaxUrl, data, function ( response ) {
				if ( response.data.items ) {
					$this.attr( 'data-offset', response.data.offset );
					var $items = $( response.data.items );
					$items = $items.addClass( 'penci-pfl-appended penci-pfl-no-trans penci-pfl-no-opacity' );
					$portfolio.append( $items );
					$portfolio.isotope( 'appended', $items );

					PENCI.portfolio.lazy();

					$items.removeClass( 'penci-pfl-no-trans penci-pfl-no-opacity' );
					$portfolio.imagesLoaded( function () {
						$portfolio.isotope( 'layout' );
					} );

					$this.delay( 400 ).removeClass( 'loading-posts' );
					PENCI.sticky.stickySidebar();

				}

				if ( ! response.data.items || ! response.data.show_pag ) {
					$this.addClass( 'is-finished' );
					$this.removeClass( 'loading-posts' );
					TweenMax.to( $parentMore, .5, {
						height: 0,
						autoAlpha: 0,
						delay: 2
					} );
				}
			} );
		},

	},
	PENCI.singleLoadMore = {
			// Init the module
			init: function () {

				if ( ! $body.hasClass( 'penci-autoload-prev' ) ) {
					return false;
				}

				PENCI.singleLoadMore.showComments();
				PENCI.singleLoadMore.loadMore();

				var firstPost = $('.penci-content-post.noloaddisqus');

				$(window).bind('scroll touchstart', function() {
					var scrollTop = $(this).scrollTop();

					if ( scrollTop > 1) {
						window.setTimeout(function() {
							var preScrollTop = scrollTop + 30;
							var postsContainer = $('.penci-content-post ');
							var locationHref = window.location.href;

							var currentP = postsContainer.map(function() {
								if ($(this).offset().top < preScrollTop )
									return this;
							});

							currentP = currentP[currentP.length - 1];
							var pid = $( currentP ).data( 'id' );
							var plink = $( currentP ).data( 'url' );
							var ptitle = $( currentP ).data( 'title' );

							if ( pid === undefined ) {
								pid = firstPost.data( 'id' );
								plink = firstPost.data( 'url' );
								ptitle = firstPost.data( 'title' );
							}

							if ( locationHref !== plink ) {
								PENCI.singleLoadMore.updatepushStateScroll( {link: plink, post_id: pid, title: ptitle} );
							}

						}, 200);
					}
				});
			},
			showComments: function () {

				$( '.comment-but-text' ).each( function () {
					var $this = $( this );

					$this.on( 'click', function () {
						var id_post = $this.data( 'postid' );
						if ( id_post ) {
							$( '.post-comments-' + id_post ).show();
							$( '.penci-mul-comments-wrapper' + id_post ).show();
							$( '#penci-comments-button-' + id_post ).remove();
						}

						return false;
					} );
				} );
			},
			loadMore: function () {

				var stopLoadMore = false;

				$( window ).on( 'scroll', function () {
					var $this_scroll = $( '.penci-content-single-inner' ),
						$handle = $( '.penci-single-loadmore' ),
						offset = parseInt( $handle.attr( 'data-offset' ) ),
						postId = $handle.attr( 'data-postidcurrent' ),
						postidloaded = $handle.attr( 'data-postidloaded' );

					if ( ! $this_scroll.length || stopLoadMore ) {
						return false;
					}

					var hH = $this_scroll.outerHeight(),
						wH = $( window ).height(),
						wS = $( this ).scrollTop(),
						wHS = wH + 800;

					if ( wS > (hH - wHS ) ) {
						if ( $handle.hasClass( 'loading-posts' ) ) {
							return false;
						}
						$handle.addClass( 'loading-posts' );

						var data = {
							action: 'penci_single_load_more',
							offset: offset,
							postid: postId,
							postidloaded: postidloaded,
							nonce: PENCILOCALIZE.nonce
						};
						$.post( PENCILOCALIZE.ajaxUrl, data, function ( r ) {

							if ( r.data.items ) {
								var $dataPost = $( r.data.items );

								$handle.attr( 'data-offset', offset + parseInt( PENCILOCALIZE.prevNumber ) );
								$handle.attr( 'data-postidloaded', r.data.postidloaded );
								$( "#main .penci-content-post:last" ).after( $dataPost );

								PENCI.singleLoadMore.showComments();
								PENCI.others.PenciTabComment();
								PENCI.general.fitvids( $( ".site-content" ) );
								PENCI.gallery();
								PENCI.sliderOwl( $( '.penci-owl-carousel-slider' ) );

								$( '.penci-owl-carousel-slider' ).trigger( 'next.owl.carousel' );

								PENCI.postLike();
								PENCI.penciVideo();
								PENCI.toggleSocialMedia();
								PENCI.penciLazy();
								PENCI.gallery();
								PENCI.popupGallery();
								PENCI.EasyPieChart();
								if( r.data.psinfo ) {
									r.data.psinfo.forEach(function (obj) {
										PENCI.singleLoadMore.updateCountview( obj.id );
									});
								}
							}else{
								stopLoadMore = true;
							}

							$handle.removeClass( 'loading-posts' );

						} );
					}
				} ).scroll();


			},updatepushStateScroll: function ( data ) {

				if ( data.link ) {
					history.pushState( {}, undefined, data.link );

					if ( typeof _gaq !== 'undefined' && _gaq !== null ) {
						_gaq.push( ['_trackPageview', data.link] );
					}

					if ( typeof ga !== 'undefined' && ga !== null ) {
						ga( 'send', 'pageview', data.link );
					}
				}

				var disqus_thread = $( '#disqus_thread' );
				if ( disqus_thread.length ) {

					var $disqus_container = $('#wordpress-' + data.post_id + '-comment .penci-disqus');

					$('.penci-disqus #disqus_thread').remove();
					$disqus_container.html('<div id="disqus_thread"></div>');

					disqus_thread.fadeOut(100, function() {
						var el = $(this);
						el.appendTo('#wordpress-' + data.post_id + '-comment .penci-disqus').fadeIn(100);
					});

					DISQUS.reset( {
						reload: true,
						config: function () {
							this.page.identifier = data.post_id + ' ' + data.link;
							this.page.url = data.link;
							this.page.title = data.title;
						}
					} );

					var height = $disqus_container.height();
					$disqus_container.css('min-height', height);
				}

			},updateCountview: function( postId ){
				var data = {
					action: 'penci_count_view_load_more',
					postid: postId,
					nonce: PENCILOCALIZE.nonce
				};
				$.post( PENCILOCALIZE.ajaxUrl, data, function ( r ) {
					if ( r.data ) {
						$( '.penci-post-countview-p' + postId ).html( r.data );
					}
				} );
			}};

	PENCI.VideosList = {
		// Init the module
		init: function () {
			PENCI.VideosList.play();
		},
		play: function () {
			$( '.penci-videos-playlist' ).each( function ( idx, item ) {

				var $blockVideo = $( this ),
					$VideoF = $blockVideo.find( '.penci-video-frame' );

				var $height = $blockVideo.find( '.penci-video-nav' ).height(),
					$heightTitle = $blockVideo.find( '.penci-video-nav .penci-playlist-title' ).height()

				$blockVideo.find( '.penci-video-playlist-nav' ).css( 'height', $height - $heightTitle );
				// Init
				$VideoF.video();

				PENCI.VideosList.updateStatus( $blockVideo );

				// Show First video and remove the loader icon
				$VideoF.addVideoEvent( 'ready', function () {
					$VideoF.css( 'visibility', 'visible' ).fadeIn();
					$blockVideo.find( '.loader-overlay' ).remove();
				} );

				// Play videos
				$blockVideo.on( 'click', '.penci-video-playlist-item', function () {

					var $thisVideo = $( this ),
						frameID = $thisVideo.data( 'name' ),
						$thisFrame = $( '#' + frameID ),
						videoSrc = $thisVideo.data( 'src' ),
						videoNum = $thisVideo.find( '.penci-video-number' ).text();

					if ( $thisVideo.hasClass( 'is-playing' ) ) {
						$thisFrame.pauseVideo();
						return;
					}

					// Update the number of the playing video in the title section
					$blockVideo.find( '.penci-video-playing' ).text( videoNum );

					// Pause all Videos
					$blockVideo.find( '.penci-video-frame' ).each( function () {
						$( this ).pauseVideo().hide();
					} )

					// If the iframe not loaded before, add it
					if ( ! $thisFrame.length ) {
						// Add the loader icon
						$blockVideo.find( '.fluid-width-video-wrapper' ).prepend( '' );

						$blockVideo.find( '.fluid-width-video-wrapper' ).append( '<iframe class="penci-video-frame" id="' + frameID + '" src="' + videoSrc + '" frameborder="0" width="100%"" height="434" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>' );
						$thisFrame = $( '#' + frameID );

						$thisFrame.video(); // reinit

						$thisFrame.addVideoEvent( 'ready', function ( e, $thisFrame, video_type ) {
							$thisFrame.playVideo();
							$blockVideo.find( '.loader-overlay' ).remove();
						} );
					} else {
						$thisFrame.playVideo();
					}

					$thisFrame.css( 'visibility', 'visible' ).fadeIn();

					PENCI.VideosList.updateStatus( $blockVideo );

				} );
			} );
		},
		updateStatus: function ( $blockVideo ) {
			$blockVideo.find( '.penci-video-frame' ).each( function () {
				var $this = $( this ),
					$videoItem = $( "[data-name='" + $this.attr( 'id' ) + "']" );

				$this.addVideoEvent( 'play', function () {
					$videoItem.removeClass( 'is-paused' ).addClass( 'is-playing' );
				} );

				$this.addVideoEvent( 'pause', function () {
					$videoItem.removeClass( 'is-playing' ).addClass( 'is-paused' );
				} );

				$this.addVideoEvent( 'finish', function () {
					$videoItem.removeClass( 'is-paused is-playing' );
				} );
			} );
		}
	};
	PENCI.CustomScrollbar = function () {
		if ( ! $.fn.mCustomScrollbar || ! $( '.penci-custom-scroll' ).length ) {
			return false;
		}

		$( '.penci-custom-scroll' ).each( function () {
			var $this = $( this ),
				scroll_height = $this.data( 'height' ) ? $this.data( 'height' ) : 'auto',
				data_padding = $this.data( 'padding' ) ? $this.data( 'padding' ) : 0;

			$this.mCustomScrollbar( 'destroy' );

			if ( $this.data( 'height' ) == 'window' ) {
				var thisHeight = $this.height(),
					windowHeight = $( window ).height() - data_padding - 50;

				scroll_height = (
					thisHeight < windowHeight
				) ? thisHeight : windowHeight;
			}

			$this.mCustomScrollbar( {
				scrollButtons: {enable: false},
				autoHideScrollbar: $this.hasClass( 'show-scroll' ) ? false : true,
				scrollInertia: 100,
				mouseWheel: {
					enable: true,
					scrollAmount: 60,
				},
				set_height: scroll_height,
				advanced: {updateOnContentResize: true},
				callbacks: {
					whileScrolling: function () {
						PENCI.penciLazy();
					}
				}
			} );
		} );
	};

	PENCI.EasyPieChart = function () {

		if ( $( '.penci-review-process' ).length ) {
			$( '.penci-review-process' ).each( function () {
				var $this = $( this ),
					$bar = $this.children(),
					$bar_w = $bar.data( 'width' ) * 10;
				$this.one( 'inview', function ( event, isInView, visiblePartX, visiblePartY ) {
					$bar.animate( {width: $bar_w + '%'}, 1000 );
				} ); // bind inview
			} ); // each
		}

		if ( ! $.fn.easyPieChart || ! $( '.penci-piechart' ).length ) {
			return false;
		}

		$( '.penci-piechart' ).each( function () {
			var $this = $( this );
			$this.one( 'inview', function ( event, isInView, visiblePartX, visiblePartY ) {
				var chart_args = {
					barColor: $this.data( 'color' ),
					trackColor: $this.data( 'trackcolor' ),
					scaleColor: false,
					lineWidth: $this.data( 'thickness' ),
					size: $this.data( 'size' ),
					animate: 1000
				};
				$this.easyPieChart( chart_args );
			} ); // bind inview
		} ); // each
	};

	PENCI.RatingAnimation = function (  ) {
		var $review_rating = $( '.penci-preview-rating' );

		if( ! $review_rating.length ){
			return false;
		}

		$review_rating.each( function () {
			var $this = $( this );
			$this.one( 'inview', function ( event, isInView, visiblePartX, visiblePartY ) {
				var dataRating = $this.attr('data-rating');

				if( 0 != dataRating ){
					$this.find( '.penci-prvrate-active' )
					     .velocity( 'stop' )
					     .velocity( {width: dataRating }, {duration: 650 } );
				}
			} );
		});
	}


	PENCI.ajaxSearch = {
		init: function () {
			if ( ! $( 'body' ).hasClass( 'penci_enable_ajaxsearch' ) ) {
				return false;
			}

			$( '#penci-header-search' ).on( 'keyup', function ( e ) {
				setTimeout( PENCI.ajaxSearch.getSearchResults( $( this ) ), 300 );
			} );

			var $inputSearch = $( '#penci-search-field-mobile' );
			$inputSearch.keydown(function(event) {
				var $this = $( this ),
					eventWhich = event.which,
					eventKeyCode = event.keyCode;

				// Enter
				if ( ( eventKeyCode && 13 === eventKeyCode ) || ( eventWhich && eventWhich === 13 ) ) {
					$this.parent().parent().submit();
				}else{
					// Backspace
					if ( ( eventKeyCode && 8 === eventKeyCode ) || ( eventWhich && eventWhich === 8 ) ) {
						var textSearch = $this.val();
						if ( 1 === textSearch.length ) {
							$inputSearch.empty();
						}
					}

					setTimeout(function(){
						PENCI.ajaxSearch.getSearchResultsMobile( $this, $inputSearch );
					}, 150 );

					return true;
				}

			});
		},
		getSearchResultsMobile: function ( $searchField, $inputSearch ) {

			var textSearch = $inputSearch.val(),
				$resultsWrapper = $( '.penci-ajax-search-results-wrapper' ),
				$closeSearch = $searchField.closest( '.search-form' ).find( '.fa-search' );

			if ( PENCI.ajaxSearch.hideSearchResults( $resultsWrapper, $inputSearch, $closeSearch ) ) {
				return false;
			}
			$closeSearch.addClass( 'ajax-search-loading' );
			if ( $resultsWrapper.hasClass( 'ajax-search-loaded' ) && ! $resultsWrapper.hasClass( 'search-results-hide' ) ) {
				$resultsWrapper.removeClass( 'ajax-search-loaded' ).addClass( 'ajax-loading ' );
			}

			var dataSearch = {
				action: 'penci_ajaxified_search',
				s: textSearch,
				nonce: PENCILOCALIZE.nonce
			};

			$.post( PENCILOCALIZE.ajaxUrl, dataSearch, function ( response ) {

				if ( PENCI.ajaxSearch.hideSearchResults( $resultsWrapper, $searchField, $closeSearch ) ) {
					return false;
				}
				var textSearchCurrent = $searchField.val();

				if ( textSearchCurrent === response.data.textsearch ) {
					$resultsWrapper
						.html( response.data.output )
						.removeClass( 'ajax-loading' )
						.addClass( 'ajax-search-loaded' )
						.removeClass( 'search-results-hide' )
						.show();

					$closeSearch.removeClass( 'ajax-search-loading' ).addClass( 'ajax-search-loaded' );
					PENCI.penciLazy();
					PENCI.general.fitvids( $resultsWrapper );
					PENCI.penciVideo();
					PENCI.EasyPieChart();
				}
			} );
		},
		getSearchResults: function ( $searchField ) {

			var value = $searchField.val(),
				$resultsWrapper = $( '.penci-ajax-search-results-wrapper' ),
				$closeSearch = $searchField.closest( '.search-form' ).find( '.fa-search' );

			$( '.header__search .search-field' ).val( value );

			if ( PENCI.ajaxSearch.hideSearchResults( $resultsWrapper, $searchField, $closeSearch ) ) {
				return false;
			}

			$closeSearch.addClass( 'ajax-search-loading' );

			if ( $resultsWrapper.hasClass( 'ajax-search-loaded' ) && ! $resultsWrapper.hasClass( 'search-results-hide' ) ) {
				$resultsWrapper.removeClass( 'ajax-search-loaded' ).addClass( 'ajax-loading ' );
			}

			var dataSearch = {
				action: 'penci_ajaxified_search',
				s: value,
				nonce: PENCILOCALIZE.nonce
			};

			$.post( PENCILOCALIZE.ajaxUrl, dataSearch, function ( response ) {

				if ( PENCI.ajaxSearch.hideSearchResults( $resultsWrapper, $searchField, $closeSearch ) ) {
					return false;
				}
				var textSearchCurrent = $searchField.val();

				if ( textSearchCurrent === response.data.textsearch ) {
					$resultsWrapper
						.html( response.data.output )
						.removeClass( 'ajax-loading' )
						.addClass( 'ajax-search-loaded' )
						.removeClass( 'search-results-hide' )
						.show();

					$closeSearch.removeClass( 'ajax-search-loading' ).addClass( 'ajax-search-loaded' );
					PENCI.penciLazy();
					PENCI.general.fitvids( $resultsWrapper );
					PENCI.penciVideo();
					PENCI.EasyPieChart();
				}
			} );

		},
		hideSearchResults: function ( $resultsWrapper, $searchField, $closeSearch ) {
			var textSearch = $searchField.val();

			if ( ! textSearch ) {
				$closeSearch.removeClass( 'ajax-search-loading' );
				$resultsWrapper.empty().hide();
				return true;
			}

			return false;
		}
	};
	PENCI.others = {
		init: function () {
			PENCI.others.flexMenu();
			//PENCI.others.countDown();
			PENCI.others.counterUp();
			PENCI.others.PenciWow();
		},

		flexMenu: function () {
			var $subcatList = $( '.penci-subcat-list' );
			$subcatList.flexMenu( {
				linkTitle: PENCILOCALIZE.linkTitle,
				linkTextAll: PENCILOCALIZE.linkTextAll,
				linkText: PENCILOCALIZE.linkText,
			} );

			$(window).on('load',function () {
				$subcatList.addClass( 'penci_loaded' );
			} );
		},
		countDown: function () {
			var $countdown = $( '.penci_countdown' );

			if ( ! $.fn.countdown || ! $countdown.length ) {
				return false;
			}

			$countdown.each( function () {
				var $this = $( this ),
					until = $this.attr( 'data-until' ),
					format = $this.attr( 'data-format' ),
					layout = $this.attr( 'data-layout' ),
					labels = $this.attr( 'data-labels' ),
					labels1 = $this.attr( 'data-labels1' ),
					timezone = $this.attr( 'data-timezone' ),
					newDateTime = new Date( until );

				$this.countdown( {
					labels: labels ? labels : ['Years', 'Months', 'Weeks', 'Days', 'Hours', 'Minutes', 'Seconds'],
					labels1: labels1 ? labels1 : ['Year', 'Month', 'Week', 'Day', 'Hour', 'Minute', 'Second'],
					until: newDateTime,
					timezone: timezone ? timezone : null,
					format: format ? format : 'dHMS',
					layout: layout ? layout : ''
				} );
			} ); // each
		},
		counterUp: function () {
			var $counterup = $( '.penci-counterup-number' );

			if ( ! $.fn.counterUp || ! $counterup.length ) {
				return false;
			}

			$counterup.each( function () {
				var $this = $( this );

				$this.one( 'inview', function ( event, isInView, visiblePartX, visiblePartY ) {
					setTimeout( function () {
						$( {countNum: $this.text()} ).animate(
							{
								countNum: $this.attr( 'data-count' )
							},

							{
								duration: 2000,
								easing: 'linear',
								step: function () {
									$this.text( Math.floor( this.countNum ) );
								},
								complete: function () {
									$this.text( this.countNum );
								}
							}
						);
					}, $this.attr( 'data-delay' ) );


				} ); // bind inview
			} );
		},
		PenciWow: function () {
			var wowPenci = new WOW( {mobile: ! 1} );
			wowPenci.init();
			wowPenci.sync();
		},
		PenciTabComment: function(){
			$( '.penci-mcomments-label-ss' ).each( function () {
				var $this = $( this );
				var $tabNav = $( '.penci-tab-nav' );

				$this.on( 'click', function ( event) {
					event.preventDefault();
					var $this = $( this ),
						$sectionShow = $( $this.attr( 'href' ) ),
						$sectionLoad = $sectionShow.hasClass( 'section_load' );

					$tabNav.find( 'li' ).removeClass( 'active' );
					$this.parent().addClass( 'active' );
					$( '.penci-tab-content div' ).removeClass( 'active' );
					$sectionShow.addClass( 'active' );

					if( $sectionLoad ) {
						var data = {
							action: 'penci_multiple_comments',
							postid: $this.attr( 'data-postID' ),
							type: $this.attr( 'data-type' ),
							nonce: PENCILOCALIZE.nonce
						};
						$.post( PENCILOCALIZE.ajaxUrl, data, function ( r ) {
							var $data = $(r.data);
							$data.hide();
							$sectionShow.append( $data );

							setTimeout( function(){
								$sectionShow.find( '.penci-loader-effect' ).remove();
								$sectionShow.find( '.penci-facebook-comments' ).show();
							},300 );
						} );

						$sectionShow.removeClass( 'section_load' );
					}
					return false;
				} );
			} );

			$( '.comment-but-text-showface' ).each( function () {
				var $this = $( this );
				$this.on( 'click', function ( event) {
					event.preventDefault();
					var $this = $( this ),
						$sectionShow = $( $this.attr( 'href' ) );


					if( $this.hasClass( 'clicked' ) ){
						return false;
					}
					var data = {
						action: 'penci_multiple_comments',
						postid: $this.attr( 'data-postID' ),
						type: $this.attr( 'data-type' ),
						nonce: PENCILOCALIZE.nonce
					};
					$.post( PENCILOCALIZE.ajaxUrl, data, function ( r ) {
						var $data = $(r.data);
						$data.hide();
						$sectionShow.append( $data );

						setTimeout( function(){
							$sectionShow.find( '.penci-loader-effect' ).remove();
							$sectionShow.find( '.penci-facebook-comments' ).show();
						},300 );
					} );

					$this.addClass( 'clicked' );
					return false;
				} );
			} );
		}
	};


	/* Init functions
	 ---------------------------------------------------------------*/
	$(document).ready(function() {
		PENCI.general.init();
		PENCI.sticky.init();
		PENCI.others.init();
		PENCI.ajaxDoBlockRequest.init();
		PENCI.penciVideo();
		PENCI.toggleSocialMedia();
		PENCI.penciLazy();
		PENCI.popupGallery();
		PENCI.sliderSync();
		PENCI.loadMorePost.init();
		PENCI.mega_menu();
		PENCI.sliderOwl( $( '.penci-owl-carousel-slider' ) );
		PENCI.loginRegisterPopup.init();
		PENCI.postLike();
		PENCI.gallery();
		PENCI.portfolio.init();
		PENCI.EasyPieChart();
		PENCI.RatingAnimation();
		PENCI.CustomScrollbar();
		PENCI.VideosList.init();
		PENCI.singleLoadMore.init();
		PENCI.ajaxSearch.init();
		PENCI.Jarallax();
		PENCI.others.PenciTabComment();
	} );
} );
