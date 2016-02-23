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
<div class="brand-header">

</div>
        <h1><?php echo $term_brands->name; ?></h1>
        <p><?php echo $term_brands->description; ?></p>
        <ul class="blocks section">
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
                      $all_terms[] = $term->name;

                    }
                  }

              $posttermstwo = get_the_terms( $post->ID, 'product_categories' ); 
                if ($posttermstwo) {
                  foreach($posttermstwo as $term) {
                    $all_termstwo[] = $term->slug;

                  }
                }
                endwhile; endif;
                $terms = array_unique($all_terms);
                $termstwo = array_unique($all_termstwo);
                foreach (array_combine($terms, $termstwo) as $term => $termtwo) { ?>
                    <li class="block">
                     <div class="round">
                         <a href="<<?php echo get_option('home'); ?>/products/?brands='<?php echo $term_brands->slug;?>&product_categories=<?php echo $termtwo; ?>"><img src="<?php echo get_bloginfo('template_url')?>/images/<?php echo $term_brands->slug;?>_<?php echo $termtwo; ?>.jpg"> </a>
                      </div>

                        <a href="<?php echo get_option('home'); ?>/products/?brands=<?php echo $term_brands->slug;?>&product_categories=<?php echo $termtwo; ?>"><?php echo $term;?> </a>
                    </li>       
                <?php } ?>
        
               
        </ul>

      </div> <!--end of entry-->      

    </article>

</div> <!-- end copy -->
<?php get_footer(); ?>
