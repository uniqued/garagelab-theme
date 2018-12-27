<?php
/**
 * The template part for displaying page gallery on homepage.
 *
 * @package Hype
 *
 */

$gallery_amount = get_post_meta( $post->ID, '_zilla_home_gallery_amount', true );
$gallery_title  = get_post_meta( $post->ID, '_zilla_home_gallery_title', true );
?>
<div class="section home-clients">
  <div class="inner-width">
    <h2 class="home-title"><?php echo esc_html( $gallery_title ); ?></h2>
    <?php

    $gallery = rtrim( get_post_meta( $post->ID, '_zilla_image_ids', true ), ',' );

    if ( $gallery ) :
      $thumbs      = explode(',', $gallery);

      if ( count( $thumbs ) < $gallery_amount ) :
        $gallery_amount = count( $thumbs );
      endif;

      $count       = 1;
      $img_class   = '';

      foreach( $thumbs as $thumb ) :
        if ( $gallery_amount >= $count ) :
        ?>
          <div class="home-client-gallery-image">
            <?php
            echo wp_get_attachment_image( $thumb );
            ?>
          </div>
          <?php
          $count++;
        endif;
      endforeach;

      wp_reset_postdata();
    endif;
    ?>
  </div>
</div>