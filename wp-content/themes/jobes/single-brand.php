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

            $doctors = get_posts(array(
							'post_type' => 'brand',
							'meta_query' => array(
								array(
									'key' => 'product', // name of custom field
									'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
									'compare' => 'LIKE'
								)
							)
						));

						?>
						<?php if( $doctors ): ?>
							<ul>
							<?php foreach( $doctors as $doctor ): ?>
								<?php 

								$photo = get_field('photo', $doctor->ID);

								?>
								<li>
									<a href="<?php echo get_permalink( $doctor->ID ); ?>">
								
										<?php echo get_the_title( $doctor->ID ); ?>
									</a>
								</li>
							<?php endforeach; ?>
							</ul>
						<?php endif; 
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
