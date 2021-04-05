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