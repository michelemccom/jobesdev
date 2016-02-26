<?php
/**
 * @package WordPress
 * @subpackage Jobes
 * Template Name: Where to Buy
 */

get_header(); 
$url = $_SERVER["REQUEST_URI"];
$parts = parse_url($url);
parse_str($parts['query'], $query);
$pbrand = $query['brands'];?>
<div id="copy"> 
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php the_content(); ?>

		<?php 
	    $args = array(
	        'post_type' => 'how_to',
	        'posts_per_page' => -1,
	        'order' => 'ASC',
	        'orderby' => 'date'
	        );
	    $the_query = new WP_Query($args);
	    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();?>
	    <?php endwhile; endif;wp_reset_postdata();?>
	<?php endwhile; endif; ?>   
<?php get_footer(); ?>
