<?php // The default template for displaying content ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 
	
	bento_post_date_blog(); 
	
	bento_post_thumbnail();
	
	bento_post_title();
	
	bento_post_content();
	
	bento_entry_meta();
	
	bento_author_info();
	
	?>
		
</article>