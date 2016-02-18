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
            //list terms in a given taxonomy (useful as a widget for twentyten)
$terms = get_field('product_categories');

if( $terms ): ?>

	<ul>

	<?php foreach( $terms as $term ): ?>

		<h2><?php echo $term->name; ?></h2>
		<p><?php echo $term->description; ?></p>
		<a href="<?php echo get_term_link( $term ); ?>">View all '<?php echo $term->name; ?>' posts</a>

	<?php endforeach; ?>

	</ul>

<?php endif; ?>


<?php $doctors = get_posts(array(
							'post_type' => 'product',
							'meta_query' => array(
								array(
									'key' => 'brands', // name of custom field
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
						<?php endif; ?>
						hello
								<?php $brands = get_field('brand'); if( $brands ): ?>
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
