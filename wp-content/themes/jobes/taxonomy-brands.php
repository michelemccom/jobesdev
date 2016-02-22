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
          <li>
              <?php the_title();

              $field = get_field_object('product_categories');
              $value = $field['value'];
              $choices = $field['choices'];

              if( $value ): ?>
          
                <?php foreach( $value as $v ): ?>
                <br/>
                  <?php echo $choices[ $v ]; ?>
           
                <?php endforeach; ?>
          
              <?php endif; ?>
              
  
                  </li>
               
           <?php } }
           endwhile; endif;wp_reset_postdata();?>
        </ul>

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
