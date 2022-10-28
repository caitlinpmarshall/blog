<?php
/**
 * Template Name: API Display
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php astra_primary_class(); ?>>
		<div class="wrapper">
			<button class="api-button" onclick="callAPI()">click me</button>
			<h2 class="api-fact-text" id="fact"></h2>

			<script>
				async function callAPI() {
					const fact = document.getElementById('fact');
					try {
						const res = await fetch(
							"<?php echo get_stylesheet_directory_uri() . '/random-fact.php'?>"
						);
						const response = await res.json();
						fact.innerText = response.Fact;
					} catch (err) {
						console.log(err);
					}
				}
			</script>
		</div>

	</div>


<?php get_footer(); ?>
