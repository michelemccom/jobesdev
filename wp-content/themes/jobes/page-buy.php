<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header(); ?>
<div id="copy"> 
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

 <h1 class="page-title"><?php the_title(); ?></h1>

		<?php the_content(); ?>
		
		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

<?php endwhile; endif; ?>   

<?php get_footer(); ?>
