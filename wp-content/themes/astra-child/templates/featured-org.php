<?php
/**
 * Template Name: Featured Organization Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

$id = 'about-' . $block['id'];
$block['className'] = "acf-common-block";
$block_image = get_field('block_image');
$block_heading = get_field('block_heading');
$block_description = get_field('block_description');

get_header();
?>

<section class="section-about <?php echo $block['className'] ?>" id="<?php echo $id; ?>">
	<div class="container">
		<div class="d-flex align-items-center">
			<?php
			if (!empty($block_image)) { ?>
				<figure class="about-hero-img w-100">
					<img src="<?php echo $block_image; ?>" alt="<?php echo $block_image['alt']; ?>" class="w-100">
				</figure>
			<?php } ?>

			<div class="about-description">
				<?php if (!empty($block_heading)) { ?>
					<h2><?php echo $block_heading; ?></h2>
				<?php }
				if (!empty($block_description)) { ?>
					<?php echo $block_description; ?>
				<?php } ?>
			 </div>
		</div>
	</div>
</section>    

<?php get_footer(); ?>
