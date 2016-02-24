<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header();
$url = $_SERVER["REQUEST_URI"];
$parts = parse_url($url);
parse_str($parts['query'], $query);
$pbrand = $query['brands'];
$pcat = $query['product_categories'];
$ptitle = $pbrand.'-'.$pcat;

$ptitle = preg_replace('/[^a-z]/', " ", $ptitle); ?>
<div id="copy"> 



		<h1 class="page-title"><?php echo $ptitle; ?></h1>
	   <?php $args = array(
	        'post_type' => 'brand_cat_desc',
	        'posts_per_page' => -1,
	        'order' => 'ASC',
	        'orderby' => 'date',
	        'name' => $pbrand.'-'.$pcat
	        );
	    $the_query = new WP_Query($args);
	    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
	    	the_content();

	    endwhile; endif;wp_reset_postdata();?>
		<?php if (have_posts()) : ?>
 	  	<ul class="blocks section">
			<?php while (have_posts()) : the_post(); ?>
			<li class="block"> 
		      	<?php if ( has_post_thumbnail() ) {
				    $thumb_id = get_post_thumbnail_id();
					$thumb_url = wp_get_attachment_image_src($thumb_id,'block', true);?>
				      	<?php if (!empty($thumb_url[0])) { ?>
				      	<div class="round">
							<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_url[0];?>">	</a>
						</div>
						<?php }
					} ?>
			     <h4><?php the_title();?></h4>
	      	</li>
			<?php endwhile; ?>
		</ul>
		<?php endif;?>
		
</div>


<?php get_footer(); ?>
