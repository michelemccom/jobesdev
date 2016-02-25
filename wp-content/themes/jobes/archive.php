<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header();
?>


		<?php if (have_posts()) : ?>

 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h4>&#8216;<?php single_cat_title(); ?>&#8217; Category</h4>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h4>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h4>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h4>Archive for <?php the_time('F jS, Y'); ?></h4>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h4>Archive for <?php the_time('F, Y'); ?></h4>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h4>Archive for <?php the_time('Y'); ?></h4>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h4>Author Archive</h4>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h4>Blog Archives</h4>
 	  <?php } ?>
<div id="copy"> 
		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class() ?>>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p class="postmetadata">By: <?php the_author_posts_link(); ?> on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?></p>

            <div class="entry">
                <?php echo trim_content($post->post_content, 110); ?>
            </div>
       
            <ul class="postmetadata">
                <li class="comment"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></li>
                <li>Category: <?php the_category(', ') ?></li>
                <li class="share"><?php if (function_exists('sharethis_button')) { sharethis_button(); } ?></a></li>   
                <li>Tags: <?php the_tags( '', ', ', ''); ?></li>            
            </ul>
        </div>


		<?php endwhile; ?>

		<div class="blognav">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
		get_search_form();

	endif;
?>

	</div>

<?php get_footer(); ?>
