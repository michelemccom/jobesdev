<?php
/**
 * @package WordPress
 * @subpackage Jobes
 * Template Name: Brands
 */

get_header(); ?>
<div id="copy"> 
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php the_content(); 
		$terms = get_terms( 'brands', 'orderby=count&hide_empty=1' );
		if( $terms ): ?>
			<ul class="blocks section">
			<?php foreach( $terms as $term ): ?>
				<li class="block">
					<?php $circle = get_field('brand_image', $term );
				    if (!empty($circle)) { ?>
				      	<div class="round">
							<a href="<?php the_permalink(); echo $term->slug; ?>"><img src="<?php echo $circle;?>" alt="<?php echo $term->name;?>"></a>
						</div>
					<?php }
					$logo = get_field('brand_logo', $term );
					if (!empty($logo)){?>
						<div class="image-text">
							<span>
								<img src="<?php echo $logo['url']; ?>" />
								
							</span>
						</div>
					<?php } ?>
				</li>
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	<?php endwhile; endif; ?>   
</div> <!-- end copy -->
<?php get_footer(); ?>
