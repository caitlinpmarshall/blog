<?php // The template for displaying page content ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php bento_post_thumbnail(); ?>
	
	<?php bento_post_title(); ?>
    
    <div class="entry-content clear">
		
		<?php the_content();
		
		// Navigation for paged pages
		wp_link_pages( 
			array(
				'before' => '<div class="page-links">',
				'after' => '</div>',
				'link_before' => '<span class="page-link-text">',
				'link_after' => '</span>',
			) 
		);
		
		?>
		
	</div>

</article>