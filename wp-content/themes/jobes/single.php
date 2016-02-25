<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header();
?>


	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
        <h1><?php the_title(); ?></h1>

        <div id="copy"> 
        <p class="postmetadata">By: <?php the_author_posts_link(); ?> on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?></p>
        
        <div class="entry">
            <?php  the_content();?>
        </div>
        
        <ul class="postmetadata">
            <li class="comment"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></li>
            <li>Category: <?php the_category(', ') ?></li>
            <li class="share"><?php if (function_exists('sharethis_button')) { sharethis_button(); } ?></li>   
            <li>Tags: <?php the_tags( '', ', ', ''); ?></li>            
        </ul>
    </div>

	<?php comments_template(); ?>
    
    <div class="blognav">
        <div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
        <div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
    </div>    

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

	<?php endif; ?>

</div> 
<?php get_footer(); ?>
