<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */
 
add_theme_support( 'automatic-feed-links' );

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
}

// Remove some Admin menu items
function remove_admin_menu_item(){
	global $menu;
	unset($menu[15]);
}
add_action('admin_menu', 'remove_admin_menu_item');

// Remove some dashboard widgets
function remove_wp_dashboard_widgets() {
	wp_unregister_sidebar_widget( 'dashboard_primary' );
	wp_unregister_sidebar_widget( 'dashboard_secondary' );
	wp_unregister_sidebar_widget( 'dashboard_plugins' );
	wp_unregister_sidebar_widget( 'dashboard_recent_comments' );
	wp_unregister_sidebar_widget( 'dashboard_recent_drafts' );
	remove_meta_box('dashboard_primary', 'dashboard', 'side');
	remove_meta_box('dashboard_secondary', 'dashboard', 'side');
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
}
add_action( 'wp_dashboard_setup', 'remove_wp_dashboard_widgets' );

// Remove some boxes from Post pages
function remove_post_boxes() {
	remove_meta_box('postcustom', 'post', 'normal');
	remove_meta_box('postcustom', 'page', 'normal');
	remove_meta_box('pagecustomdiv', 'page', 'normal');
	remove_meta_box('trackbacksdiv', 'post', 'normal');
	remove_meta_box('postexcerpt', 'post', 'normal');
	remove_meta_box('authordiv', 'post', 'normal');
	remove_meta_box('revisionsdiv', 'post', 'normal');
	remove_meta_box('commentstatusdiv', 'post', 'normal');
	remove_meta_box('commentstatusdiv', 'page', 'normal');
	remove_meta_box('edit-box-ppr', 'post', 'normal');
	remove_meta_box('edit-box-ppr', 'page', 'normal');	
	remove_meta_box('commentsdiv', 'post', 'normal');
}
add_action( 'admin_menu', 'remove_post_boxes' );

// Add Post Thumbnails/Image size
add_theme_support( 'post-thumbnails' ); 

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'block', 280, 280, true );
}

// Add Menu Support
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'navigation' => 'Navigation',
		  'footer' => 'Footer',
		  'tools' => 'Tools',
		  'sitemap' => 'Site Map'
		)
	);
}

function my_wp_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
} 

add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );

// Paginate search results
function pagination( $query, $baseURL ) {
  $page = $query->query_vars["paged"];
  if ( !$page ) $page = 1;
  $qs = $_SERVER["QUERY_STRING"] ? "?".$_SERVER["QUERY_STRING"] : "";
  // Only necessary if there's more posts than posts-per-page
  if ( $query->found_posts > $query->query_vars["posts_per_page"] ) {
    echo '<ul class="paging">';
    // Loop through pages
    for ( $i=1; $i <= $query->max_num_pages; $i++ ) {
      // Current page or linked page?
      if ( $i == $page ) {
        echo '<li class="active">'.$i.'</li>';
      } else {
        echo '<li><a href="'.$baseURL.'page/'.$i.'/'.$qs.'">'.$i.'</a></li>';
      }
    }
    echo '</ul>';
  }
}

// Trim Content
function trim_content($text, $max_length){
     if ( strlen($text) > $max_length ) {
          $text = apply_filters('the_content', $text);
          $text = strip_tags($text, '<p><em><strong>');
          $excerpt_length = $max_length;
          if (strlen($text) > $max_length){
               $text = substr($text, 0, $max_length);
               $pos = strrpos($text, " ");
               if($pos === false) {              
                    return force_balance_tags( substr($text, 0, $max_length)."...");
               }       
               return force_balance_tags( substr($text, 0, $pos)."...");
          }
     }
     force_balance_tags( $text );
     return $text;   
}
