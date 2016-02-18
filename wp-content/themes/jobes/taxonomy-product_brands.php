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
        <h1><?php echo $term_brands->name; ?></h1>
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
          $the_query = new WP_Query($args);
        if ($the_query->have_posts()) : ?>
        <ul>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
           <li> <a href="<?php the_permalink(); ?>"><?php the_title();?><a href="<?php the_permalink(); ?>"></li>
        <?php endwhile; ?>
         </ul>  
        <?php endif;wp_reset_postdata();?>
     
        

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
