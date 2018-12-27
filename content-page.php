<?php
/**
 * Content.
 *
 * @package Hype
 */

global $post;
global $wp_query;

$has_post_thumbnail = FALSE;
$subtitle           = get_post_meta( $post->ID, '_zilla_subtitle', true );

if ( has_post_thumbnail() ) {
  $has_post_thumbnail = TRUE;
}
?>

<?php zilla_post_before(); ?>

<article <?php post_class(); ?>>
  <?php zilla_post_start(); ?>

  <?php
  if ( $has_post_thumbnail && ! is_page_template( 'template-contact.php') ) :
    ?>
    <div class="inner-width-no-padding">
      <div class="featured-image">
        <?php hype_post_thumbnail( $post->ID, 'full' ); ?>
      </div>
    </div>

    <?php
  endif;
  ?>
  <div class="inner-width extra-padding default-title-section">
    <!--h1><?php the_title(); ?></h1-->
    <h3 class="default-subtitle"><?php echo esc_html( $subtitle ); ?></h3>
    <?php the_content(); ?>
    <?php if ( $subtitle ) : ?>
    <?php endif; ?>
  </div>
</article>
