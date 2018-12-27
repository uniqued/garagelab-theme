<?php
/**
 * The template part for displaying audio on a single portfolio page.
 *
 * @package Hype
 *
 */
$title      = get_post_meta( $post->ID, '_tzp_audio_title', true );
$subtitle   = get_post_meta( $post->ID, '_tzp_audio_subtitle', true );
$show_title = '';

if ( $title || $subtitle ) :
  $show_title = 'with-title';
endif;
?>

<div class="portfolio-audio <?php echo $show_title; ?>">
  <?php if ( ! empty( $show_title ) ) : ?>

    <div class="portfolio-audio-meta">
      <?php if ( $title ) : ?>
        <h3 class="portfolio-audio-title"><?php echo esc_html( $title ); ?></h3>
      <?php endif; ?>

      <?php if ( $subtitle ) : ?>
        <p class="portfolio-audio-subtitle"><?php echo esc_html( $subtitle ); ?></p>
      <?php endif; ?>
    </div>

  <?php endif; ?>

  <div class="portfolio-audio-player">
    <?php echo hype_print_audio_html( $post->ID ); ?>
  </div>
</div>

