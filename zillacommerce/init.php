<?php

$shopifydir = get_template_directory() . '/zillacommerce/';

/**
 * Functions
 */
require $shopifydir . 'functions.php';

/**
 * Customizer
 */
require $shopifydir . 'customizer.php';

/**
 * Tour
 */
require $shopifydir . 'tour.php';

if ( ! function_exists( 'zillacommerce_admin_enqueue_scripts') ) :
/**
 * Enqueue Scripts for admin
 */
function zillacommerce_admin_enqueue_scripts() {
  wp_register_script( 'product-picker', get_template_directory_uri() . '/zillacommerce/scripts/product-picker.js' );

  $zillacommerce_args = array(
    'productPickerError' => __( 'Unfortunately there was an error while selecting your product.', 'zillacommerce' )
  );

  wp_localize_script( 'product-picker', 'ZillaCommerce', $zillacommerce_args );

  wp_enqueue_script( 'product-picker' );

  wp_enqueue_style( 'zillacommerce-admin-style', get_template_directory_uri() . '/zillacommerce/styles/admin.css' );
}
endif;
add_action( 'admin_enqueue_scripts', 'zillacommerce_admin_enqueue_scripts' );


if ( ! function_exists( 'zillacommerce_enqueue_scripts') ) :
/**
 * Enqueue Scripts for admin
 */
function zillacommerce_enqueue_scripts() {
  wp_enqueue_style( 'zillacommerce-main-style', get_template_directory_uri() . '/zillacommerce/styles/main.css' );
}
endif;
add_action( 'wp_enqueue_scripts', 'zillacommerce_enqueue_scripts' );
