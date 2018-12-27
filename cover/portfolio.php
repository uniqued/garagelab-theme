<?php
/**
 * The template part for displaying portfolio objects on homepage.
 *
 * @package Hype
 *
 */


$portfolio_amount    = get_post_meta( $post->ID, '_zilla_home_portfolio_amount', true );
$portfolio_link      = get_post_meta( $post->ID, '_zilla_home_portfolio_link', true ) ? get_post_meta( $post->ID, '_zilla_home_portfolio_link', true ) : '';
$portfolio_link_text = get_post_meta( $post->ID, '_zilla_home_portfolio_link_text', true ) ? get_post_meta( $post->ID, '_zilla_home_portfolio_link_text', true ) : 'View Full Portfolio';
?>
<section class="full-width section portfolio">
  <div class="portfolio-inner">
    <div class=" portfolio-inner">
      <?php hype_print_portfolio_grid( false, '3' ); ?>
    </div>
  </div>
  <div class="inner-width">
    <div class="home-project-button-container">
      <a href="<?php echo esc_attr( $portfolio_link ); ?>" class="button primary-button"><?php echo esc_html( $portfolio_link_text ); ?></a>
    </div>
  </div>
</section>