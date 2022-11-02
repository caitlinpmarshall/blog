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
$hero_image = get_field('hero_image');
$organization_name = get_field('organization_name');
$website_link = get_field('website_link');
$organization_description = get_field('organization_description');


get_header();
?>

<section class="section-about <?php echo $block['className'] ?>" id="<?php echo $id; ?>">
	<div class="container">
		<div class="d-flex align-items-center">
			<?php
			if (!empty($hero_image)) { ?>
				<figure class="about-hero-img w-100">
					<img src="<?php echo $hero_image; ?>" alt="<?php echo $hero_image['alt']; ?>" class="w-100">
				</figure>
			<?php } ?>

			<div class="about-description">
				<?php if (!empty($organization_name)) { ?>
					<h2><?php echo $organization_name; ?></h2>
				<?php }
				if (!empty($organization_description)) { ?>
					<?php echo $organization_description; ?>
				<?php } ?>
			 </div>
		</div>
	</div>
</section>    

<?php get_footer(); ?>
