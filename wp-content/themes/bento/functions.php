<?php // Theme Functions


// Theme setup
add_action( 'after_setup_theme', 'bento_theme_setup' );

function bento_theme_setup() {
	
	// Features
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'quote', 'link', 'image' ) );
	add_theme_support( 'woocommerce' ); 
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'custom-background', array ( 'default-color' => '#f4f4f4' ) );
	
	// Actions
	add_action( 'wp_enqueue_scripts', 'bento_theme_styles_scripts' );
	add_action( 'admin_enqueue_scripts', 'bento_admin_scripts' );
	add_action( 'admin_menu', 'bento_about_page' );
	add_action( 'load-themes.php', 'bento_add_welcome_message' );
	add_action( 'template_redirect', 'bento_theme_adjust_content_width' );
	add_action( 'init', 'bento_page_excerpt_support' );
	add_action( 'get_header', 'bento_enable_threaded_comments' );
	add_action( 'tgmpa_register', 'bento_register_required_plugins' );
	add_action( 'wp_ajax_ajax_pagination', 'bento_ajax_pagination' );
	add_action( 'wp_ajax_nopriv_ajax_pagination', 'bento_ajax_pagination' );
	add_action( 'widgets_init', 'bento_register_sidebars' );
	add_action( 'comment_form_defaults', 'bento_comment_form_defaults' );
	add_action( 'comment_form_default_fields', 'bento_comment_form_fields' );
	add_action( 'wp_ajax_bento_migrate_customizer_options', 'bento_migrate_customizer_options' );
	add_action( 'wp_ajax_nopriv_bento_migrate_customizer_options', 'bento_migrate_customizer_options' );
		
	// Filters
	add_filter( 'excerpt_more', 'bento_custom_excerpt_more' );
	add_filter( 'get_custom_logo', 'bento_get_custom_logo' );
	add_filter( 'get_the_excerpt', 'bento_grid_excerpt' );
	add_filter( 'body_class', 'bento_extra_classes' );
	add_filter( 'comment_form_fields', 'bento_rearrange_comment_fields' );
	add_filter( 'post_class', 'bento_has_thumb_class' );
	add_filter( 'get_the_archive_title', 'bento_cleaner_archive_titles' );
	add_filter( 'cmb2_admin_init', 'bento_metaboxes' );
	add_filter( 'dynamic_sidebar_params', 'bento_count_footer_widgets', 50 );
	
	// Languages
	load_theme_textdomain( 'bento', get_template_directory() . '/languages' );
	
	// Initialize navigation menus
	register_nav_menus(
		array(
			'primary-menu' => esc_html__( 'Primary Menu', 'bento' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'bento' ),
		)
	);
	
	// Customizer options
	if ( file_exists( get_template_directory() . '/includes/customizer/customizer.php' ) ) {
		require_once( get_template_directory() . '/includes/customizer/customizer.php' );
	}
	add_action( 'customize_register', 'bento_customize_register' );
	add_action( 'customize_register', 'bento_customizer_rename_sections' );
	add_action( 'customize_controls_print_styles', 'bento_customizer_stylesheet' );
	add_action( 'customize_controls_enqueue_scripts', 'bento_customizer_scripts' );
	add_action( 'admin_notices', 'bento_customizer_admin_notice' );
	
	// SiteOrigin Content Builder integration
	add_filter('siteorigin_panels_row_attributes', 'bento_extra_row_attr', 10, 2);
	add_filter('siteorigin_panels_before_row', 'bento_content_builder_row_ids', 10, 3);
	
	// WooCommerce integration
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20, 0 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'woocommerce_before_main_content', 'bento_woo_wrapper_start', 10 );
	add_action( 'woocommerce_single_product_summary', 'bento_woo_product_title', 5 );
	add_action( 'woocommerce_after_main_content', 'bento_woo_wrapper_end', 10 );
	add_action( 'woocommerce_before_single_product_summary', 'bento_woo_single_product_sections_start', 20 );
	add_action( 'woocommerce_after_single_product_summary', 'bento_woo_single_product_sections_end', 20 );
	add_filter( 'woocommerce_enqueue_styles', 'bento_woo_dequeue_styles' );
	add_filter( 'wp_enqueue_scripts', 'bento_woo_dequeue_scripts' );
	add_filter( 'woocommerce_product_add_to_cart_text', 'bento_woo_custom_cart_button_text' );  
	add_filter( 'get_product_search_form', 'bento_woo_custom_product_searchform' );
	add_filter( 'loop_shop_columns', 'bento_woo_loop_columns' );
	add_filter( 'loop_shop_per_page', 'bento_woo_loop_perpage', 20 );
	    
}


// Register and enqueue CSS and scripts
function bento_theme_styles_scripts() {	
	
	// Scripts
	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri().'/includes/fitvids/jquery.fitvids.js', array('jquery'), false, true );
	wp_enqueue_script( 'bento-theme-scripts', get_template_directory_uri().'/includes/js/theme-scripts.js', array('jquery'), false, true );
		
	// Styles
	wp_enqueue_style( 'bento-theme-styles', get_template_directory_uri().'/style.css', array( 'dashicons' ), null, 'all' );
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.0.13/css/all.css', array(), null, 'all' );
	wp_enqueue_style( 'google-fonts', bento_google_fonts(), array(), null );
		
	// Passing php variables to theme scripts
	bento_localize_scripts();

	// Inline styles for customizing the theme
	wp_add_inline_style( 'bento-theme-styles', bento_customizer_css() );
	wp_add_inline_style( 'bento-theme-styles', bento_insert_custom_styles() );
	    
}


// Admin scripts
function bento_admin_scripts() {
	
	// Enqueue scripts
	$screen = get_current_screen();
	$edit_screens = array( 'post', 'page', 'project', 'product' );
	if ( in_array( $screen->id, $edit_screens ) ) {
		wp_enqueue_script( 'bento-admin-scripts', get_template_directory_uri().'/includes/admin/admin-scripts.js', array(), false, true );
	}
	$old_options = get_option( 'satori_options', 'none' );
	if ( $old_options != 'none' ) {
		wp_enqueue_script( 'bento-migrate-scripts', get_template_directory_uri().'/includes/js/migrate-scripts.js' );
	}
	wp_enqueue_style( 'bento-admin-styles', get_template_directory_uri().'/includes/admin/admin-styles.css', array(), null, 'all' );
	
	// Passing php variables to admin scripts
	bento_localize_migrate_scripts();
	
}


// Register theme status for the Expansion Pack
function bento_active() {
	$current_theme = wp_get_theme();
	if ( $current_theme == 'Bento' ) {
		return true;
	} else {
		return false;
	}
}


// Welcome notice and page
	
	// Add welcome message
	function bento_add_welcome_message() {
		$screen = get_current_screen();
		if ( is_admin() && ( 'themes' == $screen->id ) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', 'bento_render_welcome_message', 99 );
		}
	}
	
	// Display welcome message
	function bento_render_welcome_message() {
		?>
			<div class="notice notice-success is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Thank you for choosing Bento! Visit the %swelcome page%s to get the most out of the theme:', 'bento' ), '<a href="' . esc_url( admin_url( 'themes.php?page=about-bento' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=about-bento' ) ); ?>" class="button button-primary" style="text-decoration: none;"><?php esc_html_e( 'Get started with Bento', 'bento' ); ?></a></p>
			</div>
		<?php
	}
	
	// Create the submenu item
	function bento_about_page() {
		add_theme_page( esc_html__( 'Welcome to Bento!', 'bento' ), esc_html__( 'About Bento', 'bento' ), 'edit_theme_options', 'about-bento', 'bento_about_page_content' );
	}
	
	// Render page content
	function bento_about_page_content() {
		$current_theme = wp_get_theme();
		$theme_version = $current_theme->get( 'Version' );
		$theme_actions = array(
			array(
				'name' => 'demo',
				'text' => esc_html__( 'See full demonstration', 'bento' ),
				'url' => esc_url( 'http://satoristudio.net/bento/' ),
				'icon' => '<span class="dashicons dashicons-welcome-view-site"></span>',
			),
			array(
				'name' => 'manual',
				'text' => esc_html__( 'Detailed instructions', 'bento' ),
				'url' => esc_url( 'http://satoristudio.net/bento-manual/' ),
				'icon' => '<span class="dashicons dashicons-book-alt"></span>',
			),
			array(
				'name' => 'support',
				'text' => esc_html__( 'Visit official forum', 'bento' ),
				'url' => esc_url( 'https://wordpress.org/support/theme/bento/' ),
				'icon' => '<span class="dashicons dashicons-sos"></span>',
			),
		);
		$actions_html = '';
		foreach ( $theme_actions as $theme_action ) {
			$action = '
				<div class="bento-welcome-action bento-welcome-'.$theme_action['name'].'">
					<div class="bento-welcome-action-inner">
						<a href="'.$theme_action['url'].'" target="_blank">
							<div class="bento-welcome-action-icon">
								'.$theme_action['icon'].'
							</div>
							<div class="bento-welcome-action-title">
								'.ucfirst($theme_action['name']).'
							</div>
							<div class="bento-welcome-action-text">
								'.$theme_action['text'].'
							</div>
						</a>
					</div>
				</div>
			';
			$actions_html .= $action;
		}
		$upgrade_html = '';
		$ep_features = array(
			array (
				'title' => esc_html__( 'Footer copyright', 'bento' ),
				'text' => esc_html__( 'customize or remove the copyright statement in the footer', 'bento' ),
				'url' => esc_url( '' ),
			),
			array (
				'title' => esc_html__( 'Portfolio', 'bento' ),
				'text' => esc_html__( 'add stunning corporate portfolios, online storefronts, or personal showcases.', 'bento' ),
				'url' => esc_url( 'http://satoristudio.net/bento/portfolio-masonry/' ),
			),
			array (
				'title' => esc_html__( 'Pre-built layouts', 'bento' ),
				'text' => esc_html__( 'simplify the process of creating new pages using ready-made layouts.', 'bento' ),
				'url' => esc_url( 'http://satoristudio.net/bento/pre-built-layouts/' ),
			),
			array (
				'title' => esc_html__( 'Video and maps headers', 'bento' ),
				'text' => esc_html__( 'make your pages stand out with custom header content.', 'bento' ),
				'url' => esc_url( 'http://satoristudio.net/bento/video-background-in-header/' ),
			),
			array (
				'title' => esc_html__( 'Preloaders', 'bento' ),
				'text' => esc_html__( 'show your visitors a stylish progress animation until the page is fully loaded.', 'bento' ),
				'url' => esc_url( 'http://satoristudio.net/bento/preloader/' ),
			),
			array (
				'title' => esc_html__( 'And', 'bento' ),
				'text' => esc_html__( 'tons of other cool features.', 'bento' ),
				'url' => esc_url( 'http://satoristudio.net/bento-free-wordpress-theme/#expansion-pack' ),
			),
		);
		foreach ( $ep_features as $ep_feature ) {
			$link = '';
			if ( $ep_feature['url'] != '' ) {
				$link = '<a href="'.$ep_feature['url'].'" target="_blank">'.esc_html__( 'Preview', 'bento' ).'</a>';
			}
			$upgrade_html .= '
				<li><strong>'.$ep_feature['title'].'</strong>: '.$ep_feature['text'].' '.$link.'</li>';
		}
		?>
			<div class="wrap bento-welcome-container">
				<h1><?php esc_html_e( 'Thank you for choosing Bento!', 'bento' ); ?></h1>
				<div class="bento-welcome-about">
					<div class="bento-welcome-top">
						<a class="bento-welcome-rate" href="<?php echo esc_url( 'https://wordpress.org/support/theme/bento/reviews/' ); ?>" target="_blank">
							<span class="dashicons dashicons-heart"></span>
							<span class="bento-welcome-rate-link">
								<?php esc_html_e( 'Rate the theme', 'bento' ); ?>
							</span>
						</a>
					</div>
					<div class="bento-welcome-description">
						<?php esc_html_e( 'Bento is a powerful yet user-friendly WordPress theme intended for use in the broadest range of web projects. It boasts premium-grade design and is packed with awesome features, some of which are unique for free themes. Bento is mobile-friendly (responsive), retina-ready, optimized for speed, and implements SEO (search engine optimization) best practices. The theme is being constantly maintained by its author and offers regular free updates with bugfixes and additional features.', 'bento' ); ?>
					</div>
				</div>
				<div class="bento-welcome-actions">
					<?php echo $actions_html; ?>
				</div>
				<?php if ( get_option( 'bento_ep_license_status' ) == 'na' ) { ?>
				<div class="bento-welcome-upgrade">
					<h2><?php esc_html_e( 'Supercharge your Bento', 'bento' ); ?> &mdash;</h2>
					<div class="bento-welcome-upgrade-cta">
						<a href="<?php echo esc_url( 'http://satoristudio.net/bento-free-wordpress-theme/#expansion-pack' ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Get the Expansion Pack', 'bento' ); ?></a>
					</div>
					<ul class="bento-welcome-upgrade-features">
						<?php echo $upgrade_html; ?>
					</ul>
				</div>
				<?php } ?>
			</div>
		<?php
	}


// Localize scripts
function bento_localize_scripts() {
	$postid = get_queried_object_id();
	$bento_grid_mode = 'nogrid';
	$bento_grid_setting = get_post_meta( $postid, 'bento_page_grid_mode', true );
	if ( get_page_template_slug($postid) == 'grid.php' ) {
		if ( $bento_grid_setting == 'rows' ) {
			$bento_grid_mode = 'fitRows';
		} else {
			$bento_grid_mode = 'packery';
		}
		$bento_query = new WP_Query( bento_grid_query($postid) );
	} else {
		global $wp_query;
		$bento_query = $wp_query;
	}
	$bento_max_pages = $bento_query->max_num_pages; 
	$bento_query_vars = wp_json_encode( $bento_query->query );
	$bento_full_width_grid = 'off';
	$bento_paged = get_query_var( 'paged', 1 );
    wp_localize_script( 'bento-theme-scripts', 'bentoThemeVars', array(
		'menu_config' => esc_html( get_theme_mod( 'bento_menu_config' ) ),
		'fixed_menu' => esc_html( get_theme_mod( 'bento_fixed_header' ) ),
		'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
	    'query_vars' => $bento_query_vars,
		'paged' => $bento_paged,
        'max_pages' => esc_html( $bento_max_pages ),
		'grid_mode' => esc_html( $bento_grid_mode ),
    ));
	wp_reset_postdata();
}
function bento_localize_migrate_scripts() {
	wp_localize_script( 'bento-migrate-scripts', 'bentoMigrateVars', array(
		'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
	));
}


// Custom styles
function bento_insert_custom_styles() {
	
	$custom_css = '';
	
	// Grid
	$postid = get_queried_object_id();
	if ( is_singular() && get_page_template_slug( $postid ) == 'grid.php' ) {
		$bento_grid_gutter = 10;
		$bento_grid_columns = 3;
		if ( get_post_meta( $postid, 'bento_page_columns', true ) > 0 ) {
			$bento_grid_columns = esc_html( get_post_meta( $postid, 'bento_page_columns', true ) ); 
		}
		$bento_gutter_setting = esc_html( get_post_meta( $postid, 'bento_page_item_margins', true ) ); 
		if ( is_numeric($bento_gutter_setting) ) {
			$bento_grid_gutter = $bento_gutter_setting;
		}
		if ( strpos($bento_gutter_setting, 'px') !== false ) {
			$bento_grid_gutter = substr($bento_gutter_setting, 0, -2);
		}
		
		$custom_css .= '
			@media screen and (min-width: 48em) {
				.grid-masonry.grid-container,
				.grid-rows.grid-container {
					grid-template-columns: repeat( '.$bento_grid_columns.', 1fr );
				}
				.grid-columns.grid-container {
					columns: '.$bento_grid_columns.';
				}
			}
			.grid-container {
				margin: 0 -'.$bento_grid_gutter.'px;	
			}
			.grid-item-inner {
				padding: '.$bento_grid_gutter.'px;	
			}
			.grid-rows .grid-item {
				margin-bottom: '.$bento_grid_gutter.'px;	
				padding-bottom: '.$bento_grid_gutter.'px;	
			}
		';
	}
	
	// Header settings
	if ( is_singular() || is_home() ) {
		$postheader = '';
		if ( get_post_meta( $postid, 'bento_activate_header', true ) != '' && get_post_meta( $postid, 'bento_header_image', true ) != '' ) {
			$postheader = esc_url( get_post_meta( $postid, 'bento_header_image', true ) );
		} else if ( has_post_thumbnail( $postid ) ) {
			$postheader = get_the_post_thumbnail_url( $postid, 'full' );
		}
		if ( is_front_page() && 'page' == get_option('show_on_front') ) {
			if ( get_theme_mod( 'bento_front_header_image' ) != '' ) {
				$postheader_obj = wp_get_attachment_image_src( get_theme_mod( 'bento_front_header_image' ), 'full' );
				if ( $postheader_obj ) {
					$postheader = esc_url( $postheader_obj[0] );
				}
			}	
		} 
		if ( is_home() && 'posts' == get_option( 'show_on_front' ) ) {
			if ( get_theme_mod( 'bento_blog_header_image' ) != '' ) {
				$postheader_obj = wp_get_attachment_image_src( get_theme_mod( 'bento_blog_header_image' ), 'full' );
				if ( $postheader_obj ) {
					$postheader = esc_url( $postheader_obj[0] );
				}
			}
		}
		if ( $postheader != '' ) {
			$custom_css .= '
				.post-header {
					background-image: url('.$postheader.');
				}
			';
		}
	}
	
	// Individual page/post settings
	if ( is_singular() || ( is_home() && 'page' == get_option( 'show_on_front' ) ) ) {
		$custom_css .= '
			.post-header-title h1,
			.entry-header h1 { 
				color: '.esc_html( get_post_meta( $postid, 'bento_title_color', true ) ).'; 
			}
			.post-header-subtitle {
				color: '.esc_html( get_post_meta( $postid, 'bento_subtitle_color', true ) ).';
			}
			.site-content {
				background-color: '.esc_html( get_post_meta( $postid, 'bento_page_background_color', true ) ).';
			}
		';
		if ( get_post_meta( $postid, 'bento_hide_title', true ) == 'on' ) {
			$custom_css .= '
				.post-header-title h1,
				.entry-title:not(.grid-item-header .entry-title),
				.post-header-subtitle { 
					display: none;
				}
			';
		}
		if ( get_post_meta( $postid, 'bento_title_position', true ) == 'center' ) {
			$custom_css .= '
				.post-header-title,
				.post-header-subtitle {
					margin-left: auto;
					margin-right: auto;
				}
				.post-header-title h1,
				.entry-header h1,
				.post-header-subtitle,
				.portfolio-filter,
				.post-header-cta {
					text-align: center;
				}
				.post-header-cta {
					margin-left: 0;
				}
			';
		}
		if ( get_post_meta( $postid, 'bento_uppercase_title', true ) == 'on' ) {
			$custom_css .= '
				.post-header-title h1,
				.entry-header h1 { 
					text-transform: uppercase;
				}
			';
		}
		if ( get_post_meta( $postid, 'bento_activate_header', true ) != '' ) {
			$tile_opacity_raw = esc_html( get_post_meta( $postid, 'bento_header_overlay_opacity', true ) );
			if ( $tile_opacity_raw > 1 ) {
				$tile_opacity_raw = $tile_opacity_raw / 10;
			}
			$header_height = '10%';
			if ( get_post_meta( $postid, 'bento_header_image_height', true ) != 'fh' ) {
				$header_height = esc_html( get_post_meta( $postid, 'bento_header_image_height', true ) );
			}
			$custom_css .= '
				.post-header-overlay {
					background-color: '.esc_html( get_post_meta( $postid, 'bento_header_overlay', true ) ).';
					opacity: '.$tile_opacity_raw.';
				}
				.post-header-subtitle {
					margin-bottom: 0;
				}
				.post-header-cta a,
				.post-header-cta div {
					border-color: '.esc_html( get_post_meta( $postid, 'bento_cta_background_color', true ) ).';
				}
				.post-header-cta .post-header-cta-primary {
					background-color: '.esc_html( get_post_meta( $postid, 'bento_cta_background_color', true ) ).';
					color: '.esc_html( get_post_meta( $postid, 'bento_cta_text_color', true ) ).';
				}
				.post-header-cta .post-header-cta-secondary {
					color: '.esc_html( get_post_meta( $postid, 'bento_cta_background_color', true ) ).';
				}
				.post-header-cta a:hover,
				.post-header-cta div:hover {
					border-color: '.esc_html( get_post_meta( $postid, 'bento_cta_background_color_hover', true ) ).';
				}
				.post-header-cta .post-header-cta-primary:hover {
					background-color: '.esc_html( get_post_meta( $postid, 'bento_cta_background_color_hover', true ) ).';
				}
				.post-header-cta .post-header-cta-secondary:hover {
					color: '.esc_html( get_post_meta( $postid, 'bento_cta_background_color_hover', true ) ).';
				}
				.post-header-cta .post-header-cta-secondary {
					color: '.esc_html( get_post_meta( $postid, 'bento_cta_secondary_color', true ) ).';
					border-color: '.esc_html( get_post_meta( $postid, 'bento_cta_secondary_color', true ) ).';
				}
				.post-header-cta .post-header-cta-secondary:hover {
					color: '.esc_html( get_post_meta( $postid, 'bento_cta_secondary_color_hover', true ) ).';
					border-color: '.esc_html( get_post_meta( $postid, 'bento_cta_secondary_color_hover', true ) ).';
				}
				@media screen and (min-width: 48em) {
					.post-header-title {
						padding-top: '.$header_height.';
						padding-bottom: '.$header_height.';
					}
				}
			';
			if ( get_post_meta( $postid, 'bento_transparent_header', true ) == 'on' && get_theme_mod( 'bento_menu_config' ) != 'side' ) {
				$custom_css .= '
					.site-header.no-fixed-header {
						background: transparent;
						position: absolute;
						top: 0;
						width: 100%;
					}
					.primary-menu > li > .sub-menu {
						border-top-color: transparent;
					}
					.no-fixed-header .primary-menu > li > a, 
					.site-header .mobile-menu-trigger,
					.site-header .ham-menu-trigger {
						color: '.esc_html( get_post_meta( $postid, 'bento_menu_color', true ) ).';
					}
					.no-fixed-header .primary-menu > li > a:hover {
						color: '.esc_html( get_post_meta( $postid, 'bento_menu_color_hover', true ) ).';
					}
				';
			}
		}
		if ( is_front_page() && 'page' == get_option('show_on_front') ) {
			$custom_css .= '
				.post-header-cta a,
				.post-header-cta div {
					border-color: '.esc_html( get_theme_mod( 'bento_front_header_primary_cta_bck_color', '#ffffff' ) ).';
				}
				.post-header-cta .post-header-cta-primary {
					background-color: '.esc_html( get_theme_mod( 'bento_front_header_primary_cta_bck_color', '#ffffff' ) ).';
					color: '.esc_html( get_theme_mod( 'bento_front_header_primary_cta_text_color', '#333333' ) ).';
				}
				.post-header-cta a:hover,
				.post-header-cta div:hover {
					border-color: '.esc_html( get_theme_mod( 'bento_front_header_primary_cta_bck_color_hover', '#cccccc' ) ).';
				}
				.post-header-cta .post-header-cta-primary:hover {
					background-color: '.esc_html( get_theme_mod( 'bento_front_header_primary_cta_bck_color_hover', '#cccccc' ) ).';
				}
				.post-header-cta .post-header-cta-secondary {
					color: '.esc_html( get_theme_mod( 'bento_front_header_secondary_cta_color', '#ffffff' ) ).';
					border-color: '.esc_html( get_theme_mod( 'bento_front_header_secondary_cta_color', '#ffffff' ) ).';
				}
				.post-header-cta .post-header-cta-secondary:hover {
					color: '.esc_html( get_theme_mod( 'bento_front_header_secondary_cta_color_hover', '#cccccc' ) ).';
					border-color: '.esc_html( get_theme_mod( 'bento_front_header_secondary_cta_color_hover', '#cccccc' ) ).';
				}
			';
		}
	}
	
	return $custom_css;
	
}


// Load custom template tags
if ( file_exists( get_template_directory() . '/includes/template-tags.php' ) ) {
	require_once get_template_directory() . '/includes/template-tags.php';
}


// Set the content width
$GLOBALS['content_width'] = 1440;
function bento_theme_adjust_content_width() {
	$content_width = $GLOBALS['content_width'];
	$postid = get_queried_object_id();
	if ( get_theme_mod( 'bento_content_width', 1080 ) > 0 ) {
		$content_width = get_theme_mod( 'bento_content_width', 1080 ) + 360;
		if ( get_theme_mod( 'bento_website_layout', 0 ) == 1 ) {
			$content_width = $content_width + 120;
		}
	}
	if ( ( is_singular() && get_post_meta( $postid, 'bento_sidebar_layout', true ) != 'full-width' ) || is_home() ) {
		$content_width = $content_width * 0.7;
	}
	$GLOBALS['content_width'] = apply_filters( 'bento_theme_adjust_content_width', $content_width );
}


// Add excerpt support for pages
function bento_page_excerpt_support() {
	add_post_type_support( 'page', 'excerpt' );
}


// Enable threaded comments
function bento_enable_threaded_comments() {
if ( !is_admin() ) {
	if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1) )
		wp_enqueue_script('comment-reply');
	}
}


// Register sidebars
function bento_register_sidebars() {
	register_sidebar(
		array(
			'name' => esc_html__( 'Sidebar', 'bento' ),
			'id' => 'bento_sidebar',
			'before_widget' => '<div id="%1$s" class="widget widget-sidebar %2$s clear">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
	));
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer', 'bento' ),
			'id' => 'bento_footer',
			'before_widget' => '<div id="%1$s" class="widget widget-footer %2$s clear">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
	));
	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar(
			array(
				'name' => esc_html__( 'WooCommerce', 'bento' ),
				'id' => 'bento_woocommerce',
				'before_widget' => '<div id="%1$s" class="widget widget-woo %2$s clear">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			)
		);
	}
}


// Comment form defaults
function bento_comment_form_defaults( $defaults ) {
	$defaults['label_submit'] = esc_html__( 'Submit Comment', 'bento' );
    $defaults['comment_notes_before'] = '';
    $defaults['comment_field'] = '
		<div class="comment-form-comment">
			<textarea
				id="comment" 
				name="comment" 
				placeholder="'.esc_html__( 'Comment', 'bento' ).'" 
				cols="45" rows="8" 
				aria-required="true"
			></textarea>
		</div>
	';
	return $defaults;
}


// Move the textarea field to the bottom of comment form
function bento_rearrange_comment_fields( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}


// Comment form fields
function bento_comment_form_fields( $fields ) {
	$commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
	$fields['author'] = '
		<div class="comment-form-field comment-form-author">
			<label for="author">'.esc_html__( 'Name', 'bento' ).'</label>
			<input 
				id="author" 
				name="author" 
				type="text" 
				placeholder="'.esc_html__( 'Name','bento' ).'" 
				value="'.esc_attr( $commenter['comment_author'] ).'" 
				size="30"'.$aria_req.
			' />
		</div>
	';
    $fields['email'] = '
		<div class="comment-form-field comment-form-email">
			<label for="email">'.esc_html__( 'Email', 'bento' ).'</label>
			<input 
				id="email" 
				name="email" 
				type="text" 
				placeholder="'.esc_html__( 'Email','bento' ).'" 
				value="'. esc_attr( $commenter['comment_author_email'] ).'" 
				size="30"'.$aria_req.
			' />
		</div>
	';
	$fields['url'] = '';
	return $fields;
}


// Initialize the metabox class
if ( ! class_exists( 'CMB2_Bootstrap_242' ) ) {
	if ( file_exists( get_template_directory() . '/includes/metaboxes/init.php' ) ) {
		require_once ( get_template_directory().'/includes/metaboxes/init.php' );
	}
}


// Load post settings
if ( file_exists( get_template_directory() . '/includes/admin/post-settings.php' ) ) {
	require_once get_template_directory() . '/includes/admin/post-settings.php';
}


// Initialize the class for activating bundled plugins
if ( file_exists( get_template_directory() . '/includes/plugin-activation/class-tgm-plugin-activation.php' ) ) {
	require_once ( get_template_directory().'/includes/plugin-activation/class-tgm-plugin-activation.php' );
}
function bento_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => __( 'Page Builder', 'bento' ),
			'slug'      => 'siteorigin-panels',
			'required'  => false,
		),
		array(
			'name'      => __( 'Page Builder: Extra Elements', 'bento' ),
			'slug'      => 'so-widgets-bundle',
			'required'  => false,
		),
	);
	// Array of configuration settings
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'bento-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}


// Custom excerpt ellipses
function bento_custom_excerpt_more( $more ) {
	return esc_html__('Continue reading', 'bento').' &rarr;';
}


// Custom logo markup
function bento_get_custom_logo() {
	$logo = '<span class="logo-default">'.get_bloginfo( 'name' ).'</span>';
	$logo_class = 'logo-default-link';
	if ( get_theme_mod( 'custom_logo' ) ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$logo_image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		$logo_full_url = $logo_mobile_url = $logo_image[0];
		$logo = '<img class="logo-fullsize" src="'.esc_url( $logo_full_url ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'" />';
		$logo_class = 'logo-image-link';
	}
	if ( get_theme_mod( 'bento_logo_mobile' ) != '' ) {
		if ( ! get_theme_mod( 'custom_logo' ) ) {
			$logo = '<span class="logo-default logo-fullsize">'.get_bloginfo( 'name' ).'</span>';
			$logo_class = 'logo-default-link';
		}
		$mobile_logo_id = get_theme_mod( 'bento_logo_mobile' );
		$mobile_logo_image = wp_get_attachment_image_src( $mobile_logo_id , 'full' );
		$logo_mobile_url = $mobile_logo_image[0];
		$logo .= '<img class="logo-mobile" src="'.esc_url( $logo_mobile_url ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'" />';
	} else if ( get_theme_mod( 'custom_logo' ) ) {
		$logo .= '<img class="logo-mobile" src="'.esc_url( $logo_full_url ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'" />';
	}
	$logo_html = '<a href="'.esc_url( home_url( '/' ) ).'" class="'.$logo_class.'">'.$logo.'</a>';
	return $logo_html;
}


// Custom excerpt for grid items
function bento_grid_excerpt( $excerpt ) {
	global $bento_parent_page_id; 
	global $post;
	if ( $bento_parent_page_id && $post->ID != $bento_parent_page_id && 'grid.php' == get_page_template_slug( $bento_parent_page_id ) ) {
		$stripped_content = wp_strip_all_tags( strip_shortcodes( get_the_content() ) );
		$content = get_extended( apply_filters( 'the_content', $stripped_content ) );
		$content = str_replace( ']]>', ']]&gt;', $content );
		$length = 300;
		if ( ! has_excerpt() ) {
			$content_main = $content['main'];
			if ( strlen($content_main) > $length ) {
				$pos = strpos( $content_main, ' ', $length );
				if ( $pos === false ) {
					$excerpt = $content_main;
				} else {
					$excerpt = substr( $content_main, 0, $pos );
				}
			} else {
				$excerpt = $content_main;
			}
		}
		$excerpt .= '.. <a href="'.esc_url( get_post_permalink() ).'">&rarr;</a>';
		if ( get_post_format() === 'link' ) { 
			$excerpt = bento_link_format_content();
		} elseif ( get_post_format() === 'quote' ) {
			$excerpt = bento_quote_format_content();
		}
		return '<div class="entry-content grid-item-content">'.$excerpt.'</div>';
	} else {
		return $excerpt; 
	}
}


// Extra body classes
function bento_extra_classes( $classes ) {
	$postid = get_queried_object_id();
    
	// Sidebar configuration	
	if ( is_singular() ) {
		if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
			if ( ! is_active_sidebar( 'bento_woocommerce' ) || get_post_meta( $postid, 'bento_sidebar_layout', true ) == 'full-width' || is_cart() || is_checkout() ) {
				$classes[] = 'no-sidebar';
			} else {
				$classes[] = 'has-sidebar';
				if ( get_post_meta( $postid, 'bento_sidebar_layout', true ) == 'left-sidebar' ) {
					$classes[] = 'left-sidebar';
				} else {
					$classes[] = 'right-sidebar';
				}
			}
		} else {
			if ( ( ! is_active_sidebar( 'bento_sidebar' ) && get_post_type( $postid ) != 'project' ) || get_post_meta( $postid, 'bento_sidebar_layout', true ) == 'full-width' ) {
				$classes[] = 'no-sidebar';
			} else {
				$classes[] = 'has-sidebar';
				if ( get_post_meta( $postid, 'bento_sidebar_layout', true ) != '' ) {
					$classes[] = esc_html( get_post_meta( $postid, 'bento_sidebar_layout', true ) );
				} else {
					$classes[] = 'right-sidebar';
				}
			}
		}
	} else {
		if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
			if ( is_shop() ) {
				$page_id = wc_get_page_id('shop');
				if ( get_post_meta( $page_id, 'bento_sidebar_layout', true ) == 'full-width' ) {
					$classes[] = 'no-sidebar';	
				} else {
					$classes[] = esc_html( get_post_meta( $page_id, 'bento_sidebar_layout', true ) );
					$classes[] = 'has-sidebar';
				}
			} else {
				if ( is_active_sidebar( 'bento_woocommerce' ) ) {
					$classes[] = 'has-sidebar';	
					$classes[] = 'right-sidebar';
				} else {
					$classes[] = 'no-sidebar';	
				}
			}
		} else {
			if ( is_active_sidebar( 'bento_sidebar' ) ) {
				$classes[] = 'has-sidebar';	
				$classes[] = 'right-sidebar';
			} else {
				$classes[] = 'no-sidebar';	
			}
		}
	}
	
	// Boxed website layout
	if ( get_theme_mod( 'bento_website_layout' ) == 1 ) {
		$classes[] = 'boxed-layout';
	}
	
	// Full-width grid
	if ( get_post_meta( $postid, 'bento_grid_full_width', true ) == 'on' && in_array( 'no-sidebar', $classes ) ) {
		$classes[] = 'grid-full-width';
	}
	
	// Extended header
	if ( get_post_meta( $postid, 'bento_activate_header', true ) == 'on' ) {
		$classes[] = 'extended-header';
	}
	
	// Header configuration
	if ( get_theme_mod( 'bento_menu_config' ) == 1 ) {
		$classes[] = 'header-centered';
	} else if ( get_theme_mod( 'bento_menu_config' ) == 2 ) {
		$classes[] = 'header-hamburger';
	} else if ( get_theme_mod( 'bento_menu_config' ) == 3 ) {
		$classes[] = 'header-side';
	} else {
		$classes[] = 'header-default';
	}
	
	// WooCommerce shop columns
	if ( class_exists( 'WooCommerce' ) && is_shop() ) {
		$classes[] = 'shop-columns-'.esc_html( get_theme_mod( 'bento_wc_shop_columns' ) );
	}
	
    return $classes;

}


// Adds a class to post depending on whether it has a thumbnail
function bento_has_thumb_class( $classes ) {
	$postid = get_queried_object_id();
	if ( has_post_thumbnail( $postid ) ) { 
		$classes[] = 'has-thumb'; 
	} else {
		$classes[] = 'no-thumb'; 	
	}
	return $classes;
}


// Remove prefixes from archive page titles
function bento_cleaner_archive_titles($title) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>' ;
	}
    return $title;
}


// Count the number of active widgets
function bento_count_footer_widgets( $params ) {
	global $wp_registered_widgets;
	global $sidebars_widgets;
	$widget_count = 0;
	if ( isset ( $sidebars_widgets['bento_footer'] ) ) {
		foreach ( $sidebars_widgets['bento_footer'] as $widget_id ) {
			if ( function_exists( 'pll_current_language' ) && is_object( $wp_registered_widgets[ $widget_id ]['callback'][0] ) ) {
				$widget_options = get_option( 'widget_' . $wp_registered_widgets[ $widget_id ]['callback'][0]->id_base );
				$widget_number = preg_replace( '/[^0-9.]+/i', '', $widget_id );
				$current_widget_options = $widget_options[ $widget_number ];
				if ( $current_widget_options['pll_lang'] == pll_current_language() ) {
					$widget_count++;
				}
			} else {
				$widget_count ++;
			}
		}
	}	
	if ( isset( $params[0]['id'] ) && $params[0]['id'] == 'bento_footer' ) {
		$class = 'class="column-'.$widget_count.' '; 
		$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']);
	}
	return $params;
}


// Load more posts with ajax
function bento_ajax_pagination() {
	$url = wp_get_referer();
	$post_id = url_to_postid( $url );
	global $bento_parent_page_id; 
	$bento_parent_page_id = $post_id;
	$query_args = bento_grid_query( $post_id ); 
	$query_args['paged'] = $_POST['page'] + 1;
	$post_types = get_post_meta( $post_id, 'bento_page_content_types', true );
	$query_args['post_type'] = $post_types;
	$query_args['post_status'] = 'publish';
	$bento_grid_number_items = get_post_meta( $post_id, 'bento_page_number_items', true );
	if ( ctype_digit($bento_grid_number_items) &&  ctype_digit($bento_grid_number_items) != 0 ) {
		$query_args['posts_per_page'] = (int)$bento_grid_number_items;
	} else {
		$query_args['posts_per_page'] = get_option('posts_per_page');	
	}
	if ( get_page_template_slug($post_id) != 'grid.php' ) {
		$query_args = array(
			'post_type' => 'post',
			'post_status ' => 'publish',
			'orderby' => 'post_date',
			'order' => 'DESC',
			'posts_per_page' => get_option('posts_per_page'),
			'paged' => $_POST['page'] + 1
		);
	}
	$pagination_query = new WP_Query( $query_args );
	if ( $pagination_query->have_posts() ) { 
		while ( $pagination_query->have_posts() ) { 
			$pagination_query->the_post();
			// Include the page content
			if ( get_page_template_slug( $post_id ) == 'grid.php' ) {
				get_template_part( 'content', 'grid' ); 
			} else {
				get_template_part( 'content' ); 
			}
		}
	}
	wp_reset_postdata();
	die();
}


// Custom query for grid pages
function bento_grid_query( $id ) {
	$post_id = $id;
	$bento_grid_query_args = array();
	$post_types = get_post_meta( $post_id, 'bento_page_content_types', true );
	$bento_grid_query_args['post_type'] = $post_types;
	if ( is_front_page() ) {
		$bento_paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
	} else {
		$bento_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	}
	$bento_grid_query_args['paged'] = $bento_paged;
	$bento_grid_number_items = get_post_meta( $post_id, 'bento_page_number_items', true );
	if ( ctype_digit($bento_grid_number_items) && ctype_digit($bento_grid_number_items) != 0 ) {
		$bento_grid_query_args['posts_per_page'] = (int)$bento_grid_number_items;
	} else {
		$bento_grid_query_args['posts_per_page'] = get_option('posts_per_page');	
	}
	$bento_grid_orderby = get_post_meta( $post_id, 'bento_orderby_grid', true );
	if ( $bento_grid_orderby != '' ) {
		$bento_grid_query_args['orderby'] = $bento_grid_orderby;
	}
	$bento_grid_order = get_post_meta( $post_id, 'bento_order_grid', true );
	if ( $bento_grid_order == 'date_created' ) {
		$bento_grid_order = 'date';
	}
	if ( $bento_grid_order != '' ) {
		$bento_grid_query_args['order'] = $bento_grid_order;
	}
	$bento_tax_filter = get_post_meta( $post_id, 'bento_filter_taxonomy', true );
	if ( $bento_tax_filter && $bento_tax_filter != 'all' ) {
		$term = get_term( $bento_tax_filter );
		$bento_grid_query_args['tax_query'] = array(
			array(
				'taxonomy' => $term->taxonomy,
				'field' => 'term_id',
				'terms' => $bento_tax_filter,
			),
		);
	}
	return $bento_grid_query_args;
}


// SiteOrigin Content Builder integration
	
	// Add extra attribute to rows
	function bento_extra_row_attr( $attributes, $grid ) {
		if ( ! empty( $grid['style'] ) ) {
			if ( ! empty ( $grid['style']['class'] ) ) {
				$attributes['data-extraid'] = $grid['style']['class'];
			}
		}
		return $attributes;
	}
	
	// Add divs with ids before each row which has extra classes (useful for one-page layouts)
	function bento_content_builder_row_ids( $code, $grid, $attr ) {
		if ( ! empty( $attr['data-extraid'] ) ) {
			$rowclasses = $attr['data-extraid'];
			$extradiv = '<a id="'.$rowclasses.'"></a>';
			return $extradiv;
		}
	}


// WooCommerce integration

	// Declare new content wrappers
	function bento_woo_wrapper_start() {
		echo '<div class="bnt-container"><div class="content"><main class="site-main"><article>';
	}
	function bento_woo_wrapper_end() {
		echo '</article></main></div>';
		if ( is_shop() ) {
			$page_id = get_option( 'woocommerce_shop_page_id' );
		} else {
			$page_id = get_queried_object_id();
		}
		if ( is_active_sidebar( 'bento_woocommerce' )  ) {
			if ( get_post_meta( $page_id, 'bento_sidebar_layout', true ) != 'full-width' || is_product_category() ) {
				echo '<div class="sidebar widget-area sidebar-woo clear">';
					dynamic_sidebar( 'bento_woocommerce' );
				echo '</div>';
			}
		}
		echo '</div>';
	}
	
	// Remove plugin styling
	function bento_woo_dequeue_styles( $enqueue_styles ) {
		unset( $enqueue_styles['woocommerce-general'] );
		unset( $enqueue_styles['selectWoo'] );
		return $enqueue_styles;
	}
	
	// Remove country selector extras
	function bento_woo_dequeue_scripts() {
		global $wp_scripts; 
        $wp_scripts->remove('selectWoo');
	}
		
	// Hide image placeholder for products without thumbnails
	function woocommerce_template_loop_product_thumbnail() {
		global $post;
		if ( has_post_thumbnail() ) {
			echo get_the_post_thumbnail( $post->ID, 'shop_catalog' );
		}
	}
	
	// Change the "Add to cart" button text 
	function bento_woo_custom_cart_button_text() {
		return '';
	}
	
	// Hide product title if respective option is selected
	function bento_woo_product_title() {
		$page_id = get_queried_object_id();
		if ( get_post_meta( $page_id, 'bento_hide_title', true) != 'on' ) {
			the_title( '<h1 itemprop="name" class="product_title entry-title">', '</h1>' );
		}
	}
	
	// Custom number of products per shop page
	function bento_woo_loop_perpage() {
		$bento_wc_shop_num = esc_html( get_theme_mod( 'bento_wc_shop_number_items' ) );
		return $bento_wc_shop_num;
	}
	
	// Custom number of columns on the shop page
	function bento_woo_loop_columns() {
		$bento_wc_shop_col = 3;
		$bento_wc_settings_shop_col = (int)get_theme_mod( 'bento_wc_shop_columns' );
		if ( is_int($bento_wc_settings_shop_col) && $bento_wc_settings_shop_col > 0 ) 
		$bento_wc_shop_col = $bento_wc_settings_shop_col;
		return $bento_wc_shop_col;
	}
 
	// Adjust single product layout so that the sections flow more naturally
	function bento_woo_single_product_sections_start() {
		echo '<div class="single-product-section-wrap">';
	}
	function bento_woo_single_product_sections_end() { 
		echo '</div>';
		woocommerce_output_related_products(); 
	}
	
	// Custom search form
	function bento_woo_custom_product_searchform( $form ) {
		$form = '
			<form role="search" method="get" class="woocommerce-product-search" action="'.esc_url( home_url( '/'  ) ).'">
				<input type="search" class="search-field" placeholder="'.esc_attr_x( 'Search Products&hellip;', 'placeholder', 'bento' ).'" value="'.get_search_query().'" name="s" title="'.esc_attr_x( 'Search for:', 'label', 'bento' ).'" />
				<input type="submit" value="&#xf179;" />
				<input type="hidden" name="post_type" value="product" />
			</form>
		';
		return $form;
	}
	

?>