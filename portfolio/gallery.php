<?php
/**
 * The template part for displaying page gallery on single portfolio page.
 *
 * @package Hype
 *
 */
$gallery = rtrim( get_post_meta( $post->ID, '_tzp_gallery_images_ids', true ), ',' );

if ( false != $gallery ) : ?>
  <div class="portfolio-gallery slick-gallery-container">
    <?php zilla_post_gallery( $post->ID ); ?>
  </div>
<?php endif;