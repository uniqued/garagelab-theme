<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hype
 */
?>

<article class="no-results not-found">
  <div class="page-content inner-width">
    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

      <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'hype' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

    <?php elseif ( is_search() ) : ?>

      <p><?php _e( 'Leider gab es für diesen Suchbegriff keine Ergebnisse.', 'hype' ); ?></p>

      <?php get_search_form(); ?>

    <?php else : ?>

      <p><?php _e( 'Leider können wir das nicht finden. Bitte versuche es nochmal mit der Suche unten:', 'hype' ); ?></p>

      <?php get_search_form(); ?>

    <?php endif; ?>
  </div><!-- .page-content -->
</article><!-- .no-results -->