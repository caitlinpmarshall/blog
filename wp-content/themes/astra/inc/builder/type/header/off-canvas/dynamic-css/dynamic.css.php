<?php
/**
 * Off Canvas - Dynamic CSS
 *
 * @package astra-builder
 * @since 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Off Canvas Row.
 */
add_filter( 'astra_dynamic_theme_css', 'astra_off_canvas_row_setting', 11 );

/**
 * Off Canvas Row - Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return String Generated dynamic CSS for Heading Colors.
 *
 * @since 3.0.0
 */
function astra_off_canvas_row_setting( $dynamic_css, $dynamic_css_filtered = '' ) {

	$selector = '.ast-mobile-popup-drawer.active';

	$off_canvas_background       = astra_get_option( 'off-canvas-background' );
	$off_canvas_close_color      = astra_get_option( 'off-canvas-close-color' );
	$offcanvas_content_alignment = astra_get_option( 'header-offcanvas-content-alignment', 'flex-start' );
	$padding                     = astra_get_option( 'off-canvas-padding' );
	$menu_content_alignment      = 'center';
	$inner_spacing               = astra_get_option( 'off-canvas-inner-spacing' );

	$inner_spacing = ( isset( $inner_spacing ) ) ? (int) $inner_spacing : '';

	if ( 'flex-start' === $offcanvas_content_alignment ) {
		$menu_content_alignment = 'left';
	} elseif ( 'flex-end' === $offcanvas_content_alignment ) {
		$menu_content_alignment = 'right';
	}

	/**
	 * Off-Canvas CSS.
	 */
	$css_output = array(

		$selector . ' .ast-mobile-popup-inner' => astra_get_background_obj( $off_canvas_background ),

		'.ast-mobile-header-wrap .ast-mobile-header-content, .ast-desktop-header-content' => astra_get_background_obj( $off_canvas_background ),
		'.ast-mobile-popup-drawer.active .ast-desktop-popup-content, .ast-mobile-popup-drawer.active .ast-mobile-popup-content' => array( 
			// Padding CSS.
			'padding-top'    => astra_responsive_spacing( $padding, 'top', 'desktop' ),
			'padding-bottom' => astra_responsive_spacing( $padding, 'bottom', 'desktop' ),
			'padding-left'   => astra_responsive_spacing( $padding, 'left', 'desktop' ),
			'padding-right'  => astra_responsive_spacing( $padding, 'right', 'desktop' ),
		),
		'.ast-mobile-popup-content > *, .ast-mobile-header-content > *, .ast-desktop-popup-content > *, .ast-desktop-header-content > *' => array(
			'padding-top'    => astra_get_css_value( $inner_spacing, 'px' ),
			'padding-bottom' => astra_get_css_value( $inner_spacing, 'px' ),
		),
		'.content-align-' . esc_attr( $offcanvas_content_alignment ) . ' .ast-builder-layout-element' => array(
			'justify-content' => esc_attr( $offcanvas_content_alignment ),
		),
		'.content-align-' . esc_attr( $offcanvas_content_alignment ) . ' .main-header-menu' => array(
			'text-align' => esc_attr( $menu_content_alignment ),
		),
	);

	$css_output[ $selector . ' .ast-mobile-popup-drawer.active .menu-toggle-close' ]['color'] = $off_canvas_close_color;

	/* Parse CSS from array() */
	$css_output = astra_parse_css( $css_output );

	// Tablet CSS.
	$css_output_tablet = array(
		'.ast-mobile-popup-drawer.active .ast-desktop-popup-content, .ast-mobile-popup-drawer.active .ast-mobile-popup-content' => array( 
			// Padding CSS.
			'padding-top'    => astra_responsive_spacing( $padding, 'top', 'tablet' ),
			'padding-bottom' => astra_responsive_spacing( $padding, 'bottom', 'tablet' ),
			'padding-left'   => astra_responsive_spacing( $padding, 'left', 'tablet' ),
			'padding-right'  => astra_responsive_spacing( $padding, 'right', 'tablet' ),
		),
	);

	$css_output_mobile = array(

		'.ast-mobile-popup-drawer.active .ast-desktop-popup-content, .ast-mobile-popup-drawer.active .ast-mobile-popup-content' => array( 
			// Padding CSS.
			'padding-top'    => astra_responsive_spacing( $padding, 'top', 'mobile' ),
			'padding-bottom' => astra_responsive_spacing( $padding, 'bottom', 'mobile' ),
			'padding-left'   => astra_responsive_spacing( $padding, 'left', 'mobile' ),
			'padding-right'  => astra_responsive_spacing( $padding, 'right', 'mobile' ),
		),
	);

	$css_output .= astra_parse_css( $css_output_tablet, '', astra_get_tablet_breakpoint() );
	$css_output .= astra_parse_css( $css_output_mobile, '', astra_get_mobile_breakpoint() );

	$dynamic_css .= $css_output;

	return $dynamic_css;
}
