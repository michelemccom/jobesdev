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
           $all_terms = array();
          if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 

   $taxonomy = 'product_categories'; // change this to your taxonomy
   $terms = wp_get_post_terms( $post->ID, $taxonomy, array( "fields" => "ids" ) );
   if( $terms ) $all_terms = array_merge($all_terms, $terms);
endwhile; endif;
if ($all_terms) :
   $all_terms = array_unique($all_terms);
   $terms = trim( implode( ',', (array) $all_terms ), ' ,' );
   var_dump($terms);
   foreach ($terms as $term) {

     }
endif; ?>
        
               
        </ul>

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
