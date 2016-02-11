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
	<div class="blocks">
		<div class="block one">
			<?php $attachment_id = get_post_meta( $post->ID, 'block_one_image', true ); 
			$image_attributes_one = wp_get_attachment_image_src( $attachment_id, 'block' ); ?>
			<div class="round">
				<img src="<?php echo $image_attributes_one[0];?>" width="<?php echo $image_attributes_one[1];?>" height="<?php echo $image_attributes_one[2]; ?>">	
			</div>
			<a href="<?php echo get_post_meta($post->ID, "block_one_link", true);?>"><?php echo get_post_meta($post->ID, "block_one_text", true);?></a>
		</div>
		<div class="block two">
			<?php $attachment_id = get_post_meta( $post->ID, 'block_two_image', true ); 
			$image_attributes_two = wp_get_attachment_image_src( $attachment_id, 'block' ); ?>
			<div class="round">
				<img src="<?php echo $image_attributes_two[0];?>" width="<?php echo $image_attributes_two[1];?>" height="<?php echo $image_attributes_two[2]; ?>">	
			</div>
			<a href="<?php echo get_post_meta($post->ID, "block_two_link", true);?>"><?php echo get_post_meta($post->ID, "block_two_text", true);?></a>
		</div>
		<div class="block three">
			<?php $attachment_id = get_post_meta( $post->ID, 'block_three_image', true ); 
			$image_attributes_three = wp_get_attachment_image_src( $attachment_id, 'block' ); ?>
			<div class="round">
				<img src="<?php echo $image_attributes_three[0];?>" width="<?php echo $image_attributes_three[1];?>" height="'<?php echo $image_attributes_three[2]; ?>">
			</div>
			<a href="<?php echo get_post_meta($post->ID, "block_three_link", true);?>"><?php echo get_post_meta($post->ID, "block_three_text", true);?></a>
		</div>
	</div>
</div> <!-- end copy -->
<?php endwhile; endif; ?>
<?php get_footer(); ?>
