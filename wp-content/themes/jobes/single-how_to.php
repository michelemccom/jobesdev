<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post" id="post-<?php the_ID(); ?>">
		<h1 class="page-title"><?php the_title(); ?></h1>

		<div id="copy"> 
		<?php the_content(); ?>
		
		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	</div>
	<?php endwhile; endif; ?>   

<?php get_footer(); ?>
