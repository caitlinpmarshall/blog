<?php // Template name: Grid ?>

<?php get_header(); ?>

<?php 
// Define variables
$bento_parent_page_id = get_the_ID();
$bento_grid_mode = esc_html( get_post_meta( $bento_parent_page_id, 'bento_page_grid_mode', true ) );
$bento_grid_columns = esc_html( get_post_meta( $bento_parent_page_id, 'bento_page_columns', true ) );
?>

<div class="bnt-container">
    
    <div class="content content-page">
        <main class="site-main grid-main grid-main-<?php echo $bento_grid_mode; ?>">
        	
            <?php 
            // The primary Loop
            if ( have_posts() ) { 
                while ( have_posts() ) { 
                    the_post(); 
                    // Include the page content
                    get_template_part( 'content', 'page' );   					                 
                // End the Loop
                } 
            }
            ?>
			
			    
			<?php	
			// Filter for portfolio items
			$bento_grid_current_content_types = 'post';
			$bento_grid_current_content_types_array = get_post_meta( $bento_parent_page_id, 'bento_page_content_types', true );
			if ( !empty( $bento_grid_current_content_types_array ) ) {
				$bento_grid_current_content_types = implode( $bento_grid_current_content_types_array );
			}
			if ( function_exists( 'bento_ep_portfolio_filter' ) && $bento_grid_current_content_types == 'project' ) {
				bento_ep_portfolio_filter();
			}
			?>
			
			<?php
			// Build the query
			$bento_query = new WP_Query( bento_grid_query( $bento_parent_page_id ) );
			
			// Start the Loop
			if ( $bento_query->have_posts() ) { 
			?>
				
				<div class="spinner-grid">
					<div class="spinner-grid-inner">
						<div class="spinner-circle">
						</div>
					</div>
				</div>
				
				<div class="items-container grid-container grid-<?php echo $bento_grid_mode; ?> grid-columns-<?php echo $bento_grid_columns; ?>">
					
					<?php
					while ( $bento_query->have_posts() ) { 
						$bento_query->the_post(); 
						
						// Render the items
						get_template_part( 'content', 'grid' );  
						
					// End the Loop
					}
					?>
					
				</div>
			
				<?php 
				if ( get_post_meta( $bento_parent_page_id, 'bento_page_ajax_load', true ) == 'on' ) {
					bento_ajax_load_more(); 
				} else {
					bento_grid_pagination();
				}
				
			}
			wp_reset_postdata();
			?>
			
		</main>
	</div>
	
	<?php get_sidebar(); ?>
	
</div>

<?php get_footer(); ?>