	<?php
/**
* Twenty Twenty One Child functions and definitions
*
* @link http://codex.wordpress.org/Theme_Development
* @link http://codex.wordpress.org/Child_Themes
*
* @package WordPress
* @subpackage twentytwentyone
* @since twentytwentyone 2.0
*/
	
// Enqueue scripts and styles
function twentytwentyone_child_scripts(){
	wp_enqueue_style( 'twentytwentyone-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'twentytwentyone-style' ));
}
add_action( 'wp_enqueue_scripts', 'twentytwentyone_child_scripts' );