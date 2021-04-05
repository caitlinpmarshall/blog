<?php // The template part for displaying the footer of the website ?>

            </div><!-- .site-content -->
			
			<?php // Ensure that the floats are cleared for the side-menu website layout ?>
			<div class="after-content">
			</div>
            
            <footer class="site-footer">
				
				<?php // Footer widget area ?>
				<?php if ( is_active_sidebar( 'bento_footer' )  ) { ?>
                    <div class="widget-area sidebar-footer clear">
                        <div class="bnt-container">
                            <?php dynamic_sidebar( 'bento_footer' ); ?>
                        </div>
                	</div>
                <?php } ?>
                    
				<?php // Footer menu and copyright area ?>
                <div class="bottom-footer clear">
                	<div class="bnt-container">
					
						<?php bento_footer_menu(); ?>
						
                        <?php bento_copyright(); ?>
						
                    </div>
                </div>
                
            </footer><!-- .site-footer -->

		</div><!-- .site-wrapper -->
		
		<?php // Tag for including javascript in the footer; should always be the last element inside the <body> section ?>
		<?php wp_footer(); ?>

	</body>
    
</html>