<?php
/**
 * Template Name: Featured Organization Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

$classname = "featured-org";
$hero_image = get_field('hero_image');
$organization_name = get_field('organization_name');
$website_link = get_field('website_link');
$focus_areas = get_field('focus_areas');
$organization_description = get_field('organization_description');

get_header();
?>

<section class="section-featured <?php echo $classname ?>">
	<div class="container">
		<div class="d-flex align-items-center">
			<?php
			if (!empty($hero_image)) { ?>
				<figure class="featured-hero-img w-100">
					<img src="<?php echo $hero_image; ?>" alt="<?php echo $hero_image['alt']; ?>" class="w-100">
				</figure>
			<?php } ?>

			<div class="featured-description">
				<?php if (!empty($organization_name)) { ?>
					<h2><?php echo $organization_name; ?></h2>
				<?php }
				if (!empty($organization_description)) { ?>
					<p><?php echo $organization_description; ?></p>
				<?php } ?>
				<?php
				if (!empty($focus_areas)) { ?>
					<p class="focus-areas">Areas of focus: <?php echo $focus_areas; ?></p>
				<?php } ?>
				<?php
				if (!empty($website_link)) { ?>
					<p>Go to <a href="<?php echo $website_link; ?>"><?php echo $organization_name; ?></a> online to learn more.</p>
				<?php } ?>
			</div>


		</div>
	</div>
</section>    

<?php get_footer(); ?>
