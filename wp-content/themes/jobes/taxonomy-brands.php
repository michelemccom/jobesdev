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
?>
        <h1><?php echo $term_brands->name; ?></h1>
        <p><?php echo $term_brands->description; ?></p>

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
       $categories = get_terms ( $args );   
        foreach($categories as $category) {
                echo '<div class="product-cat">'; 
                //$thumb_url = get_option('taxonomy_image_plugin');
                echo '<a class="cat-title" href="http://jobesdev.com/brands/'.$term_brands->slug.'/?cat='.$category->cat_ID.'">' . $category->name.'</a>';
                echo '</div> <!--end product cat-->';
            }?>

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
