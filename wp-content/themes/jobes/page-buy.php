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
$pbrand = $query['brand'];?>
<div id="copy"> 
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<ul class="section">
		<?php 
	    $args = array(
	        'post_type' => 'where',
	        'posts_per_page' => -1,
	        'order' => 'ASC',
	        'orderby' => 'date',
	         'tax_query' => array(
           
	             array(
	            'taxonomy'      => 'brands', 
	            'terms'         => $pbrand,
	            'field'         => 'slug'
	            	)
	         )
	        );
	    $the_query = new WP_Query($args);
	    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();?>
	    <li><?php the_title(); ?></li>
	    <?php endwhile; endif;wp_reset_postdata();?>
	</ul>
	<?php endwhile; endif; ?>   
<?php get_footer(); ?>
