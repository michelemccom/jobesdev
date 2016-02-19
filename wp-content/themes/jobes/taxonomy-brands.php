<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header();
?>

<div id="copy"> 
<?php 
$slug = get_query_var('term');

//get the current taxonomy_id
$term = get_term_by( 'slug', $slug,  'product_brands' );
$term_id = $term->term_id;

    //check dept
    //checking current taxonomy to see if it has child categories if it doesn't then we're out of sub categories and should
    //show the current categories products
    $args=array(
          'hide_empty'         => 0,  
          'parent'        => $term_id,
          'taxonomy'            => 'product_brands');
            
    $categories=get_categories($args);

    if(!$categories){ ?>
    <?php
    
      //get the product category name
      echo "<h1>".$term->name."</h1>";
      
    $args = array(
      'posts_per_page' => -1, //remember posts per page should be less or more that what's set in general settings
    
      //'orderby' => 'menu_order',
      'order' => 'ASC',
      'tax_query' => array(
        array(
          'taxonomy' => 'product_brands',
          'field' => 'slug',
          'terms' => $slug)
        )
      );
        
        $products_query = new WP_Query($args);
        if (have_posts()) :
        while($products_query->have_posts()) : $products_query->the_post(); 
          //get post thumbnail url
          $post_thumbnail_id = get_post_thumbnail_id();
          $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
        ?>
          <div class="product">
            <a class="product-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <a href="<?php the_permalink(); ?>">
        
          </div> <!--end product-->
          
        <?php endwhile; else: ?>
          <p>Sorry no products were found.</p>
        <?php endif; ?>
        <?php wp_reset_query();  ?>
          
        <div class="pagination">
          <?php next_posts_link('&laquo; More Products', $products_query->max_num_pages) ?>
          <?php previous_posts_link('Previous Products &raquo;') ?>
        </div> <!--end pagination-->      
      
    <?php } else{ 
    
      //output current category name
      echo '<h1 class="entry-title">'.$term->name.'</h1>';
      foreach($categories as $category) {
        echo '<div class="product-cat">'; 
        //get the thumbnail urls from taxonomy plugin
  
        $product_cat_url = get_term_link( $category->slug, 'product_categories' );
    ?>
    
      
        <a class="cat-title" href="<?php echo $product_cat_url ; ?>"><?php echo $category->name; ?></a>
        </div> <!--end product cat-->
        
    <?php } 
      } 
    ?>   

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
