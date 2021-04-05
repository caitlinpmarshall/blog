<?php // The template part for displaying the header of the website ?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	
    <?php // This part includes meta information and functions ?>
    
    <head>
    	        
		<?php // Various utilities ?>
    	<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="profile" href="http://gmpg.org/xfn/11" />
            	
		<?php // Tag for including header files; should always be the last element inside the <head> section ?>
		<?php wp_head(); ?>
        
    </head>
    
    
    <?php // This encompasses the visible part of the website ?>
    
    <body <?php body_class(); ?>>
	
		<?php wp_body_open(); ?>
	
		<?php do_action('bento_body_top'); ?>
         				
		<div class="site-wrapper clear">

			<header class="site-header no-fixed-header">
            	<div class="bnt-container">
                
                	<?php bento_mobile_menu(); ?>
            		
                    <?php bento_logo(); ?>
                    
                    <?php bento_primary_menu(); ?>
                    
                </div>
            </header>
			
			<!-- .site-header -->
						
			<?php bento_post_header(); ?>
			
        	<div class="site-content">