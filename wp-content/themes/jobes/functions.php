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


///// CUSTOM POST TYPES /////

// register the new post type
register_post_type( 'brand_listing', array( 
    'labels'                 => array(
        'name'               => __( 'Brands' ),
        'singular_name'      => __( 'Brand' ),
        'add_new'            => __( 'Add New' ),
        'add_new_item'       => __( 'Create New Brand' ),
        'edit'               => __( 'Edit' ),
        'edit_item'          => __( 'Edit Brand' ),
        'new_item'           => __( 'New Brand' ),
        'view'               => __( 'View Brands' ),
        'view_item'          => __( 'View Brand' ),
        'search_items'       => __( 'Search Brands' ),
        'not_found'          => __( 'No brands found' ),
        'not_found_in_trash' => __( 'No brands found in trash' )
    ),
    'public'                => true,
    'show_ui'               => true,
    'capability_type'       => 'post',
    'publicly_queryable'    => true,
    'exclude_from_search'   => false,
    'hierarchical'          => true,
    '_builtin'              => false, // It's a custom post type, not built in!
    'rewrite'               => array( 'slug' => 'brands/%brand_cat%', 'with_front' => true ),
    'query_var'             => true,
    'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions' ),
) );


//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_brand_taxonomies', 0 );
//add_action('admin_init', 'flush_rewrite_rules');

//create two taxonomies, genres and writers for the post type "book"
function create_brand_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      =>  __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Categories' ),
        'parent_item_colon' => __( 'Parent Categories:' ),
        'edit_item'         => __( 'Edit Category' ), 
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Category' ),
    );  

    register_taxonomy( 'brand_cat', array( 'brand_listing' ), array(
        'hierarchical'  => true,
        'labels'        => $labels,
        'show_ui'       => true,
        'query_var'     => true,
        //'rewrite'     => true,
        'rewrite'       => array( 'slug' => 'brands', 'with_front' => true ),
    ) );

   
}

function filter_post_type_link($link, $post)
{
    if ($post->post_type != 'brand')
        return $link;

    if ($cats = get_the_terms($post->ID, 'brand_cat'))
    {
        $link = str_replace('%taxonomy_name%', get_taxonomy_parents(array_pop($cats)->term_id, 'brand_cat', false, '/', true), $link); // see custom function defined below
    }
    return $link;
}
add_filter('post_type_link', 'filter_post_type_link', 10, 2);

// my own function to do what get_category_parents does for other taxonomies
function get_taxonomy_parents($id, $taxonomy, $link = false, $separator = '/', $nicename = false, $visited = array()) {    
    $chain = '';   
    $parent = &get_term($id, $taxonomy);

    if (is_wp_error($parent)) {
        return $parent;
    }

    if ($nicename)    
        $name = $parent -> slug;        
else    
        $name = $parent -> name;

    if ($parent -> parent && ($parent -> parent != $parent -> term_id) && !in_array($parent -> parent, $visited)) {    
        $visited[] = $parent -> parent;    
        $chain .= get_taxonomy_parents($parent -> parent, $taxonomy, $link, $separator, $nicename, $visited);

    }

    if ($link) {
        // nothing, can't get this working :(
    } else    
        $chain .= $name . $separator;    
    return $chain;    
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
