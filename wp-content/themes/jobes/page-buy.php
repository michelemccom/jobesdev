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
	<ul class="blocks where section">
		<?php 
	    $args = array(
	        'post_type' => 'where',
	        'posts_per_page' => -1,
	        'order' => 'ASC',
	        'orderby' => 'title',
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
	      <li class="block"> 
	      	 <?php if ( has_post_thumbnail() ) {
			    $thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id,'where');?>
			      	<?php if (!empty($thumb_url)) { ?>
			      	<div class="logo-circle"> 
			      		<span>
						<img src="<?php echo $thumb_url[0];?>">	
					</span>
					</div>
					<?php }
				} ?>      	
				<h4><?php the_title();?></h4>

	      	</li>
	    <?php endwhile; endif;wp_reset_postdata();?>
		</ul>	
	<?php endwhile; endif; ?>   
<?php get_footer(); ?>
