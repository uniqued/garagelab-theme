<?php
/**
 * Content.
 *
 * @package Hype
 */
global $post;
global $wp_query;
global $wp_customize;

if ( $_POST && ! $wp_customize ) {
  if ( isset( $_POST['is_home'] ) ) {
    $is_home = $_POST['is_home'];
  }

  if ( isset( $_POST['is_archive'] ) ) {
    $is_archive = $_POST['is_archive'];
  }

  if ( isset( $_POST['is_single'] ) ) {
    $is_single = $_POST['is_single'];
  }

  if ( isset( $_POST['is_search'] ) ) {
    $is_search = $_POST['is_search'];
  }
} else {
  $is_home    = is_home();
  $is_archive = is_archive();
  $is_single  = is_single();
  $is_search  = is_search();
}
$is_sticky  = is_sticky();

$has_post_thumbnail = FALSE;

if ( is_sticky() ) {
  $sticky_text = get_theme_mod( 'sticky_text', 'Most Viewed' );
}

if ( has_post_thumbnail() && ! $is_single ) {
  $has_post_thumbnail = TRUE;
}

$classes = array();

if ( $is_search || $is_archive || $is_home ) {
  $classes[] = 'archive-post';
}
?>

<?php zilla_post_before(); ?>

<article <?php post_class( $classes ); ?>>
  <?php zilla_post_start(); ?>

  <?php
  if ( $has_post_thumbnail ) :
    ?>
    <div class="inner-width-800">
      <div class="featured-image">
        <?php hype_post_thumbnail( $post->ID, 'full' ); ?>
      </div>
    </div>

    <?php
  endif;
  ?>
  <div class="inner-width-800">
    <?php if ( $is_sticky && ( $is_archive || $is_home || $is_search ) ) : ?>
      <div class="sticky-text">
        <?php echo esc_html( $sticky_text ); ?>
      </div>
    <?php endif; ?>
    <?php if ( $is_archive || $is_home || $is_search ) : ?>
      <a class="date" href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
      <h2><a class="archive-title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php endif;

    hype_print_post_format_media( $post->ID );

    the_content();

    if ( $is_archive || $is_home ) {
      hype_print_post_meta();
    }
    ?>
  </div>
</article>
