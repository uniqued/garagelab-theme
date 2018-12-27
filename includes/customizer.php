<?php
/**
 * Hype Theme Customizer
 *
 * @package Hype
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

function hype_sanitize_custom_content ( $value ) {
  return wp_kses_post( force_balance_tags( $value ) );
}

function hype_sanitize_checkbox( $value ) {
  if ( ! isset( $value ) || ! in_array( $value, array( true, false ) ) ) {
    $value = true;
  }

  return $value;
}

add_action( 'customize_preview_init', 'hype_customize_preview_js', 100);

function hype_customize_preview_js() {
  wp_enqueue_script( 'hype_customizer', get_template_directory_uri() . '/scripts/customizer.js', array( 'customize-preview' ), '20130508', true );
}

add_action( 'customize_register', 'hype_customize_register', 50);

if ( ! function_exists( 'hype_customize_register') ) :

function hype_customize_register( $wp_customize ) {

  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

  //remove unneeded control
  $wp_customize->remove_control( 'blogdescription' );
  $wp_customize->remove_control( 'site_logo_header_text' );

  //move sections around
  if ( $wp_customize->get_panel( 'nav_menus' ) ) {
    $wp_customize->get_panel( 'nav_menus' )->priority = 29;
  } else {
    $wp_customize->get_section( 'nav' )->priority = 29;
  }

  $wp_customize->get_section( 'static_front_page' )->priority = 91;

  if ( function_exists( 'jetpack_the_site_logo' ) ) {
   /**
    * Site Title and Tag Line.
    */

    //rename section
    $wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title and Logo', 'hype' );

    $wp_customize->add_setting( 'show_title_instead_of_logo', array(
      'capability'        => 'edit_theme_options',
      'transport'         => 'postMessage',
      'type'              => 'option',
      'sanitize_callback' => 'hype_sanitize_checkbox'
    ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_title_instead_of_logo', array(
      'label'    => __( 'Show the title instead of a logo', 'hype' ),
      'section'  => 'title_tagline',
      'settings' => 'show_title_instead_of_logo',
      'type'     => 'checkbox'
    ) ) );
  }

  /**
   * Footer Options.
   */
  $wp_customize->add_section( 'footer_section', array(
    'title'       => __( 'Footer Section', 'hype' ),
    'description' => __( 'Options for the Footer', 'hype' ),
    'priority'    => 31
  ) );

  $wp_customize->add_setting( 'top_footer_text', array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'hype_sanitize_custom_content',
    'transport'         => 'postMessage'
  ) );

  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_footer_text', array(
    'label'    => __( 'Footer Text', 'hype' ),
    'section'  => 'footer_section',
    'settings' => 'top_footer_text'
  ) ) );

  $wp_customize->add_setting( 'top_footer_button_text', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );

  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_footer_button_text', array(
    'label'    => __( 'Button Text', 'hype' ),
    'section'  => 'footer_section',
    'settings' => 'top_footer_button_text'
  ) ) );

  $wp_customize->add_setting( 'top_footer_button_link', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );

  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'top_footer_button_link', array(
    'label'    => __( 'Button Link', 'hype' ),
    'section'  => 'footer_section',
    'settings' => 'top_footer_button_link'
  ) ) );

  /**
   * Social Icons
   */
  $wp_customize->add_section( 'social_icons', array(
    'title'       => __( 'Social Icons', 'hype' ),
    'description' => ( 'Link to your social media' ),
    'priority'    => 32,
  ) );

  $wp_customize->add_setting( 'social-dribbble', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-dribbble', array(
    'label'    => __( 'Dribbble URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-dribbble'
  ) ) );

  $wp_customize->add_setting( 'social-facebook', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-facebook', array(
    'label'    => __( 'Facebook URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-facebook'
  ) ) );

  $wp_customize->add_setting( 'social-google-plus', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-google-plus', array(
    'label'    => __( 'Google Plus URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-google-plus'
  ) ) );

  $wp_customize->add_setting( 'social-linkedin', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-linkedin', array(
    'label'    => __( 'Linkedin URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-linkedin'
  ) ) );

  $wp_customize->add_setting( 'social-pinterest', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-pinterest', array(
    'label'    => __( 'Pinterest URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-pinterest'
  ) ) );

  $wp_customize->add_setting( 'social-twitter', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-twitter', array(
    'label'    => __( 'Twitter URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-twitter'
  ) ) );

  $wp_customize->add_setting( 'social-youtube', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-youtube', array(
    'label'    => __( 'Youtube URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-youtube'
  ) ) );

  $wp_customize->add_setting( 'social-flickr', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-flickr', array(
    'label'    => __( 'Flickr URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-flickr'

  ) ) );

  $wp_customize->add_setting( 'social-instagram', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-instagram', array(
    'label'    => __( 'Instagram URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-instagram'
  ) ) );

  $wp_customize->add_setting( 'social-kickstarter', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-kickstarter', array(
    'label'    => __( 'Kiskstarter URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-kickstarter'
  ) ) );

  $wp_customize->add_setting( 'social-medium', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-medium', array(
    'label'    => __( 'Medium URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-medium'
  ) ) );

  $wp_customize->add_setting( 'social-rdio', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-rdio', array(
    'label'    => __( 'Rdio URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-rdio'
  ) ) );

  $wp_customize->add_setting( 'social-reddit', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-instagram', array(
    'label'    => __( 'Reddit URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-reddit'
  ) ) );

  $wp_customize->add_setting( 'social-rss', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-rss', array(
    'label'    => __( 'Rss Feed URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-rss'
  ) ) );

  $wp_customize->add_setting( 'social-spotify', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-spotify', array(
    'label'    => __( 'Spotify URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-spotify'
  ) ) );

  $wp_customize->add_setting( 'social-tumblr', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-tumblr', array(
    'label'    => __( 'Tumblr URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-tumblr'
  ) ) );

  $wp_customize->add_setting( 'social-vimeo', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-vimeo', array(
    'label'    => __( 'Vimeo URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-vimeo'
  ) ) );

  $wp_customize->add_setting( 'social-vine', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-vine', array(
    'label'    => __( 'Vine URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-vine'
  ) ) );
  
  
  $wp_customize->add_setting( 'social-instagram', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'social-instagram', array(
    'label'    => __( 'Instagram URL', 'hype' ),
    'section'  => 'social_icons',
    'settings' => 'social-instagram'
  ) ) );

  /**
   * Contact Info
   */
  $wp_customize->add_section( 'contact_info', array(
    'title'       => __( 'Contact Information', 'hype' ),
    'description' => __( 'Your contact information will be displayed in the footer of all pages.', 'hype' ),
    'priority'    => 30
  ) );

  $wp_customize->add_setting( 'email', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_email',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'email', array(
    'label'    => __( 'Your email address', 'hype' ),
    'section'  => 'contact_info',
    'settings' => 'email'
  ) ) );

  $wp_customize->add_setting( 'address', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'address', array(
    'label'    => __( 'Your street address', 'hype' ),
    'section'  => 'contact_info',
    'settings' => 'address'
  ) ) );

  $wp_customize->add_setting( 'city', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'city', array(
    'label'    => __( 'Your city', 'hype' ),
    'section'  => 'contact_info',
    'settings' => 'city'
  ) ) );

  $wp_customize->add_setting( 'province', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'province', array(
    'label'    => __( 'Your state/province', 'hype' ),
    'section'  => 'contact_info',
    'settings' => 'province'
  ) ) );

  $wp_customize->add_setting( 'postal-code', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'postal-code', array(
    'label'    => __( 'Your postal Code/zip code', 'hype' ),
    'section'  => 'contact_info',
    'settings' => 'postal-code'
  ) ) );

  $wp_customize->add_setting( 'phone', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'phone', array(
    'label'    => __( 'Your phone number', 'hype' ),
    'section'  => 'contact_info',
    'settings' => 'phone'
  ) ) );

  $wp_customize->add_setting( 'twitter-handle', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'twitter', array(
    'label'    => __( 'Your Twitter Handle(ie. @hype)', 'hype' ),
    'section'  => 'contact_info',
    'settings' => 'twitter-handle'
  ) ) );

  $wp_customize->add_setting( 'copyright', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'copyright', array(
    'label'    => __( 'Copyright Information', 'hype' ),
    'section'  => 'contact_info',
    'settings' => 'copyright'
  ) ) );

  /**
   * Color Options
   */
  $wp_customize->add_section( 'color_options', array(
    'title'       => __( 'Color Options', 'hype' ),
    'priority'    => 20
  ) );

  $wp_customize->add_setting( 'gradient_1', array(
    'default'           => '#56c7d9',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gradient_1', array(
    'label'    => __( 'Primary Gradient Color.', 'hype' ),
    'section'  => 'color_options',
    'settings' => 'gradient_1'
  ) ) );

  $wp_customize->add_setting( 'gradient_2', array(
    'default'           => '#80d2ad',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gradient_2', array(
    'label'    => __( 'Secondary Gradient Color.', 'hype' ),
    'section'  => 'color_options',
    'settings' => 'gradient_2'
  ) ) );

  $wp_customize->add_setting( 'button_color', array(
    'default'           => '#56c7d9',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_color', array(
    'label'    => __( 'Button Color.', 'hype' ),
    'section'  => 'color_options',
    'settings' => 'button_color'
  ) ) );

  /**
   * Single Portfolio Options
   */
  $wp_customize->add_section( 'single_project_options', array(
    'title'       => __( 'Single Portfolio Options', 'hype' ),
    'description' => __( 'Options for the single portfolio post type', 'hype' ),
    'priority'    => 100
  ) );

  $wp_customize->add_setting( 'single_project_show_more_posts', array(
    'type'              => 'option',
    'sanitize_callback' => 'hype_sanitize_checkbox',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'single_project_show_more_posts', array(
    'label'    => __( 'Show More Portfolio Items section', 'hype' ),
    'section'  => 'single_project_options',
    'settings' => 'single_project_show_more_posts',
    'type'     => 'checkbox'
  ) ) );

  $wp_customize->add_setting( 'single_project_show_more_title', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'single_project_show_more_title', array(
    'label'    => __( 'Title for "Show More Portfolio Items" section.', 'hype' ),
    'section'  => 'single_project_options',
    'settings' => 'single_project_show_more_title'
  ) ) );

  $wp_customize->add_setting( 'single_project_show_more_amount', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'single_project_show_more_amount', array(
    'label'    => __( 'How many portfolio items to show?.', 'hype' ),
    'section'  => 'single_project_options',
    'settings' => 'single_project_show_more_amount',
    'type'     => 'select',
    'choices'  => array(
      '1' => 'one',
      '2' => 'two',
      '3' => 'three',
      '4' => 'four',
      '5' => 'five',
      '6' => 'six',
      '7' => 'seven',
      '8' => 'eight',
      '9' => 'nine',
      '10' => 'ten'
    )
  ) ) );

  $wp_customize->add_setting( '_single_project_see_all_link', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );

  $wp_customize->add_control( new wp_customize_control( $wp_customize, '_single_project_see_all_link', array(
    'label'    => __( 'Button Link', 'hype' ),
    'section'  => 'single_project_options',
    'settings' => '_single_project_see_all_link'
  ) ) );

  $wp_customize->add_section( 'portfolio_options' , array(
    'title' => __( 'Portfolio Options','hype' ),
  ) );


  $wp_customize->add_setting( 'portfolio_pagination', array(
    'default' => false,
  ) );

  $wp_customize->add_control( 'show_portfolio_pagination', array(
    'settings' => 'portfolio_pagination',
    'label'    => __('Enable "load more" on portfolio pages', 'hype'),
    'section'  => 'portfolio_options',
    'type'     => 'checkbox',
  ) );

  $wp_customize->add_setting( 'portfolios_per_page', array(
    'default' => '12',
    'sanitize_callback' => 'sanitize_text_field',
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'portfolios_per_page', array(
    'label' => __( 'Portfolio items per page', 'hype' ),
    'section' => 'portfolio_options',
    'settings' => 'portfolios_per_page'
  ) ) );

  /**
   *  Options
   */
  $wp_customize->add_section( 'single_post_options', array(
    'title'       => __( 'Single Post Options', 'hype' ),
    'description' => __( 'Options for the single post type', 'hype' ),
    'priority'    => 97
  ) );

  $wp_customize->add_setting( 'single_post_show_more_posts', array(
    'type'              => 'option',
    'sanitize_callback' => 'hype_sanitize_checkbox',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'single_post_show_more_posts', array(
    'label'    => __( 'Show More Posts section', 'hype' ),
    'section'  => 'single_post_options',
    'settings' => 'single_post_show_more_posts',
    'type'     => 'checkbox'
  ) ) );

  $wp_customize->add_setting( 'single_post_show_more_title', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'single_post_show_more_title', array(
    'label'    => __( 'Title for "Show More Posts" section.', 'hype' ),
    'section'  => 'single_post_options',
    'settings' => 'single_post_show_more_title'
  ) ) );

  $wp_customize->add_setting( 'single_post_show_more_amount', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'single_post_show_more_amount', array(
    'label'    => __( 'How many post items to show?.', 'hype' ),
    'section'  => 'single_post_options',
    'settings' => 'single_post_show_more_amount',
    'type'     => 'select',
    'choices'  => array(
      '1' => 'one',
      '2' => 'two',
      '3' => 'three',
      '4' => 'four',
      '5' => 'five',
      '6' => 'six',
      '7' => 'seven',
      '8' => 'eight',
      '9' => 'nine',
      '10' => 'ten'
    )
  ) ) );

  $wp_customize->add_setting( 'single_post_show_more_button_text', array(
    'default'           => 'See All Posts',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'single_post_show_more_button_text', array(
    'label'    => __( 'Text for "Show More Posts" button.', 'hype' ),
    'section'  => 'single_post_options',
    'settings' => 'single_post_show_more_button_text'
  ) ) );

  /**
   * Post Archive Section.
   */
  $wp_customize->add_section( 'archive_options', array(
    'title'       => __( 'Post Archive Options', 'hype' ),
    'description' => __( 'Options for the Post Archive', 'hype' ),
    'priority'    => 98
  ) );

  $wp_customize->add_setting( 'archive_title', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );
  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'archive_title', array(
    'label'    => __( 'Title to be displayed on the archive page', 'hype' ),
    'section'  => 'archive_options',
    'settings' => 'archive_title'
  ) ) );

  $wp_customize->add_setting( 'archive_subtitle', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );

  $wp_customize->add_control( new WP_customize_control( $wp_customize, 'archive_subtitle', array(
    'label'    => __( 'Subitle to be displayed on the archive page', 'hype' ),
    'section'  => 'archive_options',
    'settings' => 'archive_subtitle'
  ) ) );

  $wp_customize->add_setting( 'archive_featured_image', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'postMessage'
  ) );

  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'archive_featured_image', array(
    'label'    => __( 'Featured image for the archive header', 'hype' ),
    'section'  => 'archive_options',
    'settings' => 'archive_featured_image',
  ) ) );

  $wp_customize->add_setting( 'sticky_text', array(
    'default'           => 'Most Viewed',
    'sanitize_callback' => 'sanitize_text_field'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'sticky_text', array(
    'label'    => __( 'Text to display in the "sticky" sticker', 'hype' ),
    'section'  => 'archive_options',
    'settings' => 'sticky_text'
  ) ) );

  //Portfolio Options(adding to Zilla Portfolio Options

  $wp_customize->add_setting( 'full_portfolio_cta', array(
    'default' => 'View Full Portfolio',
    'sanitize_callback' => 'sanitize_text_field'
  ) );

  $wp_customize->add_control( new wp_customize_control( $wp_customize, 'full_portfolio_cta', array(
    'label'    => __( 'Portfolio Call to Action Text', 'hype' ),
    'section'  => 'portfolio_options',
    'settings' => 'full_portfolio_cta'
  ) ) );

  $wp_customize->add_setting( '_portfolio_dribbble_text', array(
    'default'           => __( 'More On Dribbble', 'hype' ),
    'sanitize_callback' => 'sanitize_text_field'
  ) );
  $wp_customize->add_control( new wp_customize_control( $wp_customize, '_portfolio_dribbble_text', array(
    'label'    => __( 'Dribbble Button Text', 'hype' ),
    'section'  => 'portfolio_options',
    'settings' => '_portfolio_dribbble_text'
  ) ) );

  $wp_customize->add_setting( '_portfolio_dribbble_link', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'postMessage'
  ) );

  $wp_customize->add_control( new wp_customize_control( $wp_customize, '_portfolio_dribbble_link', array(
    'label'    => __( 'Dribbble Button Link', 'hype' ),
    'section'  => 'portfolio_options',
    'settings' => '_portfolio_dribbble_link'
  ) ) );

  //add to new "menu" panel
  $wp_customize->add_setting( 'always_display_mobile_menu', array(
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
    'type'              => 'option',
    'sanitize_callback' => 'hype_sanitize_checkbox'
  ) );

  if ( $wp_customize->get_panel( 'nav_menus' ) ) {
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'always_display_mobile_menu', array(
      'label'    => __( 'Always display mobile menu', 'hype' ),
      'section'  => 'menu_switcher',
      'settings' => 'always_display_mobile_menu',
      'type'     => 'checkbox'
    ) ) );

    $wp_customize->add_section( 'menu_switcher', array(
      'priority'   => 1000,
      'capability' => 'edit_theme_options',
      'title'      => __( 'Menu Display', 'hype' ),
      'panel'      => 'nav_menus',
    ) );
  } else {
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'always_display_mobile_menu', array(
      'label'    => __( 'Always display mobile menu', 'hype' ),
      'section'  => 'nav',
      'settings' => 'always_display_mobile_menu',
      'type'     => 'checkbox'
    ) ) );
  }
}

endif;
