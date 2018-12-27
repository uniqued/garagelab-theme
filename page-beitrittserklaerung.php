<?php
/**
 * The template for displaying the Beitrittserklaerung.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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

 

  <?php zilla_header_after(); ?>

  <div id="content" class="site-content full-width">
    <div id="skrollr-body">
      <?php zilla_content_start(); ?>
	  
	  
	  
	  
	  
	  

  <div id="main">

    <?php
    while ( have_posts() ) : the_post();

      get_template_part( 'content', 'page' );

    endwhile;

    ?>
  <?php zilla_comments_before(); ?>
  <?php // If comments are open or we have at least one comment, load up the comment template
  if ( comments_open() || '0' != get_comments_number() )
    comments_template();
  ?>
  <?php zilla_comments_after(); ?>
  <div><!-- #main -->
</div><!-- #skrollr-body -->


