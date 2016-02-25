<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header();
?>

<div id="copy"> 
	<img src="<?php echo get_bloginfo('template_url')?>/images/404.png" />
	<div class="right-copy">
		<p class="red">404 (Page Not Found) Error</p>	
	    <h2>Whoops,</h2>
	    <h5>Looks like you're in the woods</h5>
		<p>Find what you're looking for at <a href="/">home</a>.</p>
	</div>

</div>

<?php get_footer(); ?>