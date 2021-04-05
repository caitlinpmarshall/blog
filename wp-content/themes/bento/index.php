<?php 
// This is the generic template used to display a page when nothing more specific matches the query

get_header(); 
?>

<div class="bnt-container">

	<div class="content content-blog">
        <main class="site-main">

			<?php 
            // Start the Loop
            if ( have_posts() ) { 
                while ( have_posts() ) { 
                    the_post(); 
                    // Include the post-format-specific template for the content.
                    get_template_part( 'content' );
                // End the Loop
                } 
				// Navigation
				if ( get_theme_mod('bento_ajax_pagination') != 1 ) {
					bento_blog_pagination();
				}
            } else {
                // Display a specialized template if no posts have been found
                get_template_part( 'content', 'none' );	
            }
            ?>
            
        </main>
        
        <?php 
		if ( get_theme_mod('bento_ajax_pagination') == 1 ) {
			bento_ajax_load_more(); 
		}
		?>
        
    </div>
            
	<?php get_sidebar(); ?>
            
</div>

<?php get_footer(); ?>