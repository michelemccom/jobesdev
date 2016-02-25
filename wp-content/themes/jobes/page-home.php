<?php
/**
 * @package WordPress
 * @subpackage Jobes
 *Template Name: Home Page
 */

get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="banner">
		<?php echo get_post_meta($post->ID, "home_banner_message", true);?>
	</div>
<div id="copy"> 
	<?php the_content(); ?>
	<div class="blocks section">
		<div class="block one">
			<?php $attachment_id = get_post_meta( $post->ID, 'block_one_image', true ); 
			$image_attributes_one = wp_get_attachment_image_src( $attachment_id, 'block' ); ?>
			<div class="round">
				<a href="<?php echo get_post_meta($post->ID, "block_one_link", true);?>"><img src="<?php echo $image_attributes_one[0];?>" width="<?php echo $image_attributes_one[1];?>" height="<?php echo $image_attributes_one[2]; ?>"></a>
			</div>
			<?php $imageText = get_post_meta($post->ID, "one_image_or_subtitle", true);
			if (!empty($imageText)){?>
				<div class="image-text">
				<?php if ($imageText == "image"){
						$attachment_id = get_post_meta( $post->ID, 'block_one_secondary_image', true ); 
						$image_attributes_one_s = wp_get_attachment_image_src( $attachment_id, 'full' ); ?>
						<span><a href="<?php echo get_post_meta($post->ID, "block_one_link", true);?>"><img src="<?php echo $image_attributes_one_s[0];?>" width="<?php echo $image_attributes_one_s[1];?>" height="<?php echo $image_attributes_one_s[2]; ?>"></a></span>
				<?php } elseif ($imageText == "subtitle") { ?>	 
					<h5><a href="<?php echo get_post_meta($post->ID, "block_one_link", true);?>"><?php echo get_post_meta($post->ID, "block_one_subtitle", true);?></a></h5>
				<?php } ?>
				</div>
			<?php } ?>
			<div class="block-content">
				<a href="<?php echo get_post_meta($post->ID, "block_one_link", true);?>"><?php echo get_post_meta($post->ID, "block_one_text", true);?></a>
			</div>
		</div>
		<div class="block two">
			<?php $attachment_id = get_post_meta( $post->ID, 'block_two_image', true ); 
			$image_attributes_two = wp_get_attachment_image_src( $attachment_id, 'block' ); ?>
			<div class="round">
				<a href="<?php echo get_post_meta($post->ID, "block_two_link", true);?>"><img src="<?php echo $image_attributes_two[0];?>" width="<?php echo $image_attributes_two[1];?>" height="<?php echo $image_attributes_two[2]; ?>"></a>
			</div>
			<?php $imageText = get_post_meta($post->ID, "two_image_or_subtitle", true);
			if (!empty($imageText)){?>
				<div class="image-text">
				<?php if ($imageText == "image"){
						$attachment_id = get_post_meta( $post->ID, 'block_two_secondary_image', true ); 
						$image_attributes_two_s = wp_get_attachment_image_src( $attachment_id, 'full' ); ?>
						<span><a href="<?php echo get_post_meta($post->ID, "block_two_link", true);?>"><img src="<?php echo $image_attributes_two_s[0];?>" width="<?php echo $image_attributes_two_s[1];?>" height="<?php echo $image_attributes_two_s[2]; ?>"></a></span>
				<?php } elseif ($imageText == "subtitle") { ?>	 
					<h5><a href="<?php echo get_post_meta($post->ID, "block_two_link", true);?>"><?php echo get_post_meta($post->ID, "block_two_subtitle", true);?></a><a href="<?php echo get_post_meta($post->ID, "block_two_link", true);?>"></h5>
				<?php } ?>
				</div>
			<?php } ?>
			<div class="block-content">
				<a href="<?php echo get_post_meta($post->ID, "block_two_link", true);?>"><?php echo get_post_meta($post->ID, "block_two_text", true);?></a>
			</div>
		</div>
		<div class="block three">
			<?php $attachment_id = get_post_meta( $post->ID, 'block_three_image', true ); 
			$image_attributes_three = wp_get_attachment_image_src( $attachment_id, 'block' ); ?>
			<div class="round">
				<a href="<?php echo get_post_meta($post->ID, "block_three_link", true);?>"><img src="<?php echo $image_attributes_three[0];?>" width="<?php echo $image_attributes_three[1];?>" height="'<?php echo $image_attributes_three[2]; ?>"></a>
			</div>
			<?php $imageText = get_post_meta($post->ID, "three_image_or_subtitle", true);
			if (!empty($imageText)){?>
				<div class="image-text">
				<?php if ($imageText == "image"){
						$attachment_id = get_post_meta( $post->ID, 'block_three_secondary_image', true ); 
						$image_attributes_three_s = wp_get_attachment_image_src( $attachment_id, 'full' ); ?>
						<span><a href="<?php echo get_post_meta($post->ID, "block_three_link", true);?>"><img src="<?php echo $image_attributes_three_s[0];?>" width="<?php echo $image_attributes_three_s[1];?>" height="<?php echo $image_attributes_three_s[2]; ?>"></a></span>
				<?php } elseif ($imageText == "subtitle") { ?>	 
					<h5><a href="<?php echo get_post_meta($post->ID, "block_three_link", true);?>"><?php echo get_post_meta($post->ID, "block_three_subtitle", true);?></a></h5>
				<?php } ?>
				</div>
			<?php } ?>
			<div class="block-content">
				<a href="<?php echo get_post_meta($post->ID, "block_three_link", true);?>"><?php echo get_post_meta($post->ID, "block_three_text", true);?></a>
			</div>
		</div>
	</div>
	<div class="divider"></div>
	<div class="call-out section">
	
		<?php echo wpautop(get_post_meta($post->ID, "call_out_block", true));?>
	</div>
</div> <!-- end copy -->
<?php endwhile; endif; ?>
<?php get_footer(); ?>
