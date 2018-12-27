<?php
/**
 * The Header for our theme.
 *
 *
 * @package Hype
 */
?><!DOCTYPE html>
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="ie9 lt-ie10 no-js"> <![endif]-->
<!--[if IE 10 ]><html <?php language_attributes(); ?> class="ie10 lt-ie11 no-js"> <![endif]-->
<!--[if !(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<!--[if (IE)]><!--> <html <?php language_attributes(); ?> class="no-js ie"> <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php zilla_meta_head(); ?>
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  <?php wp_head(); ?>
  <?php zilla_head(); ?>
  <?php
  global $post;

  $header_options     = get_theme_mod( 'header_options' );
  $always_mobile_menu = get_option( 'always_display_mobile_menu', '0' );
  $show_title         = get_option( 'show_title_instead_of_logo', '0' );
  $header_classes     = '';
  $body_class         = '';

  if ( "1" === $always_mobile_menu ) :
    $header_classes[] = 'always-mobile';
  else :
    $header_classes[] = 'alternate-menu';
  endif;

  ?>

</head>

<body <?php body_class(); ?>>
<?php zilla_body_start(); ?>

<div id="page">
  <?php zilla_header_before(); ?>

  <header class="site-header full-width <?php echo implode( ' ', $header_classes ); ?>">
  <?php if ( is_page_template( 'page-cover.php' )== true || is_home()==true || is_page_template( 'page-with-hero.php' )==true )  { ?>
  <?php  $start_with_invert = true; ?>
  <?php  }  ?>
    <div class="site-header-inner">
      <div class="site-header-inner-top">
        <div class="inner-width">
          <span class="site-header-inner-logo <?php if ($start_with_invert == true) { echo('hidden'); } ?>">
		    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link" rel="home" itemprop="url">
           <!------------------------------------------------------------------------------>
			<picture><!--[if IE 9]><video style="display: none;"><![endif]-->
			<source media="(max-width: 768px)" srcset="<?php bloginfo('template_directory'); ?>/images/GarageLab_Logo_Small.svg" type="image/svg+xml">
			<source srcset="<?php bloginfo('template_directory'); ?>/images/GarageLab_Logo.svg" type="image/svg+xml"><!--[if IE 9]></video><![endif]-->
			<img src="<?php bloginfo('template_directory'); ?>/images/GarageLab_Logo.png" alt="GarageLab">
			</picture>
			<!------------------------------------------------------------------------------>
           </a>
          </span>
		  <span class="site-header-inner-logo-invert <?php if ($start_with_invert == true) { echo('');} ?>">
		    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link" rel="home" itemprop="url">
            <!------------------------------------------------------------------------------>
			<picture><!--[if IE 9]><video style="display: none;"><![endif]-->
			<source media="(max-width: 768px)" srcset="<?php bloginfo('template_directory'); ?>/images/GarageLab_Logo_Small.svg" type="image/svg+xml">
			<source srcset="<?php bloginfo('template_directory'); ?>/images/GarageLab_Logo_white.svg" type="image/svg+xml"><!--[if IE 9]></video><![endif]-->
			<img src="<?php bloginfo('template_directory'); ?>/images/GarageLab_Logo_white.png" alt="GarageLab">
			</picture>
			<!------------------------------------------------------------------------------>
           </a>
          </span>
          <span class="site-header-inner-menu">
            <span class="menu-closed">
              <span class="site-header-menu-text"><?php _e( 'Menü', 'hype' ); ?></span>
            </span>
            <span class="menu-open hidden">
              <span class="site-header-menu-text active"><?php _e( 'schließen', 'hype' ); ?></span>
            </span>
            <span class="site-header-menu-icon">
              <svg class="site-header-menu-icon-1 site-header-menu-line">
                <use xlink:href="#icon-menu-single"></use>
              </svg>
              <svg class="site-header-menu-icon-2 site-header-menu-line">
                <use xlink:href="#icon-menu-single"></use>
              </svg>
              <svg class="site-header-menu-icon-3 site-header-menu-line">
                <use xlink:href="#icon-menu-single"></use>
              </svg>
            </span>
          </span>
          <nav class="alternate-nav">
            <?php if ( has_nav_menu ( 'desktop' ) ) {
              wp_nav_menu( array(
                'depth'          => 2,
                'theme_location' => 'desktop',
                'walker'         => new hype_walker_class_menu
              ) );
            } ?>
          </nav>
        </div>
      </div>

      <div class="site-header-full-menu closed overflow-hidden">
        <div class="site-header-full-menu-inner">
          <?php zilla_nav_before(); ?>
          <nav class="primary-navigation expanded inner-width">
            <?php if ( has_nav_menu ( 'mobile') ) {
              wp_nav_menu( array(
                'depth'          => 2,
                'theme_location' => 'mobile',
                'walker'         => new hype_walker_class_menu
              ) );
            } ?>
          </nav>
          <?php zilla_nav_after(); ?>
          <?php if ( get_theme_mod( 'twitter-handle' ) && get_theme_mod( 'social-twitter' ) ): ?>

            <div class="menu-follow-us">
              <?php _e( 'Follow us', 'hype' ); ?>
              <a href="<?php echo esc_url( get_theme_mod( 'social-twitter' ) ) ?>" target="_blank">
                <?php echo esc_html( get_theme_mod( 'twitter-handle' ) ); ?>!
              </a>
            </div>

          <?php endif; ?>
          <?php get_template_part( 'social-icons' ); ?>
          <div class="site-header-inner-bottom inner-width">

            <?php if ( get_theme_mod( 'copyright' ) ): ?>

              <div class="copyright">
                <?php echo esc_html( get_theme_mod( 'copyright' ) ); ?>
              </div>

            <?php endif; ?>

          </div><!-- .site-header-inner-bottom -->
        </div><!-- .site-header-full-menu-inner -->
      </div><!-- .site-header-full-menu -->

    </div><!-- .site-header-inner -->

  </header>

  <?php zilla_header_after(); ?>

  <div id="content" class="site-content full-width">
    <div id="skrollr-body">
      <?php zilla_content_start(); ?>
<?php

if ( is_page_template( 'page-cover.php' ) || is_home() || is_page_template( 'page-with-hero.php' )) {
  get_template_part( 'hero', 'full' );
} else if ( is_page_template( 'template-portfolio.php' ) || is_page_template( 'template-contact.php' ) || is_page_template( 'about.php' ) || is_page_template( 'taxonomy-portfolio-type.php' ) || ! is_page() ) {
  get_template_part( 'hero' );
}