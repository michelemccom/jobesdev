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
			$image_attributes = wp_get_attachment_image_src( $attachment_id );
			get_post_meta( $post->ID, 'block_one_image', true ); 
			var_dump($image_attributes);?>
			<div class="round">
				<img src="<?php echo $image_attributes[0];?>" width="<?php echo $image_attributes[1];?>" height="'<?php echo $image_attributes[2]; ?>">';	
			</div>
			<a href="<?php echo get_post_meta($post->ID, "block_one_link", true);?>"><?php echo get_post_meta($post->ID, "block_one_text", true);?></a>
		</div>
	</div>
</div> <!-- end copy -->
<?php endwhile; endif; ?>
<?php get_footer(); ?>
