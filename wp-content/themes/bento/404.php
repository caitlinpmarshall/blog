<?php 
// The template to use when the URL could not be resolved to an existing page

get_header(); 
?>

<div class="bnt-container">

	<div class="content content-archive">
        <main class="site-main" role="main">

			<section class="error-404 not-found">
				
                <header class="page-header">
					<h1 class="entry-title"><?php esc_html_e( 'This page can&rsquo;t be found.', 'bento' ); ?></h1>
				</header>

				<div class="page-content">
					<p>
						<?php esc_html_e( 'It looks like nothing was found for this URL. You can try clicking the logo to return to the home page or searching using the form below', 'bento' ).' -'; ?>
                    </p>
					<?php get_search_form(); ?>
				</div>
                
			</section>
            
        </main>
    </div>
                        
</div>

<?php get_footer(); ?>