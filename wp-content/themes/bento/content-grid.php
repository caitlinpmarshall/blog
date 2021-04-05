<?php // The template for displaying grid items ?>

<?php
// Define variables
global $bento_parent_page_id; 
$bento_tile_size = 'tile-'.get_post_meta( get_the_ID(), 'bento_tile_size', true );
$bento_tile_hide_overlay = '';
if ( get_post_meta( get_the_ID(), 'bento_hide_tile_overlays', true) != 'on' ) {
	$bento_tile_hide_overlay = 'hide-overlay';
}
$bento_class_array = array( $bento_tile_size, $bento_tile_hide_overlay, 'grid-item' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $bento_class_array ); ?>>

	<?php 
	// Masonry layout elements
	if ( get_post_meta( $bento_parent_page_id, 'bento_page_grid_mode', true ) == 'masonry' ) {
	?>
		
		<div class="masonry-item-before">
        </div>
        
        <div class="masonry-item-inner grid-item-inner">
        	<div class="masonry-item-box grid-item-box">
            	<a class="masonry-item-link" href="<?php echo esc_url( get_permalink() ); ?>">
                    <?php bento_masonry_item_content(); ?>
                </a>
            </div>
        </div>
        
	<?php 	
	// Column and row layout elements
	} else {
	?>
    
    	<div class="grid-item-inner">
        	<div class="grid-item-box">
	
				<?php bento_post_thumbnail(); ?>
                
                <?php if ( ! in_array(get_post_format(), array('link','aside','status','quote'), true ) ) { ?>
                    <header class="entry-header grid-item-header">
                        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                    </header>
                <?php } ?>
                
				<?php the_excerpt(); ?>
                
                <?php bento_entry_meta(); ?>
                
            </div>
        </div>
        
    <?php } ?>

</article>