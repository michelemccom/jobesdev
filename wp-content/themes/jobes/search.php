<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header(); ?>

<div id="copy"> 

	<?php if (have_posts()) : ?>

		<h1>Search Results for "<?php echo $s ?>" (<?php echo $wp_query->found_posts; ?> results)</h1>

		<?php while (have_posts()) : the_post(); ?>

        <div <?php post_class() ?>>
            <h4 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
            <?php the_excerpt(); ?>
        </div>
        <div class="divider"></div>
		<?php endwhile; ?>

		 <?php pagination( $wp_query, "/" ); ?>

	<?php else : ?>

		<h2>No posts found. Try a different search?</h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

</div> <!-- end copy -->

<?php get_footer(); ?>
