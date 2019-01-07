<?php
/**
 * The Hero.
 *
 * @package Hype
 */


 
global $post, $current_user;

$subtitle             = get_post_meta( $post->ID, '_zilla_subtitle', true );

$archive_title      = get_theme_mod( 'archive_title', 'Posts' );
$archive_subtitle   = get_theme_mod( 'archive_subtitle', '' );
$archive_image      = get_theme_mod( 'archive_featured_image', '' );
if ( is_page() && !is_home() ) :
  $header_background = $archive_image;
else :
  $header_background = wp_get_attachment_url( get_post_thumbnail_id() );
endif;

  //$header_background = Image aus Hero Plugin
  $hero_id = love_hero_get_hero_id();
$hero_meta = new Hero_Meta( $hero_id);
$hero_image = love_hero_get_hero_image( $hero_meta->get('image_url') ); 
$button_text       = get_post_meta( $post->ID, '_zilla_hero_button_text', true );
$button_link       = get_post_meta( $post->ID, '_zilla_hero_button_link', true );
$button_new_tab    = get_post_meta( $post->ID, '_zilla_hero_button_new_tab', true );
$target            = 'on' == $button_new_tab ? 'target="_blank"' : '';

if ( ! empty( $header_background ) ): ?>
  <style>
    .home .hero,
    .blog .hero,
    .page-template-page-cover .hero {
      background-image: url(<?php echo $header_background ?>);
    }
  </style>
  <?php
endif;
?>
<div class="hero">
  <div class="hero-overlay"></div>
  <div class="bcg">
    <div class="inner-width">
      <div class="hero-content-full"
           data-start="opacity: 1; z-index:2;"
           data-center-top="opacity: 0; z-index: -1;"
           data-anchor-target=".skrollr-content">
        
		<?php

?>
  
		
		<?php if ( is_home() ): ?>
				<h1><?php echo esc_attr( get_the_title($hero_id) ); ?></h1>
          <?php if ( ! empty( $archive_subtitle ) ) : ?>
            <h3 class="lead"><?php echo esc_html( $archive_subtitle ); ?></h3>
          <?php endif; ?>
        <?php else: ?>
          <h1><?php the_title(); ?></h1>
          <?php if ( ! empty( $subtitle ) ) : ?>
            <h3 class="lead"><?php echo $hero_meta->get('text'); ?></h3>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ( ! empty( $button_text ) && ! empty( $button_link ) ) : ?>
          <a class="button secondary-button hero-button" href="<?php echo esc_url( $hero_meta->get('button_url') ); ?>" >
          <?php echo ($hero_meta->get('button_text')); ?>
          </a>
        <?php endif; ?>
        <a href="#main"
          <?php if ( is_page_template( 'page-cover.php' ) || is_home() || is_page_template( 'page-with-hero.php' ) ) : ?>
		    data-start="opacity: 1; z-index:2;"
            data-center-bottom="opacity: 0; z-index: -1;"
            data-anchor-target=".skrollr-content" class="hero-down-arrow"
          <?php endif; ?>
          >
          <div class="hero-down-arrow-icon"></div>
        </a>
      </div><!-- .hero-content-full -->
    </div><!-- .inner-width -->
  </div><!-- .bcg -->
</div><!-- .hero -->



