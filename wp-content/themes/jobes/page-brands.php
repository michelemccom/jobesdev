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
		
$field = get_post_meta($post->ID, "product_categories", true);
$value = $field['value'];
$choices = $field['choices'];

if( $value ): ?>
<ul>
	<?php foreach( $value as $v ): ?>
	<li>
		<?php echo $choices[ $v ]; ?>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>
		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	</div>
	<?php endwhile; endif; ?>   
</div> <!-- end copy -->

<?php get_footer(); ?>
