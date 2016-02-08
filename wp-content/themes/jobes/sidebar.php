<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */
?>
	<div id="sidebar">
    	<div class="search">
            <?php get_search_form(); ?>
        </div>
        
        <div class="box" id="social">
        	<h4>Keep in Touch</h4>
            <ul>
            	<li><a href="/feed/"><img src="<?php bloginfo('template_directory'); ?>/images/icon/rss.png" /></a></li>
            	<li><a href="http://www.youtube.com/user/USERNAME"><img src="<?php bloginfo('template_directory'); ?>/images/icon/youtube.png" /></a></li>
            	<li><a href="http://twitter.com/USERNAME"><img src="<?php bloginfo('template_directory'); ?>/images/icon/twitter.png" /></a></li>
            	<li><a href="http://www.flickr.com/groups/USERNAME/"><img src="<?php bloginfo('template_directory'); ?>/images/icon/flickr.png" /></a></li>
            	<li><a href="http://www.facebook.com/USERNAME"><img src="<?php bloginfo('template_directory'); ?>/images/icon/facebook.png" /></a></li>
			</ul>                
		</div>
    <?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>        
	<?php endif; ?>

    </div>  <!-- /sidebar -->