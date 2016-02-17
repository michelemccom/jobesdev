<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */
 
add_theme_support( 'automatic-feed-links' );

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar 1',
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
}

function brands_post_type() {
    $labels = array(
        'name'                => _x( 'Brands', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Brand', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Brands', 'text_domain' ),
        'all_items'           => __( 'All Brands', 'text_domain' ),
        'view_item'           => __( 'View Brand', 'text_domain' ),
        'add_new_item'        => __( 'Add New Brand', 'text_domain' ),
        'add_new'             => __( 'New Brand', 'text_domain' ),
        'edit_item'           => __( 'Edit Brand', 'text_domain' ),
        'update_item'         => __( 'Update Brand', 'text_domain' ),
        'search_items'        => __( 'Search Brands', 'text_domain' ),
        'not_found'           => __( 'No Brands Found', 'text_domain' ),
        'not_found_in_trash'  => __( 'No Brands Found in Trash', 'text_domain' ),
    );

    $args = array(
        'label'               => __( 'Brands', 'text_domain' ),
        'labels'              => $labels,
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'supports'        => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
        'menu_position'       => 5,
        'menu_icon'           => null,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite'                    => array('slug' => 'brands'),
    );

    register_post_type( 'brands', $args );


// Hook into the 'init' action

}
add_action( 'init', 'brands_post_type', 0 );

// Register Custom Taxonomy
function custom_taxonomy()  {
    $labels = array(
        'name'                       => _x( 'Catergories', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Catergories', 'text_domain' ),
        'all_items'                  => __( 'All Catergories', 'text_domain' ),
        'parent_item'                => __( 'Parent Catergories', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Catergories:', 'text_domain' ),
        'new_item_name'              => __( 'New Category Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Category', 'text_domain' ),
        'edit_item'                  => __( 'Edit Category', 'text_domain' ),
        'update_item'                => __( 'Update Category', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate Catergories with commas', 'text_domain' ),
        'search_items'               => __( 'Search Catergories', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or Remove Catergories', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from Most Used Catergories', 'text_domain' ),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'rewrite'                    => array('slug' => 'brands/%category%'),
    );

    register_taxonomy( 'category', 'brands', $args );
}
function wpa_course_post_link( $post_link, $id = 0 ){
    $post = get_post($id);  
    if ( is_object( $post ) ){
        $terms = wp_get_object_terms( $post->ID, 'category' );
        if( $terms ){
            return str_replace( '%category%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;  
}
add_filter( 'post_type_link', 'wpa_course_post_link', 1, 3 );

// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy', 0 );
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
