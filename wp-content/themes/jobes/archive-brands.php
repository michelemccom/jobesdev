<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header();
?>

<div id="copy"> 

	<?php if (have_posts()) : ?>

	<ul class="brands">
		<?php while (have_posts()) : the_post(); ?>
	   
	       <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	        
	    <?php endwhile; ?>
	 </ul>
 	<?php endif; ?>   

</div> <!-- end copy -->
<?php get_footer(); ?>
