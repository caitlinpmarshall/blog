<?php 
// The template for displaying archive pages, including category, tag, author, and date archives

get_header(); 
?>

<div class="bnt-container">

	<div class="content content-archive">
        <main class="site-main" role="main">

			<?php 
            // Start the Loop
            if ( have_posts() ) { 
			
				?>
				<header class="archive-header">
				<?php
					the_archive_title( '<h1 class="archive-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					if ( is_author() ) {
						echo wp_kses( '<div class="archive-description">'.get_the_author_meta( 'description' ).'</div>', array( 'div' => array( 'class' => array() ) ) );
					}
				?>
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