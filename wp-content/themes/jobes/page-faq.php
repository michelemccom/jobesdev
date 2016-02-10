<?php
/**
 * @package WordPress
 * @subpackage Jobes
 * Template Name: FAQs
 */

get_header(); ?>
<div id="copy"> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post" id="post-<?php the_ID(); ?>">
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php the_content(); ?>
		
		<?php 
	    $args = array(
	        'post_type' => 'faq',
	        'posts_per_page' => -1,
	        'order' => 'ASC',
	        'orderby' => 'date'
	        );
	    $the_query = new WP_Query($args);
	    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
	        <a href="<?php the_permalink(); ?>"><?php the_title();?><a href="<?php the_permalink(); ?>">
	    <?php endwhile; endif;wp_reset_postdata();?>
		
	</div>
	<?php endwhile; endif; ?>   
</div> <!-- end copy -->

<?php get_footer(); ?>
