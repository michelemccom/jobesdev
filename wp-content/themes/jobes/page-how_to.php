<?php
/**
 * @package WordPress
 * @subpackage Jobes
 * Template Name: How-To
 */

get_header(); ?>
<div id="copy"> 
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
<h1 class="page-title"><?php the_title(); ?></h1>

	<div class="post" id="post-<?php the_ID(); ?>">

		<?php the_content(); ?>
		<ul class="blocks section">
		<?php 
	    $args = array(
	        'post_type' => 'how_to',
	        'posts_per_page' => -1,
	        'order' => 'ASC',
	        'orderby' => 'date'
	        );
	    $the_query = new WP_Query($args);
	    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();?>
	      <li class="block"> 
	      	 <?php if ( has_post_thumbnail() ) {
			    $thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id,'block', true);?>
			   

		      	<?php if (!empty($thumb_url)) { ?>
		      	<div class="round">
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_url[0];?>" width="<?php echo $thumb_url[1];?>" height="<?php echo $$thumb_url[2]; ?>">	</a>
				</div>
				<?php } ?>
		      	<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>

	      	</li>
	    <?php endwhile; endif;wp_reset_postdata();?>
		</ul>	
	</div>

	<?php endwhile; endif; ?>  
</div> <!-- end copy --> 

<?php get_footer(); ?>
