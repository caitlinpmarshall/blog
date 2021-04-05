<?php // The template part for displaying comments on posts ?>


<?php 
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) { ?>
    
    	<div class="separator-line">
		</div>
    
        <h3 class="comments-title">
            <?php 
            echo esc_html( get_comments_number() ).' ';
            printf( _nx( 'comment', 'comments', get_comments_number(), 'comment section title', 'bento' ) ); 
            ?>
        </h3>
    
        <?php bento_comments_nav(); ?>
    
        <div class="comment-list">
            <?php
			// The primary comments loop
			wp_list_comments( array(
				'style' => 'div',
				'type' => 'all',
				'avatar_size' => 40,
				'callback' => 'bento_comment',
			) );
            ?>
        </div>
    
        <?php bento_comments_nav(); ?>
    
    <?php } ?>
    
    <?php 
	// Output commment form
    comment_form(); 
    ?>
		
</div>