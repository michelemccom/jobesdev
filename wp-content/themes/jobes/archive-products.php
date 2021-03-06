<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header();
$url = $_SERVER["REQUEST_URI"];
$parts = parse_url($url);
parse_str($parts['query'], $query);
$pbrand = $query['brands'];
$brandslug = $query['brands'];
$pcat = $query['product_categories'];
if (($pbrand == "jobes") || ($pbrand == "jobes-organics")) { 
	$pbrand = substr_replace($pbrand, "'", 4, 0);;
}
$ptitle = $pbrand.'-'.$pcat;
$ptitle =  str_replace('-', ' ', $ptitle ); ?>
	<?php if (have_posts()) : ?>
<div id="copy"> 
	<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>
	<div class="brand-header">
   	<?php $term_ID = get_term_by( 'slug', $brandslug, 'brands' );
	  	$termID = $term_ID->term_id; ?>
	      <div class="logo-circle">
	        <span>
	          <img src="<?php echo the_field('brand_logo', 'brands_'.$termID);?>" alt="<?php echo $term;?>">
	        </span>
	      </div>

     
	<?php if (!empty($pbrand)) { ?>
	  <div class="brand-tagline"><h2><?php echo $ptitle; ?></h2>
	<?php } else {
		 $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
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
 	  <?php } elseif (is_tax()) {
 	  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'product_categories' ) );
 	  	?>
 	  	<h2><?php echo $term->name;?></h2>
 	 <?php }
	} ?>
	</div>
	<?php $args = array(
        'post_type' => 'brand_cat_desc',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'date',
        'name' => $pbrand.'-'.$pcat
        );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
    	the_content();

    endwhile; endif;wp_reset_postdata();?>
    <div class="btn"><a href="/where-to-buy/?brand=<?php echo $pbrand; ?>">Where to Buy</a></div>
	</div>
	  	<ul class="blocks section">
	  		<span>
		<?php while (have_posts()) : the_post(); ?>
		<li class="block"> 
	      	<?php if ( has_post_thumbnail() ) {
			    $thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id,'block', true);?>
			      	<?php if (!empty($thumb_url[0])) { ?>
			      	<div class="round">
						<img src="<?php echo $thumb_url[0];?>">
					</div>
					<?php }
				} ?>
		     <h4><?php the_title();?></h4>
      	</li>
		<?php endwhile; ?>
		</span>
	</ul>
	<div class="blognav">
			<div class="alignleft"><?php next_posts_link('&laquo; More Products') ?></div>
			<div class="alignright"><?php previous_posts_link('More Products &raquo;') ?></div>
		</div>
	<?php endif;?>
	<h5>A NOTE ABOUT THIS SITE:</h5>
<p>Welcome to the new JobesCompany.com website. As we continue to expand this site in the coming weeks, we'll add more details about each of our products and how you can find them in stores nearby.</p>
</div>


<?php get_footer(); ?>
