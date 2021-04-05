<?php // Customizer options for Bento


// Extra styles
function bento_customizer_stylesheet() {
	
	// Stylesheet
	wp_enqueue_style( 'bento-customizer-css', get_template_directory_uri().'/includes/customizer/customizer-styles.css', NULL, NULL, 'all' );
	
	// Extra styles
	wp_add_inline_style( 'bento-customizer-css', bento_customizer_extra_css() );
	
}

// Add extra CSS
function bento_customizer_extra_css() {
	$extra_styles = '';
	if ( get_option( 'bento_ep_license_status' ) != 'valid' ) {
		$extra_styles = '
			#accordion-section-bento_seo .accordion-section-title:after,
			#accordion-section-bento_analytics .accordion-section-title:after,
			#accordion-section-bento_cta_popup .accordion-section-title:after,
			#accordion-section-bento_preloader .accordion-section-title:after {
				content: "\f511";
				color: #ff8c00;
			}
		';
	}
	return $extra_styles;
}


// Custom scripts
function bento_customizer_scripts() {
	
	// Enqueue the script file
	wp_enqueue_script( 'bento-customizer-scripts', get_template_directory_uri().'/includes/customizer/customizer-scripts.js', array( 'customize-controls','jquery' ), null, true );
	
	// Passing php variables to admin scripts
	bento_localize_customizer_scripts();
	
}


// Additional Customizer content
function bento_localize_customizer_scripts() {
	$bento_license_status = 'invalid';
	if ( get_option( 'bento_ep_license_status' ) == 'valid' ) {
		$bento_license_status = 'valid';
	}
	wp_localize_script( 'bento-customizer-scripts', 'bentoCustomizerVars', array(
		'exp' => esc_html__( 'Get the Expansion Pack', 'bento' ),
		'review' => esc_html__( 'Rate the theme (thanks!)', 'bento' ),
		'license_status' => esc_html( $bento_license_status ),
	) );
}


// Rename existing sections
function bento_customizer_rename_sections( $wp_customize ) {
    $wp_customize -> get_section('colors') -> title = __( 'Site Colors', 'bento' );
	$wp_customize -> get_control('background_color') -> description = __( 'For this to have effect, the "boxed" mode should be set in the "Site layout" section. This setting will be overridden if a background image is defined in the "Site Background" section.', 'bento' );
	$wp_customize -> get_section('background_image') -> title = __( 'Site Background Image', 'bento' );
	$wp_customize -> get_section('background_image') -> description = __( 'For this to have effect, the "boxed" mode should be set in the "Site layout" section.', 'bento' );
}


// Sanitize copyright field
function bento_sanitize_copyright( $input ) {
	$allowed_html = array(
		'a' => array(
			'href' => array(),
			'target' => array(),
		),
		'span' => array(),
		'div' => array(),
	);
	$input = wp_kses( $input, $allowed_html );
	return $input;
}


// Sanitize font uploads
function bento_sanitize_font_uploads( $input ) {
    $output = '';
    $filetype = wp_check_filetype( $input );
	$allowed_types = array( 'image/svg+xml', 'application/x-font-ttf', 'application/x-font-opentype', 'application/font-woff', 'application/vnd.ms-fontobject' );
    $mime_type = $filetype['type'];
    if ( in_array( $mime_type, $allowed_types ) ) {
        $output = $input;
		$output = esc_url($output);
    }
    return $output;
}


// Sanitize checkboxes
function bento_sanitize_checkboxes( $input ) {
	if ( $input == 1 ) {
        return 1;
    } else {
        return 0;
    }
}


// Sanitize select drop-downs
function bento_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}


// Controls
function bento_customize_register( $wp_customize ) {
	
	
	// Custom help section
	class Bento_WP_Help_Customize_Control extends WP_Customize_Control {
		public $type = 'text_help';
		public function render_content() {
			$bento_ep_activated = '';
			if ( get_option( 'bento_ep_license_status' ) == 'valid' ) {
				$bento_ep_activated = 'bnt-customizer-ep-active';
			}
			echo '
				<div class="bnt-customizer-help '.$bento_ep_activated.'">
					<a class="bnt-customizer-link bnt-rate-link" href="https://wordpress.org/support/theme/bento/reviews/" target="_blank">
						<span class="dashicons dashicons-heart">
						</span>
						'.esc_html__( 'Rate Bento (thanks!)', 'bento' ).'
					</a>
					<a class="bnt-customizer-link bnt-support-link" href="http://satoristudio.net/bento-manual/" target="_blank">
						<span class="dashicons dashicons-book">
						</span>
						'.esc_html__( 'View theme manual', 'bento' ).'
					</a>
					<a class="bnt-customizer-link bnt-support-link" href="https://wordpress.org/support/theme/bento/" target="_blank">
						<span class="dashicons dashicons-sos">
						</span>
						'.esc_html__( 'Visit support forum', 'bento' ).'
					</a>
				</div>
			';
		}
	}
	
	
	// Theme support
	
	$wp_customize->add_section( 
		'bento_theme_support', 
		array(
			'title' => esc_html__( 'Manual & Help', 'bento' ),
			'priority' => 19,
		) 
	);
	
	$wp_customize->add_setting( 
		'bento_support', 
		array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		new Bento_WP_Help_Customize_Control(
		$wp_customize,
		'bento_support', 
			array(
				'section' => 'bento_theme_support',
				'type' => 'text_help',
			)
		)
	);
	
	
	// Site Identity
	
	$wp_customize->add_setting( 
		'bento_logo_mobile', 
		array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'bento_logo_mobile', 
			array(
				'section' => 'title_tagline',
				'priority' => 9,
				'mime_type' => 'image',
				'label' => esc_html__( 'Logo for mobile devices (optional)', 'bento' ),
				'description' => esc_html__( 'Upload the image to be used as the logo on smartphones and tablets (i.e. all devices with screens smaller than 1280px). Leave this blank to use the default logo above.', 'bento' ),
			) 
		) 
	);
	
	$wp_customize->add_setting( 
		'bento_logo_padding', 
		array(
			'type' => 'theme_mod',
			'default' => 30,
			'sanitize_callback' => 'bento_sanitize_choices',
		)
	);
	$wp_customize->add_control( 
		'bento_logo_padding', 
		array(
			'section' => 'title_tagline',
			'priority' => 9,
			'type' => 'select',
			'choices' => array( 
				0 => '0',
				10 => '10', 
				20 => '20',
				30 => esc_html__( '30 (default)', 'bento' ),
				40 => '40',
				50 => '50',
				60 => '60',
			),
			'label' => esc_html__( 'Logo padding', 'bento' ),
			'description' => esc_html__( 'Set the top and bottom padding (extra space) for the logo, in pixels; default is 30.', 'bento' ),
		)
	);
	
	if ( get_option( 'bento_ep_license_status' ) == 'valid' ) {
		$wp_customize->add_setting( 
			'bento_footer_copyright', 
			array(
				'type' => 'theme_mod',
				'default' => '',
				'sanitize_callback' => 'bento_sanitize_copyright',
			)
		);
		$wp_customize->add_control(
			'bento_footer_copyright', 
			array(
				'section' => 'title_tagline',
				'priority' => 100,
				'type' => 'text',
				'label' => esc_html__( 'Copyright message in the footer', 'bento' ),
				'description' => esc_html__( 'Use this field to add your own message instead of the theme link in the footer.', 'bento' ),
			)
		);
	}
	
	// Site Elements
	
	$wp_customize->add_section( 
		'bento_site_elements', 
		array(
			'title' => esc_html__( 'Site Elements', 'bento' ),
			'priority' => 21,
		) 
	);
	
	$wp_customize->add_setting( 
		'bento_author_meta', 
		array(
			'type' => 'theme_mod',
			'default' => 0,
			'sanitize_callback' => 'bento_sanitize_checkboxes',
		)
	);
	$wp_customize->add_control( 
		'bento_author_meta', 
		array(
			'section' => 'bento_site_elements',
			'type' => 'checkbox',
			'label' => esc_html__( 'Hide author block below posts', 'bento' ),
			'description' => esc_html__( 'Check this option to stop displaying the author information in blog posts, below the content.', 'bento' ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_ajax_pagination', 
		array(
			'type' => 'theme_mod',
			'default' => 0,
			'sanitize_callback' => 'bento_sanitize_checkboxes',
		)
	);
	$wp_customize->add_control( 
		'bento_ajax_pagination', 
		array(
			'section' => 'bento_site_elements',
			'type' => 'checkbox',
			'label' => esc_html__( 'Load posts on the same page in blog', 'bento' ),
			'description' => esc_html__( 'Enable this to replace the standard blog pagination with a "Load more" button that does not reload the page.', 'bento' ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_fixed_header', 
		array(
			'type' => 'theme_mod',
			'default' => 0,
			'sanitize_callback' => 'bento_sanitize_checkboxes',
		)
	);
	$wp_customize->add_control( 
		'bento_fixed_header', 
		array(
			'section' => 'bento_site_elements',
			'type' => 'checkbox',
			'label' => esc_html__( 'Fix header on top of page on scroll', 'bento' ),
			'description' => esc_html__( 'Check this option if you wish to fix the header to the top of the screen while the website is being scrolled.', 'bento' ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_mobile_menu_submenus', 
		array(
			'type' => 'theme_mod',
			'default' => 0,
			'sanitize_callback' => 'bento_sanitize_checkboxes',
		)
	);
	$wp_customize->add_control( 
		'bento_mobile_menu_submenus', 
		array(
			'section' => 'bento_site_elements',
			'type' => 'checkbox',
			'label' => esc_html__( 'Hide submenu items in mobile menu', 'bento' ),
			'description' => esc_html__( 'Check this option to only display top-level items in the mobile menu.', 'bento' ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_wc_shop_number_items', 
		array(
			'type' => 'theme_mod',
			'default' => 12,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control( 
		'bento_wc_shop_number_items', 
		array(
			'section' => 'bento_site_elements',
			'type' => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 999,
				'step' => 1,
			),
			'active_callback' => 'bento_woo_active',
			'label' => esc_html__( 'Number of products per shop page (WooCommerce only)', 'bento' ),
			'description' => esc_html__( 'Indicate the number of products to be displayed per page in the WooCommerce shop page; default is 12. Note that the WooCommerce plugin is not part of the theme needs to be installed separately.', 'bento' ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_wc_shop_columns', 
		array(
			'type' => 'theme_mod',
			'default' => 4,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control( 
		'bento_wc_shop_columns', 
		array(
			'section' => 'bento_site_elements',
			'type' => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 6,
				'step' => 1,
			),
			'active_callback' => 'bento_woo_active',
			'label' => esc_html__( 'Number of columns on the shop page (WooCommerce only)', 'bento' ),
			'description' => esc_html__( 'Input the number of columns for the WooCommerce shop page; default is 4; Note that the WooCommerce plugin is not part of the theme needs to be installed separately.', 'bento' ),
		)
	);
	
	// Layout and Background
	
	$wp_customize->add_section( 
		'bento_layout_background', 
		array(
			'title' => esc_html__( 'Site Layout', 'bento' ),
			'priority' => 23,
		) 
	);
	
	$wp_customize->add_setting( 
		'bento_content_width', 
		array(
			'type' => 'theme_mod',
			'default' => 1080,
			'sanitize_callback' => 'bento_sanitize_choices',
		)
	);
	$wp_customize->add_control( 
		'bento_content_width', 
		array(
			'section' => 'bento_layout_background',
			'type' => 'select',
			'choices' => array( 
				900 => '900',
				960 => '960', 
				1020 => '1020',
				1080 => esc_html__( '1080 (default)', 'bento' ),
				1140 => '1140',
				1200 => '1200',
				1260 => '1260',
				1320 => '1320'
			),
			'label' => esc_html__( 'Content width', 'bento' ),
			'description' => esc_html__( 'Set the width of the content container, in pixels; default is 1080.', 'bento' ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_website_layout', 
		array(
			'type' => 'theme_mod',
			'default' => 0, 
			'sanitize_callback' => 'bento_sanitize_choices',
		)
	);
	$wp_customize->add_control( 
		'bento_website_layout', 
		array(
			'section' => 'bento_layout_background',
			'type' => 'select',
			'choices' => array( 
				esc_html__( 'Wide (default)', 'bento' ), 
				esc_html__( 'Boxed', 'bento' ) 
			),
			'label' => esc_html__( 'Website layout', 'bento' ),
			'description' => esc_html__( 'Choose the layout of the website: - "wide" means that the full-width elements such as the header will stretch the entire width of the browser window (this is default). - "boxed" means that the website will be restricted to a maximum width and there will be space left between the content and the sides of the browser window.', 'bento' ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_menu_config', 
		array(
			'type' => 'theme_mod',
			'default' => 0,
			'sanitize_callback' => 'bento_sanitize_choices',
		)
	);
	$wp_customize->add_control( 
		'bento_menu_config', 
		array(
			'section' => 'bento_layout_background',
			'type' => 'select',
			'choices' => array( 
				esc_html__( 'Top, right-aligned (default)', 'bento' ),
				esc_html__( 'Top, centered', 'bento' ),
				esc_html__( 'Top, hamburger button + overlay', 'bento' ),
				esc_html__( 'Left side', 'bento' ),
			),
			'label' => esc_html__( 'Menu layout', 'bento' ),
			'description' => esc_html__( 'Choose the way the primary menu is displayed: - "top, right-aligned" is the classic header with menu on the right (this is default); "top, centered" makes the menu and the logo align to the center of the header, "top, hamburger button" hides the menu behind a mobile-style three-line icon which displays a full-page overlay menu when clicked - suitable for websites with simple and non-hierarchical navigation structure; "left side" displays the menu and the logo to the left of the content area, as a separate section.', 'bento' ),
		) 
	);
	
	$wp_customize->add_setting( 
		'bento_default_sidebar', 
		array(
			'type' => 'theme_mod',
			'default' => 0,
			'sanitize_callback' => 'bento_sanitize_choices',
		)
	);
	$wp_customize->add_control( 
		'bento_default_sidebar', 
		array(
			'section' => 'bento_layout_background',
			'type' => 'select',
			'choices' => array( 
				esc_html__( 'Right sidebar', 'bento' ),
				esc_html__( 'Left sidebar', 'bento' ),
				esc_html__( 'Full width', 'bento' ),
			),
			'label' => esc_html__( 'Default sidebar layout', 'bento' ),
			'description' => esc_html__( 'Choose which sidebar configuration is set as default for all pages and posts; note that this does not affect existing posts and pages. You will also be able to change the layout for any single page or post individually using the Sidebar Layout option in the General Settings tab, while in the page edit mode.', 'bento' ),
		)
	);
	
	// Fonts and Typography
	
	$wp_customize->add_section( 
		'bento_fonts', 
		array(
			'title' => esc_html__( 'Fonts and Typography', 'bento' ),
			'priority' => 82,
		) 
	);
	
	$fonts_url = '<a href="http://www.google.com/webfonts" style="color:#999;" target="_blank">http://www.google.com/webfonts</a>';
	
	$wp_customize->add_setting( 
		'bento_font_body', 
		array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 
		'bento_font_body', 
		array(
			'section' => 'bento_fonts',
			'type' => 'text',
			'priority' => 10,
			'label' => esc_html__( 'Body font (Google Fonts)', 'bento' ),
			'description' => sprintf( esc_html__( 'Input Google Font name for the body font, e.g. Open Sans, exactly as spelled in the Google Fonts directory. You can preview Google Fonts here: %s; Default is Open Sans.', 'bento' ), $fonts_url ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_text_size_body', 
		array(
			'type' => 'theme_mod',
			'default' => 14,
			'sanitize_callback' => 'bento_sanitize_choices',
		)
	);
	$wp_customize->add_control( 
		'bento_text_size_body', 
		array(
			'section' => 'bento_fonts',
			'type' => 'select',
			'priority' => 20,
			'choices' => array( 
				12 => '12',
				13 => '13', 
				14 => esc_html__( '14 (default)', 'bento' ),
				16 => '16',
				18 => '18',
				20 => '20',
				24 => '24',
			),
			'label' => esc_html__( 'Body text size', 'bento' ),
			'description' => esc_html__( 'Choose the font size for the body text; default is 14px.', 'bento' ),
		) 
	);
	
	$wp_customize->add_setting( 
		'bento_font_headings', 
		array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 
		'bento_font_headings', 
		array(
			'section' => 'bento_fonts',
			'type' => 'text',
			'priority' => 30,
			'label' => esc_html__( 'Headings font (Google Fonts)', 'bento' ),
			'description' => sprintf( esc_html__( 'Input Google Font name for the headings font, e.g. Open Sans, exactly as spelled in the Google Fonts directory. You can preview Google Fonts here: %s; Default is Open Sans.', 'bento' ), $fonts_url ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_font_menu', 
		array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 
		'bento_font_menu', 
		array(
			'section' => 'bento_fonts',
			'type' => 'text',
			'priority' => 40,
			'label' => esc_html__( 'Menu font (Google Fonts)', 'bento' ),
			'description' => sprintf( esc_html__( 'Input Google Font name for the menu font, e.g. Montserrat, exactly as spelled in the Google Fonts directory. You can preview Google Fonts here: %s; Default is Montserrat.', 'bento' ), $fonts_url ),
		)
	);

	$wp_customize->add_setting( 
		'bento_text_size_menu', 
		array(
			'type' => 'theme_mod',
			'default' => 14,
			'sanitize_callback' => 'bento_sanitize_choices',
		)
	);
	$wp_customize->add_control( 
		'bento_text_size_menu', 
		array(
			'section' => 'bento_fonts',
			'type' => 'select',
			'priority' => 50,
			'choices' => array( 
				12 => '12',
				13 => '13', 
				14 => esc_html__( '14 (default)', 'bento' ),
				16 => '16',
				18 => '18',
				20 => '20',
				24 => '24',
			),
			'label' => esc_html__( 'Menu text size', 'bento' ),
			'description' => esc_html__( 'Choose the font size for the menu text; default is 14px.', 'bento' ),
		) 
	);
	
	$wp_customize->add_setting( 
		'bento_sentence_case_menu', 
		array(
			'type' => 'theme_mod',
			'default' => 0,
			'sanitize_callback' => 'bento_sanitize_checkboxes',
		)
	);
	$wp_customize->add_control( 
		'bento_sentence_case_menu', 
		array(
			'section' => 'bento_fonts',
			'type' => 'checkbox',
			'priority' => 60,
			'label' => esc_html__( 'Remove uppercase from menu text', 'bento' ),
			'description' => esc_html__( 'Check this option to render the menu items in sentence case (normal caps).', 'bento' ),
		)
	);
	
	// Header Colors
	
	$wp_customize->add_section( 
		'bento_colors_header', 
		array(
			'title' => esc_html__( 'Header Colors', 'bento' ),
			'priority' => 84,
		) 
	);
	
	$wp_customize->add_setting( 
		'bento_header_background_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_header_background_color', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Header background color', 'bento' ),
				'description' => esc_html__( 'Choose the background color for the top section of the website; default is #ffffff (white).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_primary_menu_background', 
		array(
			'type' => 'theme_mod',
			'default' => '#eeeeee',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_primary_menu_background', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Primary menu: background color', 'bento' ),
				'description' => esc_html__( 'Choose the background color of the overlay menu; default is #eeeeee (light-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_primary_menu_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_primary_menu_text_color', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Primary menu: text color', 'bento' ),
				'description' => esc_html__( 'Choose the text color for the main navigation menu; this will also apply to mobile menu text color by default, if nothing is chosen in the respective option below; default is #333333 (dark-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_primary_menu_text_hover_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#00B285',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_primary_menu_text_hover_color', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Primary menu: text color on hover', 'bento' ),
				'description' => esc_html__( 'Choose which color menu items become on mouse hover; default is #00b285 (blue-green).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_menu_separators', 
		array(
			'type' => 'theme_mod',
			'default' => '#eeeeee',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_menu_separators', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Primary menu: item separators', 'bento' ),
				'description' => esc_html__( 'Choose the color for the separator lines in the primary menu; default is #eeeeee (light-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_primary_menu_submenu_background_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#dddddd',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_primary_menu_submenu_background_color', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Primary menu: submenu background color', 'bento' ),
				'description' => esc_html__( 'Choose the background color for the submenus; this will also apply to mobile menu background color by default, if nothing is chosen in the respective option below; default is #dddddd (grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_primary_menu_submenu_background_hover_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#cccccc',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_primary_menu_submenu_background_hover_color', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Primary menu: submenu background color on hover', 'bento' ),
				'description' => esc_html__( 'Choose the color used as a background for submenu items on mouse hover; this will also apply to mobile menu hover background color by default, if nothing is chosen in the respective option below; default is #cccccc (grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_primary_menu_submenu_border_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#cccccc',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_primary_menu_submenu_border_color', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Primary menu: submenu border color', 'bento' ),
				'description' => esc_html__( 'Choose the color of submenu item borders; this will also apply to mobile menu border color by default, if nothing is chosen in the respective option below; default is #cccccc (grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_primary_menu_submenu_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_primary_menu_submenu_text_color', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Primary menu: submenu text color', 'bento' ),
				'description' => esc_html__( 'Choose the text color for the submenus; default is #333333 (dark-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_primary_menu_submenu_text_hover_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_primary_menu_submenu_text_hover_color', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Primary menu: submenu text color on hover', 'bento' ),
				'description' => esc_html__( 'Choose the mouse-hover text color for the submenus; default is #333333 (dark-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_mobile_menu_background_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#dddddd',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_mobile_menu_background_color', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Mobile menu: background color', 'bento' ),
				'description' => esc_html__( 'Choose the background color for the mobile menu; default is #dddddd (light-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_mobile_menu_background_hover_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#cccccc',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_mobile_menu_background_hover_color', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Mobile menu: background color on hover', 'bento' ),
				'description' => esc_html__( 'Choose the background color on hover; default is #cccccc (light-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_mobile_menu_border_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#cccccc',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_mobile_menu_border_color', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Mobile menu: border color', 'bento' ),
				'description' => esc_html__( 'Choose the border color for the mobile menu; default is #cccccc (light-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_mobile_menu_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_mobile_menu_text_color', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Mobile menu: text color', 'bento' ),
				'description' => esc_html__( 'Choose the text color for the mobile menu; default is #333333 (dark-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_mobile_menu_text_hover_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_mobile_menu_text_hover_color', 
			array(
				'section' => 'bento_colors_header',
				'label' => esc_html__( 'Mobile menu: text color on hover', 'bento' ),
				'description' => esc_html__( 'Choose the text color on mouse hover for the mobile menu; default is #333333 (dark-grey).', 'bento' ),
			)
		)
	);
	
	// Content Colors
	
	$wp_customize->add_section( 
		'bento_colors_content', 
		array(
			'title' => esc_html__( 'Content Colors', 'bento' ),
			'priority' => 86,
		) 
	);
	
	$wp_customize->add_setting( 
		'bento_content_background_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#f4f4f4',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_background_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Content area background color', 'bento' ),
				'description' => esc_html__( 'Choose the background color for the main content area of the website; default is #f4f4f4 (light-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_heading_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_heading_text_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Heading color', 'bento' ),
				'description' => esc_html__( 'Choose the color of headings throughout the website; default is #333333 (dark-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_body_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_body_text_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Body text color', 'bento' ),
				'description' => esc_html__( 'Choose the primary text color for the body of the website; default is #333333 (dark-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_link_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#00b285',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_link_text_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Link text color', 'bento' ),
				'description' => esc_html__( 'Choose the color for the link text throughout the website; default is #00b285 (blue-green).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_meta_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#999999',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_meta_text_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Meta text color', 'bento' ),
				'description' => esc_html__( 'Pick the color for meta content such as post dates, comment counts, and post counts; default is #999999 (grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_delimiter_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#dddddd',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_delimiter_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Delimiter line color', 'bento' ),
				'description' => esc_html__( 'Choose the color for delimiter lines, e.g. before comments, in sidebar widgets and in the shopping cart; also applies to in-text tables; default is #dddddd (light-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_input_background_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#e4e4e4',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_input_background_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Input fields: background color', 'bento' ),
				'description' => esc_html__( 'Choose the background color for input fields, such as comments and search; default is #e4e4e4 (light-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_input_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_input_text_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Input fields: text color', 'bento' ),
				'description' => esc_html__( 'Choose the color for the text typed into input fields, such as comment forms; default is #333333 (dark-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_input_placeholder_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#aaaaaa',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_input_placeholder_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Input fields: placeholder text color', 'bento' ),
				'description' => esc_html__( 'Choose the placeholder text color for input fields, i.e. the text that appears in empty fields; default is #aaaaaa (grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_button_background_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#00b285',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_button_background_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Buttons color', 'bento' ),
				'description' => esc_html__( 'Choose the color for buttons throughout the website; default is #00b285 (blue-green).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_button_hover_background_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#00906c',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_button_hover_background_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Button color on hover', 'bento' ),
				'description' => esc_html__( 'Choose the color for buttons on mouse hover; default is #00906c (dark blue-green).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_button_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_button_text_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Button text color', 'bento' ),
				'description' => esc_html__( 'Choose the color for button text; default is #ffffff (white).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_button_text_hover_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_button_text_hover_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Button text color on hover', 'bento' ),
				'description' => esc_html__( 'Choose the color for button text on mouse hover; default is #ffffff (white).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_secondary_button_background_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#999999',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_secondary_button_background_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Secondary button color', 'bento' ),
				'description' => esc_html__( 'Choose the color for secondary buttons, mainly for WooCommerce plugin, e.g. "update basket" and "apply coupon"; default is #999999 (grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_secondary_button_hover_background_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#777777',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_secondary_button_hover_background_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Secondary button color on hover', 'bento' ),
				'description' => esc_html__( 'Choose the color for secondary buttons on mouse hover; default is #777777 (grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_secondary_button_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_secondary_button_text_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Secondary button text color', 'bento' ),
				'description' => esc_html__( 'Choose the text color for secondary buttons, mainly for WooCommerce plugin, e.g. "update basket" and "apply coupon"; default is #ffffff (white).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_content_secondary_button_text_hover_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_content_secondary_button_text_hover_color', 
			array(
				'section' => 'bento_colors_content',
				'label' => esc_html__( 'Secondary button text color on hover', 'bento' ),
				'description' => esc_html__( 'Choose the text color for secondary buttons on mouse hover; default is #ffffff (white).', 'bento' ),
			)
		)
	);
	
	// Footer Colors
	
	$wp_customize->add_section( 
		'bento_colors_footer', 
		array(
			'title' => esc_html__( 'Footer Colors', 'bento' ),
			'priority' => 88,
		) 
	);
	
	$wp_customize->add_setting( 
		'bento_footer_widgets_background_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#888888',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_footer_widgets_background_color', 
			array(
				'section' => 'bento_colors_footer',
				'label' => esc_html__( 'Footer widget area background color', 'bento' ),
				'description' => esc_html__( 'Choose the background color for the footer widget area; default is #888888 (grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_footer_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#cccccc',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_footer_text_color', 
			array(
				'section' => 'bento_colors_footer',
				'label' => esc_html__( 'Footer text color', 'bento' ),
				'description' => esc_html__( 'Choose the text color for the footer; default is #cccccc (light-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_footer_link_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_footer_link_text_color', 
			array(
				'section' => 'bento_colors_footer',
				'label' => esc_html__( 'Footer link color', 'bento' ),
				'description' => esc_html__( 'Choose the color for links in the footer; default is #ffffff (white).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_footer_meta_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#aaaaaa',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_footer_meta_text_color', 
			array(
				'section' => 'bento_colors_footer',
				'label' => esc_html__( 'Footer meta text color', 'bento' ),
				'description' => esc_html__( 'Choose the color meta text, such as dates and post counts, in the footer; default is #aaaaaa (light-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_footer_delimiter_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#999999',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_footer_delimiter_color', 
			array(
				'section' => 'bento_colors_footer',
				'label' => esc_html__( 'Footer delimiter text color', 'bento' ),
				'description' => esc_html__( 'Choose the color for delimiter lines in the footer widgets; default is #999999 (light-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_footer_bottom_background_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#666666',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_footer_bottom_background_color', 
			array(
				'section' => 'bento_colors_footer',
				'label' => esc_html__( 'Bottom footer background color', 'bento' ),
				'description' => esc_html__( 'Choose the background color for the bottom part of the footer containing the optional footer menu and the copyright information; default is #666666 (grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_footer_bottom_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#cccccc',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_footer_bottom_text_color', 
			array(
				'section' => 'bento_colors_footer',
				'label' => esc_html__( 'Bottom footer: text color', 'bento' ),
				'description' => esc_html__( 'Choose the color for the bottom footer text; default is #cccccc (light-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_footer_bottom_link_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_footer_bottom_link_text_color', 
			array(
				'section' => 'bento_colors_footer',
				'label' => esc_html__( 'Bottom footer: link color', 'bento' ),
				'description' => esc_html__( 'Choose the color for links in the bottom footer area; default is #ffffff (white).', 'bento' ),
			)
		)
	);
	
	// Homepage Settings
	
	$wp_customize->add_setting( 
		'bento_blog_header_image', 
		array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'bento_blog_header_image', 
			array(
				'section' => 'static_front_page',
				'priority' => 21,
				'mime_type' => 'image',
				'label' => esc_html__( 'Blog posts page: header image', 'bento' ),
				'description' => esc_html__( 'Upload the image to be used as the full-width header for the blog posts page.', 'bento' ),
			) 
		) 
	);
	
	$wp_customize->add_setting( 
		'bento_blog_header_title', 
		array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 
		'bento_blog_header_title', 
		array(
			'section' => 'static_front_page',
			'priority' => 21,
			'type' => 'text',
			'label' => esc_html__( 'Blog posts page: header title', 'bento' ),
			'description' => esc_html__( 'Input the text to be displayed in the blog header on the front page.', 'bento' ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_blog_header_title_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_blog_header_title_color', 
			array(
				'section' => 'static_front_page',
				'priority' => 22,
				'label' => esc_html__( 'Front blog header title color', 'bento' ),
				'description' => esc_html__( 'Choose the color for the title of the blog posts page if it is set as the website front page; default is #ffffff (white).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_blog_header_subtitle', 
		array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 
		'bento_blog_header_subtitle', 
		array(
			'section' => 'static_front_page',
			'priority' => 23,
			'type' => 'text',
			'label' => esc_html__( 'Blog posts page: header subtitle', 'bento' ),
			'description' => esc_html__( 'Input the text to be displayed under the main title in the blog header.', 'bento' ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_blog_header_subtitle_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#cccccc',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_blog_header_subtitle_color', 
			array(
				'section' => 'static_front_page',
				'priority' => 24,
				'label' => esc_html__( 'Front blog header subtitle color', 'bento' ),
				'description' => esc_html__( 'Choose the color for the subtitle of the blog posts page if it is set as the website front page; default is #cccccc (light-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_front_header_image', 
		array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'bento_front_header_image', 
			array(
				'section' => 'static_front_page',
				'priority' => 25,
				'mime_type' => 'image',
				'label' => esc_html__( 'Static front page: header image', 'bento' ),
				'description' => esc_html__( 'Upload the image to be used as the full-width header for the static front page.', 'bento' ),
			) 
		) 
	);
	
	$wp_customize->add_setting( 
		'bento_front_header_primary_cta_text', 
		array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 
		'bento_front_header_primary_cta_text', 
		array(
			'section' => 'static_front_page',
			'priority' => 25,
			'type' => 'text',
			'label' => esc_html__( 'Primary call-to-action button text', 'bento' ),
			'description' => esc_html__( 'Input the text for an optional call-to-action button on the static front page.', 'bento' ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_front_header_primary_cta_link', 
		array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control( 
		'bento_front_header_primary_cta_link', 
		array(
			'section' => 'static_front_page',
			'priority' => 26,
			'type' => 'text',
			'label' => esc_html__( 'Primary call-to-action button link', 'bento' ),
			'description' => esc_html__( 'Paste the URL link to point the call-to-action button to; leave this blank to scroll the page below the header on button click.', 'bento' ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_front_header_primary_cta_bck_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_front_header_primary_cta_bck_color', 
			array(
				'section' => 'static_front_page',
				'priority' => 27,
				'label' => esc_html__( 'Primary call-to-action button background color', 'bento' ),
				'description' => esc_html__( 'Choose the background color for the primary call-to-action button; default is #ffffff (white).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_front_header_primary_cta_bck_color_hover', 
		array(
			'type' => 'theme_mod',
			'default' => '#cccccc',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_front_header_primary_cta_bck_color_hover', 
			array(
				'section' => 'static_front_page',
				'priority' => 28,
				'label' => esc_html__( 'Primary call-to-action button mouse-over background color', 'bento' ),
				'description' => esc_html__( 'Choose the background color for the primary call-to-action button on mouse hover; default is #cccccc (light-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_front_header_primary_cta_text_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_front_header_primary_cta_text_color', 
			array(
				'section' => 'static_front_page',
				'priority' => 29,
				'label' => esc_html__( 'Primary call-to-action button text color', 'bento' ),
				'description' => esc_html__( 'Choose the text color for the primary call-to-action button; default is #333333 (dark-grey).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_front_header_secondary_cta_text', 
		array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 
		'bento_front_header_secondary_cta_text', 
		array(
			'section' => 'static_front_page',
			'priority' => 30,
			'type' => 'text',
			'label' => esc_html__( 'Secondary call-to-action button text', 'bento' ),
			'description' => esc_html__( 'Input the text for an optional secondary call-to-action button on the static front page.', 'bento' ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_front_header_secondary_cta_link', 
		array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control( 
		'bento_front_header_secondary_cta_link', 
		array(
			'section' => 'static_front_page',
			'priority' => 31,
			'type' => 'text',
			'label' => esc_html__( 'Secondary call-to-action button link', 'bento' ),
			'description' => esc_html__( 'Paste the URL link to point the secondary call-to-action button to; leave this blank to scroll the page below the header on button click.', 'bento' ),
		)
	);
	
	$wp_customize->add_setting( 
		'bento_front_header_secondary_cta_color', 
		array(
			'type' => 'theme_mod',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_front_header_secondary_cta_color', 
			array(
				'section' => 'static_front_page',
				'priority' => 32,
				'label' => esc_html__( 'Secondary call-to-action button color', 'bento' ),
				'description' => esc_html__( 'Choose the text and border color for the secondary call-to-action button; default is #ffffff (white).', 'bento' ),
			)
		)
	);
	
	$wp_customize->add_setting( 
		'bento_front_header_secondary_cta_color_hover', 
		array(
			'type' => 'theme_mod',
			'default' => '#cccccc',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize,
			'bento_front_header_secondary_cta_color_hover', 
			array(
				'section' => 'static_front_page',
				'priority' => 33,
				'label' => esc_html__( 'Secondary call-to-action button mouse-over color', 'bento' ),
				'description' => esc_html__( 'Choose the text and border color for the secondary call-to-action button on mouse hover; default is #cccccc (light-grey).', 'bento' ),
			)
		)
	);
	

}


// Insert CSS from settings
function bento_customizer_css() {
	
	$customizer_css = '';
	
	// Theme Options: Site Identity tab
	$bento_logo_padding_rem = esc_html( get_theme_mod( 'bento_logo_padding', 30 ) ) / 10;
	$customizer_css .= '
		.logo {
			padding: '.esc_html( get_theme_mod( 'bento_logo_padding', 30 ) ).'px 0;
			padding: '.$bento_logo_padding_rem.'rem 0;
		}
	';
	
	// Theme Options: Layout and Background tab
	$bento_content_width_med_px = esc_html( get_theme_mod( 'bento_content_width', 1080 ) );
	$bento_content_width_med_rem = $bento_content_width_med_px / 10;
	$bento_content_width_hi_px = $bento_content_width_med_px + 360;
	$bento_content_width_hi_rem = $bento_content_width_hi_px / 10;
	$bento_box_width_med_px = $bento_box_width_med_rem = $bento_box_width_hi_px = $bento_box_width_hi_rem = 'none';
	$bento_box_width_med_px = $bento_content_width_med_px + 80;
	$bento_box_width_med_rem = $bento_box_width_med_px / 10;
	$bento_box_width_hi_px = $bento_content_width_hi_px + 120;
	$bento_box_width_hi_rem = $bento_box_width_hi_px / 10;
	$bento_media_breakpoint = ( $bento_content_width_med_px * 1.1 ) / 16;
	$customizer_css .= '
		@media screen and (min-width: 64em) {
			.bnt-container {
				max-width: '.$bento_content_width_med_px.'px;
				max-width: '.$bento_content_width_med_rem.'rem;
			}
		}
		@media screen and (min-width: '.$bento_media_breakpoint.'em) {
			.bnt-container {
				padding: 0;
			}
		}
		@media screen and (min-width: 120em) {
			.bnt-container {
				max-width: '.$bento_content_width_hi_px.'px;
				max-width: '.$bento_content_width_hi_rem.'rem;
			}
		}
	';
	if ( get_theme_mod( 'bento_website_layout', 0 ) == 1 ) {
		$customizer_css .= '
			@media screen and (min-width: 64em) {
				.site-wrapper {
					max-width: '.$bento_box_width_med_px.'px;
					max-width: '.$bento_box_width_med_rem.'rem;
				}
				.boxed-layout .fixed-header {
					max-width: '.$bento_box_width_med_px.'px;
					max-width: '.$bento_box_width_med_rem.'rem;
				}
			}
			@media screen and (min-width: 120em) {
				.site-wrapper {
					max-width: '.$bento_box_width_hi_px.'px;
					max-width: '.$bento_box_width_hi_rem.'rem;
				}
				.boxed-layout .fixed-header {
					max-width: '.$bento_box_width_hi_px.'px;
					max-width: '.$bento_box_width_hi_rem.'rem;
				}
			}
		';
	}
	if ( get_theme_mod( 'bento_menu_config', 0 ) == 2 ) {
		$customizer_css .= '
			.header-menu {
				background-color: '.esc_html( get_theme_mod( 'bento_primary_menu_background', '#eeeeee' ) ).';
			}
		';
	} else if ( get_theme_mod( 'bento_menu_config', 0 ) == 3 ) {
		$customizer_css .= '
			@media screen and (min-width: 48em) {
				.header-side .primary-menu > li,
				.header-side .primary-menu .sub-menu, 
				.header-side .primary-menu .sub-menu li {
					border-color: '.esc_html( get_theme_mod( 'bento_menu_separators', '#eeeeee' ) ).';
				}
				.header-side .primary-menu .sub-menu li a:hover {
					color: '.esc_html( get_theme_mod( 'bento_primary_menu_text_hover_color', '#00B285' ) ).';
				}
				.header-side .primary-menu .sub-menu li, 
				.header-side #nav-mobile {
					background-color: transparent;
				}
			}
		';
	}
	
	// Theme Options: Fonts and Typography tab
	$bento_font_face_body = $bento_font_face_headings = $bento_font_face_menu = '';
	$bento_body_font = $bento_headings_font = 'Open Sans';
	$bento_menu_font = 'Montserrat';
	$bento_body_text_size = $bento_menu_text_size = 14;
	if ( get_theme_mod( 'bento_font_body_upload', '' ) != '' ) {
		$bento_font_face_body = '
			@font-face {
				font-family: bodyFont;
				src: url('.esc_url( get_theme_mod( 'bento_font_body_upload', '' ) ).');
			}
		';
		$bento_body_font = 'bodyFont';
	} else if ( get_theme_mod( 'bento_font_body', '' ) != '' ) {
		$bento_body_font = esc_html( get_theme_mod( 'bento_font_body', '' ) );
	}
	if ( get_theme_mod( 'bento_font_headings_upload', '' ) != '' ) {
		$bento_font_face_headings = '
			@font-face {
				font-family: headingsFont;
				src: url('.esc_url( get_theme_mod( 'bento_font_headings_upload', '' ) ).');
			}
		';
		$bento_headings_font = 'headingsFont';
	} else if ( get_theme_mod( 'bento_font_headings', '' ) != '' ) {
		$bento_headings_font = esc_html( get_theme_mod( 'bento_font_headings', '' ) );
	}
	if ( get_theme_mod( 'bento_font_menu_upload', '' ) != '' ) {
		$bento_font_face_menu = '
			@font-face {
				font-family: menuFont;
				src: url('.esc_url( get_theme_mod( 'bento_font_menu_upload', '' ) ).');
			}
		';
		$bento_menu_font = 'menuFont';
	} else if ( get_theme_mod( 'bento_font_menu', '' ) != '' ) {
		$bento_menu_font = esc_html( get_theme_mod( 'bento_font_menu', '' ) );
	}
	if ( get_theme_mod( 'bento_text_size_body', 14 ) != 14 ) {
		$bento_body_text_size = esc_html( get_theme_mod( 'bento_text_size_body', 14 ) );
	}
	if ( get_theme_mod( 'bento_text_size_menu', 14 ) != 14 ) {
		$bento_menu_text_size = esc_html( get_theme_mod( 'bento_text_size_menu', 14 ) );
	}
	$bento_body_text_size_em = $bento_body_text_size / 10;
	$bento_menu_text_size_rem = $bento_menu_text_size / 10;
	$customizer_css .= 
		$bento_font_face_body.
		$bento_font_face_headings.
		$bento_font_face_menu.'
		body {
			font-family: '.$bento_body_font.', Arial, sans-serif;
			font-size: '.$bento_body_text_size.'px;
			font-size: '.$bento_body_text_size_em.'em;
		}
		.site-content h1, 
		.site-content h2, 
		.site-content h3, 
		.site-content h4, 
		.site-content h5, 
		.site-content h6,
		.post-header-title h1 {
			font-family: '.$bento_headings_font.', Arial, sans-serif;
		}
		#nav-primary {
			font-family: '.$bento_menu_font.', Arial, sans-serif;
		}
		.primary-menu > li > a,
		.primary-menu > li > a:after {
			font-size: '.$bento_menu_text_size.'px;
			font-size: '.$bento_menu_text_size_rem.'rem;
		}
	';
	if ( get_theme_mod( 'bento_sentence_case_menu', 0 ) == 1 ) {
		$customizer_css .= '
			#nav-primary {
				text-transform: none;
			}
		';
	}
	
	// Theme Options: Header Colors tab
	$customizer_css .= '
		.site-header,
		.header-default .site-header.fixed-header,
		.header-centered .site-header.fixed-header,
		.header-side .site-wrapper {
			background: '.esc_html( get_theme_mod( 'bento_header_background_color', '#ffffff' ) ).';
		}
		.primary-menu > li > .sub-menu {
			border-top-color: '.esc_html( get_theme_mod( 'bento_header_background_color', '#ffffff' ) ).';
		}
		.primary-menu > li > a,
		#nav-mobile li a,
		.mobile-menu-trigger,
		.mobile-menu-close,
		.ham-menu-close {
			color: '.esc_html( get_theme_mod( 'bento_primary_menu_text_color', '#333333' ) ).';
		}
		.primary-menu > li > a:hover,
		.primary-menu > li.current-menu-item > a,
		.primary-menu > li.current-menu-ancestor > a {
			color: '.esc_html( get_theme_mod( 'bento_primary_menu_text_hover_color', '#00B285' ) ).';
		}
		.primary-menu .sub-menu li,
		#nav-mobile {
			background-color: '.esc_html( get_theme_mod( 'bento_primary_menu_submenu_background_color', '#dddddd' ) ).';
		}
		.primary-menu .sub-menu li a:hover,
		.primary-menu .sub-menu .current-menu-item:not(.current-menu-ancestor) > a,
		#nav-mobile li a:hover,
		#nav-mobile .current-menu-item:not(.current-menu-ancestor) > a {
			background-color: '.esc_html( get_theme_mod( 'bento_primary_menu_submenu_background_hover_color', '#cccccc' ) ).';
		}
		.primary-menu .sub-menu,
		.primary-menu .sub-menu li,
		#nav-mobile li a,
		#nav-mobile .primary-mobile-menu > li:first-child > a {
			border-color: '.esc_html( get_theme_mod( 'bento_primary_menu_submenu_border_color', '#cccccc' ) ).';
		}
		.primary-menu .sub-menu li a {
			color: '.esc_html( get_theme_mod( 'bento_primary_menu_submenu_text_color', '#333333' ) ).'; 
		}
		.primary-menu .sub-menu li:hover > a {
			color: '.esc_html( get_theme_mod( 'bento_primary_menu_submenu_text_hover_color', '#333333' ) ).'; 
		}
		#nav-mobile {
			background-color: '.esc_html( get_theme_mod( 'bento_mobile_menu_background_color', '#dddddd' ) ).';
		}
		#nav-mobile li a,
		.mobile-menu-trigger,
		.mobile-menu-close {
			color: '.esc_html( get_theme_mod( 'bento_mobile_menu_text_color', '#333333' ) ).';
		}
		#nav-mobile li a:hover,
		#nav-mobile .current-menu-item:not(.current-menu-ancestor) > a {
			background-color: '.esc_html( get_theme_mod( 'bento_mobile_menu_background_hover_color', '#cccccc' ) ).';
		}
		#nav-mobile li a,
		#nav-mobile .primary-mobile-menu > li:first-child > a {
			border-color: '.esc_html( get_theme_mod( 'bento_mobile_menu_border_color', '#cccccc' ) ).';	
		}
		#nav-mobile li a:hover,
		.mobile-menu-trigger-container:hover,
		.mobile-menu-close:hover {
			color: '.esc_html( get_theme_mod( 'bento_mobile_menu_text_hover_color', '#333333' ) ).';
		}
	';
	
	// Theme Options: Content Colors tab
	$customizer_css .= '
		.site-content {
			background-color: '.esc_html( get_theme_mod( 'bento_content_background_color', '#f4f4f4' ) ).';
		}
		.site-content h1, 
		.site-content h2, 
		.site-content h3, 
		.site-content h4, 
		.site-content h5, 
		.site-content h6 {
			color: '.esc_html( get_theme_mod( 'bento_content_heading_text_color', '#333333' ) ).';
		}
		.products .product a h3,
		.masonry-item-box a h2 {
			color: inherit;	
		}
		.site-content {
			color: '.esc_html( get_theme_mod( 'bento_content_body_text_color', '#333333' ) ).';
		}
		.site-content a:not(.masonry-item-link) {
			color: '.esc_html( get_theme_mod( 'bento_content_link_text_color', '#00b285' ) ).';
		}
		.site-content a:not(.page-numbers) {
			color: '.esc_html( get_theme_mod( 'bento_content_link_text_color', '#00b285' ) ).';
		}
		.site-content a:not(.ajax-load-more) {
			color: '.esc_html( get_theme_mod( 'bento_content_link_text_color', '#00b285' ) ).';
		}
		.site-content a:not(.remove) {
			color: '.esc_html( get_theme_mod( 'bento_content_link_text_color', '#00b285' ) ).';
		}
		.site-content a:not(.button) {
			color: '.esc_html( get_theme_mod( 'bento_content_link_text_color', '#00b285' ) ).';
		}
		.page-links a .page-link-text:not(:hover) {
			color: #00B285;
		}
		label,
		.wp-caption-text,
		.post-date-blog,
		.entry-footer, 
		.archive-header .archive-description, 
		.comment-meta,
		.comment-notes,
		.project-types,
		.widget_archive li,
		.widget_categories li,
		.widget .post-date,
		.widget_calendar table caption,
		.widget_calendar table th,
		.widget_recent_comments .recentcomments,
		.product .price del,
		.widget del,
		.widget del .amount,
		.product_list_widget a.remove,
		.product_list_widget .quantity,
		.product-categories .count,
		.product_meta,
		.shop_table td.product-remove a,
		.woocommerce-checkout .payment_methods .wc_payment_method .payment_box {
			color: '.esc_html( get_theme_mod( 'bento_content_meta_text_color', '#999999' ) ).';
		}
		hr,
		.entry-content table,
		.entry-content td,
		.entry-content th,
		.separator-line,
		.comment .comment .comment-nested,
		.comment-respond,
		.sidebar .widget_recent_entries ul li,
		.sidebar .widget_recent_comments ul li,
		.sidebar .widget_categories ul li,
		.sidebar .widget_archive ul li,
		.sidebar .widget_product_categories ul li,
		.woocommerce .site-footer .widget-woo .product_list_widget li,
		.woocommerce .site-footer .widget-woo .cart_list li:last-child,
		.woocommerce-tabs .tabs,
		.woocommerce-tabs .tabs li.active,
		.cart_item,
		.cart_totals .cart-subtotal,
		.cart_totals .order-total,
		.woocommerce-checkout-review-order table tfoot,
		.woocommerce-checkout-review-order table tfoot .order-total,
		.woocommerce-checkout-review-order table tfoot .shipping {
			border-color: '.esc_html( get_theme_mod( 'bento_content_delimiter_color', '#dddddd' ) ).';	
		}
		input[type="text"], 
		input[type="password"], 
		input[type="email"], 
		input[type="number"], 
		input[type="tel"], 
		input[type="search"], 
		textarea, 
		select, 
		.select2-container {
			background-color: '.esc_html( get_theme_mod( 'bento_content_input_background_color', '#e4e4e4' ) ).';
			color: '.esc_html( get_theme_mod( 'bento_content_input_text_color', '#333333' ) ).';
		}
		::-webkit-input-placeholder { 
			color: '.esc_html( get_theme_mod( 'bento_content_input_placeholder_color', '#aaaaaa' ) ).'; 
		}
		::-moz-placeholder { 
			color: '.esc_html( get_theme_mod( 'bento_content_input_placeholder_color', '#aaaaaa' ) ).'; 
		}
		:-ms-input-placeholder { 
			color: '.esc_html( get_theme_mod( 'bento_content_input_placeholder_color', '#aaaaaa' ) ).'; 
		}
		input:-moz-placeholder { 
			color: '.esc_html( get_theme_mod( 'bento_content_input_placeholder_color', '#aaaaaa' ) ).'; 
		}
		.pagination a.page-numbers:hover,
		.woocommerce-pagination a.page-numbers:hover,
		.site-content a.ajax-load-more:hover,
		.page-links a .page-link-text:hover,
		.widget_price_filter .ui-slider .ui-slider-range, 
		.widget_price_filter .ui-slider .ui-slider-handle,
		input[type="submit"],
		.site-content .button,
		.widget_price_filter .ui-slider .ui-slider-range, 
		.widget_price_filter .ui-slider .ui-slider-handle {
			background-color: '.esc_html( get_theme_mod( 'bento_content_button_background_color', '#00b285' ) ).';	
		}
		.pagination a.page-numbers:hover,
		.woocommerce-pagination a.page-numbers:hover,
		.site-content a.ajax-load-more:hover,
		.page-links a .page-link-text:hover {
			border-color: '.esc_html( get_theme_mod( 'bento_content_button_background_color', '#00b285' ) ).';
		}
		.page-links a .page-link-text:not(:hover),
		.pagination a, 
		.woocommerce-pagination a,
		.site-content a.ajax-load-more {
			color: '.esc_html( get_theme_mod( 'bento_content_button_background_color', '#00b285' ) ).';
		}
		input[type="submit"]:hover,
		.site-content .button:hover {
			background-color: '.esc_html( get_theme_mod( 'bento_content_button_hover_background_color', '#00906c' ) ).';
		}
		input[type="submit"],
		.site-content .button,
		.site-content a.button,
		.pagination a.page-numbers:hover,
		.woocommerce-pagination a.page-numbers:hover,
		.site-content a.ajax-load-more:hover,
		.page-links a .page-link-text:hover {
			color: '.esc_html( get_theme_mod( 'bento_content_button_text_color', '#ffffff' ) ).';	
		}
		input[type="submit"]:hover,
		.site-content .button:hover {
			color: '.esc_html( get_theme_mod( 'bento_content_button_text_hover_color', '#ffffff' ) ).';
		}
		.shop_table .actions .button,
		.shipping-calculator-form .button,
		.checkout_coupon .button,
		.widget_shopping_cart .button:first-child,
		.price_slider_amount .button {
			background-color: '.esc_html( get_theme_mod( 'bento_content_secondary_button_background_color', '#999999' ) ).';
		}
		.shop_table .actions .button:hover,
		.shipping-calculator-form .button:hover,
		.checkout_coupon .button:hover,
		.widget_shopping_cart .button:first-child:hover,
		.price_slider_amount .button:hover {
			background-color: '.esc_html( get_theme_mod( 'bento_content_secondary_button_hover_background_color', '#777777' ) ).';
		}
		.shop_table .actions .button,
		.shipping-calculator-form .button,
		.checkout_coupon .button,
		.widget_shopping_cart .button:first-child,
		.price_slider_amount .button {
			color: '.esc_html( get_theme_mod( 'bento_content_secondary_button_text_color', '#ffffff' ) ).';
		}
		.shop_table .actions .button:hover,
		.shipping-calculator-form .button:hover,
		.checkout_coupon .button:hover,
		.widget_shopping_cart .button:first-child:hover,
		.price_slider_amount .button:hover {
			color: '.esc_html( get_theme_mod( 'bento_content_secondary_button_text_hover_color', '#ffffff' ) ).';
		}
	';
	
	// Theme Options: Footer Colors tab
	$customizer_css .= '
		.sidebar-footer {
			background-color: '.esc_html( get_theme_mod( 'bento_footer_widgets_background_color', '#888888' ) ).';
		}
		.site-footer {
			color: '.esc_html( get_theme_mod( 'bento_footer_text_color', '#cccccc' ) ).';
		}
		.site-footer a {
			color: '.esc_html( get_theme_mod( 'bento_footer_link_text_color', '#ffffff' ) ).';
		}
		.site-footer label, 
		.site-footer .post-date-blog, 
		.site-footer .entry-footer, 
		.site-footer .comment-meta, 
		.site-footer .comment-notes, 
		.site-footer .widget_archive li, 
		.site-footer .widget_categories li, 
		.site-footer .widget .post-date, 
		.site-footer .widget_calendar table caption, 
		.site-footer .widget_calendar table th, 
		.site-footer .widget_recent_comments .recentcomments {
			color: '.esc_html( get_theme_mod( 'bento_footer_meta_text_color', '#aaaaaa' ) ).';
		}
		.sidebar-footer .widget_recent_entries ul li, 
		.sidebar-footer .widget_recent_comments ul li, 
		.sidebar-footer .widget_categories ul li, 
		.sidebar-footer .widget_archive ul li {
			border-color: '.esc_html( get_theme_mod( 'bento_footer_delimiter_color', '#999999' ) ).';
		}
		.bottom-footer {
			background-color: '.esc_html( get_theme_mod( 'bento_footer_bottom_background_color', '#666666' ) ).';
			color: '.esc_html( get_theme_mod( 'bento_footer_bottom_text_color', '#cccccc' ) ).';
		}
		.bottom-footer a {
			color: '.esc_html( get_theme_mod( 'bento_footer_bottom_link_text_color', '#ffffff' ) ).';
		}
	';
	
	// Theme Options: Homepage tab
	$customizer_css .= '
		.home.blog .post-header-title h1 {
			color: '.esc_html( get_theme_mod( 'bento_blog_header_title_color', '#ffffff' ) ).';
		}
		.home.blog .post-header-subtitle {
			color: '.esc_html( get_theme_mod( 'bento_blog_header_subtitle_color', '#cccccc' ) ).';
		}
	';
	
	return $customizer_css;
	
}


// Control display callback - check for WooCommerce
function bento_woo_active() {
	return class_exists( 'WooCommerce' );
}


// Display admin notice for migrating theme settings to Customizer
function bento_customizer_admin_notice() {
	$old_options = get_option( 'satori_options', 'none' );
	$customizer_url = get_admin_url( null, 'customize.php' );
	$success_message = sprintf( wp_kses( __( 'Migration successful! Check out the <a href="%s">Customizer</a>', 'bento' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $customizer_url ) );
	if ( $old_options != 'none' ) {
		?>
		<div class="notice notice-warning is-dismissible notice-migrate-bento-options">
			<h3>
				<?php esc_attr_e( 'Action required - migrate Bento theme options into the Customizer', 'bento' ); ?>
			</h3>
			<p>
				<?php esc_attr_e( 'Due to a change in WordPress rules, all theme options are now handled by the native Customizer ("Appearance -> Customize" admin section). Please click on the button below to transfer existing Bento theme options to the Customizer', 'bento' ); ?>:
			</p>
			<p>
				<input name="Migrate Bento options" type="submit" class="button-primary" value="<?php esc_attr_e( 'Transfer theme options', 'bento' ); ?> &rsaquo;">
			</p>
		</div>
		<div class="notice notice-success is-dismissible hidden notice-migrate-bento-options-success">
			<p>
				<?php echo $success_message; ?>
			</p>
		</div>
		<?php
	}
}


// Get attachment ID from URL
function bento_get_attachment_id( $url ) {
	$attachment_id = '';
	$dir = wp_upload_dir();
	if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) {
		$file = basename( $url );
		$query_args = array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'fields'      => 'ids',
			'meta_query'  => array(
				array(
					'value'   => $file,
					'compare' => 'LIKE',
					'key'     => '_wp_attachment_metadata',
				),
			)
		);
		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) {
			foreach ( $query->posts as $post_id ) {
				$meta = wp_get_attachment_metadata( $post_id );
				$original_file = basename( $meta['file'] );
				$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
				if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
					$attachment_id = $post_id;
					break;
				}
			}
		}
		wp_reset_postdata();
	}
	return $attachment_id;
}	


// Migrate older options to Customizer
function bento_migrate_customizer_options() {
	if ( isset($_POST['action']) && $_POST['action'] == 'bento_migrate_customizer_options' ) {
		$old_options = get_option( 'satori_options' );
		
		if ( $old_options ) {
			
			// Migrate options
			foreach ( $old_options as $old_option_name => $old_option_value ) {
				if ( $old_option_value != '' ) {
					$new_option_name = str_replace( 'bnt_', 'bento_', $old_option_name );
					if ( $old_option_name == 'bnt_logo_mobile' ) {
						$file_id = bento_get_attachment_id( $old_option_value );
						set_theme_mod( $new_option_name, $file_id );
					} else if ( $old_option_name == 'custom_logo' ) {
						$file_id = bento_get_attachment_id( $old_option_value );
						set_theme_mod( 'custom_logo', $file_id );
					} else if ( $old_option_name == 'bnt_favicon' ) {
						$file_id = bento_get_attachment_id( $old_option_value );
						update_option( 'site_icon', $file_id );		
					} else if ( $old_option_name == 'bnt_website_background_color' ) {
						$old_bck_color = $old_options['bnt_website_background_color'];
						set_theme_mod( 'background_color', $old_bck_color );
					} else if ( $old_option_name == 'bnt_website_background_texture' ) {
						$file_url = $old_options['bnt_website_background_texture'];
						set_theme_mod( 'background_image', $file_url );
						set_theme_mod( 'background_preset', 'repeat' );
					} else if ( $old_option_name == 'bnt_website_background_image' ) {
						$file_url = $old_options['bnt_website_background_image'];
						set_theme_mod( 'background_image', $file_url );	
					} else if ( $old_option_name == 'bnt_custom_css' ) {
						$old_custom_css = $old_options['bnt_custom_css'];
						wp_update_custom_css_post( $old_custom_css );
					} else {
						set_theme_mod( $new_option_name, $old_option_value );
					}
				}
			}
			delete_option( 'satori_options' );
			
			// Migrate post meta
			$posts_args = array(
				'posts_per_page' => -1,
				'post_type' => array( 'post', 'page', 'project', 'product' ),
			);
			$posts_array = get_posts( $posts_args );
			foreach ( $posts_array as $post ) {
				$post_meta = get_post_meta( $post->ID );
				foreach( $post_meta as $old_meta_key => $meta_val ) {
					if ( strpos( $old_meta_key, 'bnt_' ) !== false ) {
						$new_meta_key = str_replace( 'bnt_', 'bento_', $old_meta_key );
						update_post_meta( $post->ID, $new_meta_key, $meta_val[0] );
						delete_post_meta( $post->ID, $old_meta_key );
					}
				}
			}
			
		}
		
	}
	die();
}


?>