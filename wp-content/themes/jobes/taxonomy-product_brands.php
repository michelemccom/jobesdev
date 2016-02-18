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
                'taxonomy'      => 'product_brands',
                'hide_empty'    => 0,
                'parent'        => $term_id_brands,
                'terms'         => $term_brands,
                'field'         => 'slug',
              )
        
          ); 

        $categories=get_categories($args);
         
            foreach($categories as $category) {
                echo '<div class="product-cat">'; 
             
                //$thumb_url = get_option('taxonomy_image_plugin');
                $product_cat_url = get_term_link( $category->slug, 'product_categories' );
                             
        
                echo '<a class="cat-title" href="/?product_categories='.$category->slug.'">' . $category->name.'</a>';
                echo '</div> <!--end product cat-->';
            }?>

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
