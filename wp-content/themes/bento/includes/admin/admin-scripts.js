
// Scripts used by the admin elements

(function( $ ) {
	
	$(window).load(function() {
		
		
		// Display grid settings box when Grid page template is chosen 
		$('body').on( 'change', '.editor-page-attributes__template .components-select-control__input', function() {
			if ( $(this).val() == 'grid.php' ) {
				$('#grid_settings_metabox').slideDown();
			} else {
				$('#grid_settings_metabox').slideUp();
			}
		});	
		$('body').on( 'change', '#pageparentdiv #page_template', function() {
			if ( $(this).val() == 'grid.php' ) {
				$('#grid_settings_metabox').slideDown();
			} else {
				$('#grid_settings_metabox').slideUp();
			}
		});
		if ( $('.editor-page-attributes__template .components-select-control__input').val() == 'grid.php' || $('#pageparentdiv #page_template').val() == 'grid.php' ) {
			$('#grid_settings_metabox').show();
		}
		
		
		// Reveal extended page header settings when the respective checkbox is active
		var bento_revealExtheader = function() {
			if ( $('#bento_activate_header').is(':checked') ) {
				$('#cmb2-metabox-post_header_metabox .cmb-row:not(:first-child)').show();
			} else {
				$('#cmb2-metabox-post_header_metabox .cmb-row:not(:first-child)').hide();
			}
		}
		bento_revealExtheader();
		$('#bento_activate_header').change( function() {
			bento_revealExtheader();
		});
		
		
		// Reveal Google Maps header settings when the respective checkbox is active
		var bento_revealMapheader = function() {
			if ( $('#bento_activate_headermap').is(':checked') ) {
				$('#cmb2-metabox-post_headermap_metabox .cmb-row:not(:first-child)').show();
			} else {
				$('#cmb2-metabox-post_headermap_metabox .cmb-row:not(:first-child)').hide();
			}
		}
		bento_revealMapheader();
		$('#bento_activate_headermap').change( function() {
			bento_revealMapheader();
		});
		
			
	});

})( jQuery );