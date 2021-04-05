<?php // The template part used when no posts can be found ?>

<section class="no-results">
	
    <header class="page-header">
		<h1 class="page-title entry-title">
			<?php esc_html_e( 'Nothing Found', 'bento' ); ?>
        </h1>
	</header>

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
			<p>
				<?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'bento' ), esc_url( admin_url( 'post-new.php' ) ) ); ?>
            </p>
		<?php } elseif ( is_search() ) { ?>
			<p>
				<?php echo esc_html__( 'Sorry, but nothing matched your search terms', 'bento' ).', "<i>'.get_search_query().'"</i>. '.esc_html__( 'Please try using different keywords', 'bento' ).' -'; ?>
            </p>
			<?php get_search_form(); ?>
		<?php } else { ?>
			<p>
				<?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help', 'bento' ).' -'; ?>
            </p>
			<?php get_search_form(); ?>
		<?php } ?>

	</div>
    
</section>
