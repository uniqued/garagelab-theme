<?php
/**
 * The template part the featured image
 *
 * @package Hype
 *
 */
global $post;

$thumb_data = hype_get_thumb_data( $post->ID );

if ( is_single() && $post->post_type == 'post' ) {
  $inner_class = 'inner-width-800';
} else {
  $inner_class = 'inner-width-no-padding';
}
?>
<div class="featured-image-section section">
  <div class="<?php echo $inner_class; ?>">
    <?php
      if ( $thumb_data ) :
        echo hype_responsive_image( $thumb_data, 'full' );
      endif;
    ?>
  </div>
</div>