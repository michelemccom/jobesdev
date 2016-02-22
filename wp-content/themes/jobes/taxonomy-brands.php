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

              
              $posttermsone = get_the_terms( $post->ID, 'product_categories' ); 
                  if ($posttermsone) {
                    foreach($posttermsone as $term) {
                      $all_termsone = $term->name;
                    }
                  }
              $posttermstwo = get_the_terms( $post->ID, 'product_categories' ); 
                if ($posttermstwo) {
                  foreach($posttermstwo as $term) {
                    $all_termstwo = $term->slug;

                  }
                }
                endwhile; endif;
  
              $termstwo = array_unique($all_termstwo);
               foreach($termstwo as $term) {
            
                   echo '<li><a href="'.$term['slug'].'">' ; 
             
                     
                    }

               $termsone = array_unique($all_terms);
               foreach($termsone as $term) {
            
                   echo $term['name'].'</a></li>'; 
             
                     
                    } ?>
        
        </ul>

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
