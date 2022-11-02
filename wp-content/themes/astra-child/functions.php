<?php
/**
* Astra Child functions and definitions
*
* @link http://codex.wordpress.org/Theme_Development
* @link http://codex.wordpress.org/Child_Themes
*
* @package WordPress
* @subpackage Astra
* @since Astra 3.2.0
*/
	
// Enqueue scripts and styles
function astra_child_scripts(){
	wp_enqueue_style( 'astra-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'astra-style' ));
    wp_enqueue_style( 'astra-child-google-fonts', 'https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Poppins:ital,wght@0,200;0,400;0,700;1,400&display=swap');
}
add_action( 'wp_enqueue_scripts', 'astra_child_scripts' );

/* -------------- Advanced Custom Fields --------------------- */
add_action('acf/init', 'acf_common_block_init');
function acf_common_block_init()
{
	if (function_exists('acf_register_block')) {
		acf_register_block([
			'name'            => 'common-block',
			'title'           => __('Common Block'),
			'description'     => __('Common Block', 'gutenberg-common-block-acf-example'),
			'render_callback' => 'acf_common_block_callback',
			'category'        => 'formatting',
			'icon'            => 'admin-comments',
			'keywords'        => array('button', 'text', 'acf'),
		]);
	}
}

function acf_common_block_callback($block)
{
	if (file_exists(get_stylesheet_directory_uri() . "/templates/acf-common-block.php")) {
		include(get_stylesheet_directory_uri() . "/templates/acf-common-block.php");
	}
}

add_action('acf/init', 'acf_featured_org_init');
function acf_featured_org_init()
{
	if (function_exists('acf_register_block')) {
		acf_register_block([
			'name'            => 'featured-org',
			'title'           => __('Featured Org'),
			'description'     => __('Featured Org'),
			'render_callback' => 'acf_featured_org_callback',
			'category'        => 'formatting',
			'icon'            => 'admin-comments',
			'keywords'        => array('button', 'text', 'acf'),
		]);
	}
}

function acf_featured_org_callback($block)
{
	if (file_exists(get_stylesheet_directory_uri() . "/templates/featured-org.php")) {
		include(get_stylesheet_directory_uri() . "/templates/featured-org.php");
	}
}