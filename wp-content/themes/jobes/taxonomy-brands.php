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
  $term_brands = get_term_by( 'slug', $slug_brands, 'brands' );
  $term_id_brands = $term_brands->term_id;
  $slug_cat = get_query_var( 'term' );
  $term_cat = get_term_by( 'slug', $slug_cat, 'product_categories' );
  
  $term_id_cat = $term_cat->term_id;
?>
        <h1><?php echo $term_brands->name; ?></h1>
        <p><?php echo $term_brands->description; ?></p>

        <?php
          $args=array(
            'post_type' => 'products',
            'parent'        => 0,             
            'tax_query' => array(
               'relation' => 'AND',
                 array(
                'taxonomy'      => 'brands',    
                'parent'        => $term_id_brands,
                'terms'         => $term_brands,
                'field'         => 'slug'
                ),
                array(
                'taxonomy'      => 'product_categories',    
                'parent'        => $term_id_cat,
                'terms'         => $term_cat,
                'field'         => 'slug'
                ),
            )
          ); 
        $categories = get_terms( 'product_categories', 'orderby=count&hide_empty=1' );
       foreach($categories as $category) {
                echo '<div class="product-cat">'; 
                //$thumb_url = get_option('taxonomy_image_plugin');
                echo  $category->name;
                echo '</div> <!--end product cat-->';
            }?>
            

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
