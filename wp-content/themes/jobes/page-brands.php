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

var_dump($brands);
if( $brands ): ?>
	<ul>
	<?php foreach( $brands as $brand ): // variable must NOT be called $post (IMPORTANT) ?>
	    <li>
	    	<a href="<?php echo get_permalink( $brand->ID ); ?>"><?php echo get_the_title( $brand->ID ); ?></a>
  
         </li>
    <?php endforeach; ?>
    </ul>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>


		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	</div>
	<?php endwhile; endif; ?>   
</div> <!-- end copy -->

<?php get_footer(); ?>
