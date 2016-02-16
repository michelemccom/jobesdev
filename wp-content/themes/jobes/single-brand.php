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
$taxonomy = 'type';
$tax_terms = get_terms($taxonomy);
?>
<ul>
<?php
foreach ($tax_terms as $tax_term) {
echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
}
?>
</ul>

            <?php $doctors = get_posts(array(
							'post_type' => 'product',
							'meta_query' => array(
								array(
									'key' => 'brand', // name of custom field
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
