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
            'hide_empty'        => 0,
            'parent'        => 0,
           'meta_query' => array(
            array(
                'key' => 'brands', // name of custom field
                'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
                'compare' => 'LIKE'
            )
            )
        
          ); 
          $categories=get_categories($args);
         
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
