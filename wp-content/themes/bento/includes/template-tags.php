<?php // Custom template tags used within the theme



// Include Google Fonts
if ( ! function_exists( 'bento_google_fonts' ) ) {
	
	function bento_google_fonts() {
		
		$fonts_url = '';
		
		// Define fonts based on Customizer settings
		$body_font = $head_font = 'Open Sans';
		if ( get_theme_mod( 'bento_font_body' ) != '' ) {
			$body_font = esc_html( get_theme_mod( 'bento_font_body' ) );
		}
		if ( get_theme_mod( 'bento_font_headings' ) != '' && get_theme_mod( 'bento_font_headings' ) != 'Open Sans' ) {
			$head_font = esc_html( get_theme_mod( 'bento_font_headings' ) );
		}
		$menu_font = 'Montserrat';
		if ( get_theme_mod( 'bento_font_menu' ) != '' ) {
			$menu_font = esc_html( get_theme_mod( 'bento_font_menu' ) );
		}
		
		// Translators: if there are characters in your language that are not supported by chosen font, translate this to 'off'.
		$body_font_on = _x( 'on', 'Google Font for body text: on or off', 'bento' );
		$head_font_on = _x( 'on', 'Google Font for heading text: on or off', 'bento' );
		$menu_font_on = _x( 'on', 'Google Font for menu text: on or off', 'bento' );
		
		// Construct url query based on chosen fonts
		if ( 'off' !== $body_font_on || 'off' !== $head_font_on || 'off' !== $menu_font_on ) {
			$font_families = array();
			if ( 'off' !== $body_font_on ) {
				$font_families[] = $body_font.':400,700,400italic';
			}
			if ( 'off' !== $head_font_on ) {
				$font_families[] = $head_font.':400,700,400italic';
			}
			if ( 'off' !== $menu_font_on ) {
				$font_families[] = $menu_font.':400,700';
			}
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'cyrillic,latin,latin-ext,greek-ext' ),
			);
			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
        
	}
	
}


// Display the logo
if ( ! function_exists( 'bento_logo' ) ) {
	
	function bento_logo() {
		if ( function_exists('get_custom_logo') ) {
			echo '<div class="logo clear">'.get_custom_logo().'</div>';
		}
	}
    
}


// Primary menu
if ( ! function_exists( 'bento_primary_menu' ) ) {
	
	function bento_primary_menu() {
		if ( ! has_nav_menu( 'primary-menu' ) ) {
			return;
		}
		$depth = '3';
		if ( get_theme_mod( 'bento_menu_config' ) == 2 ) {
			$depth = '1';
		}
		?>
		<div class="header-menu clear">
            <div id="nav-primary" class="nav">
                <nav>
                    <?php 
                    wp_nav_menu( 
                        array( 
                            'theme_location' => 'primary-menu',
                            'depth' => $depth,
                            'menu_class' => 'primary-menu',
                            'container_class' => 'menu-container',
                            'link_before' => '<span class="menu-item-inner">',
                            'link_after' => '</span>',
                            'fallback_cb' => 'false',
                        )
                    );
                    ?>
                </nav>
            </div>
        </div>
		<div class="ham-menu-trigger">
        	<div class="ham-menu-trigger-container">
                <div class="ham-menu-trigger-stick">
                </div>
                <div class="ham-menu-trigger-stick">
                </div>
                <div class="ham-menu-trigger-stick">
                </div>
            </div>
        </div>
		<div class="ham-menu-close-container">
			<div class="ham-menu-close">
			</div>
		</div>
        <?php
	}
	
}


// Mobile menu
if ( ! function_exists( 'bento_mobile_menu' ) ) {
	
	function bento_mobile_menu() {
		if ( ! has_nav_menu( 'primary-menu' ) ) {
			return;
		}
		$menu_depth = 3;
		if ( get_theme_mod( 'bento_mobile_menu_submenus' ) ) {
			$menu_depth = 1;
		}
		
		// Check if menu exists, exit if it doesn't
		$menu = wp_nav_menu(
			array (
				'theme_location' => 'primary-menu',
				'echo' => FALSE,
				'fallback_cb' => '__return_false'
			)
		);
		if ( empty($menu) ) {
			return;
		}
		?>
        <div class="mobile-menu-trigger">
        	<div class="mobile-menu-trigger-container">
                <div class="mobile-menu-trigger-stick">
                </div>
                <div class="mobile-menu-trigger-stick">
                </div>
                <div class="mobile-menu-trigger-stick">
                </div>
            </div>
        </div>
        <div class="mobile-menu">
            <div class="mobile-menu-shadow">
            </div>
            <div id="nav-mobile" class="nav">
            	<div class="mobile-menu-close-container">
                	<div class="mobile-menu-close">
                    </div>
                </div>
                <nav>
                    <?php 
                    wp_nav_menu( 
                        array( 
                            'theme_location' => 'primary-menu',
                            'depth' => $menu_depth,
                            'menu_class' => 'primary-mobile-menu',
                            'container_class' => 'menu-container',
                            'link_before' => '<span class="menu-item-inner">',
                            'link_after' => '</span>',
                            'fallback_cb' => 'false',
                        )
                    );
                    ?>
                </nav>
            </div>
        </div>
        <?php
	}
	
}


// Footer menu
if ( ! function_exists( 'bento_footer_menu' ) ) {
	
	function bento_footer_menu() {
		if ( ! has_nav_menu( 'footer-menu' ) ) {
			return;
		}
		?>
		<div class="footer-menu">
			<div id="nav-footer" class="nav">
				<nav>
					<?php 
					wp_nav_menu( 
						array( 
							'theme_location' => 'footer-menu',
							'depth' => '1',
							'menu_class' => 'menu-footer',
							'container_class' => 'menu-container',
							'link_before' => '<span class="menu-item-inner">',
							'link_after' => '</span>',
							'fallback_cb' => 'false',
						)
					);
					?>
				</nav>
			</div>
		</div>
		<?php
	}
	
}


// Display post header
if ( ! function_exists( 'bento_post_header' ) ) {
	
	function bento_post_header() {
		
		// Set variables
		$postid = $title = $subtitle = $cta = $video_header = '';
		$postid = get_queried_object_id();
				
		// Only display on single posts/pages or blog
		if ( ! is_singular() && ! is_home() ) {
			return;
		}
		
		// Set titles
		if ( is_singular() && get_post_meta( $postid, 'bento_hide_title', true) != 'on' ) {
			$title = '<h1>'.wp_kses( get_the_title(), array( 'br' => array() ) ).'</h1>';
		}
		if ( is_home() && get_option( 'show_on_front' ) == 'posts' ) {
			$title = '';
			if ( get_theme_mod( 'bento_blog_header_title' ) != '' ) {
				$title = '<h1>'.get_theme_mod( 'bento_blog_header_title' ).'</h1>';
			}
			$subtitle = '
				<div class="post-header-subtitle">
					'.get_theme_mod( 'bento_blog_header_subtitle' ).'
				</div>
			';
		}
		if ( is_singular() && has_excerpt( $postid ) ) {
			$subtitle = '
				<div class="post-header-subtitle">
					'.wp_kses( get_the_excerpt( $postid ), array( 'br' => array() ) ).'
				</div>
			';
		}
		
		// Set call-to-action elements
		$cta_front = $cta_primary = $cta_p = $cta_p_old = $cta_p_text = $cta_p_link = $cta_secondary = $cta_s = $cta_s_old = $cta_s_text = $cta_s_link = '';
		if ( is_front_page() && 'page' == get_option('show_on_front') ) {
			$cta_front = 'true';
		}
		if ( get_theme_mod( 'bento_front_header_primary_cta_text' ) != '' && $cta_front == 'true' ) {
			$cta_p = 'on';
			$cta_p_text = get_theme_mod( 'bento_front_header_primary_cta_text' );
			$cta_p_link = get_theme_mod( 'bento_front_header_primary_cta_link' );
		} else if ( get_post_meta( $postid, 'bento_cta_primary_text', true ) != '' ) {
			$cta_p = 'on';
			$cta_p_old = 'true';
			$cta_p_text = get_post_meta( $postid, 'bento_cta_primary_text', true );
			$cta_p_link = get_post_meta( $postid, 'bento_cta_primary_link', true );
		}
		if ( get_theme_mod('bento_front_header_secondary_cta_text') != '' && $cta_front == 'true' ) {
			$cta_s = 'on';
			$cta_s_text = get_theme_mod( 'bento_front_header_secondary_cta_text' );
			$cta_s_link = get_theme_mod( 'bento_front_header_secondary_cta_link' );
		} else if ( get_post_meta( $postid, 'bento_cta_secondary_text', true ) != '' ) {
			$cta_s = 'on';
			$cta_s_old = 'true';
			$cta_s_text = get_post_meta( $postid, 'bento_cta_secondary_text', true );
			$cta_s_link = get_post_meta( $postid, 'bento_cta_secondary_link', true );
		}
		if ( $cta_p == 'on' ) {
			if ( $cta_p_link != '' ) {
				$cta_primary = '
					<a class="post-header-cta-primary" href="'.esc_url( $cta_p_link ).'">
						'.esc_html( $cta_p_text ).'
					</a>
				';
			} else {
				$cta_primary = '
					<div class="post-header-cta-primary">
						'.sprintf( esc_html__( '%s', 'bento' ), esc_html( $cta_p_text ) ).'
					</div>
				';
			}
		}	
		if ( $cta_s == 'on' ) {
			if ( $cta_s_link != '' ) {	
				$cta_secondary = '
					<a class="post-header-cta-secondary" href="'.esc_url( $cta_s_link ).'">
						'.esc_html( $cta_s_text ).'
					</a>
				';
			} else {
				$cta_secondary = '
					<div class="post-header-cta-secondary">
						'.esc_html( $cta_s_text ).'
					</div>
				';
			}
		}
		if ( $cta_primary != '' || $cta_secondary != '' ) {
			$cta = '
				<div class="post-header-cta">
					'.$cta_primary.'
					'.$cta_secondary.'
				</div>
			';
		}
		
		// Set video if defined and if EP is activated
		if ( get_post_meta( $postid, 'bento_header_video_source', true ) != '' && get_option( 'bento_ep_license_status' ) == 'valid' && function_exists('bento_ep_video_header') ) {
			$video_header = bento_ep_video_header();
		}
		
		// Set Google Maps if defined and if EP is activated
		if ( get_post_meta( $postid, 'bento_activate_headermap', true ) == 'on' && get_option( 'bento_ep_license_status' ) == 'valid' ) {
			echo '<div id="bnt-map-canvas"></div>';
			return;
		}
		
		// Render the markup
		if ( 
			( get_post_meta( $postid, 'bento_activate_header', true ) == 'on' && get_post_meta( $postid, 'bento_activate_headermap', true ) != 'on' ) || 
			( is_front_page() && 'page' == get_option('show_on_front') && get_theme_mod( 'bento_front_header_image' ) != '' ) ||
			( is_home() && get_option( 'show_on_front' ) == 'posts' && get_theme_mod( 'bento_blog_header_image' ) != '' )
		) {
			echo '
				<div class="post-header">
					'.$video_header.'
					<div class="post-header-overlay">
					</div>
					<div class="bnt-container post-header-container">
						<div class="post-header-title">
							'.$title.'
							'.$subtitle.'
							'.$cta.'
						</div>
					</div>
				</div>
			';
		}
		
	}
	
}


// Display an optional post thumbnail.
if ( ! function_exists( 'bento_post_thumbnail' ) ) {
	
	function bento_post_thumbnail() {
		
		global $post;
		global $bento_parent_page_id;
		
		// Check if it's one of the situations when a thumbnail is not needed, and exit if yes
		if ( 
			! has_post_thumbnail() || 
			post_password_required() || 
			is_attachment() || 
			get_post_format( $post->ID ) === 'quote' ||
			( ! is_page() && get_post_meta( $post->ID, 'bento_hide_thumb', true ) == 'on' ) ||
			( is_singular() && get_post_meta( $post->ID, 'bento_activate_header', true ) == 'on' && ( $bento_parent_page_id == $post->ID || is_single() ) ) 
		) {
			return;
		}
		
		if ( is_singular() && get_page_template_slug( $bento_parent_page_id ) != 'grid.php' ) {
			?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php 
		} else { 
			?>
			<div class="post-thumbnail">
				<a class="post-thumbnail" href="<?php the_permalink(); ?>">
					<?php
					the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
					?>
				</a>
			</div>
		
			<?php
		}
		
	}
	
}


// Display entry dates in the blog
if ( ! function_exists( 'bento_post_date_blog' ) ) {
	
	function bento_post_date_blog() {
		if ( is_single() ) {
			return;
		}
		if ( get_the_title() == '' || get_post_format() === 'quote' || get_post_format() === 'link' ) {
			$post_date_link = '<a href="'.get_the_permalink().'">';	
			$post_date_link_close = '</a>';
		} else {
			$post_date_link = $post_date_link_close = '';	
		}
		$post_day = esc_html( get_the_date('d') );
		$post_month = esc_html( get_the_date('M') );
		$post_year = esc_html( get_the_date('Y') );
		echo '
			<div class="post-date-blog">
				'.$post_date_link.'
				<div class="post-day">
					'.$post_day.'
				</div>
				<div class="post-month">
					'.$post_month.'
				</div>
				<div class="post-year">
					'.$post_year.'
				</div>
				'.$post_date_link_close.'
			</div>
		';
	}
		
}


// Display post title
if ( ! function_exists( 'bento_post_title' ) ) {
	
	function bento_post_title() {
		
		global $post;
		
		// Check for formats which do not imply a title
		if ( in_array( get_post_format(), array('link','aside','status','quote'), true ) ) {
			return;
		}
		
		// If project post type and has a sidebar, exit
		if ( get_post_type() == 'project' && get_post_meta( $post->ID, 'bento_sidebar_layout', true ) != 'full-width' ) {
			return;
		}
		
		// If extended post header active, exit
		if ( is_singular() && get_post_meta( $post->ID, 'bento_activate_header', true ) == 'on' ) {
			return;
		}
		
		// If front page and Customizer-set header active, exit
		if ( is_front_page() && 'page' == get_option('show_on_front') && get_theme_mod( 'bento_front_header_image' ) != '' ) {
			return;
		}
		
		echo '<header class="entry-header">';
		// Main title
		if ( is_singular() ) {
			if ( get_post_meta( $post->ID, 'bento_hide_title', true) != 'on' ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			}
		} else {
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		}
		// Subtitle
		if ( is_singular() && has_excerpt( $post->ID ) ) {
			echo '
				<div class="post-header-subtitle">
					'.esc_html( get_the_excerpt( $post->ID ) ).'
				</div>
			';
		}
		echo '</header>';
		
	}
		
}


// Display post content according to the post format
if ( ! function_exists( 'bento_post_content' ) ) {
	
	function bento_post_content() {
		
		global $post;
		
		// If project post type and has a sidebar, exit
		if ( get_post_type() == 'project' && get_post_meta( $post->ID, 'bento_sidebar_layout', true ) != 'full-width' ) {
			return;
		}
		
		echo '<div class="entry-content clear">';
		
		// Check for post format and display respective content
		if ( get_post_format() === 'link' ) { 
			if ( bento_link_format_content() != false ) {
				echo bento_link_format_content();
			} else {
				the_content( esc_html__( 'Continue reading', 'bento' ).' &rarr;' );
			}
		} else if ( get_post_format() === 'quote' ) {
			echo bento_quote_format_content();
		} else {
			if ( is_home() && has_excerpt() ) {
				the_excerpt();
			} else {
				the_content( esc_html__( 'Continue reading', 'bento' ).' &rarr;' );	
			}
		}

		// Navigation for paged posts
		wp_link_pages( 
			array(
				'before' => '<div class="page-links">',
				'after' => '</div>',
				'link_before' => '<span class="page-link-text">',
				'link_after' => '</span>',
			) 
		);
		
		echo '</div>';
		
	}
		
}


// Display entry meta
if ( ! function_exists( 'bento_entry_meta' ) ) {

	function bento_entry_meta() {
		
		echo '<footer class="entry-footer">';
		
		// If single post, display tags
		if ( is_singular('post') ) {
			echo '<div class="post-tags">';
				the_tags();
			echo '</div></footer>';
			return;	
		}
		
		// If project, display navigation
		if ( get_post_type() == 'project' && is_singular('project') ) {
			if ( function_exists( 'bento_ep_project_nav' ) ) {
				bento_ep_project_nav();
			}
			return;
		}
		
		// Display a pin for sticky posts
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="sticky-icon"></span>';
		}
				
		// Display post meta - author, category, and comments
		$post_author = '<i>'.esc_html__( 'Posted by', 'bento' ).'</i> <span class="uppercase">'.get_the_author().'</span>';
		$post_categories_ids = wp_get_post_categories( get_the_ID(), array('fields' => 'ids') );
		$post_categories_names = array();
		$post_categories = '';
		if ( ! empty($post_categories_ids) && ( ! in_category('Uncategorized') ) ) {
			foreach ( $post_categories_ids as $c ) {
				$cat = get_category( $c );
				$post_categories_names[] = $cat->name;
			}
			$post_categories_names = implode(", ", $post_categories_names);
			$post_categories = ' <i>'.esc_html__( 'in', 'bento' ).'</i> <span class="uppercase">'.esc_html( $post_categories_names ).'</span>';
		}
		$post_comments = '';
		$num_comments = get_comments_number();
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = esc_html__( '0 comments', 'bento' );
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments .' '. esc_html__( 'comments', 'bento' );
			} else {
				$comments = esc_html__( '1 comment', 'bento' );
			}
			$post_comments = ', <i>'. $comments . '</i>';
		}
		$post_meta = $post_author . $post_categories . $post_comments;
		if ( get_post_type() == 'post' ) {
			echo wp_kses( $post_meta, array( 'span' => array( 'class' => array() ), 'i' => array() ) );
		}
		
		edit_post_link( esc_html__( 'Edit this', 'bento' ), '<div class="edit-this">', '</div>' );
			
		echo '</footer>';
		
	}
	
}


// Display author information in posts
if ( ! function_exists( 'bento_author_info' ) ) {

	function bento_author_info() {
		if ( is_singular('post') && get_theme_mod( 'bento_author_meta' ) != 1 ) {
			?>
            <div class="author-info">
            	<div class="author-avatar">
                	<?php echo get_avatar( get_the_author_meta( 'user_email' ), 80 ); ?>
                </div>
                <div class="author-description">
                	<h3 class="author-name">
						<?php echo esc_html__( 'Posted by', 'bento' ).' '.esc_html( get_the_author() ); ?>
                    </h3>
                    <?php if ( get_the_author_meta( 'description' ) != '' ) { ?>
                    <div class="author-bio">
                    	<?php the_author_meta( 'description' ); ?>
                    </div>
                    <?php } ?>
                    <a class="author-posts" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                    	<?php printf( esc_html__( 'View all posts by %s', 'bento' ), esc_html( get_the_author() ) ); ?>
                    </a>
                </div>
            </div>
            <?php
		}
	}
	
}


// Display comments navigation
if ( ! function_exists( 'bento_comments_nav' ) ) {

	function bento_comments_nav() {
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
		?>
        	<nav class="navigation comment-nav" role="navigation">
                <div class="nav-links">
                    <?php
					if ( $next_link = get_next_comments_link( '&larr; '.esc_html__( 'Newer Comments', 'bento' ) ) ) {
						printf( '<div class="nav-next">%s</div>', $next_link );
					}
					if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'bento' ).' &rarr;' ) ) {
						printf( '<div class="nav-previous">%s</div>', $prev_link );
					}
                    ?>
                </div>
            </nav>
        <?php	
		}
	}
	
}


// Custom comment template
if ( ! function_exists( 'bento_comment' ) ) {

	function bento_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
			<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            	<div class="comment-nested">
                </div>
				<div class="comment-author vcard clear">
					<?php echo get_avatar( $comment, 40 ); ?>
					<div class="fn author-name">
                    	<?php 
						if ( in_array( $comment->comment_type, array( 'pingback','trackback') )  ) {
							comment_author_link(); 
						} else {
							comment_author(); 
						}
						?>
                    </div>
                    <div class="comment-meta">
                        <a href="<?php comment_link() ?>" class="comment-date">
                            <?php comment_date(); ?>
                        </a>
						<?php edit_comment_link( esc_html__( 'Edit', 'bento' ) ); ?>
                        <?php
                        comment_reply_link(
                            array_merge( $args, 
                                array(
                                    'depth' => $depth, 
                                )
                            )
                        );	
                        ?>
                    </div>
				</div>
				<div class="comment-text">
					<?php comment_text(); ?>
				</div>
                <?php if ( $comment->comment_approved == '0' ) { ?>
					<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'bento' ); ?></em>
				<?php } ?>
		<?php
	}
	
}


// Display a pager on the blog and archive pages
if ( ! function_exists( 'bento_blog_pagination' ) ) {

	function bento_blog_pagination() {
		the_posts_pagination( 
			array(
				'prev_text' => '&larr; '.esc_html__( 'Previous page', 'bento' ),
				'next_text' => esc_html__( 'Next page', 'bento' ).' &rarr;',
			) 
		);
	}
	
}


// Display a pager for grid pages
if ( ! function_exists( 'bento_grid_pagination' ) ) {

	function bento_grid_pagination() {
		global $bento_query;
		?>
		<nav class="navigation pagination grid-pagination" role="navigation">
			<h2 class="screen-reader-text">
            	<?php esc_html_e( 'Posts navigation', 'bento' ); ?>
            </h2>
			<div class="nav-links">
				<?php
				if ( is_front_page() ) {
					$paged = get_query_var('page');
				} else {
					$paged = get_query_var('paged');
				}
				echo paginate_links( 
					array(
						'current' => max( 1, $paged ),
						'total' => $bento_query->max_num_pages,
					) 
				);
				?>
			</div>
		</nav>
		<?php
	}
	
}


// Display content for the "link" post type
if ( ! function_exists( 'bento_link_format_content' ) ) {

	function bento_link_format_content() {
		
		$content = get_the_content();
		$first_url = get_url_in_content( $content );
		if ( $first_url ) {
			$anchor = get_the_title();
			return '<a href="'.esc_url( $first_url ).'" title="'.esc_attr( $anchor ).'" target="_blank">'.esc_html( $anchor ).'</a>';
		} else {
			return false;
		}
		
	}
	
}


// Display content for the "quote" post type
if ( ! function_exists( 'bento_quote_format_content' ) ) {

	function bento_quote_format_content() {
		
		$output = '<div class="format-quote-text">'.get_the_content().'</div>';
		$author = esc_html( get_the_title() );
		if ( $author != '' ) {
			$output .= '<div class="format-quote-author">'.$author.'</div>';
		}
		return $output;
		
	}
	
}


// Display the copyright in the footer
if ( ! function_exists( 'bento_copyright' ) ) {

	function bento_copyright() {
		$sitename = esc_attr( get_bloginfo( 'name' ) );
		$author = esc_html__( 'Bento theme by Satori', 'bento' );
		if ( is_front_page() ) {
			$author = 'Bento ' . esc_html__( 'theme by', 'bento' ) . ' <a href="https://satoristudio.net/" target="blank" title="Satori Studio">Satori Studio</a>';
		}
		$copyright = '<div class="footer-copyright">';
		if ( get_option( 'bento_ep_license_status' ) == 'valid' && get_theme_mod( 'bento_footer_copyright' ) != '' ) {
			$copyright .= get_theme_mod( 'bento_footer_copyright' );
		} else {
			$copyright .= '&#169; '.date_i18n( __( 'Y', 'bento') ).' '.$sitename.'. '.$author;
		}
		$copyright .= '</div>';
		echo wp_kses( $copyright, 
			array( 
				'a' => array( 
					'target' => array(), 
					'href' => array(),
					'title' => array(),
				),
				'div' => array(
					'class' => array(),
				),
				'span' => array(),
			)
		);
	}
	
}


// Display the button for the ajax loader
if ( ! function_exists( 'bento_ajax_load_more' ) ) {

	function bento_ajax_load_more() {
	if ( is_home() || is_archive() || is_search() ) {
		$class = '';	
	} else {
		$class = 'grid-ajax-load-more';
	}
	?>
		<a class="ajax-load-more <?php echo esc_html( $class ); ?>">
			<?php esc_html_e( 'Load more', 'bento' ); ?>
        </a>
        <div class="spinner-ajax">
        	<div class="spinner-circle">
            </div>
        </div>
    <?php 
	}

}


// Render masonry tile content
if ( ! function_exists( 'bento_masonry_item_content' ) ) {
	
	function bento_masonry_item_content() {
		
		global $post;
		global $bento_parent_page_id;
		$tile_content = $tile_title = $tile_content_opacity = $tile_text_style = $tile_project_types = $tile_text_color = $tile_background = $tile_image = $tile_overlay = $tile_color = $tile_opacity = '';
		
		// Content
		if ( get_post_format( $post->ID ) === 'quote' ) {
			$tile_title = '"'.esc_html( get_the_content() ).'"<br><br><em>'.esc_html( get_the_title() ).'</em>';
		} else {
			$tile_title = esc_html( get_the_title() );
		}
		if ( get_post_meta( $bento_parent_page_id, 'bento_hide_tile_overlays', true) == 'on' ) {
			$tile_content_opacity = 'style="opacity: 0.0"';
		}
		$tile_types = get_post_meta( $bento_parent_page_id, 'bento_page_content_types', true );
		if ( is_array( $tile_types ) ) {
			if ( implode( $tile_types ) == 'project' ) {
				$types_objects = get_the_terms( $post->ID, 'project_type' );
				$tile_project_types_list = array();
				if ( $types_objects != false ) {
					foreach ( $types_objects as $types_object ) {
						$tile_project_types_list[] = esc_html( $types_object->name );
					}
					$tile_project_types_list = implode(', ', $tile_project_types_list);
					$tile_project_types = '<div class="project-tile-types">'.$tile_project_types_list.'</div>';
				}
			}
		}
		$tile_text_color = 'color:'.esc_html( get_post_meta( $post->ID, 'bento_tile_text_color', true ) ).';';
		$tile_text_size = 'font-size:'.esc_html( get_post_meta( $post->ID, 'bento_tile_text_size', true ) ).'px;';
		$tile_text_style .= 'style="'.$tile_text_color.$tile_text_size.'"';
		$tile_content .= '
			<div class="masonry-item-content" '.$tile_content_opacity.'>
				<header class="entry-header grid-item-header masonry-item-header">
					<h2 class="entry-title" '.$tile_text_style.'>'.$tile_title.'</h2>
				</header>
				'.$tile_project_types.'
			</div>
		';
		
		// Background
		if ( get_post_meta( $post->ID, 'bento_tile_image', true ) != '' ) {
			$tile_image = esc_url( get_post_meta( $post->ID, 'bento_tile_image', true ) );
		} else if ( has_post_thumbnail() ) {
			$post_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			$tile_image = esc_url( $post_thumb[0] );
		}
		$tile_background .= 'style=background-image:url("'.$tile_image.'")';
		$tile_opacity_raw = '0.6';
		if ( get_post_meta( $post->ID, 'bento_tile_overlay_opacity', true) != '' ) {
			if ( get_post_meta( $bento_parent_page_id, 'bento_hide_tile_overlays', true) != 'on' ) {
				$tile_opacity_raw = esc_html( get_post_meta( $post->ID, 'bento_tile_overlay_opacity', true) );
				if ( $tile_opacity_raw > 1 ) {
					$tile_opacity_raw = $tile_opacity_raw / 10;
				}
				$tile_opacity = 'opacity:'.$tile_opacity_raw.';';
			} else {
				$tile_opacity = 'opacity: 0.0';
			}
		}
		if ( get_post_meta( $post->ID, 'bento_tile_overlay_color', true ) != '' ) {
			$tile_color = 'background-color:'.esc_html( get_post_meta( $post->ID, 'bento_tile_overlay_color', true ) ).';';
		}
		$tile_overlay .= 'style="'.$tile_color.$tile_opacity.'"';
		$tile_content .= '
			<div class="masonry-item-overlay" '.$tile_overlay.'>
			</div>
			<div class="masonry-item-image" '.$tile_background.'>
			</div>
		';
		
		echo $tile_content;
		
	}
	
}


?>