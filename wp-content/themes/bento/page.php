<?php // The default template for displaying pages ?>

<?php get_header(); ?>

<?php 
// Define variables
$bento_parent_page_id = get_the_ID();
?>

<div class="bnt-container">
    
    <div class="content content-page">
        <main class="site-main">
        
            <?php 
            // Start the Loop
            if ( have_posts() ) { 
                while ( have_posts() ) { 
                    the_post(); 
                    // Include the page content
                    get_template_part( 'content', 'page' );   	

					// If comments are open or the page has at least one comment, load the comments template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
					
                // End the Loop
                } 
            }
            ?>
    
        </main>
    </div>
    
    <?php get_sidebar(); ?>
    
</div>

<?php get_footer(); ?>