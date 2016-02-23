<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php wp_title('&laquo;', true, 'right'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<?php wp_enqueue_script( "site-jquery", get_bloginfo('template_url')."/js/plugins.js", array( 'jquery' ) ); ?>
<?php wp_enqueue_script( "site-js", get_bloginfo('template_url')."/js/site.js", array( 'site-jquery' ) ); ?>
<!--[if gte IE 9]
<style type="text/css">
.gradient {
filter: none;
}
</style>
<![endif]-->
<!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php if (is_tax('brand')) {  
    $terms = get_terms('brands');
        if( $terms ): ?>
            <?php foreach( $terms as $term ):
                $image = get_field('brand_background', $term );
                 
         if (!empty($image)){ ?> 
            style="background-image: url('<?php echo $image; ?>')" 
            <?php } else {  ?> 
            style="background-image: url(<?php echo get_bloginfo('template_url')?>/images/jobes_bg.png);" }
            <?php } ?>
        <?php } else {  ?> 
        style="background-image: url(<?php echo get_bloginfo('template_url')?>/images/jobes_bg.png);" } 
    <?php } ?>
    ><!--closing body tag-->

<div id="page">

    <div id="header">
        <div class="shell">
             <?php if(is_front_page() ) { ?>
            <h1 id="logo"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?><span></span></a></h1>
                <?php } else { ?>        
            <div id="logo"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?><span></span></a></div>
            <?php } ?>    
            <div class="search">
                <?php get_search_form(); ?>
            </div> 
            <div class="nav">     
    		<?php wp_nav_menu( array( 'theme_location' => 'navigation' ) ); ?>  
            </div>     
              
        </div>      
    </div> <!-- /header -->
    	<div id="content"> 
            <div class="shell gradient">