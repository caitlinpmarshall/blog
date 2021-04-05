<?php // Post settings with metaboxes from CMB2



function bento_metaboxes() {
	
	// Define strings
	$bento_prefix = 'bento_';
	$bento_ep_url = wp_kses( 
		'<a href="http://satoristudio.net/bento-free-wordpress-theme/#expansion-pack/?utm_source=disabled&utm_medium=theme&utm_campaign=theme" target="_blank">Expansion Pack</a>', 
		array(
			'a' => array(
				'href' => array(),
				'target' => array(),
			),
		) 
	);
	
	// Callback to display a field only on single post types
	function bento_show_field_on_single() {
		$current_screen = get_current_screen();
		if ( $current_screen->id == 'page' ) {
			return false;
		} else {
			return true;
		}
	}
	
	// Add a multicheck metabox with post types
	add_action( 'cmb2_render_multicheck_posttype', 'bento_cmb2_render_multicheck_posttype', 10, 5 );
	function bento_cmb2_render_multicheck_posttype( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
		if ( version_compare( CMB2_VERSION, '2.2.2', '>=' ) ) {
			$field_type_object->type = new CMB2_Type_Radio( $field_type_object );
		}
		$cpts = array( 'post', 'project' );
		if ( class_exists( 'WooCommerce' ) ) {
			$cpts[] = 'product';
		}
		$options = '';
		$i = 1;
		$values = (array) $escaped_value;
		if ( $cpts ) {
			foreach ( $cpts as $cpt ) {
				$args = array(
					'value' => $cpt,
					'label' => $cpt,
					'type' => 'checkbox',
					'name' => $field->args['_name'] . '[]',
				);
				if ( in_array( $cpt, $values ) ) {
					$args[ 'checked' ] = 'checked';
				}
				if ( $cpt == 'project' && get_option( 'bento_ep_license_status' ) != 'valid' ) {
					$args[ 'disabled' ] = 'disabled';
				}
				$options .= $field_type_object->list_input( $args, $i );
				$i++;
			}
		}
		$classes = false === $field->args( 'select_all_button' ) ? 'cmb2-checkbox-list no-select-all cmb2-list' : 'cmb2-checkbox-list cmb2-list';
		echo $field_type_object->radio( array( 'class' => $classes, 'options' => $options ), 'multicheck_posttype' );
	}
	
	// Add a drop-down with taxonomies
	add_action( 'cmb2_render_taxonomy_list', 'bento_cmb2_render_taxonomy_list', 10, 5 );
	function bento_cmb2_render_taxonomy_list( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
		$options = '<option value="all">'.__( 'No filtering', 'bento' ).'</option>';
		$tax = get_taxonomies( array( 'public' => true ), 'object' );
		foreach ( $tax as $t ) {
			$terms = get_terms( array( 'taxonomy' => $t->name ) );
			if ( !empty( $terms ) ) {
				$options .= '<option value="'.$t->name.'" disabled>'.$t->labels->name.'</option>';
				foreach ( $terms as $term ) {
					$selected = '';
					$values = (array) $escaped_value;
					if ( in_array( $term->term_id, $values ) ) {
						$selected = ' selected';
					}
					$options .= '<option value="'.$term->term_id.'"'.$selected.'>- '.$term->name.'</option>';
				}
			}
		}		
		echo $field_type_object->select( array( 'options' => $options ), 'taxonomy_list' );
	}
	
	// General page/post settings
	$bento_general_settings = new_cmb2_box( 
		array(
			'id'            => 'post_settings_metabox',
			'title'         => esc_html__( 'General Settings', 'bento' ),
			'object_types'  => array( 'post', 'page', 'project', 'product' ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names' => true,
		) 
	);
	$bento_sidebar_current_default_text = ' ('.esc_html__( 'current default', 'bento' ).')';
	$bento_sidebar_current_default_0 = $bento_sidebar_current_default_1 = $bento_sidebar_current_default_2 = '';
	$bento_sidebar_sitewide_default = esc_html( get_theme_mod( 'bento_default_sidebar' ) );
	if ( $bento_sidebar_sitewide_default == 1 ) {
		$bento_page_sidebar_default = 'left-sidebar';
		$bento_sidebar_current_default_1 = $bento_sidebar_current_default_text;
	} else if ( $bento_sidebar_sitewide_default == 2 ) {
		$bento_page_sidebar_default = 'full-width';
		$bento_sidebar_current_default_2 = $bento_sidebar_current_default_text;
	} else {
		$bento_page_sidebar_default = 'right-sidebar';
		$bento_sidebar_current_default_0 = $bento_sidebar_current_default_text;
	}
	$bento_general_settings->add_field(
		array(
			'name' => esc_html__( 'Sidebar layout', 'bento' ),
			'desc' => esc_html__( 'Choose whether to display a sidebar and on which side of the content', 'bento' ),
			'id' => $bento_prefix . 'sidebar_layout',
			'type' => 'select',
			'options' => array(
				'right-sidebar' => esc_html__( 'Right Sidebar', 'bento' ).$bento_sidebar_current_default_0,
				'left-sidebar' => esc_html__( 'Left Sidebar', 'bento' ).$bento_sidebar_current_default_1,
				'full-width' => esc_html__( 'Full Width', 'bento' ).$bento_sidebar_current_default_2,
			),
			'default' => $bento_page_sidebar_default,
		)
	);
	$bento_general_settings->add_field(
		array(
			'name' => esc_html__( 'Page background color', 'bento' ),
			'desc' => esc_html__( 'Choose the background color for current page/post. This will override any settings in the Theme Options', 'bento' ),
			'id' => $bento_prefix . 'page_background_color',
			'type' => 'colorpicker',
		)
	);
	$bento_general_settings->add_field(
		array(
			'name' => esc_html__( 'Hide featured image', 'bento' ),
			'desc' => esc_html__( 'Check this option if you DO NOT want to display the featured image (thumbnail) on the page; it will still be used for the corresponding tile on the "columns" or "rows" grid pages.', 'bento' ),
			'id' => $bento_prefix . 'hide_thumb',
			'type' => 'checkbox',
			'show_on_cb' => 'bento_show_field_on_single'
		)
	);
	$bento_general_settings->add_field(
		array(
			'name' => esc_html__( 'Hide title', 'bento' ),
			'desc' => esc_html__( 'Check this option if you DO NOT want to display the title on the page', 'bento' ),
			'id' => $bento_prefix . 'hide_title',
			'type' => 'checkbox',
		)
	);
	$bento_general_settings->add_field(
		array(
			'name' => esc_html__( 'Uppercase title', 'bento' ),
			'desc' => esc_html__( 'Check this option if you want the page title to be entirely in uppercase (useful for landing pages).', 'bento' ),
			'id' => $bento_prefix . 'uppercase_title',
			'type' => 'checkbox',
		)
	);
	$bento_general_settings->add_field(
		array(
			'name' => esc_html__( 'Title position', 'bento' ),
			'desc' => esc_html__( 'Choose the position of the title; default is left-aligned.', 'bento' ),
			'id' => $bento_prefix . 'title_position',
			'type' => 'select',
			'options' => array(
				'left' => esc_html__( 'Left-aligned (default)', 'bento' ),
				'center' => esc_html__( 'Centered', 'bento' ),
			),
			'default' => 'left',
		)
	);
	$bento_general_settings->add_field(
		array(
			'name' => esc_html__( 'Title color', 'bento' ),
			'desc' => esc_html__( 'Choose the text color for the title of this post. This will override any settings in the Theme Options', 'bento' ),
			'id' => $bento_prefix . 'title_color',
			'type' => 'colorpicker',
		)
	);
	$bento_general_settings->add_field(
		array(
			'name' => esc_html__( 'Subtitle (excerpt) color', 'bento' ),
			'desc' => esc_html__( 'Choose the text color for the subtitle of this page, sourced from the Excerpt field; default is #999999 (light grey).', 'bento' ),
			'id' => $bento_prefix . 'subtitle_color',
			'type' => 'colorpicker',
			'default' => '#999999',
		)
	);
	
	// Extended header settings
	$bento_header_settings = new_cmb2_box( 
		array(
			'id'            => 'post_header_metabox',
			'title'         => esc_html__( 'Page Header Settings', 'bento' ),
			'object_types'  => array( 'post', 'page', 'project', 'product' ),
			'context'       => 'normal',
			'priority'      => 'low',
			'show_names' => true,
		) 
	);
	$bento_header_settings->add_field(
		array(
			'name' => esc_html__( 'Activate extended header', 'bento' ),
			'desc' => esc_html__( 'Check this box to enable extended header options such as header image and call-to-action-buttons.', 'bento' ),
			'id' => $bento_prefix . 'activate_header',
			'type' => 'checkbox',
		)
	);
	$bento_header_settings->add_field(
		array(
			'name' => esc_html__( 'Header height', 'bento' ),
			'desc' => esc_html__( 'Choose the title top and bottom padding, which will affect the header height; default is 10%', 'bento' ),
			'id' => $bento_prefix . 'header_image_height',
			'type' => 'select',
			'options' => array(
				'' => esc_html__( 'Choose value', 'bento' ),
				'5%' => '5%',
				'10%' => esc_html__( '10% (default)', 'bento' ),
				'15%' => '15%',
				'20%' => '20%',
				'25%' => '25%',
				'30%' => '30%',
				'fh' => esc_html__( 'Full screen height', 'bento' ),
			),
			'default' => '10%',
		)
	);
	if ( get_option( 'bento_ep_license_status' ) == 'valid' ) {
		$bento_header_settings->add_field(
			array(
				'name' => esc_html__( 'Header image', 'bento' ),
				'desc' => esc_html__( 'Upload the image to serve as the header; recommended size is 1400x300 pixels and above, yet mind the file size - excessively large images may worsen user experience', 'bento' ),
				'id' => $bento_prefix . 'header_image',
				'type' => 'file',
			)
		);
	}
	if ( get_option( 'bento_ep_license_status' ) == 'valid' ) {
		$bento_header_settings->add_field(
			array(
				'name' => esc_html__( 'Header video', 'bento' ),
				'desc' => esc_html__( 'Upload the video file to be used as header background; if this is active, the header image will serve as a placeholder for mobile devices; .mp4 files are recommended, but you can also use .ogv and .webm formats. Please mind the file size - excessively large images may worsen user experience', 'bento' ),
				'id' => $bento_prefix . 'header_video_source',
				'type' => 'file',
			)
		);
	}
	$bento_header_settings->add_field(
		array(
			'name' => esc_html__( 'Header image overlay color', 'bento' ),
			'desc' => esc_html__( 'Choose the color for the image overlay, designed to make the title text stand out more clearly', 'bento' ),
			'id' => $bento_prefix . 'header_overlay',
			'type' => 'colorpicker',
		)
	);
	$bento_header_settings->add_field(
		array(
			'name' => esc_html__( 'Header image overlay opacity', 'bento' ),
			'desc' => esc_html__( 'Choose the opacity level for the image overlay; 0.0 is fully transparent, 1.0 is fully opaque, default is 0.3', 'bento' ),
			'id' => $bento_prefix . 'header_overlay_opacity',
			'type' => 'select',
			'options' => array(
				'0' => '0.0',
				'1' => '0.1',
				'2' => '0.2',
				'3' => esc_html__( '0.3 (default)', 'bento' ),
				'4' => '0.4',
				'5' => '0.5',
				'6' => '0.6',
				'7' => '0.7',
				'8' => '0.8',
				'9' => '0.9',
				'10' => '1.0',
			),
			'default' => '0.3',
			'show_option_none' => esc_html__( 'Choose value', 'bento' ),
		)
	);
	$bento_header_settings->add_field(
		array(
			'name' => esc_html__( 'Transparent website header', 'bento' ),
			'desc' => esc_html__( 'Check this option to make the website header (the top area with the menu and the logo) look like a transparent overlay on top of the header image on this page.', 'bento' ),
			'id' => $bento_prefix . 'transparent_header',
			'type' => 'checkbox',
		)
	);
	$bento_header_settings->add_field(
		array(
			'name' => esc_html__( 'Website menu color on this page', 'bento' ),
			'desc' => esc_html__( 'Choose the color for the website menu on this page (useful for the transparent header).', 'bento' ),
			'id' => $bento_prefix . 'menu_color',
			'type' => 'colorpicker',
		)
	);
	$bento_header_settings->add_field(
		array(
			'name' => esc_html__( 'Website menu mouse-hover color on this page', 'bento' ),
			'desc' => esc_html__( 'Choose the mouse-over color for the website menu on this page (useful for the transparent header).', 'bento' ),
			'id' => $bento_prefix . 'menu_color_hover',
			'type' => 'colorpicker',
		)
	);
	
	// Map header settings
	if ( get_option( 'bento_ep_license_status' ) == 'valid' ) {
		$bento_headermap_settings = new_cmb2_box( 
			array(
				'id'            => 'post_headermap_metabox',
				'title'         => esc_html__( 'Map Header', 'bento' ),
				'object_types'  => array( 'page', 'post' ),
				'context'       => 'normal',
				'priority'      => 'low',
				'show_names' => true,
			) 
		);
		$bento_headermap_settings->add_field(
			array(
				'name' => esc_html__( 'Activate Google Maps header', 'bento' ),
				'desc' => esc_html__( 'Check this box to enable Google Maps header; note that this will deactivate the extended header image/video.', 'bento' ),
				'id' => $bento_prefix . 'activate_headermap',
				'type' => 'checkbox',
			)
		);
		$maps_key_url = 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key';
		$maps_key_text = sprintf( wp_kses( esc_html__( 'Input the API key for this instance of Maps - you can find detailed instructions on generating your API key <a href="%s" target="_blank">here</a>.', 'bento' ), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( $maps_key_url ) );
		$bento_headermap_settings->add_field(
			array(
				'name' => esc_html__( 'Google Maps API key', 'bento' ),
				'desc' => $maps_key_text,
				'id' => $bento_prefix . 'headermap_key',
				'type' => 'text',
			)
		);
		$bento_headermap_settings->add_field(
			array(
				'name' => esc_html__( 'Map center location', 'bento' ),
				'desc' => esc_html__( 'Input the address (country, city, or exact address) of the location on which to center the map.', 'bento' ),
				'id' => $bento_prefix . 'headermap_center',
				'type' => 'text',
			)
		);
		$bento_headermap_settings->add_field(
			array(
				'name' => esc_html__( 'Map height', 'bento' ),
				'desc' => esc_html__( 'Select the height of the map, in pixels.', 'bento' ),
				'id' => $bento_prefix . 'headermap_height',
				'type' => 'select',
				'options' => array(
					'100' => '100',
					'200' => '200',
					'300' => '300',
					'400' => esc_html__( '400 (default)', 'bento' ),
					'500' => '500',
					'600' => '600',
					'700' => '700',
				),
				'default' => '400',
			)
		);
		$bento_headermap_settings->add_field(
			array(
				'name' => esc_html__( 'Map zoom level', 'bento' ),
				'desc' => esc_html__( 'Choose the zoom level for the map, 1 being entire world and 20 being individual buildings.', 'bento' ),
				'id' => $bento_prefix . 'headermap_zoom',
				'type' => 'select',
				'options' => array(
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
					5 => '5',
					6 => '6',
					7 => '7',
					8 => '8',
					9 => '9',
					10 => '10',
					11 => '11',
					12 => '12',
					13 => '13',
					14 => '14',
					15 => esc_html__( '15 (default)', 'bento' ),
					16 => '16',
					17 => '17',
					18 => '18',
					19 => '19',
					20 => '20',
				),
				'default' => 15,
			)
		);
		$snazzymaps_url = 'https://snazzymaps.com';
		$snazzymaps_link = sprintf( wp_kses( esc_html__( 'You can insert the code for custom map styling here; check <a href="%s" target="_blank">Snazzymaps.com</a> for ready-made snippets: when on the page of the particular style, click on the "Copy" button or simply select and copy the code under the "Javascript Style Array" heading.', 'bento' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $snazzymaps_url ) );
		$bento_headermap_settings->add_field(
			array(
				'name' => esc_html__( 'Map custom style', 'bento' ),
				'desc' => $snazzymaps_link,
				'id' => $bento_prefix . 'headermap_style',
				'type' => 'textarea',
			)
		);
	}
	
	// Masonry tile settings
	$bento_tile_settings = new_cmb2_box( 
		array(
			'id'            => 'tile_settings_metabox',
			'title'         => esc_html__( 'Masonry Tile Settings / Only for displaying on "Grid" page template with "Masonry" grid type', 'bento' ),
			'object_types'  => array( 'post', 'project', 'product' ),
			'context'       => 'normal',
			'priority'      => 'low',
			'show_names'	=> true,
		) 
	);
	$bento_tile_settings->add_field(
		array(
			'name' => esc_html__( 'Tile size', 'bento' ),
			'desc' => esc_html__( 'Choose the size of the tile relative to the default 1x1 tile (defined by the number of columns in the grid)', 'bento' ),
			'id' => $bento_prefix . 'tile_size',
			'type' => 'select',
			'options' => array(
				'1x1' => esc_html__( '1x1 (default)', 'bento' ),
				'1x2' => '1x2',
				'2x1' => '2x1',
				'2x2' => '2x2',
			),
			'default' => '1x1',
		)
	);
	$bento_tile_settings->add_field(
		array(
			'name' => esc_html__( 'Tile overlay color', 'bento' ),
			'desc' => esc_html__( 'Choose the color for an overlay for the tile background image; default is #666666 (grey)', 'bento' ),
			'id' => $bento_prefix . 'tile_overlay_color',
			'type' => 'colorpicker',
			'default' => '#666666',
		)
	);
	if ( get_option( 'bento_ep_license_status' ) == 'valid' ) {
		$bento_tile_settings->add_field(
			array(
				'name' => esc_html__( 'Tile image', 'bento' ),
				'desc' => esc_html__( 'Upload the image to be used in the tile; if this field is empty, the featured image (thumbnail) will be used.', 'bento' ),
				'id' => $bento_prefix . 'tile_image',
				'type' => 'file',
			)
		);
	}
	$bento_tile_settings->add_field(
		array(
			'name' => esc_html__( 'Tile overlay opacity', 'bento' ),
			'desc' => esc_html__( 'Select the opacity level for an overlay for the tile background image, 0 is fully transparent (default is 0.6)', 'bento' ),
			'id' => $bento_prefix . 'tile_overlay_opacity',
			'type' => 'select',
			'options' => array(
				'0' => '0.0',
				'1' => '0.1',
				'2' => '0.2',
				'3' => '0.3',
				'4' => '0.4',
				'5' => '0.5',
				'6' => esc_html__( '0.6 (default)', 'bento' ),
				'7' => '0.7',
				'8' => '0.8',
				'9' => '0.9',
				'10' => '1.0',
			),
			'default' => '0.6',
			'show_option_none' => esc_html__( 'Choose value', 'bento' ),
		)
	);
	$bento_tile_settings->add_field(
		array(
			'name' => esc_html__( 'Tile text color', 'bento' ),
			'desc' => esc_html__( 'Choose the color for the text inside the tile; default is #ffffff (white)', 'bento' ),
			'id' => $bento_prefix . 'tile_text_color',
			'type' => 'colorpicker',
			'default' => '#ffffff',
		)
	);
	$bento_tile_settings->add_field(
		array(
			'name' => esc_html__( 'Tile text size', 'bento' ),
			'desc' => esc_html__( 'Choose the text size for the tile; default is 16px', 'bento' ),
			'id' => $bento_prefix . 'tile_text_size',
			'type' => 'select',
			'options' => array(
				'12' => '12',
				'13' => '13',
				'14' => '14',
				'16' => esc_html__( '16 (default)', 'bento' ),
				'18' => '18',
				'20' => '20',
				'24' => '24',
				'28' => '28',
			),
			'default' => '16',
		)
	);
	
	// Grid page settings
	$bento_grid_settings = new_cmb2_box( 
		array(
			'id'            => 'grid_settings_metabox',
			'title'         => esc_html__( 'Grid Settings', 'bento' ),
			'object_types'  => array( 'page' ),
			'context'       => 'normal',
			'priority'      => 'low',
			'show_names'	=> true,
		) 
	);
	$bento_grid_settings->add_field(
		array(
			'name' => esc_html__( 'Grid mode', 'bento' ),
			'desc' => esc_html__( 'Choose which grid type to use on this page', 'bento' ),
			'id' => $bento_prefix . 'page_grid_mode',
			'type' => 'select',
			'options' => array(
				'columns' => esc_html__( 'Columns', 'bento' ),
				'masonry' => esc_html__( 'Masonry', 'bento' ),
				'rows' => esc_html__( 'Rows', 'bento' ),
			),
			'default' => 'columns',
		)
	);
	$bento_grid_settings->add_field(
		array(
			'name' => esc_html__( 'Number of columns', 'bento' ),
			'desc' => esc_html__( 'Select the number of columns in the grid or number of base tiles per line in masonry', 'bento' ),
			'id' => $bento_prefix . 'page_columns',
			'type' => 'select',
			'options' => array(
				'1' => '1',
				'2' => '2',
				'3' => esc_html__( '3 (default)', 'bento' ),
				'4' => '4',
				'5' => '5',
				'6' => '6',
			),
			'default' => '3',
		)
	);
	if ( get_option( 'bento_ep_license_status' ) == 'valid' ) {
		$bento_grid_settings->add_field(
			array(
				'name' => esc_html__( 'Content types', 'bento' ),
				'id' => $bento_prefix . 'page_content_types',
				'type' => 'multicheck_posttype',
				'default' => 'post',
			)
		);
	} else {
		$bento_grid_settings->add_field(
			array(
				'name' => esc_html__( 'Content types', 'bento' ),
				'desc' => sprintf( esc_html__( 'Install the %s to use the "project" (portfolio) content type', 'bento' ), $bento_ep_url ),
				'id' => $bento_prefix . 'page_content_types',
				'type' => 'multicheck_posttype',
				'default' => 'post',
			)
		);
	}
	$bento_grid_settings->add_field(
		array(
			'name' => esc_html__( 'Items per page', 'bento' ),
			'desc' => esc_html__( 'Input the number of items to display per page; default is the number set in "Settings - Reading" admin section', 'bento' ),
			'id' => $bento_prefix . 'page_number_items',
			'type' => 'text_small',
			'default' => '10',
		)
	);
	$bento_grid_settings->add_field(
		array(
			'name' => esc_html__( 'Filter by taxonomy', 'bento' ),
			'desc' => esc_html__( 'Select the category, tag, etc, to be used as a filter for this grid; note that in case your chosen content type does not appear in that taxonomy, you might get an empty grid', 'bento' ),
			'id' => $bento_prefix . 'filter_taxonomy',
			'type' => 'taxonomy_list',
			'default' => 'all',
		)
	);
	$bento_grid_settings->add_field(
		array(
			'name' => esc_html__( 'Order grid items by', 'bento' ),
			'desc' => esc_html__( 'Choose the method for ordering the grid elements', 'bento' ),
			'id' => $bento_prefix . 'orderby_grid',
			'type' => 'select',
			'options' => array(
				'date_created' => esc_html__( 'Created date (default)', 'bento' ),
				'modified' => esc_html__( 'Last modified', 'bento' ),
				'title' => esc_html__( 'Post title', 'bento' ),
				'comment_count' => esc_html__( 'Comment count', 'bento' ),
			),
			'default_cb' => 'date_created',
		)
	);
	$bento_grid_settings->add_field(
		array(
			'name' => esc_html__( 'Ordering direction', 'bento' ),
			'desc' => esc_html__( 'Choose whether the grid items are displayed in ascending or descending order', 'bento' ),
			'id' => $bento_prefix . 'order_grid',
			'type' => 'select',
			'options' => array(
				'DESC' => esc_html__( 'Descending (default)', 'bento' ),
				'ASC' => esc_html__( 'Ascending', 'bento' ),
			),
			'default_cb' => 'DESC',
		)
	);
	$bento_grid_settings->add_field(
		array(
			'name' => esc_html__( 'Item margins', 'bento' ),
			'desc' => esc_html__( 'Input the margin width in pixels (default is 10)', 'bento' ),
			'id' => $bento_prefix . 'page_item_margins',
			'type' => 'text_small',
			'default' => '10',
		)
	);
	$bento_grid_settings->add_field(
		array(
			'name' => esc_html__( 'Hide tile overlays', 'bento' ),
			'desc' => esc_html__( 'Only display tile overlays in masonry on mouse hover', 'bento' ),
			'id' => $bento_prefix . 'hide_tile_overlays',
			'type' => 'checkbox',
		)
	);
	$bento_grid_settings->add_field(
		array(
			'name' => esc_html__( 'Force full width', 'bento' ),
			'desc' => esc_html__( 'Check this option if you want the grid to stretch the entire width of the screen', 'bento' ),
			'id' => $bento_prefix . 'grid_full_width',
			'type' => 'checkbox',
		)
	);
	$bento_grid_settings->add_field(
		array(
			'name' => esc_html__( 'Load items on same page', 'bento' ),
			'desc' => esc_html__( 'Replace the standard pagination with a button which loads next items without refreshing the page', 'bento' ),
			'id' => $bento_prefix . 'page_ajax_load',
			'type' => 'checkbox',
		)
	);
	
	// SEO settings
	if ( get_option( 'bento_ep_license_status' ) == 'valid' ) {
		$bento_seo_settings = new_cmb2_box( 
			array(
				'id'            => 'seo_settings_metabox',
				'title'         => esc_html__( 'SEO Settings', 'bento' ),
				'object_types'  => array( 'post', 'page', 'project', 'product' ),
				'context'       => 'normal',
				'priority'      => 'low',
				'show_names'	=> true,
			) 
		);
		$bento_seo_settings->add_field(
			array(
				'name' => esc_html__( 'Meta title', 'bento' ),
				'desc' => esc_html__( 'Input the meta title - the text to be used by search engines as well as browser tabs (recommended max length - 60 symbols); the post title will be used by default if this field is empty.', 'bento' ),
				'id' => $bento_prefix . 'meta_title',
				'type' => 'text',
			)
		);
		$bento_seo_settings->add_field(
			array(
				'name' => esc_html__( 'Meta description', 'bento' ),
				'desc' => esc_html__( 'Input the meta description - the text to be used by search engines on search result pages (recommended max length - 160 symbols); the first part of the post body will be used by default is this field is left blank.', 'bento' ),
				'id' => $bento_prefix . 'meta_description',
				'type' => 'textarea',
				'attributes' => array(
					'rows' => 3,
				),
			)
		);
	}
	
}

?>