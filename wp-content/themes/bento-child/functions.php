	<?php
/**
* Bento Child functions and definitions
*
* @link http://codex.wordpress.org/Theme_Development
* @link http://codex.wordpress.org/Child_Themes
*
* @package WordPress
* @subpackage Bento
* @since Bento 2.0
*/
	
// Enqueue scripts and styles
function bento_child_scripts(){
	wp_enqueue_style( 'bento-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'bento-style' ));
}
add_action( 'wp_enqueue_scripts', 'bento_child_scripts' );