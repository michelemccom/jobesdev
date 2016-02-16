<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header();
?>

<div id="copy"> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
        <h1 class="page-title"><?php the_title(); ?></h1>
        
            <?php  the_content();
  		$brands = get_field('brand');

						?>
						<?php if( $brands ): ?>
							<ul>
							<?php foreach( $brands as $brand ): ?>
								<li>
									<a href="<?php echo get_permalink( $brand->ID ); ?>">
										<?php echo get_the_title( $brand->ID ); ?>
									</a>
								</li>
							<?php endforeach; ?>
							</ul>
					<?php endif; ?>

      
    </div>

<?php endwhile; endif; ?>   

</div> <!-- end copy -->
<?php get_footer(); ?>
