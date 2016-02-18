<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header();
?>

<div id="copy"> 
<?php 

  $slug_brands = get_query_var( 'term' );
  $term_brands = get_term_by( 'slug', $slug_brands, 'product_brands' );
  $term_id_brands = $term_brands->term_id;
?>
        <h1><?php echo $term_brands->name; ?></h1>
        <p><?php echo $term_brands->description; ?></p>

        <?php
          $args=array(
            'post_type' => 'products',

            'tax_query' => array(


              array(
                'taxonomy'      => 'product_brands',
                'hide_empty'    => 0,
                'parent'        => $term_id_brands,
                'terms'         => $term_brands,
                'field'         => 'slug',
              )
            )
          ); 
          $the_query = new WP_Query($args);
        if ($the_query->have_posts()) :  while ($the_query->have_posts()) : $the_query->the_post(); 
        $args=array(
            'hide_empty'        => 0,
            'parent'        => 0,
            'taxonomy'      => 'product_categories');
        $categories=get_categories($args);
         
            foreach($categories as $category) {
                echo '<div class="product-cat">'; 
             
                $thumb_url = get_option('taxonomy_image_plugin');
                $product_cat_url = get_term_link( $category->slug, 'product_categories' );
                             
                echo '<a href="'.$product_cat_url.'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.wp_get_attachment_url( $thumb_url[$category->term_taxonomy_id]).'&h=200&w=200" /></a>';
                echo '<a class="cat-title" href="' . $product_cat_url .'">' . $category->name.'</a>';
                echo '</div> <!--end product cat-->';
            }?>

    
        <?php endwhile; endif;wp_reset_postdata();?>
     
        

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
