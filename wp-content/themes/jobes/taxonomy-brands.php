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
          $slug_brands = get_query_var( 'term' );
          $term_brands = get_term_by( 'slug', $slug_brands, 'brands' );
          $term_id_brands = $term_brands->term_id;
       $terms = get_terms( 'product-categories', 'orderby=count&hide_empty=0' );
          $count = count($terms);
          if ( $count > 0 ){
           echo "<ul>";
           foreach ( $terms as $term ) {
             echo "<li>" . $term->name . "</li>";

           }
           echo "</ul>";
          }
       ?>
         
            

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
