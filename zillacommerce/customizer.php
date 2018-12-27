<?php
/**
 * Shopify Theme Customizer
 *
 * @package zillacommerce
 */


if ( ! function_exists( 'zillacommerce_customize_register') ) :
/**
 * Add Shopify options to the customizer
 */
function zillacommerce_customize_register( $wp_customize ) {

  $wp_customize->add_section( 'shopify_options', array(
    'title'       => __( 'Shopify', 'zillacommerce' ),
    'description' => __( 'To integrate your Hype with Shopify, fill out the settings below, create a new page using the Default template, and add products or collections using the Zillacommerce shortcode button. For more information, see Hype\'s attached documentation.', 'hype' ),
    'priority'    => 30,
  ) );

  // Cart Title
  $wp_customize->add_setting( 'shopify_cart_title', array(
    'default'             => __( 'Your Cart', 'zillacommerce' ),
    'capability'          => 'edit_theme_options',
    'sanitize_callback'   => 'sanitize_text_field',
    'transport'           => 'refresh'
  ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopify_cart_title', array(
    'label'       => __( 'Cart Title', 'zillacommerce' ),
    'section'     => 'shopify_options',
    'settings'    => 'shopify_cart_title'
  ) ) );

  // Buy Now Text
  $wp_customize->add_setting( 'shopify_buy_now_text', array(
    'default'             => __( 'Buy Now', 'zillacommerce' ),
    'capability'          => 'edit_theme_options',
    'sanitize_callback'   => 'sanitize_text_field',
    'transport'           => 'refresh'
  ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopify_buy_now_text', array(
    'label'       => __( 'Buy Now Text', 'zillacommerce' ),
    'section'     => 'shopify_options',
    'settings'    => 'shopify_buy_now_text'
  ) ) );

  // Out of Stock Text
  $wp_customize->add_setting( 'shopify_sold_out_text', array(
    'default'             => __( 'Out of Stock', 'zillacommerce' ),
    'capability'          => 'edit_theme_options',
    'sanitize_callback'   => 'sanitize_text_field',
    'transport'           => 'refresh'
  ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'shopify_sold_out_text', array(
    'label'       => __( 'Out of Stock Text', 'zillacommerce' ),
    'section'     => 'shopify_options',
    'settings'    => 'shopify_sold_out_text'
  ) ) );

  // Text Color
  $wp_customize->add_setting( 'shopify_text_color', array(
    'default'           => '#1d1d1d',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'refresh'
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shopify_text_color', array(
    'label'    => __( 'Text Color', 'zillacommerce' ),
    'section'  => 'shopify_options',
    'settings' => 'shopify_text_color'
  ) ) );

  // Button Background
  $wp_customize->add_setting( 'shopify_button_background', array(
    'default'           => '#56c7d9',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'refresh'
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shopify_button_background', array(
    'label'    => __( 'Button Background', 'zillacommerce' ),
    'section'  => 'shopify_options',
    'settings' => 'shopify_button_background'
  ) ) );

  // Button Color
  $wp_customize->add_setting( 'shopify_button_color', array(
    'default'           => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'refresh'
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shopify_button_color', array(
    'label'    => __( 'Button Text Color', 'zillacommerce' ),
    'section'  => 'shopify_options',
    'settings' => 'shopify_button_color'
  ) ) );

  // Accent Color
  $wp_customize->add_setting( 'shopify_accent_color', array(
    'default'           => '#3d3d3d',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'refresh'
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shopify_accent_color', array(
    'label'    => __( 'Accent Color', 'zillacommerce' ),
    'section'  => 'shopify_options',
    'settings' => 'shopify_accent_color'
  ) ) );


  // Container Background
  $wp_customize->add_setting( 'shopify_container_background', array(
    'default'           => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'refresh'
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'shopify_container_background', array(
    'label'    => __( 'Container Background Color', 'zillacommerce' ),
    'section'  => 'shopify_options',
    'settings' => 'shopify_container_background'
  ) ) );
}
endif;

add_action( 'customize_register', 'zillacommerce_customize_register', 55);
