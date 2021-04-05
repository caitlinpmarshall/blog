<?php // The default template for single posts ?>

<?php get_header(); ?>

<div class="bnt-container">
    
    <div class="content content-post">
        <main class="site-main" role="main">
        
            <?php 
            // Start the Loop
            if ( have_posts() ) { 
                while ( have_posts() ) { 
                    the_post(); 
                    // Include the post-format-specific template for the content.
					get_template_part( 'content', get_post_format() );
                    
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