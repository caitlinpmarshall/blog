
// Scripts for the theme customizer

(function( $ ) {
    wp.customize.bind( 'ready', function() {
        
		var c = this;
		
		// Menu configuration related colors
        c( 'bento_menu_config', function( val ) {
			// The logic
			var bentoCustMenuStyles = function( to ) {
				var menubck = c.control( 'bento_primary_menu_background' );
				var menusep = c.control( 'bento_menu_separators' );
				if ( to == 2 ) {
					menubck.toggle( true );
					menusep.toggle( false );
				} else if ( to == 3 ) {
					menubck.toggle( false );
					menusep.toggle( true );
				} else {
					menubck.toggle( false );
					menusep.toggle( false );
				}
			}
			// On load
			bentoCustMenuStyles( val.get() );
			// On parent control change
			val.bind( bentoCustMenuStyles );
		});
		
		// Homepage settings section options
		c( 'show_on_front', function( val ) {
			// Control arrays
			var frontCtl = [
				'bento_front_header_image',
				'bento_front_header_primary_cta_text',
				'bento_front_header_primary_cta_link',
				'bento_front_header_primary_cta_bck_color',
				'bento_front_header_primary_cta_bck_color_hover',
				'bento_front_header_primary_cta_text_color',
				'bento_front_header_secondary_cta_text',
				'bento_front_header_secondary_cta_link',
				'bento_front_header_secondary_cta_color',
				'bento_front_header_secondary_cta_color_hover',
			];
			var blogCtl = [
				'bento_blog_header_image',
				'bento_blog_header_title',
				'bento_blog_header_title_color',
				'bento_blog_header_subtitle',
				'bento_blog_header_subtitle_color',
			];
			// Static front page
			$.each( frontCtl, function( index, id ) {
				c.control( id, function( control ) {
					// The logic
					var bentoCustHomepage = function( to ) {
						if ( to == 'page' ) {
							control.toggle( true );
						} else {
							control.toggle( false );
						}
					};
					// On load
					bentoCustHomepage( val.get() );
					// On parent control change
					val.bind( bentoCustHomepage );
				});
			});
			$.each( blogCtl, function( index, id ) {
				c.control( id, function( control ) {
					// The logic
					var bentoPostsHomepage = function( to ) {
						if ( to == 'posts' ) {
							control.toggle( true );
						} else {
							control.toggle( false );
						}
					};
					// On load
					bentoPostsHomepage( val.get() );
					// On parent control change
					val.bind( bentoPostsHomepage );
				});
			});
		});
		
		// Call-to-Action popup options (Expansion Pack)
		c( 'bento_cta_location', function( val ) {
			// The logic
			var bentoCustExpCtaLoc = function( to ) {
				var ctapage = c.control( 'bento_cta_page' );
				if ( to == 4 ) {
					ctapage.toggle( true );
				} else {
					ctapage.toggle( false );
				}
			}
			// On load
			bentoCustExpCtaLoc( val.get() );
			// On parent control change
			val.bind( bentoCustExpCtaLoc );
		});
		c( 'bento_cta_trigger', function( val ) {
			// The logic
			var bentoCustExpCtaTrig = function( to ) {
				var ctapage = c.control( 'bento_cta_timeonpage' );
				if ( to == 0 ) {
					ctapage.toggle( true );
				} else {
					ctapage.toggle( false );
				}
			}
			// On load
			bentoCustExpCtaTrig( val.get() );
			// On parent control change
			val.bind( bentoCustExpCtaTrig );
		});
		
    } );
})( jQuery );