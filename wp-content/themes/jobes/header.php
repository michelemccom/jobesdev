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

<body <?php body_class(); ?> 
    <?php $classes = get_body_class();
if (in_array('tax-brands',$classes)) {
    global $post;
    $term_id = get_queried_object_id();
        $image = get_field('brand_background', 'brands_'.$term_id);
        var_dump($image);
        if (!empty($image)){ ?> 
            style="background-image: url(<?php echo $image; ?>);" 
        <?php } else {  ?> 
            style="background-image: url(<?php echo get_bloginfo('template_url')?>/images/jobes_bg.jpg); background-repeat:repeat-y; background-size:contain; "
        <?php } 

} elseif (in_array('term-landscape-fabrics',$classes)) { ?>      
    style="background-image: url(<?php echo get_bloginfo('template_url')?>/images/landscapefabric_bg.jpg); background-repeat:repeat-x;" 
    <?php
} elseif ( is_post_type_archive('products') ) {
    $url = $_SERVER["REQUEST_URI"];
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    $pbrand = $query['brands'];
    $pcat = $query['product_categories'];

    $term_ID_ = get_term_by( 'slug', $pbrand, 'brands' );
    $termID_ = $term_ID_->term_id;
    $image = get_field('brand_background', 'brands_'.$termID_);
    if (!empty($image)){ ?> 
        style="background-image: url(<?php echo $image; ?>)" 
    <?php } else {  ?> 
        style="background-image: url(<?php echo get_bloginfo('template_url')?>/images/jobes_bg.jpg);background-repeat:repeat-y; background-size:contain; "
    <?php } 

} else {  ?> 
    style="background-image: url(<?php echo get_bloginfo('template_url')?>/images/jobes_bg.jpg); background-repeat:repeat-y; background-size:contain; " 
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
              <!--<div class="search">
              <?php get_search_form(); ?> 
            </div> -->
            <div class="nav">     
    		<?php wp_nav_menu( array( 'theme_location' => 'navigation' ) ); ?>  
            </div>     
              
        </div>      
    </div> <!-- /header -->
    	<div id="content"> 
            <div class="shell gradient">