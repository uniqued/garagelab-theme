<?php
/**
 * The template part for displaying page gallery on about template.
 *
 * @package Hype
 *
 */
$gallery = rtrim( get_post_meta( $post->ID, '_zilla_image_ids', true ), ',' );

if ( 'false' != $gallery ) : ?>
  <div id="about-gallery">
  <?php
  $thumbs      = explode( ',', $gallery );

  foreach( $thumbs as $thumb ) :
  ?>
      <div class="about-gallery-image">
        <?php
        echo wp_get_attachment_image( $thumb, 'full' );
        ?>
        <div class="about-gallery-image-overlay"></div>
      </div>
      <?php

  endforeach;
  wp_reset_query();
  ?>
  </div>
<?php endif;