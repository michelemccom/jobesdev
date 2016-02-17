<?php
/**
 * @package WordPress
 * @subpackage Jobes
 * Template Name: Brands
 */

get_header(); ?>
<div id="copy"> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post" id="post-<?php the_ID(); ?>">
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php the_content(); 


$brands = get_post_meta($post->ID, "product_categories", true);


if( $brands ): ?>

	<ul>

	<?php foreach( $brands as $brand ): ?>

		<h2><?php echo $brand->name; ?></h2>
		<p><?php echo $brand->description; ?></p>
		<a href="<?php echo get_term_link( $brand ); ?>">View all '<?php echo $brand->name; ?>' posts</a>

	<?php endforeach; ?>

	</ul>

<?php endif; ?>

		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	</div>
	<?php endwhile; endif; ?>   
</div> <!-- end copy -->

<?php get_footer(); ?>
