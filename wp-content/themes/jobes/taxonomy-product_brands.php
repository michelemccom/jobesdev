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

          $categories=get_categories($args);

          if(!$categories){ 

          //get the product category name
          echo "<h3>' .$term_brands->name. ' Products</h3>";

          $args = array(
            'posts_per_page' => 50, //remember posts per page should be less or more that what's set in general settings
            'paged' => $paged,
            'order' => 'ASC',
            'tax_query' => array(
              'relation' => 'AND',

              array(
                'taxonomy'      => 'product_categories',
                'hide_empty'    => 0,
                'parent'        => $term_id_products,
                'terms'         => $term_products,
                'field'         => 'slug',
              ),

              array(
                'taxonomy'      => 'product_brands',
                'hide_empty'    => 0,
                'parent'        => $term_id_brands,
                'terms'         => $term_brands,
                'field'         => 'slug',
              )
            )
          );
        ?>

        <!-- if there are no subcategories output current product category's products -->
        <?php
          $products_query = new WP_Query($args);
          if (have_posts()) : while($products_query->have_posts()) : $products_query->the_post(); 

          $thumb_url = get_option('taxonomy_image_plugin');
        ?>

        <div class="large-4 column product-cat end" onclick="location.href='<?php echo get_permalink(); ?>';">
          <div class="panel" data-equalizer-watch>
            <div class="prod-img">

              <?php
                if ( has_post_thumbnail( $post->ID ) ) :
                  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                  $image = $image[0];
                  echo '<img src=" ' . $image . ' " />';
                endif;
              ?>

            </div>
          </div>

          <a class="cat-title" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
        </div>

        <?php endwhile; endif; ?>

        <?php } else { 

          //output current category name - MOST OF THE ACTION IS HERE
          echo '<h3>'.$term_brands->name.' Products</h3>';

          foreach($categories as $category) {
            $product_cat_url = get_term_link( $category->slug, 'product_categories' );
            // $product_cat_url = get_term_link( $term_products, 'product_categories' );

            $thumb_url = get_option('taxonomy_image_plugin');
        ?>

        <div class="large-4 medium-4 column product-cat" onclick="location.href='<?php echo $product_cat_url ; ?>';">
          <div class="panel" data-equalizer-watch>
            <div class="prod-img"><img src="<?php echo wp_get_attachment_url( $thumb_url[$category->term_id]); ?>" /></div>
          </div>

          <a class="cat-title" href="<?php echo $product_cat_url ; ?>"><?php echo $category->name; ?></a>
        </div>

      <?php } } ?>

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
