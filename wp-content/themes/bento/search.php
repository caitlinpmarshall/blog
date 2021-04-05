<?php 
// The template for displaying search results

get_header(); 
?>

<div class="bnt-container">

	<div class="content content-search">
        <main class="site-main">

			<?php 
            // Start the Loop
            if ( have_posts() ) { 
			
				?>
				<header class="archive-header">
                	<div class="archive-description">
                    	<?php esc_html_e( 'Search results for', 'bento' ); ?>
                    </div>
					<h1 class="archive-title">
						"<?php echo get_search_query(); ?>"
                    </h1>
				</header>
                <?php
			
                while ( have_posts() ) { 
                    the_post(); 
                    // Include the post-format-specific template for the content.
                    get_template_part( 'content' );
                // End the Loop
                } 
				// Navigation
				bento_blog_pagination();
            } else {
                // Display a specialized template if no posts have been found
                get_template_part( 'content', 'none' );	
            }
            ?>
            
        </main>
    </div>
            
	<?php get_sidebar(); ?>
            
</div>

<?php get_footer(); ?>