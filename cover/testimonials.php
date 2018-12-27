<?php
/**
 * The template part for displaying testimonials on homepage.
 *
 * @package Hype
 *
 */

$testimonial_amount = get_post_meta( $post->ID, '_zilla_home_testimonials_amount', true );
$args = array(
  'posts_per_page' => $testimonial_amount,
  'post_type'      => 'hype-testimonial'
);

$testimonials = get_posts( $args );

if ( $testimonials ) : ?>
  <div class="section testimonials">
    <?php if ( $testimonial_amount > 1 ) : ?>
      <div class="slick-prev">
        <svg class="slick-prev-icon"><use xlink:href="#icon-down-arrow"></use></svg>
      </div>

      <div class="slick-next">
        <svg class="slick-next-icon"><use xlink:href="#icon-down-arrow"></use></svg>
      </div>
    <?php endif; ?>
    <div class="testimonials-inner inner-width">
      <?php
      foreach ( $testimonials as $testimonial ) :
        $author  = esc_html( get_post_meta( $testimonial->ID, '_zilla_testimonial_author', true ) );
        $company = esc_html( get_post_meta( $testimonial->ID, '_zilla_testimonial_author_company', true ) );

        if ( ! empty( $author ) && ! empty( $company ) ) {
          $author .= ', ';
        }

        $attachment = hype_get_thumb_data( $testimonial->ID );

        if ( NULL !== $attachment['thumb_original'] ) {
          $image      = hype_responsive_image( $attachment );
        }
        ?>
        <div class="testimonial">
          <div class="testimonial-image"><?php if( isset( $image ) ) { echo $image; } ?></div>
          <h3 class="testimonial-text"><?php echo wp_strip_all_tags( $testimonial->post_content ); ?></h3>
          <div class="testimonial-author-info">
            <label class="testimonial-author"><?php echo $author; ?></label>
            <?php echo $company; ?>
          </div>
        </div>
        <?php
      endforeach;
      ?>
    </div>
  </div>
  <?php
  wp_reset_postdata();

endif;
?>
