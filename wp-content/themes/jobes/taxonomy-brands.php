<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header();
?>

<div id="copy"> 
<?php $property_types = array();

  $slug_brands = get_query_var( 'term' );
  $term_brands = get_term_by( 'slug', $slug_brands, 'brands' );
  $term_id_brands = $term_brands->term_id;
?>
        <h1><?php echo $term_brands->name; ?></h1>
        <p><?php echo $term_brands->description; ?></p>
        <ul>
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
          $the_query = new WP_Query($args);
          if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

              <?php 

              
              $postterms = get_the_terms( $post->ID, 'product_categories' ); 
                  if ($postterms) {
                    foreach($postterms as $term) {
                      $all_terms['name'][] = $term->name;
                      $all_terms['slug'][] = $term->slug;

                    }
                  }
                endwhile; endif;
                var_dump($all_terms);
                var_dump($all_terms["name"]);
// Printing all the keys and values one by one
$keys = array_keys($all_terms);
for($i = 0; $i < count($all_terms); $i++) {
    echo $keys[$i] . "{<br>";
    foreach($all_terms[$keys[$i]] as $key => $value) {
        echo $key . " : " . $value . "<br>";
    }
    echo "}<br>";
}
          
              $terms = array_unique($all_terms);
               foreach($terms as $term) {
            
                   echo '<li><a href="'.$term['slug'].'">'.$term['name'].'</a></li>'; 
             
                     
                    } ?>
        
     
        </ul>

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
