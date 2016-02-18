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
         $the_query = new WP_Query($args);
        if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

            $categories=get_categories($args);
             
                foreach($categories as $category) {
                    echo '<div class="product-cat">'; 
                 
            
                                 
            
                    echo '<a class="cat-title" href="http://jobesdev.com/brands/'.$term_brands->slug.'/?brands='.$term_brands->slug .'&cat='.$category->cat_ID.'">' . $category->name.'</a>';
                    echo '</div> <!--end product cat-->';
                }?>
<?php endwhile; endif;wp_reset_postdata();?>    
      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
