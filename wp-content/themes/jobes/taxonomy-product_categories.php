<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header();
?>
<?php

  $slug_brands = get_query_var( 'term' );
  $term_brands = get_term_by( 'slug', $slug_brands, 'product_categories' );
  $term_id_brands = $term_brands->term_id;
?>
<div class="brand-header">
  <?php $logo = get_field('brand_logo', $term_brands );
          if (!empty($logo)){?>
            <div class="logo-circle">
              <span>
                <h1><?php echo $term_brands->name; ?></h1>
                <img src="<?php echo $logo;?>" alt="<?php echo $term->name;?>">
              </span>
            </div>
          <?php } ?>
          <div class="brand-tagline">
            <h2><?php echo get_field('brand_tagline', $term_brands );?></h2>
          </div>
</div>
<div id="copy"> 

  <p><?php echo $term_brands->description; ?></p>
  <ul class="section">
    <span>
  <?php
    $args=array(
      'post_type' => 'products',
      'parent'        => 0,             
      'tax_query' => array(
           array(
          'taxonomy'      => 'product_categories',    
          'parent'        => $term_id_brands,
          'terms'         => $term_brands,
          'field'         => 'slug'
          )
      )
    ); 
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

        <?php 
        $postterms = get_the_terms( $post->ID, 'brands' ); 
            if ($postterms) {
              foreach($postterms as $term) {
                $all_terms[] = $term->name;

              }
            }

        $posttermstwo = get_the_terms( $post->ID, 'brands' ); 
          if ($posttermstwo) {
            foreach($posttermstwo as $term) {
              $all_termstwo[] = $term->slug;

            }
          }
        $posttermsID = get_the_terms( $post->ID, 'brands' ); 
          if ($posttermsID) {
            foreach($posttermsID as $term) {
              $all_termsID[] = $term->ID;

            }
          }
          endwhile; endif;
          if (!empty($all_terms[0])) {
          $terms = array_unique($all_terms);
          $termstwo = array_unique($all_termstwo);
            foreach (array_combine($terms, $termstwo) as $term => $termtwo) { ?>
                <li>

                 <div>
                     <a href="<?php echo get_option('home'); ?>/products/?brands=<?php echo $term_brands->slug;?>&product_categories=<?php echo $termtwo; ?>"><img src="<?php echo get_bloginfo('template_url')?>/images/<?php echo $term_brands->slug;?>-<?php echo $termtwo; ?>.jpg"> </a>
                  </div>
                   <h4><a href="<?php echo get_option('home'); ?>/products/?brands=<?php echo $term_brands->slug;?>&product_categories=<?php echo $termtwo; ?>"><?php echo $term;?> </a></h4>
                    <?php $args = array(
                            'post_type' => 'brand_cat_desc',
                            'posts_per_page' => -1,
                            'order' => 'ASC',
                            'orderby' => 'date',
                            'name' => $term.'-'.$term_brands->slug
                            );
                        $the_query = new WP_Query($args);
                        if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                          the_content();

                        endwhile; endif;wp_reset_postdata();?>
                   <?php 
                  $termsID = array_unique($all_termsID);
                  foreach ($termsID as $termID) {
      

                   $args=array(
                    'post_type' => 'products',
                    'parent'        => 0,             
                    'tax_query' => array(
                         array(
                        'taxonomy'      => 'brands',    
                        'parent'        => $termID,
                        'terms'         => $termtwo,
                        'field'         => 'slug'
                        )
                    )
                  ); 
                  $the_query = new WP_Query($args);
                  if ($the_query->have_posts()) : ?>
                  <ul class="blocks section">
                  <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <li class="block"> 
                       <?php if ( has_post_thumbnail() ) {
                      $thumb_id = get_post_thumbnail_id();
                    $thumb_url = wp_get_attachment_image_src($thumb_id,'block', true);?>
                          <?php if (!empty($thumb_url[0])) { ?>
                          <div class="round">
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_url[0];?>"> </a>
                      </div>
                      <?php }
                    } ?>

          
                      <h4><?php the_title();?></h4>

                      </li>

                  <?php endwhile; ?>
                </ul>
                  <?php endif;wp_reset_postdata(); 

                }?>
                </li>       
            <?php } 
          } else {
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
              <li class="block"> 
                 <?php if ( has_post_thumbnail() ) {
                $thumb_id = get_post_thumbnail_id();
              $thumb_url = wp_get_attachment_image_src($thumb_id,'block', true);?>
                    <?php if (!empty($thumb_url[0])) { ?>
                    <div class="round">
                  <a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_url[0];?>"> </a>
                </div>
                <?php }
              } ?>

            
                <h4><?php the_title();?></h4>

                </li>


             <?php endwhile; endif;wp_reset_postdata(); 

          }?>
  
        </span> 
  </ul>

</div> <!-- end copy -->
<?php get_footer(); ?>
