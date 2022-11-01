<?php
$id = 'about-' . $block['id'];
$block_image = get_field('block_image');
$block_heading = get_field('block_heading');
$block_description = get_field('block_description');
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