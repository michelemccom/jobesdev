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
            'tax_query' => array(
                'taxonomy'      => 'brands',
                'parent'        => $term_id_brands,
                'terms'         => $term_brands,
                'field'         => 'slug',
            )
          ); 
          $my_cats = array(); 
          $the_query = new WP_Query($args);
            if ($the_query->have_posts()){
            //loop over all post and collect the categories in to an array
                while ($the_query->have_posts()){
                    $the_query->the_post();
                    foreach((get_the_category($post->ID)) as $category) {
                        if (!in_array($category->cat_ID ,$my_cats)){
                            $my_cats[] = $category->name;
                        }
                    } 
                }
            }


        $categories=get_categories();
         
            foreach($categories as $category) {
                echo '<div class="product-cat">'; 
             
                //$thumb_url = get_option('taxonomy_image_plugin');
                $product_cat_url = get_term_link( $category->slug, 'product_categories' );
                             
        
                echo '<a class="cat-title" href="http://jobesdev.com/brands/'.$term_brands->slug.'/?brands='.$term_brands->slug .'&cat='.$category->cat_ID.'">' . $category->name.'</a>';
                echo '</div> <!--end product cat-->';
            }?>

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
