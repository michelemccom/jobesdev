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
</div> <!-- end copy -->
<?php endwhile; endif; ?>
<?php get_footer(); ?>
