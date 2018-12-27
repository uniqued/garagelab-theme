<?php
/**
 * The template part for displaying "our team" section" on about template.
 *
 * @package Hype
 *
 */
$title     = get_post_meta( $post->ID, '_zilla_join_our_team_title', true );
$subtitle  = get_post_meta( $post->ID, '_zilla_join_our_team_subtitle', true );
$cta_text  = get_post_meta( $post->ID, '_zilla_join_our_team_cta_text', true );
$cta_link  = get_post_meta( $post->ID, '_zilla_join_our_team_cta_link', true );
$positions = explode( ',',  get_post_meta( $post->ID, '_zilla_join_our_team_positions', true ) );
?>

<h2><?php echo esc_html( $title );  ?></h2>
<h3><?php echo esc_html( $subtitle );  ?></h3>
<?php if ( ! empty( $positions) ) : ?>
  <div class="marker"><?php _e( 'Featured Positions', 'hype' ); ?></div>
  <?php foreach( $positions as $position ) : ?>
    <div class="join-our-team-position marker"><?php echo esc_html( $position ); ?></div>
  <?php endforeach; ?>
  <section class="lone-button">
    <a class="button primary-button" href="<?php echo esc_url( $cta_link ); ?>"><?php echo esc_html( $cta_text ); ?></a>
  </section>
<?php endif; ?>