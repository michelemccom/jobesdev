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

		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	</div>
	<?php endwhile; endif; ?>   
</div> <!-- end copy -->

<?php get_footer(); ?>
