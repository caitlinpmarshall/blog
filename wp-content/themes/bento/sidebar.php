<?php
// The template for rendering the sidebar, i.e. the primary widget area

// Reset the query
wp_reset_query();

// Display the content if it's a project post type
if ( get_post_type() == 'project' ) {
	if ( get_post_meta( $post->ID, 'bento_sidebar_layout', true ) != 'full-width' ) {
	?>
	<div class="sidebar project-info">
		<?php 
		if ( function_exists('bento_ep_project_sidebar') ) { 
			bento_ep_project_sidebar(); 
		} 
		?>
	</div>
	<?php 
	}
// Otherwise, check for the cases when no sidebar is needed and then display the classic sidebar
} else {
	if ( is_active_sidebar( 'bento_sidebar' ) ) { 
		if ( class_exists( 'WooCommerce' ) ) { 
			if ( is_cart() || is_checkout() ) {
				return;
			}
		}
		if ( is_singular() && isset( $post->ID ) && get_post_meta( $post->ID, 'bento_sidebar_layout', true ) == 'full-width' ) {
			return;	
		} else {
			// Display the widgetized sidebar
			?>
			<div class="sidebar widget-area">
				<?php dynamic_sidebar('bento_sidebar'); ?>
			</div>
			<?php 
		}
	}
}
?>