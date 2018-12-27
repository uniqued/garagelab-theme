<?php
/**
 * Tour the Shopify functionality
 */
if ( ! function_exists( 'zillacommerce_tour_assets') ) :
/**
 * Enqueue the tour's scripts and styles
 */
function zillacommerce_tour_assets() {
  $theme_info = wp_get_theme();
  $shop_options = array();

  $tour_steps = array(
    __( 'List Pages', 'zillacommerce' ) => array(
      __( '<p>Click here to list all pages and add new ones.</p>', 'zillacommerce' ),
      admin_url( 'edit.php?post_type=page&tour&step=1' ),
      'link'
    ),
    __( "Add New Page", "rainier" ) => array(
      __( '<p>Click here to create a new page.  From there we will learn how to add products and/or collections to the page.</p>', 'zillacommerce' ),
      admin_url( 'post-new.php?post_type=page&tour&step=2' ),
      'link'
    ),
    __( "Add Product", "rainier" ) => array(
      __( '<p>Click here to select a product or collection to display.  If you don\'t have a store or haven\'t logged in yet you will be able to do so here as well.', 'zillacommerce' ),
      "#zillacommerce-add-product",
      "addProduct"
    )
  );

  $tour_strings = array(
    'templateDirectory'  => get_template_directory_uri(),
    'buttonStart'        => __( 'Begin Tour', 'zillacommerce' ),
    'buttonDecline'      => __( 'No Thanks', 'zillacommerce' ),
    'landingTitle'       => sprintf( __( 'Welcome to %s', 'zillacommerce'), $theme_info->get( 'Name' ) ),
    'buttonNext'         => __( 'Next', 'zillacommerce' ),
    'buttonPrevious'     => __( 'Previous', 'zillacommerce' ),
    'buttonFinish'       => __( 'Finish', 'zillacommerce' ),
    'landingDescription' => $theme_info->get( 'Description' ),
    'landingAbout'       => __( 'Learn how to add a page and use the Shopify product shortcode with this short tour.  Thanks for choosing Themezilla.', 'zillacommerce' ),
    'completeTitle'      => __( 'Tour Complete!', 'zillacommerce' ),
    'completeMessage'    => __( 'Thanks for using Hype. If you have any questions, please don\'t hesitate to get in touch with our support team.', 'zillacommerce' ),
    'completeConfirm'    => __( 'Got it!', 'zillacommerce' )
  );

  if ( isset( $_GET['step'] ) ) {
    $shop_options['step'] = $_GET['step'];
  }

  $shop_options['tourStrings'] = $tour_strings;
  $shop_options['tourSteps']   = $tour_steps;

  wp_enqueue_script( 'tether', get_template_directory_uri() . '/zillacommerce/scripts/tether.min.js', array(), '20160118', true );
  wp_register_script( 'shopify-tour-script', get_template_directory_uri() . '/zillacommerce/scripts/tour.js', array( 'jquery', 'tether' ), '20160118', true );
  wp_localize_script( 'shopify-tour-script', 'ZillaCommerceTour', $shop_options );
  wp_enqueue_script( 'shopify-tour-script' );

  wp_enqueue_style( 'shopify-tour-style', get_template_directory_uri() . '/zillacommerce/styles/tour.css', false, '20150118' );
}
endif;

if ( ! function_exists( 'zillacommerce_tour' ) ) :
/**
 * Launch the tour
 */
function zillacommerce_tour() {
  if ( isset( $_GET['tour'] ) ) {
    add_action( 'admin_enqueue_scripts', 'zillacommerce_tour_assets' );
  }
}
endif;
add_action( 'wp_loaded', 'zillacommerce_tour' );

/**
 * After the theme is activated, redirect the user to the tour
 * on the Customize panel page
 */
if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
  wp_redirect( admin_url( "index.php?tour" ) );
}
