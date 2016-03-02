<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */

get_header();

  $slug_brands = get_query_var( 'term' );
  $term_brands = get_term_by( 'slug', $slug_brands, 'brands' );
  $term_id_brands = $term_brands->term_id;
  $term_slug_brands = $term_brands->slug;
?>
<div id="copy"> 
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
          
          <p><?php echo $term_brands->description; ?></p>
          <?php if (($term_slug_brands == 'landmaster') || ($term_slug_brands == 'weedblock') || ($term_slug_brands == 'easy-gardener') || ($term_slug_brands == 'jobes')) { ?>
            <div class="btn"><a href="/where-to-buy/?brand=<?php echo $term_slug_brands; ?>">Where to Buy</a></div>
          <?php } ?>
</div>
 
  <ul class="blocks section">
    <span>
        <?php if (($term_slug_brands == 'landmaster')) {
          $args=array(
            'post_type' => 'products',
            'parent'        => 0,             
            'tax_query' => array(
                 array(
                'taxonomy'      => 'brands',  
                'terms'         => $term_brands,
                'field'         => 'slug'
                )
            ),
             'posts_per_page' => -1,
          ); 
          $the_query = new WP_Query($args);
          if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
          
            <li class="block"> 
               <?php if ( has_post_thumbnail() ) {
                $thumb_id = get_post_thumbnail_id();
                $thumb_url = wp_get_attachment_image_src($thumb_id,'block', true);
                if (!empty($thumb_url)) { ?>
                  <div class="round">
                    <img src="<?php echo $thumb_url[0];?>" width="<?php echo $thumb_url[1];?>" height="<?php echo $$thumb_url[2]; ?>">
                  </div>
                <?php } 
              }?>
              <h4><?php the_title();?></h4>
            </li>
          <?php endwhile; endif;wp_reset_postdata(); 
        } else { 
            $args=array(
              'post_type' => 'products',
              'parent'        => 0,             
              'tax_query' => array(
                   array(
                  'taxonomy'      => 'brands',  
                  'terms'         => $term_brands,
                  'field'         => 'slug'
                  )
              ),
               'posts_per_page' => -1,
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
                  if (!empty($all_terms[0])) {
                  $terms = array_unique($all_terms);
                  $termstwo = array_unique($all_termstwo);
                    foreach (array_combine($terms, $termstwo) as $term => $termtwo) { ?>
                        <li class="block">
                         <div class="round">
                             <a href="<?php echo get_option('home'); ?>/products/?brands=<?php echo $term_brands->slug;?>&product_categories=<?php echo $termtwo; ?>"><img src="<?php echo get_bloginfo('template_url')?>/images/<?php echo $term_brands->slug;?>-<?php echo $termtwo; ?>.jpg"> </a>
                          </div>
                           <h4><a href="<?php echo get_option('home'); ?>/products/?brands=<?php echo $term_brands->slug;?>&product_categories=<?php echo $termtwo; ?>"><?php echo $term;?> </a></h4>
                        </li>       
                    <?php } 
                  } 

        }?>
    
        </span> 
  </ul>

</div> <!-- end copy -->
<?php get_footer(); ?>
