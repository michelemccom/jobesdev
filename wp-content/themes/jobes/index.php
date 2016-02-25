<?php
/**
 * @package WordPress
 * @subpackage Basic Starter
 */

get_header(); ?>


	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            
<div id="copy"> 
            <p class="postmetadata">By: <?php the_author_posts_link(); ?> on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?></p>
            
            <div class="entry">
                <?php the_content(); ?>
            </div>
            
            <ul class="postmetadata">
                <li class="comment"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></li>
                <li>Category: <?php the_category(', ') ?></li>
                <li class="share"><?php if (function_exists('sharethis_button')) { sharethis_button(); } ?></li>   
                <li>Tags: <?php the_tags( '', ', ', ''); ?></li>            
            </ul>
        </div>

		<?php endwhile; ?>
        
        <div class="blognav-article">
            <div class="prev-nav"><?php next_posts_link('Previous') ?></div>
            <div class="next-nav"><?php previous_posts_link('Next') ?></div>
        </div>          

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>
<?php get_footer(); ?>
