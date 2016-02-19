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
  $term_id_brands = $term_brands[0]->term_id;
?>
        <h1><?php echo $term_brands[0]->name; ?></h1>
        <p><?php echo $term_brands[0]->description; ?></p>

        <?php
          $args=array(
            'post_type' => 'products',
            'parent'        => 0,             
            'tax_query' => array(
                 array(
                'taxonomy'      => 'brands',    
                'parent'        => $term_id_brands,
                'terms'         => $term_brands,
                'field'         => 'slug'
                )
            )
          ); 
        $terms = get_terms( 'product_categories', array(
            'post_type' => 'products',
            'parent'        => 0,             
            'tax_query' => array(
                 array(
                'taxonomy'      => 'brands',    
                'parent'        => $term_id_brands,
                'terms'         => $term_brands,
                'field'         => 'slug'
                )
              )
            )
            );
         
            foreach($terms as $term) {
                echo '<div class="product-cat">'; 
                //$thumb_url = get_option('taxonomy_image_plugin');
                echo '<a class="cat-title" href="http://jobesdev.com/brands/'.$term_brands[0]->slug.'/?product_categories='.$term[0]->slug.'">' . $term[0]->name.'</a>';
                echo '</div> <!--end product cat-->';
            }?>

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
